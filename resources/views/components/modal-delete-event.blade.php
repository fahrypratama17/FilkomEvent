<div
  id="delete-modal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-white/65 backdrop-blur-[1px]"
>
  <div
    class="relative h-82.5 w-190 max-w-[calc(100vw-48px)]"
  >

    <div class="absolute bottom-0 left-0 h-65 w-full overflow-hidden rounded-[14px] bg-linear-to-r from-[#08B9D5] to-[#1F388B] shadow-[0_20px_35px_rgba(0,0,0,0.30)]">

      <div class="relative z-10 ml-83.75 flex h-full w-90 flex-col items-center justify-center px-4 pb-7 pt-9 text-center text-white">

        <h2 class="text-[32px] font-black uppercase leading-[1.05] tracking-[5px]">
          FILKO butuh konfirmasimu!
        </h2>

        <p class="mt-3 text-[14px] font-medium leading-tight text-white/95">
          Apakah kamu yakin untuk menghapus Event ini?
        </p>

        <p
          id="delete-event-title"
          class="mt-2 h-4.5 max-w-75 truncate text-[12px] font-semibold text-white/80"
        ></p>

        <div class="mt-5 flex items-center justify-center gap-7">

          <button
            type="button"
            id="close-delete-modal"
            class="h-9.5 w-29 rounded-lg bg-[#FF642B] text-[14px] font-bold text-white"
          >
            Batal
          </button>

          <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')

            <button
              type="submit"
              class="h-9.5 w-29 rounded-lg bg-[#E92222] text-[14px] font-bold text-white"
            >
              Hapus
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
