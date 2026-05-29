<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Riwayat Partisipasi</title>
</head>
<body class="min-h-screen bg-[#FAFAFA] font-sans text-[#06005D]">
  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    
    {{-- DOT MATRIX BACKGROUND OVERLAY --}}
    <div class="absolute w-full h-full opacity-5 pointer-events-none"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    {{-- SIDEBAR COMPONENT --}}
    @include('components.sidebar', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    {{-- MAIN CONTAINER --}}
    <main class="relative flex-1 overflow-y-auto px-[47px] py-[50px]">
      
      {{-- HEADER SECTION --}}
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="flex items-center gap-5">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-xl animate-bounce-slow">
          <div class="p-4 bg-white/40 rounded-3xl backdrop-blur-3xl border border-white/20 shadow-sm">
            <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
              Riwayat <span class="text-[#FF5F2A]">Partisipasi</span>
            </h1>
          </div>
        </div>

        <button onclick="location.href='{{ route('profile') }}'" class="flex h-[56px] w-[56px] items-center justify-center rounded-full bg-[#263F92] hover:scale-105 transition-all duration-200 shadow-md cursor-pointer group">
          <i data-lucide="user-round" class="w-6 h-6 text-[#FF5F2A] group-hover:text-white transition-colors"></i>
        </button>
      </header>

      {{-- SEARCH BAR COMPONENT --}}
      <div class="mb-6 max-w-[1028px]">
        <x-search-bar />
      </div>

      {{-- FILTER CATEGORY BAR --}}
      <section class="mb-9 max-w-[1028px] bg-white px-6 py-4 rounded-[20px] shadow-sm border border-[#DCDCDC]/60 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <label for="categoryFilter" class="text-[15px] font-extrabold text-[#06005D]">Filter Kategori:</label>
          <div class="relative">
            <select id="categoryFilter" name="category" class="h-10 min-w-[220px] rounded-xl border border-[#D0D0D0] bg-[#F7F7F7] px-4 pr-10 text-[14px] font-bold text-[#555] focus:outline-none appearance-none cursor-pointer focus:ring-2 focus:ring-[#263F92]/20">
              <option value="">Semua Kategori</option>
              @if(isset($categories))
                @foreach ($categories as $category)
                  <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                  </option>
                @endforeach
              @endif
            </select>
            <i data-lucide="chevron-down" class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-500"></i>
          </div>
        </div>
        <div class="text-sm font-bold text-gray-400">Total: {{ $registrations->total() }} Event</div>
      </section>

      {{-- CARD HISTORY CONTAINER (TASK 1: CARDS LAYOUT & RESPONSIVE) --}}
      <section class="pb-12 max-w-[1028px]">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[30px]">
          @forelse ($registrations as $reg)
            @php $event = $reg->event; @endphp
            @if($event)
              <article class="group flex flex-col justify-between overflow-hidden rounded-[24px] border border-[#DCDCDC] bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-md">
                
                {{-- CARD BANNER THUMBNAIL --}}
                <div class="relative h-[160px] w-full bg-gray-200 overflow-hidden">
                  <img src="{{ $event->image_url ? asset($event->image_url) : asset('images/default-event.jpg') }}" 
                       alt="{{ $event->title }}" 
                       class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                  
                  {{-- BADGE KATEGORI --}}
                  <span class="absolute left-4 top-4 rounded-full bg-[#263F92] px-4 py-1 text-[11px] font-extrabold text-white uppercase tracking-wider shadow-sm">
                    {{ $event->category->category_name ?? 'Event' }}
                  </span>
                </div>

                {{-- CARD INNER CONTENT --}}
                <div class="p-6 flex-1 flex flex-col justify-between">
                  <div>
                    {{-- STATUS EVENT BADGE --}}
                    <div class="mb-3 flex items-center justify-between">
                      @php
                        $eventStatus = $event->event_status ?? 'selesai';
                        $statusText = 'Selesai';
                        $badgeStyle = 'bg-gray-100 text-gray-700 ring-gray-600/20';

                        if($eventStatus === 'berlangsung') {
                          $statusText = 'Berlangsung';
                          $badgeStyle = 'bg-blue-50 text-blue-700 ring-blue-600/20';
                        } elseif($eventStatus === 'akan_datang') {
                          $statusText = 'Akan Datang';
                          $badgeStyle = 'bg-green-50 text-green-700 ring-green-600/20';
                        } elseif($eventStatus === 'dibatalkan') {
                          $statusText = 'Dibatalkan';
                          $badgeStyle = 'bg-red-50 text-red-700 ring-red-600/20';
                        }
                      @endphp
                      <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-xs font-bold ring-1 ring-inset {{ $badgeStyle }}">
                        {{ $statusText }}
                      </span>
                      
                      <span class="text-[12px] font-bold text-gray-400">
                        {{ $reg->registration_status ?? 'Registered' }}
                      </span>
                    </div>

                    {{-- JUDUL EVENT --}}
                    <h3 class="text-[18px] font-extrabold text-black line-clamp-2 leading-snug mb-3 group-hover:text-[#FF5F2A] transition-colors duration-200">
                      {{ $event->title }}
                    </h3>

                    {{-- INFORMASI EVENT --}}
                    <div class="space-y-2 text-[13px] text-gray-500 font-semibold mb-6">
                      <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="h-4 w-4 shrink-0 text-[#FF5F2A]"></i>
                        <span>{{ $event->event_start ? \Carbon\Carbon::parse($event->event_start)->translatedFormat('d M Y') : 'TBA' }}</span>
                      </div>
                      <div class="flex items-center gap-2">
                        <i data-lucide="map-pin" class="h-4 w-4 shrink-0 text-[#FF5F2A]"></i>
                        <span class="truncate">{{ $event->location }}</span>
                      </div>
                    </div>
                  </div>

                  {{-- BUTTON ACTIONS CONTROLLER --}}
                  <div class="space-y-2 pt-2 border-t border-gray-100">
                    
                    @if($eventStatus === 'selesai' && $event->certificate)
                      <button class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#FF5F2A] py-2.5 text-center text-sm font-extrabold text-white transition hover:bg-[#e04f1a] shadow-sm active:scale-[0.98]">
                        <i data-lucide="award" class="h-4 w-4"></i>
                        <span>Download Sertifikat</span>
                      </button>
                    @else
                      <div class="w-full rounded-xl bg-gray-50 py-2 text-center text-[12px] font-bold text-gray-400 border border-dashed border-gray-200 uppercase tracking-wider">
                        Sertifikat Belum Tersedia
                      </div>
                    @endif

                    {{-- ADD EVENT DETAIL BUTTON --}}
                    <a href="{{ route('events.show', $event->event_id) }}" 
                       class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-[#263F92] py-2 text-center text-sm font-extrabold text-[#263F92] transition hover:bg-[#263F92]/5 active:scale-[0.98]">
                      <i data-lucide="eye" class="h-4 w-4"></i>
                      <span>Lihat Detail</span>
                    </a>

                  </div>
                </div>
              </article>
            @endif
          @empty
            {{-- EMPTY STATE IF HISTORY IS EMPTY --}}
            <div class="col-span-full flex flex-col items-center justify-center py-20 bg-white rounded-[28px] shadow-sm border border-dashed border-gray-300">
              <div class="p-4 bg-orange-50 rounded-full mb-4 text-[#FF5F2A]">
                <i data-lucide="calendar-x" class="h-12 w-12"></i>
              </div>
              <h3 class="text-xl font-extrabold text-[#06005D]">Belum Ada Riwayat Partisipasi</h3>
              <p class="text-sm text-gray-400 mt-2 text-center max-w-sm px-4">Sepertinya kamu belum pernah mendaftar di event manapun. Yuk, cari dan ikuti event seru sekarang!</p>

              <a href="{{ route('events.index') }}" class="mt-8 px-8 py-3 bg-[#FF5F2A] text-white font-extrabold rounded-full hover:bg-[#e04f1a] transition shadow-md active:scale-95">
                Cari Event Sekarang
              </a>
            </div>
          @endforelse
        </div>

        {{-- RESPONSIVE TAILWIND PAGINATION NAVIGATION --}}
        @if(!$registrations->isEmpty())
          <div class="mt-12 flex justify-center">
            <div class="bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-200">
              {{ $registrations->links() }}
            </div>
          </div>
        @endif
      </section>
    </main>
  </div>

  @include('components.certificate-processing-modal')

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      lucide.createIcons();
    });

    document.getElementById('categoryFilter')?.addEventListener('change', function() {
        const categoryId = this.value;
        window.location.href = `{{ route('history') }}?category=${categoryId}`;
    });
  </script>
</body>
</html>