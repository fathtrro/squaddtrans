{{-- resources/views/admin/renter/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Data Penyewaan</x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        .rp * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-sizing: border-box;
        }

        /* ── HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
            border-radius: 16px;
            padding: 1.75rem 2rem;
            margin-bottom: 1.25rem;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 180px;
            height: 180px;
            background: rgba(251, 191, 36, 0.10);
            border-radius: 50%;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 38%;
            width: 120px;
            height: 120px;
            background: rgba(251, 191, 36, 0.06);
            border-radius: 50%;
        }

        .hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            position: relative;
            z-index: 1;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-title {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .hero-title span {
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-sub {
            color: rgba(255, 255, 255, 0.40);
            font-size: 0.78rem;
            margin-top: 3px;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 0.5rem 1rem;
            background: #f59e0b;
            color: #fff;
            border-radius: 9px;
            font-size: 0.78rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            box-shadow: 0 3px 10px rgba(245, 158, 11, 0.3);
            transition: all 0.2s;
        }

        .btn-add:hover {
            background: #d97706;
            transform: translateY(-1px);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 12px;
            padding: 0.85rem 1rem;
        }

        .stat-label {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.40);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }

        .stat-val {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }

        /* ── TOAST ── */
        .toast-ok {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.82rem;
            color: #166534;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            padding: 0.85rem 1.1rem;
            margin-bottom: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
            flex: 1;
            min-width: 180px;
        }

        .search-wrap input {
            width: 100%;
            padding: 0.5rem 0.8rem 0.5rem 2.2rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 9px;
            font-size: 0.8rem;
            outline: none;
            color: #111827;
            font-family: inherit;
            transition: border-color 0.15s;
        }

        .search-wrap input:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.10);
        }

        .search-wrap .si {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            color: #9ca3af;
            pointer-events: none;
        }

        .search-wrap .cx {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            line-height: 1;
        }

        .search-wrap .cx:hover {
            color: #374151;
        }

        .pills {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .pill {
            padding: 4px 11px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            border: 1.5px solid #e5e7eb;
            background: #f9fafb;
            color: #6b7280;
            text-decoration: none;
            white-space: nowrap;
            transition: opacity 0.15s;
        }

        .pill:hover { opacity: 0.8; }
        .pill.all.on    { background: #fef9c3; color: #92400e; border-color: #fcd34d; }
        .pill.yellow.on { background: #fefce8; color: #92400e; border-color: #fde68a; }
        .pill.blue.on   { background: #eff6ff; color: #1e40af; border-color: #93c5fd; }
        .pill.purple.on { background: #f5f3ff; color: #4c1d95; border-color: #c4b5fd; }
        .pill.green.on  { background: #f0fdf4; color: #166534; border-color: #86efac; }
        .pill.red.on    { background: #fef2f2; color: #991b1b; border-color: #fca5a5; }

        .date-sel {
            padding: 0.5rem 0.8rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 9px;
            font-size: 0.78rem;
            color: #374151;
            outline: none;
            background: #fff;
            cursor: pointer;
            font-family: inherit;
            transition: border-color 0.15s;
        }

        .date-sel:focus { border-color: #f59e0b; }

        /* ── DESKTOP TABLE ── */
        .table-wrap {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .rtable {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .rtable thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .rtable thead th {
            padding: 0.7rem 1rem;
            text-align: left;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #9ca3af;
            white-space: nowrap;
        }

        .rtable thead th.tc { text-align: center; }

        .rtable tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.12s;
        }

        .rtable tbody tr:last-child { border-bottom: none; }
        .rtable tbody tr:hover { background: #fafbfc; }

        .rtable tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
        }

        .rtable tbody td.tc { text-align: center; }

        /* ── MOBILE CARDS ── */
        .mobile-list {
            display: none;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .m-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .m-card-head {
            padding: 0.85rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            border-bottom: 1px solid #f1f5f9;
        }

        .m-card-body {
            padding: 0.85rem 1rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.6rem 1rem;
        }

        .m-card-foot {
            padding: 0.75rem 1rem;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .m-field-label {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #9ca3af;
            margin-bottom: 2px;
        }

        .m-field-val {
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
        }

        .m-field-sub {
            font-size: 0.7rem;
            color: #9ca3af;
            margin-top: 1px;
        }

        /* ── SHARED ATOMS ── */
        .bk-code {
            font-size: 0.78rem;
            font-weight: 700;
            color: #111827;
            font-family: 'Courier New', monospace;
            letter-spacing: -0.01em;
        }

        .svc-tag {
            display: inline-block;
            background: #eff6ff;
            color: #1e40af;
            font-size: 0.58rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 4px;
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .cust-av {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .cust-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cust-email {
            font-size: 0.72rem;
            color: #9ca3af;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .car-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: #111827;
        }

        .car-plate {
            font-size: 0.72rem;
            color: #9ca3af;
            font-family: 'Courier New', monospace;
            margin-top: 1px;
        }

        .p-start {
            font-size: 0.78rem;
            color: #374151;
            font-weight: 500;
        }

        .p-end {
            font-size: 0.72rem;
            color: #9ca3af;
            margin-top: 1px;
        }

        .price {
            font-size: 0.9rem;
            font-weight: 700;
            color: #d97706;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            white-space: nowrap;
        }

        .b-pending   { background: #fefce8; color: #92400e; }
        .b-confirmed { background: #eff6ff; color: #1e40af; }
        .b-running   { background: #f5f3ff; color: #4c1d95; }
        .b-completed { background: #f0fdf4; color: #166534; }
        .b-cancelled { background: #fef2f2; color: #991b1b; }

        .late-text { font-size: 0.72rem; font-weight: 700; color: #dc2626; line-height: 1.3; }
        .late-text .late-label {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #ef4444;
            opacity: 0.75;
            display: block;
            margin-bottom: 1px;
        }

        .acts { display: inline-flex; gap: 3px; align-items: center; }

        .ab {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            border: 1px solid #e5e7eb;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }

        .ab svg { width: 13px; height: 13px; color: #9ca3af; transition: color 0.15s; }
        .ab:hover          { border-color: #d97706; background: #fef9c3; }
        .ab:hover svg      { color: #d97706; }
        .ab.g:hover        { border-color: #22c55e; background: #f0fdf4; }
        .ab.g:hover svg    { color: #16a34a; }
        .ab.b:hover        { border-color: #3b82f6; background: #eff6ff; }
        .ab.b:hover svg    { color: #2563eb; }
        .ab.p:hover        { border-color: #8b5cf6; background: #f5f3ff; }
        .ab.p:hover svg    { color: #7c3aed; }
        .ab.d:hover        { border-color: #ef4444; background: #fef2f2; }
        .ab.d:hover svg    { color: #ef4444; }

        .m-action-link {
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            padding: 5px 0;
        }

        .m-action-link.wf { color: #16a34a; }
        .m-action-link.dt { color: #2563eb; }
        .m-action-link.ed { color: #7c3aed; }
        .m-action-link.dl {
            color: #ef4444;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .m-actions-group {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .empty-wrap { padding: 3.5rem 2rem; text-align: center; }

        .empty-icon {
            width: 56px;
            height: 56px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .pag-wrap {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            padding: 1rem 1.25rem;
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            padding: 1rem;
        }

        .modal-overlay.open { opacity: 1; pointer-events: all; }

        .modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            max-width: 370px;
            width: 100%;
            transform: scale(0.95);
            transition: transform 0.2s;
        }

        .modal-overlay.open .modal-box { transform: scale(1); }

        .modal-icon {
            width: 48px;
            height: 48px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .modal-title { font-size: 0.95rem; font-weight: 700; color: #111827; text-align: center; margin-bottom: 5px; }
        .modal-sub   { font-size: 0.8rem; color: #6b7280; text-align: center; margin-bottom: 1.5rem; }

        .modal-btns { display: flex; gap: 8px; }

        .m-cancel {
            flex: 1;
            padding: 0.7rem;
            background: #f3f4f6;
            border: none;
            border-radius: 9px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            color: #374151;
            transition: background 0.15s;
        }

        .m-cancel:hover { background: #e5e7eb; }

        .m-confirm {
            flex: 1;
            padding: 0.7rem;
            background: #ef4444;
            color: #fff;
            border: none;
            border-radius: 9px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s;
        }

        .m-confirm:hover { background: #dc2626; }

        /* ── RESPONSIVE ── */

        /* Tablet landscape ~1024px: 3 kolom stat */
        @media (max-width: 1024px) {
            .stat-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Tablet portrait ~900px: tabel dengan scroll horizontal */
        @media (max-width: 900px) {
            .table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .rtable {
                table-layout: auto;
                min-width: 700px;
            }
        }

        /* Tablet ~768px: sembunyikan tabel, tampilkan kartu */
        @media (max-width: 768px) {
            .page-hero {
                padding: 1.25rem 1.1rem;
                border-radius: 14px;
            }

            .hero-title { font-size: 1.2rem; }
            .hero-sub   { font-size: 0.72rem; }

            .stat-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 0.5rem;
            }

            .stat-card {
                padding: 0.65rem 0.75rem;
                border-radius: 10px;
            }

            .stat-val   { font-size: 1.3rem; }
            .stat-label { font-size: 0.55rem; }

            .filter-bar {
                padding: 0.75rem;
                gap: 0.6rem;
            }

            .pills  { gap: 4px; }
            .pill   { font-size: 0.65rem; padding: 3px 9px; }

            /* Sembunyikan tabel desktop, tampilkan kartu mobile */
            .table-wrap  { display: none; }
            .mobile-list { display: flex; }
        }

        /* Ponsel ~600px: filter bar full-width vertikal */
        @media (max-width: 600px) {
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrap { min-width: unset; }

            .date-sel { width: 100%; }

            .pills { justify-content: flex-start; }
        }

        /* Ponsel ~480px: stat 2 kolom */
        @media (max-width: 480px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-grid .stat-card:first-child {
                grid-column: 1 / -1;
            }

            .m-card-body {
                grid-template-columns: 1fr 1fr;
            }

            .btn-add span { display: none; }

            .m-card-foot {
                flex-direction: column;
                align-items: flex-start;
            }

            .m-actions-group {
                gap: 10px;
            }
        }

        /* Ponsel XS ~360px */
        @media (max-width: 360px) {
            .stat-grid {
                grid-template-columns: 1fr 1fr;
            }

            .m-card-body {
                grid-template-columns: 1fr;
            }

            .hero-title { font-size: 1.05rem; }

            .stat-val   { font-size: 1.1rem; }

            .pill { font-size: 0.6rem; padding: 3px 7px; }

            .modal-box { padding: 1.25rem; }
        }
    </style>

    <div class="rp">

        {{-- ── Hero ── --}}
        <div class="page-hero">
            <div class="hero-top">
                <div>
                    <div class="hero-title">Data <span>Penyewaan</span></div>
                    <div class="hero-sub">Kelola dan pantau seluruh pemesanan kendaraan</div>
                </div>
                <a href="{{ route('admin.renter.create') }}" class="btn-add">
                    <svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Penyewa</span>
                </a>
            </div>
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-label">Total</div>
                    <div class="stat-val">{{ $allBookings ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label"><span class="stat-dot" style="background:#fbbf24"></span>Menunggu</div>
                    <div class="stat-val" style="color:#fbbf24">{{ $renters->where('status', 'pending')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label"><span class="stat-dot" style="background:#60a5fa"></span>Dikonfirmasi</div>
                    <div class="stat-val" style="color:#60a5fa">{{ $renters->where('status', 'confirmed')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label"><span class="stat-dot" style="background:#a78bfa"></span>Berjalan</div>
                    <div class="stat-val" style="color:#a78bfa">{{ $renters->where('status', 'running')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label"><span class="stat-dot" style="background:#4ade80"></span>Selesai</div>
                    <div class="stat-val" style="color:#4ade80">{{ $renters->where('status', 'completed')->count() }}</div>
                </div>
            </div>
        </div>

        {{-- ── Toast ── --}}
        @if (session('success'))
            <div class="toast-ok" id="toastOk">
                <div style="display:flex;align-items:center;gap:8px">
                    <svg style="width:15px;height:15px;color:#16a34a;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
                <button onclick="document.getElementById('toastOk').remove()"
                    style="background:none;border:none;cursor:pointer;color:#16a34a;padding:0">
                    <svg style="width:15px;height:15px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- ── Filter Bar ── --}}
        <div class="filter-bar">
            <form method="GET" action="{{ route('admin.renter.index') }}" style="flex:1;min-width:160px">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <input type="hidden" name="date_range" value="{{ request('date_range') }}">
                <div class="search-wrap">
                    <svg class="si" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari booking / customer...">
                    @if (request('search'))
                        <a class="cx"
                            href="{{ route('admin.renter.index', array_filter(['status' => request('status'), 'date_range' => request('date_range')])) }}">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>

            <div class="pills">
                @php
                    $s = request('status');
                    $q = array_filter(['search' => request('search'), 'date_range' => request('date_range')]);
                @endphp
                <a href="{{ route('admin.renter.index', $q) }}" class="pill all    {{ !$s ? 'on' : '' }}">Semua</a>
                <a href="{{ route('admin.renter.index', array_merge($q, ['status' => 'pending'])) }}"    class="pill yellow {{ $s == 'pending'   ? 'on' : '' }}">Menunggu</a>
                <a href="{{ route('admin.renter.index', array_merge($q, ['status' => 'confirmed'])) }}"  class="pill blue   {{ $s == 'confirmed' ? 'on' : '' }}">Dikonfirmasi</a>
                <a href="{{ route('admin.renter.index', array_merge($q, ['status' => 'running'])) }}"   class="pill purple {{ $s == 'running'   ? 'on' : '' }}">Berjalan</a>
                <a href="{{ route('admin.renter.index', array_merge($q, ['status' => 'completed'])) }}" class="pill green  {{ $s == 'completed' ? 'on' : '' }}">Selesai</a>
                <a href="{{ route('admin.renter.index', array_merge($q, ['status' => 'cancelled'])) }}" class="pill red    {{ $s == 'cancelled' ? 'on' : '' }}">Dibatalkan</a>
            </div>

            <form method="GET" action="{{ route('admin.renter.index') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <select name="date_range" class="date-sel" onchange="this.form.submit()">
                    <option value="">Semua Tanggal</option>
                    <option value="today"      {{ request('date_range') == 'today'      ? 'selected' : '' }}>Hari Ini</option>
                    <option value="7days"      {{ request('date_range') == '7days'      ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="30days"     {{ request('date_range') == '30days'     ? 'selected' : '' }}>30 Hari Terakhir</option>
                    <option value="this_month" {{ request('date_range') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                </select>
            </form>
        </div>

        {{-- ── DESKTOP TABLE (≥769px) ── --}}
        <div class="table-wrap">
            <table class="rtable">
                <colgroup>
                    <col style="width:15%">
                    <col style="width:18%">
                    <col style="width:16%">
                    <col style="width:14%">
                    <col style="width:10%">
                    <col style="width:10%">
                    <col style="width:10%">
                    <col style="width:7%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Booking</th>
                        <th>Customer</th>
                        <th>Kendaraan</th>
                        <th>Periode</th>
                        <th>Terlambat</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="tc">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($renters as $renter)
                        @php
                            $ini = collect(explode(' ', $renter->user->name))
                                ->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
                            $avc = match ($renter->status) {
                                'pending'   => ['bg' => '#fefce8', 'cl' => '#92400e'],
                                'confirmed' => ['bg' => '#eff6ff', 'cl' => '#1e40af'],
                                'running'   => ['bg' => '#f5f3ff', 'cl' => '#4c1d95'],
                                'completed' => ['bg' => '#f0fdf4', 'cl' => '#166534'],
                                'cancelled' => ['bg' => '#fef2f2', 'cl' => '#991b1b'],
                                default     => ['bg' => '#f3f4f6', 'cl' => '#374151'],
                            };
                            $slbl = match ($renter->status) {
                                'pending'   => 'Menunggu',
                                'confirmed' => 'Dikonfirmasi',
                                'running'   => 'Berjalan',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                default     => ucfirst($renter->status),
                            };
                            $now   = \Carbon\Carbon::now();
                            $endDt = \Carbon\Carbon::parse($renter->end_datetime);
                            $isLate  = in_array($renter->status, ['running', 'confirmed']) && $now->gt($endDt);
                            $lateStr = null;
                            if ($isLate) {
                                $diff  = $endDt->diff($now);
                                $days  = (int) $diff->days;
                                $hours = (int) $diff->h;
                                $mins  = (int) $diff->i;
                                if ($days > 0 && $hours > 0)    $lateStr = "{$days} hari {$hours} jam";
                                elseif ($days > 0)              $lateStr = "{$days} hari";
                                elseif ($hours > 0)             $lateStr = "{$hours} jam";
                                else                            $lateStr = "{$mins} menit";
                            }
                        @endphp
                        <tr>
                            <td>
                                <div class="bk-code">{{ $renter->booking_code }}</div>
                                <span class="svc-tag">{{ str_replace('_', ' ', $renter->service_type) }}</span>
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;min-width:0">
                                    <div class="cust-av" style="background:{{ $avc['bg'] }};color:{{ $avc['cl'] }}">{{ $ini }}</div>
                                    <div style="min-width:0">
                                        <div class="cust-name">{{ $renter->user->name }}</div>
                                        <div class="cust-email">{{ $renter->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="car-name">{{ $renter->car->name }}</div>
                                <div class="car-plate">{{ $renter->car->plate_number }}</div>
                            </td>
                            <td>
                                <div class="p-start">{{ \Carbon\Carbon::parse($renter->start_datetime)->format('d M Y') }}</div>
                                <div class="p-end">s/d {{ \Carbon\Carbon::parse($renter->end_datetime)->format('d M Y') }}</div>
                            </td>
                            <td>
                                @if ($renter->return_datetime)
                                    <div class="late-text">
                                        <span class="late-label">Terlambat</span>
                                        {{ $renter->return_datetime }}
                                    </div>
                                @elseif ($lateStr)
                                    <div class="late-text">
                                        <span class="late-label">Terlambat</span>
                                        {{ $lateStr }}
                                    </div>
                                @else
                                    <div style="font-size:0.78rem;color:#9ca3af">-</div>
                                @endif
                            </td>
                            <td>
                                <div class="price">Rp {{ number_format($renter->total_price, 0, ',', '.') }}</div>
                            </td>
                            <td><span class="badge b-{{ $renter->status }}">{{ $slbl }}</span></td>
                            <td class="tc">
                                <div class="acts">
                                    <a href="{{ route('admin.renter.workflow', $renter->id) }}" class="ab g" title="Alur Kerja">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.renter.show', $renter->id) }}" class="ab b" title="Detail">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.renter.edit', $renter->id) }}" class="ab p" title="Edit">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button type="button" class="ab d" title="Hapus"
                                        onclick="openDel({{ $renter->id }},'{{ addslashes($renter->booking_code) }}')">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-wrap">
                                    <div class="empty-icon">
                                        <svg style="width:24px;height:24px;color:#9ca3af" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div style="font-size:0.95rem;font-weight:700;color:#374151;margin-bottom:5px">
                                        {{ request('status') || request('search') ? 'Tidak ada hasil ditemukan' : 'Belum ada data penyewaan' }}
                                    </div>
                                    <div style="font-size:0.8rem;color:#9ca3af;margin-bottom:1.1rem">
                                        @if (request('search'))
                                            Tidak ada penyewaan cocok dengan "{{ request('search') }}"
                                        @elseif (request('status'))
                                            Tidak ada penyewaan dengan status tersebut
                                        @else
                                            Data penyewaan akan muncul di sini setelah ada pemesanan
                                        @endif
                                    </div>
                                    <a href="{{ route('admin.renter.create') }}" class="btn-add">
                                        <svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Tambah Penyewa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── MOBILE CARDS (≤768px) ── --}}
        <div class="mobile-list">
            @forelse($renters as $renter)
                @php
                    $ini = collect(explode(' ', $renter->user->name))
                        ->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
                    $avc = match ($renter->status) {
                        'pending'   => ['bg' => '#fefce8', 'cl' => '#92400e'],
                        'confirmed' => ['bg' => '#eff6ff', 'cl' => '#1e40af'],
                        'running'   => ['bg' => '#f5f3ff', 'cl' => '#4c1d95'],
                        'completed' => ['bg' => '#f0fdf4', 'cl' => '#166534'],
                        'cancelled' => ['bg' => '#fef2f2', 'cl' => '#991b1b'],
                        default     => ['bg' => '#f3f4f6', 'cl' => '#374151'],
                    };
                    $slbl = match ($renter->status) {
                        'pending'   => 'Menunggu',
                        'confirmed' => 'Dikonfirmasi',
                        'running'   => 'Berjalan',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default     => ucfirst($renter->status),
                    };
                    $nowM   = \Carbon\Carbon::now();
                    $endDtM = \Carbon\Carbon::parse($renter->end_datetime);
                    $isLateM  = in_array($renter->status, ['running', 'confirmed']) && $nowM->gt($endDtM);
                    $lateStrM = null;
                    if ($isLateM) {
                        $diffM  = $endDtM->diff($nowM);
                        $daysM  = (int) $diffM->days;
                        $hoursM = (int) $diffM->h;
                        $minsM  = (int) $diffM->i;
                        if ($daysM > 0 && $hoursM > 0)  $lateStrM = "{$daysM} hari {$hoursM} jam";
                        elseif ($daysM > 0)             $lateStrM = "{$daysM} hari";
                        elseif ($hoursM > 0)            $lateStrM = "{$hoursM} jam";
                        else                            $lateStrM = "{$minsM} menit";
                    }
                @endphp
                <div class="m-card">
                    <div class="m-card-head">
                        <div style="display:flex;align-items:center;gap:10px;min-width:0">
                            <div class="cust-av" style="background:{{ $avc['bg'] }};color:{{ $avc['cl'] }}">{{ $ini }}</div>
                            <div style="min-width:0">
                                <div class="cust-name">{{ $renter->user->name }}</div>
                                <div style="display:flex;align-items:center;gap:6px;margin-top:2px;flex-wrap:wrap">
                                    <div class="bk-code" style="font-size:0.7rem">{{ $renter->booking_code }}</div>
                                    <span class="svc-tag">{{ str_replace('_', ' ', $renter->service_type) }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="badge b-{{ $renter->status }}" style="flex-shrink:0">{{ $slbl }}</span>
                    </div>

                    <div class="m-card-body">
                        <div>
                            <div class="m-field-label">Kendaraan</div>
                            <div class="m-field-val">{{ $renter->car->name }}</div>
                            <div class="m-field-sub car-plate">{{ $renter->car->plate_number }}</div>
                        </div>
                        <div>
                            <div class="m-field-label">Total</div>
                            <div class="price">Rp {{ number_format($renter->total_price, 0, ',', '.') }}</div>
                        </div>
                        <div>
                            <div class="m-field-label">Mulai</div>
                            <div class="m-field-val">{{ \Carbon\Carbon::parse($renter->start_datetime)->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div class="m-field-label">Selesai</div>
                            <div class="m-field-val">{{ \Carbon\Carbon::parse($renter->end_datetime)->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div class="m-field-label">Terlambat</div>
                            @if ($renter->return_datetime)
                                <div class="late-text">{{ $renter->return_datetime }}</div>
                            @elseif ($lateStrM)
                                <div class="late-text">{{ $lateStrM }}</div>
                            @else
                                <div style="font-size:0.78rem;color:#9ca3af">-</div>
                            @endif
                        </div>
                    </div>

                    <div class="m-card-foot">
                        <div class="m-actions-group">
                            <a href="{{ route('admin.renter.workflow', $renter->id) }}" class="m-action-link wf">
                                <svg style="width:12px;height:12px;display:inline;margin-right:3px;vertical-align:-1px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Alur Kerja
                            </a>
                            <a href="{{ route('admin.renter.show', $renter->id) }}" class="m-action-link dt">
                                <svg style="width:12px;height:12px;display:inline;margin-right:3px;vertical-align:-1px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                            <a href="{{ route('admin.renter.edit', $renter->id) }}" class="m-action-link ed">
                                <svg style="width:12px;height:12px;display:inline;margin-right:3px;vertical-align:-1px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                        </div>
                        <button type="button" class="m-action-link dl"
                            onclick="openDel({{ $renter->id }},'{{ addslashes($renter->booking_code) }}')">
                            <svg style="width:12px;height:12px;display:inline;margin-right:3px;vertical-align:-1px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div style="background:#fff;border-radius:14px;border:1px solid #e5e7eb;padding:3rem 1.5rem;text-align:center">
                    <div class="empty-icon">
                        <svg style="width:24px;height:24px;color:#9ca3af" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div style="font-size:0.9rem;font-weight:700;color:#374151;margin-bottom:5px">Belum ada data penyewaan</div>
                    <div style="font-size:0.78rem;color:#9ca3af;margin-bottom:1rem">Data penyewaan akan muncul di sini</div>
                    <a href="{{ route('admin.renter.create') }}" class="btn-add" style="display:inline-flex">
                        <svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Penyewa
                    </a>
                </div>
            @endforelse
        </div>

        {{-- ── Pagination ── --}}
        @if ($renters->hasPages())
            <div class="pag-wrap">{{ $renters->links() }}</div>
        @endif
    </div>

    {{-- ── Delete Modal ── --}}
    <div class="modal-overlay" id="delModal">
        <div class="modal-box">
            <div class="modal-icon">
                <svg style="width:22px;height:22px;color:#ef4444" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="modal-title">Hapus Data Penyewaan?</div>
            <div class="modal-sub" id="delSub">Tindakan ini tidak dapat dibatalkan.</div>
            <div class="modal-btns">
                <button class="m-cancel" onclick="closeDel()">Batal</button>
                <form id="delForm" method="POST" style="flex:1">
                    @csrf @method('DELETE')
                    <button type="submit" class="m-confirm" style="width:100%">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDel(id, code) {
            document.getElementById('delSub').textContent = `Booking "${code}" akan dihapus permanen.`;
            document.getElementById('delForm').action = `/admin/renter/${id}`;
            document.getElementById('delModal').classList.add('open');
        }

        function closeDel() {
            document.getElementById('delModal').classList.remove('open');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const delModal = document.getElementById('delModal');
            if (delModal) {
                delModal.addEventListener('click', e => {
                    if (e.target === delModal) closeDel();
                });
            }

            const searchInput = document.querySelector('.search-wrap input');
            if (searchInput) {
                searchInput.addEventListener('keydown', e => {
                    if (e.key === 'Enter') e.target.closest('form').submit();
                });
            }

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && delModal && delModal.classList.contains('open')) {
                    closeDel();
                }
            });
        });
    </script>
</x-admin-layout>
