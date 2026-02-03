<x-app-layout>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary: #F59E0B;
    --primary-dark: #D97706;
    --primary-light: #FEF3C7;
    --dark: #111827;
    --gray: #6B7280;
    --light: #F9FAFB;
    --border: #E5E7EB;
    --success: #10B981;
    --success-light: #D1FAE5;
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #FAFAFA 0%, #F5F5F5 100%);
    color: var(--dark);
    line-height: 1.5;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
}

/* ============================================= */
/* BREADCRUMB */
/* ============================================= */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: var(--gray);
    margin-bottom: 1.5rem;
    background: white;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.breadcrumb a {
    color: var(--gray);
    text-decoration: none;
    transition: all 0.3s;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

.breadcrumb a:hover {
    color: var(--primary);
    background: var(--primary-light);
}

.breadcrumb i.fa-chevron-right {
    font-size: 0.625rem;
    opacity: 0.5;
}

/* ============================================= */
/* MAIN GRID LAYOUT */
/* ============================================= */
.main-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

@media (min-width: 1024px) {
    .main-grid {
        grid-template-columns: 1fr 340px;
        gap: 2rem;
    }
}

/* ============================================= */
/* CARD */
/* ============================================= */
.card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

/* ============================================= */
/* GALLERY */
/* ============================================= */
.gallery-main {
    position: relative;
    height: 400px;
    border-radius: 16px;
    overflow: hidden;
    background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
    margin-bottom: 1rem;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.gallery-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-main:hover img {
    transform: scale(1.05);
}

.car-title {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 1.5rem;
    background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.4), transparent);
}

.car-title h1 {
    color: white;
    font-size: 1.875rem;
    font-weight: 800;
    margin-bottom: 0.25rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.car-title p {
    color: var(--primary);
    font-size: 0.9375rem;
    font-weight: 600;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

.badges {
    position: absolute;
    top: 1rem;
    left: 1rem;
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.5rem 0.875rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    backdrop-filter: blur(12px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: slideInLeft 0.5s ease;
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

.badge-premium {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.95), rgba(217, 119, 6, 0.95));
    color: white;
}

.badge-available {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95));
    color: white;
}

.rating-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(0,0,0,0.85);
    backdrop-filter: blur(12px);
    padding: 0.625rem 1rem;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-weight: 700;
    font-size: 0.9375rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    animation: slideInRight 0.5s ease;
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 1; transform: translateX(0); }
}

.rating-badge i {
    color: #FCD34D;
}

.gallery-thumbs {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.75rem;
}

.thumb {
    height: 70px;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    opacity: 0.6;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.thumb:hover,
.thumb.active {
    border-color: var(--primary);
    opacity: 1;
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(245, 158, 11, 0.3);
}

.thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumb:hover img {
    transform: scale(1.1);
}

/* ============================================= */
/* SPECIFICATIONS */
/* ============================================= */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.75rem;
}

.spec-item {
    background: linear-gradient(135deg, var(--light) 0%, #FFFFFF 100%);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.spec-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-dark));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.spec-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(245, 158, 11, 0.2);
    border-color: var(--primary);
}

.spec-item:hover::before {
    transform: scaleX(1);
}

.spec-item i {
    font-size: 1.5rem;
    color: var(--primary);
    margin-bottom: 0.5rem;
    transition: transform 0.3s ease;
}

.spec-item:hover i {
    transform: scale(1.2);
}

.spec-label {
    font-size: 0.75rem;
    color: var(--gray);
    margin-bottom: 0.25rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.spec-value {
    font-weight: 700;
    font-size: 0.9375rem;
    color: var(--dark);
}

/* ============================================= */
/* FEATURES */
/* ============================================= */
.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-top: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 0.875rem;
    color: var(--dark);
    padding: 0.75rem;
    background: var(--light);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: var(--primary-light);
    transform: translateX(4px);
}

.feature-item i {
    font-size: 1.125rem;
    color: var(--primary);
    background: white;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
}

/* ============================================= */
/* SECTION TITLE */
/* ============================================= */
.section-title {
    font-size: 1.125rem;
    font-weight: 700;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.625rem;
    color: var(--dark);
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border);
}

