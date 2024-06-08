<div>
  <x-slot name="header">
      <h2 class="font-semibold text-xl leading-tight">
          {{ __('Display Recurring Payment Details') }}
      </h2>
  </x-slot>
 <div class="card w-95 bg-base-300 m-4 shadow-lg text-center">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>#</th>
          <th>date</th>
          <th>Account Provider</th>
          <th>Account Name</th>
          <th>Account Provider</th>
          <th>Recurring</th>
          <th>Batch No</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($details as $payment)
          <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $payment->payment_date }}</td>
            <td>{{ $payment->account_provider }}</td>
            <td>{{ $payment->account_name }}</td>
            <td>{{ $payment->amount }}</td>
            <td>{{ $payment->is_recurring == 1 ? 'Yes' : 'No' }}</td>
            <td>{{ $payment->organization_batch_id }}</td>
            <td>{{ $payment->status }}</td>
            @endforeach
          </tr>
      </tbody>
    </table>
  </div>
</div>
