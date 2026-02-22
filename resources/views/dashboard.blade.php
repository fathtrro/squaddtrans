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
                   background-position: center;">
  <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col">

                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-10">
                    <div class="max-w-3xl">

    <!-- Badge -->
    <span class="inline-block py-1 px-4 
        bg-yellow-500/10 
        border border-yellow-400/30 
        text-yellow-400 
        rounded-full text-xs tracking-widest uppercase mb-6">
        Premium Travel Experience
    </span>

    <!-- Heading -->
    <h1 class="text-4xl md:text-4xl text-white leading-tight text"
        style="font-weight:400; font-family:'Plus Jakarta Sans', sans-serif; letter-spacing:-0.02em;">
        
        Eksplorasi Tanpa Batas<br> dengan 
       
            Kenyamanan
     
        yang Maksimal
        
    </h1>

</div>

                    <div class="flex items-center gap-4 mt-6 lg:mt-0">
                        <div class="flex -space-x-3">
                            <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                            <img src="https://i.pravatar.cc/40?img=3" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                        </div>
                        <div class="text-white">
                            <div class="text-lg font-semibold">500+</div>
                            <div class="text-sm text-slate-300">Happy Customers</div>
                        </div>
                    </div>
                </div>

            </div>

            <section id="units">
                <div class="max-w-7xl mx-auto pt-0 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6"></div>
                    @include('carlistdb')
                </div>
            </section>

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
                    <section class="py-24 pt-0 bg-slate-50" id="units">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                                <div>
                                    <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-3 block">Armada Kami</span>
                                    <h2 class="section-title">Pilih Unit Favorit Anda</h2>
                                </div>
                                <a href="{{ route('cars.index') }}" class="text-yellow-600 hover:text-yellow-700 font-normal flex items-center gap-2 transition-colors">
                                    Lihat Semua Armada <i class="fa-solid fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                            @include('cars.cars-list')
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
