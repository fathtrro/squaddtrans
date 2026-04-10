<x-app-layout>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
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
    --border-med:  #d1d5db;
    --bg:          #f3f4f6;
    --surface:     #ffffff;

    --r:     10px;
    --r-sm:  6px;
    --r-lg:  14px;
    --r-xl:  20px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--text);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
}

footer, header, nav { display: none !important; }

/* ══ TOP BAR ══════════════════════════════════ */
.top-bar {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 60;
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

.top-bar-title { font-size: 15px; font-weight: 700; color: var(--text); line-height: 1.2; }
.top-bar-sub   { font-size: 11px; color: var(--muted); margin-top: 2px; }

.avail-tag {
    margin-left: auto;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .03em;
    flex-shrink: 0;
}
.avail-tag.yes { background: var(--green-lt); color: var(--green); }
.avail-tag.no  { background: var(--red-soft);   color: var(--red); }
.avail-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

/* ══ PAGE LAYOUT ══════════════════════════════ */
.page { max-width: 1120px; margin: 0 auto; padding: 24px 20px 120px; }

/* Mobile: single column — Desktop: two cols */
@media (min-width: 860px) {
    .page { display: grid; grid-template-columns: 1fr 340px; gap: 24px; padding-bottom: 48px; align-items: start; }
    .right-panel { position: sticky; top: 72px; display: flex; }
}

/* ══ SECTIONS (left col) ══════════════════════ */
.col-left { display: flex; flex-direction: column; gap: 16px; }

/* ── Card shell ── */
.card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

/* ── Card section heading ── */
.card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
}

.card-header-icon {
    width: 30px; height: 30px;
    border-radius: var(--r-sm);
    background: var(--orange-dim);
    display: flex; align-items: center; justify-content: center;
    color: var(--orange-dark);
    font-size: 12px;
    flex-shrink: 0;
}

.card-header-title { font-size: 13px; font-weight: 700; color: var(--text-2); }

/* ══ IMAGE CARD ════════════════════════════════ */
.img-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.img-stage {
    background: var(--surface);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    min-height: 300px;
    width: 100%;
}

.img-stage img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.img-meta {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
}

.car-name { font-size: 18px; font-weight: 800; color: var(--text); letter-spacing: .01em; }
.car-sub  { font-size: 12px; color: var(--muted); margin-top: 3px; font-weight: 500; }

.quick-specs {
    display: flex;
    gap: 0;
    padding: 10px 16px;
    border-bottom: 1px solid var(--border);
}

.qs {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    padding: 4px 0;
}

.qs + .qs { border-left: 1px solid var(--border); }

.qs-icon {
    width: 28px; height: 28px;
    border-radius: var(--r-sm);
    background: var(--orange-dim);
    display: flex; align-items: center; justify-content: center;
    color: var(--orange-dark);
    font-size: 11px;
}

.qs-val { font-size: 12px; font-weight: 700; color: var(--text-2); }
.qs-lbl { font-size: 10px; color: var(--muted); font-weight: 500; }

/* Thumbnails */
.thumb-row {
    display: flex;
    gap: 8px;
    padding: 14px 20px;
    overflow-x: auto;
    scrollbar-width: none;
}
.thumb-row::-webkit-scrollbar { display: none; }

.thumb {
    width: 60px; height: 46px;
    border-radius: var(--r-sm);
    overflow: hidden;
    border: 2px solid transparent;
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color .15s, transform .15s;
    background: var(--bg);
}
.thumb.active { border-color: var(--orange); }
.thumb:hover  { transform: translateY(-2px); border-color: var(--orange-dark); }
.thumb img    { width: 100%; height: 100%; object-fit: cover; }

/* ══ INFO ROWS ═════════════════════════════════ */
.info-rows {}

