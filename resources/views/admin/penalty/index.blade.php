<x-admin-layout>
    <x-slot name="header">Manajemen Denda Booking</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar Denda</h1>
                <p class="text-gray-600 mt-1">Booking: {{ $booking->booking_code }}</p>
            </div>

            <a href="{{ route('admin.renter.show', $booking->id) }}"
               class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium text-gray-700 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border border-red-200">
            <p class="text-xs font-medium text-red-700 mb-1">Total Denda</p>
            <p class="text-3xl font-bold text-red-900">Rp {{ number_format($summary['total_amount'], 0, ',', '.') }}</p>
        </div>

        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
            <p class="text-xs font-medium text-orange-700 mb-1">Belum Dibayar</p>
            <p class="text-3xl font-bold text-orange-900">Rp {{ number_format($summary['unpaid_amount'], 0, ',', '.') }}</p>
            <p class="text-xs text-orange-600 mt-1">{{ $summary['unpaid_count'] }} denda</p>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
            <p class="text-xs font-medium text-green-700 mb-1">Sudah Dibayar</p>
            <p class="text-3xl font-bold text-green-900">Rp {{ number_format($summary['paid_amount'], 0, ',', '.') }}</p>
            <p class="text-xs text-green-600 mt-1">{{ $summary['paid_count'] }} denda</p>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
            <p class="text-xs font-medium text-blue-700 mb-1">Total Denda</p>
            <p class="text-3xl font-bold text-blue-900">{{ $summary['total_penalties'] }}</p>
            <p class="text-xs text-blue-600 mt-1">denda tercatat</p>
        </div>
    </div>

    <!-- Penalties Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Daftar Denda</h2>
        </div>

        @if($penalties->isEmpty())
        <div class="p-6 text-center text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p>Tidak ada denda untuk booking ini.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Denda</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($penalties as $penalty)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                {{ $penalty->type_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-900">{{ $penalty->description }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $penalty->created_at->format('d M Y H:i') }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm font-semibold text-gray-900">{{ $penalty->formatted_amount }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full {{ $penalty->status_badge }}">
                                {{ $penalty->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($penalty->status === 'unpaid')
                            <button type="button"
                                class="text-blue-600 hover:text-blue-900 font-medium text-sm"
                                onclick="openApprovalModal({{ $penalty->id }}, '{{ $penalty->type_label }}', '{{ $penalty->formatted_amount }}')">
                                Approve Pembayaran
                            </button>
                            @else
                            <span class="text-gray-500 text-sm">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Next Step Card -->
    @if($summary['unpaid_count'] === 0 && $summary['total_penalties'] > 0)
    <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-6">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <h3 class="font-semibold text-green-900">Semua Denda Lunas!</h3>
                <p class="text-sm text-green-700 mt-1">Anda dapat menyelesaikan booking ini.</p>
                <a href="{{ route('admin.booking.complete.form', $booking->id) }}"
                   class="inline-block mt-3 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                    Selesaikan Booking
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Approval Modal -->
    <div id="approvalModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">Approve Pembayaran Denda</h2>
            </div>

            <form id="approvalForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf

                <div>
                    <p class="text-sm text-gray-600">Tipe Denda</p>
                    <p id="penaltyTypeDisplay" class="text-lg font-semibold text-gray-900 mt-1"></p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Jumlah</p>
                    <p id="penaltyAmountDisplay" class="text-lg font-semibold text-gray-900 mt-1"></p>
                </div>

                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-900 mb-2">
                        Metode Pembayaran *
                    </label>
                    <select name="payment_method" id="payment_method"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                        required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cash">Tunai</option>
                        <option value="check">Cek</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="bank_id" class="block text-sm font-medium text-gray-900 mb-2">
                        Bank (jika transfer)
                    </label>
                    <select name="bank_id" id="bank_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        <option value="">-- Pilih Bank --</option>
                        {{-- Load from database --}}
                        @foreach(\App\Models\BankAccount::where('is_active', true)->get() as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->bank_name }} ({{ $bank->account_number }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="proof_image" class="block text-sm font-medium text-gray-900 mb-2">
                        Bukti Pembayaran
                    </label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition-colors">
                        <input type="file" name="proof_image" id="proof_image" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-center">
                            <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <p class="mt-1 text-xs text-gray-600">Upload bukti pembayaran</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeApprovalModal()"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Approve
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>

<script>
function openApprovalModal(penaltyId, penaltyType, penaltyAmount) {
    document.getElementById('penaltyTypeDisplay').textContent = penaltyType;
    document.getElementById('penaltyAmountDisplay').textContent = penaltyAmount;
    document.getElementById('approvalForm').action = `/admin/penalty/${penaltyId}/approve`;
    document.getElementById('approvalModal').classList.remove('hidden');
}

function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
}

document.getElementById('payment_method').addEventListener('change', function() {
    const bankField = document.getElementById('bank_id').parentElement;
    if (this.value === 'transfer') {
        bankField.style.display = 'block';
    } else {
        bankField.style.display = 'none';
    }
});
</script>
