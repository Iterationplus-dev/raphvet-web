<div class="space-y-4">

    {{-- Filters --}}
    <div class="flex flex-wrap gap-3">
        <div class="relative min-w-48 flex-1">
            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" wire:model.live.300ms="search" placeholder="Search customer name…" class="w-full rounded-lg border border-gray-300 py-2 pl-9 pr-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
        </div>
        <select wire:model.live="statusFilter" class="rounded-lg border border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
            <option value="all">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <input type="date" wire:model.live="dateFilter" class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-5 py-3 text-left">Date & Time</th>
                        <th class="px-5 py-3 text-left">Customer</th>
                        <th class="px-5 py-3 text-left">Vet</th>
                        <th class="px-5 py-3 text-left">Pet</th>
                        <th class="px-5 py-3 text-left">Service</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-left">Change Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($appointments as $appt)
                        @php
                            $statusColors = [
                                'pending'   => 'bg-yellow-100 text-yellow-800',
                                'confirmed' => 'bg-blue-100 text-blue-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <p class="text-sm font-medium text-gray-900">{{ $appt->appointment_date->format('d M Y') }}</p>
                                @if($appt->start_time)
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($appt->start_time)->format('g:i A') }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-900">{{ $appt->customer?->name ?? '—' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ $appt->vet?->name ?? '—' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ $appt->pet?->name ?? '—' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ $appt->service?->name ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $statusColors[$appt->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($appt->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <select wire:change="updateStatus({{ $appt->id }}, $event.target.value)" class="rounded-lg border border-gray-300 py-1.5 pl-2 pr-7 text-xs focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                                    <option value="pending"   @selected($appt->status === 'pending')>Pending</option>
                                    <option value="confirmed" @selected($appt->status === 'confirmed')>Confirmed</option>
                                    <option value="completed" @selected($appt->status === 'completed')>Completed</option>
                                    <option value="cancelled" @selected($appt->status === 'cancelled')>Cancelled</option>
                                </select>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-sm text-gray-400">No appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($appointments->hasPages())
            <div class="border-t border-gray-100 px-5 py-3">{{ $appointments->links() }}</div>
        @endif
    </div>
</div>
