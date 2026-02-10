# Booking Extension - Quick Reference Guide

## 🚀 Quick Start for Developers

### Setup
```bash
# Database migration sudah applied
php artisan migrate

# Model sudah created
php artisan tinker
>>> \App\Models\BookingExtension::count()

# Routes sudah registered
php artisan route:list | grep extend
```

### File Locations

```
app/
  ├─ Models/
  │  ├─ BookingExtension.php        ← Extension model
  │  └─ Booking.php                 ← Updated with extensions() relationship
  ├─ Services/
  │  ├─ BookingConflictService.php  ← Conflict detection logic
  │  ├─ ExtendBookingService.php    ← Main business logic
  │  └─ CarStatusService.php        ← Car status sync
  ├─ Http/
  │  ├─ Controllers/
  │  │  └─ BookingExtensionController.php
  │  └─ Requests/
  │     └─ ExtendBookingRequest.php  ← Form validation
  └─ Notifications/
     └─ ExtensionStatusNotification.php

database/
  └─ migrations/
     └─ 2026_02_10_010624_create_table_booking_extensions.php

resources/views/
  ├─ bookings/
  │  └─ show.blade.php              ← User UI + modal
  ├─ admin/
  │  └─ booking_extensions/
  │     └─ index.blade.php          ← Admin dashboard
  └─ components/
     └─ admin-layout.blade.php       ← Sidebar menu

routes/
  └─ web.php                         ← All routes defined
```

---

## 🔑 Key Classes

### BookingExtension Model
```php
// Usage
$extension = BookingExtension::find(1);
$extension->booking;           // Get related booking
$extension->status_label;      // Get formatted label
$extension->status_badge;      // Get CSS classes for styling
```

### BookingConflictService
```php
// Check if car has conflicting booking
$conflict = app(BookingConflictService::class);
$has_conflict = $conflict->hasConflict(
    car_id: 1,
    start: '2026-02-20 10:00',
    end: '2026-02-20 14:00',
    excludeId: null  // exclude this booking ID
);

// Check extension conflict specifically
$check = $conflict->checkExtensionConflict($booking, '2026-02-20 16:00');
// Returns: ['has_conflict' => bool, 'conflicts' => array]
```

### ExtendBookingService
```php
$service = app(ExtendBookingService::class);

// Request extension
$result = $service->requestExtension($booking, $newEndDatetime);
// Returns: ['success' => bool, 'message' => string, 'extension' => ?BookingExtension]

// Approve extension
$result = $service->approveExtension($extension);
// Returns: ['success' => bool, 'message' => string]

// Reject extension
$result = $service->rejectExtension($extension);
// Returns: ['success' => bool, 'message' => string]
```

### CarStatusService
```php
$service = app(CarStatusService::class);

// Update single car status based on booking
$service->updateCarStatusFromBooking($booking);

// Sync all cars' statuses
$service->syncAllCarStatuses();
```

---

## 📡 API Endpoints

### Check Conflict (POST)
```javascript
fetch('/bookings/1/extend-conflict', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({
        new_end_datetime: '2026-02-20 14:30'
    })
})
.then(r => r.json())
.then(data => {
    if (data.has_conflict) {
        console.log('Conflicts:', data.conflicts);
    }
});

// Response
{
    "has_conflict": false,
    "conflicts": [],
    "message": "Mobil tersedia"
}
```

---

## 📋 Request Extensions

### ExtendBookingRequest Rules
```php
'new_end_datetime' => [
    'required',
    'date',
    new AfterBookingEndDatetime(),  // Custom rule
    new MinimumExtensionHours(),    // Custom rule
]
```

---

## 🔄 Flow Diagrams

### User Request Flow
```
User Booking Detail
    ↓ [Klik "Perpanjang Sewa"]
Modal Opens
    ↓ [Pilih datetime]
Real-time Conflict Check (AJAX)
    ↓ [checkConflict() API]
  ├─ No conflict → Show success alert
  └─ Conflict → Show error alert
    ↓ [Submit]
ExtendBookingController::store()
    ↓
ExtendBookingRequest::validate()
    ↓
ExtendBookingService::requestExtension()
    ├─ Check booking status = running
    ├─ Check conflicts
    └─ Create extension with status=requested
    ↓
Flash success message
```

