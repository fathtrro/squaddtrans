<x-app-layout>
        <x-alert />

{{-- Booking Form - SQUADTRANS --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #F59E0B;
    --primary-light: #FCD34D;
    --primary-glow: rgba(245, 158, 11, 0.35);
    --dark: #1F2937;
    --darker: #111827;
    --success: #10B981;
    --success-light: #D1FAE5;
    --danger: #EF4444;
    --border: #E5E7EB;
    --text-muted: #6B7280;
    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --shadow-card: 0 4px 20px rgba(0,0,0,0.07);
    --touch-target: 48px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html { -webkit-text-size-adjust: 100%; scroll-behavior: smooth; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(160deg, #f0f4f8 0%, #e8edf2 50%, #f0f4f8 100%);
    min-height: 100vh;
    color: var(--dark);
    overflow-x: hidden;
}

img { max-width: 100%; height: auto; }

/* ============================================================
   PAGE LAYOUT
   ============================================================ */
.page-wrap {
    max-width: 1000px;
    margin: 0 auto;
    padding: 1rem 0.75rem 5rem;
}

@media (min-width: 480px) { .page-wrap { padding: 1.25rem 1rem 4rem; } }
@media (min-width: 640px) { .page-wrap { padding: 2.5rem 1.25rem 4rem; } }

/* ============================================================
   RECAP BANNER
   ============================================================ */
.recap-banner {
    background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
    border-radius: var(--radius-lg);
    padding: 1rem;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 6px 24px rgba(17,24,39,0.22);
    min-width: 0;
}

.recap-banner::before {
    content: '';
    position: absolute;
    top: -60%; right: -20%;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 70%);
    pointer-events: none;
}

.recap-car-img {
    width: 56px; height: 56px;
    border-radius: 12px;
    background: rgba(255,255,255,0.08);
    border: 2px solid rgba(255,255,255,0.12);
    overflow: hidden;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (min-width: 480px) { .recap-car-img { width: 64px; height: 64px; } }
@media (min-width: 640px) { .recap-car-img { width: 72px; height: 72px; } }

.recap-car-img img { width: 100%; height: 100%; object-fit: cover; }
.recap-car-img .fallback-icon { font-size: 1.5rem; color: rgba(255,255,255,0.3); }

.recap-info { flex: 1; min-width: 0; position: relative; z-index: 1; }
.recap-info .recap-label { font-size: 0.625rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.15rem; }
.recap-info .recap-car-name { font-family: 'Montserrat', sans-serif; font-size: 0.9375rem; font-weight: 800; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

@media (min-width: 480px) { .recap-info .recap-car-name { font-size: 1rem; } }
@media (min-width: 640px) { .recap-info .recap-car-name { font-size: 1.1rem; } }

.recap-info .recap-car-sub { font-size: 0.6875rem; color: rgba(255,255,255,0.5); margin-top: 0.1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.recap-right { display: flex; flex-direction: column; align-items: flex-end; gap: 0.4rem; flex-shrink: 0; position: relative; z-index: 1; }

.recap-service-badge { background: rgba(245, 158, 11, 0.2); border: 1.5px solid var(--primary); border-radius: 8px; padding: 0.35rem 0.6rem; display: flex; align-items: center; gap: 0.35rem; }
.recap-service-badge i { font-size: 0.875rem; color: var(--primary); }
.recap-service-text { display: flex; flex-direction: column; }
.recap-service-text .label { font-size: 0.5625rem; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.5px; }
.recap-service-text .value { font-size: 0.75rem; font-weight: 700; color: var(--primary); }

.recap-change-link { font-size: 0.6875rem; font-weight: 600; color: rgba(255,255,255,0.45); text-decoration: none; border-bottom: 1px dashed rgba(255,255,255,0.3); padding-bottom: 1px; white-space: nowrap; transition: color 0.2s; }
.recap-change-link:hover { color: var(--primary); border-color: var(--primary); }

/* ============================================================
   STEP PROGRESS BAR
   ============================================================ */
.progress-bar-wrap { display: flex; align-items: center; justify-content: center; gap: 0; margin-bottom: 1.25rem; padding: 0; }
@media (min-width: 480px) { .progress-bar-wrap { margin-bottom: 1.75rem; } }

.prog-step { display: flex; flex-direction: column; align-items: center; position: relative; flex: 0 0 auto; }

.prog-dot {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: #dde2e8;
    color: #9ca3af;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8125rem; font-weight: 700;
    transition: all 0.4s cubic-bezier(.4,0,.2,1);
    position: relative; z-index: 2;
    border: 3px solid #dde2e8;
}

@media (min-width: 360px) { .prog-dot { width: 36px; height: 36px; } }
@media (min-width: 480px) { .prog-dot { width: 38px; height: 38px; } }

.prog-dot.active { background: var(--primary); border-color: var(--primary); color: var(--darker); box-shadow: 0 0 0 4px var(--primary-glow); transform: scale(1.1); }
.prog-dot.done   { background: var(--success); border-color: var(--success); color: white; }

.prog-label { font-size: 0.5625rem; font-weight: 600; color: #9ca3af; margin-top: 0.4rem; text-transform: uppercase; letter-spacing: 0.3px; transition: color 0.3s; white-space: nowrap; }
@media (min-width: 360px) { .prog-label { font-size: 0.625rem; } }
@media (min-width: 480px) { .prog-label { font-size: 0.6875rem; letter-spacing: 0.5px; } }
.prog-label.active { color: var(--primary); font-weight: 700; }
.prog-label.done   { color: var(--success); }

.prog-line { width: 40px; height: 3px; background: #dde2e8; border-radius: 2px; overflow: hidden; align-self: center; margin-bottom: 1.55rem; flex-shrink: 0; }
@media (min-width: 360px) { .prog-line { width: 48px; } }
@media (min-width: 480px) { .prog-line { width: 64px; margin-bottom: 1.7rem; } }
@media (min-width: 640px) { .prog-line { width: 80px; } }

.prog-line-fill { height: 100%; width: 0%; background: linear-gradient(90deg, var(--primary-light), var(--primary)); border-radius: 2px; transition: width 0.5s cubic-bezier(.4,0,.2,1); }

/* ============================================================
   FORM CARD
   ============================================================ */
.form-card { background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); overflow: hidden; }

.form-card-header {
    background: linear-gradient(135deg, var(--darker), var(--dark));
    padding: 1.125rem 1.25rem;
    display: flex; align-items: center; gap: 0.75rem;
    position: relative; overflow: hidden;
}

@media (min-width: 640px) { .form-card-header { padding: 1.5rem 1.75rem; } }

.form-card-header::after {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}

.form-card-header-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary-light), var(--primary)); border-radius: 11px; display: flex; align-items: center; justify-content: center; color: var(--darker); font-size: 1.125rem; position: relative; z-index: 1; flex-shrink: 0; }
@media (min-width: 640px) { .form-card-header-icon { width: 44px; height: 44px; font-size: 1.25rem; } }

.form-card-header-text { position: relative; z-index: 1; min-width: 0; }
.form-card-header-text h3 { font-family: 'Montserrat', sans-serif; font-size: 1rem; font-weight: 800; color: white; }
@media (min-width: 480px) { .form-card-header-text h3 { font-size: 1.1rem; } }
@media (min-width: 640px) { .form-card-header-text h3 { font-size: 1.15rem; } }
.form-card-header-text p { font-size: 0.725rem; color: rgba(255,255,255,0.45); margin-top: 0.1rem; }

.form-card-body { padding: 1.25rem; }
@media (min-width: 480px) { .form-card-body { padding: 1.5rem; } }
@media (min-width: 640px) { .form-card-body { padding: 2rem 2.25rem 2.25rem; } }

/* ============================================================
   STEPS
   ============================================================ */
.step-panel { display: none; animation: stepIn 0.35s cubic-bezier(.4,0,.2,1); }
.step-panel.active { display: block; }

@keyframes stepIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ============================================================
   FORM CONTROLS
   ============================================================ */
.field { margin-bottom: 1.25rem; }
.field:last-child { margin-bottom: 0; }
@media (min-width: 480px) { .field { margin-bottom: 1.5rem; } }

.field-label { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8125rem; font-weight: 600; color: var(--dark); margin-bottom: 0.5rem; }
.field-label i { width: 26px; height: 26px; background: #FEF3C7; border-radius: 7px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 0.65rem; flex-shrink: 0; }

.form-input {
    width: 100%;
    min-height: var(--touch-target);
    padding: 0.75rem 1rem;
    border: 2px solid var(--border);
    border-radius: var(--radius-sm);
    font-family: inherit;
    font-size: 1rem;
    color: var(--dark);
    background: #fafbfc;
    transition: all 0.25s;
    outline: none;
    -webkit-appearance: none;
    appearance: none;
}

.form-input:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 3px var(--primary-glow); }
.form-input::placeholder { color: #b0b7c3; }
.form-input[type="datetime-local"] { cursor: pointer; }
.form-input[type="datetime-local"]::-webkit-calendar-picker-indicator { cursor: pointer; filter: hue-rotate(30deg) saturate(1.4); width: 20px; height: 20px; }
textarea.form-input { resize: vertical; min-height: 80px; font-size: 1rem; }

.field-hint { font-size: 0.72rem; color: var(--text-muted); margin-top: 0.35rem; display: flex; align-items: flex-start; gap: 0.3rem; line-height: 1.4; }
.field-hint i { font-size: 0.65rem; color: #9ca3af; flex-shrink: 0; margin-top: 2px; }

.field-error { font-size: 0.72rem; color: var(--danger); margin-top: 0.35rem; display: none; align-items: center; gap: 0.3rem; }
.field-error i { font-size: 0.65rem; }
.field.has-error .form-input { border-color: var(--danger); background: #fef2f2; }
.field.has-error .field-error { display: flex; }

.grid-2 { display: grid; grid-template-columns: 1fr; gap: 0; }
@media (min-width: 480px) { .grid-2 { grid-template-columns: 1fr 1fr; gap: 1rem; } .grid-2 .field { margin-bottom: 0; } }

/* ============================================================
   DURATION SUMMARY BOX
   ============================================================ */
.duration-box { background: linear-gradient(135deg, #FEF3C7, #FDE68A); border: 2px solid var(--primary); border-radius: var(--radius-md); padding: 1rem 1.25rem; margin-top: 1.25rem; position: relative; overflow: hidden; display: none; }
.duration-box.show { display: block; animation: stepIn 0.3s ease; }
.duration-box::before { content: ''; position: absolute; top: -40%; right: -30%; width: 180px; height: 180px; background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%); pointer-events: none; }
.duration-box-inner { position: relative; z-index: 1; }
.duration-row { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; }
.duration-row + .duration-row { border-top: 1px solid rgba(217,119,6,0.2); }
.duration-row .dr-label { font-size: 0.8rem; color: #92400e; font-weight: 600; }
.duration-row .dr-value { font-size: 0.8rem; font-weight: 700; color: #78350f; }
.duration-row.total { border-top: 2px solid #d97706 !important; margin-top: 0.35rem; padding-top: 0.65rem; }
.duration-row.total .dr-label { font-size: 0.875rem; font-weight: 700; color: #78350f; }
.duration-row.total .dr-value { font-family: 'Montserrat', sans-serif; font-size: 1.35rem; font-weight: 900; background: linear-gradient(135deg, #d97706, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
@media (min-width: 360px) { .duration-row.total .dr-value { font-size: 1.5rem; } }

/* ============================================================
   RADIO CARD GRID
   ============================================================ */
.card-radio-grid { display: grid; grid-template-columns: 1fr; gap: 0.625rem; }
@media (min-width: 360px) { .card-radio-grid { grid-template-columns: repeat(3, 1fr); gap: 0.5rem; } }
@media (min-width: 520px) { .card-radio-grid { grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 0.75rem; } }

.card-radio { border: 2px solid var(--border); border-radius: var(--radius-sm); padding: 0.75rem; cursor: pointer; transition: all 0.25s; background: white; position: relative; min-height: var(--touch-target); -webkit-tap-highlight-color: transparent; }
@media (min-width: 480px) { .card-radio { padding: 1rem; border-radius: var(--radius-md); } }
.card-radio:hover { border-color: #d1d5db; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
@media (hover: none) { .card-radio:hover { transform: none; } }
.card-radio:active { transform: scale(0.98); }
.card-radio.selected { border-color: var(--primary); background: linear-gradient(135deg, #fffbeb, #fef3c7); box-shadow: 0 4px 14px var(--primary-glow); }
.card-radio input[type="radio"] { display: none; }
.card-radio .tick { position: absolute; top: 0.45rem; right: 0.45rem; width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--border); background: white; display: flex; align-items: center; justify-content: center; font-size: 0.55rem; color: transparent; transition: all 0.25s; }
.card-radio.selected .tick { background: var(--primary); border-color: var(--primary); color: var(--darker); }
.card-radio-icon { width: 36px; height: 36px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 0.9375rem; margin-bottom: 0.5rem; }
@media (min-width: 480px) { .card-radio-icon { width: 42px; height: 42px; font-size: 1.125rem; margin-bottom: 0.6rem; } }
.icon-yellow { background: #FEF3C7; color: #d97706; }
.icon-blue   { background: #DBEAFE; color: #2563eb; }
.icon-green  { background: #D1FAE5; color: #059669; }
.icon-orange { background: #FFEDD5; color: #ea580c; }
.card-radio-title { font-size: 0.75rem; font-weight: 700; color: var(--dark); margin-bottom: 0.1rem; }
.card-radio-sub { font-size: 0.625rem; color: var(--text-muted); line-height: 1.3; }
@media (min-width: 480px) { .card-radio-title { font-size: 0.8125rem; } .card-radio-sub { font-size: 0.6875rem; } }

/* ============================================================
   FILE UPLOAD – dengan inline image preview
   ============================================================ */
.upload-zone {
    border: 2px dashed #d1d5db;
    border-radius: var(--radius-sm);
    padding: 1.5rem 1rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: #fafbfc;
    position: relative;
    min-height: 100px;
}

@media (min-width: 480px) { .upload-zone { padding: 1.75rem 1rem; border-radius: var(--radius-md); } }

.upload-zone-prompt { pointer-events: none; }

/* Mode preview – kotak berubah jadi container gambar */
.upload-zone.has-file { padding: 0; border-style: solid; border-color: var(--primary); background: white; cursor: default; min-height: 0; }
.upload-zone.has-file .upload-zone-prompt { display: none; }
.upload-zone.has-file > input[type="file"] { display: none; }

.upload-zone:hover, .upload-zone.dragover { border-color: var(--primary); background: #fffbeb; }
.upload-zone.has-file:hover { background: white; }

.upload-zone input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

.upload-zone-icon { font-size: 1.75rem; color: #c4c9d4; margin-bottom: 0.5rem; transition: color 0.3s; }
.upload-zone:hover .upload-zone-icon { color: var(--primary); }
.upload-zone p { font-size: 0.7875rem; color: var(--text-muted); }
.upload-zone p strong { color: var(--dark); }

/* Preview di dalam kotak */
.upload-preview { display: none; flex-direction: column; width: 100%; border-radius: var(--radius-sm); overflow: hidden; animation: stepIn 0.3s ease; }
.upload-preview.show { display: flex; }

.upload-preview-thumb { width: 100%; min-height: 160px; max-height: 260px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative; }
.upload-preview-thumb img { width: 100%; height: 100%; max-height: 260px; object-fit: contain; display: block; }

.upload-preview-thumb .thumb-fallback { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.625rem; padding: 2.5rem 1rem; color: #6B7280; }
.upload-preview-thumb .thumb-fallback i { font-size: 3rem; color: #3B82F6; }
.upload-preview-thumb .thumb-fallback span { font-size: 0.75rem; font-weight: 600; color: #374151; text-align: center; word-break: break-all; max-width: 200px; }

.upload-preview-meta { display: flex; align-items: center; gap: 0.625rem; padding: 0.625rem 0.875rem; background: #f0fdf4; border-top: 1.5px solid #6ee7b7; }
.upload-preview-icon { width: 30px; height: 30px; background: var(--success-light); border-radius: 7px; display: flex; align-items: center; justify-content: center; color: var(--success); font-size: 0.8125rem; flex-shrink: 0; }
.upload-preview-name { flex: 1; font-size: 0.725rem; font-weight: 600; color: var(--dark); word-break: break-all; line-height: 1.35; min-width: 0; }
.upload-preview-size { font-size: 0.65rem; color: var(--text-muted); font-weight: 400; margin-top: 0.1rem; }

.upload-remove { background: #fee2e2; border: none; color: var(--danger); font-size: 0.7rem; cursor: pointer; padding: 0.4rem 0.7rem; border-radius: 7px; transition: background 0.2s; flex-shrink: 0; min-width: 44px; min-height: 36px; display: flex; align-items: center; justify-content: center; gap: 0.25rem; font-weight: 600; }
.upload-remove:hover, .upload-remove:active { background: #fca5a5; color: #7f1d1d; }

/* ============================================================
   DP INPUT
   ============================================================ */
.input-prefix-wrap { position: relative; }
.input-prefix { position: absolute; left: 0; top: 0; bottom: 0; width: 3rem; background: #f0f2f5; border-right: 2px solid var(--border); border-radius: var(--radius-sm) 0 0 var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; color: var(--text-muted); }
.input-prefix-wrap .form-input { padding-left: 3.5rem; border-radius: var(--radius-sm); }

/* ============================================================
   BANK INFO BOX
   ============================================================ */
.bank-info-box { background: linear-gradient(135deg, #DBEAFE, #BFDBFE); border: 2px solid #3B82F6; border-radius: var(--radius-md); padding: 1rem 1.25rem; margin-top: 0.875rem; display: none; }
.bank-info-box.show { display: block; animation: stepIn 0.3s ease; }
.bank-info-title { font-family: 'Montserrat', sans-serif; font-size: 0.8125rem; font-weight: 800; color: #1E40AF; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
.bank-info-title i { color: #3B82F6; }
.bank-item { background: white; border-radius: 9px; padding: 0.75rem 0.875rem; margin-bottom: 0.625rem; border: 1px solid #93C5FD; }
.bank-item:last-child { margin-bottom: 0; }
.bank-name { font-size: 0.7rem; font-weight: 700; color: #1E3A8A; margin-bottom: 0.3rem; }
.bank-account { display: flex; justify-content: space-between; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
.bank-number { font-family: 'Montserrat', sans-serif; font-size: 0.875rem; font-weight: 700; color: #1E40AF; letter-spacing: 0.5px; }
.copy-btn { background: #DBEAFE; border: none; padding: 0.5rem 0.75rem; min-height: 36px; border-radius: 6px; font-size: 0.7rem; font-weight: 600; color: #1E40AF; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 0.3rem; }
.copy-btn:hover, .copy-btn:active { background: #3B82F6; color: white; }
.bank-holder { font-size: 0.7rem; color: #6B7280; margin-top: 0.2rem; }

/* ============================================================
   PAYMENT SUMMARY BOX
   ============================================================ */
.pay-summary { background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 2px solid #6ee7b7; border-radius: var(--radius-md); padding: 1rem 1.25rem; margin-top: 1.125rem; }
@media (min-width: 480px) { .pay-summary { padding: 1.25rem 1.5rem; } }
.pay-summary-title { font-family: 'Montserrat', sans-serif; font-size: 0.8125rem; font-weight: 800; color: #065f46; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
.pay-row { display: flex; justify-content: space-between; align-items: center; padding: 0.375rem 0; font-size: 0.8rem; }
.pay-row .pr-label { color: #047857; font-weight: 500; }
.pay-row .pr-val { color: #065f46; font-weight: 700; }
.pay-row.highlight { border-top: 2px solid #6ee7b7; margin-top: 0.5rem; padding-top: 0.65rem; }
.pay-row.highlight .pr-label { font-size: 0.8125rem; font-weight: 700; color: #065f46; }
.pay-row.highlight .pr-val { font-family: 'Montserrat', sans-serif; font-size: 1.15rem; font-weight: 900; color: var(--success); }
@media (min-width: 360px) { .pay-row.highlight .pr-val { font-size: 1.35rem; } }

/* ============================================================
   NAV BUTTONS
   ============================================================ */
.nav-buttons-desktop { display: none; justify-content: space-between; align-items: center; padding-top: 1.75rem; margin-top: 0.25rem; border-top: 2px solid #f0f2f5; }

.nav-buttons-mobile { position: fixed; bottom: 0; left: 0; right: 0; background: white; border-top: 1px solid #e5e7eb; padding: 0.75rem 1rem; display: flex; gap: 0.625rem; z-index: 100; padding-bottom: calc(0.75rem + env(safe-area-inset-bottom, 0px)); box-shadow: 0 -4px 20px rgba(0,0,0,0.08); }

@media (min-width: 640px) { .nav-buttons-desktop { display: flex; } .nav-buttons-mobile { display: none; } }

.btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem; padding: 0 1.25rem; height: var(--touch-target); border-radius: var(--radius-sm); font-family: inherit; font-size: 0.8125rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.25s; text-decoration: none; white-space: nowrap; -webkit-tap-highlight-color: transparent; }

.nav-buttons-mobile .btn { flex: 1; height: 48px; border-radius: 12px; }
.nav-buttons-mobile .btn-next, .nav-buttons-mobile .btn-submit { flex: 2; }

.btn-back { background: #f3f4f6; color: var(--text-muted); }
.btn-back:hover, .btn-back:active { background: #e5e7eb; color: var(--dark); }
.btn-next { background: linear-gradient(135deg, var(--primary-light), var(--primary)); color: var(--darker); box-shadow: 0 4px 14px var(--primary-glow); margin-left: auto; }
.btn-next:hover, .btn-next:active { transform: translateY(-1px); box-shadow: 0 6px 20px var(--primary-glow); }
.btn-submit { background: linear-gradient(135deg, #34d399, var(--success)); color: white; box-shadow: 0 4px 14px rgba(16,185,129,0.3); margin-left: auto; }
.btn-submit:hover, .btn-submit:active { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }
.btn-hidden { display: none !important; }

/* ============================================================
   CONFIRMATION MODAL
   ============================================================ */
.confirm-overlay { position: fixed; inset: 0; background: rgba(17,24,39,0.6); backdrop-filter: blur(4px); z-index: 5000; display: flex; align-items: flex-end; justify-content: center; opacity: 0; pointer-events: none; transition: opacity 0.3s; padding: 0; }
@media (min-width: 480px) { .confirm-overlay { align-items: center; padding: 1rem; } }
.confirm-overlay.show { opacity: 1; pointer-events: auto; }

.confirm-modal { background: white; border-radius: 24px 24px 0 0; width: 100%; max-width: 100%; max-height: 92vh; overflow-y: auto; transform: translateY(100%); transition: transform 0.4s cubic-bezier(.32,.72,0,1); box-shadow: 0 -10px 40px rgba(0,0,0,0.2); scrollbar-width: thin; -webkit-overflow-scrolling: touch; }
@media (min-width: 480px) { .confirm-modal { border-radius: 24px; max-width: 480px; max-height: 90vh; transform: scale(0.9) translateY(16px); box-shadow: 0 30px 60px rgba(0,0,0,0.25); } }
.confirm-overlay.show .confirm-modal { transform: translateY(0); }
@media (min-width: 480px) { .confirm-overlay.show .confirm-modal { transform: scale(1) translateY(0); } }

.confirm-modal::before { content: ''; display: block; width: 40px; height: 4px; background: #e5e7eb; border-radius: 2px; margin: 0.75rem auto 0; }
@media (min-width: 480px) { .confirm-modal::before { display: none; } }

.confirm-header { background: linear-gradient(135deg, var(--darker), var(--dark)); border-radius: 0; padding: 1.25rem 1.5rem 1rem; text-align: center; position: relative; overflow: hidden; }
@media (min-width: 480px) { .confirm-header { border-radius: 24px 24px 0 0; padding: 1.5rem 1.75rem 1.25rem; } }
.confirm-header::before { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at 50% 0%, rgba(245,158,11,0.15) 0%, transparent 60%); }
.confirm-header-icon { width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary-light), var(--primary)); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.625rem; font-size: 1.375rem; color: var(--darker); position: relative; z-index: 1; box-shadow: 0 6px 16px var(--primary-glow); }
.confirm-header h3 { font-family: 'Montserrat', sans-serif; font-size: 1.0625rem; font-weight: 800; color: white; position: relative; z-index: 1; }
.confirm-header p { font-size: 0.725rem; color: rgba(255,255,255,0.45); margin-top: 0.2rem; position: relative; z-index: 1; }

.confirm-body { padding: 1.25rem 1.375rem; }
@media (min-width: 480px) { .confirm-body { padding: 1.5rem 1.75rem; } }

.confirm-section-title { font-size: 0.625rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.5rem; margin-top: 0.875rem; }
.confirm-section-title:first-child { margin-top: 0; }

.confirm-row { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid #f3f4f6; gap: 0.5rem; }
.confirm-row:last-of-type { border-bottom: none; }
.confirm-row .cr-label { font-size: 0.75rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.35rem; flex-shrink: 0; }
.confirm-row .cr-label i { color: #c4c9d4; font-size: 0.65rem; }
.confirm-row .cr-val { font-size: 0.75rem; font-weight: 600; color: var(--dark); text-align: right; word-break: break-word; }

.confirm-total { background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 2px solid #6ee7b7; border-radius: 12px; padding: 0.875rem 1.125rem; margin-top: 1.125rem; display: flex; justify-content: space-between; align-items: center; }
.confirm-total .ct-label { font-size: 0.8125rem; font-weight: 700; color: #065f46; }
.confirm-total .ct-val { font-family: 'Montserrat', sans-serif; font-size: 1.25rem; font-weight: 900; color: var(--success); }

.confirm-footer { padding: 1rem 1.375rem; padding-bottom: calc(1rem + env(safe-area-inset-bottom, 0px)); display: flex; gap: 0.625rem; position: sticky; bottom: 0; background: white; border-top: 1px solid #f3f4f6; }
@media (min-width: 480px) { .confirm-footer { padding: 1.25rem 1.75rem 1.75rem; position: static; border-top: none; } }

.btn-confirm-back { flex: 1; background: #f3f4f6; color: var(--text-muted); }
.btn-confirm-back:hover { background: #e5e7eb; color: var(--dark); }
.btn-confirm-submit { flex: 1.6; background: linear-gradient(135deg, #34d399, var(--success)); color: white; box-shadow: 0 4px 14px rgba(16,185,129,0.3); }
.btn-confirm-submit:hover, .btn-confirm-submit:active { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }

/* ============================================================
   LOADING OVERLAY
   ============================================================ */
.loading-overlay { position: fixed; inset: 0; background: rgba(17,24,39,0.75); z-index: 9999; display: none; align-items: center; justify-content: center; flex-direction: column; gap: 1rem; }
.loading-overlay.active { display: flex; }
.spinner { width: 44px; height: 44px; border: 4px solid rgba(255,255,255,0.15); border-top-color: var(--primary); border-radius: 50%; animation: spin 0.7s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.loading-overlay p { color: white; font-size: 0.875rem; font-weight: 600; }

/* ============================================================
   INFO STRIP
   ============================================================ */
.info-strip { background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-left: 4px solid #3b82f6; border-radius: 12px; padding: 0.875rem 1rem; margin-top: 1.25rem; display: flex; gap: 0.625rem; align-items: flex-start; }
.info-strip i { color: #2563eb; font-size: 1rem; flex-shrink: 0; margin-top: 0.1rem; }
.info-strip p { font-size: 0.75rem; color: #1e3a5f; line-height: 1.5; }
.info-strip p strong { color: #1e40af; }

/* ============================================================
   SELECT / UTILITIES
   ============================================================ */
select.form-input { appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 2.5rem; cursor: pointer; }

.hidden { display: none !important; }
.form-card-body .step-panel:last-child { padding-bottom: 0.5rem; }
.section-divider { border: none; border-top: 2px dashed #f0f2f5; margin: 1.25rem 0; }
.confirm-modal::-webkit-scrollbar { width: 4px; }
.confirm-modal::-webkit-scrollbar-track { background: transparent; }
.confirm-modal::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 2px; }

/* ============================================================
   DRAFT INDICATOR – pojok kanan atas form card
   ============================================================ */
.draft-indicator {
    display: none;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.65rem;
    font-weight: 600;
    color: var(--success);
    background: var(--success-light);
    border: 1px solid #6ee7b7;
    border-radius: 999px;
    padding: 0.2rem 0.6rem;
    position: absolute;
    top: 1rem; right: 1rem;
    z-index: 2;
    animation: stepIn 0.3s ease;
}

.draft-indicator.show { display: flex; }
.draft-indicator i { font-size: 0.6rem; }
</style>

<!-- ============================================================
     CONFIRMATION MODAL
     ============================================================ -->
<div class="confirm-overlay" id="confirmOverlay">
    <div class="confirm-modal">
        <div class="confirm-header">
            <div class="confirm-header-icon"><i class="fa-solid fa-clipboard-check"></i></div>
            <h3>Konfirmasi Pesanan</h3>
            <p>Pastikan semua detail sudah benar</p>
        </div>

        <div class="confirm-body">
            <div class="confirm-section-title"><i class="fa-solid fa-car"></i> &nbsp;Mobil</div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-tag"></i> Mobil</span><span class="cr-val" id="cfCarName">–</span></div>

            <div class="confirm-section-title"><i class="fa-solid fa-calendar-days"></i> &nbsp;Waktu Sewa</div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-play"></i> Mulai</span><span class="cr-val" id="cfStart">–</span></div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-stop"></i> Selesai</span><span class="cr-val" id="cfEnd">–</span></div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-hourglass-half"></i> Durasi</span><span class="cr-val" id="cfDuration">–</span></div>

            <div class="confirm-section-title"><i class="fa-solid fa-user"></i> &nbsp;Data Penyewa</div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-phone"></i> Kontak</span><span class="cr-val" id="cfContact">–</span></div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-location-dot"></i> Alamat</span><span class="cr-val" id="cfAlamat">–</span></div>

            <div class="confirm-section-title"><i class="fa-solid fa-briefcase"></i> &nbsp;Layanan</div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-key"></i> Jenis Layanan</span><span class="cr-val" id="cfService">Lepas Kunci</span></div>

            <div class="confirm-section-title"><i class="fa-solid fa-shield-halved"></i> &nbsp;Jaminan</div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-id-card"></i> Tipe Jaminan</span><span class="cr-val" id="cfGuarantee">–</span></div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-file"></i> Dokumen</span><span class="cr-val" id="cfDoc">–</span></div>

            <div class="confirm-section-title"><i class="fa-solid fa-credit-card"></i> &nbsp;Pembayaran</div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-wallet"></i> Metode</span><span class="cr-val" id="cfPayMethod">–</span></div>
            <div class="confirm-row hidden" id="cfBankRow"><span class="cr-label"><i class="fa-solid fa-building-columns"></i> Bank</span><span class="cr-val" id="cfBank">–</span></div>
            <div class="confirm-row hidden" id="cfProofRow"><span class="cr-label"><i class="fa-solid fa-receipt"></i> Bukti Bayar</span><span class="cr-val" id="cfProof">–</span></div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-money-bill-wave"></i> Total Harga</span><span class="cr-val" id="cfTotalPrice">–</span></div>
            <div class="confirm-row"><span class="cr-label"><i class="fa-solid fa-hand-holding-dollar"></i> DP Dibayar</span><span class="cr-val" id="cfDP">–</span></div>

            <div class="confirm-total">
                <span class="ct-label">Sisa Pembayaran</span>
                <span class="ct-val" id="cfRemaining">Rp 0</span>
            </div>
        </div>

        <div class="confirm-footer">
            <button type="button" class="btn btn-confirm-back" id="confirmBack"><i class="fa-solid fa-arrow-left"></i> Edit Lagi</button>
            <button type="button" class="btn btn-confirm-submit" id="confirmSubmit"><i class="fa-solid fa-check-circle"></i> Konfirmasi & Pesan</button>
        </div>
    </div>
</div>

<!-- LOADING OVERLAY -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
    <p>Memproses booking Anda...</p>
</div>

<!-- ============================================================
     PAGE
     ============================================================ -->
<div class="page-wrap">

    @if($car)
    <div class="recap-banner">
        <div class="recap-car-img">
            @if($car->images->first())
                <img src="{{ asset('storage/'.$car->images->first()->image_path) }}" alt="{{ $car->name }}">
            @else
                <i class="fa-solid fa-car fallback-icon"></i>
            @endif
        </div>
        <div class="recap-info">
            <div class="recap-label">Mobil yang dipilih</div>
            <div class="recap-car-name">{{ $car->brand }} {{ $car->name }}</div>
            <div class="recap-car-sub">{{ $car->year }} &middot; {{ ucfirst($car->transmission) }} &middot; {{ $car->seats }} Kursi</div>
        </div>
        <div class="recap-right">
            <div class="recap-service-badge">
                <i class="fa-solid fa-key"></i>
                <div class="recap-service-text">
                    <span class="label">Jenis Sewa</span>
                    <span class="value">Lepas Kunci</span>
                </div>
            </div>
            <a href="{{ route('cars.show', $car->id) }}" class="recap-change-link">
                <i class="fa-solid fa-pen-to-square"></i> Ganti Mobil
            </a>
        </div>
    </div>
    @endif

    <!-- Progress Bar -->
    <div class="progress-bar-wrap" id="progressBar"></div>

    <!-- Form Card -->
    <div class="form-card" style="position:relative;">

        <!-- Draft indicator badge -->
        <div class="draft-indicator" id="draftIndicator">
            <i class="fa-solid fa-floppy-disk"></i> Draft tersimpan
        </div>

        <div class="form-card-header" id="formHeader">
            <div class="form-card-header-icon" id="headerIcon"><i class="fa-solid fa-clock"></i></div>
            <div class="form-card-header-text">
                <h3 id="headerTitle">Waktu Sewa</h3>
                <p id="headerSub">Tentukan kapan Anda ingin menyewa</p>
            </div>
        </div>

        <div class="form-card-body">
            <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data" id="bookingForm">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <input type="hidden" name="total_price" id="totalPriceInput" value="0">
                <input type="hidden" name="service_type" value="lepas_kunci">
                <input type="hidden" name="driver_id" value="" id="hiddenDriverId">
                <input type="hidden" name="duration_mode" id="durationModeHidden" value="24">
                <input type="hidden" name="base_price" id="basePriceHidden" value="0">
                <input type="hidden" name="min_deposit" id="minDepositHidden" value="0">
                <input type="hidden" name="days" id="daysHidden" value="0">

                <!-- STEP 0 – Waktu & Data Penyewa -->
                <div class="step-panel active" data-step="0">
                    <div class="grid-2">
                        <div class="field" id="fieldStart">
                            <label class="field-label"><i><i class="fa-solid fa-play" style="font-size:0.6rem;"></i></i> Tanggal Mulai</label>
                            <input type="datetime-local" name="start_datetime" id="startInput" class="form-input"
                                   value="{{ $startDate ? \Carbon\Carbon::parse($startDate)->format('Y-m-d') . 'T08:00' : (request('start') ? \Carbon\Carbon::parse(request('start'))->format('Y-m-d') . 'T08:00' : '') }}" required>
                            <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> Pilih tanggal mulai</div>
                        </div>
                        <div class="field" id="fieldEnd">
                            <label class="field-label"><i><i class="fa-solid fa-stop" style="font-size:0.6rem;"></i></i> Tanggal Selesai</label>
                            <input type="datetime-local" name="end_datetime" id="endInput" class="form-input"
                                   value="{{ $endDate ? \Carbon\Carbon::parse($endDate)->format('Y-m-d') . 'T08:00' : (request('end') ? \Carbon\Carbon::parse(request('end'))->format('Y-m-d') . 'T08:00' : '') }}" required>
                            <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> Pilih tanggal selesai</div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label"><i><i class="fa-solid fa-location-dot" style="font-size:0.65rem;"></i></i> Tujuan <span style="color:#9ca3af;font-weight:400;margin-left:0.25rem;">(opsional)</span></label>
                        <input type="text" name="destination" class="form-input" placeholder="Misal: Jakarta – Bandung">
                    </div>

                    <hr class="section-divider">

                    <div style="font-size:0.6875rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:0.875rem;">
                        <i class="fa-solid fa-user" style="color:#c4c9d4;margin-right:0.35rem;"></i> Data Penyewa
                    </div>

                    <div class="grid-2">
                        <div class="field" id="fieldContact">
                            <label class="field-label"><i><i class="fa-solid fa-phone" style="font-size:0.6rem;"></i></i> Nomor Kontak</label>
                            <input type="tel" name="contact" id="contactInput" class="form-input" placeholder="08xxxxxxxxxx" inputmode="tel" autocomplete="tel" required>
                            <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> Masukkan nomor kontak</div>
                        </div>
                        <div class="field" id="fieldAlamat">
                            <label class="field-label"><i><i class="fa-solid fa-map-marker-alt" style="font-size:0.65rem;"></i></i> Alamat</label>
                            <input type="text" name="alamat" id="alamatInput" class="form-input" placeholder="Alamat lengkap Anda" autocomplete="street-address" required>
                            <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> Masukkan alamat</div>
                        </div>
                    </div>

                    <div class="duration-box" id="durationBox">
                        <div class="duration-box-inner">
                            <div class="duration-row" id="durationModeInfo" style="display:none; padding-bottom:0.5rem; border-bottom:1px solid rgba(217,119,6,0.15);">
                                <span class="dr-label">Mode Sewa</span><span class="dr-value" id="durationModeText">—</span>
                            </div>
                            <div class="duration-row"><span class="dr-label">Durasi</span><span class="dr-value"><span id="durDays">0</span> hari</span></div>
                            <div class="duration-row"><span class="dr-label">Harga/hari</span><span class="dr-value" id="durPricePerDay">Rp 0</span></div>
                            <div class="duration-row total"><span class="dr-label">Total Harga</span><span class="dr-value" id="durTotal">Rp 0</span></div>
                        </div>
                    </div>
                </div>

                <!-- STEP 1 – Jaminan -->
                <div class="step-panel" data-step="1">
                    <div class="field">
                        <label class="field-label"><i><i class="fa-solid fa-id-card" style="font-size:0.6rem;"></i></i> Tipe Jaminan</label>
                        <div class="card-radio-grid" id="guaranteeGrid">
                            <label class="card-radio selected" data-value="ktp">
                                <input type="radio" name="guarantee_type" value="ktp" checked>
                                <div class="tick"><i class="fa-solid fa-check"></i></div>
                                <div class="card-radio-icon icon-blue"><i class="fa-solid fa-id-card"></i></div>
                                <div class="card-radio-title">KTP</div>
                                <div class="card-radio-sub">Kartu Tanda Penduduk</div>
                            </label>
                            <label class="card-radio" data-value="sim">
                                <input type="radio" name="guarantee_type" value="sim">
                                <div class="tick"><i class="fa-solid fa-check"></i></div>
                                <div class="card-radio-icon icon-green"><i class="fa-solid fa-address-card"></i></div>
                                <div class="card-radio-title">SIM</div>
                                <div class="card-radio-sub">Surat Izin Mengemudi</div>
                            </label>
                            <label class="card-radio" data-value="motor">
                                <input type="radio" name="guarantee_type" value="motor">
                                <div class="tick"><i class="fa-solid fa-check"></i></div>
                                <div class="card-radio-icon icon-orange"><i class="fa-solid fa-motorcycle"></i></div>
                                <div class="card-radio-title">BPKB Motor</div>
                                <div class="card-radio-sub">Surat kepemilikan</div>
                            </label>
                        </div>
                    </div>

                    <div class="field" id="fieldDoc">
                        <label class="field-label"><i><i class="fa-solid fa-upload" style="font-size:0.6rem;"></i></i> Upload Dokumen Jaminan</label>
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="document_file" id="docFile" accept="image/*,application/pdf" required>
                            <div class="upload-zone-prompt" id="uploadPrompt">
                                <div class="upload-zone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <p><strong>Ketuk untuk upload</strong></p>
                                <p style="margin-top:0.25rem;">JPG, PNG, atau PDF · Maks 2MB</p>
                            </div>
                            <div class="upload-preview" id="uploadPreview">
                                <div class="upload-preview-thumb" id="uploadThumb"></div>
                                <div class="upload-preview-meta">
                                    <div class="upload-preview-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                                    <div style="flex:1;min-width:0;">
                                        <div class="upload-preview-name" id="uploadFileName">—</div>
                                        <div class="upload-preview-size" id="uploadFileSize"></div>
                                    </div>
                                    <button type="button" class="upload-remove" id="uploadRemove"><i class="fa-solid fa-xmark"></i> Hapus</button>
                                </div>
                            </div>
                        </div>
                        <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> Upload dokumen jaminan Anda</div>
                    </div>
                </div>

                <!-- STEP 2 – Pembayaran -->
                <div class="step-panel" data-step="2">
                    <div class="field">
                        <label class="field-label"><i><i class="fa-solid fa-wallet" style="font-size:0.6rem;"></i></i> Metode Pembayaran</label>
                        <div class="card-radio-grid" id="paymentGrid">
                            <label class="card-radio selected" data-value="transfer">
                                <input type="radio" name="payment_method" value="transfer" checked>
                                <div class="tick"><i class="fa-solid fa-check"></i></div>
                                <div class="card-radio-icon icon-blue"><i class="fa-solid fa-building-columns"></i></div>
                                <div class="card-radio-title">Transfer Bank</div>
                                <div class="card-radio-sub">Via rekening</div>
                            </label>
                        </div>
                    </div>

                    <div class="field" id="fieldBank">
                        <label class="field-label"><i><i class="fa-solid fa-building-columns" style="font-size:0.6rem;"></i></i> Pilih Bank</label>
                        <select name="selected_bank" id="bankSelect" class="form-input">
                            <option value="">— Pilih Bank —</option>
                            @forelse($bankAccounts as $bank)
                                <option value="{{ $bank->id }}" data-bank-name="{{ $bank->bank_name }}" data-account="{{ $bank->account_number }}" data-holder="{{ $bank->account_holder_name }}">{{ $bank->bank_name }} - {{ $bank->account_number }} (a.n. {{ $bank->account_holder_name }})</option>
                            @empty
                                <option value="" disabled>Tidak ada rekening bank</option>
                            @endforelse
                        </select>
                        <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> Pilih bank tujuan transfer</div>
                    </div>

                    <div class="bank-info-box" id="bankInfoBox">
                        <div class="bank-info-title"><i class="fa-solid fa-info-circle"></i> Informasi Rekening Transfer</div>
                        <div id="bankInfoContent"></div>
                    </div>

                    <div class="field" id="fieldDP">
                        <label class="field-label"><i><i class="fa-solid fa-hand-holding-dollar" style="font-size:0.6rem;"></i></i> Jumlah DP</label>
                        <div class="input-prefix-wrap">
                            <div class="input-prefix">Rp</div>
                            <input type="number" name="amount" id="dpInput" class="form-input" placeholder="Masukkan jumlah DP" inputmode="numeric" required min="0">
                        </div>
                        <div class="field-hint"><i class="fa-solid fa-info-circle"></i> Minimal DP: <strong id="minDpText" style="margin-left:0.2rem;">Rp 0</strong> (30% dari total)</div>
                        <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> DP harus minimal <span id="minDpErr">Rp 0</span></div>
                    </div>

                    <div class="field" id="fieldProofImage">
                        <label class="field-label"><i><i class="fa-solid fa-receipt" style="font-size:0.6rem;"></i></i> Upload Bukti Pembayaran</label>
                        <div class="upload-zone" id="proofUploadZone">
                            <input type="file" name="proof_image" id="proofFile" accept="image/*">
                            <div class="upload-zone-prompt" id="proofUploadPrompt">
                                <div class="upload-zone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <p><strong>Ketuk untuk upload</strong></p>
                                <p style="margin-top:0.25rem;">JPG, PNG · Maks 2MB</p>
                            </div>
                            <div class="upload-preview" id="proofUploadPreview">
                                <div class="upload-preview-thumb" id="proofUploadThumb"></div>
                                <div class="upload-preview-meta">
                                    <div class="upload-preview-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                                    <div style="flex:1;min-width:0;">
                                        <div class="upload-preview-name" id="proofUploadFileName">—</div>
                                        <div class="upload-preview-size" id="proofUploadFileSize"></div>
                                    </div>
                                    <button type="button" class="upload-remove" id="proofUploadRemove"><i class="fa-solid fa-xmark"></i> Hapus</button>
                                </div>
                            </div>
                        </div>
                        <div class="field-hint"><i class="fa-solid fa-info-circle"></i> Upload bukti transfer Anda</div>
                    </div>

                    <div class="pay-summary">
                        <div class="pay-summary-title"><i class="fa-solid fa-circle-check"></i> Ringkasan Pembayaran</div>
                        <div class="pay-row"><span class="pr-label">Total Harga Sewa</span><span class="pr-val" id="psTotalPrice">Rp 0</span></div>
                        <div class="pay-row"><span class="pr-label">DP yang Dibayar</span><span class="pr-val" id="psDPPaid">Rp 0</span></div>
                        <div class="pay-row highlight"><span class="pr-label">Sisa Pembayaran</span><span class="pr-val" id="psRemaining">Rp 0</span></div>
                    </div>
                </div>

                <!-- Nav Buttons – Desktop -->
                <div class="nav-buttons-desktop">
                    <button type="button" class="btn btn-back btn-hidden" id="btnBackDesktop"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                    <button type="button" class="btn btn-next" id="btnNextDesktop">Selanjutnya <i class="fa-solid fa-arrow-right"></i></button>
                    <button type="button" class="btn btn-submit btn-hidden" id="btnSubmitDesktop">Konfirmasi Pesanan <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-strip">
        <i class="fa-solid fa-info-circle"></i>
        <p><strong>Informasi:</strong> DP minimal <strong>30%</strong> dari total harga sewa. Mobil dikirim ke lokasi Anda setelah booking dikonfirmasi. Butuh bantuan? Hubungi kami lewat WhatsApp.</p>
    </div>
</div>

<!-- Nav Buttons – Mobile floating bar -->
<div class="nav-buttons-mobile">
    <button type="button" class="btn btn-back btn-hidden" id="btnBack"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
    <button type="button" class="btn btn-next" id="btnNext">Selanjutnya <i class="fa-solid fa-arrow-right"></i></button>
    <button type="button" class="btn btn-submit btn-hidden" id="btnSubmit"><i class="fa-solid fa-check-circle"></i> Konfirmasi</button>
</div>

<!-- ============================================================
     JAVASCRIPT
     ============================================================ -->
<script>
(function() {
    const params        = new URLSearchParams(window.location.search);
    const paramStart    = params.get('start');
    const paramEnd      = params.get('end');
    const paramMode     = params.get('mode');
    const paramBasePrice  = params.get('base_price')  ? parseInt(params.get('base_price'))  : null;
    const paramTotalPrice = params.get('total_price') ? parseInt(params.get('total_price')) : null;
    const paramMinDeposit = params.get('min_deposit') ? parseInt(params.get('min_deposit')) : null;
    const paramDays       = params.get('days')        ? parseInt(params.get('days'))        : null;

    const PRICE_PER_DAY = {{ $car->price_24h ?? 300000 }};
    const CAR_NAME      = "{{ $car->brand }} {{ $car->name }}";

    const BANK_ACCOUNTS = {
        @forelse($bankAccounts as $bank)
            '{{ $bank->id }}': { name: '{{ $bank->bank_name }}', account: '{{ $bank->account_number }}', holder: '{{ $bank->account_holder_name }}' },
        @empty
        @endforelse
    };

    const STEPS = [
        { icon: 'fa-clock',         title: 'Waktu Sewa',  sub: 'Tentukan kapan Anda ingin menyewa' },
        { icon: 'fa-shield-halved', title: 'Jaminan',     sub: 'Upload dokumen sebagai jaminan' },
        { icon: 'fa-credit-card',   title: 'Pembayaran',  sub: 'Pilih metode dan masukkan DP' }
    ];

    let currentStep  = 0;
    let durationMode = paramMode || '24';
    let totalPrice   = paramTotalPrice || 0;
    let basePrice    = paramBasePrice  || 0;
    let days         = paramDays       || 0;
    let minDP        = paramMinDeposit || Math.ceil((totalPrice || 0) * 0.3);

    const panels = document.querySelectorAll('.step-panel');

    const btnBackMobile    = document.getElementById('btnBack');
    const btnNextMobile    = document.getElementById('btnNext');
    const btnSubmitMobile  = document.getElementById('btnSubmit');
    const btnBackDesktop   = document.getElementById('btnBackDesktop');
    const btnNextDesktop   = document.getElementById('btnNextDesktop');
    const btnSubmitDesktop = document.getElementById('btnSubmitDesktop');

    const startInput   = document.getElementById('startInput');
    const endInput     = document.getElementById('endInput');
    const dpInput      = document.getElementById('dpInput');
    const durationBox  = document.getElementById('durationBox');
    const contactInput = document.getElementById('contactInput');
    const alamatInput  = document.getElementById('alamatInput');
    const bankSelect   = document.getElementById('bankSelect');
    const bankInfoBox  = document.getElementById('bankInfoBox');

    // ── Progress & Header ──────────────────────────────────
    function renderProgress() {
        const wrap = document.getElementById('progressBar');
        let html = '';
        STEPS.forEach((s, i) => {
            const cls    = i < currentStep ? 'done' : (i === currentStep ? 'active' : '');
            const lblCls = i < currentStep ? 'done' : (i === currentStep ? 'active' : '');
            const icon   = i < currentStep ? '<i class="fa-solid fa-check"></i>' : `<i class="fa-solid ${s.icon}"></i>`;
            html += `<div class="prog-step"><div class="prog-dot ${cls}">${icon}</div><span class="prog-label ${lblCls}">${s.title}</span></div>`;
            if (i < STEPS.length - 1) html += `<div class="prog-line"><div class="prog-line-fill" style="width:${i < currentStep ? '100' : '0'}%"></div></div>`;
        });
        wrap.innerHTML = html;
    }

    function updateHeader() {
        const s = STEPS[currentStep];
        document.getElementById('headerIcon').innerHTML = `<i class="fa-solid ${s.icon}"></i>`;
        document.getElementById('headerTitle').textContent = s.title;
        document.getElementById('headerSub').textContent   = s.sub;
    }

    function syncButtons(n) {
        const isFirst = n === 0, isLast = n === STEPS.length - 1;
        btnBackMobile.classList.toggle('btn-hidden', isFirst);
        btnBackDesktop.classList.toggle('btn-hidden', isFirst);
        btnNextMobile.classList.toggle('btn-hidden', isLast);
        btnNextDesktop.classList.toggle('btn-hidden', isLast);
        btnSubmitMobile.classList.toggle('btn-hidden', !isLast);
        btnSubmitDesktop.classList.toggle('btn-hidden', !isLast);
    }

    function goToStep(n) {
        panels.forEach((p, i) => p.classList.toggle('active', i === n));
        currentStep = n;
        syncButtons(n);
        renderProgress();
        updateHeader();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ── Validation ─────────────────────────────────────────
    function clearError(id) { const f = document.getElementById(id); if (f) f.classList.remove('has-error'); }
    function setError(id)   { const f = document.getElementById(id); if (f) f.classList.add('has-error'); }

    function validateCurrentStep() {
        ['fieldStart','fieldEnd','fieldContact','fieldAlamat','fieldDoc','fieldBank','fieldDP'].forEach(clearError);
        if (currentStep === 0) {
            let ok = true;
            if (!startInput.value)   { setError('fieldStart');   ok = false; }
            if (!endInput.value)     { setError('fieldEnd');     ok = false; }
            if (!contactInput.value) { setError('fieldContact'); ok = false; }
            if (!alamatInput.value)  { setError('fieldAlamat');  ok = false; }
            if (ok && days <= 0)     { setError('fieldEnd');     ok = false; }
            return ok;
        }
        if (currentStep === 1) {
            const file = document.getElementById('docFile');
            if (!file.files || !file.files.length) { setError('fieldDoc'); return false; }
            return true;
        }
        if (currentStep === 2) {
            const payMethod = document.querySelector('input[name="payment_method"]:checked').value;
            if (payMethod === 'transfer' && !bankSelect.value) { setError('fieldBank'); return false; }
            const dp = Number(dpInput.value) || 0;
            if (dp < minDP) { setError('fieldDP'); return false; }
            if (dp > totalPrice) {
                setError('fieldDP');
                document.getElementById('minDpErr').textContent = `DP tidak boleh lebih dari Rp ${totalPrice.toLocaleString('id-ID')}`;
                return false;
            }
            return true;
        }
        return true;
    }

    function handleBack() { if (currentStep > 0) goToStep(currentStep - 1); }
    function handleNext() { if (!validateCurrentStep()) return; if (currentStep < STEPS.length - 1) goToStep(currentStep + 1); }

    btnBackMobile.addEventListener('click', handleBack);
    btnBackDesktop.addEventListener('click', handleBack);
    btnNextMobile.addEventListener('click', handleNext);
    btnNextDesktop.addEventListener('click', handleNext);

    // ── Price Calculation ──────────────────────────────────
    function calcPrice() {
        if (!startInput.value || !endInput.value) { durationBox.classList.remove('show'); return; }
        const s = new Date(startInput.value), e = new Date(endInput.value);
        days = Math.ceil((e - s) / (1000 * 60 * 60 * 24));

        if (days <= 0) {
            durationBox.classList.remove('show'); totalPrice = 0; minDP = 0;
            document.getElementById('totalPriceInput').value = 0; updatePaySummary(); return;
        }

        if (paramTotalPrice !== null && (paramMode === '12' || (paramDays !== null && paramDays === days))) {
            totalPrice = paramTotalPrice;
            basePrice  = paramBasePrice || (durationMode === '12' ? Math.round(PRICE_PER_DAY * 0.7) : PRICE_PER_DAY * days);
            minDP      = paramMinDeposit !== null ? paramMinDeposit : Math.ceil(totalPrice * 0.3);
        } else {
            basePrice  = durationMode === '12' ? Math.round(PRICE_PER_DAY * 0.7) : PRICE_PER_DAY * days;
            totalPrice = basePrice;
            minDP      = Math.ceil(totalPrice * 0.3);
        }

        document.getElementById('totalPriceInput').value    = totalPrice;
        document.getElementById('durationModeHidden').value = durationMode;
        document.getElementById('basePriceHidden').value    = basePrice;
        document.getElementById('minDepositHidden').value   = minDP;
        document.getElementById('daysHidden').value         = days;

        const modeInfo = document.getElementById('durationModeInfo');
        if (paramMode) { modeInfo.style.display = 'flex'; document.getElementById('durationModeText').textContent = durationMode === '12' ? '12 Jam' : '24 Jam'; }

        document.getElementById('durDays').textContent        = durationMode === '12' ? '1/2' : days;
        document.getElementById('durPricePerDay').textContent = 'Rp ' + (durationMode === '12' ? Math.round(PRICE_PER_DAY * 0.7) : PRICE_PER_DAY).toLocaleString('id-ID');
        document.getElementById('durTotal').textContent       = 'Rp ' + totalPrice.toLocaleString('id-ID');
        document.getElementById('minDpText').textContent      = 'Rp ' + minDP.toLocaleString('id-ID');
        document.getElementById('minDpErr').textContent       = 'Rp ' + minDP.toLocaleString('id-ID');

        dpInput.setAttribute('max', totalPrice);
        if (Number(dpInput.value) > totalPrice) dpInput.value = '';

        durationBox.classList.add('show');
        updatePaySummary();
    }

    startInput.addEventListener('change', () => { clearError('fieldStart'); calcPrice(); debounceSave(); });
    endInput.addEventListener('change',   () => { clearError('fieldEnd');   calcPrice(); debounceSave(); });
    contactInput.addEventListener('input', () => clearError('fieldContact'));
    alamatInput.addEventListener('input',  () => clearError('fieldAlamat'));

    function updatePaySummary() {
        const dp = Number(dpInput.value) || 0;
        document.getElementById('psTotalPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        document.getElementById('psDPPaid').textContent     = 'Rp ' + dp.toLocaleString('id-ID');
        document.getElementById('psRemaining').textContent  = 'Rp ' + (totalPrice - dp).toLocaleString('id-ID');
    }

    dpInput.addEventListener('input', () => {
        clearError('fieldDP');
        const dpValue = Number(dpInput.value) || 0;
        if (dpValue > totalPrice) {
            setError('fieldDP');
            document.getElementById('minDpErr').textContent = `DP tidak boleh lebih dari Rp ${totalPrice.toLocaleString('id-ID')}`;
            dpInput.value = totalPrice;
        } else if (dpValue < minDP && dpValue > 0) {
            setError('fieldDP');
            document.getElementById('minDpErr').textContent = `DP minimal Rp ${minDP.toLocaleString('id-ID')}`;
        } else {
            clearError('fieldDP');
            document.getElementById('minDpErr').textContent = `Rp ${minDP.toLocaleString('id-ID')}`;
        }
        updatePaySummary();
    });

    // ── Card Radio ─────────────────────────────────────────
    function initCardRadio(gridId) {
        const grid = document.getElementById(gridId);
        if (!grid) return;
        grid.querySelectorAll('.card-radio').forEach(card => {
            card.addEventListener('click', function() {
                grid.querySelectorAll('.card-radio').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                const radio = this.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
                debounceSave();
            });
        });
    }
    initCardRadio('guaranteeGrid');
    initCardRadio('paymentGrid');

    document.querySelectorAll('#paymentGrid .card-radio').forEach(card => {
        card.addEventListener('click', function() {
            if (this.dataset.value === 'transfer' && bankSelect.value) showBankInfo(bankSelect.value);
        });
    });

    bankSelect.addEventListener('change', function() {
        clearError('fieldBank');
        if (this.value) showBankInfo(this.value);
        else bankInfoBox.classList.remove('show');
        debounceSave();
    });

    function showBankInfo(bankCode) {
        const bank = BANK_ACCOUNTS[bankCode];
        if (!bank) return;
        document.getElementById('bankInfoContent').innerHTML =
            `<div class="bank-item"><div class="bank-name">${bank.name}</div><div class="bank-account"><span class="bank-number">${bank.account}</span><button type="button" class="copy-btn" onclick="copyToClipboard('${bank.account}')"><i class="fa-solid fa-copy"></i> Salin</button></div><div class="bank-holder">a.n. ${bank.holder}</div></div>`;
        bankInfoBox.classList.add('show');
    }

    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert('Nomor rekening berhasil disalin!'))
            .catch(() => {
                const ta = document.createElement('textarea');
                ta.value = text; ta.style.cssText = 'position:fixed;opacity:0';
                document.body.appendChild(ta); ta.focus(); ta.select();
                try { document.execCommand('copy'); alert('Nomor rekening berhasil disalin!'); } catch(e) {}
                document.body.removeChild(ta);
            });
    };

    // ── File Upload ────────────────────────────────────────
    const uploadZone    = document.getElementById('uploadZone');
    const docFile       = document.getElementById('docFile');
    const uploadPreview = document.getElementById('uploadPreview');
    const uploadRemove  = document.getElementById('uploadRemove');

    uploadZone.addEventListener('dragover', e => { e.preventDefault(); uploadZone.classList.add('dragover'); });
    uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('dragover'));
    uploadZone.addEventListener('drop', e => {
        e.preventDefault(); uploadZone.classList.remove('dragover');
        if (e.dataTransfer.files.length) { docFile.files = e.dataTransfer.files; showDocPreview(e.dataTransfer.files[0]); }
    });
    docFile.addEventListener('change', function() { if (this.files.length) showDocPreview(this.files[0]); });

    function formatSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }

    function renderThumb(file, thumbEl) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => { thumbEl.innerHTML = `<img src="${e.target.result}" alt="Preview">`; };
            reader.readAsDataURL(file);
        } else {
            thumbEl.innerHTML = `<div class="thumb-fallback"><i class="fa-solid fa-file-pdf"></i><span>${file.name}</span></div>`;
        }
    }

    function showDocPreview(file) {
        document.getElementById('uploadFileName').textContent = file.name;
        document.getElementById('uploadFileSize').textContent = formatSize(file.size);
        renderThumb(file, document.getElementById('uploadThumb'));
        uploadPreview.classList.add('show');
        uploadZone.classList.add('has-file');
        clearError('fieldDoc');
    }

    uploadRemove.addEventListener('click', e => {
        e.stopPropagation();
        docFile.value = '';
        uploadPreview.classList.remove('show');
        uploadZone.classList.remove('has-file');
        document.getElementById('uploadThumb').innerHTML = '';
    });

    const proofUploadZone    = document.getElementById('proofUploadZone');
    const proofFile          = document.getElementById('proofFile');
    const proofUploadPreview = document.getElementById('proofUploadPreview');
    const proofUploadRemove  = document.getElementById('proofUploadRemove');

    proofUploadZone.addEventListener('dragover', e => { e.preventDefault(); proofUploadZone.classList.add('dragover'); });
    proofUploadZone.addEventListener('dragleave', () => proofUploadZone.classList.remove('dragover'));
    proofUploadZone.addEventListener('drop', e => {
        e.preventDefault(); proofUploadZone.classList.remove('dragover');
        if (e.dataTransfer.files.length) { proofFile.files = e.dataTransfer.files; showProofPreview(e.dataTransfer.files[0]); }
    });
    proofFile.addEventListener('change', function() { if (this.files.length) showProofPreview(this.files[0]); });

    function showProofPreview(file) {
        document.getElementById('proofUploadFileName').textContent = file.name;
        document.getElementById('proofUploadFileSize').textContent = formatSize(file.size);
        renderThumb(file, document.getElementById('proofUploadThumb'));
        proofUploadPreview.classList.add('show');
        proofUploadZone.classList.add('has-file');
    }

    proofUploadRemove.addEventListener('click', e => {
        e.stopPropagation();
        proofFile.value = '';
        proofUploadPreview.classList.remove('show');
        proofUploadZone.classList.remove('has-file');
        document.getElementById('proofUploadThumb').innerHTML = '';
    });

    // ── Confirm Modal ──────────────────────────────────────
    function openConfirm() {
        if (!validateCurrentStep()) return;
        const grnVal = document.querySelector('input[name="guarantee_type"]:checked').value;
        const payVal = document.querySelector('input[name="payment_method"]:checked').value;
        const grnMap = { ktp:'KTP', sim:'SIM', motor:'BPKB Motor' };
        const payMap = { cash:'Cash (Tunai)', transfer:'Transfer Bank' };
        const dp = Number(dpInput.value) || 0;

        function fmtDt(val) {
            if (!val) return '–';
            const d = new Date(val);
            return d.toLocaleDateString('id-ID', { weekday:'short', day:'numeric', month:'short', year:'numeric' }) + ' · ' + d.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit' });
        }

        document.getElementById('cfCarName').textContent    = CAR_NAME;
        document.getElementById('cfStart').textContent      = fmtDt(startInput.value);
        document.getElementById('cfEnd').textContent        = fmtDt(endInput.value);
        document.getElementById('cfDuration').textContent   = durationMode === '12' ? '12 Jam' : (days + ' Hari');
        document.getElementById('cfContact').textContent    = contactInput.value || '–';
        document.getElementById('cfAlamat').textContent     = alamatInput.value || '–';
        document.getElementById('cfService').textContent    = 'Lepas Kunci';
        document.getElementById('cfGuarantee').textContent  = grnMap[grnVal] || grnVal;
        document.getElementById('cfDoc').textContent        = docFile.files.length ? docFile.files[0].name : '–';
        document.getElementById('cfPayMethod').textContent  = payMap[payVal] || payVal;
        document.getElementById('cfTotalPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        document.getElementById('cfDP').textContent         = 'Rp ' + dp.toLocaleString('id-ID');
        document.getElementById('cfRemaining').textContent  = 'Rp ' + (totalPrice - dp).toLocaleString('id-ID');

        const bankRow = document.getElementById('cfBankRow');
        if (payVal === 'transfer') {
            bankRow.classList.remove('hidden');
            document.getElementById('cfBank').textContent = bankSelect.options[bankSelect.selectedIndex]?.text || '–';
        } else bankRow.classList.add('hidden');

        const proofRow = document.getElementById('cfProofRow');
        if (payVal === 'transfer' && proofFile.files.length) {
            proofRow.classList.remove('hidden');
            document.getElementById('cfProof').textContent = proofFile.files[0].name;
        } else proofRow.classList.add('hidden');

        document.getElementById('confirmOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeConfirm() {
        document.getElementById('confirmOverlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    btnSubmitMobile.addEventListener('click', openConfirm);
    btnSubmitDesktop.addEventListener('click', openConfirm);
    document.getElementById('confirmBack').addEventListener('click', closeConfirm);
    document.getElementById('confirmOverlay').addEventListener('click', function(e) { if (e.target === this) closeConfirm(); });

    function getSelectedOptionText(selectEl) {
        if (!selectEl) return '–';
        const opt = selectEl.options[selectEl.selectedIndex];
        return opt ? opt.text : '–';
    }

    function buildWhatsAppBookingMessage() {
        const destination   = document.querySelector('input[name="destination"]').value || '-';
        const guaranteeType = document.querySelector('input[name="guarantee_type"]:checked').value || '-';
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value || '-';
        const bankText      = bankSelect.value ? getSelectedOptionText(bankSelect) : '-';
        const proofFileName = proofFile.files.length ? proofFile.files[0].name : 'Tidak ada';

        const formatDate = (val) => {
            if (!val) return '-';
            const d = new Date(val);
            return d.toLocaleDateString('id-ID', { weekday:'short', day:'numeric', month:'short', year:'numeric' }) + ' ' + d.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit' });
        };

        const startText = formatDate(startInput.value);
        const endText   = formatDate(endInput.value);
        const durText   = durationMode === '12' ? '12 Jam' : `${days} Hari`;

        const dpValue = Number(dpInput.value) || 0;

        return `Halo Admin, saya ingin melakukan booking mobil:\n` +
               `- Mobil: ${CAR_NAME} (Lepas Kunci)\n` +
               `- Tanggal Mulai: ${startText}\n` +
               `- Tanggal Selesai: ${endText}\n` +
               `- Durasi: ${durText}\n` +
               `- Tujuan: ${destination}\n` +
               `- Kontak: ${contactInput.value || '-'}\n` +
               `- Alamat: ${alamatInput.value || '-'}\n` +
               `- Jaminan: ${guaranteeType.toUpperCase()}\n` +
               `- Dokumen Jaminan: ${docFile.files.length ? docFile.files[0].name : 'Belum diupload'}\n` +
               `- Metode Pembayaran: ${paymentMethod === 'transfer' ? 'Transfer Bank' : paymentMethod}\n` +
               `- Bank Tujuan: ${bankText}\n` +
               `- Total Harga: Rp ${totalPrice.toLocaleString('id-ID')}\n` +
               `- DP Dibayar: Rp ${dpValue.toLocaleString('id-ID')}\n` +
               `- Bukti Transfer: ${proofFileName}\n\n` +
               `Upload Dokumen Jaminan\n` +
               `Upload Bukti Pembayaran\n\n` +
               `Jika sudah, kembali ke website untuk menyelesaikan booking. Terima kasih!`;
    }

    function sendWhatsAppMessage() {
        const baseNumber = '6287739904530';
        const text = buildWhatsAppBookingMessage();
        const url = `https://wa.me/${baseNumber}?text=${encodeURIComponent(text)}`;
        window.open(url, '_blank');
    }

    document.getElementById('confirmSubmit').addEventListener('click', () => {
        clearDraft();
        closeConfirm();
        sendWhatsAppMessage();
        document.getElementById('loadingOverlay').classList.add('active');
        setTimeout(() => {
            document.getElementById('bookingForm').submit();
        }, 300);
    });

    // ============================================================
    // LOCALSTORAGE AUTO-SAVE & RESTORE
    // ============================================================
    const STORAGE_KEY = 'booking_draft_car_{{ $car->id }}';

    const TEXT_FIELDS = [
        { id: 'startInput',   name: 'start_datetime' },
        { id: 'endInput',     name: 'end_datetime'   },
        { id: 'contactInput', name: 'contact'        },
        { id: 'alamatInput',  name: 'alamat'         },
        { id: 'dpInput',      name: 'amount'         },
    ];
    const SELECT_FIELDS = [{ id: 'bankSelect', name: 'selected_bank' }];
    const RADIO_GROUPS  = ['guarantee_type', 'payment_method'];
    const OTHER_FIELDS  = [{ selector: 'input[name="destination"]', name: 'destination' }];

    function saveDraft() {
        const draft = {};
        TEXT_FIELDS.forEach(f   => { const el = document.getElementById(f.id);         if (el) draft[f.name] = el.value; });
        SELECT_FIELDS.forEach(f => { const el = document.getElementById(f.id);         if (el) draft[f.name] = el.value; });
        OTHER_FIELDS.forEach(f  => { const el = document.querySelector(f.selector);    if (el) draft[f.name] = el.value; });
        RADIO_GROUPS.forEach(name => { const checked = document.querySelector(`input[name="${name}"]:checked`); if (checked) draft[name] = checked.value; });
        draft['_step'] = currentStep;
        try { localStorage.setItem(STORAGE_KEY, JSON.stringify(draft)); } catch(e) {}

        // Show badge
        document.getElementById('draftIndicator').classList.add('show');
    }

    function restoreDraft() {
        let draft;
        try { draft = JSON.parse(localStorage.getItem(STORAGE_KEY)); } catch(e) {}
        if (!draft) return;

        TEXT_FIELDS.forEach(f   => { const el = document.getElementById(f.id);      if (el && draft[f.name] !== undefined) el.value = draft[f.name]; });
        OTHER_FIELDS.forEach(f  => { const el = document.querySelector(f.selector); if (el && draft[f.name] !== undefined) el.value = draft[f.name]; });

        SELECT_FIELDS.forEach(f => {
            const el = document.getElementById(f.id);
            if (el && draft[f.name]) {
                el.value = draft[f.name];
                if (f.id === 'bankSelect') showBankInfo(draft[f.name]);
            }
        });

        RADIO_GROUPS.forEach(name => {
            if (!draft[name]) return;
            const radio = document.querySelector(`input[name="${name}"][value="${draft[name]}"]`);
            if (radio) {
                radio.checked = true;
                const card = radio.closest('.card-radio');
                if (card) {
                    const grid = card.closest('.card-radio-grid');
                    if (grid) grid.querySelectorAll('.card-radio').forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                }
            }
        });

        // Show draft badge + toast
        document.getElementById('draftIndicator').classList.add('show');
        showToast('✏️ Draft tersimpan dipulihkan');
    }

    function clearDraft() {
        try { localStorage.removeItem(STORAGE_KEY); } catch(e) {}
        document.getElementById('draftIndicator').classList.remove('show');
    }

    // ── Toast ──────────────────────────────────────────────
    function showToast(msg) {
        const existing = document.getElementById('draftToast');
        if (existing) existing.remove();

        if (!document.getElementById('toastStyle')) {
            const style = document.createElement('style');
            style.id = 'toastStyle';
            style.textContent = `
                @keyframes toastIn  { from { opacity:0; transform:translateX(-50%) translateY(8px); } to { opacity:1; transform:translateX(-50%) translateY(0); } }
                @keyframes toastOut { from { opacity:1; } to { opacity:0; } }
            `;
            document.head.appendChild(style);
        }

        const toast = document.createElement('div');
        toast.id = 'draftToast';
        toast.style.cssText = 'position:fixed;bottom:80px;left:50%;transform:translateX(-50%);background:#1F2937;color:white;padding:0.6rem 1.1rem;border-radius:999px;font-size:0.8rem;font-weight:600;box-shadow:0 4px 16px rgba(0,0,0,0.25);z-index:9998;white-space:nowrap;animation:toastIn 0.3s ease;';
        toast.textContent = msg;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = 'toastOut 0.3s ease forwards';
            setTimeout(() => toast.remove(), 300);
        }, 2500);
    }

    // ── Auto-save listeners ─────────────────────────────────
    let saveTimer;
    function debounceSave() { clearTimeout(saveTimer); saveTimer = setTimeout(saveDraft, 400); }

    TEXT_FIELDS.forEach(f => {
        const el = document.getElementById(f.id);
        if (el) { el.addEventListener('input', debounceSave); el.addEventListener('change', debounceSave); }
    });
    SELECT_FIELDS.forEach(f => { const el = document.getElementById(f.id); if (el) el.addEventListener('change', debounceSave); });
    OTHER_FIELDS.forEach(f  => { const el = document.querySelector(f.selector); if (el) el.addEventListener('input', debounceSave); });
    RADIO_GROUPS.forEach(name => {
        document.querySelectorAll(`input[name="${name}"]`).forEach(el => el.addEventListener('change', debounceSave));
    });

    // ── Init ───────────────────────────────────────────────
    goToStep(0);
    if (paramStart) startInput.value = paramStart.replace(' ', 'T');
    if (paramEnd)   endInput.value   = paramEnd.replace(' ', 'T');
    document.getElementById('durationModeHidden').value = durationMode;

    restoreDraft(); // restore setelah URL params diisi
    calcPrice();
})();
</script>

</x-app-layout>
