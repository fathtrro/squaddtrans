<x-app-layout>

    {{-- Custom Styles --}}
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
            rel="stylesheet" />
        <style>
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

            /* ===== SCROLL REVEAL TEXT ===== */
            .scroll-reveal-wrapper {
                position: relative;
                display: inline;
            }

            .word-base {
                color: #cbd5e1;
                /* slate-300 */
                font-weight: 700;
            }
            .fleet-card img {
    backface-visibility: hidden;
    perspective: 1000px;
}
#heroParallax {
    will-change: transform;
}

            .word-lit {
                color: #0f172a;
                /* slate-900 */
                font-weight: 700;
                transition: color 0.25s ease;
            }

            .word-lit.active {
                color: #0f172a;
            }

            /* Badge pill */
            .reveal-badge {
                display: inline-flex;
                align-items: center;
                border: 1px solid #cbd5e1;
                border-radius: 9999px;
                padding: 5px 18px;
                font-size: 11px;
                font-weight: 500;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: #94a3b8;
                margin-bottom: 48px;
            }

#heroParallax {
    will-change: transform, filter;
    transform: scale(1.05);
}

.fleet-card {
    will-change: transform;
    transition: box-shadow 0.4s ease;
}

.fleet-card img {
    will-change: transform;
    transform: scale(1.08);
}

/* SECTION FADE UP */
.reveal-section {
    opacity: 0;
    transform: translateY(60px);
    transition: all 1.2s cubic-bezier(.17,.67,.3,1);
}

.reveal-section.active {
    opacity: 1;
    transform: translateY(0);
}
        </style>
    @endpush

    <div class="bg-gray-50">

        {{-- ================================================================ --}}
        {{-- Hero Section                                                      --}}
        {{-- ================================================================ --}}
     <header id="heroParallax"
    class="relative w-full min-h-[120svh] overflow-hidden pt-36"
    style="background-image: url('{{ asset('images/123.jpeg') }}');
           background-size: cover;
           background-position: center;">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
                h-full flex flex-col items-center justify-center text-center">

        <div class="max-w-3xl">

            <span
                class="inline-block py-1 px-4 bg-yellow-600/20 backdrop-blur-md border border-yellow-600/30 text-yellow-500 font-bold rounded-full text-xs tracking-widest uppercase mb-8">
                Premium Travel Experience
            </span>

            <h1 class="text-4xl md:text-5xl font-medium  text-white leading-tight mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                Eksplorasi Tanpa Batas dengan
                Kenyamanan Yang Maksimal
            </h1>

            <p class="text-lg text-slate-200 mb-10 leading-relaxed">
                Layanan sewa mobil eksklusif dan paket wisata personal di Indonesia
                dengan standar pelayanan bintang lima.
            </p>

            <!-- SEARCH BAR DI HERO -->
            <div class="w-full mt-20">
                <div class="relative max-w-xl mx-auto">

                    <div class="flex items-center bg-white/90 backdrop-blur-lg
                                rounded-full p-2 shadow-2xl w-full border border-white/30">

                        <i class="fa-solid fa-search absolute left-6 text-slate-400 text-sm"></i>

                        <input type="text" id="carSearchInput"
                            placeholder="Cari merk atau model mobil..."
                            class="w-full pl-14 pr-4 py-3 bg-transparent border-none
                                   rounded-full focus:outline-none text-sm text-slate-800"
                            autocomplete="off" />
                    </div>


<!-- Modal Result -->
<div id="carSearchResults"
     class="hidden absolute bottom-full left-0
            mb-3
            w-full
            bg-white/20 backdrop-blur-md
            rounded-2xl shadow-2xl
            border border-slate-200
            p-6 z-50
            max-h-[40vh] overflow-y-auto
            transition-all duration-300 ease-out">


    <!-- Close button -->
    <button id="closeCarSearch"
        class="absolute top-4 right-4 text-slate-400 hover:text-black text-lg">
        ✕
    </button>

    <h3 class="text-base font-semibold mb-4">
        Hasil Pencarian
    </h3>

    <div id="carSearchResultList" class="space-y-3">
        <!-- Inject hasil di sini -->
    </div>
</div>
<script>
const input = document.getElementById("carSearchInput");
const modal = document.getElementById("carSearchResults");
const overlay = document.getElementById("carSearchOverlay");
const closeBtn = document.getElementById("closeCarSearch");

function openModal() {
    modal.classList.remove("hidden");
    overlay.classList.remove("hidden");
}

function closeModal() {
    modal.classList.add("hidden");
    overlay.classList.add("hidden");
}

// buka saat input focus
input.addEventListener("focus", openModal);

// close tombol X
closeBtn.addEventListener("click", closeModal);

// close klik luar
overlay.addEventListener("click", closeModal);

// optional: tekan ESC
document.addEventListener("keydown", function(e) {
    if (e.key === "Escape") closeModal();
});

