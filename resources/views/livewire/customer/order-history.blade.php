<div>
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">My Orders</h1>
    </div>

    @if($orders->isEmpty())
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-50 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-900 mb-1">No orders yet</h2>
            <p class="text-gray-500 mb-4">You haven't placed any orders. Browse our shop to get started.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary btn-sm">Browse Shop</a>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-4">Reference</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-4 hidden sm:table-cell">Date</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-4 hidden md:table-cell">Items</th>
                            <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-4">Total</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-4">Payment</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-4">Status</th>
                            <th class="px-5 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-4">
                                    <span class="font-mono text-sm font-medium text-gray-900">{{ $order->reference_number }}</span>
                                </td>
                                <td class="px-5 py-4 text-sm text-gray-500 hidden sm:table-cell">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-5 py-4 text-center text-sm text-gray-700 hidden md:table-cell">
                                    {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <span class="font-semibold text-gray-900 text-sm">₦{{ number_format((float) $order->total_amount, 2) }}</span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="badge {{ match($order->payment_status) { 'paid' => 'badge-green', 'unpaid' => 'badge-yellow', 'refunded' => 'badge-blue', default => 'badge-gray' } }} capitalize">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="badge {{ match($order->status) { 'pending' => 'badge-yellow', 'processing' => 'badge-blue', 'shipped' => 'badge-purple', 'delivered' => 'badge-green', 'cancelled' => 'badge-red', default => 'badge-gray' } }} capitalize">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <a href="#" class="text-sm text-green-700 hover:text-green-900 font-medium whitespace-nowrap">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
