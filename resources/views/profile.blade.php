{{-- resources/views/profile.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#EAEAEA] text-slate-900">
    @php
        $menuItems = [
            ['icon' => 'assets/icons/home.svg', 'label' => 'Dashboard', 'href' => '/dashboard-design', 'active' => false],
            ['icon' => 'assets/icons/bookmark.svg', 'label' => 'Bookmark', 'href' => '/bookmark-design', 'active' => false],
            ['icon' => 'assets/icons/history.svg', 'label' => 'History', 'href' => '/history-design', 'active' => false],
            ['icon' => 'assets/icons/list-event.svg', 'label' => 'List Event', 'href' => '#', 'active' => false],
        ];

        $settingItems = [
            ['icon' => 'assets/icons/profile.svg', 'label' => 'Profile', 'href' => '/profile-design', 'active' => true],
            ['icon' => 'assets/icons/logout.svg', 'label' => 'Logout', 'href' => '#', 'active' => false],
        ];

        $user = [
            'name' => 'Ahmad Rizki Maulana',
            'role' => 'Mahasiswa',
            'program' => 'Informatics Engineering Student',
            'student_id' => '12694608826',
            'email' => 'ahmad.rizki@company.com',
            'created_at' => '15 January 2024',
            'last_login' => 'Today, 09:30 WIB',
        ];
    @endphp

    <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
        <aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#223E96] px-10 py-8 text-white shadow-sm">
            <div class="mb-12">
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
                        <a href="{{ $item['href'] }}" class="flex items-center gap-8 text-[24px] {{ $item['active'] ? 'font-bold text-white' : 'text-white/90' }}">
                            <div class="flex h-10 w-10 items-center justify-center">
                                <img src="{{ asset($item['icon']) }}" alt="{{ $item['label'] }}" class="h-8 w-8 object-contain">
                            </div>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <main class="flex-1 px-10 py-10">
            <div class="mx-auto max-w-[920px]">
                <section class="overflow-hidden rounded-[18px] bg-white shadow-[0_10px_30px_rgba(0,0,0,0.12)]">
                    <div class="h-[130px] bg-gradient-to-b from-[#C6643E] to-[#2A409B]"></div>

                    <div class="relative px-8 pb-10 pt-12">
                        <div class="absolute left-8 top-0 -translate-y-1/2">
                            <div class="relative h-[116px] w-[116px] rounded-full border-4 border-white bg-[#6FA9FF] shadow-[0_8px_18px_rgba(0,0,0,0.2)]">
                                <img
                                    src="{{ asset('assets/profile/avatar-profile.png') }}"
                                    alt="{{ $user['name'] }}"
                                    class="h-full w-full rounded-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <div class="hidden h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-[#D68267] via-[#A13243] to-[#6E7A7A] text-[34px] font-bold text-white">
                                    AR
                                </div>
                                <span class="absolute bottom-[6px] right-[4px] h-[16px] w-[16px] rounded-full border-2 border-white bg-[#25D366]"></span>
                            </div>
                        </div>

                        <div class="ml-[132px] flex flex-wrap items-center gap-3">
                            <h1 class="text-[24px] font-extrabold text-[#1C2440]">{{ $user['name'] }}</h1>
                            <span class="inline-flex h-[26px] items-center rounded-full bg-[#4F74FF] px-4 text-[13px] font-semibold text-white">
                                {{ $user['role'] }}
                            </span>
                        </div>
                        <p class="ml-[132px] mt-1 text-[14px] text-[#6B7280]">{{ $user['program'] }}</p>

                        <div class="mt-8 border-t border-transparent"></div>

                        <div class="mt-2">
                            <div class="mb-4 flex items-center gap-2 text-[#233E98]">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#FF6A27] text-[12px] font-bold text-white">i</span>
                                <h2 class="text-[16px] font-bold">Account Information</h2>
                            </div>

                            <div class="space-y-5">
                                <div class="rounded-[10px] border border-[#E5E7EB] bg-[#F7F7F7] px-4 py-3">
                                    <div class="mb-2 text-[12px] font-semibold text-[#8A8F9D]">Name</div>
                                    <div class="text-[16px] font-semibold text-[#202938]">{{ $user['name'] }}</div>
                                </div>

                                <div class="rounded-[10px] border border-[#E5E7EB] bg-[#F7F7F7] px-4 py-3">
                                    <div class="mb-2 text-[12px] font-semibold text-[#8A8F9D]">Student ID Number</div>
                                    <div class="text-[16px] font-semibold text-[#202938]">{{ $user['student_id'] }}</div>
                                </div>

                                <div class="rounded-[10px] border border-[#E5E7EB] bg-[#F7F7F7] px-4 py-3">
                                    <div class="mb-2 text-[12px] font-semibold text-[#8A8F9D]">Email</div>
                                    <div class="flex items-center gap-2 text-[16px] font-semibold text-[#202938]">
                                        <span class="text-[#FF6A27]">✉</span>
                                        <span>{{ $user['email'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-6 h-px bg-[#E5E7EB]"></div>

                        <div>
                            <div class="mb-4 flex items-center gap-2 text-[#233E98]">
                                <span class="text-[#FF6A27]">🔒</span>
                                <h2 class="text-[16px] font-bold">Security and Action</h2>
                            </div>

                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <button class="inline-flex h-[46px] min-w-[270px] items-center gap-3 rounded-[10px] border-2 border-[#233E98] bg-white px-5 text-[15px] font-semibold text-[#374151]">
                                    <span class="text-[#FF6A27]">🔑</span>
                                    <span>Change password</span>
                                </button>

                                <button class="inline-flex h-[46px] min-w-[114px] items-center justify-center gap-2 rounded-[10px] border-2 border-[#FF6A27] bg-white px-5 text-[15px] font-semibold text-[#FF3A2F]">
                                    <span>🚪</span>
                                    <span>Logout</span>
                                </button>
                            </div>
                        </div>

                        <div class="my-6 h-px bg-[#E5E7EB]"></div>

                        <div class="flex flex-wrap items-center gap-x-12 gap-y-3 text-[14px] text-[#6B7280]">
                            <div class="flex items-center gap-2">
                                <span class="text-[#FF6A27]">🗓</span>
                                <span>Account created: <strong class="font-bold text-[#202938]">{{ $user['created_at'] }}</strong></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[#FF6A27]">🕒</span>
                                <span>Last login: <strong class="font-bold text-[#202938]">{{ $user['last_login'] }}</strong></span>
                            </div>
                        </div>

                        <div class="mt-14 rounded-bl-[14px] rounded-tl-[14px] border-l-4 border-[#233E98] bg-white shadow-[0_8px_22px_rgba(0,0,0,0.08)]">
                            <div class="flex flex-wrap items-center gap-4 px-6 py-5">
                                <div class="flex h-[44px] w-[44px] items-center justify-center rounded-[10px] bg-[#EEF2FF] text-[20px] text-[#FF6A27]">
                                    📅
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="text-[16px] font-bold text-[#233E98]">Participation History</div>
                                    <div class="text-[14px] text-[#7B8794]">View your activities and activities</div>
                                </div>
                            </div>

                            <div class="px-6 pb-6">
                                <a
                                    href="/history-design"
                                    class="flex h-[46px] w-full max-w-[410px] items-center justify-center rounded-[8px] bg-[#223E96] text-[15px] font-semibold text-white"
                                >
                                    View Participation History
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-14 rounded-[10px] border border-[#BDD3F3] bg-[#EAF3FF] px-5 py-4 text-[#2F3A4B]">
                    <div class="mb-2 flex items-center gap-3">
                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#FF6A27] text-[12px] font-bold text-white">i</span>
                        <h3 class="text-[16px] font-bold">Important Information</h3>
                    </div>
                    <p class="max-w-[760px] pl-8 text-[14px] leading-[1.45] text-[#5B6472]">
                        Identity data such as name, admin ID, and email cannot be changed. To change this data, please contact the system super administrator.
                    </p>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
