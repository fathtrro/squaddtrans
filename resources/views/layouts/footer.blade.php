<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,300&family=DM+Serif+Display:ital@0;1&display=swap');

:root {
    --bg:      #141210;
    --bg-2:    #1c1916;
    --bg-3:    #252118;
    --line:    rgba(255,255,255,0.07);
    --ink:     #f5f0e8;
    --ink-2:   #a09888;
    --ink-3:   #5c564e;
    --amber:   #e8a020;
    --amber-d: #c4841a;
}

.footer-dark * { box-sizing: border-box; margin: 0; padding: 0; }

.footer-dark {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    border-top: 1px solid var(--line);
    position: relative;
    overflow: hidden;
}

/* soft glow top-center */
.footer-dark::before {
    content: '';
    position: absolute;
    top: -80px; left: 50%;
    transform: translateX(-50%);
    width: 600px; height: 200px;
    background: radial-gradient(ellipse, rgba(232,160,32,0.06) 0%, transparent 70%);
    pointer-events: none;
}

/* ── UPPER ── */
.fd-upper {
    padding: 60px 0 52px;
    border-bottom: 1px solid var(--line);
}
.fd-wrap {
    max-width: 1160px;
    margin: 0 auto;
    padding: 0 28px;
}
.fd-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
    gap: 56px;
    align-items: start;
}

/* Brand */
.fd-logo {
    display: flex;
    align-items: center;
    gap: 11px;
    margin-bottom: 16px;
}
.fd-logo-mark {
    width: 40px; height: 40px;
    background: var(--amber);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 16px rgba(232,160,32,0.25);
}
.fd-logo-name {
    font-family: 'DM Serif Display', serif;
    font-size: 20px;
    color: var(--ink);
    letter-spacing: -0.3px;
    line-height: 1;
}
.fd-logo-name em { font-style: italic; color: var(--amber); }

.fd-desc {
    font-size: 13.5px;
    line-height: 1.85;
    color: var(--ink-2);
    font-weight: 300;
    margin-bottom: 24px;
    max-width: 270px;
}

/* Socials */
.fd-socials { display: flex; gap: 8px; }
.fd-soc {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1px solid var(--line);
    background: var(--bg-2);
    display: flex; align-items: center; justify-content: center;
    color: var(--ink-3);
    text-decoration: none;
    transition: all 0.2s ease;
}
.fd-soc:hover {
    border-color: var(--amber);
    background: rgba(232,160,32,0.1);
    color: var(--amber);
    transform: translateY(-2px);
}

/* Nav */
.fd-col-title {
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--ink);
    margin-bottom: 20px;
    opacity: 0.9;
}
.fd-links { list-style: none; display: flex; flex-direction: column; gap: 11px; }
.fd-links a {
    font-size: 13.5px;
    color: var(--ink-2);
    text-decoration: none;
    font-weight: 400;
    transition: color 0.15s;
    display: inline-flex;
    align-items: center;
}
.fd-links a::before {
    content: '';
    width: 0; height: 1.5px;
    background: var(--amber);
    transition: width 0.2s ease;
    margin-right: 0;
}
.fd-links a:hover { color: var(--ink); }
.fd-links a:hover::before { width: 10px; margin-right: 7px; }

/* Contact */
.fd-contacts { display: flex; flex-direction: column; gap: 13px; }
.fd-contact-row { display: flex; align-items: flex-start; gap: 11px; }
.fd-cicon {
    width: 32px; height: 32px;
    border-radius: 8px;
    background: var(--bg-3);
    border: 1px solid var(--line);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    color: var(--amber);
}
.fd-ctext {
    font-size: 13px;
    color: var(--ink-2);
    line-height: 1.65;
    padding-top: 6px;
    font-weight: 300;
}

/* ── LOWER ── */
.fd-lower { padding: 18px 0; }
.fd-lower-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}
.fd-copy {
    font-size: 12px;
    color: var(--ink-3);
}
.fd-copy strong { color: var(--ink-2); font-weight: 500; }

.fd-trust { display: flex; align-items: center; gap: 18px; }
.fd-trust-item {
    display: flex; align-items: center; gap: 6px;
    font-size: 11.5px;
    color: var(--ink-3);
    font-weight: 400;
}
.fd-trust-dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 3px rgba(34,197,94,0.15);
}
.fd-sep { width: 1px; height: 12px; background: var(--line); }

/* ── RESPONSIVE ── */
@media (max-width: 1023px) {
    .fd-grid { grid-template-columns: 1fr 1fr; gap: 40px; }
    .fd-brand-col { grid-column: 1 / -1; padding-bottom: 32px; border-bottom: 1px solid var(--line); }
}

