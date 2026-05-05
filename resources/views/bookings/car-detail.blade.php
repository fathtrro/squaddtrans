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
    --r-xl:       20px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
}

footer, header, nav { display: none !important; }

/* ══ TOP BAR ══════════════════════════════════ */
.topbar {
    background: var(--surf);
    border-bottom: 1px solid var(--border);
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: sticky;
    top: 0;
    z-index: 60;
}

.topbar-inner {
    max-width: 1120px;
    margin: 0 auto;
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
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

.tb-info { flex: 1; min-width: 0; }
.tb-title { font-size: 15px; font-weight: 800; color: var(--text); line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.tb-sub   { font-size: 11px; color: var(--muted); margin-top: 1px; }

.avail-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    flex-shrink: 0;
    margin-left: auto;
}
.avail-pill.yes { background: var(--green-lt); color: var(--green); }
.avail-pill.no  { background: var(--red-lt);   color: var(--red);   }
.avail-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

/* ══ PAGE ═══════════════════════════════════════ */
.page {
    max-width: 1120px;
    margin: 0 auto;
    padding: 20px 16px 120px;
}

@media (min-width: 860px) {
    .page {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        padding: 24px 24px 48px;
        align-items: start;
    }
    .right-panel { position: sticky; top: 72px; }
}

/* ══ LEFT COLUMN ═══════════════════════════════ */
.col-left { display: flex; flex-direction: column; gap: 14px; }

/* ══ SHARED CARD SHELL ══════════════════════════ */
.card {
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
}
.card-header-icon {
    width: 30px; height: 30px;
    border-radius: var(--r);
    background: var(--brand-lt);
    display: flex; align-items: center; justify-content: center;
    color: var(--brand-dk);
    font-size: 12px;
    flex-shrink: 0;
}
.card-header-title { font-size: 13px; font-weight: 700; color: var(--text2); }

/* ══ IMAGE CARD ═════════════════════════════════ */
.img-card {
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
}

.img-meta { padding: 14px 16px 12px; }
.car-name { font-size: 18px; font-weight: 800; color: var(--text); letter-spacing: .01em; }
.car-sub  { font-size: 12px; color: var(--hint); margin-top: 3px; font-weight: 500; }

.img-stage {
    position: relative;
    background: var(--surf2);
    min-height: 240px;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.img-stage img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: opacity .18s, transform .18s;
}
.img-placeholder-icon {
    font-size: 72px;
    color: var(--brand);
    opacity: .15;
}

/* Quick specs strip */
.quick-specs {
    display: flex;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}
.qs {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    padding: 12px 8px;
}
.qs + .qs { border-left: 1px solid var(--border); }
.qs-icon {
    width: 28px; height: 28px;
    border-radius: var(--r);
    background: var(--brand-lt);
    display: flex; align-items: center; justify-content: center;
    color: var(--brand-dk);
    font-size: 11px;
}
.qs-val { font-size: 12px; font-weight: 700; color: var(--text2); }
.qs-lbl { font-size: 10px; color: var(--hint); font-weight: 500; }

/* Thumbnails */
.thumb-row {
    display: flex;
    gap: 8px;
    padding: 12px 16px;
    overflow-x: auto;
    scrollbar-width: none;
}
.thumb-row::-webkit-scrollbar { display: none; }
.thumb {
    width: 62px; height: 48px;
    border-radius: var(--r);
    overflow: hidden;
    border: 2px solid transparent;
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color .15s, transform .15s;
    background: var(--bg);
}
.thumb.active { border-color: var(--brand); }
.thumb:hover  { transform: translateY(-2px); border-color: var(--brand-dk); }
.thumb img    { width: 100%; height: 100%; object-fit: cover; }

/* ══ INFO ROWS ══════════════════════════════════ */
.info-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 13px 16px;
    border-bottom: 1px solid var(--border);
    transition: background .12s;
}
.info-row:last-child { border-bottom: none; }
.info-row:hover { background: var(--surf2); }

