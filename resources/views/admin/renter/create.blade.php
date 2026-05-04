<x-admin-layout>
    <x-slot name="header">Tambah Penyewa Baru</x-slot>

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
            <span class="text-gray-900 font-semibold text-sm">Tambah Penyewa</span>
        </div>
    </div>

    <!-- Form Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.renter.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                @csrf

                <!-- Customer & Vehicle Section -->
                <div class="border-b border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Pelanggan & Kendaraan</h3>

                    <div class="space-y-5">
                        <!-- Customer Select -->
                        <div>
                            <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">Pelanggan <span class="text-red-500">*</span></label>
                            <select
                                id="user_id"
                                name="user_id"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-gray-900 @error('user_id') border-red-500 @enderror"
                                required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

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
                                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->brand }} {{ $car->name }} ({{ $car->plate_number }})
                                    </option>
                                @endforeach
                            </select>
                            @error('car_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Type -->
                        <div>
                            <label for="service_type" class="block text-sm font-semibold text-gray-700 mb-2">Tipe Layanan <span class="text-red-500">*</span></label>
                            <select
                                id="service_type"
                                name="service_type"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-gray-900 @error('service_type') border-red-500 @enderror"
                                required>
                                <option value="">-- Pilih Tipe Layanan --</option>
                                <option value="with_driver" {{ old('service_type') == 'with_driver' ? 'selected' : '' }}>Dengan Sopir</option>
                                <option value="without_driver" {{ old('service_type') == 'without_driver' ? 'selected' : '' }}>Tanpa Sopir</option>
                                <option value="self_drive" {{ old('service_type') == 'self_drive' ? 'selected' : '' }}>Self Drive</option>
                            </select>
                            @error('service_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Driver Select (Optional) -->
                        <div>
                            <label for="driver_id" class="block text-sm font-semibold text-gray-700 mb-2">Sopir</label>
                            <select
                                id="driver_id"
                                name="driver_id"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-gray-900">
                                <option value="">-- Pilih Sopir (Opsional) --</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }}
                                    </option>
                                @endforeach
                            </select>
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
                                value="{{ old('start_datetime') }}"
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
                                value="{{ old('end_datetime') }}"
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
                                value="{{ old('destination') }}"
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
                                value="{{ old('contact') }}"
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
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Pricing Section -->
                <div class="border-b border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Harga & Pembayaran</h3>

                    <div class="grid grid-cols-2 gap-5">
                        <!-- DP Amount -->
                        <div>
                            <x-price-input
                                name="dp_amount"
                                label="Uang Muka (DP)"
                                :value="old('dp_amount', 0)"
                                placeholder="Contoh: 500.000"
                                required
                                helpText="Minimal 30% dari total harga"
                            />
                        </div>

                        <!-- Total Price -->
                        <div>
                            <x-price-input
                                name="total_price"
                                label="Harga Total"
                                :value="old('total_price', 0)"
                                placeholder="Contoh: 1.500.000"
                                required
                            />
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
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="running" {{ old('status') == 'running' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
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
                        Simpan Penyewa
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1">
            <!-- Instructions Card -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
                <h4 class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Petunjuk
                </h4>
                <ul class="text-sm text-blue-800 space-y-2">
                    <li class="flex gap-2">
                        <span class="text-blue-500 font-bold">1.</span>
                        <span>Pilih pelanggan dan kendaraan</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-500 font-bold">2.</span>
                        <span>Tentukan periode penyewaan</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-500 font-bold">3.</span>
                        <span>Masukkan harga dan status</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-500 font-bold">4.</span>
                        <span>Klik "Simpan" untuk menambah</span>
                    </li>
                </ul>
            </div>

            <!-- Important Info -->
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-5">
                <h4 class="font-semibold text-amber-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Catatan Penting
                </h4>
                <p class="text-sm text-amber-800">
                    Pastikan semua data yang dimasukkan sudah benar sebelum menyimpan. Anda dapat mengedit data ini kemudian dari halaman detail.
                </p>
            </div>
        </div>
    </div>
</x-admin-layout>
