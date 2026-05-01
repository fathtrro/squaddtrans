<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>

        :root {
            --gold:    #d97706;
            --gold-lt: #f59e0b;
            --dark:    #0c0f18;
            --surface: #ffffff;
            --border:  #e9eaec;
            --text:    #1a1d27;
            --muted:   #6b7280;
            --radius:  14px;
        }

        body {

            background: #f4f5f7;
        }

        /* ─── HERO ─────────────────────── */

        .hero {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            background: url('/images/download.jpeg') center/cover no-repeat;
            margin-bottom: 24px;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(10, 13, 26, 0.88) 0%,
                rgba(20, 26, 46, 0.72) 50%,
                rgba(10, 13, 26, 0.60) 100%
            );
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 32px 32px;
            z-index: 0;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .hero-inner {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                padding: 40px 48px;
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.16);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 5px 12px 5px 8px;
            border-radius: 99px;
            margin-bottom: 14px;
        }

        .hero-badge-dot {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.25);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { box-shadow: 0 0 0 3px rgba(16,185,129,0.25); }
            50%       { box-shadow: 0 0 0 6px rgba(16,185,129,0.10); }
        }

        .hero-badge span {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.8);
        }

        .hero-title {

            font-size: clamp(26px, 5vw, 44px);
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .hero-title em {
            font-style: italic;
            color: #fbbf24;
        }

        .hero-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,0.6);
            line-height: 1.6;
            max-width: 400px;
        }

        .hero-stats {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        @media (max-width: 767px) {
            .hero-stats { gap: 8px; }
        }

        .stat-pill {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.13);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 14px;
            padding: 14px 16px;
            min-width: 76px;
            transition: background 0.25s;
        }

        @media (min-width: 768px) {
            .stat-pill { padding: 18px 24px; min-width: 96px; }
        }

        .stat-pill:hover { background: rgba(255,255,255,0.13); }

        .stat-num {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }

        @media (min-width: 768px) {
            .stat-num { font-size: 34px; }
        }

        .stat-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
        }

        /* ─── FILTER BAR ───────────────── */

        .filter-bar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 12px 14px;
            margin-bottom: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05), 0 4px 16px rgba(0,0,0,0.03);
        }

        @media (min-width: 768px) {
            .filter-bar { padding: 18px 20px; }
        }

        .filter-mobile {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        @media (min-width: 768px) {
            .filter-mobile { display: none; }
        }

        .filter-desktop { display: none; }

        @media (min-width: 768px) {
            .filter-desktop {
                display: grid;
                grid-template-columns: 1fr 150px 150px auto;
                align-items: center;
                gap: 12px;
            }
        }

        .mobile-search-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chip-scroll-outer { position: relative; }

        .chip-scroll-outer::after {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0;
            width: 32px;
            background: linear-gradient(to right, transparent, #fff);
            pointer-events: none;
            z-index: 2;
        }

        .chip-scroll-row {
            display: flex;
            align-items: center;
            gap: 6px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding-bottom: 4px;
            padding-right: 32px;
        }

        .chip-scroll-row::-webkit-scrollbar { display: none; }

        .chip-track {
            position: relative;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            padding: 2px;
            background: #f1f2f4;
            border-radius: 99px;
        }

        .chip-slider {
            position: absolute;
            top: 2px;
            left: 2px;
            height: calc(100% - 4px);
            border-radius: 99px;
            background: #0c0f18;
            z-index: 0;
            pointer-events: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.20);
            transition:
                transform 0.38s cubic-bezier(0.34, 1.36, 0.64, 1),
                width     0.38s cubic-bezier(0.34, 1.36, 0.64, 1);
            will-change: transform, width;
        }

        .chip-track.track-trans .chip-slider {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            box-shadow: 0 2px 8px rgba(217,119,6,0.35);
        }

        .chip-divider {
            flex-shrink: 0;
            width: 1px;
            height: 20px;
            background: #e5e7eb;
            align-self: center;
            margin: 0 2px;
        }

        .filter-chip {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            height: 30px;
            padding: 0 13px;
            border-radius: 99px;
            border: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            cursor: pointer;
            white-space: nowrap;
            user-select: none;
            position: relative;
            z-index: 1;
            transition: color 0.25s ease;
            -webkit-tap-highlight-color: transparent;
            overflow: hidden;
        }

        .filter-chip i { font-size: 10px; color: inherit; opacity: 0.7; transition: opacity 0.25s; }
        .filter-chip.chip-active { color: #fff; font-weight: 600; }
        .filter-chip.chip-active i { opacity: 1; }

        .filter-chip::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.18);
            border-radius: 99px;
            opacity: 0;
            transform: scale(0);
            transition: transform 0.35s ease, opacity 0.35s ease;
        }

        .filter-chip:active::before { transform: scale(1); opacity: 1; transition: none; }

        .chip-clear {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            height: 30px;
            padding: 0 12px;
            border-radius: 99px;
            border: 1.5px solid #fca5a5;
            background: #fef2f2;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: #dc2626;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s ease;
            -webkit-tap-highlight-color: transparent;
            animation: chipFadeIn 0.3s cubic-bezier(0.34,1.56,0.64,1) both;
        }

        @keyframes chipFadeIn {
            from { opacity: 0; transform: scale(0.7); }
            to   { opacity: 1; transform: scale(1); }
        }

        .chip-clear:active { transform: scale(0.93); }

        .search-wrap { position: relative; height: 44px; flex: 1; }

        .search-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 13px;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            height: 100%;
            padding: 0 16px 0 40px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background: #fafafa;
            transition: all 0.25s ease;
        }

        .search-input::placeholder { color: #b0b6bf; }

        .search-input:focus {
            outline: none;
            border-color: var(--gold-lt);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(245,158,11,0.10);
        }

        .dd-wrap { position: relative; }

        .dd-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 44px;
            padding: 0 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            background: #fafafa;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #4b5563;
            cursor: pointer;
            transition: all 0.25s ease;
            user-select: none;
        }

        .dd-btn i {
            font-size: 11px;
            color: #c4c8d0;
            transition: transform 0.25s ease, color 0.25s ease;
            flex-shrink: 0;
            margin-left: 8px;
        }

        .dd-btn:hover, .dd-wrap.open .dd-btn { border-color: var(--gold-lt); background: #fffbf0; }
        .dd-wrap.open .dd-btn i { transform: rotate(180deg); color: var(--gold); }

        .dd-menu {
            position: absolute;
            top: calc(100% + 6px);
            left: 0; right: 0;
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 8px 28px rgba(0,0,0,0.12);
            z-index: 999;
            overflow: hidden;
            display: none;
        }

        .dd-wrap.open .dd-menu { display: block; animation: fadeSlide 0.18s ease; }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .dd-opt {
            padding: 10px 14px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            color: #374151;
            cursor: pointer;
            transition: all 0.15s;
            border-bottom: 1px solid #f3f4f6;
        }

        .dd-opt:last-child { border-bottom: none; }
        .dd-opt:hover { background: #f9fafb; color: var(--gold); padding-left: 18px; }
        .dd-opt.selected { background: #fffbf0; color: var(--gold); font-weight: 600; }

        .clear-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            height: 44px;
            padding: 0 16px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            background: #fafafa;
            color: #6b7280;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .clear-btn:hover { border-color: #fca5a5; background: #fef2f2; color: #dc2626; }

        /* ─── META ROW ──────────────────────
           Mobile: single compact pill
           Desktop: full two-column info
        ────────────────────────────────── */

        .meta-row {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        /* ── Mobile pill ── */
        .meta-pill-mobile {
            display: inline-flex;
            align-items: center;
            gap: 7px;


            padding: 2px 14px 2px 10px;

        }

        @media (min-width: 768px) {
            .meta-pill-mobile { display: none; }
        }


        .meta-pill-mobile .pill-icon i {
            font-size: 9px;
            color: #fff;
        }

        .meta-pill-mobile .pill-count {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
        }

        .meta-pill-mobile .pill-of {
            font-size: 12px;
            color: var(--muted);
        }

        .meta-pill-mobile .pill-dot {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: #d1d5db;
            flex-shrink: 0;
        }

        .meta-pill-mobile .pill-page {
            font-size: 12px;
            font-weight: 600;
            color: var(--gold);
        }

        /* ── Desktop full info ── */
        .meta-desktop {
            display: none;
        }

        @media (min-width: 768px) {
            .meta-desktop {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                flex-wrap: wrap;
                gap: 8px;
            }
        }

        .meta-count { font-size: 13px; color: var(--muted); }
        .meta-count strong { color: var(--text); font-weight: 700; }

        .meta-range { font-size: 13px; color: var(--muted); }
        .meta-range strong { color: var(--gold); font-weight: 700; }

        .sort-select { display: none; }

        @media (min-width: 768px) {
            .sort-select {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                color: var(--muted);
            }

            .sort-select select {
                border: 1.5px solid var(--border);
                border-radius: 8px;
                padding: 4px 10px;
                font-family: 'Poppins', sans-serif;
                font-size: 13px;
                color: var(--text);
                background: white;
                cursor: pointer;
                outline: none;
            }
        }

    </style>

    <main class="max-w-7xl mx-auto px-4 md:px-8 py-6 pt-24">

        {{-- ─── HERO ─────────────────────────── --}}
        <div class="hero mb-6">
            <div class="hero-inner">

                <div>
                    <div class="hero-badge">
                        <div class="hero-badge-dot"></div>
                        <span>Armada Siap Jalan</span>
                    </div>
                    <h1 class="hero-title">
                        Temukan Mobil<br>
                       Impian Anda
                    </h1>
                    <p class="hero-subtitle">
                        Lebih dari 50 unit premium pilihan, siap menemani setiap perjalanan Anda dengan nyaman dan aman.
                    </p>
                </div>

                <div class="hero-stats">
                    <div class="stat-pill">
                        <div class="stat-num">50<span style="font-size:18px;color:#fbbf24">+</span></div>
                        <div class="stat-label">Unit</div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-num">5</div>
                        <div class="stat-label">Rating</div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-num">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ─── FILTER BAR ─────────────────────── --}}
        <div class="filter-bar">
            <form method="GET" action="{{ route('cars.index') }}" id="filterForm">

                <input type="hidden" name="category"     id="inp_category"     value="{{ request('category','all') }}">
                <input type="hidden" name="transmission" id="inp_transmission" value="{{ request('transmission','') }}">

                {{-- MOBILE --}}
                <div class="filter-mobile">
                    <div class="mobile-search-row">
                        <div class="search-wrap">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" name="search" class="search-input"
                                   placeholder="Cari brand atau model..."
                                   value="{{ request('search', '') }}">
                        </div>
                    </div>

                    <div class="chip-scroll-outer">
                    <div class="chip-scroll-row" id="mobileChips">

                        @php
                            $cats = [
                                'all'                        => 'Semua',
                                'MPV (keluarga)'             => 'MPV',
                                'SUV (tangguh/medan berat)'  => 'SUV',
                                'Hatchback (kompak)'         => 'Hatchback',
                                'City Car (lincah di kota)'  => 'City Car',
                                'Sedan (nyaman)'             => 'Sedan',
                                'Crossover (kombinasi)'      => 'Crossover',
                            ];
                            $activeCat = request('category', 'all');
                        @endphp

                        <div class="chip-track track-cat" id="trackCat">
                            <div class="chip-slider" id="sliderCat"></div>
                            @foreach($cats as $val => $label)
                                <button type="button"
                                        class="filter-chip chip-category {{ $activeCat === $val ? 'chip-active' : '' }}"
                                        data-val="{{ $val }}">
                                    @if($val === 'all')<i class="fa-solid fa-border-all"></i>@endif
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>

                        <div class="chip-divider"></div>

                        @php
                            $trans = ['' => 'Semua', 'automatic' => 'Matic', 'manual' => 'Manual'];
                            $activeTrans = request('transmission', '');
                        @endphp

                        <div class="chip-track track-trans" id="trackTrans">
                            <div class="chip-slider" id="sliderTrans"></div>
                            @foreach($trans as $val => $label)
                                <button type="button"
                                        class="filter-chip chip-transmission {{ $activeTrans === $val ? 'chip-active' : '' }}"
                                        data-val="{{ $val }}">
                                    @if($val === 'automatic')<i class="fa-solid fa-robot"></i>
                                    @elseif($val === 'manual')<i class="fa-solid fa-hand"></i>
                                    @else<i class="fa-solid fa-sliders"></i>@endif
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>

                        @if(request('category','all') !== 'all' || request('transmission','') !== '' || request('search','') !== '')
                            <div class="chip-divider"></div>
                            <button type="button" class="chip-clear" id="mobileClearBtn">
                                <i class="fa-solid fa-xmark"></i> Reset
                            </button>
                        @endif

                    </div>
                    </div>
                </div>

                {{-- DESKTOP --}}
                <div class="filter-desktop">
                    <div class="search-wrap">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="search" class="search-input"
                               placeholder="Cari brand atau model..."
                               value="{{ request('search', '') }}">
                    </div>

                    <div class="dd-wrap" id="ddCategory">
                        <button type="button" class="dd-btn">
                            <span class="dd-label">{{ request('category','all') !== 'all' ? request('category') : 'Kategori' }}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="dd-menu">
                            <div class="dd-opt {{ request('category','all')=='all' ? 'selected' : '' }}" data-val="all" data-lbl="Kategori" data-inp="inp_category">Semua Kategori</div>
                            @foreach(['MPV (keluarga)','SUV (tangguh/medan berat)','Hatchback (kompak)','City Car (lincah di kota)','Sedan (nyaman)','Crossover (kombinasi)'] as $cat)
                                <div class="dd-opt {{ request('category','all')===$cat ? 'selected' : '' }}" data-val="{{ $cat }}" data-lbl="{{ $cat }}" data-inp="inp_category">{{ $cat }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="dd-wrap" id="ddTransmission">
                        <button type="button" class="dd-btn">
                            <span class="dd-label">{{ request('transmission','') !== '' ? (request('transmission')==='automatic' ? 'Matic' : 'Manual') : 'Transmisi' }}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="dd-menu">
                            <div class="dd-opt {{ request('transmission','')=='' ? 'selected' : '' }}" data-val="" data-lbl="Transmisi" data-inp="inp_transmission">Semua Transmisi</div>
                            <div class="dd-opt {{ request('transmission','')=='automatic' ? 'selected' : '' }}" data-val="automatic" data-lbl="Matic" data-inp="inp_transmission">Automatic (Matic)</div>
                            <div class="dd-opt {{ request('transmission','')=='manual' ? 'selected' : '' }}" data-val="manual" data-lbl="Manual" data-inp="inp_transmission">Manual</div>
                        </div>
                    </div>

                    <button type="button" class="clear-btn" id="desktopClearBtn">
                        <i class="fa-solid fa-xmark"></i> Bersihkan
                    </button>
                </div>

            </form>
        </div>

        {{-- ─── META ROW ─────────────────────── --}}
        @php
            $isPaginator = $cars instanceof \Illuminate\Pagination\LengthAwarePaginator;
            $totalItems  = $isPaginator ? $cars->total()     : $cars->count();
            $fromItem    = $isPaginator ? ($cars->firstItem() ?? 0) : 1;
            $toItem      = $isPaginator ? ($cars->lastItem()  ?? 0) : $cars->count();
        @endphp

        <div class="meta-row">

            {{-- Mobile: compact pill --}}
            <div class="meta-pill-mobile">

                <span class="pill-count">{{ $cars->count() }}</span>
                <span class="pill-of">dari {{ $totalItems }}</span>
                @if($isPaginator)
                    <span class="pill-dot"></span>
                    <span class="pill-page">Hal. {{ $cars->currentPage() }}/{{ $cars->lastPage() }}</span>
                @endif
            </div>

            {{-- Desktop: full info --}}
            <div class="meta-desktop">
                <div class="meta-count">
                    <strong>{{ $cars->count() }}</strong> dari <strong>{{ $totalItems }}</strong> armada ditemukan
                </div>
                @if($isPaginator)
                <div class="meta-range">
                    Halaman <strong>{{ $cars->currentPage() }}</strong> dari <strong>{{ $cars->lastPage() }}</strong>
                    &nbsp;·&nbsp; Menampilkan <strong>{{ $fromItem }}–{{ $toItem }}</strong>
                </div>
                @endif
            </div>

        </div>

        {{-- ─── CARS GRID ─────────────────────── --}}
        @include('cars.cars-list')

    </main>

    <script>
    (function () {
        var form = document.getElementById('filterForm');

        function initSlider(trackId, sliderId, chipClass, inputId) {
            var track  = document.getElementById(trackId);
            var slider = document.getElementById(sliderId);
            if (!track || !slider) return;

            var chips         = Array.from(track.querySelectorAll('.' + chipClass));
            var pendingSubmit = null;

            function moveSlider(chip, animate) {
                if (!chip) return;
                var left  = chip.offsetLeft - 2;
                var width = chip.offsetWidth;
                if (!animate) {
                    slider.style.transition = 'none';
                    slider.style.width      = width + 'px';
                    slider.style.transform  = 'translateX(' + left + 'px)';
                    void slider.offsetWidth;
                    slider.style.transition = '';
                } else {
                    slider.style.width     = width + 'px';
                    slider.style.transform = 'translateX(' + left + 'px)';
                }
            }

            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    var active = track.querySelector('.' + chipClass + '.chip-active');
                    if (active) moveSlider(active, false);
                });
            });

            chips.forEach(function (chip) {
                chip.addEventListener('click', function () {
                    if (pendingSubmit) clearTimeout(pendingSubmit);
                    chips.forEach(function (c) { c.classList.remove('chip-active'); });
                    chip.classList.add('chip-active');
                    moveSlider(chip, true);
                    chip.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    document.getElementById(inputId).value = chip.dataset.val;
                    pendingSubmit = setTimeout(function () { form.submit(); }, 380);
                });
            });

            window.addEventListener('resize', function () {
                var cur = track.querySelector('.' + chipClass + '.chip-active');
                if (cur) moveSlider(cur, false);
            });
        }

        initSlider('trackCat',   'sliderCat',   'chip-category',     'inp_category');
        initSlider('trackTrans', 'sliderTrans',  'chip-transmission', 'inp_transmission');

        var mobileClear = document.getElementById('mobileClearBtn');
        if (mobileClear) {
            mobileClear.addEventListener('click', function () {
                document.getElementById('inp_category').value     = 'all';
                document.getElementById('inp_transmission').value = '';
                document.querySelectorAll('.search-input').forEach(function(i){ i.value = ''; });
                form.submit();
            });
        }

        document.querySelectorAll('.dd-wrap').forEach(function (wrap) {
            var btn  = wrap.querySelector('.dd-btn');
            var lbl  = wrap.querySelector('.dd-label');
            var opts = wrap.querySelectorAll('.dd-opt');

            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                document.querySelectorAll('.dd-wrap.open').forEach(function (w) {
                    if (w !== wrap) w.classList.remove('open');
                });
                wrap.classList.toggle('open');
            });

            opts.forEach(function (opt) {
                opt.addEventListener('click', function () {
                    var inp = document.getElementById(opt.dataset.inp);
                    if (inp) inp.value = opt.dataset.val;
                    lbl.textContent = opt.dataset.lbl;
                    opts.forEach(function (o) { o.classList.remove('selected'); });
                    opt.classList.add('selected');
                    wrap.classList.remove('open');
                    form.submit();
                });
            });
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.dd-wrap')) {
                document.querySelectorAll('.dd-wrap.open').forEach(function (w) {
                    w.classList.remove('open');
                });
            }
        });

        var desktopClear = document.getElementById('desktopClearBtn');
        if (desktopClear) {
            desktopClear.addEventListener('click', function () {
                document.getElementById('inp_category').value     = 'all';
                document.getElementById('inp_transmission').value = '';
                document.querySelectorAll('.search-input').forEach(function(i){ i.value = ''; });
                form.submit();
            });
        }

        var st;
        document.querySelectorAll('.search-input').forEach(function (inp) {
            inp.addEventListener('input', function () {
                clearTimeout(st);
                st = setTimeout(function () { form.submit(); }, 500);
            });
        });

    })();
    </script>

</x-app-layout>
