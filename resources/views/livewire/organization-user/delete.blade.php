<div>
    <div class="bg-base-300 p-12">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-tight">Delete {{$this->user->username}} User</h2>
            <button wire:click="$dispatch('close')" class="btn btn-sm btn-circle btn-ghost ">✕</button>
        </div>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="mt-6">
            <p>Are you sure you want to delete {{$this->user->username}}?</p>
        </div>
        <div class="mt-6">
            <button wire:click="delete" class="btn btn-danger bg-red-500">Delete User</button>
        </div>
    </div>
</div>
