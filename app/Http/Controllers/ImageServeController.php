<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ImageServeController extends Controller
{
    /**
     * Serve an image directly from storage/app/public.
     * Bypasses the public symlink entirely — reads the file straight
     * from disk and streams it as an HTTP response.
     *
     * Route:  GET /img/{path}   (where {path} is the full relative path)
     * Example: GET /img/products/shirt-abc123.webp
     *          → reads storage/app/public/products/shirt-abc123.webp
     *          → streams it with the correct Content-Type header
     *
     * @param  string  $path  Relative path within storage/app/public
     */
    public function serve(string $path): Response
    {
        // Security: prevent directory traversal (e.g. ../../etc/passwd)
        $path = ltrim($path, '/');
        if (str_contains($path, '..')) {
            abort(403, 'Invalid path.');
        }

        // Only serve from allowed subfolders (products, categories, brands)
        $allowedFolders = ['products', 'categories', 'brands'];
        $folder = explode('/', $path)[0] ?? '';
        if (!in_array($folder, $allowedFolders)) {
            abort(403, 'Access denied.');
        }

        // Check the file actually exists
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Image not found.');
        }

        // Stream the file with the correct MIME type
        $file     = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Cache-Control', 'public, max-age=31536000'); // cache 1 year
    }
}