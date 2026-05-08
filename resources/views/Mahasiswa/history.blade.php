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

      <x-search-bar />

      <section class="mb-9 flex items-end justify-between gap-6">
        <div class="flex items-end justify-between gap-8">
          <div>
            <label class="mb-2 block text-[14px] text-[#4F4F4F]">Kategori:</label>
            <div class="relative">
              <select id="categoryFilter" name="category" class="h-10.5 min-w-63.5 rounded-2xl border border-[#D0D0D0] bg-[#F7F7F7] px-4 pr-18 text-[14px] text-[#2F2F2F] focus:outline-none appearance-none cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->category_id }}">
                    {{ $category->category_name }}
                  </option>
                @endforeach
              </select>
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
