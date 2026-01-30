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

/* Breadcrumb - Enhanced */
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

/* Main Grid */
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

/* Card - Enhanced with shadow */
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

/* Gallery - Premium Look */
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
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
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
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
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

/* Specs - Modern Grid with Icons */
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

/* Features - Modern Icons */
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

/* Section - Enhanced */
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

/* Calendar - Premium Design */
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

/* Tooltip - Premium */
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

/* Legend - Modern */
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

/* Price Estimate - Premium Card */
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
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

/* Price Card - Sticky Premium */
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

/* Buttons - Modern & Attractive */
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

.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.btn i {
    position: relative;
    z-index: 1;
}

/* Reviews - Enhanced Cards */
.review-item {
    border-bottom: 1px solid var(--border);
    padding: 1rem 0;
    transition: all 0.3s ease;
}

.review-item:hover {
    background: var(--light);
    padding: 1rem;
    border-radius: 12px;
    margin: 0.5rem 0;
}

.review-item:last-child {
    border-bottom: none;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 0.75rem;
}

.review-user {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.review-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1rem;
    box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
}

.review-name {
    font-weight: 700;
    font-size: 0.9375rem;
    color: var(--dark);
}

.review-date {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 500;
}

.review-stars {
    color: #FCD34D;
    font-size: 0.875rem;
}

.review-comment {
    color: var(--gray);
    font-size: 0.875rem;
    line-height: 1.6;
}

/* Related Cars - Premium Cards */
.related-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-top: 1.5rem;
}

@media (min-width: 768px) {
    .related-grid {
        grid-template-columns: repeat(4, 1fr);
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
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
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

/* Responsive */
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

/* Utility */
.divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border), transparent);
    margin: 1rem 0;
}
</style>

<div class="container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('cars.index') }}"><i class="fa-solid fa-home"></i> Home</a>
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

                <a href="{{ route('bookings.create', ['car' => $car->id]) }}" class="btn btn-primary" style="margin-bottom: 0.75rem;">
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
    <div style="margin-top: 3rem;">
        <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--dark);">Similar Cars</h2>

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
