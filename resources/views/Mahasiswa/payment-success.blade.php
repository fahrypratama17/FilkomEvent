<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Pembayaran Berhasil - Filkom Event</title>
</head>
<body>
  <div class="relative flex min-h-screen w-full items-center justify-center bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    <main class="relative w-full max-w-2xl rounded-2xl border border-[#D9D9D9] bg-white px-10 py-12 text-center shadow-2xl">
      <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
        <video autoPlay muted playsInline  class="h-16 w-16">
          <source src="{{ asset('icon/success.webm')}}" type="video/webm">
        </video>
      </div>

      <h1 class="mb-3 text-2xl font-bold text-[#233E98]">Pembayaran Berhasil</h1>
      <p class="mb-6 px-8 text-sm text-gray-600">
        Terima kasih, pembayaran Anda telah kami terima. Anda akan kembali ke halaman pembayaran dalam 10 detik.
      </p>

      <a href="{{ route('events.id.payment', $eventId) }}"
         class="inline-flex items-center justify-center rounded-full bg-primary-lighter px-6 py-2 text-sm font-bold text-white shadow-md transition hover:bg-secondary-dark/80">
        Kembali sekarang
      </a>
    </main>
  </div>

  <script>
    setTimeout(function() {
      window.location.href = "{{ route('events.id.payment', $eventId) }}";
    }, 10000);
  </script>
</body>
</html>
