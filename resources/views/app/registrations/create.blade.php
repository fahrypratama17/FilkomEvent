@extends('layouts.app', ['title' => 'Event Registration'])

@section('content')
    <section class="mb-5">
        <a href="{{ route('events.show', $event) }}" class="text-sm text-blue-900 underline">Back to event detail</a>
        <h1 class="mt-2 text-3xl font-bold">Register for {{ $event->title }}</h1>
        <p class="mt-1 text-slate-600">Fill the form below to complete registration.</p>
    </section>

    <section class="grid gap-4 md:grid-cols-[1fr_2fr]">
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 text-lg font-bold">Event Summary</h2>
            <div class="space-y-2 text-sm text-slate-700">
                <div><strong>Location:</strong> {{ $event->location }}</div>
                <div><strong>Date:</strong> {{ $event->starts_at->format('d M Y H:i') }}</div>
                <div><strong>Quota Left:</strong> {{ $event->seatsRemaining() }}</div>
                <div><strong>Fee:</strong> {{ $event->fee > 0 ? 'IDR '.number_format((float) $event->fee, 0, ',', '.') : 'Free' }}</div>
            </div>
        </article>

        <article class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 text-lg font-bold">Registration Form</h2>
            <form method="POST" action="{{ route('registrations.store', $event) }}" class="space-y-4">
                @csrf

                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium">Name</label>
                        <input type="text" value="{{ $student->name }}" readonly class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">Student ID</label>
                        <input type="text" value="{{ $student->student_id }}" readonly class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2">
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium">Email</label>
                    <input type="text" value="{{ $student->email }}" readonly class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2">
                </div>

                <div>
                    <label for="motivation" class="mb-1 block text-sm font-medium">Motivation (minimum 50 characters)</label>
                    <textarea id="motivation" name="motivation" rows="5" required class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('motivation') }}</textarea>
                </div>

                <label class="flex items-start gap-2 text-sm">
                    <input type="checkbox" name="agreed_terms" value="1" class="mt-1 h-4 w-4 rounded">
                    <span>I agree to the terms and commit to attend the event session.</span>
                </label>

                <button type="submit" class="rounded-lg bg-blue-900 px-4 py-2 text-white">Submit Registration</button>
            </form>
        </article>
    </section>
@endsection
