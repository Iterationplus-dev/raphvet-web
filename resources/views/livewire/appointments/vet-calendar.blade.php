<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">My Schedule</h1>
        <p class="text-gray-500 mt-1 text-sm">View and manage your daily appointments.</p>
    </div>

    <!-- Date navigation -->
    <div class="flex items-center justify-between gap-4 bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <button
            type="button"
            wire:click="previousDay"
            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Previous
        </button>

        <div class="text-center">
            <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($date)->format('l') }}</p>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</p>
            @if ($date === today()->toDateString())
                <span class="inline-block mt-1 px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Today</span>
            @endif
        </div>

        <button
            type="button"
            wire:click="nextDay"
            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
        >
            Next
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    @php $hasAppointments = $appointments->isNotEmpty(); @endphp

    @if (! $hasAppointments)
        <div class="py-16 text-center bg-white rounded-xl border border-gray-200">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-gray-500 font-medium">No appointments scheduled</p>
            <p class="text-gray-400 text-sm mt-1">Enjoy your day off!</p>
        </div>
    @else
        <!-- Schedule grid -->
        <div class="space-y-3">
            @foreach ($slots as $slot)
                @php
                    $appointment = $appointments->get($slot);
                    $slotDisplay = date('h:i A', strtotime($slot));
                @endphp
                <div class="flex gap-4 items-start">
                    <!-- Time label -->
                    <div class="w-20 shrink-0 text-right pt-3">
                        <span class="text-xs font-medium text-gray-400">{{ $slotDisplay }}</span>
                    </div>

                    <!-- Slot content -->
                    <div class="flex-1">
                        @if ($appointment)
                            @php
                                $statusConfig = match($appointment->status) {
                                    'pending'     => ['label' => 'Pending',     'class' => 'bg-yellow-100 text-yellow-800', 'border' => 'border-yellow-300'],
                                    'confirmed'   => ['label' => 'Confirmed',   'class' => 'bg-blue-100 text-blue-800',   'border' => 'border-blue-300'],
                                    'in_progress' => ['label' => 'In Progress', 'class' => 'bg-purple-100 text-purple-800','border' => 'border-purple-300'],
                                    'completed'   => ['label' => 'Completed',   'class' => 'bg-green-100 text-green-800', 'border' => 'border-green-300'],
                                    'cancelled'   => ['label' => 'Cancelled',   'class' => 'bg-red-100 text-red-800',     'border' => 'border-red-200'],
                                    'no_show'     => ['label' => 'No Show',     'class' => 'bg-gray-100 text-gray-600',   'border' => 'border-gray-200'],
                                    default       => ['label' => ucfirst($appointment->status), 'class' => 'bg-gray-100 text-gray-600', 'border' => 'border-gray-200'],
                                };
                            @endphp
                            <div class="bg-white rounded-xl border {{ $statusConfig['border'] }} p-4 border-l-4">
                                <div class="flex items-start justify-between gap-3 flex-wrap">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="font-semibold text-gray-900 text-sm">{{ $appointment->customer->name ?? 'Unknown' }}</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusConfig['class'] }}">
                                                {{ $statusConfig['label'] }}
                                            </span>
                                        </div>
                                        <div class="mt-1.5 flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500">
                                            @if ($appointment->service->name)
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                                    {{ $appointment->service->name }}
                                                </span>
                                            @endif
                                            @if ($appointment->pet->name)
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                                    {{ $appointment->pet->name }} ({{ ucfirst($appointment->pet->species ?? '') }})
                                                </span>
                                            @endif
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $slotDisplay }}
                                                @if ($appointment->end_time)
                                                    – {{ date('h:i A', strtotime($appointment->end_time)) }}
                                                @endif
                                            </span>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-400">{{ $appointment->reference_number }}</p>
                                    </div>

                                    @if (in_array($appointment->status, ['confirmed', 'in_progress', 'pending']))
                                        <button
                                            type="button"
                                            wire:click="markComplete({{ $appointment->id }})"
                                            wire:confirm="Mark this appointment as completed?"
                                            wire:loading.attr="disabled"
                                            class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-600 hover:bg-green-700 text-white text-xs font-semibold transition"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            Mark Complete
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="h-12 rounded-xl border border-dashed border-gray-200 bg-gray-50 flex items-center px-4">
                                <span class="text-xs text-gray-300">Available</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
