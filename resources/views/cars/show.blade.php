<x-app-layout>
{{-- Car Detail Page - SQUADTRANS Theme with Enhanced Booking Calendar --}}

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

{{-- CSRF Token for AJAX --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap');

:root {
    --primary: #F59E0B;
    --primary-light: #FCD34D;
    --dark: #1F2937;
    --darker: #111827;
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.heading-font {
    font-family: 'Montserrat', sans-serif;
}

/* Image Gallery */
.gallery-main {
    position: relative;
    height: 400px;
    border-radius: 24px;
    overflow: hidden;
    background: #000;
}

@media (min-width: 768px) {
    .gallery-main {
        height: 500px;
    }
}

.gallery-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.gallery-main:hover img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.7) 100%);
}

.gallery-thumbs {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 12px;
}

@media (min-width: 768px) {
    .gallery-thumbs {
        gap: 16px;
        margin-top: 16px;
    }
}

.thumb {
    height: 80px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s;
    position: relative;
}

@media (min-width: 768px) {
    .thumb {
        height: 100px;
    }
}

.thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumb.active {
    border-color: var(--primary);
    transform: scale(1.05);
}

.thumb:hover {
    border-color: var(--primary-light);
}

/* Info Cards */
.info-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

@media (min-width: 768px) {
    .info-card {
        border-radius: 20px;
        padding: 32px;
    }
}

/* Spec Grid */
.spec-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

@media (min-width: 768px) {
    .spec-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
}

.spec-item {
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
    border: 2px solid var(--primary);
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    transition: all 0.3s;
}

.spec-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.2);
}

.spec-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
}

/* Features */
.feature-badge {
    background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
    border: 2px solid #3B82F6;
    border-radius: 12px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.feature-badge:hover {
    transform: translateX(4px);
    border-color: #2563EB;
}

/* Price Card */
.price-card {
    background: linear-gradient(135deg, var(--dark) 0%, var(--darker) 100%);
    border-radius: 20px;
    padding: 24px;
    color: white;
    position: relative;
    overflow: hidden;
}

@media (min-width: 768px) {
    .price-card {
        padding: 32px;
    }
}

.price-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(251, 191, 36, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(251, 191, 36, 0.08) 0%, transparent 50%);
}

.price-highlight {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Calendar Styles */
.calendar-container {
    background: white;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

@media (min-width: 768px) {
    .calendar-container {
        padding: 32px;
    }
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.calendar-nav {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    color: var(--darker);
    border: none;
}

.calendar-nav:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
}

.calendar-nav:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
}

.calendar-day-header {
    text-align: center;
    font-weight: 700;
    font-size: 12px;
    color: #6b7280;
    padding: 8px 0;
}

.calendar-day {
    aspect-ratio: 1;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    border: 2px solid transparent;
    position: relative;
}

.calendar-day.empty {
    cursor: default;
}

.calendar-day.available {
    background: #f3f4f6;
    color: #374151;
}

.calendar-day.available:hover {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    color: var(--darker);
    transform: scale(1.05);
}

.calendar-day.booked {
    background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
    color: #DC2626;
    cursor: not-allowed;
    border-color: #EF4444;
}

.calendar-day.selected-start,
.calendar-day.selected-end {
    background: linear-gradient(135deg, #34D399, #10B981);
    color: white;
    transform: scale(1.05);
    font-weight: 700;
}

.calendar-day.selected-range {
    background: linear-gradient(135deg, #A7F3D0, #6EE7B7);
    color: #065F46;
}

.calendar-day.today {
    border-color: #3B82F6;
    font-weight: 700;
}

.calendar-day.past {
    background: #f9fafb;
    color: #d1d5db;
    cursor: not-allowed;
}

.calendar-legend {
    display: flex;
    gap: 16px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #f3f4f6;
    flex-wrap: wrap;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
}

.legend-dot {
    width: 20px;
    height: 20px;
    border-radius: 6px;
}

/* Date Picker Section */
.date-picker-section {
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
    border: 2px solid var(--primary);
    border-radius: 16px;
    padding: 20px;
    margin-top: 20px;
}

.date-input {
    width: 100%;
    padding: 12px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s;
}

.date-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
}

/* Price Estimate Box */
.price-estimate-box {
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    border: 2px solid #10B981;
    border-radius: 16px;
    padding: 20px;
    margin-top: 20px;
    display: none;
}

.price-estimate-box.show {
    display: block;
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Reviews */
.review-card {
    background: white;
    border: 2px solid #f3f4f6;
    border-radius: 16px;
    padding: 20px;
    transition: all 0.3s;
}

.review-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1);
}

.rating-stars {
    color: var(--primary);
}

/* Buttons */
.btn {
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    cursor: pointer;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    color: var(--darker);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
}

.btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.btn-secondary {
    background: linear-gradient(135deg, var(--dark), var(--darker));
    color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.btn-outline {
    background: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
}

.btn-outline:hover {
    background: var(--primary);
    color: var(--darker);
}

/* Badges */
.badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-available {
    background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
    color: #065F46;
}

.badge-premium {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    color: var(--darker);
}

.badge-new {
    background: linear-gradient(135deg, #DBEAFE, #BFDBFE);
    color: #1E40AF;
}

/* Related Cars */
.related-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transition: all 0.3s;
}

.related-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.12);
}

