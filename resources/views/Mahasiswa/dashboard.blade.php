<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Dashboard</title>
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

    <main class="relative flex-1 overflow-y-auto px-12 py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="mb-12 flex items-center gap-5">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
          <div class="relative overflow-hidden shimmer bg-linear-to-r from-secondary-lighter via-white/40 to-white/80 p-4 rounded-4xl backdrop-blur-3xl">
            <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
              Selamat Datang, <span class="text-[#FF742E]">{{ Auth::user()->name ?? "Mahasiswa" }}</span>
            </h1>
          </div>
        </div>

        <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <div class="mb-8 flex items-center justify-between">
        <p class="font-bold">Event Mendatang</p>
        <button onclick="location.href='/events'" class="flex items-center gap-2 text-[18px] font-medium  hover:scale-105 duration-200 cursor-pointer">
          Tampilkan Semua
          <i data-lucide="ChevronRight" class="w-6"></i>
        </button>
      </div>

      <section class="mb-12 grid grid-cols-3 gap-12">
        @foreach ($events as $card)
          <x-event-card :event="$card" />
        @endforeach
      </section>

      <section class="grid grid-cols-[0.5fr_1fr] gap-12 pb-6">
        <div class="rounded-3xl bg-linear-to-br from-secondary-lighter to-primary-dark px-7 py-7 text-white shadow-[0_25px_60px_rgba(0,0,0,0.4)] border border-white/80 overflow-hidden">
          <h2 class="mb-6 text-[28px] font-extrabold leading-tight">
            Kategori Acara Populer
          </h2>

          <div class="space-y-7 ">
            @foreach ($categories as $category)
              <div class="flex items-center justify-between rounded-[20px] bg-[#ECECEC] px-6 py-5 border-2 border-white/20 hover:scale-105 duration-300">
                <div class="flex items-center gap-6">
                  <div>
                    <i class="text-orange-550 w-8 h-8" data-lucide="{{ $category->icon }}"></i>
                  </div>
                  <div>
                    <p class="text-xl font-bold text-orange-550">{{ $category->category_name }}</p>
                    <p class="text-[14px] text-primary-dark/60">{{ $category->events_count }} Events</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="flex flex-col gap-4 rounded-3xl bg-linear-to-br from-primary-dark via-primary-lighter to-secondary-lighter px-9 py-9 h-full border-2 border-white/20 shadow-[0_25px_60px_rgba(0,0,0,0.4)] overflow-hidden">
          <div class="mb-9 grid grid-cols-3 gap-9">
            @foreach ($stats as $item)
              <div class="relative flex flex-col h-42.5 items-center justify-center rounded-3xl bg-[#FF6A27] px-6 text-center text-white shadow-[12px_12px_0px_rgba(0,0,0,0.5)] hover:scale-105 hover:shadow-none duration-300">
                <div class="absolute top-4 right-4 opacity-40 duration-200 hover:opacity-100">
                  <i data-lucide="{{ $item['icon'] }}" class="w-8 h-8"></i>
                </div>
                <div class="mb-4 text-[54px] font-extrabold leading-none counter" data-target={{ $item['value'] }}>0</div>
                <div class="text-lg text-white/80">{{ $item['label'] }}</div>
              </div>
            @endforeach
          </div>

          <div class="rounded-[28px] bg-white/40 backdrop-blur-2xl border border-white h-full">
            <div id="chartRoot" data-stats='@json($categoryStats)'></div>
            <div class="flex flex-col items-center justify-center h-full gap-6">
              <div class="relative w-44 h-44">
                <div id="donutChart" class="absolute inset-0 rounded-full"></div>
                <div class="absolute inset-8 bg-white rounded-full flex flex-col items-center justify-center text-black">
                  <p class="text-xl opacity-80">Total</p>
                  <p class="text-xl font-bold" id="totalEvents">0</p>
                </div>
              </div>
              <div id="chartLegend" class="flex flex-wrap justify-center gap-4 text-white text-xs"></div>

              <div id="tooltip" class="fixed hidden px-3 py-2 text-xs text-white bg-black/80 rounded-lg shadow-lg pointer-events-none z-50">
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
