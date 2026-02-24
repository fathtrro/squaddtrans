<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* ===============================
   CONTAINER
=================================*/

.cars-scroll-container {
    position: relative;
    margin-bottom: 3rem;
}

/* ===============================
   MOBILE (INFINITE SCROLL)
=================================*/

@media (max-width: 767px) {

    .cars-scroll-wrapper {
        overflow: hidden;
        position: relative;
    }

    .cars-scroll {
        display: flex;
        gap: 14px;
        padding-bottom: 20px;
        will-change: transform;
        /* PENTING: mulai tanpa transition agar jumpTo tidak terlihat */
        transition: none;
    }

    .cars-scroll .fleet-card {
        flex: 0 0 calc(48% - 7px);
        min-width: calc(48% - 7px);
    }

    .scroll-btn {
        display: flex;
    }
}

/* ===============================
   DESKTOP (GRID, NO SCROLL)
=================================*/

@media (min-width: 768px) {

    .cars-scroll-wrapper {
        overflow: visible;
    }

    .cars-scroll {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .fleet-card-clone {
        display: none;
    }

    .scroll-btn {
        display: none;
    }
}

/* ===============================
   CARD
=================================*/

.fleet-card {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    height: 260px;
    cursor: pointer;
    text-decoration: none;
    display: block;
}

.fleet-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.fleet-card:hover img {
    transform: scale(1.05);
}

.fleet-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.9) 0%,
        rgba(0,0,0,0.7) 40%,
        rgba(0,0,0,0.3) 75%,
        rgba(0,0,0,0) 100%
    );
    z-index: 1;
}

.overlay-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 16px;
    z-index: 2;
    color: white;
    text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}

/* ===============================
   MOBILE ARROW BUTTON
=================================*/

.scroll-btn {
    position: absolute;
    top: 42%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.6);
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    border: none;
    outline: none;
    -webkit-tap-highlight-color: transparent;
}

.scroll-left { left: -8px; }
.scroll-right { right: -8px; }

/* ===============================
   DOTS INDICATOR
=================================*/

.cars-dots {
    display: flex;
    justify-content: center;
    gap: 6px;
    margin-top: 12px;
}

.cars-dots span {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #cbd5e1;
    transition: all 0.3s ease;
    display: block;
    cursor: pointer;
}

.cars-dots span.active {
    background: #d97706;
    width: 18px;
    border-radius: 3px;
}

@media (min-width: 768px) {
    .cars-dots { display: none; }
}

</style>


<div class="cars-scroll-container">

    <!-- MOBILE ARROW -->
    <button class="scroll-btn scroll-left" onclick="carsScroll(-1)" aria-label="Sebelumnya">
        <i class="fa-solid fa-chevron-left text-xs"></i>
    </button>

    <button class="scroll-btn scroll-right" onclick="carsScroll(1)" aria-label="Berikutnya">
        <i class="fa-solid fa-chevron-right text-xs"></i>
    </button>

    <div class="cars-scroll-wrapper" id="carsWrapper">
        <div class="cars-scroll" id="carsTrack">

            @forelse($cars as $car)
                <a href="{{ route('cars.show', $car) }}" class="fleet-card" data-original>

                    @if ($car->images->first())
                        <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                             alt="{{ $car->name }}" loading="lazy">
                    @endif

                    <div class="overlay-content">
                        <h3 class="text-sm font-bold">{{ $car->brand }}</h3>
                        <p class="text-[11px] text-gray-200 mb-2">{{ $car->name }}</p>

                        <div class="flex items-center gap-1 text-yellow-400 text-[11px] mb-2">
                            <i class="fa-solid fa-star"></i>
                            <span class="text-white font-semibold">4.8</span>
                            <span class="text-gray-300">(120)</span>
                        </div>

                        <div class="flex justify-between text-[10px] text-gray-300 mb-2">
                            <span><i class="fa-solid fa-calendar"></i> {{ $car->year }}</span>
                            <span><i class="fa-solid fa-users"></i> {{ $car->seats }}</span>
                            <span><i class="fa-solid fa-gear"></i> {{ ucfirst($car->transmission) == 'Automatic' ? 'Matic' : 'Manual' }}</span>
                        </div>

                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[9px] text-gray-300">Mulai</p>
                                <span class="text-base font-bold">
                                    Rp {{ number_format($car->price_24h / 1000, 0) }}K
                                </span>
                            </div>
                            <div class="px-2 py-1 rounded-full text-[9px]
                                {{ $car->status == 'available' ? 'bg-green-500/80' : 'bg-red-500/80' }}">
                                {{ $car->status == 'available' ? 'Tersedia' : 'Disewa' }}
                            </div>
                        </div>
                    </div>

                </a>

            @empty
                <div class="text-center py-16 col-span-full">
                    <h3 class="text-xl font-semibold text-gray-800">Tidak Ada Armada</h3>
                </div>
            @endforelse

        </div>
    </div>

    <!-- DOTS -->
    <div class="cars-dots" id="carsDots"></div>

</div>


