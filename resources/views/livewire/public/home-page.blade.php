<div>
    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- SECTION 1: HERO                                            --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <section
        class="relative min-h-screen flex items-center hero-gradient overflow-hidden"
        x-data="{
            images: [
                'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1920&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1628009368231-7bb7cfcb0def?w=1920&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1548767797-d8c844163c4a?w=1920&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1601758174114-e711a56e0a1a?w=1920&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?w=1920&q=80&auto=format&fit=crop',
            ],
            active: 0,
            next: 1,
            transitioning: false,
            init() {
                setInterval(() => {
                    this.next = (this.active + 1) % this.images.length;
                    this.transitioning = true;
                    setTimeout(() => {
                        this.active = this.next;
                        this.transitioning = false;
                    }, 1000);
                }, 5000);
            }
        }"
    >
        {{-- Background image slideshow: two-layer cross-fade so an image is always visible --}}
        {{-- Base layer: always visible --}}
        <div
            class="absolute inset-0 bg-cover bg-center pointer-events-none opacity-25"
            :style="'background-image: url(' + images[active] + ')'"
        ></div>
        {{-- Transition layer: fades in over the base, then base updates --}}
        <div
            class="absolute inset-0 bg-cover bg-center pointer-events-none transition-opacity duration-1000"
            :style="'background-image: url(' + images[next] + ')'"
            :class="transitioning ? 'opacity-25' : 'opacity-0'"
        ></div>

        {{-- Decorative blobs --}}
        <div class="absolute top-1/4 left-0 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-0 w-80 h-80 bg-accent-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-700/10 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Paw print pattern overlay --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cg fill='%23ffffff'%3E%3Ccircle cx='15' cy='10' r='4'/%3E%3Ccircle cx='30' cy='6' r='3'/%3E%3Ccircle cx='45' cy='10' r='4'/%3E%3Ccircle cx='8' cy='22' r='3'/%3E%3Cellipse cx='30' cy='28' rx='12' ry='9'/%3E%3C/g%3E%3C/svg%3E\"); background-size: 60px 60px;"></div>

        {{-- Slide indicator dots --}}
        <div class="absolute bottom-20 left-1/2 -translate-x-1/2 flex gap-2 z-10">
            <template x-for="(img, i) in images" :key="'dot-' + i">
                <button
                    @click="active = i; next = i"
                    class="w-2 h-2 rounded-full transition-all duration-300"
                    :class="i === active ? 'bg-white w-6' : 'bg-white/40'"
                ></button>
            </template>
        </div>

        <div class="relative container-app py-24 md:py-32 w-full">
            <div class="max-w-4xl mx-auto text-center">
                {{-- Eyebrow --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-primary-200 text-sm font-semibold mb-8 backdrop-blur-sm border border-white/20">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                    Nigeria's Most Trusted Veterinary Service
                </div>

                {{-- Headline --}}
                <h1 class="text-4xl sm:text-5xl md:text-6xl xl:text-7xl font-bold text-white mb-6 leading-tight text-balance">
                    Expert Veterinary Care for
                    <span class="gradient-text block mt-1">Every Animal</span>
                </h1>

                {{-- Subtext --}}
                <p class="text-lg md:text-xl text-primary-100/90 mb-10 max-w-2xl mx-auto text-balance leading-relaxed">
                    Compassionate, professional veterinary services for pets and livestock across Nigeria. From routine check-ups to emergency care — we're here for every animal.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                    <a href="{{ route('appointments.book') }}" class="btn btn-primary btn-xl shadow-lg shadow-primary-900/40">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Book an Appointment
                    </a>
                    <a href="{{ route('services') }}" class="btn btn-xl border-2 border-white/40 text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        Explore Services
                    </a>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto">
                    @foreach([
                        ['2,500+', 'Happy Pets', '🐾'],
                        ['10+', 'Years Experience', '⭐'],
                        ['50+', 'Species Treated', '🦮'],
                        ['4.9★', 'Rating', '❤️'],
                    ] as $stat)
                    <div class="px-4 py-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 text-center">
                        <div class="text-2xl font-bold text-white">{{ $stat[0] }}</div>
                        <div class="text-xs text-primary-200 mt-0.5">{{ $stat[1] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Scroll indicator --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 text-white/40 text-xs animate-bounce">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- SECTION 2: SERVICES GRID                                   --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="container-app">
            {{-- Section header --}}
            <div class="text-center mb-14"
                x-data x-intersect.once="$el.classList.add('aos-show')"
                class="aos-init">
                <span class="section-eyebrow">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Our Services
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">Comprehensive Veterinary Solutions</h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto text-lg">From companion animals to large livestock — our team handles it all with expertise and compassion.</p>
            </div>

            {{-- Services grid --}}
            @php
                $serviceIcons = [
                    0 => ['bg' => 'bg-primary-100', 'text' => 'text-primary-700', 'path' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    1 => ['bg' => 'bg-accent-100', 'text' => 'text-accent-700', 'path' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    2 => ['bg' => 'bg-primary-100', 'text' => 'text-primary-700', 'path' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                    3 => ['bg' => 'bg-accent-100', 'text' => 'text-accent-700', 'path' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredServices as $index => $service)
                    @php $icon = $serviceIcons[$index % 4]; @endphp
                    <div
                        x-data x-intersect.once="$el.classList.add('aos-show')"
                        class="aos-init aos-delay-{{ $index + 1 }} group card p-6 hover:-translate-y-1 hover:shadow-elevated transition-all duration-300 cursor-pointer"
                    >
                        <div class="w-14 h-14 rounded-2xl {{ $icon['bg'] }} flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 {{ $icon['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon['path'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ $service->short_description ?? Str::limit($service->description, 100) }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary-600 hover:text-primary-700 group-hover:gap-2 transition-all">
                            Learn More
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @empty
                    @foreach(['Veterinary Consultations', 'Farm Management', 'Pet Surgery', 'Vaccination Services'] as $index => $name)
                        @php $icon = $serviceIcons[$index % 4]; @endphp
                        <div
                            x-data x-intersect.once="$el.classList.add('aos-show')"
                            class="aos-init aos-delay-{{ $index + 1 }} group card p-6 hover:-translate-y-1 hover:shadow-elevated transition-all duration-300"
                        >
                            <div class="w-14 h-14 rounded-2xl {{ $icon['bg'] }} flex items-center justify-center mb-5">
                                <svg class="w-7 h-7 {{ $icon['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon['path'] }}"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $name }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed mb-4">Professional {{ strtolower($name) }} for all breeds and species with our certified veterinary team.</p>
                            <a href="{{ route('services') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary-600 hover:text-primary-700 transition-all">
                                Learn More
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @endforeach
                @endforelse
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('services') }}" class="btn btn-secondary">
                    View All Services
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- SECTION 3: WHY CHOOSE US                                   --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-primary-50">
        <div class="container-app">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Left: image placeholder --}}
                <div
                    x-data x-intersect.once="$el.classList.add('aos-show')"
                    class="aos-init relative"
                >
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3] hero-gradient flex items-center justify-center">
                        {{-- Decorative circles --}}
                        <div class="absolute top-6 left-6 w-32 h-32 bg-white/10 rounded-full"></div>
                        <div class="absolute bottom-6 right-6 w-24 h-24 bg-accent-500/20 rounded-full"></div>

                        {{-- Paw icon --}}
                        <div class="relative z-10 text-center text-white">
                            <div class="w-24 h-24 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4.5 11.5A2.5 2.5 0 117 9a2.5 2.5 0 01-2.5 2.5zm6.5 0A2.5 2.5 0 1113.5 9 2.5 2.5 0 0111 11.5zm5.5 0A2.5 2.5 0 1119 9a2.5 2.5 0 01-2.5 2.5zM2 14.5A2.5 2.5 0 114.5 12 2.5 2.5 0 012 14.5zm9 4.5a5 5 0 01-5-5c0-2.761 2.239-3 5-3s5 .239 5 3a5 5 0 01-5 5z"/>
                                </svg>
                            </div>
                            <p class="text-xl font-bold">Raph Veterinary</p>
                            <p class="text-primary-200 text-sm mt-1">Caring for Every Animal</p>
                        </div>
                    </div>

                    {{-- Floating badge --}}
                    <div class="absolute -bottom-4 -right-4 md:-right-6 bg-white rounded-2xl p-4 shadow-elevated flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Certified Vets</p>
                            <p class="text-xs text-gray-500">Licensed & Experienced</p>
                        </div>
                    </div>
                </div>

                {{-- Right: content --}}
                <div
                    x-data x-intersect.once="$el.classList.add('aos-show')"
                    class="aos-init"
                >
                    <span class="section-eyebrow">Why Choose Us</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-6">Why Thousands Trust Raph Veterinary</h2>
                    <p class="text-gray-500 mb-8 text-lg leading-relaxed">We combine decades of veterinary expertise with modern medical technology and a genuine love for animals to deliver the highest standard of care.</p>

                    <div class="space-y-5">
                        @foreach([
                            ['Experienced & Certified Veterinarians', 'Our team holds certifications from top veterinary institutions with years of hands-on practice.'],
                            ['Modern Medical Equipment', 'State-of-the-art diagnostic and treatment equipment for accurate, efficient care.'],
                            ['Affordable & Transparent Pricing', 'Clear pricing with no hidden fees — quality care that fits your budget.'],
                            ['Compassionate, Patient-Centered Care', 'Every animal is treated with the same love and attention we\'d give our own pets.'],
                        ] as $index => $feature)
                        <div class="flex gap-4 items-start">
                            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $feature[0] }}</p>
                                <p class="text-sm text-gray-500 mt-0.5 leading-relaxed">{{ $feature[1] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('about') }}" class="btn btn-primary">
                            Meet Our Team
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- SECTION 4: PET MANAGEMENT PREVIEW                          --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="container-app">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Left: content --}}
                <div
                    x-data x-intersect.once="$el.classList.add('aos-show')"
                    class="aos-init"
                >
                    <span class="section-eyebrow">Pet Health Portal</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-6">Manage Your Pet's Health in One Place</h2>
                    <p class="text-gray-500 mb-8 text-lg leading-relaxed">Our digital pet health portal puts all your animal's health information at your fingertips, making veterinary care simpler and more effective.</p>

                    <div class="space-y-4 mb-8">
                        @foreach([
                            'Digital vaccination records',
                            'Appointment reminders',
                            'Medical history tracking',
                            'Multiple pet profiles',
                        ] as $feature)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-primary-500 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-gray-700 font-medium">{{ $feature }}</span>
                        </div>
                        @endforeach
                    </div>

                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Get Started Free
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>

                {{-- Right: simulated UI mockup --}}
                <div
                    x-data x-intersect.once="$el.classList.add('aos-show')"
                    class="aos-init"
                >
                    <div class="relative bg-gray-900 rounded-3xl p-4 shadow-elevated">
                        {{-- Browser chrome --}}
                        <div class="flex items-center gap-2 mb-4 px-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <div class="ml-4 flex-1 bg-gray-700 rounded-md h-6 flex items-center px-3">
                                <span class="text-gray-400 text-xs">app.raphvet.com/my/pets</span>
                            </div>
                        </div>

                        {{-- App UI --}}
                        <div class="bg-white rounded-2xl overflow-hidden">
                            {{-- Header --}}
                            <div class="bg-primary-800 px-4 py-3 flex items-center justify-between">
                                <span class="text-white font-semibold text-sm">My Pets</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-white/20"></div>
                                    <div class="w-6 h-6 rounded-full bg-white/20"></div>
                                </div>
                            </div>

                            {{-- Pet cards row --}}
                            <div class="p-4 grid grid-cols-2 gap-3">
                                @foreach([
                                    ['Buddy', 'Golden Retriever', 'bg-amber-100', 'text-amber-700', '🐕', 'Healthy'],
                                    ['Whiskers', 'Persian Cat', 'bg-purple-100', 'text-purple-700', '🐱', 'Vaccination Due'],
                                ] as $pet)
                                <div class="rounded-xl border border-gray-100 p-3 hover:border-primary-200 transition-colors">
                                    <div class="w-10 h-10 {{ $pet[2] }} rounded-full flex items-center justify-center text-lg mb-2">{{ $pet[4] }}</div>
                                    <p class="font-bold text-gray-900 text-sm">{{ $pet[0] }}</p>
                                    <p class="text-xs text-gray-500">{{ $pet[1] }}</p>
                                    <span class="inline-block mt-2 px-2 py-0.5 rounded-full text-xs font-medium {{ $pet[2] }} {{ $pet[3] }}">{{ $pet[5] }}</span>
                                </div>
                                @endforeach
                            </div>

                            {{-- Upcoming appointment --}}
                            <div class="px-4 pb-4">
                                <div class="bg-primary-50 rounded-xl p-3 border border-primary-100">
                                    <p class="text-xs font-semibold text-primary-700 mb-2 uppercase tracking-wide">Upcoming Appointment</p>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">Annual Checkup - Buddy</p>
                                            <p class="text-xs text-gray-500">Tomorrow, 10:00 AM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- SECTION 5: STATS / IMPACT                                  --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-primary-900 relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cg fill='%23ffffff'%3E%3Ccircle cx='15' cy='10' r='4'/%3E%3Ccircle cx='30' cy='6' r='3'/%3E%3Ccircle cx='45' cy='10' r='4'/%3E%3Ccircle cx='8' cy='22' r='3'/%3E%3Cellipse cx='30' cy='28' rx='12' ry='9'/%3E%3C/g%3E%3C/svg%3E\"); background-size: 60px 60px;"></div>

        <div class="container-app relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white">Our Impact in Numbers</h2>
                <p class="text-primary-300 mt-3 text-lg">A decade of dedicated veterinary service across Nigeria</p>
            </div>

            <div
                x-data="{
                    started: false,
                    counts: { animals: 0, farms: 0, team: 0, years: 0 },
                    targets: { animals: 5000, farms: 200, team: 25, years: 10 },
                    start() {
                        if (this.started) return;
                        this.started = true;
                        const duration = 2000;
                        const steps = 60;
                        const interval = duration / steps;
                        let step = 0;
                        const timer = setInterval(() => {
                            step++;
                            const progress = step / steps;
                            const ease = 1 - Math.pow(1 - progress, 3);
                            this.counts.animals = Math.floor(ease * this.targets.animals);
                            this.counts.farms = Math.floor(ease * this.targets.farms);
                            this.counts.team = Math.floor(ease * this.targets.team);
                            this.counts.years = Math.floor(ease * this.targets.years);
                            if (step >= steps) {
                                clearInterval(timer);
                                this.counts = {...this.targets};
                            }
                        }, interval);
                    }
                }"
                x-intersect.once="start()"
                class="grid grid-cols-2 lg:grid-cols-4 gap-8"
            >
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-white mb-2">
                        <span x-text="counts.animals.toLocaleString()">0</span>+
                    </div>
                    <div class="text-primary-300 text-lg">Animals Treated</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-white mb-2">
                        <span x-text="counts.farms">0</span>+
                    </div>
                    <div class="text-primary-300 text-lg">Farms Managed</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-white mb-2">
                        <span x-text="counts.team">0</span>+
                    </div>
                    <div class="text-primary-300 text-lg">Team Members</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-white mb-2">
                        <span x-text="counts.years">0</span>+
                    </div>
                    <div class="text-primary-300 text-lg">Years of Service</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- SECTION 6: TESTIMONIALS CAROUSEL                           --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-gray-50">
        <div class="container-app">
            <div class="text-center mb-12">
                <span class="section-eyebrow">Testimonials</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">What Pet Owners Say</h2>
                <p class="text-gray-500 mt-4 text-lg max-w-xl mx-auto">Real stories from satisfied pet owners and farm managers across Nigeria.</p>
            </div>

            @php
                $displayTestimonials = $testimonials->count() > 0 ? $testimonials : collect([
                    (object)['author_name' => 'Chidi Okafor', 'author_role' => 'Dog Owner', 'content' => 'The team at Raph Vet saved my dog\'s life. Amazing care and follow-up! I can\'t recommend them enough. Their professionalism and compassion made a difficult time so much easier.', 'rating' => 5, 'avatar' => null],
                    (object)['author_name' => 'Fatima Bello', 'author_role' => 'Farm Owner', 'content' => 'Their farm management service improved our livestock health by 40%. The vet visits are thorough and the advice practical. Best investment we\'ve made for our farm.', 'rating' => 5, 'avatar' => null],
                    (object)['author_name' => 'Emeka Eze', 'author_role' => 'Cat Owner', 'content' => 'I love the digital pet records feature. Makes vet visits so easy! Having all of Whiskers\' vaccination history in one place is incredibly convenient. Great service overall.', 'rating' => 5, 'avatar' => null],
                ]);
            @endphp

            {{-- Swiper carousel --}}
            <div class="swiper testimonials-swiper pb-12">
                <div class="swiper-wrapper">
                    @foreach($displayTestimonials as $testimonial)
                    <div class="swiper-slide h-auto">
                        <div class="card p-6 md:p-8 h-full flex flex-col">
                            {{-- Stars --}}
                            <div class="flex gap-1 mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= ($testimonial->rating ?? 5) ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>

                            {{-- Quote --}}
                            <blockquote class="text-gray-700 leading-relaxed flex-1 mb-6 text-balance">
                                "{{ $testimonial->content }}"
                            </blockquote>

                            {{-- Author --}}
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-400 to-accent-500 flex items-center justify-center text-white font-bold text-lg shrink-0">
                                    {{ mb_strtoupper(mb_substr($testimonial->author_name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $testimonial->author_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $testimonial->author_role }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-6"></div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- SECTION 7: CTA BANNER                                      --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <section class="py-20 hero-gradient relative overflow-hidden">
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-accent-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="container-app relative z-10 text-center">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 text-balance">
                Ready to Give Your Animals<br class="hidden sm:block"> the Best Care?
            </h2>
            <p class="text-primary-200 text-lg md:text-xl mb-10 max-w-xl mx-auto">
                Book an appointment today and experience the difference compassionate veterinary care makes.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('appointments.book') }}" class="btn btn-primary btn-xl shadow-lg shadow-primary-900/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Book Now
                </a>
                <a href="{{ route('contact') }}" class="btn btn-xl border-2 border-white/40 text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.testimonials-swiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                slidesPerView: 1,
                spaceBetween: 24,
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });
        });
    </script>
    @endpush
</div>
