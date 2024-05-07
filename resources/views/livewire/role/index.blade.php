<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Roles and Permissions') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="hero ">

            <div class="mt-5">
                <div class="overflow-x-auto">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="flex justify-between m-4">
                <h1 class="text-2xl font-bold">Roles </h1>
                    {{-- <button class="btn btn-primary " wire:click="create">Create User</button> --}}
                </div>
                    <table class="table bg-base-300 p-5">
                        <!-- head -->
                        <thead class=" p-5">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            {{-- the role's permissions --}}
                            @foreach ($this->roles as $role)
                                <tr class="hover rounded" wire:key="{{$role->id}}">
                                    <th>{{($loop->index)+1}}</th>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" wire:click="view({{$role->id}})">View</button>
                                    </td>
                                </tr>
                                {{-- the role's permissions --}}
                                @if ($role->permissions->isNotEmpty())
                                    <tr class="rounded" wire:key="{{$role->id}}-permissions">
                                        <th></th>
                                        <td colspan="2" class="rounded">
                                            <h2 class="text-lg font-bold">Permissions ({{ $role->permissions->count() }})</h2>
                                            <table class="table bg-base-200 p-5">
                                                
                                                <tbody>
                                                    @foreach ($role->permissions as $permission)
                                                        <tr class="hover rounded" wire:key="{{$permission->id}}">
                                                            <td>{{$permission->name}} Permission</td>
                                                            <td>
                                                                <button class="btn btn-sm bg-red-600" wire:click="removePermission({{$role->id}},{{ $permission->id}})">Remove</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                           
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
