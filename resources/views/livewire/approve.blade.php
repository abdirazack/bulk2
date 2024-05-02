<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card w-full bg-neutral text-neutral-content">
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
        <div class="card-body items-center text-center">
          <h2 class="card-title">All Pending Approvals </h2>
  
          <div class="overflow-x-auto ">
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                <tr class="bg-base-200">
                  
                @foreach($uploadedData as $index => $uploadedData_item)

         

                
                  <td>{{ $uploadedData_item->organizationBatch->batch_number }}</td>
                  <td>{{ $uploadedData_item->organizationBatch->total_amount }}</td>
                  <td>{{ $uploadedData_item->organizationBatch->status }}</td>
                  <td>{{ $uploadedData_item->organizationBatch->total_records }}</td>
                  <td>{{ $uploadedData_item->organizationBatch->created_at }}</td>
                  <td>{{ $uploadedData_item->file_name }}</td>

                 
                  <td>
                    <button class="btn btn-primary" wire:click="approve({{ $uploadedData_item->id }})">Approve</button>
                    <button class="btn btn-secondary" wire:click="reject({{ $uploadedData_item->id }})">Reject</button>
                  </td>
                </tr>
       
                @endforeach
                <!-- row 2 -->
               
              </tbody>
            </table>
          </div>
     
          <div class="card-actions justify-end">
          </div>
        </div>
\
      </div>
</div>
