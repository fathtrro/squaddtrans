<x-app-layout>
{{-- Fleet Listing Page - SQUADTRANS Enhanced --}}

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
.heading-font { font-family: 'Montserrat', sans-serif; }

/* Hero Banner */
.hero-banner {
    background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
    border-radius: 24px;
    overflow: hidden;
    position: relative;
}

.hero-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(251, 191, 36, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(251, 191, 36, 0.08) 0%, transparent 50%);
}

/* Filter Section */
.filter-bar {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    backdrop-filter: blur(10px);
}

.filter-btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
}

.filter-btn:hover {
    transform: translateY(-2px);
    border-color: var(--primary);
}

.filter-btn.active {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    color: #111827;
    font-weight: 700;
}

/* Fleet Cards */
.fleet-card {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    border: 1px solid rgba(0,0,0,0.06);
}

.fleet-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.fleet-card:hover img {
    transform: scale(1.15);
}

.fleet-card img {
    transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.gradient-overlay {
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 40%, rgba(0,0,0,0.95) 100%);
}

/* Price Display */
.price-highlight {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
    transform: translateY(-2px);
}

.btn-secondary {
    background: linear-gradient(135deg, #1F2937, #111827);
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}

.btn-outline {
    border: 2px solid #F59E0B;
    background: transparent;
    color: #F59E0B;
    transition: all 0.3s ease;
}

.btn-outline:hover {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    color: #111827;
}

/* Feature Icons */
.feature-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    border-radius: 50%;
    font-size: 11px;
}

/* Spec Items */
.spec-item {
    border-left: 3px solid #FCD34D;
    padding-left: 12px;
    transition: all 0.3s ease;
}

.spec-item:hover {
    transform: translateX(6px);
    border-color: #F59E0B;
}

/* Badges */
.badge-premium {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    animation: pulse-glow 2s infinite;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 10px rgba(245, 158, 11, 0.4); }
    50% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.6); }
}

.badge-status {
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
}

/* Sort Dropdown */
.sort-dropdown {
    position: relative;
}

.sort-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 8px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    min-width: 200px;
    z-index: 50;
    display: none;
}

.sort-dropdown:hover .sort-menu {
    display: block;
}

.sort-menu a {
    padding: 12px 20px;
    display: block;
    transition: all 0.2s;
}

.sort-menu a:hover {
    background: #f8fafc;
    color: var(--primary);
}

/* View Toggle */
.view-btn {
    padding: 10px 14px;
    border-radius: 10px;
    transition: all 0.3s;
    cursor: pointer;
}

.view-btn:hover {
    background: #f1f5f9;
}

.view-btn.active {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    color: #111827;
}

/* Stats Cards */
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: all 0.3s;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

/* Loading Skeleton */
.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Compare Badge */
.compare-badge {
    position: absolute;
    top: 16px;
    right: 16px;
    background: white;
    border-radius: 12px;
    padding: 8px 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: all 0.3s;
}

.compare-badge:hover {
    background: #FCD34D;
    transform: scale(1.1);
}

.compare-badge input[type="checkbox"] {
    cursor: pointer;
}

/* Comparison Bar */
.comparison-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #1F2937, #111827);
    color: white;
    padding: 20px;
    transform: translateY(100%);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 100;
    box-shadow: 0 -10px 40px rgba(0,0,0,0.3);
}

.comparison-bar.show {
    transform: translateY(0);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-banner { border-radius: 16px; }
    .filter-bar { border-radius: 16px; }
}
</style>

<main class="max-w-7xl mx-auto px-4 py-8">

{{-- Hero Banner --}}
<div class="hero-banner mb-10 relative overflow-hidden">
    <div class="hero-pattern"></div>
    <div class="relative z-10 p-8 md:p-12">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex-1">
                <span class="inline-block px-4 py-1 bg-yellow-400/20 text-yellow-400 text-xs font-bold rounded-full mb-4 border border-yellow-400/30">
                    <i class="fa-solid fa-star"></i> PREMIUM FLEET
                </span>
                <h1 class="heading-font text-4xl md:text-5xl font-extrabold text-white mb-3">
                    Armada Terbaik<br>Untuk Perjalanan Anda
                </h1>
                <p class="text-gray-300 max-w-xl text-lg">
                    Lebih dari 50+ unit premium siap menemani setiap momen perjalanan Anda dengan kenyamanan maksimal.
                </p>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="stat-card text-center">
                    <div class="text-3xl font-bold price-highlight">50+</div>
                    <div class="text-xs text-gray-500 mt-1">Unit Tersedia</div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-3xl font-bold price-highlight">4.8</div>
                    <div class="text-xs text-gray-500 mt-1">Rating</div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-3xl font-bold price-highlight">24/7</div>
                    <div class="text-xs text-gray-500 mt-1">Support</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Search Section --}}
