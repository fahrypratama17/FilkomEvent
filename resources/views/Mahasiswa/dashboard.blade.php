<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#EAEAEA] text-slate-900">
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
          <div class="mb-8 flex items-start justify-between gap-6">
              <div class="relative w-full max-w-[660px]">

                  <input
                      type="text"
                      placeholder="Search here"
                      class="h-14 w-full rounded-xl border-0 bg-[#03479B] pl-16 pr-5 text-lg text-white placeholder:text-white/80 focus:outline-none"
                  >
              </div>

              <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">

              </button>
          </div>

          <div class="mb-8 flex items-center gap-5">
              <div class="flex h-[78px] w-[78px] items-center justify-center overflow-hidden rounded-2xl bg-white shadow-sm">

              </div>
              <h1 class="text-[60px] font-extrabold leading-none tracking-tight text-black">
                  Welcome, <span class="text-[#FF742E]">Student!</span>
              </h1>
          </div>

          <div class="mb-12 flex items-center justify-end">
              <button class="text-[18px] font-medium text-[#314A9A] underline underline-offset-4">
                  View All
              </button>
          </div>

          <section class="mb-12 grid grid-cols-3 gap-12">
              @foreach ($eventCards as $card)
                  <article class="rounded-[24px] bg-[#0781C4] px-7 py-7 text-white shadow-sm">
                      <div class="mb-8 flex items-start justify-between gap-6">
                          <div class="min-w-0">
                              <div class="mb-10 flex items-center gap-3 text-[12px] text-white/90">
                                  <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#FF742E] p-1">

                                  </div>
                                  <span>{{ $card['date'] }}</span>
                              </div>
                              <h3 class="mb-2 text-[18px] font-bold">{{ $card['title'] }}</h3>
                              <p class="max-w-[140px] text-[11px] leading-[1.45] text-white/90">
                                  {{ $card['description'] }}
                              </p>
                              <span class="mt-3 inline-flex rounded-md bg-[#FF742E] px-4 py-1 text-[10px] font-medium text-white">
                                  {{ $card['tag'] }}
                              </span>
                          </div>

                          <div class="h-[170px] w-[112px] overflow-hidden rounded-[26px] bg-[#ECECEC]">

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
                          <button class="h-[42px] flex-1 rounded-xl bg-[#FF6A27] text-[14px] font-semibold text-white">
                              Register Now
                          </button>
                          <button class="flex h-[42px] w-[42px] items-center justify-center rounded-xl bg-white shadow-sm">

                          </button>
                      </div>
                  </article>
              @endforeach
          </section>

          <section class="grid grid-cols-[308px_1fr] gap-12 pb-6">
              <div class="rounded-[24px] bg-[#0790C7] px-7 py-7 text-white shadow-sm">
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

              <div class="rounded-[24px] bg-[#16B6D9] px-9 py-9 shadow-sm">
                  <div class="mb-9 grid grid-cols-3 gap-9">
                      @foreach ($stats as $item)
                          <div class="flex h-[170px] items-center justify-center rounded-[24px] bg-[#FF6A27] px-6 text-center text-white">
                              <div>
                                  <div class="mb-4 text-[54px] font-extrabold leading-none">{{ $item['value'] }}</div>
                                  <div class="text-[17px] leading-snug">{{ $item['label'] }}</div>
                              </div>
                          </div>
                      @endforeach
                  </div>

                  <div class="h-[210px] overflow-hidden rounded-[28px] bg-[#FF6A27]">

                  </div>
              </div>
          </section>
      </main>
    </div>
</body>
</html>
