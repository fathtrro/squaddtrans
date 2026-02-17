<x-admin-layout>
    <x-slot name="header">Finalisasi Booking</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Selesaikan Booking</h1>
                <p class="text-gray-600 mt-1">{{ $booking->booking_code }} - {{ $booking->user->name }}</p>
            </div>

            <a href="{{ route('admin.renter.show', $booking->id) }}"
               class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium text-gray-700 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Completion Status -->
    <div class="mb-6 rounded-xl border-2 @if($completionStatus['can_complete']) border-green-300 bg-green-50 @else border-red-300 bg-red-50 @endif p-6">
        <div class="flex gap-3">
            @if($completionStatus['can_complete'])
                <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            @else
                <svg class="w-6 h-6 @if($completionStatus['can_complete']) text-green-600 @else text-red-600 @endif flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            @endif
            <div>
                <h3 class="font-semibold @if($completionStatus['can_complete']) text-green-900 @else text-red-900 @endif">
                    {{ $completionStatus['can_complete'] ? 'Siap untuk Diselesaikan' : 'Belum Dapat Diselesaikan' }}
                </h3>
                <p class="@if($completionStatus['can_complete']) text-green-700 @else text-red-700 @endif text-sm mt-1">
                    {{ $completionStatus['message'] }}
                </p>
            </div>
        </div>
    </div>

    <!-- Checklist Status -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Before Checklist -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Checklist Sebelum</h2>
                @if($completionStatus['has_before_checklist'])
                    <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">✓ Selesai</span>
                @else
                    <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">✗ Belum</span>
                @endif
            </div>

            @if($completionStatus['has_before_checklist'])
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500">Kondisi Bodi</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['before']['body_condition'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Kondisi Interior</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['before']['interior_condition'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Level Bahan Bakar</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['before']['fuel_level'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Foto Terdokumentasi</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['before']['photos_count'] ?? 0 }} foto</p>
                    </div>
                </div>
            @else
                <p class="text-gray-500 text-sm">Checklist sebelum perjalanan belum dilakukan.</p>
            @endif
        </div>

        <!-- After Checklist -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Checklist Setelah</h2>
                @if($completionStatus['has_after_checklist'])
                    <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">✓ Selesai</span>
                @else
                    <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">✗ Belum</span>
                @endif
            </div>

            @if($completionStatus['has_after_checklist'])
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500">Kondisi Bodi</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['after']['body_condition'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Kondisi Interior</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['after']['interior_condition'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Level Bahan Bakar</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['after']['fuel_level'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Foto Terdokumentasi</p>
                        <p class="text-gray-900 font-medium">{{ $report['checklists']['after']['photos_count'] ?? 0 }} foto</p>
                    </div>
                </div>
            @else
                <p class="text-gray-500 text-sm">Checklist setelah perjalanan belum dilakukan.</p>
            @endif
        </div>
    </div>

    <!-- Penalty Status -->
    @if($completionStatus['unpaid_penalties'] > 0)
    <div class="bg-red-50 border border-red-200 rounded-xl p-6 mb-6">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <h3 class="font-semibold text-red-900">Masih Ada Denda Belum Dibayar</h3>
                <p class="text-sm text-red-700 mt-1">
                    Ada {{ $completionStatus['unpaid_penalties'] }} denda dengan total Rp {{ number_format($completionStatus['total_unpaid_amount'], 0, ',', '.') }} yang belum dibayar.
                </p>
                <a href="{{ route('admin.booking.penalties', $booking->id) }}"
                   class="inline-block mt-3 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                    Proses Pembayaran Denda
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Final Report -->
    @if($report)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Laporan Transaksi Final</h2>

        <!-- Booking Info -->
        <div class="bg-gray-50 rounded-lg p-4 mb-4">
            <h3 class="font-semibold text-gray-900 mb-3">Informasi Booking</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Kode Booking</p>
                    <p class="text-gray-900 font-medium">{{ $report['booking']['code'] }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Penyewa</p>
                    <p class="text-gray-900 font-medium">{{ $report['booking']['user_name'] }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Kendaraan</p>
                    <p class="text-gray-900 font-medium">{{ $report['booking']['car_name'] }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Layanan</p>
                    <p class="text-gray-900 font-medium">{{ $report['booking']['service_type'] }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Durasi</p>
                    <p class="text-gray-900 font-medium">{{ $report['booking']['duration_days'] }} hari</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal</p>
                    <p class="text-gray-900 font-medium">{{ $report['booking']['start_date'] }} s/d {{ $report['booking']['end_date'] }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="bg-blue-50 rounded-lg p-4 mb-4">
            <h3 class="font-semibold text-gray-900 mb-3">Ringkasan Pembayaran</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <p class="text-gray-600">Harga Booking</p>
                    <p class="text-gray-900 font-medium">Rp {{ number_format($report['payment']['booking_price'], 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-600">Down Payment (dibayar)</p>
                    <p class="text-gray-900 font-medium">Rp {{ number_format($report['payment']['dp_paid'], 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-600">Pelunasan (dibayar)</p>
                    <p class="text-gray-900 font-medium">Rp {{ number_format($report['payment']['final_paid'], 0, ',', '.') }}</p>
                </div>
                @if($report['payment']['penalty_paid'] > 0)
                <div class="flex justify-between">
                    <p class="text-gray-600">Denda (dibayar)</p>
                    <p class="text-red-600 font-medium">Rp {{ number_format($report['payment']['penalty_paid'], 0, ',', '.') }}</p>
                </div>
                @endif
                <div class="flex justify-between pt-2 border-t border-blue-200">
                    <p class="text-gray-900 font-semibold">Total Pembayaran</p>
                    <p class="text-gray-900 font-bold text-lg">Rp {{ number_format($report['payment']['total_paid'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Penalties & Extensions -->
        @if(!empty($report['penalties']) || !empty($report['extensions']))
        <div class="bg-yellow-50 rounded-lg p-4">
            @if(!empty($report['penalties']))
            <div class="mb-4">
                <h4 class="font-semibold text-gray-900 mb-2">Denda Tercatat</h4>
                <div class="space-y-1 text-sm">
                    @foreach($report['penalties'] as $penalty)
                    <div class="flex justify-between">
                        <p class="text-gray-600">{{ $penalty['type'] }} - {{ substr($penalty['description'], 0, 40) }}...</p>
                        <p class="text-gray-900 font-medium">Rp {{ number_format($penalty['amount'], 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($report['extensions']))
            <div>
                <h4 class="font-semibold text-gray-900 mb-2">Perpanjangan</h4>
                <div class="space-y-1 text-sm">
                    @foreach($report['extensions'] as $ext)
                    <div class="flex justify-between">
                        <p class="text-gray-600">{{ $ext['old_end_date'] }} → {{ $ext['new_end_date'] }}</p>
                        <p class="text-gray-900 font-medium">Rp {{ number_format($ext['extra_price'], 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif
    </div>
    @endif

    <!-- Completion Form -->
    @if($completionStatus['can_complete'])
    <form method="POST" action="{{ route('admin.booking.complete', $booking->id) }}" class="space-y-4">
        @csrf

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" name="confirm_completion" value="1" required
                    class="mt-1 w-4 h-4 border-gray-300 rounded text-blue-600 shadow-sm focus:ring-blue-500">
                <div>
                    <p class="font-medium text-gray-900">Saya konfirmasi bahwa semua proses selesai</p>
                    <p class="text-sm text-gray-600 mt-1">Saya telah memverifikasi bahwa semua checklist dilakukan, semua pembayaran diterima, dan semua denda dibayar.</p>
                </div>
            </label>

            <div class="mt-4 pt-4 border-t border-gray-100">
                <label for="admin_notes" class="block text-sm font-medium text-gray-900 mb-2">
                    Catatan Admin (Opsional)
                </label>
                <textarea name="admin_notes" id="admin_notes" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                    placeholder="Catatan tambahan tentang proses penyelesaian booking...">{{ old('admin_notes') }}</textarea>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.renter.show', $booking->id) }}"
               class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Selesaikan Booking
            </button>
        </div>
    </form>
    @endif

</x-admin-layout>
