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
<div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">

  <div
    class="absolute h-full w-full opacity-4"
    style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
  </div>

  @include('components.sidebar', [
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

      <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm">
        <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
      </button>
    </header>
      <div class="flex flex-col rounded-3xl bg-linear-to-br from-primary-dark via-primary-lighter to-secondary-lighter px-9 py-9 h-full border-2 border-white/20 shadow-[0_25px_60px_rgba(0,0,0,0.4)] overflow-hidden">

        <div class="grid grid-cols-4 gap-6">
          @foreach ($summaryCards as $card)
            <div class="relative flex flex-col h-42.5 items-center justify-center rounded-3xl bg-[#FF6A27] px-6 text-center text-white shadow-[12px_12px_0px_rgba(0,0,0,0.5)] hover:scale-105 hover:shadow-none duration-300">
              <div class="absolute top-4 right-4 opacity-40 duration-200 hover:opacity-100">
                <i data-lucide="{{ $card['icon'] }}" class="w-8 h-8"></i>
              </div>
              <p class="mb-4 text-[54px] font-extrabold leading-none counter" data-target={{ $card['value'] }}>0</p>
              <p class="text-lg text-white/80">{!! $card['label'] !!}</p>
            </div>
          @endforeach
        </div>

        <div class="flex items-center justify-between gap-[64px]">
          <div class="relative h-[324px] w-[324px] shrink-0">
            <canvas
              id="adminCategoryChart"
              data-stats='@json($categoryStats)'
            ></canvas>
          </div>

          <div class="mr-[27px] flex h-[254px] w-[414px] items-center rounded-[20px] bg-white px-[54px] shadow-[0_5px_7px_rgba(0,0,0,0.22)]">
            <div
              id="adminCategoryLegend"
              class="w-full space-y-[24px]"
            ></div>
          </div>
        </div>

      </div>
    </section>
  </main>
</div>
</body>
</html>
