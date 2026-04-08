<div class="space-y-4">

    {{-- Filters --}}
    <div class="flex flex-wrap gap-3">
        <div class="relative min-w-48 flex-1">
            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" wire:model.live.300ms="search" placeholder="Reference or customer name…" class="w-full rounded-lg border border-gray-300 py-2 pl-9 pr-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
        </div>
        <select wire:model.live="statusFilter" class="rounded-lg border border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
            <option value="all">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-5 py-3 text-left">Reference</th>
                        <th class="px-5 py-3 text-left">Customer</th>
                        <th class="px-5 py-3 text-left">Date</th>
                        <th class="px-5 py-3 text-left">Items</th>
                        <th class="px-5 py-3 text-left">Total</th>
                        <th class="px-5 py-3 text-left">Payment</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        @php
                            $orderStatusColors = [
                                'pending'    => 'bg-yellow-100 text-yellow-800',
                                'processing' => 'bg-blue-100 text-blue-800',
                                'shipped'    => 'bg-indigo-100 text-indigo-800',
                                'delivered'  => 'bg-green-100 text-green-800',
                                'cancelled'  => 'bg-red-100 text-red-800',
                            ];
                            $paymentColors = [
                                'pending'  => 'bg-yellow-100 text-yellow-800',
                                'paid'     => 'bg-green-100 text-green-800',
                                'failed'   => 'bg-red-100 text-red-800',
                                'refunded' => 'bg-gray-100 text-gray-700',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 font-mono text-sm font-medium text-gray-900">
                                <a href="{{ route('admin.orders.show', $order->reference_number) }}" wire:navigate class="hover:text-primary-600">{{ $order->reference_number }}</a>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-900">{{ $order->customer?->name ?? '—' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ $order->items->count() }}</td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-900">&#8358;{{ number_format($order->total_amount, 0) }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $paymentColors[$order->payment_status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $orderStatusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.orders.show', $order->reference_number) }}" wire:navigate class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-10 text-center text-sm text-gray-400">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="border-t border-gray-100 px-5 py-3">{{ $orders->links() }}</div>
        @endif
    </div>
</div>
