@foreach ($events as $card)
  <x-event-card :event="$card" />
@endforeach

<div class="mt-8">
  {{ $events->links() }}
</div>

@if($events->isEmpty())
  <p class="col-span-3 text-center text-gray-400">
    Event tidak ditemukan...
  </p>
@endif
