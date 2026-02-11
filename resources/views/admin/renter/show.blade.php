<x-admin-layout>
    <x-slot name="header">Detail Booking</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <p class="text-gray-600">Informasi lengkap pemesanan kendaraan</p>

            <a href="{{ route('admin.renter.index') }}"
               class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium text-gray-700 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left Column - Main Info -->
        <div class="lg:col-span-2 space-y-6">

            <!-- MODIFIED: Booking Code & Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Kode Booking</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $renter->booking_code }}</p>
                    </div>

                    <!-- FORM UNTUK MENGUBAH STATUS -->
                    <form method="POST" action="{{ route('admin.renter.update', $renter->id) }}" class="relative group w-48">
                        @csrf
                        @method('PATCH')

                        <label class="sr-only">Ubah Status</label>
                        <div class="relative">
                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="appearance-none w-full bg-white border-2 text-sm font-bold py-2 pl-3 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-opacity-50 transition-colors cursor-pointer
                                    @if($renter->status === 'pending') border-yellow-400 text-yellow-700 focus:ring-yellow-400 focus:bg-yellow-50
                                    @elseif($renter->status === 'confirmed') border-blue-400 text-blue-700 focus:ring-blue-400 focus:bg-blue-50
                                    @elseif($renter->status === 'running') border-purple-400 text-purple-700 focus:ring-purple-400 focus:bg-purple-50
                                    @elseif($renter->status === 'completed') border-green-500 text-green-700 focus:ring-green-500 focus:bg-green-50
                                    @else border-red-400 text-red-700 focus:ring-red-400 focus:bg-red-50
                                    @endif">

                                <option value="pending" {{ $renter->status === 'pending' ? 'selected' : '' }}>PENDING</option>
                                <option value="confirmed" {{ $renter->status === 'confirmed' ? 'selected' : '' }}>CONFIRMED</option>
                                <option value="running" {{ $renter->status === 'running' ? 'selected' : '' }}>RUNNING</option>
                                <option value="completed" {{ $renter->status === 'completed' ? 'selected' : '' }}>COMPLETED</option>
                                <option value="cancelled" {{ $renter->status === 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                            </select>

                            <!-- Icon Panah Dropdown (Single Chevron Down) -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-current">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Booking Details Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informasi Pemesanan
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- User ID -->
                    <div class="flex items-start gap-3">
                        <div class="bg-yellow-100 rounded-lg p-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">User ID</p>
                            <p class="text-sm font-semibold text-gray-900">#{{ $renter->user_id }}</p>
                        </div>
                    </div>

                    <!-- Car ID -->
                    <div class="flex items-start gap-3">
                        <div class="bg-yellow-100 rounded-lg p-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">Mobil ID</p>
                            <p class="text-sm font-semibold text-gray-900">#{{ $renter->car_id }}</p>
                        </div>
                    </div>

                    <!-- Service Type -->
                    <div class="flex items-start gap-3">
                        <div class="bg-blue-100 rounded-lg p-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">Jenis Layanan</p>
                            <p class="text-sm font-semibold text-gray-900 capitalize">
                                {{ str_replace('_', ' ', $renter->service_type) }}
                            </p>
                        </div>
                    </div>

                    <!-- Destination -->
                    <div class="flex items-start gap-3">
                        <div class="bg-green-100 rounded-lg p-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">Tujuan</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $renter->destination ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Jadwal Sewa
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Start Date -->
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4 border border-yellow-200">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-yellow-500 text-white rounded-lg p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-yellow-700">Tanggal Mulai</p>
                                <p class="text-lg font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($renter->start_datetime)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 ml-11">
                            Pukul {{ \Carbon\Carbon::parse($renter->start_datetime)->format('H:i') }} WIB
                        </p>
                    </div>

                    <!-- End Date -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-green-500 text-white rounded-lg p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-green-700">Tanggal Selesai</p>
                                <p class="text-lg font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($renter->end_datetime)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 ml-11">
                            Pukul {{ \Carbon\Carbon::parse($renter->end_datetime)->format('H:i') }} WIB
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column - Payment & Timeline -->
        <div class="space-y-6">

            <!-- Payment Summary -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Pembayaran
                </h2>

                <div class="space-y-4">
                    <!-- DP Amount -->
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4 border border-yellow-200">
                        <p class="text-xs font-medium text-yellow-700 mb-1">Down Payment (DP)</p>
                        <p class="text-2xl font-bold text-gray-900">
                            Rp {{ number_format($renter->dp_amount, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="border-t-2 border-dashed border-gray-200"></div>

                    <!-- Total Price -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border-2 border-green-300">
                        <p class="text-sm font-medium text-green-700 mb-1">Total Harga</p>
                        <p class="text-3xl font-bold text-gray-900">
                            Rp {{ number_format($renter->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Timeline Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Riwayat Waktu
                </h2>

                <div class="space-y-4">
                    <!-- Created At -->
                    <div class="flex items-start gap-3 pb-4 border-b border-gray-100">
                        <div class="bg-yellow-100 rounded-lg p-2">
                            <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Dibuat</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $renter->created_at->format('d M Y, H:i') }} WIB
                            </p>
                        </div>
                    </div>

                    <!-- Updated At -->
                    <div class="flex items-start gap-3">
                        <div class="bg-blue-100 rounded-lg p-2">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Terakhir Update</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $renter->updated_at->format('d M Y, H:i') }} WIB
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-admin-layout>
