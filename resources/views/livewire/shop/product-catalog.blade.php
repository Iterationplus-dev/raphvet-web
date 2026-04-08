<div
    x-data="{ sidebarOpen: false }"
    @notify.window="
        const type = $event.detail.type ?? $event.detail[0]?.type;
        const message = $event.detail.message ?? $event.detail[0]?.message;
        if (window.toast) { window.toast(type, message); }
    "
>
    {{-- Hero --}}
    <section class="bg-linear-to-br from-green-700 to-green-500 text-white py-14">
        <div class="container-app text-center">
            <h1 class="text-4xl font-bold mb-3">Pet Shop</h1>
            <p class="text-green-100 max-w-xl mx-auto text-lg">Premium food, accessories, medications, and supplements for every pet. Trusted by veterinarians.</p>
        </div>
    </section>

    {{-- Mobile filter toggle --}}
    <div class="container-app py-4 flex items-center justify-between lg:hidden">
        <p class="text-sm text-gray-500">{{ $products->total() }} products</p>
        <button
            @click="sidebarOpen = true"
            class="btn btn-secondary btn-sm flex items-center gap-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 010 2H4a1 1 0 01-1-1zM6 10h12M9 16h6"/></svg>
            Filters
        </button>
    </div>

    {{-- Mobile sidebar drawer --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>
    <aside
        x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-white shadow-xl overflow-y-auto p-6 lg:hidden"
    >
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-semibold text-gray-900">Filters</h2>
            <button @click="sidebarOpen = false" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @include('livewire.shop.partials.filter-sidebar', ['categories' => $categories])
    </aside>

    {{-- Main layout --}}
    <div class="container-app py-6">
        <div class="flex gap-8">

            {{-- Desktop sidebar --}}
            <aside class="hidden lg:block w-64 shrink-0">
                @include('livewire.shop.partials.filter-sidebar', ['categories' => $categories])
            </aside>

            {{-- Product grid --}}
            <div class="flex-1 min-w-0">

                {{-- Sort bar --}}
                <div class="flex items-center justify-between mb-6 gap-4">
                    <p class="text-sm text-gray-500 hidden sm:block">
                        Showing <span class="font-medium text-gray-900">{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</span> of <span class="font-medium text-gray-900">{{ $products->total() }}</span> products
                    </p>
                    <div class="flex items-center gap-2 ml-auto">
                        <label class="text-sm text-gray-600 whitespace-nowrap">Sort by:</label>
                        <select wire:model.live="sortBy" class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="name">Name</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="newest">Newest</option>
                        </select>
                    </div>
                </div>

                {{-- Search --}}
                <div class="relative mb-6">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        placeholder="Search products..."
                        class="w-full pl-9 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    >
                </div>

                @if($products->isEmpty())
                    {{-- Empty state --}}
                    <div class="text-center py-20">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-green-50 flex items-center justify-center">
                            <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">No products found</h3>
                        <p class="text-gray-500 mb-4">Try adjusting your filters or search terms.</p>
                        <button wire:click="resetFilters" class="btn btn-secondary btn-sm">Clear Filters</button>
                    </div>
                @else
                    {{-- Grid --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                        @foreach($products as $product)
                            @php
                                $typeColors = [
                                    'food' => 'from-amber-400 to-orange-500',
                                    'accessory' => 'from-blue-400 to-blue-600',
                                    'medication' => 'from-red-400 to-red-600',
                                    'supplement' => 'from-purple-400 to-purple-600',
                                    'other' => 'from-gray-400 to-gray-600',
                                ];
                                $gradient = $typeColors[$product->type] ?? 'from-green-400 to-green-600';
                            @endphp
                            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-shadow flex flex-col">
                                {{-- Image --}}
                                <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                    @if($product->primaryImage)
                                        <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full aspect-square object-cover">
                                    @else
                                        <div class="w-full aspect-square bg-linear-to-br {{ $gradient }} flex items-center justify-center">
                                            @if($product->type === 'food')
                                                <svg class="w-14 h-14 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            @elseif($product->type === 'medication')
                                                <svg class="w-14 h-14 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                            @elseif($product->type === 'accessory')
                                                <svg class="w-14 h-14 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            @else
                                                <svg class="w-14 h-14 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                            @endif
                                        </div>
                                    @endif
                                </a>

                                {{-- Info --}}
                                <div class="p-3 flex flex-col flex-1">
                                    @if($product->category)
                                        <span class="badge badge-green text-xs mb-1 self-start">{{ $product->category->name }}</span>
                                    @endif
                                    <a href="{{ route('shop.show', $product->slug) }}" class="font-medium text-gray-900 text-sm leading-tight hover:text-green-700 line-clamp-2 mb-2">{{ $product->name }}</a>

                                    {{-- Price --}}
                                    <div class="flex items-baseline gap-2 mt-auto mb-2">
                                        <span class="font-bold text-green-700">₦{{ number_format((float) $product->price, 2) }}</span>
                                        @if($product->compare_at_price && $product->compare_at_price > $product->price)
                                            <span class="text-xs text-gray-400 line-through">₦{{ number_format((float) $product->compare_at_price, 2) }}</span>
                                        @endif
                                    </div>

                                    {{-- Status badges --}}
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @if($product->isInStock())
                                            <span class="badge badge-green text-xs">In Stock</span>
                                        @else
                                            <span class="badge badge-red text-xs">Out of Stock</span>
                                        @endif
                                        @if($product->requires_prescription)
                                            <span class="badge badge-yellow text-xs">Rx Required</span>
                                        @endif
                                    </div>

                                    <button
                                        wire:click="addToCart({{ $product->id }})"
                                        wire:loading.attr="disabled"
                                        @disabled(!$product->isInStock())
                                        class="btn btn-primary btn-sm w-full"
                                    >
                                        <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to Cart</span>
                                        <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
