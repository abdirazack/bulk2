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

               @if($uploadedData)
                <h2 class="card-title">All Pending Approvals</h2>

                <div class="overflow-x-auto bg-base-300 rounded shadow-lg p-5">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Created By</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Total Records</th>
                                <th>Created At</th>
                                <th>Uploaded Files</th>
                                <th class="text-center w-24">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->

                            @foreach ($uploadedData as $index => $uploadedData_item)
                                <tr class="hover">
                               
                                    <td>{{ $uploadedData_item->organizationBatch->batch_number }}</td>
                                    <td>{{$uploadedData_item->user->username}}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->total_amount }}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->status }}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->total_records }}</td>
                                    <td>{{ $uploadedData_item->organizationBatch->created_at }}</td>
                                    <td>{{ $uploadedData_item->file_name }}</td>


                                    {{-- <td class="text-center w-95 h-95">
                                      
                                    </td> --}}
                                    <td>
                                        <div class="dropdown dropdown-left dropdown-end">
                                            <div tabindex="0" role="button" class="btn m-1">Action</div>
                                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                              <li >  <span class="btn btn-active btn-ghost btn-sm"
                                                wire:click="details({{ $uploadedData_item->id }})">Details</button></li>
                                              <li class="text-center mt-2">
                                                <button class="btn btn-active btn-neutral btn-sm"
                                                    wire:click="reject({{ $uploadedData_item->id }})">Reject</button></li>
                                                    <li class="text-center mt-2">   <button class="btn btn-active btn-defult btn-sm"
                                                        wire:click="approve({{ $uploadedData_item->id }})">Approve</button></li>
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
                          <th>Is recurring</th> 
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
                      <tfoot>
                      </tfoot>
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
