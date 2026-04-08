<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;

class CartService
{
    public function getCart(): Cart
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }

        $sessionId = session()->getId();

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function add(int $productId, int $quantity = 1, ?int $variantId = null): CartItem
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        $unitPrice = $product->price;
        if ($variantId) {
            $variant = ProductVariant::findOrFail($variantId);
            $unitPrice = $product->price + $variant->price_modifier;
        }

        $existing = $cart->items()
            ->where('product_id', $productId)
            ->where('variant_id', $variantId)
            ->first();

        if ($existing) {
            $existing->increment('quantity', $quantity);

            return $existing->fresh();
        }

        return $cart->items()->create([
            'product_id' => $productId,
            'variant_id' => $variantId,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
        ]);
    }

    public function remove(int $cartItemId): void
    {
        CartItem::where('id', $cartItemId)
            ->where('cart_id', $this->getCart()->id)
            ->delete();
    }

    public function update(int $cartItemId, int $quantity): CartItem
    {
        $item = CartItem::where('id', $cartItemId)
            ->where('cart_id', $this->getCart()->id)
            ->firstOrFail();

        if ($quantity <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => $quantity]);
        }

        return $item->fresh() ?? $item;
    }

    public function clear(): void
    {
        $this->getCart()->items()->delete();
    }

    public function getTotal(): float
    {
        return (float) $this->getCart()
            ->items()
            ->selectRaw('SUM(unit_price * quantity) as total')
            ->value('total') ?? 0.0;
    }

    public function getItemCount(): int
    {
        return (int) $this->getCart()
            ->items()
            ->sum('quantity');
    }

    public function mergeGuestCart(string $sessionId, int $userId): void
    {
        $guestCart = Cart::where('session_id', $sessionId)->first();
        if (! $guestCart) {
            return;
        }

        $userCart = Cart::firstOrCreate(['user_id' => $userId]);

        foreach ($guestCart->items as $item) {
            $existing = $userCart->items()
                ->where('product_id', $item->product_id)
                ->where('variant_id', $item->variant_id)
                ->first();

            if ($existing) {
                $existing->increment('quantity', $item->quantity);
            } else {
                $userCart->items()->create($item->only(['product_id', 'variant_id', 'quantity', 'unit_price']));
            }
        }

        $guestCart->items()->delete();
        $guestCart->delete();
    }
}
