<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Payments List') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-5">
            <div class="overflow-x-auto">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                 @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="flex  justify-between  flex-col w-full "><div>
                    <input type="text" wire:model.live.debounce.250ms="search" class="input input-bordered w-50" placeholder="Search Payments">
                    <input type="text" id="datepicker"  wire:model.live.debounce.250ms="selectedDateFilter" class="input input-bordered w-50" placeholder="Pick a date">
                    
                    <select class="select select-info w-50 max-w-xs"  wire:model.live.debounce.250ms="statusFilter">
                        <option disabled selected>Filter Status</option>
                        <option value="">Choose Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Approved">Approved</option>
                    </select>
                    
                    <select class="select select-info w-40 max-w-xs" wire:model.live.debounce.250ms="accountProviderFilter">
                        <option disabled selected>Filter Account Provider</option>
                        <option value="">Payment Provider</option>
                        @foreach ($organizationPayments->pluck('account_provider')->unique() as $accountProvider)
                            <option value="{{ $accountProvider }}">{{ $accountProvider }}</option>
                        @endforeach
                    </select>
                    
                    
                        <select class="select select-info w-30 max-w-xs"  wire:model.live.debounce.250ms="amountFilter">
                            <option disabled selected>Filter Amount Range</option>
                            <option value="">Choose Range</option>
                            <option value="less_than">Less than</option>
                            <option value="greater_than">Greater than</option>
                            <option value="equals">Equals</option>
                        </select>
                        <input type="number"  wire:model.live.debounce.250ms="amountValue" class="input input-bordered w-40" placeholder="Enter amount">

                
                </div>

                <table class="table bg-base-300 p-5 shadow-xl rounded-xl mt-4">
                    <!-- head -->
                    <thead class=" p-5">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            {{-- <th>Batch</th> --}}
                            <th>Approved By</th>
                            <th>Account Name</th>
                            <th>Account Provider</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>is_recurring</th>
                            <th>Payment Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizationPayments as $org)
                            <tr class="hover" wire:key="{{ $org->id }}">
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $org->organization->name }}</td>
                                <td>{{ $org->user->username }}</td>
                                {{-- <td>{{ $org->organizationBatch->batch_number }}</td> --}}
                                <td>{{ $org->account_name }}</td>
                                <td>{{ $org->account_provider }}</td>
                                <td>{{ $org->account_number }}</td>
                                <td>{{ $org->amount }}</td>
                                <td>{{ $org->status }}</td>
                                <td class="">
                                    <input type="checkbox" wire:click="toggleIsRecurring({{ $org->id }})"
                                        class="toggle {{ $org->is_recurring ? 'toggle-success' : 'toggle-warning' }}"
                                        {{ $org->is_recurring ? 'checked' : '' }} /> &nbsp;
                                         {{ $org->is_recurring ? 'YES' : 'NO' }}
                                </td>


                                <td>{{ date('m/d/Y',$org->payment_date->getTimestamp()) }}</td>

                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning"
                                        wire:click="$dispatch('openModal', {component: 'organization-payment.edit', arguments: {id: {{ $org->id }}}})">View Details</button>

                                    {{-- <button class="btn btn-sm bg-red-700"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        wire:click="delete({{ $org->id }})">Delete</button> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="">
                    {{ $organizationPayments->links() }}
                </div>
            </div>

        </div>
        <x-modal name="create-user" :show="$errors->isNotEmpty()" focusable>

            <div class="bg-base-200 p-5">
                {{-- modal title --}}
                <div class="flex justify-between">
                    <h2 class="text-lg font-medium">Create User</h2>
                    <button class="btn btn-sm btn-danger" x-on:click="$dispatch('close')">X</button>
                </div>
                {{--  --}}
                <livewire:user.create />
            </div>
        </x-modal>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

   
    <script>
      const picker = new Pikaday({
    field: document.getElementById('datepicker'),
    onSelect: function(date) {
        @this.set('selectedDateFilter', date.toLocaleDateString());
    }
});

    </script>
</div>
