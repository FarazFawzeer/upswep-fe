<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $brands = Brand::orderBy('sort_order')->orderByDesc('created_at')->paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $this->imageService->store($request->file('logo'), 'brands');
        }

        Brand::create([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'logo'       => $logoPath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return response()->json(['success' => true, 'message' => 'Brand created successfully.']);
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $logoPath = $brand->logo;
        if ($request->hasFile('logo')) {
            $logoPath = $this->imageService->replace(
                $request->file('logo'), 'brands', $brand->logo
            );
        }

        $brand->update([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'logo'       => $logoPath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active'),
        ]);

        return response()->json(['success' => true, 'message' => 'Brand updated successfully.']);
    }

    public function destroy(Brand $brand)
    {
        $this->imageService->delete($brand->logo);
        $brand->delete();

        return response()->json(['success' => true, 'message' => 'Brand deleted.']);
    }
}