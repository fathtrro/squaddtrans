{{-- PROGRESS TIMELINE TAB --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-6">
    <div class="space-y-1 mb-6">
        <h3 class="text-xs sm:text-sm font-bold text-gray-900 uppercase tracking-wide">Progress Booking</h3>
        <p class="text-xs text-gray-500">Status perjalanan Anda</p>
    </div>

    {{-- Desktop timeline (hidden on mobile) --}}
    <div class="hidden sm:block relative">
        {{-- Background connector line --}}
        <div class="absolute top-6 left-0 right-0 h-1 bg-gray-200 rounded-full"></div>

        {{-- Active progress line --}}
        <div class="absolute top-6 left-0 h-1 bg-gradient-to-r from-yellow-400 via-orange-500 to-green-500 rounded-full transition-all duration-500"
             style="width: {{ $booking->status == 'confirmed' ? '33%' : ($booking->status == 'running' ? '66%' : ($booking->status == 'completed' ? '100%' : '0%')) }};"></div>

        {{-- Steps container --}}
        <div class="flex justify-between relative z-10">
            {{-- Step 1 --}}
            <div class="flex flex-col items-center flex-1">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 text-white shadow-lg flex items-center justify-center border-4 border-white mb-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="text-center">
                    <p class="text-xs sm:text-sm font-bold text-gray-900">Booking Dibuat</p>
                    <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($booking->created_at)->locale('id')->format('d M') }}</p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="flex flex-col items-center flex-1">
                <div class="w-12 h-12 rounded-full {{ in_array($booking->status, ['confirmed', 'running', 'completed']) ? 'bg-gradient-to-br from-yellow-400 to-orange-500' : 'bg-gray-300' }} text-white shadow-lg flex items-center justify-center border-4 border-white mb-3 transition-all duration-300">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </div>
                <div class="text-center">
                    <p class="text-xs sm:text-sm font-bold {{ in_array($booking->status, ['confirmed', 'running', 'completed']) ? 'text-gray-900' : 'text-gray-500' }}">Pembayaran</p>
                    <p class="text-xs {{ in_array($booking->status, ['confirmed', 'running', 'completed']) ? 'text-gray-600' : 'text-gray-400' }} mt-1">{{ $booking->formatted_start_date }}</p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="flex flex-col items-center flex-1">
                <div class="w-12 h-12 rounded-full {{ in_array($booking->status, ['running', 'completed']) ? 'bg-gradient-to-br from-orange-500 to-green-500' : 'bg-gray-300' }} text-white shadow-lg flex items-center justify-center border-4 border-white mb-3 transition-all duration-300">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                </div>
                <div class="text-center">
                    <p class="text-xs sm:text-sm font-bold {{ in_array($booking->status, ['running', 'completed']) ? 'text-gray-900' : 'text-gray-500' }}">Digunakan</p>
                    <p class="text-xs {{ in_array($booking->status, ['running', 'completed']) ? 'text-gray-600' : 'text-gray-400' }} mt-1">{{ $booking->formatted_start_date }}</p>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="flex flex-col items-center flex-1">
                <div class="w-12 h-12 rounded-full {{ $booking->status === 'completed' ? 'bg-gradient-to-br from-green-500 to-blue-500' : 'bg-gray-300' }} text-white shadow-lg flex items-center justify-center border-4 border-white mb-3 transition-all duration-300">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="text-center">
                    <p class="text-xs sm:text-sm font-bold {{ $booking->status === 'completed' ? 'text-gray-900' : 'text-gray-500' }}">Selesai</p>
                    <p class="text-xs {{ $booking->status === 'completed' ? 'text-gray-600' : 'text-gray-400' }} mt-1">{{ $booking->formatted_end_date }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile timeline (visible only on mobile) --}}
    <div class="sm:hidden space-y-2">
        {{-- Mobile Step 1 --}}
        <div class="flex items-center gap-3 p-3 rounded-lg">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-9 w-9 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 text-white shadow-sm">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm text-gray-900">Booking Dibuat</p>
                <p class="text-xs text-gray-500 mt-0.5">{{ \Carbon\Carbon::parse($booking->created_at)->locale('id')->format('d M Y, H:i') }}</p>
            </div>
            <span class="inline-block px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full flex-shrink-0">Aktif</span>
        </div>

        {{-- Mobile Step 2 --}}
        <div class="flex items-center gap-3 p-3 rounded-lg {{ in_array($booking->status, ['confirmed', 'running', 'completed']) ? 'opacity-100' : 'opacity-60' }} transition-opacity duration-300">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-9 w-9 rounded-full {{ in_array($booking->status, ['confirmed', 'running', 'completed']) ? 'bg-gradient-to-br from-yellow-400 to-orange-500' : 'bg-gray-300' }} text-white shadow-sm">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm {{ in_array($booking->status, ['confirmed', 'running', 'completed']) ? 'text-gray-900' : 'text-gray-500' }}">Pembayaran Dikonfirmasi</p>
                <p class="text-xs {{ in_array($booking->status, ['confirmed', 'running', 'completed']) ? 'text-gray-600' : 'text-gray-400' }} mt-0.5">{{ $booking->formatted_start_date }}</p>
            </div>
            @if(in_array($booking->status, ['confirmed', 'running', 'completed']))
                <span class="inline-block px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex-shrink-0">✓</span>
            @endif
        </div>

        {{-- Mobile Step 3 --}}
        <div class="flex items-center gap-3 p-3 rounded-lg {{ in_array($booking->status, ['running', 'completed']) ? 'opacity-100' : 'opacity-60' }} transition-opacity duration-300">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-9 w-9 rounded-full {{ in_array($booking->status, ['running', 'completed']) ? 'bg-gradient-to-br from-orange-500 to-green-500' : 'bg-gray-300' }} text-white shadow-sm">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm {{ in_array($booking->status, ['running', 'completed']) ? 'text-gray-900' : 'text-gray-500' }}">Sedang Digunakan</p>
                <p class="text-xs {{ in_array($booking->status, ['running', 'completed']) ? 'text-gray-600' : 'text-gray-400' }} mt-0.5">{{ $booking->formatted_start_date }}</p>
            </div>
            @if(in_array($booking->status, ['running', 'completed']))
                <span class="inline-block px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex-shrink-0">✓</span>
            @endif
        </div>

        {{-- Mobile Step 4 --}}
        <div class="flex items-center gap-3 p-3 rounded-lg {{ $booking->status === 'completed' ? 'opacity-100' : 'opacity-60' }} transition-opacity duration-300">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-9 w-9 rounded-full {{ $booking->status === 'completed' ? 'bg-gradient-to-br from-green-500 to-blue-500' : 'bg-gray-300' }} text-white shadow-sm">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm {{ $booking->status === 'completed' ? 'text-gray-900' : 'text-gray-500' }}">Perjalanan Selesai</p>
                <p class="text-xs {{ $booking->status === 'completed' ? 'text-gray-600' : 'text-gray-400' }} mt-0.5">{{ $booking->formatted_end_date }}</p>
            </div>
            @if($booking->status === 'completed')
                <span class="inline-block px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex-shrink-0">✓</span>
            @endif
        </div>
    </div>
</div>
