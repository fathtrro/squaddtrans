<x-app-layout>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* ══════════════════════════════════════
   TOKENS
══════════════════════════════════════ */
:root {
    --orange:      #f97316;
    --orange-dark: #ea6c0a;
    --orange-lt:   #fff7f0;
    --orange-dim:  rgba(249,115,22,0.1);

    --blue:        #0ea5e9;
    --blue-lt:     #f0f9ff;

    --green:       #16a34a;
    --green-lt:    #f0fdf4;
    --green-dim:   rgba(22,163,74,0.1);

    --red:         #dc2626;
    --red-lt:      #fff5f5;

    --text:        #111827;
    --text-2:      #374151;
    --muted:       #6b7280;
    --muted-lt:    #9ca3af;
    --border:      #e5e7eb;
    --border-dark: #d1d5db;
    --bg:          #f3f4f6;
    --surface:     #ffffff;

    --r:     10px;
    --r-sm:  6px;
    --r-lg:  14px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--text);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
}

/* ══════════════════════════════════════
   TOP NAV BAR (mobile app style)
══════════════════════════════════════ */
.top-bar {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 50;
    padding: 12px 16px;
}

.top-bar-inner {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 12px;
}

.back-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: transparent;
    border: none;
    cursor: pointer;
    color: var(--text);
    font-size: 15px;
    flex-shrink: 0;
    transition: background 0.15s;
    text-decoration: none;
}
.back-btn:hover { background: var(--bg); }

.top-bar-info {}

.top-bar-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--text);
    line-height: 1.2;
}

.top-bar-sub {
    font-size: 11px;
    color: var(--muted);
    margin-top: 2px;
}

/* ══════════════════════════════════════
   INCLUSIONS BANNER
══════════════════════════════════════ */
.inclusions-banner {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    padding: 14px 16px;
}

.inclusions-banner-inner {
    max-width: 1200px;
    margin: 0 auto;
}

.inclusions-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 10px;
}

.inclusions-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px 12px;
}

.inclusion-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    color: var(--text-2);
}

.inclusion-icon {
    width: 18px; height: 18px;
    border-radius: 50%;
    background: var(--green-lt);
    display: flex; align-items: center; justify-content: center;
    color: var(--green);
    font-size: 9px;
    flex-shrink: 0;
}

/* ══════════════════════════════════════
   MAIN LAYOUT
══════════════════════════════════════ */
.layout {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr;
    gap: 0;
}

@media (min-width: 1024px) {
    .layout {
        grid-template-columns: 280px 1fr;
        gap: 24px;
        padding: 24px 24px 40px;
        align-items: start;
    }
}

/* ══════════════════════════════════════
   SIDEBAR (desktop only)
══════════════════════════════════════ */
.sidebar {
    display: none;
    position: sticky;
    top: 76px;
}

@media (min-width: 1024px) { .sidebar { display: block; } }

.sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    margin-bottom: 16px;
}

.sidebar-head {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.sidebar-reset {
    font-size: 11px;
    font-weight: 500;
    color: var(--orange);
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
}

.filter-section {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
}

.filter-section:last-child { border-bottom: none; }

.filter-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 10px;
}

.filter-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.filter-opt {
    display: flex;
    align-items: center;
    gap: 9px;
    cursor: pointer;
    font-size: 13px;
    color: var(--text-2);
    padding: 6px 0;
    transition: color 0.15s;
}

.filter-opt:hover { color: var(--orange); }

.filter-opt input { accent-color: var(--orange); width: 15px; height: 15px; cursor: pointer; }

/* Sort select */
.sort-select {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid var(--border-dark);
    border-radius: var(--r-sm);
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    color: var(--text);
    background: var(--surface);
    cursor: pointer;
    outline: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='%236b7280' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 30px;
}

/* ══════════════════════════════════════
   CAR LIST AREA
══════════════════════════════════════ */
.car-list-area {
    padding: 12px 0 80px;
}

@media (min-width: 1024px) {
    .car-list-area { padding: 0 0 20px; }
}

/* ── Sort bar (mobile top, desktop hidden) ── */
.mobile-sort-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    overflow-x: auto;
    scrollbar-width: none;
}
.mobile-sort-bar::-webkit-scrollbar { display: none; }

@media (min-width: 1024px) { .mobile-sort-bar { display: none; } }

.sort-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 99px;
    border: 1.5px solid var(--border-dark);
    font-size: 12px;
    font-weight: 500;
    color: var(--text-2);
    background: var(--surface);
    white-space: nowrap;
    cursor: pointer;
    transition: all 0.15s;
    flex-shrink: 0;
}