.section-title i {
    color: var(--primary);
    font-size: 1rem;
    background: var(--primary-light);
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

/* ============================================= */
/* CALENDAR */
/* ============================================= */
.date-picker {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.date-field label {
    display: block;
    font-size: 0.8125rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--dark);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.date-field input {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid var(--border);
    border-radius: 10px;
    font-family: inherit;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background: var(--light);
}

.date-field input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    background: white;
}

.calendar-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background: var(--light);
    border-radius: 10px;
}

.calendar-nav h4 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--dark);
}

.calendar-nav button {
    width: 36px;
    height: 36px;
    border: none;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.875rem;
    color: var(--dark);
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.calendar-nav button:hover {
    background: var(--primary);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 0.375rem;
    margin-bottom: 1rem;
}

.calendar-day-header {
    text-align: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--gray);
    padding: 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.calendar-day {
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.calendar-day.available {
    background: var(--light);
    border: 2px solid transparent;
}

.calendar-day.available:hover {
    background: var(--primary);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
}

.calendar-day.booked {
    background: linear-gradient(135deg, #FEE2E2, #FCA5A5);
    color: #DC2626;
    cursor: pointer;
    position: relative;
    font-weight: 700;
    border: 2px solid #FCA5A5;
}

.calendar-day.booked:hover {
    background: linear-gradient(135deg, #FCA5A5, #F87171);
    transform: scale(1.05);
}

.calendar-day.selected-start,
.calendar-day.selected-end {
    background: linear-gradient(135deg, var(--success), #059669);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    transform: scale(1.1);
}

.calendar-day.selected-range {
    background: var(--success-light);
    color: #065F46;
    border: 2px solid var(--success);
}

.calendar-day.today {
    border: 2px solid #3B82F6;
    font-weight: 700;
    position: relative;
}

.calendar-day.today::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 4px;
    background: #3B82F6;
    border-radius: 50%;
}

.calendar-day.past {
    background: transparent;
    color: #D1D5DB;
    cursor: not-allowed;
    opacity: 0.4;
}

/* ============================================= */
/* TOOLTIP */
/* ============================================= */
.booking-tooltip {
    position: fixed;
    background: linear-gradient(135deg, rgba(17, 24, 39, 0.98), rgba(31, 41, 55, 0.98));
    color: white;
    padding: 1rem;
    border-radius: 12px;
    font-size: 0.8125rem;
    z-index: 1000;
    min-width: 200px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s ease;
    border: 1px solid rgba(255,255,255,0.1);
}

.booking-tooltip.show {
    opacity: 1;
}

.booking-tooltip-header {
    font-weight: 700;
    margin-bottom: 0.625rem;
    padding-bottom: 0.625rem;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    color: var(--primary);
    font-size: 0.75rem;
}

.booking-tooltip-row {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.375rem;
    font-size: 0.75rem;
}

.booking-tooltip-label {
    color: rgba(255,255,255,0.7);
    min-width: 60px;
    font-weight: 600;
}

.booking-tooltip-value {
    font-weight: 600;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.6875rem;
    font-weight: 700;
}

.status-confirmed {
    background: linear-gradient(135deg, #DBEAFE, #BFDBFE);
    color: #1E40AF;
}

.status-active {
    background: linear-gradient(135deg, var(--success-light), #A7F3D0);
    color: #065F46;
}

/* ============================================= */
/* CALENDAR LEGEND */
/* ============================================= */
.calendar-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    padding-top: 1rem;
    border-top: 2px solid var(--border);
    font-size: 0.8125rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
}

.legend-dot {
    width: 16px;
    height: 16px;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* ============================================= */
/* PRICE ESTIMATE */
/* ============================================= */
.price-estimate {
    background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
    border: 2px solid var(--success);
    border-radius: 12px;
    padding: 1.25rem;
    margin-top: 1rem;
    display: none;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
}

.price-estimate.show {
    display: block;
    animation: slideInUp 0.4s ease;
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.price-estimate-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 0.9375rem;
    font-weight: 700;
    color: #065F46;
}

.price-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    color: #047857;
}

.price-row.total {
    border-top: 2px solid var(--success);
    padding-top: 0.75rem;
    margin-top: 0.75rem;
    font-weight: 800;
    font-size: 1.125rem;
    color: #065F46;
}

/* ============================================= */
/* PRICE CARD (Sticky Dark Theme) */
/* ============================================= */
.price-card {
    background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
    color: white;
    border-radius: 16px;
    padding: 1.5rem;
    position: sticky;
    top: 1rem;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.1);
}

.price-card h3 {
    margin-bottom: 1.25rem;
    font-size: 1.25rem;
    font-weight: 800;
    background: linear-gradient(90deg, white, rgba(255,255,255,0.8));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.price-option {
    background: rgba(255,255,255,0.08);
    border: 2px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
}

.price-option:hover {
    background: rgba(255,255,255,0.12);
    border-color: rgba(245, 158, 11, 0.5);
    transform: translateX(4px);
}

.price-option-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.375rem;
}

.price-option-label {
    font-size: 0.875rem;
    color: rgba(255,255,255,0.7);
    font-weight: 600;
}

.price-option-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--primary);
    text-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
}

.price-option.featured {
    background: rgba(245, 158, 11, 0.15);
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
}

.price-info {
    font-size: 0.8125rem;
    color: rgba(255,255,255,0.6);
    margin: 1rem 0;
    padding: 1rem 0;
    border-top: 1px solid rgba(255,255,255,0.1);
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.price-features {
    margin: 1rem 0;
}

.price-feature {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    color: rgba(255,255,255,0.85);
    transition: all 0.3s ease;
}

.price-feature:hover {
    color: white;
    transform: translateX(4px);
}

.price-feature i {
    color: var(--success);
    font-size: 0.875rem;
    background: rgba(16, 185, 129, 0.2);
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
}

/* ============================================= */
/* INLINE CHECK AVAILABILITY (Inside Price Card) */
/* ============================================= */
.price-card .inline-check-availability {
    background: transparent;
    border: none;
    padding: 0;
    box-shadow: none;
    display: block;
    visibility: visible;
    margin-top: 1.5rem;
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 1.5rem;
}

.price-card .inline-check-availability .section-title {
    color: rgba(255,255,255,0.95);
    padding-bottom: 0.75rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 1rem;
}

.price-card .inline-check-availability .date-picker {
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
}

.price-card .inline-check-availability .date-field label {
    color: rgba(255,255,255,0.75);
    font-size: 0.75rem;
}

.price-card .inline-check-availability .date-field input {
    background: rgba(255,255,255,0.06);
    color: white;
    border: 1px solid rgba(255,255,255,0.12);
    font-size: 0.8125rem;
    padding: 0.625rem;
}

.price-card .inline-check-availability .date-field input:focus {
    background: rgba(255,255,255,0.1);
    border-color: var(--primary);
}

.price-card .inline-check-availability .calendar-nav {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
}

.price-card .inline-check-availability .calendar-nav h4 {
    color: white;
    font-size: 0.9375rem;
}

.price-card .inline-check-availability .calendar-nav button {
    background: rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.8);
    width: 32px;
    height: 32px;
}

.price-card .inline-check-availability .calendar-nav button:hover {
    background: var(--primary);
    color: white;
}

.price-card .inline-check-availability .calendar-day-header {
    color: rgba(255,255,255,0.5);
}

.price-card .inline-check-availability .calendar-day {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.8);
}

.price-card .inline-check-availability .calendar-day.available {
    background: rgba(255,255,255,0.06);
    border-color: rgba(255,255,255,0.12);
}

.price-card .inline-check-availability .calendar-day.available:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.price-card .inline-check-availability .calendar-day.booked {
    background: rgba(239,68,68,0.2);
    color: #f87171;
    border-color: rgba(239,68,68,0.3);
}

.price-card .inline-check-availability .calendar-day.selected-start,
.price-card .inline-check-availability .calendar-day.selected-end {
    background: linear-gradient(135deg, var(--success), #059669);
    color: white;
    border-color: var(--success);
}

.price-card .inline-check-availability .calendar-day.selected-range {
    background: rgba(16,185,129,0.25);
    color: #6ee7b7;
    border-color: rgba(16,185,129,0.4);
}

.price-card .inline-check-availability .calendar-day.today {
    border-color: #60a5fa;
}

.price-card .inline-check-availability .calendar-day.past {
    color: rgba(255,255,255,0.2);
    background: transparent;
}

.price-card .inline-check-availability .calendar-legend {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 0.75rem;
    margin-top: 0.75rem;
}

.price-card .inline-check-availability .legend-item {
    color: rgba(255,255,255,0.75);
    font-size: 0.75rem;
}

.price-card .inline-check-availability .btn-primary {
    width: 100%;
}

/* ============================================= */
/* BUTTONS */
/* ============================================= */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.875rem 1.25rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    width: 100%;
    position: relative;
    overflow: hidden;
    font-family: inherit;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn:hover::before {
    width: 300px;
    height: 300px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
}

.btn-secondary {
    background: transparent;
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
}

.btn-secondary:hover {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.5);
}

.btn-success {
    background: linear-gradient(135deg, var(--success), #059669);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn.btn-locked {
    background: rgba(255,255,255,0.08) !important;
    color: rgba(255,255,255,0.35) !important;
    box-shadow: none !important;
    cursor: pointer;
    border: 1.5px dashed rgba(255,255,255,0.2) !important;
    transform: none !important;
}

.btn.btn-locked:hover {
    transform: none !important;
    box-shadow: none !important;
}

.btn.btn-locked::before {
    display: none;
}

.btn i {
    position: relative;
    z-index: 1;
}

.btn span {
    position: relative;
    z-index: 1;
}

/* ============================================= */
/* POPUP MODAL */
/* ============================================= */
.popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(4px);
    z-index: 2000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.popup-overlay.show {
    opacity: 1;
    pointer-events: auto;
}

.popup-modal {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    max-width: 380px;
    width: 90%;
    text-align: center;
    transform: scale(0.88);
    transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
    box-shadow: 0 24px 60px rgba(0,0,0,0.25);
    position: relative;
}

.popup-overlay.show .popup-modal {
    transform: scale(1);
}

.popup-modal-icon {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, #FEF3C7, #FDE68A);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    box-shadow: 0 6px 16px rgba(245, 158, 11, 0.25);
}

.popup-modal-icon i {
    font-size: 1.75rem;
    color: var(--primary-dark);
}

.popup-modal h4 {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 0.5rem;
}

.popup-modal p {
    font-size: 0.875rem;
    color: var(--gray);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.popup-modal .btn-popup-close {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    border-radius: 10px;
    padding: 0.7rem 1.75rem;
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(245,158,11,0.3);
}

.popup-modal .btn-popup-close:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(245,158,11,0.4);
}

.popup-x {
    position: absolute;
    top: 0.75rem;
    right: 0.875rem;
    background: none;
    border: none;
    font-size: 1.1rem;
    color: var(--gray);
    cursor: pointer;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.2s;
}

.popup-x:hover {
    background: #f3f4f6;
    color: var(--dark);
}

/* ============================================= */
/* RELATED CARS */
/* ============================================= */
.related-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-top: 1.5rem;
}

@media (min-width: 768px) {
    .related-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.related-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.related-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    border-color: var(--primary);
}

.related-image {
    height: 160px;
    overflow: hidden;
    position: relative;
}

.related-image::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.related-card:hover .related-image::after {
    opacity: 1;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.related-card:hover .related-image img {
    transform: scale(1.1);
}

.related-content {
    padding: 1rem;
}

.related-brand {
    font-weight: 700;
    font-size: 0.9375rem;
    margin-bottom: 0.25rem;
    color: var(--dark);
}

.related-name {
    color: var(--primary);
    font-size: 0.875rem;
    margin-bottom: 0.75rem;
    font-weight: 600;
}

.related-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
    font-size: 0.875rem;
}

.related-price-label {
    color: var(--gray);
    font-size: 0.8125rem;
    font-weight: 500;
}

.related-price-value {
    font-weight: 800;
    color: var(--dark);
    font-size: 1rem;
}

/* ============================================= */
/* SPINNER */
/* ============================================= */
.spinner {
    border: 3px solid var(--border);
    border-top-color: var(--primary);
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* ============================================= */
/* DIVIDER */
/* ============================================= */
.divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border), transparent);
    margin: 1rem 0;
}

