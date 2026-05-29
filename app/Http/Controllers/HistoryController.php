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
      'event.certificate'
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

    $registrations = $query->paginate(6);

    $categories = Category::all();

    return view('Mahasiswa.history-event', [
      'registrations' => $registrations,
      'categories' => $categories,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }
}
