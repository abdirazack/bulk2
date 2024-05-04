<div>

    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Approve') }}
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
            <div class="card-body  items-center text-center">
                <h2 class="card-title">All Pending Approvals</h2>

                <div class="overflow-x-auto bg-base-300 rounded shadow-lg p-5">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Total Records</th>
                                <th>Created At</th>
                                <th>Uploaded Files</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->

                            @foreach ($uploadedData as $index => $uploadedData_item)
                                <tr class="hover">
                                    <td>{{ $uploadedData_item->organizationBatch->batch_number }}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->total_amount }}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->status }}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->total_records }}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->created_at }}</td>
                                    <td>{{ $uploadedData_item->file_name }}</td>


                                    <td class="text-center">
                                        <button class="btn btn-primary"
                                            wire:click="approve({{ $uploadedData_item->id }})">Approve</button>
                                        <button class="btn btn-secondary"
                                            wire:click="reject({{ $uploadedData_item->id }})">Reject</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $uploadedData->links() }}
                </div>

                <div class="card-actions justify-end">
                </div>
            </div>

        </div>
    </div>
</div>