/* ============================================= */
/* RESPONSIVE */
/* ============================================= */
@media (max-width: 768px) {
    .gallery-main {
        height: 300px;
    }

    .car-title h1 {
        font-size: 1.5rem;
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

    .related-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- POPUP MODAL -->
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-modal">
        <button class="popup-x" id="popupClose">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="popup-modal-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
        <h4>Pilih Tanggal Terlebih Dahulu</h4>
        <p>Silakan pilih tanggal <strong>mulai</strong> dan <strong>selesai</strong> untuk melihat ketersediaan dan melanjutkan pemesanan.</p>
        <button class="btn-popup-close" id="popupCloseBtn">
            <i class="fa-solid fa-check"></i> Oke, Mengerti
        </button>
    </div>
</div>

<div class="container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('cars.index') }}">
            <i class="fa-solid fa-home"></i> Home
        </a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ route('cars.index') }}">Cars</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span style="color: var(--dark); font-weight: 700;">{{ $car->name }}</span>
    </div>

    <div class="main-grid">
        {{-- Left Column --}}
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">

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
                        <span class="badge badge-available">
                            <i class="fa-solid fa-check"></i> Available
                        </span>
                        @endif
                        <span class="badge badge-premium">
                            <i class="fa-solid fa-crown"></i> Premium
                        </span>
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
                <div style="padding: 1rem;">
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

            {{-- Specifications --}}
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

            {{-- Related Cars --}}
            @if($relatedCars->count() > 0)
            <div style="margin-top: 1.5rem;">
                <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--dark);">
                    Rekomendasi Mobil
                </h2>

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

                            <a href="{{ route('cars.show', $relatedCar) }}" class="btn btn-primary" style="padding: 0.625rem 1rem; font-size: 0.8125rem;">
                                View Details
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
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

                {{-- Check Availability --}}
                <div class="inline-check-availability">
                    <div class="section-title">
                        <i class="fa-solid fa-calendar-check"></i> Check Availability
                    </div>

                    {{-- Date Inputs --}}
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

                    {{-- Calendar --}}
                    <div style="margin-top: 1rem;">
                        <div class="calendar-nav">
                            <button id="prevMonth"><i class="fa-solid fa-chevron-left"></i></button>
                            <h4 id="currentMonth"></h4>
                            <button id="nextMonth"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>

                        <div class="calendar-grid" id="calendarGrid"></div>

                        <div class="calendar-legend">
                            <div class="legend-item">
                                <div class="legend-dot" style="background: rgba(255,255,255,0.06);"></div>
                                <span>Available</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background: rgba(239,68,68,0.2);"></div>
                                <span>Booked</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background: rgba(16,185,129,0.25);"></div>
                                <span>Selected</span>
                            </div>
                        </div>

                        <button style="margin-top: 1rem;" type="button" id="checkAvailability" class="btn btn-primary">
                            <i class="fa-solid fa-search"></i> Check Availability
                        </button>
                    </div>

                    {{-- Price Estimate --}}
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
                </div>

                <a href="https://wa.me/6281234567890?text=Hi, I'm interested in {{ $car->brand }} {{ $car->name }}" class="btn btn-secondary" style="margin-top: 1rem;">
                    <i class="fa-brands fa-whatsapp"></i> Contact Us
                </a>

                <div class="price-info">
                    <i class="fa-solid fa-info-circle"></i> Minimum 30% deposit required
                </div>

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
</div>

