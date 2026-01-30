<x-app-layout>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary: #F59E0B;
    --primary-dark: #D97706;
    --dark: #111827;
    --gray: #6B7280;
    --light: #F9FAFB;
    --border: #E5E7EB;
    --success: #10B981;
}

body {
    font-family: 'Inter', sans-serif;
    background: #FFFFFF;
    color: var(--dark);
    line-height: 1.5;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
}

/* Breadcrumb - Compact */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: var(--gray);
    margin-bottom: 1rem;
}

.breadcrumb a {
    color: var(--gray);
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb a:hover {
    color: var(--primary);
}

.breadcrumb i.fa-chevron-right {
    font-size: 0.625rem;
}

/* Main Grid - Compact */
.main-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

@media (min-width: 1024px) {
    .main-grid {
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
    }
}

/* Card - Minimal */
.card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 1rem;
}

/* Gallery - Compact */
.gallery-main {
    position: relative;
    height: 320px;
    border-radius: 8px;
    overflow: hidden;
    background: #000;
    margin-bottom: 0.75rem;
}

.gallery-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.car-title {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 1rem;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
}

.car-title h1 {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.125rem;
}

.car-title p {
    color: var(--primary);
    font-size: 0.875rem;
    font-weight: 600;
}

.badges {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    display: flex;
    gap: 0.375rem;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.6875rem;
    font-weight: 600;
    backdrop-filter: blur(8px);
}

.badge-premium {
    background: rgba(245, 158, 11, 0.9);
    color: white;
}

.badge-available {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.rating-badge {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(8px);
    padding: 0.375rem 0.625rem;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 0.375rem;
    color: white;
    font-weight: 600;
    font-size: 0.8125rem;
}

.gallery-thumbs {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.5rem;
}

.thumb {
    height: 60px;
    border-radius: 6px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.2s;
    opacity: 0.6;
}

.thumb:hover,
.thumb.active {
    border-color: var(--primary);
    opacity: 1;
}

.thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Specs - Compact Grid */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
}

.spec-item {
    background: var(--light);
    border-radius: 6px;
    padding: 0.75rem;
    text-align: center;
}

.spec-item i {
    font-size: 1.25rem;
    color: var(--primary);
    margin-bottom: 0.375rem;
}

.spec-label {
    font-size: 0.6875rem;
    color: var(--gray);
    margin-bottom: 0.125rem;
}

.spec-value {
    font-weight: 600;
    font-size: 0.875rem;
}

/* Features - Minimal */
.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
    margin-top: 0.75rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: var(--gray);
}

.feature-item i {
    font-size: 1rem;
    color: var(--primary);
}

/* Section - Minimal */
.section-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-title i {
    color: var(--primary);
    font-size: 0.875rem;
}

/* Calendar - Compact */
.date-picker {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.date-field label {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 0.375rem;
    color: var(--dark);
}

.date-field input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    font-family: inherit;
    font-size: 0.8125rem;
}

.date-field input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.calendar-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.calendar-nav h4 {
    font-size: 0.9375rem;
    font-weight: 600;
}

.calendar-nav button {
    width: 28px;
    height: 28px;
    border: none;
    background: var(--light);
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.75rem;
}

.calendar-nav button:hover {
    background: var(--primary);
    color: white;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 0.25rem;
    margin-bottom: 0.75rem;
}

.calendar-day-header {
    text-align: center;
    font-size: 0.6875rem;
    font-weight: 600;
    color: var(--gray);
    padding: 0.375rem 0;
}

.calendar-day {
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8125rem;
    font-weight: 500;
    border-radius: 4px;
    cursor: pointer;
}

.calendar-day.available {
    background: var(--light);
}

.calendar-day.available:hover {
    background: var(--primary);
    color: white;
}

.calendar-day.booked {
    background: #FEE2E2;
    color: #DC2626;
    cursor: pointer;
    position: relative;
}

.calendar-day.booked:hover {
    background: #FCA5A5;
}

.calendar-day.selected-start,
.calendar-day.selected-end {
    background: var(--success);
    color: white;
}

.calendar-day.selected-range {
    background: #D1FAE5;
    color: #065F46;
}

.calendar-day.today {
    border: 2px solid #3B82F6;
}

.calendar-day.past {
    background: transparent;
    color: #D1D5DB;
    cursor: not-allowed;
}

