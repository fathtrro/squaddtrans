<x-app-layout>
    {{-- Fleet Listing Page - SQUADTRANS --}}

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10 pt-0">

    {{-- Hero Search and Title --}}
    <div class="mb-12" data-aos="fade-up">
        <h1 class="text-gray-900 text-4xl md:text-5xl font-extrabold mb-6 bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text">
            Daftar Armada Kami
        </h1>

        <form method="GET" action="{{ route('cars.index') }}" id="filterForm">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                {{-- Search Box --}}
                <div class="w-full md:max-w-xl">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-yellow-500">search</span>
                        </div>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="w-full h-14 pl-12 pr-4 rounded-xl bg-white border-2 border-gray-200 focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 transition-all duration-300 text-gray-900 placeholder:text-gray-400"
                               placeholder="Cari model mobil (e.g. Pajero, Alphard)...">
                    </div>
                </div>

                {{-- Filter Pills --}}
                <div class="flex gap-2 overflow-x-auto no-scrollbar w-full md:w-auto">
                    <button type="button" onclick="filterCategory('all')"
                            class="category-btn flex items-center gap-2 px-6 h-10 {{ request('category', 'all') == 'all' ? 'bg-yellow-500 text-white' : 'bg-white border-2 border-gray-200 text-gray-700' }} rounded-full font-bold text-sm transition-all duration-300 shadow-lg whitespace-nowrap">
                        Semua
                    </button>
                    <button type="button" onclick="filterCategory('SUV')"
                            class="category-btn flex items-center gap-2 px-6 h-10 {{ request('category') == 'SUV' ? 'bg-yellow-500 text-white' : 'bg-white border-2 border-gray-200 text-gray-700' }} rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                        SUV
                    </button>
                    <button type="button" onclick="filterCategory('MPV')"
                            class="category-btn flex items-center gap-2 px-6 h-10 {{ request('category') == 'MPV' ? 'bg-yellow-500 text-white' : 'bg-white border-2 border-gray-200 text-gray-700' }} rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                        MPV
                    </button>
                    <button type="button" onclick="filterCategory('Luxury')"
                            class="category-btn flex items-center gap-2 px-6 h-10 {{ request('category') == 'Luxury' ? 'bg-yellow-500 text-white' : 'bg-white border-2 border-gray-200 text-gray-700' }} rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                        Luxury
                    </button>
                    <button type="button" onclick="filterCategory('Ekonomis')"
                            class="category-btn flex items-center gap-2 px-6 h-10 {{ request('category') == 'Ekonomis' ? 'bg-yellow-500 text-white' : 'bg-white border-2 border-gray-200 text-gray-700' }} rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                        Ekonomis
                    </button>
                </div>
                <input type="hidden" name="category" id="categoryInput" value="{{ request('category', 'all') }}">
            </div>
        </form>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Sidebar Filter --}}
        <aside class="w-full lg:w-80 shrink-0">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 sticky top-28" data-aos="fade-right">
                <form method="GET" action="{{ route('cars.index') }}" id="sidebarFilter">
                    <div class="flex flex-col gap-6">
                        {{-- Header --}}
                        <div>
                            <h3 class="text-gray-900 text-xl font-bold mb-1">Filter Lanjutan</h3>
                            <p class="text-gray-500 text-sm">Sesuaikan pencarian Anda</p>
                        </div>

                        {{-- Keep search and category --}}
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="category" value="{{ request('category', 'all') }}">

                        {{-- Price Range --}}
                        <div class="flex flex-col gap-3 pb-6 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-yellow-600">payments</span>
                                </div>
                                <p class="text-gray-900 font-semibold">Rentang Harga</p>
                            </div>
                            <div class="px-2">
                                <input type="range" name="max_price" min="500000" max="5000000" step="100000" value="{{ request('max_price', 5000000) }}"
                                       class="w-full h-2 bg-gray-200 rounded-full appearance-none cursor-pointer accent-yellow-500"
                                       oninput="document.getElementById('priceDisplay').textContent = 'Rp ' + (this.value/1000) + 'rb'">
                                <div class="flex justify-between mt-3">
                                    <span class="text-xs font-medium text-gray-500">Rp 500rb</span>
                                    <span class="text-xs font-medium text-gray-500" id="priceDisplay">Rp {{ request('max_price', 5000000)/1000 }}rb</span>
                                </div>
                                <input type="hidden" name="min_price" value="500000">
                            </div>
                        </div>

                        {{-- Year Filter --}}
                        <div class="flex flex-col gap-3 pb-6 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-yellow-600">calendar_today</span>
                                </div>
                                <p class="text-gray-900 font-semibold">Tahun Kendaraan</p>
                            </div>
                            <div class="flex flex-col gap-3 pl-2">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="year_range" value="2023-2024" {{ request('year_range') == '2023-2024' ? 'checked' : '' }}
                                           class="w-5 h-5 border-gray-300 text-yellow-500 focus:ring-yellow-500">
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-600 transition-colors">2023 - 2024</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="year_range" value="2020-2022" {{ request('year_range') == '2020-2022' ? 'checked' : '' }}
                                           class="w-5 h-5 border-gray-300 text-yellow-500 focus:ring-yellow-500">
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-600 transition-colors">2020 - 2022</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="year_range" value="below-2020" {{ request('year_range') == 'below-2020' ? 'checked' : '' }}
                                           class="w-5 h-5 border-gray-300 text-yellow-500 focus:ring-yellow-500">
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-600 transition-colors">&lt; 2020</span>
                                </label>
                            </div>
                        </div>

                        {{-- Fuel Type --}}
                        <div class="flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-yellow-600">local_gas_station</span>
                                </div>
                                <p class="text-gray-900 font-semibold">Tipe Bahan Bakar</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(['Bensin', 'Diesel', 'Electric', 'Hybrid'] as $fuel)
                                    <button type="button" onclick="selectFuel('{{ $fuel }}')"
                                            class="fuel-btn px-4 py-2.5 {{ request('fuel_type') == $fuel ? 'bg-yellow-100 border-2 border-yellow-500 text-yellow-700' : 'bg-gray-50 border-2 border-gray-200 text-gray-700' }} rounded-xl text-sm font-medium hover:border-yellow-400 hover:bg-yellow-50 transition-all">
                                        {{ $fuel }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="fuel_type" id="fuelInput" value="{{ request('fuel_type') }}">
                        </div>

                        {{-- Apply Button --}}
                        <button type="submit" class="w-full mt-2 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        {{-- Fleet Grid --}}
        <div class="flex-1">
            @if($cars->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($cars as $index => $car)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:border-yellow-400"
                             data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                            <div class="relative h-56 overflow-hidden bg-gray-100">
                                @if($car->status == 'available' && $index == 0)
                                    <div class="absolute top-4 left-4 z-10 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg animate-pulse">
                                        TERPOPULER
                                    </div>
                                @endif
                                @if($car->status == 'booked')
                                    <div class="absolute top-4 right-4 z-10 bg-red-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                                        DIPESAN
                                    </div>
                                @endif
                                <img src="{{ $car->main_image }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                     alt="{{ $car->name }}">
                            </div>
                            <div class="p-6">
                                <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600 transition-colors">
                                    {{ $car->brand }} {{ $car->name }}
                                </h4>
                                <p class="text-sm text-gray-500 mb-4">Model {{ $car->year }} • {{ $car->category ?? 'SUV' }}</p>

                                <div class="grid grid-cols-3 gap-2 mb-5">
                                    <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                        <span class="material-symbols-outlined text-yellow-500 text-lg">groups</span>
                                        <span class="text-xs text-gray-700 font-medium mt-1">{{ $car->seats ?? 7 }} Seats</span>
                                    </div>
                                    <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                        <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                        <span class="text-xs text-gray-700 font-medium mt-1">{{ $car->transmission ?? 'Auto' }}</span>
                                    </div>
                                    <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                        <span class="material-symbols-outlined text-yellow-500 text-lg">ev_station</span>
                                        <span class="text-xs text-gray-700 font-medium mt-1">{{ $car->fuel_type ?? 'Bensin' }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                        <p class="text-2xl font-extrabold text-gray-900">
                                            {{ $car->formatted_price_24h }}
                                            <span class="text-sm font-normal text-gray-500">/hari</span>
                                        </p>
                                    </div>
                                    <a href="#"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg {{ $car->status != 'available' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                       {{ $car->status != 'available' ? 'onclick="return false;"' : '' }}>
                                        {{ $car->status == 'available' ? 'Pesan' : 'Tidak Tersedia' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex items-center justify-center mt-16 gap-2" data-aos="fade-up">
                    {{ $cars->links('pagination::tailwind') }}
                </div>
            @else
                <div class="text-center py-20">
                    <span class="material-symbols-outlined text-gray-300 text-8xl mb-4">directions_car</span>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Tidak Ada Kendaraan Ditemukan</h3>
                    <p class="text-gray-500">Coba ubah filter pencarian Anda</p>
                </div>
            @endif
        </div>

    </div>
</main>

<script>
function filterCategory(category) {
    document.getElementById('categoryInput').value = category;
    document.getElementById('filterForm').submit();
}

function selectFuel(fuel) {
    const currentFuel = document.getElementById('fuelInput').value;
    document.getElementById('fuelInput').value = currentFuel === fuel ? '' : fuel;
}
</script>
</x-app-layout>