{{-- Booking Tooltip --}}
<div class="booking-tooltip" id="bookingTooltip"></div>

<script>
// ============================================================
// SHARED STATE
// ============================================================
const carId        = {{ $car->id }};
const csrfToken    = document.querySelector('meta[name="csrf-token"]').content;
const bookingRoute = "{{ route('bookings.create', ['car' => $car->id]) }}";

const bookedDates = @json($car->bookings->map(function($booking) {
    $dates = [];
    $start = \Carbon\Carbon::parse($booking->start_datetime);
    $end   = \Carbon\Carbon::parse($booking->end_datetime);
    while($start <= $end) {
        $dates[] = $start->format('Y-m-d');
        $start->addDay();
    }
    return $dates;
})->flatten()->unique()->values());

let bookingDetailsMap = {};
let selectedStartDate = null;
let selectedEndDate   = null;

// ============================================================
// UTILITY FUNCTIONS
// ============================================================
const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

function formatDisplay(dateStr) {
    const [y, m, d] = dateStr.split('-');
    return `${parseInt(d)} ${monthNames[parseInt(m)-1].slice(0,3)} ${y}`;
}

function pad2(n) {
    return String(n).padStart(2,'0');
}

// ============================================================
// SYNC SELECTION
// ============================================================
function syncSelection() {
    document.getElementById('startDate').value = selectedStartDate || '';
    document.getElementById('endDate').value   = selectedEndDate  || '';
    renderCalendar();
}

