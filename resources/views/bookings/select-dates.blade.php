<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #F59E0B;
            --primary-light: #FCD34D;
            --primary-glow: rgba(245, 158, 11, 0.35);
            --dark: #1f2937;
            --darker: #111827;
            --border: #E5E7EB;
            --text-muted: #6B7280;
        }

        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Hero Section */
        .select-dates-hero {
            background: linear-gradient(135deg, #1f2937 0%, #0f172a 100%);
            padding: 3rem 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .select-dates-hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .select-dates-hero::after {
            content: '';
            position: absolute;
            bottom: -200px;
            left: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(100, 116, 139, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .select-dates-hero-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .select-dates-hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.2;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .select-dates-hero-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0;
            font-weight: 300;
        }

        @media (max-width: 768px) {
            .select-dates-hero {
                padding: 2rem 1rem;
            }
            .select-dates-hero-title {
                font-size: 1.8rem;
            }
            .select-dates-hero-subtitle {
                font-size: 1rem;
            }
        }

        /* Form Container */
        .select-dates-container {
            max-width: 900px;
            margin: -4rem auto 3rem;
            padding: 0 1.5rem;
            position: relative;
            z-index: 20;
        }

        .select-dates-form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .select-dates-form-header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 2rem;
            border-bottom: 2px solid #f3f4f6;
        }

        .select-dates-form-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--darker);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .select-dates-form-header i {
            color: var(--primary);
            font-size: 1.8rem;
        }

        .select-dates-form-body {
            padding: 2.5rem 2rem;
        }

        @media (max-width: 768px) {
            .select-dates-container {
                margin: -2rem auto 2rem;
                padding: 0 1rem;
            }
            .select-dates-form-header {
                padding: 1.5rem;
            }
            .select-dates-form-body {
                padding: 2rem 1.5rem;
            }
        }

        /* Form Fields */
        .select-dates-field {
            margin-bottom: 2rem;
        }

        .select-dates-field:last-child {
            margin-bottom: 0;
        }

        .select-dates-label {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.8rem;
        }

        .select-dates-label-icon {
            width: 32px;
            height: 32px;
            background: #FEF3C7;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 0.75rem;
        }

        .select-dates-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            font-family: inherit;
            color: var(--dark);
            background: #fafbfc;
            transition: all 0.3s;
            outline: none;
        }

        .select-dates-input:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        }

        .select-dates-input::placeholder {
            color: #cbd5e1;
        }

        /* Duration Info Box */
        .select-dates-duration {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            border: 2px solid var(--primary);
            border-radius: 14px;
            padding: 1.5rem;
            margin: 2rem 0 2rem 0;
            display: none;
            animation: slideDown 0.3s ease;
        }

        .select-dates-duration.show {
            display: block;
        }

        .select-dates-duration-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            font-size: 0.95rem;
        }

        .select-dates-duration-row + .select-dates-duration-row {
            border-top: 1px solid rgba(217, 119, 6, 0.2);
            padding-top: 0.8rem;
        }

        .select-dates-duration-label {
            color: #92400e;
            font-weight: 600;
        }

        .select-dates-duration-value {
            font-weight: 700;
            color: #78350f;
        }

        .select-dates-duration-row.highlight {
            border-top: 2px solid var(--primary) !important;
            margin-top: 0.5rem;
            padding-top: 1rem;
        }

        .select-dates-duration-row.highlight .select-dates-duration-label {
            font-size: 1rem;
            color: #78350f;
        }

        .select-dates-duration-row.highlight .select-dates-duration-value {
            font-size: 1.3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #d97706, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Buttons */
        .select-dates-button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .select-dates-btn {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            min-height: 48px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .select-dates-btn-primary {
            background: linear-gradient(135deg, var(--primary), #d97706);
            color: white;
            box-shadow: 0 4px 15px var(--primary-glow);
        }

        .select-dates-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px var(--primary-glow);
        }

        .select-dates-btn-primary:active {
            transform: translateY(0);
        }

        .select-dates-btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        .select-dates-btn-secondary {
            background: white;
            color: var(--dark);
            border: 2px solid var(--border);
            font-weight: 600;
        }

        .select-dates-btn-secondary:hover {
            background: #f9fafb;
            border-color: var(--dark);
        }

        /* Loading State */
        .select-dates-loading {
            display: none;
            text-align: center;
            padding: 2rem;
        }

        .select-dates-loading.show {
            display: block;
        }

        .select-dates-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Grid for dates */
        .select-dates-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 480px) {
            .select-dates-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="select-dates-hero">
        <div class="select-dates-hero-content">
            <h1 class="select-dates-hero-title">Mulai Petualangan Anda</h1>
            <p class="select-dates-hero-subtitle">Pilih tanggal penyewaan untuk melihat kendaraan yang tersedia dengan harga terbaik</p>
        </div>
    </section>

    <!-- Form Container -->
    <div class="select-dates-container">
        <div class="select-dates-form-card">
            <!-- Form Header -->
            <div class="select-dates-form-header">
                <h2>
                    <i class="fas fa-calendar-alt"></i>
                    Pilih Tanggal Sewa Anda
                </h2>
            </div>

            <!-- Form Body -->
            <div class="select-dates-form-body">
                <form id="dateForm">
                    <!-- Date Inputs Grid -->
                    <div class="select-dates-grid">
                        <!-- Start Date -->
                        <div class="select-dates-field">
                            <label class="select-dates-label">
                                <span class="select-dates-label-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </span>
                                Tanggal Mulai
                            </label>
                            <input
                                type="date"
                                id="startDate"
                                class="select-dates-input"
                                required
                                min="{{ date('Y-m-d') }}"
                            >
                        </div>

                        <!-- End Date -->
                        <div class="select-dates-field">
                            <label class="select-dates-label">
                                <span class="select-dates-label-icon">
                                    <i class="fas fa-calendar-times"></i>
                                </span>
                                Tanggal Selesai
                            </label>
                            <input
                                type="date"
                                id="endDate"
                                class="select-dates-input"
                                required
                            >
                        </div>
                    </div>

                    <!-- Duration Info -->
                    <div class="select-dates-duration" id="durationInfo">
                        <div class="select-dates-duration-row">
                            <span class="select-dates-duration-label">📅 Tanggal Mulai</span>
                            <span class="select-dates-duration-value" id="startDateDisplay">-</span>
                        </div>
                        <div class="select-dates-duration-row">
                            <span class="select-dates-duration-label">📅 Tanggal Selesai</span>
                            <span class="select-dates-duration-value" id="endDateDisplay">-</span>
                        </div>
                        <div class="select-dates-duration-row highlight">
                            <span class="select-dates-duration-label">⏱️ Durasi Penyewaan</span>
                            <span class="select-dates-duration-value" id="durationDays">0 hari</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="select-dates-button-group">
                        <a href="{{ route('cars.index') }}" class="select-dates-btn select-dates-btn-secondary">
                            <i class="fas fa-undo"></i> Kembali
                        </a>
                        <button type="submit" class="select-dates-btn select-dates-btn-primary" id="submitBtn">
                            <i class="fas fa-search"></i> Cari Mobil
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div class="select-dates-loading" id="loading">
                        <div class="select-dates-spinner"></div>
                        <p>Mencari kendaraan yang tersedia...</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const durationInfo = document.getElementById('durationInfo');
        const durationDays = document.getElementById('durationDays');
        const startDateDisplay = document.getElementById('startDateDisplay');
        const endDateDisplay = document.getElementById('endDateDisplay');
        const dateForm = document.getElementById('dateForm');
        const loading = document.getElementById('loading');
        const submitBtn = document.getElementById('submitBtn');

        // Set minimum date for end date when start date changes
        startDateInput.addEventListener('change', function () {
            endDateInput.min = this.value;
            if (this.value && endDateInput.value && new Date(endDateInput.value) <= new Date(this.value)) {
                endDateInput.value = '';
            }
            calculateDuration();
        });

        endDateInput.addEventListener('change', calculateDuration);

        function calculateDuration() {
            if (startDateInput.value && endDateInput.value) {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                const diffTime = end - start;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Include both start and end dates

                if (diffDays > 0) {
                    durationDays.textContent = diffDays + ' hari';
                    startDateDisplay.textContent = formatDate(start);
                    endDateDisplay.textContent = formatDate(end);
                    durationInfo.classList.add('show');
                } else {
                    durationInfo.classList.remove('show');
                }
            } else {
                durationInfo.classList.remove('show');
            }
        }

        function formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric', locale: 'id-ID' };
            return new Intl.DateTimeFormat('id-ID', options).format(date);
        }

        dateForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const startDate = startDateInput.value;
            const endDate = endDateInput.value;

            if (!startDate || !endDate) {
                alert('Harap isi tanggal mulai dan tanggal selesai');
                return;
            }

            // Show loading state
            loading.classList.add('show');
            submitBtn.disabled = true;

            try {
                const response = await fetch(`/api/bookings/available-cars?start_date=${startDate}&end_date=${endDate}`);
                const data = await response.json();

                // Store in session/local storage and redirect
                sessionStorage.setItem('bookingData', JSON.stringify({
                    startDate: startDate,
                    endDate: endDate,
                    cars: data.cars
                }));

                // Redirect to available cars list page
                window.location.href = `/bookings/select-car?start_date=${startDate}&end_date=${endDate}`;
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data mobil. Silakan coba lagi.');
                loading.classList.remove('show');
                submitBtn.disabled = false;
            }
        });
    </script>

</x-app-layout>
