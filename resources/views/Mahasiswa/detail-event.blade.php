<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Detail Event</title>
</head>
<body>
  <div class="relative flex min-h-screen w-full  bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    <main class="relative px-12 py-6">
      <header class="relative mb-6 flex justify-between items-start">
        <h1 class="flex gap-3 items-center text-2xl font-bold text-[#233E98]">
          <i data-lucide="CalendarDays" class="w-8 h-8 text-orange-550"></i>
          Detail Event
        </h1>
        <button onclick="location.href='{{ route('events.index') }}'"
           class="flex items-center gap-2 py-3 px-3 bg-primary-lighter rounded-2xl hover:scale-105 duration-300 text-white text-sm cursor-pointer">
          <i data-lucide="MoveLeft" class="w-4 h-4"></i>
          <p>Kembali ke List Event</p>
        </button>
      </header>

      <div class="grid grid-cols-[0.6fr_1fr] gap-12">
        <section class="flex flex-col">
          <h2 class="text-2xl font-extrabold mb-6">{{ $event->title }}</h2>
          <img src="{{ asset($event->image_url ?? 'images/default.jpg') }}" class="w-full max-w-90 h-auto object-cover rounded-2xl mb-6" alt="{{ $event->title }}">
          <div class="flex gap-2">
            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">{{ $event->event_status }}</span>
            <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm">
              @if($event->is_paid)
                Rp {{ number_format($event->price, 0, ',', '.') }}
              @else
                Gratis
              @endif
            </span>
          </div>
        </section>

        <section>

          <section class="grid grid-cols-[0.8fr_1.5fr] gap-12">
            <div class="flex flex-col justify-between bg-white p-5 rounded-2xl shadow mb-6">

              <h2 class="font-semibold mb-4">Registrasi</h2>

              @php
                $percent = ($event->quota > 0) ? ($event->quota_filled / $event->quota) * 100 : 0;
              @endphp

              <div class="flex justify-between text-sm mb-2">
                <span>Kuota</span>
                <span>{{ $event->quota_filled }}/{{ $event->quota }}</span>
              </div>

              <div class="w-full bg-gray-200 h-2 rounded-full mb-4">
                <div class="bg-blue-600 h-2 rounded-full"
                     style="width: {{ $percent }}%">
                </div>
              </div>

              <div class="text-center text-2xl font-bold mb-4">
                @if($event->is_paid)
                  Rp {{ number_format($event->price, 0, ',', '.') }}
                @else
                  Gratis
                @endif
              </div>

              <div class="mb-4 text-center">
                <p class="text-sm text-gray-500 mb-2">Pendaftaran berakhir dalam</p>

                <div id="countdown" data-start="{{ \Carbon\Carbon::parse($event->event_start)->toIso8601String() }}" class="text-sm font-bold">
                  Loading...
                </div>
              </div>

              <button onclick="location.href='{{ route('events.id.registration', $event->event_id, 'registration') }}'" class="w-full bg-primary-lighter text-white py-2 rounded-2xl hover:scale-105 duration-300 cursor-pointer">
                Daftar Sekarang
              </button>

            </div>

            <div class="bg-white p-5 rounded-xl mb-6 shadow">
              <h2 class="font-semibold text-lg mb-4 text-[#233E98]">
                Informasi Dasar
              </h2>

              <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                  <p class="font-medium">Tanggal & Waktu</p>
                  <p class="text-gray-500">
                    {{ \Carbon\Carbon::parse($event->event_start)->format('d M Y, H:i') }}
                    {{ \Carbon\Carbon::parse($event->event_end)->format('H:i') }} WIB
                  </p>
                </div>

                <div>
                  <p class="font-medium">Lokasi</p>
                  <p class="text-gray-500">{{ $event->location }}</p>
                </div>

                <div>
                  <p class="font-medium">Batas Pendaftaran</p>
                  <p class="text-gray-500">
                    {{ \Carbon\Carbon::parse($event->event_end)->format('d M Y  ') }}
                  </p>
                </div>

                <div>
                  <p class="font-medium">Kategori</p>
                  <p class="text-gray-500">
                    {{ $event->category->category_name ?? '-' }}
                  </p>
                </div>

                <div>
                  <h2 class="font-semibold text-lg text-[#233E98]">
                    Penyelenggara
                  </h2>
                </div>

                <div></div>

                <div class="font-medium">
                  <p>Nama Organisasi</p>
                  <p class="text-gray-500">{{ $event->organizer }}</p>
                </div>
                <div class="font-medium">
                  <p>Email</p>
                  <p class="text-gray-500">{{ $event->contact_email }}</p>
                </div>
                <div class="font-medium">
                  <p>Kontak</p>
                  <p class="text-gray-500">+{{ $event->contact_phone }}</p>
                </div>

              </div>
            </div>

          </section>

          @if($event->speakers->count() > 0)
            <div class="bg-white p-5 rounded-xl shadow mb-6">
              <h2 class="font-semibold text-lg mb-4 text-[#233E98]">
                Pembicara
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($event->speakers as $speaker)
                  <div class="flex gap-4 pb-4 border-b">
                    <div class="shrink-0">
                      @if($speaker->photo_url)
                        <img src="{{ asset($speaker->photo_url) }}"
                             alt="{{ $speaker->name }}"
                             class="w-16 h-16 rounded-full object-cover">
                      @else
                        <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center">
                          <i data-lucide="User" class="w-8 h-8 text-gray-500"></i>
                        </div>
                      @endif
                    </div>

                    <div class="flex-1">
                      <h3 class="font-semibold text-gray-900">{{ $speaker->name }}</h3>
                      <p class="text-sm text-gray-600">{{ $speaker->title }}</p>
                      <p class="text-sm text-gray-500">{{ $speaker->organization }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <div class="bg-white p-5 rounded-xl mb-6 shadow">
            <h2 class="font-semibold text-lg mb-2 text-[#233E98]">
              Deskripsi
            </h2>
            <p class="text-gray-600">
              {{ $event->description }}
            </p>
          </div>

          @if($event->goals->count() > 0)
            <div class="bg-white p-5 rounded-xl shadow mt-6">
              <h2 class="font-semibold text-lg mb-4 text-[#233E98]">
                Tujuan Acara
              </h2>
              <ul class="list-disc list-inside space-y-2">
                @foreach($event->goals as $goal)
                  <li class="text-gray-600">{{ $goal->description }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </section>
      </div>
    </main>
  </div>
</body>
</html>
