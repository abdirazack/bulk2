<div>
    <div class="bg-base-200 p-12">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-tight">Viewing Payment Details Payment</h2>
            <button wire:click="$dispatch('close')" class="btn btn-sm btn-circle btn-ghost ">✕</button>
        </div>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="mt-6">
            <div class="card w-full bg-base-100 shadow-xl">
                <div class="card-body">
                    <div>
                        <h2 class="text-2xl font-bold">Payment Details</h2>
                        {{-- table  --}}
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Organization</td>
                                    <td>{{ $this->payments->organization->name }}</td>
                                </tr>
                                <tr>
                                    <td>Approved By</td>
                                    <td>{{ $this->payments->user->username }}</td>
                                </tr>
                                <tr>
                                    <td>Account Name</td>
                                    <td>{{ $this->payments->account_name }}</td>
                                </tr>
                                <tr>
                                    <td>Account Provider</td>
                                    <td>{{ $this->payments->account_provider }}</td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td>{{ $this->payments->account_number }}</td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td>${{ $this->payments->amount }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $this->payments->status }}</td>
                                </tr>
                                <tr>
                                    <td>is_recurring</td>
                                    <td>{{ $this->payments->is_recurring ? 'YES' : 'NO' }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Date</td>
                                    <td>{{ $this->payments->payment_date->diffForHumans() }}</td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
