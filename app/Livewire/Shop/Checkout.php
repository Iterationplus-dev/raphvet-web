<?php

namespace App\Livewire\Shop;

use App\Models\Coupon;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.customer')]
class Checkout extends Component
{
    protected CartService $cartService;

    protected OrderService $orderService;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $city = '';

    public string $state = '';

    public string $country = 'Nigeria';

    public string $postalCode = '';

    public string $couponCode = '';

    public string $notes = '';

    public ?Coupon $coupon = null;

    public float $discount = 0;

    public function boot(CartService $cartService, OrderService $orderService): void
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function mount(): void
    {
        if ($this->cartService->getItemCount() === 0) {
            $this->redirectRoute('cart');

            return;
        }

        $user = auth()->user();
        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $user->phone ?? '';
    }

    public function applyCoupon(): void
    {
        $coupon = Coupon::where('code', strtoupper(trim($this->couponCode)))->first();

        if (! $coupon || ! $coupon->isValid()) {
            $this->addError('couponCode', 'Invalid or expired coupon code.');
            $this->coupon = null;
            $this->discount = 0;

            return;
        }

        $subtotal = $this->cartService->getTotal();
        $this->discount = $coupon->calculateDiscount($subtotal);

        if ($this->discount <= 0) {
            $this->addError('couponCode', 'This coupon does not meet the minimum order amount.');
            $this->coupon = null;
            $this->discount = 0;

            return;
        }

        $this->coupon = $coupon;
        $this->resetErrorBag('couponCode');
    }

    public function placeOrder(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
            'postalCode' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $cart = $this->cartService->getCart();

        if ($cart->items()->count() === 0) {
            $this->redirectRoute('cart');

            return;
        }

        $shippingData = [
            'shipping_name' => $this->name,
            'shipping_phone' => $this->phone,
            'shipping_address' => $this->address,
            'shipping_city' => $this->city,
            'shipping_state' => $this->state,
            'shipping_country' => $this->country,
            'shipping_postal_code' => $this->postalCode,
            'notes' => $this->notes,
        ];

        $order = $this->orderService->createFromCart($cart, $shippingData, $this->coupon);

        $this->redirectRoute('my.orders', navigate: true);
    }

    public function render(): View
    {
        $items = $this->cartService->getCart()->items()->with(['product', 'variant'])->get();
        $subtotal = $this->cartService->getTotal();
        $total = max(0, $subtotal - $this->discount);

        return view('livewire.shop.checkout', compact('items', 'subtotal', 'total'));
    }
}