const cards = document.querySelectorAll('.fleet-card');
let currentScroll = 0;
let targetScroll = 0;

function lerp(start, end, factor) {
    return start + (end - start) * factor;
}

function animate() {
    currentScroll = lerp(currentScroll, targetScroll, 0.08);

    cards.forEach(card => {
        const rect = card.getBoundingClientRect();
        const img = card.querySelector('img');
        if (!img) return;

        const speed = 0.2;
        const offset = (rect.top + currentScroll) * speed;

        img.style.transform = `translate3d(0, ${offset}px, 0)`;
    });

    requestAnimationFrame(animate);
}

window.addEventListener('scroll', () => {
    targetScroll = window.scrollY;
});

animate();

</script>

                </div>
            </div>

        </div>
    </div>
</header>
9

        {{-- ================================================================ --}}
        {{-- Search Section                                                    --}}
        {{-- ================================================================ --}}

             <script>
            document.addEventListener('DOMContentLoaded', function() {
                const carSearchInput = document.getElementById('carSearchInput');
                const carSearchResults = document.getElementById('carSearchResults');
                let searchTimeout;

                carSearchInput.addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    const query = e.target.value.trim();
                    if (query.length < 1) {
                        carSearchResults.classList.add('hidden');
                        return;
                    }
                    searchTimeout = setTimeout(function() {
                        fetchCarResults(query);
                    }, 300);
                });

                function fetchCarResults(query) {
                    fetch(`/api/search-cars?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => displayResults(data))
                        .catch(error => console.error('Error:', error));
                }

                function displayResults(cars) {
                    if (cars.length === 0) {
                        carSearchResults.innerHTML = `
                            <div class="p-4 text-center text-slate-500">
                                <i class="fa-solid fa-inbox text-2xl text-slate-300 mb-2"></i>
                                <p class="text-sm">Mobil tidak ditemukan</p>
                            </div>`;
                        carSearchResults.classList.remove('hidden');
                        return;
                    }
                   carSearchResults.innerHTML = cars.map(car => `
    <a href="/cars/${car.id}"
       class="flex items-center gap-3 px-3 py-3
              rounded-xl hover:bg-white/40 transition">

        <!-- Thumbnail -->
        <div class="w-14 h-14 rounded-lg overflow-hidden
                    bg-white/30 flex items-center justify-center">

            ${car.image
                ? `<img src="${car.image}"
                        alt="${car.label}"
                        class="w-full h-full object-cover">`
                : `<i class="fa-solid fa-car text-slate-400 text-xl"></i>`
            }

        </div>

        <!-- Info -->
        <div class="text-left">
            <div class="font-semibold text-sm text-slate-800">
                ${car.label}
            </div>
            <div class="text-xs text-slate-500">
                ${car.price}
            </div>
        </div>
    </a>
`).join('');

                    carSearchResults.classList.remove('hidden');
                }

                document.addEventListener('click', function(event) {
                    if (!event.target.closest('[id*="carSearch"]')) {
                        carSearchResults.classList.add('hidden');
                    }
                });

                carSearchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') carSearchResults.classList.add('hidden');
                });
            });
        </script>



        {{-- ================================================================ --}}
        {{-- Scroll Reveal Text Section (sebelum Services)                    --}}
        {{-- ================================================================ --}}
        <div class="relative z-20">

    <!-- Gradient Fade dari Hero -->
    <div class="absolute -top-24 left-0 w-full h-24
               bg-gradient-to-t from-white/100 via-white/50 to-transparent

                pointer-events-none">
    </div>

    <div class="bg-slate-50 rounded-t-[48px] shadow-2xl relative">

  <div class="relative z-20 bg-slate-50 rounded-t-[48px] shadow-2xl">


        <section class="py-20 pb-0 bg-slate-50 overflow-hidden" id="tentang">

            <div class="max-w-4xl mx-auto px-6 text-center">

                {{-- Badge --}}
                <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">
                    Solusi Transportasi

                </span>
                <h2 class="section-title pb-3">Layanan Terbaik Untuk Anda</h2>

                {{-- Teks dengan efek scroll reveal word by word --}}
                <p id="scrollRevealParagraph" class="text-3xl md:text-4xl leading-relaxed tracking-tight"
                    style="font-family: 'Plus Jakarta Sans', sans-serif;">
                </p>

            </div>
        </section>


        {{-- ================================================================ --}}
        {{-- Vehicle Fleet Section                                             --}}
        {{-- ================================================================ --}}
        <section class="py-24 bg-slate-50 " id="units">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div>
                        <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">
                            Armada Kami
                        </span>
                        <h2 class="section-title">Pilih Unit Favorit Anda</h2>
                    </div>
                    <a href="{{ route('cars.index') }}"
                        class="text-yellow-600 hover:text-yellow-700 font-normal flex items-center gap-2 transition-colors">
                        Lihat Semua Armada
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                </div>

                @include('cars.cars-list')

            </div>
        </section>

        {{-- ================================================================ --}}
        {{-- Services Section                                                  --}}
        {{-- ================================================================ --}}
        <section class="py-24 bg-slate-50" id="layanan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


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
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Durasi 24 Jam Penuh
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Asuransi All-Risk
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Unit Steril & Wangi
                            </li>
                        </ul>
                        <div class="pt-6 border-t border-slate-100">
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
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Driver Berlisensi
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> On-Time Guarantee
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-300">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Termasuk BBM & Parkir
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
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Itinerary Custom
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Dokumentasi Gratis
                            </li>
                            <li class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i> Tiket Masuk Objek
                                Wisata
                            </li>
                        </ul>
                        <div class="pt-6 border-t border-slate-100">
                            <p class="text-xs text-slate-400 font-bold uppercase mb-1">Mulai Dari</p>
                            <p class="text-2xl font-extrabold text-gray-900">
                                Rp 1.200.000 <span class="text-sm font-normal text-slate-400">/ paket</span>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- ================================================================ --}}
        {{-- Reviews Section                                                   --}}
        {{-- ================================================================ --}}
        <section class="py-12 sm:py-24 bg-slate-50" id="ulasan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 sm:mb-12 gap-6">
                    <div>
                        <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-2 sm:mb-3 block">
                            Kepuasan Pelanggan
                        </span>
                        <h2 class="heading-font text-2xl sm:text-4xl font-light text-slate-900 mb-2 ">
                            Ulasan Dari Pelanggan Kami
                        </h2>
                    </div>
               <a href="{{ route('reviews.create') }}"
   class="inline-flex items-center gap-2
          px-6 py-2.5 sm:py-3
          text-sm sm:text-base
          font-semibold
          text-yellow-600
          border-2 border-yellow-600
          rounded-full
          bg-transparent
          transition-all duration-300
          hover:bg-yellow-600 hover:text-white
          hover:shadow-md">

    <i class="fa-solid fa-star text-xs"></i>
    <span>Tambah Ulasan</span>
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
                            <div
                                class="item bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-md sm:shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">

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
</div>
        </div>
    {{-- ================================================================ --}}
    {{-- SCROLL REVEAL JAVASCRIPT                                          --}}
    {{-- ================================================================ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Teks yang ingin ditampilkan dengan efek reveal ──────────────
            const fullText =
                "  Kami menyediakan berbagai pilihan layanan yang dirancang untuk memenuhi kebutuhan mobilitas Anda dengan standar kenyamanan tertinggi";

            const paragraph = document.getElementById('scrollRevealParagraph');
            if (!paragraph) return;

            // Pisah per kata, bungkus tiap kata dalam <span>
            const words = fullText.split(' ');
            paragraph.innerHTML = words.map(function(word, i) {
                return `<span class="reveal-word" data-index="${i}" style="
                    color: #cbd5e1;
                    font-weight: 100;
                    transition: color 0.3s ease, opacity 0.3s ease;
                    display: inline;
                ">${word} </span>`;
            }).join('');

            const spans = paragraph.querySelectorAll('.reveal-word');
            const total = spans.length;

            function onScroll() {
                const section = document.getElementById('tentang');
                if (!section) return;

                const rect = section.getBoundingClientRect();
                const viewH = window.innerHeight;

                // progress 0 → 1 saat section melintas viewport
                // mulai reveal saat top section menyentuh 80% layar
                // selesai saat bottom section menyentuh 20% layar
                const start = viewH * 0.80;
                const end = viewH * 0.10;
                const traveled = start - rect.top;
                const range = (rect.bottom - rect.top) - (viewH - end - (viewH - start));
                let progress = traveled / (rect.bottom - rect.top - end + start - viewH * 0.1);
                progress = Math.min(Math.max(progress, 0), 1);

                const litCount = Math.round(progress * total);

                spans.forEach(function(span, i) {
                    if (i < litCount) {
                        span.style.color = '#0f172a'; // slate-900 — tebal gelap
                    } else {
                        span.style.color = '#cbd5e1'; // slate-300 — abu terang
                    }
                });
            }

            window.addEventListener('scroll', onScroll, {
                passive: true
            });
            onScroll(); // jalankan sekali saat pertama load
        });
    </script>
<script>
const hero = document.getElementById('heroParallax');

let current = 0;
let target = 0;

function lerp(start, end, factor) {
    return start + (end - start) * factor;
}

function smoothParallax() {
    current = lerp(current, target, 0.08);

    if (hero) {
        hero.style.transform = `translate3d(0, ${current * 0.3}px, 0)`;
    }

    requestAnimationFrame(smoothParallax);
}

window.addEventListener('scroll', () => {
    target = window.scrollY;
}, { passive: true });

smoothParallax();
</script>

</x-app-layout>
