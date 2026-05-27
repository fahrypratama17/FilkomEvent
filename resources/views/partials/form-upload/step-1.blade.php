{{-- ==================== HALAMAN 1: INFO UTAMA ==================== --}}
<div class="form-step" id="step-1">
  {{-- UPLOAD FOTO DENGAN PREVIEW ELASTIS --}}
  <div class="mb-[49px] flex flex-col items-center">
    <label for="image_url" id="uploadLabel" class="group relative flex min-h-[202px] w-full max-w-[500px] cursor-pointer flex-col items-center justify-center overflow-hidden rounded-[24px] bg-[#FF5F2A] shadow-[0_5px_4px_rgba(0,0,0,0.35)] transition hover:scale-[1.01] p-2">
      <div id="uploadIconContainer" class="flex flex-col items-center justify-center py-8">
        <i data-lucide="upload-cloud" class="h-[105px] w-[105px] stroke-[4] text-white"></i>
      </div>
      <img id="imagePreview" src="#" alt="Preview Poster" class="hidden h-auto w-full rounded-[18px] object-contain">
    </label>

    <input id="image_url" name="image_url" type="file" accept="image/*" class="hidden">

    <button type="button" onclick="document.getElementById('image_url').click()" class="mt-[39px] h-[48px] w-[573px] rounded-full bg-[#050064] text-[17px] font-extrabold text-white">
      Unggah Poster Event
    </button>

    <p id="fileNamePreview" class="mt-3 text-sm font-semibold text-[#06005D]/70"></p>
  </div>

  {{-- GRID FORM HALAMAN 1 --}}
  <div class="grid grid-cols-2 gap-x-[60px] gap-y-[26px]">
    <div>
      <label class="{{ $labelClass }}">Judul Event:</label>
      <input type="text" name="title" placeholder="Nama Event" class="{{ $inputClass }}">
    </div>

    <div>
      <label class="{{ $labelClass }}">Mulai Event:</label>
      <div class="relative">
        <input type="text" name="event_start" placeholder="Kapan Event dimulai?" onfocus="this.type='datetime-local'" class="{{ $inputClass }} pr-[55px]">
        <i data-lucide="calendar-days" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#FF5F2A]"></i>
      </div>
    </div>

    <div>
      <label class="{{ $labelClass }}">Akhir Event:</label>
      <div class="relative">
        <input type="text" name="event_end" placeholder="Kapan Event berakhir?" onfocus="this.type='datetime-local'" class="{{ $inputClass }} pr-[55px]">
        <i data-lucide="calendar-days" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#FF5F2A]"></i>
      </div>
    </div>

    <div>
      <label class="{{ $labelClass }}">Lokasi:</label>
      <input type="text" name="location" placeholder="Lokasi Event" class="{{ $inputClass }}">
    </div>

    <div>
      <label class="{{ $labelClass }}">Kuota:</label>
      <input type="number" name="quota" placeholder="Jumlah peserta" class="{{ $inputClass }}">
    </div>
  </div>
</div>
