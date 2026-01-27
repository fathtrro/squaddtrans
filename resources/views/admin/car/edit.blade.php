{{-- resources/views/admin/car/edit.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Edit Armada</x-slot>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-yellow-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.car.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-yellow-600 md:ml-2">Armada</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-semibold mb-2">Terdapat beberapa kesalahan:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.car.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Form Fields -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Dasar
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama Kendaraan -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kendaraan <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $car->name) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                   placeholder="Contoh: Toyota Avanza Veloz"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Merek -->
                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">
                                Merek <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="brand"
                                   id="brand"
                                   value="{{ old('brand', $car->brand) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('brand') border-red-500 @enderror"
                                   placeholder="Contoh: Toyota"
                                   required>
                            @error('brand')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun -->
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                   name="year"
                                   id="year"
                                   value="{{ old('year', $car->year) }}"
                                   min="1990"
                                   max="{{ date('Y') + 1 }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('year') border-red-500 @enderror"
                                   placeholder="{{ date('Y') }}"
                                   required>
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor Polisi -->
                        <div class="md:col-span-2">
                            <label for="plate_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Polisi <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="plate_number"
                                   id="plate_number"
                                   value="{{ old('plate_number', $car->plate_number) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('plate_number') border-red-500 @enderror"
                                   placeholder="Contoh: B 1234 ABC"
                                   required>
                            @error('plate_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type Mobil -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                Type Mobil <span class="text-red-500">*</span>
                            </label>
                            <select name="category"
                                    id="category"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('category') border-red-500 @enderror">
                                <option value="">-- Pilih Type Mobil --</option>
                                <option value="MPV (keluarga)" {{ (old('category') ?? $car->category) == 'MPV (keluarga)' ? 'selected' : '' }}>MPV (keluarga)</option>
                                <option value="SUV (tangguh/medan berat)" {{ (old('category') ?? $car->category) == 'SUV (tangguh/medan berat)' ? 'selected' : '' }}>SUV (tangguh/medan berat)</option>
                                <option value="Hatchback (kompak)" {{ (old('category') ?? $car->category) == 'Hatchback (kompak)' ? 'selected' : '' }}>Hatchback (kompak)</option>
                                <option value="City Car (lincah di kota)" {{ (old('category') ?? $car->category) == 'City Car (lincah di kota)' ? 'selected' : '' }}>City Car (lincah di kota)</option>
                                <option value="Sedan (nyaman)" {{ (old('category') ?? $car->category) == 'Sedan (nyaman)' ? 'selected' : '' }}>Sedan (nyaman)</option>
                                <option value="Crossover (kombinasi)" {{ (old('category') ?? $car->category) == 'Crossover (kombinasi)' ? 'selected' : '' }}>Crossover (kombinasi)</option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Kursi -->
                        <div>
                            <label for="seats" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Kursi <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                   name="seats"
                                   id="seats"
                                   value="{{ old('seats', $car->seats) }}"
                                   required
                                   min="1"
                                   placeholder="Contoh: 5"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('seats') border-red-500 @enderror">
                            @error('seats')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Transmisi -->
                        <div>
                            <label for="transmission" class="block text-sm font-medium text-gray-700 mb-2">
                                Transmisi <span class="text-red-500">*</span>
                            </label>
                            <select name="transmission"
                                    id="transmission"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('transmission') border-red-500 @enderror">
                                <option value="">-- Pilih Transmisi --</option>
                                <option value="Manual" {{ strtolower(old('transmission', $car->transmission ?? '')) == 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="Automatic" {{ strtolower(old('transmission', $car->transmission ?? '')) == 'automatic' ? 'selected' : '' }}>Automatic</option>
                            </select>
                            @error('transmission')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Bahan Bakar -->
                        <div>
                            <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Bahan Bakar <span class="text-red-500">*</span>
                            </label>
                            <select name="fuel_type"
                                    id="fuel_type"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('fuel_type') border-red-500 @enderror">
                                <option value="">-- Pilih Bahan Bakar --</option>
                                <option value="Bensin" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'bensin' ? 'selected' : '' }}>Bensin</option>
                                <option value="Diesel" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Hybrid" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="Listrik" {{ strtolower(old('fuel_type', $car->fuel_type ?? '')) == 'listrik' ? 'selected' : '' }}>Listrik</option>
                            </select>
                            @error('fuel_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Harga Sewa
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Harga 12 Jam -->
                        <div>
                            <label for="price_12h" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga 12 Jam <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                <input type="number"
                                       name="price_12h"
                                       id="price_12h"
                                       value="{{ old('price_12h', $car->price_12h) }}"
                                       min="0"
                                       step="0.01"
                                       class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('price_12h') border-red-500 @enderror"
                                       placeholder="500000"
                                       required>
                            </div>
                            @error('price_12h')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga 24 Jam -->
                        <div>
                            <label for="price_24h" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga 24 Jam <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                <input type="number"
                                       name="price_24h"
                                       id="price_24h"
                                       value="{{ old('price_24h', $car->price_24h) }}"
                                       min="0"
                                       step="0.01"
                                       class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('price_24h') border-red-500 @enderror"
                                       placeholder="800000"
                                       required>
                            </div>
                            @error('price_24h')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Images Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Foto Kendaraan
                    </h3>

                    <!-- Current Images -->
                    @if($car->images->count() > 0)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Foto Saat Ini</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($car->images as $image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                             alt="Car image"
                                             class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all rounded-lg flex items-center justify-center">
                                            <label class="cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity">
                                                <input type="checkbox"
                                                       name="remove_images[]"
                                                       value="{{ $image->id }}"
                                                       class="sr-only peer">
                                                <div class="w-8 h-8 bg-red-500 peer-checked:bg-red-700 rounded-full flex items-center justify-center text-white">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Klik gambar untuk menandai untuk dihapus</p>
                        </div>
                    @endif

                    <!-- Upload New Images -->
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                            Tambah Foto Baru (Opsional)
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label for="images" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (Max. 5MB per file)</p>
                                </div>
                                <input id="images"
                                       name="images[]"
                                       type="file"
                                       class="hidden"
                                       accept="image/png,image/jpeg,image/jpg"
                                       multiple
                                       onchange="previewImages(event)">
                            </label>
                        </div>
                        @error('images')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden"></div>
                </div>
            </div>

            <!-- Right Column - Status & Actions -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Status
                    </h3>

                    <div class="space-y-3">
                        <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                            <input type="radio"
                                   name="status"
                                   value="available"
                                   {{ old('status', $car->status) == 'available' ? 'checked' : '' }}
                                   class="w-4 h-4 text-green-600 focus:ring-green-500">
                            <div class="ml-3">
                                <span class="font-medium text-gray-900">Tersedia</span>
                                <p class="text-xs text-gray-500">Kendaraan siap untuk disewakan</p>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                            <input type="radio"
                                   name="status"
                                   value="booked"
                                   {{ old('status', $car->status) == 'booked' ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <div class="ml-3">
                                <span class="font-medium text-gray-900">Dipesan</span>
                                <p class="text-xs text-gray-500">Kendaraan sudah dibooking</p>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50">
                            <input type="radio"
                                   name="status"
                                   value="rented"
                                   {{ old('status', $car->status) == 'rented' ? 'checked' : '' }}
                                   class="w-4 h-4 text-orange-600 focus:ring-orange-500">
                            <div class="ml-3">
                                <span class="font-medium text-gray-900">Sedang Disewa</span>
                                <p class="text-xs text-gray-500">Kendaraan dalam masa sewa</p>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-red-500 has-[:checked]:bg-red-50">
                            <input type="radio"
                                   name="status"
                                   value="maintenance"
                                   {{ old('status', $car->status) == 'maintenance' ? 'checked' : '' }}
                                   class="w-4 h-4 text-red-600 focus:ring-red-500">
                            <div class="ml-3">
                                <span class="font-medium text-gray-900">Dalam Servis</span>
                                <p class="text-xs text-gray-500">Kendaraan sedang maintenance</p>
                            </div>
                        </label>
                    </div>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
                    <div class="space-y-3">
                        <button type="submit"
                                class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 shadow-sm font-medium transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Armada
                        </button>

                        <a href="{{ route('admin.car.index') }}"
                           class="w-full flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Tips:</p>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                <li>Pastikan data kendaraan akurat</li>
                                <li>Upload foto berkualitas baik</li>
                                <li>Update status secara berkala</li>
                                <li>Periksa harga sewa kompetitif</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function previewImages(event) {
            const preview = document.getElementById('imagePreview');
            const files = event.target.files;

            if (files.length === 0) {
                preview.classList.add('hidden');
                return;
            }

            preview.innerHTML = '';
            preview.classList.remove('hidden');

            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${e.target.result}"
                                 class="w-full h-32 object-cover rounded-lg border border-gray-200"
                                 alt="Preview">
                            <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-xs">
                                Baru
                            </div>
                        `;
                        preview.appendChild(div);
                    };

                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
