{{-- resources/views/admin/inbox/show.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Detail Pesan</x-slot>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-yellow-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.inbox.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-yellow-600 md:ml-2">Inbox</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8">
                <!-- Header -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $inbox->subject }}</h1>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div>
                                <p class="text-sm text-gray-600">Dari</p>
                                <p class="font-semibold text-gray-900">{{ $inbox->name }}</p>
                                <p class="text-sm text-gray-600">{{ $inbox->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Dikirim</p>
                            <p class="font-semibold text-gray-900">{{ $inbox->created_at->format('d M Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $inbox->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="mb-6 flex items-center space-x-2">
                    <span class="text-sm font-medium text-gray-600">Status:</span>
                    @if (!$inbox->is_read)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <span class="w-2 h-2 mr-1.5 bg-yellow-600 rounded-full"></span>
                            Belum Dibaca
                        </span>
                    @elseif ($inbox->responded_at)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <span class="w-2 h-2 mr-1.5 bg-green-600 rounded-full"></span>
                            Sudah Direspon
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <span class="w-2 h-2 mr-1.5 bg-blue-600 rounded-full"></span>
                            Sudah Dibaca
                        </span>
                    @endif
                </div>

                <!-- Message Content -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Pesan</h3>
                    <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                        {{ $inbox->message }}
                    </div>
                </div>

                <!-- Reply Info -->
                @if ($inbox->responded_at)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-sm text-green-800">
                            <span class="font-semibold">✓ Pesan ini telah direspon pada:</span><br>
                            {{ $inbox->responded_at->format('d M Y H:i') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Sender Info Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengirim</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-600 uppercase tracking-wide mb-1">Nama</p>
                        <p class="text-sm font-medium text-gray-900">{{ $inbox->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 uppercase tracking-wide mb-1">Email</p>
                        <a href="mailto:{{ $inbox->email }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-700">
                            {{ $inbox->email }}
                        </a>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 uppercase tracking-wide mb-1">Subjek</p>
                        <p class="text-sm font-medium text-gray-900">{{ $inbox->subject }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 uppercase tracking-wide mb-1">Dikirim</p>
                        <p class="text-sm font-medium text-gray-900">{{ $inbox->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                <div class="space-y-3">
                    <!-- Mark as Responded -->
                    @if (!$inbox->responded_at)
                        <form action="{{ route('admin.inbox.update', $inbox->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-400 to-green-500 text-white rounded-lg hover:from-green-500 hover:to-green-600 shadow-sm font-medium transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Tandai Direspon
                            </button>
                        </form>
                    @else
                        <div class="w-full px-4 py-3 bg-green-50 text-green-700 rounded-lg text-center font-medium text-sm">
                            ✓ Sudah Direspon
                        </div>
                    @endif

                    <!-- Back to Inbox -->
                    <a href="{{ route('admin.inbox.index') }}"
                       class="w-full flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Inbox
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.inbox.destroy', $inbox->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full flex items-center justify-center px-4 py-3 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
