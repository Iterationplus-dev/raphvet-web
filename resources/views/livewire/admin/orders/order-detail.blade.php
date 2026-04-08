<div class="space-y-6">

    {{-- Back --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.orders') }}" wire:navigate class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to Orders</a>
        <span class="text-gray-300">|</span>
        <span class="font-mono text-sm font-semibold text-gray-700">{{ $order->reference_number }}</span>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Left: Items + Totals --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Order Items --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4">
                    <h3 class="font-semibold text-gray-900">Order Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                                <th class="px-5 py-3 text-left">Product</th>
                                <th class="px-5 py-3 text-right">Unit Price</th>
                                <th class="px-5 py-3 text-right">Qty</th>
                                <th class="px-5 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-5 py-3 text-sm text-gray-900">{{ $item->product?->name ?? 'Deleted product' }}</td>
                                    <td class="px-5 py-3 text-right text-sm text-gray-700">&#8358;{{ number_format($item->unit_price, 0) }}</td>
                                    <td class="px-5 py-3 text-right text-sm text-gray-700">{{ $item->quantity }}</td>
                                    <td class="px-5 py-3 text-right text-sm font-medium text-gray-900">&#8358;{{ number_format($item->total_price, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Totals --}}
                <div class="border-t border-gray-100 px-5 py-4">
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <dt>Subtotal</dt>
                            <dd>&#8358;{{ number_format($order->subtotal, 0) }}</dd>
                        </div>
                        @if($order->discount_amount > 0)
                            <div class="flex justify-between text-green-700">
                                <dt>Discount</dt>
                                <dd>- &#8358;{{ number_format($order->discount_amount, 0) }}</dd>
                            </div>
                        @endif
                        <div class="flex justify-between text-gray-600">
                            <dt>Shipping</dt>
                            <dd>&#8358;{{ number_format($order->shipping_amount, 0) }}</dd>
                        </div>
                        @if($order->tax_amount > 0)
                            <div class="flex justify-between text-gray-600">
                                <dt>Tax</dt>
                                <dd>&#8358;{{ number_format($order->tax_amount, 0) }}</dd>
                            </div>
                        @endif
                        <div class="flex justify-between border-t border-gray-200 pt-2 text-base font-bold text-gray-900">
                            <dt>Total</dt>
                            <dd>&#8358;{{ number_format($order->total_amount, 0) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Shipping Address --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h4 class="mb-3 font-semibold text-gray-900">Shipping Address</h4>
                <address class="not-italic text-sm text-gray-700 space-y-0.5">
                    <p class="font-medium">{{ $order->shipping_name }}</p>
                    <p>{{ $order->shipping_phone }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->shipping_city }}@if($order->shipping_state), {{ $order->shipping_state }}@endif</p>
                    <p>{{ $order->shipping_country }} @if($order->shipping_postal_code){{ $order->shipping_postal_code }}@endif</p>
                </address>
            </div>
        </div>

        {{-- Right sidebar --}}
        <div class="space-y-5">

            {{-- Customer --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h4 class="mb-3 font-semibold text-gray-900">Customer</h4>
                @if($order->customer)
                    <p class="font-semibold text-gray-900">{{ $order->customer->name }}</p>
                    <p class="text-sm text-gray-500">{{ $order->customer->email }}</p>
                    <p class="text-sm text-gray-500">{{ $order->customer->phone ?? '—' }}</p>
                @else
                    <p class="text-sm text-gray-400">No customer info.</p>
                @endif
            </div>

            {{-- Payment --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h4 class="mb-3 font-semibold text-gray-900">Payment</h4>
                @php
                    $paymentColors = [
                        'pending'  => 'bg-yellow-100 text-yellow-800',
                        'paid'     => 'bg-green-100 text-green-800',
                        'failed'   => 'bg-red-100 text-red-800',
                        'refunded' => 'bg-gray-100 text-gray-700',
                    ];
                @endphp
                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-sm font-medium {{ $paymentColors[$order->payment_status] ?? 'bg-gray-100 text-gray-700' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
                @if($order->payment_method)
                    <p class="mt-2 text-sm text-gray-600">via {{ ucfirst($order->payment_method) }}</p>
                @endif
                @if($order->payment_reference)
                    <p class="mt-1 font-mono text-xs text-gray-400">{{ $order->payment_reference }}</p>
                @endif
            </div>

            {{-- Status control --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h4 class="mb-3 font-semibold text-gray-900">Order Status</h4>
                <form wire:submit="updateStatus" class="space-y-3">
                    <select wire:model="newStatus" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <button type="submit" class="w-full rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
