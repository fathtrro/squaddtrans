<x-app-layout>
{{-- Booking Form - SQUADTRANS Theme --}}

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap');

:root {
    --primary: #F59E0B;
    --primary-light: #FCD34D;
    --dark: #1F2937;
    --darker: #111827;
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.heading-font {
    font-family: 'Montserrat', sans-serif;
}

/* Header Card */
.header-card {
    background: linear-gradient(135deg, var(--dark) 0%, var(--darker) 100%);
    position: relative;
    overflow: hidden;
}

.header-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(251, 191, 36, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(251, 191, 36, 0.08) 0%, transparent 50%);
}

/* Step Indicator */
.step-indicator {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.step-indicator.active {
    background: linear-gradient(135deg, #FCD34D, #F59E0B) !important;
    color: #111827 !important;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
}

.step-indicator.completed {
    background: #10B981 !important;
    color: white !important;
}

.step-line {
    transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.step-label {
    transition: all 0.3s;
}

.step-label.active {
    color: var(--primary) !important;
    font-weight: 700;
}

.step-label.completed {
    color: #10B981 !important;
}

/* Form Sections */
.form-section {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

@media (min-width: 768px) {
    .form-section {
        border-radius: 24px;
        padding: 32px;
    }
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f3f4f6;
}

.section-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--darker);
}

/* Form Controls */
.form-input,
.form-select {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.3s;
    background: white;
}

.form-input:focus,
.form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

/* Price Summary Card */
.price-summary {
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
    border: 2px solid var(--primary);
    border-radius: 16px;
    padding: 20px;
    position: relative;
    overflow: hidden;
}

.price-summary::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0%, 100% { transform: translate(0, 0); }
    50% { transform: translate(-10%, -10%); }
}

.price-highlight {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Payment Summary */
.payment-summary {
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    border: 2px solid #10B981;
    border-radius: 16px;
    padding: 24px;
}

/* Buttons */
.btn {
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #FCD34D, #F59E0B);
    color: var(--darker);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-secondary {
    background: #f3f4f6;
    color: #6b7280;
}

.btn-secondary:hover {
    background: #e5e7eb;
}

.btn-success {
    background: linear-gradient(135deg, #34D399, #10B981);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

/* File Upload */
.file-upload-area {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 24px;
    text-align: center;
    transition: all 0.3s;
    cursor: pointer;
    background: #fafafa;
}

.file-upload-area:hover {
    border-color: var(--primary);
    background: #fffbeb;
}

.file-upload-area.dragover {
    border-color: var(--primary);
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
}

/* Info Card */
.info-card {
    background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
    border-left: 4px solid #3B82F6;
    border-radius: 12px;
    padding: 16px;
    display: flex;
    gap: 12px;
}

/* Select Wrapper */
.select-wrapper {
    position: relative;
}

.select-wrapper::after {
    content: '\f078';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #6b7280;
}

.select-wrapper select {
    appearance: none;
    padding-right: 40px;
}

/* Number Input */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}

/* Service Type Cards */
.service-card {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 16px;
    cursor: pointer;
    transition: all 0.3s;
    background: white;
}

.service-card:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
}

.service-card.selected {
    border-color: var(--primary);
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
}

/* Responsive */
@media (max-width: 768px) {
    .step-indicator {
        width: 36px;
        height: 36px;
        font-size: 12px;
    }

    .step-label {
        font-size: 10px;
    }

    .section-header {
        margin-bottom: 16px;
    }

    .btn {
        padding: 12px 20px;
        font-size: 13px;
    }
}

/* Loading Overlay */
.loading-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.loading-overlay.active {
    display: flex;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 4px solid #f3f4f6;
    border-top-color: var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<div class="min-h-screen py-6 sm:py-12">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header Card --}}
        <div class="header-card rounded-2xl sm:rounded-3xl p-6 sm:p-8 mb-6 sm:mb-8 text-white relative">
            <div class="header-pattern"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-yellow-400 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-calendar-check text-2xl text-gray-900"></i>
                    </div>
                    <div>
                        <h2 class="heading-font text-2xl sm:text-3xl font-extrabold">Booking Rental Mobil</h2>
                        <p class="text-gray-300 text-sm mt-1">Lengkapi data untuk menyelesaikan booking Anda</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Form Card --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden">

            {{-- Step Indicator --}}
            <div class="bg-gray-50 p-6 sm:p-8 border-b-2 border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex flex-col items-center flex-1">
                        <div class="step-indicator active w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-gray-200 text-gray-500">
                            <i class="fa-solid fa-car"></i>
                        </div>
                        <span class="step-label text-xs font-semibold text-gray-400">Mobil</span>
                    </div>

                    <div class="flex-1 h-1 bg-gray-200 mx-2 -mt-8">
                        <div class="step-line h-full bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-300" style="width: 0%"></div>
                    </div>

                    <div class="flex flex-col items-center flex-1">
                        <div class="step-indicator w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-gray-200 text-gray-500">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <span class="step-label text-xs font-semibold text-gray-400">Waktu</span>
                    </div>

                    <div class="flex-1 h-1 bg-gray-200 mx-2 -mt-8">
                        <div class="step-line h-full bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-300" style="width: 0%"></div>
                    </div>

                    <div class="flex flex-col items-center flex-1">
                        <div class="step-indicator w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-gray-200 text-gray-500">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <span class="step-label text-xs font-semibold text-gray-400">Jaminan</span>
                    </div>

                    <div class="flex-1 h-1 bg-gray-200 mx-2 -mt-8">
                        <div class="step-line h-full bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-300" style="width: 0%"></div>
                    </div>

                    <div class="flex flex-col items-center flex-1">
                        <div class="step-indicator w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-bold text-sm mb-2 bg-gray-200 text-gray-500">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <span class="step-label text-xs font-semibold text-gray-400">Pembayaran</span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data" id="bookingForm">
                @csrf

                <div class="p-6 sm:p-8">

                    {{-- STEP 1: Mobil & Layanan --}}
                    <div class="step active transition-all duration-300">
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fa-solid fa-car text-xl"></i>
                                </div>
                                <h4 class="heading-font text-xl font-bold text-gray-800">Pilih Mobil & Layanan</h4>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <label class="form-label">
                                        <i class="fa-solid fa-car mr-2 text-yellow-500"></i>Pilih Mobil
                                    </label>
                                    <div class="select-wrapper">
                                        <select name="car_id" id="carSelect" class="form-select" required>
                                            @foreach($cars as $car)
                                                <option value="{{ $car->id }}"
                                                    data-price="{{ $car->price_per_day ?? 300000 }}"
                                                    {{ $selectedCarId == $car->id ? 'selected' : '' }}>
                                                    {{ $car->name }} - {{ $car->brand }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label">
                                        <i class="fa-solid fa-briefcase mr-2 text-yellow-500"></i>Jenis Layanan
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <label class="service-card selected">
                                            <input type="radio" name="service_type" value="lepas_kunci" class="hidden service-radio" checked>
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                                    <i class="fa-solid fa-key text-xl text-yellow-600"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="font-bold text-sm">Lepas Kunci</p>
                                                    <p class="text-xs text-gray-500">Tanpa Sopir</p>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="service-card">
                                            <input type="radio" name="service_type" value="dengan_sopir" class="hidden service-radio">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <i class="fa-solid fa-user-tie text-xl text-blue-600"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="font-bold text-sm">Dengan Sopir</p>
                                                    <p class="text-xs text-gray-500">Include Driver</p>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="service-card">
                                            <input type="radio" name="service_type" value="carter" class="hidden service-radio">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <i class="fa-solid fa-van-shuttle text-xl text-green-600"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="font-bold text-sm">Carter</p>
                                                    <p class="text-xs text-gray-500">Full Service</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div id="driverSelectWrapper" class="hidden transition-all duration-300">
                                    <label class="form-label">
                                        <i class="fa-solid fa-user-check mr-2 text-yellow-500"></i>Pilih Sopir
                                    </label>
                                    <div class="select-wrapper">
                                        <select name="driver_id" id="driverSelect" class="form-select">
                                            <option value="">Pilih Sopir</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 2: Waktu & Tujuan --}}
                    <div class="step hidden transition-all duration-300">
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fa-solid fa-calendar-days text-xl"></i>
                                </div>
                                <h4 class="heading-font text-xl font-bold text-gray-800">Waktu & Tujuan</h4>
                            </div>

                            <div class="space-y-5">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label">
                                            <i class="fa-solid fa-clock mr-2 text-yellow-500"></i>Tanggal & Waktu Mulai
                                        </label>
                                        <input type="datetime-local" id="start" name="start_datetime" class="form-input" required>
                                    </div>

                                    <div>
                                        <label class="form-label">
                                            <i class="fa-solid fa-clock mr-2 text-yellow-500"></i>Tanggal & Waktu Selesai
                                        </label>
                                        <input type="datetime-local" id="end" name="end_datetime" class="form-input" required>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label">
                                        <i class="fa-solid fa-location-dot mr-2 text-yellow-500"></i>Tujuan
                                    </label>
                                    <input type="text" name="destination" class="form-input" placeholder="Contoh: Jakarta - Bandung">
                                </div>

                                <div class="price-summary">
                                    <div class="relative z-10">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-calendar-check text-2xl text-yellow-700"></i>
                                                <span class="font-bold text-gray-700">Durasi Rental</span>
                                            </div>
                                            <span class="text-3xl font-extrabold text-gray-900">
                                                <span id="duration">0</span> Hari
                                            </span>
                                        </div>

                                        <div class="border-t-2 border-yellow-600 pt-4 flex items-center justify-between">
                                            <span class="font-bold text-gray-700">Total Harga</span>
                                            <span class="heading-font text-4xl font-extrabold price-highlight">
                                                Rp <span id="totalPrice">0</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="total_price" id="totalPriceInput">
                            </div>
                        </div>
                    </div>

                    {{-- STEP 3: Jaminan --}}
                    <div class="step hidden transition-all duration-300">
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fa-solid fa-shield-halved text-xl"></i>
                                </div>
                                <h4 class="heading-font text-xl font-bold text-gray-800">Jaminan</h4>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <label class="form-label">
                                        <i class="fa-solid fa-id-card mr-2 text-yellow-500"></i>Tipe Jaminan
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <label class="service-card selected">
                                            <input type="radio" name="guarantee_type" value="ktp" class="hidden guarantee-radio" checked>
                                            <div class="text-center">
                                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                                    <i class="fa-solid fa-id-card text-2xl text-blue-600"></i>
                                                </div>
                                                <p class="font-bold text-sm">KTP</p>
                                            </div>
                                        </label>

                                        <label class="service-card">
                                            <input type="radio" name="guarantee_type" value="sim" class="hidden guarantee-radio">
                                            <div class="text-center">
                                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                                    <i class="fa-solid fa-address-card text-2xl text-green-600"></i>
                                                </div>
                                                <p class="font-bold text-sm">SIM</p>
                                            </div>
                                        </label>

                                        <label class="service-card">
                                            <input type="radio" name="guarantee_type" value="motor" class="hidden guarantee-radio">
                                            <div class="text-center">
                                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                                    <i class="fa-solid fa-motorcycle text-2xl text-orange-600"></i>
                                                </div>
                                                <p class="font-bold text-sm">BPKB Motor</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label">
                                        <i class="fa-solid fa-upload mr-2 text-yellow-500"></i>Upload Dokumen
                                    </label>
                                    <div class="file-upload-area" id="fileUploadArea">
                                        <input type="file" name="document_file" id="documentFile" class="hidden" required accept="image/*,application/pdf">
                                        <div id="fileUploadContent">
                                            <i class="fa-solid fa-cloud-arrow-up text-5xl text-gray-300 mb-3"></i>
                                            <p class="font-bold text-gray-700 mb-1">Klik atau Drag & Drop</p>
                                            <p class="text-sm text-gray-500">Format: JPG, PNG, atau PDF (Max: 2MB)</p>
                                        </div>
                                        <div id="filePreview" class="hidden">
                                            <i class="fa-solid fa-file-circle-check text-5xl text-green-500 mb-3"></i>
                                            <p class="font-bold text-gray-700" id="fileName"></p>
                                            <button type="button" class="text-sm text-red-500 hover:text-red-700 mt-2" onclick="removeFile()">
                                                <i class="fa-solid fa-trash mr-1"></i>Hapus File
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 4: Pembayaran --}}
                    <div class="step hidden transition-all duration-300">
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fa-solid fa-credit-card text-xl"></i>
                                </div>
                                <h4 class="heading-font text-xl font-bold text-gray-800">Pembayaran</h4>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <label class="form-label">
                                        <i class="fa-solid fa-money-bill-wave mr-2 text-yellow-500"></i>Jumlah DP (Minimal 30%)
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                                        <input type="number" name="amount" id="dpInput" class="form-input pl-14" placeholder="0" required>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        <i class="fa-solid fa-info-circle mr-1"></i>
                                        DP Minimal: <span id="minDp" class="font-bold text-gray-700">Rp 0</span>
                                    </p>
                                </div>

                                <div>
                                    <label class="form-label">
                                        <i class="fa-solid fa-wallet mr-2 text-yellow-500"></i>Metode Pembayaran
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <label class="service-card selected">
                                            <input type="radio" name="payment_method" value="cash" class="hidden payment-radio" checked>
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <i class="fa-solid fa-money-bill-wave text-2xl text-green-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-bold">Cash</p>
                                                    <p class="text-xs text-gray-500">Bayar Tunai</p>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="service-card">
                                            <input type="radio" name="payment_method" value="transfer" class="hidden payment-radio">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <i class="fa-solid fa-building-columns text-2xl text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-bold">Transfer</p>
                                                    <p class="text-xs text-gray-500">Bank Transfer</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="payment-summary">
                                    <div class="flex items-center mb-4">
                                        <i class="fa-solid fa-circle-check text-3xl text-green-600 mr-3"></i>
                                        <h5 class="heading-font text-xl font-bold text-gray-800">Ringkasan Pembayaran</h5>
                                    </div>

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center py-2">
                                            <span class="font-semibold text-gray-700">Total Harga:</span>
                                            <span class="text-2xl font-bold text-gray-900">Rp <span id="summaryTotal">0</span></span>
                                        </div>

                                        <div class="border-t-2 border-green-300 pt-3 flex justify-between items-center">
                                            <span class="font-semibold text-gray-700">DP Dibayar:</span>
                                            <span class="heading-font text-3xl font-extrabold text-green-600">
                                                Rp <span id="summaryDP">0</span>
                                            </span>
                                        </div>

                                        <div class="border-t-2 border-green-300 pt-3 flex justify-between items-center">
                                            <span class="font-semibold text-gray-700">Sisa Pembayaran:</span>
                                            <span class="text-xl font-bold text-gray-700">
                                                Rp <span id="remaining">0</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation Buttons --}}
                    <div class="flex justify-between items-center pt-6 mt-6 border-t-2 border-gray-100">
                        <button type="button" id="prevBtn" class="btn btn-secondary hidden">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali</span>
                        </button>

                        <button type="button" id="nextBtn" class="btn btn-primary ml-auto">
                            <span>Selanjutnya</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>

                        <button type="submit" id="submitBtn" class="btn btn-success ml-auto hidden">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Selesai Booking</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Info Card --}}
        <div class="info-card mt-6">
            <i class="fa-solid fa-info-circle text-2xl text-blue-600"></i>
            <div>
                <p class="font-bold text-blue-900 mb-1">Informasi Penting</p>
                <p class="text-sm text-blue-800">Pastikan semua data yang Anda masukkan sudah benar sebelum menyelesaikan booking. DP minimal 30% dari total harga.</p>
            </div>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div class="loading-overlay" id="loadingOverlay">
    <div class="text-center">
        <div class="spinner mb-4"></div>
        <p class="text-white font-bold">Memproses booking...</p>
    </div>
