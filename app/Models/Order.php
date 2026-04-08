<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory, SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'reference_number',
        'customer_id',
        'coupon_id',
        'status',
        'payment_status',
        'payment_method',
        'payment_reference',
        'subtotal',
        'discount_amount',
        'shipping_amount',
        'tax_amount',
        'total_amount',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_country',
        'shipping_postal_code',
        'notes',
        'shipped_at',
        'delivered_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'shipping_amount' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getRouteKeyName(): string
    {
        return 'reference_number';
    }

    public static function generateReference(): string
    {
        return 'ORD-'.strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isCancellable(): bool
    {
        return $this->status === 'pending';
    }
}
