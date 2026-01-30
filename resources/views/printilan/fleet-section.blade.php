 <section class="py-24 bg-white" id="units">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div>
                        <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">
                            Armada Kami
                        </span>
                        <h2 class="section-title">Pilih Unit Favorit Anda</h2>
                    </div>

                    <a href="{{ route('cars.index') }}"
                        class="text-yellow-600 hover:text-yellow-700 font-bold flex items-center gap-2 transition-colors">
                        Lihat Semua Armada
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                </div>

                @if ($cars->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                        @foreach ($cars as $car)
                            {{-- Vehicle Card --}}
                            <div
                                class="group bg-white rounded-3xl overflow-hidden border border-slate-100 card-shadow transition-all hover:-translate-y-2">

                                <div class="relative h-64 overflow-hidden bg-slate-100">
                                    @if ($car->images->first())
                                        <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                                            alt="{{ $car->brand }} {{ $car->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                            <i class="fa-solid fa-car-side text-6xl text-gray-400"></i>
                                        </div>
                                    @endif

                                    <div class="absolute top-4 left-4 flex gap-2">
                                        <span
                                            class="bg-gray-900/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
                                            {{ $car->category ?? 'Premium' }}
                                        </span>

                                        @php
                                            $reviews = $car->reviews;
                                            $avgRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
                                        @endphp

                                        @if ($reviews->count() > 0)
                                            <span
                                                class="bg-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                                                <i class="fa-solid fa-star text-xs"></i> {{ $avgRating }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-8">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-xl font-extrabold text-gray-900">
                                            {{ $car->brand }} {{ $car->name }}
                                        </h3>

                                        @if ($reviews->count() > 0)
                                            <span class="text-sm font-bold text-slate-600">
                                                {{ number_format($avgRating, 1) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-3 gap-2 mb-8">
                                        <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                            <i class="fa-solid fa-user-group text-slate-400 text-lg"></i>
                                            <span class="text-xs font-bold text-slate-500 uppercase">
                                                {{ $car->seats }} Kursi
                                            </span>
                                        </div>

                                        <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                            <i class="fa-solid fa-gear text-slate-400 text-lg"></i>
                                            <span class="text-xs font-bold text-slate-500 uppercase">
                                                {{ ucfirst($car->transmission) }}
                                            </span>
                                        </div>

                                        <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                            <i class="fa-solid fa-gas-pump text-slate-400 text-lg"></i>
                                            <span class="text-xs font-bold text-slate-500 uppercase">
                                                {{ $car->fuel_type }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <p class="text-2xl font-black text-gray-900">
                                            Rp {{ number_format($car->price_24h, 0, ',', '.') }}
                                            <span class="text-sm font-normal text-slate-400">/hari</span>
                                        </p>

                                        <a href="{{ route('bookings.create', $car) }}"
                                            class="bg-slate-900 text-white p-3 rounded-xl hover:bg-yellow-600 transition-colors">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">
                            Belum ada armada yang tersedia. Silakan kembali lagi nanti.
                        </p>
                    </div>
                @endif

            </div>
        </section>
