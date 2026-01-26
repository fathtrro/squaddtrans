<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hubungi Kami</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Optional: Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-2">Hubungi Kami</h1>
    <p class="text-gray-600 mb-8">
        Kami siap membantu kebutuhan Anda. Silakan hubungi kami kapan saja.
    </p>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Informasi Kontak --}}
        <div class="space-y-4">
            <div class="p-4 bg-white rounded shadow">
                <h3 class="font-semibold">📍 Alamat Kantor</h3>
                <p>123 Rental Drive, Pusat Kota<br>Los Angeles, CA 90012</p>
            </div>

            <div class="p-4 bg-white rounded shadow">
                <h3 class="font-semibold">📞 Nomor Telepon</h3>
                <p>+1 (555) 000-TRANS</p>
            </div>

            <div class="p-4 bg-white rounded shadow">
                <h3 class="font-semibold">📧 Email</h3>
                <p>contact@squadtrans.com</p>
            </div>
        </div>

        {{-- Form Kontak --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Kirim Pesan</h2>

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border rounded px-3 py-2">
                    @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded px-3 py-2">
                    @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Subjek</label>
                    <select name="subject" class="w-full border rounded px-3 py-2">
                        <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                        <option value="Pemesanan">Pemesanan</option>
                        <option value="Keluhan">Keluhan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Pesan</label>
                    <textarea name="message" rows="4"
                        class="w-full border rounded px-3 py-2">{{ old('message') }}</textarea>
                    @error('message') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
