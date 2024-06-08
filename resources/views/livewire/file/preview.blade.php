<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('File Preview') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-6">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
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
                        @foreach ($fileData as $index => $row)
                            <tr wire:key="{{ $index }}">
                                @foreach ($row as $cell)
                                    <td>
                                        <input type="text" contenteditable="true"
                                            class="input input-bordered w-full max-w-xs"
                                            wire:model.lazy="fileData.{{ $index }}.{{ $loop->index }}">
                                    </td>
                                @endforeach
                                 <td>
            <button wire:click.prevent="deleteRow({{ $index }})" class="btn btn-danger bg-red-500">Delete</button>
        </td>
                            </tr>
                        @endforeach
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
</div>
