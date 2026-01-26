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

    <div class="bg-gray-50 min-h-screen">
        {{-- Hero Section --}}
        <header class="relative w-full h-[500px] overflow-hidden mb-0">
            <img alt="Premium Car Backdrop" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiJZiTCiFd_e64WelonS71xlUr9abMavW8U12miE-JeP-xkTd5MBdaJyCsnhQqhP_QRi4VGxICzWvAXXOEzG6q5eOS_NPRwreGU9iNcbXM8Yg6hTPVUykcQ3ijN09MrHt_075TsuvZmryq80Lnj1kDDWKHrA635biIa3PoXq8ujRGBDedLQUvYlzUiFdHxa0Og0zstuAUpXSDOh0wAZNLBF0RU27IOiQu2JBtaZ2Fgu4bOkIpolzulk-I5ZZfOHN-havPBE2IzPkk"/>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                    <div class="max-w-2xl">
                        <span class="inline-block py-1 px-4 bg-yellow-600/20 backdrop-blur-md border border-yellow-600/30 text-yellow-500 font-bold rounded-full text-xs tracking-widest uppercase mb-6">Layanan Premium</span>
                        <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                            Layanan Terbaik untuk <span class="text-yellow-500">Perjalanan</span> Anda
                        </h1>
                        <p class="text-xl text-slate-200 mb-10 leading-relaxed max-w-lg">
                            Kami di sini untuk membantu kebutuhan penyewaan mobil Anda. Squad Trans menyediakan solusi transportasi premium, mulai dari perjalanan bisnis hingga liburan keluarga yang nyaman.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a class="btn-primary flex items-center gap-2" href="#detail-layanan">
                                Lihat Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                            <a class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 font-bold py-3 px-8 rounded-xl transition-all" href="{{ route('armada') }}">
                                Lihat Armada
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Quality Guarantee Feature Card --}}
        <section class="relative max-w-6xl mx-auto px-4 -mt-20 mb-16 z-10">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="absolute inset-0 opacity-20">
                    <div class="w-full h-full bg-gradient-to-br from-yellow-600/30 to-purple-600/30"></div>
                </div>
                <div class="relative p-8 md:p-12">
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-6 md:p-8 max-w-md">
                        <div class="flex items-center mb-4">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                            <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Gratis Operasional</span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Kualitas Terjamin</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Setiap armada kami melakukan inspeksi ketat 20 titik sebelum setiap perjalanan untuk keamanan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Services Grid Section --}}
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">Pilihan Layanan</span>
                    <h2 class="section-title">Layanan Kami untuk Anda</h2>
                    <p class="text-slate-500">Berbagai pilihan layanan transportasi yang dirancang untuk memenuhi kebutuhan perjalanan Anda dengan standar kualitas terbaik.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Service 1: Sewa + Driver --}}
                    <div class="bg-yellow-50 border-2 border-yellow-200 rounded-3xl p-8 hover:shadow-xl transition-all group">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-yellow-600 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-white text-3xl">person_pin_circle</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Sewa + Driver</h3>
                                <p class="text-gray-600 mb-4">
                                    Manfaat perjalanan tanpa risiko dengan pengemudi profesional dan berpengalaman.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Driver Berlisensi
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> Termasuk BBM & Parkir
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-yellow-600 text-sm">check_circle</span> On-Time Guarantee
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Service 2: Sewa Lepas Kunci --}}
                    <div class="bg-white border-2 border-slate-200 rounded-3xl p-8 hover:shadow-xl transition-all group">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-white text-3xl">key</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Sewa Lepas Kunci</h3>
                                <p class="text-gray-600 mb-4">
                                    Kebebasan penuh berkendara sendiri dengan kendaraan unit hebat dan prima.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-blue-500 text-sm">check_circle</span> Durasi 24 Jam Penuh
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-blue-500 text-sm">check_circle</span> Asuransi All-Risk
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-blue-500 text-sm">check_circle</span> Unit Steril & Wangi
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Service 3: Antar Jemput Bandara --}}
                    <div class="bg-white border-2 border-slate-200 rounded-3xl p-8 hover:shadow-xl transition-all group">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-white text-3xl">flight_takeoff</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Antar Jemput Bandara</h3>
                                <p class="text-gray-600 mb-4">
                                    Layanan kenyamanan untuk perjalanan atau penerbangan ke bandara internasional.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-purple-500 text-sm">check_circle</span> Pick up Tepat Waktu
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-purple-500 text-sm">check_circle</span> Tracking Real-time
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-purple-500 text-sm">check_circle</span> Harga Tetap
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Service 4: Paket Wisata --}}
                    <div class="bg-white border-2 border-slate-200 rounded-3xl p-8 hover:shadow-xl transition-all group">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-white text-3xl">map</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">City Tour/Paket Wisata</h3>
                                <p class="text-gray-600 mb-4">
                                    Dapatkan destinasi terbaik dengan layanan lengkap kami untuk keluarga eksklusif.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span> Itinerary Custom
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span> Dokumentasi Gratis
                                    </li>
                                    <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span> Tiket Objek Wisata
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Detail Layanan: Sewa Lepas Kunci --}}
        <section class="py-16 bg-white" id="detail-layanan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
                    <div class="p-8 md:p-12">
                        {{-- Header --}}
                        <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
                            <div>
                                <span class="inline-block px-4 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full mb-3">
                                    DETAIL LAYANAN
                                </span>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Sewa Lepas Kunci</h2>
                            </div>
                            <div class="hidden md:block">
                                <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-3xl flex items-center justify-center shadow-lg">
                                    <span class="material-symbols-outlined text-white text-4xl">key</span>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                            Nikmati kebebasan berkendara sepenuhnya dengan layanan Sewa Lepas Kunci dari Squad Trans. Sangat cocok untuk Anda yang menginginkan privasi dan fleksibilitas selama perjalanan.
                        </p>

                        {{-- Benefits Grid --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-10">
                            <div class="flex items-start group">
                                <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-yellow-600 text-2xl">verified_user</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1 text-lg">Asuransi All-Risk</h4>
                                    <p class="text-gray-600 text-sm">Perlindungan menyeluruh untuk keamanan perjalanan Anda</p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-yellow-600 text-2xl">support_agent</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1 text-lg">Bantuan 24/7</h4>
                                    <p class="text-gray-600 text-sm">Tim support siap membantu kapan saja Anda membutuhkan</p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-yellow-600 text-2xl">new_releases</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1 text-lg">Tahun Unit > 2022</h4>
                                    <p class="text-gray-600 text-sm">Armada terbaru dengan teknologi modern</p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-yellow-600 text-2xl">cleaning_services</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1 text-lg">Unit Higienis</h4>
                                    <p class="text-gray-600 text-sm">Dibersihkan dan disterilkan setiap sebelum penyewaan</p>
                                </div>
                            </div>
                        </div>

                        {{-- Syarat & Ketentuan --}}
                        <div class="bg-slate-50 rounded-2xl p-8 mb-10">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-600">rule</span>
                                Syarat & Ketentuan
                            </h3>
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-yellow-600 text-white font-bold rounded-full mr-3 flex-shrink-0">1</span>
                                    <span class="text-gray-700 pt-1">Memiliki SIM A yang masih aktif dan KTP asli untuk verifikasi data.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-yellow-600 text-white font-bold rounded-full mr-3 flex-shrink-0">2</span>
                                    <span class="text-gray-700 pt-1">Bersedia disurvei untuk penyewaan pertama kali.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-yellow-600 text-white font-bold rounded-full mr-3 flex-shrink-0">3</span>
                                    <span class="text-gray-700 pt-1">Penyewa wajib isi bahan bakar sesuai sisa yang disediakan.</span>
                                </li>
                            </ul>
                        </div>

                        {{-- CTA Button --}}
                        <div class="text-center">
                            <a href="{{ route('armada') }}" class="inline-flex items-center px-10 py-4 bg-yellow-600 hover:bg-yellow-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                                Pesan Sekarang
                                <span class="material-symbols-outlined ml-2">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Call to Action Section --}}
        <section class="py-16 bg-gradient-to-r from-yellow-400 to-yellow-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                        Siap Memulai Perjalanan Anda?
                    </h2>
                    <p class="text-xl text-gray-800 mb-10 leading-relaxed">
                        Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik untuk kebutuhan transportasi Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-gray-900 hover:bg-black text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
                            <span class="material-symbols-outlined mr-2">call</span>
                            Hubungi Kami
                        </a>
                        <a href="{{ route('armada') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
                            <span class="material-symbols-outlined mr-2">directions_car</span>
                            Lihat Armada
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

</x-app-layout>
