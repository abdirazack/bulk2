<x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight">
        {{ __(' Dashboard') }}
    </h2>
</x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1: Wallet Information -->
            <div class="bg-base-300 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Wallet Information</h3>
                <div class="flex justify-between items-center mb-4">
                    <span class="font-medium">Total Amount</span>
                    <span class=" text-white px-3 py-1 rounded"> ${{ $walletBalance }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-medium">Last Updated</span>
                    <span class=" text-white px-3 py-1 rounded">{{ $lastUpdated }}</span>
                </div>
            </div>

            <!-- Card 2: Batches Information -->
            <div class="bg-base-300 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Batches Information</h3>
                <div class="flex justify-between mb-4">
                    <div>
                        <h4 class="text-md font-semibold mb-2">Approved</h4>
                        <span class="inline-block  text-white px-3 py-1 rounded">{{ $batches['approve'] }}</span>
                    </div>
                    <div>
                        <h4 class="text-md font-semibold mb-2">Rejected</h4>
                        <span class="inline-block  text-white px-3 py-1 rounded">{{ $batches['reject'] }}</span>
                    </div>
                    <div>
                        <h4 class="text-md font-semibold mb-2">Pending</h4>
                        <span class="inline-block text-white px-3 py-1 rounded">{{ $batches['pending'] }}</span>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div>
                        <h4 class="text-md font-semibold mb-2">Approved Amount</h4>
                        <span class="text-blue-600 inline-block text-white px-3 py-1 rounded">{{ "Total : $".number_format($batches['approveAmount'], 2) }}</span>
                    </div>
                    <div>
                        <h4 class="text-md font-semibold mb-2">Pending Amount</h4>
                        <span class="text-blue-600 inline-block  text-white px-3 py-1 rounded">{{"Total : $".number_format($batches['pendingAmount'], 2) }}</span>
                    </div>
                </div>
            </div>
            


            <!-- Card 3: Payment Information -->
            <div class="bg-base-300 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Payment Information</h3>
                <div>
                    <span class="inline-block text-white px-2 py-1 rounded mr-2">Success</span>
                    <span >Total Success Payments: {{ number_format($totalSuccessPayments, 2) }}</span>
                </div>
                <div class="mt-4">
                    <span class="inline-block  text-white px-2 py-1 rounded mr-2">Pending</span>
                    <span >Total Pending Payments: {{ number_format($totalPendingPayments, 2) }}</span>
                </div>
                <div class="mt-4">
                    <span class="inline-block text-white px-2 py-1 rounded mr-2">Rejected</span>
                    <span >Total Rejected Payments: {{ number_format($totalRejectedPayments, 2) }}</span>
                </div>
            </div>

            <!-- Card 4: Users Information -->
            <div class="bg-base-300 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Users Information</h3>
                <div>
                    <span class="inline-block text-white px-2 py-1 rounded mr-2">Active</span>
                    <span >Total Active Users: {{ 22 }}</span>
                </div>
                <div class="mt-4">
                    <span class="inline-block text-white px-2 py-1 rounded mr-2">Suspended</span>
                    <span >Total Suspended Users: {{ 22 }}</span>
                </div>
                <div class="mt-4">
                    <span class="inline-block text-white px-2 py-1 rounded mr-2">Suspended</span>
                    <span >Total Suspended Users: {{ 22 }}</span>
                </div>
            </div>

            <!-- Card 5: Recurring Transactions -->
            <div class="bg-base-300 text-white rounded-lg shadow-md p-6" wire:click="viewDetails">
                <h3 class="text-lg font-semibold mb-4">Recurring Transactions</h3>
                <div class="flex justify-between items-center">
                    <span>Total Recurring Transactions</span>
                    <span class="text-white px-2 py-1 rounded">{{ $recurringTransactionsCount }}</span>
                </div>
                <div class="mt-4">
                    <h4 class="text-md font-semibold">Closest Due Recurring Payments (Top 10)</h4>
                    @if ($closestDueRecurringPayments->isNotEmpty())
                        <div class="mt-2">
                            @foreach ($closestDueRecurringPayments as $payment)
                                <div class="flex justify-between items-start border-b border-base-700 py-2">
                                    <div>
                                        <span class="block">Account: {{ $payment->account_name }}</span>
                                        <span class="block">Amount: {{ number_format($payment->amount, 2) }}</span>
                                        <span class="block">Due Date: {{ $payment->payment_date }}</span>
                                    </div>
                                    <div>
                                        <span class="block">Account Provider: {{ $payment->account_provider }}</span>
                                        <span class="block">Total Users: {{ $totalUsers }}</span>
                                        <span class="block">Payment Status: {{ ucfirst($payment->status) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span>No upcoming recurring payments</span>
                    @endif
                </div>
            </div>

            <!-- Card 6: Most Used Account Providers -->
            <div class="bg-base-300 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Most Used Account Providers</h3>
                @if ($topAccountProviders->isNotEmpty())
                    <div class="mb-4">
                        <h4 class="text-md font-semibold">Most Used Account Provider</h4>
                        <div class="flex justify-between items-center">
                            <span>{{ $topAccountProviders[0]->account_provider }}</span>
                            <span class="text-white px-2 py-1 rounded">{{ $topAccountProviders[0]->count }} times used</span>
                        </div>
                        <p class="text-sm text-base-400">The most frequently used account provider.</p>
                    </div>
                    <div>
                        <h4 class="text-md font-semibold">Other Frequently Used Providers</h4>
                        @foreach ($topAccountProviders->slice(1) as $provider)
                            <div class="mb-2">
                                <div class="flex justify-between items-center">
                                    <span>{{ $provider->account_provider }}</span>
                                    <span class=" text-white px-2 py-1 rounded">{{ $provider->count }} times used</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <span>No account providers used</span>
                @endif
            </div>
        </div>

        <!-- Latest Transactions -->
        <div class="bg-base-300 text-white rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Latest Transactions</h3>
            <div class="table-responsive">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentTransactions as $transaction)
                            <tr>
                                <td class="border px-4 py-2">{{ $transaction->id }}</td>
                                <td class="border px-4 py-2">{{ $transaction->account_name }}</td>
                                <td class="border px-4 py-2">{{ number_format($transaction->amount, 2) }}</td>
                                <td class="border px-4 py-2">{{ date_format($transaction->payment_date, 'd/m/Y h:i A') }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($transaction->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
