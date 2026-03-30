<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

/* ===============================
   BASE
=================================*/

.cars-section * {
    box-sizing: border-box;
}

/* ===============================
   GRID CONTAINER
=================================*/

.cars-section {
    margin-bottom: 4rem;
}

/* ===============================
   MOBILE — 2 kolom × 3 baris
=================================*/

@media (max-width: 767px) {

    .cars-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .fleet-card.mobile-hidden {
        display: none;
    }

    .mobile-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .desktop-pagination { display: none; }
}

/* ===============================
   DESKTOP — 4 kolom
=================================*/

@media (min-width: 768px) {

    .cars-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .fleet-card.mobile-hidden {
        display: block !important;
    }

    .mobile-pagination { display: none; }

    .desktop-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-top: 40px;
        flex-wrap: wrap;
    }
}

/* ===============================
   FLEET CARD — PREMIUM
=================================*/

.fleet-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    text-decoration: none;
    display: block;
    height: 210px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.10);
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1),
                box-shadow 0.35s ease;
}

@media (min-width: 768px) {
    .fleet-card {
        height: 270px;
        border-radius: 20px;
    }
}

.fleet-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 20px 48px rgba(0,0,0,0.18);
}

.fleet-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    display: block;
}

.fleet-card:hover img {
    transform: scale(1.08);
}

/* Gradient overlay */
.fleet-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background:
        linear-gradient(
            to top,
            rgba(5, 7, 15, 0.97) 0%,
            rgba(5, 7, 15, 0.75) 38%,
            rgba(5, 7, 15, 0.2) 65%,
            transparent 100%
        );
    z-index: 1;
    transition: opacity 0.35s ease;
}

/* Status badge top-right */
.card-status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 3;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.15);
}

.card-status-badge.available {
    background: rgba(16, 185, 129, 0.75);
    color: #ecfdf5;
}

.card-status-badge.rented {
    background: rgba(239, 68, 68, 0.75);
    color: #fef2f2;
}

@media (min-width: 768px) {
    .card-status-badge {
        top: 14px;
        right: 14px;
        font-size: 10px;
        padding: 4px 10px;
    }
}

/* Card body content */
.overlay-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 11px 12px 12px;
    z-index: 2;
    color: white;
    font-family: 'DM Sans', sans-serif;
}

@media (min-width: 768px) {
    .overlay-content {
        padding: 16px 18px 18px;
    }
}

.card-brand {
    font-size: 9px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #fbbf24;
    margin-bottom: 2px;
    line-height: 1;
}

