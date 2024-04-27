<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       

            <div class="mt-5">
                <div class="overflow-x-auto">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="flex justify-between m-4">
                        <h1 class="text-2xl font-bold">Users</h1>
                        <button 
                             x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'create-user')"
                            class="btn btn-primary " >Create User</button>
                    </div>
                    <table class="table bg-base-300 p-5">
                        <!-- head -->
                        <thead class=" p-5">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover" wire:key="{{ $user->id }}">
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->roles->isNotEmpty())
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        @else
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="view({{ $user->id }})">View</button>
                                        <button class="btn btn-sm bg-red-700"
                                            wire:confirm="Are you sure you want to delete this post?"
                                            wire:click="delete({{ $user->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
         <x-modal name="create-user" :show="$errors->isNotEmpty()" focusable>
           
            <div class="bg-base-200 p-5">
            {{-- modal title --}}
                <div class="flex justify-between">
                    <h2 class="text-lg font-medium">Create User</h2>
                    <button class="btn btn-sm btn-danger" x-on:click="$dispatch('close')">X</button>
                </div>
                {{-- <form wire:submit.prevent="store">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" value="{{ __('Name') }}" />
                            <x-text-input wire:model="name" id="name" type="text"
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
                            <
                        </div>
                       
                    </div>
                    <div class="flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                        <x-primary-button wire:click="store" class="ms-3">Create User</x-primary-button>
                    </div>
                </form> --}}
                <livewire:user.create/>
            </div>
        </x-modal>
         
    </div>
</div>
