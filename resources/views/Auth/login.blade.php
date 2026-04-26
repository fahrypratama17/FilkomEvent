<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/auth.css', 'resources/js/app.js'])
  <title>FilkomEvent - Login</title>
</head>
<body class="relative min-h-screen">
  {{--  For Toast  --}}
  <x-toast />
  {{--  For All Icon  --}}
  <img class="absolute top-0 left-0" src="{{ asset('icon/FilkomEventLogo.svg') }}" alt="">
  <img class="absolute bottom-0 right-0" src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="">
  <div class="absolute bg-gray-300/40 rounded-full w-25 h-25 bottom-20 left-10"></div>
  <div class="absolute bg-gray-300/40 rounded-full w-50 h-50 bottom-40 left-40"></div>
  <div class="absolute bg-gray-300/40 rounded-full w-15 h-15 top-70 left-80"></div>
  <div class="absolute bg-gray-300/40 rounded-full w-60 h-60 top-35 left-5"></div>
  <div class="absolute bg-gray-300/40 rounded-full w-20 h-20 top-15 left-75"></div>
  <div class="absolute bg-gray-300/40 rounded-full w-60 h-60 top-5 right-30"></div>
  <div class="absolute bg-gray-300/40 rounded-full w-20 h-20 top-60 right-80"></div>

  {{-- For the Form Section --}}
  <section>
    <div class="glassmorphism flex flex-col justify-center items-center gap-11">
      <div class="flex flex-col justify-center items-center">
        <h1 class="text-4xl text-white font-bold">Selamat Datang Kembali</h1>
        <h2 class="text-xl text-white">Mohon masukkan detail akun anda</h2>
      </div>
      <form action="{{ route('login.process') }}" method="post" class="mx-auto w-[80%] flex flex-col justify-center gap-2">
        @csrf
        <div class="flex flex-col justify-center gap-2">
          <label class="text-white text-lg" for="">Email</label>
          <input class="bg-white p-2 px-4 rounded-[40px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent" name="email" type="email" value="{{ old('email') }}" placeholder="email">
        </div>
        <div class="flex flex-col justify-center gap-2">
          <label class="text-white text-lg" for="">Password</label>
          <input class="bg-white p-2 px-4 rounded-[40px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent" name="password" type="password" placeholder="password">
        </div>
        <div class="flex items-center justify-between">
          <label class="flex items-center gap-2 text-white text-sm">
            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded" {{ old('remember') ? 'checked' : '' }}>
            <span>Ingat saya</span>
          </label>
          <a href="{{ route('password.forgot') }}"><p class="text-white hover:underline text-end">Lupa Password</p></a>
        </div>
        <button class="w-full bg-orange-550 p-2 rounded-[40px] cursor-pointer text-white hover:scale-105 transition-transform duration-300 shadow-[0px_4px_0px_rgba(0,0,0,0.3)]">Masuk</button>
      </form>
      <div class="mx-auto w-[80%] flex flex-col gap-4">
        <div class="flex items-center gap-3">
          <div class="w-full h-0.5 bg-white"></div>
          <p class="w-150 text-center text-white">Atau Masuk Dengan</p>
          <div class="w-full h-0.5 bg-white"></div>
        </div>
        <div class="flex items-center w-full">
          <img class="w-10 h-10 mx-auto hover:scale-105 cursor-pointer" src="{{ asset('icon/Google_icon.svg') }}" alt="google">
        </div>
      </div>
      <p class="text-white">Belum punya akun? <a class="hover:underline" href="{{ route('register.view') }}">Daftar Disini</a></p>
    </div>
  </section>

</body>
</html>
