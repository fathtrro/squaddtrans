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
                        <span class="material-symbols-outlined text-white text-3xl">directions_car</span>
                    </div>
                    <h2 class="text-2xl font-bold">Masuk ke Akun Anda</h2>
                    <p class="text-[#9c7f49] text-sm mt-1">
                        Selamat datang kembali di Squad Trans
                    </p>
                </div>

                <!-- Error Alert -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start gap-3">
                            <i class="bi bi-exclamation-circle text-red-600 text-xl mt-0.5"></i>
                            <div>
                                <h3 class="text-red-800 font-semibold text-sm mb-2">Login Gagal</h3>
                                <ul class="text-red-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="font-medium text-sm">Email</label>
                        <input name="email" value="{{ old('email') }}" class="w-full rounded-lg border h-12 px-4 mt-1"
                            placeholder="Masukkan email" required autofocus>
                    </div>

                    <!-- Password -->
                    <div>

                        <div class="relative">
                            <input name="password" type="password" id="loginPassword"
                                class="w-full rounded-lg border h-12 px-4 pr-10 mt-1" placeholder="Masukkan password"
                                required>
                            <button type="button"
                                class="absolute right-3 top-1/2 transform -translate-y-1.5 text-gray-500 hover:text-gray-700 togglePassword"
                                data-target="loginPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div><label>Harap password di simpan</label></div>
                    </div>

                    <!-- Button -->
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg mt-2">
                        Masuk
                    </button>
                </form>

                <!-- Register -->
                <div class="mt-6 text-center text-sm">
                    <p class="text-[#9c7f49]">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-primary font-bold">
                            Daftar
                        </a>
                    </p>
                </div>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelectorAll('.togglePassword').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    }
                });
            });
        });
    </script>
@endsection
