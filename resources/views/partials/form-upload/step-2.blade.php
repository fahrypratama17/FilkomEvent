{{-- ==================== HALAMAN 2: STATUS & KONTAK ==================== --}}
<div class="form-step hidden" id="step-2">
  <div class="grid grid-cols-2 gap-x-[60px] gap-y-[26px]">
    <div>
      <label class="{{ $labelClass }}">Status Event:</label>
      <div class="relative">
        <select name="event_status" class="{{ $selectClass }}">
          <option value="berlangsung">Sedang Berlangsung</option>
          <option value="akan_datang">Akan Datang</option>
          <option value="selesai">Selesai</option>
          <option value="dibatalkan">Dibatalkan</option>
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    <div>
      <label class="{{ $labelClass }}">Status Pendaftaran:</label>
      <div class="relative">
        <select name="registration_status" class="{{ $selectClass }}">
          <option value="terdaftar">Terdaftar</option>
          <option value="lunas">Lunas</option>
          <option value="batal">Batal</option>
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    <div>
      <label class="{{ $labelClass }}">Status Pembayaran Event:</label>
      <div class="relative">
        <select name="is_paid" class="{{ $selectClass }}">
          <option value="1">Berbayar</option>
          <option value="0">Gratis</option>
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    <div>
      <label class="{{ $labelClass }}">Biaya Pendaftaran:</label>
      <input type="number" name="price" placeholder="Berapa biaya pendaftaran?" class="{{ $inputClass }}">
    </div>

    <div>
      <label class="{{ $labelClass }}">Kategori:</label>
      <div class="relative">
        <select name="category_id" class="{{ $selectClass }}">
          @forelse($categories ?? [] as $category)
            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
          @empty
            <option value="1">Lomba</option>
            <option value="2">Workshop</option>
            <option value="3">Webinar</option>
            <option value="4">Seminar</option>
          @endforelse
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    {{-- CONTAINER PEMBICARA DENGAN ID CONTAINER AGAR BISA DIKONTROL JS --}}
    <div class="col-span-2 transition-all duration-300" id="speakerContainer">
      <label class="{{ $labelClass }}">Pembicara:</label>
      <div id="speakerWrapper" class="space-y-3">
        <div class="relative">
          <div class="grid grid-cols-3 gap-3 pr-[60px]">
            <input type="text" name="speaker_names[]" id="firstSpeakerInput" placeholder="Nama" class="{{ $inputClass }}">
            <input type="text" name="speaker_titles[]" placeholder="Jabatan" class="{{ $inputClass }}">
            <input type="text" name="speaker_organizations[]" placeholder="Organisasi" class="{{ $inputClass }}">
          </div>
          <button type="button" id="addSpeaker" class="absolute right-[21px] top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">+</button>
        </div>
      </div>
    </div>

    <div>
      <label class="{{ $labelClass }}">Penyelenggara:</label>
      <input type="text" name="organizer" placeholder="Nama penyelenggara" class="{{ $inputClass }}">
    </div>

    <div>
      <label class="{{ $labelClass }}">Email Penyelenggara:</label>
      <input type="email" name="contact_email" placeholder="Email penyelenggara" class="{{ $inputClass }}">
    </div>

    <div>
      <label class="{{ $labelClass }}">Narahubung:</label>
      <input type="text" name="contact_phone" placeholder="Kontak penyelenggara" class="{{ $inputClass }}">
    </div>
  </div>
</div>
