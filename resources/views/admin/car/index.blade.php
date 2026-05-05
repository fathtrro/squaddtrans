{{-- resources/views/admin/car/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Inventaris Armada</x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        .index-page * { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Hero */
        .page-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 20px;
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            background: rgba(234,179,8,0.12);
            border-radius: 50%;
        }
        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 40%;
            width: 140px; height: 140px;
            background: rgba(234,179,8,0.06);
            border-radius: 50%;
        }
        .hero-title {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 0.25rem;
        }
        .hero-title span {
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-subtitle { color: rgba(255,255,255,0.45); font-size: 0.85rem; }

        /* Stat cards */
        .stat-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
        .stat-card {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            position: relative;
            z-index: 1;
        }
        .stat-card .s-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(255,255,255,0.45); margin-bottom: 6px; }
        .stat-card .s-value { font-size: 1.8rem; font-weight: 700; color: #fff; line-height: 1; }
        .stat-card .s-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 6px; }

        /* Toast */
        .toast-success {
            background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 12px; padding: 0.85rem 1.1rem;
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.25rem; font-size: 0.85rem; color: #166534;
        }

        /* Filter bar */
        .filter-bar {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
        }
        .search-wrap { position: relative; flex: 1; min-width: 200px; }
        .search-wrap input {
            width: 100%;
            padding: 0.6rem 0.9rem 0.6rem 2.5rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #111827;
            outline: none;
            transition: all 0.2s;
            font-family: inherit;
            box-sizing: border-box;
        }
        .search-wrap input:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,0.12); }
        .search-wrap .search-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none; }
        .search-wrap .clear-btn { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #9ca3af; line-height: 1; }
        .search-wrap .clear-btn:hover { color: #374151; }

        .filter-pills { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .pill {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem; font-weight: 600;
            border: 1.5px solid transparent;
            text-decoration: none;
            transition: all 0.15s;
            white-space: nowrap;
        }
        .pill.all       { background: #f9fafb; color: #6b7280; border-color: #e5e7eb; }
        .pill.all.active       { background: #fef9c3; color: #92400e; border-color: #fcd34d; }
        .pill.green { background: #f9fafb; color: #6b7280; border-color: #e5e7eb; }
        .pill.green.active { background: #f0fdf4; color: #166534; border-color: #86efac; }
        .pill.blue  { background: #f9fafb; color: #6b7280; border-color: #e5e7eb; }
        .pill.blue.active  { background: #eff6ff; color: #1e40af; border-color: #93c5fd; }
        .pill.orange{ background: #f9fafb; color: #6b7280; border-color: #e5e7eb; }
        .pill.orange.active{ background: #fff7ed; color: #9a3412; border-color: #fdba74; }
        .pill.red   { background: #f9fafb; color: #6b7280; border-color: #e5e7eb; }
        .pill.red.active   { background: #fef2f2; color: #991b1b; border-color: #fca5a5; }
        .pill:hover { opacity: 0.8; }

        .btn-add {
            display: flex; align-items: center; gap: 6px;
            padding: 0.6rem 1.1rem;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white; border: none; border-radius: 10px;
            font-size: 0.85rem; font-weight: 700;
            text-decoration: none; white-space: nowrap;
            box-shadow: 0 4px 12px rgba(245,158,11,0.3);
            transition: all 0.2s;
        }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(245,158,11,0.4); }

        /* Vehicle Cards */
        .fleet-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 1.5rem; }
        .v-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.06);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: all 0.2s;
        }
        .v-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }

        .v-img-wrap { position: relative; }
        .v-img-wrap img { width: 100%; height: 180px; object-fit: cover; display: block; transition: opacity 0.2s; }
        .v-card:hover .v-img-wrap img { opacity: 0.92; }

        .v-status {
            position: absolute; top: 10px; right: 10px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.65rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
        }
        .v-status.available { background: #dcfce7; color: #166534; }
        .v-status.booked    { background: #dbeafe; color: #1e40af; }
        .v-status.rented    { background: #ffedd5; color: #9a3412; }
        .v-status.maintenance { background: #fee2e2; color: #991b1b; }

        .v-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .v-card:hover .v-overlay { background: rgba(0,0,0,0.08); }

        .v-body { padding: 1rem; }
        .v-name {
            font-size: 0.92rem; font-weight: 700; color: #111827;
            text-decoration: none; display: block; margin-bottom: 3px;
            transition: color 0.15s;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .v-name:hover { color: #d97706; }
        .v-meta { font-size: 0.75rem; color: #9ca3af; margin-bottom: 0.75rem; }
        .v-meta strong { color: #374151; }

        .v-specs { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 0.75rem; }
        .v-spec-tag {
            background: #f3f4f6; color: #6b7280;
            font-size: 0.68rem; font-weight: 600;
            padding: 3px 8px; border-radius: 6px;
        }

        .v-footer {
            border-top: 1px solid #f3f4f6;
            padding-top: 0.75rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .v-price { font-size: 0.92rem; font-weight: 700; color: #d97706; }
        .v-price-label { font-size: 0.65rem; color: #9ca3af; font-weight: 500; }

        .v-actions { display: flex; gap: 4px; }
        .v-btn {
            width: 30px; height: 30px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid #e5e7eb;
            text-decoration: none;
            transition: all 0.15s;
            background: #fff;
        }
        .v-btn:hover { border-color: #d97706; background: #fef9c3; }
        .v-btn.danger:hover { border-color: #ef4444; background: #fef2f2; }
        .v-btn svg { width: 14px; height: 14px; color: #6b7280; }
        .v-btn:hover svg { color: #d97706; }
        .v-btn.danger:hover svg { color: #ef4444; }

        /* Add card */
        .add-card {
            background: #fafafa;
            border-radius: 16px;
            border: 2px dashed #e5e7eb;
            display: flex; align-items: center; justify-content: center;
            min-height: 300px; cursor: pointer;
            transition: all 0.2s; text-decoration: none;
        }
        .add-card:hover { border-color: #f59e0b; background: #fffbeb; }
        .add-card-inner { text-align: center; padding: 2rem; }
        .add-icon {
            width: 52px; height: 52px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            transition: all 0.2s;
        }
        .add-card:hover .add-icon { background: #fef3c7; }
        .add-icon svg { width: 24px; height: 24px; color: #9ca3af; transition: color 0.2s; }
        .add-card:hover .add-icon svg { color: #d97706; }
        .add-label { font-size: 0.88rem; font-weight: 700; color: #6b7280; transition: color 0.2s; }
        .add-card:hover .add-label { color: #92400e; }
        .add-sub { font-size: 0.75rem; color: #9ca3af; margin-top: 4px; }

        /* Empty state */
        .empty-state {
            grid-column: 1 / -1;
            background: #fff;
            border-radius: 16px;
            border: 2px dashed #e5e7eb;
            padding: 4rem 2rem;
            text-align: center;
        }
        .empty-icon {
            width: 64px; height: 64px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
        }

        /* Pagination */
        .pagination-wrap {
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            padding: 1rem 1.25rem;
        }

        /* Delete modal */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 50;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none;
            transition: opacity 0.2s;
        }
        .modal-overlay.open { opacity: 1; pointer-events: all; }
        .modal-box {
            background: #fff; border-radius: 18px;
            padding: 2rem; max-width: 380px; width: 90%;
            transform: scale(0.95); transition: transform 0.2s;
        }
        .modal-overlay.open .modal-box { transform: scale(1); }
        .modal-icon { width: 52px; height: 52px; background: #fef2f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
        .modal-title { font-size: 1rem; font-weight: 700; color: #111827; text-align: center; margin-bottom: 6px; }
        .modal-sub { font-size: 0.82rem; color: #6b7280; text-align: center; margin-bottom: 1.5rem; }
        .modal-actions { display: flex; gap: 10px; }
        .modal-cancel { flex: 1; padding: 0.75rem; background: #f3f4f6; border: none; border-radius: 10px; font-size: 0.88rem; font-weight: 600; cursor: pointer; font-family: inherit; color: #374151; transition: background 0.15s; }
        .modal-cancel:hover { background: #e5e7eb; }
        .modal-confirm { flex: 1; padding: 0.75rem; background: #ef4444; color: white; border: none; border-radius: 10px; font-size: 0.88rem; font-weight: 700; cursor: pointer; font-family: inherit; transition: background 0.15s; }
        .modal-confirm:hover { background: #dc2626; }

        @media (max-width: 1200px) { .fleet-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 900px)  { .fleet-grid { grid-template-columns: repeat(2, 1fr); } .stat-cards { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 600px)  { .fleet-grid { grid-template-columns: 1fr; } .stat-cards { grid-template-columns: repeat(2, 1fr); } }
    </style>

    <div class="index-page">

        <!-- Page Hero -->
        <div class="page-hero">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.5rem">
                <div>
                    <div class="hero-title">Inventaris <span>Armada</span></div>
                    <div class="hero-subtitle">Kelola dan pantau seluruh unit kendaraan operasional</div>
                </div>
                <a href="{{ route('admin.car.create') }}" class="btn-add" style="align-self:center">
                    <svg style="width:15px;height:15px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Armada
                </a>
            </div>

            <!-- Stats inside hero -->
            <div class="stat-cards">
                <div class="stat-card">
                    <div class="s-label">Total Armada</div>
                    <div class="s-value">{{ $totalCars }}</div>
                </div>
                <div class="stat-card">
                    <div class="s-label"><span class="s-dot" style="background:#4ade80"></span>Tersedia</div>
                    <div class="s-value" style="color:#4ade80">{{ $availableCars }}</div>
                </div>
                <div class="stat-card">
                    <div class="s-label"><span class="s-dot" style="background:#fb923c"></span>Disewa</div>
                    <div class="s-value" style="color:#fb923c">{{ $rentedCars }}</div>
                </div>
                <div class="stat-card">
                    <div class="s-label"><span class="s-dot" style="background:#f87171"></span>Servis</div>
                    <div class="s-value" style="color:#f87171">{{ $maintenanceCars }}</div>
                </div>
            </div>
        </div>

        <!-- Toast -->
        @if(session('success'))
            <div class="toast-success" id="toastSuccess">
                <div style="display:flex;align-items:center;gap:8px">
                    <svg style="width:16px;height:16px;color:#16a34a;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
                <button onclick="document.getElementById('toastSuccess').remove()" style="background:none;border:none;cursor:pointer;color:#16a34a;padding:0;line-height:1">
                    <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Filter Bar -->
        <div class="filter-bar">
            <!-- Search -->
            <form method="GET" action="{{ route('admin.car.index') }}" style="flex:1;min-width:200px">
                <div class="search-wrap">
                    <svg class="search-icon" style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, plat, merek...">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    @if(request('search'))
                        <a class="clear-btn" href="{{ route('admin.car.index', ['status' => request('status')]) }}">
                            <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </form>

            <!-- Status pills -->
            <div class="filter-pills">
                <a href="{{ route('admin.car.index', array_filter(['search' => request('search')])) }}"
                   class="pill all {{ !request('status') ? 'active' : '' }}">
                    Semua <span style="opacity:0.7">({{ $totalCars }})</span>
                </a>
                <a href="{{ route('admin.car.index', array_filter(['status' => 'available', 'search' => request('search')])) }}"
                   class="pill green {{ request('status') == 'available' ? 'active' : '' }}">
                    Tersedia <span style="opacity:0.7">({{ $availableCars }})</span>
                </a>
                <a href="{{ route('admin.car.index', array_filter(['status' => 'booked', 'search' => request('search')])) }}"
                   class="pill blue {{ request('status') == 'booked' ? 'active' : '' }}">
                    Dipesan <span style="opacity:0.7">({{ $bookedCars ?? 0 }})</span>
                </a>
                <a href="{{ route('admin.car.index', array_filter(['status' => 'rented', 'search' => request('search')])) }}"
                   class="pill orange {{ request('status') == 'rented' ? 'active' : '' }}">
                    Disewa <span style="opacity:0.7">({{ $rentedCars }})</span>
                </a>
                <a href="{{ route('admin.car.index', array_filter(['status' => 'maintenance', 'search' => request('search')])) }}"
                   class="pill red {{ request('status') == 'maintenance' ? 'active' : '' }}">
                    Servis <span style="opacity:0.7">({{ $maintenanceCars }})</span>
                </a>
            </div>
        </div>

        <!-- Fleet Grid -->
        <div class="fleet-grid">
            @forelse($cars as $car)
                @php
                    $statusClass = match($car->status) {
                        'available'   => 'available',
                        'booked'      => 'booked',
                        'rented'      => 'rented',
                        'maintenance' => 'maintenance',
                        default       => 'available'
                    };
                    $statusLabel = match($car->status) {
                        'available'   => 'Tersedia',
                        'booked'      => 'Dipesan',
                        'rented'      => 'Disewa',
                        'maintenance' => 'Servis',
                        default       => ucfirst($car->status)
                    };
                    $imgSrc = $car->images->first()
                        ? asset('storage/' . $car->images->first()->image_path)
                        : 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=400&h=250&fit=crop';
                @endphp

                <div class="v-card">
                    <!-- Image -->
                    <a href="{{ route('admin.car.show', $car->id) }}" class="v-img-wrap" style="display:block">
                        <img src="{{ $imgSrc }}" alt="{{ $car->name }}">
                        <div class="v-overlay"></div>
                        <span class="v-status {{ $statusClass }}">{{ $statusLabel }}</span>
                    </a>

                    <!-- Body -->
                    <div class="v-body">
                        <a href="{{ route('admin.car.show', $car->id) }}" class="v-name">{{ $car->name }}</a>
                        <div class="v-meta">
                            <strong>{{ $car->plate_number }}</strong> &nbsp;·&nbsp; {{ $car->brand }} &nbsp;·&nbsp; {{ $car->year }}
                        </div>

                        <div class="v-specs">
                            @if($car->seats)
                                <span class="v-spec-tag">{{ $car->seats }} Kursi</span>
                            @endif
                            @if($car->transmission)
                                <span class="v-spec-tag">{{ $car->transmission }}</span>
                            @endif
                            @if($car->fuel_type)
                                <span class="v-spec-tag">{{ $car->fuel_type }}</span>
                            @endif
                        </div>

                        <div class="v-footer">
                            <div>
                                <div class="v-price-label">24 Jam</div>
                                <div class="v-price">{!! \App\Helpers\PriceFormatter::display($car->price_24h) !!}</div>
                            </div>
                            <div class="v-actions">
                                <a href="{{ route('admin.car.show', $car->id) }}" class="v-btn" title="Detail">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.car.edit', $car->id) }}" class="v-btn" title="Edit">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <button type="button" class="v-btn danger" title="Hapus"
                                        onclick="openDeleteModal({{ $car->id }}, '{{ addslashes($car->name) }}')">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg style="width:28px;height:28px;color:#9ca3af" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2.5-.5M9 16H5m10 0h4a1 1 0 001-1v-3.65a1 1 0 00-.22-.624l-3.48-4.35A1 1 0 0015.52 6H13"/>
                        </svg>
                    </div>
                    <div style="font-size:1rem;font-weight:700;color:#374151;margin-bottom:6px">
                        @if(request('status') || request('search'))
                            Tidak ada hasil ditemukan
                        @else
                            Belum ada armada
                        @endif
                    </div>
                    <div style="font-size:0.82rem;color:#9ca3af;margin-bottom:1.25rem">
                        @if(request('status'))
                            Tidak ada kendaraan dengan status "{{ $statusLabel ?? request('status') }}"
                        @elseif(request('search'))
                            Tidak ada kendaraan yang cocok dengan pencarian "{{ request('search') }}"
                        @else
                            Mulai tambahkan armada untuk mengelola kendaraan operasional
                        @endif
                    </div>
                    <a href="{{ route('admin.car.create') }}" class="btn-add" style="display:inline-flex">
                        <svg style="width:15px;height:15px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Armada Pertama
                    </a>
                </div>
            @endforelse

            <!-- Add new card -->
            @if($cars->count() > 0)
                <a href="{{ route('admin.car.create') }}" class="add-card">
                    <div class="add-card-inner">
                        <div class="add-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div class="add-label">Tambah Armada Baru</div>
                        <div class="add-sub">Klik untuk menambahkan unit baru</div>
                    </div>
                </a>
            @endif
        </div>

        <!-- Pagination -->
        @if($cars->hasPages())
            <div class="pagination-wrap">
                {{ $cars->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon">
                <svg style="width:24px;height:24px;color:#ef4444" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <div class="modal-title">Hapus Armada?</div>
            <div class="modal-sub" id="deleteModalSub">Tindakan ini tidak dapat dibatalkan.</div>
            <div class="modal-actions">
                <button class="modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <form id="deleteForm" method="POST" style="flex:1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-confirm" style="width:100%">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id, name) {
            document.getElementById('deleteModalSub').textContent = `Armada "${name}" akan dihapus permanen.`;
            document.getElementById('deleteForm').action = `/admin/car/${id}`;
            document.getElementById('deleteModal').classList.add('open');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('open');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('click', function(e) {
                    if (e.target === this) closeDeleteModal();
                });
            }

            // Auto-submit search on enter
            const searchInput = document.querySelector('.search-wrap input');
            if (searchInput) {
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') this.closest('form').submit();
                });
            }

            // Close modal with Escape key
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && deleteModal && deleteModal.classList.contains('open')) {
                    closeDeleteModal();
                }
            });
        });
    </script>
</x-admin-layout>
