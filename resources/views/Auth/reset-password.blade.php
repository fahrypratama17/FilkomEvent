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
      <h1 class="text-4xl text-white font-bold">Reset Password</h1>
      <h2 class="text-xl text-white">Masukkan password baru anda</h2>
    </div>
    <form method="POST" action="{{ route('resetPassword.process') }}" class="mx-auto w-[80%] flex flex-col justify-center gap-2">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="flex flex-col justify-center gap-2">
        <label class="text-white text-lg" for="">Password</label>
        <input name="password" class="bg-white p-2 px-4 rounded-[40px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent" type="text" placeholder="password">
      </div>
      <div class="flex flex-col justify-center gap-2">
        <label class="text-white text-lg" for="">Konfirmasi Password</label>
        <input name="password_confirmation" class="bg-white p-2 px-4 rounded-[40px] focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent" type="text" placeholder="konfirmasi password">
      </div>
      <button class="w-full mt-4 bg-orange-550 p-2 rounded-[40px] cursor-pointer text-white hover:scale-105 transition-transform duration-300 shadow-[0px_4px_0px_rgba(0,0,0,0.3)]">Kirim</button>
    </form>
  </div>
</section>

</body>
</html>
