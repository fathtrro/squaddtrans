<x-app-layout>
    <div class="min-h-screen bg-[#F8F7F4] pt-16" x-data="{ activeTab: 'progres' }" x-cloak>

        {{-- MOBILE TOP BAR --}}
        <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 shadow-sm">
            <div class="flex items-center justify-between px-4 h-16">
                <a href="{{ route('bookings.index') }}"
                    class="flex items-center justify-center w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div class="text-center">
                    <p class="text-xs text-gray-400 font-medium">Detail Booking</p>
                    <p class="text-sm font-bold text-gray-900">#{{ $booking->booking_code }}</p>
                </div>
                <button onclick="window.print()"
                    class="flex items-center justify-center w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-10">

            {{-- DESKTOP BREADCRUMB + HEADER --}}
            <div class="hidden lg:flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('bookings.index') }}"
                        class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 transition-colors font-medium group">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-white border border-gray-200 group-hover:bg-orange-50 group-hover:border-orange-200 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </span>
                        Kembali ke Booking
                    </a>
                    <span class="text-gray-300">/</span>
                    <span class="text-sm text-gray-400">Detail Booking</span>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="window.print()"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:shadow-md transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Download
                    </button>
                    <button
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:shadow-md transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        Bagikan
                    </button>
                </div>
            </div>

            {{-- DESKTOP PAGE TITLE --}}
            <div class="hidden lg:flex items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Booking <span
                            class="text-orange-500">#{{ $booking->booking_code }}</span></h1>
                    <p class="text-sm text-gray-500 mt-1">Detail informasi dan status booking Anda</p>
                </div>
                <span
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $booking->status_badge }} shadow-sm ml-auto">
                    {{ $booking->status_label }}
                </span>
            </div>

            {{-- MOBILE HERO CARD --}}
            <div class="lg:hidden mb-4 mt-2">
                <div class="relative rounded-2xl overflow-hidden h-44 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?w=800&q=80"
                        alt="{{ $booking->car->name }}" class="w-full h-full object-cover opacity-70">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <div class="flex items-end justify-between">
                            <div>
                                <p class="text-white/60 text-xs font-medium mb-0.5">{{ $booking->service_type_label }}
                                </p>
                                <h2 class="text-white text-lg font-bold leading-tight">
                                    {{ $booking->car->name ?? 'Toyota Alphard Premium' }}</h2>
                            </div>
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $booking->status_badge }} shadow-md">
                                {{ $booking->status_label }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAIN GRID --}}
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">

                {{-- LEFT: TAB NAVIGATION + CONTENT --}}
                <div class="lg:col-span-2">

                    {{-- TAB NAVIGATION --}}
                    <div class="sticky top-16 lg:top-0 z-30 bg-[#F8F7F4] pb-3 pt-1 lg:pt-0">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <nav class="grid grid-cols-3">
                                <button @click="activeTab = 'progres'"
                                    :class="activeTab === 'progres' ?
                                        'bg-orange-50 text-orange-600 border-b-2 border-orange-500' :
                                        'text-gray-500 hover:text-gray-800 hover:bg-gray-50 border-b-2 border-transparent'"
                                    class="flex flex-col items-center gap-1 px-2 py-3 lg:py-4 text-xs lg:text-sm font-semibold transition-all duration-200">
                                    <i class="fas fa-clock text-base lg:text-lg"></i>
                                    <span>Progres</span>
                                </button>
                                <button @click="activeTab = 'info'"
                                    :class="activeTab === 'info' ?
                                        'bg-orange-50 text-orange-600 border-b-2 border-orange-500' :
                                        'text-gray-500 hover:text-gray-800 hover:bg-gray-50 border-b-2 border-transparent'"
                                    class="flex flex-col items-center gap-1 px-2 py-3 lg:py-4 text-xs lg:text-sm font-semibold transition-all duration-200">
                                    <i class="fas fa-circle-info text-base lg:text-lg"></i>
                                    <span>Info</span>
                                </button>
                                <button @click="activeTab = 'biaya'"
                                    :class="activeTab === 'biaya' ?
                                        'bg-orange-50 text-orange-600 border-b-2 border-orange-500' :
                                        'text-gray-500 hover:text-gray-800 hover:bg-gray-50 border-b-2 border-transparent'"
                                    class="flex flex-col items-center gap-1 px-2 py-3 lg:py-4 text-xs lg:text-sm font-semibold transition-all duration-200">
                                    <i class="fas fa-receipt text-base lg:text-lg"></i>
                                    <span>Biaya</span>
                                </button>
                                {{-- <button @click="activeTab = 'extension'"
                                    :class="activeTab === 'extension' ?
                                        'bg-orange-50 text-orange-600 border-b-2 border-orange-500' :
                                        'text-gray-500 hover:text-gray-800 hover:bg-gray-50 border-b-2 border-transparent'"
                                    class="flex flex-col items-center gap-1 px-2 py-3 lg:py-4 text-xs lg:text-sm font-semibold transition-all duration-200">
                                    <i class="fas fa-repeat text-base lg:text-lg"></i>
                                    <span>Perpanjang</span>
                                </button> --}}
                            </nav>
                        </div>
                    </div>

                    {{-- TAB CONTENT --}}
                    <div class="mt-4 space-y-4">
                        <div x-show="activeTab === 'progres'" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('bookings.partials.tab-progres')
                        </div>
                        <div x-show="activeTab === 'info'" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('bookings.partials.tab-info')
                        </div>
                        <div x-show="activeTab === 'biaya'" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('bookings.partials.tab-billing')
                        </div>
                        <div x-show="activeTab === 'extension'" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('bookings.partials.tab-extension')
                        </div>
                    </div>

                    {{-- MOBILE action area spacer --}}
                    <div class="lg:hidden h-24"></div>
                </div>

                {{-- RIGHT SIDEBAR (desktop only) --}}
                <div class="hidden lg:block lg:col-span-1">
                    <div class="sticky top-24 space-y-5">

                        {{-- CAR CARD --}}
                        <div
                            class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-700/50">
                            <div class="aspect-[16/10] relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?w=600&q=80"
                                    alt="{{ $booking->car->name }}"
                                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent">
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-white/20 backdrop-blur-md text-white border border-white/30">
                                        {{ $booking->service_type_label }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="text-xl font-bold text-white mb-0.5">
                                    {{ $booking->car->name ?? 'Toyota Alphard Premium' }}
                                </h3>
                                <p class="text-sm text-slate-400 mb-5">Black Edition · 2023 Executive Lounge</p>

                                <div class="grid grid-cols-3 gap-2 mb-5">
                                    @foreach ([['fas fa-cog', 'Auto'], ['fas fa-gas-pump', 'Petrol'], ['fas fa-users', '7 Kursi']] as $feat)
                                        <div
                                            class="flex flex-col items-center gap-1.5 p-3 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                                            <i class="{{ $feat[0] }} text-yellow-400 text-sm"></i>
                                            <span
                                                class="text-xs text-slate-400 font-medium">{{ $feat[1] }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                @if ($booking->driver)
                                    <div
                                        class="flex items-center gap-3 p-3 bg-white/5 rounded-2xl border border-white/10">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-steering-wheel text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-400">Sopir</p>
                                            <p class="text-sm font-semibold text-white">{{ $booking->driver->name }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- QUICK SUMMARY --}}
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5 space-y-3">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ringkasan</h4>
                            <div class="space-y-2.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 flex items-center gap-2">
                                        <i class="fas fa-calendar text-orange-400 w-4 text-center"></i> Mulai
                                    </span>
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ $booking->start_datetime->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 flex items-center gap-2">
                                        <i class="fas fa-calendar-check text-orange-400 w-4 text-center"></i> Selesai
                                    </span>
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ $booking->end_datetime->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="h-px bg-gray-100"></div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 flex items-center gap-2">
                                        <i class="fas fa-tag text-orange-400 w-4 text-center"></i> Total
                                    </span>
                                    <span class="text-base font-bold text-orange-500">Rp
                                        {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="space-y-2.5">
                            @if ($booking->canBeCancelled())
                                <button type="button" onclick="document.getElementById('cancelModal').showModal()"
                                    class="w-full flex items-center justify-center gap-2 px-5 py-3.5 bg-white border-2 border-red-200 text-red-600 rounded-2xl font-bold hover:bg-red-50 hover:border-red-400 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Batalkan Booking
                                </button>
                            @endif
                            <button
                                class="w-full flex items-center justify-center gap-2 px-5 py-3.5 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-2xl font-bold shadow-lg shadow-orange-200 hover:shadow-orange-300 hover:from-orange-500 hover:to-orange-700 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                Hubungi Customer Service
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- MOBILE BOTTOM ACTION BAR (fixed) --}}
        <div
            class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-gray-100 px-4 py-3 shadow-2xl">
            <div class="flex gap-3">
                @if ($booking->canBeCancelled())
                    <button type="button" onclick="document.getElementById('cancelModal').showModal()"
                        class="flex-1 flex items-center justify-center gap-2 py-3 bg-white border-2 border-red-300 text-red-600 rounded-xl font-bold text-sm hover:bg-red-50 transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Batalkan
                    </button>
                @endif
                <button
                    class="flex-1 flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-orange-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    Customer Service
                </button>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

    {{-- EXTEND MODAL --}}
    <div id="extendModal"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl w-full sm:max-w-md overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-white">Perpanjang Sewa</h2>
                </div>
                <button onclick="closeExtendModal()" type="button"
                    class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white hover:bg-white/30 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="extendForm" action="{{ route('bookings.extend', $booking->id) }}" method="POST"
                class="p-6 space-y-4">
                @csrf
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Berakhir Saat Ini</p>
                        <p class="text-sm font-bold text-blue-900">{{ $booking->end_datetime->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>

                <div>
                    <label for="new_end_datetime" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal & Waktu Kembali Baru
                    </label>
                    <input type="datetime-local" id="new_end_datetime" name="new_end_datetime"
                        min="{{ now()->format('Y-m-d\TH:i') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl text-gray-900 focus:ring-0 focus:border-cyan-400 transition-colors text-sm"
                        required>
                </div>

                <div id="conflictAlert"
                    class="hidden bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-800">Jadwal Bentrok!</p>
                        <p id="conflictMessage" class="text-xs text-red-600 mt-0.5"></p>
                    </div>
                </div>

                <div id="successAlert"
                    class="hidden bg-green-50 border border-green-200 rounded-2xl p-3 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm font-semibold text-green-700">Tanggal tersedia! Klik untuk melanjutkan.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">Durasi Tambahan</span>
                        <span id="extraHours" class="font-bold text-gray-900">0 jam</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Biaya Tambahan</span>
                        <span id="extraPrice" class="font-bold text-orange-500 text-base">Rp 0</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeExtendModal()"
                        class="flex-1 px-4 py-3 border-2 border-gray-200 text-gray-700 rounded-2xl font-semibold hover:bg-gray-50 transition-colors text-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-2xl font-bold hover:from-cyan-600 hover:to-blue-700 transition-all shadow-md text-sm">
                        Ajukan Perpanjangan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- CANCEL MODAL --}}
    <dialog id="cancelModal"
        class="rounded-3xl shadow-2xl border-0 w-full max-w-lg mx-4 backdrop:bg-black/60 backdrop:backdrop-blur-sm">
        <div class="p-6 overflow-y-auto max-h-[90vh]">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-200">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-red-100 to-red-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Batalkan Booking</h3>
                    <p class="text-sm text-gray-500 mt-1">Booking ID: <span
                            class="font-semibold text-gray-700">#{{ $booking->booking_code }}</span></p>
                </div>
                <button onclick="document.getElementById('cancelModal').close()"
                    class="ml-auto text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="cancelForm" method="POST" action="{{ route('bookings.cancel', $booking) }}">
                @csrf

                <!-- Info Alert -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-5">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">📱 Notifikasi WhatsApp akan dikirim ke admin</p>
                            <p>Admin akan memproses pembatalan Anda dalam waktu singkat</p>
                        </div>
                    </div>
                </div>

                <!-- Cancellation Reason -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-3">Jelaskan Alasan Pembatalan</label>
                    <textarea id="cancellationReason" name="cancellation_reason" rows="4" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl text-sm bg-white placeholder-gray-400 focus:ring-0 focus:border-red-500 transition-all resize-none"
                        placeholder="Contoh: Ada kebutuhan mendadak, jadwal berubah, dll..."></textarea>
                    <p class="text-xs text-gray-500 mt-2">Alasan akan dibaca oleh admin dan membantu proses pembatalan
                    </p>
                </div>

                <!-- Message Preview -->
                <div class="mb-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.291-4.882 5.689-4.882 9.383 0 3.692 1.827 7.101 4.882 9.383 1.563 1.175 3.637 2.083 5.651 2.083.043 0 .088 0 .132-.001 4.338-.034 8.087-2.134 10.346-5.355 1.903-2.859 2.077-6.734 1.256-8.377-.957-1.88-2.773-2.932-4.88-3.505-1.02-.27-2.111-.41-3.286-.41zm10.906-9.659C19.501 0 15.424 0 12.529.001 5.823.001 0 5.823 0 12.529c0 2.215.505 4.329 1.469 6.214-.309 1.218-1.21 4.815-1.387 5.512-.099.416-.157.9.13 1.285.286.385.738.461 1.154.362.416-.099 4.294-1.078 5.512-1.387 1.885.964 4.003 1.469 6.214 1.469 6.707 0 12.529-5.823 12.529-12.529C24.999 5.823 19.237 0 12.529 0z" />
                        </svg>
                        <span class="text-sm font-semibold text-green-900">Pesan WhatsApp yang akan dikirim</span>
                    </div>
                    <div class="bg-white rounded-lg p-3 text-sm text-gray-700 border-l-4 border-green-500">
                        <p class="font-medium text-gray-900">📋 Alasan Pembatalan Booking:</p>
                        <p id="previewReason" class="mt-2 text-gray-600 italic">Alasan Anda akan ditampilkan di
                            sini...</p>
                    </div>
                </div>

                <!-- Warning Alert -->
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <div class="text-sm text-amber-800">
                            <p class="font-semibold mb-1">⚠️ Perhatian</p>
                            <p>Pastikan alasan pembatalan sudah benar dan lengkap sebelum dikonfirmasi</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('cancelModal').close()"
                        class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-semibold text-gray-700 transition-colors text-sm">
                        Batal
                    </button>
                    <button type="submit" id="confirmCancelBtn"
                        class="flex-1 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-2xl font-bold transition-all shadow-lg shadow-red-200 text-sm">
                        Konfirmasi Batalkan
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        // Real-time message preview
        document.getElementById('cancellationReason')?.addEventListener('input', function() {
            const preview = document.getElementById('previewReason');
            const value = this.value.trim();
            if (value) {
                preview.classList.remove('italic', 'text-gray-600');
                preview.classList.add('text-gray-900', 'font-normal');
                preview.textContent = value;
            } else {
                preview.classList.add('italic', 'text-gray-600');
                preview.classList.remove('text-gray-900', 'font-normal');
                preview.textContent = 'Alasan Anda akan ditampilkan di sini...';
            }
        });
    </script>

    <script>
        const bookingId = {{ $booking->id }};
        const bookingCode = '{{ $booking->booking_code }}';
        const currentEndDatetime = new Date('{{ $booking->end_datetime->format('c') }}');
        const hourlyRate = {{ $booking->total_price / $booking->duration_in_days / 24 }};

        function openExtendModal() {
            const extendModal = document.getElementById('extendModal');
            extendModal.classList.remove('hidden');
            extendModal.style.opacity = '1';
            extendModal.style.transition = '';
            setTimeout(() => document.getElementById('new_end_datetime').focus(), 100);
        }

        function closeExtendModal() {
            const extendModal = document.getElementById('extendModal');
            extendModal.classList.add('hidden');
            extendModal.style.opacity = '1';
            extendModal.style.transition = '';

            const form = document.getElementById('extendForm');
            if (form) {
                form.reset();
            }

            const conflictAlert = document.getElementById('conflictAlert');
            if (conflictAlert) {
                conflictAlert.classList.add('hidden');
            }

            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                successAlert.classList.add('hidden');
            }

            const extraHours = document.getElementById('extraHours');
            if (extraHours) {
                extraHours.textContent = '0 jam';
            }

            const extraPrice = document.getElementById('extraPrice');
            if (extraPrice) {
                extraPrice.textContent = 'Rp 0';
            }
        }

        document.getElementById('new_end_datetime').addEventListener('change', async function() {
            const newEndDatetime = this.value;
            if (!newEndDatetime) return;

            const newEnd = new Date(newEndDatetime);
            const diffMs = newEnd - currentEndDatetime;
            const diffHours = Math.ceil(diffMs / (1000 * 60 * 60));
            const extraPrice = Math.round(diffHours * hourlyRate);

            document.getElementById('extraHours').textContent = diffHours + ' jam';
            document.getElementById('extraPrice').textContent = 'Rp ' + extraPrice.toLocaleString('id-ID');

            try {
                const response = await fetch('{{ route('bookings.extend-conflict', $booking->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        new_end_datetime: newEndDatetime
                    })
                });
                const data = await response.json();

                if (data.has_conflict) {
                    document.getElementById('conflictAlert').classList.remove('hidden');
                    document.getElementById('conflictMessage').textContent = data.message;
                    document.getElementById('successAlert').classList.add('hidden');
                } else {
                    document.getElementById('conflictAlert').classList.add('hidden');
                    document.getElementById('successAlert').classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error checking conflict:', error);
            }
        });

        document.getElementById('extendForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const extendModal = document.getElementById('extendModal');

            submitBtn.disabled = true;
            submitBtn.innerHTML = `<svg class="w-4 h-4 animate-spin mr-2 inline" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg> Mengirim...`;

            try {
                const response = await fetch('{{ route('bookings.extend', $booking->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                let data = {};
                const contentType = response.headers.get('content-type');

                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    // If response is not JSON, check status code
                    if (response.ok) {
                        data = { success: true, message: 'Perpanjangan berhasil diajukan!' };
                    } else {
                        data = { success: false, message: 'Terjadi kesalahan saat memproses perpanjangan' };
                    }
                }

                if (data.success || response.ok) {
                    // Close modal dengan smooth transition
                    extendModal.classList.add('opacity-0');
                    extendModal.style.transition = 'opacity 0.3s ease-out';

                    setTimeout(() => {
                        closeExtendModal();
                        extendModal.classList.remove('opacity-0');
                        extendModal.style.transition = '';
                        showToast(data.message || 'Perpanjangan berhasil diajukan!', 'success');

                        setTimeout(() => {
                            window.location.href = window.location.pathname;
                        }, 1500);
                    }, 300);
                } else {
                    showToast(data.message || 'Gagal mengajukan perpanjangan', 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Ajukan Perpanjangan';
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Ajukan Perpanjangan';
            }
        });

        // WhatsApp Cancel Booking - REMOVED (now using Fonnte API on backend)
        // Notifications will be sent automatically via Fonnte when submitted

        // Cancel Form Submission Handler
        document.getElementById('cancelForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const reason = document.getElementById('cancellationReason').value.trim();
            const submitBtn = document.getElementById('confirmCancelBtn');

            if (!reason) {
                showToast('Alasan pembatalan harus diisi!', 'error');
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<svg class="w-4 h-4 animate-spin mr-2 inline" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg> Memproses...`;

            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                // Close modal immediately on successful request
                if (response.ok) {
                    document.getElementById('cancelModal').close();
                    showToast(
                        '✅ Permintaan pembatalan berhasil dikirim!<br><span class="text-xs opacity-90">🔔 Pesan notifikasi telah dikirim ke admin via WhatsApp</span>',
                        'success');

                    setTimeout(() => {
                        window.location.href = '{{ route('bookings.index') }}';
                    }, 2500);
                } else {
                    showToast('❌ Terjadi kesalahan saat memproses pembatalan.', 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Konfirmasi Batalkan';
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('❌ Terjadi kesalahan. Silakan coba lagi.', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Konfirmasi Batalkan';
            }
        });

        function showToast(message, type) {
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-gradient-to-r from-green-500 to-emerald-600' :
                'bg-gradient-to-r from-red-500 to-rose-600';
            const icon = type === 'success' ?
                `<svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>` :
                `<svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>`;
            toast.className =
                `fixed top-4 right-4 left-4 sm:left-auto sm:min-w-96 flex items-start gap-4 px-5 py-4 rounded-2xl shadow-2xl text-white text-sm font-semibold z-[9999] transition-all duration-300 ${bgColor} animate-slide-in`;
            toast.innerHTML = icon + `<span>${message}</span>`;
            document.body.appendChild(toast);

            // Add animation styles if not exists
            if (!document.getElementById('toastStyles')) {
                const style = document.createElement('style');
                style.id = 'toastStyles';
                style.innerHTML = `
                @keyframes slideIn {
                    from {
                        transform: translateX(400px);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                @keyframes slideOut {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(400px);
                        opacity: 0;
                    }
                }
                .animate-slide-in {
                    animation: slideIn 0.3s ease-out;
                }
                .animate-slide-out {
                    animation: slideOut 0.3s ease-out;
                }
            `;
                document.head.appendChild(style);
            }

            setTimeout(() => {
                toast.classList.add('animate-slide-out');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        document.getElementById('extendModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeExtendModal();
            }
        });
    </script>
</x-app-layout>
