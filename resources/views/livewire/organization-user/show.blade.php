<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Organization Users') }}
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
                        <h1 class="text-2xl font-bold">User List</h1>
                        <button 
                             x-data=""
                                 wire:click="$dispatch('openModal', { component: 'organization-user.create' })"
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
                            @foreach ($organizationUsers as $user)
                                <tr class="hover" wire:key="{{ $user->id }}">
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{{ $user->username }}</td>
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
                                           wire:click="$dispatch('openModal', {component: 'organization-user.edit', arguments: {user: {{$user->id}}}})">Edit</button>
                                        <button class="btn btn-sm btn-warning"
                                           wire:click="viewUser({{$user->id}})">View</button>
                                        <button class="btn btn-sm bg-red-700"
                                            wire:confirm="Are you sure you want to delete this post?"
                                            wire:click="delete({{ $user->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="">
                        {{ $organizationUsers->links() }}
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
                {{--  --}}
                <livewire:user.create/>
            </div>
        </x-modal>
         
    </div>
</div>
