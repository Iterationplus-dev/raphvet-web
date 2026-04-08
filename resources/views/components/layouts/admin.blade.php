<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} — {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full antialiased bg-gray-50">

<div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- Sidebar backdrop (mobile) -->
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-20 bg-black/50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 flex flex-col w-64 bg-white border-r border-gray-200 transition-transform duration-300 lg:static lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <!-- Logo -->
        <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-200">
            <img
                src="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg"
                alt="Raph Veterinary Services"
                class="w-9 h-9 object-contain shrink-0"
            >
            <div>
                <p class="text-sm font-bold text-gray-900">Raph Vet Admin</p>
                <p class="text-xs text-gray-500">Management Panel</p>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-1">
            @include('components.navigation.admin-sidebar')
        </nav>

        <!-- User -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-sm">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-gray-600" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- Top bar -->
        <header class="flex items-center gap-4 px-6 py-4 bg-white border-b border-gray-200 shrink-0">
            <!-- Mobile menu toggle -->
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Page title -->
            <div class="flex-1">
                <h1 class="text-lg font-semibold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
                @if(isset($breadcrumb))
                    <p class="text-xs text-gray-500 mt-0.5">{{ $breadcrumb }}</p>
                @endif
            </div>

            <!-- Header actions -->
            <div class="flex items-center gap-3">
                @if(isset($headerActions))
                    {{ $headerActions }}
                @endif
                <a href="{{ route('home') }}" target="_blank" class="btn btn-ghost btn-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Site
                </a>
            </div>
        </header>

        <!-- Flash messages -->
        @if (session('success') || session('error'))
            <div class="px-6 pt-4" x-data="{ show: true }" x-show="show" x-transition>
                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                        <span>{{ session('success') }}</span>
                        <button class="ml-auto" @click="show = false"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error mb-4">
                        <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
                        <span>{{ session('error') }}</span>
                        <button class="ml-auto" @click="show = false"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                @endif
            </div>
        @endif

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
@stack('scripts')
</body>
</html>
