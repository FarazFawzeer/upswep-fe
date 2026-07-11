<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $products = Product::with(['category', 'brand'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        $brands     = Brand::active()->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'brand_id'     => 'nullable|exists:brands,id',
            'description'  => 'nullable|string',
            'details'      => 'nullable|string',
            'sku'          => 'nullable|string|max:100|unique:products,sku',
            'price'        => 'nullable|numeric|min:0',
            'main_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'sub_images'   => 'nullable|array|max:6',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'is_featured'  => 'boolean',
            'is_trending'  => 'boolean',
            'is_active'    => 'boolean',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        // ---- Main image ----
        // Stores original + WebP, returns "products/filename.jpg" for DB
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImagePath = $this->imageService->store($request->file('main_image'), 'products');
        }

        // ---- Sub images ----
        // Each file: store original + WebP, collect paths into array
        // Array is JSON-encoded by the 'sub_images' => 'array' cast in the model
        $subImagePaths = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $file) {
                $subImagePaths[] = $this->imageService->store($file, 'products');
            }
        }

        // ---- Details: textarea lines → array ----
        $details = null;
        if ($request->filled('details')) {
            $details = array_values(array_filter(
                array_map('trim', explode("\n", $request->details))
            ));
        }

        Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id ?: null,
            'description' => $request->description,
            'details'     => $details,
            'sku'         => $request->sku ?: null,
            'price'       => $request->price ?: null,
            'main_image'  => $mainImagePath,
            'sub_images'  => $subImagePaths ?: null,
            'is_featured' => $request->boolean('is_featured'),
            'is_trending' => $request->boolean('is_trending'),
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return response()->json(['success' => true, 'message' => 'Product created successfully.']);
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $brands     = Brand::active()->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'brand_id'     => 'nullable|exists:brands,id',
            'description'  => 'nullable|string',
            'details'      => 'nullable|string',
            'sku'          => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'price'        => 'nullable|numeric|min:0',
            'main_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'sub_images'   => 'nullable|array|max:6',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'is_featured'  => 'boolean',
            'is_trending'  => 'boolean',
            'is_active'    => 'boolean',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        // ---- Main image ----
        // Replace only if a new file is uploaded:
        // → deletes old original + old WebP, stores new original + new WebP
        $mainImagePath = $product->main_image;
        if ($request->hasFile('main_image')) {
            $mainImagePath = $this->imageService->replace(
                $request->file('main_image'), 'products', $product->main_image
            );
        }

        // ---- Sub images ----
        // Replace entire set only if new files are uploaded.
        // Existing sub images are kept untouched if no new files are sent.
        $subImagePaths = $product->sub_images ?? [];
        if ($request->hasFile('sub_images')) {
            // Delete all old originals and WebP copies
            foreach ($subImagePaths as $old) {
                $this->imageService->delete($old);
            }
            // Store new set
            $subImagePaths = [];
            foreach ($request->file('sub_images') as $file) {
                $subImagePaths[] = $this->imageService->store($file, 'products');
            }
        }

        // ---- Details ----
        $details = $product->details;
        if ($request->filled('details')) {
            $details = array_values(array_filter(
                array_map('trim', explode("\n", $request->details))
            ));
        }

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id ?: null,
            'description' => $request->description,
            'details'     => $details,
            'sku'         => $request->sku ?: null,
            'price'       => $request->price ?: null,
            'main_image'  => $mainImagePath,
            'sub_images'  => $subImagePaths ?: null,
            'is_featured' => $request->boolean('is_featured'),
            'is_trending' => $request->boolean('is_trending'),
            'is_active'   => $request->boolean('is_active'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return response()->json(['success' => true, 'message' => 'Product updated successfully.']);
    }

    public function destroy(Product $product)
    {
        // Delete main image: original + WebP
        $this->imageService->delete($product->main_image);

        // Delete each sub image: original + WebP
        foreach ($product->sub_images ?? [] as $path) {
            $this->imageService->delete($path);
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product deleted.']);
    }
}