/* Tooltip - Modern */
.booking-tooltip {
    position: fixed;
    background: rgba(17, 24, 39, 0.96);
    color: white;
    padding: 0.625rem;
    border-radius: 6px;
    font-size: 0.75rem;
    z-index: 1000;
    min-width: 180px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.15s;
}

.booking-tooltip.show {
    opacity: 1;
}

.booking-tooltip-header {
    font-weight: 600;
    margin-bottom: 0.375rem;
    padding-bottom: 0.375rem;
    border-bottom: 1px solid rgba(255,255,255,0.15);
    color: var(--primary);
    font-size: 0.6875rem;
}

.booking-tooltip-row {
    display: flex;
    gap: 0.375rem;
    margin-bottom: 0.25rem;
    font-size: 0.6875rem;
}

.booking-tooltip-label {
    color: rgba(255,255,255,0.6);
    min-width: 50px;
}

.booking-tooltip-value {
    font-weight: 500;
}

.status-badge {
    display: inline-block;
    padding: 0.125rem 0.375rem;
    border-radius: 3px;
    font-size: 0.625rem;
    font-weight: 600;
}

.status-confirmed {
    background: #DBEAFE;
    color: #1E40AF;
}

.status-active {
    background: #D1FAE5;
    color: #065F46;
}

/* Legend - Compact */
.calendar-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid var(--border);
    font-size: 0.75rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 3px;
}

/* Price Estimate - Compact */
.price-estimate {
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    border: 1px solid var(--success);
    border-radius: 6px;
    padding: 0.875rem;
    margin-top: 0.75rem;
    display: none;
}

.price-estimate.show {
    display: block;
}

.price-estimate-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.625rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: #065F46;
}

.price-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.375rem;
    font-size: 0.8125rem;
}

.price-row.total {
    border-top: 1px solid var(--success);
    padding-top: 0.5rem;
    margin-top: 0.5rem;
    font-weight: 700;
    font-size: 1rem;
}

/* Price Card - Sticky Compact */
.price-card {
    background: var(--dark);
    color: white;
    border-radius: 8px;
    padding: 1rem;
    position: sticky;
    top: 1rem;
}

.price-card h3 {
    margin-bottom: 0.875rem;
    font-size: 1.125rem;
    font-weight: 600;
}

.price-option {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 6px;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
}

.price-option-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.25rem;
}

.price-option-label {
    font-size: 0.8125rem;
    color: rgba(255,255,255,0.65);
}

.price-option-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
}

.price-option.featured {
    background: rgba(245, 158, 11, 0.12);
    border-color: var(--primary);
}

.price-info {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.55);
    margin: 0.75rem 0;
    padding: 0.75rem 0;
    border-top: 1px solid rgba(255,255,255,0.08);
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.price-features {
    margin: 0.75rem 0;
}

.price-feature {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
    margin-bottom: 0.375rem;
    color: rgba(255,255,255,0.75);
}

.price-feature i {
    color: var(--success);
    font-size: 0.75rem;
}

/* Buttons - Compact */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
    padding: 0.625rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.8125rem;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    text-decoration: none;
    width: 100%;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
}

.btn-secondary {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
}