<script>
(function () {

    // Hanya jalankan di mobile
    if (window.innerWidth >= 768) return;

    const wrapper   = document.getElementById('carsWrapper');
    const track     = document.getElementById('carsTrack');
    const dotsEl    = document.getElementById('carsDots');
    const originals = Array.from(track.querySelectorAll('[data-original]'));
    const total     = originals.length;

    if (total < 1) return;

    // Kalau hanya 1 item, tidak perlu clone & infinite logic
    const needsLoop = total > 1;

    const GAP = 14; // harus sama dengan gap di CSS

    // ── 1. Clone cards ────────────────────────────────────────────────
    if (needsLoop) {
        // Clone belakang (append)
        originals.forEach(function (el) {
            const clone = el.cloneNode(true);
            clone.classList.add('fleet-card-clone');
            clone.removeAttribute('data-original');
            track.appendChild(clone);
        });

        // Clone depan (prepend)
        const prepends = originals.map(function (el) {
            const clone = el.cloneNode(true);
            clone.classList.add('fleet-card-clone');
            clone.removeAttribute('data-original');
            return clone;
        }).reverse();
        prepends.forEach(function (el) { track.prepend(el); });
    }

    // ── 2. Hitung lebar card ──────────────────────────────────────────
    function getCardWidth() {
        // paksa hitung dari wrapper yang sudah dirender
        const w = wrapper.getBoundingClientRect().width;
        return Math.floor((w / 2) - (GAP / 2));
    }

    // ── 3. State ──────────────────────────────────────────────────────
    let currentIndex = 0; // index relatif ke card asli (0 = pertama)
    let isAnimating  = false;

    // ── 4. Dots ───────────────────────────────────────────────────────
    originals.forEach(function (_, i) {
        const dot = document.createElement('span');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', function () { goTo(i); });
        dotsEl.appendChild(dot);
    });

    function updateDots() {
        const dots = dotsEl.querySelectorAll('span');
        const norm = ((currentIndex % total) + total) % total;
        dots.forEach(function (d, i) {
            d.classList.toggle('active', i === norm);
        });
    }

    // ── 5. Offset ─────────────────────────────────────────────────────
    function getOffset(index) {
        const cardW    = getCardWidth();
        // posisi absolut: clone depan ada di slot 0..(total-1), originals di total..(2*total-1)
        const absIndex = needsLoop ? total + index : index;
        return -(absIndex * (cardW + GAP));
    }

    // ── 6. jumpTo — tanpa animasi ─────────────────────────────────────
    function jumpTo(index) {
        track.style.transition = 'none';
        track.style.transform  = 'translateX(' + getOffset(index) + 'px)';
        // force reflow agar browser apply dulu sebelum transition dihidupkan lagi
        track.getBoundingClientRect();
    }

    // ── 7. slideTo — dengan animasi ───────────────────────────────────
    function slideTo(index, cb) {
        isAnimating = true;
        track.style.transition = 'transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        track.style.transform  = 'translateX(' + getOffset(index) + 'px)';

        function onEnd() {
            track.removeEventListener('transitionend', onEnd);
            isAnimating = false;
            if (cb) cb();
        }
        track.addEventListener('transitionend', onEnd);
    }

    // ── 8. INISIALISASI — tunggu gambar & layout siap ─────────────────
    // Gunakan 2 frame + setTimeout 0 untuk pastikan wrapper sudah punya lebar
    function init() {
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                setTimeout(function () {
                    jumpTo(0); // set posisi awal ke card pertama asli
                    updateDots();

                    // Aktifkan autoplay setelah posisi benar
                    startAutoPlay();
                }, 50); // 50ms buffer untuk layout mobile browser
            });
        });
    }

    // ── 9. goTo ───────────────────────────────────────────────────────
    function goTo(targetIndex) {
        if (isAnimating) return;

        slideTo(targetIndex, function () {
            currentIndex = targetIndex;

            if (needsLoop) {
                if (currentIndex >= total) {
                    currentIndex -= total;
                    jumpTo(currentIndex);
                } else if (currentIndex < 0) {
                    currentIndex += total;
                    jumpTo(currentIndex);
                }
            } else {
                // tanpa loop: clamp
                currentIndex = Math.max(0, Math.min(currentIndex, total - 1));
            }

            updateDots();
        });
    }

    // Expose ke tombol
    window.carsScroll = function (dir) { goTo(currentIndex + dir); };

    // ── 10. Auto-play ─────────────────────────────────────────────────
    let autoTimer = null;

    function startAutoPlay() {
        clearInterval(autoTimer);
        if (!needsLoop) return;
        autoTimer = setInterval(function () { goTo(currentIndex + 1); }, 3000);
    }

    function pauseAutoPlay() { clearInterval(autoTimer); }

    wrapper.addEventListener('touchstart', pauseAutoPlay, { passive: true });
    wrapper.addEventListener('touchend',   startAutoPlay, { passive: true });

    // ── 11. Swipe ─────────────────────────────────────────────────────
    let touchStartX = 0, touchStartTime = 0;

    wrapper.addEventListener('touchstart', function (e) {
        touchStartX    = e.touches[0].clientX;
        touchStartTime = Date.now();
    }, { passive: true });

    wrapper.addEventListener('touchend', function (e) {
        const dx  = touchStartX - e.changedTouches[0].clientX;
        const dt  = Date.now() - touchStartTime;
        const vel = Math.abs(dx) / dt;

        if (Math.abs(dx) > 40 || vel > 0.3) {
            goTo(currentIndex + (dx > 0 ? 1 : -1));
        }
    }, { passive: true });

    // ── 12. Recalculate on resize ─────────────────────────────────────
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 768) return;
        jumpTo(currentIndex);
    });

    // ── MULAI ─────────────────────────────────────────────────────────
    init();

})();
</script>