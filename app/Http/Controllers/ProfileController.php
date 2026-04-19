<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $stats = [
            'joined_events' => $user->registrations()->count(),
            'paid_events' => $user->registrations()->where('payment_status', 'paid')->count(),
            'bookmarks' => $user->bookmarkedEvents()->count(),
        ];

        return view('app.profile.index', compact('user', 'stats'));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (! Hash::check($validated['current_password'], $request->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        $request->user()->update([
            'password' => $validated['password'],
        ]);

        return back()->with('status', 'Password updated successfully.');
    }
}
