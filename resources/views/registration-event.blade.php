{{-- resources/views/registration-event.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - Event Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F3F3F3] text-slate-900">
    @php
        $event = [
            'title' => 'Workshop UI/UX Design 2025',
            'poster' => 'assets/events/registration-event-poster.png',
            'poster_alt' => 'Event Poster',
            'poster_size' => '1200 × 800 pixels',
            'time' => '15 January 2025, 09:00 - 16:00 WIB',
            'place' => 'Campus Auditorium',
            'quota' => '50 participants',
            'fee' => 'Free',
        ];

        $student = [
            'name' => 'Ahmad Rizki Pratama',
            'student_id' => '2021110001',
            'email' => 'ahmad.rizki@student.univ.ac.id',
        ];
    @endphp

    <div class="min-h-screen">
        <main class="mx-auto max-w-[1440px] px-0 pb-0 pt-0">
            <div class="min-h-[1084px] rounded-[4px] border border-[#C9D0D7] bg-[#F5F5F5]">
                <div class="px-[46px] pt-6">
                    <div class="mb-8 flex items-center justify-between">
                        <div class="flex items-center gap-3 text-[#233E98]">
                            <img src="{{ asset('assets/icons/calendar-orange.svg') }}" alt="Event Registration" class="h-6 w-6 object-contain">
                            <span class="text-[18px] font-medium">Event Registration</span>
                        </div>

                        <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
                            <img src="{{ asset('assets/icons/profile-top.svg') }}" alt="Profile" class="h-7 w-7 object-contain">
                        </button>
                    </div>

                    <a
                        href="/dashboard-design"
                        class="mb-6 inline-flex h-[42px] items-center gap-3 rounded-[10px] border border-[#D0D0D0] bg-[#F7F7F7] px-5 text-[16px] text-[#666666]"
                    >
                        <img src="{{ asset('assets/icons/arrow-left-orange.svg') }}" alt="Back" class="h-4 w-4 object-contain">
                        <span>Return to Dashboard</span>
                    </a>

                    <div class="grid grid-cols-[390px_1fr] gap-x-8 pb-8">
                        <section class="rounded-[10px] border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-6">
                            <h2 class="mb-5 text-[18px] font-bold text-[#233E98]">Detail Event</h2>

                            <div class="mb-5 flex h-[265px] items-center justify-center overflow-hidden rounded-[8px] bg-[#5C5C5C]">
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

                            <h3 class="mb-4 text-[16px] font-bold text-[#232323]">{{ $event['title'] }}</h3>

                            <div class="mb-4 space-y-4 text-[14px] text-[#666666]">
                                <div class="flex items-start gap-3">
                                    <img src="{{ asset('assets/icons/calendar-orange.svg') }}" alt="Time" class="mt-1 h-4 w-4 object-contain">
                                    <div><span class="font-medium text-[#4B4B4B]">Time:</span> {{ $event['time'] }}</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <img src="{{ asset('assets/icons/location-orange.svg') }}" alt="Place" class="mt-1 h-4 w-4 object-contain">
                                    <div><span class="font-medium text-[#4B4B4B]">Place:</span> {{ $event['place'] }}</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <img src="{{ asset('assets/icons/users-orange.svg') }}" alt="Quota" class="mt-1 h-4 w-4 object-contain">
                                    <div><span class="font-medium text-[#4B4B4B]">Quota:</span> {{ $event['quota'] }}</div>
                                </div>
                            </div>

                            <div class="border-t border-[#D8D8D8] pt-3">
                                <div class="flex items-center justify-between text-[16px]">
                                    <span class="text-[#666666]">Registration fee:</span>
                                    <span class="font-medium text-[#1E1E1E]">{{ $event['fee'] }}</span>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-[10px] border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-6">
                            <h2 class="mb-7 text-[18px] font-bold text-[#233E98]">Registration Form</h2>

                            <div class="mb-14 rounded-[8px] bg-[#F1F1F1] px-4 py-4">
                                <div class="mb-4 text-[14px] font-medium text-[#4D4D4D]">Student Data (Automatically Filled)</div>

                                <div class="mb-4 grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="mb-2 block text-[14px] text-[#555555]">Full Name</label>
                                        <input
                                            type="text"
                                            value="{{ $student['name'] }}"
                                            readonly
                                            class="h-[42px] w-full rounded-[6px] border border-[#D0D0D0] bg-[#F7F7F7] px-3 text-[14px] text-[#666666] focus:outline-none"
                                        >
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-[14px] text-[#555555]">Student ID Number</label>
                                        <input
                                            type="text"
                                            value="{{ $student['student_id'] }}"
                                            readonly
                                            class="h-[42px] w-full rounded-[6px] border border-[#D0D0D0] bg-[#F7F7F7] px-3 text-[14px] text-[#666666] focus:outline-none"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-[14px] text-[#555555]">Email</label>
                                    <input
                                        type="email"
                                        value="{{ $student['email'] }}"
                                        readonly
                                        class="h-[42px] w-full rounded-[6px] border border-[#D0D0D0] bg-[#F7F7F7] px-3 text-[14px] text-[#666666] focus:outline-none"
                                    >
                                </div>
                            </div>

                            <form>
                                <div class="mb-2 text-[14px] font-medium text-[#233E98]">Reasons/Motivations for Participating in the Event</div>
                                <textarea
                                    rows="6"
                                    placeholder="Explain your reasons and motivations for attending this workshop..."
                                    class="mb-2 w-full rounded-[8px] border border-[#D0D0D0] bg-[#F7F7F7] px-3 py-3 text-[14px] text-[#666666] placeholder:text-[#B0B0C0] focus:outline-none"
                                ></textarea>
                                <div class="mb-6 text-[13px] text-[#8A8A8A]">Minimum 50 characters</div>

                                <div class="mb-24 border-t border-[#D8D8D8] pt-4">
                                    <label class="flex items-start gap-3 text-[14px] text-[#555555]">
                                        <input type="checkbox" class="mt-0.5 h-4 w-4 rounded border-[#999999] text-[#233E98] focus:ring-0">
                                        <span>I agree to the terms and conditions and am willing to participate in all series of events according to the specified schedule.</span>
                                    </label>
                                </div>

                                <div class="border-t border-[#D8D8D8] pt-6">
                                    <div class="flex items-center gap-3">
                                        <a
                                            href="/detail-event-design"
                                            class="inline-flex h-[48px] flex-1 items-center justify-center gap-3 rounded-[8px] border border-[#D0D0D0] bg-[#F7F7F7] px-5 text-[16px] text-[#666666]"
                                        >
                                            <img src="{{ asset('assets/icons/arrow-left-orange.svg') }}" alt="Back" class="h-4 w-4 object-contain">
                                            <span>Return to Detail Event</span>
                                        </a>

                                        <button
                                            type="submit"
                                            class="inline-flex h-[48px] flex-1 items-center justify-center gap-3 rounded-[8px] bg-[#233E98] px-5 text-[16px] font-medium text-white"
                                        >
                                            <img src="{{ asset('assets/icons/register-orange.svg') }}" alt="Register" class="h-5 w-5 object-contain">
                                            <span>Fill in the Registration Form</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <footer class="mt-auto border-t border-[#D8D8D8] px-6 py-8 text-center text-[15px] text-[#6A6A6A]">
                    © 2026 Event Management System. All rights reserved.
                </footer>
            </div>
        </main>
    </div>
</body>
</html>
