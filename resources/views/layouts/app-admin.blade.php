<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
        <div class="h-16 flex items-center justify-center font-bold text-lg border-b dark:border-gray-700">
            🚘 SquadTrans Admin
        </div>

        <nav class="p-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700
               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('admin.users') ?? '#' }}"
               class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                👤 Users
            </a>

            <a href="{{ route('admin.products') ?? '#' }}"
               class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                📦 Products
            </a>

            <hr class="my-4">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded text-red-600 hover:bg-red-100 dark:hover:bg-red-700">
                    🚪 Logout
                </button>
            </form>

        </nav>
    </aside>

    <!-- CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- HEADER -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow px-6 py-4">
                {{ $header }}
            </header>
        @endisset

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-6 text-gray-900 dark:text-gray-100">
            {{ $slot }}
        </main>

    </div>

</div>

</body>
</html>
