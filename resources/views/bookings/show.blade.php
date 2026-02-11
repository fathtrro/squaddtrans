<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50/30 to-slate-50 py-8" x-data="{ activeTab: 'progres' }" x-cloak>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- HEADER WITH BOOKING CODE --}}
            <div class="mb-6 sm:mb-8">
                <a href="{{ route('bookings.index') }}"
                   class="inline-flex items-center text-xs sm:text-sm text-gray-600 hover:text-gray-900 mb-4 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>

                <div class="flex flex-col gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">
                            Booking #{{ $booking->booking_code }}
                        </h1>
                        <p class="text-xs sm:text-sm text-gray-500">Detail informasi booking Anda</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                        <span class="inline-flex items-center px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm font-semibold {{ $booking->status_badge }} shadow-sm">
                            {{ $booking->status_label }}
                        </span>

                        <button onclick="window.print()"
                                class="inline-flex items-center px-3 sm:px-4 py-2 bg-white border-2 border-gray-200 rounded-full text-xs sm:text-sm font-semibold text-gray-700 hover:border-gray-300 hover:shadow-md transition-all duration-200 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="hidden sm:inline">Download</span>
                        </button>

                        <button class="inline-flex items-center px-3 sm:px-4 py-2 bg-white border-2 border-gray-200 rounded-full text-xs sm:text-sm font-semibold text-gray-700 hover:border-gray-300 hover:shadow-md transition-all duration-200 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            <span class="hidden sm:inline">Bagikan</span>
                        </button>
                    </div>
            {{-- STICKY TAB NAVIGATION --}}
            <div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100 rounded-t-2xl shadow-sm mb-6">
                <div class="px-4">
                    <nav class="flex gap-0 overflow-x-visible justify-between sm:justify-start sm:gap-1">
                        <button @click="activeTab = 'progres'"
                                :class="activeTab === 'progres' ? 'border-orange-500 text-orange-600 font-bold' : 'border-transparent text-gray-600 hover:text-gray-900'"
                                class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 px-2 sm:px-4 py-3 sm:py-4 border-b-2 transition-colors duration-200 text-xs sm:text-sm flex-1 sm:flex-none">
                            <i class="fas fa-clock text-lg sm:text-base"></i>
                            <span>Progres</span>
                        </button>

                        <button @click="activeTab = 'info'"
                                :class="activeTab === 'info' ? 'border-orange-500 text-orange-600 font-bold' : 'border-transparent text-gray-600 hover:text-gray-900'"
                                class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 px-2 sm:px-4 py-3 sm:py-4 border-b-2 transition-colors duration-200 text-xs sm:text-sm flex-1 sm:flex-none">
                            <i class="fas fa-circle-info text-lg sm:text-base"></i>
                            <span>Info</span>
                        </button>

                        <button @click="activeTab = 'biaya'"
                                :class="activeTab === 'biaya' ? 'border-orange-500 text-orange-600 font-bold' : 'border-transparent text-gray-600 hover:text-gray-900'"
                                class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 px-2 sm:px-4 py-3 sm:py-4 border-b-2 transition-colors duration-200 text-xs sm:text-sm flex-1 sm:flex-none">
                            <i class="fas fa-receipt text-lg sm:text-base"></i>
                            <span>Biaya</span>
                        </button>

                        <button @click="activeTab = 'extension'"
                                :class="activeTab === 'extension' ? 'border-orange-500 text-orange-600 font-bold' : 'border-transparent text-gray-600 hover:text-gray-900'"
                                class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 px-2 sm:px-4 py-3 sm:py-4 border-b-2 transition-colors duration-200 text-xs sm:text-sm flex-1 sm:flex-none">
                            <i class="fas fa-repeat text-lg sm:text-base"></i>
                            <span>Perpanjang</span>
                        </button>
                    </nav>
                </div>
            </div>

            {{-- MAIN CONTENT WITH SIDEBAR LAYOUT --}}
            <div class="grid lg:grid-cols-3 gap-8">
                {{-- MAIN CONTENT (full width on mobile, 2 columns on desktop) --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- TAB CONTENT --}}
                {{-- PROGRES TAB --}}
                <div x-show="activeTab === 'progres'" x-transition>
                    @include('bookings.partials.tab-progres')
                </div>

                {{-- INFORMASI TAB --}}
                <div x-show="activeTab === 'info'" x-transition>
                    @include('bookings.partials.tab-info')
                </div>

                {{-- BIAYA TAB --}}
                <div x-show="activeTab === 'biaya'" x-transition>
                    @include('bookings.partials.tab-billing')
                </div>

                {{-- PERPANJANG TAB --}}
                <div x-show="activeTab === 'extension'" x-transition>
                    @include('bookings.partials.tab-extension')
                </div>
                </div>

                {{-- RIGHT SIDEBAR (1 column on desktop) --}}
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-8 space-y-6">
                        {{-- CAR INFO CARD --}}
                    <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl shadow-xl overflow-hidden border border-slate-700">
                        <div class="aspect-[4/3] bg-gradient-to-br from-slate-700 to-slate-800 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?w=600&q=80"
                                 alt="{{ $booking->car->name }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-white mb-1">
                                {{ $booking->car->name ?? 'Toyota Alphard Premium' }}
                            </h3>
                            <p class="text-sm text-slate-400 mb-6">Black Edition - 2023 Executive Lounge</p>

                            <div class="grid grid-cols-3 gap-3 mb-6">
                                <div class="text-center p-3 bg-slate-800/50 rounded-xl border border-slate-700">
                                    <svg class="w-6 h-6 text-yellow-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                                    </svg>
                                    <div class="text-xs text-slate-400">Auto</div>
                                </div>

                                <div class="text-center p-3 bg-slate-800/50 rounded-xl border border-slate-700">
                                    <svg class="w-6 h-6 text-yellow-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="text-xs text-slate-400">Petrol</div>
                                </div>

                                <div class="text-center p-3 bg-slate-800/50 rounded-xl border border-slate-700">
                                    <svg class="w-6 h-6 text-yellow-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                    <div class="text-xs text-slate-400">7 Seats</div>
                                </div>
                            </div>

                            <div class="border-t border-slate-700 pt-4">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-slate-400">Layanan</span>
                                    <span class="text-white font-semibold">{{ $booking->service_type_label }}</span>
                                </div>

                                @if($booking->driver)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-400">Sopir</span>
                                    <span class="text-white font-semibold">{{ $booking->driver->name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="space-y-3">
                        @if($booking->canBeCancelled())
                            <form method="POST" action="#" class="w-full">
                                @csrf
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')"
                                        class="w-full px-6 py-3 bg-white border-2 border-red-500 text-red-600 rounded-xl font-bold hover:bg-red-50 transition-all duration-200 flex items-center justify-center group">
                                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Batalkan Booking
                                </button>
                            </form>
                        @endif

                        <button class="w-full px-6 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-xl font-bold hover:from-yellow-500 hover:to-orange-600 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            Hubungi Customer Service
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- EXTEND BOOKING MODAL --}}
    <div id="extendModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4">
            {{-- Modal Header --}}
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-xl font-bold text-white">Perpanjang Sewa</h2>
                </div>
                <button onclick="closeExtendModal()" type="button" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <form id="extendForm" action="{{ route('bookings.extend', $booking->id) }}" method="POST" class="p-6 space-y-4">
                @csrf

                <div>
                    <label for="new_end_datetime" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Tanggal & Waktu Kembali Baru
                    </label>
                    <input type="datetime-local"
                           id="new_end_datetime"
                           name="new_end_datetime"
                           min="{{ now()->format('Y-m-d\TH:i') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                           required>
                    <p class="text-xs text-gray-500 mt-2">
                        Pilih tanggal dan waktu baru. Sistem akan mendeteksi konflik otomatis.
                    </p>
                </div>

                {{-- Conflict Alert (JavaScript will populate) --}}
                <div id="conflictAlert" class="hidden bg-red-50 border-l-4 border-red-400 p-4 rounded">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-bold text-red-800">Jadwal Bentrok!</p>
                            <p id="conflictMessage" class="text-sm text-red-700 mt-1"></p>
                        </div>
                    </div>
                </div>

                {{-- Success Alert (JavaScript will populate) --}}
                <div id="successAlert" class="hidden bg-green-50 border-l-4 border-green-400 p-4 rounded">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm text-green-700">Tanggal tersedia!</p>
                    </div>
                </div>

                {{-- Pricing Info --}}
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Durasi Tambahan:</span>
                        <span id="extraHours" class="font-bold text-gray-900">0 jam</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Biaya Tambahan:</span>
                        <span id="extraPrice" class="font-bold text-orange-600">Rp 0</span>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="button"
                            onclick="closeExtendModal()"
                            class="flex-1 px-4 py-2 border-2 border-gray-200 text-gray-700 rounded-lg font-semibold hover:border-gray-300 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-2 bg-cyan-500 text-white rounded-lg font-semibold hover:bg-cyan-600 transition-colors">
                        Ajukan Perpanjangan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const bookingId = {{ $booking->id }};
        const currentEndDatetime = new Date('{{ $booking->end_datetime->format('c') }}');
        const hourlyRate = {{ ($booking->total_price / $booking->duration_in_days / 24) }};

        function openExtendModal() {
            document.getElementById('extendModal').classList.remove('hidden');
            document.getElementById('new_end_datetime').focus();
        }

        function closeExtendModal() {
            document.getElementById('extendModal').classList.add('hidden');
            document.getElementById('extendForm').reset();
            document.getElementById('conflictAlert').classList.add('hidden');
            document.getElementById('successAlert').classList.add('hidden');
        }

        // Check for conflicts when date changes
        document.getElementById('new_end_datetime').addEventListener('change', async function() {
            const newEndDatetime = this.value;

            if (!newEndDatetime) {
                document.getElementById('conflictAlert').classList.add('hidden');
                document.getElementById('successAlert').classList.add('hidden');
                return;
            }

            // Calculate extra hours
            const newEnd = new Date(newEndDatetime);
            const diffMs = newEnd - currentEndDatetime;
            const diffHours = Math.ceil(diffMs / (1000 * 60 * 60));
            const extraPrice = Math.round(diffHours * hourlyRate);

            document.getElementById('extraHours').textContent = diffHours + ' jam';
            document.getElementById('extraPrice').textContent = 'Rp ' + extraPrice.toLocaleString('id-ID');

            // Check for conflicts
            try {
                const response = await fetch('{{ route('bookings.extend-conflict', $booking->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ new_end_datetime: newEndDatetime })
                });

                const data = await response.json();

                if (data.has_conflict) {
                    document.getElementById('conflictAlert').classList.remove('hidden');
                    document.getElementById('conflictMessage').textContent = data.message;
                    document.getElementById('successAlert').classList.add('hidden');
                } else {
                    document.getElementById('conflictAlert').classList.add('hidden');
                    document.getElementById('successAlert').classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error checking conflict:', error);
            }
        });

        // Handle form submission via AJAX
        document.getElementById('extendForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');

            // Disable button during submission
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengirim...';

            try {
                const response = await fetch('{{ route('bookings.extend', $booking->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message
                    closeExtendModal();
                    showNotification(data.message, 'success');

                    // Reload the page after 1.5 seconds to show updated extension info
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showNotification(data.message, 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Ajukan Perpanjangan';
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Ajukan Perpanjangan';
            }
        });

        // Helper function to show notifications
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg text-white ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 4000);
        }

        // Close modal when clicking outside
        document.getElementById('extendModal').addEventListener('click', function(e) {
            if (e.target === this) closeExtendModal();
        });
    </script>
</x-app-layout>
