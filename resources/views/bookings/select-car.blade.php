<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold:    #d97706;
            --gold-lt: #f59e0b;
            --dark:    #0c0f18;
            --surface: #ffffff;
            --border:  #e9eaec;
            --text:    #1a1d27;
            --muted:   #6b7280;
            --radius:  14px;
            --success: #10b981;
            --danger:  #ef4444;
        }

        body { background: #f4f5f7; }

        /* ─── HERO ─────────────────────── */
        .hero {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            background: url('/images/download.jpeg') center/cover no-repeat;
            margin-bottom: 24px;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10, 13, 26, 0.88) 0%, rgba(20, 26, 46, 0.72) 50%, rgba(10, 13, 26, 0.60) 100%);
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 32px 32px;
            z-index: 0;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .hero-inner { flex-direction: row; align-items: center; justify-content: space-between; padding: 40px 48px; }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.16);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 5px 12px 5px 8px;
            border-radius: 99px;
            margin-bottom: 14px;
        }

        .hero-badge-dot {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.25);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { box-shadow: 0 0 0 3px rgba(16,185,129,0.25); }
            50%       { box-shadow: 0 0 0 6px rgba(16,185,129,0.10); }
        }

        .hero-badge span {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.8);
        }

        .hero-title {
            font-size: clamp(26px, 5vw, 44px);
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .hero-title em { font-style: italic; color: #fbbf24; }

        .hero-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,0.6);
            line-height: 1.6;
            max-width: 400px;
        }

        .hero-stats { display: flex; gap: 10px; flex-shrink: 0; }

        @media (max-width: 767px) { .hero-stats { gap: 8px; } }

        .stat-pill {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.13);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 14px;
            padding: 14px 16px;
            min-width: 76px;
            transition: background 0.25s;
        }

        @media (min-width: 768px) { .stat-pill { padding: 18px 24px; min-width: 96px; } }

        .stat-pill:hover { background: rgba(255,255,255,0.13); }

        .stat-num {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }

        @media (min-width: 768px) { .stat-num { font-size: 34px; } }

        .stat-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
        }

        /* ─── INFO BOX ────────────────────── */
        .info-box {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            padding: 18px 20px;
            margin-bottom: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05), 0 4px 16px rgba(0,0,0,0.03);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            font-size: 13px;
        }

        .info-row:last-child { padding-bottom: 0; }

        .info-row + .info-row { border-top: 1px solid var(--border); padding-top: 10px; }

        .info-label { color: var(--muted); font-weight: 500; }

        .info-value { color: var(--text); font-weight: 700; }

        .info-value.highlight { color: var(--gold); }

        /* ─── CARS GRID ─────────────────────── */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 18px;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .cars-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px; }
        }

        @media (max-width: 480px) {
            .cars-grid { grid-template-columns: 1fr; gap: 12px; }
        }

        /* Car Card */
        .car-card {
            background: var(--surface);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05), 0 4px 16px rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.34, 1.36, 0.64, 1);
            display: flex;
            flex-direction: column;
            border: 1.5px solid var(--border);
            position: relative;
        }

        .car-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 32px rgba(217, 119, 6, 0.15);
            border-color: var(--gold-lt);
        }

        .car-card.unavailable {
            opacity: 0.65;
            pointer-events: none;
        }

        .car-image-wrap {
            position: relative;
            width: 100%;
            height: 150px;
            background: linear-gradient(135deg, #f0f4f8, #e8edf2);
            overflow: hidden;
        }

        .car-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .car-card:hover .car-image { transform: scale(1.05); }

        .car-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--success);
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            backdrop-filter: blur(8px);
        }

        .car-badge.unavailable { background: var(--danger); }

        .car-content {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .car-header {
            margin-bottom: 12px;
        }

        .car-name {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }

        .car-plate {
            font-size: 11px;
            color: var(--muted);
        }

        .car-specs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
            font-size: 12px;
        }

        .spec {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
        }

        .spec i {
            color: var(--gold);
            font-size: 11px;
            width: 14px;
            text-align: center;
        }

        .car-price {
            margin-bottom: 12px;
        }

        .price-label {
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 2px;
        }

        .price-value {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--gold);
        }

        .car-btn {
            width: 100%;
            padding: 10px 12px;
            background: linear-gradient(135deg, var(--gold-lt), var(--gold));
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: auto;
        }

        .car-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.35);
        }

        .car-btn:active { transform: translateY(0); }

        .car-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: 0 1px 4px rgba(0,0,0,0.05), 0 4px 16px rgba(0,0,0,0.03);
            grid-column: 1 / -1;
        }

        .empty-icon { font-size: 3rem; margin-bottom: 1rem; color: var(--muted); }

        .empty-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .empty-text { color: var(--muted); margin-bottom: 1.5rem; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s;
            font-size: 13px;
        }

        .back-link:hover { border-color: var(--gold); color: var(--gold); background: #fffbf0; }

    </style>

    <main class="max-w-7xl mx-auto px-4 md:px-8 py-6 pt-24">

        {{-- ─── HERO ─────────────────────────── --}}
        <div class="hero mb-6">
            <div class="hero-inner">
                <div>
                    <div class="hero-badge">
                        <div class="hero-badge-dot"></div>
                        <span>Mobil Tersedia</span>
                    </div>
                    <h1 class="hero-title">
                        Pilih Mobil<br>
                        <em>Impian Anda</em>
                    </h1>
                    <p class="hero-subtitle">
                        Kendaraan premium terpilih yang sesuai dengan tanggal penyewaan Anda.
                    </p>
                </div>

                <div class="hero-stats">
                    <div class="stat-pill">
                        <div class="stat-num" id="totalCars">0</div>
                        <div class="stat-label">Tersedia</div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-num">4.8</div>
                        <div class="stat-label">Rating</div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-num">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── INFO BOX ─────────────────────────── --}}
        <div class="info-box">
            <div class="info-row">
                <span class="info-label">📅 Tanggal Mulai:</span>
                <span class="info-value" id="infoStartDate">-</span>
            </div>
            <div class="info-row">
                <span class="info-label">📅 Tanggal Selesai:</span>
                <span class="info-value" id="infoEndDate">-</span>
            </div>
            <div class="info-row">
                <span class="info-label">⏱️ Durasi:</span>
                <span class="info-value highlight" id="infoDuration">-</span>
            </div>
        </div>

        {{-- ─── CARS GRID ─────────────────────── --}}
        <div id="carsContainer" class="cars-grid">
            <!-- Cars akan dimuat di sini via JavaScript -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div class="empty-title">Memuat Mobil...</div>
                <p class="empty-text">Segera kami tampilkan daftar mobil yang tersedia untuk tanggal pilihan Anda.</p>
            </div>
        </div>

    </main>

    <script>
        // Get dates from URL
        const urlParams = new URLSearchParams(window.location.search);
        const startDate = urlParams.get('start_date');
        const endDate = urlParams.get('end_date');

        // Format date helper
        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return new Intl.DateTimeFormat('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }).format(date);
        }

        // Calculate duration
        function calculateDuration() {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffTime = end - start;
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        }

        // Update info box
        document.getElementById('infoStartDate').textContent = formatDate(startDate);
        document.getElementById('infoEndDate').textContent = formatDate(endDate);
        document.getElementById('infoDuration').textContent = calculateDuration() + ' Hari';

        // Load cars
        async function loadCars() {
            try {
                const response = await fetch(`/api/bookings/available-cars?start_date=${startDate}&end_date=${endDate}`);
                const data = await response.json();
                const cars = data.cars;

                // Update total cars count
                const availableCars = cars.filter(c => c.is_available).length;
                document.getElementById('totalCars').textContent = availableCars;

                const container = document.getElementById('carsContainer');

                if (cars.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="empty-title">Tidak Ada Mobil Tersedia</div>
                            <p class="empty-text">Maaf, tidak ada mobil yang tersedia untuk tanggal yang dipilih. Silakan coba tanggal lain.</p>
                            <a href="{{ route('cars.index') }}" class="back-link">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    `;
                    return;
                }

                // Separate available and unavailable
                const available = cars.filter(c => c.is_available);
                const unavailable = cars.filter(c => !c.is_available);

                let html = '';

                // Available cars
                available.forEach(car => {
                    const pricePerDay = car.daily_rent_price || 0;
                    const duration = calculateDuration();
                    const totalPrice = pricePerDay * duration;

                    html += `
                        <div class="car-card">
                            <div class="car-image-wrap">
                                <img src="${car.main_image_url || '/images/placeholder.jpg'}" alt="${car.brand}" class="car-image">
                                <div class="car-badge">Tersedia</div>
                            </div>
                            <div class="car-content">
                                <div class="car-header">
                                    <div class="car-name">${car.brand} ${car.name}</div>
                                    <div class="car-plate">${car.car_plate || '-'}</div>
                                </div>
                                <div class="car-specs">
                                    <div class="spec">
                                        <i class="fas fa-users"></i>
                                        <span>${car.number_of_seats || 5} Kursi</span>
                                    </div>
                                    <div class="spec">
                                        <i class="fas fa-cogs"></i>
                                        <span>${car.transmission || 'Manual'}</span>
                                    </div>
                                    <div class="spec">
                                        <i class="fas fa-gas-pump"></i>
                                        <span>${car.engine_capacity || '1.5L'}</span>
                                    </div>
                                    <div class="spec">
                                        <i class="fas fa-road"></i>
                                        <span>${car.fuel_type || 'Bensin'}</span>
                                    </div>
                                </div>
                                <div class="car-price">
                                    <div class="price-label">Harga Total</div>
                                    <div class="price-value">Rp ${totalPrice.toLocaleString('id-ID')}</div>
                                </div>
                                <a href="#" onclick="goToCarDetail(${car.id}, '${startDate}', '${endDate}'); return false;" class="car-btn">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    `;
                });

                // Show unavailable separately if any
                if (unavailable.length > 0) {
                    unavailable.forEach(car => {
                        const pricePerDay = car.daily_rent_price || 0;
                        const duration = calculateDuration();
                        const totalPrice = pricePerDay * duration;

                        html += `
                            <div class="car-card unavailable">
                                <div class="car-image-wrap">
                                    <img src="${car.main_image_url || '/images/placeholder.jpg'}" alt="${car.brand}" class="car-image">
                                    <div class="car-badge unavailable">Dipesan</div>
                                </div>
                                <div class="car-content">
                                    <div class="car-header">
                                        <div class="car-name">${car.brand} ${car.name}</div>
                                        <div class="car-plate">${car.car_plate || '-'}</div>
                                    </div>
                                    <div class="car-specs">
                                        <div class="spec">
                                            <i class="fas fa-users"></i>
                                            <span>${car.number_of_seats || 5} Kursi</span>
                                        </div>
                                        <div class="spec">
                                            <i class="fas fa-cogs"></i>
                                            <span>${car.transmission || 'Manual'}</span>
                                        </div>
                                        <div class="spec">
                                            <i class="fas fa-gas-pump"></i>
                                            <span>${car.engine_capacity || '1.5L'}</span>
                                        </div>
                                        <div class="spec">
                                            <i class="fas fa-road"></i>
                                            <span>${car.fuel_type || 'Bensin'}</span>
                                        </div>
                                    </div>
                                    <div class="car-price">
                                        <div class="price-label">Harga Total</div>
                                        <div class="price-value">Rp ${totalPrice.toLocaleString('id-ID')}</div>
                                    </div>
                                    <button class="car-btn" disabled>
                                        <i class="fas fa-ban"></i> Tidak Tersedia
                                    </button>
                                </div>
                            </div>
                        `;
                    });
                }

                container.innerHTML = html;
            } catch (error) {
                console.error('Error loading cars:', error);
                document.getElementById('carsContainer').innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="empty-title">Terjadi Kesalahan</div>
                        <p class="empty-text">Maaf, terjadi kesalahan saat memuat data mobil. Silakan coba lagi nanti.</p>
                        <a href="{{ route('cars.index') }}" class="back-link">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                `;
            }
        }

        // Load cars on page load
        document.addEventListener('DOMContentLoaded', loadCars);

        // Navigate to car detail page
        function goToCarDetail(carId, startDate, endDate) {
            window.location.href = `/bookings/car-detail/${carId}?start_date=${startDate}&end_date=${endDate}`;
        }
    </script>

</x-app-layout>
