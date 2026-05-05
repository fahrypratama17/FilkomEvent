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
@php

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
