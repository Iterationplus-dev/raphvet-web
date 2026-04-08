<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'My Account' }} — {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full antialiased bg-gray-50">

<div class="min-h-screen flex flex-col">

    <!-- Top Nav -->
    @include('components.navigation.navbar')

    <div class="flex-1 flex">

        <!-- Sidebar (desktop) -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-white border-r border-gray-200 py-6">
            <div class="px-4 mb-6">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">My Account</p>
                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                @include('components.navigation.customer-sidebar')
            </nav>
        </aside>

        <!-- Main -->
        <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8">

            <!-- Mobile breadcrumb nav -->
            <div class="lg:hidden mb-6">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 -mx-4 px-4" x-data>
                    <a href="{{ route('my.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">Dashboard</a>
                    @if(isset($breadcrumb))
                        <span class="text-gray-400">/</span>
                        <span class="text-sm font-medium text-gray-900 whitespace-nowrap">{{ $breadcrumb }}</span>
                    @endif
                </div>
            </div>

            @if(isset($title))
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
                    @if(isset($headerActions))
                        <div class="flex items-center gap-3">{{ $headerActions }}</div>
                    @endif
                </div>
            @endif

            <!-- Flash messages -->
            @if (session('success') || session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition class="mb-6">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            <span>{{ session('success') }}</span>
                            <button class="ml-auto" @click="show = false"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error">
                            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
                            <span>{{ session('error') }}</span>
                            <button class="ml-auto" @click="show = false"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>
                    @endif
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
@stack('scripts')
</body>
</html>
