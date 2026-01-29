<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-3xl shadow-lg p-8">
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Tambahkan Ulasan</h1>
                <p class="text-slate-500 mb-8">Bagikan pengalaman Anda dengan layanan kami</p>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-700 font-semibold mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Booking Selection --}}
                    <div>
                        <label for="booking_id" class="block text-sm font-bold text-gray-700 mb-2">
                            Pilih Pemesanan
                        </label>
                        <select 
                            id="booking_id" 
                            name="booking_id" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-600 focus:border-transparent">
                            <option value="">-- Pilih Pemesanan --</option>
                            @forelse($bookings as $booking)
                                <option value="{{ $booking->id }}">
                                    {{ $booking->car->brand }} {{ $booking->car->name }} - 
                                    ({{ $booking->booking_code }})
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada pemesanan yang dapat diulas</option>
                            @endforelse
                        </select>
                        @error('booking_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Rating --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-4">
                            Rating (Bintang) <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-3 items-center">
                            <div class="flex gap-2" id="ratingStars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input 
                                        type="radio" 
                                        id="rating_{{ $i }}" 
                                        name="rating" 
                                        value="{{ $i }}"
                                        class="sr-only peer"
                                        required>
                                    <label 
                                        for="rating_{{ $i }}" 
                                        class="cursor-pointer inline-block transition-all transform hover:scale-110">
                                        <svg class="w-10 h-10 star-icon text-gray-300 transition-all" id="star_{{ $i }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                            <span id="ratingText" class="text-sm font-semibold text-gray-600 ml-4">Pilih Rating</span>
                        </div>
                        @error('rating')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const stars = document.querySelectorAll('input[name="rating"]');
                            const ratingText = document.getElementById('ratingText');
                            const ratingLabels = document.querySelectorAll('label[for^="rating_"]');

                            const updateStars = (value) => {
                                stars.forEach((star, index) => {
                                    const starIcon = document.getElementById(`star_${index + 1}`);
                                    if (index < value) {
                                        starIcon.classList.remove('text-gray-300');
                                        starIcon.classList.add('text-yellow-400');
                                    } else {
                                        starIcon.classList.remove('text-yellow-400');
                                        starIcon.classList.add('text-gray-300');
                                    }
                                });
                            };

                            // Hover effect
                            ratingLabels.forEach((label, index) => {
                                label.addEventListener('mouseenter', () => {
                                    updateStars(index + 1);
                                    ratingText.textContent = `${index + 1} Bintang`;
                                });
                            });

                            // Reset on mouse leave jika belum ada pilihan
                            document.getElementById('ratingStars').addEventListener('mouseleave', () => {
                                const checked = document.querySelector('input[name="rating"]:checked');
                                if (checked) {
                                    updateStars(checked.value);
                                    ratingText.textContent = `${checked.value} Bintang - Terima Kasih!`;
                                } else {
                                    stars.forEach(star => {
                                        document.getElementById(`star_${star.value}`).classList.remove('text-yellow-400');
                                        document.getElementById(`star_${star.value}`).classList.add('text-gray-300');
                                    });
                                    ratingText.textContent = 'Pilih Rating';
                                }
                            });

                            // Click to select
                            stars.forEach((star, index) => {
                                star.addEventListener('click', function() {
                                    updateStars(this.value);
                                    ratingText.textContent = `${this.value} Bintang - Terima Kasih!`;
                                });
                            });

                            // Initialize if already has value
                            const checked = document.querySelector('input[name="rating"]:checked');
                            if (checked) {
                                updateStars(checked.value);
                                ratingText.textContent = `${checked.value} Bintang - Terima Kasih!`;
                            }
                        });
                    </script>

                    {{-- Upload Image --}}
                    <div>
                        <label for="image" class="block text-sm font-bold text-gray-700 mb-2">
                            Upload Foto (Opsional)
                        </label>
                        <div class="relative">
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-600 focus:border-transparent cursor-pointer"
                                onchange="previewImage(event)">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WebP | Maksimal 2MB</p>
                        </div>
                        
                        {{-- Image Preview --}}
                        <div id="imagePreview" class="mt-4 hidden">
                            <img id="previewImg" src="" alt="Preview" class="w-full h-48 object-cover rounded-xl border border-gray-300">
                            <button type="button" onclick="removeImage()" class="mt-2 text-red-500 hover:text-red-700 text-sm font-semibold">
                                × Hapus Gambar
                            </button>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Comment --}}
                    <div>
                        <label for="comment" class="block text-sm font-bold text-gray-700 mb-2">
                            Komentar (Opsional)
                        </label>
                        <textarea 
                            id="comment" 
                            name="comment" 
                            rows="5"
                            placeholder="Bagikan pengalaman Anda dengan layanan kami..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-600 focus:border-transparent resize-none"
                            maxlength="1000"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Maksimal 1000 karakter</p>
                        @error('comment')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <script>
                        function previewImage(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('previewImg').src = e.target.result;
                                    document.getElementById('imagePreview').classList.remove('hidden');
                                };
                                reader.readAsDataURL(file);
                            }
                        }

                        function removeImage() {
                            document.getElementById('image').value = '';
                            document.getElementById('imagePreview').classList.add('hidden');
                        }
                    </script>

                    {{-- Submit Buttons --}}
                    <div class="flex gap-4 pt-6">
                        <a href="{{ route('dashboard') }}" 
                           class="flex-1 bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-xl hover:bg-gray-400 transition-colors text-center">
                            Batal
                        </a>
                        <button 
                            type="submit"
                            class="flex-1 bg-yellow-600 text-white font-bold py-3 px-6 rounded-xl hover:bg-yellow-700 transition-colors">
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
