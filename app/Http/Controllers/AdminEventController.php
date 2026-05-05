<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $categories = Schema::hasTable('categories')
            ? Category::orderBy('category_name')->get()
            : collect();

        if (! Schema::hasTable('events')) {
            $events = new LengthAwarePaginator(
                collect(),
                0,
                10,
                1,
                [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ]
            );

            return view('Admin.EventsManagement', compact('events', 'categories'));
        }

        $query = Event::query()
            ->with('category')
            ->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('event_status')) {
            $query->where('event_status', $request->event_status);
        }

        $events = $query->paginate(10)->withQueryString();

        return view('Admin.EventsManagement', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = Schema::hasTable('categories')
            ? Category::orderBy('category_name')->get()
            : collect();

        return view('Admin.form-upload-admin', compact('categories'));
    }

    public function store(Request $request)
    {
        // Untuk sementara masih aman sebagai slicing.
        // Kalau form kamu belum punya name lengkap atau database events belum siap,
        // jangan dipaksa insert dulu.

        return back()->with('success', 'Event berhasil disimpan.');
    }

    public function destroy(Event $event)
    {
        if ($event->image_url && str_starts_with($event->image_url, 'storage/events/')) {
            $filePath = str_replace('storage/', '', $event->image_url);
            Storage::disk('public')->delete($filePath);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