// ============================================================
// SELECT DATE
// ============================================================
function selectDate(dateStr) {
    if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
        selectedStartDate = dateStr;
        selectedEndDate   = null;
    } else {
        if (dateStr > selectedStartDate) {
            selectedEndDate = dateStr;
        } else if (dateStr < selectedStartDate) {
            selectedEndDate   = selectedStartDate;
            selectedStartDate = dateStr;
        } else {
            selectedStartDate = null;
            selectedEndDate   = null;
        }
    }
    syncSelection();
}

// ============================================================
// CALENDAR RENDERING
// ============================================================
let mainCalDate = new Date();

async function loadBookingDetails(year, month) {
    try {
        const response = await fetch(`/api/cars/${carId}/booked-dates?year=${year}&month=${month}`);
        const data = await response.json();
        if (data.booking_details) {
            bookingDetailsMap = data.booking_details;
        }
    } catch(error) {
        console.error('Error loading booking details:', error);
    }
}

function renderCalendar() {
    const year  = mainCalDate.getFullYear();
    const month = mainCalDate.getMonth();

    document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;

    loadBookingDetails(year, month + 1);

    const firstDay     = new Date(year, month, 1).getDay();
    const daysInMonth  = new Date(year, month + 1, 0).getDate();
    const today        = new Date();
    today.setHours(0,0,0,0);

    let html = '';

    // Day headers
    ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].forEach(day => {
        html += `<div class="calendar-day-header">${day}</div>`;
    });

    // Empty cells before first day
    for (let i = 0; i < firstDay; i++) {
        html += '<div class="calendar-day"></div>';
    }

    // Calendar days
    for (let day = 1; day <= daysInMonth; day++) {
        const dateObj = new Date(year, month, day);
        const dateStr = `${year}-${pad2(month+1)}-${pad2(day)}`;

        const isBooked   = bookedDates.includes(dateStr);
        const isToday    = today.getTime() === dateObj.getTime();
        const isPast     = dateObj < today;
        const isSStart   = selectedStartDate === dateStr;
        const isSEnd     = selectedEndDate   === dateStr;
        const isInRange  = selectedStartDate && selectedEndDate &&
                           dateStr > selectedStartDate && dateStr < selectedEndDate;

        let classes = 'calendar-day';
        if (isPast)       classes += ' past';
        else if (isBooked) classes += ' booked';
        else               classes += ' available';
        if (isToday)   classes += ' today';
        if (isSStart)  classes += ' selected-start';
        if (isSEnd)    classes += ' selected-end';
        if (isInRange) classes += ' selected-range';

        const onclick     = (!isPast && !isBooked) ? `onclick="selectDate('${dateStr}')"` : '';
        const onmouseover = isBooked ? `onmouseover="showBookingTooltip('${dateStr}', this)"` : '';
        const onmouseout  = isBooked ? `onmouseout="hideBookingTooltip()"` : '';

        html += `<div class="${classes}" ${onclick} ${onmouseover} ${onmouseout}>${day}</div>`;
    }

    document.getElementById('calendarGrid').innerHTML = html;
}