</div>

{{-- JavaScript --}}
<script>
let currentStep = 0;
const steps = document.querySelectorAll('.step');
const indicators = document.querySelectorAll('.step-indicator');
const labels = document.querySelectorAll('.step-label');
const lines = document.querySelectorAll('.step-line');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');

// Service Type Selection
document.querySelectorAll('.service-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.service-card').forEach(card => {
            card.classList.remove('selected');
        });
        this.closest('.service-card').classList.add('selected');

        const driverWrapper = document.getElementById('driverSelectWrapper');
        const isLepasKunci = this.value === 'lepas_kunci';
        driverWrapper.classList.toggle('hidden', isLepasKunci);
    });
});

// Guarantee Type Selection
document.querySelectorAll('.guarantee-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.guarantee-card, .service-card').forEach(card => {
            if (card.querySelector('.guarantee-radio')) {
                card.classList.remove('selected');
            }
        });
        this.closest('.service-card').classList.add('selected');
    });
});

// Payment Method Selection
document.querySelectorAll('.payment-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.payment-card, .service-card').forEach(card => {
            if (card.querySelector('.payment-radio')) {
                card.classList.remove('selected');
            }
        });
        this.closest('.service-card').classList.add('selected');
    });
});

// File Upload
const fileUploadArea = document.getElementById('fileUploadArea');
const documentFile = document.getElementById('documentFile');
const fileUploadContent = document.getElementById('fileUploadContent');
const filePreview = document.getElementById('filePreview');
const fileName = document.getElementById('fileName');

