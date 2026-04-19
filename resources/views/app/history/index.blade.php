@extends('layouts.app', ['title' => 'History'])

@section('content')
    <section class="mb-5">
        <h1 class="text-3xl font-bold">Registration History</h1>
        <p class="text-slate-600">Track all events you have joined and their payment status.</p>
    </section>

    @if ($registrations->isEmpty())
        <p class="rounded-xl bg-white p-5 text-slate-600 shadow-sm">No registrations found yet.</p>
    @else
        <div class="space-y-4">
            @foreach ($registrations as $registration)
                <article class="rounded-xl bg-white p-4 shadow-sm">
                    <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                        <h2 class="text-lg font-bold">{{ $registration->event->title }}</h2>
                        <div class="flex gap-2 text-xs">
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-blue-800">{{ ucfirst($registration->status) }}</span>
                            <span class="rounded-full bg-orange-100 px-3 py-1 text-orange-800">{{ ucfirst($registration->payment_status) }}</span>
                        </div>
                    </div>

                    <div class="mb-3 text-sm text-slate-600">
                        <div>{{ $registration->event->starts_at->format('d M Y H:i') }} | {{ $registration->event->location }}</div>
                        <div>Registered at: {{ optional($registration->registered_at)->format('d M Y H:i') ?? '-' }}</div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('events.show', $registration->event) }}" class="rounded-lg bg-blue-900 px-3 py-1.5 text-sm text-white">Event Detail</a>

                        @if ($registration->payment && $registration->payment_status !== 'paid')
                            <a href="{{ route('payments.show', $registration) }}" class="rounded-lg bg-orange-500 px-3 py-1.5 text-sm text-white">Continue Payment</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $registrations->links() }}
        </div>
    @endif
@endsection
