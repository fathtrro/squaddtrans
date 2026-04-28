<x-app-layout>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
:root {
    --brand:      #f97316;
    --brand-dk:   #ea6c0a;
    --brand-lt:   #fff7ed;
    --green:      #16a34a;
    --green-lt:   #dcfce7;
    --red:        #dc2626;
    --red-lt:     #fee2e2;
    --amber:      #d97706;
    --amber-lt:   #fffbeb;
    --text:       #111827;
    --text2:      #374151;
    --muted:      #6b7280;
    --hint:       #9ca3af;
    --border:     #e5e7eb;
    --border2:    #d1d5db;
    --bg:         #f3f4f6;
    --surf:       #ffffff;
    --surf2:      #f9fafb;
    --r:          8px;
    --r-lg:       14px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    -webkit-font-smoothing: antialiased;
}

footer { display: none !important; }

/* ─── TOP BAR ─────────────────────── */
.topbar {
    background: var(--surf);
    border-bottom: 1px solid var(--border);
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: sticky;
    top: 0;
    z-index: 50;
}
.back-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1px solid var(--border);
    background: var(--surf);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: var(--text);
    text-decoration: none;
    flex-shrink: 0;
    transition: background .15s;
}
.back-btn:hover { background: var(--bg); }
.tb-title { font-size: 15px; font-weight: 800; color: var(--text); }
.tb-sub   { font-size: 11px; color: var(--muted); margin-top: 1px; }

/* ─── LAYOUT ─────────────────────── */
.page-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding-bottom: 80px;
}

@media (min-width: 1024px) {
    .page-wrap {
        display: grid;
        grid-template-columns: 270px 1fr;
        gap: 24px;
        padding: 24px 24px 40px;
        align-items: start;
    }
}

/* ─── SIDEBAR ─────────────────────── */
.sidebar { display: none; }
@media (min-width: 1024px) {
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 14px;
        position: sticky;
        top: 72px;
    }
}
.s-card {
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
}
.s-head {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    font-size: 13px; font-weight: 700;
    display: flex; align-items: center; justify-content: space-between;
}
.s-reset {
    font-size: 11px; font-weight: 600;
    color: var(--brand);
    background: none; border: none;
    cursor: pointer; padding: 0;
}
.s-section {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
}
.s-section:last-child { border-bottom: none; }
.s-label {
    font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .07em;
    color: var(--hint); margin-bottom: 10px;
}
.s-opts { display: flex; flex-direction: column; gap: 2px; }
.s-opt {
    display: flex; align-items: center; gap: 9px;
    padding: 7px 8px;
    border-radius: var(--r);
    cursor: pointer;
    font-size: 13px; color: var(--text2);
    transition: background .12s;
}
.s-opt:hover { background: var(--surf2); color: var(--brand); }
.s-opt input { accent-color: var(--brand); width: 15px; height: 15px; cursor: pointer; }
.sort-select {
    width: 100%; padding: 9px 32px 9px 12px;
    border: 1px solid var(--border2);
    border-radius: var(--r);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; color: var(--text);
    background: var(--surf);
    cursor: pointer; outline: none; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='%236b7280' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
}

/* ─── MAIN CONTENT ─────────────────── */
.main { min-width: 0; }

