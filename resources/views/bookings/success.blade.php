<x-app-layout>
    <div class="min-h-[70vh] flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-6 text-center">

            {{-- ICON --}}
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            {{-- TITLE --}}
            <h2 class="text-xl font-bold mb-2">
                Booking Berhasil 🎉
            </h2>

            {{-- DESC --}}
            <p class="text-gray-600 mb-6">
                Terima kasih, booking rental mobil kamu sudah kami terima.
                Tim kami akan segera menghubungi kamu untuk konfirmasi.
            </p>

            {{-- INFO --}}
            @if(isset($booking))
            <div class="bg-gray-50 rounded-lg p-4 text-left text-sm mb-6">
                <p><span class="font-semibold">Kode Booking:</span> {{ $booking->code }}</p>
                <p><span class="font-semibold">Mobil:</span> {{ $booking->car->name }}</p>
                <p><span class="font-semibold">Layanan:</span> {{ ucwords(str_replace('_',' ', $booking->service_type)) }}</p>
                <p><span class="font-semibold">Total:</span> Rp {{ number_format($booking->total_price) }}</p>
            </div>
            @endif

            {{-- ACTION --}}
            <div class="flex flex-col gap-3">
                <a href="{{ route('bookings.index') }}"
                   class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold">
                    Lihat Riwayat Booking
                </a>

                <a href="{{ route('cars.index') }}"
                   class="w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg text-sm font-semibold">
                    Booking Mobil Lain
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
