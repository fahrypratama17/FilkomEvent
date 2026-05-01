<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - List Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">

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

            <section class="pb-6">
                <div class="grid grid-cols-3 gap-x-4 gap-y-8">
                  @foreach ($events as $event)
                    <article class="w-full h-full flex flex-col gap-4 bg-white/70 backdrop-blur-lg p-4 border-2 border-white rounded-3xl shadow-xl hover:scale-103 hover:shadow-2xl transition-all duration-200">

                      <div class="relative">
                        <img src="{{ asset($event->image_url ?? 'images/default.jpg') }}"
                             alt="{{ $event->title }}"
                             class="w-full h-70 object-cover rounded-2xl">

                        <p class="absolute top-2 left-2 bg-orange-550 p-2 text-[12px] rounded-2xl font-bold">
                          {{ $event->category->category_name ?? 'No Category' }}
                        </p>
                      </div>

                      <div class="flex flex-col gap-2 px-2">
                        <p class="text-black/60">
                          {{ \Carbon\Carbon::parse($event->event_start)->format('d M, Y') }}
                        </p>

                        <h3 class="text-[18px] font-bold">
                          {{ $event->title }}
                        </h3>

                        <p class="text-[14px] font-light line-clamp-2 text-black/60">
                          {{ $event->short_description ?? '-' }}
                        </p>
                      </div>

                      <div class="flex items-center justify-between px-2 text-[14px] mb-8">
                        <p class="flex items-center gap-1">
                          <i data-lucide="UsersRound" class="w-4 h-4 text-orange-550"></i>
                          {{ $event->quota }} participants
                        </p>

                        <p class="flex items-center gap-1">
                          <i data-lucide="Clock" class="w-4 h-4 text-orange-550"></i>
                          <span>{{ \Carbon\Carbon::parse($event->event_start)->format('H:i') }}</span>
                          -
                          <span>{{ \Carbon\Carbon::parse($event->event_end)->format('H:i') }} WIB</span>
                        </p>
                      </div>

                      <div class="flex gap-4 mt-auto">
                        <a href="/events/{{ $event->event_id }}"
                           class="w-full text-center bg-orange-550 px-4 py-2 rounded-2xl cursor-pointer hover:scale-105 text-white duration-300">
                          Detail Event
                        </a>

                        <button class="bg-white p-2 rounded-2xl cursor-pointer hover:scale-105 duration-300">
                          <i data-lucide="Bookmark"></i>
                        </button>
                      </div>

                    </article>
                  @endforeach
                </div>
                <div class="mt-10">
                  {{ $events->links() }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