.related-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.5s;
}

.related-card:hover img {
    transform: scale(1.1);
}

/* Sticky Booking */
.sticky-booking {
    position: sticky;
    top: 20px;
}

/* Loading Spinner */
.spinner {
    border: 3px solid #f3f4f6;
    border-top: 3px solid var(--primary);
    border-radius: 50%;
    width: 24px;
    height: 24px;
    animation: spin 1s linear infinite;
    display: inline-block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .spec-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .calendar-day {
        font-size: 12px;
    }

    .calendar-day-header {
        font-size: 10px;
    }
}
</style>

<div class="min-h-screen py-6 sm:py-12">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('cars.index') }}" class="text-gray-500 hover:text-yellow-500 transition">
                <i class="fa-solid fa-home"></i> Beranda
            </a>
            <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ route('cars.index') }}" class="text-gray-500 hover:text-yellow-500 transition">
                Armada
            </a>
            <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
            <span class="text-gray-900 font-semibold">{{ $car->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

            {{-- Left Column: Car Details --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Image Gallery --}}
                <div class="info-card">
                    <div class="gallery-main" id="mainImage">
                        @if($car->images->first())
                            <img src="{{ asset('storage/'.$car->images->first()->image_path) }}" alt="{{ $car->name }}">
                        @else
                            <div class="flex items-center justify-center h-full bg-gray-900">
                                <i class="fa-solid fa-car text-8xl text-gray-600"></i>
                            </div>
                        @endif
                        <div class="gallery-overlay"></div>

                        {{-- Badges Overlay --}}
                        <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
                            <span class="badge badge-premium">
                                <i class="fa-solid fa-crown"></i> PREMIUM
                            </span>
                            @if($car->is_available)
                            <span class="badge badge-available">
                                <i class="fa-solid fa-circle-check"></i> TERSEDIA
                            </span>
                            @endif
                            @if($car->year >= 2023)
                            <span class="badge badge-new">
                                <i class="fa-solid fa-sparkles"></i> NEW
                            </span>
                            @endif
                        </div>

                        {{-- Rating Overlay --}}
                        @if($averageRating > 0)
                        <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-sm px-4 py-2 rounded-xl z-10">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <span class="text-white font-bold">{{ number_format($averageRating, 1) }}</span>
                                <span class="text-gray-300 text-sm">({{ $totalReviews }})</span>
                            </div>
                        </div>
                        @endif

                        {{-- Car Info Overlay --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                            <h1 class="heading-font text-3xl sm:text-4xl font-extrabold text-white mb-2">
                                {{ $car->brand }}
                            </h1>
                            <p class="text-yellow-400 text-xl font-bold">{{ $car->name }}</p>
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    @if($car->images->count() > 1)
                    <div class="gallery-thumbs">
                        @foreach($car->images as $index => $image)
                        <div class="thumb {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage('{{ asset('storage/'.$image->image_path) }}', this)">
                            <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $car->name }}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Specifications --}}
                <div class="info-card">
                    <h3 class="heading-font text-2xl font-bold mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-car-side text-white"></i>
                        </div>
                        Spesifikasi
                    </h3>

                    <div class="spec-grid">
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-calendar-days text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Tahun</p>
                            <p class="font-bold text-lg">{{ $car->year }}</p>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-users text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Kapasitas</p>
                            <p class="font-bold text-lg">{{ $car->seats }} Orang</p>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-gears text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Transmisi</p>
                            <p class="font-bold text-lg">{{ ucfirst($car->transmission) }}</p>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-gas-pump text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Bahan Bakar</p>
                            <p class="font-bold text-lg">{{ $car->fuel_type }}</p>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-palette text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Warna</p>
                            <p class="font-bold text-lg">{{ $car->color }}</p>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-shapes text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Kategori</p>
                            <p class="font-bold text-lg">{{ ucfirst($car->category) }}</p>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-code text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Plat Nomor</p>
                            <p class="font-bold text-lg">{{ $car->plate_number }}</p>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fa-solid fa-hashtag text-xl text-gray-900"></i>
                            </div>
                            <p class="text-xs text-gray-600 mb-1">Nomor Mesin</p>
                            <p class="font-bold text-sm">{{ $car->engine_number }}</p>
                        </div>
                    </div>
                </div>

                {{-- Features --}}
                <div class="info-card">
                    <h3 class="heading-font text-2xl font-bold mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-stars text-white"></i>
                        </div>
                        Fitur & Fasilitas
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="feature-badge">
                            <i class="fa-solid fa-snowflake text-blue-500 text-xl"></i>
                            <span class="font-semibold">Air Conditioner</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fa-solid fa-shield-halved text-green-500 text-xl"></i>
                            <span class="font-semibold">Safety Features</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fa-brands fa-bluetooth-b text-blue-500 text-xl"></i>
                            <span class="font-semibold">Bluetooth Audio</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fa-solid fa-camera text-purple-500 text-xl"></i>
                            <span class="font-semibold">Parking Camera</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fa-solid fa-music text-pink-500 text-xl"></i>
                            <span class="font-semibold">Audio System</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fa-solid fa-key text-orange-500 text-xl"></i>
                            <span class="font-semibold">Keyless Entry</span>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="info-card">
                    <h3 class="heading-font text-2xl font-bold mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-file-lines text-white"></i>
                        </div>
                        Deskripsi
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $car->description ?? 'Mobil premium dengan kondisi sangat terawat dan siap menemani perjalanan Anda. Dilengkapi dengan berbagai fitur modern untuk kenyamanan maksimal.' }}
                    </p>
                </div>

                {{-- Calendar Section with Date Picker --}}
                <div class="calendar-container">
                    <h3 class="heading-font text-2xl font-bold mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-calendar-check text-white"></i>
                        </div>
                        Cek Ketersediaan & Booking
                    </h3>

                    {{-- Date Range Picker --}}
                    <div class="date-picker-section">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-calendar-plus mr-2"></i>Tanggal Mulai
                                </label>
                                <input type="date" id="startDate" class="date-input" min="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-calendar-minus mr-2"></i>Tanggal Selesai
                                </label>
                                <input type="date" id="endDate" class="date-input" min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <button type="button" id="checkAvailability" class="btn btn-primary w-full justify-center">
                            <i class="fa-solid fa-search"></i>
                            Cek Ketersediaan
                        </button>
                    </div>

                    {{-- Price Estimate Box --}}
                    <div class="price-estimate-box" id="priceEstimateBox">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-bold text-green-800 flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-2xl"></i>
                                Mobil Tersedia!
                            </h4>
                            <span class="text-sm text-green-700" id="rentalDuration"></span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-green-700">Harga Dasar:</span>
                                <span class="font-bold text-green-800" id="basePrice">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-green-700">Biaya Layanan:</span>
                                <span class="font-bold text-green-800" id="serviceCharge">Rp 0</span>
                            </div>
                            <div class="border-t-2 border-green-400 pt-2 flex justify-between">
                                <span class="font-bold text-green-800">Total Harga:</span>
                                <span class="heading-font text-2xl font-extrabold text-green-600" id="totalPrice">Rp 0</span>
                            </div>
                            <div class="text-xs text-green-700">
                                <i class="fa-solid fa-info-circle mr-1"></i>
                                DP Minimal: <span class="font-bold" id="minDeposit">Rp 0</span>
                            </div>
                        </div>

                        <a href="{{ route('bookings.create', ['car' => $car->id]) }}" id="bookNowBtn" class="btn btn-success w-full justify-center" style="background: linear-gradient(135deg, #34D399, #10B981); color: white;">
                            <i class="fa-solid fa-calendar-check"></i>
                            Lanjutkan Booking
                        </a>
                    </div>

                    {{-- Calendar Display --}}
                    <div class="mt-6">
                        <div class="calendar-header">
                            <button class="calendar-nav" id="prevMonth">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <h4 class="heading-font text-xl font-bold" id="currentMonth"></h4>
                            <button class="calendar-nav" id="nextMonth">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>

                        <div class="calendar-grid" id="calendarGrid">
                            <!-- Calendar will be generated by JavaScript -->
                        </div>

                        <div class="calendar-legend">
                            <div class="legend-item">
                                <div class="legend-dot" style="background: #f3f4f6;"></div>
                                <span>Tersedia</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background: linear-gradient(135deg, #FEE2E2, #FECACA);"></div>
                                <span>Sudah Dibooking</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background: linear-gradient(135deg, #A7F3D0, #6EE7B7);"></div>
                                <span>Range Dipilih</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="border: 2px solid #3B82F6; background: white;"></div>
                                <span>Hari Ini</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Reviews --}}
                @if($totalReviews > 0)
                <div class="info-card">
                    <h3 class="heading-font text-2xl font-bold mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-star text-white"></i>
                        </div>
                        Review ({{ $totalReviews }})
                    </h3>

                    <div class="space-y-4">
                        @foreach($car->reviews->take(5) as $review)
                        <div class="review-card">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold">{{ $review->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-700">{{ $review->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Right Column: Booking Card --}}
            <div class="lg:col-span-1">
                <div class="sticky-booking">
                    <div class="price-card">
                        <div class="price-pattern"></div>
                        <div class="relative z-10">
                            <h3 class="heading-font text-xl font-bold mb-4">Harga Sewa</h3>

                            <div class="space-y-4">
                                {{-- 24 Hours --}}
                                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-gray-300 text-sm">24 Jam</span>
                                        <span class="badge badge-premium text-xs">POPULER</span>
                                    </div>
                                    <p class="heading-font text-3xl font-extrabold price-highlight">
                                        Rp {{ number_format($car->price_24h, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- 12 Hours --}}
                                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-gray-300 text-sm">12 Jam</span>
                                    </div>
                                    <p class="heading-font text-2xl font-bold text-yellow-400">
                                        Rp {{ number_format($car->price_24h * 0.7, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Per Hour --}}
                                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-gray-300 text-sm">Per Jam</span>
                                    </div>
                                    <p class="heading-font text-2xl font-bold text-yellow-400">
                                        Rp {{ number_format($car->price_24h / 24, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-white/20">
                                <p class="text-gray-300 text-sm mb-4">
                                    <i class="fa-solid fa-info-circle mr-2"></i>
                                    DP Minimal 30% dari total harga
                                </p>

                                <div class="space-y-3">
                                    <a href="{{ route('bookings.create', ['car' => $car->id]) }}"
                                       class="btn btn-primary w-full justify-center text-lg">
                                        <i class="fa-solid fa-calendar-check"></i>
                                        Booking Sekarang
                                    </a>

                                    <a href="https://wa.me/6281234567890?text=Halo, saya tertarik dengan {{ $car->brand }} {{ $car->name }}"
                                       class="btn btn-outline w-full justify-center bg-white/10">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Hubungi Kami
                                    </a>
                                </div>
                            </div>

                            {{-- Additional Info --}}
                            <div class="mt-6 pt-6 border-t border-white/20 space-y-3 text-sm text-gray-300">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-green-400"></i>
                                    <span>Gratis antar jemput area tertentu</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-green-400"></i>
                                    <span>Mobil terawat & bersih</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-green-400"></i>
                                    <span>Customer service 24/7</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-green-400"></i>
                                    <span>Proses booking mudah & cepat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Cars --}}
        @if($relatedCars->count() > 0)
        <div class="mt-12">
            <h3 class="heading-font text-2xl sm:text-3xl font-bold mb-6">Mobil Serupa</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedCars as $relatedCar)
                <div class="related-card">
                    <div class="relative h-48 overflow-hidden">
                        @if($relatedCar->images->first())
                            <img src="{{ asset('storage/'.$relatedCar->images->first()->image_path) }}" alt="{{ $relatedCar->name }}">
                        @else
                            <div class="flex items-center justify-center h-full bg-gray-900">
                                <i class="fa-solid fa-car text-5xl text-gray-600"></i>
                            </div>
                        @endif

                        <div class="absolute top-2 left-2">
                            @if($relatedCar->is_available)
                            <span class="badge badge-available text-xs">
                                <i class="fa-solid fa-circle-check"></i> TERSEDIA
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4">
                        <h4 class="font-bold text-lg mb-1 truncate">{{ $relatedCar->brand }}</h4>
                        <p class="text-yellow-500 text-sm mb-3 truncate">{{ $relatedCar->name }}</p>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs text-gray-500">24 Jam</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($relatedCar->price_24h / 1000, 0) }}K</span>
                        </div>

                        <a href="{{ route('cars.show', $relatedCar) }}" class="btn btn-primary w-full justify-center text-sm">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- JavaScript --}}
