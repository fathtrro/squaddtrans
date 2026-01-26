<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 ">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('bookings.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-yellow-600 transition-colors">
                <span class="font-medium">Kembali ke Daftar Booking</span>
            </a>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 p-4 rounded-lg mb-6" role="alert">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <div>
                        <p class="font-bold text-green-800">Berhasil!</p>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Error Alert --}}
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 p-4 rounded-lg mb-6" role="alert">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-red-600">error</span>
                    <div>
                        <p class="font-bold text-red-800">Error!</p>
                        <p class="text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column - Details --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Booking Header --}}
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 px-6 py-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-yellow-100 text-sm mb-1">Booking ID</p>
                                <h1 class="text-2xl font-bold text-white">{{ $booking->booking_number }}</h1>
                                <p class="text-yellow-100 text-xs mt-1">{{ $booking->formatted_created_at }} WIB</p>
                            </div>
                            <div class="px-4 py-2 {{ $booking->status_badge }} rounded-lg font-semibold text-sm">
                                {{ $booking->status_label }}
                            </div>
                        </div>
                    </div>

                    {{-- Car Info --}}
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full md:w-40 h-32 flex-shrink-0">
                                <img src="{{ $booking->car->main_image }}"
                                     alt="{{ $booking->car->name }}"
                                     class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">
                                    {{ $booking->car->brand }} {{ $booking->car->name }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $booking->car->year }} • {{ $booking->car->category ?? 'SUV' }}</p>

                                <div class="flex flex-wrap gap-2">
                                    <div class="flex items-center gap-1 bg-gray-100 px-3 py-1 rounded-md text-sm">
                                        <span class="font-medium">{{ $booking->car->seats ?? 7 }} Kursi</span>
                                    </div>
                                    <div class="flex items-center gap-1 bg-gray-100 px-3 py-1 rounded-md text-sm">
                                        <span class="font-medium">{{ $booking->car->transmission ?? 'Auto' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1 bg-gray-100 px-3 py-1 rounded-md text-sm">
                                        <span class="font-medium">{{ $booking->car->fuel_type ?? 'Bensin' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Booking Details --}}
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">

                        Detail Pemesanan
                    </h2>

                    <div class="space-y-3">
                        {{-- Service Type --}}
                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600">Jenis Layanan</span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $booking->service_type_label }}</span>
                        </div>

                        {{-- Duration --}}
                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600">Durasi Rental</span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $booking->duration_in_days }} Hari</span>
                        </div>

                        {{-- Start Date --}}
                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600">Tanggal Mulai</span>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">{{ $booking->formatted_start_date }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->formatted_start_time }} WIB</p>
                            </div>
                        </div>

                        {{-- End Date --}}
                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600">Tanggal Selesai</span>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">{{ $booking->formatted_end_date }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->formatted_end_time }} WIB</p>
                            </div>
                        </div>

                        {{-- Destination --}}
                        @if($booking->destination)
                            <div class="flex items-start gap-2 py-3">
                                <div class="flex-1">
                                    <p class="text-gray-600 text-sm mb-1">Tujuan / Alamat Penjemputan</p>
                                    <p class="font-medium text-gray-900">{{ $booking->destination }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Driver Information --}}
                @if($booking->driver)
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-yellow-500">badge</span>
                            Informasi Sopir
                        </h2>

                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-white text-3xl">person</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-gray-900 text-lg">{{ $booking->driver->name }}</p>
                                <div class="flex items-center gap-2 text-gray-600 mt-1">
                                    <span class="material-symbols-outlined text-sm">phone</span>
                                    <span class="text-sm">{{ $booking->driver->phone }}</span>
                                </div>
                                @if(isset($booking->driver->license_number))
                                    <p class="text-sm text-gray-500 mt-1">SIM: {{ $booking->driver->license_number }}</p>
                                @endif
                            </div>
                            <a href="tel:{{ $booking->driver->phone }}"
                               class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">call</span>
                            </a>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Right Column - Payment & Actions --}}
            <div class="lg:col-span-1">
                <div class="space-y-6 lg:sticky lg:top-24">

                    {{-- Payment Summary --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-5 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                <span class="material-symbols-outlined">payments</span>
                                Pembayaran
                            </h3>
                        </div>

                        <div class="p-5 space-y-3">
                            {{-- Price Details --}}
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Harga per Hari</span>
                                    <span class="font-medium">Rp {{ number_format($booking->total_price / $booking->duration_in_days, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Durasi</span>
                                    <span class="font-medium">{{ $booking->duration_in_days }} Hari</span>
                                </div>
                                <div class="flex justify-between pt-2 border-t-2">
                                    <span class="text-gray-900 font-semibold">Total</span>
                                    <span class="text-lg font-bold text-gray-900">{{ $booking->formatted_total_price }}</span>
                                </div>
                            </div>

                            {{-- Payment Breakdown --}}
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-600">Down Payment (30%)</span>
                                    <span class="font-bold text-green-600">{{ $booking->formatted_dp_amount }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-600">Sisa Pembayaran</span>
                                    <span class="font-bold text-orange-600">{{ $booking->formatted_remaining_payment }}</span>
                                </div>
                            </div>

                            {{-- Payment Status --}}
                            @if($booking->status === 'pending')
                                <div class="bg-red-50 border border-red-200 p-3 rounded-lg">
                                    <div class="flex items-center gap-2">

                                        <p class="text-sm font-semibold text-red-800">Menunggu Pembayaran DP</p>
                                    </div>
                                </div>
                            @elseif($booking->status === 'confirmed')
                                <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-blue-600 text-xl">verified</span>
                                        <p class="text-sm font-semibold text-blue-800">DP Sudah Dibayar</p>
                                    </div>
                                </div>
                            @elseif($booking->status === 'running')
                                <div class="bg-green-50 border border-green-200 p-3 rounded-lg">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-green-600 text-xl">directions_car</span>
                                        <p class="text-sm font-semibold text-green-800">Sedang Berjalan</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="bg-white rounded-xl shadow-md p-5 space-y-3">
                        <h3 class="font-bold text-gray-900 mb-3">Aksi</h3>

                        @php
                            $isPending = $booking->status === 'pending';
                            $isConfirmed = $booking->status === 'confirmed';
                            $canCancel = in_array($booking->status, ['pending', 'confirmed']);
                        @endphp

                        {{-- Pay DP Button --}}
                        @if($isPending)
                            <button type="button"
                                    onclick="alert('Fitur pembayaran akan segera tersedia!\n\nBooking ID: {{ $booking->booking_number }}\nTotal DP: {{ $booking->formatted_dp_amount }}')"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">payment</span>
                                <span>Bayar DP Sekarang</span>
                            </button>
                        @endif

                        {{-- Payment Info Button --}}
                        @if($isConfirmed)
                            <button type="button"
                                    onclick="alert('Pembayaran sisa dilakukan saat pengambilan mobil.\n\nSisa: {{ $booking->formatted_remaining_payment }}')"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">info</span>
                                <span>Info Pembayaran Sisa</span>
                            </button>
                        @endif

                        {{-- Cancel Button --}}
                        @if($canCancel)
                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Yakin ingin membatalkan booking ini?\n\nBooking: {{ $booking->booking_number }}\nMobil: {{ $booking->car->brand }} {{ $booking->car->name }}\n\nPembatalan tidak dapat diurungkan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">cancel</span>
                                    <span>Batalkan Booking</span>
                                </button>
                            </form>
                        @endif

                        {{-- Status Info for Completed/Cancelled --}}
                        @if($booking->status === 'completed')
                            <div class="bg-green-50 border border-green-200 p-4 rounded-lg text-center">
                                <span class="material-symbols-outlined text-green-600 text-3xl">check_circle</span>
                                <p class="font-bold text-green-800 mt-2">Booking Selesai</p>
                                <p class="text-sm text-green-600 mt-1">Terima kasih!</p>
                            </div>
                        @endif

                        @if($booking->status === 'cancelled')
                            <div class="bg-gray-50 border border-gray-200 p-4 rounded-lg text-center">
                                <span class="material-symbols-outlined text-gray-600 text-3xl">cancel</span>
                                <p class="font-bold text-gray-800 mt-2">Booking Dibatalkan</p>
                            </div>
                        @endif

                        {{-- Other Actions --}}
                        <button type="button"
                                onclick="window.print()"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">print</span>
                            <span>Cetak Booking</span>
                        </button>

                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20SQUADTRANS,%20saya%20ingin%20bertanya%20tentang%20booking%20saya.%0A%0ABooking%20ID:%20{{ $booking->booking_number }}%0AMobil:%20{{ $booking->car->brand }}%20{{ $booking->car->name }}%0AStatus:%20{{ $booking->status_label }}"
                           target="_blank"
                           class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">chat</span>
                            <span>Hubungi CS</span>
                        </a>
                    </div>

                    {{-- Info Box --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <h4 class="font-bold text-blue-900 mb-3 flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-lg">info</span>
                            Informasi Penting
                        </h4>
                        <ul class="space-y-2 text-xs text-blue-800">
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>DP harus dibayar dalam 24 jam</span>
                            </li>
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>Sisa dibayar saat ambil mobil</span>
                            </li>
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>Bawa KTP & SIM asli</span>
                            </li>
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>Denda telat Rp 50.000/jam</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </main>

    {{-- Print Styles --}}
    <style>
        @media print {
            nav, footer, button, form {
                display: none !important;
            }
            .shadow-md {
                box-shadow: none !important;
            }
            .sticky {
                position: relative !important;
            }
        }
    </style>
</x-app-layout>
