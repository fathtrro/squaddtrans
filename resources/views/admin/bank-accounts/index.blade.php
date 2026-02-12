<x-admin-layout>
    <x-slot name="header">Kelola Rekening Bank</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <p class="text-gray-600">Tambah dan kelola rekening bank untuk penerimaan pembayaran sewa kendaraan.</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Action Bar -->
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.bank-accounts.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 shadow-sm font-medium transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Rekening
        </a>
    </div>

    @if ($bankAccounts->count())
        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">BANK</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">NO. REKENING</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">NAMA PEMILIK</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">STATUS</th>
                            <th class="px-6 py-4 text-center font-bold text-gray-700">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($bankAccounts as $account)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-900">{{ $account->bank_name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">{{ $account->account_number }}</code>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $account->account_holder_name }}</td>
                                <td class="px-6 py-4">
                                    @if ($account->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                            AKTIF
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                            NONAKTIF
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="{{ route('admin.bank-accounts.edit', $account) }}"
                                       class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-sm font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-7-4l7-7m0 0v5m0-5H10"></path>
                                        </svg>
                                    </a>
                                    <button onclick="deleteBook(event, '{{ route('admin.bank-accounts.destroy', $account) }}')"
                                            class="inline-flex items-center px-3 py-1 bg-red-50 text-red-700 hover:bg-red-100 rounded-lg text-sm font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($bankAccounts->hasPages())
            <div class="mt-6">
                {{ $bankAccounts->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <p class="text-gray-600 text-lg mb-4">Belum ada rekening bank yang ditambahkan</p>
            <a href="{{ route('admin.bank-accounts.create') }}" class="inline-block px-6 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 font-medium transition-all">
                Tambah Rekening Pertama
            </a>
        </div>
    @endif

    <script>
        function deleteBook(e, url) {
            e.preventDefault();
            if (confirm('Yakin hapus rekening bank ini?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-admin-layout>