.sort-chip.active, .sort-chip:hover {
    border-color: var(--orange);
    color: var(--orange);
    background: var(--orange-lt);
}

/* Results count */
.results-meta {
    padding: 12px 16px 8px;
    font-size: 12px;
    color: var(--muted);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

@media (min-width: 1024px) { .results-meta { padding: 0 0 12px; } }

.results-count { font-weight: 600; color: var(--text); }

/* ══════════════════════════════════════
   CAR CARD (horizontal Traveloka style)
══════════════════════════════════════ */
.car-card {
    background: var(--surface);
    border: 1px solid var(--border);
    position: relative;
    animation: cardFadeIn 0.35s ease both;
    margin: 0 16px 10px 16px;
    border-radius: var(--r-sm);
}

@media (min-width: 640px) {
    .car-card {
        margin: 0 0 12px 0;
        border: 1px solid var(--border);
        border-radius: var(--r-sm);
    }
}

@media (min-width: 1024px) {
    .car-card {
        border: 1px solid var(--border);
        border-radius: var(--r-lg);
        margin-bottom: 14px;
        overflow: hidden;
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .car-card:hover {
        border-color: var(--orange);
        box-shadow: 0 4px 20px rgba(249,115,22,0.1);
    }
}

@keyframes cardFadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Discount badge ribbon */
.discount-badge {
    position: absolute;
    top: 14px; right: 0;
    background: var(--red);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 5px 10px 5px 12px;
    clip-path: polygon(8px 0%, 100% 0%, 100% 100%, 8px 100%, 0% 50%);
    display: flex;
    align-items: center;
    gap: 5px;
    z-index: 2;
    white-space: nowrap;
}

/* Card inner */
.card-top {
    display: none;
}

.car-title {
    font-size: 15px;
    font-weight: 800;
    color: var(--text);
    letter-spacing: 0.01em;
    line-height: 1.2;
    margin-bottom: 8px;
    padding-right: 60px;
}

/* Image + specs row */
.card-mid {
    display: grid;
    grid-template-columns: 160px 1fr;
    gap: 12px;
    align-items: start;
    padding: 14px 16px;
}

.car-card {
    background: var(--surface);
    border: 1px solid var(--border);
    position: relative;
    animation: cardFadeIn 0.35s ease both;
    margin: 0 16px 10px 16px;
    border-radius: var(--r-sm);
    text-decoration: none;
    color: inherit;
    display: block;
}

.card-mid-link {
    text-decoration: none;
    color: inherit;
    display: contents;
}

.car-thumb {
    width: 160px;
    height: 150px;
    object-fit: cover;
    flex-shrink: 0;
    border-radius: var(--r-sm);
    background: #f9fafb;
}

.car-specs-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.spec-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px 12px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    color: var(--text-2);
}

.spec-item i {
    color: var(--muted);
    font-size: 11px;
    width: 12px;
    text-align: center;
    flex-shrink: 0;
}

/* Age tag - hidden */
.age-tag { display: none; }

/* ── Card Bottom: pricing + CTA ── */
.card-bottom {
    border-top: 1px solid var(--border);
    padding-top: 10px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
}

.price-col {}

.price-original {
    font-size: 11px;
    color: var(--muted-lt);
    text-decoration: line-through;
    margin-bottom: 1px;
}

.price-main {
    font-size: 15px;
    font-weight: 800;
    color: var(--orange);
    line-height: 1.2;
}

.price-per {
    font-size: 11px;
    color: var(--muted);
    margin-top: 2px;
    font-weight: 500;
}

.price-decimal {
    font-size: 13px;
    font-weight: 600;
}

.select-btn {
    padding: 8px 14px;
    background: var(--orange);
    color: #fff;
    border: none;
    border-radius: var(--r-sm);
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
    transition: background 0.15s, transform 0.15s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    flex-shrink: 0;
}

.select-btn:hover { background: var(--orange-dark); transform: scale(1.02); }
.select-btn:active { transform: scale(0.98); }
.select-btn:disabled {
    background: var(--border-dark);
    color: var(--muted);
    cursor: not-allowed;
    transform: none;
}

/* ── Urgency banner (Tersisa 1 lagi!) ── */
.urgency-banner {
    background: var(--orange);
    color: #fff;
    padding: 11px 16px;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.urgency-banner i { font-size: 13px; }

/* ── Unavailable overlay ── */
.car-card.unavailable { opacity: 0.55; pointer-events: none; }

.booked-banner {
    background: #f3f4f6;
    border: 1px dashed var(--border-dark);
    border-radius: var(--r-sm);
    padding: 8px 14px;
    font-size: 12px;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ══════════════════════════════════════
   SECTION DIVIDER (Sudah Dipesan)
══════════════════════════════════════ */
.section-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 16px;
    margin: 6px 16px 0;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
}

@media (min-width: 640px) {
    .section-divider { padding: 14px 0; margin: 8px 0 0; }
}

@media (min-width: 1024px) { .section-divider { padding: 14px 0; } }

.div-line { flex: 1; height: 1px; background: var(--border); }

/* ══════════════════════════════════════
   EMPTY / LOADING STATE
══════════════════════════════════════ */
.state-box {
    text-align: center;
    padding: 4rem 1.5rem;
    background: var(--surface);
}

@media (min-width: 1024px) {
    .state-box {
        border: 1px solid var(--border);
        border-radius: var(--r-lg);
    }
}

.state-icon {
    font-size: 2.5rem;
    color: var(--muted-lt);
    margin-bottom: 16px;
}

.state-title {
    font-size: 17px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 8px;
}

.state-text {
    font-size: 13px;
    color: var(--muted);
    line-height: 1.6;
    margin-bottom: 20px;
}

.state-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    border: 1.5px solid var(--orange);
    border-radius: var(--r-sm);
    color: var(--orange);
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    transition: background 0.15s;
}
.state-link:hover { background: var(--orange-lt); }

/* ══════════════════════════════════════
   BOTTOM FILTER BAR (mobile only)
══════════════════════════════════════ */
.bottom-bar {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: var(--surface);
    border-top: 1px solid var(--border);
    display: flex;
    z-index: 40;
    box-shadow: 0 -4px 16px rgba(0,0,0,0.08);
}

@media (min-width: 1024px) { .bottom-bar { display: none; } }

.bottom-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px;
    background: none;
    border: none;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-2);
    cursor: pointer;
    transition: color 0.15s;
}

