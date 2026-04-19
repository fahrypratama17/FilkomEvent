<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function create(Request $request, Event $event): View|RedirectResponse
    {
        $existing = $request->user()->registrations()
            ->where('event_id', $event->id)
            ->first();

        if ($existing) {
            return redirect()->route('history')->with('status', 'You are already registered for this event.');
        }

        if ($event->seatsRemaining() < 1) {
            return redirect()->route('events.index')->withErrors([
                'event' => 'This event is currently full.',
            ]);
        }

        return view('app.registrations.create', [
            'event' => $event,
            'student' => $request->user(),
        ]);
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        if ($event->seatsRemaining() < 1) {
            return redirect()->route('events.index')->withErrors([
                'event' => 'This event is currently full.',
            ]);
        }

        $validated = $request->validate([
            'motivation' => ['required', 'string', 'min:50'],
            'agreed_terms' => ['accepted'],
        ]);

        $registration = Registration::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'event_id' => $event->id,
            ],
            [
                'motivation' => $validated['motivation'],
                'status' => 'registered',
                'registered_at' => now(),
                'payment_status' => $event->fee > 0 ? 'pending' : 'paid',
            ]
        );

        if ($event->fee > 0) {
            Payment::firstOrCreate(
                ['registration_id' => $registration->id],
                [
                    'invoice_code' => $this->generateInvoiceCode(),
                    'amount' => $event->fee,
                    'method' => 'virtual_account',
                    'status' => 'pending',
                    'virtual_account' => $this->generateVirtualAccount(),
                    'expires_at' => now()->addDays(1),
                ]
            );

            return redirect()->route('payments.show', $registration)
                ->with('status', 'Registration successful. Please complete payment.');
        }

        return redirect()->route('history')
            ->with('status', 'Registration successful. This event does not require payment.');
    }

    private function generateInvoiceCode(): string
    {
        return 'INV-'.strtoupper(Str::random(8));
    }

    private function generateVirtualAccount(): string
    {
        return '8077'.str_pad((string) random_int(1, 99999999), 8, '0', STR_PAD_LEFT);
    }
}
