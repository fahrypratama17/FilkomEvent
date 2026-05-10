<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Event Registration</title>
</head>
<body>
  <div class="relative flex min-h-screen w-full bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    <main class="relative px-12 py-6">
      <div class="rounded-2xl">
        <div class="">
          <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3 text-primary-dark">
              <i data-lucide="IdCard" class="w-10 h-10 text-orange-550"></i>
              <p class="text-[18px] font-medium">Registrasi Event</p>
            </div>

            <button onclick="location.href='{{ route('profile') }}'" class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
              <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
            </button>
          </div>

          <button onclick="location.href='{{ route('events.index') }}'" class="group relative overflow-hidden text-white font-bold px-8 py-2 rounded-[50px] mb-6 bg-primary-lighter cursor-pointer">
            <span class="relative flex gap-2 z-10 transition-colors duration-300 group-hover:text-secondary-dark">
              <i data-lucide="MoveLeft"></i>
              Kembali ke Daftar Event
            </span>
            <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
          </button>

          <div class="grid grid-cols-[390px_1fr] gap-x-8 pb-8">
            <section class="rounded-2xl border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-6">
              <h2 class="mb-5 text-[18px] font-bold text-[#233E98]">Detail Event</h2>

              <div class="relative mb-4">
                <img src="{{ asset($event->image_url) }}" alt="{{ $event->title }}" class="w-full h-70 object-cover rounded-2xl">
                <p class="absolute top-2 left-2 bg-orange-550 p-2 text-[12px] rounded-2xl font-bold">{{ $event->category->category_name ?? 'No Category' }}</p>
              </div>

              <h3 class="mb-4 text-[16px] font-bold text-[#232323]">{{ $event->title }}</h3>

              <div class="mb-4 space-y-4 text-[14px] text-[#666666]">
                <div class="flex items-start">

                  <div class="w-full flex items-center justify-between">
                    <p class="font-medium text-gray-500">Waktu:</p>
                    <p class="text-gray-500">
                      {{ \Carbon\Carbon::parse($event->event_start)->format('d M Y, H:i') }} -
                      {{ \Carbon\Carbon::parse($event->event_end)->format('H:i') }} WIB
                    </p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <div class="w-full flex items-center justify-between">
                    <p class="font-medium text-gray-500">Tempat:</p>
                    <p>{{ $event->location }}</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <div class="w-full flex items-center justify-between">
                    <p class="font-medium text-gray-500">Kuota:</p>
                    <p>{{ $event->quota }}</p>
                  </div>
                </div>
              </div>

              <div class="border-t border-[#D8D8D8] pt-3">
                <div class="flex items-center justify-between text-[16px]">
                  <span class="text-[#666666]">Biaya Pendaftaran:</span>
                  <span class="font-medium text-[#1E1E1E]">
                    @if($event->is_paid)
                      Rp {{ number_format($event->price, 0, ',', '.') }}
                    @else
                      Gratis
                    @endif
                  </span>
                </div>
              </div>
            </section>

            <section class="rounded-2xl border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-6">
              <h2 class="mb-7 text-[18px] font-bold text-[#233E98]">Formulir Pendaftaran</h2>

              <div class="mb-14 rounded-2xl bg-[#F1F1F1] px-4 py-4">
                <div class="mb-4 text-[14px] font-medium text-[#4D4D4D]">Data Mahasiswa (Otomatis Terisi)</div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                  <div>
                    <label class="mb-2 block text-[14px] text-[#555555]">Nama Lengkap</label>
                    <input
                      type="text"
                      value="{{ $user->name }}"
                      readonly
                      class="w-full py-2.5 rounded-2xl border border-[#D0D0D0] bg-[#F7F7F7] px-3 text-[14px] text-[#666666] focus:outline-none"
                    >
                  </div>
                  <div>
                    <label class="mb-2 block text-[14px] text-[#555555]">Nomor Induk Mahasiswa (NIM)</label>
                    <input
                      type="text"
                      value="{{ $user->nim }}"
                      readonly
                      class="w-full py-2.5 rounded-2xl border border-[#D0D0D0] bg-[#F7F7F7] px-3 text-[14px] text-[#666666] focus:outline-none"
                    >
                  </div>
                </div>

                <div>
                  <label class="mb-2 block text-[14px] text-[#555555]">Email</label>
                  <input
                    type="email"
                    value="{{ $user->email }}"
                    readonly
                    class="w-full py-2.5 rounded-2xl border border-[#D0D0D0] bg-[#F7F7F7] px-3 text-[14px] text-[#666666] focus:outline-none"
                  >
                </div>
              </div>

              <form>
                <div class="mb-24 border-t border-[#D8D8D8] pt-4">
                  <label class="flex items-start gap-3 text-[14px] text-[#555555]">
                    <input type="checkbox" class="mt-0.5 h-4 w-4 rounded border-[#999999] text-[#233E98] focus:ring-0">
                    <p>Saya menyetujui
                      <button type="button" onclick="openTermsModal()" class="font-semibold text-primary-dark underline hover:text-primary-lighter cursor-pointer">syarat dan ketentuan</button>
                      yang berlaku dan bersedia mengikuti seluruh rangkaian acara sesuai dengan jadwal yang telah ditentukan.</p>
                  </label>
                </div>

                <div class="flex w-full items-center gap-3">
                  <button type="button" onclick="history.back()" class="w-full group relative overflow-hidden text-black font-bold px-8 py-4 rounded-[50px] mb-6 bg-white cursor-pointer">
                    <span class="relative flex justify-center z-10 transition-colors duration-300 group-hover:text-white">
                      Kembali ke Detail Event
                    </span>
                    <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-primary-lighter transition-transform duration-300 group-hover:scale-x-100"></span>
                  </button>

                  <button type="button" onclick="" class="w-full group relative overflow-hidden text-white font-bold px-8 py-4 rounded-[50px] mb-6 bg-primary-lighter cursor-pointer">
                    <span class="relative flex justify-center z-10 transition-colors duration-300 group-hover:text-secondary-dark">
                      Daftar Sekarang
                    </span>
                    <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
                  </button>
                </div>
              </form>
            </section>
          </div>
        </div>

        <footer class="mt-auto border-t border-[#D8D8D8] px-6 py-8 text-center text-[15px] text-[#6A6A6A]">
          © 2026 Event Management System. All rights reserved.
        </footer>
      </div>
    </main>
  </div>

  <x-terms-modal/>
</body>
</html>
