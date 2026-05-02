<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Event Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            ['icon' => 'assets/icons/edit.svg', 'label' => 'Edit Events'],
            
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
                'status' => 'Sedang Berlangsung',
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
                'status' => 'Sedang Berlangsung',
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
                'status' => 'Selesai',
                'quota' => '30/30',
                'price' => 'Rp 50.000',
                'category' => 'Lomba',
                'status_color' => 'bg-[#1F388B]',
                'cat_color' => 'bg-[#1F388B]'
            ],
        ];
    @endphp

<section class="mx-auto flex min-h-screen w-full overflow-hidden" x-data="{ showDeleteModal: false, showSuccessModal: false }">
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#F9682A" class="w-8 h-8 text-white">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
            </svg>
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
            <button class="flex items-center gap-2 rounded-xl bg-[#223E96] px-6 py-3 text-white font-bold hover:bg-blue-800 transition shadow-md active:scale-95">
                <span class="text-2xl font-bold text-[#FF742E]">+</span> Add New Event
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
                    class="h-16 w-full rounded-xl border-0 bg-[#03479B] pl-16 pr-5 text-xl text-white placeholder:text-white/80 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner">
            </div>

            <!-- Filter Row -->
            <div class="mb-10 flex gap-70 items-center justify-start text-[#223E96] font-medium">
                <div class="flex items-center gap-4">
                    <span class="text-lg text-[#404040]">Category:</span>
                    <select class="rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md focus:outline-none min-w-[150px] pr-8 text-[#404040]">
                        <option>Semua Kategori</option>
                        <option>Webinar</option>
                        <option>Talkshow</option>
                        <option>Seminar</option>
                        <option>Lomba</option>
                    </select>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-lg text-[#404040]">Status:</span>
                    <select class="rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md focus:outline-none min-w-[100px] pr-8 text-[#404040]">
                        <option>Semua Status</option>
                        <option>Akan Datang</option>
                        <option>Selesai</option>
                        <option>Sedang Berlangsung</option>
                        <option>Dibatalkan</option>
                    </select>
                </div>
                <button class="ml-auto rounded-xl bg-[#E13427] px-8 py-3 text-md font-bold text-white hover:bg-red-700 transition shadow-sm">
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
                        <span class="{{ $event['status_color'] }} rounded-full px-4 py-1 text-[10px] font-bold text-white ">{{ $event['status'] }}</span>
                    </div>
                    <div class="font-semibold text-gray-600">{{ $event['quota'] }}</div>
                    <div class="font-semibold text-gray-600">{{ $event['price'] }}</div>
                    <div>
                        <span class="{{ $event['cat_color'] }} rounded-full px-4 py-1 text-[10px] font-bold text-white ">{{ $event['category'] }}</span>
                    </div>

                    <!-- Icon Edit -->
                    <div class="flex justify-center gap-3">
                        <a href="#" class="text-[#FF742E] hover:text-orange-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>  

                    <!-- Icon Trash atau Tempat Sampah untuk Delete-->
                        <button @click="showDeleteModal = true" type="button" class="text-[#223E96] hover:opacity-80 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg> 
                        </button>
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

    <!-- Overlay Modal -->
    <div x-show="showDeleteModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-white/70 backdrop-blur-sm"
         x-cloak>

        <!-- Box Modal -->
        <div class="relative bg-[#00A9D8] w-[416px] h-[520px] rounded-[40px] p-8 text-center text-white shadow-2xl flex flex-col items-center justify-center">

            <!-- Maskot Filko -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/img/mascot-filkom.png') }}" alt="Filko (WARNING)" class="w-32">
            </div>

            <h2 class="text-xl font-bold mb-6">Apakah kamu yakin untuk menghapus Event ini?</h2>

            <!-- Informasi Penting Box -->
            <div class="bg-white/20 rounded-xl p-4 text-left mb-8 flex gap-3">
                <div class="text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-sm">Informasi Penting:</p>
                    <p class="text-xs">Setelah kamu mengklik tombol hapus maka Event akan terhapus dari penyimpanan.</p>
                </div>
            </div>

                <!-- Tombol Aksi -->
            <div class="flex justify-center gap-4 mt-8">
                <button @click="showDeleteModal = false" type="button"
                    class="w-[150px] h-[48px] bg-[#FF742E] hover:bg-orange-600 rounded-xl font-bold text-white transition shadow-md active:scale-95">
                    Batal
                </button>

                <button @click="showDeleteModal = false; showSuccessModal = true" type="button"
                    class="w-[150px] h-[48px] bg-[#E31F26] hover:bg-red-700 rounded-xl font-bold text-white transition shadow-md active:scale-95">
                    Hapus
                </button>
            </div>
            </div>
        </div>
    </div>

    
    <!-- Success Modal -->
    <div x-show="showSuccessModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-white/70 backdrop-blur-sm"
         x-cloak>

        <!-- Box Modal -->
        <div class="relative bg-[#00A9D8] w-[416px] h-[520px] rounded-[40px] p-8 text-center text-white shadow-2xl flex flex-col items-center justify-center">
            <!-- Maskot Filkom Selebrasi -->
            <div class="mb-8">
                <img src="{{ asset('assets/mascot.png') }}" alt="Yeyy" class="w-40 animate-bounce">
            </div>

            <div class="space-y-2">
                <h2 class="text-3xl font-black tracking-widest">YEYYY!!!</h2>
                <p class="text-xl font-bold">Event Berhasil Dihapus!!!</p>
            </div>

            <!-- Tombol Kembali di Success Modal -->
            <button @click="showSuccessModal = false" 
                class="mt-10 w-[300px] h-[48px] bg-[#FF742E] hover:bg-orange-600 text-white font-bold rounded-xl transition-all shadow-lg active:scale-95">
                Kembali
            </button>
        </div>
    </div>
</section>
    
</body>
</html>