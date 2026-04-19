<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function show(Request $request, Registration $registration): View|RedirectResponse
    {
        if ($registration->user_id !== $request->user()->id) {
            abort(403, 'Forbidden');
        }

        $payment = $registration->payment;

        if (! $payment) {
            return redirect()->route('history')->with('status', 'This registration does not require payment.');
        }

        if ($payment->status === 'pending' && $payment->expires_at?->isPast()) {
            $payment->update(['status' => 'expired']);
            $registration->update(['payment_status' => 'expired']);
            $payment->refresh();
        }

        return view('app.payments.show', compact('registration', 'payment'));
    }

    public function confirm(Request $request, Payment $payment): RedirectResponse
    {
        if ($payment->registration->user_id !== $request->user()->id) {
            abort(403, 'Forbidden');
        }

        $validated = $request->validate([
            'method' => ['required', 'in:virtual_account,bank_transfer,ewallet,qris'],
        ]);

        if ($payment->status === 'paid') {
            return back()->with('status', 'Payment is already confirmed.');
        }

        $payment->update([
            'method' => $validated['method'],
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $payment->registration->update([
            'payment_status' => 'paid',
        ]);

        return redirect()->route('history')->with('status', 'Payment confirmed successfully.');
    }
}
