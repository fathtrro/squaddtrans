<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Perpanjangan Sewa</h2>
                <p class="text-sm text-gray-600 mt-1">Kelola permintaan perpanjangan penyewaan dari penyewa</p>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Pending Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-orange-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">PERMINTAAN BARU</h3>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-3xl font-bold text-gray-800">{{ $pendingCount ?? 0 }}</p>
                <p class="text-sm text-orange-600">Memerlukan persetujuan</p>
            </div>
        </div>

        <!-- Approved Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-green-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">DISETUJUI</h3>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-3xl font-bold text-gray-800">{{ $approvedCount ?? 0 }}</p>
                <p class="text-sm text-green-600">Berhasil disetujui</p>
            </div>
        </div>

        <!-- Rejected Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-red-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">DITOLAK</h3>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-3xl font-bold text-gray-800">{{ $rejectedCount ?? 0 }}</p>
                <p class="text-sm text-red-600">Telah ditolak</p>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Tab Headers -->
        <div class="flex border-b border-gray-200" role="tablist">
            <button onclick="switchTab('pending')"
                    id="pending-tab"
                    class="tab-button flex-1 px-6 py-4 text-center font-medium text-sm transition-colors duration-200 border-b-2 border-yellow-400 text-yellow-600 bg-yellow-50"
                    role="tab"
                    aria-selected="true"
                    aria-controls="pending-panel">
                <div class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Menunggu Persetujuan</span>
                </div>
            </button>
            <button onclick="switchTab('approved')"
                    id="approved-tab"
                    class="tab-button flex-1 px-6 py-4 text-center font-medium text-sm transition-colors duration-200 border-b-2 border-transparent text-gray-600 hover:text-gray-800"
                    role="tab"
                    aria-selected="false"
                    aria-controls="approved-panel">
                <div class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Disetujui</span>
                </div>
            </button>
            <button onclick="switchTab('rejected')"
                    id="rejected-tab"
                    class="tab-button flex-1 px-6 py-4 text-center font-medium text-sm transition-colors duration-200 border-b-2 border-transparent text-gray-600 hover:text-gray-800"
                    role="tab"
                    aria-selected="false"
                    aria-controls="rejected-panel">
                <div class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2"></path>
                    </svg>
                    <span>Ditolak</span>
                </div>
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- Pending Tab -->
            <div id="pending-panel" class="tab-panel active" role="tabpanel" aria-labelledby="pending-tab">
                @if($pendingExtensions->count() > 0)
                    <div class="space-y-4">
                        @forelse($pendingExtensions as $extension)
                            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                    <!-- Info Section -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-3 mb-2">
                                                    <h3 class="text-lg font-semibold text-gray-800">
                                                        {{ $extension->booking->car->name ?? 'N/A' }}
                                                    </h3>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                                        Menunggu
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-3">
                                                    <strong>Penyewa:</strong> {{ $extension->booking->user->name ?? 'N/A' }}
                                                </p>
                                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Waktu Saat Ini</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->old_end_datetime->format('d M Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Waktu Baru</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->new_end_datetime->format('d M Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Durasi Tambahan</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->old_end_datetime->diffInHours($extension->new_end_datetime) }} Jam
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Biaya Tambahan</p>
                                                        <p class="text-yellow-600 font-bold mt-1">
                                                            IDR {{ number_format($extension->extra_price, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-col lg:flex-row gap-3 lg:items-center lg:flex-shrink-0">
                                        <form action="{{ route('admin.booking-extensions.approve', $extension->id) }}" method="POST" class="w-full lg:w-auto">
                                            @csrf
                                            <button type="submit" class="w-full lg:w-auto px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span>Setujui</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.booking-extensions.reject', $extension->id) }}" method="POST" class="w-full lg:w-auto">
                                            @csrf
                                            <button type="submit" class="w-full lg:w-auto px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span>Tolak</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada permintaan</h3>
                                <p class="mt-1 text-sm text-gray-500">Belum ada permintaan perpanjangan sewa yang masuk.</p>
                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada permintaan</h3>
                        <p class="mt-1 text-sm text-gray-500">Semua permintaan sudah diproses.</p>
                    </div>
                @endif
            </div>

            <!-- Approved Tab -->
            <div id="approved-panel" class="tab-panel hidden" role="tabpanel" aria-labelledby="approved-tab">
                @if($approvedExtensions->count() > 0)
                    <div class="space-y-4">
                        @forelse($approvedExtensions as $extension)
                            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-3 mb-2">
                                                    <h3 class="text-lg font-semibold text-gray-800">
                                                        {{ $extension->booking->car->name ?? 'N/A' }}
                                                    </h3>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                        Disetujui
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-3">
                                                    <strong>Penyewa:</strong> {{ $extension->booking->user->name ?? 'N/A' }}
                                                </p>
                                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Waktu Saat Ini</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->old_end_datetime->format('d M Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Waktu Baru</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->new_end_datetime->format('d M Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Durasi Tambahan</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->old_end_datetime->diffInHours($extension->new_end_datetime) }} Jam
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Biaya Tambahan</p>
                                                        <p class="text-yellow-600 font-bold mt-1">
                                                            IDR {{ number_format($extension->extra_price, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada yang disetujui</h3>
                                <p class="mt-1 text-sm text-gray-500">Belum ada permintaan perpanjangan yang disetujui.</p>
                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada yang disetujui</h3>
                        <p class="mt-1 text-sm text-gray-500">Tidak ada permintaan yang telah disetujui.</p>
                    </div>
                @endif
            </div>

            <!-- Rejected Tab -->
            <div id="rejected-panel" class="tab-panel hidden" role="tabpanel" aria-labelledby="rejected-tab">
                @if($rejectedExtensions->count() > 0)
                    <div class="space-y-4">
                        @forelse($rejectedExtensions as $extension)
                            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-3 mb-2">
                                                    <h3 class="text-lg font-semibold text-gray-800">
                                                        {{ $extension->booking->car->name ?? 'N/A' }}
                                                    </h3>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                        Ditolak
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-3">
                                                    <strong>Penyewa:</strong> {{ $extension->booking->user->name ?? 'N/A' }}
                                                </p>
                                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Waktu Saat Ini</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->old_end_datetime->format('d M Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Waktu Baru</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->new_end_datetime->format('d M Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Durasi Tambahan</p>
                                                        <p class="text-gray-800 font-medium mt-1">
                                                            {{ $extension->old_end_datetime->diffInHours($extension->new_end_datetime) }} Jam
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Biaya Tambahan</p>
                                                        <p class="text-yellow-600 font-bold mt-1">
                                                            IDR {{ number_format($extension->extra_price, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada yang ditolak</h3>
                                <p class="mt-1 text-sm text-gray-500">Belum ada permintaan perpanjangan yang ditolak.</p>
                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada yang ditolak</h3>
                        <p class="mt-1 text-sm text-gray-500">Tidak ada permintaan yang telah ditolak.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all panels
            document.querySelectorAll('.tab-panel').forEach(panel => {
                panel.classList.add('hidden');
                panel.classList.remove('active');
            });

            // Remove active state from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-yellow-400', 'text-yellow-600', 'bg-yellow-50');
                button.classList.add('border-transparent', 'text-gray-600');
            });

            // Show selected panel
            const panel = document.getElementById(tabName + '-panel');
            if (panel) {
                panel.classList.remove('hidden');
                panel.classList.add('active');
            }

            // Activate selected tab
            const tab = document.getElementById(tabName + '-tab');
            if (tab) {
                tab.classList.remove('border-transparent', 'text-gray-600');
                tab.classList.add('border-yellow-400', 'text-yellow-600', 'bg-yellow-50');
            }
        }
    </script>
</x-admin-layout>
