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
  <div class="px-[46px] py-6">

    <!-- HEADER -->
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-[#233E98]">Detail Event</h1>

      <a href="{{ route('events.index') }}"
         class="px-4 py-2 bg-gray-200 rounded-lg text-sm">
        Back
      </a>
    </div>

    <div class="grid grid-cols-[1fr_350px] gap-8">

      <!-- LEFT -->
      <div>

        <!-- IMAGE -->
        <img src="{{ asset($event->image_url ?? 'images/default.jpg') }}"
             class="w-full h-[400px] object-cover rounded-xl mb-6">

        <!-- TITLE -->
        <h1 class="text-3xl font-extrabold mb-2">
          {{ $event->title }}
        </h1>

        <!-- BADGE -->
        <div class="flex gap-2 mb-6">
                  <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                      {{ $event->event_status }}
                  </span>

          <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm">
                      @if($event->is_paid)
              Rp {{ number_format($event->price, 0, ',', '.') }}
            @else
              Free
            @endif
                  </span>
        </div>

        <!-- BASIC INFO -->
        <div class="bg-white p-5 rounded-xl mb-6 shadow">
          <h2 class="font-semibold text-lg mb-4 text-[#233E98]">
            Basic Information
          </h2>

          <div class="grid grid-cols-2 gap-4 text-sm">

            <div>
              <p class="font-medium">Date & Time</p>
              <p class="text-gray-500">
                {{ \Carbon\Carbon::parse($event->event_start)->format('d M Y, H:i') }}
                -
                {{ \Carbon\Carbon::parse($event->event_end)->format('H:i') }} WIB
              </p>
            </div>

            <div>
              <p class="font-medium">Location</p>
              <p class="text-gray-500">{{ $event->location }}</p>
            </div>

            <div>
              <p class="font-medium">Quota</p>
              <p class="text-gray-500">
                {{ $event->quota_filled }} / {{ $event->quota }}
              </p>
            </div>

            <div>
              <p class="font-medium">Category</p>
              <p class="text-gray-500">
                {{ $event->category->category_name ?? '-' }}
              </p>
            </div>

          </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-6">
          <h2 class="font-semibold text-lg mb-2 text-[#233E98]">
            Description
          </h2>
          <p class="text-gray-600">
            {{ $event->description }}
          </p>
        </div>

        <!-- SPEAKERS -->
        @if($event->speakers->count() > 0)
          <div class="bg-white p-5 rounded-xl shadow mt-6">
            <h2 class="font-semibold text-lg mb-4 text-[#233E98]">
              Speakers
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              @foreach($event->speakers as $speaker)
                <div class="flex gap-4 pb-4 border-b">
                  <!-- Speaker Photo -->
                  <div class="flex-shrink-0">
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

                  <!-- Speaker Info -->
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

        <!-- EVENT GOALS -->
        @if($event->goals->count() > 0)
          <div class="bg-white p-5 rounded-xl shadow mt-6">
            <h2 class="font-semibold text-lg mb-4 text-[#233E98]">
              Event Goals
            </h2>
            <ul class="list-disc list-inside space-y-2">
              @foreach($event->goals as $goal)
                <li class="text-gray-600">{{ $goal->description }}</li>
              @endforeach
            </ul>
          </div>
        @endif


        <!-- ORGANIZER -->
        <div class="bg-white p-5 rounded-xl shadow">
          <h2 class="font-semibold text-lg mb-4 text-[#233E98]">
            Organizer
          </h2>

          <p class="font-medium">{{ $event->organizer }}</p>
          <p class="text-gray-500">{{ $event->contact_email }}</p>
          <p class="text-gray-500">{{ $event->contact_phone }}</p>
        </div>

      </div>

      <!-- RIGHT -->
      <aside>

        <div class="bg-white p-5 rounded-xl shadow mb-6">

          <h2 class="font-semibold mb-4">Registration</h2>

          <!-- PROGRESS -->
          @php
            $percent = ($event->quota > 0)
                ? ($event->quota_filled / $event->quota) * 100
                : 0;
          @endphp

          <div class="flex justify-between text-sm mb-2">
            <span>Quota</span>
            <span>{{ $event->quota_filled }}/{{ $event->quota }}</span>
          </div>

          <div class="w-full bg-gray-200 h-2 rounded-full mb-4">
            <div class="bg-blue-600 h-2 rounded-full"
                 style="width: {{ $percent }}%">
            </div>
          </div>

          <!-- PRICE -->
          <div class="text-center text-2xl font-bold mb-4">
            @if($event->is_paid)
              Rp {{ number_format($event->price, 0, ',', '.') }}
            @else
              Free
            @endif
          </div>

          <!-- BUTTON -->
          <button class="w-full bg-[#233E98] text-white py-2 rounded-lg">
            Register Now
          </button>

        </div>

        <a href="{{ route('events.index') }}"
           class="block text-center bg-gray-200 py-2 rounded-lg">
          Back to List
        </a>

      </aside>

    </div>

  </div>
</body>
</html>
