<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        <h2 class="text-xl font-bold mb-6">Riwayat Booking</h2>

        @if($bookings->count())
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Mobil</th>
                        <th class="px-4 py-3 text-left">Layanan</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="px-4 py-3 font-semibold">
                            {{ $booking->booking_code }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $booking->car->name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ ucwords(str_replace('_',' ', $booking->service_type)) }}
                        </td>

                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($booking->start_datetime)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">
                            Rp {{ number_format($booking->total_price) }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-700
                                @elseif($booking->status == 'completed') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('bookings.show', $booking) }}"
                               class="px-3 py-1 bg-gray-900 text-white rounded text-xs hover:bg-black">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="bg-white p-8 rounded-xl shadow text-center text-gray-500">
            Belum ada booking 😕
        </div>
        @endif

    </div>
</x-app-layout>
