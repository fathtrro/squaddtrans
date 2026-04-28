<x-app-layout>
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
*, *::before, *::after { box-sizing: border-box; }
.pg { font-family: 'DM Sans', sans-serif; }
.hf { font-family: 'Syne', sans-serif; }

/* Animations */
.fu1{animation:fu .7s .15s both}
.fu2{animation:fu .7s .32s both}
.fu3{animation:fu .7s .48s both}
.fu4{animation:fu .8s .62s both}
@keyframes fu{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)}}

.badge-dot{width:6px;height:6px;border-radius:50%;background:#fbbf24;animation:bl 2s infinite}
@keyframes bl{0%,100%{opacity:1}50%{opacity:.3}}

.scroll-line{width:1px;height:38px;background:linear-gradient(to bottom,rgba(255,255,255,.55),transparent);animation:gr 1.8s ease-in-out infinite}
@keyframes gr{0%{transform:scaleY(0);transform-origin:top}50%{transform:scaleY(1);transform-origin:top}51%{transform:scaleY(1);transform-origin:bottom}100%{transform:scaleY(0);transform-origin:bottom}}

/* Premium Glass Card */
.glass-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
    border: 1px solid rgba(255,255,255,0.12);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    box-shadow:
        0 25px 50px rgba(0,0,0,0.4),
        inset 0 1px 0 rgba(255,255,255,0.1);
}

/* Modern Pill Tabs */
.tab-container {
    background: rgba(0,0,0,0.3);
    border-radius: 0.75rem;
    padding: 4px;
    display: inline-flex;
    gap: 4px;
}
.thb {
    padding: 8px 20px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 0.625rem;
    color: rgba(255,255,255,0.4);
    background: transparent;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'DM Sans', sans-serif;
}
.thb.active {
    background: rgba(251,191,36,0.15);
    color: #fbbf24;
    box-shadow: 0 2px 10px rgba(245,158,11,0.15);
}
.thb:not(.active):hover {
    color: rgba(255,255,255,0.75);
    background: rgba(255,255,255,0.05);
}

/* Premium Input Focus */
.fbox {
    background: rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 0.75rem;
    transition: all 0.3s ease;
}
.fbox:focus-within {
    border-color: rgba(251,191,36,0.5);
    background: rgba(251,191,36,0.05);
    box-shadow: 0 0 0 3px rgba(251,191,36,0.1);
}

