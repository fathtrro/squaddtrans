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

    {{-- LEAVE MODAL --}}
    <div id="leaveModal">
        <div id="leaveModalBox">
            <div style="width:56px;height:56px;background:#FFF7ED;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="fa-solid fa-arrow-right-from-bracket" style="color:#EA580C;font-size:1.375rem;"></i>
            </div>
            <h4 style="font-size:1rem;font-weight:800;margin-bottom:0.5rem;">Tinggalkan halaman?</h4>
            <p style="font-size:0.875rem;color:var(--gray);margin-bottom:1.5rem;">Pilihan tanggal kamu belum disimpan.</p>
            <div style="display:flex;gap:0.75rem;">
                <button id="leaveCancelBtn" style="flex:1;padding:0.75rem;border-radius:10px;border:1.5px solid var(--border);background:white;font-weight:600;font-size:0.875rem;cursor:pointer;font-family:inherit;">Batal</button>
                <button id="leaveConfirmBtn" style="flex:1;padding:0.75rem;border-radius:10px;border:none;background:var(--orange);color:white;font-weight:700;font-size:0.875rem;cursor:pointer;font-family:inherit;">Tinggalkan</button>
            </div>
        </div>
    </div>

    <div class="booking-tooltip" id="bookingTooltip"></div>

    {{-- MOBILE SHEET OVERLAY --}}
    <div id="mobileSheetOverlay" onclick="closeMobileSheet()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);z-index:800;"></div>

    {{-- MOBILE BOTTOM SHEET --}}
    <div id="mobileSheet" style="position:fixed;bottom:0;left:0;right:0;z-index:900;background:white;border-radius:24px 24px 0 0;max-height:90vh;overflow-y:auto;transform:translateY(100%);transition:transform 0.4s cubic-bezier(0.32,0.72,0,1);box-shadow:0 -8px 40px rgba(0,0,0,0.15);">
        <div style="display:flex;justify-content:center;padding:12px 0 4px;position:sticky;top:0;background:white;border-radius:24px 24px 0 0;z-index:10;">
            <div style="width:40px;height:4px;background:#E5E7EB;border-radius:2px;"></div>
        </div>
        <div style="padding:0 1.25rem 2.5rem;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.875rem;margin-bottom:1.25rem;">
                <div class="rental-opt active" data-type="lepas_kunci" onclick="selectRentalType('lepas_kunci')">
                    <div class="rental-opt-icon"><i class="fa-solid fa-key"></i></div>
                    <div class="rental-opt-title">Lepas Kunci</div>
                    <div class="rental-opt-desc">Sewa tanpa sopir.</div>
                </div>
                <div class="rental-opt" data-type="carter" onclick="selectRentalType('carter')">
                    <div class="rental-opt-icon"><i class="fa-solid fa-user-tie"></i></div>
                    <div class="rental-opt-title">Carter</div>
                    <div class="rental-opt-desc">Dengan sopir profesional.</div>
                </div>
            </div>

            <div id="mobileAvailSection">
                <div style="font-size:0.875rem;font-weight:700;color:var(--dark);margin-bottom:0.875rem;display:flex;align-items:center;gap:0.5rem;"><i class="fa-solid fa-calendar-check" style="color:var(--orange);"></i> Check Availability</div>
                <div class="date-inputs" id="mobileInputs24">
                    <div class="date-field"><label>Start Date</label><input type="date" id="startDate" min="{{ date('Y-m-d') }}"></div>
                    <div class="date-field"><label>End Date</label><input type="date" id="endDate" min="{{ date('Y-m-d') }}"></div>
                </div>
                <div style="display:none;gap:0.75rem;margin-bottom:1rem;" id="mobileInputs12">
                    <div class="date-field"><label>Date</label><input type="date" id="startDate12" min="{{ date('Y-m-d') }}"></div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                        <div class="date-field"><label>Start Time</label><input type="time" id="startTime" value="09:00"></div>
                        <div class="date-field"><label>End Time</label><input type="time" id="endTime" value="21:00" readonly style="opacity:0.5;cursor:not-allowed;"></div>
                    </div>
                </div>
                <div class="cal-header">
                    <button class="cal-nav-btn" id="prevMonth"><i class="fa-solid fa-chevron-left"></i></button>
                    <div class="cal-month-title" id="currentMonth"></div>
                    <button class="cal-nav-btn" id="nextMonth"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
                <div class="cal-grid" style="margin-bottom:0.5rem;">
                    <div class="cal-day-hdr">Sun</div><div class="cal-day-hdr">Mon</div>
                    <div class="cal-day-hdr">Tue</div><div class="cal-day-hdr">Wed</div>
                    <div class="cal-day-hdr">Thu</div><div class="cal-day-hdr">Fri</div>
                    <div class="cal-day-hdr">Sat</div>
                </div>
                <div class="cal-grid" id="calendarGrid"></div>
                <div class="cal-legend" style="margin-bottom:1rem;">
                    <div class="legend-item"><div class="legend-dot" style="background:#F3F4F6;border:1px solid var(--border);"></div> Tersedia</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#FEE2E2;"></div> Booked</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#DCFCE7;"></div> Dipilih</div>
                </div>
                <button class="btn-check" id="checkAvailability" style="width:100%;justify-content:center;">
                    <i class="fa-solid fa-search"></i> Check Availability
                </button>
                <div class="price-estimate" id="priceEstimateBox">
                    <div class="pe-header"><span><i class="fa-solid fa-check-circle"></i> Tersedia!</span><span id="rentalDuration"></span></div>
                    <div class="pe-row"><span>Base Price:</span><span id="basePrice">Rp 0</span></div>
                    <div class="pe-row"><span>Service:</span><span id="serviceCharge">Rp 0</span></div>
                    <div class="pe-row total"><span>Total:</span><span id="totalPrice">Rp 0</span></div>
                    <div class="pe-deposit">Min. DP: <span id="minDeposit">Rp 0</span></div>
                    <a href="{{ route('bookings.select-dates') }}" id="bookNowBtn" class="btn-book">
                        <i class="fa-solid fa-calendar-check"></i> Book Now
                    </a>
                </div>
            </div>

            <a href="#" id="whatsappBtn" style="display:none;align-items:center;justify-content:center;gap:0.5rem;padding:0.875rem;border-radius:10px;background:#25D366;color:white;font-weight:700;font-size:0.9375rem;text-decoration:none;margin-top:1rem;">
                <i class="fa-brands fa-whatsapp"></i> Order via WhatsApp
            </a>
            <a href="https://wa.me/6281234567890?text=Hi, I'm interested in {{ $car->brand }} {{ $car->name }}" style="display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.875rem;border-radius:10px;border:1.5px solid var(--border);color:var(--dark);font-weight:600;font-size:0.9375rem;text-decoration:none;margin-top:0.875rem;">
                <i class="fa-brands fa-whatsapp" style="color:#25D366;"></i> Hubungi Kami
            </a>
        </div>
    </div>

    {{-- MOBILE FLOAT BAR --}}
    <div class="mobile-float">
        <div class="mf-inner">
            <div class="mf-price-block">
                <div class="mf-from">Mulai dari</div>
                <div class="mf-amount">Rp {{ number_format($car->price_24h,0,',','.') }}</div>
                <div class="mf-per">/ 24 jam</div>
            </div>
            <button class="mf-btn" id="mobileOpenSheet">
                <i class="fa-solid fa-calendar-check"></i> Pesan Sekarang
            </button>
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
                    <div class="cta-label">Ingin Menggunakan Unit Ini?</div>
                    <div class="cta-sub">Hubungi kami sekarang juga untuk mendapatkan informasi lebih lanjut dan detail ketersediaan kendaraan ini.</div>
                    <a href="https://wa.me/6281234567890?text=Hi, saya tertarik dengan {{ $car->brand }} {{ $car->name }}"
                       class="btn-cta" style="width:fit-content;">
                        Hubungi Kami
                    </a>
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
        const carId   = {{ $car->id }};
        const csrf    = document.querySelector('meta[name="csrf-token"]').content;
        const carName = "{{ $car->brand }} {{ $car->name }}";
        const MONTHS  = ["January","February","March","April","May","June","July","August","September","October","November","December"];

        let bookedDates = @json(
            $car->bookings->map(function ($b) {
                $dates = [];
                $start = \Carbon\Carbon::parse($b->start_datetime);
                $end   = \Carbon\Carbon::parse($b->end_datetime);
                while ($start <= $end) { $dates[] = $start->format('Y-m-d'); $start->addDay(); }
                return $dates;
            })->flatten()->unique()->values()
        );

        let bookingDetailsMap = {};
        let selectedStartDate = null;
        let selectedEndDate   = null;
        let currentDurationMode = '24';
        let mainCalDate    = new Date();
        let desktopCalDate = new Date();

        function pad2(n){ return String(n).padStart(2,'0'); }
        function formatRp(n){ return 'Rp '+new Intl.NumberFormat('id-ID').format(n); }
        function fmtDate(s){ const[y,m,d]=s.split('-'); return `${parseInt(d)} ${MONTHS[parseInt(m)-1]}`; }

        function calcEndDT(d,t){
            const[y,mo,dy]=d.split('-').map(Number);
            const[h,mi]=t.split(':').map(Number);
            const dt=new Date(y,mo-1,dy,h,mi);
            dt.setTime(dt.getTime()+12*3600000);
            return{date:`${dt.getFullYear()}-${pad2(dt.getMonth()+1)}-${pad2(dt.getDate())}`,time:`${pad2(dt.getHours())}:${pad2(dt.getMinutes())}`};
        }

        function getConflicts(s,e){
            const out=[]; let cur=new Date(s);
            while(cur<=new Date(e)){
                const st=`${cur.getFullYear()}-${pad2(cur.getMonth()+1)}-${pad2(cur.getDate())}`;
                if(bookedDates.includes(st)) out.push(st);
                cur.setDate(cur.getDate()+1);
            }
            return out;
        }

        function selectPrice(el,dur,price){
            currentDurationMode=dur;
            document.querySelectorAll('.price-opt').forEach(o=>o.classList.remove('active'));
            el.classList.add('active');
            const show12=dur==='12';
            ['mobileInputs24','desktopInputs24'].forEach(id=>{ const e=document.getElementById(id); if(e) e.style.display=show12?'none':'grid'; });
            ['mobileInputs12','desktopInputs12'].forEach(id=>{ const e=document.getElementById(id); if(e) e.style.display=show12?'block':'none'; });
            ['priceEstimateBox','priceEstimateBoxDesktop'].forEach(id=>{ const e=document.getElementById(id); if(e) e.classList.remove('show'); });
            renderCalendar('mobile'); renderCalendar('desktop');
        }

        function selectRentalType(type){
            document.querySelectorAll('.rental-opt').forEach(c=>c.classList.remove('active'));
            document.querySelectorAll(`.rental-opt[data-type="${type}"]`).forEach(c=>c.classList.add('active'));
            const isCarter = type==='carter';
            const mobileAvail=document.getElementById('mobileAvailSection');
            const desktopAvail=document.getElementById('desktopAvailSection');
            const desktopWA=document.getElementById('desktopWASection');
            const wa=document.getElementById('whatsappBtn');
            const waD=document.getElementById('whatsappBtnDesktop');
            if(isCarter){
                if(mobileAvail) mobileAvail.style.display='none';
                if(desktopAvail) desktopAvail.style.display='none';
                if(desktopWA) desktopWA.style.display='block';
                if(wa){ wa.style.display='flex'; wa.href=`https://wa.me/6281234567890?text=${encodeURIComponent('Halo, saya ingin carter '+carName)}`; }
                if(waD) waD.href=`https://wa.me/6281234567890?text=${encodeURIComponent('Halo, saya ingin carter '+carName)}`;
            } else {
                if(mobileAvail) mobileAvail.style.display='block';
                if(desktopAvail) desktopAvail.style.display='block';
                if(desktopWA) desktopWA.style.display='none';
                if(wa) wa.style.display='none';
            }
        }

        function syncInputs(){
            if(currentDurationMode==='24'){
                ['startDate','startDateDesktop'].forEach(id=>{ const e=document.getElementById(id); if(e) e.value=selectedStartDate||''; });
                ['endDate','endDateDesktop'].forEach(id=>{ const e=document.getElementById(id); if(e) e.value=selectedEndDate||''; });
            } else {
                ['startDate12','startDate12Desktop'].forEach(id=>{ const e=document.getElementById(id); if(e) e.value=selectedStartDate||''; });
            }
            renderCalendar('mobile'); renderCalendar('desktop');
        }

        function selectDate(str){
            if(currentDurationMode==='12'){
                selectedStartDate=str; selectedEndDate=str;
            } else {
                if(!selectedStartDate||(selectedStartDate&&selectedEndDate)){
                    selectedStartDate=str; selectedEndDate=null;
                } else {
                    let s=selectedStartDate,e=str;
                    if(str<s){s=str;e=selectedStartDate;}
                    else if(str===s){selectedStartDate=null;selectedEndDate=null;syncInputs();return;}
                    const c=getConflicts(s,e);
                    if(c.length){alert('Tanggal '+c.map(fmtDate).join(', ')+' sudah dibooking.');selectedStartDate=null;selectedEndDate=null;syncInputs();return;}
                    selectedStartDate=s;selectedEndDate=e;
                }
            }
            syncInputs();
        }

        async function loadBookingDetails(y,m){
            try{
                const r=await fetch(`/api/cars/${carId}/booked-dates?year=${y}&month=${m}`);
                const d=await r.json();
                if(d.booked_dates) bookedDates=d.booked_dates;
                if(d.booking_details) bookingDetailsMap=d.booking_details;
            }catch(e){console.error(e);}
        }

        async function renderCalendar(which){
            const isMobile=which==='mobile';
            const ref=isMobile?mainCalDate:desktopCalDate;
            const gridId=isMobile?'calendarGrid':'calendarGridDesktop';
            const monthId=isMobile?'currentMonth':'currentMonthDesktop';
            const y=ref.getFullYear(),m=ref.getMonth();
            const mEl=document.getElementById(monthId);
            if(mEl) mEl.textContent=`${MONTHS[m]} ${y}`;
            await loadBookingDetails(y,m+1);
            const firstDay=new Date(y,m,1).getDay();
            const daysInMonth=new Date(y,m+1,0).getDate();
            const today=new Date(); today.setHours(0,0,0,0);
            let html='';
            for(let i=0;i<firstDay;i++) html+='<div class="cal-day empty"></div>';
            for(let day=1;day<=daysInMonth;day++){
                const dt=new Date(y,m,day);
                const str=`${y}-${pad2(m+1)}-${pad2(day)}`;
                const isBooked=bookedDates.includes(str);
                const isPast=dt<today;
                const isToday=dt.getTime()===today.getTime();
                let cls='cal-day';
                if(isPast) cls+=' past';
                else if(isBooked) cls+=' booked';
                else cls+=' available';
                if(isToday) cls+=' today';
                if(selectedStartDate===str) cls+=' selected-start';
                if(selectedEndDate===str) cls+=' selected-end';
                if(currentDurationMode==='24'&&selectedStartDate&&selectedEndDate&&str>selectedStartDate&&str<selectedEndDate) cls+=' selected-range';
                const oc=(!isPast&&!isBooked)?`onclick="selectDate('${str}')"`:'';
                const tip=isBooked?`onmouseover="showTip('${str}',this)" onmouseout="hideTip()"`:'';
                html+=`<div class="${cls}" ${oc} ${tip}>${day}</div>`;
            }
            const grid=document.getElementById(gridId);
            if(grid) grid.innerHTML=html;
        }

        async function doCheckAvail(isDesktop){
            let startDate,endDate,startTime,endTime;
            const sfx=isDesktop?'Desktop':'';
            if(currentDurationMode==='12'){
                const d=document.getElementById('startDate12'+sfx)?.value;
                const t=document.getElementById('startTime'+sfx)?.value;
                if(!d||!t){alert('Pilih tanggal dan waktu.');return;}
                const ec=calcEndDT(d,t);
                startDate=d;startTime=t;endDate=ec.date;endTime=ec.time;
            } else {
                startDate=document.getElementById('startDate'+sfx)?.value;
                endDate=document.getElementById('endDate'+sfx)?.value;
                if(!startDate||!endDate){alert('Pilih tanggal mulai dan selesai.');return;}
            }
            const c=getConflicts(startDate,endDate);
            if(c.length){alert('Tanggal '+c.map(fmtDate).join(', ')+' sudah dibooking.');return;}
            const btn=document.getElementById('checkAvailability'+sfx);
            const orig=btn.innerHTML;
            btn.disabled=true;btn.innerHTML='<span class="spinner"></span> Checking...';
            const payload={start_date:startDate,end_date:endDate,service_type:'lepas_kunci',duration_mode:currentDurationMode};
            if(currentDurationMode==='12'){payload.start_time=startTime;payload.end_time=endTime;payload.start_datetime=`${startDate} ${startTime}`;payload.end_datetime=`${endDate} ${endTime}`;}
            else{payload.start_datetime=`${startDate} 00:00`;payload.end_datetime=`${endDate} 23:59`;}
            try{
                const [avRes,prRes]=await Promise.all([
                    fetch(`/api/cars/${carId}/check-availability`,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},body:JSON.stringify(payload)}),
                    fetch(`/api/cars/${carId}/price-estimate`,    {method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},body:JSON.stringify(payload)}),
                ]);
                const av=await avRes.json();
                if(!av.available){alert(av.message||'Mobil tidak tersedia.');btn.disabled=false;btn.innerHTML=orig;return;}
                const pr=await prRes.json();
                document.getElementById('rentalDuration'+sfx).textContent=`${pr.days} hari`;
                document.getElementById('basePrice'+sfx).textContent=formatRp(pr.base_price);
                document.getElementById('serviceCharge'+sfx).textContent=formatRp(pr.service_charge);
                document.getElementById('totalPrice'+sfx).textContent=formatRp(pr.total_price);
                document.getElementById('minDeposit'+sfx).textContent=formatRp(pr.min_deposit);
                const bBtn=document.getElementById('bookNowBtn'+sfx);
                const url=new URL(bBtn.href);
                Object.entries({start:payload.start_datetime,end:payload.end_datetime,mode:currentDurationMode,base_price:pr.base_price,total_price:pr.total_price,min_deposit:pr.min_deposit,days:pr.days})
                    .forEach(([k,v])=>url.searchParams.set(k,v));
                bBtn.href=url.toString();
                const box=document.getElementById('priceEstimateBox'+sfx);
                box.classList.add('show');
                box.scrollIntoView({behavior:'smooth',block:'nearest'});
            }catch(e){console.error(e);alert('Terjadi kesalahan.');}
            finally{btn.disabled=false;btn.innerHTML=orig;}
        }

        document.getElementById('checkAvailability').addEventListener('click',()=>doCheckAvail(false));
        document.getElementById('checkAvailabilityDesktop').addEventListener('click',()=>doCheckAvail(true));

        ['startDate','startDateDesktop'].forEach(id=>{ document.getElementById(id)?.addEventListener('change',function(){selectedStartDate=this.value||null;syncInputs();}); });
        ['endDate','endDateDesktop'].forEach(id=>{ document.getElementById(id)?.addEventListener('change',function(){selectedEndDate=this.value||null;syncInputs();}); });
        ['startDate12','startDate12Desktop'].forEach(id=>{ document.getElementById(id)?.addEventListener('change',function(){selectedStartDate=selectedEndDate=this.value||null;syncInputs();}); });
        ['startTime','startTimeDesktop'].forEach(id=>{
            document.getElementById(id)?.addEventListener('change',function(){
                const d=document.getElementById(id==='startTime'?'startDate12':'startDate12Desktop')?.value;
                if(d){const ec=calcEndDT(d,this.value);const etId=id==='startTime'?'endTime':'endTimeDesktop';const el=document.getElementById(etId);if(el)el.value=ec.time;}
            });
        });

        document.getElementById('prevMonth').addEventListener('click',()=>{mainCalDate.setMonth(mainCalDate.getMonth()-1);renderCalendar('mobile');});
        document.getElementById('nextMonth').addEventListener('click',()=>{mainCalDate.setMonth(mainCalDate.getMonth()+1);renderCalendar('mobile');});
        document.getElementById('prevMonthDesktop').addEventListener('click',()=>{desktopCalDate.setMonth(desktopCalDate.getMonth()-1);renderCalendar('desktop');});
        document.getElementById('nextMonthDesktop').addEventListener('click',()=>{desktopCalDate.setMonth(desktopCalDate.getMonth()+1);renderCalendar('desktop');});

        function changeImg(src,thumb){
            document.getElementById('mainImg').src=src;
            document.querySelectorAll('.thumb-item').forEach(t=>t.classList.remove('active'));
            thumb.classList.add('active');
        }
        function expandImage(){
            const src=document.getElementById('mainImg').src;
            const w=window.open('','_blank');
            w.document.write(`<body style="margin:0;background:#000;display:flex;align-items:center;justify-content:center;min-height:100vh;"><img src="${src}" style="max-width:100%;max-height:100vh;object-fit:contain;"></body>`);
        }

        const tooltip=document.getElementById('bookingTooltip');
        function showTip(str,el){
            const b=bookingDetailsMap[str];if(!b)return;
            const cls=b.status==='confirmed'?'color:#1E40AF':'color:#065F46';
            tooltip.innerHTML=`<div class="tip-title">${b.booking_code}</div><div class="tip-row"><span class="tip-lbl">Customer:</span><span>${b.user_name}</span></div><div class="tip-row"><span class="tip-lbl">Status:</span><span style="${cls};font-weight:700;">${b.status}</span></div><div class="tip-row"><span class="tip-lbl">Period:</span><span>${b.start} – ${b.end}</span></div>`;
            const r=el.getBoundingClientRect();
            tooltip.style.left=r.left+r.width/2+'px';
            tooltip.style.top=(r.top+window.scrollY-10)+'px';
            tooltip.style.transform='translate(-50%,-100%)';
            tooltip.classList.add('show');
        }
        function hideTip(){tooltip.classList.remove('show');}

        const mobileSheet=document.getElementById('mobileSheet');
        const mobileOverlay=document.getElementById('mobileSheetOverlay');
        document.getElementById('mobileOpenSheet').addEventListener('click',()=>{
            mobileSheet.style.transform='translateY(0)';
            mobileOverlay.style.display='flex';
            document.body.style.overflow='hidden';
        });
        function closeMobileSheet(){
            mobileSheet.style.transform='translateY(100%)';
            mobileOverlay.style.display='none';
            document.body.style.overflow='';
        }
        let touchY=0;
        mobileSheet.addEventListener('touchstart',e=>{touchY=e.touches[0].clientY;},{passive:true});
        mobileSheet.addEventListener('touchend',e=>{if(e.changedTouches[0].clientY-touchY>80)closeMobileSheet();},{passive:true});

        (function(){
            let pUrl=null,ok=false;
            const mo=document.getElementById('leaveModal');
            const bx=document.getElementById('leaveModalBox');
            const WHITELIST=['bookings','login','register','logout','cars','wa.me','whatsapp'];
            function isWL(url){try{const u=new URL(url,location.origin);return WHITELIST.some(w=>u.pathname.includes(w)||u.href.includes(w));}catch(e){return false;}}
            function show(url){pUrl=url;mo.style.opacity='1';mo.style.pointerEvents='auto';bx.style.transform='scale(1)';}
            function hide(){mo.style.opacity='0';mo.style.pointerEvents='none';bx.style.transform='scale(0.9)';pUrl=null;}
            document.getElementById('leaveCancelBtn').addEventListener('click',hide);
            mo.addEventListener('click',e=>{if(e.target===mo)hide();});
            document.getElementById('leaveConfirmBtn').addEventListener('click',()=>{ok=true;hide();pUrl?window.location.href=pUrl:history.back();});
            document.addEventListener('click',e=>{
                const a=e.target.closest('a[href]');
                if(!a||ok)return;
                const h=a.getAttribute('href');
                if(!h||h.startsWith('#')||h.startsWith('javascript')||a.target==='_blank')return;
                if(a.href===location.href)return;
                if(isWL(a.href))return;
                e.preventDefault();show(a.href);
            });
            history.pushState(null,'',location.href);
            window.addEventListener('popstate',()=>{if(ok)return;history.pushState(null,'',location.href);show(null);});
        })();

        renderCalendar('mobile');
        renderCalendar('desktop');
        selectRentalType('lepas_kunci');
    </script>

</x-app-layout>
