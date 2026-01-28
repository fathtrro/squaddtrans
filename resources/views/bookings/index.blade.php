<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Riwayat Booking</h1>
                <p class="text-gray-600">Kelola dan pantau semua booking kendaraan Anda</p>
            </div>

            @if($bookings->count())
                <!-- Desktop Table View -->
                <div class="hidden lg:block bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-900 to-gray-800 text-white">
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Kode Booking</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Mobil</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Layanan</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Total Harga</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($bookings as $booking)
                                <tr class="hover:bg-amber-50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-900 text-sm">
                                            {{ $booking->booking_code }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                </svg>
                                            </div>
                                            <span class="font-semibold text-gray-900">{{ $booking->car->name }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="text-gray-700">
                                            {{ ucwords(str_replace('_',' ', $booking->service_type)) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 text-gray-700">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking->start_datetime)->format('d M Y') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-bold text-amber-600">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold
                                            @if($booking->status == 'pending') bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800
                                            @elseif($booking->status == 'confirmed') bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800
                                            @elseif($booking->status == 'completed') bg-gradient-to-r from-green-100 to-emerald-100 text-green-800
                                            @else bg-gradient-to-r from-red-100 to-rose-100 text-red-800
                                            @endif">
                                            <span class="w-1.5 h-1.5 rounded-full mr-2
                                                @if($booking->status == 'pending') bg-yellow-500
                                                @elseif($booking->status == 'confirmed') bg-blue-500
                                                @elseif($booking->status == 'completed') bg-green-500
                                                @else bg-red-500
                                                @endif">
                                            </span>
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('bookings.show', $booking) }}"
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-sm font-semibold rounded-lg hover:from-amber-500 hover:to-orange-600 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile Card View -->
                <div class="lg:hidden space-y-4">
                    @foreach($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-4 py-3 flex items-center justify-between">
                            <span class="text-white font-bold text-sm">{{ $booking->booking_code }}</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                @if($booking->status == 'pending') bg-yellow-400 text-yellow-900
                                @elseif($booking->status == 'confirmed') bg-blue-400 text-blue-900
                                @elseif($booking->status == 'completed') bg-green-400 text-green-900
                                @else bg-red-400 text-red-900
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>

                        <div class="p-4 space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $booking->car->name }}</p>
                                    <p class="text-sm text-gray-600">{{ ucwords(str_replace('_',' ', $booking->service_type)) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($booking->start_datetime)->format('d M Y') }}
                                </div>
                                <span class="font-bold text-amber-600">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>
                            </div>

                            <a href="{{ route('bookings.show', $booking) }}"
                               class="block w-full text-center px-4 py-2.5 bg-gradient-to-r from-amber-400 to-orange-500 text-white font-semibold rounded-lg hover:from-amber-500 hover:to-orange-600 transition-all duration-200 shadow-md">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Booking</h3>
                    <p class="text-gray-600 mb-6">Anda belum memiliki riwayat booking kendaraan</p>
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-400 to-orange-500 text-white font-semibold rounded-lg hover:from-amber-500 hover:to-orange-600 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Mulai Booking Sekarang
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