.card-name {
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 7px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

@media (min-width: 768px) {
    .card-brand { font-size: 10px; margin-bottom: 3px; }
    .card-name  { font-size: 15px; margin-bottom: 10px; }
}

/* Specs row */
.card-specs {
    display: flex;
    gap: 8px;
    margin-bottom: 8px;
}

.card-spec-item {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 9px;
    color: rgba(255,255,255,0.65);
}

.card-spec-item i {
    font-size: 8px;
    color: rgba(255,255,255,0.4);
}

@media (min-width: 768px) {
    .card-spec-item { font-size: 10px; }
    .card-spec-item i { font-size: 9px; }
    .card-specs { gap: 10px; margin-bottom: 10px; }
}

/* Divider */
.card-divider {
    height: 1px;
    background: rgba(255,255,255,0.10);
    margin-bottom: 8px;
}

@media (min-width: 768px) {
    .card-divider { margin-bottom: 10px; }
}

/* Price + rating */
.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.card-price-label {
    font-size: 8px;
    color: rgba(255,255,255,0.45);
    line-height: 1;
    margin-bottom: 2px;
}

.card-price {
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}

.card-price sup {
    font-size: 9px;
    font-weight: 500;
    color: rgba(255,255,255,0.6);
    margin-right: 1px;
}

@media (min-width: 768px) {
    .card-price { font-size: 18px; }
    .card-price sup { font-size: 10px; }
    .card-price-label { font-size: 9px; }
}

.card-rating {
    display: flex;
    align-items: center;
    gap: 4px;
    background: rgba(255,255,255,0.10);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border: 1px solid rgba(255,255,255,0.12);
    padding: 3px 7px;
    border-radius: 20px;
}

.card-rating i {
    color: #fbbf24;
    font-size: 8px;
}

.card-rating span {
    font-size: 10px;
    font-weight: 700;
    color: #fff;
}

@media (min-width: 768px) {
    .card-rating span { font-size: 11px; }
    .card-rating i    { font-size: 9px; }
    .card-rating { padding: 4px 9px; }
}

/* ===============================
   EMPTY STATE
=================================*/

.empty-state {
    grid-column: 1 / -1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 24px;
    text-align: center;
    background: linear-gradient(135deg, #fafafa, #f3f4f6);
    border-radius: 20px;
    border: 2px dashed #e5e7eb;
}

.empty-state-icon {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.empty-state-icon i {
    font-size: 30px;
    color: #d97706;
}

.empty-state h3 {
    font-family: 'DM Sans', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
}

.empty-state p {
    font-size: 14px;
    color: #6b7280;
}

/* ===============================
   PAGINATION BUTTONS
=================================*/

.page-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    min-width: 38px;
    height: 38px;
    padding: 0 12px;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    border: 1.5px solid #e5e7eb;
    background: white;
    color: #4b5563;
    transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    user-select: none;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}

.page-btn:hover {
    background: #111827;
    border-color: #111827;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.page-btn.active {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border-color: transparent;
    color: white;
    box-shadow: 0 4px 14px rgba(217, 119, 6, 0.4);
}

.page-btn.active:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(217, 119, 6, 0.45);
}

.page-btn.disabled {
    opacity: 0.35;
    cursor: not-allowed;
    pointer-events: none;
    box-shadow: none;
}

.page-btn.dots {
    border: none;
    background: none;
    box-shadow: none;
    cursor: default;
    color: #9ca3af;
    pointer-events: none;
    min-width: 24px;
    padding: 0;
}

/* Mobile pagination compact */
.mobile-pagination .page-btn {
    min-width: 34px;
    height: 34px;
    font-size: 12px;
    border-radius: 8px;
    padding: 0 8px;
}

/* ===============================
   LOAD ANIMATION
=================================*/

@keyframes cardReveal {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fleet-card[data-original] {
    animation: cardReveal 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

.fleet-card[data-original]:nth-child(1)  { animation-delay: 0.03s; }
.fleet-card[data-original]:nth-child(2)  { animation-delay: 0.07s; }
.fleet-card[data-original]:nth-child(3)  { animation-delay: 0.11s; }
.fleet-card[data-original]:nth-child(4)  { animation-delay: 0.15s; }
.fleet-card[data-original]:nth-child(5)  { animation-delay: 0.19s; }
.fleet-card[data-original]:nth-child(6)  { animation-delay: 0.23s; }
.fleet-card[data-original]:nth-child(7)  { animation-delay: 0.27s; }
.fleet-card[data-original]:nth-child(8)  { animation-delay: 0.31s; }
.fleet-card[data-original]:nth-child(9)  { animation-delay: 0.35s; }
.fleet-card[data-original]:nth-child(10) { animation-delay: 0.39s; }
.fleet-card[data-original]:nth-child(11) { animation-delay: 0.43s; }
.fleet-card[data-original]:nth-child(12) { animation-delay: 0.47s; }

</style>


<div class="cars-section">

    {{-- GRID --}}
    <div class="cars-grid" id="carsGrid">

        @forelse($cars as $i => $car)

            @php
                $avgRating = $car->reviews->avg('rating');
                $reviewCount = $car->reviews->count();
            @endphp

            <a href="{{ route('cars.show', $car) }}"
               class="fleet-card"
               data-index="{{ $i }}"
               data-original>

                {{-- Image --}}
                @if ($car->images->first())
                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                         alt="{{ $car->name }}" loading="lazy">
                @else
                    <img src="https://placehold.co/400x270/0f172a/475569?text={{ urlencode($car->brand) }}"
                         alt="{{ $car->name }}">
                @endif

                {{-- Status Badge --}}
                <div class="card-status-badge {{ $car->status == 'available' ? 'available' : 'rented' }}">
                    {{ $car->status == 'available' ? 'Tersedia' : 'Disewa' }}
                </div>

                {{-- Content --}}
                <div class="overlay-content">
                    <div class="card-brand">{{ $car->brand }}</div>
                    <div class="card-name">{{ $car->name }}</div>

                    <div class="card-specs">
                        <div class="card-spec-item">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>{{ $car->year }}</span>
                        </div>
                        <div class="card-spec-item">
                            <i class="fa-solid fa-users"></i>
                            <span>{{ $car->seats }} Kursi</span>
                        </div>
                        <div class="card-spec-item">
                            <i class="fa-solid fa-gear"></i>
                            <span>{{ $car->transmission == 'automatic' ? 'Matic' : 'Manual' }}</span>
                        </div>
                    </div>

                    <div class="card-divider"></div>

                    <div class="card-footer">
                        <div>
                            <div class="card-price-label">Mulai dari / 24 jam</div>
                            <div class="card-price">
                                <sup>Rp</sup>{{ number_format($car->price_24h / 1000, 0) }}K
                            </div>
                        </div>
                        <div class="card-rating">
                            <i class="fa-solid fa-star"></i>
                            <span>{{ $avgRating ? number_format($avgRating, 1) : '4.8' }}</span>
                        </div>
                    </div>
                </div>

            </a>

        @empty

            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <h3>Tidak Ada Armada</h3>
                <p>Coba ubah filter atau kata kunci pencarian Anda</p>
            </div>

        @endforelse

    </div>

    {{-- MOBILE PAGINATION --}}
    <div class="mobile-pagination" id="mobilePagination"></div>

    {{-- DESKTOP PAGINATION --}}
    @php
        $isPaginator = $cars instanceof \Illuminate\Pagination\LengthAwarePaginator;
    @endphp

    @if ($isPaginator && $cars->hasPages())
    <div class="desktop-pagination">

        {{-- Prev --}}
        @if ($cars->onFirstPage())
            <span class="page-btn disabled">
                <i class="fa-solid fa-chevron-left" style="font-size:11px"></i>
            </span>
        @else
            <a href="{{ $cars->previousPageUrl() }}" class="page-btn">
                <i class="fa-solid fa-chevron-left" style="font-size:11px"></i>
            </a>
        @endif

        {{-- Smart page numbers --}}
        @php
            $current  = $cars->currentPage();
            $last     = $cars->lastPage();
            $pages    = [];

            // Always show: 1, ..., current-1, current, current+1, ..., last
            if ($last <= 7) {
                $pages = range(1, $last);
            } else {
                $pages[] = 1;
                if ($current > 3)  $pages[] = '...';
                for ($p = max(2, $current - 1); $p <= min($last - 1, $current + 1); $p++) {
                    $pages[] = $p;
                }
                if ($current < $last - 2) $pages[] = '...';
                $pages[] = $last;
            }
        @endphp

        @foreach ($pages as $page)
            @if ($page === '...')
                <span class="page-btn dots">···</span>
            @elseif ($page == $current)
                <span class="page-btn active">{{ $page }}</span>
            @else
                <a href="{{ $cars->url($page) }}" class="page-btn">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next --}}
        @if ($cars->hasMorePages())
            <a href="{{ $cars->nextPageUrl() }}" class="page-btn">
                <i class="fa-solid fa-chevron-right" style="font-size:11px"></i>
            </a>
        @else
            <span class="page-btn disabled">
                <i class="fa-solid fa-chevron-right" style="font-size:11px"></i>
            </span>
        @endif

    </div>
    @endif

</div>


<script>
(function () {

    /* ─── Guard: hanya mobile ─── */
    if (window.innerWidth >= 768) return;

    const MOBILE_PER_PAGE = 6;

    const grid       = document.getElementById('carsGrid');
    const paginEl    = document.getElementById('mobilePagination');
    const allCards   = Array.from(grid.querySelectorAll('.fleet-card[data-original]'));
    const totalCards = allCards.length;

    if (totalCards === 0) return;

    @php
        $isPaginator = $cars instanceof \Illuminate\Pagination\LengthAwarePaginator;
    @endphp

    @if($isPaginator)
        const serverTotal   = {{ $cars->total() }};
        const serverPerPage = {{ $cars->perPage() }};
        const serverPage    = {{ $cars->currentPage() }};
        const prevUrl       = @json($cars->previousPageUrl());
        const nextUrl       = @json($cars->nextPageUrl());
    @else
        const serverTotal   = {{ $cars->count() }};
        const serverPerPage = {{ $cars->count() }};
        const serverPage    = 1;
        const prevUrl       = null;
        const nextUrl       = null;
    @endif

    const mobilePages = Math.ceil(totalCards / MOBILE_PER_PAGE);

    /* ── State ── */
    let mobilePage = 1;

    /* ── Cek _mobile param di URL ── */
    (function () {
        const mp = new URLSearchParams(window.location.search).get('_mobile');
        if (mp === 'last')               mobilePage = mobilePages;
        else if (mp && !isNaN(+mp))     mobilePage = Math.max(1, Math.min(+mp, mobilePages));
    })();

    /* ── Render cards ── */
    function renderCards() {
        const start = (mobilePage - 1) * MOBILE_PER_PAGE;
        const end   = start + MOBILE_PER_PAGE;
        allCards.forEach(function (c, i) {
            c.classList.toggle('mobile-hidden', !(i >= start && i < end));
        });
    }

    /* ── Render pagination ── */
    function renderPagination() {
        paginEl.innerHTML = '';

        const totalMobileGlobal   = Math.ceil(serverTotal / MOBILE_PER_PAGE);
        const mobilePerServer     = serverPerPage / MOBILE_PER_PAGE;
        const currentMobileGlobal = (serverPage - 1) * mobilePerServer + mobilePage;

        /* Prev */
        const btnPrev = document.createElement('button');
        const isFirst = mobilePage === 1 && serverPage === 1;
        btnPrev.className = 'page-btn' + (isFirst ? ' disabled' : '');
        btnPrev.innerHTML = '<i class="fa-solid fa-chevron-left" style="font-size:10px"></i>';
        if (!isFirst) {
            btnPrev.addEventListener('click', function () {
                if (mobilePage > 1) {
                    mobilePage--;
                    renderCards();
                    renderPagination();
                    scrollToGrid();
                } else if (prevUrl) {
                    window.location.href = prevUrl + (prevUrl.includes('?') ? '&' : '?') + '_mobile=last';
                }
            });
        }
        paginEl.appendChild(btnPrev);

        /* Page numbers — smart window */
        const half   = 2;
        let pStart   = Math.max(1, currentMobileGlobal - half);
        let pEnd     = Math.min(totalMobileGlobal, currentMobileGlobal + half);
        if (pEnd - pStart < 4) {
            if (pStart === 1) pEnd = Math.min(totalMobileGlobal, 5);
            else pStart = Math.max(1, pEnd - 4);
        }

        if (pStart > 1) {
            const ellBtn = document.createElement('span');
            ellBtn.className = 'page-btn dots';
            ellBtn.textContent = '···';
            paginEl.appendChild(ellBtn);
        }

        for (let p = pStart; p <= pEnd; p++) {
            const btn = document.createElement('button');
            btn.className = 'page-btn' + (p === currentMobileGlobal ? ' active' : '');
            btn.textContent = p;
            btn.addEventListener('click', (function (pg) {
                return function () { goToGlobal(pg); };
            })(p));
            paginEl.appendChild(btn);
        }

        if (pEnd < totalMobileGlobal) {
            const ellBtn = document.createElement('span');
            ellBtn.className = 'page-btn dots';
            ellBtn.textContent = '···';
            paginEl.appendChild(ellBtn);
        }

        /* Next */
        const isLast = mobilePage >= mobilePages && !nextUrl;
        const btnNext = document.createElement('button');
        btnNext.className = 'page-btn' + (isLast ? ' disabled' : '');
        btnNext.innerHTML = '<i class="fa-solid fa-chevron-right" style="font-size:10px"></i>';
        if (!isLast) {
            btnNext.addEventListener('click', function () {
                if (mobilePage < mobilePages) {
                    mobilePage++;
                    renderCards();
                    renderPagination();
                    scrollToGrid();
                } else if (nextUrl) {
                    window.location.href = nextUrl;
                }
            });
        }
        paginEl.appendChild(btnNext);
    }

    /* ── Go to global mobile page ── */
    function goToGlobal(globalPage) {
        const mobilePerServer = serverPerPage / MOBILE_PER_PAGE;
        const targetServer    = Math.ceil(globalPage / mobilePerServer);
        const targetMobile    = globalPage - (targetServer - 1) * mobilePerServer;

        if (targetServer === serverPage) {
            mobilePage = targetMobile;
            renderCards();
            renderPagination();
            scrollToGrid();
        } else {
            const url = '{{ $isPaginator ? $cars->url(1) : "#" }}'.replace(/page=\d+/, 'page=' + targetServer);
            window.location.href = url + '&_mobile=' + targetMobile;
        }
    }

    /* ── Scroll to top of grid ── */
    function scrollToGrid() {
        const top = grid.getBoundingClientRect().top + window.scrollY - 80;
        window.scrollTo({ top: top, behavior: 'smooth' });
    }

    /* ── INIT ── */
    renderCards();
    renderPagination();

})();
</script>
