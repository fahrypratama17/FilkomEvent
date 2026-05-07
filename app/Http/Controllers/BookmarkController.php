<?php

namespace App\Http\Controllers;

use App\Service\MenuService;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
  public function index(Request $request)
  {
    $query = $request->search;

    $bookmarks = Event::with(['category', 'bookmarkedBy'])
      ->whereHas('bookmarkedBy', function ($q) {
        $q->where('bookmarks.user_id', auth()->id());
      })
      ->when($query, function ($q) use ($query) {
        $q->where('title', 'like', "%{$query}%");
      })
      ->latest()
      ->get();

    if ($request->ajax()) {
      return view('partials.bookmark-list', compact('bookmarks'))->render();
    }

    $user = Auth::user();

    return view('Mahasiswa.bookmark', [
      'bookmarks' => $bookmarks,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }
}