.btn-secondary:hover {
    background: rgba(255,255,255,0.05);
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-success:hover {
    background: #059669;
}

.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Reviews - Compact */
.review-item {
    border-bottom: 1px solid var(--border);
    padding: 0.75rem 0;
}

.review-item:last-child {
    border-bottom: none;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 0.5rem;
}

.review-user {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.review-avatar {
    width: 32px;
    height: 32px;
    background: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.review-name {
    font-weight: 600;
    font-size: 0.875rem;
}

.review-date {
    font-size: 0.6875rem;
    color: var(--gray);
}

.review-stars {
    color: var(--primary);
    font-size: 0.75rem;
}

.review-comment {
    color: var(--gray);
    font-size: 0.8125rem;
    line-height: 1.5;
}

/* Related Cars - Compact */
.related-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-top: 1rem;
}

@media (min-width: 768px) {
    .related-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.related-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.2s;
}

.related-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.related-image {
    height: 140px;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-content {
    padding: 0.75rem;
}

.related-brand {
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 0.125rem;
}

.related-name {
    color: var(--primary);
    font-size: 0.8125rem;
    margin-bottom: 0.5rem;
}

.related-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
    font-size: 0.8125rem;
}

.related-price-label {
    color: var(--gray);
    font-size: 0.75rem;
}

.related-price-value {
    font-weight: 700;
}

.spinner {
    border: 2px solid var(--border);
    border-top-color: var(--primary);
    border-radius: 50%;
    width: 16px;
    height: 16px;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .gallery-main {
        height: 260px;
    }

    .car-title h1 {
        font-size: 1.25rem;
    }

    .specs-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .gallery-thumbs {
        grid-template-columns: repeat(4, 1fr);
    }

    .date-picker {
        grid-template-columns: 1fr;
    }
}

/* Utility */
.divider {
    height: 1px;
    background: var(--border);
    margin: 0.75rem 0;
}
</style>

<div class="container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('cars.index') }}"><i class="fa-solid fa-home"></i> Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ route('cars.index') }}">Cars</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span style="color: var(--dark); font-weight: 600;">{{ $car->name }}</span>
    </div>

    <div class="main-grid">
        {{-- Left Column --}}
        <div style="display: flex; flex-direction: column; gap: 1rem;">

            {{-- Gallery --}}
            <div class="card" style="padding: 0; overflow: hidden;">
                <div class="gallery-main" id="mainImage">
                    @if($car->images->first())
                        <img src="{{ asset('storage/'.$car->images->first()->image_path) }}" alt="{{ $car->name }}">
                    @else
                        <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: #000;">
                            <i class="fa-solid fa-car" style="font-size: 3rem; color: #666;"></i>
                        </div>
                    @endif

                    <div class="badges">
                        @if($car->status == 'available')
                        <span class="badge badge-available"><i class="fa-solid fa-check"></i> Available</span>
                        @endif
                        <span class="badge badge-premium"><i class="fa-solid fa-crown"></i> Premium</span>
                    </div>

                    @if($averageRating > 0)
                    <div class="rating-badge">
                        <i class="fa-solid fa-star"></i>
                        <span>{{ number_format($averageRating, 1) }}</span>
                    </div>
                    @endif

                    <div class="car-title">
                        <h1>{{ $car->brand }} {{ $car->name }}</h1>
                        <p>{{ $car->year }} • {{ ucfirst($car->transmission) }}</p>
                    </div>
                </div>

                @if($car->images->count() > 1)
                <div style="padding: 0.75rem;">
                    <div class="gallery-thumbs">
                        @foreach($car->images->take(5) as $index => $image)
                        <div class="thumb {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage('{{ asset('storage/'.$image->image_path) }}', this)">
                            <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $car->name }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Specs --}}
            <div class="card">
                <div class="section-title">
                    <i class="fa-solid fa-gauge"></i> Specifications
                </div>

                <div class="specs-grid">
                    <div class="spec-item">
                        <i class="fa-solid fa-calendar"></i>
                        <div class="spec-label">Year</div>
                        <div class="spec-value">{{ $car->year }}</div>
                    </div>
                    <div class="spec-item">
                        <i class="fa-solid fa-users"></i>
                        <div class="spec-label">Seats</div>
                        <div class="spec-value">{{ $car->seats }}</div>
                    </div>
                    <div class="spec-item">
                        <i class="fa-solid fa-gears"></i>
                        <div class="spec-label">Trans</div>
                        <div class="spec-value">{{ ucfirst($car->transmission) }}</div>
                    </div>
                    <div class="spec-item">
                        <i class="fa-solid fa-gas-pump"></i>
                        <div class="spec-label">Fuel</div>
                        <div class="spec-value">{{ $car->fuel_type }}</div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fa-solid fa-snowflake"></i>
                        <span>Air Conditioner</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa-solid fa-shield"></i>
                        <span>Safety Features</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa-brands fa-bluetooth"></i>
                        <span>Bluetooth</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa-solid fa-camera"></i>
                        <span>Camera</span>
                    </div>
                </div>
            </div>

            {{-- Calendar --}}
            <div class="card">
                <div class="section-title">
                    <i class="fa-solid fa-calendar-check"></i> Check Availability
                </div>

                <div class="date-picker">
                    <div class="date-field">
                        <label>Start Date</label>
                        <input type="date" id="startDate" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="date-field">
                        <label>End Date</label>
                        <input type="date" id="endDate" min="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <button type="button" id="checkAvailability" class="btn btn-primary">
                    <i class="fa-solid fa-search"></i> Check Availability
                </button>

                <div class="price-estimate" id="priceEstimateBox">
                    <div class="price-estimate-header">
                        <span><i class="fa-solid fa-check-circle"></i> Available!</span>
                        <span id="rentalDuration"></span>
                    </div>

                    <div class="price-row">
                        <span>Base Price:</span>
                        <span id="basePrice" style="font-weight: 600;">Rp 0</span>
                    </div>
                    <div class="price-row">
                        <span>Service:</span>
                        <span id="serviceCharge" style="font-weight: 600;">Rp 0</span>
                    </div>
                    <div class="price-row total">
                        <span>Total:</span>
                        <span id="totalPrice">Rp 0</span>
                    </div>
                    <div style="font-size: 0.75rem; color: #065F46; margin-top: 0.375rem;">
                        Min. DP: <span id="minDeposit" style="font-weight: 600;">Rp 0</span>
                    </div>

                    <a href="{{ route('bookings.create', ['car' => $car->id]) }}" id="bookNowBtn" class="btn btn-success" style="margin-top: 0.75rem;">
                        <i class="fa-solid fa-calendar-check"></i> Book Now
                    </a>
                </div>

                <div style="margin-top: 1rem;">
                    <div class="calendar-nav">
                        <button id="prevMonth"><i class="fa-solid fa-chevron-left"></i></button>
                        <h4 id="currentMonth"></h4>
                        <button id="nextMonth"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>

                    <div class="calendar-grid" id="calendarGrid"></div>

                    <div class="calendar-legend">
                        <div class="legend-item">
                            <div class="legend-dot" style="background: var(--light);"></div>
                            <span>Available</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background: #FEE2E2;"></div>
                            <span>Booked</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background: #D1FAE5;"></div>
                            <span>Selected</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reviews --}}
            <div class="card">
                <div class="section-title">
                    <i class="fa-solid fa-star"></i> Reviews ({{ $totalReviews }})
                </div>

                @if($car->reviews->count() > 0)
                    @foreach($car->reviews->take(3) as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <div class="review-user">
                                @if($review->user)
                                <div class="review-avatar">{{ strtoupper(substr($review->user->name, 0, 1)) }}</div>
                                <div>
                                    <div class="review-name">{{ $review->user->name }}</div>
                                    <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                                @else
                                <div class="review-avatar">?</div>
                                <div>
                                    <div class="review-name">Unknown User</div>
                                    <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                                @endif
                            </div>
                            <div class="review-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'fa-regular' }}" style="{{ $i > $review->rating ? 'color: #D1D5DB;' : '' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="review-comment">{{ $review->comment }}</p>
                    </div>
                    @endforeach
                @else
                    <div class="py-6 text-center">
                        <p class="text-slate-600 mb-4">Belum ada ulasan untuk mobil ini.</p>
                        <a href="{{ route('reviews.create') }}" class="btn btn-primary" style="display:inline-block; width:auto;">
                            <i class="fa-solid fa-plus"></i> Tambah Ulasan
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Price Card --}}
        <div>
            <div class="price-card">
                <h3>Rental Price</h3>

                <div class="price-option featured">
                    <div class="price-option-header">
                        <span class="price-option-label">24 Hours</span>
                        <span class="badge badge-premium" style="font-size: 0.625rem;">BEST</span>
                    </div>
                    <div class="price-option-value">Rp {{ number_format($car->price_24h, 0, ',', '.') }}</div>
                </div>

                <div class="price-option">
                    <div class="price-option-header">
                        <span class="price-option-label">12 Hours</span>
                    </div>
                    <div class="price-option-value">Rp {{ number_format($car->price_24h * 0.7, 0, ',', '.') }}</div>
                </div>

                <div class="price-info">
                    <i class="fa-solid fa-info-circle"></i> Minimum 30% deposit required
                </div>

                <a href="{{ route('bookings.create', ['car' => $car->id]) }}" class="btn btn-primary" style="margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-calendar-check"></i> Book Now
                </a>

                <a href="https://wa.me/6281234567890?text=Hi, I'm interested in {{ $car->brand }} {{ $car->name }}" class="btn btn-secondary">
                    <i class="fa-brands fa-whatsapp"></i> Contact Us
                </a>

                <div class="price-features">
                    <div class="price-feature">
                        <i class="fa-solid fa-check"></i>
                        <span>Free delivery</span>
                    </div>
                    <div class="price-feature">
                        <i class="fa-solid fa-check"></i>
                        <span>Well maintained</span>
                    </div>
                    <div class="price-feature">
                        <i class="fa-solid fa-check"></i>
                        <span>24/7 support</span>
                    </div>
                    <div class="price-feature">
                        <i class="fa-solid fa-check"></i>
                        <span>Easy booking</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Cars --}}
    @if($relatedCars->count() > 0)
    <div style="margin-top: 2rem;">
        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Similar Cars</h2>

        <div class="related-grid">
            @foreach($relatedCars as $relatedCar)
            <div class="related-card">
                <div class="related-image">
                    @if($relatedCar->images->first())
                        <img src="{{ asset('storage/'.$relatedCar->images->first()->image_path) }}" alt="{{ $relatedCar->name }}">
                    @else
                        <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: #000;">
                            <i class="fa-solid fa-car" style="font-size: 2.5rem; color: #666;"></i>
                        </div>
                    @endif
                </div>

                <div class="related-content">
                    <div class="related-brand">{{ $relatedCar->brand }}</div>
                    <div class="related-name">{{ $relatedCar->name }}</div>

                    <div class="related-price">
                        <span class="related-price-label">24 Hours</span>
                        <span class="related-price-value">Rp {{ number_format($relatedCar->price_24h / 1000, 0) }}K</span>
                    </div>

                    <a href="{{ route('cars.show', $relatedCar) }}" class="btn btn-primary" style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
