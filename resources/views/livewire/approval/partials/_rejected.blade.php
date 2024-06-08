<div class="card-body text-center">
    @if ($data)
    <div class="bg-base-300 rounded shadow p-3">
        <table class="table">
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
                    <th>Batch Number</th>
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
                @foreach ($data as $index => $uploadedData_item)
                <tr class="hover">
                    <td>{{ $uploadedData_item->file_name }}</td>
                    <td>{{ $uploadedData_item->organizationBatch->batch_number }}</td>
                    <td>{{ $uploadedData_item->user->username }}</td>
                    <td>${{ $uploadedData_item->organizationBatch->total_amount }}</td>
                    <td>{{ $uploadedData_item->organizationBatch->status }}</td>
                    <td>{{ $uploadedData_item->organizationBatch->total_records }}</td>
                    <td>{{ $uploadedData_item->organizationBatch->created_at }}</td>
                    <td>
                        <div class="dropdown dropdown-left">
                            <div tabindex="0" role="button" class="btn btn-sm btn-primary">Action</div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                <li><button class="btn btn-ghost btn-sm bg-base-300" wire:click="details({{ $uploadedData_item->id }})">Details</button></li>
                                <li class="text-center mt-2"><button class="btn btn-sm bg-base-200" wire:click="reject({{ $uploadedData_item->id }})">Reject</button></li>
                                <li class="text-center mt-2"><button class="btn btn-sm bg-base-100" wire:click="approve({{ $uploadedData_item->id }})">Approve</button></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @else
    <h2 class="card-title">No Pending Approvals</h2>
    @endif
</div>
