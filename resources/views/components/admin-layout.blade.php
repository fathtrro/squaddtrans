
{{-- resources/views/components/admin-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Smooth transitions for sidebar */
        .sidebar-transition {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Overlay backdrop */
        .sidebar-overlay {
            transition: opacity 0.3s ease-in-out;
        }

        /* Prevent body scroll when sidebar is open on mobile */
        body.sidebar-open {
            overflow: hidden;
        }

        @media (min-width: 1024px) {
            body.sidebar-open {
                overflow: auto;
            }
        }

        /* Page header styling */
        main h1 {
            @apply text-2xl font-bold text-gray-800;
        }

        /* Table improvements */
        table tbody tr {
            @apply hover:bg-gray-50 transition-colors duration-150;
        }

        table tbody tr:last-child td {
            @apply border-b-0;
        }

        /* Select dropdown style */
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        select::-ms-expand {
            display: none;
        }

        /* Better focus states */
        input:focus, select:focus, textarea:focus {
            @apply outline-none ring-2 ring-yellow-400 ring-opacity-50 border-yellow-400;
        }

        /* Smooth button transitions */
        button {
            @apply transition-all duration-200;
        }

        /* Loading skeleton */
        .skeleton {
            @apply bg-gray-200 animate-pulse;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            ::-webkit-scrollbar {
                width: 6px;
            }
            ::-webkit-scrollbar-track {
                background: transparent;
            }
            ::-webkit-scrollbar-thumb {
                background-color: rgba(156, 163, 175, 0.5);
                border-radius: 3px;
            }
        }

        /* Smooth page transitions */
        main {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Better card hover for mobile */
        @media (hover: hover) {
            .hover\:shadow-md:hover {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }
        }

        /* Stat card hover effect */
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Table styling improvements */
        table tbody tr:hover {
            background-color: #fffbeb;
        }

        /* Better link styling */
        a {
            position: relative;
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">

        <!-- MOBILE OVERLAY (backdrop when sidebar is open) -->
        <div id="sidebarOverlay"
             class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"
             onclick="toggleSidebar()">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
               class="sidebar-transition fixed lg:static inset-y-0 left-0 z-50
                      w-64 md:w-72 bg-white border-r border-gray-200 flex-shrink-0
                      transform -translate-x-full lg:translate-x-0 overflow-y-auto
                      max-h-screen">

            <!-- Logo -->
            <div class="sticky top-0 bg-white p-4 sm:p-6 border-b border-gray-200 flex items-center justify-between z-10">
                <div class="flex items-center space-x-3 min-w-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h2 class="text-lg font-bold text-gray-800 truncate">Squad Trans</h2>
                        <p class="text-xs text-gray-500 uppercase truncate">Admin</p>
                    </div>
                </div>

                <!-- Close button (mobile only) -->
                <button onclick="toggleSidebar()"
                        class="lg:hidden text-gray-600 hover:text-gray-900 p-2 -mr-2 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="p-3 sm:p-4 space-y-1 mt-2">
                <!-- Main Menu -->
                <div class="px-2 py-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Menu Utama</p>
                </div>

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-white bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Beranda</span>
                </a>

                <!-- Management Section -->
                <div class="px-2 py-3 mt-4">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Manajemen</p>
                </div>

                <a href="{{ route('admin.car.index') }}"
                   class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.car.*') ? 'text-white bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span>Armada</span>
                </a>

                <a href="{{ route('admin.renter.index') }}"
                   class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.renter.*') ? 'text-white bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Penyewaan</span>
                </a>

                {{-- <a href="{{ route('admin.booking-extensions.index') }}"
                   class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.booking-extensions.*') ? 'text-white bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Perpanjangan</span>
                </a> --}}

                <!-- Settings Section -->
                <div class="px-2 py-3 mt-4">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Pengaturan</p>
                </div>

                <a href="{{ route('admin.bank-accounts.index') }}"
                   class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.bank-accounts.*') ? 'text-white bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                    </svg>
                    <span>Bank</span>
                </a>

                <a href="{{ route('admin.reviews.index') }}"
                   class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.reviews.*') ? 'text-white bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>Ulasan</span>
                </a>

                <a href="{{ route('admin.laporan') }}"
                   class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan') ? 'text-white bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Laporan</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-3 sm:px-6 lg:px-8 py-3 sm:py-4 sticky top-0 z-30 shadow-sm">
                <div class="flex items-center justify-between gap-3 sm:gap-4">
                    <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                        <!-- Hamburger Button (Mobile) -->
                        <button onclick="toggleSidebar()"
                                class="lg:hidden text-gray-600 hover:text-gray-900 hover:bg-gray-100 p-2 -ml-3 rounded-lg flex-shrink-0 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <h1 class="text-lg sm:text-2xl font-bold text-gray-800 truncate">{{ $header ?? 'Dashboard Overview' }}</h1>
                    </div>

                    <!-- User Info -->
                    <div class="flex items-center gap-2 sm:gap-3 lg:gap-6 flex-shrink-0">
                        <!-- Notification Bell -->
                        <a href="{{ route('admin.inbox.index') }}" class="relative p-2 text-gray-400 hover:text-yellow-600 hover:bg-gray-100 rounded-lg transition-colors group flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            @php
                                $unreadCount = \App\Models\ContactUs::unread()->count();
                            @endphp
                            @if ($unreadCount > 0)
                                <span class="absolute top-1 right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform bg-red-600 rounded-full">
                                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                </span>
                            @endif
                            <span class="hidden sm:block absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                                Inbox ({{ $unreadCount }})
                            </span>
                        </a>

                        <!-- User Avatar & Dropdown -->
                        <div class="relative group flex-shrink-0">
                            <button type="button" class="flex items-center gap-2 sm:gap-3 focus:outline-none focus:ring-2 focus:ring-yellow-400 rounded-lg px-2 py-1">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin Squad') }}&background=F59E0B&color=fff"
                                     alt="Avatar"
                                     class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border-2 border-gray-200 hover:border-yellow-400 transition-colors">

                                <!-- User Info (Desktop only, next to avatar) -->
                                <div class="hidden lg:block text-left">
                                    <p class="text-sm font-semibold text-gray-800 whitespace-nowrap">{{ Auth::user()->name ?? 'Admin Squad' }}</p>
                                    <p class="text-xs text-gray-500 whitespace-nowrap">{{ Auth::user()->type ?? 'Super Admin' }}</p>
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100 py-1">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->name ?? 'Admin Squad' }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>Profil</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-3 sm:p-4 lg:p-8 bg-gray-50">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            // Toggle sidebar
            sidebar.classList.toggle('-translate-x-full');

            // Toggle overlay
            overlay.classList.toggle('hidden');

            // Prevent body scroll on mobile when sidebar is open
            body.classList.toggle('sidebar-open');
        }

        // Close sidebar when clicking on a nav link (mobile only)
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Only close on mobile
                    if (window.innerWidth < 1024) {
                        toggleSidebar();
                    }
                });
            });
        });

        // Close sidebar when resizing to desktop
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 1024) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    const body = document.body;

                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                    body.classList.remove('sidebar-open');
                }
            }, 250);
        });

        // Smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>
