<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MenuService;
use App\Models\Category;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();

    $query = Registration::with([
      'event.category',
      'certificate',
    ])
      ->where('user_id', $user->user_id)
      ->orderBy('registration_date', 'desc');

    if ($request->search) {
      $query->whereHas('event', function ($q) use ($request) {
        $q->where('title', 'like', '%' . $request->search . '%');
      });
    }

    if ($request->category) {
      $query->whereHas('event', function ($q) use ($request) {
        $q->where('category_id', $request->category);
      });
    }

    $registrations = $query->paginate(6)
      ->appends($request->only(['search', 'category']));

    $categories = Category::all();

    if ($request->ajax()) {
      return view('partials.history-list', [
        'registrations' => $registrations,
      ])->render();
    }

    return view('Mahasiswa.history', [
      'registrations' => $registrations,
      'categories' => $categories,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }
}
