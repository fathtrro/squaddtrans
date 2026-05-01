<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,300&family=DM+Serif+Display:ital@0;1&display=swap');

    :root {
        --bg: #141210;
        --bg-2: #1c1916;
        --bg-3: #252118;
        --line: rgba(255, 255, 255, 0.07);
        --ink: #f5f0e8;
        --ink-2: #a09888;
        --ink-3: #5c564e;
        --amber: #e8a020;
        --amber-d: #c4841a;
    }

    .footer-dark * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

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
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        width: 600px;
        height: 200px;
        background: radial-gradient(ellipse, rgba(232, 160, 32, 0.06) 0%, transparent 70%);
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
        width: 40px;
        height: 40px;
        background: var(--amber);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(232, 160, 32, 0.25);
    }

    .fd-logo-name {
        font-family: 'DM Serif Display', serif;
        font-size: 20px;
        color: var(--ink);
        letter-spacing: -0.3px;
        line-height: 1;
    }

    .fd-logo-name em {
        font-style: italic;
        color: var(--amber);
    }

    .fd-desc {
        font-size: 13.5px;
        line-height: 1.85;
        color: var(--ink-2);
        font-weight: 300;
        margin-bottom: 24px;
        max-width: 270px;
    }

    /* Socials */
    .fd-socials {
        display: flex;
        gap: 8px;
    }

    .fd-soc {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid var(--line);
        background: var(--bg-2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--ink-3);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .fd-soc:hover {
        border-color: var(--amber);
        background: rgba(232, 160, 32, 0.1);
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

    .fd-links {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 11px;
    }

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
        width: 0;
        height: 1.5px;
        background: var(--amber);
        transition: width 0.2s ease;
        margin-right: 0;
    }

    .fd-links a:hover {
        color: var(--ink);
    }

    .fd-links a:hover::before {
        width: 10px;
        margin-right: 7px;
    }

    /* Contact */
    .fd-contacts {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .fd-contact-row {
        display: flex;
        align-items: flex-start;
        gap: 11px;
    }

    .fd-cicon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--bg-3);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
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
    .fd-lower {
        padding: 18px 0;
    }

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

    .fd-copy strong {
        color: var(--ink-2);
        font-weight: 500;
    }

    .fd-trust {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .fd-trust-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        color: var(--ink-3);
        font-weight: 400;
    }

    .fd-trust-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
    }

    .fd-sep {
        width: 1px;
        height: 12px;
        background: var(--line);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1023px) {
        .fd-grid {
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .fd-brand-col {
            grid-column: 1 / -1;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--line);
        }
    }

    @media (max-width: 639px) {
        .fd-upper {
            padding: 40px 0 32px;
        }

        .fd-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .fd-brand-col {
            padding-bottom: 28px;
            border-bottom: 1px solid var(--line);
        }

        /* accordion */
        .fd-nav-col {
            border-bottom: 1px solid var(--line);
        }

        .fd-acc-btn {
            width: 100%;
            background: none;
            border: none;
            padding: 16px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
        }

        .fd-acc-btn .fd-col-title {
            margin-bottom: 0;
        }

        .fd-chevron {
            color: var(--ink-3);
            transition: transform 0.25s;
            flex-shrink: 0;
        }

        .fd-nav-col.open .fd-chevron {
            transform: rotate(180deg);
        }

        .fd-acc-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .fd-nav-col.open .fd-acc-body {
            max-height: 220px;
        }

        .fd-acc-body .fd-links {
            padding-bottom: 18px;
        }

        .fd-contact-col {
            padding-top: 24px;
        }

        .fd-lower-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .fd-trust {
            flex-wrap: wrap;
            gap: 10px;
        }

        .fd-sep {
            display: none;
        }
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
                            <svg width="18" height="18" fill="none" stroke="white" stroke-width="2.2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h11l4 4v10a2 2 0 01-2 2h-1" />
                                <circle cx="9" cy="20" r="1.5" />
                                <circle cx="18" cy="20" r="1.5" />
                            </svg>
                        </div>
                        <div class="fd-logo-name">Squad<em>Trans</em></div>
                    </div>
                    <p class="fd-desc">Penyedia layanan transportasi premium di Indonesia. Unit terbaik, layanan
                        profesional, untuk setiap perjalanan Anda.</p>
                </div>

                <!-- Kontak -->
                <div class="fd-contact-col">
                    <p class="fd-col-title">Kontak</p>
                    <div class="fd-contacts">
                        <div class="fd-contact-row">
                            <div class="fd-cicon">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="fd-ctext">SQUAD TRANSWISATA (RENTAL MOBIL & CARWASH)
                                Jl. Let. Jen S. Parman, Krajan, Keniten, Kec. Ponorogo, Kabupaten Ponorogo, Jawa Timur
                                63412
                        </div>
                        <div class="fd-contact-row">
                            <div class="fd-cicon">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.264.415.574.827.973 1.226.398.399.81.709 1.226.973l.773-1.548a1 1 0 011.06-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 4 14.18 4 9.5V5a1 1 0 011-1z" />
                                </svg>
                            </div>
                            <p class="fd-ctext">+62 812-3328-3578</p>
                        </div>
                        <div class="fd-contact-row">
                            <div class="fd-cicon">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
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