<script>
const carId = {{ $car->id }};
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// Image Gallery
function changeMainImage(src, thumb) {
    const mainImg = document.querySelector('#mainImage img');
    mainImg.src = src;

    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}

// Calendar
const bookedDates = @json($car->bookings->map(function($booking) {
    $dates = [];
    $start = \Carbon\Carbon::parse($booking->start_datetime);
    $end = \Carbon\Carbon::parse($booking->end_datetime);

    while($start <= $end) {
        $dates[] = $start->format('Y-m-d');
        $start->addDay();
    }

    return $dates;
})->flatten()->unique()->values());

let currentDate = new Date();
let selectedStartDate = null;
let selectedEndDate = null;

const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    let html = '';

    // Day headers
    const dayHeaders = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    dayHeaders.forEach(day => {
        html += `<div class="calendar-day-header">${day}</div>`;
    });

    // Empty cells before first day
    for (let i = 0; i < firstDay; i++) {
        html += '<div class="calendar-day empty"></div>';
    }

    // Days
    for (let day = 1; day <= daysInMonth; day++) {
        const dateObj = new Date(year, month, day);
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const isBooked = bookedDates.includes(dateStr);
        const isToday = today.getTime() === dateObj.getTime();
        const isPast = dateObj < today;
        const isSelectedStart = selectedStartDate === dateStr;
        const isSelectedEnd = selectedEndDate === dateStr;
        const isInRange = selectedStartDate && selectedEndDate && dateStr > selectedStartDate && dateStr < selectedEndDate;

        let classes = 'calendar-day';

        if (isPast) {
            classes += ' past';
        } else if (isBooked) {
            classes += ' booked';
        } else {
            classes += ' available';
        }

        if (isToday) classes += ' today';
        if (isSelectedStart) classes += ' selected-start';
        if (isSelectedEnd) classes += ' selected-end';
        if (isInRange) classes += ' selected-range';

        const onclick = (!isPast && !isBooked) ? `onclick="selectDate('${dateStr}')"` : '';

        html += `<div class="${classes}" ${onclick}>${day}</div>`;
    }

    document.getElementById('calendarGrid').innerHTML = html;
}

