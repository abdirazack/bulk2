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
                <div class="flex justify-between m-4">
                    <h1 class="text-2xl font-bold">Payments List</h1>
                    {{-- <button 
                             x-data=""
                                 wire:click="$dispatch('openModal', { component: 'organization-user.create' })"
                            class="btn btn-primary " >Create User</button> --}}

                </div>
                <table class="table bg-base-300 p-5">
                    <!-- head -->
                    <thead class=" p-5">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            {{-- <th>Batch</th> --}}
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
                                {{-- <td>{{ $org->organizationBatch->batch_number }}</td> --}}
                                <td>{{ $org->account_name }}</td>
                                <td>{{ $org->account_provider }}</td>
                                <td>{{ $org->account_number }}</td>
                                <td>{{ $org->amount }}</td>
                                <td>{{ $org->status }}</td>
                                <td class="">
                                    <input type="checkbox" wire:click="toggleIsRecurring({{ $org->id }})"
                                        class="toggle {{ $org->is_recurring ? 'toggle-success' : 'toggle-warning' }}"
                                        {{ $org->is_recurring ? 'checked' : '' }} />
                                </td>


                                <td>{{ $org->payment_date }}</td>

                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="$dispatch('openModal', {component: 'organization-payment.edit', arguments: {user: {{ $org->id }}}})">Edit</button>

                                    {{-- <button class="btn btn-sm bg-red-700"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        wire:click="delete({{ $org->id }})">Delete</button> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="">
                    {{ $this->OrganizationPayments->links() }}
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
</div>
