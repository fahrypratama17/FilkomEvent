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
  <nav class="z-100 px-8 h-20 w-full fixed top-0 flex items-center justify-between bg-primary-dark">
    <img class="w-20 h-20" src="{{ asset('icon/FilkomEventLogo.svg') }}" alt="">
    <div class="flex gap-20 cursor-pointer text-xl text-white">
      <p class="hover:underline duration-300" onclick="location.href='#home'">Beranda</p>
      <p class="hover:underline duration-300" onclick="location.href='#alasan'">Alasan</p>
      <p class="hover:underline duration-300" onclick="location.href='#testimonials'">Testimoni</p>
      <p class="hover:underline duration-300" onclick="location.href='#tentang'">Tentang Kami</p>
    </div>
    <div class="flex gap-4 cursor-pointer text-xl text-white">
      <button onclick="location.href='/login'" class="group relative overflow-hidden bg-white text-secondary-dark font-bold px-8 py-2 w-40 rounded-[50px] border-4 border-orange-550 cursor-pointer">
        <span class="relative z-10 transition-colors duration-300 group-hover:text-white">Masuk</span>
        <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-orange-550 transition-transform duration-300 group-hover:scale-x-100"></span>
      </button>
      <button onclick="location.href='/register'" class="group relative overflow-hidden text-white font-bold px-8 py-2 w-40 rounded-[50px] bg-orange-550 cursor-pointer">
        <span class="relative z-10 transition-colors duration-300 group-hover:text-secondary-dark">Daftar</span>
        <span class="absolute inset-0 rounded-[50px] origin-left scale-x-0 bg-white transition-transform duration-300 group-hover:scale-x-100"></span>
      </button>
    </div>
  </nav>

  <section id="home" class="w-full h-[120vh] hero-bg flex justify-center items-center rounded-b-[85px]">
    <div class="mx-auto w-[80%] grid grid-cols-[1.5fr_1fr] items-center">
      <div class="mx-auto flex flex-col gap-6">
        <h1 class="text-4xl font-bold text-white">Buka kunci <span class="text-orange-550 font-extrabold">semangatmu</span> melalui kompetisi dan jadilah mahasiswa yang luar <span class="text-orange-550 font-extrabold">biasa!</span></h1>
        <p class="text-xl text-white/85 ">Kami berkomitmen mendukung perjalananmu menuju kemenangan dalam kompetisi IT bergengsi dengan bimbingan dan sumber daya terbaik. Daftar sekarang, maksimalkan potensimu, dan tunjukkan kemampuanmu!</p>
        <button onclick="location.href='/login'" class="flex items-center justify-center gap-2 bg-orange-550 px-4 p-2 rounded-[50px] w-[35%] cursor-pointer hover:scale-105 duration-300 text-white shadow-[6px_6px_0px_rgba(0,0,0,0.2)] active:translate-x-1 active:translate-y-1">Telusuri Lebih Lanjut <span class="p-1" data-lucide="MoveUpRight"></span></button>
      </div>
      <div class="flex flex-col gap-12">
        <img src="{{ asset('icon/Person_1.svg') }}" alt="Person 1">
        <div class="flex gap-8">
          <div class="flex flex-col items-center justify-center text-center w-full py-12 bg-orange-550 text-white text-xl rounded-[20px] shadow-[6px_6px_0px_rgba(0,0,0,0.2)] font-extrabold"><p class="counter" data-target="125">0+</p><p>Events</p></div>
          <div class="flex flex-col items-center justify-center text-center w-full py-12 bg-orange-550 text-white font-extrabold text-xl rounded-[20px] shadow-[6px_6px_0px_rgba(0,0,0,0.2)]"><p class="counter" data-target="300">0+</p><p>Students</p></div>
          <div class="flex flex-col items-center justify-center text-center w-full py-12 bg-orange-550 text-white font-extrabold text-xl rounded-[20px] shadow-[6px_6px_0px_rgba(0,0,0,0.2)]"><p class="counter" data-target="15">0+</p><p>Category Events</p></div>
        </div>
      </div>
    </div>
  </section>

  <section id="alasan" class="mt-40 flex flex-col gap-32">
    <h1 class="text-primary-dark text-6xl text-center font-bold">3 Alasan untuk Bergabung Bersama Kami</h1>
    <div class="mx-auto w-[80%] grid grid-cols-3">
      <div class="bg-slate-50 flex flex-col gap-8 w-[90%] rounded-3xl shadow-xl shadow-slate-200 p-4 py-6 hover:shadow-2xl hover:-translate-y-1 duration-300">
        <div class="mx-auto p-4 bg-primary-dark rounded-[40px] hover:-translate-y-3 transition-transform duration-300">
          <i class="w-20 h-20 text-orange-550 " data-lucide="BookOpen"></i>
        </div>
        <h2 class="text-2xl font-bold text-center">Kompetisi Berkualitas dengan Dampak Tinggi</h2>
        <p class="text-center text-xl text-[#333333]">Akses pilihan kompetisi IT bergengsi yang telah dikurasi oleh BEM FILKOM UB untuk membangun portofolio profesionalmu secara strategis.</p>
      </div>
      <div class="bg-slate-50 flex flex-col gap-8 w-[90%] rounded-3xl shadow-xl shadow-slate-200 p-4 py-6 hover:shadow-2xl hover:-translate-y-1 duration-300">
        <div class="mx-auto p-4 bg-primary-dark rounded-[40px] hover:-translate-y-3 transition-transform duration-300">
          <i class="w-20 h-20 text-orange-550 " data-lucide="Users"></i>
        </div>
        <h2 class="text-2xl font-bold text-center">Bimbingan dan Sumber Daya Eksklusif</h2>
        <p class="text-center text-xl text-[#333333]">Raih kemenangan dengan akses eksklusif ke workshop ahli, materi unggulan, dan jaringan mentor yang mendukung kesuksesan kompetitifmu.</p>
      </div>
      <div class="bg-slate-50 flex flex-col gap-8 w-[90%] rounded-3xl shadow-xl shadow-slate-200 p-4 py-6 hover:shadow-2xl hover:-translate-y-1 duration-300">
        <div class="mx-auto p-4 bg-primary-dark rounded-[40px] hover:-translate-y-3 transition-transform duration-300">
          <i class="w-20 h-20 text-orange-550 " data-lucide="Award"></i>
        </div>
        <h2 class="text-2xl font-bold text-center">Komunitas dengan Semangat dan Tujuan yang Sama</h2>
        <p class="text-center text-xl text-[#333333]">Terhubunglah dengan mahasiswa paling ambisius di fakultas, temukan tim impianmu dan berkembang melalui kolaborasi tingkat tinggi.</p>
      </div>
    </div>
  </section>

  <section id="testimonials" class="mt-40 flex flex-col gap-48">
    <h1 class="text-primary-dark text-6xl text-center font-bold">Testimoni</h1>
    <div class="relative w-full h-70 bg-tertiary rounded-[50px] shadow-2xl shadow-blue-900/20">
      <div class="absolute right-10 left-10 h-70 w-[95%] opacity-20"
           style="background-image: radial-gradient(#001d3d 2px, transparent 2px); background-size: 20px 20px;">
      </div>

      <div class="mx-auto w-[60%] grid grid-cols-[1.5fr_0.8fr]">
        <div class="flex flex-col w-full h-70 bg-primary-dark px-20 py-10 gap-2">
          <h2 class="text-white font-bold text-2xl w-[60%]">A Game-Changer for My Portfolio</h2>
          <p class="text-white text-[14px] italic leading-relaxed">"FILKOM Event transformed how I find opportunities. No more digging through chat groups; I found my first national hackathon here and managed to build a winning team through the community. It’s a must-have tool for every ambitious Informatics student." </p>
          <p class="text-white text-[14px] font-bold">~ Rizky Aulia, Informatics '24</p>
        </div>
        <div class="flex items-end justify-center h-100 w-full bg-orange-550 -translate-y-30 rounded-tl-[50px] rounded-br-[50px] shadow-lg">
          <img src="{{ asset('icon/testimonials_1.svg') }}" alt="testimonial 1">
        </div>
      </div>
    </div>

    <div class="relative w-full h-70 bg-tertiary rounded-[50px] shadow-2xl shadow-blue-900/20">
      <div class="absolute right-10 left-10 h-70 w-[95%] opacity-20"
           style="background-image: radial-gradient(#001d3d 2px, transparent 2px); background-size: 20px 20px;">
      </div>

      <div class="mx-auto w-[60%] grid grid-cols-[0.8fr_1.5fr]">
        <div class="flex items-end justify-center h-100 w-full bg-orange-550 -translate-y-30 rounded-tr-[50px] rounded-bl-[50px] shadow-lg">
          <img src="{{ asset('icon/testimonials_2.svg') }}" alt="testimonial 2">
        </div>
        <div class="flex flex-col w-full h-70 bg-primary-dark px-20 py-10 gap-2">
          <h2 class="text-white font-bold text-2xl w-[60%]">The Ultimate Launchpad</h2>
          <p class="text-white text-[14px] italic leading-relaxed">"The mentorship resources and curated event lists are top-notch. FILKOM Event didn't just give me information; it gave me the roadmap to compete and excel. It’s more than just a website, it’s a platform that fuels our competitive spirit." </p>
          <p class="text-white text-[14px] font-bold">~ Aditya, Computer Engineering '22</p>
        </div>
      </div>
    </div>

    <div class="relative w-full h-70 bg-tertiary rounded-[50px] shadow-2xl shadow-blue-900/20">
      <div class="absolute right-10 left-10 h-70 w-[95%] opacity-20"
           style="background-image: radial-gradient(#001d3d 2px, transparent 2px); background-size: 20px 20px;">
      </div>

      <div class="mx-auto w-[60%] grid grid-cols-[1.5fr_0.8fr]">
        <div class="flex flex-col w-full h-70 bg-primary-dark px-20 py-10 gap-2">
          <h2 class="text-white font-bold text-2xl">Information Simplified</h2>
          <p class="text-white text-[14px] italic leading-relaxed">"Being a busy student, I used to miss out on important faculty events. With this centralized hub, I can track every BEM FILKOM activity in one place. The UI is clean, intuitive, and exactly what we needed to stay connected with our faculty's ecosystem."</p>
          <p class="text-white text-[14px] font-bold">~ Salsabila, Information Systems '23</p>
        </div>
        <div class="flex items-end justify-center h-100 w-full bg-orange-550 -translate-y-30 rounded-tl-[50px] rounded-br-[50px] shadow-lg">
          <img class="w-65" src="{{ asset('icon/testimonials_3.png') }}" alt="testimonial 3">
        </div>
      </div>
    </div>
  </section>

  <section id="tentang" class="mt-40 grid grid-cols-2">
    <div class="relative mx-auto flex items-center justify-center ">
      <div class="absolute bg-blue-50 rounded-full w-110 h-110"></div>
      <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-120 h-120 drop-shadow-2xl">
    </div>
    <div class="flex flex-col justify-center w-[70%] gap-12">
      <h1 class="text-6xl font-bold text-primary-dark">Tentang Kami</h1>
      <p class="text-2xl"><span class="font-bold">FILKOM<span class="text-orange-550">EVENT</span> </span>adalah pusat informasi digital terpusat yang dirancang sebagai platform utama untuk seluruh acara dan kegiatan yang diselenggarakan oleh BEM FILKOM Universitas Brawijaya.</p>
      <button onclick="location.href='/login'" class="flex items-center justify-center gap-2 bg-orange-550 px-4 p-2 rounded-[50px] w-[45%] cursor-pointer hover:scale-105 duration-300 text-white shadow-[6px_6px_0px_rgba(0,0,0,0.2)] active:translate-x-1 active:translate-y-1">Telusuri Lebih Lanjut <span class="p-1" data-lucide="MoveUpRight"></span></button>
    </div>
  </section>

  <section class="mt-40 w-full hubungi-section py-20 rounded-t-[85px] flex flex-col gap-12">
    <h1 class="mx-auto text-6xl font-extrabold text-white w-[90%]">Punya Pertanyaan ?</h1>

    <form action="" class="mx-auto w-[90%] flex flex-col gap-6">
      <div class="grid grid-cols-2 gap-6">
        <div class="flex flex-col w-full gap-6">
          <div class="flex flex-col justify-center gap-2">
            <label class="text-white text-lg" for="">Nama</label>
            <input class="bg-white p-2 px-4 rounded-[10px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent" type="text" placeholder="nama">
          </div>
          <div class="flex flex-col justify-center gap-2">
            <label class="text-white text-lg" for="">Email</label>
            <input class="bg-white p-2 px-4 rounded-[10px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent" type="password" placeholder="email">
          </div>
          <div class="flex flex-col justify-center gap-2">
            <label class="text-white text-lg" for="">NIM</label>
            <input class="bg-white p-2 px-4 rounded-[10px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent" type="password" placeholder="245150207111046">
          </div>
          <button class="w-full flex items-center justify-center gap-4 bg-orange-550 p-2 rounded-[40px] mt-6 cursor-pointer text-white hover:scale-105 transition-transform duration-300 shadow-[0px_4px_0px_rgba(0,0,0,0.3)]">WhatsApp<img class="w-6 h-6" src="{{ asset('icon/whatsapp.svg') }}" alt=""></button>
        </div>
        <div class="flex flex-col w-full gap-6">
          <div class="flex flex-col justify-center gap-2">
            <label class="text-white text-lg" for="">Pesan</label>
            <textarea class="bg-white p-2 px-4 h-60 rounded-[10px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent resize-none" type="text" placeholder="pesan disini..." ></textarea>
          </div>
          <button class="w-full flex gap-4 justify-center items-center bg-secondary-lighter p-2 rounded-[40px] mt-6 cursor-pointer text-white hover:scale-105 transition-transform duration-300 shadow-[0px_4px_0px_rgba(0,0,0,0.3)]">Kirim via Email<i data-lucide="Mail"></i></button>
        </div>
      </div>
    </form>

  </section>

  <footer class="px-8 h-20 w-full flex items-center justify-between bg-primary-dark">
    <img class="w-20 h-20" src="{{ asset('icon/FilkomEventLogo.svg') }}" alt="">
    <div class="flex justify-end gap-12 text-2xl text-white w-[40%]">
      <div onclick="location.href='https://www.instagram.com/fahrypp'" class="bg-orange-550 p-3 rounded-full cursor-pointer hover:scale-105 duration-300">
        <img class="w-6 h-6" src="{{ asset('icon/instagram.svg') }}" alt="">
      </div>
      <div onclick="location.href='https://www.linkedin.com/in/muhamad-fahry-pratama-putra-05a2a8322/'" class="bg-orange-550 p-3 rounded-full cursor-pointer hover:scale-105 duration-300">
        <img class="w-6 h-6" src="{{ asset('icon/linkedin.svg') }}" alt="">
      </div>
      <div onclick="location.href='https://www.linkedin.com/in/muhamad-fahry-pratama-putra-05a2a8322/'" class="bg-orange-550 p-3 rounded-full cursor-pointer hover:scale-105 duration-300">
        <img class="w-6 h-6" src="{{ asset('icon/twitter.svg') }}" alt="">
      </div>
    </div>
    <p class="text-white">©Copyright 2026 SGE FILKOM UB. All rights reserved.</p>
  </footer>
</body>
</html>
