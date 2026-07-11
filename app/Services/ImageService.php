<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Store an uploaded image and a WebP copy in the same folder.
     *
     * What happens:
     *  1. Generate a unique filename based on the original name
     *  2. Store the original file as-is (preserving format/quality)
     *  3. Create a WebP copy with the same base name + .webp extension
     *  4. Both files go into storage/app/public/{folder}/
     *  5. Only the original filename is returned — store this in DB
     *
     * Usage:
     *   $filename = app(ImageService::class)->store($request->file('image'), 'categories');
     *   // Returns e.g. "shirt-abc123.jpg"
     *   // DB stores: "categories/shirt-abc123.jpg"
     *   // Disk has:  storage/app/public/categories/shirt-abc123.jpg
     *   //            storage/app/public/categories/shirt-abc123.webp
     *
     * @param  UploadedFile  $file    The uploaded file from the request
     * @param  string        $folder  Subfolder inside storage/app/public (e.g. 'products', 'categories')
     * @return string                 Relative path stored in DB: "{folder}/{filename}"
     */
    public function store(UploadedFile $file, string $folder): string
    {
        // Build a unique filename: slugified original name + unique suffix + original extension
        // e.g. "My Shirt Photo.JPG" → "my-shirt-photo-a1b2c3d4.jpg"
        $originalName  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension     = strtolower($file->getClientOriginalExtension());
        $uniqueSuffix  = Str::random(8);
        $filename      = Str::slug($originalName) . '-' . $uniqueSuffix . '.' . $extension;
        $relativePath  = $folder . '/' . $filename;

        // 1. Store the original file
        Storage::disk('public')->putFileAs($folder, $file, $filename);

        // 2. Store a WebP copy (same base name, .webp extension)
        $this->storeWebp($file, $folder, $filename);

        // 3. Return the relative path for DB storage
        return $relativePath;
    }

    /**
     * Delete both the original file and its WebP copy from storage.
     *
     * Usage:
     *   app(ImageService::class)->delete('categories/shirt-abc123.jpg');
     *   // Deletes: storage/app/public/categories/shirt-abc123.jpg
     *   //          storage/app/public/categories/shirt-abc123.webp
     *
     * @param  string|null  $relativePath  The path stored in DB (e.g. "categories/shirt-abc123.jpg")
     */
    public function delete(?string $relativePath): void
    {
        if (!$relativePath) return;

        // Delete original
        Storage::disk('public')->delete($relativePath);

        // Delete WebP copy
        $webpPath = $this->toWebpPath($relativePath);
        Storage::disk('public')->delete($webpPath);
    }

    /**
     * Replace an existing image: delete both old files, store new image + WebP.
     *
     * Usage:
     *   $newPath = app(ImageService::class)->replace($request->file('image'), 'products', $product->main_image);
     *
     * @param  UploadedFile  $file           New file being uploaded
     * @param  string        $folder         Storage subfolder
     * @param  string|null   $existingPath   Current DB value to delete (or null if none)
     * @return string                        New relative path for DB
     */
    public function replace(UploadedFile $file, string $folder, ?string $existingPath): string
    {
        $this->delete($existingPath);
        return $this->store($file, $folder);
    }

    // ----------------------------------------------------------------
    // Private helpers
    // ----------------------------------------------------------------

    /**
     * Generate and store a WebP version of the uploaded image.
     * Uses GD (always available on standard PHP installs) with a fallback
     * that skips WebP creation silently if the source format isn't supported.
     *
     * @param  UploadedFile  $file      The original uploaded file
     * @param  string        $folder    Storage subfolder
     * @param  string        $filename  Original filename (e.g. "shirt-abc123.jpg")
     */
    private function storeWebp(UploadedFile $file, string $folder, string $filename): void
    {
        try {
            $mimeType = $file->getMimeType();

            // Create a GD image resource from the uploaded file
            $image = match ($mimeType) {
                'image/jpeg' => imagecreatefromjpeg($file->getPathname()),
                'image/png'  => imagecreatefrompng($file->getPathname()),
                'image/gif'  => imagecreatefromgif($file->getPathname()),
                'image/webp' => imagecreatefromwebp($file->getPathname()),
                default      => null,
            };

            if (!$image) return; // unsupported format — skip silently

            // Capture WebP output into a buffer
            ob_start();
            imagewebp($image, null, 85); // quality 85 — good balance of size vs quality
            $webpData = ob_get_clean();
            imagedestroy($image);

            // Save to storage
            $webpFilename = $this->toWebpPath($folder . '/' . $filename);
            Storage::disk('public')->put($webpFilename, $webpData);

        } catch (\Throwable $e) {
            // WebP conversion failed (e.g. GD not compiled with WebP support).
            // Log it but don't block the original upload — original is already saved.
            logger()->warning('ImageService: WebP conversion failed for ' . $filename . ': ' . $e->getMessage());
        }
    }

    /**
     * Convert a file path to its WebP equivalent.
     * e.g. "categories/shirt-abc123.jpg" → "categories/shirt-abc123.webp"
     *
     * @param  string  $path  Original relative path
     * @return string         WebP path
     */
    private function toWebpPath(string $path): string
    {
        return preg_replace('/\.[^.]+$/', '.webp', $path);
    }
}