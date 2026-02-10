# Dokumentasi Fitur Perpanjangan Sewa (Booking Extension)

## Gambaran Umum

Fitur perpanjangan sewa memungkinkan penyewa untuk mengajukan permintaan perpanjangan waktu sewa mobil setelah sewa dimulai. Admin dapat menyetujui atau menolak permintaan tersebut. Sistem ini dilengkapi dengan:

- **Deteksi Konflik**: Mencegah perpanjangan jika mobil sudah dibooking di waktu tersebut
- **Perhitungan Biaya Otomatis**: Menghitung biaya tambahan berdasarkan jam tambahan
- **Real-time Validation**: Validasi konflik di frontend sebelum submit
- **Notifikasi Email**: Notifikasi otomatis ketika permintaan disetujui/ditolak

---

## Arsitektur Teknis

### 1. Database Schema

**Tabel: `booking_extensions`**
```sql
CREATE TABLE booking_extensions (
    id BIGINT UNSIGNED PRIMARY KEY,
    booking_id BIGINT UNSIGNED FOREIGN KEY,
    old_end_datetime DATETIME,
    new_end_datetime DATETIME,
    extra_price DECIMAL(10,2),
    status ENUM('requested', 'approved', 'rejected'),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 2. Model & Relationships

**BookingExtension Model** (`app/Models/BookingExtension.php`)
```php
- belongsTo(Booking)
- Casts: old_end_datetime, new_end_datetime, extra_price
- Accessors: status_label, status_badge
```

**Booking Model** (`app/Models/Booking.php`)
```php
- hasMany(BookingExtension) // Extensions
```

### 3. Service Layer

#### BookingConflictService
**File**: `app/Services/BookingConflictService.php`

Bertanggung jawab untuk mengecek konflik booking:
- `hasConflict($carId, $startDatetime, $endDatetime, $excludeId = null)`: Cek apakah ada booking yang bertabrakan
- `checkExtensionConflict($booking, $newEndDatetime)`: Cek konflik untuk perpanjangan (mengecek booking lain untuk mobil yang sama)

**Logika Overlap Datetime**:
```
Ada konflik jika:
1. new_end BETWEEN old_start AND old_end (end baru masuk di tengah booking lain)
2. old_start BETWEEN new_start AND new_end (start booking lain masuk di tengah extension)
3. (new_start < old_start AND new_end > old_end) (extension membungkus booking lain)
```

#### CarStatusService
**File**: `app/Services/CarStatusService.php`

Otomatis update status mobil berdasarkan booking:
- `updateCarStatusFromBooking($booking)`: Update status mobil berdasarkan status booking
  - confirmed → booked
  - running → rented
  - completed/cancelled → available
- `syncAllCarStatuses()`: Sync semua status mobil

#### ExtendBookingService
**File**: `app/Services/ExtendBookingService.php`

Mengelola logika perpanjangan sewa:
- `requestExtension($booking, $newEndDatetime)`: Buat request perpanjangan (dengan validasi konflik)
- `approveExtension($extension)`: Setujui perpanjangan
  - Update booking.end_datetime
  - Update booking.total_price dengan biaya tambahan
  - Buat Payment record
  - Kirim notifikasi email
  - Update car status
- `rejectExtension($extension)`: Tolak perpanjangan dan kirim notifikasi

### 4. Controller

**BookingExtensionController** (`app/Http/Controllers/BookingExtensionController.php`)

**Methods**:

1. **index()** - Admin View
   - Menampilkan pending, approved, dan rejected extensions
   - Route: `GET /admin/booking-extensions`

2. **store()** - User Request
   - Penyewa mengajukan request perpanjangan
   - Route: `POST /bookings/{booking}/extend`
   - Validation: ExtendBookingRequest

3. **approve()** - Admin Approve
   - Admin menyetujui perpanjangan
   - Route: `POST /admin/booking-extensions/{extension}/approve`

4. **reject()** - Admin Reject
   - Admin menolak perpanjangan
   - Route: `POST /admin/booking-extensions/{extension}/reject`

5. **checkConflict()** - API Endpoint
   - Check konflik untuk frontend (AJAX)
   - Route: `GET /bookings/{booking}/extend-conflict`
   - Response: JSON dengan `has_conflict`, `conflicts` array, `message`

### 5. Form Request Validation

**ExtendBookingRequest** (`app/Http/Requests/ExtendBookingRequest.php`)

```php
Rules:
- new_end_datetime: required, date, after:current_end_datetime
- Minimal perpanjangan: 1 jam (custom rule)
- Pesan error dalam Bahasa Indonesia
```

### 6. Notifications

**ExtensionStatusNotification** (`app/Notifications/ExtensionStatusNotification.php`)

- Channels: mail, database
- Dikirim ketika:
  - Perpanjangan disetujui (approved)
  - Perpanjangan ditolak (rejected)

---

## User Flow

### 1. Penyewa Mengajukan Perpanjangan

**Trigger**: Penyewa berada di halaman detail booking dengan status `running`

**Steps**:
1. Klik tombol "Perpanjang Sewa"
2. Modal terbuka dengan form input
3. Pilih waktu kembali baru (datetime-local input)
4. JavaScript secara real-time:
   - Hitung biaya tambahan (jam_tambahan × tarif_per_jam)
   - Validasi konflik via AJAX ke `checkConflict()` endpoint
   - Tampilkan alert jika ada konflik
   - Tampilkan harga total tambahan
5. Klik "Ajukan Perpanjangan"
6. Form submit ke `BookingExtensionController::store()`
7. Sistem:
   - Validasi dengan ExtendBookingRequest
   - Check konflicting bookings dengan BookingConflictService
   - Create BookingExtension record dengan status='requested'
   - Redirect dengan success message

**View**: `resources/views/bookings/show.blade.php`
- Section: "Perpanjangan Sewa"
- Button: "Perpanjang Sewa" (hanya muncul saat status=running)
- Modal: Form perpanjangan dengan datetime picker
- History: List semua extension requests untuk booking ini

### 2. Admin Review & Approve/Reject

**Trigger**: Admin mengakses `/admin/booking-extensions`

**Halaman Admin**: `resources/views/admin/booking_extensions/index.blade.php`
- 3 tabs: Menunggu Persetujuan, Disetujui, Ditolak
- Setiap request menampilkan:
  - Nama mobil & penyewa
  - Waktu awal (old) dan waktu baru (new)
  - Durasi tambahan (jam)
  - Biaya tambahan
  - Tombol Setujui/Tolak (hanya di tab pending)

**Admin Approve Flow**:
1. Admin klik "Setujui"
2. Sistem menjalankan `approveExtension()`:
   - DB::transaction start
   - Update booking.end_datetime = extension.new_end_datetime
   - Update booking.total_price += extension.extra_price
   - Create Payment record (untuk biaya tambahan)
   - Update extension.status = 'approved'
   - Panggil CarStatusService::updateCarStatusFromBooking()
   - Kirim ExtensionStatusNotification (approved)
   - DB::transaction commit
3. Redirect dengan success message
4. Penyewa menerima email notifikasi

**Admin Reject Flow**:
1. Admin klik "Tolak"
2. Sistem menjalankan `rejectExtension()`:
   - Update extension.status = 'rejected'
   - Kirim ExtensionStatusNotification (rejected)
3. Redirect dengan success message
4. Penyewa menerima email notifikasi

---

## API Endpoints

### 1. Check Conflict (Frontend AJAX)

**Endpoint**: `POST /bookings/{booking}/extend-conflict`

**Request**:
```json
{
    "new_end_datetime": "2026-02-20 14:30"
}
```

**Response Success** (tanpa konflik):
```json
{
    "has_conflict": false,
    "conflicts": [],
    "message": "Mobil tersedia"
}
```

**Response Error** (ada konflik):
```json
{
    "has_conflict": true,
    "conflicts": [
        {
            "id": 5,
            "car_name": "Toyota Innova",
            "start": "2026-02-20T10:00",
            "end": "2026-02-21T14:00"
        }
    ],
    "message": "Mobil tidak tersedia di waktu yang Anda pilih"
}
```

---

## Routes Configuration

**File**: `routes/web.php`

```php
// User Routes (Authenticated)
Route::post('/bookings/{booking}/extend', [BookingExtensionController::class, 'store'])
    ->name('bookings.extend');
