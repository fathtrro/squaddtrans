<x-app-layout>
    <x-alert />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #F59E0B;
            --primary-dark: #D97706;
            --primary-light: #FEF3C7;
            --dark: #111827;
            --gray: #6B7280;
            --light: #F9FAFB;
            --border: #E5E7EB;
            --success: #10B981;
            --success-light: #D1FAE5;
        }

        body { font-family: 'Inter', sans-serif; background: #F5F5F5; color: var(--dark); line-height: 1.5; }

        /* ── CONTAINER ── */
        .container { max-width: 1200px; margin: 0 auto; padding: 1rem; }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            display: flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem; color: var(--gray);
            margin-bottom: 1.5rem; background: white; padding: 0.75rem 1rem;
            border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow-x: auto; white-space: nowrap; scrollbar-width: none;
        }
        .breadcrumb::-webkit-scrollbar { display: none; }
        .breadcrumb a { color: var(--gray); text-decoration: none; transition: all 0.3s; padding: 0.25rem 0.5rem; border-radius: 6px; }
        .breadcrumb a:hover { color: var(--primary); background: var(--primary-light); }
        .breadcrumb i.fa-chevron-right { font-size: 0.625rem; opacity: 0.5; flex-shrink: 0; }

        /* ── MAIN GRID ── */
        .main-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 1024px) { .main-grid { grid-template-columns: 1fr 340px; gap: 2rem; } }

        /* ── CARD ── */
        .card {
            background: white; border: 1px solid var(--border); border-radius: 16px;
            padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.3s;
        }

        /* ── GALLERY ── */
        .gallery-main {
            position: relative; height: 400px; border-radius: 16px; overflow: hidden;
            background: linear-gradient(135deg, #1F2937, #111827); margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .gallery-main img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .gallery-main:hover img { transform: scale(1.05); }

        .back-button {
            position: absolute; top: 1rem; left: 1rem; width: 40px; height: 40px;
            background: rgba(0,0,0,0.75); backdrop-filter: blur(12px); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: white;
            text-decoration: none; font-size: 1rem; transition: all 0.3s; z-index: 20;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .back-button:hover { background: rgba(0,0,0,0.9); transform: scale(1.1); }

        .car-title {
            position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem;
            background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.4), transparent);
        }
        .car-title h1 { color: white; font-size: 1.875rem; font-weight: 800; margin-bottom: 0.25rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        .car-title p { color: var(--primary); font-size: 0.9375rem; font-weight: 600; }

        .badges { position: absolute; top: 1rem; right: 1rem; display: flex; gap: 0.5rem; flex-wrap: wrap; justify-content: flex-end; }
        .badge { display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.5rem 0.875rem; border-radius: 8px; font-size: 0.75rem; font-weight: 700; backdrop-filter: blur(12px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .badge-premium { background: linear-gradient(135deg, rgba(245,158,11,0.95), rgba(217,119,6,0.95)); color: white; }
        .badge-available { background: linear-gradient(135deg, rgba(16,185,129,0.95), rgba(5,150,105,0.95)); color: white; }

        .rating-badge {
            position: absolute; top: 1rem; left: 3.5rem;
            background: rgba(0,0,0,0.8); backdrop-filter: blur(12px);
            padding: 0.5rem 0.875rem; border-radius: 10px; display: flex; align-items: center;
            gap: 0.5rem; color: white; font-weight: 700; font-size: 0.9375rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .rating-badge i { color: #FCD34D; }

        .gallery-thumbs { display: grid; grid-template-columns: repeat(5, 1fr); gap: 0.75rem; }
        .thumb {
            height: 70px; border-radius: 10px; overflow: hidden; cursor: pointer;
            border: 3px solid transparent; transition: all 0.3s; opacity: 0.6;
        }
        .thumb:hover, .thumb.active { border-color: var(--primary); opacity: 1; transform: translateY(-4px); box-shadow: 0 6px 16px rgba(245,158,11,0.3); }
        .thumb img { width: 100%; height: 100%; object-fit: cover; }

        /* ── MOBILE QUICK INFO ── */
        .mobile-quick-info {
            display: none;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 0;
        }
        .quick-info-card {
            background: white; border: 1px solid var(--border); border-radius: 14px;
            padding: 1rem; display: flex; align-items: center; gap: 0.875rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .quick-info-icon {
            width: 42px; height: 42px; border-radius: 12px; display: flex;
            align-items: center; justify-content: center; flex-shrink: 0; font-size: 1rem;
        }
        .quick-info-label { font-size: 0.6875rem; color: var(--gray); font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
        .quick-info-value { font-size: 0.9375rem; font-weight: 800; color: var(--dark); }

        /* ── SPECS ── */
        .specs-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 1px;
            background-color: var(--border); border: 1px solid var(--border); border-radius: 12px; overflow: hidden;
        }
        .spec-item {
            background: white; padding: 0.75rem 1rem; display: flex;
            align-items: center; gap: 0.75rem; transition: background 0.2s;
        }
        .spec-item:hover { background: #FAFAFA; }
        .spec-item i { font-size: 1rem; color: #9CA3AF; width: 20px; text-align: center; }
        .spec-item:hover i { color: var(--primary); }
        .spec-content { display: flex; flex-direction: column; }
        .spec-label { font-size: 0.65rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; }
        .spec-value { font-weight: 600; font-size: 0.875rem; color: #1F2937; }

        /* ── FEATURES ── */
        .features-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; margin-top: 1rem; }
        .feature-item { display: flex; align-items: center; gap: 0.625rem; font-size: 0.875rem; color: var(--dark); padding: 0.75rem; background: var(--light); border-radius: 10px; transition: all 0.3s; }
        .feature-item:hover { background: var(--primary-light); transform: translateX(4px); }
        .feature-item i { font-size: 1.125rem; color: var(--primary); background: white; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }

        /* ── SECTION TITLE ── */
        .section-title { font-size: 1.125rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.625rem; color: var(--dark); padding-bottom: 0.75rem; border-bottom: 2px solid var(--border); }
        .section-title i { color: var(--primary); font-size: 1rem; background: var(--primary-light); width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 8px; }

        /* ── DATE PICKERS ── */
        .date-picker { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem; }
        .date-picker-12h { display: none; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem; }
        .date-field label { display: block; font-size: 0.8125rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--dark); text-transform: uppercase; letter-spacing: 0.5px; }
        .date-field input { width: 100%; padding: 0.75rem; border: 2px solid var(--border); border-radius: 10px; font-family: inherit; font-size: 0.875rem; transition: all 0.3s; background: var(--light); }
        .date-field input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 4px rgba(245,158,11,0.1); background: white; }

        /* ── CALENDAR ── */
        .calendar-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding: 0.75rem; background: var(--light); border-radius: 10px; }
        .calendar-nav h4 { font-size: 1rem; font-weight: 700; color: var(--dark); }
        .calendar-nav button { width: 36px; height: 36px; border: none; background: white; border-radius: 8px; cursor: pointer; font-size: 0.875rem; color: var(--dark); transition: all 0.3s; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .calendar-nav button:hover { background: var(--primary); color: white; transform: scale(1.1); }

        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.375rem; margin-bottom: 1rem; }
        .calendar-day-header { text-align: center; font-size: 0.75rem; font-weight: 700; color: var(--gray); padding: 0.5rem 0; text-transform: uppercase; }
        .calendar-day { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: 600; border-radius: 8px; cursor: pointer; transition: all 0.3s; }
        .calendar-day.available { background: var(--light); border: 2px solid transparent; }
        .calendar-day.available:hover { background: var(--primary); color: white; transform: scale(1.1); box-shadow: 0 4px 8px rgba(245,158,11,0.3); }
        .calendar-day.booked { background: linear-gradient(135deg,#FEE2E2,#FCA5A5); color: #DC2626; cursor: not-allowed; border: 2px solid #FCA5A5; font-weight: 700; }
        .calendar-day.selected-start, .calendar-day.selected-end { background: linear-gradient(135deg,var(--success),#059669); color: white; box-shadow: 0 4px 12px rgba(16,185,129,0.4); transform: scale(1.1); }
        .calendar-day.selected-range { background: var(--success-light); color: #065F46; border: 2px solid var(--success); }
        .calendar-day.today { border: 2px solid #3B82F6; font-weight: 700; }
        .calendar-day.past { background: transparent; color: #D1D5DB; cursor: not-allowed; opacity: 0.4; }

        /* ── TOOLTIP ── */
        .booking-tooltip {
            position: fixed; background: linear-gradient(135deg,rgba(17,24,39,0.98),rgba(31,41,55,0.98));
            color: white; padding: 1rem; border-radius: 12px; font-size: 0.8125rem; z-index: 1000;
            min-width: 200px; box-shadow: 0 8px 24px rgba(0,0,0,0.3); pointer-events: none;
            opacity: 0; transition: opacity 0.2s; border: 1px solid rgba(255,255,255,0.1);
        }
        .booking-tooltip.show { opacity: 1; }
        .booking-tooltip-header { font-weight: 700; margin-bottom: 0.625rem; padding-bottom: 0.625rem; border-bottom: 1px solid rgba(255,255,255,0.2); color: var(--primary); font-size: 0.75rem; }
        .booking-tooltip-row { display: flex; gap: 0.5rem; margin-bottom: 0.375rem; font-size: 0.75rem; }
        .booking-tooltip-label { color: rgba(255,255,255,0.7); min-width: 60px; font-weight: 600; }

        /* ── CALENDAR LEGEND ── */
        .calendar-legend { display: flex; flex-wrap: wrap; gap: 1rem; padding-top: 1rem; border-top: 2px solid var(--border); font-size: 0.8125rem; }
        .legend-item { display: flex; align-items: center; gap: 0.5rem; font-weight: 600; }
        .legend-dot { width: 16px; height: 16px; border-radius: 6px; }

        /* ── PRICE ESTIMATE ── */
        .price-estimate {
            background: linear-gradient(135deg,#ECFDF5,#D1FAE5); border: 2px solid var(--success);
            border-radius: 12px; padding: 1.25rem; margin-top: 1rem; display: none;
            box-shadow: 0 4px 12px rgba(16,185,129,0.15);
        }
        .price-estimate.show { display: block; animation: slideInUp 0.4s ease; }
        @keyframes slideInUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        .price-estimate-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; font-size: 0.9375rem; font-weight: 700; color: #065F46; }
        .price-row { display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.875rem; color: #047857; }
        .price-row.total { border-top: 2px solid var(--success); padding-top: 0.75rem; margin-top: 0.75rem; font-weight: 800; font-size: 1.125rem; color: #065F46; }

        /* ── RENTAL TYPE ── */
        .rental-type-options { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 0.75rem; }
        .rental-type-card {
            background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1);
            border-radius: 12px; padding: 1rem; cursor: pointer; transition: all 0.3s;
            position: relative; overflow: hidden;
        }
        .rental-type-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,var(--primary),var(--primary-dark)); transform:scaleX(0); transition:transform 0.3s; }
        .rental-type-card:hover { border-color: rgba(245,158,11,0.5); transform: translateY(-2px); }
        .rental-type-card:hover::before, .rental-type-card.active::before { transform: scaleX(1); }
        .rental-type-card.active { background: rgba(245,158,11,0.15); border-color: var(--primary); box-shadow: 0 4px 12px rgba(245,158,11,0.2); }
        .rental-type-icon { width: 48px; height: 48px; background: rgba(245,158,11,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; transition: all 0.3s; }
        .rental-type-card.active .rental-type-icon { background: var(--primary); transform: scale(1.1); }
        .rental-type-icon i { font-size: 1.5rem; color: var(--primary); transition: all 0.3s; }
        .rental-type-card.active .rental-type-icon i { color: var(--dark); }
        .rental-type-title { font-size: 0.875rem; font-weight: 700; color: rgba(255,255,255,0.9); margin-bottom: 0.25rem; }
        .rental-type-desc { font-size: 0.75rem; color: rgba(255,255,255,0.6); line-height: 1.4; }
        .rental-type-check { position: absolute; top: 0.75rem; right: 0.75rem; width: 24px; height: 24px; background: rgba(255,255,255,0.1); border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s; }
        .rental-type-card.active .rental-type-check { background: var(--primary); border-color: var(--primary); }
        .rental-type-check i { font-size: 0.75rem; color: transparent; }
        .rental-type-card.active .rental-type-check i { color: var(--dark); }

        /* ── PRICE CARD ── */
        .price-card {
            background: linear-gradient(135deg,#1F2937,#111827); color: white;
            border-radius: 16px; padding: 1.5rem; position: sticky; top: 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1);
        }
        .price-card h3 { margin-bottom: 1.25rem; font-size: 1.25rem; font-weight: 800; background: linear-gradient(90deg,white,rgba(255,255,255,0.8)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .price-option { background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 1rem; margin-bottom: 0.75rem; transition: all 0.3s; cursor: pointer; }
        .price-option:hover { background: rgba(255,255,255,0.12); border-color: rgba(245,158,11,0.5); transform: translateX(4px); }
        .price-option-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.375rem; }
        .price-option-label { font-size: 0.875rem; color: rgba(255,255,255,0.7); font-weight: 600; }
        .price-option-value { font-size: 1.5rem; font-weight: 800; color: var(--primary); }
        .price-option.featured { background: rgba(245,158,11,0.15); border-color: var(--primary); box-shadow: 0 4px 12px rgba(245,158,11,0.2); }
        .price-option.active { background: rgba(245,158,11,0.25); border-color: var(--primary); box-shadow: 0 4px 16px rgba(245,158,11,0.3); }
        .price-info { font-size: 0.8125rem; color: rgba(255,255,255,0.6); margin: 1rem 0; padding: 1rem 0; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1); }
        .price-features { margin: 1rem 0; }
        .price-feature { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; margin-bottom: 0.5rem; color: rgba(255,255,255,0.85); transition: all 0.3s; }
        .price-feature:hover { color: white; transform: translateX(4px); }
        .price-feature i { color: var(--success); font-size: 0.875rem; background: rgba(16,185,129,0.2); width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border-radius: 6px; }

        /* ── CHECK AVAILABILITY IN CARD ── */
        .price-card .inline-check-availability { margin-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem; }
        .price-card .inline-check-availability .section-title { color: rgba(255,255,255,0.95); padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 1rem; }
        .price-card .inline-check-availability .date-field label,
        .mobile-sheet .date-field label { color: rgba(255,255,255,0.75); font-size: 0.75rem; }

        .price-card .inline-check-availability input[type="date"],
        .price-card .inline-check-availability input[type="time"],
        .mobile-sheet input[type="date"],
        .mobile-sheet input[type="time"] {
            background: rgba(255,255,255,0.06);
            color: white;
            border: 1px solid rgba(255,255,255,0.15);
            color-scheme: dark;
            font-size: 0.8125rem;
            padding: 0.625rem;
        }

        .price-card .inline-check-availability input:focus,
        .mobile-sheet input[type="date"]:focus,
        .mobile-sheet input[type="time"]:focus { background: rgba(255,255,255,0.1); border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(245,158,11,0.15); }
        .price-card .inline-check-availability .calendar-nav,
        .mobile-sheet .calendar-nav { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); }
        .price-card .inline-check-availability .calendar-nav h4,
        .mobile-sheet .calendar-nav h4 { color: white; }
        .price-card .inline-check-availability .calendar-nav button,
        .mobile-sheet .calendar-nav button { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); box-shadow: none; }
        .price-card .inline-check-availability .calendar-nav button:hover,
        .mobile-sheet .calendar-nav button:hover { background: var(--primary); color: white; }
        /* ── DARK CALENDAR (price-card desktop + mobile-sheet) ── */
        .price-card .inline-check-availability .calendar-day-header,
        .mobile-sheet .calendar-day-header { color: rgba(255,255,255,0.5); }

        .price-card .inline-check-availability .calendar-day,
        .mobile-sheet .calendar-day { border: 1px solid rgba(255,255,255,0.10); color: rgba(255,255,255,0.85); background: rgba(255,255,255,0.05); }

        .price-card .inline-check-availability .calendar-day.available,
        .mobile-sheet .calendar-day.available { background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); }

        .price-card .inline-check-availability .calendar-day.available:hover,
        .mobile-sheet .calendar-day.available:hover { background: var(--primary); color: white; border-color: var(--primary); transform: scale(1.1); }

        .price-card .inline-check-availability .calendar-day.booked,
        .mobile-sheet .calendar-day.booked { background: rgba(239,68,68,0.2); color: #f87171; border-color: rgba(239,68,68,0.35); cursor: not-allowed; }

        .price-card .inline-check-availability .calendar-day.selected-start,
        .price-card .inline-check-availability .calendar-day.selected-end,
        .mobile-sheet .calendar-day.selected-start,
        .mobile-sheet .calendar-day.selected-end { background: linear-gradient(135deg,var(--success),#059669); color: white; border-color: var(--success); transform: scale(1.1); box-shadow: 0 4px 12px rgba(16,185,129,0.4); }

        .price-card .inline-check-availability .calendar-day.selected-range,
        .mobile-sheet .calendar-day.selected-range { background: rgba(16,185,129,0.25); color: #6ee7b7; border-color: rgba(16,185,129,0.4); }

        .price-card .inline-check-availability .calendar-day.today,
        .mobile-sheet .calendar-day.today { border-color: #60a5fa; border-width: 2px; }

        .price-card .inline-check-availability .calendar-day.past,
        .mobile-sheet .calendar-day.past { color: rgba(255,255,255,0.2); background: transparent; border-color: transparent; cursor: not-allowed; opacity: 0.4; }
        .price-card .inline-check-availability .calendar-legend { border-top: 1px solid rgba(255,255,255,0.1); }
        .price-card .inline-check-availability .legend-item { color: rgba(255,255,255,0.7); font-size: 0.75rem; }

        /* ── PRICE ESTIMATE (IN CARD) ── */
        .price-card .price-estimate { background: rgba(16,185,129,0.1); border-color: var(--success); }
        .price-card .price-estimate .price-estimate-header { color: #6ee7b7; }
        .price-card .price-estimate .price-row { color: #6ee7b7; }
        .price-card .price-estimate .price-row.total { color: white; border-top-color: var(--success); }
        .price-card .price-estimate [style*="color: #065F46"] { color: #34d399 !important; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.875rem 1.25rem; border-radius: 10px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.3s; border: none; text-decoration: none; width: 100%; position: relative; overflow: hidden; font-family: inherit; }
        .btn-primary { background: linear-gradient(135deg,var(--primary),var(--primary-dark)); color: white; box-shadow: 0 4px 12px rgba(245,158,11,0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(245,158,11,0.4); }
        .btn-secondary { background: transparent; border: 2px solid rgba(255,255,255,0.3); color: white; }
        .btn-secondary:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.5); }
        .btn-success { background: linear-gradient(135deg,var(--success),#059669); color: white; box-shadow: 0 4px 12px rgba(16,185,129,0.3); }
        .btn-success:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }
        .btn-whatsapp { background: linear-gradient(135deg,#25D366,#128C7E); color: white; box-shadow: 0 4px 12px rgba(37,211,102,0.3); }
        .btn-whatsapp:hover { transform: translateY(-2px); }

        /* ── RELATED CARS ── */
        .related-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 1rem; margin-top: 1.5rem; }
        @media (min-width: 768px) { .related-grid { grid-template-columns: repeat(3,1fr); } }
        .related-card { background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .related-card:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0,0,0,0.15); border-color: var(--primary); }
        .related-image { height: 160px; overflow: hidden; }
        .related-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .related-card:hover .related-image img { transform: scale(1.1); }
        .related-content { padding: 1rem; }
        .related-brand { font-weight: 700; font-size: 0.9375rem; margin-bottom: 0.25rem; color: var(--dark); }
        .related-name { color: var(--primary); font-size: 0.875rem; margin-bottom: 0.75rem; font-weight: 600; }
        .related-price { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; }
        .related-price-label { color: var(--gray); font-size: 0.8125rem; }
        .related-price-value { font-weight: 800; color: var(--dark); }

        /* ── SPINNER ── */
        .spinner { border: 3px solid var(--border); border-top-color: var(--primary); border-radius: 50%; width: 20px; height: 20px; animation: spin 0.6s linear infinite; display: inline-block; vertical-align: middle; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── DIVIDER ── */
        .divider { height: 1px; background: linear-gradient(90deg,transparent,var(--border),transparent); margin: 1rem 0; }

        /* ── MOBILE BOTTOM SHEET ── */
        .mobile-sheet-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px); z-index: 800;
        }
        .mobile-sheet-overlay.show { display: flex; }
        .mobile-sheet {
            position: fixed; bottom: 0; left: 0; right: 0; z-index: 900;
            background: linear-gradient(135deg,#1F2937,#111827); color: white;
            border-radius: 28px 28px 0 0; max-height: 90vh; overflow-y: auto;
            transform: translateY(100%); transition: transform 0.4s cubic-bezier(0.32,0.72,0,1);
            box-shadow: 0 -8px 40px rgba(0,0,0,0.35);
        }
        .mobile-sheet.open { transform: translateY(0); }
        .mobile-sheet-handle { display: flex; justify-content: center; padding: 12px 0 4px; position: sticky; top: 0; background: #1F2937; border-radius: 28px 28px 0 0; z-index: 10; }
        .mobile-sheet-handle-bar { width: 40px; height: 4px; background: rgba(255,255,255,0.2); border-radius: 2px; }
        .mobile-sheet-content { padding: 0 1.25rem 2rem; }

        /* ── MOBILE FLOATING BAR ── */
        .mobile-floating-bar {
            display: none; position: fixed; bottom: 0; left: 0; right: 0; z-index: 700;
            background: rgba(255,255,255,0.97); backdrop-filter: blur(16px);
            border-top: 1px solid var(--border); padding: 0.875rem 1rem;
            box-shadow: 0 -4px 24px rgba(0,0,0,0.12);
        }
        .mobile-floating-inner { display: flex; align-items: center; gap: 0.875rem; max-width: 480px; margin: 0 auto; }
        .mobile-price-info { flex: 1; }
        .mobile-price-from { font-size: 0.6875rem; color: var(--gray); font-weight: 500; }
        .mobile-price-amount { font-size: 1.125rem; font-weight: 800; color: var(--dark); line-height: 1.2; }
        .mobile-price-per { font-size: 0.6875rem; color: var(--gray); }
        .mobile-book-btn {
            flex-shrink: 0; display: flex; align-items: center; gap: 0.5rem;
            background: linear-gradient(135deg,var(--primary),var(--primary-dark));
            color: white; font-weight: 800; font-size: 0.9375rem; border: none;
            padding: 0.875rem 1.5rem; border-radius: 16px; cursor: pointer;
            box-shadow: 0 4px 16px rgba(245,158,11,0.35); transition: all 0.2s;
            font-family: inherit; white-space: nowrap;
        }
        .mobile-book-btn:active { transform: scale(0.96); }

        /* ── RESPONSIVE ── */
        @media (max-width: 1023px) {
            .price-card { display: none; }        /* hide desktop card */
            .mobile-floating-bar { display: block; }
            .mobile-quick-info { display: grid; }
        }

        @media (max-width: 768px) {
            .gallery-main { height: 260px; }
            .car-title h1 { font-size: 1.375rem; }
            .specs-grid { grid-template-columns: repeat(2,1fr); }
            .gallery-thumbs { grid-template-columns: repeat(4,1fr); }
            .date-picker, .date-picker-12h { grid-template-columns: 1fr; }
            .related-grid { grid-template-columns: 1fr; }
            .rental-type-options { grid-template-columns: 1fr 1fr; }
            .container { padding: 0.75rem; }
            .breadcrumb { margin-bottom: 0.875rem; }
            .card { padding: 1rem; }
            /* Extra bottom padding for floating bar */
            .main-grid { padding-bottom: 5rem; }
        }
    </style>

    {{-- ══════════════════════ LEAVE MODAL ══════════════════════ --}}
    <div id="leaveModal" style="position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);opacity:0;pointer-events:none;transition:opacity 0.3s;">
        <div id="leaveModalBox" style="background:white;border-radius:20px;padding:1.75rem;max-width:360px;width:90%;text-align:center;transform:scale(0.9);transition:transform 0.3s;box-shadow:0 20px 60px rgba(0,0,0,0.25);">
            <div style="width:60px;height:60px;background:#FEF3C7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="fa-solid fa-arrow-right-from-bracket" style="color:#D97706;font-size:1.5rem;"></i>
            </div>
            <h4 style="font-size:1rem;font-weight:800;color:var(--dark);margin-bottom:0.5rem;">Tinggalkan halaman?</h4>
            <p style="font-size:0.875rem;color:var(--gray);margin-bottom:1.5rem;">Pilihan tanggal kamu belum disimpan.</p>
            <div style="display:flex;gap:0.75rem;">
                <button id="leaveCancelBtn" style="flex:1;padding:0.75rem;border-radius:10px;border:2px solid var(--border);background:white;font-weight:600;font-size:0.875rem;cursor:pointer;font-family:inherit;color:var(--dark);transition:all 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='white'">Batal</button>
                <button id="leaveConfirmBtn" style="flex:1;padding:0.75rem;border-radius:10px;border:none;background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;font-weight:700;font-size:0.875rem;cursor:pointer;font-family:inherit;">Tinggalkan</button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════ TOOLTIP ══════════════════════ --}}
    <div class="booking-tooltip" id="bookingTooltip"></div>

    {{-- ══════════════════════ MOBILE SHEET OVERLAY ══════════════════════ --}}
    <div class="mobile-sheet-overlay" id="mobileSheetOverlay" onclick="closeMobileSheet()"></div>

    {{-- ══════════════════════ MOBILE BOTTOM SHEET ══════════════════════ --}}
    <div class="mobile-sheet" id="mobileSheet">
        <div class="mobile-sheet-handle">
            <div class="mobile-sheet-handle-bar"></div>
        </div>
        <div class="mobile-sheet-content">
            {{-- Rental Price Options --}}
            <div id="mobilePriceSection">
                <h3 style="font-size:1.125rem;font-weight:800;background:linear-gradient(90deg,white,rgba(255,255,255,0.8));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:1rem;">Rental Price</h3>

                <div class="price-option featured active" data-duration="24" data-price="{{ $car->price_24h }}"
                     onclick="selectPrice(this,'24',{{ $car->price_24h }})">
                    <div class="price-option-header">
                        <span class="price-option-label">24 Hours</span>
                        <span class="badge badge-premium" style="font-size:0.625rem;">BEST</span>
                    </div>
                    <div class="price-option-value">Rp {{ number_format($car->price_24h,0,',','.') }}</div>
                </div>

                <div class="price-option" data-duration="12" data-price="{{ $car->price_24h * 0.7 }}"
                     onclick="selectPrice(this,'12',{{ $car->price_24h * 0.7 }})">
                    <div class="price-option-header">
                        <span class="price-option-label">12 Hours</span>
                    </div>
                    <div class="price-option-value">Rp {{ number_format($car->price_24h * 0.7,0,',','.') }}</div>
                </div>
            </div>

            <input type="hidden" id="selectedDurationMobile" value="24">

            {{-- Rental Type --}}
            <div class="rental-type-selector" style="margin-bottom:1.25rem;">
                <div class="rental-type-options">
                    <div class="rental-type-card active" data-type="lepas_kunci" onclick="selectRentalType('lepas_kunci')">
                        <div class="rental-type-check"><i class="fa-solid fa-check"></i></div>
                        <div class="rental-type-icon"><i class="fa-solid fa-key"></i></div>
                        <div class="rental-type-title">Lepas Kunci</div>
                        <div class="rental-type-desc">Sewa mobil tanpa sopir.</div>
                    </div>
                    <div class="rental-type-card" data-type="carter" onclick="selectRentalType('carter')">
                        <div class="rental-type-check"><i class="fa-solid fa-check"></i></div>
                        <div class="rental-type-icon"><i class="fa-solid fa-user-tie"></i></div>
                        <div class="rental-type-title">Carter</div>
                        <div class="rental-type-desc">Dengan sopir profesional.</div>
                    </div>
                </div>
            </div>

            {{-- Availability Section --}}
            <div class="inline-check-availability" id="availabilitySection"
                 style="background:transparent;border:none;padding:0;box-shadow:none;margin-top:1.25rem;border-top:1px solid rgba(255,255,255,0.1);padding-top:1.25rem;">

                <div class="section-title" style="color:rgba(255,255,255,0.95);border-bottom:1px solid rgba(255,255,255,0.1);">
                    <i class="fa-solid fa-calendar-check"></i> Check Availability
                </div>

                <div id="inputs24h" class="date-picker">
                    <div class="date-field">
                        <label style="color:rgba(255,255,255,0.7);">Start Date</label>
                        <input type="date" id="startDate" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="date-field">
                        <label style="color:rgba(255,255,255,0.7);">End Date</label>
                        <input type="date" id="endDate" min="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div id="inputs12h" class="date-picker-12h">
                    <div class="date-field">
                        <label style="color:rgba(255,255,255,0.7);">Date</label>
                        <input type="date" id="startDate12" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="date-field">
                        <label style="color:rgba(255,255,255,0.7);">Start Time</label>
                        <input type="time" id="startTime" value="09:00">
                    </div>
                    <div class="date-field">
                        <label style="color:rgba(255,255,255,0.7);">End Time</label>
                        <input type="time" id="endTime" value="21:00" readonly style="opacity:0.5;cursor:not-allowed;">
                    </div>
                </div>

                <div style="margin-top:1rem;">
                    <div class="calendar-nav">
                        <button id="prevMonth"><i class="fa-solid fa-chevron-left"></i></button>
                        <h4 id="currentMonth" style="color:white;"></h4>
                        <button id="nextMonth"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                    <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:0.375rem;margin-bottom:0.5rem;">
                        <div class="calendar-day-header">Sun</div><div class="calendar-day-header">Mon</div>
                        <div class="calendar-day-header">Tue</div><div class="calendar-day-header">Wed</div>
                        <div class="calendar-day-header">Thu</div><div class="calendar-day-header">Fri</div>
                        <div class="calendar-day-header">Sat</div>
                    </div>
                    <div class="calendar-grid" id="calendarGrid"></div>
                    <div class="calendar-legend" style="border-top:1px solid rgba(255,255,255,0.1);padding-top:0.75rem;">
                        <div class="legend-item" style="color:rgba(255,255,255,0.7);"><div class="legend-dot" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.2);"></div> Tersedia</div>
                        <div class="legend-item" style="color:rgba(255,255,255,0.7);"><div class="legend-dot" style="background:rgba(239,68,68,0.2);"></div> Booked</div>
                        <div class="legend-item" style="color:rgba(255,255,255,0.7);"><div class="legend-dot" style="background:rgba(16,185,129,0.25);"></div> Dipilih</div>
                    </div>
                    <button style="margin-top:1rem;" type="button" id="checkAvailability" class="btn btn-primary">
                        <i class="fa-solid fa-search"></i> Check Availability
                    </button>
                </div>

                <div class="price-estimate" id="priceEstimateBox">
                    <div class="price-estimate-header">
                        <span><i class="fa-solid fa-check-circle"></i> Available!</span>
                        <span id="rentalDuration"></span>
                    </div>
                    <div class="price-row"><span>Base Price:</span><span id="basePrice" style="font-weight:600;">Rp 0</span></div>
                    <div class="price-row"><span>Service:</span><span id="serviceCharge" style="font-weight:600;">Rp 0</span></div>
                    <div class="price-row total"><span>Total:</span><span id="totalPrice">Rp 0</span></div>
                    <div style="font-size:0.75rem;color:#34d399;margin-top:0.375rem;">Min. DP: <span id="minDeposit" style="font-weight:600;">Rp 0</span></div>
                    <a href="{{ route('bookings.select-dates') }}" id="bookNowBtn" class="btn btn-success" style="margin-top:0.75rem;">
                        <i class="fa-solid fa-calendar-check"></i> Book Now
                    </a>
                </div>
            </div>

            {{-- WhatsApp Carter --}}
            <a href="#" id="whatsappBtn" class="btn btn-whatsapp" style="margin-top:1rem;display:none;">
                <i class="fa-brands fa-whatsapp"></i> Order via WhatsApp
            </a>

            <a href="https://wa.me/6281234567890?text=Hi, I'm interested in {{ $car->brand }} {{ $car->name }}"
               class="btn btn-secondary" style="margin-top:0.75rem;">
                <i class="fa-brands fa-whatsapp"></i> Contact Us
            </a>

            <div class="price-info" style="text-align:center;">
                <i class="fa-solid fa-info-circle"></i> Minimal DP 30%
            </div>
            <div class="price-features">
                @foreach (['Antar jemput gratis','Terawat baik','Support 24/7','Booking mudah'] as $feat)
                    <div class="price-feature"><i class="fa-solid fa-check"></i><span>{{ $feat }}</span></div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══════════════════════ MOBILE FLOATING BAR ══════════════════════ --}}
    <div class="mobile-floating-bar">
        <div class="mobile-floating-inner">
            <div class="mobile-price-info">
                <div class="mobile-price-from">Mulai dari</div>
                <div class="mobile-price-amount">Rp {{ number_format($car->price_24h,0,',','.') }}</div>
                <div class="mobile-price-per">/ 24 jam</div>
            </div>
            <button class="mobile-book-btn" id="mobileOpenSheet">
                <i class="fa-solid fa-calendar-check"></i> Pesan Sekarang
            </button>
        </div>
    </div>

    {{-- ══════════════════════ PAGE CONTENT ══════════════════════ --}}
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i> Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ route('dashboard') }}">Cars</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span style="color:var(--dark);font-weight:700;">{{ $car->name }}</span>
        </div>

        <div class="main-grid">

            {{-- LEFT COLUMN --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">

                {{-- Gallery --}}
                <div class="card" style="padding:0;overflow:hidden;">
                    <div class="gallery-main" id="mainImage">
                        @if ($car->images->first())
                            <img src="{{ asset('storage/'.$car->images->first()->image_path) }}" alt="{{ $car->name }}">
                        @else
                            <div style="display:flex;align-items:center;justify-content:center;height:100%;background:#000;">
                                <i class="fa-solid fa-car" style="font-size:3rem;color:#666;"></i>
                            </div>
                        @endif

                        <div class="badges">
                            @if ($car->status == 'available')
                                <span class="badge badge-available"><i class="fa-solid fa-check"></i> Available</span>
                            @endif
                            <span class="badge badge-premium"><i class="fa-solid fa-crown"></i> Premium</span>
                        </div>

                        <a href="{{ route('dashboard') }}" class="back-button" title="Kembali">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>

                        @if ($averageRating > 0)
                            <div class="rating-badge">
                                <i class="fa-solid fa-star"></i>
                                <span>{{ number_format($averageRating,1) }}</span>
                            </div>
                        @endif

                        <div class="car-title">
                            <h1>{{ $car->brand }} {{ $car->name }}</h1>
                            <p>{{ $car->year }} &bull; {{ ucfirst($car->transmission) }}</p>
                        </div>
                    </div>

                    @if ($car->images->count() > 1)
                        <div style="padding:1rem;">
                            <div class="gallery-thumbs">
                                @foreach ($car->images->take(5) as $index => $image)
                                    <div class="thumb {{ $index===0?'active':'' }}"
                                         onclick="changeMainImage('{{ asset('storage/'.$image->image_path) }}',this)">
                                        <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $car->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Mobile quick info --}}
                <div class="mobile-quick-info">
                    <div class="quick-info-card">
                        <div class="quick-info-icon" style="background:#FEF3C7;">
                            <i class="fa-solid fa-tag" style="color:var(--primary-dark);"></i>
                        </div>
                        <div>
                            <div class="quick-info-label">Harga / 24 Jam</div>
                            <div class="quick-info-value">Rp {{ number_format($car->price_24h/1000,0) }}K</div>
                        </div>
                    </div>
                    <div class="quick-info-card">
                        <div class="quick-info-icon" style="background:#DBEAFE;">
                            <i class="fa-solid fa-chair" style="color:#1D4ED8;"></i>
                        </div>
                        <div>
                            <div class="quick-info-label">Kursi</div>
                            <div class="quick-info-value">{{ $car->seats }} Pnp</div>
                        </div>
                    </div>
                </div>

                {{-- Specifications --}}
                <div class="card">
                    <div class="section-title"><i class="fa-solid fa-gauge-high"></i> Specifications</div>
                    <div class="specs-grid">
                        <div class="spec-item"><i class="fa-regular fa-calendar-check"></i><div class="spec-content"><div class="spec-label">Year</div><div class="spec-value">{{ $car->year }}</div></div></div>
                        <div class="spec-item"><i class="fa-solid fa-chair"></i><div class="spec-content"><div class="spec-label">Seats</div><div class="spec-value">{{ $car->seats }}</div></div></div>
                        <div class="spec-item"><i class="fa-solid fa-gears"></i><div class="spec-content"><div class="spec-label">Trans</div><div class="spec-value">{{ ucfirst($car->transmission) }}</div></div></div>
                        <div class="spec-item"><i class="fa-solid fa-gas-pump"></i><div class="spec-content"><div class="spec-label">Fuel</div><div class="spec-value">{{ $car->fuel_type }}</div></div></div>
                    </div>
                    <div class="divider"></div>
                    <div class="features-grid">
                        <div class="feature-item"><i class="fa-solid fa-snowflake"></i><span>Air Conditioner</span></div>
                        <div class="feature-item"><i class="fa-solid fa-shield-halved"></i><span>Safety Features</span></div>
                        <div class="feature-item"><i class="fa-brands fa-bluetooth-b"></i><span>Bluetooth</span></div>
                        <div class="feature-item"><i class="fa-solid fa-camera"></i><span>Camera</span></div>
                    </div>
                </div>

                {{-- Related Cars --}}
                @if ($relatedCars->count() > 0)
                    <div style="margin-top:0.5rem;">
                        <h2 style="font-size:1.5rem;font-weight:800;margin-bottom:1.5rem;color:var(--dark);">Rekomendasi Mobil</h2>
                        <div class="related-grid">
                            @foreach ($relatedCars as $rc)
                                <div class="related-card">
                                    <div class="related-image">
                                        @if ($rc->images->first())
                                            <img src="{{ asset('storage/'.$rc->images->first()->image_path) }}" alt="{{ $rc->name }}">
                                        @else
                                            <div style="display:flex;align-items:center;justify-content:center;height:100%;background:#000;"><i class="fa-solid fa-car" style="font-size:2.5rem;color:#666;"></i></div>
                                        @endif
                                    </div>
                                    <div class="related-content">
                                        <div class="related-brand">{{ $rc->brand }}</div>
                                        <div class="related-name">{{ $rc->name }}</div>
                                        <div class="related-price">
                                            <span class="related-price-label">24 Hours</span>
                                            <span class="related-price-value">Rp {{ number_format($rc->price_24h/1000,0) }}K</span>
                                        </div>
                                        <a href="{{ route('cars.show', $rc) }}" class="btn btn-primary" style="padding:0.625rem 1rem;font-size:0.8125rem;">View Details</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>{{-- /left --}}

            {{-- RIGHT COLUMN — Desktop only --}}
            <div>
                <div class="price-card">
                    <div id="rentalPriceSectionDesktop">
                        <h3>Rental Price</h3>
                        <div class="price-option featured active" data-duration="24" data-price="{{ $car->price_24h }}"
                             onclick="selectPrice(this,'24',{{ $car->price_24h }})">
                            <div class="price-option-header"><span class="price-option-label">24 Hours</span><span class="badge badge-premium" style="font-size:0.625rem;">BEST</span></div>
                            <div class="price-option-value">Rp {{ number_format($car->price_24h,0,',','.') }}</div>
                        </div>
                        <div class="price-option" data-duration="12" data-price="{{ $car->price_24h * 0.7 }}"
                             onclick="selectPrice(this,'12',{{ $car->price_24h * 0.7 }})">
                            <div class="price-option-header"><span class="price-option-label">12 Hours</span></div>
                            <div class="price-option-value">Rp {{ number_format($car->price_24h*0.7,0,',','.') }}</div>
                        </div>
                    </div>
                    {{-- Rental Type (desktop duplicate) --}}
                    <div class="rental-type-selector">
                        <div class="rental-type-options">
                            <div class="rental-type-card active" data-type="lepas_kunci" onclick="selectRentalType('lepas_kunci')">
                                <div class="rental-type-check"><i class="fa-solid fa-check"></i></div>
                                <div class="rental-type-icon"><i class="fa-solid fa-key"></i></div>
                                <div class="rental-type-title">Lepas Kunci</div>
                                <div class="rental-type-desc">Sewa mobil tanpa sopir. Anda yang mengemudi.</div>
                            </div>
                            <div class="rental-type-card" data-type="carter" onclick="selectRentalType('carter')">
                                <div class="rental-type-check"><i class="fa-solid fa-check"></i></div>
                                <div class="rental-type-icon"><i class="fa-solid fa-user-tie"></i></div>
                                <div class="rental-type-title">Carter</div>
                                <div class="rental-type-desc">Full service dengan sopir profesional.</div>
                            </div>
                        </div>
                    </div>
                    <div class="inline-check-availability" id="availabilitySectionDesktop">
                        <div class="section-title"><i class="fa-solid fa-calendar-check"></i> Check Availability</div>
                        <div id="inputs24hDesktop" class="date-picker">
                            <div class="date-field"><label>Start Date</label><input type="date" id="startDateDesktop" min="{{ date('Y-m-d') }}"></div>
                            <div class="date-field"><label>End Date</label><input type="date" id="endDateDesktop" min="{{ date('Y-m-d') }}"></div>
                        </div>
                        <div id="inputs12hDesktop" class="date-picker-12h">
                            <div class="date-field"><label>Date</label><input type="date" id="startDate12Desktop" min="{{ date('Y-m-d') }}"></div>
                            <div class="date-field"><label>Start Time</label><input type="time" id="startTimeDesktop" value="09:00"></div>
                            <div class="date-field"><label>End Time</label><input type="time" id="endTimeDesktop" value="21:00" readonly style="opacity:0.5;cursor:not-allowed;"></div>
                        </div>
                        <div style="margin-top:1rem;">
                            <div class="calendar-nav">
                                <button id="prevMonthDesktop"><i class="fa-solid fa-chevron-left"></i></button>
                                <h4 id="currentMonthDesktop" style="color:white;"></h4>
                                <button id="nextMonthDesktop"><i class="fa-solid fa-chevron-right"></i></button>
                            </div>
                            <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:0.375rem;margin-bottom:0.5rem;">
                                <div class="calendar-day-header">Sun</div><div class="calendar-day-header">Mon</div>
                                <div class="calendar-day-header">Tue</div><div class="calendar-day-header">Wed</div>
                                <div class="calendar-day-header">Thu</div><div class="calendar-day-header">Fri</div>
                                <div class="calendar-day-header">Sat</div>
                            </div>
                            <div class="calendar-grid" id="calendarGridDesktop"></div>
                            <div class="calendar-legend" style="border-top:1px solid rgba(255,255,255,0.1);padding-top:0.75rem;">
                                <div class="legend-item" style="color:rgba(255,255,255,0.7);font-size:0.75rem;"><div class="legend-dot" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.2);"></div> Tersedia</div>
                                <div class="legend-item" style="color:rgba(255,255,255,0.7);font-size:0.75rem;"><div class="legend-dot" style="background:rgba(239,68,68,0.2);"></div> Booked</div>
                                <div class="legend-item" style="color:rgba(255,255,255,0.7);font-size:0.75rem;"><div class="legend-dot" style="background:rgba(16,185,129,0.25);"></div> Dipilih</div>
                            </div>
                            <button style="margin-top:1rem;" type="button" id="checkAvailabilityDesktop" class="btn btn-primary">
                                <i class="fa-solid fa-search"></i> Check Availability
                            </button>
                        </div>
                        <div class="price-estimate" id="priceEstimateBoxDesktop">
                            <div class="price-estimate-header"><span><i class="fa-solid fa-check-circle"></i> Available!</span><span id="rentalDurationDesktop"></span></div>
                            <div class="price-row"><span>Base Price:</span><span id="basePriceDesktop" style="font-weight:600;">Rp 0</span></div>
                            <div class="price-row"><span>Service:</span><span id="serviceChargeDesktop" style="font-weight:600;">Rp 0</span></div>
                            <div class="price-row total"><span>Total:</span><span id="totalPriceDesktop">Rp 0</span></div>
                            <div style="font-size:0.75rem;color:#34d399;margin-top:0.375rem;">Min. DP: <span id="minDepositDesktop" style="font-weight:600;">Rp 0</span></div>
                            <a href="{{ route('bookings.select-dates') }}" id="bookNowBtnDesktop" class="btn btn-success" style="margin-top:0.75rem;">
                                <i class="fa-solid fa-calendar-check"></i> Book Now
                            </a>
                        </div>
                    </div>
                    <a href="#" id="whatsappBtnDesktop" class="btn btn-whatsapp" style="margin-top:1rem;display:none;">
                        <i class="fa-brands fa-whatsapp"></i> Order via WhatsApp
                    </a>
                    <a href="https://wa.me/6281234567890?text=Hi, I'm interested in {{ $car->brand }} {{ $car->name }}" class="btn btn-secondary" style="margin-top:1rem;">
                        <i class="fa-brands fa-whatsapp"></i> Contact Us
                    </a>
                    <div class="price-info" style="text-align:center;"><i class="fa-solid fa-info-circle"></i> Minimum 30% deposit required</div>
                    <div class="price-features">
                        @foreach (['Free delivery','Well maintained','24/7 support','Easy booking'] as $feat)
                            <div class="price-feature"><i class="fa-solid fa-check"></i><span>{{ $feat }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>{{-- /main-grid --}}
    </div>{{-- /container --}}

    {{-- REVIEWS --}}
    @if (isset($carReviews) && $carReviews->count() > 0)
        <section class="py-12 bg-slate-50" style="margin-top:1rem;">
            <div style="max-width:1200px;margin:0 auto;padding:0 1rem;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
                    <h3 style="font-size:1.25rem;font-weight:700;">Ulasan untuk {{ $car->brand }} {{ $car->name }}</h3>
                    <a href="{{ route('reviews.create') }}" style="color:var(--primary);font-weight:600;font-size:0.875rem;text-decoration:none;">Tambah Ulasan</a>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem;">
                    @foreach ($carReviews as $review)
                        <div style="background:white;border-radius:16px;padding:1rem;border:1px solid var(--border);box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                            @if ($review->image_path)
                                <img src="{{ asset('storage/'.$review->image_path) }}" style="width:100%;height:9rem;object-fit:cover;border-radius:10px;margin-bottom:0.75rem;" alt="Review">
                            @endif
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.5rem;">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <div style="width:36px;height:36px;background:var(--primary-light);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <i class="fa-solid fa-user" style="color:var(--primary-dark);font-size:0.875rem;"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight:700;font-size:0.875rem;">{{ $review->booking->user->name ?? 'Pelanggan' }}</div>
                                        <div style="font-size:0.75rem;color:var(--gray);">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div style="font-size:0.875rem;font-weight:700;color:var(--primary);">{{ $review->rating }}/5 <i class="fa-solid fa-star" style="font-size:0.75rem;"></i></div>
                            </div>
                            <p style="font-size:0.875rem;color:var(--gray);line-height:1.6;">{{ $review->comment ?? 'Pelanggan puas.' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <script>
        // ─── CONSTANTS ───────────────────────────────────────────────
        const carId   = {{ $car->id }};
        const csrf    = document.querySelector('meta[name="csrf-token"]').content;
        const carName = "{{ $car->brand }} {{ $car->name }}";
        const MONTHS  = ["January","February","March","April","May","June","July","August","September","October","November","December"];

        // ─── STATE ───────────────────────────────────────────────────
        let bookedDates = @json(
            $car->bookings->map(function ($b) {
                $dates = [];
                $start = \Carbon\Carbon::parse($b->start_datetime);
                $end   = \Carbon\Carbon::parse($b->end_datetime);
                while ($start <= $end) {
                    $dates[] = $start->format('Y-m-d');
                    $start->addDay();
                }
                return $dates;
            })->flatten()->unique()->values()
        );

        let bookingDetailsMap  = {};
        let selectedStartDate  = null;
        let selectedEndDate    = null;
        let currentDurationMode = '24';
        let mainCalDate        = new Date();
        let desktopCalDate     = new Date();

        // ─── HELPERS ─────────────────────────────────────────────────
        function pad2(n){ return String(n).padStart(2,'0'); }
        function formatRp(n){ return 'Rp '+new Intl.NumberFormat('id-ID').format(n); }
        function fmtDate(str){ const[y,m,d]=str.split('-'); return `${parseInt(d)} ${MONTHS[parseInt(m)-1]}`; }

        function calculateEndDateTime(dateStr, timeStr){
            const[y,mo,d]=dateStr.split('-').map(Number);
            const[h,mi]=timeStr.split(':').map(Number);
            const dt=new Date(y,mo-1,d,h,mi);
            dt.setTime(dt.getTime()+12*3600000);
            return{date:`${dt.getFullYear()}-${pad2(dt.getMonth()+1)}-${pad2(dt.getDate())}`,time:`${pad2(dt.getHours())}:${pad2(dt.getMinutes())}`};
        }

        function getBookedInRange(start,end){
            const out=[]; let cur=new Date(start);
            while(cur<=new Date(end)){
                const s=`${cur.getFullYear()}-${pad2(cur.getMonth()+1)}-${pad2(cur.getDate())}`;
                if(bookedDates.includes(s)) out.push(s);
                cur.setDate(cur.getDate()+1);
            }
            return out;
        }

        // ─── ALERT ───────────────────────────────────────────────────
        function showAlert(msg){ alert(msg); }

        // ─── PRICE SELECT ─────────────────────────────────────────────
        function selectPrice(el, dur, price){
            currentDurationMode = dur;
            document.querySelectorAll('.price-option').forEach(o=>{
                o.classList.remove('active','featured');
            });
            el.classList.add('active');
            if(dur==='24') el.classList.add('featured');

            // Toggle inputs mobile
            const i24=document.getElementById('inputs24h');
            const i12=document.getElementById('inputs12h');
            // Toggle inputs desktop
            const i24d=document.getElementById('inputs24hDesktop');
            const i12d=document.getElementById('inputs12hDesktop');

            if(dur==='12'){
                [i24,i24d].forEach(el=>{ if(el){ el.style.display='none'; } });
                [i12,i12d].forEach(el=>{ if(el){ el.style.display='grid'; } });
                ['startTime','startTimeDesktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value='09:00'; });
                ['endTime','endTimeDesktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value='21:00'; });
                const ex=document.getElementById('startDate')?.value||document.getElementById('startDateDesktop')?.value;
                if(ex){
                    ['startDate12','startDate12Desktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value=ex; });
                    selectedStartDate=ex; selectedEndDate=ex;
                } else { selectedStartDate=null; selectedEndDate=null; }
            } else {
                [i12,i12d].forEach(el=>{ if(el){ el.style.display='none'; } });
                [i24,i24d].forEach(el=>{ if(el){ el.style.display='grid'; } });
                const ex12=document.getElementById('startDate12')?.value||document.getElementById('startDate12Desktop')?.value;
                if(ex12){
                    ['startDate','startDateDesktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value=ex12; });
                    selectedStartDate=ex12; selectedEndDate=null;
                }
            }
            ['priceEstimateBox','priceEstimateBoxDesktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.classList.remove('show'); });
            renderCalendar('mobile'); renderCalendar('desktop');
        }

        // ─── RENTAL TYPE ─────────────────────────────────────────────
        function selectRentalType(type){
            document.querySelectorAll('.rental-type-card').forEach(c=>c.classList.remove('active'));
            document.querySelectorAll(`.rental-type-card[data-type="${type}"]`).forEach(c=>c.classList.add('active'));

            const avail =document.getElementById('availabilitySection');
            const availD=document.getElementById('availabilitySectionDesktop');
            const wa    =document.getElementById('whatsappBtn');
            const waD   =document.getElementById('whatsappBtnDesktop');
            const prS   =document.getElementById('mobilePriceSection');
            const prSD  =document.getElementById('rentalPriceSectionDesktop');

            if(type==='lepas_kunci'){
                [avail,availD].forEach(el=>{ if(el) el.style.display='block'; });
                [wa,waD].forEach(el=>{ if(el) el.style.display='none'; });
                [prS,prSD].forEach(el=>{ if(el) el.style.display='block'; });
            } else {
                [avail,availD].forEach(el=>{ if(el) el.style.display='none'; });
                [wa,waD].forEach(el=>{
                    if(el){ el.style.display='flex'; el.href=`https://wa.me/6281234567890?text=${encodeURIComponent('Halo, saya tertarik untuk carter '+carName)}`; }
                });
                [prS,prSD].forEach(el=>{ if(el) el.style.display='none'; });
            }
        }

        // ─── SYNC ─────────────────────────────────────────────────────
        function syncInputs(){
            if(currentDurationMode==='24'){
                ['startDate','startDateDesktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value=selectedStartDate||''; });
                ['endDate','endDateDesktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value=selectedEndDate||''; });
            } else {
                ['startDate12','startDate12Desktop'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value=selectedStartDate||''; });
            }
            renderCalendar('mobile'); renderCalendar('desktop');
        }

        // ─── SELECT DATE ─────────────────────────────────────────────
        function selectDate(str){
            if(currentDurationMode==='12'){
                selectedStartDate=str; selectedEndDate=str;
            } else {
                if(!selectedStartDate||(selectedStartDate&&selectedEndDate)){
                    selectedStartDate=str; selectedEndDate=null;
                } else {
                    let s=selectedStartDate, e=str;
                    if(str<selectedStartDate){ s=str; e=selectedStartDate; }
                    else if(str===selectedStartDate){ selectedStartDate=null; selectedEndDate=null; syncInputs(); return; }
                    const conf=getBookedInRange(s,e);
                    if(conf.length){ showAlert('Tanggal '+conf.map(fmtDate).join(', ')+' sudah dibooking.'); selectedStartDate=null; selectedEndDate=null; syncInputs(); return; }
                    selectedStartDate=s; selectedEndDate=e;
                }
            }
            syncInputs();
        }

        // ─── CALENDAR ─────────────────────────────────────────────────
        async function loadBookingDetails(year,month){
            try {
                const r=await fetch(`/api/cars/${carId}/booked-dates?year=${year}&month=${month}`);
                const d=await r.json();
                if(d.booked_dates) bookedDates=d.booked_dates;
                if(d.booking_details) bookingDetailsMap=d.booking_details;
            } catch(e){ console.error(e); }
        }

        async function renderCalendar(which){
            const isMobile = which==='mobile';
            const calRef   = isMobile ? mainCalDate : desktopCalDate;
            const gridId   = isMobile ? 'calendarGrid' : 'calendarGridDesktop';
            const monthId  = isMobile ? 'currentMonth' : 'currentMonthDesktop';

            const y=calRef.getFullYear(), m=calRef.getMonth();
            const monthEl=document.getElementById(monthId);
            if(monthEl) monthEl.textContent=`${MONTHS[m]} ${y}`;

            await loadBookingDetails(y, m+1);

            const firstDay=new Date(y,m,1).getDay();
            const daysInMonth=new Date(y,m+1,0).getDate();
            const today=new Date(); today.setHours(0,0,0,0);
            let html='';

            for(let i=0;i<firstDay;i++) html+='<div class="calendar-day"></div>';

            for(let day=1;day<=daysInMonth;day++){
                const dt=new Date(y,m,day);
                const str=`${y}-${pad2(m+1)}-${pad2(day)}`;
                const isBooked=bookedDates.includes(str);
                const isPast=dt<today;
                const isToday=dt.getTime()===today.getTime();

                let cls='calendar-day';
                if(isPast) cls+=' past';
                else if(isBooked) cls+=' booked';
                else cls+=' available';
                if(isToday) cls+=' today';
                if(selectedStartDate===str) cls+=' selected-start';
                if(selectedEndDate===str) cls+=' selected-end';
                if(currentDurationMode==='24'&&selectedStartDate&&selectedEndDate&&str>selectedStartDate&&str<selectedEndDate) cls+=' selected-range';

                const onclick=(!isPast&&!isBooked)?`onclick="selectDate('${str}')"`:'';
                const tip=isBooked?`onmouseover="showBookingTooltip('${str}',this)" onmouseout="hideBookingTooltip()"`:'';
                html+=`<div class="${cls}" ${onclick} ${tip}>${day}</div>`;
            }

            const grid=document.getElementById(gridId);
            if(grid) grid.innerHTML=html;
        }

        // ─── CHECK AVAILABILITY ──────────────────────────────────────
        async function doCheckAvail(prefix){
            const isMobile = prefix==='';
            let startDate, endDate, startTime, endTime;

            if(currentDurationMode==='12'){
                const d=document.getElementById('startDate12'+(isMobile?'':'Desktop'))?.value;
                const t=document.getElementById('startTime'+(isMobile?'':'Desktop'))?.value;
                if(!d||!t){ showAlert('Pilih tanggal dan waktu.'); return; }
                const ec=calculateEndDateTime(d,t);
                startDate=d; startTime=t; endDate=ec.date; endTime=ec.time;
            } else {
                startDate=document.getElementById('startDate'+(isMobile?'':'Desktop'))?.value;
                endDate  =document.getElementById('endDate'  +(isMobile?'':'Desktop'))?.value;
                if(!startDate||!endDate){ showAlert('Pilih tanggal mulai dan selesai.'); return; }
            }

            const conf=getBookedInRange(startDate,endDate);
            if(conf.length){ showAlert('Tanggal '+conf.map(fmtDate).join(', ')+' sudah dibooking.'); return; }

            const btn=document.getElementById('checkAvailability'+(isMobile?'':'Desktop'));
            const orig=btn.innerHTML;
            btn.disabled=true; btn.innerHTML='<span class="spinner"></span> Checking...';

            const payload={start_date:startDate,end_date:endDate,service_type:'lepas_kunci',duration_mode:currentDurationMode};
            if(currentDurationMode==='12'){ payload.start_time=startTime; payload.end_time=endTime; payload.start_datetime=`${startDate} ${startTime}`; payload.end_datetime=`${endDate} ${endTime}`; }
            else { payload.start_datetime=`${startDate} 00:00`; payload.end_datetime=`${endDate} 23:59`; }

            try {
                const [avRes,prRes]=await Promise.all([
                    fetch(`/api/cars/${carId}/check-availability`,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},body:JSON.stringify(payload)}),
                    fetch(`/api/cars/${carId}/price-estimate`,    {method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},body:JSON.stringify(payload)}),
                ]);
                const av=await avRes.json();
                if(!av.available){ showAlert(av.message||'Mobil tidak tersedia.'); btn.disabled=false; btn.innerHTML=orig; return; }
                const pr=await prRes.json();

                const sfx=isMobile?'':'Desktop';
                document.getElementById('rentalDuration'+sfx).textContent=`${pr.days} hari`;
                document.getElementById('basePrice'+sfx).textContent    =formatRp(pr.base_price);
                document.getElementById('serviceCharge'+sfx).textContent=formatRp(pr.service_charge);
                document.getElementById('totalPrice'+sfx).textContent   =formatRp(pr.total_price);
                document.getElementById('minDeposit'+sfx).textContent   =formatRp(pr.min_deposit);

                const bBtn=document.getElementById('bookNowBtn'+sfx);
                const url=new URL(bBtn.href);
                Object.entries({start:payload.start_datetime,end:payload.end_datetime,mode:currentDurationMode,base_price:pr.base_price,total_price:pr.total_price,min_deposit:pr.min_deposit,days:pr.days})
                    .forEach(([k,v])=>url.searchParams.set(k,v));
                bBtn.href=url.toString();

                const box=document.getElementById('priceEstimateBox'+sfx);
                box.classList.add('show');
                box.scrollIntoView({behavior:'smooth',block:'nearest'});

            } catch(e){ console.error(e); showAlert('Terjadi kesalahan. Silakan coba lagi.'); }
            finally { btn.disabled=false; btn.innerHTML=orig; }
        }

        document.getElementById('checkAvailability').addEventListener('click', ()=>doCheckAvail(''));
        document.getElementById('checkAvailabilityDesktop').addEventListener('click', ()=>doCheckAvail('Desktop'));

        // ─── DATE INPUT SYNC ─────────────────────────────────────────
        ['startDate','startDateDesktop'].forEach(id=>{
            document.getElementById(id)?.addEventListener('change',function(){ selectedStartDate=this.value||null; syncInputs(); });
        });
        ['endDate','endDateDesktop'].forEach(id=>{
            document.getElementById(id)?.addEventListener('change',function(){ selectedEndDate=this.value||null; syncInputs(); });
        });
        ['startDate12','startDate12Desktop'].forEach(id=>{
            document.getElementById(id)?.addEventListener('change',function(){ selectedStartDate=selectedEndDate=this.value||null; syncInputs(); });
        });
        ['startTime','startTimeDesktop'].forEach(id=>{
            document.getElementById(id)?.addEventListener('change',function(){
                const d=document.getElementById(id==='startTime'?'startDate12':'startDate12Desktop')?.value;
                if(d){
                    const ec=calculateEndDateTime(d,this.value);
                    const etId=id==='startTime'?'endTime':'endTimeDesktop';
                    const el=document.getElementById(etId); if(el) el.value=ec.time;
                }
            });
        });

        // ─── CALENDAR NAV ─────────────────────────────────────────────
        document.getElementById('prevMonth').addEventListener('click',()=>{ mainCalDate.setMonth(mainCalDate.getMonth()-1); renderCalendar('mobile'); });
        document.getElementById('nextMonth').addEventListener('click',()=>{ mainCalDate.setMonth(mainCalDate.getMonth()+1); renderCalendar('mobile'); });
        document.getElementById('prevMonthDesktop').addEventListener('click',()=>{ desktopCalDate.setMonth(desktopCalDate.getMonth()-1); renderCalendar('desktop'); });
        document.getElementById('nextMonthDesktop').addEventListener('click',()=>{ desktopCalDate.setMonth(desktopCalDate.getMonth()+1); renderCalendar('desktop'); });

        // ─── GALLERY ─────────────────────────────────────────────────
        function changeMainImage(src,thumb){
            document.querySelector('#mainImage img').src=src;
            document.querySelectorAll('.thumb').forEach(t=>t.classList.remove('active'));
            thumb.classList.add('active');
        }

        // ─── TOOLTIP ─────────────────────────────────────────────────
        const tooltip=document.getElementById('bookingTooltip');
        function showBookingTooltip(str,el){
            const b=bookingDetailsMap[str]; if(!b) return;
            const cls=b.status==='confirmed'?'background:linear-gradient(135deg,#DBEAFE,#BFDBFE);color:#1E40AF':'background:linear-gradient(135deg,#D1FAE5,#A7F3D0);color:#065F46';
            tooltip.innerHTML=`
                <div class="booking-tooltip-header">${b.booking_code}</div>
                <div class="booking-tooltip-row"><span class="booking-tooltip-label">Customer:</span><span>${b.user_name}</span></div>
                <div class="booking-tooltip-row"><span class="booking-tooltip-label">Status:</span><span style="display:inline-block;padding:0.2rem 0.5rem;border-radius:6px;font-size:0.6875rem;font-weight:700;${cls}">${b.status}</span></div>
                <div class="booking-tooltip-row"><span class="booking-tooltip-label">Period:</span><span>${b.start} – ${b.end}</span></div>`;
            const r=el.getBoundingClientRect();
            tooltip.style.left=r.left+r.width/2+'px';
            tooltip.style.top=(r.top+window.scrollY-10)+'px';
            tooltip.style.transform='translate(-50%,-100%)';
            tooltip.classList.add('show');
        }
        function hideBookingTooltip(){ tooltip.classList.remove('show'); }

        // ─── MOBILE SHEET ─────────────────────────────────────────────
        const sheet   = document.getElementById('mobileSheet');
        const overlay = document.getElementById('mobileSheetOverlay');

        document.getElementById('mobileOpenSheet').addEventListener('click',()=>{
            sheet.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow='hidden';
        });
        function closeMobileSheet(){
            sheet.classList.remove('open');
            overlay.classList.remove('show');
            document.body.style.overflow='';
        }
        // Swipe down to close
        let touchY=0;
        sheet.addEventListener('touchstart',e=>{ touchY=e.touches[0].clientY; },{passive:true});
        sheet.addEventListener('touchend',e=>{ if(e.changedTouches[0].clientY-touchY>80) closeMobileSheet(); },{passive:true});

        // ─── LEAVE MODAL ─────────────────────────────────────────────
        (function(){
            let pUrl=null, ok=false;
            const mo=document.getElementById('leaveModal');
            const bx=document.getElementById('leaveModalBox');
            function show(url){ pUrl=url; mo.style.opacity='1'; mo.style.pointerEvents='auto'; bx.style.transform='scale(1)'; }
            function hide(){ mo.style.opacity='0'; mo.style.pointerEvents='none'; bx.style.transform='scale(0.9)'; pUrl=null; }

            // Path yang boleh langsung dilanjutkan tanpa konfirmasi
            const WHITELIST = ['bookings', 'login', 'register', 'logout', 'cars', 'wa.me', 'whatsapp'];
            function isWhitelisted(url){
                try {
                    const u = new URL(url, location.origin);
                    return WHITELIST.some(w => u.pathname.includes(w) || u.href.includes(w));
                } catch(e){ return false; }
            }

            document.getElementById('leaveCancelBtn').addEventListener('click',hide);
            mo.addEventListener('click',e=>{ if(e.target===mo) hide(); });
            document.getElementById('leaveConfirmBtn').addEventListener('click',()=>{ ok=true; hide(); pUrl?(window.location.href=pUrl):history.back(); });
            document.addEventListener('click',e=>{
                const a=e.target.closest('a[href]');
                if(!a||ok) return;
                const h=a.getAttribute('href');
                if(!h||h.startsWith('#')||h.startsWith('javascript')||a.target==='_blank') return;
                if(a.href===location.href) return;
                if(isWhitelisted(a.href)) return;
                e.preventDefault(); show(a.href);
            });
            history.pushState(null,'',location.href);
            window.addEventListener('popstate',()=>{ if(ok) return; history.pushState(null,'',location.href); show(null); });
        })();

        // ─── INIT ────────────────────────────────────────────────────
        renderCalendar('mobile');
        renderCalendar('desktop');
        selectRentalType('lepas_kunci');

    </script>

</x-app-layout>