input[type="datetime-local"]::-webkit-calendar-picker-indicator{filter:invert(1);opacity:.4;cursor:pointer}
select option{background:#1e293b;color:#fff}

/* 3D Cari Button */
.btn-srch {
    background: linear-gradient(135deg,#f59e0b,#d97706);
    box-shadow: 0 4px 15px rgba(245,158,11,0.3), inset 0 1px 0 rgba(255,255,255,0.2);
    transition: all 0.2s ease;
    border-bottom: 3px solid #b45309;
}
.btn-srch:hover {
    filter: brightness(1.1);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245,158,11,0.4), inset 0 1px 0 rgba(255,255,255,0.2);
    border-bottom-width: 3px;
}
.btn-srch:active {
    transform: translateY(1px);
    border-bottom-width: 1px;
    box-shadow: 0 2px 10px rgba(245,158,11,0.2);
}

.btn-wa:hover{filter:brightness(1.1);transform:translateY(-1px)}

/* Reveal on Scroll */
.reveal{opacity:0;transform:translateY(40px);transition:opacity .8s ease,transform .8s ease}
.reveal.visible{opacity:1;transform:translateY(0)}

.why-card:hover .why-icon{background:#f59e0b!important;color:#fff!important}
.why-icon{transition:all .3s}
.fleet-item:hover{transform:translateY(-4px)}
.fleet-item{transition:all .3s}
.stat-num{font-family:'Syne',sans-serif;font-size:2.8rem;font-weight:800;color:#f59e0b;line-height:1}
.app-badge:hover{transform:scale(1.04)}
.app-badge{transition:transform .2s}

/* Responsive Grid for Form */
.form-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1.5fr auto;
    gap: 0.75rem;
    align-items: start;
}
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr 1fr;
    }
    .form-grid .fbox:last-of-type {
        grid-column: span 2;
    }
    .form-grid button[type="submit"] {
        grid-column: span 2;
        width: 100%;
        justify-content: center;
    }
}
@media (max-width: 480px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .form-grid .fbox:last-of-type,
    .form-grid button[type="submit"] {
        grid-column: span 1;
    }
}
</style>
@endpush
{{-- ================================================================ --}}
{{-- 1. HERO                                                            --}}
{{-- ================================================================ --}}
<header class="pg relative w-full overflow-hidden" style="min-height:100svh;background:#0a0a0f;display:flex;flex-direction:column;">

    <div class="absolute inset-0" style="background-image:url('{{ asset('images/hand.png') }}');background-size:cover;background-position:center 70%;opacity:.42;"></div>
    <div class="absolute inset-0" style="background:linear-gradient(to bottom,rgba(10,10,15,.65) 0%,rgba(10,10,15,.1) 38%,rgba(10,10,15,.72) 72%,rgba(10,10,15,.98) 100%);"></div>
    <div class="absolute inset-0" style="background:linear-gradient(115deg,rgba(234,179,8,.08) 0%,transparent 55%);"></div>

    <!-- Top Line Accent -->
    <div class="absolute top-0 left-0 right-0 h-px" style="background:linear-gradient(to right,transparent,rgba(234,179,8,.55),transparent);"></div>

    <div class="relative z-10 max-w-6xl mx-auto w-full px-5 sm:px-8"
     style="min-height:calc(100svh - 5rem); display:flex; align-items:flex-end; padding-top:7rem; padding-bottom:4rem;">

    <div class="w-full grid lg:grid-cols-2 gap-10 items-end">
        {{-- LEFT: teks --}}
        <div class="lg:pr-6">
            <div class="fu1 flex items-center gap-2 mb-5 w-fit px-4 py-1.5 rounded-full"
                 style="background:rgba(234,179,8,.08);border:1px solid rgba(234,179,8,.32);">
                <span class="badge-dot"></span>
                <span class="text-yellow-400 text-xs font-semibold tracking-widest uppercase">
                    Premium Travel Experience
                </span>
            </div>

            <h1 class="fu2 hf text-white mb-4"
                style="font-size:clamp(2.4rem,5.5vw,4.4rem);font-weight:800;line-height:1.07;letter-spacing:-.03em;text-shadow: 0 4px 20px rgba(0,0,0,0.4);">
                Jelajahi Lebih Jauh,<br>
                Lebih <span style="color:#f59e0b;">Nyaman.</span>
            </h1>

            <p class="fu3 mb-8 text-base sm:text-lg font-light leading-relaxed"
               style="color:rgba(255,255,255,.58);max-width:38rem;text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                Armada premium siap membawa Anda ke mana saja. Pesan kendaraan terbaik dengan layanan profesional — mudah, cepat, dan terpercaya.
            </p>
        </div>

        {{-- RIGHT: card filter --}}
        <div class="fu4">
            <div class="glass-card w-full rounded-2xl overflow-hidden">

                <div class="flex items-center justify-between p-5 pb-0">
                    <div class="tab-container">
                        <button class="thb active" data-tab="lepas-kunci">
                            Lepas Kunci
                        </button>
                        <button class="thb" data-tab="carter">
                            Carter
                        </button>
                    </div>
                    <span class="text-xs font-bold tracking-widest uppercase hidden sm:block"
                          style="color:rgba(255,255,255,.18);">
                        Squad Trans
                    </span>
                </div>

                <div id="tab-lepas-kunci" class="p-5">
                    <form id="dashboardDateForm">
                        <div class="form-grid">

                            <div class="fbox flex flex-col gap-1.5 px-4 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,.35);">
                                    Tanggal & Jam Mulai
                                </span>
                                <input type="datetime-local" id="dashboardStartDateTime"
                                       class="bg-transparent border-0 outline-none text-white text-sm font-medium p-0 w-full"
                                       style="font-family:'DM Sans',sans-serif;" required>
                            </div>

                            <div class="fbox flex flex-col gap-1.5 px-4 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,.35);">
                                    Durasi
                                </span>
                                <select id="dashboardDays"
                                        class="bg-transparent border-0 outline-none text-white text-sm font-medium p-0 cursor-pointer w-full"
                                        style="font-family:'DM Sans',sans-serif;">
                                    @for($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}">{{ $i }} Hari</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="fbox flex flex-col gap-1.5 px-4 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,.35);">
                                    Selesai
                                </span>
                                <p id="dashboardEndDateDisplay" class="text-sm font-medium m-0 p-0 text-white">
                                    —
                                </p>
                            </div>

                            <button type="submit"
                                    class="btn-srch flex items-center justify-center gap-2 text-white font-bold text-sm uppercase rounded-xl border-0 cursor-pointer"
                                    style="padding:0 1.5rem;min-height:3.25rem;white-space:nowrap;letter-spacing:.05em;">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="9" r="7"/>
                                    <path d="M16 16l-3.5-3.5"/>
                                </svg>
                                Cari
                            </button>
                        </div>
                    </form>
                </div>

                <div id="tab-carter" class="p-5 hidden">
                    <a href="https://wa.me/6281233283578?text=Halo%20Admin%20Squad%20Trans%2C%20Saya%20tertarik%20untuk%20carter"
                       target="_blank"
                       class="btn-wa inline-flex items-center gap-3 px-6 py-3 text-white font-bold text-sm rounded-xl transition-all"
                       style="background:linear-gradient(135deg,#22c55e,#16a34a);box-shadow:0 4px 20px rgba(34,197,94,.3);text-decoration:none;font-family:'DM Sans',sans-serif;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/>
                        </svg>
                        Order via WhatsApp
                    </a>

                    <div class="mt-4 px-4 py-3 rounded-xl text-xs"
                         style="background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);color:rgba(255,220,120,.85);max-width:28rem;">
                        Minimum deposit 30% diperlukan untuk konfirmasi pemesanan carter.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="absolute bottom-7 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-1.5">
        <div class="scroll-line"></div>
        <span style="font-size:.6rem;letter-spacing:.16em;color:rgba(255,255,255,.28);text-transform:uppercase;font-weight:600;font-family:'DM Sans',sans-serif;">Scroll</span>
    </div>