Route::get('/bookings/{booking}/extend-conflict', [BookingExtensionController::class, 'checkConflict'])
    ->name('bookings.extend-conflict');

// Admin Routes (Authenticated + Admin Role)
Route::get('/admin/booking-extensions', [BookingExtensionController::class, 'index'])
    ->name('admin.booking-extensions.index');
Route::post('/admin/booking-extensions/{extension}/approve', [BookingExtensionController::class, 'approve'])
    ->name('admin.booking-extensions.approve');
Route::post('/admin/booking-extensions/{extension}/reject', [BookingExtensionController::class, 'reject'])
    ->name('admin.booking-extensions.reject');
```

---

## Business Logic Details

### Perhitungan Biaya Tambahan

```
Hourly Rate = Total Price / Duration (days) / 24
Extra Price = Hours Extended × Hourly Rate

Contoh:
- Total harga: IDR 1.200.000 (3 hari)
- Duration: 3 × 24 = 72 jam
- Hourly rate: 1.200.000 ÷ 72 = IDR 16.667/jam
- Extension: 2 jam
- Extra price: 2 × 16.667 = IDR 33.334
```

### Status Transitions

**Booking Status**:
```
pending → confirmed → running → completed
                   ↓
              (cancelled)
```

**Extension Status**:
```
requested → approved
        ↓
      rejected
