<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Upload File') }}
        </h2>
    </x-slot>

    {{-- success --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="mt-6 flex flex-col items-center gap-5 container mx-auto py-8 justify-center">
            <h2 class="text-2xl font-semibold text-center text-info">Select a file to Upload </h2>

            <label class="label">
                <span class="text-base label-text me-3">File has headers?</span>
                <input type="checkbox" wire:model="hasHeaders" required class="checkbox checkbox-primary" />
            </label>
            <input type="file" x-data type="file" @change='onChange($el)' wire:model="file" required
                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                class="file-input input-primary file-input-bordered w-full max-w-xs" />

            @error('file')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
            <p class="text-sm text-gray-500">Only .csv, .xlsx, .xls files are allowed</p>
            <span wire:loading wire:target="file" class="loading loading-ring loading-lg"></span>
            <button wire:click="save" class="btn btn-primary mt-2">Upload</button>
        </div>
    </div>
    @if ($fileData)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-center text-info">File Preview</h2>
                <form wire:submit.prevent="saveModifiedData">
                    <table class="table table-compact table-zebra">
                        <thead>
                            <tr>
                                @foreach ($fileData[0] as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fileData as $index => $row)
                                @if ($index > 0)
                                    <tr wire:key="{{ $index }}">
                                        @foreach ($row as $cell)
                                            <td>
                                                <input type="text" contenteditable="true" class="input input-sm input-bordered w-full max-w-xs"
                                                    wire:model.lazy="modifiedData.{{ $index }}.{{ $loop->index }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                </form>
            </div>
        </div>
    @endif
</div>
