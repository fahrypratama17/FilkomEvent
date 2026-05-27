{{-- ==================== HALAMAN 3: DESKRIPSI ==================== --}}
<div class="form-step hidden" id="step-3">
  <div class="grid grid-cols-2 gap-x-[60px] gap-y-[26px]">
    <div class="col-span-2">
      <label class="{{ $labelClass }}">Deskripsi Pembuka / Singkat:</label>
      <textarea name="short_description" placeholder="Deskripsi singkat Event" class="{{ $textareaClass }} h-[116px]"></textarea>
    </div>

    <div class="col-span-2">
      <label class="{{ $labelClass }}">Deskripsi Lengkap:</label>
      <textarea name="description" placeholder="Definisi Event" class="{{ $textareaClass }} h-[139px]"></textarea>
    </div>

    <div class="col-span-2">
      <label class="{{ $labelClass }}">Tujuan Event:</label>
      <div id="purposeWrapper" class="space-y-3">
        <div class="relative">
          <input type="text" name="event_purpose[]" placeholder="Tujuan dari Event" class="{{ $inputClass }} pr-[60px]">
          <button type="button" id="addPurpose" class="absolute right-[21px] top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">+</button>
        </div>
      </div>
    </div>
  </div>
</div>

