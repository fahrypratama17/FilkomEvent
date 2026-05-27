<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Form Upload Event Admin (Multi-step)</title>
</head>
<body>
  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div
      class="absolute h-full w-full opacity-4"
      style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebar', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="relative flex-1 px-12 py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="mb-12 flex items-center gap-5">
          <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
          <div class="relative overflow-hidden shimmer bg-linear-to-r from-secondary-lighter via-white/40 to-white/80 p-4 rounded-4xl backdrop-blur-3xl">
            <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
              Manajemen <span class="text-[#FF742E]">Event</span>
            </h1>
          </div>
        </div>

        <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      {{-- STEP PROGRESS BAR INDICATOR --}}
      <div class="mb-8 flex max-w-[1028px] items-center justify-center gap-4 px-[75px]">
        <div id="stepBadges" class="flex w-full items-center justify-between text-sm font-bold">
          <div class="step-indicator flex items-center gap-2 text-[#FF5F2A]">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FF5F2A] text-white">1</span>
            <span>Info Utama</span>
          </div>
          <div class="h-[2px] flex-1 bg-gray-300 mx-4 step-line"></div>
          <div class="step-indicator flex items-center gap-2 text-gray-400">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-300 text-white">2</span>
            <span>Status & Kontak</span>
          </div>
          <div class="h-[2px] flex-1 bg-gray-300 mx-4 step-line"></div>
          <div class="step-indicator flex items-center gap-2 text-gray-400">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-300 text-white">3</span>
            <span>Deskripsi</span>
          </div>
        </div>
      </div>

      {{-- FORM CARD --}}
      <section
        class="w-full max-w-[1028px] rounded-[28px] border border-[#DCDCDC] bg-white px-[75px] pb-[47px] pt-[67px] shadow-sm">

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
          @csrf

          @php
            $labelClass = 'mb-[13px] block text-[18px] font-extrabold text-[#06005D]';
            $inputClass = 'h-[48px] w-full rounded-[8px] bg-[#E7E7E7] px-[30px] text-[17px] font-medium text-[#555] outline-none placeholder:text-[#666] focus:ring-2 focus:ring-[#263F92]/30';
            $selectClass = 'h-[48px] w-full appearance-none rounded-[8px] bg-[#E7E7E7] px-[30px] text-[17px] font-medium text-[#555] outline-none focus:ring-2 focus:ring-[#263F92]/30';
            $textareaClass = 'w-full resize-none rounded-[8px] bg-[#E7E7E7] px-[30px] py-[23px] text-[17px] font-medium text-[#555] outline-none placeholder:text-[#666] focus:ring-2 focus:ring-[#263F92]/30';
          @endphp

          @include('partials.form-upload.step-1')
          @include('partials.form-upload.step-2')
          @include('partials.form-upload.step-3')

          {{-- ==================== NAVIGATION BUTTONS ==================== --}}
          <div class="mt-[60px] flex justify-between gap-5 max-w-[573px] mx-auto">
            <button type="button" id="prevBtn"
                    class="hidden h-[48px] flex-1 rounded-full border-2 border-[#050064] text-[17px] font-extrabold text-[#050064] transition hover:bg-gray-100">
              Kembali
            </button>

            <button type="button" id="nextBtn"
                    class="h-[48px] flex-1 rounded-full bg-[#050064] text-[17px] font-extrabold text-white transition hover:bg-[#09008a]">
              Selanjutnya
            </button>

            <button type="submit" id="submitBtn"
                    class="hidden h-[48px] flex-1 rounded-full bg-[#FF5F2A] text-[17px] font-extrabold text-white transition hover:bg-[#e04f1a] shadow-[0_4px_10px_rgba(255,95,42,0.3)]">
              Simpan Event
            </button>
          </div>

        </form>
      </section>
    </main>
  </div>
</body>
</html>
