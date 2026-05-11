<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Event Payments</title>
</head>
<body>
  <div class="relative flex min-h-screen w-full bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    <main class="relative px-12 py-6">
      <div class="rounded-2xl">
        <div>
          <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-3 text-primary-dark">
              <i data-lucide="Wallet" class="w-10 h-10 text-orange-550"></i>
              <p class="text-[18px] font-medium">Pembayaran Event</p>
            </div>

            <button onclick="location.href='{{ route('profile') }}'" class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 cursor-pointer shadow-2xl">
              <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
            </button>
          </div>

          <button onclick="location.href='{{ route('events.index') }}'" class="group relative overflow-hidden text-white font-bold px-8 py-2 rounded-[50px] mb-6 bg-primary-lighter cursor-pointer shadow-2xl">
            <span class="relative flex gap-2 z-10 transition-colors duration-300 group-hover:text-secondary-dark">
              <i data-lucide="MoveLeft"></i>
              Kembali ke Daftar Event
            </span>
            <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
          </button>

          <div class="grid grid-cols-[3fr_1fr] gap-x-7 pb-8">
            <div class="flex flex-col gap-6">
              <section class="rounded-2xl border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-5 shadow-2xl">
                <h2 class="mb-6 text-[18px] font-bold text-[#233E98]">Detail Pembayaran</h2>

                <div class="space-y-5 text-[#4F4F4F]">
                  <div class="grid grid-cols-[160px_1fr] items-center border-b border-[#E4E4E4] pb-4 text-[14px]">
                    <div>Nama Event:</div>
                    <div class="text-right text-[16px] text-[#2D2D2D]">{{ $event->title }}</div>
                  </div>

                  <div class="grid grid-cols-[160px_1fr] items-center text-[14px]">
                    <div>Total pembayaran:</div>
                    <div class="text-right text-[30px] font-bold leading-none text-[#5A5A5A]">
                      @if($event->is_paid)
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                      @else
                        Gratis
                      @endif</div>
                  </div>

                  <div class="grid grid-cols-[160px_1fr] items-center border-b border-[#E4E4E4] pb-4 text-[14px]">
                    <p>Kode Invoice:</p>
                    <p class="text-right text-[16px] text-[#2D2D2D]">INV-WDM-2025-001</p>
                  </div>
                </div>

                <div class="rounded-2xl border border-[#D9D9D9] bg-[#F3F3F3] px-3 py-3">
                  <div class="grid grid-cols-[1fr_180px] items-center gap-4">
                    <div class="text-[14px] text-[#555555]">Batas Waktu Pembayaran:</div>
                    <div class="text-right">
                      <div class="text-[22px] leading-none text-[#4A4A4A]">{{ \Carbon\Carbon::parse($event->event_start)->format('d M Y') }}</div>
                      <div class="mt-2 text-[14px] text-[#666666]">Pukul {{ \Carbon\Carbon::parse($event->event_start)->format(' H : i') }}</div>
                    </div>
                  </div>
                </div>
              </section>

              <section class="rounded-[10px] border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-5 shadow-2xl">
                <h2 class="mb-6 text-[18px] font-medium text-[#233E98]">
                  Pilih Metode Pembayaran
                </h2>

                <div class="space-y-3">

                  <div onclick="togglePayment('bank')" class="cursor-pointer rounded-2xl border border-[#D8D8D8] bg-[#FBFBFB] px-4 py-4">

                    <div class="flex items-center justify-between">
                      <span class="text-[16px] text-[#333333]">Transfer Bank</span>
                      <i data-lucide="ChevronDown" id="icon-bank" class="transition-transform duration-300"></i>
                    </div>

                    <div id="content-bank" class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out">

                      <div class="mt-4 rounded-2xl border border-[#D9D9D9] bg-[#F7F7F7] px-4 py-4">
                        <div class="mb-3 text-[14px] text-[#666666]">Instruksi Pembayaran</div>

                        <ol class="list-decimal px-4 space-y-2 text-[14px] text-[#5A5A5A]">
                          <li>Buka aplikasi mobile banking atau ATM</li>
                          <li>Pilih menu Transfer atau Pembayaran</li>
                          <li>Masukkan nomor Virtual Account</li>
                          <li>Konfirmasi pembayaran</li>
                        </ol>
                      </div>
                    </div>
                  </div>

                  <div onclick="togglePayment('va')" class="cursor-pointer rounded-2xl border border-[#8F8F8F] bg-[#FBFBFB] px-4 py-4">

                    <div class="flex items-center justify-between">
                      <span class="text-[16px] text-[#333333]">Nomor Virtual Account</span>
                      <i data-lucide="ChevronDown" id="icon-va" class="transition-transform duration-300"></i>
                    </div>

                    <div id="content-va"
                         class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out">

                      <div class="mt-4 rounded-2xl border border-[#D9D9D9] bg-[#F7F7F7] px-4 py-4">

                        <div class="mb-3 text-[14px] text-[#666666]">Nomor VA</div>

                        <div class="mb-4 rounded-2xl border border-[#D9D9D9] bg-[#F3F3F3] px-4 py-3 text-center text-[22px] font-bold text-[#111111]">
                          8077 0001 2345 6789
                        </div>

                        <ol class="list-decimal px-4 space-y-2 text-[14px] text-[#5A5A5A]">
                          <li>Buka mobile banking</li>
                          <li>Pilih transfer</li>
                          <li>Masukkan VA</li>
                          <li>Konfirmasi</li>
                        </ol>

                      </div>
                    </div>
                  </div>

                  <div onclick="togglePayment('ewallet')" class="cursor-pointer rounded-2xl border border-[#D8D8D8] bg-[#FBFBFB] px-4 py-4">

                    <div class="flex items-center justify-between">
                      <span class="text-[16px] text-[#333333]">E-Wallet</span>
                      <i data-lucide="ChevronDown" id="icon-ewallet" class="transition-transform duration-300">⌄</i>
                    </div>

                    <div id="content-ewallet" class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out">
                      <div class="mt-4 text-sm text-gray-500">
                        Pembayaran via GoPay / OVO / DANA (coming soon)
                      </div>
                    </div>
                  </div>

                  <div onclick="togglePayment('qris')" class="cursor-pointer rounded-2xl border border-[#D8D8D8] bg-[#FBFBFB] px-4 py-4">

                    <div class="flex items-center justify-between">
                      <span class="text-[16px] text-[#333333]">QRIS</span>
                      <i data-lucide="ChevronDown" id="icon-qris" class="transition-transform duration-300">⌄</i>
                    </div>

                    <div id="content-qris" class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out">
                      <div class="mt-4 text-sm text-gray-500">
                        Scan QR untuk pembayaran instan
                      </div>
                    </div>
                  </div>

                </div>
              </section>
            </div>

            <aside>
              <section class="mb-10 rounded-2xl border border-[#D9D9D9] bg-[#F7F7F7] px-5 py-5 shadow-2xl">
                <div class="rounded-2xl bg-[#F2F2F2] px-4 py-4 text-[14px] text-[#666666]">
                  <div class="mb-2 flex items-start gap-2">

                    <div>
                      <div class="font-medium text-[#555555]">Catatan Penting:</div>
                      <div class="mt-1 leading-[1.45]">
                        Pembayaran akan diverifikasi secara otomatis dalam 1-2 menit setelah transfer berhasil.
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <button type="button" onclick="history.back()" class="w-full group relative overflow-hidden text-black font-bold px-8 py-2.5 rounded-[50px] mb-6 bg-white cursor-pointer shadow-2xl">
                <span class="relative flex justify-center z-10 transition-colors duration-300 group-hover:text-white">
                  Kembali ke Registrasi Event
                </span>
                <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-primary-lighter transition-transform duration-300 group-hover:scale-x-100"></span>
              </button>
            </aside>
          </div>
        </div>

        <footer class="mt-auto border-t border-[#D8D8D8] px-6 py-8 text-center text-[15px] text-[#6A6A6A]">
          © 2026 Event Management System. All rights reserved.
        </footer>
      </div>
    </main>
  </div>
</body>
</html>
