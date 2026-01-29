{{-- resources/views/contact.blade.php --}}

<x-app-layout>
    <x-slot name="title">
        Hubungi Kami - SquadTrans
    </x-slot>

    <!-- Hero Section with Gradient -->
    <section class="relative bg-gradient-to-br from-[#FAF7F0] via-[#FFF8E7] to-[#FAF7F0] py-20 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#F5A623] opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#F5A623] opacity-5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-6xl mx-auto text-center">
                <div class="inline-flex items-center bg-white px-4 py-2 rounded-full shadow-sm mb-6 animate-slide-down">
                    <svg class="w-5 h-5 text-[#F5A623] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Siap Membantu Anda 24/7</span>
                </div>

                <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 animate-fade-in-up">
                    Mari Terhubung <span class="text-[#F5A623]">Bersama</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed animate-fade-in-up-delay">
                    Tim profesional kami siap memberikan solusi terbaik untuk kebutuhan penyewaan mobil Anda.
                    Hubungi kami kapan saja untuk konsultasi gratis.
                </p>
            </div>
        </div>
    </section>

    <!-- Quick Contact Cards -->
    <section class="bg-white py-8 -mt-10 relative z-20">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Phone Card -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#F5A623] to-[#E09612] rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">
                                    Telepon
                                </h4>
                                <a href="tel:+15550000TRANS" class="text-lg font-bold text-gray-900 hover:text-[#F5A623] transition-colors block mb-1">
                                    +1 (555) 000-TRANS
                                </a>
                                <p class="text-sm text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Sen - Jum: 08.00 - 20.00
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#F5A623] to-[#E09612] rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">
                                    Email
                                </h4>
                                <a href="mailto:contact@squadtrans.com" class="text-lg font-bold text-gray-900 hover:text-[#F5A623] transition-colors block mb-1">
                                    contact@squadtrans.com
                                </a>
                                <p class="text-sm text-gray-600">
                                    Respon dalam 24 jam
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#F5A623] to-[#E09612] rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">
                                    Lokasi
                                </h4>
                                <p class="text-lg font-bold text-gray-900 mb-1">
                                    123 Rental Drive
                                </p>
                                <p class="text-sm text-gray-600">
                                    Pusat Kota, LA 90012
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Map and Form Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

                    <!-- Contact Form -->
                    <div class="lg:col-span-3 order-2 lg:order-1">
                        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-xl p-8 lg:p-10 border border-gray-100">

                            <div class="mb-8">
                                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-3">
                                    Kirim Pesan Kepada Kami
                                </h2>
                                <p class="text-gray-600 text-lg">
                                    Isi formulir di bawah dan tim kami akan menghubungi Anda segera
                                </p>
                            </div>

                            @if (session('success'))
                                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 rounded-xl animate-fade-in shadow-sm">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-green-800 font-medium">{{ session('success') }}</span>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Nama Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="name" value="{{ old('name') }}" required
                                                   class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623] focus:ring-opacity-20 transition-all duration-300 outline-none"
                                                   placeholder="John Doe">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="email" name="email" value="{{ old('email') }}" required
                                                   class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623] focus:ring-opacity-20 transition-all duration-300 outline-none"
                                                   placeholder="john@example.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Subjek <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="subject" required
                                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623] focus:ring-opacity-20 transition-all duration-300 outline-none appearance-none bg-white">
                                            <option value="">Pilih Subjek</option>
                                            <option value="reservasi">📅 Reservasi Mobil</option>
                                            <option value="komplain">⚠️ Komplain / Keluhan</option>
                                            <option value="kerjasama">🤝 Kerjasama Bisnis</option>
                                            <option value="lainnya">💬 Pertanyaan Lainnya</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Pesan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="message" rows="6" required
                                              class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623] focus:ring-opacity-20 transition-all duration-300 outline-none resize-none"
                                              placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                                </div>

                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-[#F5A623] to-[#E09612] hover:from-[#E09612] hover:to-[#D08502] text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center group">
                                    <span>Kirim Pesan</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="lg:col-span-2 order-1 lg:order-2">
                        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 h-full sticky top-24">
                            <div class="relative h-[500px] lg:h-full min-h-[500px]">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3952.442036878846!2d111.4601346!3d-7.8487184!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799f11783f38e9%3A0xb1f12ec74cd3bcd2!2sSQUAD%20TRANSWISATA%20(RENTAL%20MOBIL%26CARTER)!5e0!3m2!1sid!2sid!4v1769496756672!5m2!1sid!2sid"
                                    class="w-full h-full border-0"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>

                                <!-- Map Overlay Card -->
                                <div class="absolute bottom-6 left-6 right-6 bg-white rounded-2xl shadow-2xl p-5 backdrop-blur-sm bg-opacity-95 animate-slide-up">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-gradient-to-br from-[#F5A623] to-[#E09612] rounded-xl flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900 mb-1 text-lg">
                                                Kantor Pusat SquadTrans
                                            </h3>
                                            <p class="text-sm text-gray-600 leading-relaxed">
                                                123 Rental Drive, Pusat Kota<br>
                                                Los Angeles, CA 90012
                                            </p>
                                            <a href="https://maps.app.goo.gl/3iWyQfnTpeZcjGXH9" target="_blank"
                                               class="inline-flex items-center text-[#F5A623] hover:text-[#E09612] font-medium text-sm mt-2 transition-colors">
                                                Buka di Maps
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- FAQ or Additional Info Section -->
    <section class="bg-gradient-to-br from-[#FAF7F0] to-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto text-center">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">
                    Butuh Bantuan Cepat?
                </h3>
                <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                    Tim customer service kami siap membantu Anda kapan saja
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://wa.me/15550000TRANS" target="_blank"
                       class="inline-flex items-center px-8 py-4 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Chat via WhatsApp
                    </a>
                    <a href="tel:+15550000TRANS"
                       class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 border-2 border-gray-200">
                        <svg class="w-6 h-6 mr-2 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Telepon Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Animations */
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

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out;
        }

        .animate-fade-in-up-delay {
            animation: fade-in-up 0.8s ease-out 0.2s both;
        }

        .animate-slide-down {
            animation: slide-down 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #F5A623;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #E09612;
        }
    </style>

</x-app-layout>
