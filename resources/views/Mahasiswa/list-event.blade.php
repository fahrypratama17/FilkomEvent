<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - List Event</title>
</head>
<body>
  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebar-mahasiswa', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="flex-1 overflow-y-auto px-11 py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="flex items-center gap-5">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
          <div class="relative overflow-hidden shimmer bg-linear-to-r from-secondary-lighter via-white/40 to-white/80 p-4 rounded-4xl backdrop-blur-3xl">
            <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
              Portal Event <span class="text-[#FF742E]">Terkini</span>
            </h1>
          </div>
        </div>

        <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <x-search-bar />

      <section class="mb-9 flex items-end justify-between gap-6">
        <div class="flex items-end gap-8">
          <div>
            <label class="mb-2 block text-[14px] text-[#4F4F4F]">Category:</label>
            <div class="relative">
              <select class="h-[42px] min-w-[254px] appearance-none rounded-[8px] border border-[#D0D0D0] bg-[#F7F7F7] px-4 pr-10 text-[14px] text-[#2F2F2F] focus:outline-none">
                <option>Workshop, Seminar, etc</option>
              </select>
            </div>
          </div>

          <div>
            <label class="mb-2 block text-[14px] text-[#4F4F4F]">Status</label>
            <div class="relative">
              <select class="h-[42px] min-w-[116px] appearance-none rounded-[8px] border border-[#D0D0D0] bg-[#F7F7F7] px-4 pr-10 text-[14px] text-[#2F2F2F] focus:outline-none">
                <option>All status</option>
              </select>
            </div>
          </div>
        </div>

        <button class="inline-flex h-[42px] items-center justify-center rounded-[8px] bg-[#EB2525] px-6 text-[14px] font-semibold text-white">
          Clear Filters
        </button>
      </section>

      <section id="eventList" class="mb-12 grid grid-cols-3 gap-12">
        @foreach ($events as $card)
          <x-event-card :event="$card" />
        @endforeach
      </section>

    </main>
  </div>
</body>
</html>
