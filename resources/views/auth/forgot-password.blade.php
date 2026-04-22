@extends('layouts.guest')

@section('content')
<div class="h-screen w-full flex overflow-hidden">

    <!-- Left Side -->
    <div class="hidden lg:flex lg:w-1/2 relative">
        <div class="absolute inset-0 bg-cover bg-center"
            style='background-image: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.2)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAlNxLfHAMAZHtw-IIbkqPNZEiF1n46Ub4f7fBsBv0rRKtgKPN2bhr18EdWK3rDOx4VwezB4-N_FNAed6dXNrsp5rDGDgY3unUAF645nyTjwyG54hmj1VbAm2P5lBSN1QfiNLHzQlj2b5vhwWxFMbQzkeTM8HAzSQ7GM1i_67ph3CZZAq8M7GJjqX4DKP9ti-7xBvSLJFR2KdrNfcQE4AEN9uoeoIqeyH4srUPWSw8oMPnr2cDZS0U0rXiSkg1JHSEw2DAkxbnu4U0");'>
        </div>

        <div class="relative z-10 flex flex-col justify-end p-10 w-full h-full bg-black/20">
            <div class="max-w-md">
                <h1 class="text-white text-3xl font-bold mb-3">
                    Squad Trans - Solusi Perjalanan Anda
                </h1>
                <p class="text-white/90 text-base">
                    Nikmati kenyamanan berkendara dengan armada terbaik kami.
                </p>
            </div>
        </div>
    </div>

    <!-- Right Side -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-6">

        <div class="w-full max-w-md">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-primary rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-key text-white text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold">Lupa Password?</h2>
                <p class="text-[#9c7f49] text-sm mt-2">
                    Tidak masalah. Kami akan mengirimkan link reset password ke email Anda
                </p>
            </div>

            <!-- Success Alert -->
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <i class="bi bi-check-circle text-green-600 text-xl mt-0.5"></i>
                        <div>
                            <h3 class="text-green-800 font-semibold text-sm mb-1">Berhasil!</h3>
                            <p class="text-green-700 text-sm">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Error Alert -->
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <i class="bi bi-exclamation-circle text-red-600 text-xl mt-0.5"></i>
                        <div>
                            <h3 class="text-red-800 font-semibold text-sm mb-2">Terjadi Kesalahan</h3>
                            <ul class="text-red-700 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="font-medium text-sm">Alamat Email</label>
                    <input name="email"
                        value="{{ old('email') }}"
                        type="email"
                        class="w-full rounded-lg border h-12 px-4 mt-1 @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email terdaftar"
                        required
                        autofocus>
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg mt-6 transition-colors">
                    Kirim Link Reset Password
                </button>
            </form>

            <!-- Back to Login -->
            <div class="mt-6 text-center text-sm">
                <p class="text-[#9c7f49]">
                    Ingat password?
                    <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">
                        Kembali ke Login
                    </a>
                </p>
            </div>

            <!-- Info -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start gap-3">
                    <i class="bi bi-info-circle text-blue-600 text-lg mt-0.5"></i>
                    <div>
                        <p class="text-blue-800 text-sm">
                            <strong>Catatan:</strong> Cek folder Spam atau Promosi jika email tidak muncul di Inbox. Link reset password berlaku selama 60 menit.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
