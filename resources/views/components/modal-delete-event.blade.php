{{-- DELETE CONFIRMATION MODAL --}}
<div
  id="delete-modal"
  class="fixed inset-0 z-[70] hidden items-center justify-center bg-white/65 backdrop-blur-[1px]"
>
  <div
    class="relative h-[330px] w-[760px] max-w-[calc(100vw-48px)] transform-gpu will-change-transform"
  >
    {{-- Mascot --}}
    <img
      src="{{ asset('assets/profile/mascot-filkom.svg') }}"
      alt="Filko Konfirmasi"
      class="absolute left-[18px] top-[-76px] z-20 w-[305px] max-w-[42vw] drop-shadow-[0_20px_22px_rgba(0,0,0,0.35)]"
    >

    {{-- Card --}}
    <div class="absolute bottom-0 left-0 h-[260px] w-full overflow-hidden rounded-[14px] bg-gradient-to-r from-[#08B9D5] to-[#1F388B] shadow-[0_20px_35px_rgba(0,0,0,0.30)]">
      {{-- Decorative circles --}}
      <div class="pointer-events-none absolute right-[52px] top-[25px] h-[78px] w-[78px] rounded-full bg-white/15 shadow-md"></div>
      <div class="pointer-events-none absolute right-[130px] top-[16px] h-[34px] w-[34px] rounded-full bg-white/15 shadow-md"></div>
      <div class="pointer-events-none absolute right-[28px] top-[108px] h-[34px] w-[34px] rounded-full bg-white/15 shadow-md"></div>
      <div class="pointer-events-none absolute right-[110px] bottom-[30px] h-[78px] w-[78px] rounded-full bg-white/15 shadow-md"></div>
      <div class="pointer-events-none absolute left-[330px] top-[64px] h-[104px] w-[104px] rounded-full bg-white/10 shadow-md"></div>
      <div class="pointer-events-none absolute left-[430px] bottom-[84px] h-[36px] w-[36px] rounded-full bg-white/10 shadow-md"></div>

      {{-- Content --}}
      <div class="relative z-10 ml-[335px] flex h-full w-[360px] flex-col items-center justify-center px-4 pb-7 pt-9 text-center text-white">
        <h2 class="text-[32px] font-black uppercase leading-[1.05] tracking-[5px]">
          FILKO butuh<br>
          konfirmasimu!
        </h2>

        <p class="mt-3 text-[14px] font-medium leading-tight text-white/95">
          Apakah kamu yakin untuk<br>
          menghapus Event ini?
        </p>

        <p class="mt-2 h-[18px] max-w-[300px] truncate text-[12px] font-semibold text-white/80" id="delete-event-title"></p>

        {{-- Buttons --}}
        <div class="mt-5 flex items-center justify-center gap-7">
          <button
            type="button"
            id="close-delete-modal"
            class="h-[38px] w-[116px] rounded-[8px] bg-[#FF642B] text-[14px] font-bold text-white shadow-md transition hover:bg-orange-600 active:scale-95"
          >
            Batal
          </button>

          <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')

            <button
              type="submit"
              class="h-[38px] w-[116px] rounded-[8px] bg-[#E92222] text-[14px] font-bold text-white shadow-md transition hover:bg-red-700 active:scale-95"
            >
              Hapus
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
