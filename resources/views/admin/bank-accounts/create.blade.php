<x-admin-layout>
    <x-slot name="header">Tambah Rekening Bank</x-slot>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.bank-accounts.index') }}" class="text-gray-600 hover:text-yellow-600">
                        Rekening Bank
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-800 font-medium">Tambah Baru</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.bank-accounts.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Informasi Rekening Bank</h3>

            <div class="space-y-4">
                <!-- Bank Name -->
                <div>
                    <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Bank *
                    </label>
                    <select name="bank_name" id="bank_name"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('bank_name') border-red-500 @enderror"
                            required>
                        <option value="">— Pilih Bank —</option>
                        <option value="BCA" @selected(old('bank_name') === 'BCA')>BCA</option>
                        <option value="Mandiri" @selected(old('bank_name') === 'Mandiri')>Mandiri</option>
                        <option value="BRI" @selected(old('bank_name') === 'BRI')>BRI</option>
                        <option value="BNI" @selected(old('bank_name') === 'BNI')>BNI</option>
                    </select>
                    @error('bank_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Account Number -->
                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Rekening *
                    </label>
                    <input type="text" name="account_number" id="account_number"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('account_number') border-red-500 @enderror"
                           placeholder="Contoh: 1234567890" value="{{ old('account_number') }}" required>
                    @error('account_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Account Holder Name -->
                <div>
                    <label for="account_holder_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Pemilik Rekening *
                    </label>
                    <input type="text" name="account_holder_name" id="account_holder_name"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('account_holder_name') border-red-500 @enderror"
                           placeholder="Contoh: PT. SQUADTRANS" value="{{ old('account_holder_name') }}" required>
                    @error('account_holder_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3">
            <a href="{{ route('admin.bank-accounts.index') }}"
               class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                Batal
            </a>
            <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 shadow-sm font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Simpan Rekening
            </button>
        </div>
    </form>
</x-admin-layout>