@media (max-width: 639px) {
    .fd-upper { padding: 40px 0 32px; }
    .fd-grid { grid-template-columns: 1fr; gap: 0; }
    .fd-brand-col { padding-bottom: 28px; border-bottom: 1px solid var(--line); }

    /* accordion */
    .fd-nav-col { border-bottom: 1px solid var(--line); }
    .fd-acc-btn {
        width: 100%; background: none; border: none;
        padding: 16px 0;
        display: flex; align-items: center; justify-content: space-between;
        cursor: pointer; font-family: 'DM Sans', sans-serif;
    }
    .fd-acc-btn .fd-col-title { margin-bottom: 0; }
    .fd-chevron { color: var(--ink-3); transition: transform 0.25s; flex-shrink: 0; }
    .fd-nav-col.open .fd-chevron { transform: rotate(180deg); }
    .fd-acc-body { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
    .fd-nav-col.open .fd-acc-body { max-height: 220px; }
    .fd-acc-body .fd-links { padding-bottom: 18px; }

    .fd-contact-col { padding-top: 24px; }
    .fd-lower-inner { flex-direction: column; align-items: flex-start; }
    .fd-trust { flex-wrap: wrap; gap: 10px; }
    .fd-sep { display: none; }
}
</style>

<footer class="footer-dark">
    <div class="fd-upper">
        <div class="fd-wrap">
            <div class="fd-grid">

                <!-- Brand -->
                <div class="fd-brand-col">
                    <div class="fd-logo">
                        <div class="fd-logo-mark">
                            <svg width="18" height="18" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h11l4 4v10a2 2 0 01-2 2h-1"/>
                                <circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/>
                            </svg>
                        </div>
                        <div class="fd-logo-name">Squad<em>Trans</em></div>
                    </div>
                    <p class="fd-desc">Penyedia layanan transportasi premium di Indonesia. Unit terbaik, layanan profesional, untuk setiap perjalanan Anda.</p>
                    <div class="fd-socials">
                        <a href="#" class="fd-soc" aria-label="Instagram">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"/></svg>
                        </a>
                        <a href="#" class="fd-soc" aria-label="WhatsApp">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                        </a>
                        <a href="#" class="fd-soc" aria-label="TikTok">
                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.3 6.3 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.87a8.18 8.18 0 004.78 1.52V7a4.85 4.85 0 01-1.01-.31z"/></svg>
                        </a>
                        <a href="#" class="fd-soc" aria-label="YouTube">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Layanan -->
                <div class="fd-nav-col" id="fd-layanan">
                    <button class="fd-acc-btn" onclick="fdToggle('fd-layanan')" type="button">
                        <p class="fd-col-title">Layanan</p>
                        <svg class="fd-chevron" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="fd-acc-body">
                        <ul class="fd-links">
                            <li><a href="#">Sewa Mobil Lepas Kunci</a></li>
                            <li><a href="#">Sewa Mobil + Driver</a></li>
                            <li><a href="#">Antar Jemput Bandara</a></li>
                            <li><a href="#">Paket Wisata Bali</a></li>
                            <li><a href="#">Sewa Hiace / Bus</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Dukungan -->
                <div class="fd-nav-col" id="fd-dukungan">
                    <button class="fd-acc-btn" onclick="fdToggle('fd-dukungan')" type="button">
                        <p class="fd-col-title">Dukungan</p>
                        <svg class="fd-chevron" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="fd-acc-body">
                        <ul class="fd-links">
                            <li><a href="#">Cara Pemesanan</a></li>
                            <li><a href="#">Metode Pembayaran</a></li>
                            <li><a href="#">Syarat & Ketentuan</a></li>
                            <li><a href="#">Pusat Bantuan</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="fd-contact-col">
                    <p class="fd-col-title">Kontak</p>
                    <div class="fd-contacts">
                        <div class="fd-contact-row">
                            <div class="fd-cicon">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            </div>
                            <p class="fd-ctext">Grand Indonesia, Menara BCA Lt. 45,<br>Jakarta Pusat</p>
                        </div>
                        <div class="fd-contact-row">
                            <div class="fd-cicon">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.264.415.574.827.973 1.226.398.399.81.709 1.226.973l.773-1.548a1 1 0 011.06-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 4 14.18 4 9.5V5a1 1 0 011-1z"/></svg>
                            </div>
                            <p class="fd-ctext">+62 812 3456 7890</p>
                        </div>
                        <div class="fd-contact-row">
                            <div class="fd-cicon">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            </div>
                            <p class="fd-ctext">booking@squadtrans.id</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Lower -->
    <div class="fd-lower">
        <div class="fd-wrap">
            <div class="fd-lower-inner">
                <p class="fd-copy">© 2026 <strong>KELOMPOK 09 SMK PGRI 2 PONOROGO </strong>- SQUAD TRANS PONOROGO </p>
                <div class="fd-trust">
                    <span class="fd-trust-item"><span class="fd-trust-dot"></span>Aktif 24/7</span>
                    <span class="fd-sep"></span>
                    <span class="fd-trust-item">SSL Secured</span>
                    <span class="fd-sep"></span>
                    <span class="fd-trust-item">Terpercaya sejak 2018</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
function fdToggle(id) {
    if (window.innerWidth >= 640) return;
    document.getElementById(id).classList.toggle('open');
}
function fdInit() {
    document.querySelectorAll('.fd-nav-col').forEach(el => {
        const body = el.querySelector('.fd-acc-body');
        if (!body) return;
        if (window.innerWidth >= 640) {
            el.classList.add('open');
            body.style.maxHeight = 'none';
            body.style.overflow = 'visible';
        } else {
            body.style.maxHeight = el.classList.contains('open') ? '220px' : '0';
            body.style.overflow = 'hidden';
        }
    });
}
fdInit();
window.addEventListener('resize', fdInit);
</script>
