{{-- PERPANJANG TAB --}}
@php
    // Allow extend if booking is running or pending completion
    $canExtend = in_array($booking->status, ['running', 'renting']);

    // Check if there's a pending extension request
    $hasPendingExtension = $booking->extensions && $booking->extensions->contains('status', 'requested');
@endphp

<div class="space-y-6">
    {{-- PERPANJANG SECTION HEADER --}}
  <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
    <div class="flex items-center justify-between gap-4">

        <!-- Left Content -->
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-yellow-400 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-900">
                    Perpanjang Sewa
                </h2>
                <p class="text-sm text-gray-600">
                    Tambah durasi sewa jika masih dibutuhkan
                </p>
            </div>
        </div>

        <!-- Right Button -->
        @if($canExtend && !$hasPendingExtension)
            <button type="button"
                onclick="openExtendModal()"
                class="px-5 py-2.5 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-medium rounded-lg transition focus:ring-2 focus:ring-yellow-300">

                Ajukan
            </button>
        @elseif($hasPendingExtension)
            <span
                class="text-sm text-orange-600 bg-orange-50 px-4 py-2 rounded-lg border border-orange-200">
                Menunggu persetujuan admin
            </span>
        @else
            <span
                class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg border">
                Belum bisa diperpanjang
            </span>
        @endif

    </div>
</div>


    {{-- EXTENSION HISTORY --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Riwayat Perpanjangan</h3>
        </div>

        <div class="p-6">
            @if($booking->extensions && $booking->extensions->count() > 0)
                <div class="space-y-4">
                    @foreach($booking->extensions as $ext)
                        <div class="bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                            @if($ext->status === 'pending')
                                                bg-yellow-100 text-yellow-800
                                            @elseif($ext->status === 'approved')
                                                bg-green-100 text-green-800
                                            @elseif($ext->status === 'rejected')
                                                bg-red-100 text-red-800
                                            @else
                                                bg-gray-100 text-gray-800
                                            @endif
                                        ">
                                            {{ ucfirst($ext->status) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $ext->created_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-gray-900">Permintaan Perpanjangan #{{ $loop->iteration }}</h4>
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Waktu Kembali Lama</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $ext->old_end_datetime->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="bg-orange-50 rounded-lg p-4">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Waktu Kembali Baru</p>
                                    <p class="text-sm font-bold text-orange-600">{{ $ext->new_end_datetime->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3 bg-blue-50 rounded-lg p-3">
                                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-600">Durasi Tambahan</p>
                                        <p class="font-bold text-gray-900">{{ $ext->old_end_datetime->diffInHours($ext->new_end_datetime) }} Jam</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 bg-green-50 rounded-lg p-3">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-600">Biaya Tambahan</p>
                                        <p class="font-bold text-green-600">Rp {{ number_format($ext->extra_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($ext->notes)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">Catatan</p>
                                    <p class="text-sm text-gray-700">{{ $ext->notes }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Perpanjangan</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        @if($canExtend)
                            Klik tombol "Ajukan Perpanjangan" di atas untuk memperpanjang sewa Anda
                        @else
                            Perpanjangan hanya dapat diajukan saat booking sedang berjalan
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
