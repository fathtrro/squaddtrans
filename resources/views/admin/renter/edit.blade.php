<x-admin-layout>
    <x-slot name="header">Edit Data Penyewa</x-slot>

    <!-- Breadcrumb & Back Button -->
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.renter.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <span class="text-gray-500 text-sm">Data Penyewaan</span>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold text-sm">Edit Penyewa</span>
        </div>
    </div>

    <!-- Form Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.renter.update', $booking->id) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                @csrf
                @method('PUT')

                <!-- Customer & Vehicle Section -->
                <div class="border-b border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Pelanggan & Kendaraan</h3>

                    <div class="space-y-5">
                        <!-- Car Select -->
                        <div>
                            <label for="car_id" class="block text-sm font-semibold text-gray-700 mb-2">Kendaraan <span class="text-red-500">*</span></label>
                            <select
                                id="car_id"
                                name="car_id"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-gray-900 @error('car_id') border-red-500 @enderror"
                                required>
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}" {{ old('car_id', $booking->car_id) == $car->id ? 'selected' : '' }}>
                                        {{ $car->brand }} {{ $car->name }} ({{ $car->plate_number }})
                                    </option>
                                @endforeach
                            </select>
                            @error('car_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Rental Period Section -->
                <div class="border-b border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Periode Penyewaan</h3>

                    <div class="space-y-5">
                        <!-- Start DateTime -->
                        <div>
                            <label for="start_datetime" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal & Waktu Mulai <span class="text-red-500">*</span></label>
                            <input
                                type="datetime-local"
                                id="start_datetime"
                                name="start_datetime"
                                value="{{ old('start_datetime', $booking->start_datetime->format('Y-m-d\\TH:i')) }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent @error('start_datetime') border-red-500 @enderror"
                                required>
                            @error('start_datetime')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End DateTime -->
                        <div>
                            <label for="end_datetime" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal & Waktu Selesai <span class="text-red-500">*</span></label>
                            <input
                                type="datetime-local"
                                id="end_datetime"
                                name="end_datetime"
                                value="{{ old('end_datetime', $booking->end_datetime->format('Y-m-d\\TH:i')) }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent @error('end_datetime') border-red-500 @enderror"
                                required>
                            @error('end_datetime')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Destination & Contact Section -->
                <div class="border-b border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Tujuan & Kontak</h3>

                    <div class="space-y-5">
                        <!-- Destination -->
                        <div>
                            <label for="destination" class="block text-sm font-semibold text-gray-700 mb-2">Tujuan</label>
                            <input
                                type="text"
                                id="destination"
                                name="destination"
                                value="{{ old('destination', $booking->destination) }}"
                                placeholder="Masukkan tujuan perjalanan"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                        </div>

                        <!-- Contact -->
                        <div>
                            <label for="contact" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Kontak</label>
                            <input
                                type="text"
                                id="contact"
                                name="contact"
                                value="{{ old('contact', $booking->contact) }}"
                                placeholder="Contoh: 08123456789"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                            <textarea
                                id="alamat"
                                name="alamat"
                                placeholder="Masukkan alamat lengkap"
                                rows="3"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">{{ old('alamat', $booking->alamat) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Pricing Section -->
                <div class="border-b border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Harga & Pembayaran</h3>

                    <div class="grid grid-cols-2 gap-5">
                        <!-- DP Amount -->
                        <div>
                            <label for="dp_amount" class="block text-sm font-semibold text-gray-700 mb-2">Uang Muka (Rp) <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                id="dp_amount"
                                name="dp_amount"
                                value="{{ old('dp_amount', $booking->dp_amount) }}"
                                step="1000"
                                min="0"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent @error('dp_amount') border-red-500 @enderror"
                                required>
                            @error('dp_amount')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Total Price -->
                        <div>
                            <label for="total_price" class="block text-sm font-semibold text-gray-700 mb-2">Harga Total (Rp) <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                id="total_price"
                                name="total_price"
                                value="{{ old('total_price', $booking->total_price) }}"
                                step="1000"
                                min="0"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent @error('total_price') border-red-500 @enderror"
                                required>
                            @error('total_price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="p-6">
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select
                        id="status"
                        name="status"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-gray-900 @error('status') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Status --</option>
                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="running" {{ old('status', $booking->status) == 'running' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex items-center justify-between">
                    <a href="{{ route('admin.renter.index') }}" class="px-6 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-2.5 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg transition-colors">
                        Perbarui Penyewa
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1">
            <!-- Booking Info Card -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-6">
                <h4 class="font-semibold text-gray-900 mb-3">Informasi Penyewaan</h4>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500 text-xs uppercase">Kode Booking</p>
                        <p class="text-gray-900 font-semibold">{{ $booking->booking_code }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs uppercase">Pelanggan</p>
                        <p class="text-gray-900 font-semibold">{{ $booking->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs uppercase">Status Saat Ini</p>
                        <p class="text-gray-900 font-semibold capitalize">{{ $booking->status }}</p>
                    </div>
                </div>
            </div>

            <!-- Important Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">
                <h4 class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Catatan
                </h4>
                <p class="text-sm text-blue-800">
                    Perubahan data akan diperbarui secara otomatis. Pastikan semua data sudah benar sebelum menyimpan.
                </p>
            </div>
        </div>
    </div>
</x-admin-layout>
