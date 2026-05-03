<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - Bookmark</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">

      @include('components.sidebarMahasiswa', [
        'menuItems' => $menuItems,
        'settingItems' => $settingItems
      ])

        <main class="flex-1 overflow-y-auto px-[42px] py-8">
            <div class="mb-8 flex items-start justify-between gap-6">
              <div class="relative w-full max-w-165">
                <i data-lucide="Search" class="absolute bottom-4 left-4 text-gray-400"></i>
                <input
                  type="text"
                  placeholder="Cari Event..."
                  class="h-14 w-full rounded-2xl bg-white border pl-14 pr-5 focus:outline-none text-gray-400 placeholder:text-gray-400 active:ring-1 active:ring-primary-lighter focus:ring-1 focus:ring-primary-lighter transition-all duration-300"
                >
              </div>

                <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">

                </button>
            </div>

            <div class="mb-6 flex items-center gap-5">
                <div class="flex h-[92px] w-[92px] items-center justify-center overflow-hidden rounded-2xl bg-transparent">

                </div>
                <h1 class="text-[54px] font-extrabold leading-none tracking-tight text-black">
                    My <span class="text-[#FF742E]">Bookmarks</span>
                </h1>
            </div>

            <section class="pb-6">
                <div class="mx-auto grid max-w-[1040px] grid-cols-2 gap-x-[56px] gap-y-[56px]">
                    @foreach ($bookmarks as $bookmark)
                    <article class="w-full rounded-[24px] bg-[#14B3D8] px-7 py-4 shadow-sm">
                      <div class="flex items-center gap-7">

                        <!-- IMAGE -->
                        <img src="{{ asset($bookmark->image_url) }}"
                             class="h-[170px] w-[111px] object-cover rounded-[22px]">

                        <div class="flex-1">

                          <!-- TITLE -->
                          <h2 class="mb-3 text-[16px] font-bold text-[#032A83]">
                            {{ $bookmark->title }}
                          </h2>

                          <!-- DESC -->
                          <p class="mb-4 text-[10px] text-[#EAF8FF]">
                            {{ $bookmark->short_description }}
                          </p>

                          <!-- INFO -->
                          <div class="mb-4 text-[10px] text-white">
                            <div>{{ $bookmark->quota }} participants</div>
                            <div>
                              {{ \Carbon\Carbon::parse($bookmark->event_start)->format('H:i') }}
                              -
                              {{ \Carbon\Carbon::parse($bookmark->event_end)->format('H:i') }} WIB
                            </div>
                          </div>

                          <!-- BUTTON -->
                          <div class="flex gap-4">

                            <a href="{{ route('bookmark.toggle', $bookmark->event_id) }}"
                               class="flex-1 bg-orange-500 text-white text-center py-2 rounded-xl">
                              See Details
                            </a>

                            <!-- UNBOOKMARK -->
                            <form action="{{ route('bookmark.toggle', $bookmark->event_id) }}" method="POST">
                              @csrf
                              <button class="bg-white p-2 rounded-xl">
                                ❌
                              </button>
                            </form>

                          </div>

                        </div>
                      </div>
                    </article>
                    @endforeach
                </div>

                <div class="mt-8 flex items-center justify-center gap-4">
                    <button class="flex h-[34px] w-[34px] items-center justify-center rounded-[6px] border border-[#C9C9C9] bg-[#EAEAEA]">

                    </button>

                    <button class="flex h-[40px] w-[33px] items-center justify-center rounded-[6px] bg-[#233E98] font-semibold text-white">
                        1
                    </button>
                    <button class="text-[#444444]">2</button>
                    <button class="text-[#444444]">3</button>

                    <button class="flex h-[34px] w-[34px] items-center justify-center rounded-[6px] border border-[#C9C9C9] bg-[#EAEAEA]">

                    </button>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