/* Hero */
.hero {
    margin: 16px;
    background: linear-gradient(135deg, #f97316 0%, #c2410c 100%);
    border-radius: var(--r-lg);
    padding: 22px 20px;
    position: relative;
    overflow: hidden;
}
@media (min-width: 1024px) { .hero { margin: 0 0 16px; } }
.hero-pattern {
    position: absolute; inset: 0;
    background-image:
        radial-gradient(circle at 85% 50%, rgba(255,255,255,0.1) 0%, transparent 55%),
        repeating-linear-gradient(45deg, transparent, transparent 22px, rgba(255,255,255,0.03) 22px, rgba(255,255,255,0.03) 23px);
    pointer-events: none;
}
.hero-inner { position: relative; z-index: 1; }
.hero-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.18);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 99px;
    padding: 5px 12px;
    margin-bottom: 12px;
}
.hero-dot { width: 7px; height: 7px; background: #4ade80; border-radius: 50%; box-shadow: 0 0 0 3px rgba(74,222,128,.25); }
.hero-badge-text { font-size: 11px; font-weight: 700; color: rgba(255,255,255,.9); text-transform: uppercase; letter-spacing: .07em; }
.hero-title { color: #fff; font-size: 22px; font-weight: 800; margin-bottom: 6px; line-height: 1.25; }
.hero-sub   { color: rgba(255,255,255,.75); font-size: 13px; line-height: 1.5; }

/* Info strip */
.info-strip {
    margin: 0 16px 14px;
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    overflow: hidden;
}
@media (min-width: 1024px) { .info-strip { margin: 0 0 14px; } }
.info-item {
    padding: 13px 12px;
    border-right: 1px solid var(--border);
}
.info-item:last-child { border-right: none; }
.info-lbl { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--hint); margin-bottom: 4px; }
.info-val { font-size: 13px; font-weight: 700; color: var(--text); line-height: 1.3; }
.info-val.orange { color: var(--brand); }

/* Inclusions */
.inclusions {
    margin: 0 16px 14px;
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    padding: 14px 16px;
}
@media (min-width: 1024px) { .inclusions { margin: 0 0 14px; } }
.incl-title { font-size: 12px; font-weight: 700; color: var(--text); margin-bottom: 10px; }
.incl-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.incl-item  { display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--muted); }
.incl-icon  {
    width: 20px; height: 20px; border-radius: 50%;
    background: var(--green-lt); color: var(--green);
    display: flex; align-items: center; justify-content: center;
    font-size: 9px; flex-shrink: 0;
}