.bottom-btn + .bottom-btn {
    border-left: 1px solid var(--border);
}

.bottom-btn:hover, .bottom-btn:active { color: var(--orange); }
.bottom-btn i { font-size: 14px; }

/* ══════════════════════════════════════
   MODAL (filter on mobile)
══════════════════════════════════════ */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    z-index: 100;
    display: none;
    align-items: flex-end;
}
.modal-overlay.open { display: flex; }

.modal-sheet {
    background: var(--surface);
    border-radius: 20px 20px 0 0;
    width: 100%;
    max-height: 85vh;
    overflow-y: auto;
    padding: 0 0 32px;
    animation: sheetUp 0.28s ease;
}

@keyframes sheetUp {
    from { transform: translateY(100%); }
    to   { transform: translateY(0); }
}

.modal-handle {
    width: 40px; height: 4px;
    border-radius: 99px;
    background: var(--border-dark);
    margin: 14px auto 16px;
}

.modal-title {
    font-size: 16px;
    font-weight: 700;
    padding: 0 20px 14px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-close {
    font-size: 18px;
    color: var(--muted);
    cursor: pointer;
    background: none;
    border: none;
    padding: 4px;
}

.modal-body {
    padding: 16px 20px;
}

.modal-filter-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 10px;
    margin-top: 14px;
}

.modal-filter-label:first-child { margin-top: 0; }

.chip-group {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 4px;
}

.filter-chip {
    padding: 7px 14px;
    border-radius: 99px;
    border: 1.5px solid var(--border-dark);
    font-size: 13px;
    font-weight: 500;
    color: var(--text-2);
    background: var(--surface);
    cursor: pointer;
    transition: all 0.15s;
}

.filter-chip.active, .filter-chip:hover {
    border-color: var(--orange);
    color: var(--orange);
    background: var(--orange-lt);
}

.apply-btn {
    width: 100%;
    padding: 14px;
    background: var(--orange);
    color: #fff;
    border: none;
    border-radius: var(--r);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 700;
    margin-top: 20px;
    cursor: pointer;
    transition: background 0.15s;
}
.apply-btn:hover { background: var(--orange-dark); }

/* ══════════════════════════════════════
   PAGINATION
══════════════════════════════════════ */
.pagination-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 20px 16px;
    margin-top: 20px;
}

@media (min-width: 1024px) {
    .pagination-container { padding: 20px 0; }
}

.pagination-btn {
    width: 36px;
    height: 36px;
    border-radius: var(--r-sm);
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--text);
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pagination-btn:hover:not(:disabled) {
    border-color: var(--orange);
    color: var(--orange);
}