</header>

{{-- ================================================================ --}}
{{-- 2. MENGAPA SQUAD TRANS?                                            --}}
{{-- ================================================================ --}}
<section class="pg py-20 bg-white" id="mengapa">
    <div class="max-w-6xl mx-auto px-5 sm:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-3 block">Tentang Kami</span>
                <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 mb-5 leading-tight">Mengapa Memilih<br>Squad Trans?</h2>
                <p class="text-slate-500 leading-relaxed mb-6">
                    Sebagai penyedia transportasi terpercaya, Squad Trans memberikan berbagai solusi mobilitas yang aman dan nyaman dengan pilihan kendaraan yang lengkap, reservasi yang mudah, pengelolaan armada yang efisien, serta layanan pelanggan yang andal.
                </p>
                <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-yellow-600 hover:text-yellow-700 transition">
                    Tentang Kami
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12M12 5l5 5-5 5"/></svg>
                </a>
            </div>
            <div class="reveal" style="transition-delay:.15s;">
                <div class="rounded-2xl overflow-hidden shadow-xl" style="aspect-ratio:4/3;background:#e2e8f0;">
                    <img src="{{ asset('images/hand.png') }}" alt="Squad Trans" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
            @php
            $features = [
                ['icon'=>'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z','title'=>'Akses Mudah & Jaringan Luas','desc'=>'Reservasi kendaraan mudah melalui berbagai channel online dan offline pada jaringan kami yang tersebar di seluruh Indonesia.'],
                ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Layanan Terbaik & Proteksi','desc'=>'Pengemudi bersertifikat, proteksi untuk seluruh unit kendaraan, dan protokol kesehatan ketat di setiap layanannya.'],
                ['icon'=>'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z','title'=>'Teknologi Terpercaya','desc'=>'Terhubung dengan teknologi tantangan yang memastikan ribuan kendaraan beroperasi secara efisien dan real-time.'],
                ['icon'=>'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z','title'=>'Layanan Pelanggan 24/7','desc'=>'Tim kami siap melayani setiap hari selama 24 jam melalui aplikasi dan Customer Assistance Center.'],
            ];
            @endphp
            @foreach($features as $i => $f)
            <div class="why-card reveal p-6 rounded-2xl border border-slate-100 hover:border-yellow-200 hover:shadow-lg transition-all duration-300" style="transition-delay:{{ $i * 0.1 }}s;">
                <div class="why-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:#fef9ee;color:#d97706;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $f['icon'] }}"/></svg>
                </div>
                <h3 class="hf text-sm text-slate-800 mb-2 leading-snug" style="font-weight:700;">{{ $f['title'] }}</h3>
                <p class="text-xs text-slate-500 leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ================================================================ --}}
{{-- 3. ARMADA KENDARAAN                                               --}}
{{-- ================================================================ --}}
<section class="pg py-20" style="background:#f8f9fb;" id="armada">
    <div class="max-w-6xl mx-auto px-5 sm:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12 reveal">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-2 block">Pilihan Kendaraan</span>
                <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">Semua Kendaraan untuk<br>Semua Perjalanan Anda</h2>
            </div>
            <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-yellow-600 hover:text-yellow-700 transition whitespace-nowrap">
                Lihat Semua Armada
                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12M12 5l5 5-5 5"/></svg>
            </a>
        </div>

        @php
        $categories = [
            ['label'=>'Mobil Penumpang','emoji'=>'🚗','desc'=>'Sedan, MPV, SUV nyaman untuk keluarga'],
            ['label'=>'Bus','emoji'=>'🚌','desc'=>'Armada bus kapasitas besar & nyaman'],
            ['label'=>'4WD / Off-road','emoji'=>'🛻','desc'=>'Kendaraan tangguh untuk medan berat'],
            ['label'=>'Mobil Komersial','emoji'=>'🚐','desc'=>'Van dan pickup untuk kebutuhan bisnis'],
        ];
        @endphp
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($categories as $i => $cat)
            <div class="fleet-item reveal bg-white rounded-2xl p-5 border border-slate-100 hover:border-yellow-300 hover:shadow-xl transition-all duration-300 cursor-pointer group" style="transition-delay:{{ $i * 0.08 }}s;">
                <div class="w-full h-32 flex items-center justify-center rounded-xl mb-4 text-5xl" style="background:#fef9ee;">{{ $cat['emoji'] }}</div>
                <h3 class="hf text-sm font-bold text-slate-800 mb-1">{{ $cat['label'] }}</h3>
                <p class="text-xs text-slate-400 leading-snug mb-3">{{ $cat['desc'] }}</p>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-yellow-600 group-hover:gap-2 transition-all">
                    Lihat
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12M12 5l5 5-5 5"/></svg>
                </span>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ================================================================ --}}
{{-- 4. STATS                                                           --}}
{{-- ================================================================ --}}
<section class="pg py-20 bg-white">
    <div class="max-w-6xl mx-auto px-5 sm:px-8">
        <div class="reveal text-center mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-2 block">Pencapaian Kami</span>
            <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">Memberikan Layanan<br>Transportasi Terbaik</h2>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $stats = [
                ['num'=>'500+','label'=>'Unit Armada','sub'=>'Siap beroperasi'],
                ['num'=>'10K+','label'=>'Pelanggan Puas','sub'=>'Setiap tahunnya'],
                ['num'=>'24/7','label'=>'Layanan Aktif','sub'=>'Tidak pernah berhenti'],
                ['num'=>'5★','label'=>'Rating Rata-rata','sub'=>'Dari ribuan ulasan'],
            ];
            @endphp
            @foreach($stats as $i => $s)
            <div class="reveal text-center p-6 rounded-2xl" style="background:#fef9ee;transition-delay:{{ $i * 0.1 }}s;">
                <p class="stat-num mb-1">{{ $s['num'] }}</p>
                <p class="hf text-sm font-bold text-slate-800 mb-0.5">{{ $s['label'] }}</p>
                <p class="text-xs text-slate-400">{{ $s['sub'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ================================================================ --}}
{{-- 5. ULASAN PELANGGAN                                               --}}
{{-- ================================================================ --}}
<section class="pg py-20" style="background:#f8f9fb;" id="ulasan">
    <div class="max-w-6xl mx-auto px-5 sm:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12 reveal">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-2 block">Kepuasan Pelanggan</span>
                <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">Ulasan Dari<br>Pelanggan Kami</h2>
            </div>
            @auth
            <button onclick="document.getElementById('reviewDialog').showModal()" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-yellow-600 border-2 border-yellow-500 rounded-full hover:bg-yellow-500 hover:text-white transition whitespace-nowrap">
                <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                Tambah Ulasan
            </button>
            @endauth
            @guest
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition whitespace-nowrap">
                Tambah Ulasan
            </a>
            @endguest
        </div>

        @php
        $reviews = App\Models\Review::with('booking.car','booking.user')->orderBy('created_at','desc')->limit(8)->get();
        @endphp

        @if($reviews->count() > 0)
        <div class="reviews-carousel owl-carousel owl-theme">
            @foreach($reviews as $review)
            <div class="item bg-white rounded-2xl overflow-hidden border border-slate-100 shadow hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                @if($review->image_path)
                    <img src="{{ asset('storage/'.$review->image_path) }}" alt="Review" class="w-full h-44 object-cover">
                @elseif($review->booking->car->images->first())
                    <img src="{{ asset('storage/'.$review->booking->car->images->first()->image_path) }}" alt="{{ $review->booking->car->brand }}" class="w-full h-44 object-cover">
                @else
                    <div class="w-full h-44 flex items-center justify-center" style="background:#fef9ee;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="1.5"><path d="M19 17H5m14 0a2 2 0 002-2v-4a2 2 0 00-2-2h-1.172a2 2 0 01-1.414-.586L14 6.586A2 2 0 0012.586 6H6a2 2 0 00-2 2v7a2 2 0 002 2m13 0v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2"/></svg>
                    </div>
                @endif
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex items-center gap-0.5 mb-3">
                        @for($i=1;$i<=5;$i++)
                        <svg class="w-4 h-4 {{ $i<=$review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed flex-1 line-clamp-3 mb-4">"{{ $review->comment ?? 'Pelanggan puas dengan layanan kami.' }}"</p>
                    <div class="flex items-center gap-3 border-t border-slate-100 pt-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style="background:#fef9ee;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="1.8"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $review->booking->user->name ?? 'Pelanggan' }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $review->booking->car->brand ?? '' }} {{ $review->booking->car->name ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-100">
            <div class="text-5xl mb-4">💬</div>
            <p class="text-slate-400 mb-4">Belum ada ulasan. Jadilah yang pertama!</p>
            @auth
            <button onclick="document.getElementById('reviewDialog').showModal()" class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-yellow-600 border-2 border-yellow-500 rounded-full hover:bg-yellow-500 hover:text-white transition">Tambah Ulasan</button>
            @endauth
        </div>
        @endif
    </div>
</section>


{{-- ================================================================ --}}
{{-- 6. CTA APP DOWNLOAD                                               --}}
{{-- ================================================================ --}}
<section class="pg py-16 relative overflow-hidden" style="background:linear-gradient(135deg,#f59e0b 0%,#d97706 100%);">
    <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:36px 36px;"></div>
    <div class="relative max-w-6xl mx-auto px-5 sm:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-10">
            <div class="reveal flex-shrink-0">
                <div class="w-48 h-80 rounded-3xl shadow-2xl flex items-center justify-center" style="background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.3);">
                    <div class="text-center text-white">
                        <div class="text-6xl mb-3">📱</div>
                        <p class="text-xs font-semibold opacity-70">Squad Trans App</p>
                    </div>
                </div>
            </div>
            <div class="reveal text-white" style="transition-delay:.15s;">
                <p class="text-xs font-bold uppercase tracking-widest mb-3 opacity-80">Aplikasi Mobile</p>
                <h2 class="hf text-3xl sm:text-4xl font-bold mb-4 leading-tight">
                    Bisnis atau Liburan,<br>Semua Lebih Praktis<br>dengan Squad Trans
                </h2>
                <p class="text-base opacity-80 mb-1">Sewa Mobil, Bus atau Airport Transfer Langsung dari Aplikasi</p>
                <p class="text-sm font-semibold mb-7 opacity-90">#SquadTransDiSetiapOdometer</p>
                <div class="flex flex-wrap gap-3">
                    <a href="#" class="app-badge inline-flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold" style="background:rgba(0,0,0,.85);color:#fff;text-decoration:none;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                        App Store
                    </a>
                    <a href="#" class="app-badge inline-flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold" style="background:rgba(0,0,0,.85);color:#fff;text-decoration:none;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M3.18 23.76c.33.18.7.2 1.06.04l12.3-7.1-2.63-2.63-10.73 9.69zm16.51-10.32L17.35 12l2.35-1.44c.73-.45.73-1.67 0-2.12L4.24.17C3.88.01 3.51.03 3.18.21L13.9 12 3.18 23.79c.33.18.7.2 1.06.04l15.45-8.91c.73-.45.73-1.23 0-1.68z"/></svg>
                        Google Play
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ================================================================ --}}
{{-- REVIEW MODAL                                                       --}}
{{-- ================================================================ --}}
<dialog id="reviewDialog" style="border:none;padding:0;border-radius:1.5rem;width:90%;max-width:42rem;max-height:90vh;overflow-y:auto;box-shadow:0 25px 60px rgba(0,0,0,.3);">
    <div style="padding:2rem;position:relative;">
        <button onclick="document.getElementById('reviewDialog').close()" style="position:absolute;top:.75rem;right:1rem;background:none;border:none;font-size:1.5rem;color:#94a3b8;cursor:pointer;line-height:1;">✕</button>
        <h2 class="hf text-2xl font-bold mb-1 text-slate-900">Tambahkan Ulasan</h2>
        <p class="text-slate-400 text-sm mb-6">Bagikan pengalaman Anda bersama kami</p>
        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.1rem;">
            @csrf
            <div>
                <label class="text-sm font-semibold mb-1.5 block text-slate-700">Pilih Pemesanan</label>
                <select name="booking_id" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm outline-none bg-white" style="font-family:'DM Sans',sans-serif;">
                    <option value="">-- Pilih --</option>
                    @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">{{ $booking->car->brand }} {{ $booking->car->name }} ({{ $booking->booking_code }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold mb-1.5 block text-slate-700">Rating</label>
                <input type="number" name="rating" min="1" max="5" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm outline-none" placeholder="Nilai 1 - 5">
            </div>
            <div>
                <label class="text-sm font-semibold mb-1.5 block text-slate-700">Komentar</label>
                <textarea name="comment" rows="4" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm outline-none resize-none" placeholder="Tulis pengalaman kamu..."></textarea>
            </div>
            <div>
                <label class="text-sm font-semibold mb-1.5 block text-slate-700">Foto (opsional)</label>
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
            </div>
            <div class="flex gap-3 pt-1">
                <button type="button" onclick="document.getElementById('reviewDialog').close()" class="flex-1 py-3 font-semibold rounded-xl text-sm transition" style="background:#f1f5f9;color:#475569;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;">Batal</button>
                <button type="submit" class="flex-1 py-3 font-semibold rounded-xl text-sm text-white transition" style="background:linear-gradient(135deg,#f59e0b,#d97706);border:none;cursor:pointer;font-family:'DM Sans',sans-serif;">Kirim Ulasan</button>
            </div>
        </form>
    </div>
