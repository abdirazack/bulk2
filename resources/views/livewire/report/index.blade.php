<!-- resources/views/livewire/dashboard.blade.php -->
<x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight">
        {{ __('Report') }}
    </h2>
</x-slot>


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="mt-6">
        <div class="flex justify-right m-4 p-4 bg-base-200">
            <h2 class="font-semibold leading-tigh">Report Params</h2>
            <div class="dropdown dropdown-end m-4 p-4">
          
           <select name="params" id="params" class="select select-ghost w-full max-w-xs"> 
            <option value="">Select an option</option>
            <option value="1">Payment</option>
            <option value="2">Transactions</option>
            <option value="3">Wallet Balances</option>
           </select>
        </div>

    </div>
      </div>


