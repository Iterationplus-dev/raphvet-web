<div class="space-y-6">

    {{-- Back link + reference --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.appointments') }}" wire:navigate class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to Appointments</a>
        <span class="text-gray-300">|</span>
        <span class="font-mono text-sm font-semibold text-gray-700">{{ $appointment->reference_number }}</span>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Main detail card --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4">
                    <h3 class="font-semibold text-gray-900">Appointment Info</h3>
                </div>
                <dl class="divide-y divide-gray-100">
                    @php
                        $rows = [
                            'Date'    => $appointment->appointment_date->format('d F Y'),
                            'Time'    => $appointment->start_time ? \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') . ($appointment->end_time ? ' — ' . \Carbon\Carbon::parse($appointment->end_time)->format('g:i A') : '') : '—',
                            'Type'    => ucfirst($appointment->type ?? '—'),
                            'Reason'  => $appointment->reason ?? '—',
                        ];
                    @endphp
                    @foreach($rows as $label => $value)
                        <div class="grid grid-cols-3 gap-4 px-5 py-3">
                            <dt class="text-sm font-medium text-gray-500">{{ $label }}</dt>
                            <dd class="col-span-2 text-sm text-gray-900">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            {{-- Customer & Pet --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <h4 class="mb-3 text-sm font-semibold text-gray-700">Customer</h4>
                    @if($appointment->customer)
                        <p class="font-semibold text-gray-900">{{ $appointment->customer->name }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment->customer->email }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment->customer->phone ?? '—' }}</p>
                    @else
                        <p class="text-sm text-gray-400">No customer info.</p>
                    @endif
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <h4 class="mb-3 text-sm font-semibold text-gray-700">Pet</h4>
                    @if($appointment->pet && $appointment->pet->exists)
                        <p class="font-semibold text-gray-900">{{ $appointment->pet->name }}</p>
                        <p class="text-sm text-gray-500">{{ ucfirst($appointment->pet->species ?? '') }} · {{ $appointment->pet->breed ?? '—' }}</p>
                    @else
                        <p class="text-sm text-gray-400">No pet info.</p>
                    @endif
                </div>
            </div>

            {{-- Vet & Service --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <h4 class="mb-3 text-sm font-semibold text-gray-700">Attending Vet</h4>
                    <p class="text-sm text-gray-900">{{ $appointment->vet?->name ?? 'Unassigned' }}</p>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <h4 class="mb-3 text-sm font-semibold text-gray-700">Service</h4>
                    <p class="text-sm text-gray-900">{{ $appointment->service?->name ?? '—' }}</p>
                </div>
            </div>

            @if($appointment->notes)
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <h4 class="mb-2 text-sm font-semibold text-gray-700">Notes</h4>
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $appointment->notes }}</p>
                </div>
            @endif
        </div>

        {{-- Sidebar: Status + Timeline --}}
        <div class="space-y-5">

            {{-- Status control --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h4 class="mb-3 font-semibold text-gray-900">Update Status</h4>
                @php
                    $statusColors = [
                        'pending'   => 'bg-yellow-100 text-yellow-800',
                        'confirmed' => 'bg-blue-100 text-blue-800',
                        'completed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                    ];
                @endphp
                <span class="mb-4 inline-flex items-center rounded-full px-3 py-1 text-sm font-medium {{ $statusColors[$appointment->status] ?? 'bg-gray-100 text-gray-700' }}">
                    {{ ucfirst($appointment->status) }}
                </span>
                <form wire:submit="updateStatus" class="mt-4 space-y-3">
                    <select wire:model="newStatus" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <button type="submit" class="w-full rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700">
                        Update Status
                    </button>
                </form>
            </div>

            {{-- Status log timeline --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h4 class="mb-4 font-semibold text-gray-900">Status History</h4>
                @if($appointment->statusLogs->isEmpty())
                    <p class="text-sm text-gray-400">No status changes recorded.</p>
                @else
                    <ol class="relative border-l border-gray-200 space-y-4 pl-5">
                        @foreach($appointment->statusLogs->sortByDesc('created_at') as $log)
                            <li class="relative">
                                <span class="absolute -left-6 flex h-3 w-3 items-center justify-center rounded-full bg-primary-500 ring-4 ring-white"></span>
                                <p class="text-xs font-medium text-gray-700">
                                    <span class="text-gray-500">{{ ucfirst($log->from_status) }}</span>
                                    &rarr;
                                    <span class="font-semibold text-gray-900">{{ ucfirst($log->to_status) }}</span>
                                </p>
                                <p class="text-xs text-gray-400">{{ $log->created_at->format('d M Y, g:i A') }}</p>
                                @if($log->changedBy)
                                    <p class="text-xs text-gray-400">by {{ $log->changedBy->name }}</p>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>
    </div>
</div>
