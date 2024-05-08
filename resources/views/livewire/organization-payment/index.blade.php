<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Payments') }}
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
                <div class="flex justify-between m-4 flex-col">
                <div>
                    <input type="text" wire:model.live.debounce.250ms="search" class="input input-bordered" placeholder="Search Payments">
                    <input type="text"  id="datepicker" wire:model="dateRangeFilter"  class="input input-bordered" placeholder="Date Range">
                     <select class="select select-info w-50 max-w-xs" wire:model="statusFilter" >
                    <option disabled selected>Filter Status</option>
                    <option>Pending</option>
                    <option>Rejected</option>
                    <option>Approved</option>
                  </select>
                  <select class="select select-info w-50 max-w-xs" wire:model="accountProviderFilter">
                    <option disabled selected>Filter Account Provider</option>
                    <option>Hormuud</option>
                    <option>somtel</option>
                    <option>somXc</option>
                    <option>Amtel</option>
         
                  </select>

                  <select class="select select-info w-50 max-w-xs" wire:model="amountFilter">
                    <option disabled selected>Filter Amount Range</option>
                    <option>less than 500</option>
                    <option>greater than 500</option>
                  
                  </select>
                  <button class="btn btn-neutral" wire:click="applyFilters">Apply Filters</button>

                  <h1 class="text-2xl font-bold">Payments List</h1>
                </div> 
                
                
                   
                    
                </div>
                <table class="table bg-base-300 p-5">
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
        @this.set('selectedDate', date.toLocaleDateString());
    }
});

    </script>
</div>
