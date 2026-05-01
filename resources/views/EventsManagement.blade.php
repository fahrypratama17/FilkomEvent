<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Event Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FBFBFB] font-sans antialiased">
    @php
        $menuItems = [
            ['icon' => 'assets/icons/home.svg', 'label' => 'Dashboard', 'active' => false],
            ['icon' => 'assets/icons/bookmark.svg', 'label' => 'Events', 'active' => true],
            ['icon' => 'assets/icons/history.svg', 'label' => 'User Management', 'active' => false],
        ];

        $settingItems = [
            ['icon' => 'assets/icons/profile.svg', 'label' => 'Profile'],
        ];

        $events = [
            ['title' => "Workshop React.js", 'date' => "2024-07-15", 'status' => "Scheduled"],
            ['title' => "Digital Marketing Seminar", 'date' => "2024-07-20", 'status' => "Scheduled"],
            ['title' => "UI/UX Workshop", 'date' => "2024-07-25", 'status' => "Scheduled"],
        ];

        
        $events = [
            [ 
                'title' => 'Workshop Machine Learning',
                'author' => 'By: Dr. Ahmad Rahman',
                'date' => '1 Mei 2026',
                'time' => '09:00 - 16:00',
                'status' => 'Buka',
                'quota' => '45/50',
                'price' => 'Rp150.000',
                'category' => 'Workshop',
                'status_color' => 'bg-[#1F388B]',
                'cat_color' => 'bg-[#1F388B]'

            ],
            [
                'title' => 'Seminar Cybersecurity',
                'author' => 'By: Prof. Sarah Wijaya',
                'date' => '20 Nov 2024',
                'time' => '13:00 - 17:00',
                'status' => 'Occur',
                'quota' => '100/100',
                'price' => 'Gratis',
                'category' => 'Seminar',
                'status_color' => 'bg-[#1F388B]',
                'cat_color' => 'bg-[#1F388B]'
            ],
            [
                'title' => 'Programming Competition',
                'author' => 'By: Tim FILKOM',
                'date' => '25 Nov 2024',
                'time' => '08:00 - 18:00',
                'status' => 'Completed',
                'quota' => '30/30',
                'price' => 'Rp 50.000',
                'category' => 'Kompetisi',
                'status_color' => 'bg-[#1F388B]',
                'cat_color' => 'bg-[#1F388B]'
            ],
        ];
    @endphp

