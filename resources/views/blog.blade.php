<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Playfair+Display:ital,wght@1,500;1,600;1,700&display=swap');

/* ════════════════════════════════════
   ROOT & RESET
════════════════════════════════════ */
.bl {
    font-family: 'Poppins', sans-serif;
    background: #f7f5f1;
    color: #1a1a1a;
    --amber:   #d97706;
    --amber-l: #fef3c7;
    --amber-d: #b45309;
    --ink:     #111;
    --ink2:    #3d3730;
    --ink3:    #7a7066;
    --bg:      #f7f5f1;
    --bg2:     #eeebe3;
    --bg3:     #e2ddd4;
    --white:   #ffffff;
    --radius:  18px;
}
.bl * { box-sizing: border-box; margin: 0; padding: 0; }
.bl a { text-decoration: none; color: inherit; }
.bl-wrap { max-width: 1200px; margin: 0 auto; padding: 0 28px; }

/* Playfair untuk aksen heading */
.bl h1 em, .bl h2 em, .bl h3 em {
    font-family: 'Playfair Display', Georgia, serif;
    font-style: italic;
    font-weight: 600;
    letter-spacing: -0.3px;
}

/* ════════════════════════════════════
   HERO HEADER
════════════════════════════════════ */
.bl-hero {
    background: var(--ink);
    padding-top: 100px;
    position: relative;
    overflow: hidden;
}
.bl-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.018'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.bl-hero::after {
    content: '';
    position: absolute; bottom: -120px; right: -60px;
    width: 600px; height: 600px; border-radius: 50%;
    background: radial-gradient(circle, rgba(217,119,6,.16) 0%, transparent 65%);
    pointer-events: none;
}

.bl-hero-inner {
    position: relative; z-index: 1;
    padding: 64px 0 0;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 48px;
    align-items: end;
}

.bl-hero-eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-size: 10.5px; font-weight: 700; letter-spacing: 2.5px;
    text-transform: uppercase; color: var(--amber);
    margin-bottom: 16px;
}
.bl-hero-eyebrow::before {
    content: ''; width: 24px; height: 2px;
    background: var(--amber); border-radius: 2px;
}

.bl-hero-title {
    font-size: clamp(40px, 6vw, 72px);
    font-weight: 800; color: #fff;
    line-height: 1.05; letter-spacing: -1.5px;
    margin-bottom: 16px;
}
.bl-hero-title em {
    display: block; color: var(--amber);
}

.bl-hero-sub {
    font-size: 15px; color: rgba(255,255,255,.45);
    font-weight: 300; line-height: 1.75; max-width: 440px;
}

.bl-hero-badge {
    align-self: flex-end;
    text-align: right;
    padding-bottom: 4px;
}
.bl-hero-count {
    font-size: 72px; font-weight: 800; line-height: 1;
    color: rgba(255,255,255,.07); letter-spacing: -4px;
    font-family: 'Playfair Display', serif; font-style: italic;
}
.bl-hero-count-label {
    font-size: 12px; color: rgba(255,255,255,.3);
    font-weight: 400; letter-spacing: 1px;
    margin-top: 4px;
}

/* category pill bar */
.bl-cat-bar {
    position: relative; z-index: 1;
    border-top: 1px solid rgba(255,255,255,.08);
    margin-top: 48px;
}
.bl-cat-inner {
    display: flex; align-items: center; gap: 8px;
    padding: 18px 0;
    overflow-x: auto;
    scrollbar-width: none;
}
.bl-cat-inner::-webkit-scrollbar { display: none; }
.bl-cat {
    flex-shrink: 0;
    padding: 8px 20px; border-radius: 50px;
    font-size: 12px; font-weight: 600; letter-spacing: .3px;
    cursor: pointer; transition: all .18s;
    border: 1.5px solid rgba(255,255,255,.12);
    color: rgba(255,255,255,.5); background: transparent;
    font-family: 'Poppins', sans-serif;
}
.bl-cat:hover { border-color: rgba(255,255,255,.3); color: #fff; }
.bl-cat.active {
    background: var(--amber);
    border-color: var(--amber); color: #fff;
}

/* ════════════════════════════════════
   MAIN LAYOUT
════════════════════════════════════ */
.bl-main {
    padding: 56px 0 80px;
}
.bl-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 36px;
    align-items: start;
}

