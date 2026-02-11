{{-- BIAYA TAB --}}
<div class="space-y-6">
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
                                @elseif($pay->payment_type == 'extension')
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                                            @if($pay->payment_type == 'dp')
                                                Pembayaran DP (30%)
                                            @elseif($pay->payment_type == 'extension')
                                                Pembayaran Perpanjangan
                                            @else
                                                Pelunasan
                                            @endif
                                        </h4>
                                        <div class="flex items-center mt-1 text-xs text-gray-500">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 font-medium mr-2">
                                                {{ $pay->payment_method ?? 'Bank Transfer - BCA' }}
                                            </span>
                                            @if($pay->payment_type == 'dp')
                                                <span class="text-green-600 font-semibold uppercase text-xs">DIBAYAR</span>
                                            @elseif($pay->status == 'paid')
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
                                @elseif($pay->payment_type == 'extension')
                                    <div class="mt-2 text-xs text-gray-500">
                                        Menunggu pembayaran untuk perpanjangan
                                    </div>
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        @if($pay->paid_at)
                                            Dibayar: {{ \Carbon\Carbon::parse($pay->paid_at)->format('d M Y, H:i') }}
                                        @else
                                            Due: {{ \Carbon\Carbon::parse($booking->end_datetime)->format('d M Y') }}
                                        @endif
                                    </div>
                                @else
                                    <div class="mt-2 text-xs text-gray-500">
                                        Menunggu pembayaran sebelum tanggal kembali
                                    </div>
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        @if($pay->paid_at)
                                            Dibayar: {{ \Carbon\Carbon::parse($pay->paid_at)->format('d M Y, H:i') }}
                                        @else
                                            Due: {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                        @endif
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
</div>
