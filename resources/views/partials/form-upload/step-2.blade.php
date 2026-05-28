<div class="form-step hidden" id="step-2">
  @php
    $selectedEventStatus = old('event_status', $event->event_status ?? '');
    $selectedRegistrationStatus = old('registration_status', $event->registration_status ?? '');
    $selectedPaidStatus = old('is_paid', isset($event) ? (int) $event->is_paid : '');
    $selectedCategory = old('category_id', $event->category_id ?? '');

    $speakerNamesValues = old('speaker_names', $speakerNames ?? ['']);
    $speakerTitlesValues = old('speaker_titles', $speakerTitles ?? ['']);
    $speakerOrganizationsValues = old('speaker_organizations', $speakerOrganizations ?? ['']);
    $speakerRowCount = max(count($speakerNamesValues), count($speakerTitlesValues), count($speakerOrganizationsValues));
  @endphp

  <div class="grid grid-cols-2 gap-x-15 gap-y-6.5">
    <div>
      <label class="admin-label">Status Event:</label>
      <div class="relative">
        <select name="event_status" class="admin-select">
          <option value="berlangsung" {{ $selectedEventStatus === 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
          <option value="akan_datang" {{ $selectedEventStatus === 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
          <option value="selesai" {{ $selectedEventStatus === 'selesai' ? 'selected' : '' }}>Selesai</option>
          <option value="dibatalkan" {{ $selectedEventStatus === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-5.75 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    <div>
      <label class="admin-label">Status Pendaftaran:</label>
      <div class="relative">
        <select name="registration_status" class="admin-select">
          <option value="terdaftar" {{ $selectedRegistrationStatus === 'terdaftar' ? 'selected' : '' }}>Terdaftar</option>
          <option value="lunas" {{ $selectedRegistrationStatus === 'lunas' ? 'selected' : '' }}>Lunas</option>
          <option value="batal" {{ $selectedRegistrationStatus === 'batal' ? 'selected' : '' }}>Batal</option>
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-5.75 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    <div>
      <label class="admin-label">Status Pembayaran Event:</label>
      <div class="relative">
        <select name="is_paid" class="admin-select">
          <option value="1" {{ (string) $selectedPaidStatus === '1' ? 'selected' : '' }}>Berbayar</option>
          <option value="0" {{ (string) $selectedPaidStatus === '0' ? 'selected' : '' }}>Gratis</option>
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-5.75 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    <div>
      <label class="admin-label">Biaya Pendaftaran:</label>
      <input type="number" name="price" placeholder="Berapa biaya pendaftaran?" class="admin-input" value="{{ old('price', $event->price ?? '') }}">
    </div>

    <div>
      <label class="admin-label">Kategori:</label>
      <div class="relative">
        <select name="category_id" class="admin-select">
          @forelse($categories ?? [] as $category)
            <option value="{{ $category->category_id }}" {{ (string) $selectedCategory === (string) $category->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
          @empty
            <option value="1">Lomba</option>
            <option value="2">Workshop</option>
            <option value="3">Webinar</option>
            <option value="4">Seminar</option>
          @endforelse
        </select>
        <i data-lucide="chevron-down" class="pointer-events-none absolute right-5.75 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-[#555]"></i>
      </div>
    </div>

    <div class="col-span-2 transition-all duration-300" id="speakerContainer">
      <label class="admin-label">Pembicara:</label>
      <div id="speakerWrapper" class="space-y-3">
        @for ($i = 0; $i < $speakerRowCount; $i++)
          @php
            $speakerName = $speakerNamesValues[$i] ?? '';
            $speakerTitle = $speakerTitlesValues[$i] ?? '';
            $speakerOrganization = $speakerOrganizationsValues[$i] ?? '';
          @endphp
          <div class="relative">
            <div class="grid grid-cols-3 gap-3 pr-15">
              <input type="text" name="speaker_names[]" {{ $i === 0 ? 'id=firstSpeakerInput' : '' }} placeholder="Nama" class="admin-input" value="{{ $speakerName }}">
              <input type="text" name="speaker_titles[]" placeholder="Jabatan" class="admin-input" value="{{ $speakerTitle }}">
              <input type="text" name="speaker_organizations[]" placeholder="Organisasi" class="admin-input" value="{{ $speakerOrganization }}">
            </div>
            @if ($i === 0)
              <button type="button" id="addSpeaker" class="absolute right-5.25 top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">+</button>
            @else
              <button type="button" class="remove-speaker absolute right-5.25 top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">-</button>
            @endif
          </div>
        @endfor
      </div>
    </div>

    <div>
      <label class="admin-label">Penyelenggara:</label>
      <input type="text" name="organizer" placeholder="Nama penyelenggara" class="admin-input" value="{{ old('organizer', $event->organizer ?? '') }}">
    </div>

    <div>
      <label class="admin-label">Email Penyelenggara:</label>
      <input type="email" name="contact_email" placeholder="Email penyelenggara" class="admin-input" value="{{ old('contact_email', $event->contact_email ?? '') }}">
    </div>

    <div>
      <label class="admin-label">Narahubung:</label>
      <input type="text" name="contact_phone" placeholder="Kontak penyelenggara" class="admin-input" value="{{ old('contact_phone', $event->contact_phone ?? '') }}">
    </div>
  </div>
</div>
