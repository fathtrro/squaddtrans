<x-app-layout>
<style>
    /* ── Font combo: Poppins (body/heading) + Playfair Display italic (aksen) ── */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Playfair+Display:ital,wght@1,500;1,600;1,700&display=swap');

    /* ── Playfair italic accent (semua teks kuning di heading) ── */
    .tn h1 em, .tn h2 em, .tn h3 em {
        font-family: 'Playfair Display', Georgia, serif;
        font-style: italic;
        font-weight: 600;
        letter-spacing: -0.3px;
    }


    .tn { font-family: 'Poppins', sans-serif; background: #f9f8f5; color: #1a1a1a; }
    .tn * { box-sizing: border-box; margin: 0; padding: 0; }
    .tn-wrap { max-width: 1160px; margin: 0 auto; padding: 0 28px; }

    /* ══════════════════════════════
       HERO
    ══════════════════════════════ */
    .tn-hero {
        background: #111;
        padding-top: 100px;
        position: relative;
        overflow: hidden;
    }
    .tn-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; right: -80px;
        width: 560px; height: 560px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(234,179,8,.14) 0%, transparent 65%);
        pointer-events: none;
    }

    .tn-hero-inner {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 56px;
        align-items: end;
        padding: 64px 0 0;
        position: relative; z-index: 1;
    }

    .tn-label {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 11px; font-weight: 600; letter-spacing: 2.5px;
        text-transform: uppercase; color: #eab308;
        margin-bottom: 18px;
    }
    .tn-label::before { content:''; width:28px; height:2px; background:#eab308; border-radius:2px; }

    .tn-hero-title {
        font-size: clamp(36px, 5.5vw, 64px);
        font-weight: 800;
        color: #ffffff;
        line-height: 1.1;
        letter-spacing: -1px;
        margin-bottom: 20px;
    }
    .tn-hero-title em {
        color: #eab308;
        display: block;
        font-family: 'Playfair Display', Georgia, serif;
        font-style: italic;
        font-weight: 600;
    }

    .tn-hero-desc {
        font-size: 15px;
        color: rgba(255,255,255,0.55);
        line-height: 1.8;
        font-weight: 300;
        max-width: 480px;
    }

    /* aside card */
    .tn-aside-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 28px;
        align-self: end;
        margin-bottom: 0;
    }
    .tn-aside-year {
        font-size: 64px; font-weight: 800;
        color: rgba(255,255,255,0.08);
        line-height: 1; letter-spacing: -3px;
        margin-bottom: 12px;
    }
    .tn-aside-head {
        font-size: 16px; font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
    }
    .tn-aside-text {
        font-size: 13px; color: rgba(255,255,255,0.45);
        line-height: 1.7; font-weight: 300;
    }

    /* stats bar */
    .tn-stats-bar {
        border-top: 1px solid rgba(255,255,255,0.08);
        margin-top: 56px;
        position: relative; z-index: 1;
    }
    .tn-stats-grid {
        display: grid;
        grid-template-columns: repeat(4,1fr);
    }
    .tn-stat {
        padding: 28px 0 28px 32px;
        border-right: 1px solid rgba(255,255,255,0.08);
    }
    .tn-stat:first-child { padding-left: 0; }
    .tn-stat:last-child { border-right: none; }
    .tn-stat-num {
        font-size: 36px; font-weight: 800;
        color: #ffffff; line-height: 1;
        margin-bottom: 4px;
    }
    .tn-stat-num em { color: #eab308; font-style: normal; }
    .tn-stat-label { font-size: 12px; color: rgba(255,255,255,0.35); font-weight: 400; }

    /* ══════════════════════════════
       MARQUEE
    ══════════════════════════════ */
    .tn-marquee { background: #eab308; overflow: hidden; padding: 12px 0; }
    .tn-marquee-track { display: flex; animation: mq 22s linear infinite; width: max-content; }
    .tn-marquee-item {
        font-size: 11px; font-weight: 700; letter-spacing: 2px;
        text-transform: uppercase; color: #111;
        padding: 0 28px; white-space: nowrap;
        display: flex; align-items: center; gap: 14px;
    }
    .tn-marquee-item::after { content: '✦'; font-size: 7px; opacity: .4; }
    @keyframes mq { from{transform:translateX(0)} to{transform:translateX(-50%)} }

    /* ══════════════════════════════
       GENERIC SECTION
    ══════════════════════════════ */
    .tn-section { padding: 80px 0; }
    .tn-section-alt { background: #f1ede4; }

    .tn-sec-tag {
        font-size: 10px; font-weight: 700; letter-spacing: 2.5px;
        text-transform: uppercase; color: #ca8a04;
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 10px;
    }
    .tn-sec-tag::before { content:''; width:18px; height:1.5px; background:#ca8a04; }

    .tn-sec-title {
        font-size: clamp(26px, 3.5vw, 40px);
        font-weight: 800; color: #1a1a1a;
        line-height: 1.15; letter-spacing: -0.5px;
    }
    .tn-sec-title em { font-style: italic; font-weight: 600; color: #ca8a04; }

    /* ══════════════════════════════
       CERITA
    ══════════════════════════════ */
    .tn-story {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 72px; align-items: center;
    }
    .tn-story-text p {
        font-size: 14.5px; line-height: 1.9;
        color: #4a4a4a; font-weight: 300;
        margin-bottom: 16px;
    }
    .tn-story-text p:last-child { margin-bottom: 0; }
    .tn-story-text strong { color: #1a1a1a; font-weight: 600; }

    .tn-story-visual { position: relative; }
    .tn-story-img {
        width: 100%; aspect-ratio: 4/5;
        background: linear-gradient(145deg, #e8e0d0, #d4c9b4);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 80px; font-weight: 800;
        color: rgba(255,255,255,0.5);
        letter-spacing: -4px;
        overflow: hidden; position: relative;
    }
    .tn-story-img::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(145deg, rgba(234,179,8,.1) 0%, transparent 60%);
    }
    .tn-float-card {
        position: absolute; bottom: -20px; left: -20px;
        background: #111; border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 16px 40px rgba(0,0,0,.2);
        min-width: 160px;
    }
    .tn-float-num { font-size: 38px; font-weight: 800; color: #eab308; line-height: 1; }
    .tn-float-label { font-size: 11.5px; color: rgba(255,255,255,.5); margin-top: 4px; }

    /* ══════════════════════════════
       VISI MISI
    ══════════════════════════════ */
    .tn-vm-grid {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 20px; margin-top: 40px;
    }
    .tn-vm-card {
        background: #fff;
        border-radius: 20px;
        padding: 36px;
        border: 1px solid #ece8de;
        position: relative; overflow: hidden;
        transition: transform .2s, box-shadow .2s;
    }
    .tn-vm-card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,.08); }
    .tn-vm-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #eab308, #f97316);
    }
    .tn-vm-letter {
        position: absolute; top: 12px; right: 24px;
        font-size: 96px; font-weight: 800;
        color: #f5f1e8; line-height: 1;
        pointer-events: none;
        transition: color .2s;
    }
    .tn-vm-card:hover .tn-vm-letter { color: #fef3c7; }
    .tn-vm-icon {
        width: 44px; height: 44px;
        background: #fef9c3; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: #ca8a04; margin-bottom: 16px;
    }
    .tn-vm-card h3 {
        font-size: 20px; font-weight: 700;
        color: #1a1a1a; margin-bottom: 12px;
    }
    .tn-vm-card p {
        font-size: 13.5px; color: #555;
        line-height: 1.8; font-weight: 300;
    }

    /* ══════════════════════════════
       KEUNGGULAN — BENTO
    ══════════════════════════════ */
    .tn-bento {
        display: grid;
        grid-template-columns: 280px 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        gap: 14px;
        margin-top: 40px;
    }
    .tn-bento-item {
        background: #fff;
        border-radius: 18px;
        padding: 26px;
        border: 1px solid #ece8de;
        transition: all .2s;
    }
    .tn-bento-item:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
        transform: translateY(-2px);
    }
    .tn-bento-item.dark {
        background: #111; border-color: transparent;
        grid-row: span 2;
        display: flex; flex-direction: column; justify-content: space-between;
    }
    .tn-bento-item.dark .tn-bento-icon { background: rgba(234,179,8,.15); color: #eab308; }
    .tn-bento-item.dark .tn-bento-h { color: #fff; }
    .tn-bento-item.dark .tn-bento-p { color: rgba(255,255,255,.45); }
    .tn-bento-big { font-size: 80px; font-weight: 800; color: rgba(234,179,8,.15); line-height: 1; text-align: right; }

    .tn-bento-icon {
        width: 40px; height: 40px;
        border-radius: 11px; background: #f5f1e8;
        display: flex; align-items: center; justify-content: center;
        color: #ca8a04; margin-bottom: 14px;
    }
    .tn-bento-h { font-size: 14px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
    .tn-bento-p { font-size: 12.5px; color: #666; line-height: 1.7; font-weight: 300; }

    /* ══════════════════════════════
       TIMELINE
    ══════════════════════════════ */
    .tn-tl-grid {
        display: grid;
        grid-template-columns: 1fr 2px 1fr;
        gap: 0 48px;
        margin-top: 52px;
    }
    .tn-tl-bar { background: linear-gradient(180deg, #eab308, transparent); border-radius: 2px; }
    .tn-tl-col { display: flex; flex-direction: column; gap: 20px; }
    .tn-tl-col.right { padding-top: 72px; }

    .tn-tl-card {
        background: #fff;
        border: 1px solid #ece8de;
        border-radius: 16px;
        padding: 22px 24px;
        position: relative;
        transition: all .2s;
    }
    .tn-tl-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.07); transform: translateY(-2px); }
    .tn-tl-card.current {
        background: #111; border-color: transparent;
    }
    .tn-tl-card.current .tn-tl-year { color: #fbbf24; }
    .tn-tl-card.current .tn-tl-title { color: #fff; }
    .tn-tl-card.current .tn-tl-desc { color: rgba(255,255,255,.45); }
    .tn-tl-card.current::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg,#eab308,#f97316);
        border-radius: 16px 16px 0 0;
    }

    /* dot on timeline */
    .tn-tl-col .tn-tl-card::after {
        content: '';
        position: absolute; top: 24px;
        width: 10px; height: 10px;
        border-radius: 50%; background: #eab308;
        box-shadow: 0 0 0 4px #fef9c3;
    }
    .tn-tl-col:not(.right) .tn-tl-card::after { right: -53px; }
    .tn-tl-col.right .tn-tl-card::after { left: -53px; }

    .tn-tl-year { font-size: 10.5px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #ca8a04; margin-bottom: 5px; }
    .tn-tl-title { font-size: 15px; font-weight: 700; color: #1a1a1a; margin-bottom: 5px; }
    .tn-tl-desc { font-size: 12.5px; color: #666; line-height: 1.7; font-weight: 300; }

    /* ══════════════════════════════
       MITRA
    ══════════════════════════════ */
    .tn-mitra-row { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 28px; }
    .tn-mitra-badge {
        padding: 9px 20px;
        background: #fff; border: 1.5px solid #e5e0d5;
        border-radius: 50px; font-size: 13px;
        font-weight: 600; color: #444;
        transition: all .15s;
    }
    .tn-mitra-badge:hover { border-color: #eab308; color: #ca8a04; background: #fefce8; }

    /* ══════════════════════════════
       CTA
    ══════════════════════════════ */
    .tn-cta { padding: 80px 0; }
    .tn-cta-box {
        background: #111;
        border-radius: 28px;
        padding: 64px 56px;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 48px; align-items: center;
        position: relative; overflow: hidden;
    }
    .tn-cta-box::before {
        content: '';
        position: absolute; top: -100px; right: -80px;
        width: 480px; height: 480px; border-radius: 50%;
        background: radial-gradient(circle, rgba(234,179,8,.12) 0%, transparent 65%);
        pointer-events: none;
    }
    .tn-cta-tag { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #eab308; margin-bottom: 12px; }
    .tn-cta-title { font-size: clamp(26px, 3.5vw, 38px); font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -.5px; }
    .tn-cta-title em { font-style: italic; font-weight: 600; color: #eab308; }
    .tn-cta-sub { font-size: 14px; color: rgba(255,255,255,.4); font-weight: 300; margin-top: 10px; }
    .tn-cta-btns { display: flex; flex-direction: column; gap: 10px; flex-shrink: 0; position: relative; z-index: 1; }
    .tn-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 13px 26px; border-radius: 50px;
        font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 700;
        text-decoration: none; white-space: nowrap; transition: all .2s;
    }
    .tn-btn-amber {
        background: linear-gradient(135deg,#f59e0b,#f97316);
        color: #fff; box-shadow: 0 6px 18px rgba(245,158,11,.4);
    }
    .tn-btn-amber:hover { transform: translateY(-2px); box-shadow: 0 10px 26px rgba(245,158,11,.5); }
    .tn-btn-outline {
        border: 1.5px solid rgba(255,255,255,.2);
        color: rgba(255,255,255,.7); background: transparent;
    }
    .tn-btn-outline:hover { border-color: rgba(255,255,255,.5); color: #fff; }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media(max-width:1023px){
        .tn-hero-inner{grid-template-columns:1fr}
        .tn-story{grid-template-columns:1fr;gap:48px}
        .tn-story-visual{order:-1;max-width:380px}
        .tn-vm-grid{grid-template-columns:1fr}
        .tn-bento{grid-template-columns:1fr 1fr}
        .tn-bento-item.dark{grid-row:span 1}
        .tn-tl-grid{grid-template-columns:1fr;gap:16px}
        .tn-tl-bar{display:none}
        .tn-tl-col.right{padding-top:0}
        .tn-tl-card::after{display:none}
        .tn-cta-box{grid-template-columns:1fr;gap:28px}
        .tn-cta-btns{flex-direction:row}
    }
    @media(max-width:639px){
        .tn-stats-grid{grid-template-columns:1fr 1fr}
        .tn-bento{grid-template-columns:1fr}
        .tn-cta-box{padding:36px 24px}
        .tn-cta-btns{flex-direction:column}
    }

    /* reveal animation */
    .tn-fade { animation: tnFade .5s cubic-bezier(.22,1,.36,1) both; }
    @keyframes tnFade { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:none} }
    .tn-fade:nth-child(1){animation-delay:.05s}
    .tn-fade:nth-child(2){animation-delay:.10s}
    .tn-fade:nth-child(3){animation-delay:.15s}
    .tn-fade:nth-child(4){animation-delay:.20s}
    .tn-fade:nth-child(5){animation-delay:.25s}
    .tn-fade:nth-child(6){animation-delay:.30s}
</style>

<div class="tn">

    {{-- ═══════════ HERO ═══════════ --}}
    <section class="tn-hero">
        <div class="tn-wrap">
            <div class="tn-hero-inner">
                <div>
                    <p class="tn-label">Tentang Kami</p>
                    <h1 class="tn-hero-title">
                        Menggerakkan
                        <em>Setiap Perjalanan</em>
                        Indonesia
                    </h1>
                    <p class="tn-hero-desc">
                        Sejak 2018, SquadTrans hadir dengan satu misi — membuat setiap perjalanan terasa aman, nyaman, dan tak terlupakan. Dari bandara hingga destinasi impian Anda.
                    </p>
                </div>
                <div style="position: relative; display: flex; flex-direction: column; gap: 20px; align-items: flex-end;">
                    <img src="{{ asset('images/WhatsApp Image 2026-04-24 at 09.22.54.jpeg') }}" alt="SquadTrans Hero" style="width: 100%; height: 280px; object-fit: cover; border-radius: 16px;">
                    <div class="tn-aside-card">
                        <div class="tn-aside-year">2018</div>
                        <div class="tn-aside-head">Berdiri & Terus Berkembang</div>
                        <div class="tn-aside-text">Dari 3 unit menjadi 120+ armada premium di seluruh Indonesia dalam 6 tahun.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tn-stats-bar">
            <div class="tn-wrap">
                <div class="tn-stats-grid">
                    <div class="tn-stat">
                        <div class="tn-stat-num">120<em>+</em></div>
                        <div class="tn-stat-label">Unit Armada</div>
                    </div>
                    <div class="tn-stat">
                        <div class="tn-stat-num">15<em>k+</em></div>
                        <div class="tn-stat-label">Pelanggan Puas</div>
                    </div>
                    <div class="tn-stat">
                        <div class="tn-stat-num">12<em>+</em></div>
                        <div class="tn-stat-label">Kota Layanan</div>
                    </div>
                    <div class="tn-stat">
                        <div class="tn-stat-num">98<em>%</em></div>
                        <div class="tn-stat-label">Kepuasan Pelanggan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MARQUEE --}}
    <div class="tn-marquee" aria-hidden="true">
        <div class="tn-marquee-track">
            @foreach(array_fill(0,2,['Armada Premium','Layanan 24/7','Driver Profesional','Harga Transparan','Booking Mudah','12 Kota','15.000+ Pelanggan','Terpercaya Sejak 2018']) as $arr)
                @foreach($arr as $t)
                    <span class="tn-marquee-item">{{ $t }}</span>
                @endforeach
            @endforeach
        </div>
    </div>

    {{-- ═══════════ CERITA ═══════════ --}}
    <section class="tn-section">
        <div class="tn-wrap">
            <div class="tn-story">
                <div class="tn-story-text">
                    <p class="tn-sec-tag">Cerita Kami</p>
                    <h2 class="tn-sec-title" style="margin-bottom:24px">
                        Dari Garasi Kecil<br>ke <em>Ribuan Rute</em>
                    </h2>
                    <p><strong>SquadTrans lahir dari frustrasi sederhana</strong> — sulitnya menemukan layanan transportasi yang benar-benar bisa diandalkan. Bukan sekadar harga murah, tapi kenyamanan, ketepatan waktu, dan rasa aman.</p>
                    <p>Dimulai dari 3 unit kendaraan dan tim kecil yang bersemangat, kami membangun satu demi satu kepercayaan pelanggan. Setiap ulasan positif menjadi bahan bakar untuk terus berkembang.</p>
                    <p>Kini, dengan <strong>lebih dari 120 unit armada</strong>, tim pengemudi terlatih, dan platform pemesanan digital, SquadTrans telah menjadi mitra perjalanan pilihan ribuan keluarga dan profesional di Indonesia.</p>
                </div>
                <div class="tn-story-visual">
                    <img src="{{ asset('images/WhatsApp Image 2026-04-24 at 09.22.55.jpeg') }}" alt="SquadTrans Fleet" class="tn-story-img" style="object-fit: cover; display: block;">
                    <div class="tn-float-card">
                        <div class="tn-float-num">6+</div>
                        <div class="tn-float-label">Tahun membangun kepercayaan</div>
                    </div>
                </img>
            </div>
        </div>
    </section>

    {{-- ═══════════ VISI MISI ═══════════ --}}
    <section class="tn-section tn-section-alt">
        <div class="tn-wrap">
            <p class="tn-sec-tag">Fondasi Kami</p>
            <h2 class="tn-sec-title">Visi & <em>Misi</em></h2>
            <div class="tn-vm-grid">
                <div class="tn-vm-card tn-fade">
                    <span class="tn-vm-letter">V</span>
                    <div class="tn-vm-icon">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3>Visi</h3>
                    <p>Menjadi penyedia layanan transportasi terpercaya nomor satu di Indonesia — dikenal karena keandalan, keamanan, dan pengalaman perjalanan yang tak terlupakan bagi setiap pelanggan.</p>
                </div>
                <div class="tn-vm-card tn-fade">
                    <span class="tn-vm-letter">M</span>
                    <div class="tn-vm-icon">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3>Misi</h3>
                    <p>Menghadirkan armada berkualitas tinggi, pengemudi profesional, sistem pemesanan yang mudah, harga transparan, dan layanan pelanggan 24/7 — sehingga setiap perjalanan terasa aman dan menyenangkan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════ KEUNGGULAN ═══════════ --}}
    <section class="tn-section">
        <div class="tn-wrap">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:0">
                <div>
                    <p class="tn-sec-tag">Mengapa Kami</p>
                    <h2 class="tn-sec-title">Yang Membuat Kami <em>Berbeda</em></h2>
                </div>
                <p style="font-size:13.5px;color:#666;font-weight:300;max-width:300px;text-align:right;line-height:1.75">
                    Bukan sekadar sewa kendaraan — kami menghadirkan pengalaman yang selalu ingin Anda ulangi.
                </p>
            </div>

            <div class="tn-bento">
                {{-- dark tall --}}
                <div class="tn-bento-item dark tn-fade">
                    <div>
                        <div class="tn-bento-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="tn-bento-h">Layanan 24/7</div>
                        <div class="tn-bento-p">Tim kami siap membantu kapan saja — tengah malam sekalipun. Karena perjalanan tidak mengenal waktu.</div>
                    </div>
                    <div class="tn-bento-big">24</div>
                </div>

                <div class="tn-bento-item tn-fade">
                    <div class="tn-bento-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="tn-bento-h">Armada Terawat</div>
                    <div class="tn-bento-p">Setiap unit melalui inspeksi rutin. Keamanan Anda adalah prioritas kami tanpa kompromi.</div>
                </div>

                <div class="tn-bento-item tn-fade">
                    <div class="tn-bento-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="tn-bento-h">Driver Profesional</div>
                    <div class="tn-bento-p">Pengemudi terlatih, ramah, dan hafal rute terbaik di setiap kota tujuan Anda.</div>
                </div>

                <div class="tn-bento-item tn-fade">
                    <div class="tn-bento-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="tn-bento-h">Harga Transparan</div>
                    <div class="tn-bento-p">Tidak ada biaya kejutan. Yang Anda lihat di layar adalah yang Anda bayar.</div>
                </div>

                <div class="tn-bento-item tn-fade">
                    <div class="tn-bento-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div class="tn-bento-h">Booking Mudah</div>
                    <div class="tn-bento-p">Pesan dalam menit, konfirmasi instan. Semua bisa dari genggaman tangan Anda.</div>
                </div>

                <div class="tn-bento-item tn-fade">
                    <div class="tn-bento-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div class="tn-bento-h">Loyalitas Dihargai</div>
                    <div class="tn-bento-p">Kumpulkan poin setiap perjalanan dan tukarkan dengan diskon menarik untuk booking berikutnya.</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════ TIMELINE ═══════════ --}}
    <section class="tn-section tn-section-alt">
        <div class="tn-wrap">
            <div style="text-align:center;max-width:540px;margin:0 auto 0">
                <p class="tn-sec-tag" style="justify-content:center">Perjalanan Kami</p>
                <h2 class="tn-sec-title" style="margin-bottom:12px">Tumbuh Bersama <em>Kepercayaan</em></h2>
                <p style="font-size:13.5px;color:#666;font-weight:300;line-height:1.8">Setiap tahun membawa lompatan baru dalam armada, layanan, dan jangkauan kota.</p>
            </div>
            <div class="tn-tl-grid">
                <div class="tn-tl-col">
                    <div class="tn-tl-card tn-fade">
                        <p class="tn-tl-year">2018</p>
                        <p class="tn-tl-title">Awal Perjalanan</p>
                        <p class="tn-tl-desc">Mulai beroperasi di Jakarta dengan 3 unit. Fokus pada layanan antar-jemput bandara yang cepat dan andal.</p>
                    </div>
                    <div class="tn-tl-card tn-fade">
                        <p class="tn-tl-year">2020</p>
                        <p class="tn-tl-title">Bertahan & Berinovasi</p>
                        <p class="tn-tl-desc">Di tengah pandemi, kami beralih ke layanan korporat dan pengiriman esensial — tetap melayani saat yang lain berhenti.</p>
                    </div>
                    <div class="tn-tl-card tn-fade">
                        <p class="tn-tl-year">2023</p>
                        <p class="tn-tl-title">80+ Unit & 8 Kota</p>
                        <p class="tn-tl-desc">Ekspansi ke Bali, Surabaya, Yogyakarta, dan Medan. Armada terus bertumbuh dengan permintaan yang kian meningkat.</p>
                    </div>
                </div>

                <div class="tn-tl-bar"></div>

                <div class="tn-tl-col right">
                    <div class="tn-tl-card tn-fade">
                        <p class="tn-tl-year">2019</p>
                        <p class="tn-tl-title">Ekspansi Pertama</p>
                        <p class="tn-tl-desc">Armada tumbuh menjadi 25 unit. Layanan sewa harian dan paket wisata perdana ke Bali resmi diluncurkan.</p>
                    </div>
                    <div class="tn-tl-card tn-fade">
                        <p class="tn-tl-year">2021</p>
                        <p class="tn-tl-title">Platform Digital Lahir</p>
                        <p class="tn-tl-desc">Sistem pemesanan online diluncurkan. Kini pelanggan bisa booking kapan saja, dari mana saja, dalam hitungan menit.</p>
                    </div>
                    <div class="tn-tl-card current tn-fade">
                        <p class="tn-tl-year">2024 — Sekarang</p>
                        <p class="tn-tl-title">120+ Unit, 12 Kota</p>
                        <p class="tn-tl-desc">15.000+ pelanggan, armada premium lengkap, dan terus berkembang. Ini baru awal dari perjalanan panjang kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════ MITRA ═══════════ --}}
    <section class="tn-section">
        <div class="tn-wrap">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap">
                <div>
                    <p class="tn-sec-tag">Mitra Terpercaya</p>
                    <h2 class="tn-sec-title">Dipercaya Brand <em>Terkemuka</em></h2>
                </div>
                <p style="font-size:13px;color:#888;font-weight:300;max-width:280px;text-align:right;line-height:1.7">
                    Kami bermitra dengan brand dan institusi terpercaya untuk memastikan standar tertinggi.
                </p>
            </div>
            <div class="tn-mitra-row">
                @foreach(['Toyota','Honda','Mitsubishi','Hyundai','Wuling','Asuransi Simas','Garuda Indonesia','Traveloka for Business','Bank BCA','Gojek Corporate'] as $p)
                    <span class="tn-mitra-badge">{{ $p }}</span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════ CTA ═══════════ --}}
    <div class="tn-cta">
        <div class="tn-wrap">
            <div class="tn-cta-box">
                <div style="position:relative;z-index:1">
                    <p class="tn-cta-tag">Mulai Sekarang</p>
                    <h2 class="tn-cta-title">Siap untuk Perjalanan <em>Berikutnya?</em></h2>
                    <p class="tn-cta-sub">Bergabung bersama 15.000+ pelanggan yang telah mempercayai SquadTrans.</p>
                </div>
                <div class="tn-cta-btns">
                    <a href="{{ route('dashboard') }}" class="tn-btn tn-btn-amber">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h11l4 4v10a2 2 0 01-2 2h-1"/><circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/></svg>
                        Lihat Armada
                    </a>
                    <a href="/contact" class="tn-btn tn-btn-outline">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
</x-app-layout>
