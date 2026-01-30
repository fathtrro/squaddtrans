<x-admin-layout>
    <x-slot name="header">Data Penyewaan</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <p class="text-gray-600">Kelola dan pantau seluruh transaksi penyewaan kendaraan.</p>
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

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-4 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Filter Labels and Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                <!-- Filter Label -->
                <div class="flex items-center px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 w-fit">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">Filter:</span>
                </div>

                <!-- Filter Buttons - Mobile: Grid, Desktop: Flex -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:flex gap-2">
                    <a href="{{ route('admin.renter.index') }}"
                       class="px-3 py-2 text-xs sm:text-sm font-medium text-center {{ !request('status') ? 'text-yellow-700 bg-yellow-50 border-2 border-yellow-400' : 'text-gray-700 bg-white border border-gray-200' }} rounded-lg hover:bg-yellow-100 transition-colors">
                        SEMUA
                    </a>
                    <a href="{{ route('admin.renter.index', ['status' => 'pending']) }}"
                       class="px-3 py-2 text-xs sm:text-sm font-medium text-center {{ request('status') == 'pending' ? 'text-yellow-700 bg-yellow-50 border-2 border-yellow-400' : 'text-gray-700 bg-white border border-gray-200' }} rounded-lg hover:bg-yellow-100 transition-colors">
                        PENDING
                    </a>
                    <a href="{{ route('admin.renter.index', ['status' => 'confirmed']) }}"
                       class="px-3 py-2 text-xs sm:text-sm font-medium text-center {{ request('status') == 'confirmed' ? 'text-blue-700 bg-blue-50 border-2 border-blue-400' : 'text-gray-700 bg-white border border-gray-200' }} rounded-lg hover:bg-blue-100 transition-colors">
                        CONFIRMED
                    </a>
                    <a href="{{ route('admin.renter.index', ['status' => 'running']) }}"
                       class="px-3 py-2 text-xs sm:text-sm font-medium text-center {{ request('status') == 'running' ? 'text-purple-700 bg-purple-50 border-2 border-purple-400' : 'text-gray-700 bg-white border border-gray-200' }} rounded-lg hover:bg-purple-100 transition-colors">
                        RUNNING
                    </a>
                    <a href="{{ route('admin.renter.index', ['status' => 'completed']) }}"
                       class="px-3 py-2 text-xs sm:text-sm font-medium text-center {{ request('status') == 'completed' ? 'text-green-700 bg-green-50 border-2 border-green-400' : 'text-gray-700 bg-white border border-gray-200' }} rounded-lg hover:bg-green-100 transition-colors">
                        COMPLETED
                    </a>
                    <a href="{{ route('admin.renter.index', ['status' => 'cancelled']) }}"
                       class="px-3 py-2 text-xs sm:text-sm font-medium text-center {{ request('status') == 'cancelled' ? 'text-red-700 bg-red-50 border-2 border-red-400' : 'text-gray-700 bg-white border border-gray-200' }} rounded-lg hover:bg-red-100 transition-colors">
                        CANCELLED
                    </a>
                </div>
            </div>

            <!-- Print Button -->
            <div class="flex justify-center sm:justify-end">
                <button onclick="window.print()" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-xs sm:text-sm font-medium text-gray-700 transition-all w-full sm:w-auto justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print
                </button>
            </div>
        </div>
    </div>

    <!-- Desktop Table View (hidden on mobile) -->
    <div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Booking
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kendaraan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Periode
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                <form action="{{ route('admin.renter.update', $renter->id) }}"
                                      method="POST"
                                      class="status-form">
                                    @csrf
                                    @method('PUT')
                                    <select name="status"
                                            class="text-xs font-semibold rounded-lg border-0 focus:ring-2 focus:ring-yellow-500 cursor-pointer px-3 py-1
                                            @if($renter->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($renter->status === 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($renter->status === 'running') bg-purple-100 text-purple-800
                                            @elseif($renter->status === 'completed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif"
                                            onchange="if(confirm('Yakin ingin mengubah status booking?')) { this.form.submit(); } else { this.value='{{ $renter->status }}'; }">
                                        <option value="pending" {{ $renter->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $renter->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="running" {{ $renter->status === 'running' ? 'selected' : '' }}>Running</option>
                                        <option value="completed" {{ $renter->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $renter->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.renter.show', $renter->id) }}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">
                                        Detail
                                    </a>
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('admin.renter.destroy', $renter->id) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Yakin hapus data penyewaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                            Hapus
                                        </button>
                                    </form>
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
                    <form action="{{ route('admin.renter.update', $renter->id) }}"
                          method="POST"
                          class="status-form">
                        @csrf
                        @method('PUT')
                        <select name="status"
                                class="text-xs font-semibold rounded-lg border-0 focus:ring-2 focus:ring-yellow-500 cursor-pointer px-2 py-1
                                @if($renter->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($renter->status === 'confirmed') bg-blue-100 text-blue-800
                                @elseif($renter->status === 'running') bg-purple-100 text-purple-800
                                @elseif($renter->status === 'completed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif"
                                onchange="if(confirm('Yakin ingin mengubah status booking?')) { this.form.submit(); } else { this.value='{{ $renter->status }}'; }">
                            <option value="pending" {{ $renter->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $renter->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="running" {{ $renter->status === 'running' ? 'selected' : '' }}>Running</option>
                            <option value="completed" {{ $renter->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $renter->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
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
                        <a href="{{ route('admin.renter.show', $renter->id) }}"
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            Detail
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
