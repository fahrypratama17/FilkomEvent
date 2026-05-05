<div id="passwordModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">

  <div class="absolute inset-0 bg-black/40"></div>

  <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
    <h2 class="text-lg font-bold mb-4">Ubah Kata Sandi</h2>

    <form  method="POST" class="space-y-4">
      @csrf

      <input type="password" name="current_password" placeholder="Password lama" class="w-full rounded-lg border p-2">
      <input type="password" name="new_password" placeholder="Password baru" class="w-full rounded-lg border p-2">
      <input type="password" name="new_password_confirmation" placeholder="Konfirmasi password" class="w-full rounded-lg border p-2">

      <div class="flex justify-end gap-2 pt-2">
        <button type="button" id="closePasswordModal" class="px-4 py-2 rounded-lg border">
          Batal
        </button>
        <button type="submit" class="px-4 py-2 rounded-lg bg-[#223E96] text-white">
          Simpan
        </button>
      </div>
    </form>

  </div>
</div>
