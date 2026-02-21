<nav x-data="{ open: false, scrolled: false, openProfile: false }"
    @scroll.window="scrolled = window.pageYOffset > 20"
    :class="scrolled
        ? 'bg-white/80 backdrop-blur-2xl shadow-2xl border border-white/60'
        : 'bg-white/70 backdrop-blur-xl border border-white/40'"
    class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl
           rounded-3xl z-50 transition-all duration-300">

    <div class="px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- ================= LOGO ================= --}}
            <a href="/" class="flex items-center gap-3">

                {{-- Logo Mobile --}}
                <img src="{{ asset('images/lg.png') }}"
                    class="h-9 w-9 md:hidden drop-shadow-md"
                    alt="Logo">

                {{-- Text Logo --}}
                <span class="text-xl font-bold tracking-wide text-gray-900">
                    SQUAD<span class="text-yellow-500">TRANS</span>
                </span>

            </a>

            {{-- ================= MENU DESKTOP ================= --}}
            <div class="hidden md:flex items-center gap-10">

                @php
                    $current = request()->path();
                @endphp

                @foreach([
                    '/' => 'Beranda',
                    '/cars' => 'Unit Armada',
                    '/contact' => 'Tentang'
                ] as $url => $label)

                    <a href="{{ $url }}"
                        class="relative text-sm font-medium transition-all duration-300
                               {{ trim($current,'/') == trim($url,'/') ? 'text-yellow-600' : 'text-gray-700' }}
                               hover:text-yellow-600 group">

                        {{ $label }}

                        {{-- Animated underline --}}
                        <span class="absolute -bottom-1 left-0 w-0 h-[2px]
                                     bg-yellow-500 rounded-full
                                     transition-all duration-300
                                     group-hover:w-full"></span>

                    </a>

                @endforeach

                @auth
                    <a href="{{ route('bookings.index') }}"
                        class="text-sm font-medium text-gray-700 hover:text-yellow-600 transition">
                        Riwayat
                    </a>
                @endauth

            </div>

            {{-- ================= RIGHT AREA ================= --}}
            <div class="hidden md:flex items-center gap-5">

                @guest
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-700 hover:text-yellow-600 transition">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-5 py-2 rounded-full bg-yellow-500 hover:bg-yellow-600
                               text-white text-sm font-semibold shadow-md
                               hover:shadow-xl transition-all duration-300">
                        Daftar
                    </a>
                @endguest

                @auth

                    {{-- Profile --}}
                    <div class="relative" x-data="{ openProfile:false }">

                        <button @click="openProfile = !openProfile"
                            class="flex items-center gap-2">

                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=eab308&color=fff"
                                class="w-8 h-8 rounded-full border-2 border-yellow-400 shadow-sm">

                            <span class="text-sm font-medium text-gray-800">
                                {{ Auth::user()->name }}
                            </span>

                        </button>

                        {{-- Dropdown --}}
                        <div x-show="openProfile"
                            @click.outside="openProfile = false"
                            x-transition
                            class="absolute right-0 mt-3 w-48
                                   bg-white/90 backdrop-blur-xl
                                   rounded-2xl shadow-2xl border border-white/60
                                   overflow-hidden">

                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-3 text-sm hover:bg-yellow-50 transition">
                                Profile Saya
                            </a>

                            <a href="{{ route('bookings.index') }}"
                                class="block px-4 py-3 text-sm border-t hover:bg-yellow-50 transition">
                                Riwayat Booking
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-3 text-sm text-red-500
                                               border-t hover:bg-red-50 transition">
                                    Logout
                                </button>
                            </form>

                        </div>
                    </div>

                @endauth

            </div>

            {{-- ================= MOBILE BUTTON ================= --}}
            <button @click="open = !open"
                class="md:hidden w-10 h-10 flex items-center justify-center
                       rounded-2xl bg-white shadow-md">

                <svg x-show="!open" class="w-5 h-5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="open" class="w-5 h-5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>
    </div>

</nav>
