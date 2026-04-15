# WhatsApp Fonnte Integration - Booking Extensions

## User Notifications (Penyewa)

### 1. Saat Mengajukan Perpanjangan (Request Submission)
**Pesan Ke User:**
```
📅 *Perpanjangan Sewa Diterima*

Halo [Nama],

Permintaan perpanjangan sewa Anda untuk booking [CODE] sudah kami terima dan sedang diproses oleh tim admin kami.

📋 *Detail Perpanjangan:*
• Waktu Kembali Baru: [TANGGAL WAKTU]
• Biaya Tambahan: Rp [AMOUNT]

⏳ Kami akan segera memberikan notifikasi persetujuan atau penolakan dalam waktu 1x24 jam.

Terima kasih telah menggunakan layanan kami! 🙏
```

### 2. Saat Pengajuan Diterima (Approved)
**Pesan Ke User:**
```
✅ *Perpanjangan Sewa Disetujui!*

Halo [Nama],

Selamat! Permintaan perpanjangan sewa Anda untuk booking [CODE] telah disetujui oleh admin kami.

📋 *Detail Perpanjangan yang Disetujui:*
• Waktu Kembali Baru: [TANGGAL WAKTU]
• Biaya Tambahan: Rp [AMOUNT]
• Total Harga Akhir: Rp [TOTAL]

💳 *Langkah Selanjutnya:*
Silakan selesaikan pembayaran untuk biaya perpanjangan melalui aplikasi atau hubungi customer service kami.

Terima kasih! 🙏
```

### 3. Saat Pengajuan Ditolak (Rejected)
**Pesan Ke User:**
```
⚠️ *Perpanjangan Sewa Ditolak*

Halo [Nama],

Permintaan perpanjangan sewa Anda untuk booking [CODE] telah ditolak oleh tim admin kami.

📋 *Detail:*
• Waktu Kembali Awal: [TANGGAL WAKTU]
• Waktu Kembali yang Diminta: [TANGGAL WAKTU]

Kemungkinan alasan penolakan:
• Jadwal kendaraan sudah penuh
• Ketersediaan terbatas
• Alasan administratif lainnya

📞 *Hubungi Kami:*
Jika Anda ingin membahas lebih lanjut atau mencari solusi alternatif, silakan hubungi customer service kami:
📱 [ADMIN_PHONE]

Terima kasih atas pemahaman Anda. 🙏
```

## Admin Notifications (Admin)

### 1. Saat Ada Pengajuan Baru (Request Received)
**Pesan Ke Admin:**
```
🔔 *Permintaan Perpanjangan Baru*

Ada permintaan perpanjangan sewa dari pelanggan:

👤 *Nama Pelanggan:* [NAMA]
📱 *Nomor HP:* [PHONE]
🔖 *Booking Code:* [CODE]
🚗 *Kendaraan:* [CAR_NAME]

📝 *Detail Perpanjangan:*
• Waktu Kembali Saat Ini: [OLD_DATE]
• Waktu Kembali Baru: [NEW_DATE]
• Biaya Tambahan: Rp [AMOUNT]

Silakan review dan lakukan persetujuan atau penolakan melalui dashboard admin.
Link: [ADMIN_URL]/admin/booking-extensions
```

### 2. Saat Admin Menyetujui (Approved)
**Pesan Ke Admin (Confirmation):**
```
✅ *Perpanjangan Disetujui*

Booking Code: [CODE]
Pelanggan: [NAMA]
Biaya: Rp [AMOUNT]

Status: Sudah disetujui dan notifikasi telah dikirim ke pelanggan.
```

### 3. Saat Admin Menolak (Rejected)
**Pesan Ke Admin (Confirmation):**
```
❌ *Perpanjangan Ditolak*

Booking Code: [CODE]
Pelanggan: [NAMA]
Biaya yang Ditawarkan: Rp [AMOUNT]

Status: Sudah ditolak dan notifikasi telah dikirim ke pelanggan.
```

## Implementation Details

**File yang dimodifikasi:**
- `app/Services/ExtendBookingService.php` - Tambah trait & WhatsApp calls
- `app/Traits/SendsWhatsAppNotifications.php` - Trait baru untuk sending messages

**Flow:**
1. **requestExtension()** → Kirim pesan ke user + admin
2. **approveExtension()** → Kirim pesan ke user + admin
3. **rejectExtension()** → Kirim pesan ke user + admin

**Environment Variables:**
- `FONNTE_API_TOKEN` - Token API Fonnte (sudah ada di .env)
- `ADMIN_PHONE` - Nomor HP admin untuk menerima notifikasi

**Error Handling:**
- Semua WhatsApp calls dibungkus dalam try-catch
- Jika gagal, di-log ke storage/logs tapi tidak mengganggu proses bisnis
- User experience tetap smooth meskipun WhatsApp gagal terkirim
