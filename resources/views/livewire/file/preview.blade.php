
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('File Preview') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-6">
             {{-- success --}}
    @if (session()->has('success'))
    <div role="alert" class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>    {{ session('success') }}</span>
      </div>
    @endif


    @if (session()->has('error'))
    <div role="alert" class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session('error') }}</span>
      </div>
    @endif
            <h2 class="text-2xl font-semibold text-center text-info">File Preview</h2>
            <form wire:submit.prevent="saveModifiedData" class="mt-12">
                <div class="flex justify-center gap-12">
                    <label class="label">
                        <span class="text-base label-text me-3">Is this Payment Recurring?</span>
                        <input type="checkbox" wire:model="recurring" class="checkbox checkbox-primary" />
                    </label>
                    <label class="label">
                        <span class="text-base label-text me-3">Payment Date</span>
                        <input type="date" wire:model="paymentDate" required class="input input-primary input-bordered" />
                    </label>
                </div>

                <table class="table table-compact table-zebra">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Account Provider</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            @foreach ($fileData as $index => $row)
                                <tr wire:key="{{ $index }}">
                                    @foreach ($row as $cellIndex => $cell)
                                    @if ($cellIndex == 1)
                                        <td>
                                            <select class="select select-bordered w-full max-w-xs "
                                                    wire:model.lazy="fileData.{{ $index }}.{{ $cellIndex }}">
                                                <option value="">Select an option</option>
                                                @foreach ($accountProviders as $accountprovider)
                                                    @php 
                                                    @endphp
                                                    <option value="{{ $accountprovider }}" 
                                                        {{ $cell == $accountprovider ? 'selected' : '' }}>
                                                        {{ trim(ucfirst($accountprovider)) }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </td> 
                                        @else
                                            <td>
                                                <input type="text" contenteditable="true"
                                                       class="input input-bordered w-full max-w-xs"
                                                       wire:model.lazy="fileData.{{ $index }}.{{ $cellIndex }}">
                                            </td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <button wire:click.prevent="deleteRow({{ $index }})" class="btn btn-danger bg-red-500">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </tbody>
                    
                </table>
                <span wire:loading wire:target="fileData" class="loading loading-ring loading-lg"></span>
                <div class="flex justify-end gap-12 mt-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
