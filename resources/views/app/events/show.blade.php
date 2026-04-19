@extends('layouts.app', ['title' => $event->title])

@section('content')
    <section class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <div>
            <a href="{{ route('events.index') }}" class="mb-2 inline-flex text-sm text-blue-900 underline">Back to event list</a>
            <h1 class="text-3xl font-bold">{{ $event->title }}</h1>
            <p class="mt-1 text-slate-600">{{ $event->category ?? 'General' }} | {{ $event->organizer ?? 'Filkom Event Committee' }}</p>
        </div>

        <form method="POST" action="{{ route('events.bookmark.toggle', $event) }}">
            @csrf
            <button type="submit" class="rounded-lg bg-orange-500 px-4 py-2 text-white">
                {{ $isBookmarked ? 'Remove Bookmark' : 'Add Bookmark' }}
            </button>
        </form>
    </section>

    <section class="grid gap-4 md:grid-cols-[2fr_1fr]">
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 text-xl font-bold">Event Description</h2>
            <p class="text-slate-700">{{ $event->description ?? 'No description available.' }}</p>
        </article>

        <aside class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 text-xl font-bold">Information</h2>
            <div class="space-y-2 text-sm text-slate-700">
                <div><strong>Location:</strong> {{ $event->location }}</div>
                <div><strong>Start:</strong> {{ $event->starts_at->format('d M Y H:i') }}</div>
                <div><strong>End:</strong> {{ $event->ends_at->format('d M Y H:i') }}</div>
                <div><strong>Quota:</strong> {{ $event->quota }}</div>
                <div><strong>Seats left:</strong> {{ $event->seatsRemaining() }}</div>
                <div><strong>Fee:</strong> {{ $event->fee > 0 ? 'IDR '.number_format((float) $event->fee, 0, ',', '.') : 'Free' }}</div>
            </div>

            <div class="mt-4">
                @if ($registration)
                    <div class="rounded-lg bg-slate-100 p-3 text-sm">
                        <div class="font-semibold">You are registered.</div>
                        <div>Status: {{ ucfirst($registration->status) }}</div>
                        <div>Payment: {{ ucfirst($registration->payment_status) }}</div>
                    </div>

                    @if ($registration->payment && $registration->payment_status !== 'paid')
                        <a href="{{ route('payments.show', $registration) }}" class="mt-3 inline-flex rounded-lg bg-blue-900 px-4 py-2 text-sm text-white">Continue Payment</a>
                    @endif
                @else
                    <a href="{{ route('registrations.create', $event) }}" class="inline-flex rounded-lg bg-blue-900 px-4 py-2 text-sm text-white">Register Now</a>
                @endif
            </div>
        </aside>
    </section>
@endsection
