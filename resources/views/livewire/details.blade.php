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
              <div class="alert alert-danger mt-2">
                  {{ session('error') }}
              </div>
          @endif
          @if ($batchInfo && $data)
              <div class="card w-96 bg-base-100 shadow-xl mt-15">
                  <div class="card-body">
                      <h2 class="card-title">Batch Information</h2>
                      <p><strong>Batch Number:</strong> {{ $batchInfo['batch_number'] }}</p>
                      <p><strong>Total Records:</strong> {{ $batchInfo['total_records'] }}</p>
                      <p><strong>Total Amount:</strong> {{ $batchInfo['total_amount'] }}</p>
                      <p><strong>Status:</strong> {{ $batchInfo['status'] }}</p>
                      <p><strong>Created At:</strong> {{ $batchInfo['created_at'] }}</p>
                      <!-- You can include more details here if needed -->
                  </div>
              </div>
          @endif

          <div class="overflow-x-auto mt-4">
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
                      @foreach ($data as $index => $row)
                          <tr>
                              <th>{{ $index }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->account_provider }}</td>
                              <td>{{ $row->account_number }}</td>
                              <td>{{ $row->amount }}</td>
                              <td>{{ $row->is_recurring }}</td>
                              <td>{{ $row->payment_date }}</td>
                          </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>
</div>
