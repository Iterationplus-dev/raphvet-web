<div>
    {{-- Hero --}}
    <x-ui.page-hero>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-primary-200 text-sm font-semibold mb-6 backdrop-blur-sm border border-white/20">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            What We Offer
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5">Our Veterinary Services</h1>
        <p class="text-primary-100/90 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            Comprehensive care for every animal — from beloved household pets to large farm livestock. Explore our full range of veterinary services.
        </p>
    </x-ui.page-hero>

    {{-- Services grid --}}
    <section class="py-16 md:py-20 bg-white">
        <div class="container-app">
            @php
                $iconPaths = [
                    'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
                    'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                ];
                $iconColors = [
                    ['bg-primary-100', 'text-primary-700'],
                    ['bg-accent-100', 'text-accent-700'],
                    ['bg-emerald-100', 'text-emerald-700'],
                    ['bg-sky-100', 'text-sky-700'],
                    ['bg-violet-100', 'text-violet-700'],
                    ['bg-amber-100', 'text-amber-700'],
                ];
            @endphp

            @if($services->isEmpty())
                <div class="text-center py-20">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No services listed yet</h3>
                    <p class="text-gray-500">Please check back soon — we're adding our services shortly.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($services as $index => $service)
                        @php
                            $color = $iconColors[$index % count($iconColors)];
                            $iconPath = $iconPaths[$index % count($iconPaths)];
                        @endphp
                        <a
                            href="{{ route('services.show', $service->slug) }}"
                            x-data x-intersect.once="$el.classList.add('aos-show')"
                            class="aos-init group card p-6 hover:-translate-y-1 hover:shadow-elevated transition-all duration-300 flex flex-col"
                        >
                            <div class="w-14 h-14 rounded-2xl {{ $color[0] }} flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 {{ $color[1] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-primary-700 transition-colors">{{ $service->name }}</h2>
                            @if($service->short_description)
                                <p class="text-sm text-gray-500 leading-relaxed flex-1 mb-4">{{ $service->short_description }}</p>
                            @endif
                            <div class="inline-flex items-center gap-1 text-sm font-semibold text-primary-600 group-hover:gap-2 transition-all mt-auto">
                                Learn More
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 bg-primary-50">
        <div class="container-app text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Need a Service Not Listed?</h2>
            <p class="text-gray-500 mb-8 text-lg max-w-xl mx-auto">Contact us directly — our team handles a wide range of veterinary needs beyond what's listed here.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('appointments.book') }}" class="btn btn-primary btn-lg">Book an Appointment</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary btn-lg">Contact Us</a>
            </div>
        </div>
    </section>
</div>
