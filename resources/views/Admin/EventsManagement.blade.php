<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Event Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#FBFBFB] font-sans antialiased">
    @php
        $statusLabels = [
            'akan_datang' => 'Akan Datang',
            'berlangsung' => 'Sedang Berlangsung',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        $statusClasses = [
            'akan_datang' => 'bg-[#1F388B]',
            'berlangsung' => 'bg-[#1F388B]',
            'selesai' => 'bg-[#16A34A]',
            'dibatalkan' => 'bg-[#E13427]',
        ];
    @endphp

    <section
        class="mx-auto flex min-h-screen w-full overflow-hidden"
        x-data="{
            showDeleteModal: false,
            deleteUrl: '',
            eventTitle: '',
            openDeleteModal(url, title) {
                this.deleteUrl = url;
                this.eventTitle = title;
                this.showDeleteModal = true;
            }
        }"
    >
        {{-- SIDEBAR --}}
        <aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#1F388B] px-12 py-8 text-white shadow-sm">
            <div class="mb-14 flex items-center gap-3">
                <h1 class="text-xl font-bold">Filkom Event</h1>
            </div>

            <div>
                <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">
                    Main Menu
                </h2>

                <nav class="space-y-8">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-8 text-[24px] text-white/70">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.events.index') }}"
                       class="flex items-center gap-8 text-[24px] font-bold text-white underline underline-offset-8">
                        <span>Events</span>
                    </a>

                    <a href="#"
                       class="flex items-center gap-8 text-[24px] text-white/70">
                        <span>User Management</span>
                    </a>
                </nav>
            </div>

            <div class="mt-auto pt-16">
                <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">
                    Setting
                </h2>

                <div class="space-y-8">
                    <a href="#"
                       class="flex items-center gap-8 text-[24px] text-white/90">
                        <span>Profile</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="flex w-full items-center gap-8 text-left text-[24px] text-white/90">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-y-auto bg-white px-12 py-8">
            {{-- TOP BAR --}}
            <div class="mb-8 flex justify-end">
                <button type="button"
                        class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="#F9682A"
                         class="h-8 w-8">
                        <path fill-rule="evenodd"
                              d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                              clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            {{-- HEADER PAGE --}}
            <div class="mb-8 flex items-center gap-5">
                <img src="{{ asset('assets/mascot.png') }}"
                     alt="Mascot"
                     class="w-16"
                     onerror="this.style.display='none'">

                <h1 class="text-[50px] font-extrabold leading-none tracking-tight text-black">
                    Event <span class="text-[#FF742E]">Management!</span>
                </h1>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-xl bg-green-100 px-5 py-4 font-semibold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FILTER & STATS BAR --}}
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-[#223E96]">
                    Total Event: {{ $events->total() }} Events
                </h2>

                <a href="{{ route('admin.events.create') }}"
                   class="flex items-center gap-2 rounded-xl bg-[#223E96] px-6 py-3 font-bold text-white shadow-md transition hover:bg-blue-800 active:scale-95">
                    <span class="text-2xl font-bold text-[#FF742E]">+</span>
                    Add New Event
                </a>
            </div>

            {{-- TABLE CONTAINER --}}
            <div class="rounded-[20px] border border-gray-200 bg-white p-6 shadow-md">
                {{-- FILTER FORM --}}
                <form method="GET" action="{{ route('admin.events.index') }}">
                    {{-- SEARCH BAR --}}
                    <div class="relative mb-8 w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5">
                            <svg class="h-6 w-6 text-white/80"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search here"
                            class="h-16 w-full rounded-xl border-0 bg-[#03479B] pl-16 pr-5 text-xl text-white shadow-inner placeholder:text-white/80 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                    </div>

                    {{-- FILTER ROW --}}
                    <div class="mb-10 flex flex-wrap items-center gap-6 text-[#223E96]">
                        <div class="flex items-center gap-4">
                            <span class="text-lg text-[#404040]">Category:</span>

                            <select
                                name="category_id"
                                class="min-w-[180px] rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md text-[#404040] focus:outline-none"
                            >
                                <option value="">Semua Kategori</option>

                                @forelse($categories as $category)
                                    <option
                                        value="{{ $category->category_id }}"
                                        @selected(request('category_id') == $category->category_id)
                                    >
                                        {{ $category->category_name }}
                                    </option>
                                @empty
                                    <option value="1" @selected(request('category_id') == 1)>Workshop</option>
                                    <option value="2" @selected(request('category_id') == 2)>Lomba</option>
                                    <option value="3" @selected(request('category_id') == 3)>Webinar</option>
                                    <option value="4" @selected(request('category_id') == 4)>Seminar</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="text-lg text-[#404040]">Status:</span>

                            <select
                                name="event_status"
                                class="min-w-[190px] rounded-xl border border-gray-300 bg-white px-4 py-2 pr-8 text-md text-[#404040] focus:outline-none"
                            >
                                <option value="">Semua Status</option>
                                <option value="akan_datang" @selected(request('event_status') === 'akan_datang')>Akan Datang</option>
                                <option value="berlangsung" @selected(request('event_status') === 'berlangsung')>Sedang Berlangsung</option>
                                <option value="selesai" @selected(request('event_status') === 'selesai')>Selesai</option>
                                <option value="dibatalkan" @selected(request('event_status') === 'dibatalkan')>Dibatalkan</option>
                            </select>
                        </div>

                        <button
                            type="submit"
                            class="rounded-xl bg-[#223E96] px-8 py-3 text-md font-bold text-white shadow-sm transition hover:bg-blue-800"
                        >
                            Filter
                        </button>

                        <a
                            href="{{ route('admin.events.index') }}"
                            class="rounded-xl bg-[#E13427] px-8 py-3 text-md font-bold text-white shadow-sm transition hover:bg-red-700"
                        >
                            Clear Filters
                        </a>
                    </div>
                </form>

                {{-- TABLE HEADER --}}
                <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] border-b pb-4 text-center text-sm font-bold text-[#1F388B]">
                    <div class="text-left">Event Title</div>
                    <div>Schedule</div>
                    <div>Event Status</div>
                    <div>Quota</div>
                    <div>Price</div>
                    <div>Category</div>
                    <div>Action</div>
                </div>

                {{-- TABLE BODY --}}
                <div class="divide-y divide-gray-100">
                    @forelse($events as $event)
                        @php
                            $status = $event->event_status;

                            $statusLabel = $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status));
                            $statusClass = $statusClasses[$status] ?? 'bg-[#1F388B]';

                            $start = $event->event_start ? \Carbon\Carbon::parse($event->event_start) : null;
                            $end = $event->event_end ? \Carbon\Carbon::parse($event->event_end) : null;

                            $quotaFilled = $event->quota_filled ?? 0;
                            $quotaTotal = $event->quota ?? 0;

                            $priceText = $event->is_paid
                                ? 'Rp ' . number_format((float) $event->price, 0, ',', '.')
                                : 'Gratis';
                        @endphp

                        <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] items-center py-6 text-center text-sm">
                            <div class="text-left">
                                <p class="font-bold text-gray-800">
                                    {{ $event->title }}
                                </p>

                                <p class="text-xs italic text-gray-400">
                                    By: {{ $event->organizer ?? 'Admin FILKOM' }}
                                </p>
                            </div>

                            <div>
                                <p class="font-semibold">
                                    {{ $start ? $start->format('d M Y') : '-' }}
                                </p>

                                <p class="text-[10px] text-gray-500">
                                    {{ $start ? $start->format('H:i') : '-' }}
                                    -
                                    {{ $end ? $end->format('H:i') : '-' }}
                                </p>
                            </div>

                            <div>
                                <span class="{{ $statusClass }} rounded-full px-4 py-1 text-[10px] font-bold text-white">
                                    {{ $statusLabel }}
                                </span>
                            </div>

                            <div class="font-semibold text-gray-600">
                                {{ $quotaFilled }}/{{ $quotaTotal }}
                            </div>

                            <div class="font-semibold text-gray-600">
                                {{ $priceText }}
                            </div>

                            <div>
                                <span class="rounded-full bg-[#1F388B] px-4 py-1 text-[10px] font-bold text-white">
                                    {{ $event->category->category_name ?? '-' }}
                                </span>
                            </div>

                            <div class="flex justify-center gap-3">
                                <a href="#"
                                   class="text-[#FF742E] transition-colors hover:text-orange-600"
                                   title="Edit event">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="h-6 w-6">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

                                <button
                                    type="button"
                                    class="text-[#223E96] transition-opacity hover:opacity-80"
                                    title="Delete event"
                                    @click="openDeleteModal('{{ route('admin.events.destroy', $event) }}', @js($event->title))"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24"
                                         fill="currentColor"
                                         class="h-6 w-6">
                                        <path fill-rule="evenodd"
                                              d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center">
                            <p class="text-lg font-bold text-[#1F388B]">
                                Belum ada event.
                            </p>

                            <p class="mt-2 text-sm text-gray-500">
                                Klik tombol Add New Event untuk menambahkan event baru.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="mt-8">
                    {{ $events->links() }}
                </div>
            </div>
        </main>

        {{-- DELETE MODAL --}}
        <div
            x-show="showDeleteModal"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-white/70 backdrop-blur-sm"
        >
            <div class="relative flex h-[520px] w-[416px] flex-col items-center justify-center rounded-[40px] bg-[#00A9D8] p-8 text-center text-white shadow-2xl">
                <div class="mb-4 flex justify-center">
                    <img src="{{ asset('assets/img/mascot-filkom.png') }}"
                         alt="Filko Warning"
                         class="w-32"
                         onerror="this.style.display='none'">
                </div>

                <h2 class="mb-3 text-xl font-bold">
                    Apakah kamu yakin untuk menghapus Event ini?
                </h2>

                <p class="mb-6 text-sm font-semibold text-white/90" x-text="eventTitle"></p>

                <div class="mb-8 flex gap-3 rounded-xl bg-white/20 p-4 text-left">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="currentColor"
                             class="h-6 w-6">
                            <path fill-rule="evenodd"
                                  d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-bold">Informasi Penting:</p>
                        <p class="text-xs">
                            Setelah kamu mengklik tombol hapus maka event akan terhapus dari penyimpanan.
                        </p>
                    </div>
                </div>

                <div class="mt-8 flex justify-center gap-4">
                    <button
                        type="button"
                        @click="showDeleteModal = false"
                        class="h-[48px] w-[150px] rounded-xl bg-[#FF742E] font-bold text-white shadow-md transition hover:bg-orange-600 active:scale-95"
                    >
                        Batal
                    </button>

                    <form x-bind:action="deleteUrl" method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="h-[48px] w-[150px] rounded-xl bg-[#E31F26] font-bold text-white shadow-md transition hover:bg-red-700 active:scale-95"
                        >
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
