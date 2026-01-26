<x-app-layout>
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10">

        <div class="mb-8">
            <a href="{{ route('cars.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-yellow-600 transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
                <span class="font-medium">Kembali ke Daftar Armada</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-8 py-6">
                <h1 class="text-3xl font-bold text-white mb-2">Form Pemesanan</h1>
                <p class="text-yellow-50">Isi detail pemesanan Anda dengan lengkap</p>
            </div>

            <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm" class="p-8">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Left Column - Car Info --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-24">
                            <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Mobil yang Dipilih</h3>

                                <img src="{{ $car->main_image }}" alt="{{ $car->name }}" class="w-full h-40 object-cover rounded-lg mb-4">

                                <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $car->brand }} {{ $car->name }}</h4>
                                <p class="text-sm text-gray-500 mb-4">{{ $car->year }} • {{ $car->category }}</p>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <span class="material-symbols-outlined text-yellow-500 text-lg">groups</span>
                                        <span>{{ $car->seats }} Penumpang</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <span class="material-symbols-outlined text-yellow-500 text-lg">settings</span>
                                        <span>{{ $car->transmission }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <span class="material-symbols-outlined text-yellow-500 text-lg">ev_station</span>
                                        <span>{{ $car->fuel_type }}</span>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <p class="text-xs text-gray-500 mb-1">Harga Dasar (24 Jam)</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $car->formatted_price_24h }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column - Booking Form --}}
                    <div class="lg:col-span-2">

                        {{-- Service Type --}}
                        <div class="mb-8">
                            <label class="block text-gray-900 font-semibold mb-3">
                                <span class="material-symbols-outlined text-yellow-500 align-middle">info</span>
                                Jenis Layanan <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="service_type" value="lepas_kunci" class="peer sr-only" required>
                                    <div class="p-5 border-2 border-gray-200 rounded-xl peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:border-yellow-300 transition-all">
                                        <div class="flex flex-col items-center text-center">
                                            <span class="material-symbols-outlined text-3xl text-yellow-500 mb-2">key</span>
                                            <p class="font-bold text-gray-900">Lepas Kunci</p>
                                            <p class="text-xs text-gray-500 mt-1">Tanpa sopir</p>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer">
                                    <input type="radio" name="service_type" value="dengan_sopir" class="peer sr-only">
                                    <div class="p-5 border-2 border-gray-200 rounded-xl peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:border-yellow-300 transition-all">
                                        <div class="flex flex-col items-center text-center">
                                            <span class="material-symbols-outlined text-3xl text-yellow-500 mb-2">person</span>
                                            <p class="font-bold text-gray-900">Dengan Sopir</p>
                                            <p class="text-xs text-gray-500 mt-1">+Rp 200rb/hari</p>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer">
                                    <input type="radio" name="service_type" value="carter" class="peer sr-only">
                                    <div class="p-5 border-2 border-gray-200 rounded-xl peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:border-yellow-300 transition-all">
                                        <div class="flex flex-col items-center text-center">
                                            <span class="material-symbols-outlined text-3xl text-yellow-500 mb-2">local_taxi</span>
                                            <p class="font-bold text-gray-900">Carter</p>
                                            <p class="text-xs text-gray-500 mt-1">Full day + sopir</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('service_type')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Date & Time --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-900 font-semibold mb-2">
                                    Tanggal & Waktu Mulai <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" name="start_datetime"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all"
                                       min="{{ now()->addHours(2)->format('Y-m-d\TH:i') }}"
                                       required>
                                @error('start_datetime')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-900 font-semibold mb-2">
                                    Tanggal & Waktu Selesai <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" name="end_datetime"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all"
                                       required>
                                @error('end_datetime')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Driver Selection (conditional) --}}
                        <div id="driverSection" class="mb-6 hidden">
                            <label class="block text-gray-900 font-semibold mb-2">
                                Pilih Sopir <span class="text-red-500">*</span>
                            </label>
                            <select name="driver_id" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all">
                                <option value="">-- Pilih Sopir --</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }} - {{ $driver->phone }}</option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Destination --}}
                        <div class="mb-6">
                            <label class="block text-gray-900 font-semibold mb-2">
                                Tujuan / Alamat Penjemputan
                            </label>
                            <textarea name="destination" rows="3"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all resize-none"
                                      placeholder="Contoh: Jl. Merdeka No. 123, Madiun"></textarea>
                            @error('destination')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Price Summary --}}
                        <div id="priceSummary" class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-6 border-2 border-yellow-200 mb-6 hidden">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Biaya</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">Durasi</span>
                                    <span class="font-bold text-gray-900" id="durationDisplay">-</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">Harga per Hari</span>
                                    <span class="font-bold text-gray-900" id="basePriceDisplay">-</span>
                                </div>
                                <div class="border-t-2 border-yellow-300 pt-3 flex justify-between items-center">
                                    <span class="text-gray-900 font-semibold">Total Harga</span>
                                    <span class="text-2xl font-bold text-yellow-600" id="totalPriceDisplay">-</span>
                                </div>
                                <div class="flex justify-between items-center bg-white rounded-lg p-3">
                                    <span class="text-gray-900 font-semibold">DP (30%)</span>
                                    <span class="text-xl font-bold text-green-600" id="dpDisplay">-</span>
                                </div>
                            </div>
                        </div>

                        {{-- Terms --}}
                        <div class="mb-6">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input type="checkbox" required class="mt-1 w-5 h-5 border-gray-300 rounded text-yellow-500 focus:ring-yellow-500">
                                <span class="text-sm text-gray-700">
                                    Saya setuju dengan <a href="#" class="text-yellow-600 font-semibold hover:underline">syarat dan ketentuan</a> yang berlaku
                                </span>
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <span class="flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">check_circle</span>
                                <span>Buat Pemesanan</span>
                            </span>
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Show/hide driver section based on service type
        const serviceTypeInputs = document.querySelectorAll('input[name="service_type"]');
        const driverSection = document.getElementById('driverSection');
        const driverSelect = document.querySelector('select[name="driver_id"]');

        serviceTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'dengan_sopir' || this.value === 'carter') {
                    driverSection.classList.remove('hidden');
                    driverSelect.required = true;
                } else {
                    driverSection.classList.add('hidden');
                    driverSelect.required = false;
                    driverSelect.value = '';
                }
                calculatePrice();
            });
        });

        // Calculate price when dates change
        const startDateInput = document.querySelector('input[name="start_datetime"]');
        const endDateInput = document.querySelector('input[name="end_datetime"]');

        startDateInput.addEventListener('change', calculatePrice);
        endDateInput.addEventListener('change', calculatePrice);

        function calculatePrice() {
            const carId = document.querySelector('input[name="car_id"]').value;
            const serviceType = document.querySelector('input[name="service_type"]:checked')?.value;
            const startDateTime = startDateInput.value;
            const endDateTime = endDateInput.value;

            if (!serviceType || !startDateTime || !endDateTime) return;

            fetch('{{ route("bookings.calculate-price") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    car_id: carId,
                    service_type: serviceType,
                    start_datetime: startDateTime,
                    end_datetime: endDateTime
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('priceSummary').classList.remove('hidden');
                document.getElementById('durationDisplay').textContent = data.duration_days + ' Hari';
                document.getElementById('basePriceDisplay').textContent = 'Rp ' + data.base_price.toLocaleString('id-ID');
                document.getElementById('totalPriceDisplay').textContent = data.formatted_total;
                document.getElementById('dpDisplay').textContent = data.formatted_dp;
            });
        }
    </script>
</x-app-layout>
