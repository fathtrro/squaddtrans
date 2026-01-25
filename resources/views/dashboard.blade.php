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
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi Penjemputan</label>
                    <div class="relative">
                        <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-yellow-600/20 text-sm" placeholder="Cari kota atau bandara..." type="text"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal & Waktu</label>
                    <div class="relative">

                        <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-yellow-600/20 text-sm" placeholder="Pilih tanggal..." type="text"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Tipe Kendaraan</label>
                    <div class="relative">
                        <select class="w-full pl-10 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-yellow-600/20 text-sm appearance-none">
                            <option>Semua Tipe</option>
                            <option>Luxury Sedan</option>
                            <option>Family SUV</option>
                            <option>Van / Hiace</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button class="w-full bg-gray-900 text-yellow-500 font-bold py-3.5 rounded-xl hover:bg-black transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">search</span>
                        Cari Armada
                    </button>
                </div>
            </div>
        </section>

        {{-- Services Section --}}
        <section class="py-24 pt-0 bg-slate-50" id="layanan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">Solusi Transportasi</span>
                    <h2 class="section-title">Layanan Terbaik Untuk Anda</h2>
                    <p class="text-slate-500">Kami menyediakan berbagai pilihan layanan yang dirancang untuk memenuhi kebutuhan mobilitas Anda dengan standar kenyamanan tertinggi.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Service Card 1 --}}
                    <div class="bg-white p-10 rounded-3xl border border-slate-100 card-shadow relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/5 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:scale-150"></div>
                        <div class="w-16 h-16 bg-yellow-600/10 rounded-2xl flex items-center justify-center mb-8">
                            <span class="material-symbols-outlined text-yellow-600 text-3xl">key</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Rental Lepas Kunci</h3>
                        <p class="text-slate-500 mb-6">Kebebasan penuh berkendara sendiri untuk urusan bisnis maupun pribadi.</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Durasi 24 Jam Penuh
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Asuransi All-Risk
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Unit Steril & Wangi
                            </li>
                        </ul>
                        <div class="pt-6 border-t border-slate-50">
                            <p class="text-xs text-slate-400 font-bold uppercase mb-1">Mulai Dari</p>
                            <p class="text-2xl font-extrabold text-gray-900">Rp 350.000 <span class="text-sm font-normal text-slate-400">/ hari</span></p>
                        </div>
                    </div>

                    {{-- Service Card 2 (Featured) --}}
                    <div class="bg-gray-900 p-10 rounded-3xl border border-gray-900 shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/10 rounded-bl-full -mr-10 -mt-10"></div>
                        <div class="w-16 h-16 bg-yellow-600 rounded-2xl flex items-center justify-center mb-8">
                            <span class="material-symbols-outlined text-white text-3xl">person_pin_circle</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-white">Sewa + Sopir</h3>
                        <p class="text-slate-400 mb-6">Nikmati perjalanan tanpa lelah dengan pengemudi profesional kami.</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Driver Berlisensi
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> On-Time Guarantee
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Termasuk BBM & Parkir
                            </li>
                        </ul>
                        <div class="pt-6 border-t border-white/10">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Mulai Dari</p>
                            <p class="text-2xl font-extrabold text-yellow-500">Rp 600.000 <span class="text-sm font-normal text-slate-500">/ 12 jam</span></p>
                        </div>
                    </div>

                    {{-- Service Card 3 --}}
                    <div class="bg-white p-10 rounded-3xl border border-slate-100 card-shadow relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/5 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:scale-150"></div>
                        <div class="w-16 h-16 bg-yellow-600/10 rounded-2xl flex items-center justify-center mb-8">
                            <span class="material-symbols-outlined text-yellow-600 text-3xl">map</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">City Tour/Pariwisata</h3>
                        <p class="text-slate-500 mb-6">Paket perjalanan wisata lengkap untuk keluarga dan grup besar.</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Itinerary Custom
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Dokumentasi Gratis
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Tiket Masuk Objek Wisata
                            </li>
                        </ul>
                        <div class="pt-6 border-t border-slate-50">
                            <p class="text-xs text-slate-400 font-bold uppercase mb-1">Mulai Dari</p>
                            <p class="text-2xl font-extrabold text-gray-900">Rp 1.200.000 <span class="text-sm font-normal text-slate-400">/ paket</span></p>
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
                        <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">Armada Kami</span>
                        <h2 class="section-title">Pilih Unit Favorit Anda</h2>
                    </div>
                    <div class="flex bg-slate-100 p-1 rounded-2xl overflow-x-auto">
                        <button class="px-6 py-2.5 rounded-xl font-bold text-sm bg-white shadow-sm text-gray-900">Semua</button>
                        <button class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:text-gray-900">Luxury</button>
                        <button class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:text-gray-900">Family</button>
                        <button class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:text-gray-900">Economic</button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- Vehicle Card 1 --}}
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 card-shadow transition-all hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden bg-slate-100">
                            <img alt="Luxury Car" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRbtNl7jWKSOQDwtCtxAPILIpaC4kUdm6EPdNy3RhgPuLbBEdOtVrJ038MGHoDYudIy-TL1bYjfatrVw1jpWtxVlyhCZsX3KBXYhMA_dUl4qFFHAlaTrsxhp3zdgDNY6qcaWQDNQ9ta884JO697KAVtRArc4Gnu6Ns2bcPaeA2KwR4ialfB-C3zuNLSNlJsCFk4Dhic-UZuqAe7zP6OTqIa6c5zPjq_5ZO4rex3jLKfrUed961Vp1p8sNir2H-pRvufR8UTuBiMkA"/>
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span class="bg-gray-900/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Premium</span>
                                <span class="bg-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Baru</span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-extrabold text-gray-900">Executive Luxury Sedan</h3>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-yellow-600 text-sm">star</span>
                                    <span class="text-sm font-bold">4.9</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-2 mb-8">
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">person</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">4 Kursi</span>
                                </div>
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">ac_unit</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">Dual AC</span>
                                </div>
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">local_gas_station</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">Pertalite</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-2xl font-black text-gray-900">Rp 950k <span class="text-sm font-normal text-slate-400">/hari</span></p>
                                </div>
                                <button class="bg-slate-900 text-white p-3 rounded-xl hover:bg-yellow-600 transition-colors">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Vehicle Card 2 --}}
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 card-shadow transition-all hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden bg-slate-100">
                            <img alt="Executive SUV" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDcj_Tw5DhgsFDGpwsoI8iaCc6_qWMIp0uw_F3Lbtm-_d502Ara8BeOUCRRaerLoYVVKAljMX_Sshtw20v1z-DxVodW3RHbXXBsRsrCNmua9C2i5Bs3B5V__XaneBzJygLVzmDBsOFM9_Lv9cfnkU60Q913mvigkvXIOp95LvVYDB2kLQ42Yv7Z0RCdI-0TlisAKvOW9-ptKjDx4Y_22MCMYqcFFs5F0xuc3un7l7v5j8rYIw8-E3zffg6ko4gzpqEE3irc2ET2m60"/>
                            <div class="absolute top-4 left-4">
                                <span class="bg-gray-900/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Most Popular</span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-extrabold text-gray-900">Premium Family SUV</h3>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-yellow-600 text-sm">star</span>
                                    <span class="text-sm font-bold">4.8</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-2 mb-8">
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">person</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">7 Kursi</span>
                                </div>
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">ac_unit</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">Triple AC</span>
                                </div>
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">local_gas_station</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">Solar</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-2xl font-black text-gray-900">Rp 750k <span class="text-sm font-normal text-slate-400">/hari</span></p>
                                </div>
                                <button class="bg-slate-900 text-white p-3 rounded-xl hover:bg-yellow-600 transition-colors">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Vehicle Card 3 --}}
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 card-shadow transition-all hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden bg-slate-100">
                            <img alt="Family Van" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCR828I_Lhqg5801bigVdMBgn2DfbJVkeO53dhvBIX5VyeI72XoKmuvfr8OUBQ3AvhjClZ2tvegkl9OQYjFHNOm36c3mtuPRs4HWH16wKPLFLWqhNKDFJfcMWgbQhUZJWHNYW2V1rSMjm-NhfUNXOwFJDskWMIQqpYr0YMnn8xuf73YmtjbcQb4eRTZHuCHWq0WD6ZH0Li9olq26_qDuIFX-iqdC8rTiUOEvwYzLz22fMVlH23OaEWyLqhHmdqsq2IIEl9jK79YQLg"/>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-extrabold text-gray-900">Luxury Traveler Van</h3>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-yellow-600 text-sm">star</span>
                                    <span class="text-sm font-bold">5.0</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-2 mb-8">
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">person</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">12 Kursi</span>
                                </div>
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">ac_unit</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">Full AC</span>
                                </div>
                                <div class="bg-slate-50 p-3 rounded-xl flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">local_gas_station</span>
                                    <span class="text-xs font-bold text-slate-500 uppercase">Solar</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-2xl font-black text-gray-900">Rp 1.1M <span class="text-sm font-normal text-slate-400">/hari</span></p>
                                </div>
                                <button class="bg-slate-900 text-white p-3 rounded-xl hover:bg-yellow-600 transition-colors">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
