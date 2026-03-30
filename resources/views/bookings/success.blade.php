<x-app-layout>
<style>
    nav, footer { display: none !important; }
    *, *::before, *::after { box-sizing: border-box; }

    /* ── Prevent any scroll ── */
    html, body { height: 100%; overflow: hidden; }

    @keyframes popIn {
        0%   { transform: scale(0.5); opacity: 0; }
        70%  { transform: scale(1.15); }
        100% { transform: scale(1); opacity: 1; }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes dash { to { stroke-dashoffset: 0; } }

    .pop-in  { animation: popIn 0.55s cubic-bezier(.36,.07,.19,.97) both; }
    .fade-up { animation: fadeUp 0.4s ease both; }
    .d1 { animation-delay: 0.10s; }
    .d2 { animation-delay: 0.20s; }
    .d3 { animation-delay: 0.30s; }
    .d4 { animation-delay: 0.40s; }

    .checkmark-circle {
        stroke-dasharray: 166; stroke-dashoffset: 166;
        animation: dash 0.6s 0.3s cubic-bezier(0.65,0,0.45,1) forwards;
    }
    .checkmark-check {
        stroke-dasharray: 48; stroke-dashoffset: 48;
        animation: dash 0.4s 0.85s ease forwards;
    }

    /* ── Ticket dashed divider ── */
    .ticket-div {
        position: relative; height: 1px;
        background: repeating-linear-gradient(90deg,#fde68a 0,#fde68a 6px,transparent 6px,transparent 12px);
    }
    .ticket-div::before, .ticket-div::after {
        content: ''; position: absolute; top: 50%; transform: translateY(-50%);
        width: 16px; height: 16px; border-radius: 50%;
    }
    .ticket-div::before { left: -20px; }
    .ticket-div::after  { right: -20px; }

    .btn-gold {
        background: linear-gradient(135deg,#facc15,#f59e0b);
        box-shadow: 0 3px 14px rgba(245,158,11,.35);
        transition: all .18s;
    }
    .btn-gold:active { transform: scale(.97); }

    /* ── MOBILE layout ── */
    .wrap-mobile {
        display: flex; flex-direction: column;
        height: 100dvh;
        background: #FBFAF7;
        overflow: hidden;
    }

    .mob-header {
        flex-shrink: 0;
        position: relative;
        background: linear-gradient(135deg,#fbbf24,#f59e0b);
        padding: 14px 16px 44px;
        text-align: center;
        overflow: hidden;
    }

    .mob-body {
        flex: 1; display: flex; flex-direction: column;
        padding: 0 14px 8px;
        gap: 6px;
        overflow: hidden;
        /* extra top space so the overlapping card is fully visible */
        margin-top: -32px;
        padding-top: 0;
        position: relative; z-index: 5;
    }

    .mob-ticket {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 6px 24px rgba(0,0,0,.10);
        flex-shrink: 0;
        position: relative; z-index: 10;
    }
    .ticket-div::before { background: #FBFAF7; }
    .ticket-div::after  { background: #FBFAF7; }

    .mob-detail-row {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
        padding: 8px 14px; flex-shrink: 0;
        display: flex; justify-content: space-between; align-items: center;
        font-size: 12px;
    }

    .mob-btns { flex-shrink: 0; display: flex; flex-direction: column; gap: 6px; }

    .mob-footer { flex-shrink: 0; text-align: center; }

    /* ── DESKTOP layout ── */
    .wrap-desktop {
        display: none;
        height: 100dvh;
        background: #F7F7F5;
        overflow: hidden;
        flex-direction: column;
    }
    .desk-bar { height: 3px; flex-shrink: 0; background: linear-gradient(90deg,#facc15,#f59e0b); }
    .desk-center {
        flex: 1; display: flex; align-items: center; justify-content: center;
        padding: 24px 32px;
    }
    .desk-grid {
        width: 100%; max-width: 860px;
        display: grid; grid-template-columns: 2fr 3fr; gap: 32px;
        align-items: start;
    }
    .desk-card {
        background: #fff; border-radius: 18px;
        box-shadow: 0 2px 20px rgba(0,0,0,.07);
        overflow: hidden;
    }
    .desk-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 9px 0; border-bottom: 1px solid #f3f4f6; font-size: 13px;
    }
    .desk-row:last-child { border-bottom: none; }
    .desk-divider {
        height: 1px; margin: 4px 0;
        background: repeating-linear-gradient(90deg,#fde68a 0,#fde68a 6px,transparent 6px,transparent 12px);
    }
    .desk-btn-gold {
        background: linear-gradient(135deg,#facc15,#f59e0b);
        box-shadow: 0 3px 14px rgba(245,158,11,.3);
        transition: all .18s;
    }
    .desk-btn-gold:hover { filter: brightness(1.05); transform: translateY(-1px); }
    .desk-btn-outline {
        border: 1.5px solid #e5e7eb; transition: all .18s;
    }
    .desk-btn-outline:hover { border-color: #f59e0b; color: #d97706; transform: translateY(-1px); }

    @media (min-width: 768px) {
        .wrap-mobile  { display: none !important; }
        .wrap-desktop { display: flex; }
    }
</style>


{{-- ══════════════════════════════
     MOBILE  (< 768px)
══════════════════════════════ --}}
<div class="wrap-mobile">

    {{-- ===== Header wave (original style) ===== --}}
    <div class="mob-header">
        <div class="absolute -top-6 -left-6 w-24 h-24 rounded-full bg-white/10"></div>
        <div class="absolute top-2 right-4 w-12 h-12 rounded-full bg-white/10"></div>

        {{-- Checkmark --}}
        <div class="pop-in flex justify-center mb-1.5">
            <div class="w-12 h-12">
                <svg viewBox="0 0 52 52" class="w-full h-full drop-shadow">
                    <circle cx="26" cy="26" r="25" fill="white" opacity="0.25"/>
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="white" stroke-width="2"/>
                    <path class="checkmark-check" fill="none" stroke="white" stroke-width="3.5"
                          stroke-linecap="round" stroke-linejoin="round" d="M14 27l8 8 16-16"/>
                </svg>
            </div>
        </div>

        <h1 class="fade-up d1 text-base font-extrabold text-white tracking-tight">Booking Berhasil!</h1>
        <p class="fade-up d2 text-yellow-100 text-[11px] mt-0.5">ID Pemesanan</p>
        <div class="fade-up d2 inline-flex items-center gap-1.5 mt-1 bg-white/20 backdrop-blur-sm rounded-full px-3 py-1">
            <span class="text-[11px] font-bold text-white tracking-widest">{{ $booking->booking_code }}</span>
            <button onclick="navigator.clipboard.writeText('{{ $booking->booking_code }}')" class="text-yellow-200 hover:text-white transition">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </button>
        </div>

        {{-- Wave SVG --}}
        <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 390 28" preserveAspectRatio="none">
            <path d="M0,14 C100,28 290,0 390,14 L390,28 L0,28 Z" fill="#FBFAF7"/>
        </svg>
    </div>

    {{-- ===== Body ===== --}}
    <div class="mob-body">

        {{-- TICKET CARD — overlaps wave --}}
        <div class="mob-ticket fade-up d2">
            {{-- 2-col info grid --}}
            <div class="px-4 pt-4 pb-2.5 grid grid-cols-2 gap-x-4 gap-y-2.5">
                <div class="text-left">
                    <p class="text-[9px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Kendaraan</p>
                    <p class="font-bold text-gray-800 text-xs">{{ $booking->car->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Layanan</p>
                    <p class="font-bold text-gray-800 text-xs">{{ ucwords(str_replace('_',' ', $booking->service_type)) }}</p>
                </div>
                <div class="text-left">
                    <p class="text-[9px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Mulai</p>
                    <p class="font-bold text-gray-800 text-xs">{{ $booking->start_datetime->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Selesai</p>
                    <p class="font-bold text-gray-800 text-xs">{{ $booking->end_datetime->format('d M Y') }}</p>
                </div>
            </div>

            <div class="mx-5 my-1"><div class="ticket-div"></div></div>

            {{-- Payment section --}}
            <div class="px-4 pt-2.5 pb-3.5">
                <div class="text-center mb-2">
                    <p class="text-[9px] font-semibold text-gray-400 uppercase tracking-wider">Total Harga Sewa</p>
                    <p class="text-lg font-extrabold text-gray-900">Rp {{ number_format($booking->total_price,0,',','.') }}</p>
                </div>

                @php
                    $dpPayment = $booking->payments->where('payment_type', 'dp')->sum('amount');
                    $remaining = $booking->total_price - $dpPayment;
                @endphp

                {{-- DP & Sisa inline --}}
                <div class="bg-gray-50 rounded-xl px-3 py-2 flex justify-between items-center gap-2">
                    <div class="flex items-center gap-1.5 text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 flex-shrink-0"></span>
                        <span class="text-gray-500">DP Dibayar</span>
                        <span class="font-bold text-green-600">Rp {{ number_format($dpPayment,0,',','.') }}</span>
                    </div>
                    <div class="w-px h-4 bg-gray-200 flex-shrink-0"></div>
                    <div class="flex items-center gap-1.5 text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>
                        <span class="text-gray-500">Sisa</span>
                        <span class="font-bold text-orange-600">Rp {{ number_format($remaining,0,',','.') }}</span>
                    </div>
                </div>

                <div class="mt-2 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full
                                 bg-orange-100 text-orange-700 text-[9px] font-bold uppercase tracking-wide">
                        <span class="w-1 h-1 rounded-full bg-orange-500 animate-pulse"></span>
                        Pending Pelunasan
                    </span>
                    <span class="text-[10px] text-gray-400">via {{ ucfirst($booking->payments->first()->payment_method ?? '-') }}</span>
                </div>
            </div>
        </div>

        {{-- Nama penyewa --}}
        <div class="mob-detail-row fade-up d3">
            <span class="text-gray-500">Nama Penyewa</span>
            <span class="font-semibold text-gray-800">{{ $booking->user->name }}</span>
        </div>

        {{-- Action buttons (original style: full-width stacked) --}}
        <div class="mob-btns fade-up d3">
            <a href="{{ route('bookings.index') }}"
               class="btn-gold w-full py-3 flex items-center justify-center gap-2
                      rounded-2xl text-white font-bold text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lihat Riwayat Booking
            </a>
            <a href="{{ route('cars.index') }}"
               class="w-full py-2.5 flex items-center justify-center gap-2 rounded-2xl
                      border-2 border-gray-200 bg-white text-gray-700 font-semibold text-sm
                      hover:border-yellow-400 hover:text-yellow-600 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                Booking Mobil Lain
            </a>
        </div>

        {{-- WhatsApp footer (original: separate centered) --}}
        <div class="mob-footer fade-up d4">
            <p class="text-[10px] text-gray-400 mb-1.5">Butuh bantuan?</p>
            <a href="https://wa.me/62xxxxxxxxxx"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                      bg-green-50 border border-green-200 text-green-700 font-semibold text-xs
                      hover:bg-green-100 transition-all">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Hubungi via WhatsApp
            </a>
        </div>

    </div>
</div>


{{-- ══════════════════════════════
     DESKTOP  (≥ 768px)
══════════════════════════════ --}}
<div class="wrap-desktop">
    <div class="desk-bar"></div>

    <div class="desk-center">
        <div class="desk-grid">

            {{-- LEFT --}}
            <div class="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 flex-shrink-0">
                        <svg viewBox="0 0 52 52" class="w-full h-full">
                            <circle cx="26" cy="26" r="25" fill="#fef9c3"/>
                            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#f59e0b" stroke-width="2"/>
                            <path class="checkmark-check" fill="none" stroke="#f59e0b" stroke-width="3.5"
                                  stroke-linecap="round" stroke-linejoin="round" d="M14 27l8 8 16-16"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest">Konfirmasi</p>
                        <h1 class="text-xl font-extrabold text-gray-900 leading-tight">Booking Berhasil!</h1>
                    </div>
                </div>

                {{-- Code --}}
                <div class="mb-5">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1.5">ID Pemesanan</p>
                    <div class="inline-flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-xl px-3.5 py-2">
                        <span class="text-sm font-bold text-amber-700 tracking-widest">{{ $booking->booking_code }}</span>
                        <button onclick="navigator.clipboard.writeText('{{ $booking->booking_code }}')"
                                class="text-amber-400 hover:text-amber-600 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-6">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1.5">Status</p>
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                                 bg-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wide">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                        Pending Pelunasan
                    </span>
                </div>

                {{-- Buttons --}}
                <div class="space-y-2.5">
                    <a href="{{ route('bookings.index') }}"
                       class="desk-btn-gold w-full py-2.5 flex items-center justify-center gap-2 rounded-xl text-white font-bold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Lihat Riwayat Booking
                    </a>
                    <a href="{{ route('cars.index') }}"
                       class="desk-btn-outline w-full py-2.5 flex items-center justify-center gap-2
                              rounded-xl bg-white text-gray-600 font-semibold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Booking Mobil Lain
                    </a>
                </div>

                {{-- WhatsApp --}}
                <div class="mt-5 pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-400 mb-2">Butuh bantuan?</p>
                    <a href="https://wa.me/62xxxxxxxxxx"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                              bg-green-50 border border-green-200 text-green-700 font-semibold text-sm
                              hover:bg-green-100 transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="desk-card fade-up d2">

                {{-- Header --}}
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-0.5">Kendaraan</p>
                        <p class="text-base font-extrabold text-gray-900">{{ $booking->car->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-0.5">Layanan</p>
                        <p class="text-sm font-bold text-gray-700">{{ ucwords(str_replace('_',' ', $booking->service_type)) }}</p>
                    </div>
                </div>

                {{-- Info rows --}}
                <div class="px-6 py-1">
                    <div class="desk-row">
                        <span class="text-gray-500">Nama Penyewa</span>
                        <span class="font-semibold text-gray-800">{{ $booking->user->name }}</span>
                    </div>
                    <div class="desk-row">
                        <span class="text-gray-500">Tanggal Mulai</span>
                        <span class="font-semibold text-gray-800">{{ $booking->start_datetime->format('d M Y') }}</span>
                    </div>
                    <div class="desk-row">
                        <span class="text-gray-500">Tanggal Selesai</span>
                        <span class="font-semibold text-gray-800">{{ $booking->end_datetime->format('d M Y') }}</span>
                    </div>
                    <div class="desk-row">
                        <span class="text-gray-500">Metode Pembayaran</span>
                        <span class="font-semibold text-gray-800 capitalize">{{ $booking->payments->first()->payment_method ?? '-' }}</span>
                    </div>
                </div>

                <div class="mx-6 my-2"><div class="desk-divider"></div></div>

                {{-- Payment --}}
                <div class="px-6 pb-5">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1">Rincian Pembayaran</p>
                    @php
                        $dpPayment = $booking->payments->where('payment_type', 'dp')->sum('amount');
                        $remaining = $booking->total_price - $dpPayment;
                    @endphp
                    <div class="desk-row">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            <span class="text-gray-500">DP Dibayar</span>
                        </div>
                        <span class="font-bold text-green-600">Rp {{ number_format($dpPayment,0,',','.') }}</span>
                    </div>
                    <div class="desk-row">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                            <span class="text-gray-500">Sisa Pelunasan</span>
                        </div>
                        <span class="font-bold text-orange-600">Rp {{ number_format($remaining,0,',','.') }}</span>
                    </div>
                    <div class="mt-4 pt-3 border-t-2 border-gray-100 flex justify-between items-center">
                        <span class="text-sm font-semibold text-gray-500">Total Harga Sewa</span>
                        <span class="text-xl font-extrabold text-gray-900">Rp {{ number_format($booking->total_price,0,',','.') }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        try {
            history.pushState(null, '', location.href);
            history.pushState(null, '', location.href);
        } catch (e) {}
        window.addEventListener('popstate', function () {
            window.location.href = "{{ route('cars.index') }}";
        });
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.replace("{{ route('cars.index') }}");
            }
        };
    });
</script>

</x-app-layout>
