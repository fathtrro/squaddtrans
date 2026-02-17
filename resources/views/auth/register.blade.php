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
<div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-12 bg-white overflow-y-auto">
<div class="w-full max-w-[480px] py-6">

<!-- Header -->
<div class="flex flex-col items-center mb-8">
    <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
        <span class="material-symbols-outlined text-white text-4xl">person_add</span>
    </div>
    <h2 class="text-[32px] font-bold text-center">Buat Akun Baru</h2>
    <p class="text-[#9c7f49] mt-2 text-center">Lengkapi data diri Anda untuk bergabung</p>
</div>

<!-- FORM -->
<form method="POST" action="{{ route('register') }}" class="space-y-4">
@csrf

<!-- Nama Lengkap -->
<div class="flex flex-col gap-2">
    <label class="font-medium">Nama Lengkap *</label>
    <input name="name" value="{{ old('name') }}"
        class="form-input w-full rounded-lg border h-12 px-4 @error('name') border-red-500 @enderror"
        placeholder="Masukkan nama lengkap"
        required>
    @error('name')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

<!-- Email -->
<div class="flex flex-col gap-2">
    <label class="font-medium">Email *</label>
    <input name="email" value="{{ old('email') }}" type="email"
        class="form-input w-full rounded-lg border h-12 px-4 @error('email') border-red-500 @enderror"
        placeholder="Masukkan email"
        required>
    @error('email')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

<!-- No Telepon -->
<div class="flex flex-col gap-2">
    <label class="font-medium">No. Telepon</label>
    <input name="phone" value="{{ old('phone') }}" type="tel"
        class="form-input w-full rounded-lg border h-12 px-4"
        placeholder="Masukkan nomor telepon">
</div>

<!-- Password -->
<div class="flex flex-col gap-2">
    <label class="font-medium">Password *</label>
    <input name="password" type="password"
        class="form-input w-full rounded-lg border h-12 px-4 @error('password') border-red-500 @enderror"
        placeholder="Masukkan password (minimal 8 karakter)"
        required>
    @error('password')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

<!-- Konfirmasi Password -->
<div class="flex flex-col gap-2">
    <label class="font-medium">Konfirmasi Password *</label>
    <input name="password_confirmation" type="password"
        class="form-input w-full rounded-lg border h-12 px-4 @error('password_confirmation') border-red-500 @enderror"
        placeholder="Masukkan ulang password"
        required>
    @error('password_confirmation')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

<!-- Button -->
<button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg mt-6 transition-colors">
    Daftar Sekarang
</button>

</form>

<!-- Login Link -->
<p class="text-center text-sm mt-6">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk di sini</a>
</p>

</div>
</div>

</div>
@endsection
