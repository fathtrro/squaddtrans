<nav x-data="{ open: false, userMenu: false, scrolled: false }"
    @scroll.window="scrolled = window.pageYOffset > 20"
    :class="scrolled ? 'bg-white shadow-sm' : 'bg-white'"
    class="fixed w-full top-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo Minimalis -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.jpeg') }}"
                    class="h-9 w-9 rounded-lg object-cover"
                    alt="Logo">
                <span class="text-xl font-semibold text-gray-900">
                    SQUAD<span class="text-yellow-500">TRANS</span>
                </span>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                    Beranda
                </a>
                <a href="/cars" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                    Unit Armada
                </a>
                @auth
                    <a href="{{ route('bookings.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                        Riwayat Booking
                    </a>
                @endauth
                <a href="/contact" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                    Tentang
                </a>
            </div>

            <!-- Right Section -->
            <div class="hidden md:flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium transition-colors">
                        Daftar
                    </a>
                @endguest

                @auth
                    <div class="relative" x-data="{ openProfile: false }">
                        <button @click="openProfile = !openProfile"
                            class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=eab308&color=fff"
                                class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <svg :class="openProfile ? 'rotate-180' : ''"
                                class="w-4 h-4 text-gray-400 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="openProfile" @click.outside="openProfile = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100">

                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs text-gray-500">Signed in as</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile Saya
                            </a>

                            <a href="{{ route('bookings.index') }}"
                                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5h6M9 9h6M9 13h6M5 5h.01M5 9h.01M5 13h.01" />
                                </svg>
                                Riwayat Booking
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="open = !open" class="p-2 text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" :class="open ? 'hidden' : 'block'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="w-6 h-6" :class="open ? 'block' : 'hidden'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden border-t border-gray-100 bg-white">

        <div class="px-6 py-4 space-y-1">
            <a href="/" class="block px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                Beranda
            </a>
            <a href="/cars" class="block px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                Unit Armada
            </a>
            @auth
                <a href="{{ route('bookings.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                    Riwayat Booking
                </a>
            @endauth
            <a href="/contact" class="block px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                Tentang
            </a>

            @guest
                <div class="pt-4 space-y-2">
                    <a href="{{ route('login') }}"
                        class="block text-center px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-lg hover:border-gray-300 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="block text-center px-4 py-2 text-sm bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition-colors">
                        Daftar
                    </a>
                </div>
            @endguest

            @auth
                <div class="pt-4 border-t border-gray-100 mt-4">
                    <div class="flex items-center gap-3 px-3 py-2 mb-2">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=eab308&color=fff"
                            class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-xs text-gray-500">Login sebagai</p>
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                        class="block px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                        Profile Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>

</nav>

<!-- Spacer -->
<div class="h-16"></div>
