<style>
/* Cars Container Styles */
.cars-scroll-container {
    position: relative;
    margin-bottom: 2.5rem;
}

.cars-scroll-wrapper {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    scroll-behavior: smooth;
}

.cars-scroll-wrapper::-webkit-scrollbar {
    display: none;
}

/* Mobile: 2 Column Horizontal Layout */
@media (max-width: 767px) {
    .cars-scroll {
        display: grid;
        grid-auto-flow: column;
        grid-template-rows: repeat(2, 1fr);
        grid-auto-columns: 280px;
        gap: 12px;
        padding-bottom: 60px;
    }
}

/* Desktop: Normal Grid */
@media (min-width: 768px) {
    .cars-scroll {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
}

@media (min-width: 1024px) {
    .cars-scroll {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
}

/* Fleet Cards */
.fleet-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    transition: all 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}

@media (min-width: 768px) {
    .fleet-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
        border-color: #d1d5db;
    }

    .fleet-card:hover img {
        transform: scale(1.05);
    }
}

.fleet-card img {
    transition: transform 0.4s;
}

/* Scroll Navigation Buttons - Mobile Only */
.scroll-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 36px;
    height: 36px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 10;
    cursor: pointer;
    transition: all 0.3s;
    color: #111827;
}

.scroll-nav-btn:hover {
    background: #f9fafb;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.scroll-nav-btn.left {
    left: 8px;
}

.scroll-nav-btn.right {
    right: 8px;
}

@media (min-width: 768px) {
    .scroll-nav-btn {
        display: none;
    }
}

/* Scroll Indicator Dots */
.scroll-indicator {
    display: flex;
    justify-content: center;
    gap: 6px;
    margin-top: 16px;
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}

@media (min-width: 768px) {
    .scroll-indicator {
        display: none;
    }
}

.scroll-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.2);
    transition: all 0.3s;
}

.scroll-dot.active {
    background: #111827;
    width: 20px;
    border-radius: 3px;
}

/* Ensure button is visible */
.fleet-card a {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}
</style>

<div class="cars-scroll-container">
    {{-- Navigation Buttons (Mobile Only) --}}
    <button class="scroll-nav-btn left" id="scrollLeft">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button class="scroll-nav-btn right" id="scrollRight">
        <i class="fa-solid fa-chevron-right"></i>
    </button>

    {{-- Scrollable Wrapper --}}
    <div class="cars-scroll-wrapper" id="carsScrollWrapper">
        <div class="cars-scroll" id="carsScroll">
            @forelse($cars as $car)
                <div class="fleet-card overflow-hidden">

                    {{-- Image Container --}}
                    <div class="relative h-40 sm:h-48 lg:h-56 overflow-hidden bg-gray-100">
                        @if ($car->images->first())
                            <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                                alt="{{ $car->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full bg-gray-50">
                                <i class="fa-solid fa-car text-5xl text-gray-300"></i>
                            </div>
                        @endif

                        {{-- Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                        {{-- Status Badge --}}
                        <div class="absolute top-2 left-2">
                            @if ($car->status === 'available')
                                <span class="px-2.5 py-1 bg-green-500 text-white text-xs font-semibold rounded-full inline-flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Tersedia</span>
                                </span>
                            @elseif ($car->status === 'booked')
                                <span class="px-2.5 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full inline-flex items-center gap-1">
                                    <i class="fa-solid fa-clock"></i>
                                    <span>Dibooking</span>
                                </span>
                            @elseif ($car->status === 'rented')
                                <span class="px-2.5 py-1 bg-red-500 text-white text-xs font-semibold rounded-full inline-flex items-center gap-1">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    <span>Disewa</span>
                                </span>
                            @elseif ($car->status === 'maintenance')
                                <span class="px-2.5 py-1 bg-gray-500 text-white text-xs font-semibold rounded-full inline-flex items-center gap-1">
                                    <i class="fa-solid fa-wrench"></i>
                                    <span>Maintenance</span>
                                </span>
                            @endif
                        </div>

                        {{-- Rating Badge --}}
                        @php
                            $avg = $car->reviews->avg('rating');
                        @endphp
                        @if ($avg)
                            <div class="absolute top-2 right-2 backdrop-blur-md bg-black/40 px-2.5 py-1 rounded-full">
                                <span class="text-yellow-400 text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fa-solid fa-star"></i>
                                    {{ number_format($avg, 1) }}
                                </span>
                            </div>
                        @endif

                        {{-- Bottom Info --}}
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <h3 class="text-white text-base font-bold truncate">
                                {{ $car->brand }}
                            </h3>
                            <p class="text-yellow-400 font-medium text-sm truncate">
                                {{ $car->name }}
                            </p>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-3 sm:p-4 flex flex-col">

                        {{-- Specs Grid --}}
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-calendar text-yellow-500 text-sm"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Tahun</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $car->year }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-users text-yellow-500 text-sm"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Kapasitas</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $car->seats }} Orang</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-gears text-yellow-500 text-sm"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Transmisi</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ ucfirst($car->transmission) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-gas-pump text-yellow-500 text-sm"></i>
                                <div>
                                    <p class="text-xs text-gray-500">BBM</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $car->fuel_type }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-gray-100 my-3"></div>

                        {{-- Price Section --}}
                        <div class="backdrop-blur-md bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl p-3 mb-3 border border-yellow-100">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-xs text-gray-600 font-medium">Harga 24 Jam</p>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold">
                                    Promo
                                </span>
                            </div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-sm text-gray-500">Rp</span>
                                <p class="text-2xl font-bold text-yellow-600">
                                    {{ number_format($car->price_24h / 1000, 0) }}K
                                </p>
                            </div>

                            {{-- Additional Pricing --}}
                            <div class="mt-2 pt-2 border-t border-yellow-200">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-600">12 Jam:</span>
                                    <span class="font-semibold text-gray-800">
                                        Rp {{ number_format(($car->price_24h * 0.7) / 1000, 0) }}K
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <a href="{{ route('cars.show', $car) }}"
                            class="block w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg font-semibold text-sm text-center transition-all duration-300 shadow-sm hover:shadow-md">
                            <i class="fa-solid fa-calendar-check mr-2"></i>
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-2xl">
                    <i class="fa-solid fa-car-burst text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak Ada Armada</h3>
                    <p class="text-sm text-gray-500">Coba ubah filter pencarian Anda</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Scroll Indicator Dots --}}
    <div class="scroll-indicator" id="scrollIndicator"></div>
</div>
