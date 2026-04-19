@extends('layouts.admin', ['title' => 'Edit Event'])

@section('content')
    <section class="mb-6">
        <h1 class="text-3xl font-bold">Edit Event</h1>
        <p class="text-slate-600">Update event details.</p>
    </section>

    <section class="rounded-xl bg-white p-5 shadow-sm">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="grid gap-4 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium">Title</label>
                <input name="title" value="{{ old('title', $event->title) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('description', $event->description) }}</textarea>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Category</label>
                <input name="category" value="{{ old('category', $event->category) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Organizer</label>
                <input name="organizer" value="{{ old('organizer', $event->organizer) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Location</label>
                <input name="location" value="{{ old('location', $event->location) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Status</label>
                <select name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="draft" @selected(old('status', $event->status) === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $event->status) === 'published')>Published</option>
                    <option value="completed" @selected(old('status', $event->status) === 'completed')>Completed</option>
                    <option value="cancelled" @selected(old('status', $event->status) === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Start Time</label>
                <input type="datetime-local" name="starts_at" value="{{ old('starts_at', $event->starts_at->format('Y-m-d\\TH:i')) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">End Time</label>
                <input type="datetime-local" name="ends_at" value="{{ old('ends_at', $event->ends_at->format('Y-m-d\\TH:i')) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Quota</label>
                <input type="number" name="quota" value="{{ old('quota', $event->quota) }}" min="1" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Fee (IDR)</label>
                <input type="number" name="fee" value="{{ old('fee', $event->fee) }}" min="0" step="0.01" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div class="md:col-span-2 flex items-center gap-2">
                <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-white">Update Event</button>
                <a href="{{ route('admin.events.index') }}" class="rounded-lg border border-slate-300 px-4 py-2">Cancel</a>
            </div>
        </form>
    </section>
@endsection
