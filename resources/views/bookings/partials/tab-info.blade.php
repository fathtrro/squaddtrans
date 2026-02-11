{{-- INFORMASI TAB --}}
<div class="space-y-6">
    {{-- INFORMASI BOOKING --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Informasi Booking</h3>
        </div>

        <div class="p-6 space-y-6">
            {{-- PICKUP & RETURN --}}
            <div class="grid md:grid-cols-2 gap-6">
                {{-- PICK-UP --}}
                <div>
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-900">Pick-up Location</span>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed ml-7">
                        @if($booking->service_type == 'with_driver')
                            Soekarno-Hatta Int. Airport
                        @else
                            {{ $booking->pickup_location ?? 'Kantor Pusat' }}
                        @endif
                    </p>
                    <p class="text-xs text-gray-500 ml-7 mt-1">Terminal 3 A/Arrival Hall, Gate 5, Tangerang</p>

                    <div class="mt-4 flex items-center ml-7">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm font-semibold text-gray-900">{{ $booking->formatted_start_date }} | {{ $booking->formatted_start_time }}</div>
                    </div>
                </div>

                {{-- RETURN --}}
                <div>
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-900">Return Location</span>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed ml-7">
                        @if($booking->service_type == 'with_driver')
                            Sentra Grosir Senen II
                        @else
                            {{ $booking->return_location ?? 'Kantor Pusat' }}
                        @endif
                    </p>
                    <p class="text-xs text-gray-500 ml-7 mt-1">Jl. Asia Afrika No.8, Jakarta Pusat</p>

                    <div class="mt-4 flex items-center ml-7">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm font-semibold text-gray-900">{{ $booking->formatted_end_date }} | {{ $booking->formatted_end_time }}</div>
                    </div>
                </div>
            </div>

            {{-- CUSTOMER DETAILS --}}
            <div class="border-t border-gray-100 pt-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Customer Details</h4>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr($booking->user->name ?? 'C', 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500">Customer Name</p>
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $booking->user->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500">Phone Number</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $booking->contact ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JAMINAN --}}
    @if($booking->guarantees && $booking->guarantees->count() > 0)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0110 1.944 11.954 11.954 0 0117.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Jaminan</h3>
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            @foreach($booking->guarantees as $g)
                <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center mr-4">
                            @if(strtolower($g->type) == 'ktp')
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900">{{ strtoupper($g->type) }}</h4>
                            <p class="text-sm text-gray-500 mt-0.5">
                                @if(strtolower($g->type) == 'ktp')
                                    Kartu Tanda Penduduk
                                @else
                                    Kartu {{ strtoupper($g->type) }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                        {{ $g->status == 'diterima' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($g->status) }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- CAR INFO CARD --}}
    <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl shadow-xl overflow-hidden border border-slate-700">
        <div class="aspect-[4/3] bg-gradient-to-br from-slate-700 to-slate-800 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?w=600&q=80"
                 alt="{{ $booking->car->name }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
        </div>

        <div class="p-6">
            <h3 class="text-2xl font-bold text-white mb-1">
                {{ $booking->car->name ?? 'Toyota Alphard Premium' }}
            </h3>
            <p class="text-sm text-slate-400 mb-6">Black Edition - 2023 Executive Lounge</p>

            <div class="grid grid-cols-3 gap-3 mb-6">
                <div class="text-center p-3 bg-slate-800/50 rounded-xl border border-slate-700">
                    <svg class="w-6 h-6 text-yellow-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                    <div class="text-xs text-slate-400">Auto</div>
                </div>

                <div class="text-center p-3 bg-slate-800/50 rounded-xl border border-slate-700">
                    <svg class="w-6 h-6 text-yellow-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-xs text-slate-400">Petrol</div>
                </div>

                <div class="text-center p-3 bg-slate-800/50 rounded-xl border border-slate-700">
                    <svg class="w-6 h-6 text-yellow-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    <div class="text-xs text-slate-400">7 Seats</div>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-4">
                <div class="flex items-center justify-between text-sm mb-2">
                    <span class="text-slate-400">Layanan</span>
                    <span class="text-white font-semibold">{{ $booking->service_type_label }}</span>
                </div>

                @if($booking->driver)
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-400">Sopir</span>
                    <span class="text-white font-semibold">{{ $booking->driver->name }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
