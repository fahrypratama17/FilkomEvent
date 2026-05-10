<div id="passwordModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">

  <div class="absolute inset-0 bg-black/40"></div>

  <div class="relative w-full max-w-xl rounded-2xl bg-white p-6 shadow-xl">
    <h2 class="text-2xl font-bold">Ubah Kata Sandi</h2>
    <p class=" mb-4">Untuk keamanan akun Anda, silahkan ubah kata sandi secara berkala</p>

    <form action="{{ route('profile.change-password') }}" method="POST" class="space-y-4">
      @csrf

      <div class="flex flex-col gap-2">
        <label for="" class="font-bold">Kata Sandi Saat Ini</label>
        <input type="password" name="current_password" placeholder="Password lama" class="w-full rounded-2xl border p-2">
      </div>
      <div class="flex flex-col gap-2">
        <label for="" class="font-bold">Kata Sandi Baru</label>
        <input type="password" name="new_password" placeholder="Password baru" class="w-full rounded-2xl border p-2">
        <p><span class="text-red-600">* </span>Minimal 8 karakter</p>
      </div>
      <div class="flex flex-col gap-2">
        <label for="" class="font-bold">Konfirmasi Kata Sandi Baru</label>
        <input type="password" name="new_password_confirmation" placeholder="Konfirmasi password" class="w-full rounded-2xl border p-2">
      </div>

      <div class="flex justify-end gap-2 pt-2">
        <button type="button" id="closePasswordModal" class="group relative overflow-hidden flex py-2  items-center gap-3 rounded-2xl border-2 border-primary-lighter bg-white px-5 text-[15px] font-semibold text-[#374151] cursor-pointer">
          <span class="relative z-10 transition-colors duration-300 group-hover:text-white">Batal</span>
          <span class="absolute inset-0 rounded-xl origin-left scale-x-0 bg-secondary-dark transition-transform duration-300 group-hover:scale-x-100"></span>
        </button>
        <button type="submit" class="group relative overflow-hidden flex py-2  items-center gap-3 rounded-2xl border-2 border-primary-lighter bg-secondary-dark px-5 text-[15px] font-semibold text-white cursor-pointer">
          <span class="relative z-10 transition-colors duration-300 group-hover:text-[#374151]">Simpan</span>
          <span class="absolute inset-0 rounded-xl origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
        </button>
      </div>
    </form>

  </div>
</div>
