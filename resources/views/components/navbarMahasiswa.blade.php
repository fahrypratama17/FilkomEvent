<aside class="flex w-80 shrink-0 flex-col rounded-r-[50px] bg-[#223E96] px-12 py-8 text-white shadow-sm">
  <div class="bg-primary-dark my-12 py-2 rounded-2xl">
    <h1 class="text-2xl font-extrabold text-center">FILKOM<span class="text-orange-550">EVENT</span></h1>
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
          <i data-lucide="{{ $item['icon'] }}"></i>
          <p>{{ $item['label'] }}</p>
        </a>
      @endforeach
    </nav>
  </div>

  <div class="pt-16">
    <h2 class="mb-8 text-[26px] font-extrabold tracking-wide">SETTING</h2>
    <div class="space-y-8">
      @foreach ($settingItems as $item)
        @php
          $isActive = request()->routeIs($item['route']);
          $routeName = str_replace('.*', '.index', $item['route']);
        @endphp

        <a href="{{ route($routeName) }}" class="flex items-center gap-4 text-[20px] transition {{ $isActive ? 'font-bold text-white' : 'text-white/70 hover:text-white' }}">
          <i data-lucide="{{ $item['icon'] }}"></i>
          <p>{{ $item['label'] }}</p>
        </a>
      @endforeach
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="flex w-full items-center gap-4 text-[20px] text-white/70 hover:text-white cursor-pointer">
          <i data-lucide="LogOut"></i>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>
</aside>
