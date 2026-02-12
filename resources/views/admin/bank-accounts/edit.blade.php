<x-admin-layout>
    <x-slot name="header">Edit Rekening Bank</x-slot>

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
                        <span class="text-gray-800 font-medium">Edit</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.bank-accounts.update', $bankAccount) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

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
                        <option value="BCA" @selected(old('bank_name', $bankAccount->bank_name) === 'BCA')>BCA</option>
                        <option value="Mandiri" @selected(old('bank_name', $bankAccount->bank_name) === 'Mandiri')>Mandiri</option>
                        <option value="BRI" @selected(old('bank_name', $bankAccount->bank_name) === 'BRI')>BRI</option>
                        <option value="BNI" @selected(old('bank_name', $bankAccount->bank_name) === 'BNI')>BNI</option>
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
                           value="{{ old('account_number', $bankAccount->account_number) }}" required>
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
                           value="{{ old('account_holder_name', $bankAccount->account_holder_name) }}" required>
                    @error('account_holder_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div class="pt-4 border-t border-gray-100">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                               class="w-4 h-4 text-yellow-500 rounded focus:ring-yellow-500 border-gray-300"
                               @checked(old('is_active', $bankAccount->is_active))>
                        <span class="ml-3 text-sm font-medium text-gray-700">
                            Aktifkan rekening bank ini
                        </span>
                    </label>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</x-admin-layout>
