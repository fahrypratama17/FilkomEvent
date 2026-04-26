# Auth Facade Login/Logout - Use Case Testing

Tanggal: 2026-04-26
Scope: Verifikasi perubahan login/logout yang sudah dipindah ke Laravel Auth Facade dan route POST logout.

## Pre-Condition

- Aplikasi berjalan di `http://127.0.0.1:8000`.
- Database MySQL aktif dan terkoneksi.
- Sudah ada minimal 1 akun user valid (bisa buat dari halaman register).

## Data Uji Rekomendasi

- Email valid: user test yang ada di tabel users.
- Password valid: password akun tersebut.
- Password invalid: string random yang salah.

## Use Case 1 - Login Berhasil

Tujuan: memastikan `Auth::attempt()` berjalan normal.

Langkah:
1. Buka `/login`.
2. Isi email valid dan password valid.
3. Klik tombol `Masuk`.

Expected Result:
- Redirect ke `/dashboard`.
- Muncul flash success (jika komponen toast aktif).
- Di browser cookie ada session aktif (`laravel_session`).

## Use Case 2 - Login Gagal (Password Salah)

Tujuan: memastikan autentikasi ditolak saat kredensial salah.

Langkah:
1. Buka `/login`.
2. Isi email valid dan password salah.
3. Klik `Masuk`.

Expected Result:
- Tetap di flow login (tidak masuk dashboard secara autentik).
- Error `Email atau password salah` tersimpan di error bag.

## Use Case 3 - Validasi Field Login

Tujuan: memastikan validasi request login aktif.

Langkah:
1. Buka `/login`.
2. Kosongkan email atau password.
3. Submit form.

Expected Result:
- Request ditolak validasi.
- Tidak berhasil login.

## Use Case 4 - Logout Berhasil dari Sidebar Dashboard

Tujuan: memastikan `Auth::logout()` + invalidate session + regenerate token berjalan.

Langkah:
1. Login dulu sampai masuk `/dashboard`.
2. Klik menu `Logout` di sidebar.

Expected Result:
- Request logout dikirim dengan method POST ke `/logout`.
- Redirect ke `/login`.
- Session lama tidak dipakai lagi.

## Use Case 5 - Logout Berhasil dari Halaman Lain

Tujuan: memastikan wiring form logout konsisten di semua halaman yang sudah diubah.

Langkah:
1. Login.
2. Uji klik logout di halaman berikut satu per satu:
   - `/dashboard`
   - `/history-design`
   - `/bookmark`
   - `/list-event-design`
   - `/profile-design`
   - `/admin/dashboard`

Expected Result:
- Semua tombol logout melakukan POST ke `/logout`.
- Semua redirect kembali ke `/login`.

## Use Case 6 - Route Security (Method Check)

Tujuan: memastikan endpoint logout tidak bisa dipanggil via GET.

Langkah:
1. Buka URL `/logout` langsung dari browser (GET).

Expected Result:
- Tidak dieksekusi sebagai logout.
- Response method not allowed (karena route yang didaftarkan adalah POST).

## Use Case 7 - CSRF Protection pada Logout

Tujuan: memastikan logout tetap terlindungi CSRF.

Langkah:
1. Kirim request POST ke `/logout` tanpa token CSRF (misalnya dari tool HTTP tanpa token).

Expected Result:
- Request ditolak (status 419 / token mismatch).

## Use Case 8 - Session Regeneration Saat Login

Tujuan: memastikan mitigasi session fixation berjalan.

Langkah:
1. Buka browser devtools, catat nilai cookie `laravel_session` sebelum login.
2. Login dengan akun valid.
3. Cek nilai cookie `laravel_session` setelah login.

Expected Result:
- Nilai session cookie berubah setelah login (session regenerate berhasil).

## Catatan Penting

- Saat ini route halaman utama masih belum diproteksi middleware `auth`, jadi pengujian akses halaman setelah logout belum bisa dipakai sebagai indikator final authorization.
- Fokus dokumen ini hanya memverifikasi perubahan login/logout berbasis Auth Facade dan mekanisme session/csrf/logout route.