<div class="filter-bar p-6 mb-8">
    <div class="flex flex-col lg:flex-row gap-4 items-center justify-between mb-6">
        {{-- Search Bar --}}
        <div class="flex-1 w-full lg:max-w-md relative">
            <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text"
                   placeholder="Cari mobil (brand, tipe, tahun...)"
                   class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-yellow-400 focus:outline-none transition">
        </div>

        {{-- View Toggle & Sort --}}
        <div class="flex items-center gap-3">
            {{-- View Toggle --}}
            <div class="flex bg-gray-100 rounded-xl p-1">
                <button class="view-btn active">
                    <i class="fa-solid fa-grid-2"></i>
                </button>
                <button class="view-btn">
                    <i class="fa-solid fa-list"></i>
                </button>
            </div>

            {{-- Sort Dropdown --}}
            <div class="sort-dropdown">
                <button class="flex items-center gap-2 px-4 py-3 bg-gray-100 rounded-xl font-semibold hover:bg-gray-200 transition">
                    <i class="fa-solid fa-sort"></i>
                    <span>Urutkan</span>
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>
                <div class="sort-menu">
                    <a href="#"><i class="fa-solid fa-star text-yellow-500 mr-2"></i> Rating Tertinggi</a>
                    <a href="#"><i class="fa-solid fa-dollar-sign text-green-500 mr-2"></i> Harga Terendah</a>
                    <a href="#"><i class="fa-solid fa-dollar-sign text-red-500 mr-2"></i> Harga Tertinggi</a>
                    <a href="#"><i class="fa-solid fa-calendar text-blue-500 mr-2"></i> Terbaru</a>
                    <a href="#"><i class="fa-solid fa-fire text-orange-500 mr-2"></i> Terpopuler</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Category Filters --}}
    <div class="flex flex-wrap gap-3">
        <button class="filter-btn active px-5 py-2 rounded-full font-semibold text-sm">
            <i class="fa-solid fa-layer-group mr-2"></i>Semua
        </button>
        <button class="filter-btn px-5 py-2 rounded-full font-semibold text-sm bg-gray-50 hover:bg-gray-100">
            <i class="fa-solid fa-car mr-2"></i>Sedan
        </button>
        <button class="filter-btn px-5 py-2 rounded-full font-semibold text-sm bg-gray-50 hover:bg-gray-100">
            <i class="fa-solid fa-truck-pickup mr-2"></i>SUV
        </button>
        <button class="filter-btn px-5 py-2 rounded-full font-semibold text-sm bg-gray-50 hover:bg-gray-100">
            <i class="fa-solid fa-van-shuttle mr-2"></i>MPV
        </button>
        <button class="filter-btn px-5 py-2 rounded-full font-semibold text-sm bg-gray-50 hover:bg-gray-100">
            <i class="fa-solid fa-car-side mr-2"></i>Hatchback
        </button>
        <button class="filter-btn px-5 py-2 rounded-full font-semibold text-sm bg-gray-50 hover:bg-gray-100">
            <i class="fa-solid fa-charging-station mr-2"></i>Electric
        </button>
        <button class="filter-btn px-5 py-2 rounded-full font-semibold text-sm bg-gray-50 hover:bg-gray-100">
            <i class="fa-solid fa-crown mr-2"></i>Luxury
        </button>
    </div>
</div>

{{-- Results Info --}}
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-600">
        Menampilkan <span class="font-bold text-gray-900">{{ $cars->count() }}</span> dari
        <span class="font-bold text-gray-900">{{ $cars->total() }}</span> unit
    </p>
    <button class="text-yellow-600 font-semibold hover:text-yellow-700 transition">
        <i class="fa-solid fa-filter mr-2"></i>Filter Lanjutan
    </button>
</div>