.info-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    transition: background .12s;
}
.info-row:last-child { border-bottom: none; }
.info-row:hover { background: #fafbfd; }

.ir-icon {
    width: 36px; height: 36px;
    border-radius: var(--r);
    background: var(--orange-dim);
    display: flex; align-items: center; justify-content: center;
    color: var(--orange-dark);
    font-size: 14px;
    flex-shrink: 0;
}

.ir-body { flex: 1; min-width: 0; }
.ir-label { font-size: 11px; color: var(--muted); font-weight: 500; margin-bottom: 2px; }
.ir-value { font-size: 13px; font-weight: 700; color: var(--text-2); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.ir-end { margin-left: auto; flex-shrink: 0; }

.chip {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    background: var(--orange-soft);
    color: var(--orange-deep);
    border: 1px solid #fde68a;
}

/* ══ FACILITY LIST ══════════════════════════════ */
.facility-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.fac-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    border-right: 1px solid var(--border);
    transition: background .12s;
}

.fac-item:nth-child(even) { border-right: none; }
.fac-item:nth-last-child(-n+2) { border-bottom: none; }
.fac-item:hover { background: #fafbfd; }

.fac-icon {
    width: 32px; height: 32px;
    border-radius: var(--r-sm);
    background: var(--orange-dim);
    display: flex; align-items: center; justify-content: center;
    color: var(--orange-dark);
    font-size: 12px;
    flex-shrink: 0;
}

.fac-text { font-size: 12px; font-weight: 600; color: var(--text-3); line-height: 1.35; }

/* ══ SPECS GRID ════════════════════════════════ */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}

.spec-cell {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    border-right: 1px solid var(--border);
    transition: background .12s;
}

.spec-cell:nth-child(3n) { border-right: none; }
.spec-cell:nth-last-child(-n+3) { border-bottom: none; }
.spec-cell:hover { background: #fafbfd; }

.spec-icon {
    width: 28px; height: 28px;
    border-radius: var(--r-sm);
    background: var(--orange-dim);
    display: flex; align-items: center; justify-content: center;
    color: var(--orange-dark);
    font-size: 11px;
    margin-bottom: 8px;
}

.spec-lbl { font-size: 10px; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; font-weight: 600; margin-bottom: 3px; }
.spec-val { font-size: 13px; font-weight: 700; color: var(--text); }

/* ══ REVIEWS ═══════════════════════════════════ */
.review-hero {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    border-bottom: 1px solid var(--border);
}

.rating-bubble {
    width: 56px; height: 56px;
    border-radius: var(--r-lg);
    background: var(--orange);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; font-weight: 800; color: #fff;
    flex-shrink: 0;
    letter-spacing: -.5px;
}

.rating-label  { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 5px; }
.rating-stars  { display: flex; gap: 2px; margin-bottom: 4px; }
.star          { font-size: 12px; color: var(--orange); }
.star.off      { color: var(--border); }
.rating-count  { font-size: 11px; color: var(--muted); }

.review-item {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    transition: background .12s;
}
.review-item:last-child { border-bottom: none; }
.review-item:hover { background: #fafbfd; }

.review-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 8px;
}

.review-avatar {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: var(--orange-dim);
    border: 2px solid var(--orange-soft);
    color: var(--orange-deep);
    font-size: 12px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.reviewer-name { font-size: 12px; font-weight: 700; color: var(--text); }
.reviewer-date { font-size: 10px; color: var(--muted-lt); margin-top: 1px; }
.review-stars-sm { display: flex; gap: 1px; }
.rs { font-size: 10px; color: var(--orange); }
.rs.off { color: var(--border); }
.review-body { font-size: 12px; color: var(--muted); line-height: 1.6; }

.no-review {
    text-align: center;
    padding: 36px 20px;
    color: var(--muted-lt);
}
.no-review i { font-size: 26px; margin-bottom: 8px; display: block; opacity: .5; }
.no-review p { font-size: 13px; }

/* ══ RIGHT PANEL ═══════════════════════════════ */
.right-panel { display: none; flex-direction: column; gap: 14px; }

@media (min-width: 860px) {
    .right-panel { display: flex; }
}

.price-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow);
}

.price-head {
    background: var(--text);
    padding: 22px 20px;
}

.ph-label { font-size: 10px; color: rgba(255,255,255,.55); font-weight: 600; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 8px; }

.ph-total {
    font-size: 30px; font-weight: 800; color: #fff; line-height: 1;
    margin-bottom: 12px;
    letter-spacing: -.5px;
}

.ph-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid rgba(255,255,255,.12);
}

.ph-breakdown { font-size: 12px; color: rgba(255,255,255,.65); font-weight: 500; }
.ph-per       { font-size: 12px; color: var(--orange); font-weight: 700; }

.price-body { padding: 16px; display: flex; flex-direction: column; gap: 10px; }

.duration-strip {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    background: var(--bg);
    border-radius: var(--r);
    border: 1px solid var(--border);
}

.ds-label { font-size: 11px; color: var(--muted); font-weight: 500; }
.ds-val   { font-size: 13px; font-weight: 700; color: var(--text); }

.btn-book {
    width: 100%;
    padding: 14px;
    background: var(--orange);
    color: var(--text);
    border: none;
    border-radius: var(--r-lg);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    gap: 8px;
    transition: background .15s, transform .12s;
    text-decoration: none;
    letter-spacing: .01em;
}
.btn-book:hover  { background: var(--orange-dark); transform: translateY(-1px); }
.btn-book:active { transform: scale(.98); }
.btn-book:disabled { background: var(--border); color: var(--muted); cursor: not-allowed; transform: none; }

