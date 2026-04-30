<x-app-layout>
    <x-alert />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --orange: #F97316;
            --orange-dark: #EA580C;
            --orange-light: #FFF7ED;
            --dark: #111827;
            --gray: #6B7280;
            --light: #F9FAFB;
            --border: #E5E7EB;
            --white: #FFFFFF;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F3F4F6; color: var(--dark); }

        /* ── PAGE WRAPPER ── */
        .page-wrap { max-width: 1200px; margin: 0 auto; padding: 1.5rem 1rem 3rem; }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.8125rem; color: var(--gray); margin-bottom: 1.5rem;
            padding-top: 5rem;
        }
        .breadcrumb a { color: var(--gray); text-decoration: none; }
        .breadcrumb a:hover { color: var(--orange); }
        .breadcrumb .sep { opacity: 0.4; }
        .breadcrumb .current { color: var(--dark); font-weight: 600; }

        /* ── MAIN LAYOUT ── */
        .detail-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
            padding: 2rem;
        }
        @media (max-width: 900px) {
            .detail-layout { grid-template-columns: 1fr; padding: 1.25rem; }
        }

        /* ── LEFT: GALLERY ── */
        .gallery-col {}
        .main-image-wrap {
            position: relative;
            background: #F8FAFC;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            aspect-ratio: 4/3;
            display: flex; align-items: center; justify-content: center;
        }
        .main-image-wrap img {
            width: 100%; height: 100%; object-fit: contain;
            transition: transform 0.4s ease;
        }
        .main-image-wrap:hover img { transform: scale(1.04); }

        .expand-btn {
            position: absolute; bottom: 0.75rem; right: 0.75rem;
            width: 36px; height: 36px; background: rgba(0,0,0,0.5);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            color: white; cursor: pointer; border: none; font-size: 0.875rem;
        }
        .expand-btn:hover { background: rgba(0,0,0,0.75); }

        .status-badge-wrap {
            position: absolute; top: 0.75rem; left: 0.75rem;
        }
        .status-badge {
            display: inline-flex; align-items: center; gap: 0.375rem;
            padding: 0.375rem 0.875rem; border-radius: 999px;
            font-size: 0.75rem; font-weight: 700;
            background: #DCFCE7; color: #15803D;
        }
        .status-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: #22C55E; }

        .thumbs { display: flex; gap: 0.75rem; margin-top: 1rem; }
        .thumb-item {
            flex: 1; aspect-ratio: 4/3; border-radius: 10px; overflow: hidden;
            border: 2px solid var(--border); cursor: pointer; transition: all 0.25s;
        }
        .thumb-item img { width: 100%; height: 100%; object-fit: cover; }
        .thumb-item.active,
        .thumb-item:hover { border-color: var(--orange); }

        /* ── RIGHT: INFO ── */
        .info-col { display: flex; flex-direction: column; gap: 1.5rem; }

        .car-name { font-size: 2rem; font-weight: 800; color: var(--dark); line-height: 1.2; }

        /* ── SPECS GRID ── */
        .specs-label { font-size: 0.8125rem; font-weight: 700; color: var(--gray); text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 0.75rem; }
        .specs-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.875rem;
        }
        .spec-card {
            display: flex; align-items: center; gap: 0.75rem;
            background: var(--light); border: 1px solid var(--border);
            border-radius: 12px; padding: 0.875rem 1rem;
        }
        .spec-icon-wrap {
            width: 36px; height: 36px; border-radius: 8px;
            background: white; border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .spec-icon-wrap img { width: 20px; height: 20px; object-fit: contain; }
        .spec-icon-wrap i { font-size: 0.875rem; color: var(--orange); }
        .spec-detail {}
        .spec-detail .spec-lbl { font-size: 0.6875rem; color: var(--gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; }
        .spec-detail .spec-val { font-size: 0.9375rem; font-weight: 700; color: var(--dark); }

        /* ── TRUST BANNER ── */
        .trust-banner {
            display: flex; align-items: flex-start; gap: 0.875rem;
            background: #F0FDF4; border: 1px solid #BBF7D0;
            border-radius: 12px; padding: 1rem 1.125rem;
        }
        .trust-icon { font-size: 1.5rem; color: #16A34A; flex-shrink: 0; margin-top: 0.125rem; }
        .trust-text { font-size: 0.875rem; color: #166534; line-height: 1.6; }

        /* ── CTA BLOCK ── */
        .cta-block {}
        .cta-label { font-size: 0.9375rem; font-weight: 700; color: var(--dark); margin-bottom: 0.25rem; }
        .cta-sub { font-size: 0.875rem; color: var(--gray); margin-bottom: 1rem; line-height: 1.5; }

        .btn-cta {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.625rem;
            padding: 0.875rem 2rem; border-radius: 999px;
            background: var(--orange); color: white;
            font-size: 1rem; font-weight: 700; font-family: inherit;
            border: none; cursor: pointer; text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-cta:hover { background: var(--orange-dark); transform: translateY(-1px); }
        .btn-cta:active { transform: scale(0.98); }

        /* ── PRICE CARD (below main layout) ── */
        .price-section {
            margin-top: 1.5rem;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem 2rem;
        }
        .price-section-inner {
            display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;
        }
        @media (max-width: 700px) { .price-section-inner { grid-template-columns: 1fr; } .price-section { padding: 1.25rem; } }

        .price-section-title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        .price-section-title i { color: var(--orange); }

        .price-options { display: grid; grid-template-columns: 1fr 1fr; gap: 0.875rem; }
        .price-opt {
            border: 2px solid var(--border); border-radius: 12px; padding: 1rem;
            cursor: pointer; transition: all 0.2s; position: relative; overflow: hidden;
        }
        .price-opt:hover { border-color: var(--orange); }
        .price-opt.active { border-color: var(--orange); background: var(--orange-light); }
        .price-opt-label { font-size: 0.75rem; font-weight: 700; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; }
        .price-opt-value { font-size: 1.375rem; font-weight: 800; color: var(--dark); }
        .price-opt .best-tag {
            position: absolute; top: 0.5rem; right: 0.5rem;
            font-size: 0.625rem; font-weight: 800; padding: 0.2rem 0.5rem;
            background: var(--orange); color: white; border-radius: 4px; text-transform: uppercase;
        }

        /* ── RENTAL TYPE ── */
        .rental-types { display: grid; grid-template-columns: 1fr 1fr; gap: 0.875rem; }
        .rental-opt {
            border: 2px solid var(--border); border-radius: 12px; padding: 1rem;
            cursor: pointer; transition: all 0.2s; display: flex; flex-direction: column; gap: 0.375rem;
        }
        .rental-opt:hover { border-color: var(--orange); }
        .rental-opt.active { border-color: var(--orange); background: var(--orange-light); }
        .rental-opt-icon { font-size: 1.25rem; color: var(--orange); }
        .rental-opt-title { font-size: 0.875rem; font-weight: 700; color: var(--dark); }
        .rental-opt-desc { font-size: 0.75rem; color: var(--gray); line-height: 1.4; }

        /* ── AVAILABILITY CALENDAR ── */
        .avail-section { margin-top: 1.5rem; }

        .calendar-wrap {
            background: white; border: 1px solid var(--border);
            border-radius: 16px; padding: 1.5rem 2rem;
        }

        .cal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .cal-month-title { font-size: 1rem; font-weight: 700; color: var(--dark); }
        .cal-nav-btn {
            width: 34px; height: 34px; border: 1px solid var(--border); border-radius: 8px;
            background: white; cursor: pointer; font-size: 0.8125rem; color: var(--dark);
            display: flex; align-items: center; justify-content: center; transition: all 0.2s;
        }
        .cal-nav-btn:hover { background: var(--orange); color: white; border-color: var(--orange); }

        .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; }
        .cal-day-hdr { text-align: center; font-size: 0.6875rem; font-weight: 700; color: var(--gray); padding: 0.5rem 0; text-transform: uppercase; }
        .cal-day {
            aspect-ratio: 1; display: flex; align-items: center; justify-content: center;
            font-size: 0.875rem; font-weight: 500; border-radius: 8px; cursor: pointer;
            border: 1.5px solid transparent; transition: all 0.2s;
        }
        .cal-day.available:hover { background: var(--orange); color: white; }
        .cal-day.booked { background: #FEE2E2; color: #DC2626; cursor: not-allowed; font-weight: 700; border-color: #FCA5A5; }
        .cal-day.selected-start, .cal-day.selected-end { background: #16A34A; color: white; transform: scale(1.08); }
        .cal-day.selected-range { background: #DCFCE7; color: #166534; border-color: #86EFAC; }
        .cal-day.today { border-color: #3B82F6; }
        .cal-day.past { color: #D1D5DB; cursor: not-allowed; }
        .cal-day.empty { cursor: default; }

        .cal-legend { display: flex; gap: 1.25rem; margin-top: 1rem; flex-wrap: wrap; }
        .legend-item { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem; color: var(--gray); font-weight: 500; }
        .legend-dot { width: 14px; height: 14px; border-radius: 4px; }

        /* ── DATE INPUTS ── */
        .date-inputs { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem; }
        .date-field label { display: block; font-size: 0.75rem; font-weight: 700; color: var(--dark); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.375rem; }
        .date-field input {
            width: 100%; padding: 0.75rem 0.875rem;
            border: 1.5px solid var(--border); border-radius: 10px;
            font-family: inherit; font-size: 0.875rem; color: var(--dark);
            background: var(--light); transition: border-color 0.2s;
        }
        .date-field input:focus { outline: none; border-color: var(--orange); background: white; box-shadow: 0 0 0 3px rgba(249,115,22,0.1); }

        .btn-check {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 1.5rem; border-radius: 10px;
            background: var(--orange); color: white;
            font-size: 0.875rem; font-weight: 700; font-family: inherit;
            border: none; cursor: pointer; transition: all 0.2s;
        }
        .btn-check:hover { background: var(--orange-dark); transform: translateY(-1px); }

        /* ── PRICE ESTIMATE ── */
        .price-estimate {
            background: #F0FDF4; border: 1.5px solid #86EFAC; border-radius: 12px;
            padding: 1.25rem; margin-top: 1rem; display: none;
        }
        .price-estimate.show { display: block; animation: fadeInUp 0.3s ease; }
        @keyframes fadeInUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .pe-header { display: flex; justify-content: space-between; align-items: center; font-weight: 700; font-size: 0.9375rem; color: #15803D; margin-bottom: 0.875rem; }
        .pe-row { display: flex; justify-content: space-between; font-size: 0.875rem; color: #166534; padding: 0.25rem 0; }
        .pe-row.total { border-top: 1.5px solid #86EFAC; margin-top: 0.5rem; padding-top: 0.75rem; font-weight: 800; font-size: 1rem; color: #15803D; }
        .pe-deposit { font-size: 0.75rem; color: #16A34A; margin-top: 0.375rem; }

        .btn-book {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            width: 100%; padding: 0.875rem; border-radius: 10px;
            background: #16A34A; color: white; font-size: 0.9375rem;
            font-weight: 700; font-family: inherit; border: none; cursor: pointer;
            text-decoration: none; margin-top: 0.875rem; transition: all 0.2s;
        }
        .btn-book:hover { background: #15803D; transform: translateY(-1px); }

        /* ── RELATED ── */
        .related-section { margin-top: 2rem; }
        .section-heading { font-size: 1.25rem; font-weight: 800; color: var(--dark); margin-bottom: 1.25rem; }
        .related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        @media (max-width: 768px) { .related-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 480px) { .related-grid { grid-template-columns: 1fr; } }

        .related-card {
            background: white; border: 1px solid var(--border); border-radius: 14px;
            overflow: hidden; transition: all 0.25s;
        }
        .related-card:hover { transform: translateY(-6px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); border-color: var(--orange); }
        .related-img { height: 160px; overflow: hidden; }
        .related-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
        .related-card:hover .related-img img { transform: scale(1.08); }
        .related-body { padding: 1rem; }
        .related-brand { font-size: 0.875rem; font-weight: 700; color: var(--dark); }
        .related-name { font-size: 0.8125rem; color: var(--orange); font-weight: 600; margin-bottom: 0.75rem; }
        .related-footer { display: flex; justify-content: space-between; align-items: center; }
        .related-price-val { font-size: 0.9375rem; font-weight: 800; color: var(--dark); }
        .related-price-lbl { font-size: 0.6875rem; color: var(--gray); }
        .btn-view {
            display: inline-flex; align-items: center; gap: 0.375rem;
            padding: 0.5rem 0.875rem; border-radius: 8px;
            background: var(--orange-light); color: var(--orange-dark);
            font-size: 0.8125rem; font-weight: 700; text-decoration: none;
            border: 1px solid #FED7AA; transition: all 0.2s;
        }
        .btn-view:hover { background: var(--orange); color: white; border-color: var(--orange); }

        /* ── TOOLTIP ── */
        .booking-tooltip {
            position: fixed; background: #111827; color: white;
            padding: 0.875rem; border-radius: 10px; font-size: 0.8125rem; z-index: 1000;
            min-width: 190px; pointer-events: none; opacity: 0; transition: opacity 0.2s;
        }
        .booking-tooltip.show { opacity: 1; }
        .tip-title { font-weight: 700; color: var(--orange); font-size: 0.75rem; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .tip-row { display: flex; gap: 0.5rem; font-size: 0.75rem; margin-bottom: 0.25rem; }
        .tip-lbl { color: rgba(255,255,255,0.6); min-width: 55px; }

        /* ── SPINNER ── */
        .spinner { border: 2px solid rgba(255,255,255,0.3); border-top-color: white; border-radius: 50%; width: 16px; height: 16px; animation: spin 0.6s linear infinite; display: inline-block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── REVIEWS ── */
        .reviews-section { margin-top: 2rem; }
        .review-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; margin-top: 1.25rem; }
        .review-card { background: white; border: 1px solid var(--border); border-radius: 14px; padding: 1.125rem; }
        .review-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem; }
        .reviewer { display: flex; align-items: center; gap: 0.75rem; }
        .reviewer-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--orange-light); display: flex; align-items: center; justify-content: center; }
        .reviewer-avatar i { color: var(--orange-dark); font-size: 0.875rem; }
        .reviewer-name { font-size: 0.875rem; font-weight: 700; color: var(--dark); }
        .reviewer-time { font-size: 0.75rem; color: var(--gray); }
        .review-rating { font-size: 0.875rem; font-weight: 700; color: var(--orange); }
        .review-text { font-size: 0.875rem; color: var(--gray); line-height: 1.6; }

        /* ── LEAVE MODAL ── */
        #leaveModal { position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.55);opacity:0;pointer-events:none;transition:opacity 0.3s; }
        #leaveModalBox { background:white;border-radius:20px;padding:1.75rem;max-width:360px;width:90%;text-align:center;transform:scale(0.9);transition:transform 0.3s; }

        /* ── MOBILE FLOAT ── */
        .mobile-float {
            display: none; position: fixed; bottom: 0; left: 0; right: 0;
            background: rgba(255,255,255,0.97); backdrop-filter: blur(16px);
            border-top: 1px solid var(--border); padding: 0.875rem 1rem;
            z-index: 700; box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
        }
        .mf-inner { display: flex; align-items: center; gap: 0.875rem; max-width: 480px; margin: 0 auto; }
        .mf-price-block { flex: 1; }
        .mf-from { font-size: 0.6875rem; color: var(--gray); }
        .mf-amount { font-size: 1.125rem; font-weight: 800; color: var(--dark); }
        .mf-per { font-size: 0.6875rem; color: var(--gray); }
        .mf-btn {
            flex-shrink: 0; background: var(--orange); color: white;
            font-weight: 800; font-size: 0.9375rem; border: none;
            padding: 0.875rem 1.5rem; border-radius: 14px; cursor: pointer;
            font-family: inherit; transition: all 0.2s;
        }
        .mf-btn:active { transform: scale(0.96); }

        @media (max-width: 1023px) {
            .price-section { display: none; }
            .mobile-float { display: block; }
            .page-wrap { padding-bottom: 5.5rem; }
        }
        @media (max-width: 600px) {
            .specs-grid { grid-template-columns: repeat(2, 1fr); }
            .car-name { font-size: 1.5rem; }
        }
    </style>

    {{-- LEAVE MODAL - REMOVED (not needed without bookings) --}}

    <div class="booking-tooltip" id="bookingTooltip"></div>

    {{-- MOBILE FLOAT BAR --}}
    <div class="mobile-float">
        <div class="mf-inner">
            <div class="mf-price-block">
                <div class="mf-from">Mulai dari</div>
                <div class="mf-amount">Rp {{ number_format($car->price_24h,0,',','.') }}</div>
                <div class="mf-per">/ 24 jam</div>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo Squad Trans! Saya tertarik dengan {{ urlencode($car->brand.' '.$car->name) }}. Tolong info detail harga dan ketersediaan kendaraan ini." class="mf-btn">
                <i class="fa-brands fa-whatsapp"></i> Pesan
            </a>
        </div>
    </div>

    {{-- PAGE --}}
    <div class="page-wrap">

        {{-- Breadcrumb --}}
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i> Home</a>
            <span class="sep"> / </span>
            <a href="{{ route('dashboard') }}">Kendaraan</a>
            <span class="sep"> / </span>
            <span class="current">{{ $car->brand }} {{ $car->name }}</span>
        </div>

        {{-- MAIN DETAIL CARD --}}
        <div class="detail-layout">

            {{-- LEFT: Gallery --}}
            <div class="gallery-col">
                <div class="main-image-wrap" id="mainImageWrap">
                    @if ($car->images->first())
                        <img src="{{ asset('storage/'.$car->images->first()->image_path) }}" alt="{{ $car->name }}" id="mainImg">
                    @else
                        <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#9CA3AF;flex-direction:column;gap:0.5rem;">
                            <i class="fa-solid fa-bus" style="font-size:3rem;"></i>
                        </div>
                    @endif
                    @if ($car->status == 'available')
                        <div class="status-badge-wrap">
                            <span class="status-badge"><span class="dot"></span> Tersedia</span>
                        </div>
                    @endif
                    <button class="expand-btn" onclick="expandImage()">
                        <i class="fa-solid fa-expand"></i>
                    </button>
                </div>

                @if ($car->images->count() > 1)
                    <div class="thumbs">
                        @foreach ($car->images->take(5) as $i => $image)
                            <div class="thumb-item {{ $i===0?'active':'' }}"
                                 onclick="changeImg('{{ asset('storage/'.$image->image_path) }}',this)">
                                <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $car->name }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- RIGHT: Info --}}
            <div class="info-col">

                <div>
                    <h1 class="car-name">{{ $car->brand }} {{ $car->name }}</h1>
                    @if ($averageRating > 0)
                        <div style="display:flex;align-items:center;gap:0.375rem;margin-top:0.5rem;">
                            @for ($s=1;$s<=5;$s++)
                                <i class="fa-solid fa-star" style="color:{{ $s<=$averageRating ? '#FBBF24' : '#E5E7EB' }};font-size:0.875rem;"></i>
                            @endfor
                            <span style="font-size:0.875rem;font-weight:700;color:var(--dark);margin-left:0.25rem;">{{ number_format($averageRating,1) }}</span>
                        </div>
                    @endif
                </div>

                {{-- Specifications --}}
                <div>
                    <div class="specs-label">Spesifikasi :</div>
                    <div class="specs-grid">
                        <div class="spec-card">
                            <div class="spec-icon-wrap"><i class="fa-solid fa-chair"></i></div>
                            <div class="spec-detail">
                                <div class="spec-lbl">Tempat Duduk</div>
                                <div class="spec-val">{{ $car->seats }}</div>
                            </div>
                        </div>
                        <div class="spec-card">
                            <div class="spec-icon-wrap"><i class="fa-solid fa-suitcase-rolling"></i></div>
                            <div class="spec-detail">
                                <div class="spec-lbl">Bagasi</div>
                                <div class="spec-val">{{ $car->baggage ?? '4' }}</div>
                            </div>
                        </div>
                        <div class="spec-card">
                            <div class="spec-icon-wrap"><i class="fa-solid fa-gears"></i></div>
                            <div class="spec-detail">
                                <div class="spec-lbl">Transmisi</div>
                                <div class="spec-val">{{ ucfirst($car->transmission) }}</div>
                            </div>
                        </div>
                        <div class="spec-card">
                            <div class="spec-icon-wrap"><i class="fa-solid fa-gas-pump"></i></div>
                            <div class="spec-detail">
                                <div class="spec-lbl">Bahan Bakar</div>
                                <div class="spec-val">{{ $car->fuel_type }}</div>
                            </div>
                        </div>
                        <div class="spec-card">
                            <div class="spec-icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
                            <div class="spec-detail">
                                <div class="spec-lbl">Asuransi Kendaraan</div>
                                <div class="spec-val">Ya</div>
                            </div>
                        </div>
                        <div class="spec-card">
                            <div class="spec-icon-wrap"><i class="fa-solid fa-user-tie"></i></div>
                            <div class="spec-detail">
                                <div class="spec-lbl">Pengemudi</div>
                                <div class="spec-val">Ya</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Trust Banner --}}
                <div class="trust-banner">
                    <div class="trust-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <div class="trust-text">Kendaraan dan pengemudi sudah di verifikasi serta mengikuti protokol kesehatan untuk kebersihan unit dan swab berkala.</div>
                </div>

                {{-- CTA --}}
                <div class="cta-block">
                    <div style="text-align:center;padding:1.5rem;background:linear-gradient(135deg,#fbbf24 0%,#f59e0b 100%);border-radius:16px;color:white;">
                        <div style="font-size:1.25rem;font-weight:800;margin-bottom:0.5rem;">Pesan Sekarang</div>
                        <div style="font-size:0.9375rem;margin-bottom:1.25rem;opacity:0.95;">Hubungi kami via WhatsApp untuk pemesanan & info detail harga</div>
                        <a href="https://wa.me/6281234567890?text=Halo Squad Trans! Saya tertarik dengan {{ urlencode($car->brand.' '.$car->name) }}. Tolong info detail harga dan ketersediaan kendaraan ini."
                           class="btn-cta" style="width:fit-content;margin:0 auto;background:white;color:var(--orange);font-weight:800;display:inline-flex;">
                            <i class="fa-brands fa-whatsapp" style="font-size:1.125rem;"></i> Chat WhatsApp
                        </a>
                    </div>

                    <div style="margin-top:1.25rem;padding:1rem;background:#fef9e7;border-left:4px solid var(--orange);border-radius:8px;">
                        <div style="font-size:0.875rem;color:var(--dark);line-height:1.6;">
                            <strong>💰 Harga Mulai dari:</strong><br>
                            Rp {{ number_format($car->price_24h,0,',','.') }} / 24 jam<br>
                            <span style="font-size:0.8rem;color:var(--gray);">Paket hemat tersedia untuk booking jangka panjang</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- RELATED --}}
        @if ($relatedCars->count() > 0)
            <div class="related-section">
                <h2 class="section-heading">Rekomendasi Kendaraan</h2>
                <div class="related-grid">
                    @foreach ($relatedCars as $rc)
                        <div class="related-card">
                            <div class="related-img">
                                @if ($rc->images->first())
                                    <img src="{{ asset('storage/'.$rc->images->first()->image_path) }}" alt="{{ $rc->name }}">
                                @else
                                    <div style="display:flex;align-items:center;justify-content:center;height:100%;background:#F3F4F6;"><i class="fa-solid fa-car" style="font-size:2rem;color:#9CA3AF;"></i></div>
                                @endif
                            </div>
                            <div class="related-body">
                                <div class="related-brand">{{ $rc->brand }}</div>
                                <div class="related-name">{{ $rc->name }}</div>
                                <div class="related-footer">
                                    <div>
                                        <div class="related-price-lbl">24 Jam</div>
                                        <div class="related-price-val">Rp {{ number_format($rc->price_24h/1000,0) }}K</div>
                                    </div>
                                    <a href="{{ route('cars.show', $rc) }}" class="btn-view">Lihat <i class="fa-solid fa-arrow-right" style="font-size:0.75rem;"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    {{-- REVIEWS --}}
    @if (isset($carReviews) && $carReviews->count() > 0)
        <div style="background:white;border-top:1px solid var(--border);padding:2rem 1rem;">
            <div style="max-width:1200px;margin:0 auto;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <h3 style="font-size:1.125rem;font-weight:800;color:var(--dark);">Ulasan Pelanggan</h3>
                    <a href="{{ route('reviews.create') }}" style="color:var(--orange);font-weight:600;font-size:0.875rem;text-decoration:none;">+ Tulis Ulasan</a>
                </div>
                <div class="review-grid">
                    @foreach ($carReviews as $review)
                        <div class="review-card">
                            @if ($review->image_path)
                                <img src="{{ asset('storage/'.$review->image_path) }}" style="width:100%;height:9rem;object-fit:cover;border-radius:8px;margin-bottom:0.75rem;" alt="Review">
                            @endif
                            <div class="review-top">
                                <div class="reviewer">
                                    <div class="reviewer-avatar"><i class="fa-solid fa-user"></i></div>
                                    <div>
                                        <div class="reviewer-name">{{ $review->booking->user->name ?? 'Pelanggan' }}</div>
                                        <div class="reviewer-time">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="review-rating">{{ $review->rating }}/5 <i class="fa-solid fa-star" style="font-size:0.75rem;"></i></div>
                            </div>
                            <div class="review-text">{{ $review->comment ?? 'Pelanggan puas.' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <script>
        // Gallery functions
        function changeImg(src, thumb) {
            document.getElementById('mainImg').src = src;
            document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        }

        function expandImage() {
            const src = document.getElementById('mainImg').src;
            const w = window.open('', '_blank');
            w.document.write(`<body style="margin:0;background:#000;display:flex;align-items:center;justify-content:center;min-height:100vh;">
                <img src="${src}" style="max-width:100%;max-height:100vh;object-fit:contain;">
                <style>body{font-family:system-ui;}</style>
            </body>`);
        }
    </script>

</x-app-layout>
