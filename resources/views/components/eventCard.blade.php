@vite(['resources/css/app.css', 'resources/js/app.js'])

@php
  $isBookmarked = $event->bookmarkedBy->isNotEmpty();
@endphp

<article class="w-full h-full flex flex-col gap-4 bg-white/70 backdrop-blur-lg p-4 border-2 border-white rounded-3xl shadow-xl hover:scale-103 hover:shadow-2xl transition-all duration-200">
  <div class="relative">
    <img src="{{ asset($event->image_url) }}" alt="{{ $event->title }}" class="w-full h-70 object-cover rounded-2xl">
    <p class="absolute top-2 left-2 bg-orange-550 p-2 text-[12px] rounded-2xl font-bold">{{ $event->category->category_name ?? 'No Category' }}</p>
  </div>
  <div class="flex flex-col gap-2 px-2">
    <p class="text-black/60">{{ \Carbon\Carbon::parse($event->event_start)->format('d M, Y') }}</p>
    <h3 class="text-[18px] font-bold">{{ $event->title }}</h3>
    <p class="text-[14px] font-light line-clamp-2 text-black/60">{{ $event->short_description }}</p>
  </div>
  <div class="flex items-center justify-between px-2 text-[14px] mb-8">
    <p class="flex items-center gap-1"><i data-lucide="UsersRound" class="w-4 h-4 text-orange-550"></i>{{ $event->quota }} participants</p>
    <p class="flex items-center gap-1"><i data-lucide="Clock" class="w-4 h-4 text-orange-550"></i><span>{{ \Carbon\Carbon::parse($event->event_start)->format('H:i') }} -</span><span>{{ \Carbon\Carbon::parse($event->event_end)->format('H:i') }} WIB</span></p>
  </div>
  <div class="flex gap-4 mt-auto">
    <button onclick="location.href='{{ route('events.show', $event->event_id) }}'" class="w-full bg-orange-550 px-4 py-2 rounded-2xl cursor-pointer shadow-xl hover:scale-105 text-white duration-300">Detail Event</button>
    <button onclick="toggleBookmark({{ $event->event_id }}, this)" class="bookmark-btn {{ $isBookmarked ? 'bg-orange-550 text-white' : 'bg-white' }} p-2 rounded-2xl transition duration-200 hover:scale-105 shadow-xl cursor-pointer">
      <i data-lucide="Bookmark" class="{{ $isBookmarked ? 'fill-white' : '' }}"></i>
    </button>
  </div>
</article>