<section class="mx-auto flex min-h-screen w-full overflow-hidden">
    <div class="flex w-82.5 shrink-0 flex-col rounded-r-[26px] bg-[#1F388B] px-12 py-8 text-white shadow-sm">
        <div class="mb-14 flex items-center gap-3">
                <h1 class="">Filkom Event</h1>
        </div>

        <div>
            <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">Main Menu</h2>
            <nav class="space-y-8">
              @foreach ($menuItems as $item)
                <div class="flex items-center gap-8 text-[24px] {{ $item['active'] ? 'font-bold text-white underline underline-offset-8' : 'text-white/70' }}">
                  <span>{{ $item['label'] }}</span>
                </div>
              @endforeach
            </nav>
        </div>

        <div class="mt-auto pt-16">
            <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">Setting</h2>
            <div class="space-y-8">
              @foreach ($settingItems as $item)
                <div class="flex items-center gap-8 text-[24px] text-white/90">
                  <span>{{ $item['label'] }}</span>
                </div>
              @endforeach
              <button class="flex w-full items-center gap-8 text-[24px] text-white/90">
                <span>Logout</span>
              </button>
            </div>
        </div>
    </div>


    <!-- MAIN CONTENT -->
     <div class="flex-1 overflow-y-auto px-12 py-8 bg-white">
    <!-- Search & Profile Top Bar -->
    <div class="mb-8 flex justify-end">
      <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
        <!-- Icon Profile -->
        <img src="{{ asset('assets/icons/profile-white.svg') }}" class="w-6 h-6">
      </button>
    </div>

    <!-- Header Page -->
    <div class="mb-8 flex items-center gap-5">
      <img src="{{ asset('assets/mascot.png') }}" class="w-16">
      <h1 class="text-[50px] font-extrabold leading-none tracking-tight text-black">
        Event <span class="text-[#FF742E]">Management!</span>
      </h1>
    </div>

    <!-- Filter & Stats Bar -->
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-[#223E96]">Total Event: 120 Events</h2>
        <button class="flex items-center gap-2 rounded-xl bg-[#223E96] px-6 py-3 text-white font-bold hover:bg-blue-800 transition">
            <span class="text-xl">+</span> Add New Event
        </button>
    </div>

    <!-- Table Container -->
    <div class="rounded-[20px] border border-gray-200 bg-white p-6 shadow-md">
        <!-- Search Bar -->
        <div class="mb-8 relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-5">
                <!-- Icon Search -->
                <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input 
                type="text" 
                placeholder="Search here" 
                class="h-16 w-full rounded-xl border-0 bg-[#03479B] pl-16 pr-5 text-xl text-white placeholder:text-white/80 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner"
            >
        </div>

        <!-- Filter Row -->
        <div class="mb-10 flex gap-70 items-center justify-start text-[#223E96] font-medium">
            <div class="flex items-center gap-4">
                <span class="text-lg">Category:</span>
                <select class="rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md focus:outline-none min-w-[240px]">
                    <option>Workshop, Seminar, etc</option>
                </select>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-lg">Status:</span>
                <select class="rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md focus:outline-none min-w-[150px]">
                    <option>All status</option>
                </select>
            </div>
            <button class="ml-auto rounded-xl bg-[#E13427] px-8 py-3 text-md font-bold text-white uppercase hover:bg-red-700 transition shadow-sm">
                Clear Filters
            </button>
        </div>

        <!-- Table Header -->
        <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] border-b pb-4 text-center text-sm font-bold text-[#1F388B]">
            <div class="text-left">Event Title</div>
            <div>Schedule</div>
            <div>Event Status</div>
            <div>Quota</div>
            <div>Price</div>
            <div>Category</div>
            <div>Action</div>
        </div>

        <!-- Bagian Table -->
        <div class="divide-y divide-gray-100">
            @foreach($events as $event)
            <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] items-center py-6 text-center text-sm">
                <div class="text-left">
                    <p class="font-bold text-gray-800">{{ $event['title'] }}</p>
                    <p class="text-xs text-gray-400 italic">{{ $event['author'] }}</p>
                </div>
                <div>
                    <p class="font-semibold">{{ $event['date'] }}</p>
                    <p class="text-[10px] text-gray-500">{{ $event['time'] }}</p>
                </div>
                <div>
                    <span class="{{ $event['status_color'] }} rounded-full px-4 py-1 text-[10px] font-bold text-white uppercase">{{ $event['status'] }}</span>
                </div>
                <div class="font-semibold text-gray-600">{{ $event['quota'] }}</div>
                <div class="font-semibold text-gray-600">{{ $event['price'] }}</div>
                <div>
                    <span class="{{ $event['cat_color'] }} rounded-full px-4 py-1 text-[10px] font-bold text-white uppercase">{{ $event['category'] }}</span>
                </div>
                <div class="flex justify-center gap-3">
                    <button class="text-orange-500">✏️</button>
                    <button class="text-red-500">🗑️</button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Dummy -->
        <div class="mt-8 flex justify-end gap-2">
            <button class="h-8 w-8 rounded-lg border border-gray-300 text-gray-400"> < </button>
            <button class="h-8 w-8 rounded-lg bg-[#1F388B] text-white font-bold">1</button>
            <button class="h-8 w-8 rounded-lg border border-gray-300">2</button>
            <button class="h-8 w-8 rounded-lg border border-gray-300">3</button>
            <button class="h-8 w-8 rounded-lg border border-gray-300 text-[#1F388B]"> > </button>
        </div>
    </div>
    </div>
</section>
    
</body>
</html>