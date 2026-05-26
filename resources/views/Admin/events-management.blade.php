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
@php
  $statusLabels = [
    'Aktif' => 'Aktif',
      'Akan Datang' => 'Akan Datang',
      'Berlangsung' => 'Berlangsung',
      'Selesai' => 'Selesai',
      'Dibatalkan' => 'Dibatalkan',
  ];

  $statusClasses = [
    'Aktif' => 'bg-[#1F388B]',
      'Akan Datang' => 'bg-[#1F388B]',
      'Berlangsung' => 'bg-[#16A34A]',
      'Selesai' => 'bg-[#16A34A]',
      'Dibatalkan' => 'bg-[#E13427]',
  ];
@endphp

  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div
      class="absolute h-full w-full opacity-4"
      style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebar', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="flex-1 overflow-y-auto bg-white px-12 py-8">
      {{-- TOP BAR --}}
      <div class="mb-8 flex justify-end">
        <button type="button"
                class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg"
               viewBox="0 0 24 24"
               fill="#F9682A"
               class="h-8 w-8">
            <path fill-rule="evenodd"
                  d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                  clip-rule="evenodd" />
          </svg>
        </button>
      </div>

      {{-- HEADER PAGE --}}
      <div class="mb-8 flex items-center gap-5">
        <img src="{{ asset('assets/mascot.png') }}"
             alt="Mascot"
             class="w-16"
             onerror="this.style.display='none'">

        <h1 class="text-[50px] font-extrabold leading-none tracking-tight text-black">
          Event <span class="text-[#FF742E]">Management!</span>
        </h1>
      </div>

      {{-- FILTER & STATS BAR --}}
      <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-[#223E96]">
{{--          Total Event: {{ $events->total() }} Events--}}
          8
        </h2>

        <a href="{{ route('admin.events.create') }}"
           class="flex items-center gap-2 rounded-xl bg-[#223E96] px-6 py-3 font-bold text-white shadow-md transition hover:bg-blue-800 active:scale-95">
          <span class="text-2xl font-bold text-[#FF742E]">+</span>
          Add New Event
        </a>
      </div>

      {{-- TABLE CONTAINER --}}
      <div class="rounded-[20px] border border-gray-200 bg-white p-6 shadow-md">
        {{-- FILTER FORM --}}
        <form method="GET" action="{{ route('admin.events.index') }}">
          {{-- SEARCH BAR --}}
          <div class="relative mb-8 w-full">
                          <span class="absolute inset-y-0 left-0 flex items-center pl-5">
                              <svg class="h-6 w-6 text-white/80"
                                   fill="none"
                                   stroke="currentColor"
                                   viewBox="0 0 24 24">
                                  <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                              </svg>
                          </span>

            <input
              type="text"
              name="search"
              value="{{ request('search') }}"
              placeholder="Search here"
              class="h-16 w-full rounded-xl border-0 bg-[#03479B] pl-16 pr-5 text-xl text-white shadow-inner placeholder:text-white/80 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
          </div>

          {{-- FILTER ROW --}}
          <div class="mb-10 flex flex-wrap items-center gap-6 text-[#223E96]">
            <div class="flex items-center gap-4">
              <span class="text-lg text-[#404040]">Category:</span>

              <select
                name="category_id"
                class="min-w-[180px] rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md text-[#404040] focus:outline-none"
              >
                <option value="">Semua Kategori</option>

{{--                @forelse($categories as $category)--}}
{{--                  <option--}}
{{--                    value="{{ $category->category_id }}"--}}
{{--                    @selected(request('category_id') == $category->category_id)--}}
{{--                  >--}}
{{--                    {{ $category->category_name }}--}}
{{--                  </option>--}}
{{--                @empty--}}
{{--                  <option value="1" @selected(request('category_id') == 1)>Workshop</option>--}}
{{--                  <option value="2" @selected(request('category_id') == 2)>Lomba</option>--}}
{{--                  <option value="3" @selected(request('category_id') == 3)>Webinar</option>--}}
{{--                  <option value="4" @selected(request('category_id') == 4)>Seminar</option>--}}
{{--                @endforelse--}}
              </select>
            </div>

            <div class="flex items-center gap-4">
              <span class="text-lg text-[#404040]">Status:</span>

              <select
                name="event_status"
                class="min-w-[190px] rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md text-[#404040] focus:outline-none"
              >
                <option value="">Semua Status</option>
                <option value="akan_datang" @selected(request('event_status') === 'akan_datang')>Akan Datang</option>
                <option value="berlangsung" @selected(request('event_status') === 'berlangsung')>Sedang Berlangsung</option>
                <option value="selesai" @selected(request('event_status') === 'selesai')>Selesai</option>
                <option value="dibatalkan" @selected(request('event_status') === 'dibatalkan')>Dibatalkan</option>
              </select>
            </div>

            <button
              type="submit"
              class="rounded-xl bg-[#223E96] px-8 py-3 text-md font-bold text-white shadow-sm transition hover:bg-blue-800"
            >
              Filter
            </button>

            <a
              href="{{ route('admin.events.index') }}"
              class="rounded-xl bg-[#E13427] px-8 py-3 text-md font-bold text-white shadow-sm transition hover:bg-red-700"
            >
              Clear Filters
            </a>
          </div>
        </form>

        {{-- TABLE HEADER --}}
        <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] border-b pb-4 text-center text-sm font-bold text-[#1F388B]">
          <div class="text-left">Event Title</div>
          <div>Schedule</div>
          <div>Event Status</div>
          <div>Quota</div>
          <div>Price</div>
          <div>Category</div>
          <div>Action</div>
        </div>

        {{-- TABLE BODY --}}
        <div class="divide-y divide-gray-100">
{{--          @forelse($events as $event)--}}
{{--            @php--}}
{{--              $status = $event->event_status;--}}

{{--              $statusLabel = $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status));--}}
{{--              $statusClass = $statusClasses[$status];--}}

