# 📧 Setup Reset Password - Development Testing

Panduan lengkap untuk testing fitur reset password di Laragon (development environment).

---

## ✅ Setup Sudah Selesai!

Fitur reset password **sudah berfungsi 100%** di environment lokal (Laragon). Tidak perlu koneksi ke Gmail atau Mailtrap.

---

## 🚀 Quick Start - Testing Reset Password

### **Langkah 1: Request Reset Password**

1. Buka: `http://localhost:8000/forgot-password`
2. Masukkan email dari user yang terdaftar
3. Klik **"Kirim Link Reset Password"**
4. Sistem akan menyimpan reset token di database

### **Langkah 2: Ambil Reset Link**

Gunakan **SALAH SATU** cara di bawah:

---

#### **Cara A: Debug Page (Paling Mudah ✅ REKOMENDASI)**

1. Buka: `http://localhost:8000/debug/password-reset`
2. Pilih user dari list atau search email
3. Copy reset link yang muncul
4. Buka link di browser untuk reset password

**Keuntungan:**
- ✅ Interface yang user-friendly
- ✅ Bisa lihat semua reset tokens
- ✅ Copy/Open link dengan mudah
- ✅ Auto-hidden ketika production (APP_DEBUG=false)

---

#### **Cara B: Command Line**

Jalankan command di terminal:

```bash
php artisan password:show-reset-link your-email@example.com
```

Output akan menampilkan:
```
✅ Reset Password Link Found!
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Email: your-email@example.com
Token: abc123xyz789...

Reset Link:
http://localhost:8000/reset-password/abc123xyz789...
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
```

Copy link tersebut dan buka di browser.

---

#### **Cara C: Check Database**

Langsung query tabel `password_reset_tokens` untuk lihat reset token:

```bash
php artisan tinker
```

Kemudian:
```php
DB::table('password_reset_tokens')->latest()->get();
```

Atau gunakan database tool seperti phpMyAdmin atau DBeaver.

---

### **Langkah 3: Reset Password**

1. Buka reset link yang sudah dicopy
2. Halaman reset password akan muncul
3. Masukkan password baru (2x)
4. Klik **"Reset Password"**
5. Password sudah diganti!

### **Langkah 4: Login dengan Password Baru**

1. Buka: `http://localhost:8000/login`
2. Masukkan email dan password baru
3. Login berhasil ✅

---

## 🔧 Konfigurasi Email (Development vs Production)

### **Development (Laragon) - Sekarang ✅**

```bash
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

Email tidak benar-benar dikirim, tapi reset link disimpan di database dan bisa diakses via debug page.

---

### **Production (Deploy ke Server) - Nanti**

Ketika deploy, ubah ke Gmail SMTP:

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=app-password-dari-gmail
MAIL_ENCRYPTION=tls
```

**Setup Gmail untuk Production:**
1. Aktifkan 2FA di Gmail
2. Generate App Password
3. Copy credentials ke `.env` di server
4. Jalankan `php artisan config:cache`

---

## 📋 File-File Terkait

| File | Fungsi |
|------|--------|
| `resources/views/auth/forgot-password.blade.php` | Form untuk request reset password |
| `resources/views/auth/debug-password-reset.blade.php` | Debug page untuk lihat reset link |
| `app/Http/Controllers/Auth/PasswordResetLinkController.php` | Logic untuk handle forgot password |
| `app/Http/Controllers/Auth/NewPasswordController.php` | Logic untuk handle reset password |
| `app/Http/Controllers/Auth/DebugPasswordResetController.php` | Controller untuk debug page |
| `app/Console/Commands/ShowResetPasswordLink.php` | Command untuk lihat reset link |
| `.env` | Mail configuration |
| `config/mail.php` | Mail config settings |

---

## ✅ Checklist Testing

- [ ] Akses `/forgot-password`
- [ ] Masukkan email user yang terdaftar
- [ ] Klik "Kirim Link Reset Password"
- [ ] Buka `/debug/password-reset` atau jalankan command
- [ ] Copy reset link
- [ ] Buka reset link di browser
- [ ] Masukkan password baru
- [ ] Login dengan password baru
- [ ] Berhasil! ✅

---

## 🆘 Troubleshooting

### ❌ Reset link tidak ditemukan

**Penyebab:**
- Email belum request reset password
- Reset token sudah expired (60 menit)
- Email typo

**Solusi:**
- Pastikan email benar dan user ada di database
- Request reset password lagi
- Check table `password_reset_tokens` di database

---

### ❌ Error saat membuka reset link

**Penyebab:**
- Link sudah expired
- Token tidak valid
- User tidak ditemukan

**Solusi:**
- Request reset password lagi
- Pastikan link di-copy dengan benar
- Check email user ada di database

---

### ❌ Lupa email mana yang request reset

**Solusi:**
- Buka debug page: `http://localhost:8000/debug/password-reset`
- Lihat daftar semua reset tokens yang recent
- Pilih yang mau di-reset

---

## 💡 Tips

1. **Development Testing:** Gunakan debug page (`/debug/password-reset`)
2. **Cepat Testing:** Gunakan command (`php artisan password:show-reset-link`)
3. **Check Database:** Buka phpMyAdmin → table `password_reset_tokens`
4. **Production:** Ganti ke Gmail SMTP atau Mailtrap
5. **Reset Link Expired:** Berlaku 60 menit, buat reset baru jika expired

---

## 🌐 Endpoints

| Endpoint | Method | Fungsi |
|----------|--------|--------|
| `/forgot-password` | GET/POST | Form request reset password |
| `/reset-password/{token}` | GET/POST | Form reset password baru |
| `/debug/password-reset` | GET | Debug page untuk lihat reset links |
| `/debug/password-reset/get-link` | POST | API untuk ambil reset link (AJAX) |

---

## 📚 Referensi

- [Laravel Password Reset](https://laravel.com/docs/passwords)
- [Laravel Mail](https://laravel.com/docs/mail)
- [Gmail App Passwords](https://support.google.com/accounts/answer/185833)

---

**Happy testing! 🚀**
