<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductFEController extends Controller
{

    
    // ================================================================
    // PRODUCT LISTING PAGE — grid.blade.php
    // GET /products?q=shirt&category=shirts&sort=newest
    // ================================================================
    public function index(Request $request)
    {
        $query = Product::active()
            ->with(['category', 'brand'])
            ->whereNotNull('main_image');
 
        // ---- Search ----
        // Triggered by the header search box: ?q=shirt
        // Searches product name and description
        if ($request->filled('q')) {
            $search = '%' . $request->q . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('description', 'like', $search);
            });
        }
 
        // ---- Category filter ----
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) =>
                $q->where('slug', $request->category)
            );
        }
 
        // ---- Brand filter ----
        if ($request->filled('brand')) {
            $query->whereHas('brand', fn($q) =>
                $q->where('slug', $request->brand)
            );
        }
 
        // ---- Sort ----
        match ($request->sort) {
            'price-low'  => $query->orderBy('price'),
            'price-high' => $query->orderByDesc('price'),
            'name-az'    => $query->orderBy('name'),
            default      => $query->orderByDesc('created_at'),
        };
 
        $products = $query->paginate(12)->withQueryString();
 
        $categories = Category::active()
            ->whereHas('products', fn($q) => $q->where('is_active', true))
            ->orderBy('sort_order')
            ->get();
 
        $brands = Brand::active()
            ->whereHas('products', fn($q) => $q->where('is_active', true))
            ->orderBy('sort_order')
            ->get();
 
        $activeCategory = $categories->firstWhere('slug', $request->category);
        $activeBrand    = $brands->firstWhere('slug', $request->brand);
 
        return view('frontend.grid', compact(
            'products', 'categories', 'brands', 'activeCategory', 'activeBrand'
        ));
    }
 
    // ================================================================
    // SINGLE PRODUCT PAGE — product.blade.php
    // GET /product/{slug}
    // ================================================================
    public function show(string $slug)
    {
        // Find product by slug — 404 if not found or inactive
        $product = Product::active()
            ->with(['category', 'brand'])
            ->where('slug', $slug)
            ->firstOrFail();
 
        // ---- Build image array ----
        // main_image first, then sub_images (all as full URLs via img_url())
        // img_url() checks WebP first, falls back to original — no symlink needed
        $images = [];
 
        if ($product->main_image) {
            $images[] = img_url($product->main_image);
        }
 
        foreach ($product->sub_images ?? [] as $sub) {
            $images[] = img_url($sub);
        }
 
        $primaryImage = $images[0] ?? null;
 
        return view('frontend.product', compact('product', 'images', 'primaryImage'));
    }
}
