<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('File Preview') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <h2 class="text-2xl font-semibold text-center text-info">File Preview</h2>
                <form wire:submit.prevent="saveModifiedData"  class="mt-12">
                    <div class="flex justify-center gap-12">
                        <label class="label">
                            <span class="text-base label-text me-3">Is this Payment Recurring?</span>
                            <input type="checkbox" wire:model="recurring" required
                                class="checkbox checkbox-primary" />
                        </label>
                        {{-- date picker --}}
                        <label class="label">
                            <span class="text-base label-text me-3">Payment Date</span>
                            <input type="date" wire:model="paymentDate" required
                                class="input input-primary input-bordered" />
                    </div>

                    <table class="table table-compact table-zebra">
                        <thead>
                            <tr>
                              <th>Name </th>
                              <th>Account Provider</th>
                                <th>Account Number</th>
                                <th>Amount</th>
                                <th>Is Recurring</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fileData as $index => $row)
                                @if ($index > 0)
                                    <tr wire:key="{{ $index }}">
                                        @foreach ($row as $cell)
                                            <td>
                                                <input type="text" contenteditable="true"
                                                    class="input input-bordered w-full max-w-xs"
                                                    wire:model.lazy="fileData.{{ $index }}.{{ $loop->index }}">
                                            </td>
                                           
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <span wire:loading wire:target="fileData" class="loading loading-ring loading-lg"></span>
                    <div class="flex justify-end gap-12 mt-4">
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                        <button wire:click="cancel" class="btn btn-secondary">Cancel</button>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary mt-2 ">Save Changes</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
