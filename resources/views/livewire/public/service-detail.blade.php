<div>
    {{-- JSON-LD: Service Schema --}}
    @push('scripts')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "serviceType": "{{ $service->name }}",
        "name": "{{ $service->name }}",
        "description": "{{ $service->meta_description ?: $service->short_description ?: $service->name }}",
        "url": "{{ route('services.show', $service->slug) }}",
        "provider": {
            "@type": "VeterinaryCare",
            "name": "Raph Veterinary Services",
            "url": "{{ config('app.url') }}"
        },
        "areaServed": {
            "@type": "Country",
            "name": "Nigeria"
        },
        "availableChannel": {
            "@type": "ServiceChannel",
            "serviceUrl": "{{ route('appointments.book') }}"
        }
    }
    </script>
    @endpush

    {{-- Hero --}}
    <x-ui.page-hero :centered="false">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-primary-300 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('services') }}" class="hover:text-white transition-colors">Services</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">{{ $service->name }}</span>
        </nav>

        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5">{{ $service->name }}</h1>
            @if($service->short_description)
                <p class="text-primary-100/90 text-lg md:text-xl leading-relaxed">{{ $service->short_description }}</p>
            @endif
        </div>
    </x-ui.page-hero>

    {{-- Service content --}}
    <section class="py-16 md:py-20 bg-white">
        <div class="container-app">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                {{-- Main content --}}
                <div class="lg:col-span-2">
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        @if($service->description)
                            {!! nl2br(e($service->description)) !!}
                        @else
                            <p>Detailed information about {{ $service->name }} coming soon. Please contact us for more details about this service.</p>
                        @endif
                    </div>

                    {{-- Key features --}}
                    <div class="mt-12 p-6 md:p-8 bg-primary-50 rounded-2xl border border-primary-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-5">What's Included</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach([
                                'Initial consultation & assessment',
                                'Full physical examination',
                                'Diagnostic testing if required',
                                'Treatment & medication',
                                'Follow-up care plan',
                                'Digital health records update',
                            ] as $feature)
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 rounded-full bg-primary-500 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    {{-- Book CTA --}}
                    <div class="card p-6 border-2 border-primary-200 bg-primary-50 sticky top-6">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Book This Service</h3>
                        <p class="text-sm text-gray-500 mb-5">Schedule an appointment for {{ $service->name }} with our expert veterinary team.</p>
                        <a href="{{ route('appointments.book') }}" class="btn btn-primary w-full justify-center">
                            Book Appointment
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-secondary w-full justify-center mt-3">
                            Ask a Question
                        </a>
                    </div>

                    {{-- Contact info --}}
                    <div class="card p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Need More Information?</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-primary-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>Call us for a quick answer</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-primary-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>Send us an email</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related services --}}
    @if($relatedServices->isNotEmpty())
    <section class="py-16 bg-gray-50">
        <div class="container-app">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">Other Services You May Need</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($relatedServices as $index => $related)
                <a
                    href="{{ route('services.show', $related->slug) }}"
                    class="group card p-6 hover:-translate-y-1 hover:shadow-elevated transition-all duration-300 flex flex-col"
                >
                    <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-primary-700 transition-colors">{{ $related->name }}</h3>
                    @if($related->short_description)
                        <p class="text-sm text-gray-500 leading-relaxed flex-1">{{ Str::limit($related->short_description, 90) }}</p>
                    @endif
                    <div class="inline-flex items-center gap-1 text-sm font-semibold text-primary-600 mt-4 group-hover:gap-2 transition-all">
                        Learn More <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Banner --}}
    <section class="py-16 hero-gradient">
        <div class="container-app text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-primary-200 mb-8 text-lg max-w-xl mx-auto">Book your appointment for {{ $service->name }} today and experience expert veterinary care.</p>
            <a href="{{ route('appointments.book') }}" class="btn btn-primary btn-xl shadow-lg shadow-primary-900/40">
                Book an Appointment
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </section>
</div>
