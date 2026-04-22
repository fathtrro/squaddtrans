@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-bug text-red-600 text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">🔧 Debug Mode - Password Reset</h1>
                    <p class="text-gray-600 text-sm">Development Only - Use untuk testing reset password</p>
                </div>
            </div>
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                <p class="text-yellow-800 text-sm">
                    <strong>⚠️ Warning:</strong> Halaman ini hanya untuk development. Akan otomatis hidden ketika APP_DEBUG=false di production.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Sidebar - User List -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">👥 Registered Users</h2>
                    <div class="space-y-2 max-h-96 overflow-y-auto">
                        @forelse($users as $user)
                            <button type="button"
                                    onclick="searchResetLink('{{ $user->email }}')"
                                    class="w-full text-left p-3 rounded-lg hover:bg-blue-50 transition-colors border border-gray-200 hover:border-blue-400">
                                <p class="font-semibold text-gray-900 text-sm">{{ $user->name }}</p>
                                <p class="text-gray-600 text-xs">{{ $user->email }}</p>
                            </button>
                        @empty
                            <p class="text-gray-500 text-sm">No users found</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Search Box -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">🔍 Find Reset Link</h2>
                    <div class="flex gap-2">
                        <input type="email"
                               id="searchEmail"
                               placeholder="Masukkan email user..."
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button onclick="searchResetLink()"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            Search
                        </button>
                    </div>
                </div>

                <!-- Result Box -->
                <div id="resultBox" class="hidden bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">✅ Reset Link Found</h2>

                    <div class="space-y-4">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <div id="resultEmail" class="px-4 py-2 bg-gray-100 rounded-lg text-gray-900 font-mono text-sm break-all"></div>
                        </div>

                        <!-- Token -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Token</label>
                            <div class="flex gap-2">
                                <div id="resultToken" class="flex-1 px-4 py-2 bg-gray-100 rounded-lg text-gray-900 font-mono text-sm break-all"></div>
                                <button onclick="copyToClipboard('resultToken')" class="px-3 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition-colors">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Reset Link -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Reset Password Link</label>
                            <div class="flex gap-2">
                                <input type="text"
                                       id="resultLink"
                                       readonly
                                       class="flex-1 px-4 py-2 bg-green-50 border border-green-300 rounded-lg text-gray-900 font-mono text-sm break-all">
                                <button onclick="copyToClipboard('resultLink')" class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                                <button onclick="openLink()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Created At -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Created At</label>
                            <div id="resultCreatedAt" class="px-4 py-2 bg-gray-100 rounded-lg text-gray-900 text-sm"></div>
                        </div>

                        <!-- Instructions -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-blue-900 text-sm font-semibold mb-2">📋 Instructions:</p>
                            <ol class="text-blue-800 text-sm space-y-1 list-decimal list-inside">
                                <li>Copy link di atas atau klik tombol "Open Link"</li>
                                <li>Buka di browser untuk reset password</li>
                                <li>Masukkan password baru dan submit</li>
                                <li>Login dengan password baru</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Error Box -->
                <div id="errorBox" class="hidden bg-red-50 border border-red-200 rounded-xl p-6">
                    <div class="flex gap-3">
                        <i class="bi bi-exclamation-circle text-red-600 text-2xl mt-1"></i>
                        <div>
                            <h3 class="font-semibold text-red-900 mb-2">❌ Error</h3>
                            <p id="errorMessage" class="text-red-800 text-sm"></p>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">📝 How to Test</h2>
                    <div class="space-y-3 text-gray-700 text-sm">
                        <div class="flex gap-3">
                            <span class="font-bold text-blue-600 min-w-fit">1. Request Reset:</span>
                            <span>Buka <code class="bg-gray-100 px-2 py-1 rounded text-xs">/forgot-password</code> dan masukkan email user</span>
                        </div>
                        <div class="flex gap-3">
                            <span class="font-bold text-blue-600 min-w-fit">2. Get Link:</span>
                            <span>Di halaman ini, search email untuk melihat reset link</span>
                        </div>
                        <div class="flex gap-3">
                            <span class="font-bold text-blue-600 min-w-fit">3. Reset Password:</span>
                            <span>Klik link untuk buka halaman reset password dan isi password baru</span>
                        </div>
                        <div class="flex gap-3">
                            <span class="font-bold text-blue-600 min-w-fit">4. Login:</span>
                            <span>Login dengan password baru di halaman login</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
    let currentLink = '';

    async function searchResetLink(email = null) {
        const searchEmail = email || document.getElementById('searchEmail').value.trim();

        if (!searchEmail) {
            showError('Silakan masukkan email');
            return;
        }

        try {
            const response = await fetch('{{ route("password.debug.get-link") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ email: searchEmail })
            });

            const data = await response.json();

            if (!response.ok) {
                showError(data.error || 'Tidak ada reset token untuk email ini. Silakan request reset password terlebih dahulu!');
                return;
            }

            // Show result
            document.getElementById('resultEmail').textContent = data.email;
            document.getElementById('resultToken').textContent = data.token;
            document.getElementById('resultLink').value = data.link;
            document.getElementById('resultCreatedAt').textContent = new Date(data.created_at).toLocaleString('id-ID');

            currentLink = data.link;

            document.getElementById('resultBox').classList.remove('hidden');
            document.getElementById('errorBox').classList.add('hidden');
            document.getElementById('searchEmail').value = searchEmail;

        } catch (error) {
            showError('Error: ' + error.message);
        }
    }

    function showError(message) {
        document.getElementById('errorMessage').textContent = message;
        document.getElementById('errorBox').classList.remove('hidden');
        document.getElementById('resultBox').classList.add('hidden');
    }

    function copyToClipboard(elementId) {
        const element = document.getElementById(elementId);
        const text = element.value || element.textContent;

        navigator.clipboard.writeText(text).then(() => {
            alert('✅ Copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy:', err);
        });
    }

    function openLink() {
        if (currentLink) {
            window.open(currentLink, '_blank');
        }
    }

    // Allow Enter key to search
    document.getElementById('searchEmail')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') searchResetLink();
    });
</script>
@endsection
