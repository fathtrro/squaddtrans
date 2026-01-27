<x-app-layout>

    {{-- Custom Styles --}}
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
        <header class="relative w-full h-[500px] overflow-hidden">
            <img alt="Premium Car Backdrop" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiJZiTCiFd_e64WelonS71xlUr9abMavW8U12miE-JeP-xkTd5MBdaJyCsnhQqhP_QRi4VGxICzWvAXXOEzG6q5eOS_NPRwreGU9iNcbXM8Yg6hTPVUykcQ3ijN09MrHt_075TsuvZmryq80Lnj1kDDWKHrA635biIa3PoXq8ujRGBDedLQUvYlzUiFdHxa0Og0zstuAUpXSDOh0wAZNLBF0RU27IOiQu2JBtaZ2Fgu4bOkIpolzulk-I5ZZfOHN-havPBE2IzPkk"/>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                    <div class="max-w-2xl">
                        <span class="inline-block py-1 px-4 bg-yellow-600/20 backdrop-blur-md border border-yellow-600/30 text-yellow-500 font-bold rounded-full text-xs tracking-widest uppercase mb-6">Premium Travel Experience</span>
                        <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                            Eksplorasi Tanpa Batas dengan <span class="text-yellow-500">Kenyamanan</span> Maksimal
                        </h1>
                        <p class="text-xl text-slate-200 mb-10 leading-relaxed max-w-lg">
                            Layanan sewa mobil eksklusif dan paket wisata personal di Indonesia dengan standar pelayanan bintang lima.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a class="btn-primary flex items-center gap-2" href="#units">
                                Pesan Sekarang <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                            <a class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 font-bold py-3 px-8 rounded-xl transition-all" href="#">
                                Konsultasi Rute
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Search Section --}}
     <section class="relative z-20 max-w-6xl mx-auto -mt-24 px-4 mb-12">
    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-2xl border border-slate-100 grid grid-cols-1 md:grid-cols-4 gap-6 items-end">

        <!-- Lokasi -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">
                Lokasi Penjemputan
            </label>
            <div class="relative">
                <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input
                    type="text"
                    placeholder="Cari kota atau bandara..."
                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-yellow-600/20 text-sm"
                />
            </div>
        </div>

        <!-- Tanggal -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">
                Tanggal & Waktu
            </label>
            <div class="relative">
                <i class="fa-solid fa-calendar-days absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input
                    type="text"
                    placeholder="Pilih tanggal..."
                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-yellow-600/20 text-sm"
                />
            </div>
        </div>

        <!-- Tipe Kendaraan -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">
                Tipe Kendaraan
            </label>
            <div class="relative">
                <i class="fa-solid fa-car absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <select
                    class="w-full pl-11 pr-10 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-yellow-600/20 text-sm appearance-none">
                    <option>Semua Tipe</option>
                    <option>Luxury Sedan</option>
                    <option>Family SUV</option>
                    <option>Van / Hiace</option>
                </select>

                <!-- arrow custom -->
                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
            </div>
        </div>

        <!-- Button -->
        <div>
            <button
                class="w-full bg-gray-900 text-yellow-500 font-bold py-3.5 rounded-xl hover:bg-black transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari Armada
            </button>
        </div>

    </div>
</section>


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
            <div class="bg-white p-10 rounded-3xl border border-slate-100 card-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/5 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:scale-150"></div>

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
            <div class="bg-gray-900 p-10 rounded-3xl border border-gray-900 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/10 rounded-bl-full -mr-10 -mt-10"></div>

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
            <div class="bg-white p-10 rounded-3xl border border-slate-100 card-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/5 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:scale-150"></div>

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

        @if($cars->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($cars as $car)
                {{-- Vehicle Card --}}
                <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 card-shadow transition-all hover:-translate-y-2">

                    <div class="relative h-64 overflow-hidden bg-slate-100">
                        @if($car->images->first())
                            <img
                                src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                                alt="{{ $car->brand }} {{ $car->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                <i class="fa-solid fa-car-side text-6xl text-gray-400"></i>
                            </div>
                        @endif

                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="bg-gray-900/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
                                {{ $car->category ?? 'Premium' }}
                            </span>

                            @php
                                $reviews = $car->reviews;
                                $avgRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
                            @endphp

                            @if($reviews->count() > 0)
                                <span class="bg-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
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

                            @if($reviews->count() > 0)
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

    </div>
</x-app-layout>
