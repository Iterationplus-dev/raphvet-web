<?php

namespace App\Livewire\Admin\Products;

use App\Models\ProductCategory;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class CategoryList extends Component
{
    public function render(): View
    {
        $categories = ProductCategory::withCount('products')
            ->with('children')
            ->whereNull('parent_id')
            ->get();

        return view('livewire.admin.products.category-list', compact('categories'));
    }
}
