<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'details',
        'sku',
        'price',
        'main_image',
        'sub_images',
        'is_featured',
        'is_trending',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        // details cast to array — stores/retrieves as JSON automatically
        // matches product.blade.php: @foreach ($product->details as $line)
        'details'    => 'array',

        // sub_images cast to array — stores/retrieves as JSON automatically
        // e.g. ["products/shirt-2.jpg", "products/shirt-3.jpg"]
        // matches product.blade.php: @foreach ($images as $i => $img)
        'sub_images' => 'array',

        'price'      => 'decimal:2',
        'is_featured'=> 'boolean',
        'is_trending'=> 'boolean',
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // ---- Relationships ----

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(Enquiry::class);
    }

    // ---- Scopes ----

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeTrending($query)
    {
        return $query->where('is_trending', true)->where('is_active', true);
    }

    public function scopeInCategory($query, string $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    public function scopeByBrand($query, string $brandSlug)
    {
        return $query->whereHas('brand', function ($q) use ($brandSlug) {
            $q->where('slug', $brandSlug);
        });
    }

    // ---- Accessors ----

    /**
     * Returns all gallery images as a flat array of paths —
     * main_image first, followed by sub_images.
     *
     * Used in product.blade.php:
     *   $images = $product->all_images;
     *   @foreach ($images as $i => $img) ... $img (plain string path)
     *
     * Since $img is now always a plain string, the is_string() check
     * in product.blade.php will always hit the right branch.
     */
    public function getAllImagesAttribute(): array
    {
        $images = [];

        if ($this->main_image) {
            $images[] = asset('storage/' . $this->main_image);
        }

        foreach ($this->sub_images ?? [] as $path) {
            $images[] = asset('storage/' . $path);
        }

        return $images;
    }

    /**
     * Main image as a full URL — used in the product grid card.
     * Usage: $product->main_image_url
     */
    public function getMainImageUrlAttribute(): ?string
    {
        return $this->main_image
            ? asset('storage/' . $this->main_image)
            : null;
    }

    /**
     * Formatted price — returns "Contact for price" when price is null.
     * Usage: $product->formatted_price
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->price
            ? 'LKR' . number_format($this->price, 2)
            : 'Contact for price';
    }

    // ---- Helpers ----

    public static function generateSlug(string $name): string
    {
        return Str::slug($name);
    }
}