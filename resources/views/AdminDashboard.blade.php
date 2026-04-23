<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Admin - Dashboard</title>
</head>
<body>
@php
  $menuItems = [
      ['icon' => 'assets/icons/home.svg', 'label' => 'Dashboard', 'active' => true],
      ['icon' => 'assets/icons/bookmark.svg', 'label' => 'Events', 'active' => false],
      ['icon' => 'assets/icons/history.svg', 'label' => 'User Management', 'active' => false],
  ];

  $settingItems = [
      ['icon' => 'assets/icons/profile.svg', 'label' => 'Profile'],
      ['icon' => 'assets/icons/logout.svg', 'label' => 'Logout'],
  ];

  $adminCard = [
    ['title' => "Event Management", 'desc' => "Manage all existing events by editing information and monitoring event status.", 'action' => "Enter Event Management"],
    ['title' => "Add Event", 'desc' => "Create new events easily and quickly.", 'action' => "Add New Event"],
    ['title' => "Account Management", 'desc' => "Manage user access rights.", 'action' => "Manage Users"],
  ];

  $actCard = [
    ['title' => "John Doe mendaftar untuk event Workshop React.js", 'desc' => "2 minutes ago"],
    ['title' => "The Digital Marketing Seminar Event has been updated", 'desc' => "30 minutes ago"],
    ['title' => "UI/UX Workshop Certificate for the event has been uploaded", 'desc' => "1 hour ago"],
  ];

  $stats = [
      ['value' => '24', 'label' => 'Total Event'],
      ['value' => '08', 'label' => 'Event Takes Place'],
      ['value' => '15', 'label' => 'New Registrant'],
  ];

  $reqAction = [
    ['title' => "Workshop UI/UX Design", 'desc' => "Completed 2 days ago - Upload Certificate"],
    ['title' => "Web Development Training", 'desc' => "Finished today - Upload Certificate"],
  ]
@endphp

<section class="mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
  <div class="flex w-82.5 shrink-0 flex-col rounded-r-[26px] bg-[#223E96] px-12 py-8 text-white shadow-sm">
    <div class="mb-14">
      <div class="mb-3 flex items-center gap-3">
        <h1 class="">Filkom Event</h1>
          <div class="hidden leading-none">
        <div class="text-[30px] font-extrabold tracking-wide">FILKOM</div>
        <div class="text-[30px] font-extrabold tracking-wide">EVENT</div>
      </div>
    </div>
  </div>

  <div>
    <h2 class="mb-8 text-[26px] font-extrabold tracking-wide">MAIN MENU</h2>
    <nav class="space-y-8">
      @foreach ($menuItems as $item)
        <div class="flex items-center gap-8 text-[24px] {{ $item['active'] ? 'font-bold text-white' : 'text-white/90' }}">

          <span>{{ $item['label'] }}</span>
        </div>
      @endforeach
    </nav>
  </div>

  <div class="mt-auto pt-16">
    <h2 class="mb-8 text-[26px] font-extrabold tracking-wide">SETTING</h2>
    <div class="space-y-8">
      @foreach ($settingItems as $item)
        <div class="flex items-center gap-8 text-[24px] text-white/90">
          <span>{{ $item['label'] }}</span>
        </div>
      @endforeach
    </div>
  </div>
  </div>

  <div class="flex-1 overflow-y-auto px-12 py-8">
    <div class="mb-8 flex items-start justify-between gap-6">
      <div class="relative w-full max-w-[660px]">
        <input
          type="text"
          placeholder="Search here"
          class="h-14 w-full rounded-xl border-0 bg-[#03479B] pl-16 pr-5 text-lg text-white placeholder:text-white/80 focus:outline-none"
        >
      </div>

      <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
      </button>
    </div>

    <div class="mb-8 flex items-center gap-5">
      <div class="flex h-19.5 w-19.5 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-sm">

      </div>
      <h1 class="text-[60px] font-extrabold leading-none tracking-tight text-black">
        Welcome, <span class="text-[#FF742E]">Admin!</span>
      </h1>
    </div>

    <section class="mb-12 grid grid-cols-3 gap-12">
      @foreach($adminCard as $item)
        <div class="w-full bg-secondary-dark rounded-[20px] flex flex-col gap-4 p-4 text-white">
          <div class="h-15 w-15 rounded-2xl bg-white"></div>
          <h1 class="text-2xl">{{$item['title']}}</h1>
          <p class="text-sm">{{$item['desc']}}</p>
          <button class="bg-orange rounded-full py-2 mt-auto cursor-pointer hover:scale-105 duration-300" type="submit">{{$item['action']}}</button>
        </div>
      @endforeach
    </section>

    <div class="grid grid-cols-[308px_1fr] gap-12 pb-6">
      <div class="rounded-3xl bg-[#0790C7] px-7 py-7 text-white shadow-sm">
        <h2 class="mb-6 text-[28px] font-extrabold leading-tight">
          New Activities
        </h2>

        <div class="space-y-7">
          @foreach ($actCard as $item)
            <div class="flex justify-between rounded-[20px] bg-[#ECECEC] gap-4 px-6 py-5">
              <div class="bg-primary-dark  w-10 h-5 rounded-full"></div>
              <div>
                <h2 class="text-[14px] font-bold text-[#FF6A27]">{{ $item['title'] }}</h2>
                <p class="text-[11px] text-[#314A9A]">{{ $item['desc'] }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="rounded-3xl bg-[#16B6D9] px-9 py-9 shadow-sm">
        <div class="mb-9 grid grid-cols-3 gap-9">
          @foreach ($stats as $item)
            <div class="flex h-42.5 items-center justify-center rounded-3xl bg-[#FF6A27] px-6 text-center text-white">
              <div>
                <div class="mb-4 text-[54px] font-extrabold leading-none">{{ $item['value'] }}</div>
                <div class="text-[17px] leading-snug">{{ $item['label'] }}</div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="flex flex-col gap-8 h-auto p-8 overflow-hidden rounded-[28px] bg-[#FF6A27]">
          <h1 class="text-3xl text-white font-bold">Event Require Action</h1>
          @foreach($reqAction as $item)
            <div class="flex gap-4 bg-white p-4 w-full rounded-3xl">
              <div class="w-15 h-15 rounded-2xl bg-primary-dark"></div>
              <div class="flex flex-col">
                <h4 class="text-[20px]">{{$item['title']}}</h4>
                <p>{{$item['desc']}}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
