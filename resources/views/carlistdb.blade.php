<style>

/* ===============================
   WRAPPER — overflow hidden
=================================*/
.carousel-wrapper {
    overflow: hidden;
    width: 100%;
}

/* ===============================
   CONTAINER — padding kiri supaya
   border-radius tidak terpotong
=================================*/
.carousel-container {
    position: relative;
    width: 100%;
    padding: 4px 0 4px 10px;
}

/* ===============================
   TRACK
=================================*/
.carousel-track {
    display: flex;
    transition: transform 0.4s ease;
    cursor: grab;
    will-change: transform;
}

.carousel-track.dragging {
    cursor: grabbing;
    transition: none;
}

/* ===============================
   ITEM
   Mobile  : 2 card sekaligus terlihat
   Desktop : 4 card
=================================*/
.carousel-item {
    flex: 0 0 calc(50% - 8px);  /* 2 card mobile */
    padding: 0 5px;
}

@media (min-width: 768px) {
    .carousel-item {
        flex: 0 0 25%;           /* 4 card desktop */
        padding: 0 10px;
    }
}

/* ===============================
   CARD
=================================*/
.fleet-card {
    position: relative;
    height: 180px;
    border-radius: 14px;
    overflow: hidden;
    display: block;
}

@media (min-width: 768px) {
    .fleet-card {
        height: 220px;
        border-radius: 16px;
    }
}

.fleet-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    pointer-events: none;
    user-select: none;
}

.fleet-card:hover img {
    transform: scale(1.04);
}

.fleet-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.75) 0%,
        rgba(0,0,0,0.2) 55%,
        rgba(0,0,0,0) 100%
    );
}

.overlay-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 12px 14px;
    z-index: 2;
    color: white;
}

</style>


<div class="carousel-wrapper">
    <div class="carousel-container">
        <div id="carouselTrack" class="carousel-track">

            @foreach($mobil as $car)
                <div class="carousel-item">
                    <a href="{{ route('cars.show', $car) }}" class="fleet-card">

                        @if ($car->images->first())
                            <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                                 alt="{{ $car->name }}"
                                 draggable="false">
                        @endif

                        <div class="overlay-content">
                            <h3 class="text-sm font-semibold leading-tight">
                                {{ $car->brand }}
                            </h3>
                            <p class="text-xs text-gray-300">
                                {{ $car->name }}
                            </p>
                        </div>

                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>


<script>
(function () {
    const track = document.getElementById('carouselTrack');

    // Mobile: geser 2 card; Desktop: geser 1 card (4 terlihat)
    function getPerView() {
        return window.innerWidth >= 768 ? 1 : 2;
    }

    let perView          = getPerView();
    let index            = perView;
    let startX           = 0;
    let currentTranslate = 0;
    let prevTranslate    = 0;
    let isDragging       = false;
    let autoTimer        = null;
    const AUTO_INTERVAL  = 3000;
    const DRAG_THRESHOLD = 50;

    /* ── Clone untuk infinite loop ── */
    function setupClones() {
        track.querySelectorAll('[data-clone]').forEach(el => el.remove());

        const originals = Array.from(track.children);
        perView = getPerView();

        // Clone depan → tempel belakang
        originals.slice(0, perView).forEach(el => {
            const c = el.cloneNode(true);
            c.dataset.clone = 'end';
            track.appendChild(c);
        });

        // Clone belakang → sisip depan
        [...originals].slice(-perView).reverse().forEach(el => {
            const c = el.cloneNode(true);
            c.dataset.clone = 'start';
            track.insertBefore(c, track.firstChild);
        });

        index = perView;
        setPosition(false);
    }

    function slides()     { return Array.from(track.children); }
    function slideWidth() { return slides()[index]?.offsetWidth ?? 0; }

    function setPosition(animated) {
        currentTranslate = -slideWidth() * index;
        prevTranslate    = currentTranslate;
        track.style.transition = animated ? 'transform 0.4s ease' : 'none';
        track.style.transform  = `translateX(${currentTranslate}px)`;
    }

    function goTo(newIndex) {
        index            = newIndex;
        currentTranslate = -slideWidth() * index;
        prevTranslate    = currentTranslate;
        track.style.transition = 'transform 0.4s ease';
        track.style.transform  = `translateX(${currentTranslate}px)`;
    }

    /* ── Teleport diam-diam saat sudah di clone ── */
    track.addEventListener('transitionend', () => {
        const all      = slides();
        const lastReal = all.length - perView;

        if (index >= lastReal) {
            index = perView + (index - lastReal);
            track.style.transition = 'none';
            setPosition(false);
        } else if (index < perView) {
            index = all.length - perView * 2 - (perView - index);
            track.style.transition = 'none';
            setPosition(false);
        }
    });

    /* ── Auto slide ── */
    function startAuto() {
        stopAuto();
        autoTimer = setInterval(() => goTo(index + 1), AUTO_INTERVAL);
    }

    function stopAuto() {
        clearInterval(autoTimer);
        autoTimer = null;
    }

    /* ── Touch & Mouse drag ── */
    function getX(e) {
        return e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
    }

    track.addEventListener('mousedown',  onStart);
    track.addEventListener('touchstart', onStart, { passive: true });
    track.addEventListener('mousemove',  onMove);
    track.addEventListener('touchmove',  onMove, { passive: true });
    track.addEventListener('mouseup',    onEnd);
    track.addEventListener('mouseleave', onEnd);
    track.addEventListener('touchend',   onEnd);

    function onStart(e) {
        isDragging = true;
        startX     = getX(e);
        track.classList.add('dragging');
        track.style.transition = 'none';
        stopAuto();
    }

    function onMove(e) {
        if (!isDragging) return;
        track.style.transform = `translateX(${prevTranslate + getX(e) - startX}px)`;
    }

    function onEnd() {
        if (!isDragging) return;
        isDragging = false;
        track.classList.remove('dragging');

        const current = parseFloat(track.style.transform.replace('translateX(', ''));
        const moved   = current - prevTranslate;

        if (moved < -DRAG_THRESHOLD)     index += 1;
        else if (moved > DRAG_THRESHOLD) index -= 1;

        setPosition(true);
        startAuto();
    }

    /* ── Cegah klik saat drag ── */
    track.addEventListener('click', e => {
        const current = parseFloat(track.style.transform.replace('translateX(', ''));
        if (Math.abs(current - prevTranslate) > 5) e.preventDefault();
    }, true);

    /* ── Resize debounce ── */
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            stopAuto();
            setupClones();
            startAuto();
        }, 200);
    });

    setupClones();
    startAuto();
})();
</script>
