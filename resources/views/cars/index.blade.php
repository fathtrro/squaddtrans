<x-app-layout>
    {{-- Fleet Listing Page - SQUADTRANS --}}

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10 pt-0">

    {{-- Hero Section --}}
    <div class="mb-12" data-aos="fade-up">
        <h1 class="text-gray-900 text-4xl md:text-5xl font-extrabold mb-6">
            Daftar Armada Kami
        </h1>
    </div>

    {{-- Cars Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($cars as $car)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">

                {{-- Image Section --}}
                <div class="relative h-64 bg-gray-900 overflow-hidden">
                    @if($car->images->first())
                        <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                             alt="{{ $car->brand }} {{ $car->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                            <span class="material-symbols-outlined text-6xl text-gray-400">directions_car</span>
                        </div>
                    @endif

                    {{-- Badges --}}
                    <div class="absolute top-4 left-4 flex gap-2">
                        <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full">
                            Premium XSUV
                        </span>
                        @php
                            $reviews = $car->reviews;
                            $avgRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
                            $reviewCount = $reviews->count();
                        @endphp
                        @if($reviewCount > 0)
                            <span class="px-3 py-1 bg-gray-800 bg-opacity-90 text-yellow-400 text-xs font-bold rounded-full">
                                ⭐ {{ number_format($avgRating, 1) }} ({{ $reviewCount }} Reviews)
                            </span>
                        @endif
                    </div>

                    {{-- Car Name Overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black via-black/50 to-transparent p-6">
                        <h3 class="text-2xl font-bold text-white">{{ $car->brand }} {{ $car->name }}</h3>
                    </div>
                </div>

                {{-- Content Section --}}
                <div class="p-6">
                    {{-- Specifications --}}
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h4 class="text-sm font-bold text-yellow-600 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined">settings</span>
                            Spesifikasi Kendaraan
                        </h4>

                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600 font-medium">Tipe Mesin</p>
                                <p class="text-gray-900 font-semibold">{{ $car->fuel_type }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Performa</p>
                                <p class="text-gray-900 font-semibold">Kapasitas: {{ $car->seats }} Kursi</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Transmisi</p>
                                <p class="text-gray-900 font-semibold">{{ ucfirst($car->transmission) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Tahun</p>
                                <p class="text-gray-900 font-semibold">{{ $car->year }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Features --}}
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h4 class="text-sm font-bold text-yellow-600 mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            Fitur Utama
                        </h4>
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <label class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-500">check</span>
                                <span class="text-gray-700">AC</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-500">check</span>
                                <span class="text-gray-700">{{ $car->seats }} Seats</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-500">check</span>
                                <span class="text-gray-700">Airbag</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-500">check</span>
                                <span class="text-gray-700">Audio BT</span>
                            </label>
                        </div>
                    </div>

                    {{-- Pricing --}}
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h4 class="text-sm font-bold text-gray-900 mb-3">Harga Sewa</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Lepas Kunci (24 jam)</span>
                                <span class="text-lg font-bold text-yellow-600">Rp {{ number_format($car->price_24h, 0, ',', '.') }}</span>
                            </div>
                            @if($car->price_with_driver)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Dengan Sopir (24 jam)</span>
                                    <span class="text-lg font-bold text-yellow-600">Rp {{ number_format($car->price_with_driver, 0, ',', '.') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('cars.show', $car) }}"
                           class="px-4 py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold text-sm rounded-lg transition-colors text-center">
                            Lihat Detail
                        </a>
                        <a href="{{ route('bookings.create', ['car' => $car->id, 'service_type' => 'dengan_sopir']) }}"
                           class="px-4 py-3 bg-gray-900 hover:bg-black text-white font-bold text-sm rounded-lg transition-colors text-center">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-5xl text-gray-400">directions_car</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Mobil Tersedia</h3>
                <p class="text-gray-600 mb-6">Maaf, tidak ada mobil yang sesuai dengan kriteria pencarian Anda.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($cars->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $cars->links() }}
        </div>
    @endif

</main>
</x-app-layout>
