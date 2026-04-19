@extends('layouts.app', ['title' => 'Bookmarks'])

@section('content')
    <section class="mb-5">
        <h1 class="text-3xl font-bold">My Bookmarks</h1>
        <p class="text-slate-600">Events you saved for later.</p>
    </section>

    @if ($events->isEmpty())
        <p class="rounded-xl bg-white p-5 text-slate-600 shadow-sm">You have no bookmarked events yet.</p>
    @else
        <section class="grid gap-4 md:grid-cols-2">
            @foreach ($events as $event)
                <article class="rounded-xl bg-white p-4 shadow-sm">
                    <div class="mb-2 text-xs font-semibold uppercase text-blue-700">{{ $event->category ?? 'General' }}</div>
                    <h2 class="mb-2 text-lg font-bold">{{ $event->title }}</h2>
                    <p class="mb-3 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($event->description, 110) }}</p>
                    <div class="mb-3 text-sm text-slate-700">
                        <div>{{ $event->starts_at->format('d M Y H:i') }}</div>
                        <div>{{ $event->location }}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('events.show', $event) }}" class="rounded-lg bg-blue-900 px-3 py-1.5 text-sm text-white">Details</a>
                        <form method="POST" action="{{ route('events.bookmark.toggle', $event) }}">
                            @csrf
                            <button type="submit" class="rounded-lg bg-orange-500 px-3 py-1.5 text-sm text-white">Remove</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </section>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    @endif
@endsection
