<div
  id="termsModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
>
  <div class="w-full max-w-2xl rounded-3xl bg-white p-6 shadow-2xl">

    <div class="mb-5 flex items-center justify-between border-b border-gray-200 pb-4">
      <h2 class="text-2xl font-bold text-[#233E98]">
        Syarat dan Ketentuan Event
      </h2>

      <button
        type="button"
        onclick="closeTermsModal()"
        class="rounded-full p-2 hover:bg-gray-100 cursor-pointer"
      >
        <i data-lucide="X" class="h-5 w-5"></i>
      </button>
    </div>

    <div class="max-h-125 overflow-y-auto pr-2">
      <ol class="list-disc space-y-2 pl-5 text-[15px] leading-relaxed text-gray-700">
        <li>Peserta wajib melakukan registrasi menggunakan data diri yang valid dan aktif.</li>
        <li>Peserta diwajibkan hadir tepat waktu sesuai jadwal yang telah ditentukan panitia.</li>
        <li>Peserta wajib menjaga ketertiban dan kenyamanan selama acara berlangsung.</li>
        <li>Dilarang melakukan tindakan yang mengganggu jalannya acara maupun peserta lain.</li>
        <li>Panitia berhak menolak atau membatalkan keikutsertaan peserta yang melanggar aturan.</li>
        <li>Peserta wajib mengikuti seluruh rangkaian kegiatan hingga acara selesai.</li>
        <li>Segala bentuk dokumentasi selama acara menjadi hak milik panitia untuk publikasi.</li>
        <li>Biaya pendaftaran yang telah dibayarkan tidak dapat dikembalikan dalam kondisi apa pun.</li>
        <li>Peserta bertanggung jawab atas barang pribadi masing-masing selama acara berlangsung.</li>
        <li>Dengan melakukan pendaftaran, peserta dianggap telah memahami dan menyetujui seluruh syarat dan ketentuan yang berlaku.</li>
      </ol>
    </div>

    <div class="mt-6 flex justify-end border-t border-gray-200 pt-4">
      <button type="button" onclick="closeTermsModal()" class="group relative overflow-hidden text-white font-bold px-8 py-2 rounded-[50px] mb-6 bg-primary-dark cursor-pointer">
        <span class="relative flex justify-center z-10 transition-colors duration-300 group-hover:text-primary-dark">
          Tutup
        </span>
        <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
      </button>
    </div>
  </div>
</div>
