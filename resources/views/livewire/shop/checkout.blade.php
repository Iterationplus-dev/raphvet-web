<div>
    <div class="py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Left: shipping form + coupon --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Shipping information --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-5">Shipping Information</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                            <input
                                wire:model="name"
                                type="text"
                                class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('name') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                                placeholder="Your full name"
                            >
                            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input
                                wire:model="email"
                                type="email"
                                class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('email') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                                placeholder="your@email.com"
                            >
                            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                            <input
                                wire:model="phone"
                                type="tel"
                                class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('phone') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                                placeholder="+234..."
                            >
                            @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Street Address <span class="text-red-500">*</span></label>
                            <input
                                wire:model="address"
                                type="text"
                                class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('address') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                                placeholder="House number, street name"
                            >
                            @error('address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                            <input
                                wire:model="city"
                                type="text"
                                class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('city') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                                placeholder="City"
                            >
                            @error('city') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">State <span class="text-red-500">*</span></label>
                            <input
                                wire:model="state"
                                type="text"
                                class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('state') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                                placeholder="State"
                            >
                            @error('state') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Country <span class="text-red-500">*</span></label>
                            <input
                                wire:model="country"
                                type="text"
                                class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('country') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                            >
                            @error('country') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                            <input
                                wire:model="postalCode"
                                type="text"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Optional"
                            >
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Order Notes</label>
                            <textarea
                                wire:model="notes"
                                rows="3"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 resize-none"
                                placeholder="Special instructions for your order (optional)"
                            ></textarea>
                        </div>
                    </div>
                </div>

                {{-- Coupon --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Coupon Code</h2>

                    @if($coupon)
                        <div class="alert alert-success">
                            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            <span>Coupon <strong>{{ $coupon->code }}</strong> applied — you save ₦{{ number_format($discount, 2) }}!</span>
                            <button wire:click="$set('coupon', null); $set('discount', 0); $set('couponCode', '')" class="ml-auto text-green-800 hover:text-green-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    @else
                        <div class="flex gap-3">
                            <input
                                wire:model="couponCode"
                                type="text"
                                placeholder="Enter coupon code"
                                class="flex-1 rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 uppercase {{ $errors->has('couponCode') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                            >
                            <button wire:click="applyCoupon" wire:loading.attr="disabled" class="btn btn-secondary">
                                <span wire:loading.remove wire:target="applyCoupon">Apply</span>
                                <span wire:loading wire:target="applyCoupon">...</span>
                            </button>
                        </div>
                        @error('couponCode') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                    @endif
                </div>
            </div>

            {{-- Right: order summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 mb-5">Order Summary</h2>

                    {{-- Items list --}}
                    <div class="space-y-3 mb-5">
                        @foreach($items as $item)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-green-50 shrink-0 overflow-hidden flex items-center justify-center">
                                    @if($item->product->primaryImage)
                                        <img src="{{ asset('storage/'.$item->product->primaryImage->image_path) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item->product->name }}</p>
                                    @if($item->variant)
                                        <p class="text-xs text-gray-500">{{ $item->variant->name }}</p>
                                    @endif
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="text-sm font-medium text-gray-900">₦{{ number_format((float) $item->unit_price * $item->quantity, 2) }}</p>
                                    <p class="text-xs text-gray-500">× {{ $item->quantity }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-2 mb-5">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-900">₦{{ number_format($subtotal, 2) }}</span>
                        </div>
                        @if($discount > 0)
                            <div class="flex justify-between text-sm text-green-700">
                                <span>Discount</span>
                                <span>−₦{{ number_format($discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium text-green-700">Free</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between">
                            <span class="font-semibold text-gray-900">Total</span>
                            <span class="font-bold text-xl text-green-700">₦{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button
                        wire:click="placeOrder"
                        wire:loading.attr="disabled"
                        class="btn btn-primary w-full btn-lg"
                    >
                        <span wire:loading.remove wire:target="placeOrder">Place Order</span>
                        <span wire:loading wire:target="placeOrder">Placing order...</span>
                    </button>

                    <p class="text-xs text-gray-500 text-center mt-3">
                        By placing your order you agree to our terms and conditions.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
