<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">
                Detail Booking
                <span class="text-gray-500 text-sm">
                    ({{ $booking->booking_code }})
                </span>
            </h2>

            <span class="px-4 py-1 border rounded-full text-sm font-semibold {{ $booking->status_badge }}">
                {{ $booking->status_label }}
            </span>
        </div>

        {{-- INFO UTAMA --}}
        <div class="grid md:grid-cols-2 gap-6">

            {{-- INFO BOOKING --}}
            <div class="bg-white rounded-xl shadow p-5 space-y-3">
                <h4 class="font-semibold mb-2">Informasi Booking</h4>

                <div><b>Mobil:</b> {{ $booking->car->name }}</div>
                <div><b>Layanan:</b> {{ $booking->service_type_label }}</div>

                @if($booking->driver)
                    <div><b>Sopir:</b> {{ $booking->driver->name }}</div>
                @endif

                <div><b>Tanggal Mulai:</b> {{ $booking->formatted_start_date }} {{ $booking->formatted_start_time }}</div>
                <div><b>Tanggal Selesai:</b> {{ $booking->formatted_end_date }} {{ $booking->formatted_end_time }}</div>

                <div><b>Durasi:</b> {{ $booking->duration_in_days }} hari</div>
                <div><b>Tujuan:</b> {{ $booking->destination ?? '-' }}</div>
            </div>

            {{-- INFO PEMBAYARAN --}}
            <div class="bg-white rounded-xl shadow p-5 space-y-3">
                <h4 class="font-semibold mb-2">Pembayaran</h4>

                <div><b>Total Harga:</b> {{ $booking->formatted_total_price }}</div>
                <div><b>DP:</b> {{ $booking->formatted_dp_amount }}</div>
                <div><b>Total Dibayar:</b> Rp {{ number_format($booking->total_paid, 0, ',', '.') }}</div>
                <div>
                    <b>Sisa:</b>
                    Rp {{ number_format($booking->remaining_payment, 0, ',', '.') }}
                </div>

                <div>
                    <b>Status:</b>
                    @if($booking->isFullyPaid())
                        <span class="text-green-600 font-semibold">Lunas</span>
                    @else
                        <span class="text-yellow-600 font-semibold">Belum Lunas</span>
                    @endif
                </div>
            </div>

        </div>

        {{-- JAMINAN --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h4 class="font-semibold mb-3">Jaminan</h4>

            @forelse($booking->guarantees as $g)
                <div class="flex justify-between border-b py-2 text-sm">
                    <div>{{ strtoupper($g->type) }}</div>
                    <div class="text-gray-600">{{ ucfirst($g->status) }}</div>
                </div>
            @empty
                <div class="text-gray-500 text-sm">Tidak ada jaminan</div>
            @endforelse
        </div>

        {{-- RIWAYAT PEMBAYARAN --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h4 class="font-semibold mb-3">Riwayat Pembayaran</h4>

            @forelse($booking->payments as $pay)
                <div class="flex justify-between border-b py-2 text-sm">
                    <div>
                        {{ strtoupper($pay->payment_type) }}
                        <span class="text-gray-500 text-xs">
                            ({{ $pay->payment_method ?? '-' }})
                        </span>
                    </div>
                    <div>Rp {{ number_format($pay->amount, 0, ',', '.') }}</div>
                    <div class="text-gray-500">
                        {{ $pay->paid_at ? \Carbon\Carbon::parse($pay->paid_at)->format('d M Y') : '-' }}
                    </div>
                </div>
            @empty
                <div class="text-gray-500 text-sm">Belum ada pembayaran</div>
            @endforelse
        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-3">

            @if($booking->canBeCancelled())
                <form method="POST" action="#">
                    @csrf
                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Batalkan Booking
                    </button>
                </form>
            @endif

            <a href="{{ route('bookings.index') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-black">
                Kembali
            </a>
        </div>

    </div>
</x-app-layout>
