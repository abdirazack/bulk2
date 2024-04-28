<div>
    {{-- Create User form  --}}
    <div class="flex justify-between m-4">
        <h1 class="text-2xl font-bold">Create User</h1>
        <button class="btn btn-primary " wire:click="create">Create User</button>
    </div>
    <div class="bg-base-300 p-5">
        <form wire:submit.prevent="store">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="name" value="{{ __('Username') }}" />
                    <x-text-input wire:model="username" id="name" type="text"
                        class="mt-1 block
                        w-full" />
                    
                </div>
                <div>
                    <x-input-label for="email" value="{{ __('Email') }}" />
                    <x-text-input wire:model="email" id="email" type="email"
                        class="mt-1 block
                        w-full" />
                    
                </div>
                <div>
                    <x-input-label for="password" value="{{ __('Password') }}" />
                    <x-text-input wire:model="password" id="password" type="password"
                        class="mt-1 block
                            w-full" />
                   
                </div>
                <div>
                    <x-input-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password"
                        class="mt-1 block
                                w-full" />
                    
                </div>
               
            </div>
            <div class="flex justify-end">
                <x-secondary-button wire:click="create = false">Cancel</x-secondary-button>
                <x-primary-button wire:click="store" class="ms-3">Create User</x-primary-button>
            </div>
        </form>

    </div>
</div>
