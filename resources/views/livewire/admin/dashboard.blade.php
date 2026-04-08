<div class="space-y-6">

    {{-- Pending contacts alert --}}
    @if($pendingContacts > 0)
        <div class="flex items-center gap-3 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-amber-800">
            <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
            </svg>
            <span class="text-sm font-medium">You have {{ $pendingContacts }} unread contact {{ Str::plural('submission', $pendingContacts) }}.</span>
            <a href="{{ route('admin.contact-inbox') }}" wire:navigate class="ml-auto text-sm font-semibold underline hover:text-amber-900">View Inbox &rarr;</a>
        </div>
    @endif

    {{-- Stats cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">
        {{-- Total Users --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Total Users</p>
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50">
                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
        </div>

        {{-- Total Pets --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Total Pets</p>
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-green-50">
                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($totalPets) }}</p>
        </div>

        {{-- Appointments Today --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Appointments Today</p>
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-50">
                    <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($appointmentsToday) }}</p>
        </div>

        {{-- Orders This Week --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Orders This Week</p>
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50">
                    <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($ordersThisWeek) }}</p>
        </div>

        {{-- Revenue This Month --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Revenue This Month</p>
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-green-50">
                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-bold text-gray-900">&#8358;{{ number_format($revenueThisMonth, 0) }}</p>
        </div>
    </div>

    {{-- Two-column grid --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Recent Appointments --}}
        <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                <h3 class="font-semibold text-gray-900">Recent Appointments</h3>
                <a href="{{ route('admin.appointments') }}" wire:navigate class="text-sm font-medium text-primary-600 hover:text-primary-700">View All &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-5 py-3 text-left">Date</th>
                            <th class="px-5 py-3 text-left">Customer</th>
                            <th class="px-5 py-3 text-left">Service</th>
                            <th class="px-5 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentAppointments as $appt)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 text-sm text-gray-700">{{ $appt->appointment_date->format('d M') }}</td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-900">{{ $appt->customer?->name ?? '—' }}</td>
                                <td class="px-5 py-3 text-sm text-gray-600">{{ $appt->service?->name ?? '—' }}</td>
                                <td class="px-5 py-3">
                                    @php
                                        $colors = [
                                            'pending'   => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                        $color = $colors[$appt->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $color }}">
                                        {{ ucfirst($appt->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-6 text-center text-sm text-gray-400">No recent appointments.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                <h3 class="font-semibold text-gray-900">Recent Orders</h3>
                <a href="{{ route('admin.orders') }}" wire:navigate class="text-sm font-medium text-primary-600 hover:text-primary-700">View All &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-5 py-3 text-left">Reference</th>
                            <th class="px-5 py-3 text-left">Customer</th>
                            <th class="px-5 py-3 text-left">Total</th>
                            <th class="px-5 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 text-sm font-mono text-gray-700">
                                    <a href="{{ route('admin.orders.show', $order->reference_number) }}" wire:navigate class="hover:text-primary-600">
                                        {{ $order->reference_number }}
                                    </a>
                                </td>
                                <td class="px-5 py-3 text-sm text-gray-900">{{ $order->customer?->name ?? '—' }}</td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-900">&#8358;{{ number_format($order->total_amount, 0) }}</td>
                                <td class="px-5 py-3">
                                    @php
                                        $colors = [
                                            'pending'    => 'bg-yellow-100 text-yellow-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'shipped'    => 'bg-indigo-100 text-indigo-800',
                                            'delivered'  => 'bg-green-100 text-green-800',
                                            'cancelled'  => 'bg-red-100 text-red-800',
                                        ];
                                        $color = $colors[$order->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $color }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-6 text-center text-sm text-gray-400">No recent orders.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
