<x-app-layout>
    {{-- Fleet Listing Page - SQUADTRANS --}}

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10 pt-0">

    {{-- Hero Search and Title --}}
    <div class="mb-12" data-aos="fade-up">
        <h1 class=" text-gray-900 text-4xl md:text-5xl font-extrabold mb-6 bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text">
            Daftar Armada Kami
        </h1>

        <div class="flex flex-col md:flex-row gap-4 items-center">
            {{-- Search Box --}}
            <div class="w-full md:max-w-xl">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-yellow-500">search</span>
                    </div>
                    <input type="text"
                           class="w-full h-14 pl-12 pr-4 rounded-xl bg-white border-2 border-gray-200 focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 transition-all duration-300 text-gray-900 placeholder:text-gray-400"
                           placeholder="Cari model mobil (e.g. Pajero, Alphard)...">
                </div>
            </div>

            {{-- Filter Pills --}}
            <div class="flex gap-2 overflow-x-auto no-scrollbar w-full md:w-auto">
                <button class="flex items-center gap-2 px-6 h-10 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full font-bold text-sm transition-all duration-300 shadow-lg whitespace-nowrap">
                    Semua
                </button>
                <button class="flex items-center gap-2 px-6 h-10 bg-white hover:bg-yellow-50 border-2 border-gray-200 hover:border-yellow-400 text-gray-700 rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                    SUV
                </button>
                <button class="flex items-center gap-2 px-6 h-10 bg-white hover:bg-yellow-50 border-2 border-gray-200 hover:border-yellow-400 text-gray-700 rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                    MPV
                </button>
                <button class="flex items-center gap-2 px-6 h-10 bg-white hover:bg-yellow-50 border-2 border-gray-200 hover:border-yellow-400 text-gray-700 rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                    Luxury
                </button>
                <button class="flex items-center gap-2 px-6 h-10 bg-white hover:bg-yellow-50 border-2 border-gray-200 hover:border-yellow-400 text-gray-700 rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap">
                    Ekonomis
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Sidebar Filter --}}
        <aside class="w-full lg:w-80 shrink-0">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 sticky top-28" data-aos="fade-right">
                <div class="flex flex-col gap-6">
                    {{-- Header --}}
                    <div>
                        <h3 class="text-gray-900 text-xl font-bold mb-1">Filter Lanjutan</h3>
                        <p class="text-gray-500 text-sm">Sesuaikan pencarian Anda</p>
                    </div>

                    {{-- Price Range --}}
                    <div class="flex flex-col gap-3 pb-6 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-yellow-600">payments</span>
                            </div>
                            <p class="text-gray-900 font-semibold">Rentang Harga</p>
                        </div>
                        <div class="px-2">
                            <input type="range" class="w-full h-2 bg-gray-200 rounded-full appearance-none cursor-pointer accent-yellow-500">
                            <div class="flex justify-between mt-3">
                                <span class="text-xs font-medium text-gray-500">Rp 500rb</span>
                                <span class="text-xs font-medium text-gray-500">Rp 5jt+</span>
                            </div>
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
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-yellow-500 focus:ring-yellow-500">
                                <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-600 transition-colors">2023 - 2024</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-yellow-500 focus:ring-yellow-500">
                                <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-600 transition-colors">2020 - 2022</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-yellow-500 focus:ring-yellow-500">
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
                            <button class="px-4 py-2.5 bg-yellow-100 border-2 border-yellow-500 text-yellow-700 rounded-xl text-sm font-bold hover:bg-yellow-200 transition-all">
                                Bensin
                            </button>
                            <button class="px-4 py-2.5 bg-gray-50 border-2 border-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:border-yellow-400 hover:bg-yellow-50 transition-all">
                                Diesel
                            </button>
                            <button class="px-4 py-2.5 bg-gray-50 border-2 border-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:border-yellow-400 hover:bg-yellow-50 transition-all">
                                Electric
                            </button>
                            <button class="px-4 py-2.5 bg-gray-50 border-2 border-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:border-yellow-400 hover:bg-yellow-50 transition-all">
                                Hybrid
                            </button>
                        </div>
                    </div>

                    {{-- Apply Button --}}
                    <button class="w-full mt-2 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </aside>

        {{-- Fleet Grid --}}
        <div class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                {{-- Card 1 - Pajero Sport (Popular) --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:border-yellow-400" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <div class="absolute top-4 left-4 z-10 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg animate-pulse">
                            TERPOPULER
                        </div>
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAM2-MAEtqAnD2xp4pVls9_FtXI6p_aHMeXawSlwqHqyiYXuDV-sc2sFXJjqfhtlNWNfQeqy3_bag8YVZDJxS7ErAJV6F2BxoOLO2ZFv2lcbGN4Dyj_ph3w7MRwOxWi1XNoCWMVV5yqGWFrZ4yhWq4SBmWKsS6tNLV0m-Eeu9thlPmxkpo2IBisRDYc7oI7sHCzti08GN9HLd3wJZSLbSdbhx1xzg7lOYsz8TNqD67POEjhCX9rliqC9dmfC0HwkEkVZy4csiPCsnE"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="Mitsubishi Pajero Sport">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600 transition-colors">
                            Mitsubishi Pajero Sport
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">Model 2023 • SUV Premium</p>

                        <div class="grid grid-cols-3 gap-2 mb-5">
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">groups</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">7 Seats</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Auto</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">ev_station</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Diesel</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                <p class="text-2xl font-extrabold text-gray-900">
                                    Rp 1.200rb
                                    <span class="text-sm font-normal text-gray-500">/hari</span>
                                </p>
                            </div>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Card 2 - Alphard --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:border-yellow-400" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCU6Zx36J3x348OXtN_md_PIW5Yk5zBlsnfqeUBeHSjOOiQTqaURlnJoS9eUNX8VzmMkPgsG_y4WvLn485QWoZsQlgdzSf703kiXSQHMD57iWxApHccWM2nx1qFpusljqMPnalLsf902QQqWdHw6lJkVstGQXhpScOje_HWSjNaMwZRT51jtgYBqRTTtc1eZSQEsb0D-0zenh3z1SCAhAwybZLg56Klrr6L3ka-4QEEUCuGuRMO52lSVVgR5gbQ8XrK_dqXgp88DA"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="Toyota Alphard">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600 transition-colors">
                            Toyota Alphard
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">Model 2022 • Luxury MPV</p>

                        <div class="grid grid-cols-3 gap-2 mb-5">
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">airline_seat_recline_extra</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">6 Seats</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Auto</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">local_gas_station</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Petrol</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                <p class="text-2xl font-extrabold text-gray-900">
                                    Rp 2.500rb
                                    <span class="text-sm font-normal text-gray-500">/hari</span>
                                </p>
                            </div>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Card 3 - Honda CR-V --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:border-yellow-400" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXwBhOlpA8An8Vyd1UKWeI5emfSqcB7xPlhxY1LmpohLwpdqV5UzHiJW2I3xQRtqFQQeoyGuMI6VtLxnFvxMsnA0GnS0Vi2ruc5or4iiUcMn1WU_H2X9BuqEwCvepSK9xvVu8Qrr-zQnasZzMyVuS_KiY4eEUkP-_5Q-iXpgg8CmpwpMZihLAnGT6MLLCK4qgOoeqwFk6maVX3AhOGT9W3gKMTcxqtABH_qvcoNB0oVBQXYgx7Uq6lOHyp4Dv9PQSYE-JkhDCunHA"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="Honda CR-V">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600 transition-colors">
                            Honda CR-V Turbo
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">Model 2024 • SUV Family</p>

                        <div class="grid grid-cols-3 gap-2 mb-5">
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">groups</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">5 Seats</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Auto</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">local_gas_station</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Petrol</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                <p class="text-2xl font-extrabold text-gray-900">
                                    Rp 900rb
                                    <span class="text-sm font-normal text-gray-500">/hari</span>
                                </p>
                            </div>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Card 4 - Innova Zenix --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:border-yellow-400" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsuKT40rGpurn-S8S7dRidg6MnaSBixQL1flW_YBPGf0zzWa32BI-nR90_YIZBR5mAfMo-Pz550QFzXknmqoPOpLOoc8MmLVU5xhe0uLRlonsejUBFpcm6iqtV4ELnRV3tTCWEoNBbZXSUVQl2HIm2MiVpIvFLiyCx58tUjx9lJyMzhWLf_QdICFVnxUPvQ13b_-qsZQGuJjL_PXGQVPhTJFW9sQq7-vO8E6znmIudbm4on5ZKerTp6YhPItdFmL5WRZ9c5FmZTfc"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="Toyota Innova Zenix">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600 transition-colors">
                            Toyota Innova Zenix
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">Model 2024 • MPV Hybrid</p>

                        <div class="grid grid-cols-3 gap-2 mb-5">
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">groups</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">7 Seats</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Auto</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">electric_car</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Hybrid</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                <p class="text-2xl font-extrabold text-gray-900">
                                    Rp 1.100rb
                                    <span class="text-sm font-normal text-gray-500">/hari</span>
                                </p>
                            </div>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Card 5 - Avanza (Available) --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:border-yellow-400" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <div class="absolute top-4 right-4 z-10 bg-green-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                            TERSEDIA
                        </div>
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQoEGRQFOYfRALhhZY6BkflE33xUQn3f4zsLZM2LI4_bHh9RLQYEajeFBiJ5EWXCx93rk4CBgL596DTj5MmGM5ltsfdGW9LSvapbSEA1gQrzXod1MLWLoZ2w7eMnEtU9YtY009ahGlrDp5ESPv4NeclR0ITA40sUuw7bGHvJkU_yHT4xK6LI27vLYJeNVU6gqlBFPjfvYyWKvoknzYKMSZAq2ikXcqodvO5RzorOvkta8CwDhNdHr-n1BvT-cih9xmUcXm9KdgeCI"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="Toyota Avanza">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600 transition-colors">
                            Toyota Avanza
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">Model 2023 • MPV Ekonomis</p>

                        <div class="grid grid-cols-3 gap-2 mb-5">
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">groups</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">7 Seats</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Manual</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">local_gas_station</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Petrol</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                <p class="text-2xl font-extrabold text-gray-900">
                                    Rp 450rb
                                    <span class="text-sm font-normal text-gray-500">/hari</span>
                                </p>
                            </div>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Card 6 - Mercedes S-Class --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group border border-gray-100 hover:border-yellow-400" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBR11LVW4TofLvvMSu6Lbp_rprFzFOYT1B4Qv1I8RqEDC2F99K3sUY8MMTRAvcd-sb6bylKFA1pDtecaKKeX4LUnrEJsn4diDQDqluADVvKQzm3vB-uRwPG4H7fmn_DIRWICheUt-W_kxaG96Cs5t6O0uNCbr6pwRTCP1NzlFRPi0lT6RR6ZJz8aJoRyary5WYCNJGhSSih2BlJHzDUZZbP4rxadrCn0d2iAMAOeJfgAHVwqls4mwlRuOoUuqQ1kumls8ulmwexUy0"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="Mercedes S-Class">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600 transition-colors">
                            Mercedes-Benz S-Class
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">Model 2023 • Ultra Luxury</p>

                        <div class="grid grid-cols-3 gap-2 mb-5">
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">airline_seat_recline_normal</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">4 Seats</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Auto</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                                <span class="material-symbols-outlined text-yellow-500 text-lg">local_gas_station</span>
                                <span class="text-xs text-gray-700 font-medium mt-1">Petrol</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                <p class="text-2xl font-extrabold text-gray-900">
                                    Rp 5.500rb
                                    <span class="text-sm font-normal text-gray-500">/hari</span>
                                </p>
                            </div>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Pagination --}}
            <div class="flex items-center justify-center mt-16 gap-2" data-aos="fade-up">
                <button class="w-10 h-10 rounded-xl flex items-center justify-center border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-300">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </button>
                <button class="w-10 h-10 rounded-xl flex items-center justify-center bg-yellow-500 text-white font-bold shadow-lg">
                    1
                </button>
                <button class="w-10 h-10 rounded-xl flex items-center justify-center border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-300">
                    2
                </button>
                <button class="w-10 h-10 rounded-xl flex items-center justify-center border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-300">
                    3
                </button>
                <span class="px-2 text-gray-400">...</span>
                <button class="w-10 h-10 rounded-xl flex items-center justify-center border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-300">
                    12
                </button>
                <button class="w-10 h-10 rounded-xl flex items-center justify-center border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-300">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </button>
            </div>
        </div>

    </div>
</main>
</x-app-layout>