/* Warning banner */
.warn-banner {
    margin: 0 16px 14px;
    background: var(--amber-lt);
    border: 1px solid #f59e0b;
    border-radius: var(--r-lg);
    padding: 14px 16px;
    display: flex; align-items: flex-start; gap: 12px;
}
@media (min-width: 1024px) { .warn-banner { margin: 0 0 14px; } }
.warn-icon  { color: var(--amber); font-size: 18px; flex-shrink: 0; margin-top: 1px; }
.warn-body  { flex: 1; }
.warn-title { font-size: 13px; font-weight: 700; color: #92400e; margin-bottom: 3px; }
.warn-text  { font-size: 12px; color: #b45309; line-height: 1.5; }
.warn-cta   {
    flex-shrink: 0;
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 14px;
    background: var(--amber); color: #fff;
    border-radius: var(--r);
    font-size: 12px; font-weight: 700;
    text-decoration: none;
    align-self: center;
    transition: background .15s;
    white-space: nowrap;
}
.warn-cta:hover { background: #c2760a; }

/* Sort chips (mobile) */
.sort-bar {
    display: flex; gap: 8px;
    padding: 10px 16px;
    background: var(--surf);
    border-bottom: 1px solid var(--border);
    overflow-x: auto;
    scrollbar-width: none;
}
.sort-bar::-webkit-scrollbar { display: none; }
@media (min-width: 1024px) { .sort-bar { display: none; } }
.sort-chip {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px;
    border-radius: 99px;
    border: 1.5px solid var(--border2);
    font-size: 12px; font-weight: 600;
    color: var(--muted);
    background: var(--surf);
    white-space: nowrap;
    cursor: pointer;
    transition: all .15s;
    font-family: 'Plus Jakarta Sans', sans-serif;
    flex-shrink: 0;
}
.sort-chip.active, .sort-chip:hover {
    border-color: var(--brand);
    color: var(--brand);
    background: var(--brand-lt);
}

/* Results meta */
.results-meta {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 16px 8px;
}
@media (min-width: 1024px) { .results-meta { padding: 0 0 12px; } }
.results-count { font-size: 13px; font-weight: 700; color: var(--text); }
.results-sub   { font-size: 11px; color: var(--hint); }

/* ─── CAR CARD ─────────────────────── */
.car-card {
    display: block;
    text-decoration: none;
    color: inherit;
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    margin: 0 16px 12px;
    animation: fadeUp .35s ease both;
    transition: border-color .2s, box-shadow .2s, transform .18s;
}
@media (min-width: 640px)  { .car-card { margin: 0 0 12px; } }
@media (min-width: 1024px) { .car-card { margin: 0 0 14px; } }
.car-card:hover:not(.unavail) {
    border-color: var(--brand);
    box-shadow: 0 6px 24px rgba(249,115,22,.12);
    transform: translateY(-2px);
}
.car-card.unavail { opacity: .5; pointer-events: none; }
@keyframes fadeUp { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }

/* Image area */
.card-img-wrap {
    position: relative;
    height: 170px;
    background: var(--surf2);
    overflow: hidden;
}
.car-thumb {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .4s ease;
}
.car-card:hover .car-thumb { transform: scale(1.03); }

/* Badge availability (overlay on image) */
.avail-pill {
    position: absolute;
    top: 10px; left: 10px;
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 11px;
    border-radius: 99px;
    font-size: 11px; font-weight: 700;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
}
.avail-pill.yes { background: rgba(220,252,231,.9); color: #15803d; }
.avail-pill.no  { background: rgba(254,226,226,.9); color: #b91c1c; }

/* Price corner (overlay on image) */
.price-corner {
    position: absolute;
    bottom: 0; right: 0;
    background: var(--brand);
    color: #fff;
    padding: 8px 14px;
    border-top-left-radius: var(--r);
}
.price-corner .p-amount { font-size: 16px; font-weight: 800; line-height: 1; }
.price-corner .p-per    { font-size: 10px; opacity: .85; margin-top: 2px; }

/* Card body */
.card-bd { padding: 14px 16px 12px; }
.car-name  { font-size: 16px; font-weight: 800; color: var(--text); margin-bottom: 2px; }
.car-brand { font-size: 12px; color: var(--hint); margin-bottom: 12px; }

.spec-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.spec-item {
    display: flex; align-items: center; gap: 8px;
    font-size: 12px; color: var(--text2);
}
.spec-icon {
    width: 28px; height: 28px;
    border-radius: var(--r);
    background: var(--surf2);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.spec-icon i { font-size: 12px; color: var(--muted); }

/* Card footer */
.card-ft {
    border-top: 1px solid var(--border);
    padding: 11px 16px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 10px;
}
.incl-tags { display: flex; gap: 6px; flex-wrap: wrap; }
.incl-tag {
    padding: 3px 9px;
    border-radius: 99px;
    font-size: 11px; font-weight: 600;
    background: var(--surf2);
    color: var(--muted);
    border: 1px solid var(--border);
}
.btn-select {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px;
    background: var(--brand); color: #fff;
    border: none; border-radius: var(--r);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700;
    cursor: pointer;
    transition: background .15s, transform .12s;
    flex-shrink: 0;
    white-space: nowrap;
}
.btn-select:hover  { background: var(--brand-dk); }
.btn-select:active { transform: scale(.97); }
.btn-select i { font-size: 11px; }

/* Section divider */
.sec-div {
    display: flex; align-items: center; gap: 12px;
    padding: 6px 16px 4px;
    font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .1em;
    color: var(--hint);
}
@media (min-width: 640px) { .sec-div { padding: 12px 0 4px; } }
.div-line { flex: 1; height: 1px; background: var(--border); }

/* Pagination */
.pagination {
    display: flex; align-items: center; justify-content: center;
    gap: 6px;
    padding: 20px 16px;
}
@media (min-width: 1024px) { .pagination { padding: 20px 0; } }
.pg-btn {
    width: 36px; height: 36px;
    border-radius: var(--r);
    border: 1px solid var(--border);
    background: var(--surf);
    color: var(--text);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 600;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all .15s;
}
.pg-btn:hover:not(:disabled) { border-color: var(--brand); color: var(--brand); }
.pg-btn.active { background: var(--brand); color: #fff; border-color: var(--brand); }
.pg-btn:disabled { opacity: .45; cursor: not-allowed; }
.pg-dots { font-size: 13px; color: var(--hint); padding: 0 2px; }

/* State box */
.state-box {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    margin: 0 16px;
}
@media (min-width: 640px) { .state-box { margin: 0; } }
.state-icon  { font-size: 2.5rem; color: var(--hint); margin-bottom: 14px; }
.state-title { font-size: 17px; font-weight: 700; margin-bottom: 8px; }
.state-text  { font-size: 13px; color: var(--muted); line-height: 1.6; margin-bottom: 20px; }
.state-link  {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 20px;
    border: 1.5px solid var(--brand);
    border-radius: var(--r);
    color: var(--brand); text-decoration: none;
    font-weight: 700; font-size: 13px;
    transition: background .15s;
}
.state-link:hover { background: var(--brand-lt); }

/* Bottom bar (mobile) */
.bottom-bar {
    position: fixed; bottom: 0; left: 0; right: 0;
    background: var(--surf);
    border-top: 1px solid var(--border);
    display: flex;
    z-index: 40;
    box-shadow: 0 -4px 16px rgba(0,0,0,.07);
}
@media (min-width: 1024px) { .bottom-bar { display: none; } }
.bb-btn {
    flex: 1;
    display: flex; align-items: center; justify-content: center;
    gap: 8px;
    padding: 14px;
    background: none; border: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 600;
    color: var(--muted);
    cursor: pointer;
    transition: color .15s;
}
.bb-btn + .bb-btn { border-left: 1px solid var(--border); }
.bb-btn:hover { color: var(--brand); }

/* Modal */
.modal-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 100;
    display: none; align-items: flex-end;
}
.modal-overlay.open { display: flex; }
.modal-sheet {
    background: var(--surf);
    border-radius: 20px 20px 0 0;
    width: 100%;
    max-height: 85vh;
    overflow-y: auto;
    padding: 0 0 32px;
    animation: sheetUp .28s ease;
}
@keyframes sheetUp { from { transform: translateY(100%); } to { transform: translateY(0); } }
.modal-handle {
    width: 40px; height: 4px;
    background: var(--border2);
    border-radius: 99px;
    margin: 14px auto 16px;
}
.modal-title {
    font-size: 16px; font-weight: 700;
    padding: 0 20px 14px;
    border-bottom: 1px solid var(--border);
    display: flex; justify-content: space-between; align-items: center;
}
.modal-close { font-size: 18px; color: var(--muted); cursor: pointer; background: none; border: none; padding: 4px; }
.modal-body  { padding: 16px 20px; }
.m-label {
    font-size: 10px; font-weight: 700;
    letter-spacing: .08em; text-transform: uppercase;
    color: var(--hint);
    margin-bottom: 10px; margin-top: 14px;
}
.m-label:first-child { margin-top: 0; }
.chip-group  { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 4px; }
.filter-chip {
    padding: 7px 14px;
    border-radius: 99px;
    border: 1.5px solid var(--border2);
    font-size: 13px; font-weight: 500;
    color: var(--text2);
    background: var(--surf);
    cursor: pointer;
    transition: all .15s;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.filter-chip.active, .filter-chip:hover {
    border-color: var(--brand); color: var(--brand); background: var(--brand-lt);
}
.apply-btn {
    width: 100%; padding: 14px;
    background: var(--brand); color: #fff;
    border: none; border-radius: var(--r);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px; font-weight: 700;
    margin-top: 20px; cursor: pointer;
    transition: background .15s;
}
.apply-btn:hover { background: var(--brand-dk); }
</style>

{{-- TOP BAR --}}
<div class="topbar">
    <a href="{{ route('dashboard') }}" class="back-btn"><i class="fas fa-arrow-left"></i></a>
    <div>
        <div class="tb-title" id="navTitle">Rental Mobil</div>
        <div class="tb-sub"   id="navSub">Memuat...</div>
    </div>
</div>

{{-- PAGE WRAP --}}
<div class="page-wrap">

    {{-- ─── SIDEBAR ─────────────────────── --}}
    <aside class="sidebar">

        <div class="s-card">
            <div class="s-head">
                Sudah Termasuk
            </div>
            <div style="padding: 14px 16px;">
                <div class="incl-grid">
                    <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Layanan darurat 24 jam</div>
                    <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Asuransi comprehensive</div>
                    <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Bisa refund</div>
                    <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Mobil pengganti</div>
                </div>
            </div>
        </div>

        <div class="s-card">
            <div class="s-head">
                Filter
                <button class="s-reset" onclick="resetFilters()">Reset</button>
            </div>
            <div class="s-section">
                <div class="s-label">Urutkan</div>
                <select class="sort-select" id="desktopSort" onchange="applyFilters()">
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                </select>
            </div>
            <div class="s-section">
                <div class="s-label">Transmisi</div>
                <div class="s-opts">
                    <label class="s-opt"><input type="checkbox" value="Automatic" onchange="applyFilters()"> Automatic</label>
                    <label class="s-opt"><input type="checkbox" value="Manual"    onchange="applyFilters()"> Manual</label>
                </div>
            </div>
            <div class="s-section">
                <div class="s-label">Kapasitas Kursi</div>
                <div class="s-opts">
                    <label class="s-opt"><input type="checkbox" value="4" onchange="applyFilters()"> 4 Kursi</label>
                    <label class="s-opt"><input type="checkbox" value="5" onchange="applyFilters()"> 5 Kursi</label>
                    <label class="s-opt"><input type="checkbox" value="6" onchange="applyFilters()"> 6 Kursi</label>
                    <label class="s-opt"><input type="checkbox" value="7" onchange="applyFilters()"> 7+ Kursi</label>
                </div>
            </div>
        </div>

    </aside>

    {{-- ─── MAIN ─────────────────────── --}}
    <div class="main">

        {{-- Hero --}}
        <div class="hero">
            <div class="hero-pattern"></div>
            <div class="hero-inner">
                <div class="hero-badge">
                    <div class="hero-dot"></div>
                    <span class="hero-badge-text">Kendaraan Tersedia</span>
                </div>
                <div class="hero-title">Pilih Kendaraan Terbaik Anda</div>
                <div class="hero-sub">Kendaraan premium terpilih sesuai kebutuhan dan tanggal penyewaan Anda.</div>
            </div>
        </div>

        {{-- Info strip --}}
        <div class="info-strip">
            <div class="info-item">
                <div class="info-lbl">Mulai</div>
                <div class="info-val" id="infStartDate">-</div>
            </div>
            <div class="info-item">
                <div class="info-lbl">Selesai</div>
                <div class="info-val" id="infoEndDate">-</div>
            </div>
            <div class="info-item">
                <div class="info-lbl">Durasi</div>
                <div class="info-val orange" id="infoDuration">-</div>
            </div>
            <div class="info-item">
                <div class="info-lbl">Tersedia</div>
                <div class="info-val" id="infoAvailable">-</div>
            </div>
        </div>

        {{-- Inclusions (mobile) --}}
        <div class="inclusions" id="mobileInclusions">
            <div class="incl-title">Semua kendaraan sudah termasuk</div>
            <div class="incl-grid">
                <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Layanan darurat 24 jam</div>
                <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Asuransi comprehensive</div>
                <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Bisa refund (KB)</div>
                <div class="incl-item"><div class="incl-icon"><i class="fas fa-check"></i></div> Mobil pengganti</div>
            </div>
        </div>

        {{-- Incomplete booking warning --}}
        @if(isset($incompleteBooking) && $incompleteBooking)
        <div class="warn-banner">
            <div class="warn-icon"><i class="fas fa-exclamation-circle"></i></div>
            <div class="warn-body">
                <div class="warn-title">Booking belum selesai!</div>
                <div class="warn-text">
                    ID <strong>{{ $incompleteBooking->booking_code }}</strong> — status
                    <strong>{{ strtoupper(str_replace('_',' ', $incompleteBooking->status)) }}</strong>.
                    Selesaikan atau batalkan sebelum membuat booking baru.
                </div>
            </div>
            <a href="{{ route('bookings.index') }}" class="warn-cta"><i class="fas fa-clipboard-list"></i> Lihat</a>
        </div>
        @endif

        {{-- Sort chips (mobile) --}}
        <div class="sort-bar">
            <button class="sort-chip active" onclick="setMobileSort('price_asc',this)">
                <i class="fas fa-arrow-up-short-wide"></i> Termurah
            </button>
            <button class="sort-chip" onclick="setMobileSort('price_desc',this)">
                <i class="fas fa-arrow-down-short-wide"></i> Termahal
            </button>
        </div>

        {{-- Results meta --}}
        <div class="results-meta">
            <span class="results-count" id="resultsText">Memuat kendaraan...</span>
            <span class="results-sub"   id="durationText"></span>
        </div>

        {{-- Cars --}}
        <div id="carsContainer">
            <div class="state-box">
                <div class="state-icon"><i class="fas fa-spinner fa-spin"></i></div>
                <div class="state-title">Menyiapkan Pilihan...</div>
                <p class="state-text">Kami sedang mencari kendaraan terbaik untuk Anda.</p>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination" id="paginationContainer" style="display:none;"></div>

    </div>
</div>

{{-- BOTTOM BAR --}}
<div class="bottom-bar">
    <button class="bb-btn" onclick="openModal('sort')"><i class="fas fa-sort-amount-up-alt"></i> Urutkan</button>
    <button class="bb-btn" onclick="openModal('filter')"><i class="fas fa-filter"></i> Filter</button>
</div>

{{-- MOBILE MODAL --}}
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
function formatRupiah(n) {
    return Math.floor(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

const params    = new URLSearchParams(window.location.search);
let startDate   = params.get('start_date');
let endDate     = params.get('end_date');
let startTime   = params.get('start_time') || '00:00';
let endTime     = params.get('end_time')   || '00:00';

if (!startDate || !endDate) {
    document.body.innerHTML = `
        <div style="display:flex;align-items:center;justify-content:center;min-height:100vh;background:#f3f4f6;">
            <div style="background:#fff;padding:40px;border-radius:14px;text-align:center;max-width:400px;">
                <div style="font-size:3rem;margin-bottom:20px;">⚠️</div>
                <h2 style="font-size:20px;font-weight:800;margin-bottom:10px;">Parameter Tidak Valid</h2>
                <p style="color:#6b7280;margin-bottom:20px;font-size:14px;">Silakan pilih tanggal perjalanan terlebih dahulu.</p>
                <a href="{{ route('dashboard') }}" style="display:inline-block;padding:10px 24px;background:#f97316;color:#fff;text-decoration:none;border-radius:8px;font-weight:700;">← Kembali ke Dashboard</a>
            </div>
        </div>`;
    throw new Error('Missing date parameters');
}

const fmtDate = s => new Intl.DateTimeFormat('id-ID', { day:'numeric', month:'short', year:'numeric' }).format(new Date(s));
const fmtFull = (d, t) => `${fmtDate(d)}, ${t}`;

function getDuration() {
    return Math.round((new Date(endDate) - new Date(startDate)) / 86400000);
}

const dur = getDuration();
document.getElementById('navTitle').textContent   = 'Rental Mobil';
document.getElementById('navSub').textContent     = `${fmtFull(startDate, startTime)} – ${fmtFull(endDate, endTime)} • ${dur} Hari`;
document.getElementById('durationText').textContent = `${dur} Hari`;
document.getElementById('infStartDate').textContent = fmtFull(startDate, startTime);
document.getElementById('infoEndDate').textContent  = fmtFull(endDate, endTime);
document.getElementById('infoDuration').textContent = dur + ' Hari';

let allCars     = [];
let sortMode    = 'price_asc';
let filterTrans = [];
let filterSeats = [];
let currentPage = 1;
const PER_PAGE  = 5;

async function loadCars() {
    try {
        const res  = await fetch(`/api/bookings/available-cars?start_date=${startDate}&end_date=${endDate}`);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();
        allCars    = data.cars || [];
        renderCars();
    } catch (e) {
        document.getElementById('carsContainer').innerHTML = `
            <div class="state-box">
                <div class="state-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="state-title">Gagal Memuat Data</div>
                <p class="state-text" style="color:#dc2626;font-weight:600;">${e.message}</p>
                <p class="state-text">Silakan refresh atau hubungi support.</p>
                <a href="{{ route('dashboard') }}" class="state-link"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>`;
    }
}

function renderCars() {
    const d    = getDuration();
    let avail  = allCars.filter(c =>  c.is_available);
    let booked = allCars.filter(c => !c.is_available);

    document.getElementById('infoAvailable').textContent = avail.length + ' Unit';

    if (filterTrans.length) {
        avail  = avail.filter(c => filterTrans.includes(c.transmission));
        booked = booked.filter(c => filterTrans.includes(c.transmission));
    }
    if (filterSeats.length) {
        const fn = c => filterSeats.some(s => s === '7' ? (c.number_of_seats||5) >= 7 : (c.number_of_seats||5) == s);
        avail  = avail.filter(fn);
        booked = booked.filter(fn);
    }

    const sortFn = {
        price_asc:  (a,b) => (a.daily_rent_price||0) - (b.daily_rent_price||0),
        price_desc: (a,b) => (b.daily_rent_price||0) - (a.daily_rent_price||0),
    }[sortMode];
    avail.sort(sortFn);

    document.getElementById('resultsText').innerHTML =
        `<strong>${avail.length}</strong> kendaraan ditemukan`;

    if (!allCars.length) {
        document.getElementById('carsContainer').innerHTML = `
            <div class="state-box">
                <div class="state-icon"><i class="fas fa-search"></i></div>
                <div class="state-title">Tidak Ada Kendaraan</div>
                <p class="state-text">Tidak ada mobil tersedia untuk tanggal ini. Coba ubah tanggal perjalanan.</p>
                <a href="{{ route('dashboard') }}" class="state-link"><i class="fas fa-arrow-left"></i> Ubah Tanggal</a>
            </div>`;
        document.getElementById('paginationContainer').style.display = 'none';
        return;
    }

    const total      = avail.length;
    const totalPages = Math.ceil(total / PER_PAGE) || 1;
    currentPage      = Math.min(currentPage, totalPages);
    const start      = (currentPage - 1) * PER_PAGE;
    const paged      = avail.slice(start, start + PER_PAGE);

    let html = paged.map((car, i) => buildCard(car, true, d, start + i)).join('');

    if (currentPage === totalPages || total <= PER_PAGE) {
        if (booked.length) {
            html += `<div class="sec-div"><div class="div-line"></div><span>Sudah Dipesan</span><div class="div-line"></div></div>`;
            html += booked.map((car, i) => buildCard(car, false, d, total + i)).join('');
        }
    }

    document.getElementById('carsContainer').innerHTML = html;

    if (totalPages > 1) {
        renderPagination(totalPages);
        document.getElementById('paginationContainer').style.display = 'flex';
    } else {
        document.getElementById('paginationContainer').style.display = 'none';
    }
}

function buildCard(car, avail, dur, idx) {
    const price = car.daily_rent_price || 0;
    const delay = (idx * .05).toFixed(2);
    const link  = avail
        ? `/bookings/car-detail/${car.id}?start_date=${startDate}&start_time=${startTime}&end_date=${endDate}&end_time=${endTime}`
        : '#';
    const img   = car.main_image_url || '/images/placeholder.jpg';
    const brand = car.brand || '';
    const name  = car.name  || '';

    return `<a href="${link}" class="car-card${avail ? '' : ' unavail'}" style="animation-delay:${delay}s">
        <div class="card-img-wrap">
            <img class="car-thumb" src="${img}" alt="${brand} ${name}" loading="lazy" onerror="this.src='/images/placeholder.jpg'">
            <span class="avail-pill ${avail ? 'yes' : 'no'}">
                <i class="fas fa-${avail ? 'check' : 'times'}-circle" style="font-size:10px;"></i>
                ${avail ? 'Tersedia' : 'Tidak Tersedia'}
            </span>
            <div class="price-corner">
                <div class="p-amount">Rp ${formatRupiah(price)}</div>
                <div class="p-per">/ hari</div>
            </div>
        </div>
        <div class="card-bd">
            <div class="car-name">${name}</div>
            <div class="car-brand">${brand}${car.year ? ' &middot; ' + car.year : ''}</div>
            <div class="spec-grid">
                <div class="spec-item"><div class="spec-icon"><i class="fas fa-users"></i></div>${car.number_of_seats || 5} Kursi</div>
                <div class="spec-item"><div class="spec-icon"><i class="fas fa-suitcase-rolling"></i></div>${car.luggage || 2} Koper</div>
                <div class="spec-item"><div class="spec-icon"><i class="fas fa-cog"></i></div>${car.transmission || 'Automatic'}</div>
                <div class="spec-item"><div class="spec-icon"><i class="fas fa-shield-alt"></i></div>Asuransi</div>
            </div>
        </div>
        <div class="card-ft">
            <div class="incl-tags">
                <span class="incl-tag">24 Jam</span>
                <span class="incl-tag">Refund</span>
                <span class="incl-tag">Ganti Rugi</span>
            </div>
            ${avail ? '<button class="btn-select">Pilih <i class="fas fa-arrow-right"></i></button>' : ''}
        </div>
    </a>`;
}

function renderPagination(total) {
    let html = `<button class="pg-btn" onclick="changePage(${currentPage-1})" ${currentPage===1?'disabled':''}><i class="fas fa-chevron-left"></i></button>`;
    for (let i = 1; i <= total; i++) {
        if (i === 1 || i === total || (i >= currentPage-1 && i <= currentPage+1)) {
            if (i > 1 && i < currentPage-1) html += `<span class="pg-dots">…</span>`;
            html += `<button class="pg-btn${i===currentPage?' active':''}" onclick="changePage(${i})">${i}</button>`;
        }
    }
    html += `<button class="pg-btn" onclick="changePage(${currentPage+1})" ${currentPage===total?'disabled':''}><i class="fas fa-chevron-right"></i></button>`;
    document.getElementById('paginationContainer').innerHTML = html;
}

function changePage(p) {
    currentPage = p;
    renderCars();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function applyFilters() {
    const checked = Array.from(document.querySelectorAll('.s-opts input:checked')).map(e => e.value);
    filterTrans = checked.filter(v => ['Automatic','Manual'].includes(v));
    filterSeats = checked.filter(v => ['4','5','6','7'].includes(v));
    sortMode    = document.getElementById('desktopSort')?.value || sortMode;
    currentPage = 1;
    renderCars();
}

function resetFilters() {
    document.querySelectorAll('.s-opts input').forEach(e => e.checked = false);
    if (document.getElementById('desktopSort')) document.getElementById('desktopSort').value = 'price_asc';
    filterTrans = []; filterSeats = []; sortMode = 'price_asc'; currentPage = 1;
    renderCars();
}

function setMobileSort(mode, el) {
    document.querySelectorAll('.sort-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    sortMode = mode; currentPage = 1;
    renderCars();
}

function openModal(type) {
    document.getElementById('modalTitle').textContent = type === 'sort' ? 'Urutkan' : 'Filter';
    if (type === 'sort') {
        document.getElementById('modalBody').innerHTML = `
            <div class="m-label">Pilih Urutan</div>
            <div class="chip-group">
                <button class="filter-chip${sortMode==='price_asc'?' active':''}" onclick="mobileSort('price_asc',this)">Harga Terendah</button>
                <button class="filter-chip${sortMode==='price_desc'?' active':''}" onclick="mobileSort('price_desc',this)">Harga Tertinggi</button>
            </div>
            <button class="apply-btn" onclick="closeModal()">Terapkan</button>`;
    } else {
        document.getElementById('modalBody').innerHTML = `
            <div class="m-label">Transmisi</div>
            <div class="chip-group">
                <button class="filter-chip${filterTrans.includes('Automatic')?' active':''}" onclick="toggleChip(this,'trans','Automatic')">Automatic</button>
                <button class="filter-chip${filterTrans.includes('Manual')?' active':''}" onclick="toggleChip(this,'trans','Manual')">Manual</button>
            </div>
            <div class="m-label">Kapasitas Kursi</div>
            <div class="chip-group">
                <button class="filter-chip${filterSeats.includes('4')?' active':''}" onclick="toggleChip(this,'seats','4')">4 Kursi</button>
                <button class="filter-chip${filterSeats.includes('5')?' active':''}" onclick="toggleChip(this,'seats','5')">5 Kursi</button>
                <button class="filter-chip${filterSeats.includes('6')?' active':''}" onclick="toggleChip(this,'seats','6')">6 Kursi</button>
                <button class="filter-chip${filterSeats.includes('7')?' active':''}" onclick="toggleChip(this,'seats','7')">7+ Kursi</button>
            </div>
            <button class="apply-btn" onclick="closeModal()">Terapkan Filter</button>`;
    }
    document.getElementById('mobileModal').classList.add('open');
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
    const chips = document.querySelectorAll('.sort-chip');
    chips.forEach(c => c.classList.remove('active'));
    if (mode === 'price_asc' && chips[0]) chips[0].classList.add('active');
    if (mode === 'price_desc' && chips[1]) chips[1].classList.add('active');
}

function toggleChip(el, type, val) {
    el.classList.toggle('active');
    if (type === 'trans') filterTrans = filterTrans.includes(val) ? filterTrans.filter(v=>v!==val) : [...filterTrans, val];
    else filterSeats = filterSeats.includes(val) ? filterSeats.filter(v=>v!==val) : [...filterSeats, val];
}

document.addEventListener('DOMContentLoaded', loadCars);
</script>

</x-app-layout>
