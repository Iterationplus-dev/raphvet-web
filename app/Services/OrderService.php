<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createFromCart(Cart $cart, array $shippingData, ?Coupon $coupon = null): Order
    {
        return DB::transaction(function () use ($cart, $shippingData, $coupon) {
            $items = $cart->items()->with('product', 'variant')->get();

            $subtotal = $items->sum(fn ($item) => $item->unit_price * $item->quantity);
            $discountAmount = $coupon ? $coupon->calculateDiscount((float) $subtotal) : 0;
            $total = max(0, $subtotal - $discountAmount);

            $order = Order::create([
                'reference_number' => Order::generateReference(),
                'customer_id' => auth()->id(),
                'coupon_id' => $coupon?->id,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'shipping_amount' => 0,
                'tax_amount' => 0,
                'total_amount' => $total,
                ...$shippingData,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'product_name' => $item->product->name,
                    'product_sku' => $item->product->sku,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->unit_price * $item->quantity,
                ]);

                if ($item->product->track_stock) {
                    $item->product->decrement('stock_quantity', $item->quantity);
                }
            }

            if ($coupon) {
                $coupon->increment('used_count');
            }

            $cart->items()->delete();

            return $order;
        });
    }
}