{{--              $start = $event->event_start ? \Carbon\Carbon::parse($event->event_start) : null;--}}
{{--              $end = $event->event_end ? \Carbon\Carbon::parse($event->event_end) : null;--}}

{{--              $quotaFilled = $event->quota_filled ?? 0;--}}
{{--              $quotaTotal = $event->quota ?? 0;--}}

{{--              $priceText = $event->is_paid--}}
{{--                  ? 'Rp ' . number_format((float) $event->price, 0, ',', '.')--}}
{{--                  : 'Gratis';--}}
{{--            @endphp--}}

{{--            <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] items-center py-6 text-center text-sm">--}}
{{--              <div class="text-left">--}}
{{--                <p class="font-bold text-gray-800">--}}
{{--                  {{ $event->title }}--}}
{{--                </p>--}}

{{--                <p class="text-xs italic text-gray-400">--}}
{{--                  By: {{ $event->organizer ?? 'Admin FILKOM' }}--}}
{{--                </p>--}}
{{--              </div>--}}

{{--              <div>--}}
{{--                <p class="font-semibold">--}}
{{--                  {{ $start ? $start->format('d M Y') : '-' }}--}}
{{--                </p>--}}

{{--                <p class="text-[10px] text-gray-500">--}}
{{--                  {{ $start ? $start->format('H:i') : '-' }}--}}
{{--                  ---}}
{{--                  {{ $end ? $end->format('H:i') : '-' }}--}}
{{--                </p>--}}
{{--              </div>--}}

{{--              <div>--}}
{{--                                  <span class="{{ $statusClass }} rounded-full px-4 py-1 text-[10px] font-bold text-white">--}}
{{--                                      {{ $statusLabel }}--}}
{{--                                  </span>--}}
{{--              </div>--}}

{{--              <div class="font-semibold text-gray-600">--}}
{{--                {{ $quotaFilled }}/{{ $quotaTotal }}--}}
{{--              </div>--}}

{{--              <div class="font-semibold text-gray-600">--}}
{{--                {{ $priceText }}--}}
{{--              </div>--}}

{{--              <div>--}}
{{--                                  <span class="rounded-full bg-[#1F388B] px-4 py-1 text-[10px] font-bold text-white">--}}
{{--                                      {{ $event->category->category_name ?? '-' }}--}}
{{--                                  </span>--}}
{{--              </div>--}}

{{--              <div class="flex justify-center gap-3">--}}
{{--                <a href="#"--}}
{{--                   class="text-[#FF742E] transition-colors hover:text-orange-600"--}}
{{--                   title="Edit event">--}}
{{--                  <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                       fill="none"--}}
{{--                       viewBox="0 0 24 24"--}}
{{--                       stroke-width="1.5"--}}
{{--                       stroke="currentColor"--}}
{{--                       class="h-6 w-6">--}}
{{--                    <path stroke-linecap="round"--}}
{{--                          stroke-linejoin="round"--}}
{{--                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />--}}
{{--                  </svg>--}}
{{--                </a>--}}

{{--                <button--}}
{{--                  type="button"--}}
{{--                  class="delete-button   text-[#223E96] transition-opacity hover:opacity-80"--}}
{{--                  data-url="{{ route('admin.events.destroy', $event) }}"--}}
{{--                  data-title="{{ $event->title }}"--}}
{{--                >--}}
{{--                  <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                       viewBox="0 0 24 24"--}}
{{--                       fill="currentColor"--}}
{{--                       class="h-6 w-6">--}}
{{--                    <path fill-rule="evenodd"--}}
{{--                          d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"--}}
{{--                          clip-rule="evenodd" />--}}
{{--                  </svg>--}}
{{--                </button>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          @empty--}}
{{--            <div class="py-12 text-center">--}}
{{--              <p class="text-lg font-bold text-[#1F388B]">--}}
{{--                Belum ada event.--}}
{{--              </p>--}}

{{--              <p class="mt-2 text-sm text-gray-500">--}}
{{--                Klik tombol Add New Event untuk menambahkan event baru.--}}
{{--              </p>--}}
{{--            </div>--}}
{{--          @endforelse--}}
        </div>

        {{-- PAGINATION --}}
{{--        <div class="mt-8">--}}
{{--          {{ $events->links() }}--}}
{{--        </div>--}}
      </div>
    </main>

    {{-- DELETE CONFIRMATION MODAL --}}
    <div
      id="delete-modal"
      class="fixed inset-0 z-[70] hidden items-center justify-center bg-white/65 backdrop-blur-[1px]"
    >
      <div
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-[0.98] translate-y-3"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-120"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-[0.98] translate-y-2"
        class="relative h-[330px] w-[760px] max-w-[calc(100vw-48px)] transform-gpu will-change-transform"
      >
        {{-- Mascot --}}
        <img
          src="{{ asset('assets/img/mascot-filkom.png') }}"
          alt="Filko Konfirmasi"
          class="absolute left-[18px] top-[-76px] z-20 w-[305px] max-w-[42vw] drop-shadow-[0_20px_22px_rgba(0,0,0,0.35)]"
          onerror="this.onerror=null; this.src='{{ asset('icon/FilkomEventAvatar.svg') }}'"
        >

        {{-- Card --}}
        <div class="absolute bottom-0 left-0 h-[260px] w-full overflow-hidden rounded-[14px] bg-gradient-to-r from-[#08B9D5] to-[#1F388B] shadow-[0_20px_35px_rgba(0,0,0,0.30)]">
          {{-- Decorative circles --}}
          <div class="pointer-events-none absolute right-[52px] top-[25px] h-[78px] w-[78px] rounded-full bg-white/15 shadow-md"></div>
          <div class="pointer-events-none absolute right-[130px] top-[16px] h-[34px] w-[34px] rounded-full bg-white/15 shadow-md"></div>
          <div class="pointer-events-none absolute right-[28px] top-[108px] h-[34px] w-[34px] rounded-full bg-white/15 shadow-md"></div>
          <div class="pointer-events-none absolute right-[110px] bottom-[30px] h-[78px] w-[78px] rounded-full bg-white/15 shadow-md"></div>
          <div class="pointer-events-none absolute left-[330px] top-[64px] h-[104px] w-[104px] rounded-full bg-white/10 shadow-md"></div>
          <div class="pointer-events-none absolute left-[430px] bottom-[84px] h-[36px] w-[36px] rounded-full bg-white/10 shadow-md"></div>

          {{-- Content --}}
          <div class="relative z-10 ml-[335px] flex h-full w-[360px] flex-col items-center justify-center px-4 pb-7 pt-9 text-center text-white">
            <h2 class="text-[32px] font-black uppercase leading-[1.05] tracking-[5px]">
              FILKO butuh<br>
              konfirmasimu!
            </h2>

            <p class="mt-3 text-[14px] font-medium leading-tight text-white/95">
              Apakah kamu yakin untuk<br>
              menghapus Event ini?
            </p>

            <p class="mt-2 h-[18px] max-w-[300px] truncate text-[12px] font-semibold text-white/80" id="delete-event-title"></p>

            {{-- Buttons --}}
            <div class="mt-5 flex items-center justify-center gap-7">
              <button
                type="button"
                id="close-delete-modal"
                class="h-[38px] w-[116px] rounded-[8px] bg-[#FF642B] text-[14px] font-bold text-white shadow-md transition hover:bg-orange-600 active:scale-95"
              >
                Batal
              </button>

              <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')

                <button
                  type="submit"
                  class="h-[38px] w-[116px] rounded-[8px] bg-[#E92222] text-[14px] font-bold text-white shadow-md transition hover:bg-red-700 active:scale-95"
                >
                  Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
