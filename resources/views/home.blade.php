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
    <div class="flex gap-20 cursor-pointer text-2xl text-white">
      <p>Home</p>
      <p>Testimonials</p>
      <p>About Us</p>
    </div>
    <div class="flex gap-4 cursor-pointer text-xl text-white">
      <button class="bg-white text-secondary-dark px-8 py-2 w-40 rounded-[50px] border-3 border-orange-550 cursor-pointer">Login</button>
      <button class="text-white w-40 py-2 rounded-[50px] bg-orange-550 cursor-pointer">Sign Up</button>
    </div>
  </nav>

  <section class="w-full h-[120vh] hero-bg flex justify-center items-center rounded-b-[85px]">
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

  <section class="mt-40 flex flex-col gap-32">
    <h1 class="text-primary-dark text-6xl text-center font-bold">3 Alasan untuk Bergabung Bersama Kami</h1>
    <div class="mx-auto w-[80%] grid grid-cols-3">
      <div class="flex flex-col gap-8">
        <div class="mx-auto p-4 bg-primary-dark rounded-[40px]">
          <i class="w-20 h-20 text-orange-550 " data-lucide="BookOpen"></i>
        </div>
        <h2 class="text-2xl font-bold text-center">Kompetisi Berkualitas dengan Dampak Tinggi</h2>
        <p class="mx-auto text-xl w-[85%]">Akses pilihan kompetisi IT bergengsi yang telah dikurasi oleh BEM FILKOM UB untuk membangun portofolio profesionalmu secara strategis.</p>
      </div>
      <div class="flex flex-col gap-8">
        <div class="mx-auto p-4 bg-primary-dark rounded-[40px]">
          <i class="w-20 h-20 text-orange-550 " data-lucide="Users"></i>
        </div>
        <h2 class="text-2xl font-bold text-center">Bimbingan dan Sumber Daya Eksklusif</h2>
        <p class="mx-auto text-xl w-[85%]">Raih kemenangan dengan akses eksklusif ke workshop ahli, materi unggulan, dan jaringan mentor yang mendukung kesuksesan kompetitifmu.</p>
      </div>
      <div class="flex flex-col gap-8">
        <div class="mx-auto p-4 bg-primary-dark rounded-[40px]">
          <i class="w-20 h-20 text-orange-550 " data-lucide="Award"></i>
        </div>
        <h2 class="text-2xl font-bold text-center">Komunitas dengan Semangat dan Tujuan yang Sama</h2>
        <p class="mx-auto text-xl w-[85%]">Terhubunglah dengan mahasiswa paling ambisius di fakultas, temukan tim impianmu dan berkembang melalui kolaborasi tingkat tinggi.</p>
      </div>
    </div>
  </section>

  <section class="mt-40 flex flex-col gap-48">
    <h1 class="text-primary-dark text-6xl text-center font-bold">Testimonials</h1>
    <div class="w-full h-70 bg-tertiary rounded-[50px] -z-50">
      <div class="mx-auto w-[60%] grid grid-cols-[1.5fr_0.8fr]">
        <div class="flex flex-col w-full h-70 bg-primary-dark px-20 py-10 gap-2">
          <h2 class="text-white font-bold text-2xl w-[60%]">A Game-Changer for My Portfolio</h2>
          <p class="text-white text-[14px]">"FILKOM Event transformed how I find opportunities. No more digging through chat groups; I found my first national hackathon here and managed to build a winning team through the community. It’s a must-have tool for every ambitious Informatics student." </p>
          <p class="text-white text-[14px] font-bold">~ Rizky Aulia, Informatics '24</p>
        </div>
        <div class="flex items-end justify-center h-100 w-full bg-orange-550 -translate-y-30 rounded-tl-[50px] rounded-br-[50px]">
          <img src="{{ asset('icon/testimonials_1.svg') }}" alt="testimonial 1">
        </div>
      </div>
    </div>

    <div class="w-full h-70 bg-tertiary rounded-[50px] -z-50">
      <div class="mx-auto w-[60%] grid grid-cols-[0.8fr_1.5fr]">
        <div class="flex items-end justify-center h-100 w-full bg-orange-550 -translate-y-30 rounded-tl-[50px] rounded-br-[50px]">
          <img src="{{ asset('icon/testimonials_2.svg') }}" alt="testimonial 2">
        </div>
        <div class="flex flex-col w-full h-70 bg-primary-dark px-20 py-10 gap-2">
          <h2 class="text-white font-bold text-2xl w-[60%]">The Ultimate Launchpad</h2>
          <p class="text-white text-[14px]">"The mentorship resources and curated event lists are top-notch. FILKOM Event didn't just give me information; it gave me the roadmap to compete and excel. It’s more than just a website, it’s a platform that fuels our competitive spirit." </p>
          <p class="text-white text-[14px] font-bold">~ Aditya, Computer Engineering '22</p>
        </div>
      </div>
    </div>

    <div class="w-full h-70 bg-tertiary rounded-[50px]">
      <div class="mx-auto w-[60%] grid grid-cols-[1.5fr_0.8fr]">
        <div class="flex flex-col w-full h-70 bg-primary-dark px-20 py-10 gap-2">
          <h2 class="text-white font-bold text-2xl w-[60%]">Information Simplified</h2>
          <p class="text-white text-[14px]">"Being a busy student, I used to miss out on important faculty events. With this centralized hub, I can track every BEM FILKOM activity in one place. The UI is clean, intuitive, and exactly what we needed to stay connected with our faculty's ecosystem."</p>
          <p class="text-white text-[14px] font-bold">~ Salsabila, Information Systems '23</p>
        </div>
        <div class="flex items-end justify-center h-100 w-full bg-orange-550 -translate-y-30 rounded-tl-[50px] rounded-br-[50px]">
          <img class="w-65" src="{{ asset('icon/testimonials_3.png') }}" alt="testimonial 3">
        </div>
      </div>
    </div>
  </section>
</body>
</html>
