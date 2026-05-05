{{-- resources/views/admin/dashboard.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Dashboard Overview</x-slot>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider">Total Revenue</h3>
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-3xl font-bold text-gray-800">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="text-sm font-semibold {{ $revenueTrend >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    <span class="text-lg">{{ $revenueTrend >= 0 ? '↑' : '↓' }}</span> {{ abs(round($revenueTrend, 1)) }}% bulan ini
                </p>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider">Total Pesanan</h3>
                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
                <p class="text-sm text-gray-600">
                    <span class="font-semibold text-green-600">{{ $completedBookings }} ✓</span> Selesai •
                    <span class="font-semibold text-red-600">{{ $cancelledBookings }} ✕</span> Batal
                </p>
            </div>
        </div>

        <!-- Active Rentals -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider">Rental Aktif</h3>
                <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-3xl font-bold text-gray-800">{{ $activeRentals }}</p>
                <p class="text-sm font-semibold text-green-600">Kendaraan sedang disewa</p>
            </div>
        </div>

        <!-- Maintenance Issues -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider">Servis</h3>
                <div class="w-12 h-12 bg-gradient-to-br from-red-100 to-red-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-3xl font-bold text-gray-800">{{ $maintenanceUrgent }}</p>
                <p class="text-sm {{ $maintenanceUrgent > 0 ? 'font-semibold text-red-600' : 'font-semibold text-green-600' }}">
                    {{ $maintenanceUrgent > 0 ? '⚠ Ada kendaraan servis' : '✓ Semua normal' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Charts & Fleet Status Section -->
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Pendapatan Bulanan</h3>
                    <p class="text-sm text-gray-500">Tren pendapatan 12 bulan terakhir</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.laporan') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 font-medium text-gray-700 transition-colors">Lihat Report</a>
                    <button class="px-4 py-2 text-sm bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 font-medium transition-all">{{ date('Y') }}</button>
                </div>
            </div>
            <div class="h-72 flex items-end justify-between gap-2">
                @foreach($revenueData as $month => $amount)
                    @php
                        $percentage = $maxRevenue > 0 ? ($amount / $maxRevenue) * 100 : 0;
                        $percentage = max($percentage, 5); // Minimum height for visibility
                    @endphp
                    <div class="flex-1 relative group">
                        <div class="bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg hover:shadow-lg transition-all" style="height: {{ $percentage }}%"></div>
                        <div class="absolute -bottom-8 left-0 right-0 text-xs font-semibold text-gray-600 text-center group-hover:text-yellow-600 transition-colors">{{ $month }}</div>
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-10">
                            IDR {{ number_format($amount, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-16"></div>
        </div>

        <!-- Fleet Status -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Status Armada</h3>
            <p class="text-sm text-gray-500 mb-6">Total {{ $totalCars }} Kendaraan</p>

            <div class="flex items-center justify-center mb-6">
                <div class="relative w-48 h-48">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 200 200">
                        <!-- Background circle -->
                        <circle cx="100" cy="100" r="90" stroke="#F5F5F5" stroke-width="20" fill="none"/>

                        <!-- Rented (Yellow) -->
                        @php
                            $rentedDegrees = $totalCars > 0 ? ($carsRented / $totalCars) * 360 : 0;
                            $rentedRadians = deg2rad($rentedDegrees);
                        @endphp
                        <circle cx="100" cy="100" r="90" stroke="#FBBF24" stroke-width="20" fill="none"
                                stroke-dasharray="{{ $rentedDegrees * 1.57 / 180 }}, 564.6"
                                stroke-linecap="round"/>

                        <!-- Available (Green) - offset by rented -->
                        @php
                            $availableDegrees = $totalCars > 0 ? ($carsAvailable / $totalCars) * 360 : 0;
                            $totalBefore = $rentedDegrees;
                        @endphp
                        <circle cx="100" cy="100" r="90" stroke="#10B981" stroke-width="20" fill="none"
                                stroke-dasharray="{{ $availableDegrees * 1.57 / 180 }}, 564.6"
                                stroke-dashoffset="-{{ $totalBefore * 1.57 / 180 }}"
                                stroke-linecap="round"/>

                        <!-- Service (Red) -->
                        <circle cx="100" cy="100" r="90" stroke="#EF4444" stroke-width="20" fill="none"
                                stroke-dasharray="{{ $servicePercentage * 5.64 / 100 }}, 564.6"
                                stroke-dashoffset="-{{ ($totalBefore + $availableDegrees) * 1.57 / 180 }}"
                                stroke-linecap="round"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl font-bold text-gray-800">{{ $totalCars }}</span>
                        <span class="text-sm text-gray-500 font-semibold">UNITS</span>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></div>
                        <span class="text-sm font-medium text-gray-700">Disewa</span>
                    </div>
                    <span class="text-sm font-bold text-gray-800">{{ $carsRented }} ({{ $rentedPercentage }}%)</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium text-gray-700">Tersedia</span>
                    </div>
                    <span class="text-sm font-bold text-gray-800">{{ $carsAvailable }} ({{ $availablePercentage }}%)</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium text-gray-700">Servis</span>
                    </div>
                    <span class="text-sm font-bold text-gray-800">{{ $carsInService }} ({{ $servicePercentage }}%)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Penyewaan Terbaru</h3>
                <p class="text-sm text-gray-500 mt-1">10 booking terakhir</p>
            </div>
            <a href="{{ route('admin.renter.index') }}" class="text-sm font-semibold text-yellow-600 hover:text-yellow-700 hover:underline transition-colors">
                Lihat Semua →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kendaraan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentBookings as $booking)
                            @php
                            $statusColorMap = [
                                'pending' => ['bg' => '#FEF3C7', 'text' => '#B45309', 'label' => 'MENUNGGU'],
                                'confirmed' => ['bg' => '#DBEAFE', 'text' => '#1E40AF', 'label' => 'DIKONFIRMASI'],
                                'running' => ['bg' => '#DCFCE7', 'text' => '#166534', 'label' => 'BERJALAN'],
                                'completed' => ['bg' => '#D1D5DB', 'text' => '#374151', 'label' => 'SELESAI'],
                                'cancelled' => ['bg' => '#FEE2E2', 'text' => '#991B1B', 'label' => 'DIBATALKAN'],
                            ];
                            $colorData = $statusColorMap[$booking->status] ?? $statusColorMap['pending'];
                            $duration = $booking->start_datetime->diffInDays($booking->end_datetime) + 1;
                            $initials = strtoupper(substr($booking->user->name, 0, 2));
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-gray-900">{{ $booking->booking_code }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold mr-3" style="background-color: {{ $colorData['bg'] }}; color: {{ $colorData['text'] }};">{{ $initials }}</div>
                                    <span class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-700">{{ $booking->car->brand ?? 'N/A' }} {{ $booking->car->name ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-700">{{ $duration }} {{ $duration > 1 ? 'hari' : 'hari' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-bold rounded-full transition-colors" style="background-color: {{ $colorData['bg'] }}; color: {{ $colorData['text'] }};">
                                    {{ $colorData['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-gray-900">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-500 font-medium">Tidak ada data booking</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
