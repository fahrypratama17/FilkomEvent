<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Filkom Event - Dashboard</title>
</head>
<body>
@php
  $stats = [
      ['value' => '14', 'label' => 'Acara yang Diikuti', 'icon' => 'UserRound'],
      ['value' => '08', 'label' => 'Sertifikat yang Diperoleh', 'icon' => 'Award'],
      ['value' => '04', 'label' => 'Acara Mendatang', 'icon' => 'Calendar'],
  ];
@endphp

  <div class="relative mx-auto flex min-h-screen w-full overflow-hidden bg-[#EAEAEA]">
    <div class="absolute w-full h-full opacity-4"
         style="background-image: radial-gradient(#001d3d 1px, transparent 2px); background-size: 10px 10px;">
    </div>

    @include('components.sidebarMahasiswa', [
      'menuItems' => $menuItems,
      'settingItems' => $settingItems
    ])

    <main class="relative flex-1 overflow-y-auto px-12 py-8">
      <header class="mb-8 flex items-start justify-between gap-6">
        <div class="relative w-full max-w-165">
          <i data-lucide="Search" class="absolute bottom-4 left-4 text-gray-400"></i>
          <input
            type="text"
            placeholder="Cari Event..."
            class="h-14 w-full rounded-2xl bg-white border pl-14 pr-5 focus:outline-none text-gray-400 placeholder:text-gray-400 active:ring-1 active:ring-primary-lighter focus:ring-1 focus:ring-primary-lighter transition-all duration-300"
          >
        </div>

        <button class="flex h-14.5 w-14.5 items-center justify-center rounded-full bg-[#233E98] hover:scale-105 duration-200 shadow-sm cursor-pointer">
          <i data-lucide="UserRound" class="w-10 h-10 text-orange-550"></i>
        </button>
      </header>

      <div class="mb-12 flex items-center gap-5">
        <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko" class="w-20 h-20 drop-shadow-2xl">
        <div class="relative overflow-hidden shimmer bg-linear-to-r from-secondary-lighter via-white/40 to-white/80 p-4 rounded-4xl backdrop-blur-3xl">
          <h1 class="text-[32px] font-extrabold leading-none tracking-tight text-black">
            Selamat Datang, <span class="text-[#FF742E]">{{ Auth::user()->name ?? "Mahasiswa" }}</span>
          </h1>
        </div>
      </div>

      <div class="mb-8 flex items-center justify-between">
        <p class="font-bold">FILKOM EVENT</p>
        <button onclick="location.href='/list-event'" class="flex items-center gap-2 text-[18px] font-medium  hover:scale-105 duration-200 cursor-pointer">
          Tampilkan Semua
          <i data-lucide="ChevronRight" class="w-6"></i>
        </button>
      </div>

      <section class="mb-12 grid grid-cols-3 gap-12">
        @foreach ($events as $card)
          <x-eventCard :event="$card" />
        @endforeach
      </section>

      <section class="grid grid-cols-[0.5fr_1fr] gap-12 pb-6">
        <div class="rounded-3xl bg-linear-to-br from-secondary-lighter to-primary-dark px-7 py-7 text-white shadow-[0_25px_60px_rgba(0,0,0,0.4)] border border-white/80">
          <h2 class="mb-6 text-[28px] font-extrabold leading-tight">
            Kategori Acara Populer
          </h2>

          <div class="space-y-7 ">
            @foreach ($categories as $category)
              <div class="flex items-center justify-between rounded-[20px] bg-[#ECECEC] px-6 py-5 border-2 border-white/20 hover:scale-105 duration-300">
                <div class="flex items-center gap-6">
                  <div>
                    <i class="text-orange-550 w-8 h-8" data-lucide="{{ $category->icon }}"></i>
                  </div>
                  <div>
                    <p class="text-xl font-bold text-orange-550">{{ $category->category_name }}</p>
                    <p class="text-[14px] text-primary-dark/60">{{ $category->events_count }} Events</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="flex flex-col gap-4 rounded-3xl bg-[#16B6D9] px-9 py-9 h-full border-2 border-white/20 shadow-[0_25px_60px_rgba(0,0,0,0.4)]">
          <div class="mb-9 grid grid-cols-3 gap-9">
            @foreach ($stats as $item)
              <div class="relative flex flex-col h-42.5 items-center justify-center rounded-3xl bg-[#FF6A27] px-6 text-center text-white shadow-[12px_12px_0px_rgba(0,0,0,0.5)]">
                <div class="absolute top-4 right-4 opacity-40">
                  <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6"></i>
                </div>
                <div class="mb-4 text-[54px] font-extrabold leading-none">{{ $item['value'] }}</div>
                <div class="text-lg text-white/80">{{ $item['label'] }}</div>
              </div>
            @endforeach
          </div>

          <div class="rounded-[28px] bg-[#FF6A27] h-full">
            <div class="flex flex-col items-center justify-center h-full gap-6">

              <div class="relative w-44 h-44">
                <div id="donutChart" class="absolute inset-0 rounded-full"></div>

                <div class="absolute inset-8 bg-[#FF6A27] rounded-full flex flex-col items-center justify-center text-white">
                  <p class="text-xs opacity-80">Total</p>
                  <p class="text-xl font-bold" id="totalEvents">0</p>
                </div>
              </div>

              <div id="chartLegend" class="flex flex-wrap justify-center gap-4 text-white text-xs"></div>

              <div id="tooltip"
                   class="fixed hidden px-3 py-2 text-xs text-white bg-black/80 rounded-lg shadow-lg pointer-events-none z-50">
              </div>

            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

<script>
  const categoryData = @json($categoryStats);

  const chart = document.getElementById('donutChart');
  const legend = document.getElementById('chartLegend');
  const totalText = document.getElementById('totalEvents');
  const tooltip = document.getElementById('tooltip');

  const colors = [
    '#1E90FF',
    '#FFD700',
    '#FF4D4D',
    '#00C49F',
    '#A78BFA'
  ];

  const total = categoryData.reduce((sum, item) => sum + parseInt(item.total), 0);
  totalText.innerText = total;

  if (total === 0) {
    chart.style.background = '#ddd';
    legend.innerHTML = '<p class="text-white/70">Belum ada data</p>';
  } else {
    let currentPercent = 0;
    let gradientParts = [];

    categoryData.forEach((item, index) => {
      const percent = (item.total / total) * 100;
      const start = currentPercent;
      const end = currentPercent + percent;
      const color = colors[index % colors.length];

      gradientParts.push(`${color} ${start}% ${end}%`);

      // Legend element
      const div = document.createElement('div');
      div.className = "flex items-center gap-2 cursor-pointer";
      div.innerHTML = `
        <span class="w-3 h-3 rounded-full" style="background:${color}"></span>
        ${item.category_name}
      `;

      // 🔥 Tooltip events
      div.addEventListener('mousemove', (e) => {
        tooltip.classList.remove('hidden');
        tooltip.innerHTML = `
          <strong>${item.category_name}</strong><br>
          ${item.total} events<br>
          ${percent.toFixed(1)}%
        `;
        tooltip.style.top = (e.clientY + 12) + 'px';
        tooltip.style.left = (e.clientX + 12) + 'px';
      });

      div.addEventListener('mouseleave', () => {
        tooltip.classList.add('hidden');
      });

      legend.appendChild(div);

      currentPercent = end;
    });

    // Animasi chart
    chart.style.transition = 'background 1s ease';
    setTimeout(() => {
      chart.style.background = `conic-gradient(${gradientParts.join(',')})`;
    }, 200);
  }
</script>
</body>
</html>
