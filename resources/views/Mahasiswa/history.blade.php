{{-- resources/views/history.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - History</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#EAEAEA] text-slate-900">
    @php
        $menuItems = [
            ['icon' => 'assets/icons/home.svg', 'label' => 'Dashboard', 'href' => '/dashboard-design', 'active' => false],
            ['icon' => 'assets/icons/bookmark.svg', 'label' => 'Bookmark', 'href' => '/bookmark-design', 'active' => false],
            ['icon' => 'assets/icons/history.svg', 'label' => 'History', 'href' => '/history-design', 'active' => true],
            ['icon' => 'assets/icons/list-event.svg', 'label' => 'List Event', 'href' => '#', 'active' => false],
        ];

        $settingItems = [
            ['icon' => 'assets/icons/profile.svg', 'label' => 'Profile', 'href' => '#'],
        ];

        $historyItems = [
            [
                'title' => 'App Design',
                'date' => '15 January 2025 - 16 January 2025',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'event_status' => 'Completed',
                'payment_status' => 'Paid off',
                'action' => 'Download Certificate',
                'action_type' => 'download',
            ],
            [
                'title' => 'App Design',
                'date' => '15 January 2025 - 16 January 2025',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'event_status' => 'Occur',
                'payment_status' => 'Waiting for Payment',
                'action' => 'See Details',
                'action_type' => 'details',
            ],
            [
                'title' => 'App Design',
                'date' => '15 January 2025 - 16 January 2025',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'event_status' => 'Completed',
                'payment_status' => 'Canceled',
                'action' => 'Not Available',
                'action_type' => 'disabled',
            ],
        ];
    @endphp

    <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
        <aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#223E96] px-12 py-8 text-white shadow-sm">
            <div class="mb-14">
                <div class="mb-3">
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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-8 text-[24px] text-white/90">
                            <div class="flex h-10 w-10 items-center justify-center">
                            </div>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto px-[44px] py-8">
            <div class="mb-8 flex items-start justify-between gap-6">
                <div class="relative w-full max-w-[520px]">
                    <input
                        type="text"
                        placeholder="Search here"
                        class="h-[55px] w-full rounded-[12px] border-0 bg-[#03479B] pl-14 pr-5 text-[16px] text-white placeholder:text-white/85 focus:outline-none"
                    >
                </div>

                <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
                </button>
            </div>

            <div class="mb-6 flex items-center gap-5">
                <div class="flex h-[92px] w-[92px] items-center justify-center overflow-hidden rounded-2xl bg-transparent">
                </div>
                <h1 class="text-[54px] font-extrabold leading-none tracking-tight text-black">
                    My <span class="text-[#FF742E]">Histories</span>
                </h1>
            </div>

            <section class="mb-8 rounded-[24px] bg-[#16B6D9] px-[42px] py-[30px] text-white shadow-sm">
                <h2 class="mb-6 text-[28px] font-extrabold">Filters &amp; Search</h2>

                <div class="grid grid-cols-[220px_220px_1fr] gap-x-[52px]">
                    <div>
                        <label class="mb-2 block text-[16px] font-medium text-white/95">Status Event</label>
                        <div class="relative">
                            <select class="h-[44px] w-full appearance-none rounded-[8px] border-0 bg-[#F4F4F4] px-4 pr-10 text-[14px] text-[#FF6A27] focus:outline-none">
                                <option>Semua Status</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-[16px] font-medium text-white/95">Status Pendaftaran</label>
                        <div class="relative">
                            <select class="h-[44px] w-full appearance-none rounded-[8px] border-0 bg-[#F4F4F4] px-4 pr-10 text-[14px] text-[#FF6A27] focus:outline-none">
                                <option>Semua Status</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-[16px] font-medium text-white/95">Pencarian Event</label>
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="Search by event name"
                                class="h-[44px] w-full rounded-[8px] border-0 bg-[#F4F4F4] pl-10 pr-4 text-[14px] text-[#F0A384] placeholder:text-[#F0A384] focus:outline-none"
                            >
                        </div>
                    </div>
                </div>
            </section>

            <section class="pb-6">
                <div class="space-y-6">
                    @foreach ($historyItems as $item)
                        <article class="rounded-[24px] bg-[#0A7EBF] px-12 py-8 text-white shadow-sm">
                            <div class="flex items-start justify-between gap-6">
                                <div class="max-w-[640px]">
                                    <div class="mb-2 flex flex-wrap items-center gap-3">
                                        <h3 class="text-[20px] font-bold">{{ $item['title'] }}</h3>

                                        <span class="inline-flex rounded-full bg-[#050A8F] px-4 py-[5px] text-[12px] font-medium text-white">
                                            {{ $item['event_status'] }}
                                        </span>

                                        <span class="inline-flex rounded-full bg-[#FF6A27] px-4 py-[5px] text-[12px] font-medium text-white">
                                            {{ $item['payment_status'] }}
                                        </span>
                                    </div>

                                    <div class="mb-4 text-[14px] text-white/95">{{ $item['date'] }}</div>

                                    <p class="max-w-[620px] text-[14px] leading-[1.35] text-white/95">
                                        {{ $item['description'] }}
                                    </p>
                                </div>

                                <div class="pt-2">
                                    @if ($item['action_type'] === 'download')
                                        <button
                                            type="button"
                                            onclick="openCertificateModal()"
                                            class="inline-flex h-[40px] min-w-[196px] items-center justify-center gap-3 rounded-[8px] bg-[#050A8F] px-5 text-[14px] font-semibold text-white"
                                        >
                                            <span>{{ $item['action'] }}</span>
                                        </button>
                                    @elseif ($item['action_type'] === 'details')
                                        <button class="inline-flex h-[40px] min-w-[196px] items-center justify-center gap-3 rounded-[8px] bg-[#050A8F] px-5 text-[14px] font-semibold text-white">
                                            <span>{{ $item['action'] }}</span>
                                        </button>
                                    @else
                                        <button class="inline-flex h-[40px] min-w-[196px] items-center justify-center rounded-[8px] bg-[#0C4E9B] px-5 text-[14px] font-medium text-white/95">
                                            {{ $item['action'] }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8 flex items-center justify-center gap-4">
                    <button class="flex h-[34px] w-[34px] items-center justify-center rounded-[6px] border border-[#C9C9C9] bg-[#EAEAEA]">
                    </button>

                    <button class="flex h-[40px] w-[33px] items-center justify-center rounded-[6px] bg-[#233E98] font-semibold text-white">1</button>
                    <button class="text-[#444444]">2</button>
                    <button class="text-[#444444]">3</button>

                    <button class="flex h-[34px] w-[34px] items-center justify-center rounded-[6px] border border-[#C9C9C9] bg-[#EAEAEA]">
                    </button>
                </div>
            </section>
        </main>
    </div>
    @include('components.certificate-processing-modal')

    <script>
        function openCertificateModal() {
            const modal = document.getElementById('certificateProcessingModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeCertificateModal() {
            const modal = document.getElementById('certificateProcessingModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeCertificateModal();
            }
        });
    </script>
</body>
</html>