.pagination-btn.active {
    background: var(--orange);
    color: #fff;
    border-color: var(--orange);
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-info {
    font-size: 12px;
    color: var(--muted);
    margin: 0 6px;
}
.desktop-inclusions { display: none; }
@media (min-width: 1024px) {
    .desktop-inclusions { display: block; }
    .mobile-inclusions  { display: none; }
}

/* Hapus footer di halaman ini */
footer { display: none !important; }
</style>

{{-- ─── TOP NAV BAR ─────────────────────────── --}}
<div class="top-bar">
    <div class="top-bar-inner">
        <a href="{{ route('dashboard') }}" class="back-btn"><i class="fas fa-arrow-left"></i></a>
        <div class="top-bar-info">
            <div class="top-bar-title" id="navTitle">Rental Mobil</div>
            <div class="top-bar-sub" id="navSub">Memuat...</div>
        </div>
    </div>
</div>

{{-- ─── INCLUSIONS BANNER (mobile) ─────────────────────────── --}}
<div class="inclusions-banner mobile-inclusions">
    <div class="inclusions-banner-inner">
        <div class="inclusions-title">Semua kendaraan sudah termasuk</div>
        <div class="inclusions-grid">
            <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Layanan darurat 24 jam</div>
            <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Asuransi comprehensive</div>
            <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Bisa refund (Ketentuan Berlaku)</div>
            <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Mobil pengganti jika dibutuhkan</div>
        </div>
    </div>
</div>

{{-- ─── INCOMPLETE BOOKING WARNING ─────────────────────────── --}}
@if(isset($incompleteBooking) && $incompleteBooking)
    <div style="padding: 16px; max-width: 1200px; margin: 0 auto;">
        <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 1.5px solid #f59e0b; border-radius: var(--r-lg); padding: 16px; box-shadow: 0 4px 6px rgba(245, 158, 11, 0.1);">
            <div style="display: flex; align-items: flex-start; gap: 14px;">
                <div style="flex-shrink: 0; color: #d97706;">
                    <i class="fas fa-exclamation-circle" style="font-size: 20px;"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 700; color: #92400e; font-size: 14px; margin-bottom: 4px;">Perhatian!</div>
                    <p style="font-size: 13px; color: #b45309; margin-bottom: 8px;"><strong>Anda belum menyelesaikan proses booking yang sebelumnya.</strong></p>
                    <p style="font-size: 12px; color: #a16207; margin-bottom: 8px;">
                        ID Booking: <span style="font-weight: 700;">{{ $incompleteBooking->booking_code }}</span> (Status: <span style="font-weight: 700; text-transform: uppercase;">{{ str_replace('_', ' ', $incompleteBooking->status) }}</span>)
                    </p>
                    <p style="font-size: 12px; color: #a16207;">Silakan selesaikan atau batalkan booking tersebut sebelum membuat booking baru.</p>
                </div>
                <a href="{{ route('bookings.index') }}" style="flex-shrink: 0; display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; background: #d97706; color: white; border-radius: var(--r-sm); text-decoration: none; font-weight: 600; font-size: 12px; white-space: nowrap; transition: background 0.15s;">
                    <i class="fas fa-clipboard-list"></i> Lihat
                </a>
            </div>
        </div>
    </div>
@endif

{{-- ─── MAIN LAYOUT ─────────────────────────── --}}
<div class="layout">

    {{-- ─── HERO SECTION WITH INFO ─────────────────────────── --}}
    <div style="grid-column: 1 / -1; padding: 0 16px 16px; max-width: 1200px; margin: 0 auto; width: 100%;">
        {{-- Hero Banner --}}
        <div style="background: linear-gradient(135deg, #f97316 0%, #ea6c0a 100%); border-radius: var(--r-lg); padding: 24px 20px; margin-bottom: 16px; overflow: hidden; position: relative;">
            <div style="position: absolute; inset: 0; background-image: linear-gradient(45deg, transparent 48%, rgba(255,255,255,0.05) 49%, rgba(255,255,255,0.05) 51%, transparent 52%); background-size: 16px 16px; z-index: 0;"></div>
            <div style="position: relative; z-index: 1;">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); padding: 6px 12px; border-radius: 99px; margin-bottom: 12px;">
                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);"></div>
                    <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(255,255,255,0.9);">Mobil Tersedia</span>
                </div>
                <h2 style="color: white; font-size: 24px; font-weight: 700; margin: 0 0 8px; line-height: 1.3;">Pilih Kendaraan Terbaik Anda</h2>
                <p style="color: rgba(255,255,255,0.8); font-size: 13px; margin: 0; max-width: 400px; line-height: 1.5;">Kendaraan premium terpilih yang sesuai dengan kebutuhan dan tanggal penyewaan Anda.</p>
            </div>
        </div>

        {{-- Info Box --}}
        <div style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 12px;">
                <div style="padding-bottom: 12px; border-bottom: 1px solid var(--border);">
                    <div style="font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); margin-bottom: 4px;">Mulai</div>
                    <div style="font-size: 13px; font-weight: 600; color: var(--text);" id="infStartDate">-</div>
                </div>
                <div style="padding-bottom: 12px; border-bottom: 1px solid var(--border);">
                    <div style="font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); margin-bottom: 4px;">Selesai</div>
                    <div style="font-size: 13px; font-weight: 600; color: var(--text);" id="infoEndDate">-</div>
                </div>
                <div style="padding-bottom: 12px; border-bottom: 1px solid var(--border);">
                    <div style="font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); margin-bottom: 4px;">Durasi</div>
                    <div style="font-size: 13px; font-weight: 600; color: var(--orange);" id="infoDuration">-</div>
                </div>
                <div style="padding-bottom: 12px; border-bottom: 1px solid var(--border);">
                    <div style="font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); margin-bottom: 4px;">Tersedia</div>
                    <div style="font-size: 13px; font-weight: 600; color: var(--text);" id="infoAvailable">-</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── SIDEBAR ─────────────────────────── --}}
    <aside class="sidebar">

        {{-- Inclusions (desktop) --}}
        <div class="sidebar-card desktop-inclusions">
            <div class="sidebar-head">Sudah Termasuk</div>
            <div style="padding:14px 16px">
                <div class="inclusions-grid" style="gap:8px 12px">
                    <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Layanan darurat 24 jam</div>
                    <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Asuransi comprehensive</div>
                    <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Bisa refund</div>
                    <div class="inclusion-item"><div class="inclusion-icon"><i class="fas fa-check"></i></div> Mobil pengganti</div>
                </div>
            </div>
        </div>

        {{-- Filter card --}}
        <div class="sidebar-card">
            <div class="sidebar-head">
                Filter
                <button class="sidebar-reset" onclick="resetFilters()">Reset</button>
            </div>
            <div class="filter-section">
                <div class="filter-label">Urutkan</div>
                <select class="sort-select" id="desktopSort" onchange="applyFilters()">
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                </select>
            </div>
            <div class="filter-section">
                <div class="filter-label">Transmisi</div>
                <div class="filter-options">
                    <label class="filter-opt"><input type="checkbox" value="Automatic" onchange="applyFilters()"> Automatic</label>
                    <label class="filter-opt"><input type="checkbox" value="Manual" onchange="applyFilters()"> Manual</label>
                </div>
            </div>
            <div class="filter-section">
                <div class="filter-label">Kapasitas Kursi</div>
                <div class="filter-options">
                    <label class="filter-opt"><input type="checkbox" value="4" onchange="applyFilters()"> 4 Kursi</label>
                    <label class="filter-opt"><input type="checkbox" value="5" onchange="applyFilters()"> 5 Kursi</label>
                    <label class="filter-opt"><input type="checkbox" value="6" onchange="applyFilters()"> 6 Kursi</label>
                    <label class="filter-opt"><input type="checkbox" value="7" onchange="applyFilters()"> 7+ Kursi</label>
                </div>
            </div>
        </div>

    </aside>

    {{-- ─── CAR LIST AREA ─────────────────────────── --}}
    <div class="car-list-area">

        {{-- Mobile sort chips --}}
        <div class="mobile-sort-bar">
            <button class="sort-chip active" onclick="setMobileSort('price_asc', this)"><i class="fas fa-sort-amount-up-alt"></i> Termurah</button>
            <button class="sort-chip" onclick="setMobileSort('price_desc', this)"><i class="fas fa-sort-amount-down"></i> Termahal</button>
        </div>

        {{-- Results meta --}}
        <div class="results-meta">
            <span id="resultsText">Memuat kendaraan...</span>
            <span id="durationText" style="font-size:11px;color:var(--muted)"></span>
        </div>

        {{-- Cars container --}}
        <div id="carsContainer">
            <div class="state-box">
                <div class="state-icon"><i class="fas fa-spinner fa-spin"></i></div>
                <div class="state-title">Menyiapkan Pilihan...</div>
                <p class="state-text">Kami sedang mencari kendaraan terbaik untuk Anda.</p>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination-container" id="paginationContainer" style="display: none;"></div>

    </div>
