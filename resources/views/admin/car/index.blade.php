{{-- resources/views/admin/armada/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Inventaris Armada</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <p class="text-gray-600">Kelola dan pantau seluruh unit kendaraan operasional.</p>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <button class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter
                </button>

                <button class="px-4 py-2 text-sm font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100">
                    SEMUA (120)
                </button>
                <button class="px-4 py-2 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100">
                    TERSEDIA (36)
                </button>
                <button class="px-4 py-2 text-sm font-medium text-orange-700 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100">
                    DISEWA (72)
                </button>
                <button class="px-4 py-2 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100">
                    SERVIS (12)
                </button>
            </div>

           <a href="{{ route('admin.car.create') }}"
   class="flex items-center px-6 py-2.5 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 shadow-sm font-medium">

    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4v16m8-8H4"></path>
    </svg>

    Tambah Armada
</a>

        </div>
    </div>

    <!-- Fleet Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-6">
        <!-- Vehicle Card 1 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=400&h=250&fit=crop"
                     alt="Toyota Hiace"
                     class="w-full h-48 object-cover">
                <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                    TERSEDIA
                </span>
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-gray-800">Toyota Hiace Premio</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-3">B 1234 SQD • 16 Penumpang</p>

                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Diesel
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        </svg>
                        Manual
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <p class="text-lg font-bold text-yellow-600">IDR 1.2M<span class="text-xs text-gray-500 font-normal">/hari</span></p>
                </div>
            </div>
        </div>

        <!-- Vehicle Card 2 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=400&h=250&fit=crop"
                     alt="Mitsubishi Pajero"
                     class="w-full h-48 object-cover">
                <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold text-orange-800 bg-orange-100 rounded-full">
                    DISEWA
                </span>
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-gray-800">Mitsubishi Pajero Sport</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-3">B 8888 SQD • 7 Penumpang</p>

                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Diesel
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Matic
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <p class="text-lg font-bold text-yellow-600">IDR 950K<span class="text-xs text-gray-500 font-normal">/hari</span></p>
                </div>
            </div>
        </div>

        <!-- Vehicle Card 3 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=400&h=250&fit=crop"
                     alt="Innova Zenix"
                     class="w-full h-48 object-cover">
                <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                    TERSEDIA
                </span>
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-gray-800">Innova Zenix Hybrid</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-3">B 2024 SQD • 7 Penumpang</p>

                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Hybrid
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Matic
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <p class="text-lg font-bold text-yellow-600">IDR 850K<span class="text-xs text-gray-500 font-normal">/hari</span></p>
                </div>
            </div>
        </div>

        <!-- Vehicle Card 4 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=400&h=250&fit=crop"
                     alt="Toyota Alphard"
                     class="w-full h-48 object-cover">
                <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                    SERVIS
                </span>
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-gray-800">Toyota Alphard Gen 4</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-3">B 1 SQD • 6 Penumpang</p>

                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Bensin
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Matic
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <p class="text-lg font-bold text-yellow-600">IDR 2.8M<span class="text-xs text-gray-500 font-normal">/hari</span></p>
                </div>
            </div>
        </div>

        <!-- Vehicle Card 5 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=400&h=250&fit=crop"
                     alt="Hino Big Bus"
                     class="w-full h-48 object-cover">
                <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold text-orange-800 bg-orange-100 rounded-full">
                    DISEWA
                </span>
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-gray-800">Hino Big Bus Jetbus</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-3">B 7000 SQD • 50 Penumpang</p>

                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Diesel
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        </svg>
                        Manual
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <p class="text-lg font-bold text-yellow-600">IDR 4.5M<span class="text-xs text-gray-500 font-normal">/hari</span></p>
                </div>
            </div>
        </div>

        <!-- Add New Card -->
        <div class="bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 overflow-hidden hover:border-yellow-400 hover:bg-yellow-50 transition-all cursor-pointer">
            <div class="h-full flex flex-col items-center justify-center p-8 text-center">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-700 mb-2">Tambah Armada Baru</h3>
                <p class="text-sm text-gray-500">Klik untuk menambahkan unit kendaraan baru ke sistem.</p>
            </div>
        </div>
    </div>

    <!-- Load More Section -->
    <div class="text-center py-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Muat Lebih Banyak</h3>
        <p class="text-sm text-gray-500 mb-4">Menampilkan 5 dari 120 Armada</p>
        <button class="px-6 py-2.5 border-2 border-yellow-400 text-yellow-600 rounded-lg hover:bg-yellow-50 font-medium transition-colors">
            Tampilkan Lebih Banyak
        </button>
    </div>
</x-admin-layout>
