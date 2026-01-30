<div class="cars-scroll-container mb-10">
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
                        <div class="fleet-card overflow-hidden shadow-md">

                            {{-- Image Container --}}
                            <div
                                class="relative h-32 sm:h-48 lg:h-56 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800">
                                @if ($car->images->first())
                                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                                        alt="{{ $car->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <i class="fa-solid fa-car text-4xl sm:text-7xl text-gray-600"></i>
                                    </div>
                                @endif

                                <div class="gradient-overlay absolute inset-0"></div>

                                {{-- Top Badges --}}
                                <div class="absolute top-2 left-2 flex flex-col gap-1">
                                    <span
                                        class="badge-premium px-2 py-0.5 text-gray-900 text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                        <i class="fa-solid fa-crown mr-0.5"></i>PREMIUM
                                    </span>

                                    @if ($car->status === 'available')
                                        <span
                                            class="px-2 py-0.5 bg-green-500 text-white text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                            <i class="fa-solid fa-circle-check mr-0.5"></i>TERSEDIA
                                        </span>
                                    @elseif ($car->status === 'booked')
                                        <span
                                            class="px-2 py-0.5 bg-yellow-500 text-white text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                            <i class="fa-solid fa-clock mr-0.5"></i>DIBOOKING
                                        </span>
                                    @elseif ($car->status === 'rented')
                                        <span
                                            class="px-2 py-0.5 bg-red-500 text-white text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                            <i class="fa-solid fa-circle-xmark mr-0.5"></i>DISEWA
                                        </span>
                                    @elseif ($car->status === 'maintenance')
                                        <span
                                            class="px-2 py-0.5 bg-gray-500 text-white text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                            <i class="fa-solid fa-screwdriver-wrench mr-0.5"></i>MAINTENANCE
                                        </span>
                                    @endif
                                </div>


                                {{-- Rating Badge --}}
                                @php
                                    $avg = $car->reviews->avg('rating');
                                @endphp
                                @if ($avg)
                                    <span
                                        class="badge-status absolute top-2 right-2 px-2 py-0.5 sm:py-1 text-yellow-400 text-[9px] sm:text-xs font-bold rounded-full">
                                        <i class="fa-solid fa-star"></i> {{ number_format($avg, 1) }}
                                    </span>
                                @endif

                                {{-- Bottom Info --}}
                                <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-4">
                                    <h3 class="heading-font text-white text-sm sm:text-lg font-bold mb-0.5 truncate">
                                        {{ $car->brand }}
                                    </h3>
                                    <p class="text-yellow-400 font-semibold text-xs sm:text-base truncate">
                                        {{ $car->name }}</p>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-2 sm:p-4 flex-1 flex flex-col">

                                {{-- Quick Specs Grid --}}
                                <div class="grid grid-cols-2 gap-1.5 sm:gap-2 mb-2 sm:mb-3">
                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">Tahun</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm">
                                            <i class="fa-solid fa-calendar-days text-yellow-500 text-[9px]"></i>
                                            {{ $car->year }}
                                        </p>
                                    </div>

                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">Kapasitas</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm">
                                            <i class="fa-solid fa-users text-yellow-500 text-[9px]"></i>
                                            {{ $car->seats }}
                                        </p>
                                    </div>

                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">Transmisi</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm truncate">
                                            <i class="fa-solid fa-gears text-yellow-500 text-[9px]"></i>
                                            {{ ucfirst($car->transmission) }}
                                        </p>
                                    </div>

                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">BBM</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm truncate">
                                            <i class="fa-solid fa-gas-pump text-yellow-500 text-[9px]"></i>
                                            {{ $car->fuel_type }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Features Icons --}}
                                <div class="grid grid-cols-4 gap-1.5 sm:gap-2 mb-2 sm:mb-3">
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-solid fa-snowflake text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">AC</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-solid fa-shield-halved text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">Safe</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-brands fa-bluetooth-b text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">BT</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-solid fa-camera text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">Cam</span>
                                    </div>
                                </div>

                                {{-- Divider --}}
                                <div class="border-t border-gray-100 my-2 sm:my-3"></div>

                                {{-- Price Section --}}
                                <div
                                    class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg sm:rounded-xl p-2 sm:p-3 mb-2 sm:mb-3 border border-yellow-100">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="text-[9px] sm:text-xs text-gray-600 font-medium">24 Jam</p>
                                        <span
                                            class="text-[8px] sm:text-xs bg-green-100 text-green-700 px-1.5 py-0.5 rounded-full font-bold">
                                            -15%
                                        </span>
                                    </div>
                                    <div class="flex items-end gap-1">
                                        <p class="heading-font text-base sm:text-2xl font-extrabold price-highlight">
                                            {{ number_format($car->price_24h / 1000, 0) }}K
                                        </p>
                                    </div>

                                    {{-- Additional Pricing --}}
                                    <div class="mt-1.5 sm:mt-2 pt-1.5 sm:pt-2 border-t border-yellow-200 space-y-0.5">
                                        <div class="flex items-center justify-between text-[9px] sm:text-xs">
                                            <span class="text-gray-600">12 Jam:</span>
                                            <span
                                                class="font-bold text-gray-800">{{ number_format(($car->price_24h * 0.7) / 1000, 0) }}K</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Button --}}
                                <a href="{{ route('cars.show', $car) }}"
                                    class="btn-primary text-gray-900 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold flex items-center justify-center gap-2 text-xs sm:text-sm mt-auto w-full">
                                    <i class="fa-solid fa-calendar-check"></i>
                                    <span>Pesan Sekarang</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 bg-white rounded-2xl">
                            <i class="fa-solid fa-car-burst text-5xl text-gray-300 mb-3"></i>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Tidak Ada Armada</h3>
                            <p class="text-sm text-gray-500">Coba ubah filter pencarian</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Scroll Indicator Dots --}}
            <div class="scroll-indicator" id="scrollIndicator">
                <!-- Dots will be generated by JavaScript -->
            </div>
        </div>
