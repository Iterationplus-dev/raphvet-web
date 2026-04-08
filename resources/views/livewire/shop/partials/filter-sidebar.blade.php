<div class="space-y-6">
    {{-- Categories --}}
    <div>
        <h3 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wide">Categories</h3>
        <div class="space-y-1">
            <button
                wire:click="$set('categoryFilter', '')"
                class="w-full text-left px-3 py-2 rounded-lg text-sm transition-colors {{ $categoryFilter === '' ? 'bg-green-100 text-green-800 font-medium' : 'text-gray-600 hover:bg-gray-100' }}"
            >
                All Categories
            </button>
            @foreach($categories as $category)
                <button
                    wire:click="$set('categoryFilter', '{{ $category->id }}')"
                    class="w-full text-left px-3 py-2 rounded-lg text-sm transition-colors {{ $categoryFilter == $category->id ? 'bg-green-100 text-green-800 font-medium' : 'text-gray-600 hover:bg-gray-100' }}"
                >
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- Product Type --}}
    <div>
        <h3 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wide">Product Type</h3>
        <div class="space-y-1">
            @foreach(['all' => 'All Types', 'food' => 'Food', 'accessory' => 'Accessories', 'medication' => 'Medication', 'supplement' => 'Supplements', 'other' => 'Other'] as $value => $label)
                <button
                    wire:click="$set('typeFilter', '{{ $value === 'all' ? '' : $value }}')"
                    class="w-full text-left px-3 py-2 rounded-lg text-sm transition-colors {{ ($value === 'all' && $typeFilter === '') || $typeFilter === $value ? 'bg-green-100 text-green-800 font-medium' : 'text-gray-600 hover:bg-gray-100' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- Price Range --}}
    <div>
        <h3 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wide">Price Range (₦)</h3>
        <div class="flex items-center gap-2">
            <input
                wire:model.live.debounce.500ms="priceMin"
                type="number"
                min="0"
                placeholder="Min"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
            >
            <span class="text-gray-400 shrink-0">–</span>
            <input
                wire:model.live.debounce.500ms="priceMax"
                type="number"
                min="0"
                placeholder="Max"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
            >
        </div>
    </div>

    {{-- Clear Filters --}}
    <button wire:click="resetFilters" class="text-sm text-green-700 hover:text-green-900 font-medium flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        Clear All Filters
    </button>
</div>
