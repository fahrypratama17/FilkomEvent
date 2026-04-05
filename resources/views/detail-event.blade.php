{{-- resources/views/detail-event.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - Detail Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F3F3F3] text-slate-900">
    @php
        $event = [
            'title' => 'AI and Machine Learning Technology Seminar 2025',
            'registration_status' => 'Registration Open',
            'price_label' => 'Free',
            'poster' => 'assets/events/event-detail-poster.png',
            'poster_alt' => 'Event Poster',
            'poster_size' => '1200 × 800 pixels',
            'quota_text' => '180 of 200',
            'quota_percent' => 90,
            'fee' => 'Free',
            'fee_note' => 'There is no registration fee',
            'date_time' => '15 March 2025, 09:00 - 16:00 WIB',
            'location' => 'Auditorium Utama, Building A',
            'quota' => '200 participants',
            'category' => 'Technology & Innovation',
            'description_1' => 'This seminar will discuss the latest developments in Artificial Intelligence and Machine Learning. Participants will gain in-depth insights into the practical applications of AI in various industries.',
            'description_2' => 'This event is aimed at students, researchers, and professionals interested in AI technology. Topics will be presented by leading experts from industry and academia.',
            'goals' => [
                'Understand the basic concepts of AI and Machine Learning',
                'Knowing the practical applications in industry',
                'Networking with professionals',
                'Obtain a certificate of attendance',
            ],
            'organizer' => 'Informatics Engineering Student Association',
            'organizer_subtitle' => 'Indonesian University of Technology',
            'email' => 'hmti@university.ac.id',
            'phone' => '+62 21 1234 5678',
            'instagram' => '@hmti_university',
        ];

        $schedule = [
            ['time' => '09:00 WIB', 'activity' => 'Registration & Coffee Break'],
            ['time' => '10:00 WIB', 'activity' => 'Opening'],
            ['time' => '10:30 WIB', 'activity' => 'Session 1: Introduction to AI', 'speaker' => 'Dr. Ahmad Rizki'],
            ['time' => '12:00 WIB', 'activity' => 'Lunch break'],
            ['time' => '13:30 WIB', 'activity' => 'Session 2: Machine Learning', 'speaker' => 'Prof. Sarah Lestari'],
            ['time' => '15:30 WIB', 'activity' => 'Q&A and Closing'],
        ];

        $speakers = [
            [
                'name' => 'Dr. Ahmad Rizki',
                'role' => 'AI Research Scientist',
                'institution' => 'Google Indonesia',
                'avatar' => 'assets/speakers/speaker-1.png',
                'initials' => 'AR',
            ],
            [
                'name' => 'Prof. Sarah Lestari',
                'role' => 'Machine Learning Expert',
                'institution' => 'Institut Teknologi Bandung',
                'avatar' => 'assets/speakers/speaker-2.png',
                'initials' => 'SL',
            ],
        ];
    @endphp

    <div class="min-h-screen">
        <main class="mx-auto max-w-[1440px] px-[44px] pb-0 pt-0">
            <div class="min-h-[1438px] rounded-[4px] border border-[#C9D0D7] bg-[#F5F5F5]">
                <div class="px-[46px] pt-6">
                    <div class="mb-9 flex items-center justify-between">
                        <div class="flex items-center gap-3 text-[#233E98]">
                            <img src="{{ asset('assets/icons/calendar-orange.svg') }}" alt="Detail Event" class="h-5 w-5 object-contain">
                            <span class="text-[18px] font-medium">Detail Event</span>
                        </div>

                        <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
                            <img src="{{ asset('assets/icons/profile-top.svg') }}" alt="Profile" class="h-7 w-7 object-contain">
                        </button>
                    </div>

                    <div class="grid grid-cols-[1fr_394px] gap-x-8">
                        <div>
                            <a
                                href="/dashboard-design"
                                class="mb-6 inline-flex h-[42px] items-center gap-3 rounded-[10px] border border-[#D0D0D0] bg-white px-5 text-[16px] text-[#666666]"
                            >
                                <img src="{{ asset('assets/icons/arrow-left-orange.svg') }}" alt="Back" class="h-4 w-4 object-contain">
                                <span>Return to Dashboard</span>
                            </a>

                            <h1 class="mb-3 text-[26px] font-extrabold leading-tight text-[#1B1B1B]">
                                {{ $event['title'] }}
                            </h1>

                            <div class="mb-8 flex items-center gap-3">
                                <span class="inline-flex rounded-full bg-[#4E74FF] px-4 py-[5px] text-[13px] font-medium text-white">
                                    {{ $event['registration_status'] }}
                                </span>
                                <span class="inline-flex rounded-full bg-[#FF6A27] px-4 py-[5px] text-[13px] font-medium text-white">
                                    {{ $event['price_label'] }}
                                </span>
                            </div>

                            <div class="mb-8 flex h-[404px] items-center justify-center overflow-hidden rounded-[8px] bg-[#5C5C5C]">
                                <img
                                    src="{{ asset($event['poster']) }}"
                                    alt="{{ $event['poster_alt'] }}"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <div class="hidden flex-col items-center justify-center text-center text-white/90">
                                    <img src="{{ asset('assets/icons/image-placeholder.svg') }}" alt="Poster" class="mb-3 h-10 w-10 object-contain opacity-95">
                                    <div class="text-[18px] font-medium">{{ $event['poster_alt'] }}</div>
                                    <div class="text-[14px] opacity-90">{{ $event['poster_size'] }}</div>
                                </div>
                            </div>

                            <section class="mb-8 rounded-[10px] bg-[#F1F1F1] px-5 py-4">
                                <h2 class="mb-5 text-[18px] font-medium text-[#233E98]">Basic Information</h2>
                                <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                                    <div class="flex items-start gap-3">
                                        <img src="{{ asset('assets/icons/calendar-orange.svg') }}" alt="Date" class="mt-1 h-4 w-4 object-contain">
                                        <div>
                                            <div class="text-[16px] font-medium text-[#303030]">Date &amp; Time</div>
                                            <div class="text-[15px] text-[#6B6B6B]">{{ $event['date_time'] }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <img src="{{ asset('assets/icons/location-orange.svg') }}" alt="Location" class="mt-1 h-4 w-4 object-contain">
                                        <div>
                                            <div class="text-[16px] font-medium text-[#303030]">Location</div>
                                            <div class="text-[15px] text-[#6B6B6B]">{{ $event['location'] }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <img src="{{ asset('assets/icons/users-orange.svg') }}" alt="Quota" class="mt-1 h-4 w-4 object-contain">
                                        <div>
                                            <div class="text-[16px] font-medium text-[#303030]">Quota</div>
                                            <div class="text-[15px] text-[#6B6B6B]">{{ $event['quota'] }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <img src="{{ asset('assets/icons/tag-orange.svg') }}" alt="Category" class="mt-1 h-4 w-4 object-contain">
                                        <div>
                                            <div class="text-[16px] font-medium text-[#303030]">Category</div>
                                            <div class="text-[15px] text-[#6B6B6B]">{{ $event['category'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="mb-8">
                                <h2 class="mb-4 text-[18px] font-medium text-[#233E98]">Event Description</h2>
                                <div class="max-w-[820px] space-y-4 text-[15px] leading-[1.55] text-[#4F4F4F]">
                                    <p>{{ $event['description_1'] }}</p>
                                    <p>{{ $event['description_2'] }}</p>
                                </div>
                            </section>

                            <section class="mb-8">
                                <h2 class="mb-3 text-[18px] font-medium text-[#233E98]">Event Goal</h2>
                                <div class="space-y-2 text-[15px] leading-[1.45] text-[#4F4F4F]">
                                    @foreach ($event['goals'] as $goal)
                                        <div>{{ $goal }}</div>
                                    @endforeach
                                </div>
                            </section>

                            <section class="mb-8">
                                <h2 class="mb-4 text-[18px] font-medium text-[#233E98]">Speaker</h2>
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ($speakers as $speaker)
                                        <div class="flex items-center gap-4 rounded-[8px] border border-[#DBDBDB] bg-[#F8F8F8] px-4 py-4">
                                            <div class="flex h-[64px] w-[64px] shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#EEF2FF] text-[22px] font-bold text-[#233E98]">
                                                <img
                                                    src="{{ asset($speaker['avatar']) }}"
                                                    alt="{{ $speaker['name'] }}"
                                                    class="h-full w-full object-cover"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                                >
                                                <div class="hidden h-full w-full items-center justify-center">{{ $speaker['initials'] }}</div>
                                            </div>
                                            <div>
                                                <div class="text-[16px] font-medium text-[#2D2D2D]">{{ $speaker['name'] }}</div>
                                                <div class="text-[15px] text-[#4F4F4F]">{{ $speaker['role'] }}</div>
                                                <div class="text-[14px] text-[#7A7A7A]">{{ $speaker['institution'] }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <section class="mb-10">
                                <h2 class="mb-4 text-[18px] font-medium text-[#233E98]">Organizer &amp; Contact Person</h2>
                                <div class="rounded-[8px] border border-[#DBDBDB] bg-[#F7F7F7] px-0 py-0">
                                    <div class="flex gap-3 px-0 py-0">
                                        <div class="flex w-[68px] items-start justify-center px-4 pt-5">
                                            <div class="flex h-[48px] w-[48px] items-center justify-center rounded-[8px] bg-[#EFEFEF]">
                                                <img src="{{ asset('assets/icons/building-orange.svg') }}" alt="Organizer" class="h-5 w-5 object-contain">
                                            </div>
                                        </div>
                                        <div class="flex-1 py-4 pr-5">
                                            <div class="mb-3 text-[15px] leading-[1.45] text-[#4F4F4F]">
                                                <div class="font-medium text-[#2D2D2D]">{{ $event['organizer'] }}</div>
                                                <div>{{ $event['organizer_subtitle'] }}</div>
                                            </div>

                                            <div class="space-y-2 text-[15px] text-[#5F5F5F]">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ asset('assets/icons/mail-orange.svg') }}" alt="Email" class="h-4 w-4 object-contain">
                                                    <span>{{ $event['email'] }}</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ asset('assets/icons/phone-orange.svg') }}" alt="Phone" class="h-4 w-4 object-contain">
                                                    <span>{{ $event['phone'] }}</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ asset('assets/icons/instagram-outline.svg') }}" alt="Instagram" class="h-4 w-4 object-contain">
                                                    <span>{{ $event['instagram'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <aside>
                            <section class="mb-6 rounded-[10px] border border-[#DDDDDD] bg-[#F8F8F8] px-[26px] py-[24px]">
                                <h2 class="mb-5 text-[16px] font-medium text-[#2D2D2D]">Event Registration</h2>

                                <div class="mb-1 flex items-center justify-between text-[14px] text-[#666666]">
                                    <span>Quota Available</span>
                                    <span class="text-[#3B3B3B]">{{ $event['quota_text'] }}</span>
                                </div>

                                <div class="mb-5 h-[6px] overflow-hidden rounded-full bg-[#D7D7D7]">
                                    <div class="h-full rounded-full bg-[#233E98]" style="width: {{ $event['quota_percent'] }}%"></div>
                                </div>

                                <div class="mb-1 text-center text-[28px] font-extrabold leading-none text-[#171717]">{{ $event['fee'] }}</div>
                                <div class="mb-5 text-center text-[14px] text-[#777777]">{{ $event['fee_note'] }}</div>

                                <button class="mb-4 inline-flex h-[48px] w-full items-center justify-center gap-3 rounded-[8px] bg-[#233E98] px-5 text-[15px] font-medium text-white">
                                    <img src="{{ asset('assets/icons/register-white.svg') }}" alt="Register" class="h-4 w-4 object-contain">
                                    <span>Register for Event Now</span>
                                </button>

                                <p class="text-center text-[12px] leading-[1.4] text-[#8B8B8B]">
                                    By registering, you agree to the terms and conditions of the event.
                                </p>
                            </section>

                            <section class="mb-6 rounded-[10px] border border-[#DDDDDD] bg-[#F8F8F8] px-[26px] py-[24px]">
                                <h2 class="mb-5 text-[16px] font-medium text-[#2D2D2D]">Event schedule</h2>
                                <div class="space-y-4 text-[14px] text-[#4F4F4F]">
                                    @foreach ($schedule as $item)
                                        <div class="grid grid-cols-[72px_1fr] gap-3 leading-[1.35]">
                                            <div class="text-[#404040]">{{ $item['time'] }}</div>
                                            <div>
                                                <div>{{ $item['activity'] }}</div>
                                                @if (!empty($item['speaker']))
                                                    <div class="text-[13px] text-[#7B7B7B]">{{ $item['speaker'] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <a
                                href="#"
                                class="inline-flex h-[48px] w-full items-center justify-center gap-3 rounded-[8px] border border-[#D0D0D0] bg-[#F8F8F8] px-5 text-[16px] text-[#666666]"
                            >
                                <img src="{{ asset('assets/icons/arrow-left-orange.svg') }}" alt="Back" class="h-4 w-4 object-contain">
                                <span>Return to Event List</span>
                            </a>
                        </aside>
                    </div>
                </div>

                <footer class="mt-[68px] border-t border-[#D8D8D8] px-6 py-7 text-center text-[15px] text-[#6A6A6A]">
                    © 2026 Event Management System. All rights reserved.
                </footer>
            </div>
        </main>
    </div>
</body>
</html>