.ir-icon {
    width: 36px; height: 36px;
    border-radius: var(--r);
    background: var(--brand-lt);
    display: flex; align-items: center; justify-content: center;
    color: var(--brand-dk);
    font-size: 14px;
    flex-shrink: 0;
}
.ir-body  { flex: 1; min-width: 0; }
.ir-label { font-size: 11px; color: var(--hint); font-weight: 500; margin-bottom: 2px; }
.ir-value { font-size: 13px; font-weight: 700; color: var(--text2); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.ir-end   { margin-left: auto; flex-shrink: 0; }

.ir-chip {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11px; font-weight: 700;
    background: var(--brand-lt);
    color: var(--brand-dk);
    border: 1px solid #fed7aa;
}

/* ══ FACILITY GRID ══════════════════════════════ */
.facility-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
.fac-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    border-right: 1px solid var(--border);
    transition: background .12s;
}
.fac-item:nth-child(even)      { border-right: none; }
.fac-item:nth-last-child(-n+2) { border-bottom: none; }
.fac-item:hover { background: var(--surf2); }

.fac-icon {
    width: 32px; height: 32px;
    border-radius: var(--r);
    background: var(--brand-lt);
    display: flex; align-items: center; justify-content: center;
    color: var(--brand-dk);
    font-size: 12px;
    flex-shrink: 0;
}
.fac-text { font-size: 12px; font-weight: 600; color: var(--text2); line-height: 1.4; }

/* ══ SPECS GRID ═════════════════════════════════ */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}
.spec-cell {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    border-right: 1px solid var(--border);
    transition: background .12s;
}
.spec-cell:nth-child(3n)       { border-right: none; }
.spec-cell:nth-last-child(-n+3){ border-bottom: none; }
.spec-cell:hover { background: var(--surf2); }

.spec-icon {
    width: 28px; height: 28px;
    border-radius: var(--r);
    background: var(--brand-lt);
    display: flex; align-items: center; justify-content: center;
    color: var(--brand-dk);
    font-size: 11px;
    margin-bottom: 8px;
}
.spec-lbl { font-size: 10px; color: var(--hint); text-transform: uppercase; letter-spacing: .06em; font-weight: 700; margin-bottom: 3px; }
.spec-val { font-size: 13px; font-weight: 700; color: var(--text); }

/* ══ REVIEWS ════════════════════════════════════ */
.review-hero {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 18px 16px;
    border-bottom: 1px solid var(--border);
}
.rating-bubble {
    width: 52px; height: 52px;
    border-radius: var(--r-lg);
    background: var(--brand);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; font-weight: 800; color: #fff;
    flex-shrink: 0;
    letter-spacing: -.5px;
}
.rating-label { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 5px; }
.rating-stars { display: flex; gap: 2px; margin-bottom: 4px; }
.star     { font-size: 12px; color: var(--brand); }
.star.off { color: var(--border); }
.rating-count { font-size: 11px; color: var(--hint); }

.review-item {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    transition: background .12s;
}
.review-item:last-child { border-bottom: none; }
.review-item:hover { background: var(--surf2); }

