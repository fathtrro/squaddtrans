<div x-data="{ open: false }"
     @open-review-modal.window="open = true"
     x-show="open"
     x-cloak
     class="fixed inset-0 flex items-center justify-center bg-black/40">

    <div class="bg-white p-10 rounded-3xl">
        <h2>Modal Berhasil</h2>

        <button @click="open = false"
            class="mt-4 bg-yellow-600 text-white px-4 py-2 rounded">
            Tutup
        </button>
    </div>

</div>
