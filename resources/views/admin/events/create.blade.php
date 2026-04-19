@extends('layouts.admin', ['title' => 'Create Event'])

@section('content')
    <section class="mb-6">
        <h1 class="text-3xl font-bold">Create Event</h1>
        <p class="text-slate-600">Add a new event for students.</p>
    </section>

    <section class="rounded-xl bg-white p-5 shadow-sm">
        <form method="POST" action="{{ route('admin.events.store') }}" class="grid gap-4 md:grid-cols-2">
            @csrf

            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium">Title</label>
                <input name="title" value="{{ old('title') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Category</label>
                <input name="category" value="{{ old('category') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Organizer</label>
                <input name="organizer" value="{{ old('organizer') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Location</label>
                <input name="location" value="{{ old('location') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Status</label>
                <select name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', 'published') === 'published')>Published</option>
                    <option value="completed" @selected(old('status') === 'completed')>Completed</option>
                    <option value="cancelled" @selected(old('status') === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Start Time</label>
                <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">End Time</label>
                <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Quota</label>
                <input type="number" name="quota" value="{{ old('quota', 50) }}" min="1" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Fee (IDR)</label>
                <input type="number" name="fee" value="{{ old('fee', 0) }}" min="0" step="0.01" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <div class="md:col-span-2 flex items-center gap-2">
                <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-white">Save Event</button>
                <a href="{{ route('admin.events.index') }}" class="rounded-lg border border-slate-300 px-4 py-2">Cancel</a>
            </div>
        </form>
    </section>
@endsection
