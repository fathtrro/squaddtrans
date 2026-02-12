{{-- resources/views/admin/armada/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Inventaris Armada</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <p class="text-gray-600">Kelola dan pantau seluruh unit kendaraan operasional.</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif
<!-- Filter Bar - Compact Version -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.car.index') }}" class="flex-1 max-w-md">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari armada..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                <input type="hidden" name="status" value="{{ request('status') }}">

                @if(request('search'))
                <a href="{{ route('admin.car.index', ['status' => request('status')]) }}"
                   class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
                @endif
            </div>
        </form>

        <!-- Status Filter Pills -->
        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('admin.car.index', array_filter(['search' => request('search')])) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ !request('status') ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : 'bg-gray-50 text-gray-600 border border-transparent hover:border-gray-200' }}">
                Semua ({{ $totalCars }})
            </a>

            <a href="{{ route('admin.car.index', array_filter(['status' => 'available', 'search' => request('search')])) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ request('status') == 'available' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-50 text-gray-600 border border-transparent hover:border-gray-200' }}">
                Tersedia ({{ $availableCars }})
            </a>

            <a href="{{ route('admin.car.index', array_filter(['status' => 'rented', 'search' => request('search')])) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ request('status') == 'rented' ? 'bg-orange-50 text-orange-700 border border-orange-200' : 'bg-gray-50 text-gray-600 border border-transparent hover:border-gray-200' }}">
                Disewa ({{ $rentedCars }})
            </a>

            <a href="{{ route('admin.car.index', array_filter(['status' => 'maintenance', 'search' => request('search')])) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ request('status') == 'maintenance' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-gray-50 text-gray-600 border border-transparent hover:border-gray-200' }}">
                Servis ({{ $maintenanceCars }})
            </a>
        </div>

        <!-- Add Button -->
        <a href="{{ route('admin.car.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 shadow-sm font-medium transition-all whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Armada
        </a>
    </div>
</div>

    <!-- Fleet Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-6">
        @forelse($cars as $car)
            <!-- Vehicle Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Clickable Image -->
                <a href="{{ route('admin.car.show', $car->id) }}" class="block relative group">
                    <img src="{{ $car->image ? asset('storage/' . $car->image) : ($car->images->first() ? asset('storage/' . $car->images->first()->image_path) : 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=400&h=250&fit=crop') }}"
                         alt="{{ $car->name }}"
                         class="w-full h-48 object-cover group-hover:opacity-90 transition-opacity">

                    <!-- Overlay on hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all flex items-center justify-center">
                        <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity font-semibold">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </span>
                    </div>

                    @php
                        $statusConfig = [
                            'available' => ['label' => 'TERSEDIA', 'class' => 'text-green-800 bg-green-100'],
                            'booked' => ['label' => 'DIPESAN', 'class' => 'text-blue-800 bg-blue-100'],
                            'rented' => ['label' => 'DISEWA', 'class' => 'text-orange-800 bg-orange-100'],
                            'maintenance' => ['label' => 'SERVIS', 'class' => 'text-red-800 bg-red-100'],
                        ];
                        $status = $statusConfig[$car->status] ?? ['label' => strtoupper($car->status), 'class' => 'text-gray-800 bg-gray-100'];
                    @endphp

                    <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold {{ $status['class'] }} rounded-full shadow-sm">
                        {{ $status['label'] }}
                    </span>
                </a>

                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <!-- Clickable Title -->
                        <a href="{{ route('admin.car.show', $car->id) }}" class="flex-1">
                            <h3 class="font-bold text-gray-800 text-base hover:text-yellow-600 transition-colors">{{ $car->name }}</h3>
                        </a>

                        <div class="relative dropdown">
                            <button class="text-gray-400 hover:text-gray-600 dropdown-toggle" type="button">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10 py-1">
                                <a href="{{ route('admin.car.show', $car->id) }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Detail
                                </a>
                                <a href="{{ route('admin.car.edit', $car->id) }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <hr class="my-1">
                                <form action="{{ route('admin.car.destroy', $car->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus armada {{ $car->name }}?')"
                                      class="block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600 mb-3">
                        <span class="font-semibold">{{ $car->plate_number }}</span> •
                        {{ $car->brand }} •
                        {{ $car->year }}
                    </p>

                    <div class="pt-3 border-t border-gray-100">
                        <div class="space-y-1">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">12 Jam:</span>
                                <span class="text-sm font-bold text-yellow-600">Rp {{ number_format($car->price_12h, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">24 Jam:</span>
                                <span class="text-sm font-bold text-yellow-600">Rp {{ number_format($car->price_24h, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-span-full">
                <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Data Armada</h3>
                    <p class="text-gray-500 mb-4">
                        @if(request('status'))
                            Tidak ada armada dengan status "{{ strtoupper(request('status')) }}"
                        @else
                            Mulai tambahkan armada untuk mengelola kendaraan operasional.
                        @endif
                    </p>
                    <a href="{{ route('admin.car.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 shadow-sm font-medium transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Armada Pertama
                    </a>
                </div>
            </div>
        @endforelse

        <!-- Add New Card (Only show when there are cars) -->
        @if($cars->count() > 0)
            <a href="{{ route('admin.car.create') }}"
               class="bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 overflow-hidden hover:border-yellow-400 hover:bg-yellow-50 transition-all cursor-pointer group">
                <div class="h-full flex flex-col items-center justify-center p-8 text-center min-h-[320px]">
                    <div class="w-16 h-16 bg-gray-200 group-hover:bg-yellow-100 rounded-full flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-8 h-8 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-700 mb-2 group-hover:text-yellow-700 transition-colors">Tambah Armada Baru</h3>
                    <p class="text-sm text-gray-500">Klik untuk menambahkan unit kendaraan baru ke sistem.</p>
                </div>
            </a>
        @endif
    </div>

    <!-- Pagination -->
    @if($cars->hasPages())
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            {{ $cars->links() }}
        </div>
    @endif

    @push('scripts')
    <script>
        // Dropdown toggle
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const menu = this.nextElementSibling;

                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if (m !== menu) {
                            m.classList.add('hidden');
                        }
                    });

                    // Toggle current dropdown
                    menu.classList.toggle('hidden');
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });

            // Prevent dropdown from closing when clicking inside
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>
