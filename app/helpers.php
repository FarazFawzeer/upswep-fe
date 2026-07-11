<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('img_url')) {
    /**
     * Returns the correct image URL for display, preferring WebP if it exists.
     * Always reads from storage/app/public directly — no symlink dependency.
     *
     * Usage in Blade:
     *   <img src="{{ img_url($product->main_image) }}" alt="...">
     *   <img src="{{ img_url($category->image) }}" alt="...">
     *
     * What it does:
     *   1. Takes the path stored in DB e.g. "products/shirt-abc123.jpg"
     *   2. Derives the WebP path   e.g. "products/shirt-abc123.webp"
     *   3. If the WebP file exists in storage/app/public → returns /img/products/shirt-abc123.webp
     *   4. Otherwise → returns /img/products/shirt-abc123.jpg
     *   5. Both URLs route through ImageServeController which reads from storage/app/public
     *      directly — no symlink needed.
     *
     * @param  string|null  $path  Relative path stored in DB (e.g. "products/shirt.jpg")
     * @param  string|null  $fallback  URL to return if $path is null (optional)
     * @return string|null  Full URL to serve the image
     */
    function img_url(?string $path, ?string $fallback = null): ?string
    {
        if (!$path) return $fallback;

        // Derive WebP path by replacing extension
        $webpPath = preg_replace('/\.[^.]+$/', '.webp', $path);

        // Check if WebP exists in storage/app/public
        if (Storage::disk('public')->exists($webpPath)) {
            return url('/img/' . $webpPath);
        }

        // Fall back to original
        return url('/img/' . $path);
    }
}

if (!function_exists('img_exists')) {
    /**
     * Check if an image path actually exists in storage/app/public.
     * Useful for conditionally showing images vs placeholders.
     *
     * Usage:
     *   @if (img_exists($product->main_image))
     *
     * @param  string|null  $path  Relative path stored in DB
     * @return bool
     */
    function img_exists(?string $path): bool
    {
        if (!$path) return false;
        return Storage::disk('public')->exists($path);
    }
}