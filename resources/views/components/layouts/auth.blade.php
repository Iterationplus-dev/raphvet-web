<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Account' }} — {{ config('app.name', 'Raph Veterinary Services') }}</title>
    <link rel="icon" type="image/svg+xml" href="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full antialiased bg-gradient-to-br from-primary-50 via-white to-accent-50">

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

        <!-- Logo -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <img
                    src="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg"
                    alt="Raph Veterinary Services"
                    class="w-12 h-12 object-contain"
                >
                <div class="text-left">
                    <div class="text-xl font-bold text-gray-900 leading-tight">Raph Vet</div>
                    <div class="text-xs text-primary-600 font-medium">Veterinary Services</div>
                </div>
            </a>
        </div>

        <!-- Card -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="card p-8 sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>

        <!-- Back to home -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-primary-600 transition-colors">
                ← Back to home
            </a>
        </div>
    </div>

    @livewireScripts
</body>
</html>
