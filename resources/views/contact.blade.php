{{-- resources/views/contact.blade.php --}}

<x-app-layout>
    <x-slot name="title">
        Hubungi Kami - SquadTrans
    </x-slot>

    <!-- Hero Section -->
    <section class="bg-[#FAF7F0] py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                            Hubungi Kami
                        </h1>
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
                    <div>
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden h-full">
                            <div class="relative h-[500px]">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3952.442036878846!2d111.4601346!3d-7.8487184!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799f11783f38e9%3A0xb1f12ec74cd3bcd2!2sSQUAD%20TRANSWISATA%20(RENTAL%20MOBIL%26CARTER)!5e0!3m2!1sid!2sid!4v1769496756672!5m2!1sid!2sid"
                                    class="w-full h-full border-0"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>

                                <div class="absolute bottom-6 left-6 bg-white rounded-xl shadow-lg p-4 max-w-xs">
                                    <h3 class="font-bold text-gray-900 mb-1">
                                        Kantor Pusat Kami
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        123 Rental Drive, Pusat Kota, LA
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Cards -->
                    <div class="space-y-4">

                        <!-- Address -->
                        <div class="bg-white rounded-2xl shadow-md p-6">
                            <h4 class="text-sm font-semibold text-gray-500 mb-1">
                                Alamat Kantor
                            </h4>
                            <p class="text-gray-900 font-medium">
                                123 Rental Drive, Pusat Kota<br>
                                Los Angeles, CA 90012
                            </p>
                        </div>

                        <!-- Phone -->
                        <div class="bg-white rounded-2xl shadow-md p-6">
                            <h4 class="text-sm font-semibold text-gray-500 mb-1">
                                Nomor Telepon
                            </h4>
                            <a href="tel:+15550000TRANS" class="font-medium text-gray-900 hover:text-[#F5A623]">
                                +1 (555) 000-TRANS
                            </a>
                            <p class="text-sm text-gray-500 mt-1">
                                Sen - Jum: 08.00 - 20.00
                            </p>
                        </div>

                        <!-- Email -->
                        <div class="bg-white rounded-2xl shadow-md p-6">
                            <h4 class="text-sm font-semibold text-gray-500 mb-1">
                                Alamat Email
                            </h4>
                            <a href="mailto:contact@squadtrans.com" class="font-medium text-gray-900 hover:text-[#F5A623]">
                                contact@squadtrans.com
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-md p-8">

                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Kirim Pesan
                </h2>
                <p class="text-gray-600 mb-8">
                    Isi formulir di bawah ini dan kami akan segera menghubungi Anda
                </p>

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg animate-fade-in">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full border rounded-lg px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full border rounded-lg px-4 py-3">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Subjek</label>
                        <select name="subject" class="w-full border rounded-lg px-4 py-3">
                            <option value="">Pilih Subjek</option>
                            <option value="reservasi">Reservasi</option>
                            <option value="komplain">Komplain</option>
                            <option value="kerjasama">Kerjasama</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Pesan</label>
                        <textarea name="message" rows="5"
                                  class="w-full border rounded-lg px-4 py-3">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-[#F5A623] hover:bg-[#E09612] text-white font-semibold py-3 rounded-lg">
                        Kirim Pesan
                    </button>
                </form>
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

</x-app-layout>
