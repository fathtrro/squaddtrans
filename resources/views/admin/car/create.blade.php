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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kendaraan *</label>
                            <input type="text"
                                   name="name"
                                   required
                                   placeholder="Contoh: Toyota Hiace Premio"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Plat Nomor *</label>
                            <input type="text"
                                   name="plate_number"
                                   required
                                   placeholder="Contoh: B 1234 SQD"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('plate_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Pembuatan *</label>
                            <input type="number"
                                   name="year"
                                   required
                                   min="1990"
                                   max="2026"
                                   placeholder="2024"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Merek *</label>
                            <select name="brand"
                                    required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">Pilih Merek</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Honda">Honda</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Daihatsu">Daihatsu</option>
                                <option value="Hino">Hino</option>
                                <option value="Isuzu">Isuzu</option>
                            </select>
                            @error('brand')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe/Model *</label>
                            <input type="text"
                                   name="model"
                                   required
                                   placeholder="Contoh: Hiace Premio"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('model')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                            <input type="text"
                                   name="color"
                                   placeholder="Contoh: Putih Mutiara"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Penumpang *</label>
                            <input type="number"
                                   name="capacity"
                                   required
                                   min="1"
                                   placeholder="7"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Spesifikasi Teknis -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Spesifikasi Teknis</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Bahan Bakar *</label>
                            <select name="fuel_type"
                                    required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">Pilih Bahan Bakar</option>
                                <option value="Bensin">Bensin</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Electric">Electric</option>
                            </select>
                            @error('fuel_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi *</label>
                            <select name="transmission"
                                    required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">Pilih Transmisi</option>
                                <option value="Manual">Manual</option>
                                <option value="Matic">Matic</option>
                            </select>
                            @error('transmission')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Rangka (VIN)</label>
                            <input type="text"
                                   name="vin"
                                   placeholder="Contoh: MHFXXXXX12345678"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Mesin</label>
                            <input type="text"
                                   name="engine_number"
                                   placeholder="Contoh: 2GD-FTV-1234567"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fitur & Fasilitas</label>
                            <textarea name="features"
                                      rows="3"
                                      placeholder="Contoh: AC, TV, Reclining Seat, USB Charger, Wifi"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Harga & Status -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Harga & Status</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Sewa per Hari *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-500">IDR</span>
                                <input type="number"
                                       name="price_per_day"
                                       required
                                       min="0"
                                       placeholder="1200000"
                                       class="w-full pl-14 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            </div>
                            @error('price_per_day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Kendaraan *</label>
                            <select name="status"
                                    required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="tersedia">Tersedia</option>
                                <option value="disewa">Disewa</option>
                                <option value="servis">Servis</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kilometer (Odometer)</label>
                            <div class="relative">
                                <input type="number"
                                       name="mileage"
                                       min="0"
                                       placeholder="50000"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <span class="absolute right-4 top-3 text-gray-500">km</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Service Terakhir</label>
                            <input type="date"
                                   name="last_service_date"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Dokumen & Asuransi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Dokumen & Asuransi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berlaku STNK</label>
                            <input type="date"
                                   name="stnk_expiry"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berlaku KIR</label>
                            <input type="date"
                                   name="kir_expiry"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Polis Asuransi</label>
                            <input type="text"
                                   name="insurance_policy"
                                   placeholder="Contoh: POL-2024-001234"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berlaku Asuransi</label>
                            <input type="date"
                                   name="insurance_expiry"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Catatan Tambahan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Catatan Tambahan</h3>
                    <textarea name="notes"
                              rows="4"
                              placeholder="Tambahkan catatan khusus tentang kendaraan ini..."
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"></textarea>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Upload Foto -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Foto Kendaraan</h3>

                    <div class="space-y-4">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-yellow-400 transition-colors cursor-pointer">
                            <input type="file"
                                   name="images[]"
                                   multiple
                                   accept="image/*"
                                   class="hidden"
                                   id="imageUpload">
                            <label for="imageUpload" class="cursor-pointer">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-700">Upload Foto</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG hingga 5MB</p>
                            </label>
                        </div>

                        <p class="text-xs text-gray-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Upload minimal 3 foto dari berbagai sudut
                        </p>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl border border-yellow-200 p-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 mb-2">Tips Menambah Armada</h4>
                            <ul class="text-xs text-gray-700 space-y-1">
                                <li>• Pastikan semua dokumen lengkap</li>
                                <li>• Foto kendaraan harus jelas</li>
                                <li>• Periksa kondisi fisik sebelum input</li>
                                <li>• Update status secara berkala</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="space-y-3">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 font-semibold shadow-sm">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Armada
                        </button>

                        <a href="{{ route('admin.car.index') }}"
                           class="block w-full px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium text-center">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
