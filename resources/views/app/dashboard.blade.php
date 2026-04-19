@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <section class="mb-8">
        <h1 class="mb-2 text-3xl font-bold">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-slate-600">Track events, registrations, bookmarks, and payment status in one place.</p>
    </section>

    <section class="mb-8 grid gap-4 md:grid-cols-3">
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Events Attended</div>
            <div class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['events_attended'] }}</div>
        </article>
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Bookmarked Events</div>
            <div class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['bookmarks'] }}</div>
        </article>
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Upcoming Registered Events</div>
            <div class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['upcoming_events'] }}</div>
        </article>
    </section>

    <section class="rounded-xl bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-bold">Upcoming Events</h2>
            <a href="{{ route('events.index') }}" class="rounded-lg bg-blue-900 px-3 py-1.5 text-sm text-white">View all events</a>
        </div>

        @if ($events->isEmpty())
            <p class="text-slate-600">No upcoming events available yet.</p>
        @else
            <div class="grid gap-4 md:grid-cols-3">
                @foreach ($events as $event)
                    <article class="rounded-lg border border-slate-200 p-4">
                        <div class="mb-2 text-xs font-semibold uppercase text-blue-700">{{ $event->category ?? 'General' }}</div>
                        <h3 class="mb-2 text-lg font-semibold">{{ $event->title }}</h3>
                        <p class="mb-3 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($event->description, 90) }}</p>
                        <div class="mb-3 space-y-1 text-sm text-slate-700">
                            <div>{{ $event->starts_at->format('d M Y H:i') }} - {{ $event->ends_at->format('H:i') }}</div>
                            <div>{{ $event->location }}</div>
                            <div>Fee: {{ $event->fee > 0 ? 'IDR '.number_format((float) $event->fee, 0, ',', '.') : 'Free' }}</div>
                        </div>
                        <a href="{{ route('events.show', $event) }}" class="inline-flex rounded-lg bg-orange-500 px-3 py-1.5 text-sm font-medium text-white">
                            See details
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