fileUploadArea.addEventListener('click', () => documentFile.click());

fileUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    fileUploadArea.classList.add('dragover');
});

fileUploadArea.addEventListener('dragleave', () => {
    fileUploadArea.classList.remove('dragover');
});

fileUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    fileUploadArea.classList.remove('dragover');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        documentFile.files = files;
        showFilePreview(files[0]);
    }
});

documentFile.addEventListener('change', function() {
    if (this.files.length > 0) {
        showFilePreview(this.files[0]);
    }
});

function showFilePreview(file) {
    fileName.textContent = file.name;
    fileUploadContent.classList.add('hidden');
    filePreview.classList.remove('hidden');
}

function removeFile() {
    documentFile.value = '';
    fileUploadContent.classList.remove('hidden');
    filePreview.classList.add('hidden');
}

// Step Navigation
function showStep(step) {
    steps.forEach((el, i) => {
        el.classList.toggle('hidden', i !== step);
    });

    indicators.forEach((el, i) => {
        el.classList.remove('active', 'completed');
        if (i < step) {
            el.classList.add('completed');
            el.innerHTML = '<i class="fa-solid fa-check"></i>';
        } else if (i === step) {
            el.classList.add('active');
            const icons = ['fa-car', 'fa-clock', 'fa-shield-halved', 'fa-credit-card'];
            el.innerHTML = `<i class="fa-solid ${icons[i]}"></i>`;
        } else {
            const icons = ['fa-car', 'fa-clock', 'fa-shield-halved', 'fa-credit-card'];
            el.innerHTML = `<i class="fa-solid ${icons[i]}"></i>`;
        }
    });

    labels.forEach((el, i) => {
        el.classList.remove('active', 'completed');
        if (i < step) {
            el.classList.add('completed');
        } else if (i === step) {
            el.classList.add('active');
        }
    });

    lines.forEach((line, i) => {
        line.style.width = i < step ? '100%' : '0%';
    });

    prevBtn.classList.toggle('hidden', step === 0);
    nextBtn.classList.toggle('hidden', step === steps.length - 1);
    submitBtn.classList.toggle('hidden', step !== steps.length - 1);

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

nextBtn.addEventListener('click', () => {
    if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
    }
});

