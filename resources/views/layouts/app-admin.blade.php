<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Smooth transitions for sidebar */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        /* Overlay backdrop */
        .sidebar-overlay {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

<div class="min-h-screen flex">

    <!-- MOBILE OVERLAY (backdrop when sidebar is open) -->
    <div id="sidebarOverlay"
         class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"
         onclick="toggleSidebar()">
    </div>

    <!-- SIDEBAR -->
    <aside id="sidebar"
           class="sidebar-transition fixed lg:static inset-y-0 left-0 z-50
                  w-64 bg-white dark:bg-gray-800 shadow-lg
                  transform -translate-x-full lg:translate-x-0">

        <!-- Sidebar Header -->
        <div class="h-16 flex items-center justify-between px-4 font-bold text-lg border-b dark:border-gray-700">
            <span>🚘 SquadTrans Admin</span>
            <!-- Close button (mobile only) -->
            <button onclick="toggleSidebar()"
                    class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2 overflow-y-auto" style="max-height: calc(100vh - 4rem);">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors
               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-3">
                    <span class="text-xl">🏠</span>
                    <span>Dashboard</span>
                </span>
            </a>

            <a href="{{ route('admin.users') ?? '#' }}"
               class="block px-4 py-3 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors
               {{ request()->routeIs('admin.users') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-3">
                    <span class="text-xl">👤</span>
                    <span>Users</span>
                </span>
            </a>

            <a href="{{ route('admin.products') ?? '#' }}"
               class="block px-4 py-3 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors
               {{ request()->routeIs('admin.products') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-3">
                    <span class="text-xl">📦</span>
                    <span>Products</span>
                </span>
            </a>

            <hr class="my-4 border-gray-300 dark:border-gray-600">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded text-red-600 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-900/30 transition-colors">
                    <span class="flex items-center gap-3">
                        <span class="text-xl">🚪</span>
                        <span>Logout</span>
                    </span>
                </button>
            </form>

        </nav>
    </aside>

    <!-- CONTENT -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- MOBILE HEADER BAR (with hamburger menu) -->
        <div class="lg:hidden h-16 bg-white dark:bg-gray-800 shadow flex items-center justify-between px-4">
            <!-- Hamburger Button -->
            <button onclick="toggleSidebar()"
                    class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <span class="font-bold text-lg">🚘 Admin</span>

            <!-- Placeholder for right side (optional) -->
            <div class="w-6"></div>
        </div>

        <!-- PAGE HEADER (Desktop) -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow px-4 sm:px-6 py-4 hidden lg:block">
                {{ $header }}
            </header>
        @endisset

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-4 sm:p-6 text-gray-900 dark:text-gray-100 overflow-x-hidden">
            {{ $slot }}
        </main>

    </div>

</div>

<!-- JavaScript for Sidebar Toggle -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        // Toggle sidebar
        sidebar.classList.toggle('-translate-x-full');

        // Toggle overlay
        overlay.classList.toggle('hidden');
    }

    // Close sidebar when clicking on a link (mobile only)
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarLinks = document.querySelectorAll('#sidebar a');

        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Only close on mobile
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });
    });

    // Close sidebar when resizing to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
        }
    });
</script>

</body>
</html>
