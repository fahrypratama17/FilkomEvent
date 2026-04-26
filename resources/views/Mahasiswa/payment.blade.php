{{-- resources/views/payment.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom Event - Event Payments</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F3F3F3] text-slate-900">
    @php
        $payment = [
            'event_name' => 'Workshop UI/UX Design 2025',
            'total_payment' => 'IDR 150.000',
            'invoice_code' => 'INV-WDM-2025-001',
            'deadline_time' => '23:40:20',
            'deadline_date' => '15 Jan 2025, 23:59',
            'virtual_account' => '8077 0001 2345 6789',
            'instructions' => [
                'Open the mobile banking application or ATM',
                'Select the Transfer/Pay menu',
                'Enter the Virtual Account number above',
                'Confirmation of payment of Rp. 150,000',
            ],
        ];
    @endphp

    <div class="min-h-screen">
        <main class="mx-auto px-0 pb-0 pt-0">
            <div class="min-h-[1273px] rounded-[4px] border border-[#C9D0D7] bg-[#F5F5F5]">
                <div class="px-[46px] pt-6">
                    <div class="mb-8 flex items-center justify-between">
                        <div class="flex items-center gap-3 text-[#233E98]">

                            <span class="text-[18px] font-medium">Event Payments</span>
                        </div>

                        <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">

                        </button>
                    </div>

                    <a
                        href="/dashboard-design"
                        class="mb-4 inline-flex h-[42px] items-center gap-3 rounded-[10px] border border-[#D0D0D0] bg-[#F7F7F7] px-5 text-[16px] text-[#666666]"
                    >

                        <span>Return to Dashboard</span>
                    </a>

                    <div class="grid grid-cols-[1fr_292px] gap-x-7 pb-8">
                        <div>
                            <section class="mb-6 rounded-[10px] border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-5">
                                <h2 class="mb-6 text-[18px] font-bold text-[#233E98]">Payment Details</h2>

                                <div class="space-y-5 text-[#4F4F4F]">
                                    <div class="grid grid-cols-[160px_1fr] items-center border-b border-[#E4E4E4] pb-4 text-[14px]">
                                        <div>Event Name:</div>
                                        <div class="text-right text-[16px] text-[#2D2D2D]">{{ $payment['event_name'] }}</div>
                                    </div>

                                    <div class="grid grid-cols-[160px_1fr] items-center text-[14px]">
                                        <div>Total payment:</div>
                                        <div class="text-right text-[30px] font-bold leading-none text-[#5A5A5A]">{{ $payment['total_payment'] }}</div>
                                    </div>

                                    <div class="grid grid-cols-[160px_1fr] items-center border-b border-[#E4E4E4] pb-4 text-[14px]">
                                        <div>Invoice Code:</div>
                                        <div class="text-right text-[16px] text-[#2D2D2D]">{{ $payment['invoice_code'] }}</div>
                                    </div>
                                </div>

                                <div class="mt-0 rounded-[8px] border border-[#D9D9D9] bg-[#F3F3F3] px-3 py-3">
                                    <div class="grid grid-cols-[1fr_180px] items-center gap-4">
                                        <div class="text-[14px] text-[#555555]">Deadline Payment:</div>
                                        <div class="text-right">
                                            <div class="text-[22px] leading-none text-[#4A4A4A]">{{ $payment['deadline_time'] }}</div>
                                            <div class="mt-2 text-[14px] text-[#666666]">{{ $payment['deadline_date'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-[10px] border border-[#D9D9D9] bg-[#F7F7F7] px-6 py-5">
                                <h2 class="mb-6 text-[18px] font-medium text-[#233E98]">Select Payment Method</h2>

                                <div class="space-y-3">
                                    <div class="rounded-[8px] border border-[#D8D8D8] bg-[#FBFBFB] px-4 py-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3 text-[16px] text-[#333333]">

                                                <span>Bank Transfer</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="rounded-[8px] border border-[#8F8F8F] bg-[#FBFBFB] px-4 py-4">
                                        <div class="mb-4 flex items-center justify-between">
                                            <div class="flex items-center gap-3 text-[16px] text-[#333333]">

                                                <span>Virtual Account</span>
                                            </div>

                                        </div>

                                        <div class="rounded-[8px] border border-[#D9D9D9] bg-[#F7F7F7] px-4 py-4">
                                            <div class="mb-3 text-[14px] text-[#666666]">Virtual Account Number</div>

                                            <div class="mb-4 rounded-[6px] border border-[#D9D9D9] bg-[#F3F3F3] px-4 py-3 text-center text-[22px] font-bold text-[#111111]">
                                                {{ $payment['virtual_account'] }}
                                            </div>

                                            <div class="mb-3 text-[14px] text-[#666666]">Payment Instructions</div>
                                            <ol class="space-y-2 text-[14px] text-[#5A5A5A]">
                                                @foreach ($payment['instructions'] as $index => $instruction)
                                                    <li>{{ $index + 1 }}. {{ $instruction }}</li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>

                                    <div class="rounded-[8px] border border-[#D8D8D8] bg-[#FBFBFB] px-4 py-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3 text-[16px] text-[#333333]">

                                                <span>E-Wallet</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="rounded-[8px] border border-[#D8D8D8] bg-[#FBFBFB] px-4 py-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3 text-[16px] text-[#333333]">

                                                <span>QRIS</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <aside>
                            <section class="mb-10 rounded-[10px] border border-[#D9D9D9] bg-[#F7F7F7] px-5 py-5">
                                <h2 class="mb-5 text-[18px] text-[#2D2D2D]">Status &amp; Confirmation</h2>

                                <button class="mb-4 inline-flex h-[44px] w-full items-center justify-center gap-3 rounded-[8px] bg-[#233E98] px-4 text-[14px] font-medium text-white">

                                    <span>Status &amp; Confirmation</span>
                                </button>

                                <p class="mx-auto mb-6 max-w-[230px] text-center text-[14px] leading-[1.45] text-[#2F2F2F]">
                                    Click the button above to find out your payment status.
                                </p>

                                <div class="rounded-[8px] bg-[#F2F2F2] px-4 py-4 text-[14px] text-[#666666]">
                                    <div class="mb-2 flex items-start gap-2">

                                        <div>
                                            <div class="font-medium text-[#555555]">Vital Records:</div>
                                            <div class="mt-1 leading-[1.45]">
                                                Payment will be automatically verified within 1-5 minutes after successful transfer.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <a
                                href="/detail-event-design"
                                class="inline-flex h-[46px] w-full items-center justify-center gap-3 rounded-[8px] border border-[#D0D0D0] bg-[#F7F7F7] px-5 text-[16px] text-[#666666]"
                            >

                                <span>Return to Detail Event</span>
                            </a>
                        </aside>
                    </div>
                </div>

                <footer class="mt-auto border-t border-[#D8D8D8] px-6 py-8 text-center text-[15px] text-[#6A6A6A]">
                    © 2026 Event Management System. All rights reserved.
                </footer>
            </div>
        </main>
    </div>
</body>
</html>
