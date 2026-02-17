<x-admin-layout>
    <x-slot name="header">Formulir Return & Checklist Setelah Perjalanan</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Return Kendaraan</h1>
                <p class="text-gray-600 mt-1">Isi form checklist setelah perjalanan sebelum menyelesaikan booking</p>
            </div>

            <a href="{{ route('admin.renter.show', $booking->id) }}"
               class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium text-gray-700 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Booking Info Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Booking</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Kode Booking</p>
                <p class="text-lg font-bold text-gray-900">{{ $booking->booking_code }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Mobil</p>
                <p class="text-lg font-bold text-gray-900">{{ $booking->car->name }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Penyewa</p>
                <p class="text-lg font-bold text-gray-900">{{ $booking->user->name }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Tanggal Selesai</p>
                <p class="text-lg font-bold text-gray-900">{{ $booking->formatted_end_date }}</p>
            </div>
        </div>
    </div>

    <!-- Comparison Info -->
    @if($beforeChecklist)
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <h3 class="font-semibold text-blue-900">Referensi Checklist Sebelum</h3>
                <p class="text-sm text-blue-700 mt-1">Bandingkan kondisi mobil dengan checklist sebelum perjalanan untuk mengidentifikasi kerusakan.</p>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg p-4 border border-blue-100">
                <p class="text-xs font-medium text-gray-500 mb-2">Kondisi Bodi Sebelum</p>
                <p class="text-sm text-gray-900">{{ $beforeChecklist->body_condition ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-lg p-4 border border-blue-100">
                <p class="text-xs font-medium text-gray-500 mb-2">Kondisi Interior Sebelum</p>
                <p class="text-sm text-gray-900">{{ $beforeChecklist->interior_condition ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-lg p-4 border border-blue-100">
                <p class="text-xs font-medium text-gray-500 mb-2">Level Bahan Bakar Sebelum</p>
                <p class="text-sm text-gray-900">{{ $beforeChecklist->fuel_level ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-lg p-4 border border-blue-100">
                <p class="text-xs font-medium text-gray-500 mb-2">Aksesori/Perlengkapan Sebelum</p>
                <p class="text-sm text-gray-900">{{ $beforeChecklist->accessories ?? '-' }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Return Form -->
    <form method="POST" action="{{ route('admin.booking.return.submit', $booking->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Kondisi Kendaraan Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Kondisi Kendaraan Setelah Perjalanan</h2>

            <div class="space-y-6">
                <!-- Body Condition Quick Select -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        🚗 Kondisi Bodi Kendaraan *
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        <button type="button" class="condition-btn" data-field="body_condition" data-value="Baik - Tidak ada kerusakan" data-status="baik">
                            <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 hover:bg-green-50 transition-all">
                                <svg class="w-6 h-6 mx-auto text-green-600 mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <p class="font-semibold text-sm">Baik</p>
                                <p class="text-xs text-gray-600">Tidak ada kerusakan</p>
                            </div>
                        </button>
                        <button type="button" class="condition-btn" data-field="body_condition" data-value="Ada Goresan - Goresan ringan pada cat" data-status="cacat">
                            <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-yellow-500 hover:bg-yellow-50 transition-all">
                                <svg class="w-6 h-6 mx-auto text-yellow-600 mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <p class="font-semibold text-sm">Ada Goresan</p>
                                <p class="text-xs text-gray-600">Kerusakan ringan</p>
                            </div>
                        </button>
                        <button type="button" class="condition-btn" data-field="body_condition" data-value="Rusak - Penyok/kerusakan berat" data-status="rusak">
                            <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-red-500 hover:bg-red-50 transition-all">
                                <svg class="w-6 h-6 mx-auto text-red-600 mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                <p class="font-semibold text-sm">Rusak</p>
                                <p class="text-xs text-gray-600">Kerusakan berat</p>
                            </div>
                        </button>
                    </div>
                    <input type="hidden" name="body_condition" id="body_condition" value="{{ old('body_condition', $beforeChecklist->body_condition ?? '') }}" required>
                    @error('body_condition')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interior Condition Quick Select -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        🪑 Kondisi Interior Kendaraan *
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        <button type="button" class="condition-btn" data-field="interior_condition" data-value="Baik - Bersih dan utuh" data-status="baik">
                            <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 hover:bg-green-50 transition-all">
                                <svg class="w-6 h-6 mx-auto text-green-600 mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <p class="font-semibold text-sm">Baik</p>
                                <p class="text-xs text-gray-600">Bersih & utuh</p>
                            </div>
                        </button>
                        <button type="button" class="condition-btn" data-field="interior_condition" data-value="Ada Cacat - Cakar/noda pada interior" data-status="cacat">
                            <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-yellow-500 hover:bg-yellow-50 transition-all">
                                <svg class="w-6 h-6 mx-auto text-yellow-600 mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <p class="font-semibold text-sm">Ada Cacat</p>
                                <p class="text-xs text-gray-600">Rusak ringan</p>
                            </div>
                        </button>
                        <button type="button" class="condition-btn" data-field="interior_condition" data-value="Rusak - Kerusakan parah pada interior" data-status="rusak">
                            <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-red-500 hover:bg-red-50 transition-all">
                                <svg class="w-6 h-6 mx-auto text-red-600 mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                <p class="font-semibold text-sm">Rusak Parah</p>
                                <p class="text-xs text-gray-600">Rusak berat</p>
                            </div>
                        </button>
                    </div>
                    <input type="hidden" name="interior_condition" id="interior_condition" value="{{ old('interior_condition', $beforeChecklist->interior_condition ?? '') }}" required>
                    @error('interior_condition')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fuel Level -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        ⛽ Level Bahan Bakar *
                    </label>
                    <div class="flex gap-3">
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="Penuh (Full)" class="rounded" @if(old('fuel_level') === 'Penuh (Full)' || (!old('fuel_level') && $beforeChecklist->fuel_level === 'Penuh (Full)')) checked @endif required>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩 Penuh</span>
                        </label>
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="3/4" class="rounded" @if(old('fuel_level') === '3/4' || (!old('fuel_level') && $beforeChecklist->fuel_level === '3/4')) checked @endif>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩🟩🟩 3/4</span>
                        </label>
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="1/2" class="rounded" @if(old('fuel_level') === '1/2' || (!old('fuel_level') && $beforeChecklist->fuel_level === '1/2')) checked @endif>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩🟩 1/2</span>
                        </label>
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="1/4" class="rounded" @if(old('fuel_level') === '1/4' || (!old('fuel_level') && $beforeChecklist->fuel_level === '1/4')) checked @endif>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩 1/4</span>
                        </label>
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="Kosong" class="rounded" @if(old('fuel_level') === 'Kosong' || (!old('fuel_level') && $beforeChecklist->fuel_level === 'Kosong')) checked @endif>
                            <span class="ml-2 text-sm font-semibold text-gray-700">⬜ Kosong</span>
                        </label>
                    </div>
                    @error('fuel_level')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Accessories Checklist -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        🔧 Status Aksesori & Perlengkapan *
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @php
                            $accessories = ['Dongkrak', 'Kunci Roda', 'Segitiga Safety', 'Jek', 'Kunci Inggris', 'Odol', 'Kabel Jumper'];
                            $selectedAccessories = old('accessories') ? explode(',', old('accessories')) : explode(',', $beforeChecklist->accessories ?? '');
                        @endphp
                        @foreach($accessories as $item)
                            <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all">
                                <input type="checkbox" name="accessories_list[]" value="{{ $item }}" class="rounded" @if(in_array(trim($item), array_map('trim', $selectedAccessories))) checked @endif>
                                <span class="ml-2 text-sm font-semibold text-gray-700">{{ $item }}</span>
                            </label>
                        @endforeach
                    </div>
                    <input type="hidden" name="accessories" id="accessories">
                    @error('accessories')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        📝 Catatan Tambahan
                    </label>
                    <textarea name="notes" id="notes" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                        placeholder="Catatan tambahan atau observasi lainnya (opsional)">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Photo Documentation Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Dokumentasi Foto</h2>
            <p class="text-sm text-gray-600 mb-4">Upload foto untuk mendokumentasikan kondisi kendaraan (semua opsional, max 5MB per file)</p>

            <div class="space-y-4">
                <!-- Damage Photos -->
                <div>
                    <label for="photos_damage" class="block text-sm font-medium text-gray-900 mb-2">
                        Foto Kerusakan (jika ada)
                    </label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-400 transition-colors">
                        <input type="file" name="photos[damage][]" id="photos_damage" multiple accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Klik atau drag file foto kerusakan</p>
                        </div>
                    </div>
                    @error('photos.damage.*')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interior Photos -->
                <div>
                    <label for="photos_interior" class="block text-sm font-medium text-gray-900 mb-2">
                        Foto Interior
                    </label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-400 transition-colors">
                        <input type="file" name="photos[interior][]" id="photos_interior" multiple accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Klik atau drag file foto interior</p>
                        </div>
                    </div>
                    @error('photos.interior.*')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Other Photos (Fuel, Exterior, etc) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="photos_fuel" class="block text-sm font-medium text-gray-900 mb-2">
                            Foto Bahan Bakar
                        </label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition-colors">
                            <input type="file" name="photos[fuel][]" id="photos_fuel" multiple accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="text-center">
                                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="mt-1 text-xs text-gray-600">Upload foto</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="photos_tire" class="block text-sm font-medium text-gray-900 mb-2">
                            Foto Ban
                        </label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition-colors">
                            <input type="file" name="photos[tire][]" id="photos_tire" multiple accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="text-center">
                                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="mt-1 text-xs text-gray-600">Upload foto</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="photos_exterior" class="block text-sm font-medium text-gray-900 mb-2">
                            Foto Eksterior
                        </label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition-colors">
                            <input type="file" name="photos[exterior][]" id="photos_exterior" multiple accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="text-center">
                                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="mt-1 text-xs text-gray-600">Upload foto</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex gap-3 justify-end">
            <a href="{{ route('admin.renter.show', $booking->id) }}"
               class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan & Proses Return
            </button>
        </div>
    </form>

    @if($errors->any())
    <div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <h3 class="font-semibold text-red-900">Ada kesalahan dalam form:</h3>
        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <script>
        // Initialize condition buttons with saved values
        function initializeConditionButtons() {
            const bodyValue = document.getElementById('body_condition').value;
            const interiorValue = document.getElementById('interior_condition').value;

            if (bodyValue) {
                document.querySelectorAll('[data-field="body_condition"]').forEach(btn => {
                    if (btn.dataset.value === bodyValue) {
                        const status = btn.dataset.status;
                        if (status === 'baik') {
                            btn.querySelector('div').classList.add('border-green-500', 'bg-green-50');
                        } else if (status === 'cacat') {
                            btn.querySelector('div').classList.add('border-yellow-500', 'bg-yellow-50');
                        } else if (status === 'rusak') {
                            btn.querySelector('div').classList.add('border-red-500', 'bg-red-50');
                        }
                    }
                });
            }

            if (interiorValue) {
                document.querySelectorAll('[data-field="interior_condition"]').forEach(btn => {
                    if (btn.dataset.value === interiorValue) {
                        const status = btn.dataset.status;
                        if (status === 'baik') {
                            btn.querySelector('div').classList.add('border-green-500', 'bg-green-50');
                        } else if (status === 'cacat') {
                            btn.querySelector('div').classList.add('border-yellow-500', 'bg-yellow-50');
                        } else if (status === 'rusak') {
                            btn.querySelector('div').classList.add('border-red-500', 'bg-red-50');
                        }
                    }
                });
            }
        }

        // Handle condition button clicks
        document.querySelectorAll('.condition-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const field = this.dataset.field;
                const value = this.dataset.value;
                const status = this.dataset.status;

                // Set hidden input value
                document.getElementById(field).value = value;

                // Update UI - remove all selected classes for this field
                document.querySelectorAll(`[data-field="${field}"]`).forEach(b => {
                    b.querySelector('div').classList.remove('border-green-500', 'bg-green-50', 'border-yellow-500', 'bg-yellow-50', 'border-red-500', 'bg-red-50');
                    b.querySelector('div').classList.add('border-gray-200');
                });

                // Add selected class to current button
                if (status === 'baik') {
                    this.querySelector('div').classList.add('border-green-500', 'bg-green-50');
                } else if (status === 'cacat') {
                    this.querySelector('div').classList.add('border-yellow-500', 'bg-yellow-50');
                } else if (status === 'rusak') {
                    this.querySelector('div').classList.add('border-red-500', 'bg-red-50');
                }
                this.querySelector('div').classList.remove('border-gray-200');
            });
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeConditionButtons);
        // Handle accessories checklist
        document.querySelectorAll('input[name="accessories_list[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateAccessories);
        });

        function updateAccessories() {
            const selected = Array.from(document.querySelectorAll('input[name="accessories_list[]"]:checked'))
                .map(cb => cb.value)
                .join(', ');
            document.getElementById('accessories').value = selected || 'Semua aksesori tersedia';
        }

        // Initialize accessories on load
        updateAccessories();
    </script>

</x-admin-layout>
