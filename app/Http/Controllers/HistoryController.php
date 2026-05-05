<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MenuService;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request) {
      $query = Event::with(['category', 'bookmarkedBy' => function ($q) {
        $q->where('bookmarks.user_id', auth()->id());
      }])->latest();

      if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
      }

      if ($request->category) {
        $query->where('category_id', $request->category);
      }

      $events = $query->paginate(6);

      $categories = Category::all();

      $user = Auth::user();

      return view('Mahasiswa.history', [
        'events' => $events,
        'categories' => $categories,
        'menuItems' => MenuService::getMenu($user->role),
        'settingItems' => MenuService::getSetting(),
      ]);
    }
}
