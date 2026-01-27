{{-- resources/views/admin/car/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Tambah Armada Baru</x-slot>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.car.index') }}" class="text-gray-600 hover:text-yellow-600">
                        Armada
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="text-gray-800 font-medium">Tambah Baru</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form Section -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informasi Kendaraan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Kendaraan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kendaraan *
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                placeholder="Contoh: Toyota Hiace Premio"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Merek *
                            </label>
                            <input type="text" name="brand" value="{{ old('brand') }}" required
                                placeholder="Contoh: Toyota"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('brand') border-red-500 @enderror">
                            @error('brand')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Plat Nomor *
                            </label>
                            <input type="text" name="plate_number" value="{{ old('plate_number') }}" required
                                placeholder="Contoh: B 1234 SQD"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('plate_number') border-red-500 @enderror">
                            @error('plate_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun Pembuatan *
                            </label>
                            <input type="number" name="year" value="{{ old('year') }}" required min="1990"
                                max="2026" placeholder="2024"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('year') border-red-500 @enderror">
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Type Mobil *
                            </label>

                            <select name="category" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('category') border-red-500 @enderror">

                                <option value="">-- Pilih Type Mobil --</option>
                                <option value="MPV (keluarga)"
                                    {{ old('category') == 'MPV (keluarga)' ? 'selected' : '' }}>MPV (keluarga)</option>
                                <option value="SUV (tangguh/medan berat)"
                                    {{ old('category') == 'SUV (tangguh/medan berat)' ? 'selected' : '' }}>SUV
                                    (tangguh/medan berat)</option>
                                <option value="Hatchback (kompak)"
                                    {{ old('category') == 'Hatchback (kompak)' ? 'selected' : '' }}>Hatchback (kompak)
                                </option>
                                <option value="City Car (lincah di kota)"
                                    {{ old('category') == 'City Car (lincah di kota)' ? 'selected' : '' }}>City Car
                                    (lincah di kota)</option>
                                <option value="Sedan (nyaman)"
                                    {{ old('category') == 'Sedan (nyaman)' ? 'selected' : '' }}>Sedan (nyaman)</option>
                                <option value="Crossover (kombinasi)"
                                    {{ old('category') == 'Crossover (kombinasi)' ? 'selected' : '' }}>Crossover
                                    (kombinasi)</option>
                            </select>

                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Kursi *
                            </label>
                            <input type="number" name="seats" value="{{ old('seats') }}" required min="1"
                                placeholder="Contoh: 5"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('seats') border-red-500 @enderror">

                            @error('seats')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Transmisi *
                            </label>

                            <select name="transmission" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('transmission') border-red-500 @enderror">

                                <option value="">-- Pilih Transmisi --</option>
                                <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual
                                </option>
                                <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>
                                    Automatic</option>
                            </select>

                            @error('transmission')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Bahan Bakar *
                            </label>

                            <select name="fuel_type" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('fuel_type') border-red-500 @enderror">

                                <option value="">-- Pilih Bahan Bakar --</option>
                                <option value="Bensin" {{ old('fuel_type') == 'Bensin' ? 'selected' : '' }}>Bensin
                                </option>
                                <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel
                                </option>
                                <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid
                                </option>
                                <option value="Listrik" {{ old('fuel_type') == 'Listrik' ? 'selected' : '' }}>Listrik
                                </option>
                            </select>

                            @error('fuel_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>
                </div>

                <!-- Harga Sewa -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Harga Sewa</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Harga 12 Jam *
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="price_12h" value="{{ old('price_12h') }}" required
                                    min="0" step="0.01" placeholder="800000.00"
                                    class="w-full pl-14 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('price_12h') border-red-500 @enderror">
                            </div>
                            @error('price_12h')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Harga 24 Jam *
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="price_24h" value="{{ old('price_24h') }}" required
                                    min="0" step="0.01" placeholder="1200000.00"
                                    class="w-full pl-14 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('price_24h') border-red-500 @enderror">
                            </div>
                            @error('price_24h')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Harga 24 jam biasanya lebih tinggi dari 12 jam</p>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Sidebar Section -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Upload Foto -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Foto Kendaraan</h3>

                    <div class="space-y-4">
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-yellow-400 transition-colors cursor-pointer">
                            <input type="file" name="images[]" multiple accept="image/*" class="hidden"
                                id="imageUpload">
                            <label for="imageUpload" class="cursor-pointer">
                                <div
                                    class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-700">Upload Foto</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG hingga 5MB</p>
                            </label>
                        </div>

                        <p class="text-xs text-gray-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Upload minimal 3 foto dari berbagai sudut
                        </p>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl border border-yellow-200 p-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 mb-2">Tips Menambah Armada</h4>
                            <ul class="text-xs text-gray-700 space-y-1">
                                <li>• Pastikan plat nomor belum terdaftar</li>
                                <li>• Foto kendaraan harus jelas</li>
                                <li>• Harga 24 jam umumnya lebih mahal</li>
                                <li>• Set status sesuai kondisi aktual</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="space-y-3">
                        <button type="submit"
                            class="w-full px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 font-semibold shadow-sm transition-all">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Armada
                        </button>

                        <a href="{{ route('admin.car.index') }}"
                            class="block w-full px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium text-center transition-all">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
