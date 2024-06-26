<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Upload File') }}
        </h2>
    </x-slot>

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

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="mt-6 flex flex-col items-center gap-5 container mx-auto py-8 justify-center">
            <h2 class="text-2xl font-semibold text-center ">Select a file to Upload </h2>
            <div class="join" >
            <input type="file" x-data type="file" wire:model="file" required
                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                class="file-input input-secondary file-input-bordered w-full max-w-xs join-item" />

                  <button wire:click="save" class="btn btn-secondary  join-item">Upload</button>
            </div>
            @error('file')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
            <span wire:loading wire:target="file" class="loading loading-ring loading-lg"></span>
            <p class="text-sm text-gray-500">Only .csv, .xlsx, .xls files are allowed</p>
            <button class="btn btn-link btn-sm" wire:click="download_sample">Download Template</button>
        </div>
    </div>


</div>