// ============================================================
// CALENDAR NAVIGATION
// ============================================================
document.getElementById('prevMonth').addEventListener('click', () => {
    mainCalDate.setMonth(mainCalDate.getMonth() - 1);
    renderCalendar();
});

document.getElementById('nextMonth').addEventListener('click', () => {
    mainCalDate.setMonth(mainCalDate.getMonth() + 1);
    renderCalendar();
});

// ============================================================
// DATE INPUT HANDLERS
// ============================================================
document.getElementById('startDate').addEventListener('change', function() {
    selectedStartDate = this.value || null;
    syncSelection();
});

document.getElementById('endDate').addEventListener('change', function() {
    selectedEndDate = this.value || null;
    syncSelection();
});

// ============================================================
// POPUP HANDLERS
// ============================================================
function closePopup() {
    document.getElementById('popupOverlay').classList.remove('show');
}

document.getElementById('popupClose').addEventListener('click', closePopup);
document.getElementById('popupCloseBtn').addEventListener('click', closePopup);
document.getElementById('popupOverlay').addEventListener('click', function(e) {
    if (e.target === this) closePopup();
});

// ============================================================
// BOOKING TOOLTIP
// ============================================================
const tooltip = document.getElementById('bookingTooltip');

function showBookingTooltip(dateStr, element) {
    const booking = bookingDetailsMap[dateStr];
    if (!booking) return;

    const statusLabel = booking.status === 'confirmed' ? 'Confirmed' : 'Active';
    const statusClass = booking.status === 'confirmed' ? 'status-confirmed' : 'status-active';

    tooltip.innerHTML = `
        <div class="booking-tooltip-header">${booking.booking_code}</div>
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
            <span class="booking-tooltip-value">${booking.start} – ${booking.end}</span>
        </div>
    `;

    const rect = element.getBoundingClientRect();
    tooltip.style.left      = rect.left + (rect.width / 2) + 'px';
    tooltip.style.top       = (rect.top + window.scrollY - 10) + 'px';
    tooltip.style.transform = 'translate(-50%, -100%)';
    tooltip.classList.add('show');
}

