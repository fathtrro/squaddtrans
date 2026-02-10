<x-app-layout>
    {{-- Fleet Listing Page - Clean Minimalist with Glass Effect --}}

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        }

        /* Hero Banner - Compact with Glass Stats */
        .hero-banner {
            background:
                linear-gradient(135deg,
                    rgba(17, 24, 39, 0.7) 0%,
                    rgba(31, 41, 55, 0.6) 100%),
                url('/images/download.jpeg');
            background-size: cover;
            background-position: center;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        /* Glassmorphism for stats */
        .stat-card {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        @media (min-width: 768px) {
            .stat-card {
                padding: 16px 20px;
            }
        }

        /* Filter Bar - Glass Effect */
        .filter-bar {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        }

        /* Category Scroll */
        .category-scroll {
            display: flex;
            overflow-x: auto;
            gap: 8px;
            padding: 2px 0;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .category-scroll::-webkit-scrollbar {
            display: none;
        }

        .filter-btn {
            transition: all 0.3s;
            border: 1px solid #e5e7eb;
            white-space: nowrap;
            flex-shrink: 0;
            background: white;
            color: #6b7280;
        }

        .filter-btn.active {
            background: #111827;
            color: white;
            border-color: #111827;
            font-weight: 600;
        }

        .filter-btn:hover:not(.active) {
            border-color: #d1d5db;
            background: #f9fafb;
        }

        /* Cars Container */
        .cars-scroll-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            scroll-behavior: smooth;
        }

        .cars-scroll-wrapper::-webkit-scrollbar {
            display: none;
        }

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

        @media (min-width: 768px) {
            .cars-scroll {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (min-width: 1024px) {
            .cars-scroll {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
        }

        /* Fleet Cards */
        .fleet-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            transition: all 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 768px) {
            .fleet-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
                border-color: #d1d5db;
            }

            .fleet-card:hover img {
                transform: scale(1.05);
            }
        }

        .fleet-card img {
            transition: transform 0.4s;
        }

        /* Scroll Navigation */
        .scroll-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 10;
            cursor: pointer;
            transition: all 0.3s;
            color: #111827;
        }

        .scroll-nav-btn:hover {
            background: #f9fafb;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
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

        /* Sort Dropdown */
        .sort-dropdown {
            position: relative;
        }

        .sort-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            z-index: 50;
            display: none;
            overflow: hidden;
        }

        .sort-dropdown.active .sort-menu {
            display: block;
        }

        .sort-menu a {
            padding: 10px 14px;
            display: block;
            transition: all 0.2s;
            font-size: 14px;
        }

        .sort-menu a:hover {
            background: #f9fafb;
        }

        /* View Toggle */
        .view-btn {
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .view-btn.active {
            background: white;
            color: #111827;
        }

        /* Scroll Indicator */
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
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transition: all 0.3s;
        }

        .scroll-dot.active {
            background: white;
            width: 20px;
            border-radius: 3px;
        }

        /* Price Highlight */
        .price-highlight {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <main class="max-w-7xl mx-auto px-4 py-6">

        {{-- Hero Banner - Compact --}}
        <div class="hero-banner mb-6 relative overflow-hidden">
            <div class="relative z-10 p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">

                    {{-- Text Content --}}
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-1.5 backdrop-blur-md bg-white/10 border border-white/20 px-3 py-1 rounded-full mb-3">
                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            <span class="text-white text-xs font-medium">PREMIUM FLEET</span>
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-white mb-2">
                            Armada Terbaik Untuk<br class="hidden sm:block">Perjalanan Anda
                        </h1>
                        <p class="text-gray-200 text-sm lg:text-base max-w-xl">
                            50+ unit premium siap menemani perjalanan Anda
                        </p>
                    </div>

                    {{-- Glass Stats Cards - Compact --}}
                    <div class="flex gap-3 w-full lg:w-auto">
                        <div class="stat-card flex-1 lg:flex-none text-center min-w-[90px]">
                            <div class="text-2xl lg:text-3xl font-bold text-white">50+</div>
                            <div class="text-xs text-white/80 mt-0.5">Unit</div>
                        </div>
                        <div class="stat-card flex-1 lg:flex-none text-center min-w-[90px]">
                            <div class="text-2xl lg:text-3xl font-bold text-white">4.8</div>
                            <div class="text-xs text-white/80 mt-0.5">Rating</div>
                        </div>
                        <div class="stat-card flex-1 lg:flex-none text-center min-w-[90px]">
                            <div class="text-2xl lg:text-3xl font-bold text-white">24/7</div>
                            <div class="text-xs text-white/80 mt-0.5">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Search - Glass Effect --}}
        <div class="filter-bar p-4 lg:p-5 mb-6">

            {{-- Search & Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between mb-4">

                {{-- Search Bar --}}
                <div class="flex-1 relative">
                    <i class="fa-solid fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" id="searchInput" placeholder="Cari mobil..."
                        class="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-gray-200 rounded-lg focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition outline-none">
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2">

                    {{-- View Toggle --}}
                    <div class="hidden sm:flex bg-gray-100 rounded-lg p-1">
                        <button class="view-btn active">
                            <i class="fa-solid fa-table-cells"></i>
                        </button>
                        <button class="view-btn">
                            <i class="fa-solid fa-list"></i>
                        </button>
                    </div>

                    {{-- Sort Dropdown --}}
                    <div class="sort-dropdown">
                        <button class="sort-toggle flex items-center gap-2 px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-sm hover:border-gray-300 transition">
                            <i class="fa-solid fa-sort text-sm"></i>
                            <span class="hidden sm:inline">Urutkan</span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="sort-menu">
                            <a href="#" class="sort-option">
                                <i class="fa-solid fa-star text-yellow-500 mr-2"></i>
                                Rating Tertinggi
                            </a>
                            <a href="#" class="sort-option">
                                <i class="fa-solid fa-arrow-up text-green-500 mr-2"></i>
                                Harga Terendah
                            </a>
                            <a href="#" class="sort-option">
                                <i class="fa-solid fa-arrow-down text-red-500 mr-2"></i>
                                Harga Tertinggi
                            </a>
                            <a href="#" class="sort-option">
                                <i class="fa-solid fa-clock text-blue-500 mr-2"></i>
                                Terbaru
                            </a>
                            <a href="#" class="sort-option">
                                <i class="fa-solid fa-fire text-orange-500 mr-2"></i>
                                Terpopuler
                            </a>
                        </div>
                    </div>

                    {{-- Filter Button --}}
                    <button class="filter-toggle px-3.5 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium transition">
                        <i class="fa-solid fa-sliders"></i>
                        <span class="hidden sm:inline ml-2">Filter</span>
                    </button>
                </div>
            </div>

            {{-- Category Filters --}}
            <form method="GET" action="{{ route('cars.index') }}" id="filterForm" class="category-scroll -mx-4 px-4 sm:mx-0 sm:px-0">
                @foreach (['all' => ['icon' => 'fa-layer-group', 'label' => 'Semua'], 'MPV (keluarga)' => ['icon' => 'fa-van-shuttle', 'label' => 'MPV (keluarga)'], 'SUV (tangguh/medan berat)' => ['icon' => 'fa-truck-pickup', 'label' => 'SUV (tangguh/medan berat)'], 'Hatchback (kompak)' => ['icon' => 'fa-car-side', 'label' => 'Hatchback (kompak)'], 'City Car (lincah di kota)' => ['icon' => 'fa-car', 'label' => 'City Car (lincah di kota)'], 'Sedan (nyaman)' => ['icon' => 'fa-car', 'label' => 'Sedan (nyaman)'], 'Crossover (kombinasi)' => ['icon' => 'fa-cube', 'label' => 'Crossover (kombinasi)'] ] as $value => $option)
                    <button type="button" class="filter-btn {{ request('category', 'all') == $value ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-medium category-filter-btn" data-category="{{ $value }}">
                        <i class="fa-solid {{ $option['icon'] }} mr-1.5"></i>{{ $option['label'] }}
                    </button>
                @endforeach
                <input type="hidden" name="category" id="categoryInput" value="{{ request('category', 'all') }}">
            </form>
        </div>

        {{-- Results Info --}}
        <div class="flex items-center justify-between mb-4 px-1">
            <p class="text-sm text-gray-600">
                <span class="font-semibold text-gray-900">{{ $cars->count() }}</span> dari
                <span class="font-semibold text-gray-900">{{ $cars->total() }}</span> unit
            </p>
            <p class="text-xs text-gray-500 md:hidden">
                <i class="fa-solid fa-hand-point-right mr-1"></i>Geser untuk lihat lebih
            </p>
        </div>

        {{-- Cars List --}}
        @include('cars.cars-list')

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $cars->links() }}
        </div>

    </main>

    {{-- JavaScript --}}
    <script>
        // Scroll Navigation
        const scrollWrapper = document.getElementById('carsScrollWrapper');
        const scrollLeft = document.getElementById('scrollLeft');
        const scrollRight = document.getElementById('scrollRight');
        const scrollIndicator = document.getElementById('scrollIndicator');
        const scrollAmount = 300;

        scrollLeft?.addEventListener('click', () => {
            scrollWrapper.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        scrollRight?.addEventListener('click', () => {
            scrollWrapper.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        // Scroll Indicators
        function updateScrollIndicators() {
            if (window.innerWidth >= 768) return;
            const scrollWidth = scrollWrapper.scrollWidth;
            const clientWidth = scrollWrapper.clientWidth;
            const scrollLeft = scrollWrapper.scrollLeft;
            const totalDots = Math.ceil(scrollWidth / clientWidth);
            const activeDot = Math.floor(scrollLeft / clientWidth);

            if (scrollIndicator && scrollIndicator.children.length !== totalDots) {
                scrollIndicator.innerHTML = '';
                for (let i = 0; i < totalDots; i++) {
                    const dot = document.createElement('div');
                    dot.className = 'scroll-dot';
                    if (i === activeDot) dot.classList.add('active');
                    scrollIndicator.appendChild(dot);
                }
            } else {
                const dots = scrollIndicator?.querySelectorAll('.scroll-dot');
                dots?.forEach((dot, index) => {
                    dot.classList.toggle('active', index === activeDot);
                });
            }
        }

        scrollWrapper?.addEventListener('scroll', updateScrollIndicators);
        window.addEventListener('resize', updateScrollIndicators);
        window.addEventListener('load', updateScrollIndicators);

        // Sort Dropdown
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

        // Category Filters
        document.querySelectorAll('.category-filter-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.category-filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('categoryInput').value = this.dataset.category;
                document.getElementById('filterForm').submit();
            });
        });

        // View Toggle
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>

</x-app-layout>
