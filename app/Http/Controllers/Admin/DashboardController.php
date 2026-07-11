<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ---- Stat cards ----
        $totalProducts   = Product::count();
        $activeProducts  = Product::where('is_active', true)->count();
        $totalEnquiries  = Enquiry::count();
        $newEnquiries    = Enquiry::where('status', 'new')->count();

        // ---- This month vs last month (for trend arrows) ----
        $thisMonth       = now()->startOfMonth();
        $lastMonth       = now()->subMonth()->startOfMonth();
        $lastMonthEnd    = now()->subMonth()->endOfMonth();

        $productsThisMonth = Product::where('created_at', '>=', $thisMonth)->count();
        $productsLastMonth = Product::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();

        $enquiriesThisMonth = Enquiry::where('created_at', '>=', $thisMonth)->count();
        $enquiriesLastMonth = Enquiry::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();

        // ---- Recent enquiries (last 8) ----
        $recentEnquiries = Enquiry::with('product')
            ->orderByRaw("FIELD(status, 'new', 'contacted', 'closed')")
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        // ---- Products by category (for the breakdown table) ----
        $categoryStats = Category::withCount([
                'products',
                'products as active_products_count' => fn($q) => $q->where('is_active', true),
            ])
            ->orderByDesc('products_count')
            ->get();

        // ---- Enquiry status breakdown ----
        $enquiryStats = [
            'new'       => Enquiry::where('status', 'new')->count(),
            'contacted' => Enquiry::where('status', 'contacted')->count(),
            'closed'    => Enquiry::where('status', 'closed')->count(),
        ];

        // ---- Total brands and categories ----
        $totalCategories = Category::count();
        $totalBrands     = Brand::count();

        return view('index', compact(
            'user',
            'totalProducts',
            'activeProducts',
            'totalEnquiries',
            'newEnquiries',
            'productsThisMonth',
            'productsLastMonth',
            'enquiriesThisMonth',
            'enquiriesLastMonth',
            'recentEnquiries',
            'categoryStats',
            'enquiryStats',
            'totalCategories',
            'totalBrands'
        ));
    }
}