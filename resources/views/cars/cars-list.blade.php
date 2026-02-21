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
