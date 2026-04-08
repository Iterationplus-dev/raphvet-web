<div>
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('my.appointments') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Appointments
        </a>
    </div>

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
        $typeLabels = ['in_clinic' => 'In-Clinic 🏥', 'farm_visit' => 'Farm Visit 🚜', 'online' => 'Online 💻'];
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main detail card -->
        <div class="lg:col-span-2 space-y-5">
            <!-- Header card -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">{{ $appointment->service->name ?? 'Appointment' }}</h1>
                        <p class="text-sm text-gray-400 mt-0.5">{{ $appointment->reference_number }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusConfig['class'] }}">
                        {{ $statusConfig['label'] }}
                    </span>
                </div>

                <dl class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Veterinarian</dt>
                        <dd class="mt-1 flex items-center gap-2">
                            <img src="{{ $appointment->vet->avatar_url }}" alt="{{ $appointment->vet->name }}" class="w-7 h-7 rounded-full object-cover">
                            <span class="text-sm font-medium text-gray-900">Dr. {{ $appointment->vet->name ?? '—' }}</span>
                        </dd>
                        @if ($appointment->vet?->vetProfile?->specialization)
                            <dd class="mt-0.5 text-xs text-gray-500 pl-9">{{ $appointment->vet->vetProfile->specialization }}</dd>
                        @endif
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Date &amp; Time</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900">
                            {{ $appointment->appointment_date->format('l, F j, Y') }}
                        </dd>
                        @if ($appointment->start_time)
                            <dd class="text-sm text-gray-600">
                                {{ date('h:i A', strtotime($appointment->start_time)) }}
                                @if ($appointment->end_time)
                                    – {{ date('h:i A', strtotime($appointment->end_time)) }}
                                @endif
                            </dd>
                        @endif
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $typeLabels[$appointment->type] ?? $appointment->type }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pet</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $appointment->pet->name ? $appointment->pet->name.' ('.ucfirst($appointment->pet->species ?? '').')' : 'No pet' }}
                        </dd>
                    </div>
                    @if ($appointment->total_amount)
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Consultation Fee</dt>
                            <dd class="mt-1 text-sm font-semibold text-green-700">₱{{ number_format($appointment->total_amount, 2) }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- Reason & notes card -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-900 mb-3">Reason for Visit</h2>
                <p class="text-sm text-gray-700 leading-relaxed">{{ $appointment->reason }}</p>
                @if ($appointment->notes)
                    <h2 class="text-sm font-semibold text-gray-900 mt-5 mb-3">Additional Notes</h2>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ $appointment->notes }}</p>
                @endif
                @if ($appointment->cancellation_reason)
                    <h2 class="text-sm font-semibold text-red-700 mt-5 mb-3">Cancellation Reason</h2>
                    <p class="text-sm text-red-600 leading-relaxed">{{ $appointment->cancellation_reason }}</p>
                @endif
            </div>

            <!-- Cancel button -->
            @if ($appointment->isCancellable())
                <div
                    x-data
                    x-on:click="if (confirm('Are you sure you want to cancel this appointment?')) { $wire.cancel() }"
                >
                    <button
                        type="button"
                        class="w-full py-2.5 rounded-lg border border-red-300 text-red-600 hover:bg-red-50 text-sm font-medium transition"
                    >
                        Cancel Appointment
                    </button>
                </div>
            @endif
        </div>

        <!-- Status timeline -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-6">
                <h2 class="text-sm font-semibold text-gray-900 mb-4">Status History</h2>
                @if ($appointment->statusLogs->isNotEmpty())
                    <ol class="relative border-l border-gray-200 space-y-5 ml-2">
                        @foreach ($appointment->statusLogs->sortBy('created_at') as $log)
                            @php
                                $dotColor = match($log->to_status) {
                                    'pending'     => 'bg-yellow-400',
                                    'confirmed'   => 'bg-blue-500',
                                    'in_progress' => 'bg-purple-500',
                                    'completed'   => 'bg-green-500',
                                    'cancelled'   => 'bg-red-500',
                                    'no_show'     => 'bg-gray-400',
                                    default       => 'bg-gray-400',
                                };
                            @endphp
                            <li class="ml-4">
                                <div class="absolute -left-1.5 mt-1 w-3 h-3 rounded-full border-2 border-white {{ $dotColor }}"></div>
                                <p class="text-xs font-semibold text-gray-800 capitalize">{{ str_replace('_', ' ', $log->to_status) }}</p>
                                <p class="text-xs text-gray-400">{{ $log->created_at->format('M j, Y h:i A') }}</p>
                                @if ($log->notes)
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $log->notes }}</p>
                                @endif
                                @if ($log->changedBy)
                                    <p class="text-xs text-gray-400">by {{ $log->changedBy->name }}</p>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="text-sm text-gray-400">No status history available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
