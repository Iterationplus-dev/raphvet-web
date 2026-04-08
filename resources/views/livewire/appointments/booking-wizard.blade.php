<div>
    @if ($step === 5)
        {{-- ── Success Screen ───────────────────────────────────────────── --}}
        <div class="min-h-[60vh] flex items-center justify-center px-4 py-20">
            <div class="max-w-md w-full text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary-100 mb-6">
                    <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Appointment Booked!</h1>
                <p class="text-gray-500 mb-4">Your request has been submitted and is pending confirmation from our team.</p>
                <div class="inline-block px-6 py-3 rounded-xl bg-primary-50 border border-primary-200 mb-8">
                    <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider mb-1">Reference Number</p>
                    <p class="text-2xl font-bold text-primary-800 tracking-widest">{{ $bookedReference }}</p>
                </div>
                <p class="text-sm text-gray-400 mb-8">Please save your reference number. You will receive a confirmation via email.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    @auth
                        <a href="{{ route('my.appointments') }}" class="btn btn-primary">View My Appointments</a>
                    @endauth
                    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
        </div>
    @else
        {{-- ── Booking Wizard ───────────────────────────────────────────── --}}
        <div class="py-10 md:py-16 bg-gray-50 min-h-[70vh]">
            <div class="container-app">
                <div class="max-w-3xl mx-auto">
                    <!-- Page header -->
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-900">Book an Appointment</h1>
                        <p class="text-gray-500 mt-1">Follow the steps below to schedule your visit.</p>
                    </div>

                    @guest
                        <div class="mb-6 p-4 rounded-xl bg-accent-50 border border-accent-200 flex gap-3">
                            <svg class="w-5 h-5 text-accent-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                            <p class="text-sm text-accent-800">
                                Booking as a guest. <a href="{{ route('login') }}" class="font-semibold underline hover:text-accent-900">Sign in</a> or <a href="{{ route('register') }}" class="font-semibold underline hover:text-accent-900">create an account</a> to save your pets and view appointment history.
                            </p>
                        </div>
                    @endguest

                    <!-- Progress bar -->
                    <div class="mb-8">
                        <div class="flex items-center">
                            @foreach ([1 => 'Service', 2 => 'Vet & Time', 3 => 'Details', 4 => 'Confirm'] as $num => $label)
                                <div class="flex items-center {{ $num < 4 ? 'flex-1' : '' }}">
                                    <div class="flex flex-col items-center">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold
                                            {{ $step > $num ? 'bg-primary-600 text-white' : ($step === $num ? 'bg-primary-600 text-white ring-4 ring-primary-100' : 'bg-gray-200 text-gray-500') }}">
                                            @if ($step > $num)
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            @else
                                                {{ $num }}
                                            @endif
                                        </div>
                                        <span class="mt-1.5 text-xs font-medium {{ $step >= $num ? 'text-primary-700' : 'text-gray-400' }} hidden sm:block">{{ $label }}</span>
                                    </div>
                                    @if ($num < 4)
                                        <div class="flex-1 h-0.5 mx-2 {{ $step > $num ? 'bg-primary-500' : 'bg-gray-200' }}"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Step content -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                        {{-- Step 1: Select Service --}}
                        @if ($step === 1)
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Select a Service</h2>
                            @error('selectedServiceId')
                                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">{{ $message }}</div>
                            @enderror
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @forelse ($services as $service)
                                    <button
                                        type="button"
                                        wire:click="$set('selectedServiceId', {{ $service->id }})"
                                        class="text-left p-4 rounded-xl border-2 transition-all
                                            {{ $selectedServiceId === $service->id
                                                ? 'border-primary-500 bg-primary-50'
                                                : 'border-gray-200 bg-white hover:border-primary-300 hover:bg-gray-50' }}"
                                    >
                                        <div class="flex items-start gap-3">
                                            <div class="text-2xl leading-none mt-0.5">{{ $service->icon ?? '🐾' }}</div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-gray-900 text-sm">{{ $service->name }}</p>
                                                @if ($service->short_description)
                                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $service->short_description }}</p>
                                                @endif
                                            </div>
                                            @if ($selectedServiceId === $service->id)
                                                <svg class="w-5 h-5 text-primary-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                            @endif
                                        </div>
                                    </button>
                                @empty
                                    <div class="col-span-2 py-12 text-center text-gray-400">
                                        <p>No services available at this time.</p>
                                    </div>
                                @endforelse
                            </div>
                        @endif

                        {{-- Step 2: Choose Vet & Time --}}
                        @if ($step === 2)
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Choose Veterinarian &amp; Time</h2>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Vet selection -->
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">Veterinarian</p>
                                    @error('selectedVetId')
                                        <div class="mb-2 p-2 bg-red-50 border border-red-200 rounded-lg text-xs text-red-700">{{ $message }}</div>
                                    @enderror
                                    <div class="space-y-2">
                                        @forelse ($vets as $vet)
                                            <button
                                                type="button"
                                                wire:click="$set('selectedVetId', {{ $vet->id }})"
                                                class="w-full text-left p-3 rounded-xl border-2 transition-all
                                                    {{ $selectedVetId === $vet->id
                                                        ? 'border-primary-500 bg-primary-50'
                                                        : 'border-gray-200 hover:border-primary-300 hover:bg-gray-50' }}"
                                            >
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ $vet->avatar_url }}" alt="{{ $vet->name }}" class="w-10 h-10 rounded-full object-cover">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="font-semibold text-gray-900 text-sm truncate">Dr. {{ $vet->name }}</p>
                                                        @if ($vet->vetProfile)
                                                            <p class="text-xs text-gray-500 truncate">{{ $vet->vetProfile->specialization }}</p>
                                                            <p class="text-xs text-primary-700 font-medium">₦{{ number_format($vet->vetProfile->consultation_fee, 2) }}</p>
                                                        @endif
                                                    </div>
                                                    @if ($selectedVetId === $vet->id)
                                                        <svg class="w-5 h-5 text-primary-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                                    @endif
                                                </div>
                                            </button>
                                        @empty
                                            <p class="text-sm text-gray-400 py-4 text-center">No veterinarians available.</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Date & time selection -->
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">Date</p>
                                    @error('selectedDate')
                                        <div class="mb-2 p-2 bg-red-50 border border-red-200 rounded-lg text-xs text-red-700">{{ $message }}</div>
                                    @enderror
                                    <input
                                        type="date"
                                        wire:model.live="selectedDate"
                                        min="{{ today()->toDateString() }}"
                                        class="form-input"
                                    >

                                    <p class="text-sm font-medium text-gray-700 mt-4 mb-2">Available Time Slots</p>
                                    @error('selectedTime')
                                        <div class="mb-2 p-2 bg-red-50 border border-red-200 rounded-lg text-xs text-red-700">{{ $message }}</div>
                                    @enderror

                                    @if (! $selectedVetId || ! $selectedDate)
                                        <div class="py-8 text-center text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                            <p class="text-sm">Select a vet and date first</p>
                                        </div>
                                    @elseif (empty($availableSlots))
                                        <div class="py-8 text-center text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                            <p class="text-sm">No available slots for this day</p>
                                        </div>
                                    @else
                                        <div class="grid grid-cols-3 gap-2">
                                            @foreach ($availableSlots as $slot)
                                                @if ($slot['available'])
                                                    <button
                                                        type="button"
                                                        wire:click="$set('selectedTime', '{{ $slot['value'] }}')"
                                                        class="py-2 px-3 rounded-lg text-xs font-medium border transition-all
                                                            {{ $selectedTime === $slot['value']
                                                                ? 'bg-primary-600 border-primary-600 text-white'
                                                                : 'bg-white border-gray-300 text-gray-700 hover:border-primary-400 hover:bg-primary-50' }}"
                                                    >
                                                        {{ $slot['display'] }}
                                                    </button>
                                                @else
                                                    <button type="button" disabled class="py-2 px-3 rounded-lg text-xs font-medium border border-gray-100 bg-gray-50 text-gray-300 cursor-not-allowed line-through">
                                                        {{ $slot['display'] }}
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Step 3: Appointment Details --}}
                        @if ($step === 3)
                            <h2 class="text-lg font-semibold text-gray-900 mb-5">Appointment Details</h2>

                            {{-- Guest info (only shown when not logged in) --}}
                            @guest
                                <div class="mb-6 p-4 rounded-xl bg-gray-50 border border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-4">Your Contact Information</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="form-label">Full Name <span class="required">*</span></label>
                                            @error('guestName')
                                                <p class="form-error mb-1">{{ $message }}</p>
                                            @enderror
                                            <input type="text" wire:model="guestName" class="form-input" placeholder="Jane Doe">
                                        </div>
                                        <div>
                                            <label class="form-label">Phone Number <span class="required">*</span></label>
                                            @error('guestPhone')
                                                <p class="form-error mb-1">{{ $message }}</p>
                                            @enderror
                                            <input type="tel" wire:model="guestPhone" class="form-input" placeholder="+234 800 000 0000">
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="form-label">Email Address <span class="required">*</span></label>
                                            @error('guestEmail')
                                                <p class="form-error mb-1">{{ $message }}</p>
                                            @enderror
                                            <input type="email" wire:model="guestEmail" class="form-input" placeholder="jane@example.com">
                                        </div>
                                    </div>
                                </div>
                            @endguest

                            <!-- Pet selection (only for logged-in users) -->
                            @auth
                                <div class="mb-5">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Select Pet <span class="text-gray-400 font-normal">(optional)</span></p>
                                    <div class="flex flex-wrap gap-2">
                                        <button
                                            type="button"
                                            wire:click="$set('selectedPetId', null)"
                                            class="px-4 py-2 rounded-full border-2 text-sm font-medium transition-all
                                                {{ $selectedPetId === null
                                                    ? 'border-primary-500 bg-primary-50 text-primary-700'
                                                    : 'border-gray-200 text-gray-600 hover:border-primary-300' }}"
                                        >
                                            No Pet
                                        </button>
                                        @foreach ($pets as $pet)
                                            <button
                                                type="button"
                                                wire:click="$set('selectedPetId', {{ $pet->id }})"
                                                class="px-4 py-2 rounded-full border-2 text-sm font-medium transition-all
                                                    {{ $selectedPetId === $pet->id
                                                        ? 'border-primary-500 bg-primary-50 text-primary-700'
                                                        : 'border-gray-200 text-gray-600 hover:border-primary-300' }}"
                                            >
                                                {{ $pet->name }}
                                                <span class="text-xs opacity-60 ml-1">{{ ucfirst($pet->species) }}</span>
                                            </button>
                                        @endforeach
                                        @if ($pets->isEmpty())
                                            <p class="text-sm text-gray-400 self-center">No registered pets. <a href="{{ route('my.pets.create') }}" class="text-primary-600 hover:underline">Add one</a>.</p>
                                        @endif
                                    </div>
                                </div>
                            @endauth

                            <!-- Appointment type -->
                            <div class="mb-5">
                                <p class="text-sm font-medium text-gray-700 mb-2">Appointment Type</p>
                                @error('type')
                                    <div class="mb-2 p-2 bg-red-50 border border-red-200 rounded-lg text-xs text-red-700">{{ $message }}</div>
                                @enderror
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    @foreach ([
                                        ['value' => 'in_clinic',   'label' => 'In-Clinic',   'icon' => '🏥', 'desc' => 'Visit us at the clinic'],
                                        ['value' => 'farm_visit',  'label' => 'Farm Visit',  'icon' => '🚜', 'desc' => 'We come to your farm'],
                                        ['value' => 'online',      'label' => 'Online',      'icon' => '💻', 'desc' => 'Video consultation'],
                                    ] as $option)
                                        <button
                                            type="button"
                                            wire:click="$set('type', '{{ $option['value'] }}')"
                                            class="p-4 rounded-xl border-2 text-left transition-all
                                                {{ $type === $option['value']
                                                    ? 'border-primary-500 bg-primary-50'
                                                    : 'border-gray-200 hover:border-primary-300 hover:bg-gray-50' }}"
                                        >
                                            <div class="text-2xl mb-2">{{ $option['icon'] }}</div>
                                            <p class="font-semibold text-sm text-gray-900">{{ $option['label'] }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">{{ $option['desc'] }}</p>
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Reason -->
                            <div class="mb-5">
                                <label class="form-label">Reason for Visit <span class="required">*</span></label>
                                @error('reason')
                                    <div class="mb-2 p-2 bg-red-50 border border-red-200 rounded-lg text-xs text-red-700">{{ $message }}</div>
                                @enderror
                                <textarea
                                    wire:model.blur="reason"
                                    rows="4"
                                    maxlength="1000"
                                    placeholder="Describe the reason for your visit (e.g., annual checkup, limping on left leg, skin irritation...)"
                                    class="form-input"
                                ></textarea>
                                <p class="form-hint text-right">{{ strlen($reason) }} / 1000</p>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="form-label">Additional Notes <span class="text-gray-400 font-normal">(optional)</span></label>
                                <textarea
                                    wire:model="notes"
                                    rows="3"
                                    placeholder="Any other information you'd like the vet to know..."
                                    class="form-input"
                                ></textarea>
                            </div>
                        @endif

                        {{-- Step 4: Confirmation --}}
                        @if ($step === 4)
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-100 mb-3">
                                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900">Review Your Booking</h2>
                                <p class="text-sm text-gray-500 mt-1">Please confirm the details below before submitting.</p>
                            </div>

                            <dl class="divide-y divide-gray-100 rounded-xl border border-gray-200 overflow-hidden">
                                @php
                                    $selectedService = $services->find($selectedServiceId);
                                    $selectedVet = $vets->find($selectedVetId);
                                    $selectedPet = $selectedPetId ? $pets->find($selectedPetId) : null;
                                    $typeLabels = ['in_clinic' => 'In-Clinic', 'farm_visit' => 'Farm Visit', 'online' => 'Online'];
                                @endphp

                                @guest
                                    <div class="flex gap-4 px-5 py-3 bg-primary-50">
                                        <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Name</dt>
                                        <dd class="text-sm text-gray-900 font-semibold">{{ $guestName }}</dd>
                                    </div>
                                    <div class="flex gap-4 px-5 py-3">
                                        <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Email</dt>
                                        <dd class="text-sm text-gray-900">{{ $guestEmail }}</dd>
                                    </div>
                                    <div class="flex gap-4 px-5 py-3 bg-gray-50">
                                        <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Phone</dt>
                                        <dd class="text-sm text-gray-900">{{ $guestPhone }}</dd>
                                    </div>
                                @endguest

                                <div class="flex gap-4 px-5 py-3 {{ auth()->check() ? 'bg-gray-50' : '' }}">
                                    <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Service</dt>
                                    <dd class="text-sm text-gray-900 font-semibold">{{ $selectedService?->name ?? '—' }}</dd>
                                </div>
                                <div class="flex gap-4 px-5 py-3">
                                    <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Veterinarian</dt>
                                    <dd class="text-sm text-gray-900">Dr. {{ $selectedVet?->name ?? '—' }}</dd>
                                </div>
                                <div class="flex gap-4 px-5 py-3 bg-gray-50">
                                    <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Date &amp; Time</dt>
                                    <dd class="text-sm text-gray-900">
                                        {{ $selectedDate ? \Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') : '—' }}
                                        @if ($selectedTime)
                                            &bull; {{ date('h:i A', strtotime($selectedTime)) }}
                                        @endif
                                    </dd>
                                </div>
                                @auth
                                    <div class="flex gap-4 px-5 py-3">
                                        <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Pet</dt>
                                        <dd class="text-sm text-gray-900">{{ $selectedPet ? $selectedPet->name.' ('.ucfirst($selectedPet->species).')' : 'No pet selected' }}</dd>
                                    </div>
                                @endauth
                                <div class="flex gap-4 px-5 py-3 bg-gray-50">
                                    <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Type</dt>
                                    <dd class="text-sm text-gray-900">{{ $typeLabels[$type] ?? $type }}</dd>
                                </div>
                                <div class="flex gap-4 px-5 py-3">
                                    <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Reason</dt>
                                    <dd class="text-sm text-gray-900">{{ $reason }}</dd>
                                </div>
                                @if ($notes)
                                    <div class="flex gap-4 px-5 py-3 bg-gray-50">
                                        <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Notes</dt>
                                        <dd class="text-sm text-gray-900">{{ $notes }}</dd>
                                    </div>
                                @endif
                                @if ($selectedVet?->vetProfile?->consultation_fee)
                                    <div class="flex gap-4 px-5 py-3">
                                        <dt class="text-sm font-medium text-gray-500 w-32 shrink-0">Consultation Fee</dt>
                                        <dd class="text-sm font-semibold text-primary-700">₦{{ number_format($selectedVet->vetProfile->consultation_fee, 2) }}</dd>
                                    </div>
                                @endif
                            </dl>
                        @endif
                    </div>

                    <!-- Navigation buttons -->
                    <div class="mt-6 flex items-center justify-between">
                        <div>
                            @if ($step > 1)
                                <button
                                    type="button"
                                    wire:click="previousStep"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    Back
                                </button>
                            @endif
                        </div>

                        <div>
                            @if ($step < 4)
                                <button
                                    type="button"
                                    wire:click="nextStep"
                                    class="btn btn-primary"
                                >
                                    Next
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            @else
                                <button
                                    type="button"
                                    wire:click="book"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-75 cursor-not-allowed"
                                    class="btn btn-primary"
                                >
                                    <span wire:loading.remove wire:target="book">Confirm Booking</span>
                                    <span wire:loading wire:target="book" class="inline-flex items-center gap-2">
                                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                        Booking...
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
