{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Hubungi Kami - SquadTrans')

@section('content')
<!-- Hero Section -->
<section class="bg-[#FAF7F0] py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
                    <p class="text-lg text-gray-600 max-w-2xl leading-relaxed">
                        Kami di sini untuk membantu kebutuhan penyewaan mobil Anda.<br>
                        Hubungi kami kapan saja untuk penawaran, pertanyaan, atau bantuan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map and Contact Section -->
<section class="bg-[#FAF7F0] pb-16">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Map Section -->
                <div class="order-1 lg:order-1">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden h-full">
                        <div class="relative h-[500px]">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3952.442036878846!2d111.4601346!3d-7.8487184!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799f11783f38e9%3A0xb1f12ec74cd3bcd2!2sSQUAD%20TRANSWISATA%20(RENTAL%20MOBIL%26CARTER)!5e0!3m2!1sid!2sid!4v1769496756672!5m2!1sid!2sid"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                            <!-- Map Overlay Card -->
                            <div class="absolute bottom-6 left-6 bg-white rounded-xl shadow-lg p-4 max-w-xs">
                                <h3 class="font-bold text-gray-900 mb-1">Kantor Pusat Kami</h3>
                                <p class="text-sm text-gray-600">123 Rental Drive, Pusat Kota, LA</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Cards -->
                <div class="order-2 lg:order-2 space-y-4">

                    <!-- Address Card -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FFF5E1] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500 mb-1">Alamat Kantor</h4>
                                <p class="text-gray-900 font-medium leading-relaxed">
                                    123 Rental Drive, Pusat Kota,<br>
                                    Los Angeles, CA 90012
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FFF5E1] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500 mb-1">Nomor Telepon</h4>
                                <a href="tel:+15550000TRANS" class="text-gray-900 font-medium hover:text-[#F5A623] transition-colors">
                                    +1 (555) 000-TRANS
                                </a>
                                <p class="text-sm text-gray-500 mt-1">Sen - Jum: 08.00 - 20.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FFF5E1] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500 mb-1">Alamat Email</h4>
                                <a href="mailto:contact@squadtrans.com" class="text-gray-900 font-medium hover:text-[#F5A623] transition-colors">
                                    contact@squadtrans.com
                                </a>
                                <p class="text-sm text-gray-500 mt-1">Balas dalam 24 jam</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Card -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FFF5E1] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500 mb-2">Ikuti Kami</h4>
                                <div class="flex flex-wrap gap-2">
                                    <a href="#" class="text-[#F5A623] hover:text-[#E09612] transition-colors font-medium">Instagram</a>
                                    <span class="text-gray-300">•</span>
                                    <a href="#" class="text-[#F5A623] hover:text-[#E09612] transition-colors font-medium">Facebook</a>
                                    <span class="text-gray-300">•</span>
                                    <a href="#" class="text-[#F5A623] hover:text-[#E09612] transition-colors font-medium">Twitter</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Kirim Pesan</h2>
                    <p class="text-gray-600">Isi formulir di bawah ini dan kami akan segera menghubungi Anda</p>
                </div>

                @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Input -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#F5A623] focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror"
                                   placeholder="Nama Anda"
                                   value="{{ old('name') }}">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Email
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#F5A623] focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror"
                                   placeholder="email@contoh.com"
                                   value="{{ old('email') }}">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Subject Select -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            Subjek
                        </label>
                        <div class="relative">
                            <select id="subject"
                                    name="subject"
                                    required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#F5A623] focus:border-transparent transition-all duration-200 appearance-none bg-white @error('subject') border-red-500 @enderror">
                                <option value="">Pertanyaan Umum</option>
                                <option value="reservasi" {{ old('subject') == 'reservasi' ? 'selected' : '' }}>Reservasi</option>
                                <option value="komplain" {{ old('subject') == 'komplain' ? 'selected' : '' }}>Komplain</option>
                                <option value="kerjasama" {{ old('subject') == 'kerjasama' ? 'selected' : '' }}>Kerjasama</option>
                                <option value="lainnya" {{ old('subject') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Textarea -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Pesan
                        </label>
                        <textarea id="message"
                                  name="message"
                                  rows="6"
                                  required
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#F5A623] focus:border-transparent transition-all duration-200 resize-none @error('message') border-red-500 @enderror"
                                  placeholder="Beritahu kami bagaimana kami bisa membantu...">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full bg-[#F5A623] hover:bg-[#E09612] text-white font-semibold py-3.5 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.01] shadow-md flex items-center justify-center">
                            <span>Kirim Pesan</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}
</style>

@endsection