</div>

{{-- ─── BOTTOM FILTER BAR ─────────────────────────── --}}
<div class="bottom-bar">
    <button class="bottom-btn" onclick="openModal('sort')"><i class="fas fa-sort-amount-up-alt"></i> Urutkan</button>
    <button class="bottom-btn" onclick="openModal('filter')"><i class="fas fa-filter"></i> Filter</button>
</div>

{{-- ─── MOBILE BOTTOM SHEET ─────────────────────────── --}}
<div class="modal-overlay" id="mobileModal" onclick="closeModal(event)">
    <div class="modal-sheet" id="modalSheet">
        <div class="modal-handle"></div>
        <div class="modal-title">
            <span id="modalTitle">Filter</span>
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" id="modalBody"></div>
    </div>
</div>

<script>
/* ── Format rupiah Indonesia ── */
function formatRupiah(num) {
    return Math.floor(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

/* ── URL params ── */
const params    = new URLSearchParams(window.location.search);
let startDate = params.get('start_date');
let endDate   = params.get('end_date');
let startTime = params.get('start_time') || '00:00';
let endTime = params.get('end_time') || '00:00';

console.log('📅 URL Params:', { startDate, endDate, startTime, endTime });

// Jika parameter tidak ada, redirect ke dashboard
if (!startDate || !endDate) {
    console.error('❌ Parameter tanggal tidak ditemukan!');
    document.body.innerHTML = `
        <div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; background: #f3f4f6;">
            <div style="background: white; padding: 40px; border-radius: 12px; text-align: center; max-width: 400px;">
                <div style="font-size: 48px; margin-bottom: 20px;">⚠️</div>
                <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 10px; color: #111827;">Parameter Tidak Valid</h2>
                <p style="color: #6b7280; margin-bottom: 20px; font-size: 14px;">Silakan pilih tanggal perjalanan terlebih dahulu.</p>
                <a href="{{ route('dashboard') }}" style="display: inline-block; padding: 10px 24px; background: #f97316; color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">← Kembali ke Dashboard</a>
            </div>
        </div>
    `;
    throw new Error('Missing date parameters');
}

const fmt = s => new Intl.DateTimeFormat('id-ID', { day:'numeric', month:'short', year:'numeric' }).format(new Date(s));
const fmtWithTime = (dateStr, timeStr) => {
    const date = new Date(dateStr);
    const dateFormatted = new Intl.DateTimeFormat('id-ID', { day:'numeric', month:'short', year:'numeric' }).format(date);
    return `${dateFormatted} ${timeStr}`;
};

function getDuration() {
    return Math.round((new Date(endDate) - new Date(startDate)) / 86400000);
}

/* ── Fill nav bar and info box ── */
const dur = getDuration();
document.getElementById('navTitle').textContent = 'Rental Mobil';
document.getElementById('navSub').textContent   = `${fmtWithTime(startDate, startTime)} – ${fmtWithTime(endDate, endTime)} • ${dur} Hari • Lepas Kunci`;
document.getElementById('durationText').textContent = `${dur} Hari`;

// Fill info box dengan waktu
document.getElementById('infStartDate').textContent = fmtWithTime(startDate, startTime);
document.getElementById('infoEndDate').textContent = fmtWithTime(endDate, endTime);
document.getElementById('infoDuration').textContent = dur + ' Hari';

/* ── State ── */
let allCars      = [];
let sortMode     = 'price_asc';
let filterTrans  = [];
let filterSeats  = [];
let currentPage  = 1;
const itemsPerPage = 5;

/* ── Load ── */
async function loadCars() {
    try {
        const url = `/api/bookings/available-cars?start_date=${startDate}&end_date=${endDate}`;
        console.log('🚗 Fetching:', url);

        const res = await fetch(url);
        if (!res.ok) throw new Error(`HTTP ${res.status}: ${res.statusText}`);

        const data = await res.json();
        console.log('✅ Data berhasil diambil:', data);

        allCars = data.cars || [];
        console.log('📊 Total mobil:', allCars.length);

        renderCars();
    } catch (e) {
        console.error('❌ Error loading cars:', e);
        document.getElementById('carsContainer').innerHTML = `
            <div class="state-box">
                <div class="state-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="state-title">Gagal Memuat Data</div>
                <p class="state-text" style="color: #dc2626; font-weight: 600;">Error: ${e.message}</p>
                <p class="state-text">Silakan refresh halaman atau hubungi support.</p>
                <a href="{{ route('dashboard') }}" class="state-link"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>`;
    }
}

/* ── Render ── */
function renderCars() {
    const dur    = getDuration();
    let avail    = allCars.filter(c =>  c.is_available);
    let booked   = allCars.filter(c => !c.is_available);

    // Update available cars count
    document.getElementById('infoAvailable').textContent = avail.length + ' Unit';

    /* filter transmisi */
    if (filterTrans.length) {
        avail  = avail.filter(c => filterTrans.includes(c.transmission));
        booked = booked.filter(c => filterTrans.includes(c.transmission));
    }

    /* filter seats */
    if (filterSeats.length) {
        const fn = c => filterSeats.some(s => {
            if (s === '7') return (c.number_of_seats || 5) >= 7;
            return (c.number_of_seats || 5) == s;
        });
        avail  = avail.filter(fn);
        booked = booked.filter(fn);
    }

    /* sort */
    const sortFn = {
        price_asc:  (a,b) => (a.daily_rent_price||0) - (b.daily_rent_price||0),
        price_desc: (a,b) => (b.daily_rent_price||0) - (a.daily_rent_price||0),
    }[sortMode] || (() => 0);

    avail.sort(sortFn);

    document.getElementById('resultsText').innerHTML =
        `<span class="results-count">${avail.length} kendaraan</span> ditemukan`;

    if (!allCars.length) {
        document.getElementById('carsContainer').innerHTML = `
            <div class="state-box">
                <div class="state-icon"><i class="fas fa-search"></i></div>
                <div class="state-title">Tidak Ada Kendaraan</div>
                <p class="state-text">Tidak ada mobil tersedia untuk tanggal ini. Coba ubah tanggal perjalanan Anda.</p>
                <a href="{{ route('dashboard') }}" class="state-link"><i class="fas fa-arrow-left"></i> Ubah Tanggal</a>
            </div>`;
        document.getElementById('paginationContainer').style.display = 'none';
        return;
    }

    /* Pagination */
    const totalAvail = avail.length;
    const totalPages = Math.ceil(totalAvail / itemsPerPage);
    currentPage = Math.min(currentPage, totalPages) || 1;

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedAvail = avail.slice(start, end);

    let html = paginatedAvail.map((car, i) => buildCard(car, true, dur, start + i)).join('');

    /* Show booked only on last page or if few items */
    if (currentPage === totalPages || totalAvail < itemsPerPage) {
        if (booked.length) {
            html += `<div class="section-divider"><div class="div-line"></div><span>Sudah Dipesan</span><div class="div-line"></div></div>`;
            html += booked.map((car, i) => buildCard(car, false, dur, totalAvail + i)).join('');
        }
    }

    document.getElementById('carsContainer').innerHTML = html;

    /* Render pagination */
    if (totalPages > 1) {
        renderPagination(totalPages);
        document.getElementById('paginationContainer').style.display = 'flex';
    } else {
        document.getElementById('paginationContainer').style.display = 'none';
    }
}

/* ── Pagination ── */
function renderPagination(totalPages) {
    let html = `<button class="pagination-btn" onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}><i class="fas fa-chevron-left"></i></button>`;

    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
            if (i > 1 && (i < currentPage - 1 || (i === currentPage - 1 && currentPage > 3))) {
                html += `<span class="pagination-info">...</span>`;
            }
            html += `<button class="pagination-btn${i === currentPage ? ' active' : ''}" onclick="changePage(${i})">${i}</button>`;
        }
    }

    html += `<button class="pagination-btn" onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}><i class="fas fa-chevron-right"></i></button>`;

    document.getElementById('paginationContainer').innerHTML = html;
}