/* ════════════════════════════════════
   FEATURED
════════════════════════════════════ */
.bl-featured {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 48px;
}
.bl-feat-main {
    grid-row: span 2;
    background: var(--white);
    border-radius: 22px;
    overflow: hidden;
    border: 1px solid var(--bg3);
    transition: all .22s;
    display: flex; flex-direction: column;
}
.bl-feat-main:hover {
    box-shadow: 0 20px 48px rgba(0,0,0,.1);
    transform: translateY(-3px);
}

.bl-feat-img {
    width: 100%; aspect-ratio: 16/9;
    position: relative; overflow: hidden; flex-shrink: 0;
}
.bl-feat-img-inner {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
}
.bl-feat-img-icon {
    font-size: 72px; opacity: .12;
    font-family: 'Playfair Display', serif;
    font-style: italic; color: #fff;
}

/* gradient per category */
.g-travel { background: linear-gradient(135deg,#0c4a6e,#0369a1,#38bdf8); }
.g-tips    { background: linear-gradient(135deg,#14532d,#15803d,#86efac); }
.g-guide   { background: linear-gradient(135deg,#7c2d12,#c2410c,#fb923c); }
.g-promo   { background: linear-gradient(135deg,#4a1d96,#7e22ce,#c084fc); }
.g-news    { background: linear-gradient(135deg,#1e1b4b,#3730a3,#818cf8); }
.g-dark    { background: linear-gradient(135deg,#111,#2d2d2d,#555); }
.g-warm    { background: linear-gradient(135deg,#78350f,#d97706,#fbbf24); }

.bl-feat-body { padding: 24px 26px 26px; flex: 1; display: flex; flex-direction: column; }
.bl-feat-meta {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 12px; flex-wrap: wrap;
}
.bl-tag {
    font-size: 10px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: var(--amber-d);
    background: var(--amber-l); padding: 4px 11px;
    border-radius: 50px;
}
.bl-date { font-size: 11.5px; color: var(--ink3); font-weight: 400; }

.bl-feat-title {
    font-size: 20px; font-weight: 700; color: var(--ink);
    line-height: 1.3; margin-bottom: 10px;
    letter-spacing: -.2px;
}
.bl-feat-excerpt {
    font-size: 13px; color: var(--ink3);
    line-height: 1.8; font-weight: 300;
    flex: 1; margin-bottom: 18px;
}
.bl-read-link {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 12.5px; font-weight: 700;
    color: var(--amber); transition: gap .18s;
}
.bl-read-link:hover { gap: 10px; }

/* small featured */
.bl-feat-sm {
    background: var(--white);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--bg3);
    transition: all .2s;
    display: flex; flex-direction: column;
}
.bl-feat-sm:hover {
    box-shadow: 0 10px 28px rgba(0,0,0,.08);
    transform: translateY(-2px);
}
.bl-feat-sm .bl-feat-img { aspect-ratio: 16/7; }
.bl-feat-sm .bl-feat-body { padding: 16px 18px 18px; }
.bl-feat-sm .bl-feat-title { font-size: 14.5px; margin-bottom: 10px; }

/* ════════════════════════════════════
   SECTION HEAD
════════════════════════════════════ */
.bl-sec-head {
    display: flex; align-items: center; justify-content: space-between;
    gap: 16px; margin-bottom: 20px;
}
.bl-sec-label {
    font-size: 10.5px; font-weight: 700; letter-spacing: 2.5px;
    text-transform: uppercase; color: var(--ink3);
    display: flex; align-items: center; gap: 8px;
}
.bl-sec-label::before {
    content: ''; width: 16px; height: 1.5px;
    background: var(--ink3);
}
.bl-sec-more {
    font-size: 12px; font-weight: 600;
    color: var(--amber); display: flex; align-items: center; gap: 5px;
    transition: gap .15s;
}
.bl-sec-more:hover { gap: 8px; }

/* ════════════════════════════════════
   ARTICLE GRID
════════════════════════════════════ */
.bl-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 48px;
}
.bl-card {
    background: var(--white);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--bg3);
    transition: all .2s;
    display: flex; flex-direction: column;
}
.bl-card:hover {
    box-shadow: 0 10px 28px rgba(0,0,0,.08);
    transform: translateY(-3px);
}
.bl-card-img {
    width: 100%; aspect-ratio: 16/9;
    position: relative; overflow: hidden;
}
.bl-card-body { padding: 16px 18px 20px; flex: 1; display: flex; flex-direction: column; }
.bl-card-title {
    font-size: 14px; font-weight: 700; color: var(--ink);
    line-height: 1.4; margin-bottom: 8px; letter-spacing: -.1px;
    flex: 1;
}
.bl-card-foot {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 12px; padding-top: 12px;
    border-top: 1px solid var(--bg2);
}
.bl-card-author {
    display: flex; align-items: center; gap: 8px;
}
.bl-avatar {
    width: 26px; height: 26px; border-radius: 50%;
    background: var(--bg2); display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 700; color: var(--ink3);
    flex-shrink: 0;
}
.bl-author-name { font-size: 11px; font-weight: 500; color: var(--ink2); }
.bl-read-time { font-size: 11px; color: var(--ink3); }

/* ════════════════════════════════════
   LIST ARTICLES
════════════════════════════════════ */
.bl-list { display: flex; flex-direction: column; gap: 8px; margin-bottom: 48px; }
.bl-list-item {
    background: var(--white);
    border-radius: var(--radius);
    padding: 20px 22px;
    display: grid;
    grid-template-columns: 52px 1fr auto;
    gap: 16px;
    align-items: center;
    border: 1px solid var(--bg3);
    transition: all .18s;
}
.bl-list-item:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,.07);
    transform: translateX(3px);
}
.bl-list-num {
    font-family: 'Playfair Display', serif;
    font-size: 36px; font-style: italic;
    color: var(--bg3); line-height: 1;
    font-weight: 600; text-align: center;
    transition: color .18s;
}
.bl-list-item:hover .bl-list-num { color: var(--amber-l); }
.bl-list-title {
    font-size: 14px; font-weight: 600; color: var(--ink);
    line-height: 1.4; margin-bottom: 6px;
}
.bl-list-meta {
    display: flex; gap: 8px; align-items: center; flex-wrap: wrap;
}
.bl-list-meta span { font-size: 11.5px; color: var(--ink3); font-weight: 300; }
.bl-list-arrow {
    width: 34px; height: 34px; border-radius: 50%;
    border: 1.5px solid var(--bg3);
    display: flex; align-items: center; justify-content: center;
    color: var(--ink3); transition: all .18s; flex-shrink: 0;
}
.bl-list-item:hover .bl-list-arrow {
    background: var(--amber); border-color: var(--amber); color: #fff;
}

/* ════════════════════════════════════
   PAGINATION
════════════════════════════════════ */
.bl-pagination {
    display: flex; align-items: center; justify-content: center;
    gap: 6px;
}
.bl-page {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600;
    border: 1.5px solid var(--bg3);
    color: var(--ink2); background: var(--white);
    transition: all .15s; cursor: pointer;
}
.bl-page:hover { border-color: var(--amber); color: var(--amber); }
.bl-page.active { background: var(--amber); border-color: var(--amber); color: #fff; }
.bl-page.dots { border-color: transparent; background: transparent; cursor: default; color: var(--ink3); }
.bl-page-nav { width: auto; padding: 0 14px; }

/* ════════════════════════════════════
   SIDEBAR
════════════════════════════════════ */
.bl-sidebar { display: flex; flex-direction: column; gap: 20px; }

.bl-widget {
    background: var(--white);
    border-radius: 20px;
    padding: 24px;
    border: 1px solid var(--bg3);
}
.bl-widget-title {
    font-size: 12px; font-weight: 800;
    color: var(--ink); text-transform: uppercase;
    letter-spacing: 1px; margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 1.5px solid var(--bg2);
    display: flex; align-items: center; gap: 8px;
}
.bl-widget-title::before {
    content: '';
    width: 3px; height: 14px;
    background: var(--amber); border-radius: 2px;
}

/* search */
.bl-search { display: flex; gap: 8px; }
.bl-search-input {
    flex: 1; padding: 10px 14px;
    background: var(--bg); border: 1.5px solid var(--bg3);
    border-radius: 10px; color: var(--ink);
    font-family: 'Poppins', sans-serif; font-size: 13px;
    outline: none; transition: border-color .2s;
}
.bl-search-input:focus { border-color: var(--amber); }
.bl-search-btn {
    width: 40px; height: 40px; border-radius: 10px;
    background: var(--amber); border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: #fff; transition: background .15s; flex-shrink: 0;
}
.bl-search-btn:hover { background: var(--amber-d); }

/* popular */
.bl-popular { display: flex; flex-direction: column; gap: 14px; }
.bl-pop-item { display: flex; gap: 12px; align-items: flex-start; cursor: pointer; }
.bl-pop-num {
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-style: italic;
    color: var(--bg3); font-weight: 700;
    line-height: 1; flex-shrink: 0; width: 22px;
    transition: color .15s;
}
.bl-pop-item:hover .bl-pop-num { color: var(--amber-l); }
.bl-pop-title {
    font-size: 13px; font-weight: 600;
    color: var(--ink2); line-height: 1.45;
    transition: color .15s;
}
.bl-pop-item:hover .bl-pop-title { color: var(--amber-d); }
.bl-pop-meta { font-size: 11px; color: var(--ink3); margin-top: 3px; font-weight: 300; }

/* newsletter */
.bl-newsletter {
    background: var(--ink);
    border-radius: 20px; padding: 26px;
    position: relative; overflow: hidden;
}
.bl-newsletter::before {
    content: '';
    position: absolute; bottom: -60px; right: -40px;
    width: 200px; height: 200px; border-radius: 50%;
    background: radial-gradient(circle, rgba(217,119,6,.2) 0%, transparent 65%);
    pointer-events: none;
}
.bl-nl-title {
    font-size: 16px; font-weight: 800; color: #fff;
    margin-bottom: 8px; position: relative; z-index: 1;
    line-height: 1.3;
}
.bl-nl-title em {
    font-family: 'Playfair Display', serif;
    font-style: italic; color: var(--amber);
}
.bl-nl-desc {
    font-size: 12px; color: rgba(255,255,255,.4);
    font-weight: 300; line-height: 1.65;
    margin-bottom: 16px; position: relative; z-index: 1;
}
.bl-nl-input {
    width: 100%; padding: 10px 14px;
    background: rgba(255,255,255,.07);
    border: 1.5px solid rgba(255,255,255,.1);
    border-radius: 10px; color: #fff;
    font-family: 'Poppins', sans-serif; font-size: 13px;
    outline: none; transition: border-color .2s;
    margin-bottom: 10px; position: relative; z-index: 1;
    display: block;
}
.bl-nl-input::placeholder { color: rgba(255,255,255,.25); }
.bl-nl-input:focus { border-color: var(--amber); }
.bl-nl-btn {
    width: 100%; padding: 11px;
    background: linear-gradient(135deg,#f59e0b,#f97316);
    border: none; border-radius: 10px;
    font-family: 'Poppins', sans-serif; font-size: 13px;
    font-weight: 700; color: #fff; cursor: pointer;
    transition: all .2s; position: relative; z-index: 1;
    box-shadow: 0 4px 14px rgba(245,158,11,.35);
}
.bl-nl-btn:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(245,158,11,.45); }

/* tags */
.bl-tags { display: flex; flex-wrap: wrap; gap: 7px; }
.bl-tag-pill {
    padding: 6px 14px; border-radius: 50px;
    font-size: 11.5px; font-weight: 500;
    background: var(--bg); border: 1.5px solid var(--bg3);
    color: var(--ink2); transition: all .15s; cursor: pointer;
}
.bl-tag-pill:hover {
    background: var(--amber-l); border-color: rgba(217,119,6,.25);
    color: var(--amber-d);
}

/* ════════════════════════════════════
   RESPONSIVE
════════════════════════════════════ */
@media(max-width:1023px){
    .bl-layout { grid-template-columns: 1fr; }
    .bl-sidebar { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .bl-newsletter { grid-column: span 2; }
    .bl-grid { grid-template-columns: 1fr 1fr; }
    .bl-hero-badge { display: none; }
}
@media(max-width:767px){
    .bl-featured { grid-template-columns: 1fr; }
    .bl-feat-main { grid-row: span 1; }
    .bl-grid { grid-template-columns: 1fr; }
    .bl-sidebar { grid-template-columns: 1fr; }
    .bl-newsletter { grid-column: span 1; }
    .bl-list-item { grid-template-columns: 36px 1fr; }
    .bl-list-arrow { display: none; }
    .bl-hero-inner { grid-template-columns: 1fr; }
}

/* entrance animation */
.bl-fade { animation: blFade .5s cubic-bezier(.22,1,.36,1) both; }
@keyframes blFade { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:none} }
.bl-fade:nth-child(1){animation-delay:.04s}
.bl-fade:nth-child(2){animation-delay:.09s}
.bl-fade:nth-child(3){animation-delay:.14s}
.bl-fade:nth-child(4){animation-delay:.19s}
.bl-fade:nth-child(5){animation-delay:.24s}
.bl-fade:nth-child(6){animation-delay:.29s}
</style>

<div class="bl">

    {{-- ═══════════ HERO ═══════════ --}}
    <section class="bl-hero">
        <div class="bl-wrap">
            <div class="bl-hero-inner">
                <div>
                    <p class="bl-hero-eyebrow">Blog & Artikel</p>
                    <h1 class="bl-hero-title">
                        Inspirasi &amp;
                        <em>Panduan Perjalanan</em>
                    </h1>
                    <p class="bl-hero-sub">
                        Tips berkendara, destinasi wisata terbaik, promo terkini, dan cerita perjalanan dari komunitas SquadTrans.
                    </p>
                </div>
                <div class="bl-hero-badge">
                    <div class="bl-hero-count">48</div>
                    <div class="bl-hero-count-label">Total Artikel</div>
                </div>
            </div>
        </div>

        <div class="bl-cat-bar">
            <div class="bl-wrap">
                <div class="bl-cat-inner">
                    <button class="bl-cat active">Semua</button>
                    <button class="bl-cat">Tips Berkendara</button>
                    <button class="bl-cat">Destinasi Wisata</button>
                    <button class="bl-cat">Panduan Sewa</button>
                    <button class="bl-cat">Promo & Info</button>
                    <button class="bl-cat">Berita</button>
                    <button class="bl-cat">Cerita Pelanggan</button>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════ MAIN CONTENT ═══════════ --}}
    <div class="bl-main">
        <div class="bl-wrap">
            <div class="bl-layout">

                {{-- ──── LEFT ──── --}}
                <div>

                    {{-- Featured --}}
                    <div class="bl-sec-head">
                        <span class="bl-sec-label">Artikel Pilihan</span>
                        <a href="#" class="bl-sec-more">
                            Lihat semua
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <div class="bl-featured">
                        {{-- Main big card --}}
                        <a href="#" class="bl-feat-main bl-fade">
                            <div class="bl-feat-img g-travel">
                                <div class="bl-feat-img-inner">
                                    <span class="bl-feat-img-icon">✈</span>
                                </div>
                            </div>
                            <div class="bl-feat-body">
                                <div class="bl-feat-meta">
                                    <span class="bl-tag">Destinasi Wisata</span>
                                    <span class="bl-date">12 Mar 2025</span>
                                </div>
                                <h2 class="bl-feat-title">
                                    10 Destinasi <em>Tersembunyi</em> di Jawa yang Wajib Dikunjungi Tahun Ini
                                </h2>
                                <p class="bl-feat-excerpt">
                                    Jawa menyimpan begitu banyak surga tersembunyi yang belum banyak terjamah wisatawan. Dari pantai biru di ujung timur hingga kebun teh yang menghijau di dataran tinggi — semua bisa Anda jelajahi dengan mudah bersama SquadTrans.
                                </p>
                                <span class="bl-read-link">
                                    Baca Artikel
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </a>

                        {{-- Small card 1 --}}
                        <a href="#" class="bl-feat-sm bl-fade">
                            <div class="bl-feat-img g-tips">
                                <div class="bl-feat-img-inner">
                                    <span class="bl-feat-img-icon">🛣</span>
                                </div>
                            </div>
                            <div class="bl-feat-body">
                                <div class="bl-feat-meta">
                                    <span class="bl-tag">Tips Berkendara</span>
                                    <span class="bl-date">5 Mar 2025</span>
                                </div>
                                <h3 class="bl-feat-title">Persiapan Road Trip Panjang: Checklist yang Sering Dilupakan</h3>
                                <span class="bl-read-link" style="font-size:12px">
                                    Baca
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </a>

                        {{-- Small card 2 --}}
                        <a href="#" class="bl-feat-sm bl-fade">
                            <div class="bl-feat-img g-promo">
                                <div class="bl-feat-img-inner">
                                    <span class="bl-feat-img-icon">%</span>
                                </div>
                            </div>
                            <div class="bl-feat-body">
                                <div class="bl-feat-meta">
                                    <span class="bl-tag">Promo & Info</span>
                                    <span class="bl-date">1 Mar 2025</span>
                                </div>
                                <h3 class="bl-feat-title">Promo Lebaran 2025: Diskon 30% untuk Sewa Mingguan</h3>
                                <span class="bl-read-link" style="font-size:12px">
                                    Baca
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </a>
                    </div>

                    {{-- Article Grid --}}
                    <div class="bl-sec-head">
                        <span class="bl-sec-label">Artikel Terbaru</span>
                        <a href="#" class="bl-sec-more">
                            Semua artikel
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <div class="bl-grid">
                        @php
                        $articles = [
                            ['g'=>'g-guide','tag'=>'Panduan Sewa','date'=>'27 Feb','title'=>'Panduan Lengkap Sewa Mobil Harian untuk Pemula','author'=>'Rafi A','time'=>'5 mnt'],
                            ['g'=>'g-travel','tag'=>'Destinasi Wisata','date'=>'24 Feb','title'=>'Menjelajahi Bali Timur: Rute 3 Hari yang Sempurna','author'=>'Siti N','time'=>'7 mnt'],
                            ['g'=>'g-tips','tag'=>'Tips Berkendara','date'=>'20 Feb','title'=>'Cara Memilih Kendaraan yang Tepat untuk Liburan Keluarga','author'=>'Dian R','time'=>'4 mnt'],
                            ['g'=>'g-news','tag'=>'Berita','date'=>'17 Feb','title'=>'SquadTrans Kini Hadir di Makassar dan Manado','author'=>'Admin','time'=>'3 mnt'],
                            ['g'=>'g-dark','tag'=>'Cerita Pelanggan','date'=>'14 Feb','title'=>'Perjalanan Romantis Malang–Bromo: Cerita dari Pasangan Muda','author'=>'Lia K','time'=>'6 mnt'],
                            ['g'=>'g-warm','tag'=>'Panduan Sewa','date'=>'10 Feb','title'=>'Apa Itu Sewa Lepas Kunci? Keuntungan dan Syaratnya','author'=>'Rafi A','time'=>'5 mnt'],
                        ];
                        @endphp
                        @foreach($articles as $i => $a)
                        <a href="#" class="bl-card bl-fade">
                            <div class="bl-card-img {{ $a['g'] }}">
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:48px;opacity:.1;font-family:'Playfair Display',serif;font-style:italic;color:#fff">{{ $i+1 }}</div>
                            </div>
                            <div class="bl-card-body">
                                <div class="bl-feat-meta" style="margin-bottom:8px">
                                    <span class="bl-tag">{{ $a['tag'] }}</span>
                                    <span class="bl-date">{{ $a['date'] }}</span>
                                </div>
                                <p class="bl-card-title">{{ $a['title'] }}</p>
                                <div class="bl-card-foot">
                                    <div class="bl-card-author">
                                        <div class="bl-avatar">{{ substr($a['author'],0,1) }}</div>
                                        <span class="bl-author-name">{{ $a['author'] }}</span>
                                    </div>
                                    <span class="bl-read-time">{{ $a['time'] }} baca</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    {{-- List articles --}}
                    <div class="bl-sec-head">
                        <span class="bl-sec-label">Artikel Lainnya</span>
                    </div>

                    <div class="bl-list">
                        @php
                        $list = [
                            ['n'=>'01','tag'=>'Tips Berkendara','title'=>'10 Kesalahan Umum Saat Berkendara di Luar Kota','date'=>'8 Feb 2025','time'=>'6 mnt'],
                            ['n'=>'02','tag'=>'Destinasi Wisata','title'=>'Wisata Alam Bromo: Tips Terbaik agar Tak Kecewa','date'=>'4 Feb 2025','time'=>'8 mnt'],
                            ['n'=>'03','tag'=>'Panduan Sewa','title'=>'Perbedaan Sewa Harian, Mingguan, dan Bulanan: Mana yang Lebih Hemat?','date'=>'1 Feb 2025','time'=>'5 mnt'],
                            ['n'=>'04','tag'=>'Promo & Info','title'=>'SquadTrans Loyalty: Cara Kumpulkan & Tukarkan Poin Anda','date'=>'26 Jan 2025','time'=>'4 mnt'],
                        ];
                        @endphp
                        @foreach($list as $item)
                        <a href="#" class="bl-list-item">
                            <div class="bl-list-num">{{ $item['n'] }}</div>
                            <div>
                                <div class="bl-list-title">{{ $item['title'] }}</div>
                                <div class="bl-list-meta">
                                    <span class="bl-tag" style="font-size:9.5px;padding:3px 9px">{{ $item['tag'] }}</span>
                                    <span>{{ $item['date'] }}</span>
                                    <span>· {{ $item['time'] }} baca</span>
                                </div>
                            </div>
                            <div class="bl-list-arrow">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="bl-pagination">
                        <a href="#" class="bl-page bl-page-nav">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        </a>
                        <a href="#" class="bl-page active">1</a>
                        <a href="#" class="bl-page">2</a>
                        <a href="#" class="bl-page">3</a>
                        <span class="bl-page dots">···</span>
                        <a href="#" class="bl-page">8</a>
                        <a href="#" class="bl-page bl-page-nav">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                </div>

                {{-- ──── SIDEBAR ──── --}}
                <aside class="bl-sidebar">

                    {{-- Search --}}
                    <div class="bl-widget">
                        <div class="bl-widget-title">Cari Artikel</div>
                        <div class="bl-search">
                            <input class="bl-search-input" type="text" placeholder="Kata kunci...">
                            <button class="bl-search-btn">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Popular --}}
                    <div class="bl-widget">
                        <div class="bl-widget-title">Paling Banyak Dibaca</div>
                        <div class="bl-popular">
                            @foreach([
                                ['n'=>'1','t'=>'10 Destinasi Tersembunyi di Jawa yang Wajib Dikunjungi','m'=>'12.4k pembaca'],
                                ['n'=>'2','t'=>'Panduan Lengkap Sewa Mobil Harian untuk Pemula','m'=>'9.1k pembaca'],
                                ['n'=>'3','t'=>'Cara Memilih Kendaraan yang Tepat untuk Liburan Keluarga','m'=>'7.8k pembaca'],
                                ['n'=>'4','t'=>'Promo Lebaran 2025: Diskon 30% Sewa Mingguan','m'=>'6.2k pembaca'],
                            ] as $p)
                            <div class="bl-pop-item">
                                <div class="bl-pop-num">{{ $p['n'] }}</div>
                                <div>
                                    <div class="bl-pop-title">{{ $p['t'] }}</div>
                                    <div class="bl-pop-meta">{{ $p['m'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Newsletter --}}
                    <div class="bl-newsletter">
                        <div class="bl-nl-title">Jangan Lewatkan<br><em>Artikel Terbaru</em></div>
                        <p class="bl-nl-desc">Dapatkan tips perjalanan, promo eksklusif, dan inspirasi wisata langsung di inbox Anda.</p>
                        <input class="bl-nl-input" type="email" placeholder="Email kamu...">
                        <button class="bl-nl-btn">Langganan Sekarang</button>
                    </div>

                    {{-- Tags --}}
                    <div class="bl-widget">
                        <div class="bl-widget-title">Topik Populer</div>
                        <div class="bl-tags">
                            @foreach(['Sewa Mobil','Tips Berkendara','Wisata Bali','Road Trip','Bromo','Keluarga','Driver','Lebaran','Malang','Yogyakarta','Bandung','Promo'] as $tag)
                                <span class="bl-tag-pill">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>

</div>

<script>
document.querySelectorAll('.bl-cat').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.bl-cat').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>
</x-app-layout>
