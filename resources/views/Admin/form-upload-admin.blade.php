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
  @include('components.toast')
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

      <div class="mb-8 flex max-w-257 items-center justify-center gap-4 px-18.75">
        <div id="stepBadges" class="flex w-full items-center justify-between text-sm font-bold">
          <div class="step-indicator flex items-center gap-2 text-[#FF5F2A] text-xl">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FF5F2A] text-white">1</span>
            <span>Info Utama</span>
          </div>
          <div class="h-0.5 flex-1 bg-gray-300 mx-4 step-line"></div>
          <div class="step-indicator flex items-center gap-2 text-gray-400 text-xl">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-300 text-white">2</span>
            <span>Status & Kontak</span>
          </div>
          <div class="h-0.5 flex-1 bg-gray-300 mx-4 step-line"></div>
          <div class="step-indicator flex items-center gap-2 text-gray-400 text-xl">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-300 text-white">3</span>
            <span>Deskripsi</span>
          </div>
        </div>
      </div>

      <section class="w-full rounded-2xl border border-[#DCDCDC] bg-white p-12 shadow-sm">

        @php
          $isEdit = isset($event) && $event;
        @endphp

        <form action="{{ $isEdit ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
          @csrf
          @if($isEdit)
            @method('PUT')
          @endif

          @include('partials.form-upload.step-1')
          @include('partials.form-upload.step-2')
          @include('partials.form-upload.step-3')

          <div class="flex justify-between gap-5 w-[50%] mx-auto mt-20">
            <button type="button" id="prevBtn" class="hidden group flex-1 relative overflow-hidden border border-primary-dark text-primary-dark font-bold px-8 py-2 w-40 rounded-2xl bg-white cursor-pointer">
              <span class="relative z-10 transition-colors duration-300 group-hover:text-white">Kembali</span>
              <span class="absolute inset-0 rounded-2xl origin-left scale-x-0 bg-primary-dark transition-transform duration-300 group-hover:scale-x-100"></span>
            </button>

            <button type="button" id="nextBtn" class="group flex-1 relative overflow-hidden text-white font-bold px-8 py-2 w-40 rounded-2xl bg-primary-dark cursor-pointer">
              <span class="relative z-10 transition-colors duration-300 group-hover:text-secondary-dark">Selanjutnya</span>
              <span class="absolute inset-0 rounded-2xl origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
            </button>

            <button type="submit" id="submitBtn" class="hidden group flex-1 relative overflow-hidden text-white font-bold px-8 py-2 w-40 rounded-2xl bg-orange-550 cursor-pointer">
              <span class="relative z-10 transition-colors duration-300 group-hover:text-primary-dark">Simpan Event</span>
              <span class="absolute inset-0 rounded-2xl origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
            </button>
          </div>

        </form>
      </section>
    </main>
  </div>
</body>
</html>