.review-header {
    display: flex; align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 8px;
}
.review-avatar {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: var(--brand-lt);
    border: 2px solid #fed7aa;
    color: var(--brand-dk);
    font-size: 12px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.reviewer-name { font-size: 12px; font-weight: 700; color: var(--text); }
.reviewer-date { font-size: 10px; color: var(--hint); margin-top: 1px; }
.review-stars-sm { display: flex; gap: 1px; }
.rs     { font-size: 10px; color: var(--brand); }
.rs.off { color: var(--border); }
.review-body { font-size: 12px; color: var(--muted); line-height: 1.6; }

.no-review {
    text-align: center;
    padding: 36px 20px;
    color: var(--hint);
}
.no-review i { font-size: 26px; margin-bottom: 8px; display: block; opacity: .4; }
.no-review p { font-size: 13px; }

/* ══ RIGHT PANEL ════════════════════════════════ */
.right-panel { display: none; flex-direction: column; gap: 14px; }
@media (min-width: 860px) { .right-panel { display: flex; } }

.price-card {
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
}

.price-head {
    background: var(--text);
    padding: 20px 18px;
}
.ph-label    { font-size: 10px; color: rgba(255,255,255,.5); font-weight: 700; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 8px; }
.ph-total    { font-size: 28px; font-weight: 800; color: #fff; line-height: 1; margin-bottom: 12px; letter-spacing: -.5px; }
.ph-row      { display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid rgba(255,255,255,.12); }
.ph-breakdown{ font-size: 12px; color: rgba(255,255,255,.6); font-weight: 500; }
.ph-per      { font-size: 12px; color: var(--brand); font-weight: 700; }

.price-body { padding: 14px 16px; display: flex; flex-direction: column; gap: 10px; }

.date-strip {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    background: var(--surf2);
    border-radius: var(--r);
    border: 1px solid var(--border);
}
.ds-lbl { font-size: 10px; color: var(--hint); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 2px; }
.ds-val { font-size: 13px; font-weight: 700; color: var(--text); }
.ds-arrow { color: var(--hint); font-size: 11px; }

.btn-book {
    width: 100%;
    padding: 13px;
    background: var(--brand);
    color: #fff;
    border: none;
    border-radius: var(--r);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 800;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    gap: 8px;
    transition: background .15s, transform .12s;
    text-decoration: none;
    letter-spacing: .01em;
}
.btn-book:hover  { background: var(--brand-dk); transform: translateY(-1px); }
.btn-book:active { transform: scale(.98); }
.btn-book:disabled { background: var(--border2); color: var(--hint); cursor: not-allowed; transform: none; }

.btn-back {
    width: 100%;
    padding: 11px;
    background: transparent;
    color: var(--muted);
    border: 1px solid var(--border);
    border-radius: var(--r);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 600;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    gap: 7px;
    transition: all .15s;
}
.btn-back:hover { border-color: var(--brand); color: var(--brand-dk); background: var(--brand-lt); }

.guarantees {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 14px 16px;
    border-top: 1px solid var(--border);
}
.g-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 12px; color: var(--muted); font-weight: 500;
}
.g-dot {
    width: 18px; height: 18px;
    border-radius: 50%;
    background: var(--green-lt);
    color: var(--green);
    display: flex; align-items: center; justify-content: center;
    font-size: 9px;
    flex-shrink: 0;
}

/* ══ MOBILE BOTTOM BAR ══════════════════════════ */
.mob-bottom {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: var(--surf);
    border-top: 1px solid var(--border);
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 16px;
    z-index: 50;
    box-shadow: 0 -4px 20px rgba(0,0,0,.08);
}
@media (min-width: 860px) { .mob-bottom { display: none; } }

.mob-price-lbl { font-size: 10px; color: var(--hint); font-weight: 700; text-transform: uppercase; letter-spacing: .05em; }
.mob-price-val { font-size: 20px; font-weight: 800; color: var(--text); line-height: 1; }
.mob-price-per { font-size: 10px; color: var(--hint); margin-top: 2px; }

.mob-btn {
    flex-shrink: 0;
    padding: 13px 22px;
    background: var(--brand);
    color: #fff;
    border: none;
    border-radius: var(--r);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 800;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
    transition: background .15s;
}
.mob-btn:hover { background: var(--brand-dk); }
.mob-btn:disabled { background: var(--border2); color: var(--hint); cursor: not-allowed; }

/* ══ ANIMATIONS ═════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}
.col-left > *:nth-child(1) { animation: fadeUp .3s ease both; }
.col-left > *:nth-child(2) { animation: fadeUp .3s ease .05s both; }
.col-left > *:nth-child(3) { animation: fadeUp .3s ease .10s both; }
.col-left > *:nth-child(4) { animation: fadeUp .3s ease .15s both; }
.col-left > *:nth-child(5) { animation: fadeUp .3s ease .20s both; }
.right-panel               { animation: fadeUp .3s ease .08s both; }
</style>

{{-- ══ TOP BAR ══════════════════════════════════ --}}
<div class="topbar">
    <div class="topbar-inner">
        <a class="back-btn" href="javascript:history.back()">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="tb-info">
            <div class="tb-title">{{ $car->brand }} {{ $car->name }}</div>
            <div class="tb-sub">
                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
                – {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                · {{ $duration }} Hari · Lepas Kunci
            </div>
        </div>
        <div class="avail-pill {{ $isAvailable ? 'yes' : 'no' }}">
            <div class="avail-dot"></div>
            {{ $isAvailable ? 'Tersedia' : 'Tidak Tersedia' }}
        </div>
    </div>
</div>

{{-- ══ PAGE ══════════════════════════════════════ --}}
<div class="page">

    {{-- LEFT COLUMN --}}
    <div class="col-left">

        {{-- ── Image Card ── --}}
        <div class="img-card">
            <div class="img-meta">
                <div class="car-name">{{ strtoupper($car->brand . ' ' . $car->name) }}</div>
                <div class="car-sub">{{ $car->year }} · {{ $car->category }}</div>
            </div>

            <div class="img-stage">
                @if($car->images->count() > 0)
                    <img id="mainImg"
                         src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                         alt="{{ $car->brand }} {{ $car->name }}">
                @else
                    <div class="img-placeholder-icon"><i class="fas fa-car"></i></div>
                @endif
            </div>

            <div class="quick-specs">
                <div class="qs">
                    <div class="qs-icon"><i class="fas fa-users"></i></div>
                    <div class="qs-val">{{ $car->seats ?? $car->number_of_seats ?? 6 }}</div>
                    <div class="qs-lbl">Kursi</div>
                </div>
                <div class="qs">
                    <div class="qs-icon"><i class="fas fa-cogs"></i></div>
                    <div class="qs-val">{{ ucfirst($car->transmission ?? 'Auto') }}</div>
                    <div class="qs-lbl">Transmisi</div>
                </div>
                <div class="qs">
                    <div class="qs-icon"><i class="fas fa-gas-pump"></i></div>
                    <div class="qs-val">{{ ucfirst($car->fuel_type ?? 'Bensin') }}</div>
                    <div class="qs-lbl">BBM</div>
                </div>
                <div class="qs">
                    <div class="qs-icon"><i class="fas fa-shield-alt"></i></div>
                    <div class="qs-val">Inkl.</div>
                    <div class="qs-lbl">Asuransi</div>
                </div>
            </div>

            @if($car->images->count() > 1)
            <div class="thumb-row">
                @foreach($car->images as $i => $img)
                <div class="thumb {{ $i === 0 ? 'active' : '' }}"
                     onclick="switchImg('{{ asset('storage/'.$img->image_path) }}', this)">
                    <img src="{{ asset('storage/'.$img->image_path) }}" alt="foto {{ $i+1 }}">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ── Detail Sewa ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-file-alt"></i></div>
                <div class="card-header-title">Detail Sewa</div>
            </div>
            <div class="info-row">
                <div class="ir-icon"><i class="fas fa-car"></i></div>
                <div class="ir-body">
                    <div class="ir-label">Tipe Sewa</div>
                    <div class="ir-value">Rental Harian</div>
                </div>
                <div class="ir-end"><span class="ir-chip"><i class="fas fa-key"></i> Lepas Kunci</span></div>
            </div>
            <div class="info-row">
                <div class="ir-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="ir-body">
                    <div class="ir-label">Periode Sewa</div>
                    <div class="ir-value">
                        {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
                        – {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                    </div>
                </div>
                <div class="ir-end"><span class="ir-chip">{{ $duration }} Hari</span></div>
            </div>
            <div class="info-row">
                <div class="ir-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="ir-body">
                    <div class="ir-label">Lokasi Pengambilan</div>
                    <div class="ir-value">Sesuai Kesepakatan</div>
                </div>
            </div>
        </div>

        {{-- ── Fasilitas ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-star"></i></div>
                <div class="card-header-title">Fasilitas & Keuntungan</div>
            </div>
            <div class="facility-grid">
                <div class="fac-item">
                    <div class="fac-icon"><i class="fas fa-headset"></i></div>
                    <div class="fac-text">Layanan darurat<br>24 jam</div>
                </div>
                <div class="fac-item">
                    <div class="fac-icon"><i class="fas fa-shield-alt"></i></div>
                    <div class="fac-text">Asuransi<br>comprehensive</div>
                </div>
                <div class="fac-item">
                    <div class="fac-icon"><i class="fas fa-undo-alt"></i></div>
                    <div class="fac-text">Refund<br>(ketentuan berlaku)</div>
                </div>
                <div class="fac-item">
                    <div class="fac-icon"><i class="fas fa-car-side"></i></div>
                    <div class="fac-text">Mobil pengganti<br>jika dibutuhkan</div>
                </div>
            </div>
        </div>

        {{-- ── Spesifikasi ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-cogs"></i></div>
                <div class="card-header-title">Spesifikasi Kendaraan</div>
            </div>
            <div class="specs-grid">
                <div class="spec-cell">
                    <div class="spec-icon"><i class="fas fa-users"></i></div>
                    <div class="spec-lbl">Kapasitas</div>
                    <div class="spec-val">{{ $car->seats ?? $car->number_of_seats ?? '—' }} Kursi</div>
                </div>
                <div class="spec-cell">
                    <div class="spec-icon"><i class="fas fa-cogs"></i></div>
                    <div class="spec-lbl">Transmisi</div>
                    <div class="spec-val">{{ ucfirst($car->transmission ?? 'Automatic') }}</div>
                </div>
                <div class="spec-cell">
                    <div class="spec-icon"><i class="fas fa-gas-pump"></i></div>
                    <div class="spec-lbl">Bahan Bakar</div>
                    <div class="spec-val">{{ ucfirst($car->fuel_type ?? 'Bensin') }}</div>
                </div>
                <div class="spec-cell">
                    <div class="spec-icon"><i class="fas fa-id-card"></i></div>
                    <div class="spec-lbl">Plat Nomor</div>
                    <div class="spec-val">{{ strtoupper($car->plate_number ?? $car->car_plate ?? '—') }}</div>
                </div>
                <div class="spec-cell">
                    <div class="spec-icon"><i class="fas fa-calendar"></i></div>
                    <div class="spec-lbl">Tahun</div>
                    <div class="spec-val">{{ $car->year ?? '—' }}</div>
                </div>
                <div class="spec-cell">
                    <div class="spec-icon"><i class="fas fa-tag"></i></div>
                    <div class="spec-lbl">Kategori</div>
                    <div class="spec-val">{{ $car->category ?? '—' }}</div>
                </div>
            </div>
        </div>

        {{-- ── Reviews ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-star"></i></div>
                <div class="card-header-title">Rating & Ulasan</div>
            </div>

            <div class="review-hero">
                <div class="rating-bubble">{{ number_format($averageRating ?? 4.8, 1) }}</div>
                <div>
                    <div class="rating-label">Rating Keseluruhan</div>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star star {{ $i <= round($averageRating ?? 5) ? '' : 'off' }}"></i>
                        @endfor
                    </div>
                    <div class="rating-count">{{ $reviewCount ?? 0 }} ulasan</div>
                </div>
            </div>

            @if(isset($reviews) && $reviews->count() > 0)
                @foreach($reviews->take(3) as $review)
                <div class="review-item">
                    <div class="review-header">
                        <div style="display:flex;align-items:center;gap:10px">
                            <div class="review-avatar">
                                {{ strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <div class="reviewer-name">{{ $review->user->name ?? 'Anonymous' }}</div>
                                <div class="reviewer-date">{{ $review->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="review-stars-sm">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star rs {{ $i <= $review->rating ? '' : 'off' }}"></i>
                            @endfor
                        </div>
                    </div>
                    <div class="review-body">{{ $review->comment }}</div>
                </div>
                @endforeach
            @else
                <div class="no-review">
                    <i class="far fa-star"></i>
                    <p>Belum ada ulasan untuk kendaraan ini</p>
                </div>
            @endif
        </div>

    </div>{{-- /col-left --}}

    {{-- RIGHT PANEL --}}
    <div class="right-panel">
        <div class="price-card">
            <div class="price-head">
                <div class="ph-label">Total Pembayaran</div>
                <div class="ph-total">Rp {{ number_format(($dailyPrice ?? 0) * ($duration ?? 1), 0, ',', '.') }}</div>
                <div class="ph-row">
                    <div class="ph-breakdown">{{ $duration ?? 1 }} hari × Rp {{ number_format($dailyPrice ?? 0, 0, ',', '.') }}</div>
                    <div class="ph-per">per hari</div>
                </div>
            </div>

            <div class="price-body">
                <div class="date-strip">
                    <div>
                        <div class="ds-lbl">Mulai</div>
                        <div class="ds-val">{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</div>
                    </div>
                    <i class="fas fa-arrow-right ds-arrow"></i>
                    <div style="text-align:right">
                        <div class="ds-lbl">Selesai</div>
                        <div class="ds-val">{{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</div>
                    </div>
                </div>

                @if($isAvailable)
                <form method="GET" action="{{ route('bookings.create') }}">
                    <input type="hidden" name="car"        value="{{ $car->id }}">
                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                    <input type="hidden" name="start_time" value="{{ $startTime ?? '09:00' }}">
                    <input type="hidden" name="end_date"   value="{{ $endDate }}">
                    <input type="hidden" name="end_time"   value="{{ $endTime ?? '09:00' }}">
                    <button type="submit" class="btn-book">
                        <i class="fas fa-check-circle"></i> Pesan Sekarang
                    </button>
                </form>
                @else
                <button class="btn-book" disabled>
                    <i class="fas fa-ban"></i> Tidak Tersedia
                </button>
                @endif

                <button class="btn-back" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
            </div>

            <div class="guarantees">
                <div class="g-item">
                    <div class="g-dot"><i class="fas fa-check"></i></div>
                    Pembatalan gratis (T&C berlaku)
                </div>
                <div class="g-item">
                    <div class="g-dot"><i class="fas fa-check"></i></div>
                    Asuransi comprehensive inklusif
                </div>
                <div class="g-item">
                    <div class="g-dot"><i class="fas fa-check"></i></div>
                    Dukungan 24 jam non-stop
                </div>
            </div>
        </div>
    </div>{{-- /right-panel --}}

</div>{{-- /page --}}

{{-- ══ MOBILE STICKY BOTTOM ══════════════════════ --}}
<div class="mob-bottom">
    <div style="flex:1;min-width:0">
        <div class="mob-price-lbl">Total</div>
        <div class="mob-price-val">Rp {{ number_format(($dailyPrice ?? 0) * ($duration ?? 1), 0, ',', '.') }}</div>
        <div class="mob-price-per">{{ $duration }} hari · Rp {{ number_format($dailyPrice ?? 0, 0, ',', '.') }}/hari</div>
    </div>

    @if($isAvailable)
    <form method="GET" action="{{ route('bookings.create') }}">
        <input type="hidden" name="car"        value="{{ $car->id }}">
        <input type="hidden" name="start_date" value="{{ $startDate }}">
        <input type="hidden" name="start_time" value="{{ $startTime ?? '09:00' }}">
        <input type="hidden" name="end_date"   value="{{ $endDate }}">
        <input type="hidden" name="end_time"   value="{{ $endTime ?? '09:00' }}">
        <button type="submit" class="mob-btn">
            <i class="fas fa-check-circle"></i> Pesan
        </button>
    </form>
    @else
    <button class="mob-btn" disabled>
        <i class="fas fa-ban"></i> Tidak Tersedia
    </button>
    @endif
</div>

<script>
function switchImg(src, el) {
    const img = document.getElementById('mainImg');
    if (!img) return;
    img.style.opacity = '0';
    img.style.transform = 'scale(.96)';
    setTimeout(() => {
        img.src = src;
        img.style.opacity = '1';
        img.style.transform = 'scale(1)';
    }, 180);
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}
</script>

</x-app-layout>
