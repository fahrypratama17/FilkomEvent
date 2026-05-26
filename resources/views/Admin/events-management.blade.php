<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Admin Event Management - FILKOM Event</title>
</head>
<body>
  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div
      class="absolute h-full w-full opacity-4"
      style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebar', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="relative flex-1 px-12 py-8">
      <header class="flex items-start justify-between gap-6">
        <div class="mb-8 flex items-center gap-5">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
          <div class="relative overflow-hidden shimmer bg-linear-to-r from-secondary-lighter via-white/40 to-white/80 p-4 rounded-4xl backdrop-blur-3xl">
            <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
              Manajemen <span class="text-[#FF742E]">Event</span>
            </h1>
          </div>
        </div>

        <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-[#223E96]">
          Total Event: {{ $events->total() }} Event
        </h2>

        <a href="{{ route('admin.events.create') }}" class="flex items-center gap-2 rounded-2xl bg-primary-lighter px-6 py-3 font-bold text-white shadow-md transition hover:bg-secondary-dark/80 active:scale-95">
          <span class="text-2xl font-bold text-[#FF742E]">+</span>
          Tambah Event Baru
        </a>
      </div>

      <x-search-bar />

      <section class="mb-9 flex items-end justify-between gap-6">
        <div class="flex items-end justify-between gap-8">
          <div>
            <label class="mb-2 block text-[14px] text-[#4F4F4F]">Kategori:</label>
            <div class="relative">
              <select id="categoryFilter" name="category" class="h-10.5 min-w-63.5 rounded-2xl border border-[#D0D0D0] bg-[#F7F7F7] px-4 pr-18 text-[14px] text-[#2F2F2F] focus:outline-none appearance-none cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->category_id }}">
                    {{ $category->category_name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div>
          <label class="mb-2 block text-[14px] text-[#4F4F4F]">Status:</label>
          <div class="relative">
            <select id="statusFilter" name="status" class="h-10.5 min-w-29 rounded-2xl border border-[#D0D0D0] bg-[#F7F7F7] px-4 pr-10 text-[14px] text-[#2F2F2F] focus:outline-none appearance-none cursor-pointer">
              <option value="">Semua Status</option>
              <option value="akan_datang">Akan Datang</option>
              <option value="berlangsung">Sedang Berlangsung</option>
              <option value="selesai">Selesai</option>
              <option value="dibatalkan">Dibatalkan</option>
            </select>
          </div>
        </div>
      </section>

      <div class="rounded-[20px] border border-gray-200 bg-white p-6 shadow-md">
        <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] border-b pb-4 text-center text-sm font-bold text-[#1F388B]">
          <div class="text-left">Nama Event</div>
          <div>Jadwal</div>
          <div>Status</div>
          <div>Kuota</div>
          <div>Harga</div>
          <div>Kategori</div>
          <div>Aksi</div>
        </div>

        <div class="divide-y divide-gray-100">
          @forelse($events as $event)
            @php
              $status = $event->event_status;

              $start = $event->event_start ? \Carbon\Carbon::parse($event->event_start) : null;
              $end = $event->event_end ? \Carbon\Carbon::parse($event->event_end) : null;

              $quotaFilled = $event->quota_filled ?? 0;
              $quotaTotal = $event->quota ?? 0;

              $priceText = $event->is_paid
                  ? 'Rp' . number_format((float) $event->price, 0, ',', '.')
                  : 'Gratis';
            @endphp

            <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] items-center py-6 text-center text-sm">
              <div class="text-left">
                <p class="font-bold text-gray-800">{{ $event->title }}</p>
                <p class="text-xs italic text-gray-400">By: {{ $event->organizer ?? 'Admin FILKOM' }}</p>
              </div>

              <div>
                <p class="font-semibold">{{ $start ? $start->format('d M Y') : '-' }}</p>
                <p class="text-[10px] text-gray-500">{{ $start ? $start->format('H:i') : '-' }} - {{ $end ? $end->format('H:i') : '-' }}
                </p>
              </div>

              <div>
                <span class="{{ $event->status_class }} rounded-full px-4 py-1 text-[10px] font-bold text-white">
                  {{ $event->status_label }}
                </span>
              </div>

              <div class="font-semibold text-gray-600">{{ $quotaFilled }}/{{ $quotaTotal }}</div>
              <div class="font-semibold text-gray-600">{{ $priceText }}</div>

              <div>
                <span class="rounded-full bg-[#1F388B] px-4 py-1 text-[10px] font-bold text-white">
                  {{ $event->category->category_name ?? '-' }}
                </span>
              </div>

              <div class="flex justify-center gap-3">
                <i data-lucide="SquarePen" class="text-orange-400 hover:text-orange-600 duration-200 cursor-pointer"></i>

                <button title="Hapus Event" type="button" class="delete-button" data-url="{{ route('admin.events.destroy', $event) }}" data-title="{{ $event->title }}">
                  <i data-lucide="Trash2" class="text-red-800 hover:text-red-600 duration-200 cursor-pointer"></i>
                </button>
              </div>
            </div>
          @empty
            <div class="py-12 text-center">
              <p class="text-lg font-bold text-[#1F388B]">
                Belum ada event.
              </p>

              <p class="mt-2 text-sm text-gray-500">
                Klik tombol Add New Event untuk menambahkan event baru.
              </p>
            </div>
          @endforelse
        </div>

        <div class="mt-8">
          {{ $events->links() }}
        </div>
      </div>
    </main>

    <x-modal-delete-event/>
  </div>
</body>
</html>
