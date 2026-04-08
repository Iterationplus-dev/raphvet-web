<div>
    {{-- ── Hero ──────────────────────────────────────────────────────────── --}}
    <x-ui.page-hero>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-primary-200 text-sm font-semibold mb-6 backdrop-blur-sm border border-white/20">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/></svg>
            We're Hiring
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5">Join Our Team</h1>
        <p class="text-primary-100/90 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            Help us deliver exceptional veterinary care across Nigeria. We're looking for passionate, skilled individuals to grow with us.
        </p>
    </x-ui.page-hero>

    @if ($submitted)
        {{-- ── Success ──────────────────────────────────────────────────────── --}}
        <section class="py-24 bg-white">
            <div class="container-app text-center max-w-lg mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary-100 mb-6">
                    <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Application Received!</h2>
                <p class="text-gray-500 mb-8">Thank you for your interest in joining Raph Veterinary Services. Our HR team will review your application and reach out to you if your profile matches our current needs.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
            </div>
        </section>
    @else

        {{-- ── Why Join Us ──────────────────────────────────────────────────── --}}
        <section class="py-16 bg-gray-50">
            <div class="container-app">
                <div class="text-center mb-12">
                    <span class="section-eyebrow">Why Raph Vet</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">A Great Place to Build Your Career</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach([
                        ['icon' => '🌱', 'title' => 'Grow & Learn', 'desc' => 'Ongoing training, CPD support, and clear career progression pathways.'],
                        ['icon' => '🤝', 'title' => 'Collaborative Team', 'desc' => 'Work alongside experienced vets, technicians, and admin professionals.'],
                        ['icon' => '💰', 'title' => 'Competitive Pay', 'desc' => 'Competitive salaries, health benefits, and performance-based bonuses.'],
                        ['icon' => '🐾', 'title' => 'Meaningful Work', 'desc' => 'Make a real difference in the lives of animals and their owners every day.'],
                    ] as $benefit)
                        <div class="card p-6 text-center hover:-translate-y-1 transition-transform duration-300">
                            <div class="text-4xl mb-4">{{ $benefit['icon'] }}</div>
                            <h3 class="font-bold text-gray-900 mb-2">{{ $benefit['title'] }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $benefit['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ── Open Positions ───────────────────────────────────────────────── --}}
        <section class="py-16 bg-white">
            <div class="container-app">
                <div class="text-center mb-12">
                    <span class="section-eyebrow">Open Roles</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">Current Openings</h2>
                </div>
                <div class="max-w-3xl mx-auto space-y-4">
                    @foreach([
                        ['title' => 'Veterinary Doctor (MBBS/BVM)', 'type' => 'Full-time', 'location' => 'Lagos & Abuja', 'dept' => 'Clinical'],
                        ['title' => 'Veterinary Nurse / Technician', 'type' => 'Full-time', 'location' => 'Lagos', 'dept' => 'Clinical'],
                        ['title' => 'Farm Animal Specialist', 'type' => 'Full-time', 'location' => 'Field (South-West)', 'dept' => 'Livestock'],
                        ['title' => 'Pharmacy & Drug Inventory Officer', 'type' => 'Full-time', 'location' => 'Lagos', 'dept' => 'Pharmacy'],
                        ['title' => 'Customer Relations Officer', 'type' => 'Full-time', 'location' => 'Lagos', 'dept' => 'Operations'],
                        ['title' => 'General Applications', 'type' => 'Open', 'location' => 'Various', 'dept' => 'All Departments'],
                    ] as $position)
                        <div class="flex items-center justify-between gap-4 p-5 rounded-xl border border-gray-200 hover:border-primary-300 hover:bg-primary-50/30 transition-all group">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $position['title'] }}</p>
                                    <div class="flex flex-wrap gap-2 mt-1.5">
                                        <span class="badge badge-green">{{ $position['dept'] }}</span>
                                        <span class="badge badge-gray">{{ $position['type'] }}</span>
                                        <span class="text-xs text-gray-400 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $position['location'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <a href="#apply" class="btn btn-secondary btn-sm shrink-0 group-hover:bg-primary-600 group-hover:text-white group-hover:border-primary-600 transition-all">Apply</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ── Application Form ─────────────────────────────────────────────── --}}
        <section id="apply" class="py-16 md:py-20 bg-gray-50">
            <div class="container-app">
                <div class="max-w-2xl mx-auto">
                    <div class="text-center mb-10">
                        <span class="section-eyebrow">Apply Now</span>
                        <h2 class="text-3xl font-bold text-gray-900 mt-3">Submit Your Application</h2>
                        <p class="text-gray-500 mt-3">Fill in the form below and we'll be in touch. Fields marked <span class="text-red-500">*</span> are required.</p>
                    </div>

                    <form wire:submit="submit" class="card p-8 space-y-6">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">Full Name <span class="required">*</span></label>
                                <input type="text" wire:model="fullName" class="form-input @error('fullName') is-invalid @enderror" placeholder="Jane Doe">
                                @error('fullName') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Phone Number <span class="required">*</span></label>
                                <input type="tel" wire:model="phone" class="form-input @error('phone') is-invalid @enderror" placeholder="+234 800 000 0000">
                                @error('phone') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email" wire:model="email" class="form-input @error('email') is-invalid @enderror" placeholder="jane@example.com">
                            @error('email') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">Position Applying For <span class="required">*</span></label>
                                <input type="text" wire:model="positionApplied" class="form-input @error('positionApplied') is-invalid @enderror" placeholder="e.g. Veterinary Doctor">
                                @error('positionApplied') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Years of Experience <span class="required">*</span></label>
                                <select wire:model="experienceYears" class="form-select @error('experienceYears') is-invalid @enderror">
                                    <option value="">Select...</option>
                                    <option value="0-1">Less than 1 year</option>
                                    <option value="1-3">1 – 3 years</option>
                                    <option value="3-5">3 – 5 years</option>
                                    <option value="5-10">5 – 10 years</option>
                                    <option value="10+">10+ years</option>
                                </select>
                                @error('experienceYears') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Cover Letter <span class="required">*</span></label>
                            <p class="form-hint mb-2">Tell us why you're the right fit and what value you'll bring to our team.</p>
                            <textarea wire:model="coverLetter" rows="6" maxlength="2000" class="form-input @error('coverLetter') is-invalid @enderror" placeholder="Dear Hiring Team, I am excited to apply for..."></textarea>
                            @error('coverLetter') <p class="form-error">{{ $message }}</p> @enderror
                            <p class="form-hint text-right">{{ strlen($coverLetter) }} / 2000</p>
                        </div>

                        <div>
                            <label class="form-label">Upload CV / Resume <span class="text-gray-400 font-normal">(optional — PDF, DOC, or DOCX, max 5 MB)</span></label>
                            <div
                                x-data="{ dragging: false }"
                                @dragover.prevent="dragging = true"
                                @dragleave.prevent="dragging = false"
                                @drop.prevent="dragging = false"
                                class="mt-1 flex flex-col items-center justify-center gap-2 px-6 py-8 border-2 border-dashed rounded-xl transition-colors"
                                :class="dragging ? 'border-primary-400 bg-primary-50' : 'border-gray-300 hover:border-primary-300'"
                            >
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                @if ($cv)
                                    <p class="text-sm text-primary-700 font-semibold">{{ $cv->getClientOriginalName() }}</p>
                                    <p class="text-xs text-gray-400">{{ round($cv->getSize() / 1024) }} KB</p>
                                @else
                                    <p class="text-sm text-gray-500">Drag & drop or <label class="text-primary-600 font-semibold cursor-pointer hover:underline"><input type="file" wire:model="cv" accept=".pdf,.doc,.docx" class="sr-only">browse to upload</label></p>
                                @endif
                                @error('cv') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="form-label">LinkedIn Profile URL <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="url" wire:model="linkedinUrl" class="form-input @error('linkedinUrl') is-invalid @enderror" placeholder="https://linkedin.com/in/your-name">
                            @error('linkedinUrl') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-2">
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-75 cursor-not-allowed"
                                class="btn btn-primary btn-lg w-full justify-center"
                            >
                                <span wire:loading.remove wire:target="submit" class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    Submit Application
                                </span>
                                <span wire:loading wire:target="submit" class="inline-flex items-center gap-2">
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                    Submitting...
                                </span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>

    @endif
</div>