function selectDate(dateStr) {
    if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
        // Start new selection
        selectedStartDate = dateStr;
        selectedEndDate = null;
        document.getElementById('startDate').value = dateStr;
        document.getElementById('endDate').value = '';
    } else {
        // Set end date
        if (dateStr > selectedStartDate) {
            selectedEndDate = dateStr;
            document.getElementById('endDate').value = dateStr;
        } else {
            // If selected date is before start date, make it the new start date
            selectedEndDate = selectedStartDate;
            selectedStartDate = dateStr;
            document.getElementById('startDate').value = dateStr;
            document.getElementById('endDate').value = selectedEndDate;
        }
    }

    renderCalendar();
}

document.getElementById('prevMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});

document.getElementById('nextMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

// Sync date inputs with calendar
document.getElementById('startDate').addEventListener('change', function() {
    selectedStartDate = this.value;
    renderCalendar();
});

document.getElementById('endDate').addEventListener('change', function() {
    selectedEndDate = this.value;
    renderCalendar();
});

// Check Availability
document.getElementById('checkAvailability').addEventListener('click', async function() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    if (!startDate || !endDate) {
        alert('Mohon pilih tanggal mulai dan selesai');
        return;
    }

    const button = this;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<span class="spinner"></span> Mengecek...';

    try {
        // Check availability
        const availabilityResponse = await fetch(`/api/cars/${carId}/check-availability`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                start_date: startDate,
                end_date: endDate
            })
        });

        const availabilityData = await availabilityResponse.json();

        if (!availabilityData.available) {
            alert(availabilityData.message);
            button.disabled = false;
            button.innerHTML = originalText;
            return;
        }

        // Get price estimate
        const priceResponse = await fetch(`/api/cars/${carId}/price-estimate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                start_date: startDate,
                end_date: endDate,
                service_type: 'lepas_kunci'
            })
        });

        const priceData = await priceResponse.json();

        // Display results
        document.getElementById('rentalDuration').textContent = `${priceData.days} hari`;
        document.getElementById('basePrice').textContent = `Rp ${priceData.base_price.toLocaleString('id-ID')}`;
        document.getElementById('serviceCharge').textContent = `Rp ${priceData.service_charge.toLocaleString('id-ID')}`;
        document.getElementById('totalPrice').textContent = `Rp ${priceData.total_price.toLocaleString('id-ID')}`;
        document.getElementById('minDeposit').textContent = `Rp ${priceData.min_deposit.toLocaleString('id-ID')}`;

        // Update booking link
        const bookingUrl = new URL(document.getElementById('bookNowBtn').href);
        bookingUrl.searchParams.set('start', startDate);
        bookingUrl.searchParams.set('end', endDate);
        document.getElementById('bookNowBtn').href = bookingUrl.toString();

        // Show price estimate box
        document.getElementById('priceEstimateBox').classList.add('show');

        // Scroll to price estimate
        document.getElementById('priceEstimateBox').scrollIntoView({ behavior: 'smooth', block: 'nearest' });

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    } finally {
        button.disabled = false;
        button.innerHTML = originalText;
    }
});

// Initialize calendar
renderCalendar();
</script>

</x-app-layout>
