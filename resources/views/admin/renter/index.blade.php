<x-admin-layout>
    <x-slot name="header">Data Penyewaan</x-slot>

    <!-- Page Header with Description -->
    <div class="mb-6">
        <p class="text-gray-600 text-sm">Kelola dan pantau seluruh data pemesanan kendaraan dari pelanggan</p>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
        <!-- Total -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Total</p>
            <p class="text-2xl font-bold text-gray-900">{{ $allBookings ?? 0 }}</p>
        </div>
        <!-- Pending -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Menunggu</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $renters->where('status', 'pending')->count() }}</p>
        </div>
        <!-- Confirmed -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Dikonfirmasi</p>
            <p class="text-2xl font-bold text-blue-600">{{ $renters->where('status', 'confirmed')->count() }}</p>
        </div>
        <!-- Running -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Berjalan</p>
            <p class="text-2xl font-bold text-purple-600">{{ $renters->where('status', 'running')->count() }}</p>
        </div>
        <!-- Completed -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Selesai</p>
            <p class="text-2xl font-bold text-green-600">{{ $renters->where('status', 'completed')->count() }}</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
            <span class="text-sm sm:text-base">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 ml-2 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Advanced Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
        <form method="GET" action="{{ route('admin.renter.index') }}" class="space-y-4">
            <!-- Top Row: Search + Dropdowns -->
            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                <!-- Search Input -->
                <div class="flex-1 min-w-0">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari Nomor Booking / Customer"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-sm transition-all"
                        >
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="relative">
                    <select
                        name="status"
                        class="px-4 py-2.5 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent appearance-none cursor-pointer pr-10 transition-all"
                        onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="running" {{ request('status') == 'running' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>

                <!-- Date Filter -->
                <div class="relative">
                    <select
                        name="date_range"
                        class="px-4 py-2.5 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent appearance-none cursor-pointer pr-10 transition-all"
                        onchange="this.form.submit()">
                        <option value="">Pilih Tanggal</option>
                        <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="7days" {{ request('date_range') == '7days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                        <option value="30days" {{ request('date_range') == '30days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                        <option value="this_month" {{ request('date_range') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="custom" {{ request('date_range') == 'custom' ? 'selected' : '' }}>Rentang Custom</option>
                    </select>
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2 flex-wrap">
                    <!-- Add Renter Button -->
                    <a href="{{ route('admin.renter.create') }}"
                       class="flex items-center justify-center gap-2 px-4 py-2.5 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg transition-all whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Penyewa
                    </a>

                    <!-- Print Button -->
                    <button
                        type="button"
                        onclick="window.print()"
                        class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 rounded-lg text-sm font-medium text-gray-700 transition-all whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Cetak
                    </button>

                    <!-- Reset Filters -->
                    @if(request('search') || request('status') || request('date_range'))
                        <a href="{{ route('admin.renter.index') }}"
                           class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 hover:bg-red-50 hover:border-red-300 hover:text-red-600 rounded-lg text-sm font-medium text-gray-700 transition-all whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Desktop Table View (hidden on mobile) -->
    <div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Booking
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Customer
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Kendaraan
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Periode
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($renters as $renter)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Booking Code -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $renter->booking_code }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ str_replace('_', ' ', $renter->service_type) }}</div>
                            </td>

                            <!-- Customer -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $renter->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $renter->user->email }}</div>
                            </td>

                            <!-- Car -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $renter->car->name }}</div>
                                <div class="text-xs text-gray-500">{{ $renter->car->plate_number }}</div>
                            </td>

                            <!-- Date Period -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($renter->start_datetime)->format('d M Y') }}</span>
                                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($renter->end_datetime)->format('d M Y') }}</span>
                                </div>
                            </td>

                            <!-- Total Price -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-gray-900">
                                    Rp {{ number_format($renter->total_price, 0, ',', '.') }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xs font-semibold rounded-lg px-3 py-1 inline-block
                                @if($renter->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($renter->status === 'confirmed') bg-blue-100 text-blue-800
                                @elseif($renter->status === 'running') bg-purple-100 text-purple-800
                                @elseif($renter->status === 'completed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                    {{ ucfirst($renter->status) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="relative inline-block group">
                                    <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                        </svg>
                                    </button>
                                    <div class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-gray-150 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 scale-95 group-hover:scale-100 origin-top-right">
                                        <div class="py-1.5">
                                            <a href="{{ route('admin.renter.workflow', $renter->id) }}"
                                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:text-green-600 hover:bg-green-50 transition-colors duration-150 first:rounded-t-xl">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                <span>Alur Kerja</span>
                                            </a>
                                            <a href="{{ route('admin.renter.show', $renter->id) }}"
                                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-150">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>Detail</span>
                                            </a>
                                            <a href="{{ route('admin.renter.edit', $renter->id) }}"
                                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:text-purple-600 hover:bg-purple-50 transition-colors duration-150">
                                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span>Edit</span>
                                            </a>
                                            <div class="border-t border-gray-100 my-1"></div>
                                            <form action="{{ route('admin.renter.destroy', $renter->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus data penyewaan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150 last:rounded-b-xl">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Data Penyewaan</h3>
                                    <p class="text-gray-500">
                                        @if(request('status'))
                                            Tidak ada penyewaan dengan status "{{ strtoupper(request('status')) }}"
                                        @else
                                            Data penyewaan akan muncul di sini
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Card View (visible on mobile and tablet) -->
    <div class="lg:hidden space-y-4">
        @forelse ($renters as $renter)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <!-- Header: Booking Code & Status -->
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">{{ $renter->booking_code }}</h3>
                        <p class="text-xs text-gray-500 capitalize">{{ str_replace('_', ' ', $renter->service_type) }}</p>
                    </div>
                    <span class="text-xs font-semibold rounded-lg px-2 py-1 inline-block
                    @if($renter->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($renter->status === 'confirmed') bg-blue-100 text-blue-800
                    @elseif($renter->status === 'running') bg-purple-100 text-purple-800
                    @elseif($renter->status === 'completed') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                        {{ ucfirst($renter->status) }}
                    </span>
                </div>

                <!-- Customer Info -->
                <div class="mb-3">
                    <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Customer</h4>
                    <p class="text-sm font-medium text-gray-900">{{ $renter->user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $renter->user->email }}</p>
                </div>

                <!-- Vehicle Info -->
                <div class="mb-3">
                    <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Kendaraan</h4>
                    <p class="text-sm font-medium text-gray-900">{{ $renter->car->name }}</p>
                    <p class="text-xs text-gray-500">{{ $renter->car->plate_number }}</p>
                </div>

                <!-- Period and Price -->
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Periode</h4>
                        <p class="text-xs text-gray-900">{{ \Carbon\Carbon::parse($renter->start_datetime)->format('d M Y') }}</p>
                        <p class="text-xs text-gray-900">{{ \Carbon\Carbon::parse($renter->end_datetime)->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Total</h4>
                        <p class="text-sm font-bold text-gray-900">
                            Rp {{ number_format($renter->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-gray-100 pt-3">
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.renter.workflow', $renter->id) }}"
                           class="text-green-600 hover:text-green-800 font-medium text-sm">
                            Alur Kerja
                        </a>
                        <a href="{{ route('admin.renter.show', $renter->id) }}"
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            Detail
                        </a>
                        <a href="{{ route('admin.renter.edit', $renter->id) }}"
                           class="text-purple-600 hover:text-purple-800 font-medium text-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.renter.destroy', $renter->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Yakin hapus data penyewaan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <div class="flex flex-col items-center justify-center text-center">
                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Data Penyewaan</h3>
                    <p class="text-gray-500 text-sm">
                        @if(request('status'))
                            Tidak ada penyewaan dengan status "{{ strtoupper(request('status')) }}"
                        @else
                            Data penyewaan akan muncul di sini
                        @endif
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($renters->hasPages())
        <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            {{ $renters->links() }}
        </div>
    @endif
</x-admin-layout>
