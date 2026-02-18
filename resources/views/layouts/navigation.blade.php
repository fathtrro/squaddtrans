<nav x-data="{ open: false, scrolled: false }"
    @scroll.window="scrolled = window.pageYOffset > 20"
    :class="scrolled ? 'bg-white shadow-md' : 'bg-white'"
    class="fixed top-3 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl
           rounded-3xl overflow-hidden
           transition-all duration-300 z-50">

    <!-- Main Navbar -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.jpeg') }}"
                    class="h-9 w-9 rounded-lg object-cover"
                    alt="Logo">

                <span class="text-xl font-semibold text-gray-900">
                    SQUAD<span class="text-yellow-500">TRANS</span>
                </span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">

                <a href="/" class="text-sm text-gray-600 hover:text-gray-900">
                    Beranda
                </a>

                <a href="/cars" class="text-sm text-gray-600 hover:text-gray-900">
                    Unit Armada
                </a>

                @auth
                <a href="{{ route('bookings.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">
                    Riwayat Booking
                </a>
                @endauth

                <a href="/contact" class="text-sm text-gray-600 hover:text-gray-900">
                    Tentang
                </a>

            </div>

            <!-- Right -->
            <div class="hidden md:flex items-center gap-4">

                @guest
                <a href="{{ route('login') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                    class="px-5 py-2 rounded-full bg-yellow-500 hover:bg-yellow-600
                           text-white text-sm font-medium">
                    Daftar
                </a>
                @endguest


                @auth
                <div class="relative" x-data="{ openProfile: false }">

                    <button @click="openProfile = !openProfile"
                        class="flex items-center gap-2">

                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=eab308&color=fff"
                            class="w-8 h-8 rounded-full">

                        <span class="text-sm font-medium text-gray-700">
                            {{ Auth::user()->name }}
                        </span>

                        <svg :class="openProfile ? 'rotate-180' : ''"
                            class="w-4 h-4 text-gray-400 transition"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>

                    </button>


                    <!-- Profile Dropdown -->
                    <div x-show="openProfile"
                        @click.outside="openProfile = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white
                               rounded-xl shadow-lg border">

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Profile Saya
                        </a>

                        <a href="{{ route('bookings.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Riwayat Booking
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                class="w-full text-left px-4 py-2 text-sm
                                       text-red-600 hover:bg-red-50">
                                Logout
                            </button>

                        </form>

                    </div>

                </div>
                @endauth

            </div>

            <!-- Mobile Button -->
            <div class="md:hidden">

                <button @click="open = !open"
                    class="p-2 text-gray-600">

                    <!-- Hamburger -->
                    <svg x-show="!open" class="w-6 h-6"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <!-- Close -->
                    <svg x-show="open" class="w-6 h-6"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

        </div>
    </div>


    <!-- Mobile Menu -->
    <div x-show="open"
        x-transition
        class="md:hidden bg-white
               rounded-b-3xl
               overflow-hidden
               shadow-md">

        <div class="px-6 py-4 space-y-2">

            <a href="/"
                class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100">
                Beranda
            </a>

            <a href="/cars"
                class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100">
                Unit Armada
            </a>

            @auth
            <a href="{{ route('bookings.index') }}"
                class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100">
                Riwayat Booking
            </a>
            @endauth

            <a href="/contact"
                class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100">
                Tentang
            </a>


            @guest
            <div class="pt-3 space-y-2">

                <a href="{{ route('login') }}"
                    class="block text-center px-4 py-2
                           border rounded-lg text-sm">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                    class="block text-center px-4 py-2
                           bg-yellow-500 text-white rounded-lg">
                    Daftar
                </a>

            </div>
            @endguest


            @auth
            <div class="pt-3 border-t mt-3">

                <a href="{{ route('profile.edit') }}"
                    class="block px-3 py-2 text-sm hover:bg-gray-100 rounded-lg">
                    Profile Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full text-left px-3 py-2
                               text-sm text-red-600 hover:bg-red-50 rounded-lg">
                        Logout
                    </button>

                </form>

            </div>
            @endauth

        </div>

    </div>

</nav>
