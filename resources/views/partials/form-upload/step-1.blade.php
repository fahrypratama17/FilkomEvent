<div class="form-step" id="step-1">
  <div class="mb-12.25 flex flex-col items-center">
    <label for="image_url" id="uploadLabel" class="group relative flex min-h-50.5 w-full max-w-125 cursor-pointer flex-col items-center justify-center overflow-hidden rounded-2xl bg-orange-550 shadow-[0_5px_4px_rgba(0,0,0,0.35)] transition hover:scale-[1.01] p-2">
      <div id="uploadIconContainer" class="flex flex-col items-center justify-center py-8">
        <i data-lucide="upload-cloud" class="h-26.25 w-26.25 stroke-4 text-white"></i>
      </div>
      <img id="imagePreview" src="#" alt="Preview Poster" class="hidden h-auto w-full rounded-2xl object-contain">
    </label>

    <input id="image_url" name="image_url" type="file" accept="image/*" class="hidden">

    <button type="button" onclick="document.getElementById('image_url').click()" class="mt-9.75 h-12 w-143.25 rounded-2xl bg-[#050064] text-[17px] font-extrabold text-white cursor-pointer hover:scale-105 duration-300">
      Unggah Poster Event
    </button>

    <p id="fileNamePreview" class="mt-3 text-sm font-semibold text-[#06005D]/70"></p>
  </div>

  <div class="grid grid-cols-2 gap-x-15 gap-y-6.5">
    <div>
      <label class="admin-label">Judul Event:</label>
      <input type="text" name="title" placeholder="Nama Event" class="admin-input">
    </div>

    <div>
      <label class="admin-label">Mulai Event:</label>
      <div class="relative">
        <input type="text" name="event_start" placeholder="Kapan Event dimulai?" onfocus="this.type='datetime-local'" class="admin-input pr-13.75">
        <i data-lucide="calendar-days" class="pointer-events-none absolute right-5.75 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-orange-550"></i>
      </div>
    </div>

    <div>
      <label class="admin-label">Akhir Event:</label>
      <div class="relative">
        <input type="text" name="event_end" placeholder="Kapan Event berakhir?" onfocus="this.type='datetime-local'" class="admin-input pr-13.75">
        <i data-lucide="calendar-days" class="pointer-events-none absolute right-5.75 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-orange-550"></i>
      </div>
    </div>

    <div>
      <label class="admin-label">Lokasi:</label>
      <input type="text" name="location" placeholder="Lokasi Event" class="admin-input">
    </div>

    <div>
      <label class="admin-label">Kuota:</label>
      <input type="number" name="quota" placeholder="Jumlah peserta" class="admin-input">
    </div>
  </div>
</div>