const carId = {{ $car->id }};
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

function changeMainImage(src, thumb) {
    document.querySelector('#mainImage img').src = src;
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}

const bookedDates = @json($car->bookings->map(function($booking) {
    $dates = [];
    $start = \Carbon\Carbon::parse($booking->start_datetime);
    $end = \Carbon\Carbon::parse($booking->end_datetime);
    while($start <= $end) {
        $dates[] = $start->format('Y-m-d');
        $start->addDay();
    }
    return $dates;
})->flatten()->unique()->values());

let bookingDetailsMap = {};
let currentDate = new Date();
let selectedStartDate = null;
let selectedEndDate = null;

const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

const tooltip = document.createElement('div');
tooltip.className = 'booking-tooltip';
document.body.appendChild(tooltip);

function showBookingTooltip(dateStr, element) {
    const booking = bookingDetailsMap[dateStr];
    if (!booking) return;

    const statusLabel = booking.status === 'confirmed' ? 'Confirmed' : 'Active';
    const statusClass = booking.status === 'confirmed' ? 'status-confirmed' : 'status-active';

    tooltip.innerHTML = `
        <div class="booking-tooltip-header">
            ${booking.booking_code}
        </div>
        <div class="booking-tooltip-row">
            <span class="booking-tooltip-label">Customer:</span>
            <span class="booking-tooltip-value">${booking.user_name}</span>
        </div>
        <div class="booking-tooltip-row">
            <span class="booking-tooltip-label">Status:</span>
            <span class="status-badge ${statusClass}">${statusLabel}</span>
        </div>
        <div class="booking-tooltip-row">
            <span class="booking-tooltip-label">Period:</span>
            <span class="booking-tooltip-value">${booking.start} - ${booking.end}</span>
        </div>
    `;

    const rect = element.getBoundingClientRect();
    tooltip.style.left = rect.left + (rect.width / 2) + 'px';
    tooltip.style.top = (rect.top + window.scrollY - 10) + 'px';
    tooltip.style.transform = 'translate(-50%, -100%)';
    tooltip.classList.add('show');
}

