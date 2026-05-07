<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Riwayat</title>
</head>
<body>
  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebar-mahasiswa', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="relative flex-1 overflow-y-auto px-12 py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="flex items-center gap-5">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
          <div class="relative overflow-hidden shimmer bg-linear-to-r from-secondary-lighter via-white/40 to-white/80 p-4 rounded-4xl backdrop-blur-3xl">
            <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
              Riwayat <span class="text-[#FF742E]">Partisipasi</span>
            </h1>
          </div>
        </div>

        <button onclick="location.href='{{ route('profile') }}'" class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <!-- <x-search-bar /> -->

      <section class="mb-9 rounded-[30px] bg-[#00B4D8] p-8 shadow-sm">
        <h2 class="mb-6 text-2xl font-bold text-white">Filter & Cari</h2>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-white">Kategori Event</label>
                <div class="relative">
                    <select name="category" class="w-full h-12 rounded-xl border-none bg-white px-4 pr-10 text-sm text-[#FF742E] focus:ring-2 focus:ring-orange-300 appearance-none cursor-pointer font-semibold">
                        <option value="">Semua Kategori</option>
                        <option value="seminar">Seminar</option>
                        <option value="lomba">Lomba</option>
                        <option value="workshop">Workshop</option>
                        <option value="webinar">Webinar</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#FF742E]">
                        <i data-lucide="chevron-down" class="h-5 w-5"></i>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-white">Status Event</label>
                <div class="relative">
                    <select name="status" class="w-full h-12 rounded-xl border-none bg-white px-4 pr-10 text-sm text-[#FF742E] focus:ring-2 focus:ring-orange-300 appearance-none cursor-pointer font-semibold">
                        <option value="">Semua Status</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Sedang Berlangsung">Sedang Berlangsung</option>
                        <option value="Akan Datang">Akan Datang</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#FF742E]">
                        <i data-lucide="chevron-down" class="h-5 w-5"></i>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-white">Pencarian Event</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[#FF742E]">
                        <i data-lucide="search" class="h-5 w-5"></i>
                    </div>
                    <input 
                        type="text" 
                        placeholder="Cari berdasarkan nama Event" 
                        class="w-full h-12 rounded-xl border-none bg-white pl-11 pr-4 text-sm placeholder:text-orange-200 focus:ring-2 focus:ring-orange-300 font-semibold"
                    >
                </div>
            </div>
        </div>
      </section>

      <section class="pb-6">
        <div class="grid grid-cols-1 gap-6">
            @forelse ($registrations as $reg)
              <article class="flex items-center justify-between rounded-[30px] bg-[#0077B6] p-8 shadow-md border border-white/10 hover:scale-[1.01] transition-all duration-300">
                  <div class="flex items-start gap-6">
                      <div class="flex flex-col justify-center">
                          <div class="flex items-center gap-3 mb-1">
                              <h3 class="text-2xl font-bold text-white">{{ $reg->event->title }}</h3>

                              <!-- Badge status event -->
                              @php
                                  $eventStatus = $reg->event->status ?? 'Selesai'; // Logika status event dari DB
                                  $statusClass = $eventStatus == 'Selesai' ? 'bg-[#03045E]' : 'bg-[#023E8A]';
                              @endphp
                              <span class="px-4 py-1 rounded-full text-[12px] font-medium text-white {{ $statusClass }}">
                                  {{ $eventStatus }}
                              </span>
                          </div>

                          <p class="text-white/80 text-sm mb-3">
                              {{ $reg->event->event_start ? \Carbon\Carbon::parse($reg->event->event_start)->format('d M, Y') : 'TBA' }}
                          </p>

                          <p class="text-white/90 text-sm line-clamp-2 max-w-2xl leading-relaxed">
                              {{ $reg->event->short_description ?? Str::limit($reg->event->description, 150) }}
                          </p>
                      </div>
                  </div>

                  <!-- Kolom tombol dinamis sesuai dengan status event yang diikuti -->
                  <div class="flex flex-col items-end min-w-[200px]">
                      @if($eventStatus == 'Selesai' && $reg->event->certificate_path)
                          <button class="flex items-center gap-3 rounded-xl bg-[#03045E] px-6 py-3 text-white font-bold hover:bg-[#023E8A] transition shadow-lg w-full justify-center">
                              <i data-lucide="download" class="w-5 h-5"></i>
                              Download Certificate
                          </button>
                      @elseif($eventStatus == 'Sedang Berlangsung')
                          <button class="flex items-center gap-3 rounded-xl bg-[#023E8A] px-6 py-3 text-white font-bold hover:bg-[#03045E] transition shadow-lg w-full justify-center">
                              <i data-lucide="eye" class="w-5 h-5"></i>
                              See Details
                          </button>
                      @else
                          <button disabled class="rounded-xl bg-[#023E8A]/50 px-6 py-3 text-white/50 font-bold cursor-not-allowed w-full text-center">
                              Not Available
                          </button>
                      @endif
                  </div>
              </article>


            @empty
                <!-- Tampilan Ketika Pengguna Belum Memiliki Riwayat -->
                <div class="flex flex-col items-center justify-center py-20 bg-white rounded-[30px] shadow-sm border border-dashed border-gray-300">
                    <div class="p-4 bg-gray-50 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-400">Belum Ada Riwayat Partisipasi</h3>
                    <p class="text-sm text-gray-400 mt-2 text-center">Sepertinya kamu belum mendaftar di event manapun.<br>Yuk, eksplorasi event seru di FILKOM!</p>

                    <a href="/events" class="mt-8 px-8 py-3 bg-[#FF742E] text-white font-bold rounded-2xl hover:bg-orange-600 transition shadow-lg active:scale-95">
                        Cari Event Sekarang
                    </a>
                </div>
            @endforelse
        </div>
      </section>
    </main>
  </div>
  @include('components.certificate-processing-modal')
</body>
</html>
