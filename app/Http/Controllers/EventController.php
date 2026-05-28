<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MenuService;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
  public function index(Request $request)
  {
    $query = Event::with(['category', 'bookmarkedBy' => function ($q) {
      $q->where('bookmarks.user_id', auth()->id());
    }])->latest();

    if ($request->search) {
      $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->category) {
      $query->where('category_id', $request->category);
    }

    if ($request->status) {
      if ($request->status === 'akan_datang') {
        $query->where('event_start', '>', now());
      }

      if ($request->status === 'berlangsung') {
        $query->where('event_start', '<=', now())
          ->where('event_end', '>=', now());
      }

      if ($request->status === 'selesai') {
        $query->where('event_end', '<', now());
      }

      if ($request->status === 'dibatalkan') {
        $query->where('event_status', 'Dibatalkan');
      }
    }

    $events = $query->paginate(6);

    $categories = Category::all();

    if ($request->ajax()) {
      return view('partials.event-list', compact('events'))->render();
    }

    $user = Auth::user();

    return view('Mahasiswa.list-event', [
      'events' => $events,
      'categories' => $categories,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }

  public function show($id) {
    $user = Auth::user();
    $event = Event::with('category', 'speakers', 'goals')->findOrFail($id);

    return view ('Mahasiswa.detail-event', [
      'event' => $event,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }

  public function registration($id) {
    $user = Auth::user();
    $event = Event::with('category')->findOrFail($id);

    return view ('Mahasiswa.registration-event', [
      'event' => $event,
      'user' => $user,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }

  public function payment($id) {
    $user = Auth::user();
    $event = Event::with('category')->findOrFail($id);

    return view ('Mahasiswa.payment', [
      'event' => $event,
      'user' => $user,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }

  public function toggleBookmark($id) {
    $user = auth()->user();

    if ($user->bookmarks()->where('events.event_id', $id)->exists()) {
      $user->bookmarks()->detach($id);
    } else {
      $user->bookmarks()->attach($id);
    }

    return response()->json([
      'status' => 'ok'
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'event_id'          => 'required', 
      'title'             => 'required',
      'event_start'       => 'required',
      'location'          => 'required',
      'short_description' => 'required',
      'description'       => 'required',
    ]);

    try {
      $idEvent = $request->event_id;

      $isExists = Event::where('event_id', $idEvent)->exists();
      
      if ($isExists) {
        do {
          $idEvent = 'EVT-' . strtoupper(\Illuminate\Support\Str::random(6));
          $checkAgain = Event::where('event_id', $idEvent)->exists();
        } while ($checkAgain);
      }

      Event::create([
        'event_id'            => $idEvent, 
        'title'               => $request->title,
        'event_start'         => $request->event_start,
        'event_end'           => $request->event_end,
        'location'            => $request->location,
        'quota'               => $request->quota,
        'event_status'        => $request->event_status,
        'registration_status' => $request->registration_status,
        'is_paid'             => $request->is_paid,
        'price'               => $request->price ?? 0,
        'category_id'         => $request->category_id,
        'organizer'           => $request->organizer,
        'contact_email'       => $request->contact_email,
        'contact_phone'       => $request->contact_phone,
        'short_description'   => $request->short_description,
        'description'         => $request->description,
        'event_purpose'       => $request->event_purpose,
        'created_by'          => auth()->id(),
      ]);

      return redirect()->back()->with('success', 'Event Berhasil Disimpan di Database');

    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Event Gagal Disimpan ke Database');
    }
  }
}