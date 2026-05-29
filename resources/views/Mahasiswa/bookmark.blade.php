<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Bookmark</title>
</head>
<body>
  <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebar', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="relative flex-1 overflow-y-auto px-12 py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="flex items-center gap-5">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
          <div class="relative overflow-hidden shimmer bg-linear-to-r from-secondary-lighter via-white/40 to-white/80 p-4 rounded-4xl backdrop-blur-3xl">
            <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
              Event <span class="text-[#FF742E]">Tersimpan</span>
            </h1>
          </div>
        </div>

        <button onclick="location.href='{{ route('profile') }}'" class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <x-search-bar />

      <section id="eventListSkeleton" class="mb-12 hidden grid grid-cols-3 gap-12">
        @for ($i = 0; $i < 6; $i++)
          <div class="w-full h-full flex flex-col gap-4 bg-white/70 backdrop-blur-lg p-4 border-2 border-white rounded-3xl shadow-xl">
            <div class="w-full h-70 rounded-2xl bg-gray-200 animate-pulse"></div>
            <div class="flex flex-col gap-2 px-2">
              <div class="h-4 w-24 rounded bg-gray-200 animate-pulse"></div>
              <div class="h-5 w-3/4 rounded bg-gray-200 animate-pulse"></div>
              <div class="h-4 w-full rounded bg-gray-200 animate-pulse"></div>
            </div>
            <div class="mt-auto flex gap-4 px-2">
              <div class="h-9 w-full rounded-2xl bg-gray-200 animate-pulse"></div>
              <div class="h-9 w-12 rounded-2xl bg-gray-200 animate-pulse"></div>
            </div>
          </div>
        @endfor
      </section>

      <section id="eventList" data-page="bookmark" class="mb-12 grid grid-cols-3 gap-12">
        @foreach ($bookmarks as $bookmark)
          <x-event-card :event="$bookmark" />
        @endforeach

        <p id="bookmark-empty" class="col-span-3 text-center text-gray-400 {{ $bookmarks->isEmpty() ? '' : 'hidden' }}">
          Tidak ada event ditemukan...
        </p>
      </section>
    </main>
  </div>
</body>
</html>
