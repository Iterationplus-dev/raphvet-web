<?php

namespace App\Livewire\Shop;

use App\Services\CartService;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class CartPage extends Component
{
    protected CartService $cartService;

    public function boot(CartService $cartService): void
    {
        $this->cartService = $cartService;
    }

    public function updateQuantity(int $itemId, int $qty): void
    {
        $this->cartService->update($itemId, $qty);
    }

    public function removeItem(int $itemId): void
    {
        $this->cartService->remove($itemId);
    }

    public function render(): View
    {
        $items = $this->cartService->getCart()->items()->with(['product', 'variant'])->get();
        $total = $this->cartService->getTotal();
        $itemCount = $this->cartService->getItemCount();

        return view('livewire.shop.cart-page', compact('items', 'total', 'itemCount'));
    }
}
