<x-app-layout>

    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
        <style>
            .nav-link { @apply font-medium text-slate-700 hover:text-yellow-600 transition-colors duration-200; }
            .btn-primary { @apply bg-yellow-600 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg; }
            .section-title { @apply text-3xl md:text-4xl font-extrabold text-slate-900 mb-4; }
            .card-shadow { @apply shadow-lg hover:shadow-xl transition-shadow duration-300; }

            .fleet-card img { backface-visibility: hidden; perspective: 1000px; }
            #heroParallax { will-change: transform, filter; transform: scale(1.05); }
            .fleet-card { will-change: transform; transition: box-shadow 0.4s ease; }
            .fleet-card img { will-change: transform; transform: scale(1.08); }
            .reveal-section { opacity: 0; transform: translateY(60px); transition: all 1.2s cubic-bezier(.17, .67, .3, 1); }
            .reveal-section.active { opacity: 1; transform: translateY(0); }

            /* ── Dialog Modal ── */
            #reviewDialog {
                border: none;
                padding: 0;
                border-radius: 1.5rem;
                width: 90%;
                max-width: 42rem;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            }
            #reviewDialog::backdrop {
                background: rgba(0,0,0,0.55);
                backdrop-filter: blur(4px);
            }
            #reviewDialog[open] {
                animation: dialogIn 0.2s ease;
            }
            @keyframes dialogIn {
                from { opacity: 0; transform: scale(0.95) translateY(8px); }
                to   { opacity: 1; transform: scale(1) translateY(0); }
            }
        </style>
    @endpush

    <div class="bg-gray-50">

        {{-- ================================================================ --}}
        {{-- Hero Section                                                      --}}
        {{-- ================================================================ --}}
        <header id="heroParallax" class="relative w-full min-h-[120svh] overflow-hidden pt-32"
            style="background-image: url('{{ asset('images/hand.png') }}');
                   background-size: cover;
                   background-position: center 90%;">
            <!-- Overlay Gelap -->
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col">

                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-10">
                    <div class="max-w-3xl">

                        <!-- Badge -->
                        <span class="inline-block py-1 px-4
                            bg-yellow-100/10
                            border border-yellow-400/30
                            text-yellow-400
                            rounded-full text-xs tracking-widest uppercase mb-6">
                            Premium Travel Experience
                        </span>

                        <!-- Heading -->
                        <h1 class="text-4xl md:text-4xl text-white leading-tight text"
                            style="font-weight:400; font-family:'Plus Jakarta Sans', sans-serif; letter-spacing:-0.02em;">

                            Eksplorasi Tanpa Batas<br> Dengan

                                Kenyamanan

                            yang Maksimal

                        </h1>

                    </div>

                    <div class="flex items-center gap-4 mt-6 lg:mt-0 w-full lg:w-auto">
                        <div class="bg-white/15 backdrop-blur-2xl rounded-3xl shadow-2xl overflow-hidden w-full lg:max-w-md border border-white/30">
                            <!-- Form Header dengan Blurmorphism -->
                            <div class="relative overflow-hidden bg-gradient-to-r from-yellow-600/80 via-amber-600/70 to-yellow-700/80 backdrop-blur-xl px-6 py-6 border-b border-white/20">
                                <div class="absolute inset-0 opacity-30">
                                    <div class="absolute top-0 right-0 w-48 h-48 bg-white/20 rounded-full blur-3xl"></div>
                                    <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-yellow-400/20 rounded-full blur-3xl"></div>
                                </div>
                                <h3 class="text-lg font-bold text-white flex items-center gap-3 relative z-10">
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/30 shadow-lg">
                                        <i class="fas fa-search text-white text-base"></i>
                                    </div>
                                    <span>Cari Kendaraan</span>
                                </h3>
                            </div>

                            <!-- Form Body dengan Blurmorphism -->
                            <div class="p-6 space-y-5 bg-white/10 backdrop-blur-xl relative">
                                <!-- Background blur elements -->
                                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-400/10 rounded-full blur-3xl pointer-events-none"></div>
                                <div class="absolute bottom-0 left-0 w-40 h-40 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

                                <form id="dashboardDateForm" class="space-y-5 relative z-10">
                                    <!-- Start Date -->
                                    <div class="group">
                                        <label class="block text-xs font-bold text-white/90 mb-2 uppercase tracking-wider flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-yellow-300/80 to-amber-400/80 backdrop-blur-md flex items-center justify-center border border-white/30">
                                                <i class="fas fa-calendar-check text-white text-xs"></i>
                                            </div>
                                            Tanggal Mulai
                                        </label>
                                        <input
                                            type="date"
                                            id="dashboardStartDate"
                                            class="w-full px-4 py-3 bg-white/20 backdrop-blur-md border-2 border-white/40 rounded-xl focus:border-white/60 focus:ring-4 focus:ring-white/30 focus:outline-none text-white font-medium transition-all duration-200 group-hover:border-white/50 group-hover:bg-white/25 shadow-lg placeholder-white/50"
                                            required
                                            min="{{ date('Y-m-d') }}"
                                        >
                                    </div>

                                    <!-- Durasi Rental Dropdown -->
                                    <div class="group">
                                        <label class="block text-xs font-bold text-white/90 mb-2 uppercase tracking-wider flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-yellow-300/80 to-amber-400/80 backdrop-blur-md flex items-center justify-center border border-white/30">
                                                <i class="fas fa-hourglass-half text-white text-xs"></i>
                                            </div>
                                            Durasi Rental
                                        </label>
                                        <select
                                            id="dashboardDays"
                                            class="w-full px-4 py-3 bg-white/20 backdrop-blur-md border-2 border-white/40 rounded-xl focus:border-white/60 focus:ring-4 focus:ring-white/30 focus:outline-none text-white font-medium transition-all duration-200 group-hover:border-white/50 group-hover:bg-white/25 shadow-lg appearance-none cursor-pointer"
                                            required
                                        >
                                            <option value="" class="bg-slate-900">-- Pilih Durasi --</option>
                                            <option value="1" class="bg-slate-900">1 Hari</option>
                                            <option value="2" class="bg-slate-900">2 Hari</option>
                                            <option value="3" class="bg-slate-900">3 Hari</option>
                                            <option value="4" class="bg-slate-900">4 Hari</option>
                                            <option value="5" class="bg-slate-900">5 Hari</option>
                                            <option value="6" class="bg-slate-900">6 Hari</option>
                                            <option value="7" class="bg-slate-900">7 Hari</option>
                                            <option value="8" class="bg-slate-900">8 Hari</option>
                                            <option value="9" class="bg-slate-900">9 Hari</option>
                                            <option value="10" class="bg-slate-900">10 Hari</option>
                                            <option value="11" class="bg-slate-900">11 Hari</option>
                                            <option value="12" class="bg-slate-900">12 Hari</option>
                                            <option value="13" class="bg-slate-900">13 Hari</option>
                                            <option value="14" class="bg-slate-900">14 Hari</option>
                                            <option value="15" class="bg-slate-900">15 Hari</option>
                                            <option value="16" class="bg-slate-900">16 Hari</option>
                                            <option value="17" class="bg-slate-900">17 Hari</option>
                                            <option value="18" class="bg-slate-900">18 Hari</option>
                                            <option value="19" class="bg-slate-900">19 Hari</option>
                                            <option value="20" class="bg-slate-900">20 Hari</option>
                                        </select>
                                        <!-- Custom arrow icon untuk select -->
                                        <style>
                                            #dashboardDays {
                                                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
                                                background-repeat: no-repeat;
                                                background-position: right 1rem center;
                                                padding-right: 2.5rem;
                                            }
                                        </style>
                                    </div>

                                    <!-- End Date Display dengan Blurmorphism -->
                                    <div id="dashboardEndDateInfo" class="bg-white/15 backdrop-blur-xl border-2 border-white/30 rounded-xl p-3">
                                        <p class="text-xs font-semibold text-white/70 uppercase tracking-wide mb-1">Tanggal Selesai</p>
                                        <p id="dashboardEndDateDisplay" class="text-lg font-bold text-white">-</p>
                                    </div>

                                    <!-- Duration Display dengan Blurmorphism -->
                                    <div id="dashboardDurationInfo" class="hidden">
                                        <div class="bg-white/15 backdrop-blur-xl border-2 border-white/30 rounded-2xl p-4 text-center group hover:bg-white/20 transition-all">
                                            <p class="text-xs font-semibold text-white/80 uppercase tracking-wide mb-2">Total Durasi</p>
                                            <p id="dashboardDurationDays" class="text-4xl font-bold text-white drop-shadow-lg">1 Hari</p>
                                        </div>
                                    </div>

                                    <!-- Submit Button dengan Blurmorphism -->
                                    <button
                                        type="submit"
                                        class="w-full px-4 py-3 bg-gradient-to-r from-yellow-400/90 via-yellow-300/85 to-amber-400/90 backdrop-blur-md text-slate-900 font-bold rounded-2xl hover:shadow-2xl hover:shadow-yellow-500/50 transition-all duration-300 border border-white/40 group hover:scale-105 relative overflow-hidden text-sm uppercase tracking-wider font-semibold"
                                    >
                                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/30 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        <span class="relative flex items-center justify-center gap-2">
                                            <i class="fas fa-search"></i>
                                            Cari Kendaraan
                                        </span>
                                    </button>

                                    <!-- Helper Text -->
                                    <p class="text-xs text-white/70 text-center mt-3">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Pilih tanggal rental Anda
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </header>

        {{-- ================================================================ --}}
        {{-- Scroll Reveal + Sections                                          --}}
        {{-- ================================================================ --}}
        <div class="relative z-20">
            <div class="absolute -top-24 left-0 w-full h-24 bg-gradient-to-t from-white/100 via-white/50 to-transparent pointer-events-none"></div>

            <div class="bg-slate-50 rounded-t-[48px] shadow-2xl relative">
                <div class="relative z-20 bg-slate-50 rounded-t-[48px] shadow-2xl">

                    <section class="py-20 pb-5 bg-slate-50 overflow-hidden" id="tentang">
                        <div class="max-w-4xl mx-auto px-6 text-center">
                            <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">Solusi Transportasi</span>
                            <h2 class="section-title pb-3">Layanan Terbaik Untuk Anda</h2>
                            <p id="scrollRevealParagraph" class="text-3xl md:text-4xl leading-relaxed tracking-tight"
                                style="font-family: 'Plus Jakarta Sans', sans-serif;"></p>
                        </div>
                    </section>

                    {{-- Fleet --}}
                    <section class="py-24 pb-0 pt-15 bg-slate-50" id="units">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-6">
                                <div>
                                    <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">Armada Kami</span>
                                    <h2 class="section-title">Pilih Unit Favorit Anda</h2>
                                </div>
                                <a href="{{ route('cars.index') }}" class="text-yellow-600 hover:text-yellow-700 font-normal flex items-center gap-2 transition-colors">
                                    Lihat Semua Armada <i class="fa-solid fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                            @include('cars.dashboard-cars')
                        </div>
                    </section>


                    {{-- Reviews --}}
                    <section class="py-12 sm:py-24 bg-slate-50" id="ulasan">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 sm:mb-12 gap-6">
                                <div>
                                    <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-2 sm:mb-3 block">Kepuasan Pelanggan</span>
                                    <h2 class="heading-font  sm:text-4xs font-light text-slate-900 mb-2">Ulasan Dari Pelanggan Kami</h2>
                                </div>

                                @auth
                                    {{-- DIUBAH: onclick biasa, tidak pakai Alpine --}}
                                    <button onclick="document.getElementById('reviewDialog').showModal()"
                                        class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-yellow-600 border-2 border-yellow-600 rounded-full hover:bg-yellow-600 hover:text-white transition">
                                        <i class="fa-solid fa-star text-xs"></i>
                                        Tambah Ulasan
                                    </button>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}"
                                        class="inline-flex items-center gap-2 px-6 py-3 font-semibold bg-yellow-600 text-white rounded-full hover:bg-yellow-700 transition">
                                        Tambah Ulasan
                                    </a>
                                @endguest
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
                                        <div class="item bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-md sm:shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">

                                            @if ($review->image_path)
                                                <img src="{{ asset('storage/' . $review->image_path) }}" alt="Review Image" class="w-full h-40 sm:h-48 object-cover">
                                            @elseif ($review->booking->car->images->first())
                                                <img src="{{ asset('storage/' . $review->booking->car->images->first()->image_path) }}" alt="{{ $review->booking->car->brand }}" class="w-full h-40 sm:h-48 object-cover">
                                            @else
                                                <div class="w-full h-40 sm:h-48 bg-gray-300 flex items-center justify-center">
                                                    <i class="fa-solid fa-car-side text-4xl sm:text-6xl text-gray-400"></i>
                                                </div>
                                            @endif

                                            <div class="p-4 sm:p-8 flex-1 flex flex-col">
                                                <div class="flex items-center gap-1 mb-3 sm:mb-4">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 sm:w-5 h-4 sm:h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endfor
                                                    <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-bold text-gray-700">{{ $review->rating }}/5</span>
                                                </div>

                                                <p class="text-xs sm:text-sm text-slate-600 mb-4 sm:mb-6 flex-grow line-clamp-3">
                                                    "{{ $review->comment ?? 'Pelanggan puas dengan layanan kami.' }}"
                                                </p>

                                                <div class="flex items-center gap-2 sm:gap-3 border-t border-slate-100 pt-3 sm:pt-4">
                                                    <div class="w-10 sm:w-12 h-10 sm:h-12 bg-yellow-600/10 rounded-full flex items-center justify-center flex-shrink-0">
                                                        <i class="fa-solid fa-user text-yellow-600 text-sm sm:text-lg"></i>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="font-bold text-gray-900 text-xs sm:text-sm truncate">{{ $review->booking->user->name ?? 'Pelanggan' }}</p>
                                                        <p class="text-xs text-slate-500 truncate">{{ $review->booking->car->brand ?? 'Produk' }} {{ $review->booking->car->name ?? '' }}</p>
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
                                    <p class="text-gray-500 text-base sm:text-lg mb-3 sm:mb-4">Belum ada ulasan. Jadilah yang pertama memberikan ulasan!</p>
                                    @auth
                                        <button onclick="document.getElementById('reviewDialog').showModal()"
                                            class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-yellow-600 border-2 border-yellow-600 rounded-full hover:bg-yellow-600 hover:text-white transition">
                                            <i class="fa-solid fa-star text-xs"></i>
                                            Tambah Ulasan
                                        </button>
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 font-semibold bg-yellow-600 text-white rounded-full hover:bg-yellow-700 transition">
                                            Tambah Ulasan
                                        </a>
                                    @endguest
                                </div>
                            @endif

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================ --}}
    {{-- REVIEW MODAL — <dialog> HTML native, DI DALAM x-app-layout       --}}
    {{-- ================================================================ --}}
    <dialog id="reviewDialog">
        <div class="p-8 relative">
            <button
                onclick="document.getElementById('reviewDialog').close()"
                class="absolute top-0 right-2 text-gray-400 hover:text-red-500 transition text-2xl font-light leading-none">
                ✕
            </button>

            <h2 class="text-2xl font-bold mb-2">Tambahkan Ulasan</h2>
            <p class="text-slate-500 mb-6">Bagikan pengalaman Anda</p>

            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="text-sm font-semibold mb-2 block">Pilih Pemesanan</label>
                    <select name="booking_id" required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-white">
                        <option value="">-- Pilih --</option>
                        @foreach ($bookings as $booking)
                            <option value="{{ $booking->id }}">
                                {{ $booking->car->brand }} {{ $booking->car->name }}
                                ({{ $booking->booking_code }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold block mb-2">Rating</label>
                    <input type="number" name="rating" min="1" max="5" required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="Nilai 1 - 5">
                </div>

                <div>
                    <label class="text-sm font-semibold block mb-2">Komentar</label>
                    <textarea name="comment" rows="4"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="Tulis pengalaman kamu..."></textarea>
                </div>

                <div>
                    <label class="text-sm font-semibold block mb-2">Foto (opsional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('reviewDialog').close()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 rounded-xl py-3 font-semibold transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-yellow-600 text-white rounded-xl py-3 font-semibold hover:bg-yellow-700 transition">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- ================================================================ --}}
    {{-- JAVASCRIPT                                                        --}}
    {{-- ================================================================ --}}
    <script>
        // ── Dashboard Date Form ──────────────────────────────────────────
        const dashboardStartDate = document.getElementById('dashboardStartDate');
        const dashboardDays = document.getElementById('dashboardDays');
        const dashboardEndDateDisplay = document.getElementById('dashboardEndDateDisplay');
        const dashboardDurationInfo = document.getElementById('dashboardDurationInfo');
        const dashboardDurationDays = document.getElementById('dashboardDurationDays');
        const dashboardDateForm = document.getElementById('dashboardDateForm');

        // Function to format date for display
        function formatDateDisplay(date) {
            return new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }).format(date);
        }

        // Calculate end date and duration when start date or days change
        function calculateEndDate() {
            if (dashboardStartDate.value && dashboardDays.value) {
                const start = new Date(dashboardStartDate.value);
                const days = parseInt(dashboardDays.value) || 1;

                // Create end date by adding days to start date
                const end = new Date(start);
                end.setDate(end.getDate() + days - 1);

                // Display end date
                dashboardEndDateDisplay.textContent = formatDateDisplay(end);
                dashboardDurationDays.textContent = days + ' Hari';
                dashboardDurationInfo.classList.remove('hidden');

                return end;
            } else {
                dashboardDurationInfo.classList.add('hidden');
                dashboardEndDateDisplay.textContent = '-';
            }
        }

        dashboardStartDate.addEventListener('change', calculateEndDate);
        dashboardDays.addEventListener('change', calculateEndDate);
        dashboardDays.addEventListener('input', calculateEndDate);

        // Form submission
        dashboardDateForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const startDate = dashboardStartDate.value;
            const days = dashboardDays.value;

            if (!startDate || !days) {
                alert('Harap isi tanggal mulai dan jumlah hari');
                return;
            }

            // Calculate end date
            const start = new Date(startDate);
            const end = new Date(start);
            end.setDate(end.getDate() + parseInt(days) - 1);

            // Format end date as YYYY-MM-DD
            const endDateFormatted = end.toISOString().split('T')[0];

            // Redirect to available cars list page
            window.location.href = `/bookings/select-car?start_date=${startDate}&end_date=${endDateFormatted}`;
        });

        // ── Klik backdrop dialog → tutup ─────────────────────────────────
        const reviewDialog = document.getElementById('reviewDialog');
        reviewDialog.addEventListener('click', function (e) {
            const rect = reviewDialog.getBoundingClientRect();
            const outside = e.clientX < rect.left || e.clientX > rect.right
                         || e.clientY < rect.top  || e.clientY > rect.bottom;
            if (outside) reviewDialog.close();
        });

        // ── Scroll Reveal Text ───────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', function () {
            const fullText = "Kami menyediakan berbagai pilihan layanan yang dirancang untuk memenuhi kebutuhan mobilitas Anda dengan standar kenyamanan tertinggi";
            const paragraph = document.getElementById('scrollRevealParagraph');
            if (!paragraph) return;

            paragraph.innerHTML = fullText.split(' ').map(function (word, i) {
                return `<span class="reveal-word" data-index="${i}" style="color:#cbd5e1;font-weight:100;transition:color 0.3s ease;display:inline;">${word} </span>`;
            }).join('');

            const spans = paragraph.querySelectorAll('.reveal-word');
            const total = spans.length;

            function onScroll() {
                const section = document.getElementById('tentang');
                if (!section) return;
                const rect = section.getBoundingClientRect();
                const viewH = window.innerHeight;
                const start = viewH * 0.80;
                const traveled = start - rect.top;
                let progress = traveled / (rect.bottom - rect.top - viewH * 0.1 + start - viewH * 0.1);
                progress = Math.min(Math.max(progress, 0), 1);
                const litCount = Math.round(progress * total);
                spans.forEach(function (span, i) {
                    span.style.color = i < litCount ? '#0f172a' : '#cbd5e1';
                });
            }

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        });

        // ── Parallax Hero ────────────────────────────────────────────────
        const hero = document.getElementById('heroParallax');
        let current = 0, target = 0;
        function lerp(start, end, factor) { return start + (end - start) * factor; }
        function smoothParallax() {
            current = lerp(current, target, 0.08);
            if (hero) hero.style.transform = `translate3d(0, ${current * 0.3}px, 0)`;
            requestAnimationFrame(smoothParallax);
        }
        window.addEventListener('scroll', () => { target = window.scrollY; }, { passive: true });
        smoothParallax();
    </script>

</x-app-layout>
