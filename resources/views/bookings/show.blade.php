<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50/30 to-slate-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER WITH BOOKING CODE --}}
            <div class="mb-8">
                <a href="{{ route('bookings.index') }}"
                   class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-1">
                            Booking #{{ $booking->booking_code }}
                        </h1>
                        <p class="text-sm text-gray-500">Detail informasi booking Anda</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $booking->status_badge }} shadow-sm">
                            {{ $booking->status_label }}
                        </span>

                        <button onclick="window.print()"
                                class="inline-flex items-center px-4 py-2 bg-white border-2 border-gray-200 rounded-full text-sm font-semibold text-gray-700 hover:border-gray-300 hover:shadow-md transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download Invoice
                        </button>

                        <button class="inline-flex items-center px-4 py-2 bg-white border-2 border-gray-200 rounded-full text-sm font-semibold text-gray-700 hover:border-gray-300 hover:shadow-md transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROGRESS TIMELINE --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex items-center justify-between relative">
                    {{-- Progress Bar Background --}}
                    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 -translate-y-1/2 z-0"></div>
                    <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-yellow-400 to-orange-500 -translate-y-1/2 z-0"
                         style="width: 66%;"></div>

                    {{-- Step 1: BOOKING CREATED --}}
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-lg mb-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-xs font-bold text-gray-900 uppercase tracking-wide">Booking Created</div>
                            <div class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($booking->created_at)->format('d M, H:i') }}</div>
                        </div>
                    </div>

                    {{-- Step 2: PAYMENT VERIFIED --}}
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-lg mb-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-xs font-bold text-gray-900 uppercase tracking-wide">Payment Verified</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $booking->formatted_start_date }}</div>
                        </div>
                    </div>

                    {{-- Step 3: IN USE --}}
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-lg mb-2 ring-4 ring-yellow-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-xs font-bold text-gray-900 uppercase tracking-wide">In Use</div>
                            <div class="text-xs text-gray-500 mt-1">Ride Now</div>
                        </div>
                    </div>

                    {{-- Step 4: COMPLETED --}}
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 mb-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wide">Completed</div>
                            <div class="text-xs text-gray-400 mt-1">Estimated 15 Oct</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT GRID --}}
            <div class="grid lg:grid-cols-3 gap-6">

                {{-- LEFT COLUMN --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- INFORMASI BOOKING --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-6 py-4 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Informasi Booking</h3>
                            </div>
                        </div>

                        <div class="p-6 space-y-6">
                            {{-- PICKUP & RETURN --}}
                            <div class="grid md:grid-cols-2 gap-6">
                                {{-- PICK-UP --}}
                                <div class="relative">
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-yellow-400 to-orange-500 rounded-full"></div>
                                    <div class="pl-4">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-4 h-4 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pick-up Location</span>
                                        </div>
                                        <h4 class="font-bold text-gray-900 mb-1">
                                            @if($booking->service_type == 'with_driver')
                                                Soekarno-Hatta Int. Airport
                                            @else
                                                {{ $booking->pickup_location ?? 'Kantor Pusat' }}
                                            @endif
                                        </h4>
                                        <p class="text-sm text-gray-500 leading-relaxed">Terminal 3 A/Arrival Hall, Gate 5, Tangerang, Banten</p>

                                        <div class="mt-4 flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $booking->formatted_start_date }} | {{ $booking->formatted_start_time }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- RETURN --}}
                                <div class="relative">
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-orange-500 to-red-500 rounded-full"></div>
                                    <div class="pl-4">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Return Location</span>
                                        </div>
                                        <h4 class="font-bold text-gray-900 mb-1">
                                            @if($booking->service_type == 'with_driver')
                                                Sentra Grosir Senen II
                                            @else
                                                {{ $booking->return_location ?? 'Kantor Pusat' }}
                                            @endif
                                        </h4>
                                        <p class="text-sm text-gray-500 leading-relaxed">Jl. Asia Afrika No.8, Jakarta Pusat</p>

                                        <div class="mt-4 flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $booking->formatted_end_date }} | {{ $booking->formatted_end_time }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- CUSTOMER DETAILS --}}
                            <div class="border-t border-gray-100 pt-6">
                                <div class="flex items-center mb-4">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer Details</span>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold mr-3">
                                            {{ strtoupper(substr($booking->customer_name ?? 'B', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Driver Name</div>
                                            <div class="font-semibold text-gray-900">{{ $booking->customer_name ?? 'Bambang Pamungkas' }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Phone Number</div>
                                            <div class="font-semibold text-gray-900">{{ $booking->customer_phone ?? '+62 812 - 3456 - 7890' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIWAYAT PEMBAYARAN --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Riwayat Pembayaran</h3>
                                </div>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @forelse($booking->payments as $index => $pay)
                                <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start flex-1">
                                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center mr-4 flex-shrink-0">
                                                @if($pay->payment_type == 'dp')
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                    </svg>
                                                @endif
                                            </div>

                                            <div class="flex-1">
                                                <div class="flex items-start justify-between mb-1">
                                                    <div>
                                                        <h4 class="font-bold text-gray-900">
                                                            {{ $pay->payment_type == 'dp' ? 'Pembayaran DP (30%)' : 'Pelunasan' }}
                                                        </h4>
                                                        <div class="flex items-center mt-1 text-xs text-gray-500">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 font-medium mr-2">
                                                                {{ $pay->payment_method ?? 'Bank Transfer - BCA' }}
                                                            </span>
                                                            @if($pay->payment_type == 'dp')
                                                                <span class="text-green-600 font-semibold uppercase text-xs">DIBAYAR</span>
                                                            @else
                                                                <span class="text-yellow-600 font-semibold uppercase text-xs">BELUM DIBAYAR</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <div class="text-xl font-bold text-gray-900">
                                                            Rp {{ number_format($pay->amount, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($pay->payment_type == 'dp')
                                                    <div class="mt-2 text-xs text-gray-500">
                                                        {{ $pay->paid_at ? \Carbon\Carbon::parse($pay->paid_at)->format('d M Y, H:i') : \Carbon\Carbon::parse($booking->created_at)->format('d M Y, H:i') }}
                                                    </div>
                                                @else
                                                    <div class="mt-2 text-xs text-gray-500">
                                                        Menunggu pembayaran sebelum tanggal kembali
                                                    </div>
                                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                                        Due: {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-gray-500">Belum ada riwayat pembayaran</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- JAMINAN --}}
                    @if($booking->guarantees && $booking->guarantees->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
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

                </div>

                {{-- RIGHT COLUMN --}}
                <div class="lg:col-span-1 space-y-6">

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

                    {{-- PRICE BREAKDOWN --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Detail Biaya</h3>
                            </div>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Rental ({{ $booking->duration_in_days }} Hari)</span>
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($booking->total_price - 150000 - ($booking->total_price * 0.11), 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Layanan Pick-up Bandara</span>
                                    <span class="font-semibold text-gray-900">Rp 150.000</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Asuransi Perjalanan</span>
                                    <span class="font-semibold text-green-600">Free</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Pajak PPN (11%)</span>
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($booking->total_price * 0.11, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="border-t-2 border-dashed border-gray-200 pt-4">
                                <div class="flex justify-between items-end mb-4">
                                    <span class="text-sm font-semibold text-gray-600">Total Tagihan</span>
                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-orange-600">
                                            {{ $booking->formatted_total_price }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Warning Notice --}}
                            <div class="bg-amber-50 border-l-4 border-amber-400 rounded-lg p-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <h4 class="text-sm font-bold text-amber-900 mb-1">Catatan Penting</h4>
                                        <p class="text-xs text-amber-800 leading-relaxed">
                                            Harap selesaikan pembayaran sebelum tanggal kembali untuk menghindari penalti keterlambatan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="space-y-3">
                        @if($booking->canBeCancelled())
                            <form method="POST" action="#" class="w-full">
                                @csrf
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')"
                                        class="w-full px-6 py-3 bg-white border-2 border-red-500 text-red-600 rounded-xl font-bold hover:bg-red-50 transition-all duration-200 flex items-center justify-center group">
                                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Batalkan Booking
                                </button>
                            </form>
                        @endif

                        <button class="w-full px-6 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-xl font-bold hover:from-yellow-500 hover:to-orange-600 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            Hubungi Customer Service
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
