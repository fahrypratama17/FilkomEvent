@foreach ($bookmarks as $bookmark)
  <x-event-card :event="$bookmark" />
@endforeach

@if($bookmarks->isEmpty())
  <p class="text-center text-gray-400 col-span-3">
    Tidak ada event ditemukan...
  </p>
@endif
