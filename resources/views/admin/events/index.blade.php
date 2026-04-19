@extends('layouts.admin', ['title' => 'Manage Events'])

@section('content')
    <section class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">Manage Events</h1>
            <p class="text-slate-600">Create, edit, and remove events.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm text-white">Add Event</a>
    </section>

    <section class="overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Quota</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3">{{ $event->title }}</td>
                        <td class="px-4 py-3">{{ $event->starts_at->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3">{{ ucfirst($event->status) }}</td>
                        <td class="px-4 py-3">{{ $event->quota }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.events.edit', $event) }}" class="rounded bg-blue-700 px-3 py-1 text-white">Edit</a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded bg-red-600 px-3 py-1 text-white">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-slate-600">No events found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="mt-6">
        {{ $events->links() }}
    </div>
@endsection
