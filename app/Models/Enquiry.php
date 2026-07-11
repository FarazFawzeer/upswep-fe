<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'phone',
        'email',
        'message',
        'subject',
        'status',
    ];

    protected $casts = [
        'product_id' => 'integer',
    ];

    // ---- Relationships ----

    /**
     * The product this enquiry is about.
     * Null for contact form submissions (subject-based enquiries).
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // ---- Scopes ----

    /**
     * Only unresolved enquiries — used for the admin panel
     * dashboard badge count showing new/pending items.
     *
     * Usage: Enquiry::pending()->count()
     */
    public function scopePending($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Only product enquiries (have a product_id).
     * Usage: Enquiry::forProducts()->get()
     */
    public function scopeForProducts($query)
    {
        return $query->whereNotNull('product_id');
    }

    /**
     * Only contact form submissions (no product_id).
     * Usage: Enquiry::fromContact()->get()
     */
    public function scopeFromContact($query)
    {
        return $query->whereNull('product_id');
    }

    // ---- Helpers ----

    /**
     * Human-readable status labels for the admin panel table.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'new'       => 'New',
            'contacted' => 'Contacted',
            'closed'    => 'Closed',
            default     => ucfirst($this->status),
        };
    }

    /**
     * Badge colour class for the admin panel status pill.
     * Works with your existing badge-soft-{color} Bootstrap pattern.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'new'       => 'danger',
            'contacted' => 'warning',
            'closed'    => 'success',
            default     => 'secondary',
        };
    }
}