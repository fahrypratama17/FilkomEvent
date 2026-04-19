{{-- resources/views/list-event.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - List Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#EAEAEA] text-slate-900">
    @php
        $menuItems = [
            ['icon' => 'assets/icons/home.svg', 'label' => 'Dashboard', 'href' => '/dashboard-design', 'active' => false],
            ['icon' => 'assets/icons/bookmark.svg', 'label' => 'Bookmark', 'href' => '/bookmark', 'active' => false],
            ['icon' => 'assets/icons/history.svg', 'label' => 'History', 'href' => '/history-design', 'active' => false],
            ['icon' => 'assets/icons/list-event.svg', 'label' => 'List Event', 'href' => '/list-event-design', 'active' => true],
        ];

        $settingItems = [
            ['icon' => 'assets/icons/profile.svg', 'label' => 'Profile', 'href' => '/profile-design'],
            ['icon' => 'assets/icons/logout.svg', 'label' => 'Logout', 'href' => '#'],
        ];

        $events = [
            [
                'title' => 'Tech Innovation Summit 2025',
                'poster_label' => 'WORKSHOP',
                'poster' => 'assets/events/list-event-1.png',
                'schedule' => 'March 15, 2025 • 09:00 WIB',
                'organizer' => 'Computer Science Department',
                'status_primary' => 'Upcoming',
                'status_secondary' => 'Open',
            ],
            [
                'title' => 'Digital Marketing Workshop',
                'poster_label' => 'WORKSHOP',
                'poster' => 'assets/events/list-event-2.png',
                'schedule' => 'March 15, 2025 • 09:00 WIB',
                'organizer' => 'Computer Science Department',
                'status_primary' => 'Ongoing',
                'status_secondary' => 'Full',
            ],
            [
                'title' => 'Tech Innovation Summit 2025',
                'poster_label' => 'WORKSHOP',
                'poster' => 'assets/events/list-event-3.png',
                'schedule' => 'March 15, 2025 • 09:00 WIB',
                'organizer' => 'Computer Science Department',
                'status_primary' => 'Completed',
                'status_secondary' => 'Closed',
            ],
            [
                'title' => 'Tech Innovation Summit 2025',
                'poster_label' => 'WORKSHOP',
                'poster' => 'assets/events/list-event-4.png',
                'schedule' => 'March 15, 2025 • 09:00 WIB',
                'organizer' => 'Computer Science Department',
                'status_primary' => 'Upcoming',
                'status_secondary' => 'Open',
            ],
            [
                'title' => 'Tech Innovation Summit 2025',
                'poster_label' => 'WORKSHOP',
                'poster' => 'assets/events/list-event-5.png',
                'schedule' => 'March 15, 2025 • 09:00 WIB',
                'organizer' => 'Computer Science Department',
                'status_primary' => 'Upcoming',
                'status_secondary' => 'Open',
            ],
            [
                'title' => 'Tech Innovation Summit 2025',
                'poster_label' => 'WORKSHOP',
                'poster' => 'assets/events/list-event-6.png',
                'schedule' => 'March 15, 2025 • 09:00 WIB',
                'organizer' => 'Computer Science Department',
                'status_primary' => 'Upcoming',
                'status_secondary' => 'Open',
            ],
        ];
    @endphp

    <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
        <aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#223E96] px-12 py-8 text-white shadow-sm">
            <div class="mb-14">
                <div class="mb-3 flex items-center gap-3">
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
                            </div>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

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
                        <article class="overflow-hidden rounded-[10px] border border-[#D8D8D8] bg-[#F7F7F7] shadow-sm">
                            <div class="flex h-[170px] items-center justify-center overflow-hidden bg-[#D9D9D9] text-center text-white/80">
                                <div class="hidden h-full w-full items-center justify-center text-[28px] font-medium tracking-wide">
                                    {{ $event['poster_label'] }}
                                </div>
                            </div>

                            <div class="px-4 py-4">
                                <div class="mb-2 flex items-start justify-between gap-3">
                                    <h2 class="max-w-[210px] text-[16px] font-medium leading-[1.45] text-[#2D2D2D]">
                                        {{ $event['title'] }}
                                    </h2>
                                    <div class="space-y-1">
                                        <div class="rounded-full bg-[#4E74FF] px-4 py-[4px] text-center text-[12px] font-medium text-white">
                                            {{ $event['status_primary'] }}
                                        </div>
                                        <div class="rounded-full bg-[#FF6A27] px-4 py-[4px] text-center text-[12px] font-medium text-white">
                                            {{ $event['status_secondary'] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 space-y-3 text-[12px] text-[#666666]">
                                    <div class="flex items-center gap-2">
                                        <span>{{ $event['schedule'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>{{ $event['organizer'] }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <a
                                        href="/detail-event-design"
                                        class="flex h-[38px] flex-1 items-center justify-center rounded-[6px] bg-[#233E98] text-[14px] font-medium text-white"
                                    >
                                        See Details
                                    </a>
                                    <button class="flex h-[38px] w-[38px] items-center justify-center rounded-[6px] bg-[#233E98] shadow-sm">
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</body>
</html>
