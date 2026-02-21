{{-- resources/views/contact.blade.php --}}

<x-app-layout>
    <x-slot name="title">Hubungi Kami - SquadTrans</x-slot>

    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
        <style>
            * {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    @endpush


    {{-- ================= HERO ================= --}}
<div class="w-[95%] max-w-7xl mx-auto pt-24">

    <header x-data
        x-init="$el.classList.add('opacity-100')"
        class="relative w-full rounded-2xl overflow-hidden bg-cover bg-center opacity-0 transition-all duration-700 ease-out"
        style="height:340px; background-image:url('{{ asset('images/keluarga.jpeg') }}');">

        {{-- Dark Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-black/20"></div>

        {{-- Soft Glow Effect --}}
        <div class="absolute -top-20 -left-20 w-72 h-72 bg-yellow-500/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-yellow-500/20 rounded-full blur-3xl"></div>

        {{-- Content --}}
        <div class="absolute bottom-10 left-10 z-10 space-y-3">

            {{-- Badge --}}
            {{-- Badge --}}
<span class="inline-block px-4 py-1 text-xs font-light tracking-widest
              border border-yellow-500 text-white rounded-full backdrop-blur-sm">
    LAYANAN KAMI
</span>

{{-- Title --}}
<h1 class="text-4xl sm:text-5xl font-semibold text-white leading-tight">
    Butuh Bantuan atau Informasi
</h1>

{{-- Subtitle --}}
<p class="text-white/80 max-w-lg text-sm sm:text-base">
    Tim kami siap membantu Anda dalam reservasi, konsultasi, dan kebutuhan transportasi
    dengan respon cepat dan pelayanan terbaik.
</p>

        </div>

    </header>

</div>


    {{-- ================= CONTACT SECTION ================= --}}
    <section class="py-10">

        <div class="w-[95%] max-w-7xl mx-auto px-5 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-10">

                {{-- ================= LEFT ================= --}}
                <div>

                    <span class="text-yellow-600 font-bold uppercase text-xs tracking-widest">
                        Informasi Kontak
                    </span>

                    <h2 class="text-3xl md:text-4xl text-slate-900 mt-3 mb-6">
                        Cara Menghubungi Kami
                    </h2>

                    <p class="text-slate-500 mb-10 max-w-md">
                        Kami siap membantu kebutuhan transportasi Anda dengan pelayanan cepat dan profesional.
                    </p>

                    <div class="space-y-8">

                        {{-- Phone --}}
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-yellow-600/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    +62 812-3328-3578
                                </p>
                                <p class="text-xs text-slate-500">
                                    Sen - Jum, 08.00 - 20.00
                                </p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-yellow-600/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    contact@squadtrans.com
                                </p>
                                <p class="text-xs text-slate-500">
                                    Respon dalam 24 jam
                                </p>
                            </div>
                        </div>
                         <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-yellow-600/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">
                                        123 Rental Drive
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        Pusat Kota
                                    </p>
                                </div>
                            </div>

                    </div>

                </div>


                {{-- ================= RIGHT FORM ================= --}}
                <div>

    <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 shadow-sm">

        <h3 class="text-xl font-bold mb-1">
            Get In Touch
        </h3>

        <p class="text-sm text-slate-400 mb-4">
            Ceritakan kebutuhan transportasi Anda
        </p>

        {{-- ✅ Ubah Layout Form --}}
        <form action="{{ route('contact.store') }}" method="POST"
            class="grid grid-cols-1 md:grid-cols-2 gap-4">

            @csrf

            {{-- Nama --}}
            <input type="text" name="name" placeholder="Full Name"
                class="col-span-1 w-full rounded-xl border px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-500">

            {{-- Email --}}
            <input type="email" name="email" placeholder="Email"
                class="col-span-1 w-full rounded-xl border px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-500">

            {{-- Subject (Full Row) --}}
            <select name="subject"
                class="md:col-span-2 w-full rounded-xl border px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-500">
                <option value="">Pilih Subject</option>
                <option>Reservasi Mobil</option>
                <option>Komplain</option>
                <option>Kerjasama</option>
            </select>

            {{-- Message (Full Row) --}}
            <textarea name="message" rows="4"
                class="md:col-span-2 w-full rounded-xl border px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-500 resize-none"
                placeholder="Message"></textarea>

            {{-- Button (Full Row) --}}
            <button type="submit"
                class="md:col-span-2 w-full bg-slate-900 hover:bg-yellow-600 text-white py-3 rounded-xl transition">
                Send Message
            </button>

        </form>

    </div>

</div>

            </div>

        </div>

    </section>


    {{-- ================= MAP ================= --}}
    <section class="pb-10">

        <div class="w-[95%] max-w-7xl mx-auto ">

            <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200 h-[420px]">

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3952.442036878846!2d111.4601346!3d-7.8487184!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799f11783f38e9%3A0xb1f12ec74cd3bcd2!2sSQUAD%20TRANSWISATA%20(RENTAL%20MOBIL%26CARTER)!5e0!3m2!1sid!2sid!4v1769496756672!5m2!1sid!2sid"
                    class="w-full h-full border-0"
                    loading="lazy">
                </iframe>

            </div>

        </div>

    </section>

</x-app-layout>
