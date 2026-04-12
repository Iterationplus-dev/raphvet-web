<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\CartService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    public string $categoryFilter = '';

    public string $typeFilter = '';

    public string $sortBy = 'name';

    public string $priceMin = '';

    public string $priceMax = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function updatingPriceMin(): void
    {
        $this->resetPage();
    }

    public function updatingPriceMax(): void
    {
        $this->resetPage();
    }

    public function addToCart(int $productId): void
    {
        $cartService = app(CartService::class);
        $cartService->add($productId);

        $this->dispatch('notify', type: 'success', message: 'Added to cart!');
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->categoryFilter = '';
        $this->typeFilter = '';
        $this->priceMin = '';
        $this->priceMax = '';
        $this->sortBy = 'name';
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Product::active()->with(['category', 'primaryImage']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('short_description', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        if ($this->typeFilter) {
            $query->where('type', $this->typeFilter);
        }

        if ($this->priceMin !== '') {
            $query->where('price', '>=', (float) $this->priceMin);
        }

        if ($this->priceMax !== '') {
            $query->where('price', '<=', (float) $this->priceMax);
        }

        $query->orderBy(match ($this->sortBy) {
            'price_asc' => 'price',
            'price_desc' => 'price',
            'newest' => 'created_at',
            default => 'name',
        }, match ($this->sortBy) {
            'price_desc' => 'desc',
            'newest' => 'desc',
            default => 'asc',
        });

        $products = $query->paginate(16);
        $categories = ProductCategory::active()->orderBy('sort_order')->get();

        return view('livewire.shop.product-catalog', compact('products', 'categories'))
            ->layout('components.layouts.app', [
                'title' => 'Pet & Veterinary Products',
                'description' => 'Shop premium pet food, medications, accessories, and veterinary supplies at Raph Veterinary Services. Fast delivery across Nigeria.',
            ]);
    }
}