.btn-back {
    width: 100%;
    padding: 12px;
    background: transparent;
    color: var(--text-3);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    gap: 7px;
    transition: all .15s;
}
.btn-back:hover { border-color: var(--orange); color: var(--orange-deep); background: var(--orange-soft); }

/* Guarantee pills */
.guarantees {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 14px 16px;
    border-top: 1px solid var(--border);
}

.g-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    color: var(--muted);
    font-weight: 500;
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

/* ══ STICKY MOBILE BOTTOM ══════════════════════ */
.mob-bottom {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: var(--surface);
    border-top: 1px solid var(--border);
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    z-index: 50;
    box-shadow: 0 -4px 24px rgba(15,23,42,0.08);
}

.mob-price-lbl { font-size: 10px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; }
.mob-price-val { font-size: 20px; font-weight: 800; color: var(--text); line-height: 1; }
.mob-price-per { font-size: 10px; color: var(--muted); margin-top: 2px; }

.mob-btn {
    flex-shrink: 0;
    padding: 13px 24px;
    background: var(--orange);
    color: var(--text);
    border: none;
    border-radius: var(--r-lg);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background .15s;
}
.mob-btn:hover { background: var(--orange-dark); }
.mob-btn:disabled { background: var(--border); color: var(--muted); cursor: not-allowed; }

@media (min-width: 860px) { .mob-bottom { display: none; } }

/* ══ ANIMATIONS ════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.col-left > *:nth-child(1) { animation: fadeUp .3s ease both; }
.col-left > *:nth-child(2) { animation: fadeUp .3s ease .05s both; }
.col-left > *:nth-child(3) { animation: fadeUp .3s ease .10s both; }
.col-left > *:nth-child(4) { animation: fadeUp .3s ease .15s both; }
.right-panel               { animation: fadeUp .3s ease .08s both; }
</style>

{{-- ── TOP BAR ─────────────────────────────── --}}
<div class="top-bar">
    <a class="back-btn" href="javascript:history.back()">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <div class="top-bar-title">{{ $car->brand }} {{ $car->name }}</div>
        <div class="top-bar-sub">
            {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} – {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
            · {{ $duration }} Hari · Lepas Kunci
        </div>
    </div>
    <div class="avail-tag {{ $isAvailable ? 'yes' : 'no' }}">
        <div class="avail-dot"></div>
        {{ $isAvailable ? 'Tersedia' : 'Tidak Tersedia' }}
    </div>
</div>

{{-- ── PAGE ─────────────────────────────────── --}}
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
                    <div style="opacity:.2;font-size:72px;color:var(--orange-dark)">
                        <i class="fas fa-car"></i>
                    </div>
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

        {{-- ── Rental Info ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-file-alt"></i></div>
                <div class="card-header-title">Detail Sewa</div>
            </div>
            <div class="info-rows">
                <div class="info-row">
                    <div class="ir-icon"><i class="fas fa-car"></i></div>
                    <div class="ir-body">
                        <div class="ir-label">Tipe Sewa</div>
                        <div class="ir-value">Rental Harian</div>
                    </div>
                    <div class="ir-end"><div class="chip"><i class="fas fa-key"></i> Lepas Kunci</div></div>
                </div>
                <div class="info-row">
                    <div class="ir-icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="ir-body">
                        <div class="ir-label">Periode Sewa</div>
                        <div class="ir-value">
                            {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} – {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                        </div>
                    </div>
                    <div class="ir-end"><div class="chip">{{ $duration }} Hari</div></div>
                </div>
                <div class="info-row">
                    <div class="ir-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="ir-body">
                        <div class="ir-label">Lokasi Pengambilan</div>
                        <div class="ir-value">Sesuai Kesepakatan</div>
                    </div>
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
                    <div class="spec-val">{{ $car->plate_number ?? $car->car_plate ?? '—' }}</div>
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
                            <div class="review-avatar">{{ strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}</div>
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

                <div class="duration-strip">
                    <div>
                        <div class="ds-label">Mulai</div>
                        <div class="ds-val">{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</div>
                    </div>
                    <i class="fas fa-arrow-right" style="color:var(--muted);font-size:12px"></i>
                    <div style="text-align:right">
                        <div class="ds-label">Selesai</div>
                        <div class="ds-val">{{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</div>
                    </div>
                </div>

                @if($isAvailable)
                <form method="GET" action="{{ route('bookings.create') }}">
                    <input type="hidden" name="car"        value="{{ $car->id }}">
                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                    <input type="hidden" name="end_date"   value="{{ $endDate }}">
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

{{-- ── MOBILE STICKY BOTTOM ──────────────────── --}}
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
        <input type="hidden" name="end_date"   value="{{ $endDate }}">
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
    img.style.transition = 'opacity .18s, transform .18s';
    img.style.opacity = '0';
    img.style.transform = 'scale(.95)';
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



