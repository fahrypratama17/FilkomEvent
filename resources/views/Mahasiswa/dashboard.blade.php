<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Dashboard</title>
</head>
<body>
@php
  $eventCards = [
      [
          'date' => '01 Nov, 2026',
          'title' => 'App Design',
          'description' => 'Learn App Design from our expert trainer',
          'tag' => 'UI Corner',
          'participants' => '80 participant',
          'time' => '13:00 - 17:00 WIB',
          'image' => 'assets/events/event-1.png',
      ],
      [
          'date' => '01 Nov, 2026',
          'title' => 'App Design',
          'description' => 'Learn App Design from our expert trainer',
          'tag' => 'UI Corner',
          'participants' => '80 participant',
          'time' => '13:00 - 17:00 WIB',
          'image' => 'assets/events/event-2.png',
      ],
      [
          'date' => '01 Nov, 2026',
          'title' => 'App Design',
          'description' => 'Learn App Design from our expert trainer',
          'tag' => 'UI Corner',
          'participants' => '80 participant',
          'time' => '13:00 - 17:00 WIB',
          'image' => 'assets/events/event-3.png',
      ],
  ];

  $categories = [
      ['name' => 'UI/UX Design', 'count' => '20 Events'],
      ['name' => 'UI/UX Design', 'count' => '20 Events'],
      ['name' => 'UI/UX Design', 'count' => '20 Events'],
      ['name' => 'UI/UX Design', 'count' => '20 Events'],
  ];

  $stats = [
      ['value' => '14', 'label' => 'Events attended'],
      ['value' => '08', 'label' => 'Certificates obtained'],
      ['value' => '04', 'label' => 'Upcoming events'],
  ];
@endphp

  <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">

    @include('components.navbarMahasiswa', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="flex-1 overflow-y-auto px-12 py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="relative w-full max-w-165">
          <i data-lucide="Search" class="absolute bottom-4 left-4 text-gray-400"></i>
          <input
            type="text"
            placeholder="Cari Event..."
            class="h-14 w-full rounded-2xl bg-white border pl-14 pr-5 focus:outline-none text-gray-400 placeholder:text-gray-400 active:ring-1 active:ring-primary-lighter focus:ring-1 focus:ring-primary-lighter transition-all duration-300"
          >
        </div>

        <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <div class="mb-8 flex items-center gap-5">
        <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
        <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
          Selamat Datang, <span class="text-[#FF742E]">{{ Auth::user()->name ?? "Mahasiswa" }}</span>
        </h1>
      </div>

      <div class="mb-12 flex items-center justify-end">
        <button onclick="location.href='/list-event'" class="flex items-center gap-2 text-[18px] font-medium text-[#314A9A] underline underline-offset-4 hover:scale-105 duration-200 cursor-pointer">
          Tampilkan Semua
          <i data-lucide="MoveRight" class="w-4"></i>
        </button>
      </div>

      <section class="mb-12 grid grid-cols-3 gap-12">
        @foreach ($eventCards as $card)
          <article class="rounded-3xl bg-[#0781C4] px-7 py-7 text-white shadow-sm">
            <div class="mb-8 flex items-start justify-between gap-6">
              <div class="min-w-0">
                <div class="mb-10 flex items-center gap-3 text-[12px] text-white/90">
                  <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#FF742E] p-1">

                  </div>
                  <span>{{ $card['date'] }}</span>
                </div>
                <h3 class="mb-2 text-[18px] font-bold">{{ $card['title'] }}</h3>
                <p class="max-w-35 text-[11px] leading-[1.45] text-white/90">
                  {{ $card['description'] }}
                </p>
                <span class="mt-3 inline-flex rounded-md bg-[#FF742E] px-4 py-1 text-[10px] font-medium text-white">
                  {{ $card['tag'] }}
                </span>
              </div>

              <div class="h-42.5 w-28 overflow-hidden rounded-[26px] bg-[#ECECEC]">

              </div>
            </div>

            <div class="mb-8 space-y-4 text-[12px] text-white/90">
              <div class="flex items-center gap-3">

                <span>{{ $card['participants'] }}</span>
              </div>
              <div class="flex items-center gap-3">

                <span>{{ $card['time'] }}</span>
              </div>
            </div>

            <div class="flex items-center gap-4">
              <button class="h-10.5 flex-1 rounded-xl bg-[#FF6A27] text-[14px] font-semibold text-white">
                Register Now
              </button>
              <button class="flex h-10.5 w-10.5 items-center justify-center rounded-xl bg-white shadow-sm">

              </button>
            </div>
          </article>
        @endforeach
      </section>

      <section class="grid grid-cols-[308px_1fr] gap-12 pb-6">
        <div class="rounded-3xl bg-[#0790C7] px-7 py-7 text-white shadow-sm">
          <h2 class="mb-6 text-[28px] font-extrabold leading-tight">
            Popular Categories
            <br>
            Events
          </h2>

          <div class="space-y-7">
            @foreach ($categories as $item)
              <div class="flex items-center justify-between rounded-[20px] bg-[#ECECEC] px-6 py-5">
                <div>
                  <div class="text-[18px] font-bold text-[#FF6A27]">{{ $item['name'] }}</div>
                  <div class="text-[11px] text-[#314A9A]">{{ $item['count'] }}</div>
                </div>
                <div>

                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="rounded-3xl bg-[#16B6D9] px-9 py-9 shadow-sm">
          <div class="mb-9 grid grid-cols-3 gap-9">
            @foreach ($stats as $item)
              <div class="flex h-42.5 items-center justify-center rounded-3xl bg-[#FF6A27] px-6 text-center text-white">
                <div>
                  <div class="mb-4 text-[54px] font-extrabold leading-none">{{ $item['value'] }}</div>
                  <div class="text-[17px] leading-snug">{{ $item['label'] }}</div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="h-52.5 overflow-hidden rounded-[28px] bg-[#FF6A27]">

          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
