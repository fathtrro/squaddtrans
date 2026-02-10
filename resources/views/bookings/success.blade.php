<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#FBFAF7] px-4 py-10">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8 text-center">

            {{-- ICON --}}
            <div class="flex justify-center mb-5">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-300 to-yellow-500
                            flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            {{-- TITLE --}}
            <h2 class="text-2xl font-extrabold text-gray-800">
                Booking Berhasil!
            </h2>
            <p class="text-xs text-gray-400 mt-1 mb-6">
                ID : <span class="font-semibold text-gray-600">{{ $booking->booking_code }}</span>
            </p>

            {{-- INFO CARD --}}
            <div class="bg-[#FFFCF6] rounded-2xl p-5 mb-6 border border-yellow-100 text-left">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase">Kendaraan</p>
                        <p class="font-semibold text-gray-800">{{ $booking->car->name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase">Layanan</p>
                        <p class="font-semibold text-gray-800">
                            {{ ucwords(str_replace('_',' ', $booking->service_type)) }}
                        </p>
                    </div>
                </div>

                <div class="text-center border-t border-dashed border-yellow-200 pt-4">
                    <p class="text-[10px] text-gray-400 uppercase">Total Bayar</p>
                    <p class="text-xl font-extrabold text-yellow-600">
                        Rp {{ number_format($booking->total_price,0,',','.') }}
                    </p>
                    <span class="inline-block mt-1 px-3 py-1 text-[10px]
                                 font-bold rounded-full bg-green-100 text-green-700">
                        LUNAS
                    </span>
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="text-sm text-gray-600 space-y-3 mb-8">
                <div class="flex justify-between">
                    <span>Tanggal Sewa</span>
                    <span class="font-medium text-gray-800">
                        {{ $booking->start_datetime->format('d M Y') }}
                        -
                        {{ $booking->end_datetime->format('d M Y') }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span>Metode Pembayaran</span>
                    <span class="font-medium text-gray-800">
                        {{ ucfirst($booking->payments->first()->payment_method ?? '-') }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span>Nama Penyewa</span>
                    <span class="font-medium text-gray-800">
                        {{ $booking->user->name }}
                    </span>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="space-y-3">
                <a href="{{ route('bookings.index') }}"
                   class="w-full py-3 block rounded-xl
                          bg-gradient-to-r from-yellow-400 to-yellow-500
                          text-white font-bold shadow-md">
                    Lihat Riwayat Booking
                </a>

                <a href="{{ route('cars.index') }}"
                   class="w-full py-3 block rounded-xl border border-gray-300
                          text-gray-700 font-semibold hover:bg-gray-50">
                    Booking Mobil Lain
                </a>
            </div>

            {{-- FOOTER --}}
            <div class="mt-6 text-xs text-gray-400">
                Need help?
                <a href="https://wa.me/62xxxxxxxxxx" class="text-green-600 font-semibold">
                    Contact via WhatsApp
                </a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Push an extra history state so pressing back triggers popstate
            try {
                history.pushState(null, '', location.href);
                history.pushState(null, '', location.href);
            } catch (e) {
                // ignore
            }

            window.addEventListener('popstate', function (event) {
                // Redirect user to cars index when they try to go back from this success page
                window.location.href = "{{ route('cars.index') }}";
            });

            // Handle page show from bfcache (back-forward cache)
            window.onpageshow = function (event) {
                if (event.persisted) {
                    window.location.replace("{{ route('cars.index') }}");
                }
            };
        });
    </script>

</x-app-layout>
