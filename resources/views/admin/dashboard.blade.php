@extends('layouts.admin', ['title' => 'Admin Dashboard'])

@section('content')
    <section class="mb-6">
        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
        <p class="text-slate-600">Monitor events and registrations.</p>
    </section>

    <section class="mb-6 grid gap-4 md:grid-cols-3">
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Total Events</div>
            <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_events'] }}</div>
        </article>
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Published Events</div>
            <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['published_events'] }}</div>
        </article>
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Total Registrations</div>
            <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_registrations'] }}</div>
        </article>
    </section>

    <section class="mb-6 grid gap-4 md:grid-cols-2">
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 text-xl font-bold">Recent Registrations</h2>
            <div class="space-y-2 text-sm">
                @forelse ($recentRegistrations as $registration)
                    <div class="rounded-lg bg-slate-50 p-3">
                        {{ $registration->user->name }} registered for {{ $registration->event->title }}
                    </div>
                @empty
                    <p class="text-slate-600">No registrations yet.</p>
                @endforelse
            </div>
        </article>

        <article class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 text-xl font-bold">Events Requiring Action</h2>
            <div class="space-y-2 text-sm">
                @forelse ($eventsRequiringAction as $event)
                    <div class="rounded-lg bg-slate-50 p-3">
                        {{ $event->title }} ended on {{ $event->ends_at->format('d M Y') }}
                    </div>
                @empty
                    <p class="text-slate-600">No pending actions.</p>
                @endforelse
            </div>
        </article>
    </section>

    <a href="{{ route('admin.events.index') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm text-white">Manage Events</a>
@endsection
