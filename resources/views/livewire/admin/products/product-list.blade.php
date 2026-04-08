<div class="space-y-4">

    {{-- Top bar --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 flex-wrap gap-3">
            <div class="relative min-w-48 flex-1">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.300ms="search" placeholder="Search name or SKU…" class="w-full rounded-lg border border-gray-300 py-2 pl-9 pr-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
            </div>
            <select wire:model.live="categoryFilter" class="rounded-lg border border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <select wire:model.live="typeFilter" class="rounded-lg border border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                <option value="">All Types</option>
                <option value="food">Food</option>
                <option value="medicine">Medicine</option>
                <option value="accessory">Accessory</option>
                <option value="supplement">Supplement</option>
                <option value="grooming">Grooming</option>
                <option value="other">Other</option>
            </select>
        </div>
        <a href="{{ route('admin.products.create') }}" wire:navigate class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Product
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-5 py-3 text-left">Product</th>
                        <th class="px-5 py-3 text-left">Category</th>
                        <th class="px-5 py-3 text-left">Type</th>
                        <th class="px-5 py-3 text-left">Price</th>
                        <th class="px-5 py-3 text-left">Stock</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        @php
                            $typeColors = [
                                'food'       => 'bg-amber-100 text-amber-700',
                                'medicine'   => 'bg-red-100 text-red-700',
                                'accessory'  => 'bg-blue-100 text-blue-700',
                                'supplement' => 'bg-green-100 text-green-700',
                                'grooming'   => 'bg-pink-100 text-pink-700',
                                'other'      => 'bg-gray-100 text-gray-700',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                        @if($product->primaryImage)
                                            <img src="{{ $product->primaryImage->url }}" alt="{{ $product->name }}" class="h-full w-full object-cover"/>
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-gray-300">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
                                        @if($product->sku)
                                            <p class="text-xs text-gray-400">SKU: {{ $product->sku }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $typeColors[$product->type] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($product->type) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-900">&#8358;{{ number_format($product->price, 0) }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-sm text-gray-700">{{ $product->stock_quantity }}</span>
                                    @if($product->isLowStock())
                                        <span class="rounded-full bg-amber-100 px-1.5 py-0.5 text-xs font-medium text-amber-700">Low</span>
                                    @elseif($product->stock_quantity === 0)
                                        <span class="rounded-full bg-red-100 px-1.5 py-0.5 text-xs font-medium text-red-700">Out</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <button wire:click="toggleActive({{ $product->id }})" class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium transition-colors {{ $product->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $product->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.products.edit', $product) }}" wire:navigate class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-sm text-gray-400">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="border-t border-gray-100 px-5 py-3">{{ $products->links() }}</div>
        @endif
    </div>
</div>