### Admin Approval Flow
```
Admin Dashboard (/admin/booking-extensions)
    ↓ [View pending in tab]
    ↓ [Klik "Setujui"]
BookingExtensionController::approve()
    ↓
ExtendBookingService::approveExtension()
    ↓
DB::transaction() {
    Update booking.end_datetime
    Update booking.total_price
    Create Payment record
    Update extension.status = approved
    Call CarStatusService::updateCarStatusFromBooking()
    Send ExtensionStatusNotification
}
    ↓
Redirect with success
    ↓
User receives email
```

---

## 🧪 Testing Quick Commands

```php
// Test in tinker
$booking = Booking::whereStatus('running')->first();
$extension_service = app(\App\Services\ExtendBookingService::class);

// Create test extension
$result = $extension_service->requestExtension(
    $booking,
    \Carbon\Carbon::now()->addHours(2)
);

// Check result
dd($result);

// Check conflicts
$conflict_service = app(\App\Services\BookingConflictService::class);
$check = $conflict_service->checkExtensionConflict(
    $booking,
    \Carbon\Carbon::now()->addHours(1)
);
dd($check);

// Get all extensions
\App\Models\BookingExtension::with('booking')->get();
```

---

## 🛠️ Common Tasks

### How to: Create Extension Manually
```php
$extension = \App\Models\BookingExtension::create([
    'booking_id' => 1,
    'old_end_datetime' => $booking->end_datetime,
    'new_end_datetime' => $newEndDatetime,
    'extra_price' => 100000,
    'status' => 'requested'
]);
```

### How to: Approve Extension Programmatically
```php
$service = app(\App\Services\ExtendBookingService::class);
$extension = \App\Models\BookingExtension::find(1);
$result = $service->approveExtension($extension);

if ($result['success']) {
    // Extension approved, booking updated
}
```

### How to: Check Car Availability
```php
$conflict = app(\App\Services\BookingConflictService::class);
$available = !$conflict->hasConflict(
    car_id: 1,
    start: '2026-02-20 10:00',
    end: '2026-02-20 14:00'
);
```

### How to: Get All Pending Extensions
```php
$pending = \App\Models\BookingExtension::where('status', 'requested')
    ->with('booking.user', 'booking.car')
    ->get();
```

### How to: Calculate Extra Price
```php
$hourly_rate = $booking->total_price / ($booking->duration_in_days * 24);
$extra_hours = $booking->end_datetime->diffInHours($new_end_datetime);
$extra_price = $extra_hours * $hourly_rate;
```

---

## 🐛 Debug Checklist

- [ ] Check migration applied: `php artisan migrate:status`
- [ ] Verify table exists: `SELECT * FROM booking_extensions LIMIT 1;`
- [ ] Check routes: `php artisan route:list | grep extend`
- [ ] Test services in tinker
- [ ] Check mail config: `.env` MAIL_* settings
- [ ] Verify notifications: Check database notifications table
- [ ] Test conflict detection with overlapping datetimes
- [ ] Test API endpoint with Postman/cURL

---

## 📌 Important Notes

1. **Status Transitions**: Extension only works for bookings with status='running'
2. **Timezone**: All datetime operations use app timezone
3. **Currency**: All prices in IDR
4. **Transactions**: Approval uses DB::transaction for safety
5. **Notifications**: ShouldQueue - requires queue worker
6. **Conflict Logic**: 3-part overlap detection (start-between, end-between, wrap-both)

---

## 🔗 Related Features

- **Booking Model**: Main booking entity
- **Payment Model**: Created automatically on approval
- **Car Model**: Status updated on approval
- **User Model**: Receives notifications
- **UpdateBookingStatus Command**: Auto status transitions

---

## 📞 Contact & Support

**Issues?** Check:
1. `docs/BOOKING_EXTENSION.md` - Full technical documentation
2. `BOOKING_EXTENSION_CHECKLIST.md` - Testing scenarios
3. Model files for relationships
4. Service files for business logic
5. Controller for API endpoints

---

**Version**: 1.0  
**Last Updated**: January 2026