function changePage(page) {
    currentPage = page;
    renderCars();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/* ── Build single card ── */
function buildCard(car, avail, dur, idx) {
    const basePrice  = car.daily_rent_price   || 0;
    const delay      = (idx * 0.05).toFixed(2);
    const cardLink   = avail ? `/bookings/car-detail/${car.id}?start_date=${startDate}&start_time=${startTime}&end_date=${endDate}&end_time=${endTime}` : '#';

    return `
    <a href="${cardLink}" class="car-card${avail ? '' : ' unavailable'}" style="animation-delay:${delay}s">

        <div class="discount-badge" style="background: ${avail ? '#16a34a' : '#dc2626'}; pointer-events: none;"><i class="fas ${avail ? 'fa-check-circle' : 'fa-times-circle'}"></i> ${avail ? 'Tersedia' : 'Tidak Tersedia'}</div>

        <div class="card-mid">
            <img
                src="${car.main_image_url || '/images/placeholder.jpg'}"
                alt="${car.brand} ${car.name}"
                class="car-thumb"
                loading="lazy"
                onerror="this.src='/images/placeholder.jpg'"
                style="pointer-events: none;"
            >
            <div class="car-specs-col">
                <div class="car-title">${(car.name || '')}</div>
                <div class="spec-row">
                    <div class="spec-item"><i class="fas fa-shield-alt"></i> Asuransi</div>
                    <div class="spec-item"><i class="fas fa-users"></i> ${car.number_of_seats || 5} Kursi</div>
                    <div class="spec-item"><i class="fas fa-suitcase"></i> ${car.luggage || 2} Koper</div>
                    <div class="spec-item"><i class="fas fa-cogs"></i> ${car.transmission || 'Automatic'}</div>
                </div>
                <div class="card-bottom">
                    <div class="price-col">
                        <div class="price-main">Rp ${formatRupiah(basePrice)}</div>
                        <div class="price-per">per 1 hari</div>
                    </div>
                </div>
            </div>
        </div>

    </a>`;
}

/* ── Filter / sort logic ── */
function applyFilters() {
    /* transmisi checkboxes */
    filterTrans = Array.from(document.querySelectorAll('.filter-options input[type=checkbox]:checked'))
        .map(el => el.value)
        .filter(v => ['Automatic','Manual'].includes(v));

    /* seats checkboxes */
    filterSeats = Array.from(document.querySelectorAll('.filter-options input[type=checkbox]:checked'))
        .map(el => el.value)
        .filter(v => ['4','5','6','7'].includes(v));

    sortMode = document.getElementById('desktopSort')?.value || sortMode;
    currentPage = 1;
    renderCars();
}

function resetFilters() {
    document.querySelectorAll('.filter-options input[type=checkbox]').forEach(el => el.checked = false);
    if (document.getElementById('desktopSort')) document.getElementById('desktopSort').value = 'price_asc';
    filterTrans = []; filterSeats = []; sortMode = 'price_asc';
    currentPage = 1;
    renderCars();
}

/* ── Mobile sort ── */
function setMobileSort(mode, el) {
    document.querySelectorAll('.sort-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    sortMode = mode;
    currentPage = 1;
    renderCars();
}

/* ── Mobile modal ── */
function openModal(type) {
    const modal = document.getElementById('mobileModal');
    document.getElementById('modalTitle').textContent = type === 'sort' ? 'Urutkan' : 'Filter';

    if (type === 'sort') {
        document.getElementById('modalBody').innerHTML = `
            <div class="modal-filter-label">Pilih Urutan</div>
            <div class="chip-group">
                <button class="filter-chip${sortMode==='price_asc'?' active':''}" onclick="mobileSort('price_asc',this)">Harga Terendah</button>
                <button class="filter-chip${sortMode==='price_desc'?' active':''}" onclick="mobileSort('price_desc',this)">Harga Tertinggi</button>
            </div>
            <button class="apply-btn" onclick="closeModal()">Terapkan</button>`;
    } else {
        document.getElementById('modalBody').innerHTML = `
            <div class="modal-filter-label">Transmisi</div>
            <div class="chip-group">
                <button class="filter-chip${filterTrans.includes('Automatic')?' active':''}" onclick="toggleChipFilter(this,'trans','Automatic')">Automatic</button>
                <button class="filter-chip${filterTrans.includes('Manual')?' active':''}" onclick="toggleChipFilter(this,'trans','Manual')">Manual</button>
            </div>
            <div class="modal-filter-label">Kapasitas Kursi</div>
            <div class="chip-group">
                <button class="filter-chip${filterSeats.includes('4')?' active':''}" onclick="toggleChipFilter(this,'seats','4')">4 Kursi</button>
                <button class="filter-chip${filterSeats.includes('5')?' active':''}" onclick="toggleChipFilter(this,'seats','5')">5 Kursi</button>
                <button class="filter-chip${filterSeats.includes('6')?' active':''}" onclick="toggleChipFilter(this,'seats','6')">6 Kursi</button>
                <button class="filter-chip${filterSeats.includes('7')?' active':''}" onclick="toggleChipFilter(this,'seats','7+')">7+ Kursi</button>
            </div>
            <button class="apply-btn" onclick="closeModal()">Terapkan Filter</button>`;
    }

    modal.classList.add('open');
}

function closeModal(e) {
    if (!e || e.target === document.getElementById('mobileModal')) {
        document.getElementById('mobileModal').classList.remove('open');
        renderCars();
    }
}

function mobileSort(mode, el) {
    document.querySelectorAll('#modalBody .filter-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    sortMode = mode;
    /* sync mobile sort chips at top */
    document.querySelectorAll('.sort-chip').forEach(c => c.classList.remove('active'));
    const map = { price_asc: 0, price_desc: 1 };
    const chips = document.querySelectorAll('.sort-chip');
    if (chips[map[mode]]) chips[map[mode]].classList.add('active');
}

function toggleChipFilter(el, type, val) {
    el.classList.toggle('active');
    if (type === 'trans') {
        filterTrans = filterTrans.includes(val)
            ? filterTrans.filter(v => v !== val)
            : [...filterTrans, val];
    } else {
        filterSeats = filterSeats.includes(val)
            ? filterSeats.filter(v => v !== val)
            : [...filterSeats, val];
    }
}

document.addEventListener('DOMContentLoaded', loadCars);
</script>

</x-app-layout>