function hideBookingTooltip() {
    tooltip.classList.remove('show');
}

async function loadBookingDetails(year, month) {
    try {
        const response = await fetch(`/api/cars/${carId}/booked-dates?year=${year}&month=${month}`);
        const data = await response.json();

        if (data.booking_details) {
            bookingDetailsMap = data.booking_details;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;

    loadBookingDetails(year, month + 1);

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    let html = '';
    const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    dayHeaders.forEach(day => html += `<div class="calendar-day-header">${day}</div>`);

    for (let i = 0; i < firstDay; i++) html += '<div class="calendar-day"></div>';

    for (let day = 1; day <= daysInMonth; day++) {
        const dateObj = new Date(year, month, day);
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const isBooked = bookedDates.includes(dateStr);
        const isToday = today.getTime() === dateObj.getTime();
        const isPast = dateObj < today;
        const isSelectedStart = selectedStartDate === dateStr;
        const isSelectedEnd = selectedEndDate === dateStr;
        const isInRange = selectedStartDate && selectedEndDate && dateStr > selectedStartDate && dateStr < selectedEndDate;

        let classes = 'calendar-day';
        if (isPast) classes += ' past';
        else if (isBooked) classes += ' booked';
        else classes += ' available';
        if (isToday) classes += ' today';
        if (isSelectedStart) classes += ' selected-start';
        if (isSelectedEnd) classes += ' selected-end';
        if (isInRange) classes += ' selected-range';

        const onclick = (!isPast && !isBooked) ? `onclick="selectDate('${dateStr}')"` : '';
        const onmouseover = isBooked ? `onmouseover="showBookingTooltip('${dateStr}', this)"` : '';
        const onmouseout = isBooked ? `onmouseout="hideBookingTooltip()"` : '';

        html += `<div class="${classes}" ${onclick} ${onmouseover} ${onmouseout}>${day}</div>`;
    }

    document.getElementById('calendarGrid').innerHTML = html;
}

function selectDate(dateStr) {
    if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
        selectedStartDate = dateStr;
        selectedEndDate = null;
        document.getElementById('startDate').value = dateStr;
        document.getElementById('endDate').value = '';
    } else {
        if (dateStr > selectedStartDate) {
            selectedEndDate = dateStr;
            document.getElementById('endDate').value = dateStr;
        } else {
            selectedEndDate = selectedStartDate;
            selectedStartDate = dateStr;
            document.getElementById('startDate').value = dateStr;
            document.getElementById('endDate').value = selectedEndDate;
        }
    }
    renderCalendar();
}

document.getElementById('prevMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});

document.getElementById('nextMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

document.getElementById('startDate').addEventListener('change', function() {
    selectedStartDate = this.value;
    renderCalendar();
});

document.getElementById('endDate').addEventListener('change', function() {
    selectedEndDate = this.value;
    renderCalendar();
});

document.getElementById('checkAvailability').addEventListener('click', async function() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    if (!startDate || !endDate) {
        alert('Please select start and end dates');
        return;
    }

    const button = this;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<span class="spinner"></span> Checking...';

    try {
        const availabilityResponse = await fetch(`/api/cars/${carId}/check-availability`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ start_date: startDate, end_date: endDate })
        });

        const availabilityData = await availabilityResponse.json();

        if (!availabilityData.available) {
            alert(availabilityData.message);
            button.disabled = false;
            button.innerHTML = originalText;
            return;
        }

        const priceResponse = await fetch(`/api/cars/${carId}/price-estimate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                start_date: startDate,
                end_date: endDate,
                service_type: 'lepas_kunci'
            })
        });

        const priceData = await priceResponse.json();

        document.getElementById('rentalDuration').textContent = `${priceData.days} days`;
        document.getElementById('basePrice').textContent = `Rp ${priceData.base_price.toLocaleString('id-ID')}`;
        document.getElementById('serviceCharge').textContent = `Rp ${priceData.service_charge.toLocaleString('id-ID')}`;
        document.getElementById('totalPrice').textContent = `Rp ${priceData.total_price.toLocaleString('id-ID')}`;
        document.getElementById('minDeposit').textContent = `Rp ${priceData.min_deposit.toLocaleString('id-ID')}`;

        const bookingUrl = new URL(document.getElementById('bookNowBtn').href);
        bookingUrl.searchParams.set('start', startDate);
        bookingUrl.searchParams.set('end', endDate);
        document.getElementById('bookNowBtn').href = bookingUrl.toString();

        document.getElementById('priceEstimateBox').classList.add('show');
        document.getElementById('priceEstimateBox').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    } finally {
        button.disabled = false;
        button.innerHTML = originalText;
    }
});

renderCalendar();
</script>

{{-- Car specific reviews (from bookings) --}}
@if(isset($carReviews) && $carReviews->count() > 0)
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold">Ulasan untuk {{ $car->brand }} {{ $car->name }}</h3>
                <a href="{{ route('reviews.create') }}" class="text-yellow-600 font-semibold">Tambah Ulasan</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($carReviews as $review)
                    <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                        @if($review->image_path)
                            <img src="{{ asset('storage/'.$review->image_path) }}" class="w-full h-36 object-cover rounded-md mb-3" alt="Review image">
                        @endif
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-yellow-600/10 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-user text-yellow-600"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-sm">{{ $review->booking->user->name ?? 'Pelanggan' }}</div>
                                    <div class="text-xs text-slate-500">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="text-sm font-bold">{{ $review->rating }}/5</div>
                        </div>
                        <p class="text-sm text-slate-600 mb-2">{{ $review->comment ?? 'Pelanggan puas.' }}</p>
                        <div class="text-xs text-slate-500">Mobil: {{ $review->booking->car->brand ?? '' }} {{ $review->booking->car->name ?? '' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

</x-app-layout>
