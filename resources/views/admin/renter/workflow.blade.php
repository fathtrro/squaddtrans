<x-admin-layout>
    <x-slot name="header">Workflow Booking - {{ $booking->booking_code }}</x-slot>

    <!-- Toast Notification -->
    @if ($message = session('success'))
        <div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-out z-50">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $message }}</span>
            </div>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('toast').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <style>
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateX(20px); }
            10% { opacity: 1; transform: translateX(0); }
            90% { opacity: 1; transform: translateX(0); }
            100% { opacity: 0; transform: translateX(20px); }
        }
        .animate-fade-in-out {
            animation: fadeInOut 3s ease-in-out;
        }
    </style>

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $booking->booking_code }}</h1>
                <p class="text-gray-600 mt-1">{{ $booking->user->name }} - {{ $booking->car->brand }} {{ $booking->car->name }}</p>
            </div>

            <a href="{{ route('admin.renter.index') }}"
               class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium text-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Booking Details -->
    <div class="mb-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- User Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Penyewa</p>
            <p class="text-sm font-semibold text-gray-900">{{ $booking->user->name }}</p>
            <p class="text-xs text-gray-600 mt-1">{{ $booking->user->email }}</p>
            <p class="text-xs text-gray-600">{{ $booking->user->phone ?? '-' }}</p>
        </div>

        <!-- Kendaraan Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Kendaraan</p>
            <p class="text-sm font-semibold text-gray-900">{{ $booking->car->name }}</p>
            <p class="text-xs text-gray-600 mt-1">{{ $booking->car->brand }} - {{ $booking->car->year }}</p>
            <p class="text-xs text-gray-600">{{ $booking->car->license_plate }}</p>
        </div>

        <!-- Tanggal -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Periode Rental</p>
            <p class="text-xs text-gray-900 font-semibold">{{ $booking->formatted_start_date }}</p>
            <p class="text-xs text-gray-600">hingga</p>
            <p class="text-xs text-gray-900 font-semibold">{{ $booking->formatted_end_date }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ (int) $booking->duration_in_days }} hari</p>
        </div>

        <!-- Harga -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Harga Total</p>
            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
            @if($booking->hasExtensions())
                <p class="text-xs text-gray-600 mt-2">
                    + Ekstension: Rp {{ number_format($booking->extensions_total, 0, ',', '.') }}
                </p>
            @endif
        </div>
    </div>

    <!-- WORKFLOW TIMELINE - HORIZONTAL -->
    <div class="mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-bold text-gray-900 mb-6">Progress Booking</h3>

            <div class="flex items-center justify-between">
                <!-- Step 1: Persetujuan -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full @if(in_array($booking->status, ['pending', 'confirmed', 'running', 'completed', 'waiting_penalty'])) bg-green-500 @else bg-gray-300 @endif flex items-center justify-center text-white font-bold text-sm relative z-10 shadow-lg mb-2">
                        1
                    </div>
                    <p class="text-xs font-semibold text-gray-900 text-center">Persetujuan</p>
                    <p class="text-xs text-gray-500 text-center">{{ $booking->status === 'pending' ? 'PENDING' : '✓ DONE' }}</p>
                </div>

                <!-- Connector 1 -->
                <div class="flex-1 h-1 @if(in_array($booking->status, ['confirmed', 'running', 'completed', 'waiting_penalty'])) bg-green-500 @else bg-gray-300 @endif mb-6"></div>

                <!-- Step 2: Check Sebelum -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full @if(in_array($booking->status, ['confirmed', 'running', 'completed', 'waiting_penalty'])) bg-green-500 @else bg-gray-300 @endif flex items-center justify-center text-white font-bold text-sm relative z-10 shadow-lg mb-2">
                        2
                    </div>
                    <p class="text-xs font-semibold text-gray-900 text-center">Check Sebelum</p>
                    <p class="text-xs text-gray-500 text-center">{{ $booking->hasBeforeChecklist() ? '✓ DONE' : 'PENDING' }}</p>
                </div>

                <!-- Connector 2 -->
                <div class="flex-1 h-1 @if(in_array($booking->status, ['running', 'completed', 'waiting_penalty'])) bg-green-500 @else bg-gray-300 @endif mb-6"></div>

                <!-- Step 3: Berlangsung -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full @if(in_array($booking->status, ['running', 'completed', 'waiting_penalty'])) bg-green-500 @else bg-gray-300 @endif flex items-center justify-center text-white font-bold text-sm relative z-10 shadow-lg mb-2">
                        3
                    </div>
                    <p class="text-xs font-semibold text-gray-900 text-center">Berlangsung</p>
                    <p class="text-xs text-gray-500 text-center">{{ in_array($booking->status, ['running', 'completed', 'waiting_penalty']) ? '✓ ACTIVE' : 'WAITING' }}</p>
                </div>

                <!-- Connector 3 -->
                <div class="flex-1 h-1 @if(in_array($booking->status, ['completed', 'waiting_penalty'])) bg-green-500 @else bg-gray-300 @endif mb-6"></div>

                <!-- Step 4: Check Sesudah -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full @if(in_array($booking->status, ['completed', 'waiting_penalty'])) bg-green-500 @elseif($booking->status === 'running') bg-yellow-500 @else bg-gray-300 @endif flex items-center justify-center text-white font-bold text-sm relative z-10 shadow-lg mb-2">
                        4
                    </div>
                    <p class="text-xs font-semibold text-gray-900 text-center">Check Sesudah</p>
                    <p class="text-xs text-gray-500 text-center">{{ $booking->hasAfterChecklist() ? '✓ DONE' : 'PENDING' }}</p>
                </div>

                <!-- Connector 4 -->
                <div class="flex-1 h-1 @if($booking->status === 'completed') bg-green-500 @else bg-gray-300 @endif mb-6"></div>

                <!-- Step 5: Selesai -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full @if($booking->status === 'completed') bg-green-500 @else bg-gray-300 @endif flex items-center justify-center text-white font-bold text-sm relative z-10 shadow-lg mb-2">
                        5
                    </div>
                    <p class="text-xs font-semibold text-gray-900 text-center">Selesai</p>
                    <p class="text-xs text-gray-500 text-center">{{ $booking->status === 'completed' ? '✓ DONE' : 'WAITING' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT AREA - Dynamic Based on Status -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- STEP 1: Approval Section -->
            @if($booking->status === 'pending')
            <div class="bg-white rounded-xl shadow-sm border-2 border-yellow-300 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-6">📋 Step 1: Persetujuan Pesanan</h2>

                <!-- Verification Checklist -->
                <div class="bg-yellow-50 rounded-lg p-4 mb-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Sebelum Approve, Periksa:</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <input type="checkbox" id="check-penyewa" class="mt-1 rounded">
                            <label for="check-penyewa" class="text-sm text-gray-700">Data penyewa sudah sesuai</label>
                        </li>
                        <li class="flex items-start gap-3">
                            <input type="checkbox" id="check-ktp" class="mt-1 rounded">
                            <label for="check-ktp" class="text-sm text-gray-700">KTP/Identitas verified</label>
                        </li>
                        <li class="flex items-start gap-3">
                            <input type="checkbox" id="check-mobil" class="mt-1 rounded">
                            <label for="check-mobil" class="text-sm text-gray-700">Mobil yang dipesan tersedia & cocok</label>
                        </li>
                        <li class="flex items-start gap-3">
                            <input type="checkbox" id="check-transfer" class="mt-1 rounded">
                            <label for="check-transfer" class="text-sm text-gray-700">Bukti transfer DP sudah diterima & benar</label>
                        </li>
                    </ul>
                </div>

                <!-- Penyewa Info Section -->
                <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                        Data Penyewa
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">NAMA LENGKAP</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $booking->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">EMAIL</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $booking->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">NO. TELEPON</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $booking->contact ?? '-' }}</p>
                        </div>

                        <div>
    <p class="text-xs text-gray-600 font-semibold">DOKUMEN IDENTITAS</p>

    @php
        $ktp = $booking->guarantees->where('type', 'ktp')->first();
        $sim = $booking->guarantees->where('type', 'sim')->first();
        $doc = $ktp ?? $sim;
    @endphp

    @if($doc)
        <img
            src="{{ asset('storage/' . $doc->document_file) }}"
            alt="Dokumen Identitas"
            class="mt-2 w-48 rounded-lg border shadow hover:scale-105 transition cursor-pointer"
            onclick="window.open(this.src,'_blank')"
        >
        <p class="text-xs text-gray-500 mt-1">
            Tipe: {{ strtoupper($doc->type) }}
        </p>
    @else
        <p class="text-sm font-semibold text-gray-900">-</p>
    @endif
</div>

                    </div>
                </div>

                <!-- Vehicle Info Section -->
                <div class="mb-6 p-4 bg-green-50 rounded-lg border border-green-200">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/><path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/></svg>
                        Data Kendaraan
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">NAMA KENDARAAN</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $booking->car->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">MEREK</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $booking->car->brand }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">TAHUN</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $booking->car->year }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 font-semibold">PLAT NOMOR</p>
                            <p class="text-sm font-bold text-green-700 bg-yellow-100 px-2 py-1 rounded">{{ $booking->car->plate_number }}</p>
                        </div>
                    </div>
                </div>

                <!-- DP Payment Proof Section -->
                @php
                    $dpPayment = $booking->payments()->where('payment_type', 'dp')->first();
                @endphp
                <div class="mb-6 p-4 @if($dpPayment) bg-purple-50 border border-purple-200 @else bg-red-50 border border-red-200 @endif rounded-lg">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 @if($dpPayment) text-purple-600 @else text-red-600 @endif" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/></svg>
                        Bukti Transfer DP
                    </h3>
                    @if($dpPayment)
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold">JUMLAH DP</p>
                                    <p class="text-sm font-bold text-purple-700">Rp {{ number_format($dpPayment->amount, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold">METODE PEMBAYARAN</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ ucfirst($dpPayment->payment_method) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold">STATUS</p>
                                    <p class="text-sm font-semibold">
                                        @if($dpPayment->status === 'approved')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">✓ Approved</span>
                                        @elseif($dpPayment->status === 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">⏳ Pending</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">✗ Rejected</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold">TANGGAL TRANSFER</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $dpPayment->paid_at ? $dpPayment->paid_at->format('d M Y H:i') : '-' }}</p>
                                </div>
                            </div>
                            @if($dpPayment->proof_image)
                                <div class="border-t pt-3 mt-3">
                                    <p class="text-xs text-gray-600 font-semibold mb-2">BUKTI TRANSFER</p>
<div
    class="relative group w-full max-w-xs cursor-pointer"
    onclick="openDocModal('{{ asset('storage/'.$dpPayment->proof_image) }}')"
>

    <img
        src="{{ asset('storage/'.$dpPayment->proof_image) }}"
        alt="Bukti Transfer"
        class="w-full rounded-xl border border-purple-200 shadow object-cover"
    >

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded-xl">
        <span class="text-white text-xs font-semibold bg-black/60 px-3 py-1 rounded-lg">
            Klik untuk Perbesar
        </span>
    </div>

</div>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-sm text-red-700 font-semibold">⚠️ Belum ada pembayaran DP</p>
                    @endif
                </div>

                <!-- Approval Button -->
                <div class="bg-yellow-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700 mb-4">Setelah semua data terverifikasi, silakan klik tombol di bawah untuk approve pesanan.</p>
                    <form method="POST" action="{{ route('admin.renter.update', $booking->id) }}" class="flex gap-3">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Setujui Pesanan
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- STEP 2: Before Checklist -->
            @if(in_array($booking->status, ['confirmed', 'running', 'completed', 'waiting_penalty']))
            <div class="bg-white rounded-xl shadow-sm border-2 @if($booking->hasBeforeChecklist()) border-green-300 @else border-blue-300 @endif p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">✅ Step 2: Check Kendaraan Sebelum Perjalanan</h2>

                @if($booking->hasBeforeChecklist())
                    @php $beforeCheck = $booking->checklists()->where('checklist_type', 'before')->first(); @endphp
                    <div class="space-y-3">
                        <div class="bg-green-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-green-700 mb-2">✓ SUDAH DICEK</p>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-xs text-gray-600">Kondisi Bodi</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $beforeCheck->body_condition }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Kondisi Interior</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $beforeCheck->interior_condition }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Level BBM</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $beforeCheck->fuel_level }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Aksesori</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $beforeCheck->accessories }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-blue-700 mb-4">Silakan lakukan pengecekan kondisi kendaraan sebelum penyewaan dimulai</p>
                        <a href="{{ route('admin.booking.checklist.before', $booking->id) }}"
                           class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Mulai Check Sebelum
                        </a>
                    </div>
                @endif
            </div>
            @endif

            <!-- STEP 3: Running Status -->
            @if(in_array($booking->status, ['running', 'completed', 'waiting_penalty']))
            <div class="bg-white rounded-xl shadow-sm border-2 border-green-300 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">🚗 Step 3: Kendaraan Sedang Digunakan</h2>
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-700 font-semibold">Tanggal Mulai: {{ $booking->formatted_start_date }}</p>
                            <p class="text-sm text-green-700 font-semibold">Tanggal Akhir: {{ $booking->formatted_end_date }}</p>
                        </div>
                        @if($booking->status === 'running')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-200 text-green-800">
                            🔄 BERLANGSUNG
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-800">
                            SELESAI
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- STEP 4: After Checklist & Penalties -->
            @if(in_array($booking->status, ['running', 'completed', 'waiting_penalty']))
            <div class="bg-white rounded-xl shadow-sm border-2 @if($booking->hasAfterChecklist()) border-green-300 @else border-purple-300 @endif p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">📸 Step 4: Check Kendaraan Setelah Perjalanan</h2>

                @if($booking->hasAfterChecklist())
                    @php $afterCheck = $booking->checklists()->where('checklist_type', 'after')->first(); @endphp
                    <div class="space-y-4">
                        <div class="bg-green-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-green-700 mb-2">✓ SUDAH DICEK</p>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-xs text-gray-600">Kondisi Bodi</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $afterCheck->body_condition }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Kondisi Interior</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $afterCheck->interior_condition }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Level BBM</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $afterCheck->fuel_level }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Aksesori</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $afterCheck->accessories }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Penalties Found -->
                        @if($booking->penalties->count() > 0)
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-sm font-semibold text-red-900 mb-3">⚠️ Denda Ditemukan ({{ $booking->penalties->count() }} item)</p>
                            <div class="space-y-2">
                                @foreach($booking->penalties as $penalty)
                                <div class="flex justify-between items-center bg-white rounded p-2">
                                    <div>
                                        <p class="text-xs font-semibold text-gray-900">{{ ucfirst(str_replace('_', ' ', $penalty->type)) }}</p>
                                        <p class="text-xs text-gray-600">{{ $penalty->description ?? 'Severity: ' . ucfirst($penalty->severity_level) }}</p>
                                    </div>
                                    <p class="text-sm font-bold text-red-600">Rp {{ number_format($penalty->amount, 0, ',', '.') }}</p>
                                </div>
                                @endforeach
                            </div>
                            <a href="{{ route('admin.booking.penalties', $booking->id) }}"
                               class="inline-flex items-center mt-3 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded">
                                Kelola Denda
                            </a>
                        </div>
                        @else
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                            <p class="text-sm font-semibold text-green-900">✓ Tidak Ada Denda - Kendaraan Dalam Kondisi Baik</p>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="bg-purple-50 rounded-lg p-4 text-center">
                        @if($booking->status === 'running')
                        <p class="text-sm text-purple-700 mb-4">✓ Kendaraan sudah siap untuk pengecekan akhir</p>
                        <p class="text-xs text-gray-600 mb-4">Tanggal pengembalian: {{ $booking->formatted_end_date }}</p>
                        @else
                        <p class="text-sm text-purple-700 mb-4">Silakan lakukan pengecekan kondisi kendaraan setelah pengembalian</p>
                        @endif
                        <a href="{{ route('admin.booking.return.form', $booking->id) }}"
                           class="inline-flex items-center px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Isi Check Pengembalian
                        </a>
                    </div>
                @endif
            </div>
            @endif

            <!-- STEP 5: Completion -->
            @if(in_array($booking->status, ['waiting_penalty', 'completed']))
            <div class="bg-white rounded-xl shadow-sm border-2 @if($booking->status === 'completed') border-green-300 @else border-yellow-300 @endif p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">🎉 Step 5: Finalisasi Booking</h2>

                @if($booking->status === 'completed')
                    <div class="bg-green-50 rounded-lg p-4 text-center">
                        <svg class="w-12 h-12 text-green-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-lg font-bold text-green-900">Booking Selesai!</p>
                        <p class="text-sm text-green-700 mt-1">Semua pembayaran telah diselesaikan</p>
                    </div>
                @else
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <p class="text-sm text-yellow-900 font-semibold mb-3">⏳ Menunggu Pembayaran Denda</p>
                        @if($booking->getTotalUnpaidPenalties() > 0)
                            <p class="text-xs text-gray-600 mb-3">Total denda yang belum dibayar:</p>
                            <p class="text-2xl font-bold text-red-600 mb-4">Rp {{ number_format($booking->getTotalUnpaidPenalties(), 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-600 mb-3">Setelah semua denda dibayar, booking dapat diselesaikan.</p>
                        @else
                            <p class="text-green-700 font-semibold mb-3">✓ Semua denda sudah dibayar!</p>
                            <a href="{{ route('admin.booking.complete.form', $booking->id) }}"
                               class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Selesaikan Booking
                            </a>
                        @endif
                    </div>
                @endif
            </div>
            @endif

        </div>

        <!-- Right Sidebar - Price Breakdown -->
        <div class="space-y-6">
            <!-- Booking Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">📋 Detail Pemesanan</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Cek-in</span>
                        <span class="font-semibold">{{ $booking->formatted_start_date }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Cek-out</span>
                        <span class="font-semibold">{{ $booking->formatted_end_date }}</span>
                    </div>
                    <div class="border-t pt-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-semibold">{{ (int) $booking->duration_in_days }} hari</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Price Breakdown -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">💰 Rincian Harga</h3>
                <div class="space-y-3 text-sm">
                    <!-- Base Price -->
                    <div class="flex justify-between pb-3 border-b">
                        <span class="text-gray-600">Harga Dasar</span>
                        <span class="font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>

                    <!-- Extensions -->
                    @php
                        $extensionCost = 0;
                        if ($booking->extensions()->where('status', 'approved')->exists()) {
                            $extensionCost = $booking->extensions()->where('status', 'approved')->sum('additional_price');
                        }
                    @endphp
                    @if($extensionCost > 0)
                        <div class="flex justify-between pb-3 border-b text-blue-600">
                            <span>Biaya Perpanjangan</span>
                            <span class="font-semibold">+ Rp {{ number_format($extensionCost, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <!-- Approved Penalties -->
                    @php $paidPenalties = $booking->penalties()->where('status', 'approved')->sum('amount'); @endphp
                    @if($paidPenalties > 0)
                    <div class="flex justify-between pb-3 border-b text-red-600">
                        <span>Denda (Sudah Disetujui)</span>
                        <span class="font-semibold">+ Rp {{ number_format($paidPenalties, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <!-- Unpaid Penalties -->
                    @php $unpaidPenalties = $booking->getTotalUnpaidPenalties(); @endphp
                    @if($unpaidPenalties > 0)
                    <div class="flex justify-between pb-3 border-b text-orange-600">
                        <span>Denda (Menunggu)</span>
                        <span class="font-semibold">+ Rp {{ number_format($unpaidPenalties, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <!-- Down Payment -->
                    <div class="flex justify-between pb-3 border-b text-green-600">
                        <span>Sudah Dibayar (DP)</span>
                        <span class="font-semibold">- Rp {{ number_format($booking->dp_amount, 0, ',', '.') }}</span>
                    </div>

                    <!-- Total -->
                    @php
                        $totalAmount = $booking->total_price + $extensionCost + $paidPenalties + $unpaidPenalties - $booking->dp_amount;
                    @endphp
                    <div class="flex justify-between pt-3 text-lg font-bold">
                        <span>Total Tagihan</span>
                        <span class="@if($totalAmount > 0) text-red-600 @else text-green-600 @endif">
                            @if($totalAmount > 0)
                                + Rp {{ number_format($totalAmount, 0, ',', '.') }}
                            @else
                                Rp {{ number_format(abs($totalAmount), 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">📊 Status Saat Ini</h3>
                <div class="flex items-center gap-3">
                    @if($booking->status === 'pending')
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">PENDING</p>
                            <p class="text-xs text-gray-600">Menunggu persetujuan</p>
                        </div>
                    @elseif($booking->status === 'confirmed')
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">DIKONFIRMASI</p>
                            <p class="text-xs text-gray-600">Menunggu pemeriksaan awal</p>
                        </div>
                    @elseif($booking->status === 'running')
                        <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">BERLANGSUNG</p>
                            <p class="text-xs text-gray-600">Kendaraan sedang digunakan penyewa</p>
                        </div>
                    @elseif($booking->status === 'waiting_penalty')
                        <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">MENUNGGU PEMBAYARAN</p>
                            <p class="text-xs text-gray-600">Menunggu pembayaran denda</p>
                        </div>
                    @elseif($booking->status === 'completed')
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">SELESAI</p>
                            <p class="text-xs text-gray-600">Booking telah selesai</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
