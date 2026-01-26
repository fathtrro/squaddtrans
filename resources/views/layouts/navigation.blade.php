<nav x-data="{ open: false, userMenu: false, scrolled: false }"
     @scroll.window="scrolled = window.pageYOffset > 20"
     :class="scrolled ? 'bg-white/95 backdrop-blur-lg shadow-lg' : 'bg-white'"
     class="fixed w-full top-0 z-50 border-b border-gray-100 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo dengan animasi -->
            <div class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-yellow-400 rounded-lg blur-md opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                    <img src="{{ asset('images/logo.jpeg') }}"
                         class="h-12 w-12 rounded-lg object-cover relative transform group-hover:scale-105 transition-transform duration-300 shadow-md"
                         alt="Logo">
                </div>

                <span class="text-2xl font-bold tracking-tight">
                    <span class="text-gray-900 bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text">SQUAD</span>
                    <span class="text-yellow-500 bg-gradient-to-r from-yellow-400 to-yellow-600 bg-clip-text">TRANS</span>
                </span>
            </div>

            <!-- Menu Desktop dengan hover effect -->
            <div class="hidden md:flex items-center space-x-1 font-medium">
                <a href="/" class="relative px-4 py-2 text-gray-700 hover:text-yellow-500 transition-colors duration-200 group">
                    <span class="relative z-10">Beranda</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-yellow-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/layanan" class="relative px-4 py-2 text-gray-700 hover:text-yellow-500 transition-colors duration-200 group">
                    <span class="relative z-10">Layanan</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-yellow-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/cars" class="relative px-4 py-2 text-gray-700 hover:text-yellow-500 transition-colors duration-200 group">
                    <span class="relative z-10">Unit Armada</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-yellow-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/lokasi" class="relative px-4 py-2 text-gray-700 hover:text-yellow-500 transition-colors duration-200 group">
                    <span class="relative z-10">Lokasi</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-yellow-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/bantuan" class="relative px-4 py-2 text-gray-700 hover:text-yellow-500 transition-colors duration-200 group">
                    <span class="relative z-10">Bantuan</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-yellow-500 group-hover:w-full transition-all duration-300"></span>
                </a>
            </div>

            <!-- Right Section dengan button modern -->
            <div class="hidden md:flex items-center space-x-3">

                {{-- ✅ JIKA BELUM LOGIN --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="px-6 py-2.5 rounded-xl border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-300 font-medium transform hover:scale-105">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}"
                       class="relative px-6 py-2.5 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 overflow-hidden group">
                        <span class="relative z-10">Daftar</span>
                        <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                    </a>
                @endguest

                {{-- ✅ JIKA SUDAH LOGIN --}}
                @auth
                    <div class="relative" x-data="{ openProfile: false }">
                        <button @click="openProfile = !openProfile"
                                class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-gray-50 transition-all duration-300 border-2 border-transparent hover:border-gray-200 group">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=fbbf24&color=fff"
                                     class="w-9 h-9 rounded-full ring-2 ring-yellow-400 ring-offset-2 transform group-hover:scale-110 transition-transform duration-300">
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></span>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                            <svg :class="openProfile ? 'rotate-180' : ''" class="w-4 h-4 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown dengan animasi -->
                        <div x-show="openProfile"
                             @click.outside="openProfile = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">

                            <div class="px-4 py-3 bg-gradient-to-r from-yellow-50 to-orange-50 border-b border-gray-100">
                                <p class="text-xs text-gray-500">Signed in as</p>
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile Saya
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-3 w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

            </div>

            <!-- Hamburger dengan animasi -->
            <div class="md:hidden">
                <button @click="open = !open" class="p-2 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-6 h-6 transition-transform duration-300" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu dengan animasi slide -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="md:hidden border-t border-gray-100 bg-white/95 backdrop-blur-lg">

        <div class="px-4 py-6 space-y-2">
            <a href="/" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-all duration-200 font-medium">
                Beranda
            </a>
            <a href="/layanan" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-all duration-200 font-medium">
                Layanan
            </a>
            <a href="/armada" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-all duration-200 font-medium">
                Unit Armada
            </a>
            <a href="/lokasi" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-all duration-200 font-medium">
                Lokasi
            </a>
            <a href="/bantuan" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-all duration-200 font-medium">
                Bantuan
            </a>

            {{-- Mobile Auth --}}
            @guest
                <div class="pt-4 flex flex-col gap-3">
                    <a href="{{ route('login') }}"
                       class="text-center px-6 py-3 rounded-xl border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-300 font-medium">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="text-center px-6 py-3 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-500 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        Daftar
                    </a>
                </div>
            @endguest

            @auth
                <div class="pt-4 mt-4 border-t border-gray-100 space-y-2">
                    <div class="flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=fbbf24&color=fff"
                             class="w-10 h-10 rounded-full ring-2 ring-yellow-400">
                        <div>
                            <p class="text-xs text-gray-500">Logged in as</p>
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="flex items-center gap-3 w-full text-left px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>

<!-- Spacer untuk fixed navbar -->
<div class="h-20"></div>
