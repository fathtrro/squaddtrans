<x-app-layout>
    @push('styles')
        <link
            href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
            rel="stylesheet" />
        <style>
            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            .pg {
                font-family: 'DM Sans', sans-serif;
            }

            .hf {
                font-family: 'Syne', sans-serif;
            }

            /* ─── Entrance Animations ─── */
            .fu1 {
                animation: fu .7s .15s both
            }

            .fu2 {
                animation: fu .7s .32s both
            }

            .fu3 {
                animation: fu .7s .48s both
            }

            .fu4 {
                animation: fu .8s .62s both
            }

            @keyframes fu {
                from {
                    opacity: 0;
                    transform: translateY(22px)
                }

                to {
                    opacity: 1;
                    transform: translateY(0)
                }
            }

            /* ─── Badge pulse dot ─── */
            .badge-dot {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: #fbbf24;
                animation: bl 2s infinite;
                display: inline-block;
                flex-shrink: 0;
            }

            @keyframes bl {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1)
                }

                50% {
                    opacity: .4;
                    transform: scale(.75)
                }
            }

            /* ─── Scroll indicator ─── */
            .scroll-line {
                width: 1px;
                height: 38px;
                background: linear-gradient(to bottom, rgba(255, 255, 255, .55), transparent);
                animation: gr 1.8s ease-in-out infinite;
            }

            @keyframes gr {
                0% {
                    transform: scaleY(0);
                    transform-origin: top
                }

                50% {
                    transform: scaleY(1);
                    transform-origin: top
                }

                51% {
                    transform: scaleY(1);
                    transform-origin: bottom
                }

                100% {
                    transform: scaleY(0);
                    transform-origin: bottom
                }
            }

            /* ─── Datetime picker indicator ─── */
            input[type="datetime-local"]::-webkit-calendar-picker-indicator {
                filter: invert(.8) brightness(1.2);
                cursor: pointer;
            }

            /* ─── Divider line ─── */
            .divider-line {
                height: 1px;
                background: rgba(51, 65, 85, .5);
                margin: 16px 0;
            }

            /* ─── Scroll reveal ─── */
            .reveal {
                opacity: 0;
                transform: translateY(36px);
                transition: opacity .8s ease, transform .8s ease
            }

            .reveal.visible {
                opacity: 1;
                transform: translateY(0)
            }

            /* ─── Why cards ─── */
            .why-card:hover .why-icon {
                background: #f59e0b !important;
                color: #fff !important
            }

            .why-icon {
                transition: all .3s
            }

            /* ─── Fleet cards ─── */
            .fleet-item:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 32px rgba(0, 0, 0, .1) !important;
            }

            /* ─── Responsive Header Versions ─── */
            .header-desktop {
                display: grid;
                visibility: visible;
            }

            .header-mobile {
                display: none;
                visibility: hidden;
            }

            .fleet-item {
                transition: all .3s
            }

            /* ─── Stats ─── */
            .stat-num {
                font-family: 'Syne', sans-serif;
                font-size: 2.8rem;
                font-weight: 800;
                color: #f59e0b;
                line-height: 1
            }

            /* ─── App store badges ─── */
            .app-badge:hover {
                transform: scale(1.04)
            }

            .app-badge {
                transition: transform .2s
            }

            /* ─── Select reset ─── */
            select {
                -webkit-appearance: none;
                appearance: none;
            }
        </style>
    @endpush

    {{-- ================================================================ --}}
    {{-- 1. HERO / HEADER                                                  --}}
    {{-- ================================================================ --}}
    <header class="pg relative w-full overflow-hidden"
        style="min-height:100svh;background:#06080e;display:flex;flex-direction:column;">

        {{-- Background image --}}
        <div class="absolute inset-0"
            style="background-image:url('{{ asset('images/hand.png') }}');
                background-size:cover;
                background-position:center 60%;
                opacity:.45;">
        </div>

        {{-- Gradient layer — lighter in center so card sits on a lit background --}}
        <div class="absolute inset-0"
            style="background:linear-gradient(to bottom,
             rgba(6,8,14,.72) 0%,
             rgba(6,8,14,.18) 30%,
             rgba(6,8,14,.22) 60%,
             rgba(6,8,14,.92) 100%);">
        </div>

        {{-- Warm amber glow — right side, behind the card --}}
        <div class="absolute inset-0"
            style="background:radial-gradient(ellipse 60% 70% at 75% 52%, rgba(245,158,11,.10) 0%, transparent 70%);">
        </div>

        {{-- Subtle warm tint on left for the headline --}}
        <div class="absolute inset-0"
            style="background:radial-gradient(ellipse 55% 60% at 22% 55%, rgba(245,158,11,.06) 0%, transparent 65%);">
        </div>

        {{-- Top accent line --}}
        <div class="absolute top-0 left-0 right-0"
            style="height:1px;background:linear-gradient(to right,transparent,rgba(234,179,8,.45),transparent);">
        </div>

        {{-- Main content — vertically centered --}}
        <div class="relative z-10 max-w-6xl mx-auto w-full px-5 sm:px-8"
            style="flex:1;display:flex;align-items:center;padding-top:6rem;padding-bottom:5rem;">

            {{-- DESKTOP VERSION --}}
            <div class="header-desktop" style="grid-template-columns:1fr 1fr;gap:56px;align-items:center;width:100%">

                {{-- ── LEFT: Headline ── --}}
                <div style="padding-right:8px;">

                    {{-- Badge --}}
                    <div class="fu1"
                        style="display:inline-flex;align-items:center;gap:8px;
                            margin-bottom:22px;padding:6px 16px;
                            background:rgba(234,179,8,.09);
                            border:1px solid rgba(234,179,8,.28);
                            border-radius:999px;">
                        <span class="badge-dot"></span>
                        <span
                            style="color:#fbbf24;font-size:10.5px;font-weight:700;
                                 letter-spacing:.16em;text-transform:uppercase;">
                            Premium Travel Experience
                        </span>
                    </div>

                    {{-- Headline --}}
                    <h1 class="fu2 hf"
                        style="color:#fff;
                           font-size:clamp(2.2rem,4.8vw,4rem);
                           font-weight:800;
                           line-height:1.08;
                           letter-spacing:-.03em;
                           margin:0 0 20px;">
                        Jelajahi Lebih Jauh,<br>
                        Lebih <span style="color:#f59e0b;">Nyaman.</span>
                    </h1>

                    {{-- Sub --}}
                    <p class="fu3"
                        style="color:rgba(255,255,255,.58);
                          font-size:1.05rem;
                          font-weight:300;
                          line-height:1.75;
                          max-width:36rem;
                          margin:0 0 32px;">
                        Armada premium siap membawa Anda ke mana saja. Pesan kendaraan terbaik
                        dengan layanan profesional — mudah, cepat, dan terpercaya.
                    </p>

                    {{-- Stats strip --}}
                    <div class="fu3" style="display:flex;gap:28px;">
                        <div>
                            <p
                                style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;
                                  color:#f59e0b;margin:0;line-height:1;">
                                50+</p>
                            <p
                                style="font-size:11px;color:rgba(255,255,255,.4);margin:4px 0 0;
                                  letter-spacing:.04em;">
                                Unit Armada</p>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.12);"></div>
                        <div>
                            <p
                                style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;
                                  color:#f59e0b;margin:0;line-height:1;">
                                15K+</p>
                            <p
                                style="font-size:11px;color:rgba(255,255,255,.4);margin:4px 0 0;
                                  letter-spacing:.04em;">
                                Pelanggan Puas</p>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.12);"></div>
                        <div>
                            <p
                                style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;
                                  color:#f59e0b;margin:0;line-height:1;">
                                4,7★</p>
                            <p
                                style="font-size:11px;color:rgba(255,255,255,.4);margin:4px 0 0;
                                  letter-spacing:.04em;">
                                Rating</p>
                        </div>
                    </div>
                </div>

                {{-- ── RIGHT: Filter Card — Glassmorphism Light ── --}}
                <div class="fu4">
                    {{-- Outer glow ring --}}
                    <div style="position:relative;">
                        {{-- Glow behind card --}}
                        <div
                            style="position:absolute;inset:-18px;
                                background:radial-gradient(ellipse at center, rgba(245,158,11,.13) 0%, transparent 70%);
                                border-radius:40px;
                                pointer-events:none;">
                        </div>

                        {{-- Glass card — light mode feel with translucent white --}}
                        <div
                            style="position:relative;
                                background:rgba(255,255,255,0.11);
                                border:1px solid rgba(255,255,255,0.22);
                                border-radius:26px;
                                backdrop-filter:blur(28px) saturate(1.6);
                                -webkit-backdrop-filter:blur(28px) saturate(1.6);
                                box-shadow:
                                    0 8px 32px rgba(0,0,0,.28),
                                    0 1px 0 rgba(255,255,255,.18) inset,
                                    0 -1px 0 rgba(0,0,0,.12) inset;
                                padding:28px 26px;">

                            {{-- Card header: logo mark + label --}}
                            <div
                                style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                                <div
                                    style="display:flex;gap:4px;
                                        padding:4px;
                                        background:rgba(0,0,0,.25);
                                        border:1px solid rgba(255,255,255,.12);
                                        border-radius:14px;">
                                    <button id="btn-lepas-kunci" onclick="switchHeroTab('lepas-kunci')"
                                        style="padding:8px 18px;border-radius:10px;
                                               font-size:12.5px;font-weight:700;
                                               border:none;cursor:pointer;
                                               font-family:'DM Sans',sans-serif;
                                               background:linear-gradient(135deg,#f59e0b,#d97706);
                                               color:#1a1200;
                                               box-shadow:0 2px 10px rgba(245,158,11,.4);
                                               transition:all .22s;">
                                        Lepas Kunci
                                    </button>
                                    <button id="btn-carter" onclick="switchHeroTab('carter')"
                                        style="padding:8px 18px;border-radius:10px;
                                               font-size:12.5px;font-weight:700;
                                               border:none;cursor:pointer;
                                               font-family:'DM Sans',sans-serif;
                                               background:transparent;
                                               color:rgba(255,255,255,.5);
                                               transition:all .22s;">
                                        Carter
                                    </button>
                                </div>
                                <div style="display:flex;align-items:center;gap:6px;">
                                    <div style="width:6px;height:6px;border-radius:50%;background:#f59e0b;"></div>
                                    <span
                                        style="font-size:10px;font-weight:700;letter-spacing:.14em;
                                             color:rgba(255,255,255,.35);text-transform:uppercase;">
                                        Squad Trans
                                    </span>
                                </div>
                            </div>

                            {{-- Divider --}}
                            <div style="height:1px;background:rgba(255,255,255,.1);margin-bottom:20px;"></div>

                            {{-- ── TAB: Lepas Kunci ── --}}
                            <div id="tab-lepas-kunci">
                                <form id="dashboardDateForm">

                                    {{-- Row 1: Tanggal & Durasi --}}
                                    <div
                                        style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">

                                        {{-- Tanggal Mulai --}}
                                        <div style="position:relative;
                                                background:rgba(255,255,255,.08);
                                                border:1px solid rgba(255,255,255,.15);
                                                border-radius:16px;
                                                padding:14px 15px;
                                                cursor:pointer;
                                                transition:background .2s,border-color .2s;"
                                            onmouseenter="this.style.background='rgba(255,255,255,.13)';this.style.borderColor='rgba(255,255,255,.25)'"
                                            onmouseleave="this.style.background='rgba(255,255,255,.08)';this.style.borderColor='rgba(255,255,255,.15)'"
                                            onclick="document.getElementById('dashboardStartDateTime').showPicker?.() || document.getElementById('dashboardStartDateTime').click()">
                                            <span
                                                style="display:block;font-size:8.5px;font-weight:700;
                                                     letter-spacing:.16em;text-transform:uppercase;
                                                     color:rgba(255,255,255,.45);margin-bottom:8px;">
                                                Tanggal Mulai
                                            </span>
                                            <input type="datetime-local" id="dashboardStartDateTime"
                                                style="position:absolute;inset:0;width:100%;height:100%;
                                                      opacity:0;cursor:pointer;z-index:10;"
                                                required>
                                            <div style="pointer-events:none;">
                                                <p id="startDateLine"
                                                    style="font-size:13px;font-weight:700;
                                                      color:rgba(255,255,255,.95);
                                                      margin:0;line-height:1.3;">
                                                    —</p>
                                                <p id="startTimeLine"
                                                    style="font-size:11.5px;
                                                      color:rgba(255,255,255,.45);
                                                      margin:4px 0 0;line-height:1;">
                                                    —</p>
                                            </div>
                                        </div>

                                        {{-- Durasi --}}
                                        <div
                                            style="background:rgba(255,255,255,.08);
                                                border:1px solid rgba(255,255,255,.15);
                                                border-radius:16px;
                                                padding:14px 15px;">
                                            <span
                                                style="display:block;font-size:8.5px;font-weight:700;
                                                     letter-spacing:.16em;text-transform:uppercase;
                                                     color:rgba(255,255,255,.45);margin-bottom:8px;">
                                                Durasi
                                            </span>
                                            <select id="dashboardDays"
                                                style="-webkit-appearance:none;appearance:none;
                                                       background:transparent;border:none;outline:none;
                                                       color:rgba(255,255,255,.95);font-size:13px;font-weight:700;
                                                       width:100%;cursor:pointer;
                                                       font-family:'DM Sans',sans-serif;">
                                                @for ($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}"
                                                        style="background:#1e2a3a;color:#fff;">{{ $i }} Hari
                                                    </option>
                                                @endfor
                                            </select>
                                            <p
                                                style="font-size:10.5px;color:rgba(255,255,255,.38);
                                                  margin:5px 0 0;line-height:1;">
                                                Bisa disesuaikan
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Row 2: Selesai --}}
                                    <div
                                        style="display:flex;align-items:center;justify-content:space-between;
                                            gap:12px;
                                            background:rgba(245,158,11,.12);
                                            border:1px solid rgba(245,158,11,.35);
                                            border-radius:16px;
                                            padding:14px 15px;
                                            margin-bottom:12px;">
                                        <div>
                                            <span
                                                style="display:block;font-size:8.5px;font-weight:700;
                                                     letter-spacing:.16em;text-transform:uppercase;
                                                     color:rgba(245,158,11,.6);margin-bottom:7px;">
                                                Selesai
                                            </span>
                                            <p id="dashboardEndDateDisplay"
                                                style="font-size:15px;font-weight:700;
                                                  color:#fbbf24;margin:0;
                                                  text-shadow:0 0 20px rgba(251,191,36,.4);">
                                                —
                                            </p>
                                        </div>
                                        <div
                                            style="width:36px;height:36px;flex-shrink:0;
                                                background:rgba(245,158,11,.18);
                                                border:1px solid rgba(245,158,11,.3);
                                                border-radius:10px;
                                                display:flex;align-items:center;justify-content:center;">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                stroke="#f59e0b" stroke-width="2.2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                                <path d="M16 2v4M8 2v4M3 10h18" />
                                            </svg>
                                        </div>
                                    </div>

                                    {{-- Row 3: Cari button --}}
                                    <button type="submit"
                                        style="width:100%;
                                               background:linear-gradient(135deg,#f59e0b 0%,#d97706 100%);
                                               border:none;border-radius:16px;
                                               padding:15px 20px;
                                               color:#fff;font-weight:700;font-size:13px;
                                               letter-spacing:.08em;text-transform:uppercase;
                                               cursor:pointer;
                                               display:flex;align-items:center;justify-content:center;gap:10px;
                                               font-family:'DM Sans',sans-serif;
                                               box-shadow:0 4px 22px rgba(245,158,11,.45);
                                               transition:filter .2s,transform .15s;"
                                        onmouseenter="this.style.filter='brightness(1.1)';this.style.transform='translateY(-1px)'"
                                        onmouseleave="this.style.filter='brightness(1)';this.style.transform='translateY(0)'"
                                        onmousedown="this.style.transform='scale(.99)'"
                                        onmouseup="this.style.transform='translateY(-1px)'">
                                        <svg width="15" height="15" viewBox="0 0 20 20" fill="none"
                                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <circle cx="9" cy="9" r="7" />
                                            <path d="M16 16l-3.5-3.5" />
                                        </svg>
                                        Cari Kendaraan
                                    </button>

                                </form>
                            </div>{{-- /tab-lepas-kunci --}}

                            {{-- ── TAB: Carter ── --}}
                            <div id="tab-carter" style="display:none;">
                                <p
                                    style="color:rgba(255,255,255,.6);font-size:13.5px;
                                      line-height:1.75;margin:0 0 16px;">
                                    Butuh kendaraan untuk perjalanan khusus? Hubungi kami langsung via
                                    WhatsApp untuk info harga dan ketersediaan armada.
                                </p>
                                <a href="https://wa.me/6281233283578?text=Halo%20Admin%20Squad%20Trans%2C%20Saya%20tertarik%20untuk%20carter"
                                    target="_blank"
                                    style="display:inline-flex;align-items:center;gap:10px;
                                      padding:13px 22px;border-radius:14px;
                                      background:#22c55e;color:#fff;
                                      font-weight:700;font-size:14px;
                                      text-decoration:none;
                                      font-family:'DM Sans',sans-serif;
                                      margin-bottom:14px;
                                      box-shadow:0 4px 18px rgba(34,197,94,.35);
                                      transition:filter .2s;"
                                    onmouseenter="this.style.filter='brightness(1.08)'"
                                    onmouseleave="this.style.filter='brightness(1)'">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
                                    </svg>
                                    Order via WhatsApp
                                </a>
                                <div
                                    style="background:rgba(245,158,11,.1);
                                        border:1px solid rgba(245,158,11,.3);
                                        border-radius:12px;padding:12px 14px;
                                        color:rgba(251,191,36,.9);font-size:11.5px;line-height:1.65;">
                                    Minimum deposit 30% diperlukan untuk konfirmasi pemesanan carter.
                                </div>
                            </div>{{-- /tab-carter --}}

                        </div>{{-- /glass-card --}}
                    </div>{{-- /glow-wrapper --}}
                </div>{{-- /fu4 --}}

            </div>

            {{-- MOBILE VERSION --}}
            <div class="header-mobile" style="grid-template-columns:1fr;gap:24px;width:100%">

                {{-- Mobile Headline Section --}}
                <div style="text-align:center;">
                    {{-- Badge --}}
                    <div class="fu1"
                        style="display:inline-flex;align-items:center;gap:8px;
                            margin-bottom:16px;padding:6px 14px;
                            background:rgba(234,179,8,.09);
                            border:1px solid rgba(234,179,8,.28);
                            border-radius:999px;">
                        <span class="badge-dot"></span>
                        <span
                            style="color:#fbbf24;font-size:9px;font-weight:700;
                                 letter-spacing:.14em;text-transform:uppercase;">
                            Premium Travel Experience
                        </span>
                    </div>

                    {{-- Headline --}}
                    <h1 class="fu2 hf"
                        style="color:#fff;
                           font-size:clamp(1.8rem,7vw,2.3rem);
                           font-weight:800;
                           line-height:1.2;
                           letter-spacing:-.02em;
                           margin:0 0 14px;">
                        Jelajahi Lebih<br>Jauh, Lebih<br><span style="color:#f59e0b;">Nyaman</span>
                    </h1>

                    {{-- Sub --}}
                    <p class="fu3"
                        style="color:rgba(255,255,255,.6);
                          font-size:0.95rem;
                          font-weight:300;
                          line-height:1.5;
                          margin:0 0 24px;">
                        Sewa kendaraan premium dengan mudah dan terpercaya
                    </p>
                </div>

                {{-- Mobile Filter Card --}}
                <div class="fu4">
                    {{-- Glass card --}}
                    <div
                        style="position:relative;
                            background:rgba(255,255,255,0.10);
                            border:1px solid rgba(255,255,255,0.2);
                            border-radius:20px;
                            backdrop-filter:blur(20px) saturate(1.5);
                            -webkit-backdrop-filter:blur(20px) saturate(1.5);
                            box-shadow:0 8px 24px rgba(0,0,0,.25);
                            padding:20px;">

                        {{-- Mobile header --}}
                        <div
                            style="display:flex;align-items:center;justify-content:center;margin-bottom:16px;gap:4px;">
                            <div style="width:4px;height:4px;border-radius:50%;background:#f59e0b;"></div>
                            <span
                                style="font-size:10px;font-weight:700;letter-spacing:.12em;
                                     color:rgba(255,255,255,.4);text-transform:uppercase;">
                                Pesan Sekarang
                            </span>
                        </div>

                        {{-- Divider --}}
                        <div style="height:1px;background:rgba(255,255,255,.1);margin-bottom:18px;"></div>

                        {{-- Mobile form --}}
                        <form id="dashboardDateFormMobile">

                            {{-- Tanggal Mulai --}}
                            <div style="position:relative;
                                    background:rgba(255,255,255,.08);
                                    border:1px solid rgba(255,255,255,.15);
                                    border-radius:14px;
                                    padding:12px 14px;
                                    cursor:pointer;
                                    transition:background .2s,border-color .2s;
                                    margin-bottom:12px;"
                                onmouseenter="this.style.background='rgba(255,255,255,.13)';this.style.borderColor='rgba(255,255,255,.25)'"
                                onmouseleave="this.style.background='rgba(255,255,255,.08)';this.style.borderColor='rgba(255,255,255,.15)'"
                                onclick="document.getElementById('dashboardStartDateTimeMobile').showPicker?.() || document.getElementById('dashboardStartDateTimeMobile').click()">
                                <span
                                    style="display:block;font-size:9px;font-weight:700;
                                         letter-spacing:.14em;text-transform:uppercase;
                                         color:rgba(255,255,255,.4);margin-bottom:6px;">
                                    Tanggal & Waktu Mulai
                                </span>
                                <input type="datetime-local" id="dashboardStartDateTimeMobile"
                                    style="position:absolute;inset:0;width:100%;height:100%;
                                          opacity:0;cursor:pointer;z-index:10;"
                                    required>
                                <div style="pointer-events:none;">
                                    <p id="startDateLineMobile"
                                        style="font-size:14px;font-weight:700;
                                          color:rgba(255,255,255,.95);
                                          margin:0;line-height:1.3;">
                                        —</p>
                                </div>
                            </div>

                            {{-- Durasi --}}
                            <div
                                style="background:rgba(255,255,255,.08);
                                    border:1px solid rgba(255,255,255,.15);
                                    border-radius:14px;
                                    padding:12px 14px;
                                    margin-bottom:12px;">
                                <span
                                    style="display:block;font-size:9px;font-weight:700;
                                         letter-spacing:.14em;text-transform:uppercase;
                                         color:rgba(255,255,255,.4);margin-bottom:6px;">
                                    Durasi Sewa
                                </span>
                                <select id="dashboardDaysMobile"
                                    style="-webkit-appearance:none;appearance:none;
                                           background:transparent;border:none;outline:none;
                                           color:rgba(255,255,255,.95);font-size:14px;font-weight:700;
                                           width:100%;cursor:pointer;
                                           font-family:'DM Sans',sans-serif;">
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" style="background:#1e2a3a;color:#fff;">
                                            {{ $i }} Hari</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Selesai Summary --}}
                            <div
                                style="background:rgba(245,158,11,.12);
                                    border:1px solid rgba(245,158,11,.3);
                                    border-radius:14px;
                                    padding:12px 14px;
                                    margin-bottom:16px;">
                                <span
                                    style="display:block;font-size:9px;font-weight:700;
                                         letter-spacing:.14em;text-transform:uppercase;
                                         color:rgba(245,158,11,.5);margin-bottom:4px;">
                                    Waktu Selesai
                                </span>
                                <p id="dashboardEndDateDisplayMobile"
                                    style="font-size:13px;font-weight:700;
                                      color:#fbbf24;margin:0;">
                                    —
                                </p>
                            </div>

                            {{-- Cari button --}}
                            <button type="submit"
                                style="width:100%;
                                       background:linear-gradient(135deg,#f59e0b 0%,#d97706 100%);
                                       border:none;border-radius:14px;
                                       padding:13px 16px;
                                       color:#fff;font-weight:700;font-size:13px;
                                       letter-spacing:.08em;text-transform:uppercase;
                                       cursor:pointer;
                                       display:flex;align-items:center;justify-content:center;gap:8px;
                                       font-family:'DM Sans',sans-serif;
                                       box-shadow:0 4px 16px rgba(245,158,11,.4);
                                       transition:filter .2s,transform .15s;"
                                onmouseenter="this.style.filter='brightness(1.1)';this.style.transform='translateY(-2px)'"
                                onmouseleave="this.style.filter='brightness(1)';this.style.transform='translateY(0)'"
                                onmousedown="this.style.transform='scale(.98)'"
                                onmouseup="this.style.transform='translateY(-2px)'">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="9" cy="9" r="7" />
                                    <path d="M16 16l-3.5-3.5" />
                                </svg>
                                Cari Kendaraan
                            </button>

                        </form>
                    </div>
                </div>

            </div>

        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-7 left-1/2 -translate-x-1/2 z-10"
            style="display:flex;flex-direction:column;align-items:center;gap:6px;">
            <div class="scroll-line"></div>
            <span
                style="font-size:.58rem;letter-spacing:.18em;color:rgba(255,255,255,.25);
                     text-transform:uppercase;font-weight:600;font-family:'DM Sans',sans-serif;">
                Scroll
            </span>
        </div>

    </header>

    {{-- ── Hero JS ── --}}
    <script>
        (function() {
            /* ── Responsive Header Control via JS (Inline styles dengan priority) ── */
            function updateHeaderVisibility() {
                var desktop = document.querySelector('.header-desktop');
                var mobile = document.querySelector('.header-mobile');
                var isMobile = window.innerWidth < 1024;

                if (isMobile) {
                    desktop.style.setProperty('display', 'none', 'important');
                    desktop.style.setProperty('visibility', 'hidden', 'important');
                    desktop.style.setProperty('height', '0', 'important');
                    desktop.style.setProperty('overflow', 'hidden', 'important');

                    mobile.style.setProperty('display', 'grid', 'important');
                    mobile.style.setProperty('visibility', 'visible', 'important');
                    mobile.style.setProperty('height', 'auto', 'important');
                } else {
                    desktop.style.setProperty('display', 'grid', 'important');
                    desktop.style.setProperty('visibility', 'visible', 'important');
                    desktop.style.setProperty('height', 'auto', 'important');
                    desktop.style.removeProperty('overflow');

                    mobile.style.setProperty('display', 'none', 'important');
                    mobile.style.setProperty('visibility', 'hidden', 'important');
                    mobile.style.setProperty('height', '0', 'important');
                    mobile.style.setProperty('overflow', 'hidden', 'important');
                }
            }

            updateHeaderVisibility();
            window.addEventListener('resize', updateHeaderVisibility);

            /* ── Tab switching ── */
            window.switchHeroTab = function(tab) {
                var isLK = tab === 'lepas-kunci';
                document.getElementById('tab-lepas-kunci').style.display = isLK ? 'block' : 'none';
                document.getElementById('tab-carter').style.display = isLK ? 'none' : 'block';
                var btnLK = document.getElementById('btn-lepas-kunci');
                var btnCT = document.getElementById('btn-carter');
                if (isLK) {
                    btnLK.style.cssText =
                        'padding:8px 20px;border-radius:10px;font-size:13px;font-weight:700;border:none;cursor:pointer;font-family:\'DM Sans\',sans-serif;background:linear-gradient(135deg,#f59e0b,#d97706);color:#1a1200;box-shadow:0 2px 12px rgba(245,158,11,.35);transition:all .2s;';
                    btnCT.style.cssText =
                        'padding:8px 20px;border-radius:10px;font-size:13px;font-weight:700;border:none;cursor:pointer;font-family:\'DM Sans\',sans-serif;background:transparent;color:rgb(100,116,139);transition:all .2s;';
                } else {
                    btnCT.style.cssText =
                        'padding:8px 20px;border-radius:10px;font-size:13px;font-weight:700;border:none;cursor:pointer;font-family:\'DM Sans\',sans-serif;background:linear-gradient(135deg,#f59e0b,#d97706);color:#1a1200;box-shadow:0 2px 12px rgba(245,158,11,.35);transition:all .2s;';
                    btnLK.style.cssText =
                        'padding:8px 20px;border-radius:10px;font-size:13px;font-weight:700;border:none;cursor:pointer;font-family:\'DM Sans\',sans-serif;background:transparent;color:rgb(100,116,139);transition:all .2s;';
                }
            };

            /* ── Helpers ── */
            function pad(v) {
                return String(v).padStart(2, '0');
            }
            var DAYS = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            function fmtStartDate(d) {
                return DAYS[d.getDay()] + ', ' + pad(d.getDate()) + ' ' + MONTHS[d.getMonth()];
            }

            function fmtStartTime(d) {
                return pad(d.getHours()) + ':' + pad(d.getMinutes());
            }

            function fmtEndDate(d) {
                return pad(d.getDate()) + ' ' + MONTHS[d.getMonth()] + ' ' + d.getFullYear() + ', ' + pad(d
                .getHours()) + ':' + pad(d.getMinutes());
            }

            var startInput = document.getElementById('dashboardStartDateTime');
            var startDateEl = document.getElementById('startDateLine');
            var startTimeEl = document.getElementById('startTimeLine');
            var daysInput = document.getElementById('dashboardDays');
            var endDisplay = document.getElementById('dashboardEndDateDisplay');

            function updateStart() {
                if (!startInput.value) {
                    startDateEl.textContent = '—';
                    startTimeEl.textContent = '—';
                    return;
                }
                var d = new Date(startInput.value);
                startDateEl.textContent = fmtStartDate(d);
                startTimeEl.textContent = fmtStartTime(d);
            }

            function calcEnd() {
                if (!startInput.value || !daysInput.value) {
                    endDisplay.textContent = '—';
                    return;
                }
                var end = new Date(startInput.value);
                end.setDate(end.getDate() + parseInt(daysInput.value));
                endDisplay.textContent = fmtEndDate(end);
            }

            function setDefaults() {
                var n = new Date();
                startInput.value = n.getFullYear() + '-' + pad(n.getMonth() + 1) + '-' + pad(n.getDate()) + 'T09:00';
                daysInput.value = '1';
                updateStart();
                calcEnd();
            }

            setDefaults();
            startInput.addEventListener('change', function() {
                updateStart();
                calcEnd();
            });
            daysInput.addEventListener('change', calcEnd);

            /* ── Form submit ── */
            document.getElementById('dashboardDateForm').addEventListener('submit', function(e) {
                e.preventDefault();
                var start = new Date(startInput.value);
                var days = parseInt(daysInput.value);
                var end = new Date(start);
                end.setDate(end.getDate() + days);
                var fD = function(d) {
                    return d.toISOString().split('T')[0];
                };
                var fT = function(d) {
                    return pad(d.getHours()) + ':' + pad(d.getMinutes());
                };
                window.location.href = '/bookings/select-car' +
                    '?start_date=' + fD(start) +
                    '&start_time=' + fT(start) +
                    '&end_date=' + fD(end) +
                    '&end_time=' + fT(end);
            });

            /* ── Scroll reveal ── */
            var io = new IntersectionObserver(function(entries) {
                entries.forEach(function(e) {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        io.unobserve(e.target);
                    }
                });
            }, {
                threshold: .12
            });
            document.querySelectorAll('.reveal').forEach(function(el) {
                io.observe(el);
            });

            /* ── Mobile Form Handler ── */
            var mobileStartInput = document.getElementById('dashboardStartDateTimeMobile');
            var mobileStartDateEl = document.getElementById('startDateLineMobile');
            var mobileDaysInput = document.getElementById('dashboardDaysMobile');
            var mobileEndDisplay = document.getElementById('dashboardEndDateDisplayMobile');

            if (mobileStartInput) {
                function updateStartMobile() {
                    if (!mobileStartInput.value) {
                        mobileStartDateEl.textContent = '—';
                        return;
                    }
                    var d = new Date(mobileStartInput.value);
                    mobileStartDateEl.textContent = fmtStartDate(d) + ' ' + fmtStartTime(d);
                }

                function calcEndMobile() {
                    if (!mobileStartInput.value || !mobileDaysInput.value) {
                        mobileEndDisplay.textContent = '—';
                        return;
                    }
                    var end = new Date(mobileStartInput.value);
                    end.setDate(end.getDate() + parseInt(mobileDaysInput.value));
                    mobileEndDisplay.textContent = fmtEndDate(end);
                }

                function setDefaultsMobile() {
                    var n = new Date();
                    mobileStartInput.value = n.getFullYear() + '-' + pad(n.getMonth() + 1) + '-' + pad(n.getDate()) +
                        'T09:00';
                    mobileDaysInput.value = '1';
                    updateStartMobile();
                    calcEndMobile();
                }

                setDefaultsMobile();
                mobileStartInput.addEventListener('change', function() {
                    updateStartMobile();
                    calcEndMobile();
                });
                mobileDaysInput.addEventListener('change', calcEndMobile);

                /* ── Mobile Form submit ── */
                document.getElementById('dashboardDateFormMobile').addEventListener('submit', function(e) {
                    e.preventDefault();
                    var start = new Date(mobileStartInput.value);
                    var days = parseInt(mobileDaysInput.value);
                    var end = new Date(start);
                    end.setDate(end.getDate() + days);
                    var fD = function(d) {
                        return d.toISOString().split('T')[0];
                    };
                    var fT = function(d) {
                        return pad(d.getHours()) + ':' + pad(d.getMinutes());
                    };
                    window.location.href = '/bookings/select-car' +
                        '?start_date=' + fD(start) +
                        '&start_time=' + fT(start) +
                        '&end_date=' + fD(end) +
                        '&end_time=' + fT(end);
                });
            }
        })();

        /* ── Navigate to cars by category ── */
        window.navigateToCategory = function(categoryType) {
            var categoryMap = {
                'passenger': 'all', // Shows all passenger vehicles: City Car, Sedan, MPV
                'bus': 'Bus',
                'offroad': 'SUV (tangguh/medan berat)',
                'commercial': 'Komersial'
            };

            var dbCategory = categoryMap[categoryType] || 'all';
            window.location.href = '/cars?category=' + encodeURIComponent(dbCategory);
        };
    </script>


    {{-- ================================================================ --}}
    {{-- 2. MENGAPA SQUAD TRANS?                                            --}}
    {{-- ================================================================ --}}
    <section class="pg py-20 bg-white" id="mengapa">
        <div class="max-w-6xl mx-auto px-5 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="reveal">
                    <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-3 block">Tentang
                        Kami</span>
                    <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 mb-5 leading-tight">
                        Mengapa Memilih<br>Squad Trans?
                    </h2>
                    <p class="text-slate-500 leading-relaxed mb-6">
                        Sebagai penyedia transportasi terpercaya, Squad Trans memberikan berbagai solusi mobilitas
                        yang aman dan nyaman dengan pilihan kendaraan yang lengkap, reservasi yang mudah,
                        pengelolaan armada yang efisien, serta layanan pelanggan yang andal.
                    </p>
                    <a href="tentang"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-yellow-600 hover:text-yellow-700 transition">
                        Tentang Kami
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 10h12M12 5l5 5-5 5" />
                        </svg>
                    </a>
                </div>
                <div class="reveal" style="transition-delay:.15s;">
                    <div class="rounded-2xl overflow-hidden shadow-xl" style="aspect-ratio:4/3;background:#e2e8f0;">
                        <img src="{{ asset('images/poster.png') }}" alt="Squad Trans" class="w-full object-cover">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
                @php
                    $features = [
                        [
                            'icon' =>
                                'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                            'title' => 'Akses Mudah & Jaringan Luas',
                            'desc' =>
                                'Reservasi kendaraan mudah melalui berbagai channel online dan offline pada jaringan kami yang tersebar di seluruh Indonesia.',
                        ],
                        [
                            'icon' =>
                                'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'title' => 'Layanan Terbaik & Proteksi',
                            'desc' =>
                                'Pengemudi bersertifikat, proteksi untuk seluruh unit kendaraan, dan protokol kesehatan ketat di setiap layanannya.',
                        ],
                        [
                            'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                            'title' => 'Teknologi Terpercaya',
                            'desc' =>
                                'Terhubung dengan teknologi yang memastikan ribuan kendaraan beroperasi secara efisien dan real-time.',
                        ],
                        [
                            'icon' =>
                                'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                            'title' => 'Layanan Pelanggan 24/7',
                            'desc' =>
                                'Tim kami siap melayani setiap hari selama 24 jam melalui aplikasi dan Customer Assistance Center.',
                        ],
                    ];
                @endphp
                @foreach ($features as $i => $f)
                    <div class="why-card reveal p-6 rounded-2xl border border-slate-100 hover:border-yellow-200 hover:shadow-lg transition-all duration-300"
                        style="transition-delay:{{ $i * 0.1 }}s;">
                        <div class="why-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4"
                            style="background:#fef9ee;color:#d97706;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="{{ $f['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="hf text-sm text-slate-800 mb-2 leading-snug" style="font-weight:700;">
                            {{ $f['title'] }}</h3>
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
                    <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-2 block">Pilihan
                        Kendaraan</span>
                    <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">
                        Semua Kendaraan untuk<br>Semua Perjalanan Anda
                    </h2>
                </div>
                <a href="/cars"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-yellow-600 hover:text-yellow-700 transition whitespace-nowrap">
                    Lihat Semua Armada
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 10h12M12 5l5 5-5 5" />
                    </svg>
                </a>
            </div>

            @php
                $categories = [
                    [
                        'label' => 'Transportasi Reguler',
                        'image' => 'mobil.png',
                        'desc' => 'Pilihan kendaraan harian yang nyaman untuk keluarga dan perjalanan pribadi',
                        'type' => 'passenger',
                    ],
                    [
                        'label' => 'Bus Pariwisata',
                        'image' => 'bus.png',
                        'desc' => 'Armada bus berkapasitas besar, ideal untuk rombongan dan perjalanan wisata',
                        'type' => 'bus',
                    ],
                    [
                        'label' => 'Mobil Executive ⭐',
                        'image' => 'executive.png',
                        'desc' => 'Kendaraan premium untuk perjalanan bisnis dan layanan VIP yang lebih eksklusif',
                        'type' => 'offroad',
                    ],
                    [
                        'label' => 'Transportasi Komersial',
                        'image' => 'truk.png',
                        'desc' => 'Solusi kendaraan untuk kebutuhan bisnis, logistik, dan operasional perusahaan',
                        'type' => 'commercial',
                    ],
                ];
            @endphp
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($categories as $i => $cat)
                    <div class="fleet-item reveal bg-white rounded-2xl p-5 border border-slate-100
                        hover:border-yellow-300 cursor-pointer group"
                        style="transition-delay:{{ $i * 0.08 }}s;"
                        onclick="navigateToCategory('{{ $cat['type'] }}')">
                        <div class="w-full h-32 flex items-center justify-center rounded-xl mb-4 overflow-hidden"
                            style="background:#fef9ee;">
                            <img src="{{ asset('images/' . $cat['image']) }}" alt="{{ $cat['label'] }}"
                                style="width:100%;height:100%;object-fit:contain;">
                        </div>
                        <h3 class="hf text-sm font-bold text-slate-800 mb-1">{{ $cat['label'] }}</h3>
                        <p class="text-xs text-slate-400 leading-snug mb-3">{{ $cat['desc'] }}</p>
                        <span
                            class="inline-flex items-center gap-1 text-xs font-semibold text-yellow-600 group-hover:gap-2 transition-all">
                            Lihat
                            <svg width="12" height="12" viewBox="0 0 20 20" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 10h12M12 5l5 5-5 5" />
                            </svg>
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
                <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-2 block">Pencapaian
                    Kami</span>
                <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">
                    Memberikan Layanan<br>Transportasi Terbaik
                </h2>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $stats = [
                        ['num' => '50+', 'label' => 'Unit Armada', 'sub' => 'Siap beroperasi'],
                        ['num' => '15K+', 'label' => 'Pelanggan Puas', 'sub' => 'Setiap tahunnya'],
                        ['num' => '24/7', 'label' => 'Layanan Aktif', 'sub' => 'Tidak pernah berhenti'],
                        ['num' => '4,7★', 'label' => 'Rating Rata-rata', 'sub' => 'Dari ribuan ulasan'],
                    ];
                @endphp
                @foreach ($stats as $i => $s)
                    <div class="reveal text-center p-6 rounded-2xl"
                        style="background:#fef9ee;transition-delay:{{ $i * 0.1 }}s;">
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
                    <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-2 block">Kepuasan
                        Pelanggan</span>
                    <h2 class="hf text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">
                        Ulasan Dari<br>Pelanggan Kami
                    </h2>
                </div>
                @auth
                    <button onclick="document.getElementById('reviewDialog').showModal()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold
                           text-yellow-600 border-2 border-yellow-500 rounded-full
                           hover:bg-yellow-500 hover:text-white transition whitespace-nowrap">
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Tambah Ulasan
                    </button>
                @endauth
                @guest
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold
                      bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition whitespace-nowrap">
                        Tambah Ulasan
                    </a>
                @endguest
            </div>

            @php
                $reviews = App\Models\Review::with('booking.car', 'booking.user')
                    ->orderBy('created_at', 'desc')
                    ->limit(8)
                    ->get();
            @endphp

            @if ($reviews->count() > 0)
                <div class="reviews-carousel owl-carousel owl-theme">
                    @foreach ($reviews as $review)
                        <div
                            class="item bg-white rounded-2xl overflow-hidden border border-slate-100
                        shadow hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                            @if ($review->image_path)
                                <img src="{{ asset('storage/' . $review->image_path) }}" alt="Review"
                                    class="w-full h-44 object-cover">
                            @elseif($review->booking->car->images->first())
                                <img src="{{ asset('storage/' . $review->booking->car->images->first()->image_path) }}"
                                    alt="{{ $review->booking->car->brand }}" class="w-full h-44 object-cover">
                            @else
                                <div class="w-full h-44 flex items-center justify-center" style="background:#fef9ee;">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                        stroke="#f59e0b" stroke-width="1.5">
                                        <path
                                            d="M19 17H5m14 0a2 2 0 002-2v-4a2 2 0 00-2-2h-1.172a2 2 0 01-1.414-.586L14 6.586A2 2 0 0012.586 6H6a2 2 0 00-2 2v7a2 2 0 002 2m13 0v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2" />
                                    </svg>
                                </div>
                            @endif
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center gap-0.5 mb-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-sm text-slate-500 leading-relaxed flex-1 line-clamp-3 mb-4">
                                    "{{ $review->comment ?? 'Pelanggan puas dengan layanan kami.' }}"
                                </p>
                                <div class="flex items-center gap-3 border-t border-slate-100 pt-4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                        style="background:#fef9ee;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="#d97706" stroke-width="1.8">
                                            <path
                                                d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-slate-800 truncate">
                                            {{ $review->booking->user->name ?? 'Pelanggan' }}
                                        </p>
                                        <p class="text-xs text-slate-400 truncate">
                                            {{ $review->booking->car->brand ?? '' }}
                                            {{ $review->booking->car->name ?? '' }}
                                        </p>
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
                        <button onclick="document.getElementById('reviewDialog').showModal()"
                            class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-yellow-600
                           border-2 border-yellow-500 rounded-full hover:bg-yellow-500 hover:text-white transition">
                            Tambah Ulasan
                        </button>
                    @endauth
                </div>
            @endif
        </div>
    </section>


    {{-- ================================================================ --}}
    {{-- 6. CTA APP DOWNLOAD                                               --}}
    {{-- ================================================================ --}}
    <section class="pg py-16 relative overflow-hidden"
        style="background:linear-gradient(135deg,#f59e0b 0%,#d97706 100%);">
        <div class="absolute inset-0 opacity-10"
            style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);
                background-size:36px 36px;">
        </div>
        <div class="relative max-w-6xl mx-auto px-5 sm:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-10">


                {{-- Teks CTA --}}
                <div class="reveal text-white" style="transition-delay:.15s;">
                    <p class="text-xs font-bold uppercase tracking-widest mb-3 opacity-80">Butuh Armada Sekarang?</p>
                    <h2 class="hf text-3xl sm:text-4xl font-bold mb-4 leading-tight">
                        Bisnis atau Liburan,<br>Kami Siap Antarkan<br>ke Mana Saja
                    </h2>
                    <p class="text-base opacity-80 mb-1">Sewa Mobil, Bus atau Airport Transfer — Pesan Langsung via
                        WhatsApp</p>
                    <p class="text-sm font-semibold mb-7 opacity-90">#SquadTransDiSetiapOdometer</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://wa.me/+6281233283578?text=Halo, saya ingin memesan kendaraan Squad Trans"
                            class="app-badge inline-flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold"
                            style="background:rgba(0,0,0,.85);color:#fff;text-decoration:none;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                <path
                                    d="M12 0C5.373 0 0 5.373 0 12c0 2.124.554 4.118 1.528 5.845L.057 23.03a.75.75 0 0 0 .914.913l5.188-1.47A11.95 11.95 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.95 9.95 0 0 1-5.07-1.384l-.363-.214-3.761 1.065 1.065-3.762-.213-.363A9.95 9.95 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                            </svg>
                            Chat WhatsApp
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================================================================ --}}
    {{-- REVIEW MODAL                                                       --}}
    {{-- ================================================================ --}}
    <dialog id="reviewDialog"
        style="border:none;padding:0;border-radius:1.5rem;width:90%;max-width:42rem;
               max-height:90vh;overflow-y:auto;box-shadow:0 25px 60px rgba(0,0,0,.3);">
        <div style="padding:2rem;position:relative;">
            <button onclick="document.getElementById('reviewDialog').close()"
                style="position:absolute;top:.75rem;right:1rem;background:none;border:none;
                       font-size:1.5rem;color:#94a3b8;cursor:pointer;line-height:1;">✕</button>
            <h2 class="hf text-2xl font-bold mb-1 text-slate-900">Tambahkan Ulasan</h2>
            <p class="text-slate-400 text-sm mb-6">Bagikan pengalaman Anda bersama kami</p>
            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data"
                style="display:flex;flex-direction:column;gap:1.1rem;">
                @csrf
                <div>
                    <label class="text-sm font-semibold mb-1.5 block text-slate-700">Pilih Pemesanan</label>
                    <select name="booking_id" required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm outline-none bg-white"
                        style="font-family:'DM Sans',sans-serif;">
                        <option value="">-- Pilih --</option>
                        @foreach ($bookings as $booking)
                            <option value="{{ $booking->id }}">
                                {{ $booking->car->brand }} {{ $booking->car->name }} ({{ $booking->booking_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold mb-1.5 block text-slate-700">Rating</label>
                    <input type="number" name="rating" min="1" max="5" required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm outline-none"
                        placeholder="Nilai 1 - 5">
                </div>
                <div>
                    <label class="text-sm font-semibold mb-1.5 block text-slate-700">Komentar</label>
                    <textarea name="comment" rows="4"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm outline-none resize-none"
                        placeholder="Tulis pengalaman kamu..."></textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold mb-1.5 block text-slate-700">Foto (opsional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0
                              file:font-semibold file:bg-yellow-50 file:text-yellow-700
                              hover:file:bg-yellow-100">
                </div>
                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="document.getElementById('reviewDialog').close()"
                        class="flex-1 py-3 font-semibold rounded-xl text-sm transition"
                        style="background:#f1f5f9;color:#475569;border:none;cursor:pointer;
                               font-family:'DM Sans',sans-serif;">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 py-3 font-semibold rounded-xl text-sm text-white transition"
                        style="background:linear-gradient(135deg,#f59e0b,#d97706);border:none;
                               cursor:pointer;font-family:'DM Sans',sans-serif;">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </dialog>


    {{-- ================================================================ --}}
    {{-- GLOBAL JS                                                          --}}
    {{-- ================================================================ --}}
    <script>
        /* ── Close dialog on backdrop click ── */
        document.getElementById('reviewDialog')?.addEventListener('click', function(e) {
            var r = this.getBoundingClientRect();
            if (e.clientX < r.left || e.clientX > r.right || e.clientY < r.top || e.clientY > r.bottom) this
        .close();
        });
    </script>

</x-app-layout>
