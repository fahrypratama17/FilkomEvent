{{-- resources/views/bookmark.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - Bookmark</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#EAEAEA] text-slate-900">
    @php
        $menuItems = [
            ['icon' => 'assets/icons/home.svg', 'label' => 'Dashboard', 'href' => '/dashboard-design', 'active' => false],
            ['icon' => 'assets/icons/bookmark.svg', 'label' => 'Bookmark', 'href' => '/bookmark-design', 'active' => true],
            ['icon' => 'assets/icons/history.svg', 'label' => 'History', 'href' => '#', 'active' => false],
            ['icon' => 'assets/icons/list-event.svg', 'label' => 'List Event', 'href' => '#', 'active' => false],
        ];

        $settingItems = [
            ['icon' => 'assets/icons/profile.svg', 'label' => 'Profile', 'href' => '#'],
            ['icon' => 'assets/icons/logout.svg', 'label' => 'Logout', 'href' => '#'],
        ];

        $bookmarks = [
        [
            'title' => 'App Design',
            'description' => 'Learn App Design from our expert trainer',
            'participants' => '50 participant',
            'time' => '13:00 - 17:00 WIB',
            'image' => 'assets/events/event-1.png',
        ],
        [
            'title' => 'App Design',
            'description' => 'Learn App Design from our expert trainer',
            'participants' => '50 participant',
            'time' => '13:00 - 17:00 WIB',
            'image' => 'assets/events/event-2.png',
        ],
        [
            'title' => 'App Design',
            'description' => 'Learn App Design from our expert trainer',
            'participants' => '50 participant',
            'time' => '13:00 - 17:00 WIB',
            'image' => 'assets/events/event-3.png',
        ],
        [
            'title' => 'App Design',
            'description' => 'Learn App Design from our expert trainer',
            'participants' => '50 participant',
            'time' => '13:00 - 17:00 WIB',
            'image' => 'assets/events/event-4.png',
        ],
        [
            'title' => 'App Design',
            'description' => 'Learn App Design from our expert trainer',
            'participants' => '50 participant',
            'time' => '13:00 - 17:00 WIB',
            'image' => 'assets/events/event-5.png',
        ],
        [
            'title' => 'App Design',
            'description' => 'Learn App Design from our expert trainer',
            'participants' => '50 participant',
            'time' => '13:00 - 17:00 WIB',
            'image' => 'assets/events/event-6.png',
        ],
    ];
    @endphp

    <div class="mx-auto flex min-h-screen w-full max-w-[1440px] overflow-hidden bg-[#EAEAEA]">
        <aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#223E96] px-12 py-8 text-white shadow-sm">
            <div class="mb-14">
                <div class="mb-3">
                    <img
                        src="{{ asset('assets/logo/logo-filkom.png') }}"
                        alt="Logo Filkom Event"
                        class="w-[150px] object-contain"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                    >
                    <div class="hidden leading-none">
                        <div class="text-[30px] font-extrabold tracking-wide">FILKOM</div>
                        <div class="text-[30px] font-extrabold tracking-wide">EVENT</div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="mb-8 text-[26px] font-extrabold tracking-wide">MAIN MENU</h2>
                <nav class="space-y-8">
                    @foreach ($menuItems as $item)
                        <a href="{{ $item['href'] }}" class="flex items-center gap-8 text-[24px] {{ $item['active'] ? 'font-bold text-white' : 'text-white/90' }}">
                            <div class="flex h-10 w-10 items-center justify-center">
                                <img src="{{ asset($item['icon']) }}" alt="{{ $item['label'] }}" class="h-8 w-8 object-contain">
                            </div>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="mt-auto pt-16">
                <h2 class="mb-8 text-[26px] font-extrabold tracking-wide">SETTING</h2>
                <div class="space-y-8">
                    @foreach ($settingItems as $item)
                        <a href="{{ $item['href'] }}" class="flex items-center gap-8 text-[24px] text-white/90">
                            <div class="flex h-10 w-10 items-center justify-center">
                                <img src="{{ asset($item['icon']) }}" alt="{{ $item['label'] }}" class="h-8 w-8 object-contain">
                            </div>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto px-[42px] py-8">
            <div class="mb-8 flex items-start justify-between gap-6">
                <div class="relative w-full max-w-[520px]">
                    <img
                        src="{{ asset('assets/icons/search.svg') }}"
                        alt="Search"
                        class="pointer-events-none absolute left-4 top-1/2 h-6 w-6 -translate-y-1/2 object-contain"
                    >
                    <input
                        type="text"
                        placeholder="Search here"
                        class="h-[55px] w-full rounded-[12px] border-0 bg-[#03479B] pl-14 pr-5 text-[16px] text-white placeholder:text-white/85 focus:outline-none"
                    >
                </div>

                <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
                    <img src="{{ asset('assets/icons/profile-top.svg') }}" alt="Profile" class="h-7 w-7 object-contain">
                </button>
            </div>

            <div class="mb-6 flex items-center gap-5">
                <div class="flex h-[92px] w-[92px] items-center justify-center overflow-hidden rounded-2xl bg-transparent">
                    <img
                        src="{{ asset('assets/mascot/mascot-student.png') }}"
                        alt="Mascot"
                        class="h-full w-full object-contain"
                        onerror="this.style.display='none'; this.parentElement.innerHTML='🦊'; this.parentElement.classList.add('text-[54px]');"
                    >
                </div>
                <h1 class="text-[54px] font-extrabold leading-none tracking-tight text-black">
                    My <span class="text-[#FF742E]">Bookmarks</span>
                </h1>
            </div>

            <section class="pb-6">
                <div class="mx-auto grid max-w-[1040px] grid-cols-2 gap-x-[56px] gap-y-[56px]">
                    @foreach ($bookmarks as $card)
                        <article class="w-full rounded-[24px] bg-[#14B3D8] px-7 py-4 shadow-sm">
                            <div class="flex items-center gap-7">
                                <div class="h-[170px] w-[111px] shrink-0 overflow-hidden rounded-[22px] bg-[#ECECEC]">
                                    <img
                                        src="{{ asset($card['image']) }}"
                                        alt="{{ $card['title'] }}"
                                        class="h-full w-full object-cover"
                                        onerror="this.style.display='none';"
                                    >
                                </div>

                                <div class="min-w-0 flex-1 pt-2">
                                    <h2 class="mb-3 text-[16px] font-bold text-[#032A83]">{{ $card['title'] }}</h2>

                                    <p class="mb-4 max-w-[170px] text-[10px] leading-[1.35] text-[#EAF8FF]">
                                        {{ $card['description'] }}
                                    </p>

                                    <div class="mb-4 space-y-3 text-[10px] text-[#EAF8FF]">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('assets/icons/participants-dark.svg') }}" alt="Participants" class="h-4 w-4 object-contain">
                                            <span>{{ $card['participants'] }}</span>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('assets/icons/clock-dark.svg') }}" alt="Time" class="h-4 w-4 object-contain">
                                            <span>{{ $card['time'] }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <button class="h-[36px] flex-1 rounded-[12px] bg-[#FF6A27] px-5 text-[14px] font-semibold text-white">
                                            See Details
                                        </button>

                                        <button class="flex h-[36px] w-[36px] items-center justify-center rounded-[10px] bg-white shadow-sm">
                                            <img src="{{ asset('assets/icons/bookmark-blue.svg') }}" alt="Bookmark" class="h-5 w-5 object-contain">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8 flex items-center justify-center gap-4">
                    <button class="flex h-[34px] w-[34px] items-center justify-center rounded-[6px] border border-[#C9C9C9] bg-[#EAEAEA]">
                        <img src="{{ asset('assets/icons/arrow-left.svg') }}" alt="Previous" class="h-4 w-4 object-contain">
                    </button>

                    <button class="flex h-[40px] w-[33px] items-center justify-center rounded-[6px] bg-[#233E98] font-semibold text-white">
                        1
                    </button>
                    <button class="text-[#444444]">2</button>
                    <button class="text-[#444444]">3</button>

                    <button class="flex h-[34px] w-[34px] items-center justify-center rounded-[6px] border border-[#C9C9C9] bg-[#EAEAEA]">
                        <img src="{{ asset('assets/icons/arrow-right.svg') }}" alt="Next" class="h-4 w-4 object-contain">
                    </button>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
