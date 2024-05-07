<div class="bg-base-100 p-5">
    {{-- Create User form  --}}
    <div class="flex justify-between m-4">
        <h1 class="text-xl font-bold">Create User</h1>
    </div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="bg-base-200 p-10 rounded ">
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




            <div class="flex justify-end mt-3">
                <a wire:click="$dispatch('closeModal')" class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>

    </div>
</div>
