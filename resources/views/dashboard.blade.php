{{-- resources/views/dashboard.blade.php --}}
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
        $menuItems = [
            ['icon' => 'assets/icons/home.svg', 'label' => 'Dashboard', 'active' => true],
            ['icon' => 'assets/icons/bookmark.svg', 'label' => 'Bookmark', 'active' => false],
            ['icon' => 'assets/icons/history.svg', 'label' => 'History', 'active' => false],
            ['icon' => 'assets/icons/list-event.svg', 'label' => 'List Event', 'active' => false],
        ];

        $settingItems = [
            ['icon' => 'assets/icons/profile.svg', 'label' => 'Profile'],
            ['icon' => 'assets/icons/logout.svg', 'label' => 'Logout'],
        ];

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

    <div class="mx-auto flex min-h-screen w-full max-w-[1440px] overflow-hidden bg-[#EAEAEA]">
        <aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#223E96] px-12 py-8 text-white shadow-sm">
            <div class="mb-14">
                <div class="mb-3 flex items-center gap-3">
                    <img
                        src="{{ asset('assets/logo/logo-filkom.png') }}"
                        alt="Logo Filkom Event"
                        class="w-[140px] object-contain"
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
                        <div class="flex items-center gap-8 text-[24px] {{ $item['active'] ? 'font-bold text-white' : 'text-white/90' }}">
                            <div class="flex h-10 w-10 items-center justify-center">
                                <img
                                    src="{{ asset($item['icon']) }}"
                                    alt="{{ $item['label'] }}"
                                    class="h-8 w-8 object-contain"
                                >
                            </div>
                            <span>{{ $item['label'] }}</span>
                        </div>
                    @endforeach
                </nav>
            </div>

            <div class="mt-auto pt-16">
                <h2 class="mb-8 text-[26px] font-extrabold tracking-wide">SETTING</h2>
                <div class="space-y-8">
                    @foreach ($settingItems as $item)
                        <div class="flex items-center gap-8 text-[24px] text-white/90">
                            <div class="flex h-10 w-10 items-center justify-center">
                                <img
                                    src="{{ asset($item['icon']) }}"
                                    alt="{{ $item['label'] }}"
                                    class="h-8 w-8 object-contain"
                                >
                            </div>
                            <span>{{ $item['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto px-12 py-8">
            <div class="mb-8 flex items-start justify-between gap-6">
                <div class="relative w-full max-w-[660px]">
                    <img
                        src="{{ asset('assets/icons/search.svg') }}"
                        alt="Search"
                        class="pointer-events-none absolute left-6 top-1/2 h-6 w-6 -translate-y-1/2 object-contain"
                    >
                    <input
                        type="text"
                        placeholder="Search here"
                        class="h-14 w-full rounded-xl border-0 bg-[#03479B] pl-16 pr-5 text-lg text-white placeholder:text-white/80 focus:outline-none"
                    >
                </div>

                <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
                    <img
                        src="{{ asset('assets/icons/profile-top.svg') }}"
                        alt="Profile"
                        class="h-7 w-7 object-contain"
                    >
                </button>
            </div>

            <div class="mb-8 flex items-center gap-5">
                <div class="flex h-[78px] w-[78px] items-center justify-center overflow-hidden rounded-2xl bg-white shadow-sm">
                    <img
                        src="{{ asset('assets/mascot/mascot-student.png') }}"
                        alt="Mascot"
                        class="h-full w-full object-contain"
                    >
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
                                        <img
                                            src="{{ asset('assets/icons/event-badge.svg') }}"
                                            alt="Event"
                                            class="h-full w-full object-contain"
                                        >
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
                                <img
                                    src="{{ asset($card['image']) }}"
                                    alt="{{ $card['title'] }}"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'; this.parentElement.classList.add('bg-[#ECECEC]');"
                                >
                            </div>
                        </div>

                        <div class="mb-8 space-y-4 text-[12px] text-white/90">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/icons/participants.svg') }}" alt="Participants" class="h-4 w-4 object-contain">
                                <span>{{ $card['participants'] }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/icons/clock.svg') }}" alt="Time" class="h-4 w-4 object-contain">
                                <span>{{ $card['time'] }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="h-[42px] flex-1 rounded-xl bg-[#FF6A27] text-[14px] font-semibold text-white">
                                Register Now
                            </button>
                            <button class="flex h-[42px] w-[42px] items-center justify-center rounded-xl bg-white shadow-sm">
                                <img src="{{ asset('assets/icons/bookmark-orange.svg') }}" alt="Bookmark" class="h-5 w-5 object-contain">
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
                                    <img src="{{ asset('assets/icons/category.svg') }}" alt="Category" class="h-7 w-7 object-contain">
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
                        <img
                            src="{{ asset('assets/charts/chart-main.png') }}"
                            alt="Chart"
                            class="h-full w-full object-cover"
                            onerror="this.style.display='none'; this.parentElement.classList.add('bg-[#FF6A27]');"
                        >
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
