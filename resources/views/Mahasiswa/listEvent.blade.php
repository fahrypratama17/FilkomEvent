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
    @include('components.sidebarMahasiswa', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="flex-1 overflow-y-auto px-[44px] py-8">
      <div class="mb-6 flex items-start justify-between gap-6">
        <div class="flex items-center gap-5">
          <div class="flex h-[92px] w-[92px] items-center justify-center overflow-hidden rounded-2xl bg-transparent">
          </div>
          <h1 class="text-[54px] font-extrabold leading-none tracking-tight text-black">
            Student <span class="text-[#FF742E]">Events</span>
          </h1>
        </div>

        <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
        </button>
      </div>

      <div class="mb-12 relative w-full">
        <input
          type="text"
          placeholder="Search here"
          class="h-[54px] w-full rounded-[12px] border-0 bg-[#03479B] pl-14 pr-5 text-[16px] text-white placeholder:text-white/85 focus:outline-none"
        >
      </div>

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

      <section class="mb-12 grid grid-cols-3 gap-12">
        @foreach ($events as $card)
          <x-eventCard :event="$card" />
        @endforeach
      </section>

    </main>
  </div>
</body>
</html>
