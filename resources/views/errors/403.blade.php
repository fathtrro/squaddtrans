<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="text-center">
        <h1 class="text-9xl font-bold text-gray-800 mb-4">403</h1>
        <h2 class="text-3xl font-semibold text-gray-700 mb-2">Access Denied</h2>
        <p class="text-gray-500 text-lg mb-8">You don't have permission to access this page.</p>

        <a href="{{ url('/') }}" class="inline-block px-8 py-3 bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-semibold rounded transition">
            Back to home
        </a>
    </div>
</body>
</html>
