<x-app-layout>
    {{-- Fleet Listing Page - SQUADTRANS Mobile Horizontal Scroll --}}

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

        .heading-font {
            font-family: 'Montserrat', sans-serif;
        }

        /* Hero Banner - Mobile Optimized */
        .hero-banner {
            background:
                linear-gradient(135deg,
                    rgba(31, 41, 55, 0.55) 0%,
                    rgba(17, 24, 39, 0.6) 100%),
                url('/images/brio.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }



        @media (min-width: 768px) {
            .hero-banner {
                border-radius: 24px;
            }
        }

        .hero-pattern {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(251, 191, 36, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(251, 191, 36, 0.08) 0%, transparent 50%);
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s;
        }

        @media (min-width: 768px) {
            .stat-card {
                border-radius: 16px;
                padding: 20px;
            }
        }

        /* Filter Section */
        .filter-bar {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        @media (min-width: 768px) {
            .filter-bar {
                border-radius: 20px;
            }
        }

        /* Category Filters - Horizontal Scroll */
        .category-scroll {
            display: flex;
            overflow-x: auto;
            gap: 8px;
            padding: 4px 0;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            scroll-behavior: smooth;
        }

        .category-scroll::-webkit-scrollbar {
            display: none;
        }

        .filter-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .filter-btn:active {
            transform: scale(0.95);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #FCD34D, #F59E0B);
            color: #111827;
            font-weight: 700;
        }

        /* Horizontal Scroll Container for Cars - MOBILE */
        .cars-scroll-container {
            position: relative;
        }

        .cars-scroll-wrapper {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            scroll-behavior: smooth;
            padding: 2px;
        }

        .cars-scroll-wrapper::-webkit-scrollbar {
            display: none;
        }

        /* Mobile: 2 Column Horizontal Layout */
        @media (max-width: 767px) {
            .cars-scroll {
                display: grid;
                grid-auto-flow: column;
                grid-template-rows: repeat(2, 1fr);
                grid-auto-columns: 280px;
                gap: 12px;
                padding-bottom: 60px;
            }
        }

        /* Desktop: Normal Grid */
        @media (min-width: 768px) {
            .cars-scroll {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }

        @media (min-width: 1024px) {
            .cars-scroll {
                grid-template-columns: repeat(3, 1fr);
                gap: 24px;
            }
        }

        /* Scroll Navigation Buttons - Mobile Only */
        .scroll-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FCD34D, #F59E0B);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            z-index: 10;
            cursor: pointer;
            transition: all 0.3s;
            color: #111827;
        }

        .scroll-nav-btn:active {
            transform: translateY(-50%) scale(0.9);
        }

        .scroll-nav-btn.left {
            left: 8px;
        }

        .scroll-nav-btn.right {
            right: 8px;
        }

        @media (min-width: 768px) {
            .scroll-nav-btn {
                display: none;
            }
        }

        /* Fleet Cards - Compact Mobile Version */
        .fleet-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 768px) {
            .fleet-card {
                border-radius: 24px;
            }

            .fleet-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
            }

            .fleet-card:hover img {
                transform: scale(1.1);
            }
        }

        .fleet-card img {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gradient-overlay {
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.3) 40%, rgba(0, 0, 0, 0.95) 100%);
        }

        /* Price Display */
        .price-highlight {
            background: linear-gradient(135deg, #FCD34D, #F59E0B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Buttons - Touch Friendly */
        .btn-primary {
            background: linear-gradient(135deg, #FCD34D, #F59E0B);
            transition: all 0.3s ease;
            min-height: 44px;
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #1F2937, #111827);
            transition: all 0.3s ease;
            min-height: 44px;
        }

        .btn-secondary:active {
            transform: scale(0.98);
        }

        .btn-outline {
            border: 2px solid #F59E0B;
            background: transparent;
            color: #F59E0B;
            transition: all 0.3s ease;
            min-height: 44px;
        }

        .btn-outline:active {
            background: rgba(245, 158, 11, 0.1);
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
            font-size: 10px;
        }

        /* Spec Items */
        .spec-item {
            border-left: 2px solid #FCD34D;
            padding-left: 8px;
        }

        /* Badges */
        .badge-premium {
            background: linear-gradient(135deg, #FCD34D, #F59E0B);
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 8px rgba(245, 158, 11, 0.3);
            }

            50% {
                box-shadow: 0 0 16px rgba(245, 158, 11, 0.5);
            }
        }

        .badge-status {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
        }

        /* Compare Badge */
        .compare-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: white;
            border-radius: 8px;
            padding: 4px 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 10px;
            z-index: 5;
        }

        @media (min-width: 768px) {
            .compare-badge {
                top: 12px;
                right: 12px;
                padding: 6px 10px;
                border-radius: 10px;
                font-size: 11px;
            }
        }

        .compare-badge:active {
            background: #FCD34D;
            transform: scale(0.95);
        }

        /* Sort Dropdown */
        .sort-dropdown {
            position: relative;
        }

        .sort-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            z-index: 50;
            display: none;
            max-height: 70vh;
            overflow-y: auto;
        }

        .sort-dropdown.active .sort-menu {
            display: block;
        }

        .sort-menu a {
            padding: 12px 16px;
            display: block;
            transition: all 0.2s;
        }

        .sort-menu a:active {
            background: #f8fafc;
            color: var(--primary);
        }

        /* View Toggle */
        .view-btn {
            padding: 10px;
            border-radius: 10px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .view-btn:active {
            background: #e2e8f0;
        }

        .view-btn.active {
            background: linear-gradient(135deg, #FCD34D, #F59E0B);
            color: #111827;
        }

        /* Comparison Bar */
        .comparison-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #1F2937, #111827);
            color: white;
            padding: 16px;
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
            box-shadow: 0 -8px 32px rgba(0, 0, 0, 0.3);
        }

        @media (min-width: 768px) {
            .comparison-bar {
                padding: 20px;
            }
        }

        .comparison-bar.show {
            transform: translateY(0);
        }

        /* Scroll Indicator Dots - Mobile */
        .scroll-indicator {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 16px;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        @media (min-width: 768px) {
            .scroll-indicator {
                display: none;
            }
        }

        .scroll-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #d1d5db;
            transition: all 0.3s;
        }

        .scroll-dot.active {
            background: linear-gradient(135deg, #FCD34D, #F59E0B);
            width: 24px;
            border-radius: 4px;
        }
    </style>

    <main class="max-w-7xl mx-auto px-4 py-4 sm:py-6 lg:py-8">

        {{-- Hero Banner --}}
        <div class="hero-banner mb-6 sm:mb-8 lg:mb-10 relative overflow-hidden">
            <div class="hero-pattern"></div>
            <div class="relative z-10 p-4 sm:p-6 lg:p-12">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 lg:gap-6">
                    <div class="flex-1">
                        <span
                            class="inline-block px-3 py-1 bg-yellow-400/20 text-yellow-400 text-xs font-bold rounded-full mb-3 border border-yellow-400/30">
                            <i class="fa-solid fa-star"></i> PREMIUM FLEET
                        </span>
                        <h1
                            class="heading-font text-2xl sm:text-3xl lg:text-5xl font-extrabold text-white mb-2 sm:mb-3">
                            Armada Terbaik<br>Untuk Perjalanan Anda
                        </h1>
                        <p class="text-gray-300 text-sm sm:text-base lg:text-lg max-w-xl">
                            Lebih dari 50+ unit premium siap menemani setiap momen perjalanan Anda.
                        </p>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-2 sm:gap-3 lg:gap-4 w-full lg:w-auto">
                        <div class="stat-card text-center">
                            <div class="text-xl sm:text-2xl lg:text-3xl font-bold price-highlight">50+</div>
                            <div class="text-[10px] sm:text-xs text-gray-500 mt-0.5 sm:mt-1">Unit</div>
                        </div>
                        <div class="stat-card text-center">
                            <div class="text-xl sm:text-2xl lg:text-3xl font-bold price-highlight">4.8</div>
                            <div class="text-[10px] sm:text-xs text-gray-500 mt-0.5 sm:mt-1">Rating</div>
                        </div>
                        <div class="stat-card text-center">
                            <div class="text-xl sm:text-2xl lg:text-3xl font-bold price-highlight">24/7</div>
                            <div class="text-[10px] sm:text-xs text-gray-500 mt-0.5 sm:mt-1">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Search Section --}}
        <div class="filter-bar p-4 sm:p-5 lg:p-6 mb-6 sm:mb-8">
            {{-- Search & Actions --}}
            <div
                class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-stretch sm:items-center justify-between mb-4 sm:mb-6">
                {{-- Search Bar --}}
                <div class="flex-1 relative">
                    <i
                        class="fa-solid fa-search absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" id="searchInput" placeholder="Cari mobil..."
                        class="w-full pl-9 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm sm:text-base rounded-xl border-2 border-gray-200 focus:border-yellow-400 focus:outline-none transition">
                </div>

                {{-- View Toggle & Sort --}}
                <div class="flex items-center gap-2 sm:gap-3">
                    {{-- View Toggle - Hidden on Mobile --}}
                    <div class="hidden sm:flex bg-gray-100 rounded-xl p-1">
                        <button class="view-btn active">
                            <i class="fa-solid fa-grid-2"></i>
                        </button>
                        <button class="view-btn">
                            <i class="fa-solid fa-list"></i>
                        </button>
                    </div>

                    {{-- Sort Dropdown --}}
                    <div class="sort-dropdown">
                        <button
                            class="sort-toggle flex items-center gap-2 px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-100 rounded-xl text-sm font-semibold hover:bg-gray-200 transition whitespace-nowrap">
                            <i class="fa-solid fa-sort"></i>
                            <span class="hidden sm:inline">Urutkan</span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="sort-menu">
                            <a href="#" class="sort-option"><i class="fa-solid fa-star text-yellow-500 mr-2"></i>
                                Rating Tertinggi</a>
                            <a href="#" class="sort-option"><i
                                    class="fa-solid fa-dollar-sign text-green-500 mr-2"></i> Harga Terendah</a>
                            <a href="#" class="sort-option"><i
                                    class="fa-solid fa-dollar-sign text-red-500 mr-2"></i> Harga Tertinggi</a>
                            <a href="#" class="sort-option"><i
                                    class="fa-solid fa-calendar text-blue-500 mr-2"></i> Terbaru</a>
                            <a href="#" class="sort-option"><i class="fa-solid fa-fire text-orange-500 mr-2"></i>
                                Terpopuler</a>
                        </div>
                    </div>

                    {{-- Advanced Filter Button --}}
                    <button
                        class="filter-toggle px-3 sm:px-4 py-2.5 sm:py-3 bg-yellow-400 rounded-xl text-sm font-semibold hover:bg-yellow-500 transition">
                        <i class="fa-solid fa-sliders"></i>
                        <span class="hidden sm:inline ml-2">Filter</span>
                    </button>
                </div>
            </div>

            {{-- Category Filters - Horizontal Scroll --}}
            <div class="category-scroll">
                <button class="filter-btn active px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm">
                    <i class="fa-solid fa-layer-group mr-1 sm:mr-2"></i>Semua
                </button>
                <button class="filter-btn px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm bg-gray-50">
                    <i class="fa-solid fa-car mr-1 sm:mr-2"></i>Sedan
                </button>
                <button class="filter-btn px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm bg-gray-50">
                    <i class="fa-solid fa-truck-pickup mr-1 sm:mr-2"></i>SUV
                </button>
                <button class="filter-btn px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm bg-gray-50">
                    <i class="fa-solid fa-van-shuttle mr-1 sm:mr-2"></i>MPV
                </button>
                <button class="filter-btn px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm bg-gray-50">
                    <i class="fa-solid fa-car-side mr-1 sm:mr-2"></i>Hatchback
                </button>
                <button class="filter-btn px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm bg-gray-50">
                    <i class="fa-solid fa-charging-station mr-1 sm:mr-2"></i>Electric
                </button>
                <button class="filter-btn px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm bg-gray-50">
                    <i class="fa-solid fa-crown mr-1 sm:mr-2"></i>Luxury
                </button>
            </div>
        </div>

        {{-- Results Info --}}
        <div class="flex items-center justify-between mb-4 sm:mb-6 px-1">
            <p class="text-xs sm:text-sm text-gray-600">
                <span class="font-bold text-gray-900">{{ $cars->count() }}</span> dari
                <span class="font-bold text-gray-900">{{ $cars->total() }}</span> unit
            </p>
            <p class="text-xs text-gray-500 md:hidden">
                <i class="fa-solid fa-hand-point-right mr-1"></i>Geser untuk lihat lebih banyak
            </p>
        </div>

        {{-- Cars Horizontal Scroll Container --}}
        <div class="cars-scroll-container mb-10">
            {{-- Navigation Buttons (Mobile Only) --}}
            <button class="scroll-nav-btn left" id="scrollLeft">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="scroll-nav-btn right" id="scrollRight">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            {{-- Scrollable Wrapper --}}
            <div class="cars-scroll-wrapper" id="carsScrollWrapper">
                <div class="cars-scroll" id="carsScroll">
                    @forelse($cars as $car)
                        <div class="fleet-card overflow-hidden shadow-md">

                            {{-- Compare Checkbox --}}
                            <div class="compare-badge">
                                <label class="flex items-center gap-1 cursor-pointer">
                                    <input type="checkbox" class="w-3 h-3 accent-yellow-500"
                                        value="{{ $car->id }}">
                                    <span class="text-xs font-semibold hidden sm:inline">Bandingkan</span>
                                    <i class="fa-solid fa-code-compare sm:hidden"></i>
                                </label>
                            </div>

                            {{-- Image Container --}}
                            <div
                                class="relative h-32 sm:h-48 lg:h-56 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800">
                                @if ($car->images->first())
                                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                                        alt="{{ $car->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <i class="fa-solid fa-car text-4xl sm:text-7xl text-gray-600"></i>
                                    </div>
                                @endif

                                <div class="gradient-overlay absolute inset-0"></div>

                                {{-- Top Badges --}}
                                <div class="absolute top-2 left-2 flex flex-col gap-1">
                                    <span
                                        class="badge-premium px-2 py-0.5 text-gray-900 text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                        <i class="fa-solid fa-crown mr-0.5"></i>PREMIUM
                                    </span>
                                    @if ($car->is_available)
                                        <span
                                            class="px-2 py-0.5 bg-green-500 text-white text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                            <i class="fa-solid fa-circle-check mr-0.5"></i>TERSEDIA
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-0.5 bg-red-500 text-white text-[9px] sm:text-xs font-bold rounded-full inline-block">
                                            <i class="fa-solid fa-circle-xmark mr-0.5"></i>DISEWA
                                        </span>
                                    @endif
                                </div>

                                {{-- Rating Badge --}}
                                @php
                                    $avg = $car->reviews->avg('rating');
                                @endphp
                                @if ($avg)
                                    <span
                                        class="badge-status absolute top-2 right-12 sm:right-16 px-2 py-0.5 sm:py-1 text-yellow-400 text-[9px] sm:text-xs font-bold rounded-full">
                                        <i class="fa-solid fa-star"></i> {{ number_format($avg, 1) }}
                                    </span>
                                @endif

                                {{-- Bottom Info --}}
                                <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-4">
                                    <h3 class="heading-font text-white text-sm sm:text-lg font-bold mb-0.5 truncate">
                                        {{ $car->brand }}
                                    </h3>
                                    <p class="text-yellow-400 font-semibold text-xs sm:text-base truncate">
                                        {{ $car->name }}</p>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-2 sm:p-4 flex-1 flex flex-col">

                                {{-- Quick Specs Grid --}}
                                <div class="grid grid-cols-2 gap-1.5 sm:gap-2 mb-2 sm:mb-3">
                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">Tahun</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm">
                                            <i class="fa-solid fa-calendar-days text-yellow-500 text-[9px]"></i>
                                            {{ $car->year }}
                                        </p>
                                    </div>

                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">Kapasitas</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm">
                                            <i class="fa-solid fa-users text-yellow-500 text-[9px]"></i>
                                            {{ $car->seats }}
                                        </p>
                                    </div>

                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">Transmisi</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm truncate">
                                            <i class="fa-solid fa-gears text-yellow-500 text-[9px]"></i>
                                            {{ ucfirst($car->transmission) }}
                                        </p>
                                    </div>

                                    <div class="spec-item">
                                        <p class="text-[9px] sm:text-xs text-gray-500 mb-0.5">BBM</p>
                                        <p class="font-bold flex items-center gap-1 text-[10px] sm:text-sm truncate">
                                            <i class="fa-solid fa-gas-pump text-yellow-500 text-[9px]"></i>
                                            {{ $car->fuel_type }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Features Icons --}}
                                <div class="grid grid-cols-4 gap-1.5 sm:gap-2 mb-2 sm:mb-3">
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-solid fa-snowflake text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">AC</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-solid fa-shield-halved text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">Safe</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-brands fa-bluetooth-b text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">BT</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-0.5 p-1 rounded-lg">
                                        <div class="feature-icon">
                                            <i class="fa-solid fa-camera text-white"></i>
                                        </div>
                                        <span class="text-[8px] sm:text-xs font-medium">Cam</span>
                                    </div>
                                </div>

                                {{-- Divider --}}
                                <div class="border-t border-gray-100 my-2 sm:my-3"></div>

                                {{-- Price Section --}}
                                <div
                                    class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg sm:rounded-xl p-2 sm:p-3 mb-2 sm:mb-3 border border-yellow-100">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="text-[9px] sm:text-xs text-gray-600 font-medium">24 Jam</p>
                                        <span
                                            class="text-[8px] sm:text-xs bg-green-100 text-green-700 px-1.5 py-0.5 rounded-full font-bold">
                                            -15%
                                        </span>
                                    </div>
                                    <div class="flex items-end gap-1">
                                        <p class="heading-font text-base sm:text-2xl font-extrabold price-highlight">
                                            {{ number_format($car->price_24h / 1000, 0) }}K
                                        </p>
                                    </div>

                                    {{-- Additional Pricing --}}
                                    <div class="mt-1.5 sm:mt-2 pt-1.5 sm:pt-2 border-t border-yellow-200 space-y-0.5">
                                        <div class="flex items-center justify-between text-[9px] sm:text-xs">
                                            <span class="text-gray-600">12 Jam:</span>
                                            <span
                                                class="font-bold text-gray-800">{{ number_format(($car->price_24h * 0.7) / 1000, 0) }}K</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="grid grid-cols-2 gap-1.5 sm:gap-2 mt-auto">
                                    <a href="{{ route('cars.show', $car) }}"
                                        class="btn-secondary text-white py-2 sm:py-2.5 rounded-lg sm:rounded-xl font-bold flex items-center justify-center gap-1 text-[10px] sm:text-sm">
                                        <i class="fa-solid fa-circle-info"></i>
                                        <span>Detail</span>
                                    </a>

                                    <a href="{{ route('bookings.create', ['car' => $car->id]) }}"
                                        class="btn-primary text-gray-900 py-2 sm:py-2.5 rounded-lg sm:rounded-xl font-bold flex items-center justify-center gap-1 text-[10px] sm:text-sm">
                                        <i class="fa-solid fa-calendar-check"></i>
                                        <span>Pesan</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 bg-white rounded-2xl">
                            <i class="fa-solid fa-car-burst text-5xl text-gray-300 mb-3"></i>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Tidak Ada Armada</h3>
                            <p class="text-sm text-gray-500">Coba ubah filter pencarian</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Scroll Indicator Dots --}}
            <div class="scroll-indicator" id="scrollIndicator">
                <!-- Dots will be generated by JavaScript -->
            </div>
        </div>

        {{-- Pagination (Desktop) --}}
        <div class="mt-8 sm:mt-12 flex justify-center">
            {{ $cars->links() }}
        </div>

    </main>

    {{-- Comparison Bar --}}
    <div class="comparison-bar" id="comparisonBar">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3 sm:gap-4">
                <i class="fa-solid fa-code-compare text-xl sm:text-2xl text-yellow-400"></i>
                <div>
                    <p class="font-bold text-sm sm:text-base">Bandingkan Mobil</p>
                    <p class="text-xs text-gray-400"><span id="compareCount">0</span> mobil dipilih</p>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <button
                    class="px-4 sm:px-6 py-2.5 bg-yellow-400 text-gray-900 rounded-xl text-xs sm:text-sm font-bold hover:bg-yellow-500 transition">
                    <i class="fa-solid fa-chart-simple mr-1"></i>
                    <span class="hidden sm:inline">Bandingkan</span>
                    <span class="sm:hidden">Cek</span>
                </button>
                <button class="px-3 py-2.5 bg-white/10 text-white rounded-xl hover:bg-white/20 transition"
                    onclick="clearComparison()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Reviews Section --}}
    <section class="py-12 sm:py-24 bg-slate-50" id="ulasan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 sm:mb-12 gap-6">
                <div>
                    <span class="text-yellow-600 font-bold tracking-widest uppercase text-xs mb-2 sm:mb-3 block">
                        Kepuasan Pelanggan
                    </span>
                    <h2 class="heading-font text-2xl sm:text-4xl font-extrabold text-slate-900 mb-2">Ulasan Dari Pelanggan Kami</h2>
                </div>

                <a href="{{ route('reviews.create') }}"
                    class="bg-yellow-600 text-white font-bold py-2 sm:py-3 px-4 sm:px-6 rounded-xl hover:bg-yellow-700 transition-colors flex items-center gap-2 w-fit text-sm sm:text-base">
                    <i class="fa-solid fa-plus text-sm"></i>
                    Tambah Ulasan
                </a>
            </div>

            @php
                $reviews = App\Models\Review::with('booking.car', 'booking.user')
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get();
            @endphp

            @if ($reviews->count() > 0)
                <div class="reviews-carousel owl-carousel owl-theme">
                    @foreach ($reviews as $review)
                        {{-- Review Card --}}
                        <div
                            class="item bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-md sm:shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">

                            {{-- Car Image or Review Image --}}
                            @if ($review->image_path)
                                <img src="{{ asset('storage/' . $review->image_path) }}"
                                     alt="Review Image"
                                     class="w-full h-40 sm:h-48 object-cover">
                            @elseif ($review->booking->car->images->first())
                                <img src="{{ asset('storage/' . $review->booking->car->images->first()->image_path) }}"
                                     alt="{{ $review->booking->car->brand }} {{ $review->booking->car->name }}"
                                     class="w-full h-40 sm:h-48 object-cover">
                            @else
                                <div class="w-full h-40 sm:h-48 bg-gray-300 flex items-center justify-center">
                                    <i class="fa-solid fa-car-side text-4xl sm:text-6xl text-gray-400"></i>
                                </div>
                            @endif

                            <div class="p-4 sm:p-8 flex-1 flex flex-col">
                                {{-- Rating Stars --}}
                                <div class="flex items-center gap-1 mb-3 sm:mb-4">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 sm:w-5 h-4 sm:h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-bold text-gray-700">{{ $review->rating }}/5</span>
                                </div>

                                <p class="text-xs sm:text-sm text-slate-600 mb-4 sm:mb-6 flex-grow line-clamp-3">
                                    "{{ $review->comment ?? 'Pelanggan puas dengan layanan kami.' }}"
                                </p>

                                <div class="flex items-center gap-2 sm:gap-3 border-t border-slate-100 pt-3 sm:pt-4">
                                    <div
                                        class="w-10 sm:w-12 h-10 sm:h-12 bg-yellow-600/10 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-user text-yellow-600 text-sm sm:text-lg"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-gray-900 text-xs sm:text-sm truncate">
                                            {{ $review->booking->user->name ?? 'Pelanggan' }}
                                        </p>
                                        <p class="text-xs text-slate-500 truncate">
                                            {{ $review->booking->car->brand ?? 'Produk' }}
                                            {{ $review->booking->car->name ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 sm:py-16 bg-white rounded-3xl border border-slate-100">
                    <div class="mb-3 sm:mb-4">
                        <i class="fa-solid fa-comments text-5xl sm:text-6xl text-slate-300"></i>
                    </div>
                    <p class="text-gray-500 text-base sm:text-lg mb-3 sm:mb-4">
                        Belum ada ulasan. Jadilah yang pertama memberikan ulasan!
                    </p>
                    <a href="{{ route('reviews.create') }}"
                        class="bg-yellow-600 text-white font-bold py-2 sm:py-3 px-6 sm:px-8 rounded-xl hover:bg-yellow-700 transition-colors inline-flex items-center gap-2 text-sm sm:text-base">
                        <i class="fa-solid fa-plus text-sm"></i>
                        Tambah Ulasan Sekarang
                    </a>
                </div>
            @endif

        </div>
    </section>

    {{-- JavaScript --}}
    <script>
        // Horizontal Scroll Navigation
        const scrollWrapper = document.getElementById('carsScrollWrapper');
        const scrollLeft = document.getElementById('scrollLeft');
        const scrollRight = document.getElementById('scrollRight');
        const scrollIndicator = document.getElementById('scrollIndicator');

        // Scroll amount (adjust based on card width)
        const scrollAmount = 300;

        scrollLeft?.addEventListener('click', () => {
            scrollWrapper.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        scrollRight?.addEventListener('click', () => {
            scrollWrapper.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        // Update scroll indicators
        function updateScrollIndicators() {
            if (window.innerWidth >= 768) return; // Only for mobile

            const scrollWidth = scrollWrapper.scrollWidth;
            const clientWidth = scrollWrapper.clientWidth;
            const scrollLeft = scrollWrapper.scrollLeft;

            const totalDots = Math.ceil(scrollWidth / clientWidth);
            const activeDot = Math.floor(scrollLeft / clientWidth);

            // Generate dots
            if (scrollIndicator && scrollIndicator.children.length !== totalDots) {
                scrollIndicator.innerHTML = '';
                for (let i = 0; i < totalDots; i++) {
                    const dot = document.createElement('div');
                    dot.className = 'scroll-dot';
                    if (i === activeDot) dot.classList.add('active');
                    scrollIndicator.appendChild(dot);
                }
            } else {
                // Update active dot
                const dots = scrollIndicator?.querySelectorAll('.scroll-dot');
                dots?.forEach((dot, index) => {
                    dot.classList.toggle('active', index === activeDot);
                });
            }
        }

        scrollWrapper?.addEventListener('scroll', updateScrollIndicators);
        window.addEventListener('resize', updateScrollIndicators);
        window.addEventListener('load', updateScrollIndicators);

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
                        alert('Maksimal 3 mobil');
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

        // Sort dropdown toggle
        const sortToggle = document.querySelector('.sort-toggle');
        const sortDropdown = document.querySelector('.sort-dropdown');

        sortToggle?.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdown.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!sortDropdown?.contains(e.target)) {
                sortDropdown?.classList.remove('active');
            }
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput?.addEventListener('input', function(e) {
            console.log('Searching:', e.target.value);
        });

        // Category filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>

</x-app-layout>
