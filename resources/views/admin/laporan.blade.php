{{-- resources/views/admin/laporan.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Laporan Kinerja Penyewaan</x-slot>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">TOTAL PENDAPATAN</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">TOTAL TRANSAKSI</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalBookings }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Bookings -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">PENYEWAAN SELESAI</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $completedBookings }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Penalties -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">TOTAL DENDA</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">IDR {{ number_format($totalPenalties, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Monthly Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-800">Tren Pendapatan Bulanan</h3>
                <p class="text-sm text-gray-500">Pendapatan dari pembayaran yang sudah dikonfirmasi</p>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                @foreach($revenueData as $month => $amount)
                    @php
                        $percentage = $maxRevenue > 0 ? ($amount / $maxRevenue) * 100 : 0;
                    @endphp
                    <div class="flex-1 bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg"
                         style="height: {{ $percentage }}%"
                         title="Bulan {{ $month }}: IDR {{ number_format($amount, 0, ',', '.') }}">
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between mt-4 text-xs text-gray-500">
                <span>JAN</span>
                <span>FEB</span>
                <span>MAR</span>
                <span>APR</span>
                <span>MEI</span>
                <span>JUN</span>
                <span>JUL</span>
                <span>AUG</span>
                <span>SEP</span>
                <span>OKT</span>
                <span>NOV</span>
                <span>DES</span>
            </div>
        </div>

        <!-- Stats Sidebar -->
        <div class="space-y-6">
            <!-- Top Car -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Kendaraan Terpopuler</h3>
                @if($popularCars->isNotEmpty())
                    @php $topCar = $popularCars->first(); @endphp
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-600 mb-2">⭐</div>
                        <p class="text-sm font-semibold text-gray-800">{{ $topCar->brand }} {{ $topCar->name }}</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $topCar->bookings_count }}</p>
                        <p class="text-xs text-gray-500">Penyewaan</p>
                    </div>
                @else
                    <p class="text-sm text-gray-500 text-center">Belum ada data</p>
                @endif
            </div>

            <!-- Average Duration -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Durasi Rata-Rata</h3>
                <div class="text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $avgDuration }}</p>
                    <p class="text-sm text-gray-500 mt-1">Hari Per Transaksi</p>
                </div>
            </div>

            <!-- Average Rating -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Rating Rata-Rata</h3>
                <div class="text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $avgRating }}</p>
                    <div class="flex justify-center mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($avgRating))
                                <span class="text-yellow-400">★</span>
                            @else
                                <span class="text-gray-300">★</span>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Laporan Keuntungan Riil</h3>

            <!-- Filters -->
            <form method="GET" class="flex gap-4 flex-wrap">
                <div class="flex-1 min-w-[200px]">
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           placeholder="Tanggal Mulai">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           placeholder="Tanggal Akhir">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="running" {{ request('status') === 'running' ? 'selected' : '' }}>Running</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-medium text-sm">
                    Filter
                </button>
                <a href="{{ route('admin.laporan') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 font-medium text-sm">
                    Reset
                </a>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sewa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bayar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookingData as $booking)
                        @php
                            $statusColorMap = [
                                'pending' => ['bg' => '#FEF3C7', 'text' => '#B45309'],
                                'confirmed' => ['bg' => '#FEF3C7', 'text' => '#92400E'],
                                'running' => ['bg' => '#DCFCE7', 'text' => '#166534'],
                                'completed' => ['bg' => '#DBEAFE', 'text' => '#1E40AF'],
                                'cancelled' => ['bg' => '#FEE2E2', 'text' => '#991B1B'],
                            ];
                            $colorData = $statusColorMap[$booking['status']] ?? $statusColorMap['pending'];
                            $statusText = [
                                'pending' => 'MENUNGGU',
                                'confirmed' => 'DIKONFIRMASI',
                                'running' => 'BERJALAN',
                                'completed' => 'SELESAI',
                                'cancelled' => 'DIBATALKAN',
                            ][$booking['status']] ?? strtoupper($booking['status']);
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking['booking_code'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking['customer_name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking['car_full_name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking['plate_number'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking['start_date'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking['end_date'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking['duration'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">IDR {{ number_format($booking['total_price'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">IDR {{ number_format($booking['total_paid'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">IDR {{ number_format($booking['penalty'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                      style="background-color: {{ $colorData['bg'] }}; color: {{ $colorData['text'] }};">
                                    {{ $statusText }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
