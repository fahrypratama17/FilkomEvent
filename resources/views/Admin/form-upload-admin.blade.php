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
<body class="min-h-screen bg-[#FAFAFA] font-sans text-[#06005D]">
<div class="flex min-h-screen">

  {{-- SIDEBAR --}}
  <aside class="fixed left-0 top-0 h-screen w-[326px] bg-[#263F92] px-[46px] py-[46px] text-white">
    <div class="mb-[44px]">
      <div class="flex items-center gap-3">
        <div class="flex h-[48px] w-[48px] items-center justify-center rounded-xl bg-[#FF5F2A]">
          <i data-lucide="calendar-days" class="h-7 w-7 text-white"></i>
        </div>

        <div class="leading-none">
          <h1 class="text-[28px] font-extrabold tracking-tight">FILKOM</h1>
          <p class="text-[23px] font-extrabold tracking-tight">EVENT</p>
        </div>
      </div>
    </div>

    <nav>
      <h2 class="mb-[28px] text-[22px] font-extrabold tracking-wide">MAIN MENU</h2>

      <div class="space-y-[30px]">
        <a href="{{ url('/admin/dashboard') }}"
           class="flex items-center gap-[28px] text-[18px] font-medium text-white/80">
          <i data-lucide="home" class="h-[24px] w-[24px]"></i>
          <span>Dashboard</span>
        </a>

        <a href="#" class="flex items-center gap-[28px] text-[18px] font-bold text-white">
          <i data-lucide="calendar-days" class="h-[24px] w-[24px]"></i>
          <span>Events</span>
        </a>
      </div>

      <h2 class="mb-[28px] mt-[220px] text-[22px] font-extrabold tracking-wide">SETTING</h2>

      <div class="space-y-[30px]">
        <form method="POST" action="{{ url('/logout') }}">
          @csrf
          <button type="submit" class="flex items-center gap-[28px] text-[18px] font-medium text-white/80">
            <i data-lucide="log-out" class="h-[24px] w-[24px]"></i>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </nav>
  </aside>

  {{-- MAIN CONTENT --}}
  <main class="ml-[326px] min-h-screen w-full px-[47px] py-[50px] relative">

    {{-- CONTAINER TOAST NOTIFICATION (MELAYANG DI POJOK KANAN ATAS) --}}
    <div class="fixed top-[34px] right-[76px] z-50 space-y-4 w-full max-w-[420px]">
      @if(session('success'))
        <div id="toast-success"
             class="flex items-center gap-4 rounded-[20px] border border-[#234E1A] bg-[#C1EEA6] px-6 py-4 text-[#1E3E14] shadow-[0_4px_12px_rgba(0,0,0,0.1)] transition-all duration-300">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#1E3E14]">
            <i data-lucide="check" class="h-5 w-5 text-[#C1EEA6]"></i>
          </div>
          <div>
            <h4 class="text-[15px] font-extrabold leading-tight">INFORMASI PENTING!</h4>
            <p class="text-[13px] font-bold opacity-90">{{ session('success') }}</p>
          </div>
        </div>
      @endif

      @if(session('error'))
        <div id="toast-error"
             class="flex items-center gap-4 rounded-[20px] border border-[#A71919] bg-[#F7A4A4] px-6 py-4 text-[#640505] shadow-[0_4px_12px_rgba(0,0,0,0.1)] transition-all duration-300">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#640505]">
            <i data-lucide="x" class="h-5 w-5 text-[#F7A4A4]"></i>
          </div>
          <div>
            <h4 class="text-[15px] font-extrabold leading-tight">INFORMASI PENTING!</h4>
            <p class="text-[13px] font-bold opacity-90">{{ session('error') }}</p>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div id="toast-validation"
             class="flex items-center gap-4 rounded-[20px] border border-[#A71919] bg-[#F7A4A4] px-6 py-4 text-[#640505] shadow-[0_4px_12px_rgba(0,0,0,0.1)] transition-all duration-300">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#640505]">
            <i data-lucide="x" class="h-5 w-5 text-[#F7A4A4]"></i>
          </div>
          <div>
            <h4 class="text-[15px] font-extrabold leading-tight">INFORMASI PENTING!</h4>
            <p class="text-[13px] font-bold opacity-90">Pengisian Form Belum Sesuai</p>
          </div>
        </div>
      @endif
    </div>

    <!-- {{-- TOP USER ICON --}}
    <div class="absolute right-[76px] top-[34px]">
                <div class="flex h-[56px] w-[56px] items-center justify-center rounded-full bg-[#263F92]">
                    <i data-lucide="user-round" class="h-[27px] w-[27px] text-[#FF5F2A]"></i>
                </div>
            </div> -->

    {{-- HEADER --}}
    <div class="mb-[30px] flex items-center gap-[23px]">
      <div class="h-[70px] w-[70px] overflow-hidden">
        <img
          src="{{ asset('icon/mascot.png') }}"
          alt="Mascot"
          class="h-full w-full object-contain"
          onerror="this.style.display='none'"
        >
      </div>

      <h1 class="text-[40px] font-extrabold leading-none text-black">
        Event <span class="text-[#FF5F2A]">Management!</span>
      </h1>
    </div>

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

{{-- ==================== JAVASCRIPT LOGIC CENTER ==================== --}}
{{-- JS moved to resources/js/formUploadAdmin.js --}}
</body>
</html>
