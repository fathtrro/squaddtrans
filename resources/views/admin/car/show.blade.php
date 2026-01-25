{{-- resources/views/admin/car/show.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Detail Armada</x-slot>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-yellow-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.car.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-yellow-600 md:ml-2">Armada</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Action Buttons -->
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">{{ $car->name }}</h2>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.car.edit', $car->id) }}"
               class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.car.destroy', $car->id) }}"
                  method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus armada {{ $car->name }}? Data yang dihapus tidak dapat dikembalikan.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Images -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Main Image -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                @php
                    $mainImage = $car->image ? asset('storage/' . $car->image) : ($car->images->first() ? asset('storage/' . $car->images->first()->image_path) : 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800&h=600&fit=crop');
                @endphp
                <img id="mainImage"
                     src="{{ $mainImage }}"
                     alt="{{ $car->name }}"
                     class="w-full h-96 object-cover">
            </div>

            <!-- Image Gallery -->
            @if($car->images->count() > 0 || $car->image)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    <h3 class="font-semibold text-gray-800 mb-4">Galeri Foto</h3>
                    <div class="grid grid-cols-4 md:grid-cols-6 gap-3">
                        @if($car->image)
                            <button onclick="changeMainImage('{{ asset('storage/' . $car->image) }}')"
                                    class="gallery-thumb aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-yellow-400 transition-all">
                                <img src="{{ asset('storage/' . $car->image) }}"
                                     alt="{{ $car->name }}"
                                     class="w-full h-full object-cover">
                            </button>
                        @endif
                        @foreach($car->images as $image)
                            <button onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
                                    class="gallery-thumb aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-yellow-400 transition-all">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     alt="{{ $car->name }}"
                                     class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Description Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 text-lg">Deskripsi Kendaraan</h3>
                <div class="prose max-w-none text-gray-600">
                    <p>{{ $car->name }} adalah kendaraan {{ $car->brand }} tahun {{ $car->year }} dengan nomor polisi {{ $car->plate_number }}. Kendaraan ini tersedia untuk disewakan dengan harga yang kompetitif dan kondisi yang prima.</p>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                @php
                    $statusConfig = [
                        'available' => [
                            'label' => 'Tersedia',
                            'class' => 'bg-green-100 text-green-800 border-green-200',
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        'booked' => [
                            'label' => 'Dipesan',
                            'class' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        'rented' => [
                            'label' => 'Sedang Disewa',
                            'class' => 'bg-orange-100 text-orange-800 border-orange-200',
                            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        'maintenance' => [
                            'label' => 'Dalam Servis',
                            'class' => 'bg-red-100 text-red-800 border-red-200',
                            'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
                        ],
                    ];
                    $status = $statusConfig[$car->status] ?? ['label' => ucfirst($car->status), 'class' => 'bg-gray-100 text-gray-800 border-gray-200', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                @endphp

                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-gray-800">Status Kendaraan</h3>
                </div>
                <div class="flex items-center px-4 py-3 {{ $status['class'] }} border rounded-lg">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $status['icon'] }}"></path>
                    </svg>
                    <span class="font-semibold text-lg">{{ $status['label'] }}</span>
                </div>
            </div>

            <!-- Price Card -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl shadow-sm border border-yellow-200 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Harga Sewa
                </h3>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg p-4 border border-yellow-300">
                        <p class="text-sm text-gray-600 mb-1">Sewa 12 Jam</p>
                        <p class="text-2xl font-bold text-yellow-600">
                            Rp {{ number_format($car->price_12h, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Per 12 jam</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 border border-yellow-300">
                        <p class="text-sm text-gray-600 mb-1">Sewa 24 Jam</p>
                        <p class="text-2xl font-bold text-yellow-600">
                            Rp {{ number_format($car->price_24h, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Per hari (24 jam)</p>
                    </div>
                </div>
            </div>

            <!-- Vehicle Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Informasi Kendaraan</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Nama Kendaraan</p>
                            <p class="font-semibold text-gray-800">{{ $car->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Merek</p>
                            <p class="font-semibold text-gray-800">{{ $car->brand }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Nomor Polisi</p>
                            <p class="font-semibold text-gray-800">{{ $car->plate_number }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Tahun Pembuatan</p>
                            <p class="font-semibold text-gray-800">{{ $car->year }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Ditambahkan</p>
                            <p class="font-semibold text-gray-800">{{ $car->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Terakhir Diupdate</p>
                            <p class="font-semibold text-gray-800">{{ $car->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.car.edit', $car->id) }}"
                       class="flex items-center justify-center w-full px-4 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors border border-blue-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Kendaraan
                    </a>
                    <a href="{{ route('admin.car.index') }}"
                       class="flex items-center justify-center w-full px-4 py-3 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors border border-gray-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function changeMainImage(imageSrc) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = imageSrc;

            // Add animation
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.style.opacity = '1';
            }, 100);
        }
    </script>
    @endpush

    @push('styles')
    <style>
        #mainImage {
            transition: opacity 0.3s ease-in-out;
        }

        .gallery-thumb:hover {
            transform: scale(1.05);
        }

        .gallery-thumb {
            transition: all 0.2s ease-in-out;
        }
    </style>
    @endpush
</x-admin-layout>
