@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen">

<!-- LEFT -->
<div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-12 bg-cover bg-center"
    style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.7)), url('https://lh3.googleusercontent.com/aida-public/AB6AXuBrmIBoNcHlvp-YcCCyBJccTuuj-LaOxEhGk7Lf4CfkhTlrDVbOBBKUcDboTG-mb2g1nkplV3RstQFloguFHwXohUeTVwtX5xn4IDLDhIib9SaA2onBW6rA2gzxie1bxGaoMKvfg8BxAqJTGdAgzRMstY6XxBIjdVjIrM_dVJhLzj3su-XsIaicXYKWOQ6vYUeHt_yVWWriFVR1ZAH2ibJCz6TBOqKxOaSYpJgtQW_ig276dOPlCbFUTlDQ4vm6M83axyL5NeL5OgM');">

    <h1 class="text-white text-2xl font-bold">Squad Trans</h1>

    <div>
        <h2 class="text-white text-4xl font-bold mb-4">
            Kenyamanan & Keamanan Prioritas Kami.
        </h2>
        <p class="text-white/90">
            Nikmati perjalanan premium dengan armada terbaik.
        </p>
    </div>
</div>

<!-- RIGHT -->
<div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
<div class="w-full max-w-[480px] flex flex-col gap-6">

<h2 class="text-3xl font-bold">Buat Akun Baru</h2>
<p class="text-gray-600">Lengkapi data diri Anda.</p>

<form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
@csrf

<input name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required class="form-input h-14">

<input name="email" value="{{ old('email') }}" type="email" placeholder="Email" required class="form-input h-14">

<input name="password" type="password" placeholder="Password" required class="form-input h-14">

<input name="password_confirmation" type="password" placeholder="Konfirmasi Password" required class="form-input h-14">

<button class="bg-primary text-white py-4 rounded-lg font-bold">
    Daftar Sekarang
</button>

</form>

<p class="text-center text-sm mt-4">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="text-primary font-bold">Masuk</a>
</p>

</div>
</div>

</div>
@endsection
