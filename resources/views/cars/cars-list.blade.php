<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* ===============================
   CONTAINER
=================================*/

.cars-scroll-container {
    position: relative;
    margin-bottom: 3rem;
}

.cars-scroll-wrapper {
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
}

.cars-scroll-wrapper::-webkit-scrollbar {
    display: none;
}

/* ===============================
   MOBILE (2 GRID + SCROLL)
=================================*/

@media (max-width: 767px) {

    .cars-scroll {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: 48%;
        gap: 14px;
        padding-bottom: 20px;
    }

    .scroll-btn {
        display: flex;
    }
}

/* ===============================
   DESKTOP (NO SCROLL)
=================================*/

@media (min-width: 768px) {

    .cars-scroll-wrapper {
        overflow: visible;
    }

    .cars-scroll {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .scroll-btn {
        display: none;
    }
}

/* ===============================
   CARD
=================================*/

.fleet-card {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    height: 260px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.fleet-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.fleet-card:hover img {
    transform: scale(1.05);
}

.fleet-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.9) 0%,
        rgba(0,0,0,0.7) 40%,
        rgba(0,0,0,0.3) 75%,
        rgba(0,0,0,0) 100%
    );
    z-index: 1;
}

.overlay-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 16px;
    z-index: 2;
    color: white;
    text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}

/* ===============================
   MOBILE ARROW BUTTON
=================================*/

.scroll-btn {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.6);
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
}

.scroll-left { left: -8px; }
.scroll-right { right: -8px; }

</style>


<div class="cars-scroll-container">

    <!-- MOBILE ARROW -->
    <div class="scroll-btn scroll-left" onclick="scrollCars(-1)">
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
                        @if(session('just_booked'))
                            <button disabled
                                class="block w-full bg-gray-400 text-gray-600 py-3 rounded-lg font-semibold text-sm text-center cursor-not-allowed">
                                <i class="fa-solid fa-calendar-check mr-2"></i>
                                Baru Saja Booking
                            </button>
                        @else
                            <a href="{{ route('cars.show', $car) }}"
                                class="block w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg font-semibold text-sm text-center transition-all duration-300 shadow-sm hover:shadow-md">
                                <i class="fa-solid fa-calendar-check mr-2"></i>
                                Pesan Sekarang
                            </a>
                        @endif
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

    <div class="scroll-btn scroll-right" onclick="scrollCars(1)">
        <i class="fa-solid fa-chevron-right"></i>
    </div>

    <div class="cars-scroll-wrapper" id="carsWrapper">
        <div class="cars-scroll">

            @forelse($cars as $car)
                <a href="{{ route('cars.show', $car) }}" class="fleet-card">

                    @if ($car->images->first())
                        <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                             alt="{{ $car->name }}">
                    @endif

                    <div class="overlay-content">

                        <h3 class="text-sm font-bold">
                            {{ $car->brand }}
                        </h3>

                        <p class="text-[11px] text-gray-200 mb-2">
                            {{ $car->name }}
                        </p>

                        <!-- RATING -->
                        <div class="flex items-center gap-1 text-yellow-400 text-[11px] mb-2">
                            <i class="fa-solid fa-star"></i>
                            <span class="text-white font-semibold">4.8</span>
                            <span class="text-gray-300">(120)</span>
                        </div>

                        <!-- SPEK -->
                        <div class="flex justify-between text-[10px] text-gray-300 mb-2">
                            <span><i class="fa-solid fa-calendar"></i> {{ $car->year }}</span>
                            <span><i class="fa-solid fa-users"></i> {{ $car->seats }}</span>
                            <span><i class="fa-solid fa-gear"></i> {{ ucfirst($car->transmission) == 'Automatic' ? 'Matic' : 'Manual' }}</span>
                        </div>

                        <!-- PRICE -->
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[9px] text-gray-300">Mulai</p>
                                <span class="text-base font-bold">
                                    Rp {{ number_format($car->price_24h / 1000, 0) }}K
                                </span>
                            </div>

                            <div class="px-2 py-1 rounded-full text-[9px]
                                {{ $car->status == 'available' ? 'bg-green-500/80' : 'bg-red-500/80' }}">
                                {{ $car->status == 'available' ? 'Tersedia' : 'Disewa' }}
                            </div>
                        </div>

                    </div>

                </a>

            @empty
                <div class="text-center py-16 col-span-full">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Tidak Ada Armada
                    </h3>
                </div>
            @endforelse

        </div>
    </div>
</div>


<script>
function scrollCars(direction) {
    const wrapper = document.getElementById('carsWrapper');
    const scrollAmount = wrapper.clientWidth * 0.8;
    wrapper.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}
</script>
