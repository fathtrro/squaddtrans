<x-app-layout>
<style>
    :root {
        --primary: #d97706;
        --primary-light: #f59e0b;
        --dark: #1f2937;
        --dark-light: #374151;
        --light: #f8fafc;
        --border: #e5e7eb;
        --success: #10b981;
        --danger: #ef4444;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light);
        color: var(--dark);
    }

    .detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    }

    /* Header with back button */
    .detail-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: var(--light);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        color: var(--dark);
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background-color: var(--primary-light);
        color: white;
        transform: translateX(-2px);
    }

    .header-info h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .header-info p {
        color: #6b7280;
        font-size: 14px;
    }

    /* Main grid layout */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        margin-bottom: 32px;
    }

    /* Image carousel */
    .image-section {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .main-image {
        position: relative;
        width: 100%;
        height: 400px;
        border-radius: 16px;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .main-image:hover img {
        transform: scale(1.05);
    }

    .image-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(16, 185, 129, 0.95);
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
    }

    .image-badge.unavailable {
        background: rgba(239, 68, 68, 0.95);
    }

    .thumb-gallery {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }

    .thumb {
        width: 100%;
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumb.active {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
    }

    .thumb:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }

    /* Info section */
    .info-section {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Price card */
    .price-card {
        background: linear-gradient(135deg, var(--primary) 0%, #dc2626 100%);
        color: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(217, 119, 6, 0.3);
    }

    .price-label {
        font-size: 13px;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .price-main {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .price-breakdown {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        opacity: 0.9;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    .price-duration {
        display: flex;
        gap: 4px;
    }

    /* Specs grid */
    .specs-card {
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
        background-color: #fafafa;
    }

    .specs-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        color: var(--dark);
    }

    .specs-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .spec-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .spec-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .spec-content {
        display: flex;
        flex-direction: column;
    }

    .spec-label {
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .spec-value {
        font-size: 15px;
        font-weight: 600;
        color: var(--dark);
    }

    /* Reviews section */
    .reviews-section {
        padding: 24px;
        background-color: #fafafa;
        border-radius: 14px;
        border: 1px solid var(--border);
    }

    .reviews-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .review-rating-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        color: white;
        border-radius: 12px;
        font-size: 20px;
        font-weight: 700;
    }

    .reviews-info h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .reviews-info p {
        font-size: 13px;
        color: #6b7280;
    }

    .review-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .review-item {
        background: white;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .reviewer-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--dark);
    }

    .review-rating {
        display: flex;
        gap: 4px;
    }

    .star {
        color: var(--primary-light);
        font-size: 14px;
    }

    .review-comment {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.6;
    }

    .review-date {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 8px;
    }

    .no-reviews {
        text-align: center;
        padding: 32px 16px;
        color: #9ca3af;
    }

    .no-reviews i {
        display: block;
        font-size: 32px;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    /* Action buttons */
    .action-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 32px;
        padding-top: 32px;
        border-top: 1px solid var(--border);
    }

    .btn {
        padding: 14px 24px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-secondary {
        background-color: var(--light);
        color: var(--dark);
        border: 1px solid var(--border);
    }

    .btn-secondary:hover {
        background-color: #f3f4f6;
        transform: translateY(-2px);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(217, 119, 6, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(217, 119, 6, 0.4);
    }

    .btn-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .detail-header h1 {
            font-size: 22px;
        }

        .price-main {
            font-size: 24px;
        }

        .main-image {
            height: 300px;
        }

        .specs-grid {
            grid-template-columns: 1fr;
        }

        .action-section {
            grid-template-columns: 1fr;
        }

        .thumb-gallery {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 480px) {
        .detail-container {
            padding: 16px;
            border-radius: 16px;
        }

        .detail-header {
            margin-bottom: 20px;
        }

        .main-image {
            height: 250px;
        }

        .header-info h1 {
            font-size: 20px;
        }

        .price-main {
            font-size: 20px;
        }

        .thumb-gallery {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <div class="header-info">
            <h1>{{ $car->brand }} {{ $car->name }}</h1>
            <p>{{ $car->year }} • {{ $car->category }}</p>
        </div>
    </div>

    <!-- Main content grid -->
    <div class="detail-grid">
        <!-- Left: Images -->
        <div class="image-section">
            <div class="main-image" id="mainImageContainer">
                @if($car->images->count() > 0)
                    <img id="mainImage" src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="{{ $car->brand }} {{ $car->name }}">
                @else
                    <div style="color: white; text-align: center;">
                        <i class="fa-solid fa-car" style="font-size: 64px; opacity: 0.3;"></i>
                    </div>
                @endif
                <div class="image-badge {{ !$isAvailable ? 'unavailable' : '' }}">
                    {{ $isAvailable ? 'Tersedia' : 'Dipesan' }}
                </div>
            </div>

            @if($car->images->count() > 1)
            <div class="thumb-gallery">
                @foreach($car->images as $index => $image)
                <div class="thumb {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Thumb {{ $index + 1 }}">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Right: Info -->
        <div class="info-section">
            <!-- Price Card -->
            <div class="price-card">
                <div class="price-label">Total Rental</div>
                <div class="price-main" id="totalPrice">
                    Rp {{ number_format($dailyPrice * $duration, 0, ',', '.') }}
                </div>
                <div class="price-breakdown">
                    <span>
                        <span class="price-duration">
                            <span id="durationDays">{{ $duration }}</span>
                            <span>hari</span>
                        </span>
                    </span>
                    <span>@ Rp {{ number_format($dailyPrice, 0, ',', '.') }}/hari</span>
                </div>
            </div>

            <!-- Specs -->
            <div class="specs-card">
                <div class="specs-title">Spesifikasi Mobil</div>
                <div class="specs-grid">
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Kapasitas</div>
                            <div class="spec-value">{{ $car->seats }} Penumpang</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fa-solid fa-cogs"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Transmisi</div>
                            <div class="spec-value">{{ ucfirst($car->transmission) }}</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fa-solid fa-gas-pump"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Bahan Bakar</div>
                            <div class="spec-value">{{ ucfirst($car->fuel_type) }}</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fa-solid fa-number"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Plat Nomor</div>
                            <div class="spec-value">{{ $car->plate_number }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="reviews-section">
                <div class="reviews-header">
                    <div class="review-rating-badge">
                        {{ number_format($averageRating, 1) }}
                    </div>
                    <div class="reviews-info">
                        <h3>Rating & Review</h3>
                        <p>{{ $reviewCount }} ulasan</p>
                    </div>
                </div>

                @if($reviews->count() > 0)
                <div class="review-list" id="reviewList">
                    @foreach($reviews->take(3) as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-name">{{ $review->user->name ?? 'Anonymous' }}</div>
                            <div class="review-rating">
                                @for($i = 0; $i < $review->rating; $i++)
                                <span class="star">★</span>
                                @endfor
                                @for($i = $review->rating; $i < 5; $i++)
                                <span class="star" style="opacity: 0.3;">★</span>
                                @endfor
                            </div>
                        </div>
                        <div class="review-comment">{{ $review->comment }}</div>
                        <div class="review-date">{{ $review->created_at->format('d M Y') }}</div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="no-reviews">
                    <i class="fa-solid fa-star"></i>
                    <p>Belum ada ulasan untuk mobil ini</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action buttons -->
    <div class="action-section">
        <button class="btn btn-secondary" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </button>
        <form id="proceedForm" method="GET" action="{{ route('bookings.create') }}" style="width: 100%;">
            <input type="hidden" name="car" value="{{ $car->id }}">
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="btn btn-primary" {{ !$isAvailable ? 'disabled' : '' }} style="width: 100%;">
                <i class="fa-solid fa-check"></i> Lanjut ke Pemesanan
            </button>
        </form>
    </div>
</div>

<script>
    function changeMainImage(imageSrc, element) {
        document.getElementById('mainImage').src = imageSrc;
        document.querySelectorAll('.thumb').forEach(thumb => thumb.classList.remove('active'));
        element.classList.add('active');
    }
</script>
</x-app-layout>
