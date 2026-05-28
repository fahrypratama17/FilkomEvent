<div class="form-step hidden" id="step-3">
  <div class="grid grid-cols-2 gap-x-15 gap-y-6.5">
    <div class="col-span-2">
      <label class="admin-label">Deskripsi Pembuka / Singkat:</label>
      <textarea name="short_description" placeholder="Deskripsi singkat Event" class="admin-textarea h-29"></textarea>
    </div>

    <div class="col-span-2">
      <label class="admin-label">Deskripsi Lengkap:</label>
      <textarea name="description" placeholder="Definisi Event" class="admin-textarea h-34.75"></textarea>
    </div>

    <div class="col-span-2">
      <label class="admin-label">Tujuan Event:</label>
      <div id="purposeWrapper" class="space-y-3">
        <div class="relative">
          <input type="text" name="event_goals[]" placeholder="Tujuan dari Event" class="admin-input pr-15">
          <button type="button" id="addPurpose" class="absolute right-5.25 top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">+</button>
        </div>
      </div>
    </div>
  </div>
</div>
