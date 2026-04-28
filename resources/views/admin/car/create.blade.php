{{-- resources/views/admin/car/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Tambah Armada Baru</x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        .create-page * { font-family: 'Plus Jakarta Sans', sans-serif; }

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
        .hero-subtitle { color: rgba(255,255,255,0.45); font-size: 0.85rem; margin-top: 0.25rem; }

        .card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.06);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }
        .card-header {
            display: flex; align-items: center; gap: 10px;
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
        .card-icon.blue   { background: #dbeafe; }
        .card-icon.green  { background: #dcfce7; }
        .card-icon.purple { background: #ede9fe; }
        .card-header h3 { font-size: 0.9rem; font-weight: 600; color: #111827; letter-spacing: -0.01em; }
        .card-header p  { font-size: 0.75rem; color: #9ca3af; margin-top: 1px; }
        .card-body { padding: 1.5rem; }

        .form-group { margin-bottom: 0; }
        .form-label {
            display: block;
            font-size: 0.78rem; font-weight: 600; color: #374151;
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em; text-transform: uppercase;
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
            box-sizing: border-box;
        }
        .form-input:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,0.12); }
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
        .input-prefix { position: relative; }
        .input-prefix .prefix {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            font-size: 0.82rem; font-weight: 600; color: #9ca3af;
            pointer-events: none;
        }
        .input-prefix .form-input { padding-left: 42px; }
        .error-msg { font-size: 0.75rem; color: #ef4444; margin-top: 5px; display: flex; align-items: center; gap: 4px; }

        .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .field-grid .full { grid-column: 1 / -1; }

        .drop-zone {
            border: 2px dashed #fcd34d;
            border-radius: 14px;
            background: #fffbeb;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }
        .drop-zone:hover  { background: #fef3c7; border-color: #f59e0b; }
        .drop-zone.drag-over { background: #fef3c7; border-color: #d97706; transform: scale(1.01); }
        .drop-icon {
            width: 48px; height: 48px;
            background: #fef9c3;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }

        .preview-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
        .preview-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            width: 100%; height: 100px;
            border: 1.5px solid #fcd34d;
            background: #fef9c3;
        }
        .preview-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .preview-item .rm-btn {
            position: absolute; top: 5px; right: 5px;
            width: 22px; height: 22px;
            background: rgba(239,68,68,0.9);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; opacity: 0;
            transition: opacity 0.2s;
            z-index: 10; border: none;
        }
        .preview-item:hover .rm-btn { opacity: 1; }
        .preview-item .primary-tag {
            position: absolute; top: 5px; left: 5px;
            background: #f59e0b; color: white;
            font-size: 0.6rem; font-weight: 700;
            padding: 2px 7px; border-radius: 6px;
            text-transform: uppercase; letter-spacing: 0.05em; z-index: 10;
        }

        .file-badge {
            display: inline-flex; align-items: center;
            background: #fef9c3; color: #92400e;
            border: 1px solid #fcd34d;
            border-radius: 20px; font-size: 0.72rem; font-weight: 700; padding: 2px 10px;
        }

        .btn-submit {
            width: 100%; padding: 0.85rem;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white; border: none; border-radius: 12px;
            font-size: 0.9rem; font-weight: 700; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.2s; font-family: inherit; letter-spacing: 0.01em;
            box-shadow: 0 4px 14px rgba(245,158,11,0.35);
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(245,158,11,0.45); }
        .btn-submit:active { transform: translateY(0); }
        .btn-cancel {
            width: 100%; padding: 0.85rem;
            background: #f3f4f6; color: #374151;
            border: 1.5px solid #e5e7eb; border-radius: 12px;
            font-size: 0.9rem; font-weight: 600; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.2s; font-family: inherit; text-decoration: none;
        }
        .btn-cancel:hover { background: #e5e7eb; }

        .tip-card {
            background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 100%);
            border-radius: 14px; padding: 1.25rem; color: white;
        }
        .tip-item {
            display: flex; align-items: flex-start; gap: 8px;
            padding: 5px 0; font-size: 0.8rem; color: rgba(255,255,255,0.75);
        }
        .tip-item::before { content: '→'; color: #93c5fd; flex-shrink: 0; font-weight: 700; }

        .info-strip {
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px;
            padding: 0.75rem 1rem; display: flex; align-items: center; gap: 8px;
            font-size: 0.78rem; color: #166534;
        }

        .error-alert {
            background: #fef2f2; border: 1px solid #fecaca;
            border-radius: 12px; padding: 1rem 1.25rem;
            margin-bottom: 1.5rem; display: flex; gap: 10px;
        }
        .error-alert ul { margin: 4px 0 0; padding-left: 1.2rem; font-size: 0.82rem; color: #b91c1c; }
        .error-alert ul li { margin-bottom: 2px; }

        .section-divider {
            display: flex; align-items: center; gap: 10px;
            margin: 1.5rem 0 1rem;
        }
        .section-divider .label {
            font-size: 0.72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: #9ca3af; white-space: nowrap;
        }
        .section-divider .line { flex: 1; height: 1px; background: #e5e7eb; }

        @media (max-width: 768px) {
            .field-grid { grid-template-columns: 1fr; }
            .field-grid .full { grid-column: 1; }
            .preview-grid { grid-template-columns: repeat(3, 1fr); }
        }
    </style>

    <div class="create-page">
        <!-- Page Hero -->
        <div class="page-hero">
            <div class="hero-breadcrumb" style="display:flex;align-items:center;">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>›</span>
                <a href="{{ route('admin.car.index') }}">Armada</a>
                <span>›</span>
                <span class="current">Tambah Baru</span>
            </div>
            <div class="hero-title">Tambah <span>Armada Baru</span></div>
            <div class="hero-subtitle">Lengkapi data kendaraan untuk ditambahkan ke daftar armada</div>
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

        <form action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                                <!-- Nama -->
                                <div class="form-group full">
                                    <label class="form-label">Nama Kendaraan <span class="req">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                           class="form-input @error('name') error @enderror"
                                           placeholder="Contoh: Toyota Hiace Premio" required>
                                    @error('name')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Merek -->
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="req">*</span></label>
                                    <input type="text" name="brand" value="{{ old('brand') }}"
                                           class="form-input @error('brand') error @enderror"
                                           placeholder="Contoh: Toyota" required>
                                    @error('brand')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Tahun -->
                                <div class="form-group">
                                    <label class="form-label">Tahun <span class="req">*</span></label>
                                    <input type="number" name="year" value="{{ old('year') }}"
                                           min="1990" max="{{ date('Y') + 1 }}" placeholder="{{ date('Y') }}"
                                           class="form-input @error('year') error @enderror" required>
                                    @error('year')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Plat Nomor -->
                                <div class="form-group full">
                                    <label class="form-label">Nomor Polisi <span class="req">*</span></label>
                                    <input type="text" name="plate_number" value="{{ old('plate_number') }}"
                                           class="form-input @error('plate_number') error @enderror"
                                           placeholder="Contoh: B 1234 ABC"
                                           style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"
                                           required>
                                    @error('plate_number')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Tipe -->
                                <div class="form-group full">
                                    <label class="form-label">Tipe Kendaraan <span class="req">*</span></label>
                                    <select name="category" class="form-input form-select @error('category') error @enderror" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="MPV (keluarga)" {{ old('category') == 'MPV (keluarga)' ? 'selected' : '' }}>🚐 MPV (keluarga)</option>
                                        <option value="SUV (tangguh/medan berat)" {{ old('category') == 'SUV (tangguh/medan berat)' ? 'selected' : '' }}>🚙 SUV (tangguh/medan berat)</option>
                                        <option value="Hatchback (kompak)" {{ old('category') == 'Hatchback (kompak)' ? 'selected' : '' }}>🚗 Hatchback (kompak)</option>
                                        <option value="City Car (lincah di kota)" {{ old('category') == 'City Car (lincah di kota)' ? 'selected' : '' }}>🏙 City Car</option>
                                        <option value="Sedan (nyaman)" {{ old('category') == 'Sedan (nyaman)' ? 'selected' : '' }}>🚘 Sedan (nyaman)</option>
                                        <option value="Crossover (kombinasi)" {{ old('category') == 'Crossover (kombinasi)' ? 'selected' : '' }}>🚕 Crossover (kombinasi)</option>
                                    </select>
                                    @error('category')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="section-divider">
                                <div class="line"></div>
                                <div class="label">Spesifikasi</div>
                                <div class="line"></div>
                            </div>

                            <div class="field-grid">
                                <!-- Kursi -->
                                <div class="form-group">
                                    <label class="form-label">Jumlah Kursi <span class="req">*</span></label>
                                    <input type="number" name="seats" value="{{ old('seats') }}"
                                           min="1" placeholder="5"
                                           class="form-input @error('seats') error @enderror" required>
                                    @error('seats')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Transmisi -->
                                <div class="form-group">
                                    <label class="form-label">Transmisi <span class="req">*</span></label>
                                    <select name="transmission" class="form-input form-select @error('transmission') error @enderror" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>⚙ Manual</option>
                                        <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>🤖 Automatic</option>
                                    </select>
                                    @error('transmission')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                </div>

                                <!-- Bahan Bakar -->
                                <div class="form-group full">
                                    <label class="form-label">Bahan Bakar <span class="req">*</span></label>
                                    <select name="fuel_type" class="form-input form-select @error('fuel_type') error @enderror" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Bensin" {{ old('fuel_type') == 'Bensin' ? 'selected' : '' }}>⛽ Bensin</option>
                                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>🛢 Diesel</option>
                                        <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>⚡ Hybrid</option>
                                        <option value="Listrik" {{ old('fuel_type') == 'Listrik' ? 'selected' : '' }}>🔋 Listrik</option>
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
                                <label class="form-label">Harga per 24 Jam <span class="req">*</span></label>
                                <div class="input-prefix">
                                    <span class="prefix">Rp</span>
                                    <input type="number" name="price_24h" value="{{ old('price_24h') }}"
                                           min="0" step="1000" placeholder="800000"
                                           class="form-input @error('price_24h') error @enderror" required>
                                </div>
                                @error('price_24h')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                                <div class="info-strip" style="margin-top:10px">
                                    <svg style="width:14px;height:14px;color:#16a34a;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Harga sudah termasuk pajak dan asuransi dasar
                                </div>
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
                                <p>Upload minimal 1 foto kendaraan</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Hidden file input -->
                            <input id="images" name="images[]" type="file"
                                   accept="image/png,image/jpeg,image/jpg" multiple required
                                   style="display:none">

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
                                    <span style="font-size:0.78rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em">Preview Foto</span>
                                    <span class="file-badge" id="fileCount">0 foto</span>
                                </div>
                                <div class="preview-grid" id="imagePreview"></div>
                                <p style="font-size:0.72rem;color:#9ca3af;margin-top:8px">Foto pertama akan menjadi gambar utama</p>
                            </div>
                        </div>
                    </div>

                </div><!-- end left -->

                <!-- RIGHT COLUMN -->
                <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:1.5rem">

                    <!-- Action Buttons -->
                    <div class="card">
                        <div class="card-body" style="display:flex;flex-direction:column;gap:10px">
                            <button type="submit" class="btn-submit">
                                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Armada
                            </button>
                            <a href="{{ route('admin.car.index') }}" class="btn-cancel">
                                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batal
                            </a>
                        </div>
                    </div>

                    <!-- Checklist Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon blue">
                                <svg style="width:18px;height:18px;color:#2563eb" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3>Checklist Data</h3>
                                <p>Pastikan semua terisi</p>
                            </div>
                        </div>
                        <div class="card-body" style="display:flex;flex-direction:column;gap:8px">
                            <div id="check-name"   class="check-item" data-field="name">
                                <span class="check-dot"></span><span class="check-text">Nama kendaraan</span>
                            </div>
                            <div id="check-brand"  class="check-item" data-field="brand">
                                <span class="check-dot"></span><span class="check-text">Merek</span>
                            </div>
                            <div id="check-plate"  class="check-item" data-field="plate_number">
                                <span class="check-dot"></span><span class="check-text">Nomor polisi</span>
                            </div>
                            <div id="check-year"   class="check-item" data-field="year">
                                <span class="check-dot"></span><span class="check-text">Tahun</span>
                            </div>
                            <div id="check-cat"    class="check-item" data-field="category">
                                <span class="check-dot"></span><span class="check-text">Tipe kendaraan</span>
                            </div>
                            <div id="check-seats"  class="check-item" data-field="seats">
                                <span class="check-dot"></span><span class="check-text">Jumlah kursi</span>
                            </div>
                            <div id="check-trans"  class="check-item" data-field="transmission">
                                <span class="check-dot"></span><span class="check-text">Transmisi</span>
                            </div>
                            <div id="check-fuel"   class="check-item" data-field="fuel_type">
                                <span class="check-dot"></span><span class="check-text">Bahan bakar</span>
                            </div>
                            <div id="check-price"  class="check-item" data-field="price_24h">
                                <span class="check-dot"></span><span class="check-text">Harga sewa</span>
                            </div>
                            <div id="check-images" class="check-item" data-field="images">
                                <span class="check-dot"></span><span class="check-text">Foto kendaraan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="tip-card">
                        <div style="font-size:0.8rem;font-weight:700;color:white;margin-bottom:10px;display:flex;align-items:center;gap:6px">
                            <svg style="width:15px;height:15px;color:#93c5fd" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            Tips Tambah Armada
                        </div>
                        <div class="tip-item">Pastikan plat nomor belum terdaftar di sistem</div>
                        <div class="tip-item">Upload foto dari berbagai sudut kendaraan</div>
                        <div class="tip-item">Cek harga sewa kompetitor sebagai referensi</div>
                        <div class="tip-item">Status default adalah Tersedia setelah disimpan</div>
                    </div>

                </div><!-- end right -->
            </div>
        </form>
    </div>

    <style>
        .check-item {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 8px; border-radius: 8px;
            transition: background 0.15s;
            font-size: 0.82rem; color: #6b7280;
        }
        .check-dot {
            width: 16px; height: 16px; border-radius: 50%;
            border: 2px solid #d1d5db; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .check-item.done { color: #15803d; }
        .check-item.done .check-dot {
            border-color: #22c55e; background: #22c55e;
        }
        .check-item.done .check-dot::after {
            content: '';
            display: block; width: 5px; height: 3px;
            border-left: 2px solid white; border-bottom: 2px solid white;
            transform: rotate(-45deg) translateY(-1px);
        }
    </style>

    <script>
        // ─── Image Upload ────────────────────────────────────────────
        let selectedFiles = new DataTransfer();
        const imagesInput  = document.getElementById('images');
        const dropZone     = document.getElementById('dropZone');
        const imagePreview = document.getElementById('imagePreview');
        const previewSec   = document.getElementById('previewSection');
        const errorMsg     = document.getElementById('errorMsg');
        const fileCountEl  = document.getElementById('fileCount');

        // Drag & drop
        dropZone.addEventListener('dragover', e => {
            e.preventDefault(); dropZone.classList.add('drag-over');
        });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
        dropZone.addEventListener('drop', e => {
            e.preventDefault(); dropZone.classList.remove('drag-over');
            handleFiles(Array.from(e.dataTransfer.files));
        });

        imagesInput.addEventListener('change', e => handleFiles(Array.from(e.target.files)));

        function handleFiles(files) {
            errorMsg.innerHTML = '';
            errorMsg.style.display = 'none';
            const dt = new DataTransfer();
            const errors = [];

            files.forEach(file => {
                if (!['image/png','image/jpeg','image/jpg'].includes(file.type)) {
                    errors.push(`${file.name}: format tidak valid`); return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    errors.push(`${file.name}: ukuran >5MB`); return;
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
            updateChecklist('images', selectedFiles.files.length > 0);
        }

        function renderPreviews() {
            imagePreview.innerHTML = '';
            if (selectedFiles.files.length === 0) { previewSec.style.display = 'none'; return; }
            previewSec.style.display = 'block';
            fileCountEl.textContent = `${selectedFiles.files.length} foto`;

            Array.from(selectedFiles.files).forEach((file, idx) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const div = document.createElement('div');
                    div.className = 'preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result; img.alt = 'preview';

                    const rm = document.createElement('button');
                    rm.type = 'button'; rm.className = 'rm-btn';
                    rm.innerHTML = `<svg style="width:10px;height:10px;color:white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>`;
                    rm.onclick = ev => { ev.stopPropagation(); removeImage(idx); };

                    div.appendChild(img);
                    div.appendChild(rm);

                    if (idx === 0) {
                        const tag = document.createElement('div');
                        tag.className = 'primary-tag'; tag.textContent = 'Utama';
                        div.appendChild(tag);
                    }
                    imagePreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        window.removeImage = function(idx) {
            const dt = new DataTransfer();
            Array.from(selectedFiles.files).forEach((f, i) => { if (i !== idx) dt.items.add(f); });
            selectedFiles = dt;
            imagesInput.files = selectedFiles.files;
            renderPreviews();
            updateChecklist('images', selectedFiles.files.length > 0);
        };

        // ─── Live Checklist ──────────────────────────────────────────
        const fieldMap = {
            name: 'check-name', brand: 'check-brand', plate_number: 'check-plate',
            year: 'check-year', category: 'check-cat', seats: 'check-seats',
            transmission: 'check-trans', fuel_type: 'check-fuel', price_24h: 'check-price'
        };

        Object.entries(fieldMap).forEach(([name, checkId]) => {
            const input = document.querySelector(`[name="${name}"]`);
            if (!input) return;
            const check = () => updateChecklist(name, input.value.trim() !== '');
            input.addEventListener('input', check);
            input.addEventListener('change', check);
            // init on load (old() values)
            if (input.value.trim()) updateChecklist(name, true);
        });

        function updateChecklist(field, done) {
            const idMap = { ...fieldMap, images: 'check-images' };
            const el = document.getElementById(idMap[field] || ('check-' + field));
            if (!el) return;
            el.classList.toggle('done', done);
        }
    </script>
</x-admin-layout>
