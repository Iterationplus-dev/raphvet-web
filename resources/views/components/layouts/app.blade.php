<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName    = config('app.name', 'Raph Veterinary Services');
        $pageTitle   = $title ?? $siteName;
        $fullTitle   = ($title ?? false) ? "$pageTitle | $siteName" : $siteName;
        $pageDesc    = $description ?? 'Expert veterinary care for pets and livestock in Nigeria. Book appointments, manage pet health records, and shop premium veterinary products online.';
        $pageImage   = $ogImage ?? asset('images/og-image.jpg');
        $canonicalUrl = url()->current();
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $pageDesc }}">
    <meta name="keywords" content="{{ $keywords ?? 'veterinary Nigeria, vet clinic Nigeria, pet care Nigeria, animal hospital, livestock treatment, dog vet Lagos, cat vet Abuja, pet health records, farm animal care, veterinary products, pet shop Nigeria, animal doctor, poultry vet, cattle treatment, appointment booking vet' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <!-- Open Graph -->
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDesc }}">
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:image:alt" content="{{ $pageTitle }}">
    <meta property="og:locale" content="en_NG">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDesc }}">
    <meta name="twitter:image" content="{{ $pageImage }}">

    <!-- Per-page meta overrides pushed from child views -->
    @stack('meta')

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg">
    <link rel="shortcut icon" href="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg">
    <link rel="apple-touch-icon" href="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg">

    <!-- JSON-LD: Veterinary Practice -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "VeterinaryCare",
        "name": "Raph Veterinary Services",
        "description": "Expert veterinary care for pets and livestock across Nigeria. We offer clinical consultations, farm management, vaccinations, surgery, and premium pet products.",
        "url": "{{ config('app.url') }}",
        "logo": "https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg",
        "image": "{{ asset('images/og-image.jpg') }}",
        "telephone": "+2349127128206",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+2349127128206",
            "contactType": "customer service",
            "availableLanguage": "English"
        },
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "NG"
        },
        "areaServed": {
            "@type": "Country",
            "name": "Nigeria"
        },
        "sameAs": [],
        "priceRange": "₦₦",
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
            "opens": "08:00",
            "closes": "18:00"
        }
    }
    </script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full antialiased">

    <!-- Cookie Consent -->
    @include('cookie-consent::index')

    <!-- Navigation -->
    @include('components.navigation.navbar')

    <!-- Flash Messages -->
    @if (session('success') || session('error') || session('warning') || session('info'))
        <div class="container-app pt-4" x-data="{ show: true }" x-show="show" x-transition>
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                    <span>{{ session('success') }}</span>
                    <button class="ml-auto" @click="show = false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error mb-4">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
                    <span>{{ session('error') }}</span>
                    <button class="ml-auto" @click="show = false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
        </div>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('components.navigation.footer')

    <!-- WhatsApp Floating Button -->
    @php $whatsappNumber = config('services.whatsapp.number', '2349127128206'); @endphp
    <a
        href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello! I would like to enquire about your veterinary services.') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] text-white shadow-elevated hover:scale-110 transition-transform"
        title="Chat with us on WhatsApp"
        x-data
        x-intersect.once="$el.classList.add('animate-bounce-once')"
    >
        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    @livewireScripts
    @stack('scripts')
</body>
</html>
