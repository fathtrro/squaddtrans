
{{-- resources/views/admin/dashboard.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Dashboard Overview</x-slot>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">TOTAL REVENUE</h3>
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-3xl font-bold text-gray-800">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="text-sm {{ $revenueTrend >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ $revenueTrend >= 0 ? '↑' : '↓' }} {{ abs(round($revenueTrend, 1)) }}% dari bulan lalu</p>
            </div>
        </div>

        <!-- Active Rentals -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">ACTIVE RENTALS</h3>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-3xl font-bold text-gray-800">{{ $activeRentals }} Units</p>
                <p class="text-sm text-green-600">↑ Aktif saat ini</p>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">PENDING APPROVALS</h3>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-3xl font-bold text-gray-800">{{ $pendingApprovals }} Tasks</p>
                <p class="text-sm {{ $pendingApprovals > 0 ? 'text-red-600' : 'text-green-600' }}">{{ $pendingApprovals > 0 ? '! Butuh perhatian segera' : '✓ Semua tersetujui' }}</p>
            </div>
        </div>

        <!-- Maintenance -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">MAINTENANCE</h3>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-3xl font-bold text-gray-800">{{ $maintenanceUrgent }} Issues</p>
                <p class="text-sm text-gray-600">⏱ Perlu penanganan</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Pendapatan Bulanan</h3>
                    <p class="text-sm text-gray-500">Tren pendapatan selama 12 bulan terakhir</p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Unduh Report</button>
                    <button class="px-4 py-2 text-sm bg-gray-800 text-white rounded-lg hover:bg-gray-700">{{ date('Y') }}</button>
                </div>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                @foreach($revenueData as $month => $amount)
                    @php
                        $percentage = $maxRevenue > 0 ? ($amount / $maxRevenue) * 100 : 0;
                    @endphp
                    <div class="flex-1 bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg" style="height: {{ $percentage }}%" title="Bulan {{ $month }}: IDR {{ number_format($amount, 0, ',', '.') }}"></div>
                @endforeach
            </div>
            <div class="flex justify-between mt-4 text-xs text-gray-500">
                <span>JAN</span>
                <span>MAR</span>
                <span>MEI</span>
                <span>JUL</span>
                <span>SEP</span>
                <span>NOV</span>
            </div>
        </div>

        <!-- Fleet Status -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Status Armada</h3>
            <p class="text-sm text-gray-500 mb-6">Total {{ $totalCars }} Kendaraan</p>

            <div class="flex items-center justify-center mb-6">
                <div class="relative w-48 h-48">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="96" cy="96" r="80" stroke="#FEF3C7" stroke-width="16" fill="none"/>
                        <circle cx="96" cy="96" r="80" stroke="#F59E0B" stroke-width="16" fill="none"
                                stroke-dasharray="301.59" stroke-dashoffset="{{ 301.59 - (($carsRented / $totalCars) * 301.59) }}" stroke-linecap="round"/>
                        <circle cx="96" cy="96" r="80" stroke="#10B981" stroke-width="16" fill="none"
                                stroke-dasharray="301.59" stroke-dashoffset="{{ 301.59 - (($carsAvailable / $totalCars) * 301.59) }}" stroke-linecap="round"/>
                        <circle cx="96" cy="96" r="80" stroke="#EF4444" stroke-width="16" fill="none"
                                stroke-dasharray="301.59" stroke-dashoffset="{{ 301.59 - (($carsInService / $totalCars) * 301.59) }}" stroke-linecap="round"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl font-bold text-gray-800">{{ $totalCars }}</span>
                        <span class="text-sm text-gray-500">UNITS</span>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-700">Disewa</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-800">{{ $carsRented }} Units ({{ $rentedPercentage }}%)</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-700">Tersedia</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-800">{{ $carsAvailable }} Units ({{ $availablePercentage }}%)</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-700">Servis</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-800">{{ $carsInService }} Units ({{ $servicePercentage }}%)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800">Penyewaan Terbaru</h3>
            <a href="{{ route('admin.renter.index') }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-700">Lihat Semua →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentBookings as $booking)
                            @php
                            $statusColorMap = [
                                'pending' => ['bg' => '#FEF3C7', 'text' => '#B45309'],
                                'confirmed' => ['bg' => '#FEF3C7', 'text' => '#92400E'],
                                'running' => ['bg' => '#DCFCE7', 'text' => '#166534'],
                                'completed' => ['bg' => '#DBEAFE', 'text' => '#1E40AF'],
                                'cancelled' => ['bg' => '#FEE2E2', 'text' => '#991B1B'],
                            ];
                            $statusLabel = [
                                'pending' => 'MENUNGGU',
                                'confirmed' => 'DIKONFIRMASI',
                                'running' => 'BERJALAN',
                                'completed' => 'SELESAI',
                                'cancelled' => 'DIBATALKAN',
                            ];
                            $colorData = $statusColorMap[$booking->status] ?? $statusColorMap['pending'];
                            $statusText = $statusLabel[$booking->status] ?? strtoupper($booking->status);
                            $duration = $booking->start_datetime->diffInDays($booking->end_datetime) + 1;
                            $initials = strtoupper(substr($booking->user->name, 0, 2));
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->booking_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold mr-3" style="background-color: {{ $colorData['bg'] }}; color: {{ $colorData['text'] }};">{{ $initials }}</div>
                                    <span class="text-sm text-gray-900">{{ $booking->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking->car->brand }} {{ $booking->car->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $duration }} {{ $duration > 1 ? 'Hari' : 'Hari' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full" style="background-color: {{ $colorData['bg'] }}; color: {{ $colorData['text'] }};">{{ $statusText }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data booking</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
