<x-app-layout>

    {{-- Custom Styles --}}
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
            rel="stylesheet" />
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }

            .nav-link {
                @apply font-medium text-slate-700 hover:text-yellow-600 transition-colors duration-200;
            }

            .btn-primary {
                @apply bg-yellow-600 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg;
            }

            .section-title {
                @apply text-3xl md:text-4xl font-extrabold text-slate-900 mb-4;
            }

            .card-shadow {
                @apply shadow-lg hover:shadow-xl transition-shadow duration-300;
            }
        </style>
    @endpush

    <div class="bg-gray-50">
        {{-- Hero Section --}}
        <header class="relative w-full h-[500px] overflow-hidden"
            style="background-image: url('{{ asset('images/123.jpeg') }}');
           background-size: cover;
           background-position: center;">

            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent">
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col items-center justify-start pt-4">
                    <div class="max-w-2xl text-center">
                        <span
                            class="inline-block py-1 px-4 bg-yellow-600/20 backdrop-blur-md border border-yellow-600/30 text-yellow-500 font-bold rounded-full text-xs tracking-widest uppercase mb-6">Premium
                            Travel Experience</span>
                        <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                            Eksplorasi Tanpa Batas dengan <span class="text-yellow-500">Kenyamanan</span> Maksimal
                        </h1>
                        <p class="text-xl text-slate-200 mb-10 leading-relaxed">
                            Layanan sewa mobil eksklusif dan paket wisata personal di Indonesia dengan standar pelayanan
                            bintang lima.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        {{-- Search Section (pill over hero, no card) --}}
        <section class="relative z-20 max-w-6xl mx-auto -mt-32 px-4 mb-0 pb-12">
            <!-- Search pill sits above the card area and over the hero background -->
            <div class="w-full flex justify-center -mt-0">
                <div class="w-full md:w-3/4 lg:w-2/3">
                    <div class="relative">
                        <div
                            class="flex items-center bg-white rounded-full p-2 shadow-2xl w-full border border-slate-200">
                            <i class="fa-solid fa-car absolute left-6 text-slate-400 text-sm"></i>
                            <input type="text" id="carSearchInput"
                                placeholder="Cari merk atau model mobil yang Anda inginkan..."
                                class="w-full pl-14 pr-4 py-3 bg-transparent border-none rounded-full focus:outline-none text-sm"
                                autocomplete="off" />

                        </div>

                        <!-- Autocomplete dropdown -->
                        <div id="carSearchResults"
                            class="hidden absolute top-full left-0 right-0 mt-3 bg-white border-2 border-slate-200 rounded-xl shadow-lg z-50 max-h-72 overflow-y-auto">
                            <!-- Results akan ditampilkan di sini -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-0 overflow-hidden mt-6">
                <!-- Feature / Quick Links pill bar -->
                <div class="bg-[#f7f3ee] rounded-3xl p-3 lg:p-4">
                    <div class="max-w-7xl mx-auto px-2">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex-1 overflow-x-auto">
                                <div class="flex items-center divide-x divide-slate-200/60">
                                    <div class="flex items-center gap-3 px-4 py-2">
                                        <div
                                            class="w-10 h-10 bg-slate-800 text-white rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-bold text-sm text-slate-800">Holiday Listings</div>
                                            <div class="text-xs text-slate-500">Pilih lokasi</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 px-4 py-2">
                                        <div
                                            class="w-10 h-10 bg-slate-800 text-white rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-bold text-sm text-slate-800">Featured Villas</div>
                                            <div class="text-xs text-slate-500">Spesial</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 px-4 py-2">
                                        <div
                                            class="w-10 h-10 bg-slate-800 text-white rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-car-side"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-bold text-sm text-slate-800">Size Type</div>
                                            <div class="text-xs text-slate-500">Kategori</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 px-4 py-2">
                                        <div
                                            class="w-10 h-10 bg-slate-800 text-white rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-bold text-sm text-slate-800">About 4-6 Seats</div>
                                            <div class="text-xs text-slate-500">Kapasitas</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-shrink-0 pl-4">
                                <a href="{{ route('cars.index') }}"
                                    class="bg-emerald-700 text-white px-6 py-2 rounded-full font-bold shadow hover:bg-emerald-800 transition">Reservasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const carSearchInput = document.getElementById('carSearchInput');
                const carSearchResults = document.getElementById('carSearchResults');
                const searchBtn = document.getElementById('searchBtn');
                let searchTimeout;

                // Handle input change
                carSearchInput.addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    const query = e.target.value.trim();

                    if (query.length < 1) {
                        carSearchResults.classList.add('hidden');
                        return;
                    }

                    // Debounce search to avoid too many requests
                    searchTimeout = setTimeout(function() {
                        fetchCarResults(query);
                    }, 300);
                });

                // Search button navigates to list page with query
                searchBtn.addEventListener('click', function() {
                    const q = carSearchInput.value.trim();
                    if (q.length > 0) {
                        window.location.href = `/cars?q=${encodeURIComponent(q)}`;
                    } else {
                        window.location.href = `{{ route('cars.index') }}`;
                    }
                });

                // Fetch search results from API
                function fetchCarResults(query) {
                    fetch(`/api/search-cars?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            displayResults(data);
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Display results in dropdown
                function displayResults(cars) {
                    if (cars.length === 0) {
                        carSearchResults.innerHTML = `
                            <div class="p-4 text-center text-slate-500">
                                <i class="fa-solid fa-inbox text-2xl text-slate-300 mb-2"></i>
                                <p class="text-sm">Mobil tidak ditemukan</p>
                            </div>
                        `;
                        carSearchResults.classList.remove('hidden');
                        return;
                    }

                    carSearchResults.innerHTML = cars.map(car => `
                        <a href="/cars/${car.id}" class="flex items-center gap-3 p-3 hover:bg-yellow-50 border-l-4 border-transparent hover:border-yellow-500 transition-all cursor-pointer block">
                            <div class="flex-1">
                                <div class="font-bold text-slate-900 text-sm">${car.label}</div>
                                <div class="text-xs text-slate-500">${car.price}</div>
                            </div>
                            <i class="fa-solid fa-arrow-right text-yellow-600 text-xs"></i>
                        </a>
                    `).join('');
                    carSearchResults.classList.remove('hidden');
                }

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('[id*="carSearch"]') && !event.target.closest('#searchBtn')) {
                        carSearchResults.classList.add('hidden');
                    }
                });

                // Handle result selection by keyboard
                carSearchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        carSearchResults.classList.add('hidden');
                    }
                });
            });
        </script>




        {{-- Services Section --}}
        <section class="py-24 pt-0 bg-slate-50" id="layanan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">
                        Solusi Transportasi
                    </span>
                    <h2 class="section-title">Layanan Terbaik Untuk Anda</h2>
                    <p class="text-slate-500">
                        Kami menyediakan berbagai pilihan layanan yang dirancang untuk memenuhi kebutuhan mobilitas Anda
                        dengan standar kenyamanan tertinggi.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    {{-- Service Card 1 --}}
                    <div
                        class="bg-white p-10 rounded-3xl border border-slate-100 card-shadow relative overflow-hidden group">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/5 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:scale-150">
                        </div>

                        <div class="w-16 h-16 bg-yellow-600/10 rounded-2xl flex items-center justify-center mb-8">
                            <i class="fa-solid fa-key text-yellow-600 text-3xl"></i>
                        </div>

                        <h3 class="text-2xl font-bold mb-4">Rental Lepas Kunci</h3>
                        <p class="text-slate-500 mb-6">
                            Kebebasan penuh berkendara sendiri untuk urusan bisnis maupun pribadi.
                        </p>

                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Durasi 24 Jam Penuh
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Asuransi All-Risk
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Unit Steril & Wangi
                            </li>
                        </ul>

                        <div class="pt-6 border-t border-slate-50">
                            <p class="text-xs text-slate-400 font-bold uppercase mb-1">Mulai Dari</p>
                            <p class="text-2xl font-extrabold text-gray-900">
                                Rp 350.000 <span class="text-sm font-normal text-slate-400">/ hari</span>
                            </p>
                        </div>
                    </div>

                    {{-- Service Card 2 (Featured) --}}
                    <div
                        class="bg-gray-900 p-10 rounded-3xl border border-gray-900 shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/10 rounded-bl-full -mr-10 -mt-10">
                        </div>

                        <div class="w-16 h-16 bg-yellow-600 rounded-2xl flex items-center justify-center mb-8">
                            <i class="fa-solid fa-user-tie text-white text-3xl"></i>
                        </div>

                        <h3 class="text-2xl font-bold mb-4 text-white">Sewa + Sopir</h3>
                        <p class="text-slate-400 mb-6">
                            Nikmati perjalanan tanpa lelah dengan pengemudi profesional kami.
                        </p>

                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Driver Berlisensi
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                On-Time Guarantee
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Termasuk BBM & Parkir
                            </li>
                        </ul>

                        <div class="pt-6 border-t border-white/10">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Mulai Dari</p>
                            <p class="text-2xl font-extrabold text-yellow-500">
                                Rp 600.000 <span class="text-sm font-normal text-slate-500">/ 12 jam</span>
                            </p>
                        </div>
                    </div>

                    {{-- Service Card 3 --}}
                    <div
                        class="bg-white p-10 rounded-3xl border border-slate-100 card-shadow relative overflow-hidden group">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/5 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:scale-150">
                        </div>

                        <div class="w-16 h-16 bg-yellow-600/10 rounded-2xl flex items-center justify-center mb-8">
                            <i class="fa-solid fa-map-location-dot text-yellow-600 text-3xl"></i>
                        </div>

                        <h3 class="text-2xl font-bold mb-4">City Tour / Pariwisata</h3>
                        <p class="text-slate-500 mb-6">
                            Paket perjalanan wisata lengkap untuk keluarga dan grup besar.
                        </p>

                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Itinerary Custom
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Dokumentasi Gratis
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                                Tiket Masuk Objek Wisata
                            </li>
                        </ul>

                        <div class="pt-6 border-t border-slate-50">
                            <p class="text-xs text-slate-400 font-bold uppercase mb-1">Mulai Dari</p>
                            <p class="text-2xl font-extrabold text-gray-900">
                                Rp 1.200.000 <span class="text-sm font-normal text-slate-400">/ paket</span>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Vehicle Fleet Section --}}
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

                @include('cars.cars-list')


            </div>
        </section>

        {{-- Reviews Section --}}
        <section class="py-12 sm:py-24 bg-slate-50" id="ulasan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 sm:mb-12 gap-6">
                    <div>
                        <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-2 sm:mb-3 block">
                            Kepuasan Pelanggan
                        </span>
                        <h2 class="heading-font text-2xl sm:text-4xl font-extrabold text-slate-900 mb-2">Ulasan Dari
                            Pelanggan Kami</h2>
                    </div>

                    <a href="{{ route('reviews.create') }}"
                        class="bg-yellow-600 text-white font-bold py-2 sm:py-3 px-4 sm:px-6 rounded-xl hover:bg-yellow-700 transition-colors flex items-center gap-2 w-fit text-sm sm:text-base">
                        <i class="fa-solid fa-plus text-sm"></i>
                        Tambah Ulasan
                    </a>
                </div>

                @php
                    $reviews = App\Models\Review::with('booking.car', 'booking.user')
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                @endphp

                @if ($reviews->count() > 0)
                    <div class="reviews-carousel owl-carousel owl-theme">
                        @foreach ($reviews as $review)
                            {{-- Review Card --}}
                            <div
                                class="item bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-md sm:shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">

                                {{-- Car Image or Review Image --}}
                                @if ($review->image_path)
                                    <img src="{{ asset('storage/' . $review->image_path) }}" alt="Review Image"
                                        class="w-full h-40 sm:h-48 object-cover">
                                @elseif ($review->booking->car->images->first())
                                    <img src="{{ asset('storage/' . $review->booking->car->images->first()->image_path) }}"
                                        alt="{{ $review->booking->car->brand }} {{ $review->booking->car->name }}"
                                        class="w-full h-40 sm:h-48 object-cover">
                                @else
                                    <div class="w-full h-40 sm:h-48 bg-gray-300 flex items-center justify-center">
                                        <i class="fa-solid fa-car-side text-4xl sm:text-6xl text-gray-400"></i>
                                    </div>
                                @endif

                                <div class="p-4 sm:p-8 flex-1 flex flex-col">
                                    {{-- Rating Stars --}}
                                    <div class="flex items-center gap-1 mb-3 sm:mb-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 sm:w-5 h-4 sm:h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span
                                            class="ml-1 sm:ml-2 text-xs sm:text-sm font-bold text-gray-700">{{ $review->rating }}/5</span>
                                    </div>

                                    <p class="text-xs sm:text-sm text-slate-600 mb-4 sm:mb-6 flex-grow line-clamp-3">
                                        "{{ $review->comment ?? 'Pelanggan puas dengan layanan kami.' }}"
                                    </p>

                                    <div
                                        class="flex items-center gap-2 sm:gap-3 border-t border-slate-100 pt-3 sm:pt-4">
                                        <div
                                            class="w-10 sm:w-12 h-10 sm:h-12 bg-yellow-600/10 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-user text-yellow-600 text-sm sm:text-lg"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-bold text-gray-900 text-xs sm:text-sm truncate">
                                                {{ $review->booking->user->name ?? 'Pelanggan' }}
                                            </p>
                                            <p class="text-xs text-slate-500 truncate">
                                                {{ $review->booking->car->brand ?? 'Produk' }}
                                                {{ $review->booking->car->name ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 sm:py-16 bg-white rounded-3xl border border-slate-100">
                        <div class="mb-3 sm:mb-4">
                            <i class="fa-solid fa-comments text-5xl sm:text-6xl text-slate-300"></i>
                        </div>
                        <p class="text-gray-500 text-base sm:text-lg mb-3 sm:mb-4">
                            Belum ada ulasan. Jadilah yang pertama memberikan ulasan!
                        </p>
                        <a href="{{ route('reviews.create') }}"
                            class="bg-yellow-600 text-white font-bold py-2 sm:py-3 px-6 sm:px-8 rounded-xl hover:bg-yellow-700 transition-colors inline-flex items-center gap-2 text-sm sm:text-base">
                            <i class="fa-solid fa-plus text-sm"></i>
                            Tambah Ulasan Sekarang
                        </a>
                    </div>
                @endif

            </div>
        </section>

    </div>
</x-app-layout>
