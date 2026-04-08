<div>
    <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">My Appointments</h1>
            <p class="text-gray-500 mt-1 text-sm">Manage and track your veterinary appointments.</p>
        </div>
        <a href="{{ route('appointments.book') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-semibold transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Book Appointment
        </a>
    </div>

    <!-- Status filter tabs -->
    <div class="flex gap-1 mb-6 bg-gray-100 p-1 rounded-lg w-fit flex-wrap">
        @foreach (['all' => 'All', 'upcoming' => 'Upcoming', 'past' => 'Past', 'cancelled' => 'Cancelled'] as $value => $label)
            <button
                type="button"
                wire:click="$set('statusFilter', '{{ $value }}')"
                class="px-4 py-1.5 rounded-md text-sm font-medium transition
                    {{ $statusFilter === $value ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}"
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Appointment list -->
    @if ($appointments->isEmpty())
        <div class="py-16 text-center bg-white rounded-xl border border-gray-200">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            @if ($statusFilter === 'upcoming')
                <p class="text-gray-500 font-medium">No upcoming appointments</p>
                <p class="text-gray-400 text-sm mt-1">Book one to get started.</p>
            @elseif ($statusFilter === 'past')
                <p class="text-gray-500 font-medium">No past appointments</p>
            @elseif ($statusFilter === 'cancelled')
                <p class="text-gray-500 font-medium">No cancelled appointments</p>
            @else
                <p class="text-gray-500 font-medium">No appointments yet</p>
                <p class="text-gray-400 text-sm mt-1">Book your first appointment today.</p>
            @endif
            <a href="{{ route('appointments.book') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                Book Appointment
            </a>
        </div>
    @else
        <div class="space-y-3">
            @foreach ($appointments as $appointment)
                @php
                    $statusConfig = match($appointment->status) {
                        'pending'     => ['label' => 'Pending',     'class' => 'bg-yellow-100 text-yellow-800'],
                        'confirmed'   => ['label' => 'Confirmed',   'class' => 'bg-blue-100 text-blue-800'],
                        'in_progress' => ['label' => 'In Progress', 'class' => 'bg-purple-100 text-purple-800'],
                        'completed'   => ['label' => 'Completed',   'class' => 'bg-green-100 text-green-800'],
                        'cancelled'   => ['label' => 'Cancelled',   'class' => 'bg-red-100 text-red-800'],
                        'no_show'     => ['label' => 'No Show',     'class' => 'bg-gray-100 text-gray-600'],
                        default       => ['label' => ucfirst($appointment->status), 'class' => 'bg-gray-100 text-gray-600'],
                    };
                    $typeLabels = ['in_clinic' => 'In-Clinic', 'farm_visit' => 'Farm Visit', 'online' => 'Online'];
                @endphp
                <div class="bg-white rounded-xl border border-gray-200 p-4 hover:border-gray-300 transition">
                    <!-- Mobile layout -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-semibold text-gray-900 text-sm">{{ $appointment->service->name ?? 'Unknown Service' }}</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusConfig['class'] }}">
                                    {{ $statusConfig['label'] }}
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    {{ $typeLabels[$appointment->type] ?? $appointment->type }}
                                </span>
                            </div>
                            <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Dr. {{ $appointment->vet->name ?? '—' }}
                                </span>
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $appointment->appointment_date->format('M j, Y') }}
                                    @if ($appointment->start_time)
                                        &bull; {{ date('h:i A', strtotime($appointment->start_time)) }}
                                    @endif
                                </span>
                                @if ($appointment->pet->name)
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        {{ $appointment->pet->name }}
                                    </span>
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-400">Ref: {{ $appointment->reference_number }}</p>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 shrink-0">
                            <a
                                href="{{ route('my.appointments.show', $appointment->reference_number) }}"
                                class="text-xs px-3 py-1.5 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 font-medium transition"
                            >
                                View
                            </a>
                            @if ($appointment->isCancellable())
                                <div
                                    x-data
                                    x-on:click="if (confirm('Are you sure you want to cancel this appointment?')) { $wire.cancel({{ $appointment->id }}) }"
                                >
                                    <button
                                        type="button"
                                        class="text-xs px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 font-medium transition"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $appointments->links() }}
        </div>
    @endif
</div>
