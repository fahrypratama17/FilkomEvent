@extends('layouts.app', ['title' => 'Payment'])

@section('content')
    <section class="mb-5">
        <a href="{{ route('events.show', $registration->event) }}" class="text-sm text-blue-900 underline">Back to event detail</a>
        <h1 class="mt-2 text-3xl font-bold">Payment for {{ $registration->event->title }}</h1>
        <p class="mt-1 text-slate-600">Complete your payment to confirm participation.</p>
    </section>

    <section class="grid gap-4 md:grid-cols-[2fr_1fr]">
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-4 text-xl font-bold">Invoice</h2>
            <div class="space-y-2 text-sm text-slate-700">
                <div><strong>Invoice Code:</strong> {{ $payment->invoice_code }}</div>
                <div><strong>Amount:</strong> IDR {{ number_format((float) $payment->amount, 0, ',', '.') }}</div>
                <div><strong>Virtual Account:</strong> {{ $payment->virtual_account }}</div>
                <div><strong>Status:</strong> {{ ucfirst($payment->status) }}</div>
                <div><strong>Expires:</strong> {{ optional($payment->expires_at)->format('d M Y H:i') ?? '-' }}</div>
            </div>

            @if ($payment->status !== 'paid')
                <form method="POST" action="{{ route('payments.confirm', $payment) }}" class="mt-5 space-y-3">
                    @csrf

                    <div>
                        <label for="method" class="mb-1 block text-sm font-medium">Payment Method</label>
                        <select name="method" id="method" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                            <option value="virtual_account" @selected($payment->method === 'virtual_account')>Virtual Account</option>
                            <option value="bank_transfer" @selected($payment->method === 'bank_transfer')>Bank Transfer</option>
                            <option value="ewallet" @selected($payment->method === 'ewallet')>E-Wallet</option>
                            <option value="qris" @selected($payment->method === 'qris')>QRIS</option>
                        </select>
                    </div>

                    <button type="submit" class="rounded-lg bg-blue-900 px-4 py-2 text-white">I Have Completed Payment</button>
                </form>
            @else
                <div class="mt-4 rounded-lg bg-emerald-100 p-3 text-sm text-emerald-700">
                    Payment has been confirmed.
                </div>
            @endif
        </article>

        <aside class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 text-lg font-bold">Tips</h2>
            <ul class="list-disc space-y-2 pl-5 text-sm text-slate-700">
                <li>Use the exact amount shown in the invoice.</li>
                <li>Confirmation updates your registration status in history.</li>
                <li>If your payment expires, re-register to generate a new invoice.</li>
            </ul>
        </aside>
    </section>
@endsection
