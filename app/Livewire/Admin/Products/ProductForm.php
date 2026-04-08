<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class ProductForm extends Component
{
    public string $name = '';

    public string $sku = '';

    public string $slug = '';

    public string $categoryId = '';

    public string $type = 'food';

    public string $price = '';

    public string $compareAtPrice = '';

    public int $stockQuantity = 0;

    public string $description = '';

    public string $shortDescription = '';

    public bool $requiresPrescription = false;

    public bool $isActive = true;

    public bool $isFeatured = false;

    public string $metaTitle = '';

    public string $metaDescription = '';

    public ?int $productId = null;

    public string $activeTab = 'basic';

    public function mount(?Product $product = null): void
    {
        if ($product && $product->exists) {
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->sku = $product->sku ?? '';
            $this->slug = $product->slug;
            $this->categoryId = (string) ($product->category_id ?? '');
            $this->type = $product->type ?? 'food';
            $this->price = (string) $product->price;
            $this->compareAtPrice = $product->compare_at_price ? (string) $product->compare_at_price : '';
            $this->stockQuantity = $product->stock_quantity;
            $this->description = $product->description ?? '';
            $this->shortDescription = $product->short_description ?? '';
            $this->requiresPrescription = $product->requires_prescription;
            $this->isActive = $product->is_active;
            $this->isFeatured = $product->is_featured;
            $this->metaTitle = $product->meta_title ?? '';
            $this->metaDescription = $product->meta_description ?? '';
        }
    }

    public function updatedName(): void
    {
        if (! $this->productId) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:200',
            'sku' => 'nullable|string|max:100|unique:products,sku'.($this->productId ? ",{$this->productId}" : ''),
            'slug' => 'required|string|max:200|unique:products,slug'.($this->productId ? ",{$this->productId}" : ''),
            'categoryId' => 'nullable|exists:product_categories,id',
            'type' => 'required|in:food,medicine,accessory,supplement,grooming,other',
            'price' => 'required|numeric|min:0',
            'compareAtPrice' => 'nullable|numeric|min:0',
            'stockQuantity' => 'integer|min:0',
            'description' => 'nullable|string',
            'shortDescription' => 'nullable|string|max:500',
            'requiresPrescription' => 'boolean',
            'isActive' => 'boolean',
            'isFeatured' => 'boolean',
            'metaTitle' => 'nullable|string|max:160',
            'metaDescription' => 'nullable|string|max:320',
        ]);

        $data = [
            'name' => $this->name,
            'sku' => $this->sku ?: null,
            'slug' => $this->slug,
            'category_id' => $this->categoryId ?: null,
            'type' => $this->type,
            'price' => $this->price,
            'compare_at_price' => $this->compareAtPrice ?: null,
            'stock_quantity' => $this->stockQuantity,
            'description' => $this->description,
            'short_description' => $this->shortDescription,
            'requires_prescription' => $this->requiresPrescription,
            'is_active' => $this->isActive,
            'is_featured' => $this->isFeatured,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
        ];

        if ($this->productId) {
            Product::findOrFail($this->productId)->update($data);
        } else {
            Product::create($data);
        }

        session()->flash('success', 'Product saved successfully.');
        $this->redirect(route('admin.products'), navigate: true);
    }

    public function render(): View
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('livewire.admin.products.product-form', compact('categories'));
    }
}
