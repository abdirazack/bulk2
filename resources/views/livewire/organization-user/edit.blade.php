<div class="bg-base-100 p-5">
    {{-- Create User form  --}}
    <div class="flex justify-between m-4">
        <h1 class="text-xl font-bold">Update User</h1>
    </div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success"
                x-data="{show:true}"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
            >
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="bg-base-200 p-10 rounded ">
        <form wire:submit.prevent>
<div class="grid  grid-cols-2 gap-4">
                <div>
            <input Value="{{ $username }}" wire:model="username" id="name" type="text"
                class="input input-bordered w-full max-w-xs" />
            <div>
                @error('username')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            </div>
            
 <div>
            <input Value="{{ $email }}" wire:model="email" id="email" type="email"
                class="input input-bordered w-full max-w-xs" />
            <div>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            </div>
            
            <div>
            <input placeholder="Password" wire:model="password" id="password" type="password"
                class="input input-bordered w-full max-w-xs" />
            <div>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            </div>
             <div>
            <input placeholder="confirm Password" wire:model="password_confirmation" id="password_confirmation"
                type="password" class="input input-bordered w-full max-w-xs" />
            <div>
                @error('password_confirmation')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            </div>
            </div>
           <div class="flex justify-end mt-5">
            <button wire:click="$dispatch('closeModal')" class="btn btn-secondary me-3">Cancel</button>

            <button wire:click="update" class="btn btn-primary">Update</button>
        </div>
        </form>

    </div>
</div>
