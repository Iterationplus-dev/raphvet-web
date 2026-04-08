<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory, SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'compare_at_price',
        'cost_price',
        'stock_quantity',
        'low_stock_threshold',
        'track_stock',
        'weight_kg',
        'type',
        'requires_prescription',
        'is_active',
        'is_featured',
        'meta_title',
        'meta_description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'compare_at_price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'weight_kg' => 'decimal:3',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'requires_prescription' => 'boolean',
            'track_stock' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_active', true);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isInStock(): bool
    {
        if (! $this->track_stock) {
            return true;
        }

        return $this->stock_quantity > 0;
    }

    public function isLowStock(): bool
    {
        if (! $this->track_stock) {
            return false;
        }

        return $this->stock_quantity <= $this->low_stock_threshold && $this->stock_quantity > 0;
    }

    public function getPriceDisplayAttribute(): string
    {
        return '₦'.number_format((float) $this->price, 2);
    }
}
