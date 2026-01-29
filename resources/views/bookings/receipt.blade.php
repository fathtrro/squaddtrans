<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kwitansi - {{ $booking->booking_code }}</title>

<style>
/* ================= BASE ================= */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: "Times New Roman", serif;
    font-size: 11px;
    color: #1F2937;
    background: #fff;
    line-height: 1.6;
}

/* ================= PRINT ================= */
@page {
    size: A4;
    margin: 15mm;
}

@media print {
    body { zoom: 0.85; }
}

/* ================= CONTAINER ================= */
.invoice {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    position: relative;
}

/* ================= WATERMARK ================= */
.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-30deg);
    font-size: 100px;
    font-weight: bold;
    color: rgba(0,0,0,0.04);
    z-index: 0;
}

/* ================= HEADER ================= */
.header {
    display: flex;
    justify-content: space-between;
    border-bottom: 2px solid #f59e0b;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.brand h2 {
    font-size: 18px;
    color: #f59e0b;
    font-weight: bold;
}

.brand p {
    font-size: 10px;
    color: #6b7280;
}

.invoice-title {
    text-align: right;
}

.invoice-title h1 {
    color: #f59e0b;
    font-size: 26px;
    letter-spacing: 2px;
}

.invoice-title p {
    font-size: 10px;
    margin-top: 4px;
}

/* ================= INFO GRID ================= */
.section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-bottom: 30px;
}

.section h3 {
    font-size: 10px;
    color: #f59e0b;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-bottom: 1px solid #f59e0b;
    padding-bottom: 5px;
    margin-bottom: 10px;
}

.field {
    margin-bottom: 8px;
}

.field span {
    font-size: 9px;
    color: #6b7280;
    text-transform: uppercase;
}

.field strong {
    display: block;
    font-size: 12px;
}

/* ================= TABLE ================= */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

thead th {
    background: #1f2937;
    color: #fff;
    font-size: 9px;
    padding: 10px;
    text-transform: uppercase;
}

tbody td {
    padding: 10px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 11px;
}

.status {
    background: #d1fae5;
    color: #065f46;
    font-size: 9px;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: bold;
}

/* ================= TOTAL ================= */
.total-box {
    width: 300px;
    background: #f59e0b;
    color: #1f2937;
    padding: 20px;
    border-radius: 14px;
    margin-left: auto;
    margin-top: 20px;
}

.total-box small {
    font-size: 9px;
    text-transform: uppercase;
}

.total-box h2 {
    font-size: 22px;
    text-align: right;
}

/* ================= SIGN ================= */
.sign {
    display: grid;
    grid-template-columns: 1fr 1fr;
    text-align: center;
    margin-top: 60px;
}

.sign div {
    padding-top: 40px;
    border-top: 1px solid #e5e7eb;
    font-weight: bold;
}

/* ================= FOOTER ================= */
.footer {
    text-align: center;
    font-size: 9px;
    margin-top: 25px;
    color: #6b7280;
    font-style: italic;
}
</style>
</head>

<body>

<div class="invoice">
<div class="watermark">PAID</div>

<!-- HEADER -->
<div class="header">
    <div class="brand">
        <h2>SQUAD TRANS PREMIUM</h2>
        <p>
            Jl. Premium Luxury No. 88, Jakarta Selatan<br>
            contact@squadtrans.com | +62 21 555 0123
        </p>
    </div>

    <div class="invoice-title">
        <h1>KWITANSI</h1>
        <p>No. Booking: <strong>{{ $booking->booking_code }}</strong></p>
        <p>{{ now()->format('d F Y') }}</p>
    </div>
</div>

<!-- INFO -->
<div class="section">
    <div>
        <h3>Data Pelanggan</h3>
        <div class="field"><span>Nama</span><strong>{{ $booking->user->name }}</strong></div>
        <div class="field"><span>Telepon</span><strong>{{ $booking->user->phone ?? '-' }}</strong></div>
        <div class="field"><span>Email</span><strong>{{ $booking->user->email }}</strong></div>
    </div>

    <div>
        <h3>Detail Sewa</h3>
        <div class="field"><span>Kendaraan</span><strong>{{ $booking->car->name }}</strong></div>
        <div class="field"><span>Plat</span><strong>{{ $booking->car->license_plate }}</strong></div>
        <div class="field"><span>Periode</span>
            <strong>{{ $booking->start_datetime }} - {{ $booking->end_datetime }}</strong>
        </div>
    </div>
</div>

<!-- TABLE -->
<table>
<thead>
<tr>
    <th>Layanan</th>
    <th>Metode</th>
    <th>Status</th>
    <th style="text-align:right">Subtotal</th>
</tr>
</thead>
<tbody>
@foreach($booking->payments as $p)
<tr>
    <td>{{ $p->payment_type }}</td>
    <td>{{ ucwords(str_replace('_',' ',$p->payment_method)) }}</td>
    <td><span class="status">{{ strtoupper($p->status) }}</span></td>
    <td style="text-align:right">Rp {{ number_format($p->amount,0,',','.') }}</td>
</tr>
@endforeach
</tbody>
</table>

<!-- TOTAL -->
<div class="total-box">
    <small>Total Pembayaran</small>
    <h2>Rp {{ number_format($booking->total_price,0,',','.') }}</h2>
</div>

<!-- SIGN -->
<div class="sign">
    <div>{{ $booking->user->name }}</div>
    <div>Squad Trans Management</div>
</div>

<!-- FOOTER -->
<div class="footer">
    “Memberikan Kemewahan di Setiap Perjalanan Anda”
</div>

</div>
</body>
</html>
