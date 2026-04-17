<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event</title>
</head>
<body>
  <nav class="px-8 h-20 w-full fixed top-0 flex items-center justify-between bg-primary-dark">
    <img class="w-20 h-20" src="{{ asset('icon/FilkomEventLogo.svg') }}" alt="">
    <div></div>
    <div></div>
  </nav>

  <section class="w-full h-[120vh] hero-bg flex justify-center items-center">
    <div class="mx-auto w-[80%] grid grid-cols-[1.5fr_1fr] items-center">
      <div class="mx-auto flex flex-col gap-6">
        <h1 class="text-4xl font-bold">Buka kunci semangatmu melalui kompetisi dan jadilah mahasiswa yang luar biasa!</h1>
        <p class="text-xl">Kami berkomitmen mendukung perjalananmu menuju kemenangan dalam kompetisi IT bergengsi dengan bimbingan dan sumber daya terbaik. Daftar sekarang, maksimalkan potensimu, dan tunjukkan kemampuanmu!</p>
        <button class="flex items-center justify-center gap-2 bg-orange-550 px-4 p-2 rounded-[50px] w-[35%] cursor-pointer hover:scale-105 duration-300 text-white">Telusuri Lebih Lanjut <span class="p-1" data-lucide="MoveUpRight"></span></button>
      </div>
      <div class="flex flex-col gap-12">
        <img src="{{ asset('icon/Person_1.svg') }}" alt="Person 1">
        <div class="flex gap-8">
          <div class="flex flex-col items-center justify-center text-center w-full py-12 bg-orange-550 text-white font-bold text-xl rounded-[20px] shadow-[6px_6px_0px_rgba(0,0,0,0.2)]"><p>125+</p><p>Events</p></div>
          <div class="flex flex-col items-center justify-center text-center w-full py-12 bg-orange-550 text-white font-bold text-xl rounded-[20px] shadow-[6px_6px_0px_rgba(0,0,0,0.2)]"><p>300+</p><p>Students</p></div>
          <div class="flex flex-col items-center justify-center text-center w-full py-12 bg-orange-550 text-white font-bold text-xl rounded-[20px] shadow-[6px_6px_0px_rgba(0,0,0,0.2)]"><p>15+</p><p>Category Events</p></div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
