<div class="bg-base-200 p-5">
    {{-- Create User form  --}}
    <div class="flex justify-between m-4">
        <h1 class="text-xl font-bold">Create User</h1>
        <button wire:click="$dispatch('close')" class="btn btn-sm btn-circle btn-ghost ">✕</button>
    </div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="bg-base-100 p-10 rounded ">
        <form wire:submit="save">
            <div class="grid  grid-cols-2 gap-4">
                <div>
                    <input placeholder="Username" wire:model="username" id="name" type="text"
                        class="input input-bordered w-full max-w-xs" />

                    <div>
                        @error('username')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                <div>
                    <input placeholder="email" wire:model="email" id="email" type="email"
                        class="input input-bordered w-full max-w-xs" />
                    <div>
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div x-data="{ show: false }">
                    <div class="relative">
                        <input placeholder="Password" wire:model="password" id="password"
                            :type="show ? 'text' : 'password'" class="input input-bordered w-full max-w-xs pr-10" />
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 focus:outline-none">
                            <i x-show="!show" class="fas fa-eye"></i>
                            <i x-show="show" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                    <div>
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <div class="relative">
                        <input placeholder="Confirm Password" wire:model="password_confirmation"
                            id="password_confirmation" :type="show ? 'text' : 'password'"
                            class="input input-bordered w-full max-w-xs pr-10" />
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 focus:outline-none">
                            <i x-show="!show" class="fas fa-eye"></i>
                            <i x-show="show" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                    <div>
                        @error('password_confirmation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>





            <div class="flex justify-end mt-3">
                {{-- <a wire:click="$dispatch('closeModal')" class="btn btn-secondary me-3">Cancel</a> --}}
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>

    </div>
</div>
