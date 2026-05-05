<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Profile</title>
</head>
<body>
  <div class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    @include('components.sidebar-mahasiswa', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="flex-1 px-10 py-10">
      <div class="mx-auto max-w-230">
        <section class="overflow-hidden rounded-[18px] bg-white shadow-[0_10px_30px_rgba(0,0,0,0.12)]">
          <div class="h-32.5 bg-linear-to-b from-[#C6643E] to-[#2A409B]"></div>

          <div class="relative px-8 pb-10 pt-8">
            <div class="absolute left-8 top-0 -translate-y-1/2">
              <div class="relative h-29 w-29 overflow-hidden rounded-full border-4 border-white bg-[#6FA9FF] shadow-[0_8px_18px_rgba(0,0,0,0.2)]">
                <img src="{{ asset('icon/boy.svg') }}" alt="Boy">
              </div>
            </div>

            <div class="w-[25%] flex flex-wrap items-center justify-end gap-3">
              <span class="inline-flex h-6.5 items-center rounded-full bg-[#4F74FF] px-4 text-[13px] font-semibold text-white">{{ $user->role }}
              </span>
            </div>

            <div class="mt-10">
              <div class="mb-4 flex items-center gap-2 text-[#233E98]">
                <i data-lucide="CircleAlert" class="text-orange-550"></i>
                <h2 class="text-[16px] font-bold">Informasi Akun</h2>
              </div>

              <div class="space-y-5">
                <div class="rounded-[10px] border border-[#E5E7EB] bg-[#F7F7F7] px-4 py-3">
                  <p class="mb-2 text-[12px] font-semibold text-[#8A8F9D]">Nama Lengkap</p>
                  <p class="text-[16px] font-semibold text-[#202938]">{{ $user->name }}</p>
                </div>

                <div class="rounded-[10px] border border-[#E5E7EB] bg-[#F7F7F7] px-4 py-3">
                  <div class="mb-2 text-[12px] font-semibold text-[#8A8F9D]">Nomor Induk Mahasiswa (NIM)</div>
                  <div class="text-[16px] font-semibold text-[#202938]">{{ $user->nim }}</div>
                </div>

                <div class="rounded-[10px] border border-[#E5E7EB] bg-[#F7F7F7] px-4 py-3">
                  <div class="mb-2 text-[12px] font-semibold text-[#8A8F9D]">Email</div>
                  <div class="flex items-center gap-2 text-[16px] font-semibold text-[#202938]">
                    <i data-lucide="mail" class="text-orange-550"></i>
                    <span>{{ $user->email }}</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="my-6 h-px bg-[#E5E7EB]"></div>

            <div>
              <div class="mb-4 flex items-center gap-2 text-[#233E98]">
                <i data-lucide="LockKeyhole" class="text-orange-550"></i>
                <h2 class="text-[16px] font-bold">Pengaturan Keamanan</h2>
              </div>

              <div class="flex flex-wrap items-center justify-between gap-4">
                <button class="flex py-2.5 min-w-67.5 items-center gap-3 rounded-2xl border-2 border-[#233E98] bg-white px-5 text-[15px] font-semibold text-[#374151] cursor-pointer">
                  <i data-lucide="Wrench"></i>
                  <span>Ubah Kata Sandi</span>
                </button>

                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="group relative overflow-hidden flex py-2.5 min-w-28.5 items-center justify-center gap-2 rounded-2xl border-2 border-[#FF6A27] bg-white px-5 text-[15px] font-semibold text-[#FF3A2F] cursor-pointer">
                    <i data-lucide="LogOut" class="relative z-10 transition-colors duration-300 group-hover:text-white"></i>
                    <span class="relative z-10 transition-colors duration-300 group-hover:text-white">Keluar</span>
                    <span class="absolute inset-0 rounded-xl origin-left scale-x-0 bg-[#FF3A2F] transition-transform duration-300 group-hover:scale-x-100"></span>
                  </button>
                </form>
              </div>
            </div>

            <div class="my-6 h-px bg-[#E5E7EB]"></div>

            <div class="flex flex-wrap items-center gap-x-12 gap-y-3 text-[14px] text-[#6B7280]">
              <div class="flex items-center gap-2">
                <i data-lucide="Calendar1" class="text-orange-550"></i>
                <span>Akun Dibuat: <strong class="font-bold text-[#202938]">{{ $user->created_at }}</strong></span>
              </div>
            </div>

            <div class="mt-14 rounded-bl-[14px] rounded-tl-[14px] border-l-4 border-[#233E98] bg-white shadow-[0_8px_22px_rgba(0,0,0,0.08)]">
              <div class="flex flex-wrap items-center gap-4 px-6 py-5">
                <div class="flex h-[44px] w-[44px] items-center justify-center rounded-[10px] bg-[#EEF2FF] text-[20px] text-[#FF6A27]">
                  📅
                </div>

                <div class="min-w-0 flex-1">
                  <div class="text-[16px] font-bold text-[#233E98]">Riwayat Partisipasi</div>
                  <div class="text-[14px] text-[#7B8794]">Lihat riwayat aktivitas Anda</div>
                </div>
              </div>

              <div class="px-6 pb-6">
                <button onclick="location.href='/history'" class="flex h-11.5 w-full max-w-102.5 items-center justify-center rounded-2xl bg-[#223E96] text-[15px] font-semibold text-white hover:scale-105 duration-300 shadow-xl cursor-pointer"
                >
                  Lihat Riwayat Partisipasi
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>
</body>
</html>
