{{-- resources/views/admin/car/edit.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Edit Armada</x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        .edit-page * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Page header */
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
            background: rgba(234, 179, 8, 0.12);
            border-radius: 50%;
        }
        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 40%;
            width: 140px; height: 140px;
            background: rgba(234, 179, 8, 0.06);
            border-radius: 50%;
        }
        .hero-breadcrumb a {
            color: rgba(255,255,255,0.5);
            font-size: 0.78rem;
            text-decoration: none;
            letter-spacing: 0.04em;
            transition: color 0.2s;
        }
        .hero-breadcrumb a:hover { color: #fbbf24; }
        .hero-breadcrumb span { color: rgba(255,255,255,0.3); margin: 0 8px; font-size: 0.75rem; }
        .hero-breadcrumb .current { color: rgba(255,255,255,0.8); font-size: 0.78rem; }
        .hero-title {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 0.6rem;
            letter-spacing: -0.02em;
        }
        .hero-title span {
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-subtitle {
            color: rgba(255,255,255,0.45);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        /* Cards */
        .card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.06);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }
        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            background: #fafafa;
        }
        .card-icon {
            width: 34px; height: 34px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .card-icon.yellow { background: #fef9c3; }
        .card-icon.blue { background: #dbeafe; }
        .card-icon.green { background: #dcfce7; }
        .card-icon.purple { background: #ede9fe; }
        .card-header h3 {
            font-size: 0.9rem;
            font-weight: 600;
            color: #111827;
            letter-spacing: -0.01em;
        }
        .card-header p {
            font-size: 0.75rem;
            color: #9ca3af;
            margin-top: 1px;
        }
        .card-body { padding: 1.5rem; }

        /* Form inputs */
        .form-group { margin-bottom: 0; }
        .form-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
            text-transform: uppercase;
        }
        .form-label .req { color: #ef4444; font-weight: 700; margin-left: 2px; }
        .form-input {
            width: 100%;
            padding: 0.6rem 0.9rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.9rem;
            color: #111827;
            background: #fff;
            transition: all 0.2s;
            outline: none;
            font-family: inherit;
        }
        .form-input:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
        }
        .form-input.error { border-color: #ef4444; }
        .form-input::placeholder { color: #d1d5db; }
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 2.2rem;
        }
        .input-prefix {
            position: relative;
        }
        .input-prefix .prefix {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            font-size: 0.82rem;
            font-weight: 600;
            color: #9ca3af;
            pointer-events: none;
        }
        .input-prefix .form-input { padding-left: 42px; }
        .error-msg { font-size: 0.75rem; color: #ef4444; margin-top: 5px; display: flex; align-items: center; gap: 4px; }

        /* Grid */
        .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .field-grid .full { grid-column: 1 / -1; }

        /* Status radio */
        .status-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem 1rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .status-option:hover { background: #f9fafb; }
        .status-option input[type=radio] { display: none; }
        .status-dot {
            width: 14px; height: 14px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s;
        }
        .status-dot::after {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: transparent;
            transition: background 0.2s;
        }
        .status-option.active-green { border-color: #22c55e; background: #f0fdf4; }
        .status-option.active-blue { border-color: #3b82f6; background: #eff6ff; }
        .status-option.active-orange { border-color: #f97316; background: #fff7ed; }
        .status-option.active-red { border-color: #ef4444; background: #fef2f2; }
        .status-option.active-green .status-dot { border-color: #22c55e; }
        .status-option.active-blue .status-dot { border-color: #3b82f6; }
        .status-option.active-orange .status-dot { border-color: #f97316; }
        .status-option.active-red .status-dot { border-color: #ef4444; }
        .status-option.active-green .status-dot::after { background: #22c55e; }
        .status-option.active-blue .status-dot::after { background: #3b82f6; }
        .status-option.active-orange .status-dot::after { background: #f97316; }
        .status-option.active-red .status-dot::after { background: #ef4444; }
        .status-label { font-size: 0.88rem; font-weight: 600; color: #111827; }
        .status-sub { font-size: 0.73rem; color: #9ca3af; margin-top: 1px; }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        /* Image area */
        .current-images-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
        .img-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            height: 100px;
            border: 1.5px solid #e5e7eb;
            cursor: pointer;
        }
        .img-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
            transition: all 0.2s;
        }
        .img-item .img-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .img-item:hover .img-overlay { background: rgba(0,0,0,0.4); }
        .img-item .delete-btn {
            opacity: 0;
            width: 32px; height: 32px;
            background: #ef4444;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            transition: opacity 0.2s;
            color: white;
        }
        .img-item:hover .delete-btn { opacity: 1; }
        .img-item.marked .img-overlay { background: rgba(239, 68, 68, 0.6); }
        .img-item.marked img { filter: grayscale(60%); opacity: 0.7; }
        .img-item.marked .delete-btn { opacity: 1; background: #374151; }
        .img-item .restore-tag {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            background: rgba(239,68,68,0.9);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            text-align: center;
            padding: 3px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Drop zone */
        .drop-zone {
            border: 2px dashed #fcd34d;
            border-radius: 14px;
            background: #fffbeb;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .drop-zone:hover { background: #fef3c7; border-color: #f59e0b; }
        .drop-zone.drag-over { background: #fef3c7; border-color: #d97706; transform: scale(1.01); }
        .drop-icon {
            width: 48px; height: 48px;
            background: #fef9c3;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }

        /* Preview grid */
        .preview-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
        .preview-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            height: 100px;
            border: 1.5px solid #fcd34d;
            background: #fef9c3;
        }
        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .preview-item .rm-btn {
            position: absolute;
            top: 5px; right: 5px;
            width: 22px; height: 22px;
            background: rgba(239,68,68,0.9);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s;
            z-index: 10;
            border: none;
        }
        .preview-item:hover .rm-btn { opacity: 1; }
        .preview-item .primary-tag {
            position: absolute;
            top: 5px; left: 5px;
            background: #f59e0b;
            color: white;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            z-index: 10;
        }

        /* Buttons */
        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.2s;
            font-family: inherit;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 14px rgba(245, 158, 11, 0.35);
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(245, 158, 11, 0.45); }
        .btn-submit:active { transform: translateY(0); }
        .btn-cancel {
            width: 100%;
            padding: 0.85rem;
            background: #f3f4f6;
            color: #374151;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.2s;
            font-family: inherit;
            text-decoration: none;
        }
        .btn-cancel:hover { background: #e5e7eb; }

        /* Tip card */
        .tip-card {
            background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 100%);
            border-radius: 14px;
            padding: 1.25rem;
            color: white;
        }
        .tip-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 5px 0;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.75);
        }
        .tip-item::before {
            content: '→';
            color: #93c5fd;
            flex-shrink: 0;
            font-weight: 700;
        }

        /* Info strip */
        .info-strip {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.78rem;
            color: #166534;
        }

        /* Error alert */
        .error-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 10px;
        }
        .error-alert ul { margin: 4px 0 0; padding-left: 1.2rem; font-size: 0.82rem; color: #b91c1c; }
        .error-alert ul li { margin-bottom: 2px; }

        /* Section divider */
        .section-divider {
            display: flex; align-items: center; gap: 10px;
            margin: 1.5rem 0 1rem;
        }
        .section-divider .label {
            font-size: 0.72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: #9ca3af; white-space: nowrap;
        }
        .section-divider .line {
            flex: 1; height: 1px; background: #e5e7eb;
        }

        /* File count badge */
        .file-badge {
            display: inline-flex; align-items: center;
            background: #fef9c3;
            color: #92400e;
            border: 1px solid #fcd34d;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 10px;
        }

        @media (max-width: 768px) {
            .field-grid { grid-template-columns: 1fr; }
            .field-grid .full { grid-column: 1; }
            .current-images-grid { grid-template-columns: repeat(3, 1fr); }
            .preview-grid { grid-template-columns: repeat(3, 1fr); }
        }
    </style>

    <div class="edit-page">
        <!-- Page Hero -->
        <div class="page-hero">
            <div class="hero-breadcrumb" style="display:flex;align-items:center;">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>›</span>
                <a href="{{ route('admin.car.index') }}">Armada</a>
                <span>›</span>
                <span class="current">Edit Kendaraan</span>
            </div>
            <div class="hero-title">Edit <span>Armada</span></div>
            <div class="hero-subtitle">Perbarui informasi, harga, dan foto kendaraan</div>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="error-alert">
                <svg style="width:18px;height:18px;color:#ef4444;flex-shrink:0;margin-top:2px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <div style="font-size:0.85rem;font-weight:700;color:#991b1b;">Terdapat beberapa kesalahan</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;">

                <!-- LEFT COLUMN -->
                <div style="display:flex;flex-direction:column;gap:1.25rem;">

                    <!-- Basic Info Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon yellow">
                                <svg style="width:18px;height:18px;color:#d97706" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2.5-.5M9 16H5m10 0h4a1 1 0 001-1v-3.65a1 1 0 00-.22-.624l-3.48-4.35A1 1 0 0015.52 6H13"/>
                                </svg>
                            </div>
                            <div>
                                <h3>Informasi Kendaraan</h3>
                                <p>Data dasar identitas armada</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="field-grid">
                                <!-- Nama Kendaraan -->
                                <div class="form-group full">
                                    <label class="form-label">Nama Kendaraan <span class="req">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $car->name) }}"
                                           class="form-input @error('name') error @enderror"
                                           placeholder="Contoh: Toyota Avanza Veloz" required>
                                    @error('name')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Merek -->
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="req">*</span></label>
                                    <input type="text" name="brand" value="{{ old('brand', $car->brand) }}"
                                           class="form-input @error('brand') error @enderror"
                                           placeholder="Contoh: Toyota" required>
                                    @error('brand')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Tahun -->
                                <div class="form-group">
                                    <label class="form-label">Tahun <span class="req">*</span></label>
                                    <input type="number" name="year" value="{{ old('year', $car->year) }}"
                                           min="1990" max="{{ date('Y') + 1 }}"
                                           class="form-input @error('year') error @enderror"
                                           placeholder="{{ date('Y') }}" required>
                                    @error('year')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Nomor Polisi -->
                                <div class="form-group full">
                                    <label class="form-label">Nomor Polisi <span class="req">*</span></label>
                                    <input type="text" name="plate_number" value="{{ old('plate_number', $car->plate_number) }}"
                                           class="form-input @error('plate_number') error @enderror"
                                           placeholder="Contoh: B 1234 ABC"
                                           style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"
                                           required>
                                    @error('plate_number')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Type Mobil -->
                                <div class="form-group full">
                                    <label class="form-label">Tipe Kendaraan <span class="req">*</span></label>
                                    <select name="category" class="form-input form-select @error('category') error @enderror" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="MPV (keluarga)" {{ (old('category') ?? $car->category) == 'MPV (keluarga)' ? 'selected' : '' }}>🚐 MPV (keluarga)</option>
                                        <option value="SUV (tangguh/medan berat)" {{ (old('category') ?? $car->category) == 'SUV (tangguh/medan berat)' ? 'selected' : '' }}>🚙 SUV (tangguh/medan berat)</option>
                                        <option value="Hatchback (kompak)" {{ (old('category') ?? $car->category) == 'Hatchback (kompak)' ? 'selected' : '' }}>🚗 Hatchback (kompak)</option>
                                        <option value="City Car (lincah di kota)" {{ (old('category') ?? $car->category) == 'City Car (lincah di kota)' ? 'selected' : '' }}>🏙 City Car</option>
                                        <option value="Sedan (nyaman)" {{ (old('category') ?? $car->category) == 'Sedan (nyaman)' ? 'selected' : '' }}>🚘 Sedan (nyaman)</option>
                                        <option value="Crossover (kombinasi)" {{ (old('category') ?? $car->category) == 'Crossover (kombinasi)' ? 'selected' : '' }}>🚕 Crossover (kombinasi)</option>
                                    </select>
                                    @error('category')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Section divider: Spesifikasi -->
                            <div class="section-divider">
                                <div class="line"></div>
                                <div class="label">Spesifikasi</div>
                                <div class="line"></div>
                            </div>

                            <div class="field-grid">
                                <!-- Kursi -->
                                <div class="form-group">
                                    <label class="form-label">Jumlah Kursi <span class="req">*</span></label>
                                    <input type="number" name="seats" value="{{ old('seats', $car->seats) }}"
                                           min="1" placeholder="5"
                                           class="form-input @error('seats') error @enderror" required>
                                    @error('seats')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Transmisi -->
                                <div class="form-group">
                                    <label class="form-label">Transmisi <span class="req">*</span></label>
                                    <select name="transmission" class="form-input form-select @error('transmission') error @enderror" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Manual" {{ strtolower(old('transmission', $car->transmission ?? '')) == 'manual' ? 'selected' : '' }}>⚙ Manual</option>
                                        <option value="Automatic" {{ strtolower(old('transmission', $car->transmission ?? '')) == 'automatic' ? 'selected' : '' }}>🤖 Automatic</option>
                                    </select>
                                    @error('transmission')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Bahan Bakar -->
                                <div class="form-group full">
                                    <label class="form-label">Bahan Bakar <span class="req">*</span></label>
                                    <select name="fuel_type" class="form-input form-select @error('fuel_type') error @enderror" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Bensin" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'bensin' ? 'selected' : '' }}>⛽ Bensin</option>
                                        <option value="Diesel" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'diesel' ? 'selected' : '' }}>🛢 Diesel</option>
                                        <option value="Hybrid" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'hybrid' ? 'selected' : '' }}>⚡ Hybrid</option>
                                        <option value="Listrik" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'listrik' ? 'selected' : '' }}>🔋 Listrik</option>
                                    </select>
                                    @error('fuel_type')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon green">
                                <svg style="width:18px;height:18px;color:#16a34a" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3>Tarif Sewa</h3>
                                <p>Harga sewa per periode</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="max-width:320px">
                                <x-price-input
                                    name="price_24h"
                                    label="Harga per 24 Jam"
                                    :value="old('price_24h', $car->price_24h)"
                                    placeholder="Contoh: 800.000"
                                    required
                                    helpText="Harga sudah termasuk pajak dan asuransi dasar"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Photos Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon purple">
                                <svg style="width:18px;height:18px;color:#7c3aed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3>Foto Kendaraan</h3>
                                <p>Kelola gambar armada</p>
                            </div>
                        </div>
                        <div class="card-body">

                            @if($car->images->count() > 0)
                                <div class="section-divider" style="margin-top:0">
                                    <div class="label">Foto saat ini</div>
                                    <div class="line"></div>
                                    <span style="font-size:0.72rem;color:#9ca3af">{{ $car->images->count() }} foto</span>
                                </div>

                                <div class="current-images-grid" id="existingGrid">
                                    @foreach($car->images as $image)
                                        <div class="img-item" id="imgwrap-{{ $image->id }}" onclick="toggleDelete({{ $image->id }})">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="foto" id="imgel-{{ $image->id }}">
                                            <div class="img-overlay" id="overlay-{{ $image->id }}">
                                                <div class="delete-btn" id="delbtn-{{ $image->id }}">
                                                    <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <input type="checkbox" name="remove_images[]" value="{{ $image->id }}" id="chk-{{ $image->id }}" style="display:none">
                                        </div>
                                    @endforeach
                                </div>
                                <p style="font-size:0.73rem;color:#9ca3af;margin-top:8px">
                                    Klik foto untuk menandai / membatalkan penghapusan
                                </p>
                            @endif

                            <div class="section-divider">
                                <div class="label">Tambah foto baru</div>
                                <div class="line"></div>
                            </div>

                            <!-- Hidden file input -->
                            <input id="images" name="images[]" type="file" accept="image/png,image/jpeg,image/jpg" multiple style="display:none">

                            <!-- Drop zone -->
                            <div class="drop-zone" id="dropZone" onclick="document.getElementById('images').click()">
                                <div class="drop-icon">
                                    <svg style="width:22px;height:22px;color:#d97706" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <div style="font-size:0.9rem;font-weight:700;color:#374151">Klik atau drag & drop foto</div>
                                <div style="font-size:0.78rem;color:#9ca3af;margin-top:4px">PNG, JPG, JPEG — Maks. 5MB per file</div>
                            </div>

                            <!-- Error -->
                            <div id="errorMsg" style="font-size:0.78rem;color:#ef4444;margin-top:8px;display:none"></div>
                            @error('images')<div class="error-msg" style="margin-top:6px">⚠ {{ $message }}</div>@enderror
                            @error('images.*')<div class="error-msg" style="margin-top:6px">⚠ {{ $message }}</div>@enderror

                            <!-- Preview -->
                            <div id="previewSection" style="display:none;margin-top:1.5rem">
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px">
                                    <span style="font-size:0.78rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em">Preview Foto Baru</span>
                                    <span class="file-badge" id="fileCount">0 file</span>
                                </div>
                                <div class="preview-grid" id="imagePreview"></div>
                                <p style="font-size:0.72rem;color:#9ca3af;margin-top:8px">Foto pertama akan menjadi gambar utama</p>
                            </div>
                        </div>
                    </div>

                </div><!-- end left -->

                <!-- RIGHT COLUMN -->
                <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:1.5rem">

                    <!-- Status Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon blue">
                                <svg style="width:18px;height:18px;color:#2563eb" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3>Status Armada</h3>
                                <p>Kondisi saat ini</p>
                            </div>
                        </div>
                        <div class="card-body" style="display:flex;flex-direction:column;gap:8px">
                            <label class="status-option {{ old('status', $car->status) == 'available' ? 'active-green' : '' }}" id="opt-available">
                                <input type="radio" name="status" value="available"
                                       {{ old('status', $car->status) == 'available' ? 'checked' : '' }}
                                       onchange="updateStatus(this)">
                                <div style="width:10px;height:10px;border-radius:50%;background:#22c55e;flex-shrink:0"></div>
                                <div>
                                    <div class="status-label">Tersedia</div>
                                    <div class="status-sub">Siap untuk disewakan</div>
                                </div>
                            </label>

                            <label class="status-option {{ old('status', $car->status) == 'booked' ? 'active-blue' : '' }}" id="opt-booked">
                                <input type="radio" name="status" value="booked"
                                       {{ old('status', $car->status) == 'booked' ? 'checked' : '' }}
                                       onchange="updateStatus(this)">
                                <div style="width:10px;height:10px;border-radius:50%;background:#3b82f6;flex-shrink:0"></div>
                                <div>
                                    <div class="status-label">Dipesan</div>
                                    <div class="status-sub">Sudah ada pemesanan</div>
                                </div>
                            </label>

                            <label class="status-option {{ old('status', $car->status) == 'rented' ? 'active-orange' : '' }}" id="opt-rented">
                                <input type="radio" name="status" value="rented"
                                       {{ old('status', $car->status) == 'rented' ? 'checked' : '' }}
                                       onchange="updateStatus(this)">
                                <div style="width:10px;height:10px;border-radius:50%;background:#f97316;flex-shrink:0"></div>
                                <div>
                                    <div class="status-label">Sedang Disewa</div>
                                    <div class="status-sub">Dalam masa sewa aktif</div>
                                </div>
                            </label>

                            <label class="status-option {{ old('status', $car->status) == 'maintenance' ? 'active-red' : '' }}" id="opt-maintenance">
                                <input type="radio" name="status" value="maintenance"
                                       {{ old('status', $car->status) == 'maintenance' ? 'checked' : '' }}
                                       onchange="updateStatus(this)">
                                <div style="width:10px;height:10px;border-radius:50%;background:#ef4444;flex-shrink:0"></div>
                                <div>
                                    <div class="status-label">Dalam Servis</div>
                                    <div class="status-sub">Sedang maintenance</div>
                                </div>
                            </label>

                            @error('status')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card">
                        <div class="card-body" style="display:flex;flex-direction:column;gap:10px">
                            <button type="submit" class="btn-submit">
                                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.car.index') }}" class="btn-cancel">
                                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batal
                            </a>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="tip-card">
                        <div style="font-size:0.8rem;font-weight:700;color:white;margin-bottom:10px;display:flex;align-items:center;gap:6px">
                            <svg style="width:15px;height:15px;color:#93c5fd" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            Tips Edit Armada
                        </div>
                        <div class="tip-item">Pastikan data kendaraan akurat dan terkini</div>
                        <div class="tip-item">Upload foto berkualitas baik dari berbagai sudut</div>
                        <div class="tip-item">Update status secara berkala agar tidak salah booking</div>
                        <div class="tip-item">Cek harga sewa kompetitor sebagai referensi tarif</div>
                    </div>

                </div><!-- end right -->
            </div>
        </form>
    </div>

    <script>
        // Status radio style update
        const statusColors = {
            available: 'active-green',
            booked: 'active-blue',
            rented: 'active-orange',
            maintenance: 'active-red'
        };

        function updateStatus(radio) {
            Object.keys(statusColors).forEach(val => {
                const el = document.getElementById('opt-' + val);
                if (el) {
                    el.classList.remove('active-green', 'active-blue', 'active-orange', 'active-red');
                    if (val === radio.value) {
                        el.classList.add(statusColors[val]);
                    }
                }
            });
        }

        // Toggle delete for existing images
        function toggleDelete(id) {
            const chk = document.getElementById('chk-' + id);
            const wrap = document.getElementById('imgwrap-' + id);
            const delbtn = document.getElementById('delbtn-' + id);
            chk.checked = !chk.checked;
            if (chk.checked) {
                wrap.classList.add('marked');
                delbtn.style.background = '#374151';

                // Add "Hapus" tag
                let tag = document.getElementById('tag-' + id);
                if (!tag) {
                    tag = document.createElement('div');
                    tag.id = 'tag-' + id;
                    tag.className = 'restore-tag';
                    tag.textContent = '✕ Akan dihapus';
                    wrap.appendChild(tag);
                }
            } else {
                wrap.classList.remove('marked');
                delbtn.style.background = '#ef4444';
                const tag = document.getElementById('tag-' + id);
                if (tag) tag.remove();
            }
        }

        // Image upload handling
        let selectedFiles = new DataTransfer();
        const imagesInput = document.getElementById('images');
        const dropZone = document.getElementById('dropZone');
        const imagePreview = document.getElementById('imagePreview');
        const previewSection = document.getElementById('previewSection');
        const errorMsg = document.getElementById('errorMsg');
        const fileCount = document.getElementById('fileCount');

        if (imagesInput) {
            imagesInput.addEventListener('change', e => handleFiles(Array.from(e.target.files)));
        }

        if (dropZone) {
            dropZone.addEventListener('dragover', e => {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });
            dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
            dropZone.addEventListener('drop', e => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
                handleFiles(Array.from(e.dataTransfer.files));
            });
        }

        function handleFiles(files) {
            errorMsg.innerHTML = '';
            errorMsg.style.display = 'none';
            const dt = new DataTransfer();
            const errors = [];

            files.forEach(file => {
                if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
                    errors.push(`${file.name}: format tidak valid`);
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    errors.push(`${file.name}: ukuran terlalu besar (>5MB)`);
                    return;
                }
                dt.items.add(file);
            });

            selectedFiles = dt;
            imagesInput.files = selectedFiles.files;

            if (errors.length) {
                errorMsg.innerHTML = '⚠ ' + errors.join('<br>⚠ ');
                errorMsg.style.display = 'block';
            }
            renderPreviews();
        }

        function renderPreviews() {
            imagePreview.innerHTML = '';
            if (selectedFiles.files.length === 0) {
                previewSection.style.display = 'none';
                return;
            }
            previewSection.style.display = 'block';
            fileCount.textContent = `${selectedFiles.files.length} foto`;

            Array.from(selectedFiles.files).forEach((file, idx) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const div = document.createElement('div');
                    div.className = 'preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'preview';

                    const rm = document.createElement('div');
                    rm.className = 'rm-btn';
                    rm.innerHTML = `<svg style="width:10px;height:10px;color:white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>`;
                    rm.onclick = (ev) => { ev.stopPropagation(); removeImage(idx); };

                    div.appendChild(img);
                    div.appendChild(rm);

                    if (idx === 0) {
                        const tag = document.createElement('div');
                        tag.className = 'primary-tag';
                        tag.textContent = 'Utama';
                        div.appendChild(tag);
                    }
                    imagePreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        window.removeImage = function(idx) {
            const dt = new DataTransfer();
            Array.from(selectedFiles.files).forEach((f, i) => {
                if (i !== idx) dt.items.add(f);
            });
            selectedFiles = dt;
            imagesInput.files = selectedFiles.files;
            renderPreviews();
        };
    </script>
</x-admin-layout>
