<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 pt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

            <!-- Header Section -->
            <!-- Header + Stats (Sejajar) -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

                <!-- Kiri: Judul -->
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Riwayat Pembayaran
                    </h1>
                    <p class="text-gray-600">
                        Kelola dan lacak semua transaksi penyewaan kendaraan Anda.
                    </p>
                </div>

                <!-- Kanan: Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full lg:w-auto">

                    <!-- Loyalty Points -->
                    <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between min-w-[260px]">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">LOYALTY POINTS</p>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ number_format(
                                    isset($allBookings)
                                        ? $allBookings->where('status', 'completed')->count() * 50
                                        : $bookings->where('status', 'completed')->count() * 50,
                                    0,
                                    ',',
                                    '.',
                                ) }}
                                <span class="text-sm font-normal text-gray-500">Pts</span>
                            </p>
                        </div>

                        <div
                            class="w-14 h-14 bg-gradient-to-br from-yellow-100 to-amber-100 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Total Transaksi -->
                    <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between min-w-[260px]">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">TOTAL TRANSAKSI</p>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ isset($allBookings) ? $allBookings->count() : $bookings->total() }}
                                <span class="text-sm font-normal text-gray-500">Kali</span>
                            </p>
                        </div>

                        <div
                            class="w-14 h-14 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Filter and Search Section - Always Visible -->
            <div class="sticky top-0 z-10 bg-white rounded-2xl shadow-md p-4 mb-6">
                <form method="GET" action="{{ route('bookings.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Status:</span>
                        <select name="status"
                            class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm"
                            onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                Cancelled</option>
                        </select>
                    </div>

                    <div class="flex-1 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Tanggal:</span>
                        <input type="date" name="date_filter" value="{{ request('date_filter') }}"
                            class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm"
                            onchange="this.form.submit()" placeholder="Rentang Tanggal">
                    </div>

                    <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-lg transition-colors">
                        Terapkan
                    </button>
                </form>
            </div>

            @if ($bookings->count())

                <!-- Bookings List -->
                <div class="space-y-4">
                    @foreach ($bookings as $booking)
                        <div
                            class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-200">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <!-- Status Icon -->
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-12 h-12 rounded-full flex items-center justify-center
                                        @if ($booking->status == 'pending') bg-yellow-100
                                        @elseif($booking->status == 'confirmed') bg-blue-100
                                        @elseif($booking->status == 'completed') bg-green-100
                                        @else bg-red-100 @endif">
                                            @if ($booking->status == 'completed')
                                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif($booking->status == 'pending')
                                                <svg class="w-6 h-6 text-yellow-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif($booking->status == 'cancelled')
                                                <svg class="w-6 h-6 text-red-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Transaction Details -->
                                    <div class="flex-grow">
                                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                            <!-- Date & ID -->
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">TANGGAL & ID</p>
                                                <p class="font-bold text-gray-900 text-sm mb-0.5">
                                                    {{ \Carbon\Carbon::parse($booking->start_datetime)->format('d M Y') }}
                                                </p>
                                                <p class="text-xs text-gray-600">{{ $booking->booking_code }}</p>
                                            </div>

                                            <!-- Vehicle -->
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">KENDARAAN</p>
                                                <p class="font-bold text-gray-900 text-sm mb-0.5">
                                                    {{ $booking->car->name }}</p>
                                                <p class="text-xs text-gray-600">
                                                    {{ $booking->car->plate_number ?? 'N/A' }}</p>
                                            </div>

                                            <!-- Payment Method -->
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">METODE</p>
                                                <div class="flex items-center gap-2">
                                                    @if ($booking->payments->first())
                                                        @php
                                                            $firstPayment = $booking->payments->first();
                                                            $paymentMethod = $firstPayment->payment_method;
                                                        @endphp
                                                        <svg class="w-4 h-4 text-gray-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                        </svg>
                                                        <span class="text-sm text-gray-900 font-medium">
                                                            Transfer via {{ $firstPayment->bankAccount?->bank_name ?? 'Bank' }}
                                                        </span>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="text-sm text-gray-500">-</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">STATUS</p>
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                                @if ($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-800
                                                @elseif($booking->status == 'completed') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full mr-2
                                                    @if ($booking->status == 'pending') bg-yellow-500
                                                    @elseif($booking->status == 'confirmed') bg-blue-500
                                                    @elseif($booking->status == 'completed') bg-green-500
                                                    @else bg-red-500 @endif">
                                                    </span>
                                                    {{ strtoupper($booking->status) }}
                                                </span>
                                            </div>

                                            <!-- Amount -->
                                            <div class="text-right">
                                                <p class="text-xs text-gray-500 mb-1">TOTAL HARGA</p>
                                                <p class="font-bold text-gray-900 text-sm mb-1">
                                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                                </p>
                                                @php
                                                    $totalPaid = $booking->payments->sum('amount');
                                                    $dpPaid = $booking->payments->where('payment_type', 'dp')->sum('amount');
                                                    $remaining = $booking->total_price - $totalPaid;
                                                @endphp
                                                <div class="flex flex-col gap-0.5 text-xs">
                                                    @if($booking->status === 'completed')
                                                        <span class="text-green-600 font-semibold">✓ Lunas</span>
                                                        <span class="text-gray-600">Total: Rp {{ number_format($totalPaid, 0, ',', '.') }}</span>
                                                    @else
                                                        <span class="text-green-600">DP: Rp {{ number_format($dpPaid, 0, ',', '.') }}</span>
                                                        <span class="text-orange-600">Sisa: Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex-shrink-0 flex flex-col md:flex-row gap-2">
                                        <a href="{{ route('bookings.show', $booking) }}"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition-all duration-200 shadow-md hover:shadow-lg">
                                            Detail
                                        </a>
                                        <a href="{{ route('bookings.download', $booking) }}"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-gray-200 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($bookings->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="flex items-center gap-2">
                            @if ($bookings->onFirstPage())
                                <span
                                    class="px-3 py-2 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $bookings->previousPageUrl() }}"
                                    class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </a>
                            @endif

                            @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                                @if ($page == $bookings->currentPage())
                                    <span
                                        class="w-10 h-10 rounded-lg bg-amber-500 text-white font-bold flex items-center justify-center">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="w-10 h-10 rounded-lg border border-gray-200 text-gray-700 font-medium hover:bg-gray-50 transition-colors flex items-center justify-center">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            @if ($bookings->hasMorePages())
                                <a href="{{ $bookings->nextPageUrl() }}"
                                    class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <span
                                    class="px-3 py-2 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div
                        class="w-24 h-24 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Transaksi</h3>
                    <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pembayaran</p>
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-400 to-orange-500 text-white font-semibold rounded-lg hover:from-amber-500 hover:to-orange-600 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Mulai Booking Sekarang
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
