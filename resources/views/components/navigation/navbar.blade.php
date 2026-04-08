<nav
    class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200"
    x-data="{
        mobileOpen: false,
        servicesOpen: false,
        cartCount: $wire ? 0 : 0,
    }"
>
    <div class="container-app">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img
                    src="https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775640828/raph_vet_logo_no_text_jrwdnu.svg"
                    alt="Raph Veterinary Services"
                    class="w-12 h-12 object-contain drop-shadow-[0_0_16px_rgba(34,197,94,1)] group-hover:drop-shadow-[0_0_28px_rgba(34,197,94,1)] transition-all duration-300"
                >
                <div>
                    <span class="text-lg font-bold text-gray-900 leading-tight block">Raph Veterinary</span>
                    <span class="text-xs text-primary-600 font-medium leading-tight block">Services</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>

                <!-- Services Dropdown -->
                <div class="relative" @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                    <button
                        class="nav-link flex items-center gap-1 {{ request()->routeIs('services*') ? 'active' : '' }}"
                        @click="servicesOpen = !servicesOpen"
                    >
                        Services
                        <svg class="w-4 h-4 transition-transform" :class="servicesOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="servicesOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 mt-1 w-72 card-elevated py-2 z-50"
                        @click.outside="servicesOpen = false"
                    >
                        <a href="{{ route('services.show', 'animal-treatment') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-primary-50 transition-colors">
                            <div class="w-9 h-9 bg-primary-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Animal Treatment</p>
                                <p class="text-xs text-gray-500">Diagnosis, surgery & medical care</p>
                            </div>
                        </a>
                        <a href="{{ route('services.show', 'veterinary-consultancy') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-primary-50 transition-colors">
                            <div class="w-9 h-9 bg-accent-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-accent-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Veterinary Consultancy</p>
                                <p class="text-xs text-gray-500">Expert advice for animal health</p>
                            </div>
                        </a>
                        <a href="{{ route('services.show', 'farm-management') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-primary-50 transition-colors">
                            <div class="w-9 h-9 bg-yellow-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Farm Management</p>
                                <p class="text-xs text-gray-500">Livestock health & productivity</p>
                            </div>
                        </a>
                        <a href="{{ route('services.show', 'animal-feed') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-primary-50 transition-colors">
                            <div class="w-9 h-9 bg-orange-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Animal Feed</p>
                                <p class="text-xs text-gray-500">Production, sales & supply</p>
                            </div>
                        </a>
                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <a href="{{ route('services') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-primary-700 hover:bg-primary-50 transition-colors">
                                View all services
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('shop') }}" class="nav-link {{ request()->routeIs('shop*') ? 'active' : '' }}">Shop</a>
                <a href="{{ route('faq') }}" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </div>

            <!-- Desktop Right Actions -->
            <div class="hidden lg:flex items-center gap-3">
                <!-- Cart -->
                <a href="{{ route('cart') }}" class="relative btn btn-ghost btn-sm" title="Cart">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-4H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </a>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 btn btn-ghost btn-sm">
                            <div class="w-7 h-7 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-xs">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-gray-700 max-w-24 truncate">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div
                            x-show="open"
                            x-transition
                            @click.outside="open = false"
                            class="absolute right-0 mt-1 w-52 card-elevated py-2 z-50"
                        >
                            <a href="{{ route('my.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                My Dashboard
                            </a>
                            <a href="{{ route('my.pets') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                My Pets
                            </a>
                            <a href="{{ route('my.appointments') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Appointments
                            </a>
                            <a href="{{ route('my.orders') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                My Orders
                            </a>
                            @if(auth()->user()->hasRole('admin'))
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-primary-700 font-medium hover:bg-primary-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Admin Panel
                                </a>
                            @endif
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Log in</a>
                    <a href="{{ route('appointments.book') }}" class="btn btn-primary btn-sm">Book Appointment</a>
                @endauth
            </div>

            <!-- Mobile menu toggle -->
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-t border-gray-200 bg-white"
    >
        <div class="container-app py-4 space-y-1">
            <a href="{{ route('home') }}" class="block nav-link">Home</a>
            <a href="{{ route('about') }}" class="block nav-link">About</a>

            <!-- Services accordion -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between nav-link">
                    Services
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="ml-4 mt-1 space-y-1 border-l-2 border-primary-100 pl-4">
                    <a href="{{ route('services.show', 'animal-treatment') }}" class="block text-sm py-1.5 text-gray-600 hover:text-primary-700">Animal Treatment</a>
                    <a href="{{ route('services.show', 'veterinary-consultancy') }}" class="block text-sm py-1.5 text-gray-600 hover:text-primary-700">Veterinary Consultancy</a>
                    <a href="{{ route('services.show', 'farm-management') }}" class="block text-sm py-1.5 text-gray-600 hover:text-primary-700">Farm Management</a>
                    <a href="{{ route('services.show', 'animal-feed') }}" class="block text-sm py-1.5 text-gray-600 hover:text-primary-700">Animal Feed</a>
                    <a href="{{ route('services') }}" class="block text-sm py-1.5 font-semibold text-primary-700">All Services →</a>
                </div>
            </div>

            <a href="{{ route('shop') }}" class="block nav-link">Shop</a>
            <a href="{{ route('faq') }}" class="block nav-link">FAQ</a>
            <a href="{{ route('contact') }}" class="block nav-link">Contact</a>

            <div class="pt-3 border-t border-gray-200 flex flex-col gap-2">
                @auth
                    <a href="{{ route('my.dashboard') }}" class="btn btn-secondary w-full justify-center">My Account</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-ghost w-full text-red-600 justify-center">Sign Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary w-full justify-center">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary w-full justify-center">Book Appointment</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
