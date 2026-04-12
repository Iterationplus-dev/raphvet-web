<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\View\View;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public int $quantity = 1;

    public ?int $selectedVariantId = null;

    public int $selectedImageIndex = 0;

    public function mount(string $slug): void
    {
        $this->product = Product::active()
            ->with(['images', 'variants', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function incrementQuantity(): void
    {
        $this->quantity++;
    }

    public function decrementQuantity(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function selectImage(int $index): void
    {
        $this->selectedImageIndex = $index;
    }

    public function addToCart(): void
    {
        $cartService = app(CartService::class);
        $cartService->add($this->product->id, $this->quantity, $this->selectedVariantId);

        $this->dispatch('notify', type: 'success', message: 'Added to cart!');
    }

    public function render(): View
    {
        $relatedProducts = Product::active()
            ->with(['primaryImage', 'category'])
            ->where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->limit(4)
            ->get();

        $title = $this->product->meta_title ?: $this->product->name;
        $description = $this->product->meta_description
            ?: ($this->product->short_description ?: 'Buy '.$this->product->name.' at Raph Veterinary Services. Premium veterinary product delivered across Nigeria.');
        $ogImage = $this->product->primaryImage?->url ?? asset('images/og-image.jpg');

        return view('livewire.shop.product-detail', compact('relatedProducts'))
            ->layout('components.layouts.app', [
                'title' => $title,
                'description' => $description,
                'ogImage' => $ogImage,
                'ogType' => 'product',
            ]);
    }
}