function hideBookingTooltip() {
    tooltip.classList.remove('show');
}

// ============================================================
// CHECK AVAILABILITY
// ============================================================
document.getElementById('checkAvailability').addEventListener('click', async function() {
    const startDate = document.getElementById('startDate').value;
    const endDate   = document.getElementById('endDate').value;

    if (!startDate || !endDate) {
        alert('Please select start and end dates');
        return;
    }

    const button       = this;
    const originalText = button.innerHTML;
    button.disabled    = true;
    button.innerHTML   = '<span class="spinner"></span> Checking...';

    try {
        // Check availability
        const availResponse = await fetch(`/api/cars/${carId}/check-availability`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                start_date: startDate,
                end_date: endDate
            })
        });
        const availData = await availResponse.json();

        if (!availData.available) {
            alert(availData.message);
            button.disabled = false;
            button.innerHTML = originalText;
            return;
        }

        // Get price estimate
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

        // Update price display
        document.getElementById('rentalDuration').textContent = `${priceData.days} days`;
        document.getElementById('basePrice').textContent      = `Rp ${priceData.base_price.toLocaleString('id-ID')}`;
        document.getElementById('serviceCharge').textContent  = `Rp ${priceData.service_charge.toLocaleString('id-ID')}`;
        document.getElementById('totalPrice').textContent     = `Rp ${priceData.total_price.toLocaleString('id-ID')}`;
        document.getElementById('minDeposit').textContent     = `Rp ${priceData.min_deposit.toLocaleString('id-ID')}`;

        // Update Book Now button URL
        if (startDate && endDate) {
            const bookingUrl = new URL(document.getElementById('bookNowBtn').href);
            bookingUrl.searchParams.set('start', startDate);
            bookingUrl.searchParams.set('end', endDate);
            document.getElementById('bookNowBtn').href = bookingUrl.toString();
        }

        // Show price estimate box
        document.getElementById('priceEstimateBox').classList.add('show');
        document.getElementById('priceEstimateBox').scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
        });

    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    } finally {
        button.disabled  = false;
        button.innerHTML = originalText;
    }
});

// ============================================================
// GALLERY IMAGE CHANGER
// ============================================================
function changeMainImage(src, thumb) {
    document.querySelector('#mainImage img').src = src;
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}

// ============================================================
// INITIALIZATION
// ============================================================
renderCalendar();
</script>

{{-- Car Reviews Section --}}
@if(isset($carReviews) && $carReviews->count() > 0)
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold">Ulasan untuk {{ $car->brand }} {{ $car->name }}</h3>
            <a href="{{ route('reviews.create') }}" class="text-yellow-600 font-semibold hover:underline">
                Tambah Ulasan
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($carReviews as $review)
            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
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
                    <div class="text-sm font-bold text-yellow-600">{{ $review->rating }}/5</div>
                </div>

                <p class="text-sm text-slate-600 mb-2">{{ $review->comment ?? 'Pelanggan puas.' }}</p>
                <div class="text-xs text-slate-500">
                    Mobil: {{ $review->booking->car->brand ?? '' }} {{ $review->booking->car->name ?? '' }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

</x-app-layout>