{{-- Cars Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
@forelse($cars as $car)
<div class="fleet-card rounded-3xl overflow-hidden shadow-lg relative">

{{-- Compare Checkbox --}}
<div class="compare-badge">
    <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" class="w-4 h-4 accent-yellow-500" value="{{ $car->id }}">
        <span class="text-xs font-semibold">Bandingkan</span>
    </label>
</div>

{{-- Image Container --}}
<div class="relative h-64 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800">
    @if($car->images->first())
        <img src="{{ asset('storage/'.$car->images->first()->image_path) }}"
             alt="{{ $car->name }}"
             class="w-full h-full object-cover">
    @else
        <div class="flex items-center justify-center h-full">
            <i class="fa-solid fa-car text-8xl text-gray-600"></i>
        </div>
    @endif

    <div class="gradient-overlay absolute inset-0"></div>

    {{-- Top Badges --}}
    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
        <div class="flex flex-col gap-2">
            <span class="badge-premium px-4 py-1.5 text-gray-900 text-xs font-bold rounded-full inline-block">
                <i class="fa-solid fa-crown mr-1"></i>PREMIUM
            </span>
            @if($car->is_available)
            <span class="px-4 py-1.5 bg-green-500 text-white text-xs font-bold rounded-full inline-block">
                <i class="fa-solid fa-circle-check mr-1"></i>TERSEDIA
            </span>
            @else
            <span class="px-4 py-1.5 bg-red-500 text-white text-xs font-bold rounded-full inline-block">
                <i class="fa-solid fa-circle-xmark mr-1"></i>DISEWA
            </span>
            @endif
        </div>

        <div class="flex flex-col gap-2 items-end">
            @php
                $avg = $car->reviews->avg('rating');
            @endphp
            @if($avg)
            <span class="badge-status px-3 py-1.5 text-yellow-400 text-xs font-bold rounded-full">
                <i class="fa-solid fa-star"></i> {{ number_format($avg, 1) }}
            </span>
            @endif

            <button class="badge-status p-2 rounded-full hover:bg-red-500 transition">
                <i class="fa-regular fa-heart text-white"></i>
            </button>
        </div>
    </div>

    {{-- Bottom Info --}}
    <div class="absolute bottom-0 left-0 right-0 p-6">
        <div class="flex items-end justify-between">
            <div>
                <h3 class="heading-font text-white text-2xl font-bold mb-1">{{ $car->brand }}</h3>
                <p class="text-yellow-400 font-semibold text-lg">{{ $car->name }}</p>
            </div>
            <div class="text-right">
                <p class="text-gray-300 text-xs">Total Booking</p>
                <p class="text-white font-bold text-lg">{{ rand(50, 500) }}x</p>
            </div>
        </div>
    </div>
</div>

{{-- Content --}}
<div class="p-6">

{{-- Quick Specs Grid --}}
<div class="grid grid-cols-2 gap-3 mb-5">
    <div class="spec-item">
        <p class="text-xs text-gray-500 mb-1">Tahun</p>
        <p class="font-bold flex items-center gap-2 text-sm">
            <i class="fa-solid fa-calendar-days text-yellow-500"></i>
            {{ $car->year }}
        </p>
    </div>

    <div class="spec-item">
        <p class="text-xs text-gray-500 mb-1">Kapasitas</p>
        <p class="font-bold flex items-center gap-2 text-sm">
            <i class="fa-solid fa-users text-yellow-500"></i>
            {{ $car->seats }} Kursi
        </p>
    </div>

    <div class="spec-item">
        <p class="text-xs text-gray-500 mb-1">Transmisi</p>
        <p class="font-bold flex items-center gap-2 text-sm">
            <i class="fa-solid fa-gears text-yellow-500"></i>
            {{ ucfirst($car->transmission) }}
        </p>
    </div>

    <div class="spec-item">
        <p class="text-xs text-gray-500 mb-1">Bahan Bakar</p>
        <p class="font-bold flex items-center gap-2 text-sm">
            <i class="fa-solid fa-gas-pump text-yellow-500"></i>
            {{ $car->fuel_type }}
        </p>
    </div>
</div>

{{-- Features Icons --}}
<div class="grid grid-cols-4 gap-3 mb-5">
    <div class="flex flex-col items-center gap-1 p-2 rounded-lg hover:bg-gray-50 transition">
        <div class="feature-icon">
            <i class="fa-solid fa-snowflake text-white"></i>
        </div>
        <span class="text-xs font-medium">AC</span>
    </div>
    <div class="flex flex-col items-center gap-1 p-2 rounded-lg hover:bg-gray-50 transition">
        <div class="feature-icon">
            <i class="fa-solid fa-shield-halved text-white"></i>
        </div>
        <span class="text-xs font-medium">Airbag</span>
    </div>
    <div class="flex flex-col items-center gap-1 p-2 rounded-lg hover:bg-gray-50 transition">
        <div class="feature-icon">
            <i class="fa-brands fa-bluetooth-b text-white"></i>
        </div>
        <span class="text-xs font-medium">Audio</span>
    </div>
    <div class="flex flex-col items-center gap-1 p-2 rounded-lg hover:bg-gray-50 transition">
        <div class="feature-icon">
            <i class="fa-solid fa-camera text-white"></i>
        </div>
        <span class="text-xs font-medium">Camera</span>
    </div>
</div>

{{-- Divider --}}
<div class="border-t border-gray-100 my-5"></div>

{{-- Price Section --}}
<div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-4 mb-5 border border-yellow-100">
    <div class="flex items-center justify-between mb-2">
        <p class="text-xs text-gray-600 font-medium">Harga Sewa / 24 Jam</p>
        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-bold">
            -15% OFF
        </span>
    </div>
    <div class="flex items-end gap-2">
        <p class="heading-font text-3xl font-extrabold price-highlight">
            Rp {{ number_format($car->price_24h, 0, ',', '.') }}
        </p>
        <p class="text-gray-400 line-through text-sm mb-1">
            Rp {{ number_format($car->price_24h * 1.15, 0, ',', '.') }}
        </p>
    </div>

    {{-- Additional Pricing Options --}}
    <div class="mt-3 pt-3 border-t border-yellow-200">
        <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">12 Jam:</span>
            <span class="font-bold text-gray-800">Rp {{ number_format($car->price_24h * 0.7, 0, ',', '.') }}</span>
        </div>
        <div class="flex items-center justify-between text-xs mt-1">
            <span class="text-gray-600">Mingguan (7 hari):</span>
            <span class="font-bold text-gray-800">Rp {{ number_format($car->price_24h * 6, 0, ',', '.') }}</span>
        </div>
    </div>
</div>

{{-- Action Buttons --}}
<div class="grid grid-cols-2 gap-3">
    <a href="{{ route('cars.show', $car) }}"
       class="btn-secondary text-white py-3 rounded-xl font-bold flex items-center justify-center gap-2 text-sm">
        <i class="fa-solid fa-circle-info"></i>
        <span>Detail</span>
    </a>

    <a href="{{ route('bookings.create', ['car' => $car->id]) }}"
       class="btn-primary text-gray-900 py-3 rounded-xl font-bold flex items-center justify-center gap-2 text-sm">
        <i class="fa-solid fa-calendar-check"></i>
        <span>Pesan</span>
    </a>
</div>

{{-- Quick Contact --}}
<div class="mt-3">
    <button class="w-full btn-outline py-2.5 rounded-xl font-semibold text-sm flex items-center justify-center gap-2">
        <i class="fa-brands fa-whatsapp"></i>
        <span>Chat WhatsApp</span>
    </button>
</div>

</div>
</div>
@empty
<div class="col-span-full text-center py-20 bg-white rounded-3xl">
    <i class="fa-solid fa-car-burst text-7xl text-gray-300 mb-4"></i>
    <h3 class="text-2xl font-bold text-gray-800 mb-2">Tidak Ada Armada Tersedia</h3>
    <p class="text-gray-500">Coba ubah filter pencarian Anda</p>
    <button class="mt-6 btn-primary px-6 py-3 rounded-xl font-bold text-gray-900">
        <i class="fa-solid fa-rotate-right mr-2"></i>Reset Filter
    </button>
</div>
@endforelse
</div>

{{-- Pagination --}}
<div class="mt-12 flex justify-center">
    {{ $cars->links() }}
</div>

</main>

{{-- Comparison Bar (Hidden by default) --}}
<div class="comparison-bar" id="comparisonBar">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-4">
            <i class="fa-solid fa-code-compare text-2xl text-yellow-400"></i>
            <div>
                <p class="font-bold text-lg">Bandingkan Mobil</p>
                <p class="text-sm text-gray-400"><span id="compareCount">0</span> mobil dipilih</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button class="px-6 py-3 bg-yellow-400 text-gray-900 rounded-xl font-bold hover:bg-yellow-500 transition">
                <i class="fa-solid fa-chart-simple mr-2"></i>Bandingkan Sekarang
            </button>
            <button class="px-4 py-3 bg-white/10 text-white rounded-xl hover:bg-white/20 transition" onclick="clearComparison()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>

{{-- Quick Filter Modal (Sliced) --}}
<div id="filterModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-4xl w-full max-h-[90vh] overflow-y-auto p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="heading-font text-2xl font-bold">Filter Lanjutan</h2>
            <button class="p-2 hover:bg-gray-100 rounded-full transition">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <div class="space-y-6">
            {{-- Price Range --}}
            <div>
                <label class="font-semibold mb-3 block">Rentang Harga</label>
                <div class="flex items-center gap-4">
                    <input type="number" placeholder="Min" class="flex-1 px-4 py-3 border rounded-xl">
                    <span>-</span>
                    <input type="number" placeholder="Max" class="flex-1 px-4 py-3 border rounded-xl">
                </div>
            </div>

            {{-- Transmission --}}
            <div>
                <label class="font-semibold mb-3 block">Transmisi</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:border-yellow-400 transition">
                        <input type="checkbox" class="w-5 h-5 accent-yellow-500">
                        <span>Manual</span>
                    </label>
                    <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:border-yellow-400 transition">
                        <input type="checkbox" class="w-5 h-5 accent-yellow-500">
                        <span>Automatic</span>
                    </label>
                </div>
            </div>

            {{-- Seats --}}
            <div>
                <label class="font-semibold mb-3 block">Kapasitas Kursi</label>
                <div class="grid grid-cols-4 gap-3">
                    <button class="filter-btn px-4 py-3 rounded-xl font-semibold bg-gray-50">2-4</button>
                    <button class="filter-btn px-4 py-3 rounded-xl font-semibold bg-gray-50">5-6</button>
                    <button class="filter-btn px-4 py-3 rounded-xl font-semibold bg-gray-50">7+</button>
                    <button class="filter-btn px-4 py-3 rounded-xl font-semibold bg-gray-50">Semua</button>
                </div>
            </div>

            {{-- Features --}}
            <div>
                <label class="font-semibold mb-3 block">Fitur Tambahan</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center gap-3 p-3 border rounded-xl cursor-pointer hover:border-yellow-400 transition">
                        <input type="checkbox" class="w-4 h-4 accent-yellow-500">
                        <i class="fa-solid fa-snowflake text-blue-500"></i>
                        <span class="text-sm">AC</span>
                    </label>
                    <label class="flex items-center gap-3 p-3 border rounded-xl cursor-pointer hover:border-yellow-400 transition">
                        <input type="checkbox" class="w-4 h-4 accent-yellow-500">
                        <i class="fa-solid fa-shield-halved text-green-500"></i>
                        <span class="text-sm">Airbag</span>
                    </label>
                    <label class="flex items-center gap-3 p-3 border rounded-xl cursor-pointer hover:border-yellow-400 transition">
                        <input type="checkbox" class="w-4 h-4 accent-yellow-500">
                        <i class="fa-brands fa-bluetooth-b text-blue-600"></i>
                        <span class="text-sm">Bluetooth</span>
                    </label>
                    <label class="flex items-center gap-3 p-3 border rounded-xl cursor-pointer hover:border-yellow-400 transition">
                        <input type="checkbox" class="w-4 h-4 accent-yellow-500">
                        <i class="fa-solid fa-camera text-purple-500"></i>
                        <span class="text-sm">Camera</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-8">
            <button class="flex-1 py-3 border-2 border-gray-300 rounded-xl font-bold hover:bg-gray-50 transition">
                Reset Filter
            </button>
            <button class="flex-1 btn-primary py-3 rounded-xl font-bold text-gray-900">
                Terapkan Filter
            </button>
        </div>
    </div>
</div>

{{-- JavaScript for Interactions (Sliced) --}}
<script>
// Comparison functionality
let comparedCars = [];
const comparisonBar = document.getElementById('comparisonBar');
const compareCount = document.getElementById('compareCount');

document.querySelectorAll('.compare-badge input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const carId = this.value;

        if (this.checked) {
            if (comparedCars.length < 3) {
                comparedCars.push(carId);
            } else {
                this.checked = false;
                alert('Maksimal 3 mobil untuk dibandingkan');
            }
        } else {
            comparedCars = comparedCars.filter(id => id !== carId);
        }

        updateComparisonBar();
    });
});

function updateComparisonBar() {
    compareCount.textContent = comparedCars.length;

    if (comparedCars.length > 0) {
        comparisonBar.classList.add('show');
    } else {
        comparisonBar.classList.remove('show');
    }
}

function clearComparison() {
    comparedCars = [];
    document.querySelectorAll('.compare-badge input[type="checkbox"]').forEach(cb => {
        cb.checked = false;
    });
    updateComparisonBar();
}

// Search functionality (placeholder)
document.querySelector('input[type="text"]').addEventListener('input', function(e) {
    // Will be connected to backend filter
    console.log('Searching:', e.target.value);
});

// View toggle
document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        // Toggle grid/list view logic here
    });
});

// Filter buttons
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        // Apply filter logic here
    });
});
</script>

</x-app-layout>
