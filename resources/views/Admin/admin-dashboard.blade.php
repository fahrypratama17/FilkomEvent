<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Admin Dashboard | FILKOM Event</title>
</head>
<body>
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


  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebar', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <section class="mx-auto flex min-h-screen w-full overflow-hidden">
      <main class="flex-1 overflow-y-auto bg-white px-12 py-8">
        <section class="mb-[28px] flex items-center gap-[24px]">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Admin Mascot" class="h-[72px] w-[86px] object-contain">

          <h1 class="text-[40px] font-extrabold leading-none">
            Welcome, <span class="text-[#FF5C28]">Admin!</span>
          </h1>
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
  </div>
</body>
</html>
