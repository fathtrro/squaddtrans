<!-- Terms & Conditions Modal -->
<div id="termsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">

            <!-- Header -->
            <div class="sticky top-0 bg-white border-b px-6 py-4">
                <h2 class="text-2xl font-bold">Pernyataan & Persetujuan (WAJIB DI BACA)</h2>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">

                <!-- Terms List -->
                <div class="space-y-3 text-sm text-gray-700 mb-6">
                    <p><strong>1.</strong>Penyewa menyerakan jaminan berupa montor tahun 2009 ke atas, STNK, KTP, KK, semua atas nama penyewa</p>

                    <p><strong>2.</strong>Uang sewa harus di bawar lunas sesuai dengan lama sewa.</p>

                    <p><strong>3.</strong>Lama sewa minimal 12 (Kecuali WKN / Hari Besar).</p>

                    <p><strong>4.</strong>Bila penyewa ingin memperpanjang masa sewa maka diharuskan lapor menginformasikan kepada staf Kantor SQUAD TRANS, dan bia tidak menginformasikan maka penyewa di anggap ingin menguasai mobil tersebut dan SQUAD TRANS berhak menyelesaikan secara hukum yang berlaku atau melaporkan kepada pihak kepolisian dan denda sebesar Rp. 1.500.000 untuk setiap hari keterlambatan.</p>

                    <p><strong>5.</strong>Bilamana mobil yang disewa menurut perjanjian ini selama perjanjian berlangsung dan pihak penyewa belum menyerahkan mobil tersebut kepada SQUAD TRANS karena kehilangan tersebut, maka pihak penyewa bertanggung jawab dan wajib mengganti mobil tersebut menurut harga pasaran.</p>

                    <p><strong>6.</strong>Bilamana terhadap segala apa yang disewakan tersebut terjadi kerusakan, sebelum penyewa penggantian suku cadang yang rusak tersebut, terlebih dahulu melaporkan kepada SQUAD TRANS, pergantian tanpa pemberitahuan dianggap tindakan perusakan atau pencurian oleh penyewa.</p>

                    <p><strong>7.</strong>Selama mobil dalam masa perbaikan penyewa wajib membayar uang sewa sebesar 100% dari tarif yang berlaku.</p>

                    <p><strong>8.</strong>Segala apa yang disewa menurut perjanjian ini pihak penyewa, tidak berhak menjaminkan, memindahkan hak sewanya dan atau memindahkan pada pihak lain baik secara diam-diam maupun terang-terangan dan bilamana hal demikian terjadi maka penyewa wajib membayar denda sebesar 30x (30 kali dari besarnya sewa dan semua resiko yang timbul karena menjadi tanggung jawab pihak sewa).</p>

                    <p><strong>9.</strong>Bilamana terjadi hal-hal tersebut dalam butir 5 dan butir 8 di atas tanpa pemberitahuan  terlebih dahulu dan pihak penyewa seberapa perlu pihak SQUAD TRANS diberi kuasa pula untuk dan atas namanya sendiri maupun terang-terangan, dan bilamana hal demikian terjadi maka pihak penyewa wajib membayar denda 3sebesar 30x (tiga puluh kali) dari besar sewa.</p>

                    <p><strong>10.</strong>Semua resiko yang timbul karenanya menjadi tanggungan pihak penyewa apabila pihak penyewa tidak sanggup menyelesaikan biaya sewa atau biaya perbaikan maka SQUAD TRANS berhak menguasai dan menggunakan barang jaminan sesuai dengan jumlah tagihan dan meminta kekurangan (sewa / perbaikan) bilamana nilai jaminan tersebut tidak menacukupi.</p>

                    <p><strong>11.</strong>Pihak penyewa bertanggung jawab penuh terhadap kerusakan maupun karena kehilangan, pencurian, penipuan, atau kebakaran dan sebab-sebab lain yang mengakibatkan mobil mengalami kerusakan Sebagian atau seluruh atas segala apa yang disewakan tersebut dan semuanya menjadi resiko dan tanggung jawab penyewa.</p>

                    <p><strong>12.</strong>Bilamana perjanjian sewa ini berakhir tidak ada kerugian apapun yang menimpa SQUAD TRANS tetapi pihak SQUAD TRANS belum menyerahkan barang jaminan kepada penyewa, maka pihak SQUAD TRANS bersedia mengganti barang jaminan sesuai harga pasaran, ketentuan ini tidak berlaku bila terjadi hal-hal sebagaimana tersebut dalam butir 6, butir8, butir 9, butir 10, butir 11, sehingga barang jaminan tersebut harus di perhitungkan terlebih dahulu dengan biaya kekurangan yang diderit SQUAD TRANS.</p>

                    <p><strong>13.</strong>Pihak penyewa tidak di perbolehka menggunakan mobil untuk sarana atau prasarana kejahatan atau pelanggaran yang melanggar hukum yang berlaku. SQUAD TRANS tidak bertanggung jawab secara hukum atas penyalahgunaan kendaraan atau mobil yang di sewa.</p>
                </div>

                <!-- Checkboxes -->
                <div class="space-y-3 border-t pt-6">
                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" id="termsCheck1" class="mt-1 mr-3 w-4 h-4 rounded">
                        <span class="text-sm text-gray-700">
                            Saya telah membaca, memahami, dan menyetujui Syarat dan Ketentuan serta kebijakan Privasi SQUAD TRANS
                        </span>
                    </label>

                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" id="termsCheck2" class="mt-1 mr-3 w-4 h-4 rounded">
                        <span class="text-sm text-gray-700">
                            Saya menyetujui untuk menerima informasi, promosi dan penawaran produk dengan tujuan marketing dari SQUAD TRANS
                        </span>
                    </label>
                </div>
            </div>

            <!-- Footer -->
            <div class="sticky bottom-0 bg-white border-t px-6 py-4 flex gap-3 justify-end">
                <button id="agreeTermsBtn"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg disabled:opacity-50 disabled:cursor-not-allowed transition"
                    disabled>
                    Setuju & Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsModal = document.getElementById('termsModal');
    const check1 = document.getElementById('termsCheck1');
    const check2 = document.getElementById('termsCheck2');
    const agreeBtn = document.getElementById('agreeTermsBtn');

    function updateButtonState() {
        agreeBtn.disabled = !(check1.checked && check2.checked);
    }

    check1.addEventListener('change', updateButtonState);
    check2.addEventListener('change', updateButtonState);

    agreeBtn.addEventListener('click', function() {
        termsModal.classList.add('hidden');
        // Reset checkboxes
        check1.checked = false;
        check2.checked = false;
        updateButtonState();
        // Set flag agar tidak tampil lagi di session browser yang sama
        sessionStorage.setItem('termsAgreedThisSession', 'true');
    });

    // Auto show modal jika ada trigger dari flash session (setelah login/register)
    const showTermsFromFlash = "{{ session('showTermsModal', false) }}" === "true" ||
                               "{{ session('showTermsModal', false) }}" === "1";

    // Jika ada trigger dari flash session, tampilkan modal
    if (showTermsFromFlash) {
        sessionStorage.removeItem('termsAgreedThisSession');
        termsModal.classList.remove('hidden');
    }

    // Fungsi manual untuk show modal (optional, untuk trigger dari tempat lain)
    window.showTermsModal = function() {
        // Cek apakah sudah agree di session browser ini
        if (!sessionStorage.getItem('termsAgreedThisSession')) {
            termsModal.classList.remove('hidden');
        }
    };

    // Close modal jika klik di luar modal (optional)
    termsModal.addEventListener('click', function(e) {
        if (e.target === termsModal) {
            // Prevent closing modal by clicking outside
            // Modal harus di close dengan button "Setuju & Lanjutkan"
        }
    });
});
</script>
