<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // ---- Relationships ----

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // ---- Scopes ----

    /**
     * Only return active categories, ordered by sort_order.
     * Used by HomeController to build the category circles row.
     *
     * Usage: Category::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // ---- Accessors / helpers ----

    /**
     * Auto-generate a slug from the name if one isn't provided.
     * Called in the admin controller before save:
     *   $category->slug = $category->slug ?: Str::slug($category->name);
     */
    public static function generateSlug(string $name): string
    {
        return Str::slug($name);
    }
}