</dialog>


{{-- ================================================================ --}}
{{-- JAVASCRIPT — inline, NO @push/@endpush                            --}}
{{-- ================================================================ --}}
<script>
document.getElementById('reviewDialog')?.addEventListener('click', function(e) {
    const r = this.getBoundingClientRect();
    if(e.clientX < r.left || e.clientX > r.right || e.clientY < r.top || e.clientY > r.bottom) this.close();
});

document.querySelectorAll('.thb').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.thb').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('#tab-lepas-kunci,#tab-carter').forEach(p => p.classList.add('hidden'));
        btn.classList.add('active');
        document.getElementById('tab-' + btn.dataset.tab)?.classList.remove('hidden');
    });
});

const startInput = document.getElementById('dashboardStartDateTime');
const daysInput  = document.getElementById('dashboardDays');
const endDisplay = document.getElementById('dashboardEndDateDisplay');

function fmtDate(d) {
    const dd = String(d.getDate()).padStart(2,'0');
    const mo = d.toLocaleDateString('id-ID',{month:'short'});
    const hh = String(d.getHours()).padStart(2,'0');
    const mm = String(d.getMinutes()).padStart(2,'0');
    return dd+' '+mo+' '+d.getFullYear()+', '+hh+':'+mm;
}
function calcEnd() {
    if(!startInput.value||!daysInput.value){endDisplay.textContent='—';return;}
    const end = new Date(startInput.value);
    end.setDate(end.getDate()+parseInt(daysInput.value));
    endDisplay.textContent = fmtDate(end);
}
function setDefaults() {
    const n = new Date(), p = function(v){return String(v).padStart(2,'0');};
    startInput.value = n.getFullYear()+'-'+p(n.getMonth()+1)+'-'+p(n.getDate())+'T09:00';
    daysInput.value = '1';
    calcEnd();
}
setDefaults();
startInput.addEventListener('change', calcEnd);
daysInput.addEventListener('change', calcEnd);

document.getElementById('dashboardDateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const start = new Date(startInput.value), days = parseInt(daysInput.value);
    const end = new Date(start);
    end.setDate(end.getDate()+days);
    const fmt  = function(d){return d.toISOString().split('T')[0];};
    const fmtT = function(d){return String(d.getHours()).padStart(2,'0')+':'+String(d.getMinutes()).padStart(2,'0');};
    window.location.href = '/bookings/select-car?start_date='+fmt(start)+'&start_time='+fmtT(start)+'&end_date='+fmt(end)+'&end_time='+fmtT(end);
});

const io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target);}});
},{threshold:0.12});
document.querySelectorAll('.reveal').forEach(function(el){io.observe(el);});
</script>

</x-app-layout>
