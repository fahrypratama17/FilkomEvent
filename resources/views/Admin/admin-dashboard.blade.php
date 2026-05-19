<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | FILKOM Event</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FBFBFB] font-sans text-black antialiased">
@php
  $totalEvents = $totalEvents ?? 24;
  $upcomingEvents = $upcomingEvents ?? 8;
  $ongoingEvents = $ongoingEvents ?? 15;
  $finishedEvents = $finishedEvents ?? 1;

  $summaryCards = [
    [
      'value' => str_pad((string) $totalEvents, 2, '0', STR_PAD_LEFT),
      'label' => 'Jumlah<br>Event',
    ],
    [
      'value' => str_pad((string) $upcomingEvents, 2, '0', STR_PAD_LEFT),
      'label' => 'Event Akan<br>Datang',
    ],
    [
      'value' => str_pad((string) $ongoingEvents, 2, '0', STR_PAD_LEFT),
      'label' => 'Event Sedang<br>Berlangsung',
    ],
    [
      'value' => str_pad((string) $finishedEvents, 2, '0', STR_PAD_LEFT),
      'label' => 'Event<br>Selesai',
    ],
  ];

  $categoryStats = collect($categoryStats ?? [])->values()->all();
@endphp

<section class="mx-auto flex min-h-screen w-full overflow-hidden">
  <aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#1F388B] px-12 py-8 text-white shadow-sm">
    <div class="mb-14 flex items-center gap-3">
      <h1 class="text-xl font-bold">Filkom Event</h1>
    </div>

    <div>
      <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">
        Main Menu
      </h2>

      <nav class="space-y-8">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-8 text-[24px] font-bold text-white underline underline-offset-8">
          <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.events.index') }}"
           class="flex items-center gap-8 text-[24px] text-white/70">
          <span>Events</span>
        </a>

        <a href="#"
           class="flex items-center gap-8 text-[24px] text-white/70">
          <span>User Management</span>
        </a>
      </nav>
    </div>

    <div class="mt-auto pt-16">
      <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">
        Setting
      </h2>

      <div class="space-y-8">
        <a href="#"
           class="flex items-center gap-8 text-[24px] text-white/90">
          <span>Profile</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <button type="submit"
                  class="flex w-full items-center gap-8 text-left text-[24px] text-white/90">
            <span>Logout</span>
          </button>
        </form>
      </div>
    </div>
  </aside>

  <main class="flex-1 overflow-y-auto bg-white px-12 py-8">
    <section class="mb-[28px] flex items-center gap-[24px]">
      <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Admin Mascot" class="h-[72px] w-[86px] object-contain">

      <h1 class="text-[40px] font-extrabold leading-none">
        Welcome, <span class="text-[#FF5C28]">Admin!</span>
      </h1>
    </section>

    <section class="mb-[63px] rounded-[18px] bg-[#10B4CB] px-[44px] py-[36px]">
      <div class="grid grid-cols-4 place-items-center gap-[78px]">
        @foreach ($summaryCards as $card)
          <div class="flex h-[167px] w-[150px] flex-col items-center justify-center rounded-[18px] bg-[#FF5C28] text-center text-white">
            <div class="mb-[16px] text-[36px] font-extrabold leading-none">
              {{ $card['value'] }}
            </div>

            <div class="text-[15px] font-medium leading-[18px]">
              {!! $card['label'] !!}
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <section class="rounded-[18px] bg-[#FF5C28] px-[63px] py-[49px]">
      <div class="flex items-center justify-between gap-[64px]">
        <div class="relative h-[324px] w-[324px] shrink-0">
          <canvas id="adminCategoryChart" data-stats='@json($categoryStats)'></canvas>
        </div>

        <div class="mr-[27px] flex h-[254px] w-[414px] items-center rounded-[20px] bg-white px-[54px] shadow-[0_5px_7px_rgba(0,0,0,0.22)]">
          <div id="adminCategoryLegend" class="w-full space-y-[24px]"></div>
        </div>
      </div>
    </section>
  </main>
</section>
</body>
</html>
