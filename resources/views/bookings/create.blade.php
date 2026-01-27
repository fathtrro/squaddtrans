<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Rental Mobil
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

                {{-- HEADER CARD --}}
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Lengkapi Data Booking</h3>
                    <p class="text-blue-100 text-sm">Ikuti langkah-langkah berikut untuk menyelesaikan booking Anda</p>
                </div>

                <div class="p-8">
                    {{-- STEP INDICATOR --}}
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex flex-col items-center flex-1">
                                <div class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-blue-600 text-white">
                                    1
                                </div>
                                <span class="step-label text-xs font-semibold text-blue-600">Mobil</span>
                            </div>
                            <div class="flex-1 h-1 bg-gray-200 mx-2 -mt-8">
                                <div class="step-line h-full bg-blue-600 transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-gray-200 text-gray-500">
                                    2
                                </div>
                                <span class="step-label text-xs font-semibold text-gray-400">Waktu</span>
                            </div>
                            <div class="flex-1 h-1 bg-gray-200 mx-2 -mt-8">
                                <div class="step-line h-full bg-blue-600 transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-gray-200 text-gray-500">
                                    3
                                </div>
                                <span class="step-label text-xs font-semibold text-gray-400">Jaminan</span>
                            </div>
                            <div class="flex-1 h-1 bg-gray-200 mx-2 -mt-8">
                                <div class="step-line h-full bg-blue-600 transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-gray-200 text-gray-500">
                                    4
                                </div>
                                <span class="step-label text-xs font-semibold text-gray-400">Pembayaran</span>
                            </div>
                        </div>
                    </div>

                    <form method="POST"
                          action="{{ route('bookings.store') }}"
                          enctype="multipart/form-data"
                          id="bookingForm">
                        @csrf

                        {{-- STEP 1 --}}
                        <div class="step transition-all duration-300">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                                        </svg>
                                        Pilih Mobil & Layanan
                                    </h4>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Mobil
                                        </label>
                                        <select name="car_id" id="carSelect"
                                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                                                required>
                                            @foreach($cars as $car)
                                                <option value="{{ $car->id }}"
                                                    data-price="{{ $car->price_per_day ?? 300000 }}"
                                                    {{ $selectedCarId == $car->id ? 'selected' : '' }}>
                                                    {{ $car->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Jenis Layanan
                                        </label>
                                        <select name="service_type" id="serviceType"
                                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                                            <option value="lepas_kunci">🔑 Lepas Kunci</option>
                                            <option value="dengan_sopir">👨‍✈️ Dengan Sopir</option>
                                            <option value="carter">🚐 Carter</option>
                                        </select>
                                    </div>

                                    <div id="driverSelectWrapper" class="hidden transition-all duration-300">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Pilih Sopir
                                        </label>
                                        <select name="driver_id" id="driverSelect"
                                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                                            <option value="">Pilih Sopir</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- STEP 2 --}}
                        <div class="step hidden transition-all duration-300">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Waktu & Tujuan
                                    </h4>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Tanggal & Waktu Mulai
                                        </label>
                                        <input type="datetime-local" id="start" name="start_datetime"
                                               class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                                               required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Tanggal & Waktu Selesai
                                        </label>
                                        <input type="datetime-local" id="end" name="end_datetime"
                                               class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                                               required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Tujuan
                                        </label>
                                        <input type="text" name="destination"
                                               class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                                               placeholder="Contoh: Jakarta - Bandung">
                                    </div>

                                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm font-semibold text-gray-700">Durasi:</span>
                                            <span class="text-xl font-bold text-blue-600"><span id="duration">0</span> hari</span>
                                        </div>
                                        <div class="border-t-2 border-blue-200 pt-3 flex items-center justify-between">
                                            <span class="text-sm font-semibold text-gray-700">Total Harga:</span>
                                            <span class="text-2xl font-bold text-indigo-600">Rp <span id="totalPrice">0</span></span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="total_price" id="totalPriceInput">
                                </div>
                            </div>
                        </div>

                        {{-- STEP 3 --}}
                        <div class="step hidden transition-all duration-300">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        Jaminan
                                    </h4>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Tipe Jaminan
                                        </label>
                                        <select name="guarantee_type"
                                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                                            <option value="ktp">📋 KTP</option>
                                            <option value="sim">🪪 SIM</option>
                                            <option value="motor">🏍️ Motor</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Upload Dokumen
                                        </label>
                                        <div class="relative">
                                            <input type="file" name="document_file" id="documentFile"
                                                   class="w-full border-2 border-dashed border-gray-300 rounded-xl p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"
                                                   required>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, atau PDF (Max: 2MB)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- STEP 4 --}}
                        <div class="step hidden transition-all duration-300">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        Pembayaran
                                    </h4>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Jumlah DP (Minimal 30%)
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                            <input type="number" name="amount" id="dpInput"
                                                   class="w-full border-2 border-gray-200 rounded-xl p-3 pl-12 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                                                   placeholder="0" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Metode Pembayaran
                                        </label>
                                        <select name="payment_method"
                                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                                            <option value="cash">💵 Cash</option>
                                            <option value="transfer">🏦 Transfer</option>
                                        </select>
                                    </div>

                                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-5 mt-6">
                                        <div class="flex items-center mb-4">
                                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <h5 class="font-bold text-gray-800">Ringkasan Pembayaran</h5>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Total Harga:</span>
                                                <span class="text-lg font-bold text-gray-800">Rp <span id="summaryTotal">0</span></span>
                                            </div>
                                            <div class="border-t-2 border-green-200 pt-3 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">DP Dibayar:</span>
                                                <span class="text-xl font-bold text-green-600">Rp <span id="summaryDP">0</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- BUTTONS --}}
                        <div class="flex justify-between items-center pt-8 border-t-2 border-gray-100 mt-8">
                            <button type="button" id="prevBtn"
                                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center hidden">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Kembali
                            </button>

                            <button type="button" id="nextBtn"
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center ml-auto">
                                Selanjutnya
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>

                            <button type="submit" id="submitBtn"
                                    class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center ml-auto hidden">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Selesai Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INFO CARD --}}
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-600 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-blue-800">Informasi Penting</p>
                        <p class="text-xs text-blue-700 mt-1">Pastikan semua data yang Anda masukkan sudah benar sebelum menyelesaikan booking. DP minimal 30% dari total harga.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll('.step');
        const labels = document.querySelectorAll('.step-label');
        const indicators = document.querySelectorAll('.step-indicator');
        const lines = document.querySelectorAll('.step-line');

        const serviceType = document.getElementById('serviceType');
        const driverSelect = document.getElementById('driverSelect');
        const driverSelectWrapper = document.getElementById('driverSelectWrapper');

        const start = document.getElementById('start');
        const end = document.getElementById('end');
        const carSelect = document.getElementById('carSelect');

        const durationText = document.getElementById('duration');
        const totalText = document.getElementById('totalPrice');
        const totalInput = document.getElementById('totalPriceInput');

        const dpInput = document.getElementById('dpInput');
        const summaryTotal = document.getElementById('summaryTotal');
        const summaryDP = document.getElementById('summaryDP');

        function showStep(step) {
            steps.forEach((el, i) => {
                el.classList.toggle('hidden', i !== step);
            });

            indicators.forEach((el, i) => {
                if (i < step) {
                    el.classList.remove('bg-gray-200', 'text-gray-500');
                    el.classList.add('bg-green-500', 'text-white');
                    el.innerHTML = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>';
                } else if (i === step) {
                    el.classList.remove('bg-gray-200', 'text-gray-500', 'bg-green-500');
                    el.classList.add('bg-blue-600', 'text-white');
                    el.textContent = i + 1;
                } else {
                    el.classList.remove('bg-blue-600', 'text-white', 'bg-green-500');
                    el.classList.add('bg-gray-200', 'text-gray-500');
                    el.textContent = i + 1;
                }
            });

            labels.forEach((el, i) => {
                if (i === step) {
                    el.classList.remove('text-gray-400');
                    el.classList.add('text-blue-600');
                } else if (i < step) {
                    el.classList.remove('text-gray-400', 'text-blue-600');
                    el.classList.add('text-green-600');
                } else {
                    el.classList.remove('text-blue-600', 'text-green-600');
                    el.classList.add('text-gray-400');
                }
            });

            lines.forEach((line, i) => {
                if (i < step) {
                    line.style.width = '100%';
                } else {
                    line.style.width = '0%';
                }
            });

            prevBtn.classList.toggle('hidden', step === 0);
            nextBtn.classList.toggle('hidden', step === steps.length - 1);
            submitBtn.classList.toggle('hidden', step !== steps.length - 1);
        }

        serviceType.onchange = () => {
            const isLepasKunci = serviceType.value === 'lepas_kunci';
            driverSelectWrapper.classList.toggle('hidden', isLepasKunci);
            driverSelect.classList.toggle('hidden', isLepasKunci);
        };

        function calculatePrice() {
            if (!start.value || !end.value) return;

            const days = Math.ceil(
                (new Date(end.value) - new Date(start.value)) / (1000 * 60 * 60 * 24)
            );

            const price = carSelect.selectedOptions[0].dataset.price * days;

            durationText.innerText = days;
            totalText.innerText = price.toLocaleString('id-ID');
            totalInput.value = price;

            summaryTotal.innerText = price.toLocaleString('id-ID');
            dpInput.min = Math.ceil(price * 0.3);
        }

        start.onchange = calculatePrice;
        end.onchange = calculatePrice;
        carSelect.onchange = calculatePrice;

        dpInput.oninput = () =>
            summaryDP.innerText = Number(dpInput.value).toLocaleString('id-ID');

        nextBtn.onclick = () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        };

        prevBtn.onclick = () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        };

        showStep(currentStep);
    </script>
</x-app-layout>
