<div>
    <div class="container-app py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if($items->isEmpty())
            {{-- Empty state --}}
            <div class="text-center py-20">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-green-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Looks like you haven't added anything yet. Explore our pet shop to find what your animals need.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Cart items --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">Product</th>
                                    <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-4 hidden sm:table-cell">Unit Price</th>
                                    <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-4">Qty</th>
                                    <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">Subtotal</th>
                                    <th class="px-4 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($items as $item)
                                    <tr wire:key="cart-item-{{ $item->id }}">
                                        {{-- Product --}}
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-16 rounded-lg bg-green-50 flex items-center justify-center shrink-0 overflow-hidden">
                                                    @if($item->product->primaryImage)
                                                        <img src="{{ asset('storage/'.$item->product->primaryImage->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('shop.show', $item->product->slug) }}" class="font-medium text-gray-900 hover:text-green-700 text-sm">{{ $item->product->name }}</a>
                                                    @if($item->variant)
                                                        <p class="text-xs text-gray-500 mt-0.5">{{ $item->variant->name }}</p>
                                                    @endif
                                                    <p class="text-xs text-green-700 font-semibold mt-1 sm:hidden">₦{{ number_format((float) $item->unit_price, 2) }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Unit price --}}
                                        <td class="px-4 py-4 text-center text-sm text-gray-700 hidden sm:table-cell">
                                            ₦{{ number_format((float) $item->unit_price, 2) }}
                                        </td>

                                        {{-- Quantity --}}
                                        <td class="px-4 py-4">
                                            <div class="flex items-center justify-center">
                                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                                    <button
                                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                                        class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors"
                                                    >
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                                    </button>
                                                    <span class="w-8 text-center text-sm font-medium text-gray-900">{{ $item->quantity }}</span>
                                                    <button
                                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                        class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors"
                                                    >
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Subtotal --}}
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-semibold text-gray-900 text-sm">₦{{ number_format((float) $item->unit_price * $item->quantity, 2) }}</span>
                                        </td>

                                        {{-- Remove --}}
                                        <td class="px-4 py-4">
                                            <button
                                                wire:click="removeItem({{ $item->id }})"
                                                wire:confirm="Remove this item from your cart?"
                                                class="text-gray-400 hover:text-red-500 transition-colors"
                                                title="Remove item"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <a href="{{ route('shop') }}" class="btn btn-secondary btn-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                {{-- Order summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-gray-900 mb-5">Order Summary</h2>

                        <div class="space-y-3 mb-5">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal ({{ $itemCount }} {{ Str::plural('item', $itemCount) }})</span>
                                <span class="font-medium text-gray-900">₦{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium text-green-700">Free</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3 flex justify-between">
                                <span class="font-semibold text-gray-900">Total</span>
                                <span class="font-bold text-xl text-green-700">₦{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        @auth
                            <a href="{{ route('my.checkout') }}" class="btn btn-primary w-full btn-lg text-center block">
                                Proceed to Checkout
                            </a>
                        @else
                            <a href="{{ route('login') }}?redirect={{ urlencode(route('my.checkout')) }}" class="btn btn-primary w-full btn-lg text-center block">
                                Login to Checkout
                            </a>
                            <p class="text-xs text-gray-500 text-center mt-2">You need to be logged in to place an order.</p>
                        @endauth
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
