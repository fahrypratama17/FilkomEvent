<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(Request $request): View
    {
        $registrations = $request->user()
            ->registrations()
            ->with(['event', 'payment'])
            ->latest('registered_at')
            ->paginate(10);

        return view('app.history.index', compact('registrations'));
    }
}