prevBtn.addEventListener('click', () => {
    if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
    }
});

// Price Calculation
const start = document.getElementById('start');
const end = document.getElementById('end');
const carSelect = document.getElementById('carSelect');
const durationText = document.getElementById('duration');
const totalText = document.getElementById('totalPrice');
const totalInput = document.getElementById('totalPriceInput');
const dpInput = document.getElementById('dpInput');
const summaryTotal = document.getElementById('summaryTotal');
const summaryDP = document.getElementById('summaryDP');
const minDp = document.getElementById('minDp');
const remaining = document.getElementById('remaining');

function calculatePrice() {
    if (!start.value || !end.value) return;

    const startDate = new Date(start.value);
    const endDate = new Date(end.value);
    const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));

    if (days <= 0) {
        alert('Tanggal selesai harus setelah tanggal mulai');
        return;
    }

    const pricePerDay = carSelect.selectedOptions[0].dataset.price;
    const total = pricePerDay * days;
    const minDpAmount = Math.ceil(total * 0.3);

    durationText.textContent = days;
    totalText.textContent = total.toLocaleString('id-ID');
    totalInput.value = total;
    summaryTotal.textContent = total.toLocaleString('id-ID');
    dpInput.min = minDpAmount;
    minDp.textContent = 'Rp ' + minDpAmount.toLocaleString('id-ID');
}

start.addEventListener('change', calculatePrice);
end.addEventListener('change', calculatePrice);
carSelect.addEventListener('change', calculatePrice);

dpInput.addEventListener('input', function() {
    const dpAmount = Number(this.value) || 0;
    const total = Number(totalInput.value) || 0;
    const remainingAmount = total - dpAmount;

    summaryDP.textContent = dpAmount.toLocaleString('id-ID');
    remaining.textContent = remainingAmount.toLocaleString('id-ID');
});

// Form Submission
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.classList.add('active');
});

// Initialize
showStep(currentStep);
</script>

</x-app-layout>
