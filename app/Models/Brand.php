<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
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
     * Only return active brands, ordered by sort_order.
     * Used by HomeController for the Discover Brands section
     * and by ProductController for the brand filter dropdown.
     *
     * Usage: Brand::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // ---- Helpers ----

    public static function generateSlug(string $name): string
    {
        return Str::slug($name);
    }
}