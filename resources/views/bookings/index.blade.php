<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap');

    .booking-page * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .mono { font-family: 'DM Mono', monospace; }

    /* Background */
    .page-bg {
        background: #fafaf9;
        min-height: 100vh;
    }

    /* Header Stats */
    .stat-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        transition: all 0.2s ease;
    }
    .stat-card:hover {
        border-color: #f59e0b;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1);
    }

    /* Filter Section */
    .filter-container {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 16px;
    }

    /* Booking Cards */
    .booking-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.2s ease;
    }
    .booking-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-color: #d1d5db;
    }

    /* Status Indicators */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    /* Status Colors */
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-pending .status-dot { background: #f59e0b; }

    .status-confirmed { background: #dbeafe; color: #1e40af; }
    .status-confirmed .status-dot { background: #3b82f6; }

    .status-completed { background: #d1fae5; color: #065f46; }
    .status-completed .status-dot { background: #10b981; }

    .status-cancelled { background: #fee2e2; color: #991b1b; }
    .status-cancelled .status-dot { background: #ef4444; }

    /* Buttons */
    .btn-primary {
        background: #111827;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-primary:hover { background: #374151; }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
        padding: 8px;
        border-radius: 8px;
        transition: all 0.2s;
    }
    .btn-secondary:hover { background: #e5e7eb; }

    /* Price Tag */
    .price-tag {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
    }

    /* Mobile Specific Styles */
    @media (max-width: 768px) {
        .desktop-only { display: none !important; }
        .mobile-only { display: block !important; }

        .mobile-card {
            padding: 16px;
        }

        .mobile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .mobile-vehicle {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .mobile-meta {
            font-size: 12px;
            color: #6b7280;
        }

        .mobile-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            padding: 12px 0;
            border-top: 1px solid #f3f4f6;
            border-bottom: 1px solid #f3f4f6;
            margin-bottom: 12px;
        }

        .mobile-detail-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .mobile-label {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 500;
        }

        .mobile-value {
            font-size: 13px;
            color: #374151;
            font-weight: 600;
        }

        .mobile-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mobile-price {
            font-size: 16px;
            font-weight: 800;
            color: #111827;
        }

        .mobile-actions {
            display: flex;
            gap: 8px;
        }
    }

    @media (min-width: 769px) {
        .mobile-only { display: none !important; }
        .desktop-only { display: block !important; }

        .desktop-row {
            display: grid;
            grid-template-columns: 60px 2fr 1.5fr 1fr 1.5fr auto;
            gap: 20px;
            align-items: center;
            padding: 20px 24px;
        }

        .desktop-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-bg-pending { background: #fef3c7; }
        .icon-bg-confirmed { background: #dbeafe; }
        .icon-bg-completed { background: #d1fae5; }
        .icon-bg-cancelled { background: #fee2e2; }
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: #fef3c7;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }

    /* Pagination */
    .pagination-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .pagination-active {
        background: #111827;
        color: white;
    }

    .pagination-inactive {
        background: white;
        border: 1px solid #e5e7eb;
        color: #374151;
    }
    .pagination-inactive:hover {
        border-color: #111827;
    }
</style>

<div class="booking-page page-bg py-8 pt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <p class="text-xs font-bold tracking-wider text-amber-600 uppercase mb-1">Akun Saya</p>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Riwayat Booking</h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola dan lacak semua transaksi penyewaan kendaraan Anda.</p>
                </div>

                <!-- Stats -->
                <div class="flex gap-3">
                    <div class="stat-card flex-1 md:w-40">
                        <p class="text-xs text-gray-500 mb-1">Total Booking</p>
                        <p class="text-xl font-bold text-gray-900">
                            {{ isset($allBookings) ? $allBookings->count() : $bookings->total() }}
                        </p>
                    </div>
                    <div class="stat-card flex-1 md:w-40">
                        <p class="text-xs text-gray-500 mb-1">Loyalty Points</p>
                        <p class="text-xl font-bold text-amber-600">
                            {{ number_format(
                                isset($allBookings)
                                    ? $allBookings->where('status', 'completed')->count() * 50
                                    : $bookings->where('status', 'completed')->count() * 50,
                                0, ',', '.'
                            ) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-container">
                <form method="GET" action="{{ route('bookings.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <select name="status" class="flex-1 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-amber-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>

                    <input type="date" name="date_filter" value="{{ request('date_filter') }}"
                           class="flex-1 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-amber-500">

                    <button type="submit" class="px-6 py-2.5 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        <!-- Booking List -->
        @if ($bookings->count())
        <div class="space-y-3">
            @foreach ($bookings as $booking)
            @php
                $st = $booking->status;
                $totalPaid = $booking->payments->sum('amount');
                $dpPaid = $booking->payments->where('payment_type', 'dp')->sum('amount');
                $remaining = $booking->total_price - $totalPaid;
                $firstPayment = $booking->payments->first();
            @endphp

            <div class="booking-card">

                <!-- Desktop Layout -->
                <div class="desktop-only">
                    <div class="desktop-row">
                        <!-- Icon -->
                        <div class="desktop-icon icon-bg-{{ $st }}">
                            @if ($st == 'completed')
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            @elseif($st == 'pending')
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @elseif($st == 'cancelled')
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            @else
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @endif
                        </div>

                        <!-- Vehicle & Date -->
                        <div>
                            <p class="font-bold text-gray-900 mb-0.5">{{ $booking->car->name }}</p>
                            <p class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($booking->start_datetime)->format('d M Y') }} ·
                                <span class="mono">{{ $booking->booking_code }}</span>
                            </p>
                        </div>

                        <!-- Plate & Payment -->
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $booking->car->plate_number ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $firstPayment ? ($firstPayment->bankAccount?->bank_name ?? 'Transfer Bank') : '-' }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div>
                            <span class="status-badge status-{{ $st }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($st) }}
                            </span>
                        </div>

                        <!-- Price -->
                        <div>
                            <p class="price-tag">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            @if($st !== 'completed')
                                <p class="text-xs text-gray-500 mt-0.5">Sisa: Rp {{ number_format($remaining, 0, ',', '.') }}</p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('bookings.show', $booking) }}" class="btn-primary">Detail</a>
                            <a href="{{ route('bookings.download', $booking) }}" class="btn-secondary" title="Download">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Layout (Clean & Compact) -->
                <div class="mobile-only mobile-card">
                    <!-- Header: Vehicle + Status -->
                    <div class="mobile-header">
                        <div class="flex-1 min-w-0">
                            <p class="mobile-vehicle truncate">{{ $booking->car->name }}</p>
                            <p class="mobile-meta">{{ \Carbon\Carbon::parse($booking->start_datetime)->format('d M Y') }} · {{ $booking->booking_code }}</p>
                        </div>
                        <span class="status-badge status-{{ $st }} flex-shrink-0">
                            <span class="status-dot"></span>
                            {{ ucfirst($st) }}
                        </span>
                    </div>

                    <!-- Details Grid -->
                    <div class="mobile-details">
                        <div class="mobile-detail-item">
                            <span class="mobile-label">Plat Nomor</span>
                            <span class="mobile-value">{{ $booking->car->plate_number ?? 'N/A' }}</span>
                        </div>
                        <div class="mobile-detail-item">
                            <span class="mobile-label">Pembayaran</span>
                            <span class="mobile-value">
                                @if($st === 'completed')
                                    Lunas
                                @else
                                    DP Rp {{ number_format($dpPaid, 0, ',', '.') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Footer: Price + Actions -->
                    <div class="mobile-footer">
                        <div>
                            <p class="mobile-label">Total</p>
                            <p class="mobile-price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="mobile-actions">
                            <a href="{{ route('bookings.show', $booking) }}" class="btn-primary text-sm px-4">Detail</a>
                            <a href="{{ route('bookings.download', $booking) }}" class="btn-secondary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($bookings->hasPages())
        <div class="mt-8 flex items-center justify-center gap-2">
            @if ($bookings->onFirstPage())
                <span class="pagination-btn pagination-inactive opacity-50 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $bookings->previousPageUrl() }}" class="pagination-btn pagination-inactive">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                @if ($page == $bookings->currentPage())
                    <span class="pagination-btn pagination-active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="pagination-btn pagination-inactive">{{ $page }}</a>
                @endif
            @endforeach

            @if ($bookings->hasMorePages())
                <a href="{{ $bookings->nextPageUrl() }}" class="pagination-btn pagination-inactive">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="pagination-btn pagination-inactive opacity-50 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="booking-card empty-state">
            <div class="empty-icon">
                <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Transaksi</h3>
            <p class="text-sm text-gray-500 mb-6">Anda belum memiliki riwayat pembayaran.</p>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold text-sm hover:bg-gray-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Booking Sekarang
            </a>
        </div>
        @endif

    </div>
</div>
</x-app-layout>
