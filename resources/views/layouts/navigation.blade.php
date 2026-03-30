@if(!in_array(request()->route()->getName(), ['profile.edit', 'bookings.create']))
<nav x-data="{ open: false, scrolled: false, openInfo: false }"
    @scroll.window="scrolled = window.pageYOffset > 20"
    :class="scrolled
        ? 'bg-white/80 backdrop-blur-2xl shadow-2xl border border-white/60'
        : 'bg-white/70 backdrop-blur-xl border border-white/40'"
    class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl
           rounded-3xl z-50 transition-all duration-300
           [box-shadow:inset_0_2px_4px_rgba(0,0,0,0.05),0_10px_25px_rgba(0,0,0,0.1)]">

    <div class="px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 md:h-16">

            {{-- ================= LOGO ================= --}}
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/lg.png') }}"
                    class="h-10 w-10 drop-shadow-md md:hidden" alt="Logo">
                <span class="hidden md:inline text-xl tracking-tight font-bold text-gray-900">
                    SQUAD<span class="text-yellow-500">TRANS</span>
                </span>
            </a>

            {{-- ================= MENU DESKTOP ================= --}}
            <div class="hidden md:flex items-center gap-8">
                @php $current = request()->path(); @endphp

                {{-- Beranda --}}
                <a href="/" class="relative text-sm font-medium transition-all duration-300
                    {{ trim($current,'/') == '' ? 'text-yellow-600' : 'text-gray-700' }}
                    hover:text-yellow-600 group">
                    Beranda
                    <span class="absolute -bottom-1 left-0 w-0 h-[2px] bg-yellow-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                </a>

                {{-- Unit Armada --}}
                <a href="/cars" class="relative text-sm font-medium transition-all duration-300
                    {{ trim($current,'/') == 'cars' ? 'text-yellow-600' : 'text-gray-700' }}
                    hover:text-yellow-600 group">
                    Unit Armada
                    <span class="absolute -bottom-1 left-0 w-0 h-[2px] bg-yellow-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                </a>

                {{-- Dropdown: Informasi --}}
                @php
                    $infoActive = in_array(trim($current,'/'), ['tentang', 'blog', 'contact-us']);
                @endphp
                <div class="relative" @click.outside="openInfo = false">
                    <button @click="openInfo = !openInfo"
                        class="flex items-center gap-1 text-sm font-medium transition-all duration-300 group
                               {{ $infoActive ? 'text-yellow-600' : 'text-gray-700' }} hover:text-yellow-600"
                        :class="openInfo ? 'text-yellow-600' : ''">
                        <span class="relative">
                            Informasi
                            <span class="absolute -bottom-1 left-0 h-[2px] bg-yellow-500 rounded-full transition-all duration-300
                                         {{ $infoActive ? 'w-full' : '' }}"
                                  :class="openInfo ? 'w-full' : '{{ $infoActive ? 'w-full' : 'w-0' }} group-hover:w-full'"></span>
                        </span>
                        <svg class="w-3.5 h-3.5 mt-px transition-transform duration-200"
                             :class="openInfo ? 'rotate-180 text-yellow-500' : ''"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown panel (3 items) --}}
                    <div x-show="openInfo"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-5 w-56
                                bg-white rounded-2xl shadow-2xl border border-gray-100
                                overflow-hidden origin-top">

                        {{-- caret --}}
                        <div class="absolute -top-[7px] left-1/2 -translate-x-1/2
                                    w-3.5 h-3.5 bg-white border-l border-t border-gray-100
                                    rotate-45 rounded-tl-sm"></div>

                        {{-- Tentang Kami --}}
                        <a href="/tentang"
                            class="flex items-center gap-3 px-4 py-3.5 transition-colors group/item
                                   {{ trim($current,'/') == 'tentang' ? 'bg-yellow-50' : 'hover:bg-yellow-50' }}">
                            <span class="w-8 h-8 rounded-xl border flex items-center justify-center flex-shrink-0 transition-all
                                         {{ trim($current,'/') == 'tentang'
                                            ? 'bg-yellow-100 border-yellow-200'
                                            : 'bg-gray-50 border-gray-100 group-hover/item:bg-yellow-100 group-hover/item:border-yellow-200' }}">
                                <svg class="w-4 h-4 transition-colors
                                            {{ trim($current,'/') == 'tentang' ? 'text-yellow-500' : 'text-gray-400 group-hover/item:text-yellow-500' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold transition-colors
                                          {{ trim($current,'/') == 'tentang' ? 'text-yellow-600' : 'text-gray-800 group-hover/item:text-yellow-600' }}">
                                    Tentang Kami
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">Profil perusahaan</p>
                            </div>
                        </a>

                        <div class="h-px bg-gray-50 mx-3"></div>

                        {{-- Blog --}}
                        <a href="/blog"
                            class="flex items-center gap-3 px-4 py-3.5 transition-colors group/item
                                   {{ trim($current,'/') == 'blog' ? 'bg-yellow-50' : 'hover:bg-yellow-50' }}">
                            <span class="w-8 h-8 rounded-xl border flex items-center justify-center flex-shrink-0 transition-all
                                         {{ trim($current,'/') == 'blog'
                                            ? 'bg-yellow-100 border-yellow-200'
                                            : 'bg-gray-50 border-gray-100 group-hover/item:bg-yellow-100 group-hover/item:border-yellow-200' }}">
                                <svg class="w-4 h-4 transition-colors
                                            {{ trim($current,'/') == 'blog' ? 'text-yellow-500' : 'text-gray-400 group-hover/item:text-yellow-500' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM9 14h6M9 10h4"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold transition-colors
                                          {{ trim($current,'/') == 'blog' ? 'text-yellow-600' : 'text-gray-800 group-hover/item:text-yellow-600' }}">
                                    Blog & Artikel
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">Tips & inspirasi perjalanan</p>
                            </div>
                        </a>

                        <div class="h-px bg-gray-50 mx-3"></div>

                        {{-- Hubungi Kami --}}
                        <a href="/contact-us"
                            class="flex items-center gap-3 px-4 py-3.5 transition-colors group/item
                                   {{ trim($current,'/') == 'contact-us' ? 'bg-yellow-50' : 'hover:bg-yellow-50' }}">
                            <span class="w-8 h-8 rounded-xl border flex items-center justify-center flex-shrink-0 transition-all
                                         {{ trim($current,'/') == 'contact-us'
                                            ? 'bg-yellow-100 border-yellow-200'
                                            : 'bg-gray-50 border-gray-100 group-hover/item:bg-yellow-100 group-hover/item:border-yellow-200' }}">
                                <svg class="w-4 h-4 transition-colors
                                            {{ trim($current,'/') == 'contact-us' ? 'text-yellow-500' : 'text-gray-400 group-hover/item:text-yellow-500' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold transition-colors
                                          {{ trim($current,'/') == 'contact-us' ? 'text-yellow-600' : 'text-gray-800 group-hover/item:text-yellow-600' }}">
                                    Hubungi Kami
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">Kontak &amp; lokasi</p>
                            </div>
                        </a>
                    </div>
                </div>

                @auth
                    <a href="{{ route('bookings.index') }}"
                        class="relative text-sm font-medium transition-all duration-300
                        {{ request()->routeIs('bookings.*') ? 'text-yellow-600' : 'text-gray-700' }}
                        hover:text-yellow-600 group">
                        Riwayat
                        <span class="absolute -bottom-1 left-0 w-0 h-[2px] bg-yellow-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                    </a>
                @endauth
            </div>

            {{-- ================= RIGHT AREA DESKTOP ================= --}}
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
                    <div class="relative" x-data="{ openProfile: false }">
                        <button @click="openProfile = !openProfile" class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=eab308&color=fff"
                                class="w-8 h-8 rounded-full border-2 border-yellow-400 shadow-sm">
                            <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</span>
                        </button>
                        <div x-show="openProfile" @click.outside="openProfile = false" x-transition
                            class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm hover:bg-yellow-50 transition">Profile Saya</a>
                            <a href="{{ route('bookings.index') }}" class="block px-4 py-3 text-sm border-t hover:bg-yellow-50 transition">Riwayat Booking</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-3 text-sm text-red-500 border-t hover:bg-red-50 transition">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- ================= MOBILE BUTTON ================= --}}
            <button @click="open = !open"
                class="md:hidden w-10 h-10 flex items-center justify-center
                       rounded-2xl bg-gray-100/80 hover:bg-yellow-100 transition-colors duration-200">
                <svg x-show="!open" x-cloak class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-cloak class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- ================= MOBILE MENU ================= --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden px-4 pb-4">

        <div class="mt-2 rounded-2xl overflow-hidden bg-white/90 backdrop-blur-sm border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.08)]">

            <div class="px-2 pt-2 pb-2">
                @php $current = request()->path(); @endphp

                @php
                $mobileNav = [
                    '/'           => ['label' => 'Beranda',           'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                    '/cars'       => ['label' => 'Unit Armada',        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 17h8M3 10l2-4h14l2 4M3 10h18v6H3v-6z"/>'],
                    '/tentang'    => ['label' => 'Tentang Kami',       'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
                    '/blog'       => ['label' => 'Blog & Artikel',     'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM9 14h6M9 10h4"/>'],
                    '/contact-us' => ['label' => 'Hubungi Kami',       'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                ];
                @endphp

                @foreach($mobileNav as $url => $item)
                    @php $isActive = trim($current,'/') == trim($url,'/'); @endphp
                    <a href="{{ $url }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl mb-1 transition-all duration-200
                               {{ $isActive ? 'bg-yellow-50 text-yellow-600' : 'text-gray-700 hover:bg-gray-50 hover:text-yellow-600' }}">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isActive ? 'bg-yellow-100' : 'bg-gray-100' }}">
                            <svg class="w-4 h-4 {{ $isActive ? 'text-yellow-500' : 'text-gray-500' }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                        </span>
                        <span class="text-sm font-medium">{{ $item['label'] }}</span>
                        @if($isActive)<span class="ml-auto w-1.5 h-1.5 rounded-full bg-yellow-500"></span>@endif
                    </a>
                @endforeach

                @auth
                    <a href="{{ route('bookings.index') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl mb-1
                               {{ request()->routeIs('bookings.*') ? 'bg-yellow-50 text-yellow-600' : 'text-gray-700 hover:bg-gray-50 hover:text-yellow-600' }}
                               transition-all duration-200">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg
                                     {{ request()->routeIs('bookings.*') ? 'bg-yellow-100' : 'bg-gray-100' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('bookings.*') ? 'text-yellow-500' : 'text-gray-500' }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium">Riwayat</span>
                        @if(request()->routeIs('bookings.*'))<span class="ml-auto w-1.5 h-1.5 rounded-full bg-yellow-500"></span>@endif
                    </a>
                @endauth
            </div>

            <div class="h-px bg-gray-100 mx-3"></div>

            <div class="px-2 pt-2 pb-2">
                @guest
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl mb-1
                               text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium">Masuk</span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center gap-2 mx-1 py-3 rounded-xl
                               bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold
                               shadow-md shadow-yellow-200 transition-all duration-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Daftar Sekarang
                    </a>
                @endguest

                @auth
                    <div class="flex items-center gap-3 px-3 py-3 mb-1 rounded-xl bg-yellow-50">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=eab308&color=fff"
                            class="w-9 h-9 rounded-full border-2 border-yellow-300 shadow-sm flex-shrink-0">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl mb-1
                               text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium">Profile Saya</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-3 rounded-xl
                                   text-red-500 hover:bg-red-50 transition-all duration-200">
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50">
                                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </span>
                            <span class="text-sm font-medium">Logout</span>
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </div>

</nav>
@endif
