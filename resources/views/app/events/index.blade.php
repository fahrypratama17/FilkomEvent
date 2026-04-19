@extends('layouts.app', ['title' => 'Events'])

@section('content')
    <section class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-3xl font-bold">Events</h1>
            <p class="text-slate-600">Discover and join upcoming FILKOM events.</p>
        </div>
    </section>

    <section class="mb-6 rounded-xl bg-white p-4 shadow-sm">
        <form method="GET" action="{{ route('events.index') }}" class="grid gap-3 md:grid-cols-4">
            <input name="search" value="{{ request('search') }}" placeholder="Search event" class="rounded-lg border border-slate-300 px-3 py-2">

            <select name="category" class="rounded-lg border border-slate-300 px-3 py-2">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>

            <select name="status" class="rounded-lg border border-slate-300 px-3 py-2">
                <option value="">All Status</option>
                <option value="upcoming" @selected(request('status') === 'upcoming')>Upcoming</option>
                <option value="ongoing" @selected(request('status') === 'ongoing')>Ongoing</option>
                <option value="completed" @selected(request('status') === 'completed')>Completed</option>
            </select>

            <button type="submit" class="rounded-lg bg-blue-900 px-4 py-2 font-medium text-white">Apply Filters</button>
        </form>
    </section>

    @if ($events->isEmpty())
        <p class="rounded-xl bg-white p-5 text-slate-600 shadow-sm">No events found for current filters.</p>
    @else
        <section class="grid gap-4 md:grid-cols-3">
            @foreach ($events as $event)
                <article class="rounded-xl bg-white p-4 shadow-sm">
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase text-blue-700">{{ $event->category ?? 'General' }}</span>
                        <span class="text-xs text-slate-500">{{ $event->starts_at->format('d M Y') }}</span>
                    </div>
                    <h2 class="mb-2 text-lg font-bold">{{ $event->title }}</h2>
                    <p class="mb-3 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                    <div class="mb-3 space-y-1 text-sm text-slate-700">
                        <div>{{ $event->location }}</div>
                        <div>Seats left: {{ $event->seatsRemaining() }}</div>
                        <div>Fee: {{ $event->fee > 0 ? 'IDR '.number_format((float) $event->fee, 0, ',', '.') : 'Free' }}</div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('events.show', $event) }}" class="inline-flex rounded-lg bg-blue-900 px-3 py-1.5 text-sm text-white">Details</a>
                        <form method="POST" action="{{ route('events.bookmark.toggle', $event) }}">
                            @csrf
                            <button type="submit" class="inline-flex rounded-lg bg-orange-500 px-3 py-1.5 text-sm text-white">
                                {{ in_array($event->id, $bookmarkedEventIds, true) ? 'Unbookmark' : 'Bookmark' }}
                            </button>
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
