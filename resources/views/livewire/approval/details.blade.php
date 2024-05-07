<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Display Details') }}
        </h2>
    </x-slot>
        @if ($batchInfo && $data)
            <div class="card w-95 bg-base-300 m-4 shadow-lg text-center">
                <div class="card-body ">
                    <h2> Batch No: {{ $batchInfo->batch_number }} || Total Records: {{ $batchInfo->total_records }} || Total Amount: {{ $batchInfo->total_amount }} || Status: {{ $batchInfo->status }}</h2>
                  
                  
            
                </div>
              </div> 
              <div class="overflow-x-auto bg-base-300 mt-4 p-4shadow-xl rounded-xl">

                <table class="table" >
                    <thead>
                        <tr class=" bg-base-200">
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
                        @foreach ($data as  $row)
                            <tr class="hover">
                                <th >{{ $loop->index+1 }}</th> 
                                <td >{{ $row[0] }}</td> 
                                <td >{{ $row[1] }}</td> 
                                <td >{{ $row[2] }}</td> 
                                <td >{{ $row[3] }}</td> 
                            
                                <td >{{ $row[4] == 1 ? 'Yes' : 'No' }}</td>
                                <td >{{ $row[5] }}</td> 
                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
               {{
                $data->links(data: ['scrollTo' => false])
               }}
        @endif
    </div>
</div>
