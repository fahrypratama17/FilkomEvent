<aside class="flex w-[330px] shrink-0 flex-col rounded-r-[26px] bg-[#223E96] px-12 py-8 text-white shadow-sm">
  <div class="mb-14">
    <div class="mb-3 flex items-center gap-3">
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
        @php
            $isActive = request()->routeIs($item['route']);
            $routeName = str_replace('.*', '.index', $item['route']);
        @endphp

        <a href="{{ route($routeName) }}" class="flex items-center gap-4 text-[20px] transition {{ $isActive ? 'font-bold text-white' : 'text-white/70 hover:text-white' }}">
            {{ $item['label'] }}
        </a>
      @endforeach
    </nav>
  </div>

  <div class="mt-auto pt-16">
    <h2 class="mb-8 text-[26px] font-extrabold tracking-wide">SETTING</h2>
    <div class="space-y-8">
      @foreach ($settingItems as $item)
        <div class="flex items-center gap-8 text-[24px] text-white/90">
          <div class="flex h-10 w-10 items-center justify-center">

          </div>
          <span>{{ $item['label'] }}</span>
        </div>
      @endforeach
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="flex w-full items-center gap-8 text-[24px] text-white/90">
          <div class="flex h-10 w-10 items-center justify-center">

          </div>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>
</aside>
