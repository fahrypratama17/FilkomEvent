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

    @include('components.sidebar-mahasiswa', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="flex-1 overflow-y-auto px-[42px] py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="mb-6 flex items-center gap-5">
          <div class="flex h-[92px] w-[92px] items-center justify-center overflow-hidden rounded-2xl bg-transparent">

          </div>
          <h1 class="text-[54px] font-extrabold leading-none tracking-tight text-black">
            My <span class="text-[#FF742E]">Bookmarks</span>
          </h1>
        </div>

        <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <x-search-bar />

      <section id="eventList" class="mb-12 grid grid-cols-3 gap-12">
        @foreach ($bookmarks as $bookmark)
          <x-event-card :event="$bookmark" />
        @endforeach
      </section>
    </main>
  </div>
</body>
</html>
