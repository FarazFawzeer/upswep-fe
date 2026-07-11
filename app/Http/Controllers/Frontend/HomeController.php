<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // ---- Category circles ----
        // All active categories ordered by sort_order.
        // Matches the 8 circle items on the homepage.
        $categories = Category::active()->get();

        // ---- Trending Now (3-up grid) ----
        // Products flagged is_trending = 1, newest first, limit 3.
        $trending = Product::trending()
            ->with('category')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        // ---- Styled For You (6-up grid) ----
        // 6 active products NOT already shown in Trending or Featured,
        // with a main image, ordered by sort_order.
        $excludeIds = $trending->pluck('id')
            ->merge(Product::featured()->pluck('id'))
            ->unique();

        $styled = Product::active()
            ->whereNotIn('id', $excludeIds)
            ->whereNotNull('main_image')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        // ---- Featured (3-up with descriptions) ----
        // Products flagged is_featured = 1, limit 3.
        $featured = Product::featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('frontend.index', compact(
            'categories',
            'trending',
            'styled',
            'featured'
        ));
    }
}