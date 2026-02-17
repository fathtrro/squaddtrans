<x-admin-layout>
    <x-slot name="header">Formulir Checklist Sebelum Perjalanan</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Checklist Kendaraan - Sebelum Perjalanan</h1>
                <p class="text-gray-600 mt-1">Periksa kondisi kendaraan sebelum penyewa mengambilnya</p>
            </div>

            <a href="{{ route('admin.renter.workflow', $booking->id) }}"
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
                <p class="text-lg font-bold text-gray-900">{{ $booking->car->brand }} {{ $booking->car->name }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Penyewa</p>
                <p class="text-lg font-bold text-gray-900">{{ $booking->user->name }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Tanggal Mulai</p>
                <p class="text-lg font-bold text-gray-900">{{ $booking->formatted_start_date }}</p>
            </div>
        </div>
    </div>

    <!-- Checklist Form -->
    <form method="POST" action="{{ route('admin.booking.checklist.before.submit', $booking->id) }}" class="space-y-6">
        @csrf

        <!-- Kondisi Kendaraan Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Pemeriksaan Kondisi Kendaraan</h2>

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
                    <input type="hidden" name="body_condition" id="body_condition" value="{{ old('body_condition', '') }}" required>
                    @error('body_condition')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interior Condition Quick Select -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        🪑 Kondisi Interior *
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
                                <p class="font-semibold text-sm">Rusak</p>
                                <p class="text-xs text-gray-600">Rusak berat</p>
                            </div>
                        </button>
                    </div>
                    <input type="hidden" name="interior_condition" id="interior_condition" value="{{ old('interior_condition', '') }}" required>
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
                            <input type="radio" name="fuel_level" value="Penuh (Full)" class="rounded" @if(old('fuel_level') === 'Penuh (Full)') checked @endif required>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩 Penuh</span>
                        </label>
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="3/4" class="rounded" @if(old('fuel_level') === '3/4') checked @endif>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩🟩🟩 3/4</span>
                        </label>
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="1/2" class="rounded" @if(old('fuel_level') === '1/2') checked @endif>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩🟩 1/2</span>
                        </label>
                        <label class="flex items-center px-4 py-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all flex-1">
                            <input type="radio" name="fuel_level" value="1/4" class="rounded" @if(old('fuel_level') === '1/4') checked @endif>
                            <span class="ml-2 text-sm font-semibold text-gray-700">🟩 1/4</span>
                        </label>
                    </div>
                    @error('fuel_level')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Accessories Checklist -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        🔧 Aksesori/Perlengkapan *
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @php
                            $accessories = ['Dongkrak', 'Kunci Roda', 'Segitiga Safety', 'Jek', 'Kunci Inggris', 'Odol', 'Kabel Jumper'];
                            $oldAccessories = explode(',', old('accessories', ''));
                        @endphp
                        @foreach($accessories as $item)
                            <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all">
                                <input type="checkbox" name="accessories_list[]" value="{{ $item }}" class="rounded" @if(in_array($item, $oldAccessories)) checked @endif>
                                <span class="ml-2 text-sm font-semibold text-gray-700">{{ $item }}</span>
                            </label>
                        @endforeach
                    </div>
                    <input type="hidden" name="accessories" id="accessories">
                    @error('accessories')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Notes -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        📝 Catatan Tambahan
                    </label>
                    <textarea name="notes" id="notes" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                        placeholder="Catatan tambahan atau kondisi khusus lainnya...">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex gap-4">
            <button type="submit" class="flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan & Mulai Penyewaan
            </button>

            <a href="{{ route('admin.renter.workflow', $booking->id) }}" class="flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
        </div>
    </form>

    <script>
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
