<div>
    @php
        $avatarColors = match($pet->species) {
            'dog'    => 'bg-blue-100 text-blue-700',
            'cat'    => 'bg-purple-100 text-purple-700',
            'bird'   => 'bg-yellow-100 text-yellow-700',
            'cattle' => 'bg-green-100 text-green-700',
            default  => 'bg-gray-100 text-gray-700',
        };
        $genderLabel = match($pet->gender) {
            'male'   => '♂ Male',
            'female' => '♀ Female',
            default  => '? Unknown',
        };
    @endphp

    {{-- Header card --}}
    <div class="mb-6 rounded-2xl bg-white shadow-sm border border-gray-100 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-5">
            {{-- Avatar --}}
            <div class="shrink-0 w-16 h-16 rounded-full {{ $avatarColors }} flex items-center justify-center text-2xl font-bold uppercase">
                {{ mb_substr($pet->name, 0, 1) }}
            </div>

            {{-- Pet info --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold text-gray-900">{{ $pet->name }}</h1>
                <p class="text-sm text-gray-500 mt-0.5">
                    {{ ucfirst($pet->species) }}
                    @if ($pet->breed)
                        &middot; {{ $pet->breed }}
                    @endif
                    &middot; {{ $genderLabel }}
                    @if ($pet->age)
                        &middot; {{ $pet->age }}
                    @endif
                    @if ($pet->weight_kg)
                        &middot; {{ $pet->weight_kg }} kg
                    @endif
                </p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('my.pets') }}"
                   class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-600 hover:border-gray-300 hover:text-gray-900 transition-colors">
                    ← Back
                </a>
                <a href="{{ route('my.pets.edit', $pet) }}"
                   class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                    Edit
                </a>
            </div>
        </div>
    </div>

    {{-- Tab bar --}}
    <div class="mb-6 flex gap-1 rounded-xl bg-gray-100 p-1 w-full sm:w-auto sm:inline-flex">
        <button wire:click="setTab('overview')"
                class="flex-1 sm:flex-none rounded-lg px-4 py-2 text-sm font-medium transition-colors
                    {{ $activeTab === 'overview' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
            Overview
        </button>
        <button wire:click="setTab('medical')"
                class="flex-1 sm:flex-none rounded-lg px-4 py-2 text-sm font-medium transition-colors
                    {{ $activeTab === 'medical' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
            Medical History
        </button>
        <button wire:click="setTab('vaccinations')"
                class="flex-1 sm:flex-none rounded-lg px-4 py-2 text-sm font-medium transition-colors
                    {{ $activeTab === 'vaccinations' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
            Vaccinations
        </button>
    </div>

    {{-- ── Overview tab ──────────────────────────────────────────────────── --}}
    @if ($activeTab === 'overview')
        {{-- Stats row --}}
        <div class="mb-5 grid grid-cols-2 gap-4 sm:grid-cols-4">
            <div class="rounded-xl bg-white border border-gray-100 shadow-sm px-4 py-3">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Weight</p>
                <p class="text-sm font-semibold text-gray-900">
                    {{ $pet->weight_kg ? $pet->weight_kg . ' kg' : '—' }}
                </p>
            </div>
            <div class="rounded-xl bg-white border border-gray-100 shadow-sm px-4 py-3">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Date of Birth</p>
                <p class="text-sm font-semibold text-gray-900">
                    {{ $pet->date_of_birth ? $pet->date_of_birth->format('d M Y') : '—' }}
                </p>
            </div>
            <div class="rounded-xl bg-white border border-gray-100 shadow-sm px-4 py-3">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Gender</p>
                <p class="text-sm font-semibold text-gray-900">{{ $genderLabel }}</p>
            </div>
            <div class="rounded-xl bg-white border border-gray-100 shadow-sm px-4 py-3">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Microchip</p>
                <p class="text-sm font-semibold text-gray-900 truncate">
                    {{ $pet->microchip_number ?: '—' }}
                </p>
            </div>
        </div>

        {{-- Notes --}}
        @if ($pet->notes)
            <div class="mb-5 rounded-xl bg-white border border-gray-100 shadow-sm px-5 py-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Notes</h3>
                <p class="text-sm text-gray-600 whitespace-pre-line">{{ $pet->notes }}</p>
            </div>
        @endif

        {{-- Quick actions --}}
        <div class="rounded-xl bg-white border border-gray-100 shadow-sm px-5 py-4">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Quick Actions</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('appointments.book') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Book Appointment
                </a>
                <button type="button"
                        disabled
                        title="Only vets can add medical records"
                        class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Add Medical Record
                </button>
                <button wire:click="setTab('vaccinations')"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    Add Vaccination
                </button>
            </div>
        </div>
    @endif

    {{-- ── Medical History tab ────────────────────────────────────────────── --}}
    @if ($activeTab === 'medical')
        <div class="rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Medical History</h2>
                <button type="button"
                        disabled
                        title="Only vets can add medical records"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-400 cursor-not-allowed">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Record (Vet only)
                </button>
            </div>

            @if ($medicalRecords->isEmpty())
                <div class="flex flex-col items-center justify-center py-14 px-8 text-center">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-500">No medical records yet</p>
                    <p class="text-xs text-gray-400 mt-1">Records are added by your vet after each visit.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Visit Date</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Complaint</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Diagnosis</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Vet</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Follow-up</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($medicalRecords as $record)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-900 font-medium whitespace-nowrap">
                                        {{ $record->visit_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 max-w-45 truncate">
                                        {{ $record->chief_complaint ?: '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 max-w-45 truncate">
                                        {{ $record->diagnosis ?: '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $record->vet?->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $record->follow_up_date ? $record->follow_up_date->format('d M Y') : '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @endif

    {{-- ── Vaccinations tab ───────────────────────────────────────────────── --}}
    @if ($activeTab === 'vaccinations')
        @php
            $overdueVaccinations = $vaccinations->filter(fn ($v) => $v->isOverdue());
            $dueSoonVaccinations = $vaccinations->filter(fn ($v) => $v->isDueSoon());
        @endphp

        {{-- Due soon / overdue alerts --}}
        @if ($overdueVaccinations->isNotEmpty() || $dueSoonVaccinations->isNotEmpty())
            <div class="mb-5 space-y-3">
                @foreach ($overdueVaccinations as $v)
                    <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                        <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-red-800">Overdue: {{ $v->vaccine_name }}</p>
                            <p class="text-xs text-red-600 mt-0.5">Was due {{ $v->next_due_date->format('d M Y') }}</p>
                        </div>
                    </div>
                @endforeach

                @foreach ($dueSoonVaccinations as $v)
                    <div class="flex items-start gap-3 rounded-xl border border-yellow-200 bg-yellow-50 px-4 py-3">
                        <svg class="w-5 h-5 text-yellow-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-yellow-800">Due Soon: {{ $v->vaccine_name }}</p>
                            <p class="text-xs text-yellow-600 mt-0.5">Due {{ $v->next_due_date->format('d M Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Vaccination history table --}}
        <div class="rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Vaccination History</h2>
            </div>

            @if ($vaccinations->isEmpty())
                <div class="flex flex-col items-center justify-center py-14 px-8 text-center">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-500">No vaccination records yet</p>
                    <p class="text-xs text-gray-400 mt-1">Vaccination records are added by your vet.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Vaccine</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Administered</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Next Due</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Vet</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($vaccinations as $vaccination)
                                @php
                                    $statusLabel = 'Up to date';
                                    $statusClasses = 'bg-green-100 text-green-700';

                                    if ($vaccination->isOverdue()) {
                                        $statusLabel = 'Overdue';
                                        $statusClasses = 'bg-red-100 text-red-700';
                                    } elseif ($vaccination->isDueSoon()) {
                                        $statusLabel = 'Due soon';
                                        $statusClasses = 'bg-yellow-100 text-yellow-700';
                                    } elseif (! $vaccination->next_due_date) {
                                        $statusLabel = 'No follow-up';
                                        $statusClasses = 'bg-gray-100 text-gray-600';
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-900 font-medium">
                                        {{ $vaccination->vaccine_name }}
                                        @if ($vaccination->manufacturer)
                                            <span class="text-xs text-gray-400 block font-normal">{{ $vaccination->manufacturer }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $vaccination->administered_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $vaccination->next_due_date ? $vaccination->next_due_date->format('d M Y') : '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $vaccination->vet?->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @endif
</div>
