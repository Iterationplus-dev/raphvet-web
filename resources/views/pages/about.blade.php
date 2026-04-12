<x-layouts.app
    title="About Us"
    description="Learn about Raph Veterinary Services — our mission, team, and commitment to expert veterinary care for pets and livestock across Nigeria."
>

    <!-- Hero -->
    <x-ui.page-hero>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-primary-200 text-sm font-semibold mb-6 backdrop-blur-sm border border-white/20">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
            Our Story
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5">About Raph Vet. Services</h1>
        <p class="text-primary-100/90 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">Dedicated to the health and wellbeing of animals across Nigeria — providing expert veterinary care you can trust.</p>
    </x-ui.page-hero>

    <!-- Our Story -->
    <section class="py-20 bg-white">
        <div class="container-app">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block text-xs font-bold uppercase tracking-widest text-primary-600 mb-3">Our Story</span>
                    <h2 class="text-3xl font-bold text-gray-900 mb-5">Caring for Animals Since Day One</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Raph Veterinary Services was founded with a simple mission: to provide every animal — whether a beloved pet or a working farm animal — with the highest standard of veterinary care. We believe that animal health is inseparable from human wellbeing and agricultural productivity.
                    </p>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Our team of qualified veterinarians brings years of experience in clinical practice, farm management, and animal nutrition to serve our clients across Nigeria. We combine modern diagnostic tools with compassionate care to deliver outcomes that matter.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        From routine check-ups to complex surgeries, farm herd management to premium feed supply — we are your complete veterinary partner.
                    </p>
                </div>
                <div class="bg-primary-50 rounded-2xl p-10 flex items-center justify-center min-h-64">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <p class="text-primary-700 font-semibold text-lg">Raph Veterinary Services</p>
                        <p class="text-primary-500 text-sm mt-1">Your Trusted Animal Health Partner</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-gray-50">
        <div class="container-app">
            <div class="text-center mb-12">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-primary-600 mb-3">Why Choose Us</span>
                <h2 class="text-3xl font-bold text-gray-900">What Sets Us Apart</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Qualified & Experienced</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Our vets are fully licensed professionals with years of hands-on clinical and field experience across a wide range of species.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Prompt & Reliable</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">We understand that animal emergencies don't wait. Our team responds quickly and keeps you informed every step of the way.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Comprehensive Services</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">From individual pets to large-scale farm operations, we offer a full suite of veterinary services under one roof.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-20 bg-white">
        <div class="container-app">
            <div class="text-center mb-12">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-primary-600 mb-3">Our Team</span>
                <h2 class="text-3xl font-bold text-gray-900">Meet the Vets</h2>
                <p class="text-gray-500 mt-3">Our team of dedicated professionals is here to care for your animals.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ([['name' => 'Dr. Raphael O.', 'role' => 'Chief Veterinarian'], ['name' => 'Dr. Chidinma S.', 'role' => 'Vet. Specialist'], ['name' => 'Dr. Ikeokwo May N.', 'role' => 'Vet. Specialist']] as $member)
                    <div class="bg-gray-50 rounded-2xl p-8 text-center border border-gray-100">
                        <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-primary-600">{{ substr($member['name'], 4, 1) }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $member['name'] }}</h3>
                        <p class="text-sm text-primary-600 font-medium mt-1">{{ $member['role'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">Committed to providing compassionate, expert care for every animal we see.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-primary-600 text-white">
        <div class="container-app text-center">
            <h2 class="text-2xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-primary-100 mb-8">Book an appointment or get in touch with our team today.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('appointments.book') }}" class="btn btn-white">Book Appointment</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-white">Contact Us</a>
            </div>
        </div>
    </section>

</x-layouts.app>
