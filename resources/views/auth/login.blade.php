@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen w-full">

<!-- Left Side -->
<div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center"
        style='background-image: linear-gradient(to right, rgba(0,0,0,0.4), rgba(0,0,0,0.1)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAlNxLfHAMAZHtw-IIbkqPNZEiF1n46Ub4f7fBsBv0rRKtgKPN2bhr18EdWK3rDOx4VwezB4-N_FNAed6dXNrsp5rDGDgY3unUAF645nyTjwyG54hmj1VbAm2P5lBSN1QfiNLHzQlj2b5vhwWxFMbQzkeTM8HAzSQ7GM1i_67ph3CZZAq8M7GJjqX4DKP9ti-7xBvSLJFR2KdrNfcQE4AEN9uoeoIqeyH4srUPWSw8oMPnr2cDZS0U0rXiSkg1JHSEw2DAkxbnu4U0");'>
    </div>

    <div class="relative z-10 flex flex-col justify-end p-12 w-full h-full bg-black/20">
        <div class="max-w-md">
            <h1 class="text-white text-4xl font-bold mb-4">
                Squad Trans - Solusi Perjalanan Anda
            </h1>
            <p class="text-white/90 text-lg">
                Nikmati kenyamanan berkendara dengan armada terbaik kami.
            </p>
        </div>
    </div>
</div>

<!-- Right Side -->
<div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-12 bg-white">
<div class="w-full max-w-[480px]">

<!-- Header -->
<div class="flex flex-col items-center mb-10">
    <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
        <span class="material-symbols-outlined text-white text-4xl">directions_car</span>
    </div>
    <h2 class="text-[32px] font-bold text-center">Masuk ke Akun Anda</h2>
    <p class="text-[#9c7f49] mt-2 text-center">Selamat datang kembali di Squad Trans</p>
</div>

<!-- FORM -->
<form method="POST" action="{{ route('login') }}" class="space-y-5">
@csrf

<!-- Email -->
<div class="flex flex-col gap-2">
    <label class="font-medium">Email</label>
    <input name="email" value="{{ old('email') }}"
        class="form-input w-full rounded-lg border h-14 px-4"
        placeholder="Masukkan email"
        required autofocus>

    @error('email')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

<!-- Password -->
<div class="flex flex-col gap-2">
    <div class="flex justify-between">
        <label class="font-medium">Password</label>
        <a href="{{ route('password.request') }}" class="text-primary text-sm font-semibold">
            Lupa Password?
        </a>
    </div>

    <input name="password" type="password"
        class="form-input w-full rounded-lg border h-14 px-4"
        placeholder="Masukkan password"
        required>

    @error('password')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

<!-- Button -->
<button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg">
    Masuk
</button>


</form>

<!-- Register -->
<div class="mt-10 text-center">
    <p class="text-[#9c7f49]">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-primary font-bold">Daftar Sekarang</a>
    </p>
</div>

</div>
</div>

</div>
@endsection
