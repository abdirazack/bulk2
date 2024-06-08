<div>

    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('All Pending Approvals') }}
            </h2>
        </x-slot>
        {{-- Care about people's approval and you will be their prisoner. --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger  mt-2">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card-body  text-center">
                <div class="flex justify-between m-4">

                    <div class="text-2xl font-bold">
                        <input type="text" wire:model.live.debounce.250ms="search" class="input input-bordered"
                            placeholder="Search By File Name">
                    </div>
                    <div></div>
                </div>
                @if ($uploadedData)
                    <div class=" bg-base-300 rounded shadow p-3">
                        <table class="table ">
                            <!-- head -->
                            <thead>
                                <tr>
                                <th>
                                        @if ($sortField !== 'file_name')
                                            <button wire:click="sortBy('file_name')">File Name &nbsp;
                                                <i class="fa-solid fa-sort"></i></button>
                                        @else
                                            <button wire:click="sortBy('file_name')">
                                                File Name &nbsp;
                                                @if ($sortOrder === 'asc')
                                                    <i class="fa fa-sort-up"></i>
                                                @else
                                                    <i class="fa fa-sort-down"></i>
                                                @endif
                                            </button>
                                        @endif
                                    </th>
                                    <th>
                                      Batch Number 
                                    </th>
                                    <th>Created By</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Total Records</th>
                                    
                                    <th>
                                        @if ($sortField !== 'created_at')
                                            <button wire:click="sortBy('created_at')">Uploaded Date &nbsp;
                                                <i class="fa-solid fa-sort"></i></button>
                                        @else
                                            <button wire:click="sortBy('created_at')">
                                                Uploaded Date &nbsp;
                                                @if ($sortOrder === 'asc')
                                                    <i class="fa fa-sort-up"></i>
                                                @else
                                                    <i class="fa fa-sort-down"></i>
                                                @endif
                                            </button>
                                        @endif
                                    </th>
                                    <th class="text-center w-24">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->

                                @foreach ($uploadedData as $index => $uploadedData_item)
                                    <tr class="hover">

                                        <td>{{ $uploadedData_item->file_name }}</td>
                                        <td>{{ $uploadedData_item->organizationBatch->batch_number }}</td>
                                        <td>{{ $uploadedData_item->user->username }}</td>
                                        <td>${{ $uploadedData_item->organizationBatch->total_amount }}</td>
                                        <td>{{ $uploadedData_item->organizationBatch->status }}</td>
                                        <td>{{ $uploadedData_item->organizationBatch->total_records }}</td>
                                        <td>{{ $uploadedData_item->organizationBatch->created_at }}</td>


                                        {{-- <td class="text-center w-95 h-95">
                                      
                                    </td> --}}
                                        <td>
                                            <div class="dropdown dropdown-left mt-12 dropdown-bottom dropdown-end">
                                                <div tabindex="0" role="button" class="btn btn-sm btn-primary">Action</div>
                                                <ul tabindex="0"
                                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-300 rounded-box w-52">
                                                    <li> <button class="btn  btn-ghost btn-sm  bg-base-300"
                                                            wire:click="details({{ $uploadedData_item->id }})">Details
                                                            </wire:click=>
                                                    </li>
                                                    <li class="text-center mt-2">
                                                        <button class="btn btn-sm  bg-base-200"
                                                            wire:click="reject({{ $uploadedData_item->id }})">Reject</button>
                                                    </li>
                                                    <li class="text-center mt-2"> <button class="btn btn-sm bg-base-100"
                                                            wire:click="approve({{ $uploadedData_item->id }})">Approve</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $uploadedData->links() }}
                    </div>
                @elseif($data)
                    <div class="overflow-x-auto">
                        <table class="table table-xs">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Account Provider</th>
                                    <th>Account Number</th>
                                    <th>Amount</th>
                                    <th>Recurring</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($data as $index => $row)
                                        <th>{{ $index }}</th>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->account_provider }}</td>
                                        <td>{{ $row->account_number }}</td>
                                        <td>{{ $row->amount }}</td>
                                        <td>{{ $row->is_recurring }}</td>
                                        <td>{{ $row->payment_date }}</td>

                                </tr>
                            </tbody>
                @endforeach
                </table>
            </div>
        @else
            <h2 class="card-title">No Pending Approvals</h2>
            @endif
        </div>

        <div class="card-actions justify-end">
        </div>
    </div>

</div>
</div>
</div>