```

### Data Consistency

Semua operasi approval/rejection menggunakan `DB::transaction()` untuk memastikan atomicity:
- Jika ada error di tengah proses, seluruh transaksi rollback
- Tidak ada data yang inconsistent

---

## Frontend Integration

### Modal Form (`resources/views/bookings/show.blade.php`)

```blade
- Datetime picker dengan min value = current end_datetime
- Real-time conflict checking via JavaScript
- Display extra price calculation
- Alert untuk conflict warning
- Submit button disabled saat conflict terdeteksi
```

### Admin View (`resources/views/admin/booking_extensions/index.blade.php`)

```blade
- Tab navigation (pending/approved/rejected)
- Extension cards dengan info lengkap
- Approve/Reject buttons di tab pending
- Status badges untuk visual clarity
- Empty state messages
```

### Admin Sidebar

Menu item "Perpanjangan Sewa" ditambahkan ke sidebar dengan:
- Icon: clock/timer
- Active state: highlight saat di halaman extensions
- Badge: menampilkan jumlah pending requests (opsional)

---

## Skenario Testing

### Test Case 1: Happy Path
1. Penyewa mengajukan extension dengan waktu valid
2. Tidak ada konflik
3. Admin approve
4. ✅ Booking updated, payment created, notifikasi dikirim

### Test Case 2: Konflik Detection
1. Penyewa mengajukan extension untuk waktu yang sudah dibooking
2. Frontend deteksi konflik sebelum submit
3. Button disabled, alert ditampilkan
4. ✅ Request tidak bisa submit

### Test Case 3: Admin Reject
1. Penyewa mengajukan extension
2. Admin reject
3. ✅ Extension status=rejected, notifikasi dikirim, booking tidak berubah

### Test Case 4: Invalid Data
1. Penyewa submit dengan waktu < current end_datetime
2. ✅ Validation error, redirect dengan message

---

## Error Handling

### Frontend
- DateTime picker validation (min value)
- Conflict detection dengan retry logic
- Graceful error messages

### Backend
- Form request validation (ExtendBookingRequest)
- Service layer validation (booking status, conflict check)
- Database transaction rollback
- Exception handling dengan meaningful messages

---

## Performance Considerations

1. **Database Query Optimization**:
   - Use with('booking.user', 'booking.car') untuk eager load
   - Index pada booking_id dan status

2. **API Response**:
   - Conflict checking response minimal (hanya data yang perlu)
   - Pagination tidak diperlukan (karena list per booking)

3. **Frontend**:
   - Debounce AJAX conflict check
   - Cache datetime picker state

---

## Future Enhancements

1. **WhatsApp Notification**: Implementasi notifikasi via WhatsApp selain email
2. **Auto Approval**: Rules untuk auto-approve jika tidak ada konflik
3. **Extension History**: Analytics tentang extension requests
4. **Multiple Extensions**: Allow multiple extension requests per booking
5. **Dynamic Pricing**: Pricing adjustment berdasarkan demand/season
6. **Late Return Penalty**: Auto-calculate penalty jika kembali lewat waktu

---

## Troubleshooting

### Konflik tidak terdeteksi
- Check: apakah booking comparisons includes dengan status yang benar?
- Debug: enable SQL logging untuk lihat query

### Email notifikasi tidak terkirim
- Check: Mail configuration di .env
- Check: Queue worker running (php artisan queue:work)
- Check: Notification marked as mailable

### Migration error
- Check: apakah table booking_extensions sudah exist?
- Run: php artisan migrate:refresh (untuk dev environment)

---

## Files Summary

| File | Purpose |
|------|---------|
| `app/Models/BookingExtension.php` | Model definition |
| `app/Models/Booking.php` | Extension relationship |
| `app/Services/BookingConflictService.php` | Conflict detection |
| `app/Services/CarStatusService.php` | Car status automation |
| `app/Services/ExtendBookingService.php` | Business logic |
| `app/Http/Controllers/BookingExtensionController.php` | Controller |
| `app/Http/Requests/ExtendBookingRequest.php` | Validation |
| `app/Notifications/ExtensionStatusNotification.php` | Email notification |
| `database/migrations/*booking_extensions*` | Schema |
| `resources/views/bookings/show.blade.php` | User booking detail + modal |
| `resources/views/admin/booking_extensions/index.blade.php` | Admin management |
| `resources/views/components/admin-layout.blade.php` | Admin menu integration |
| `routes/web.php` | Routes registration |

---

**Versi**: 1.0  
**Terakhir Update**: Januari 2026  
**Author**: Squad Trans Development Team
