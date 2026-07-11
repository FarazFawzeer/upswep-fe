<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $categories = Category::orderBy('sort_order')->orderByDesc('created_at')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Stores original file + WebP copy, returns "categories/filename.jpg" for DB
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->imageService->store($request->file('image'), 'categories');
        }

        Category::create([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'image'      => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return response()->json(['success' => true, 'message' => 'Category created successfully.']);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            // Deletes old original + old WebP, stores new original + new WebP
            $imagePath = $this->imageService->replace(
                $request->file('image'), 'categories', $category->image
            );
        }

        $category->update([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'image'      => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active'),
        ]);

        return response()->json(['success' => true, 'message' => 'Category updated successfully.']);
    }

    public function destroy(Category $category)
    {
        // Deletes both original and WebP copy from storage
        $this->imageService->delete($category->image);
        $category->delete();

        return response()->json(['success' => true, 'message' => 'Category deleted.']);
    }
}