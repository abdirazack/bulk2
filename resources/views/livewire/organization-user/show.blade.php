<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Organization Users') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-5">
            <div class="overflow-x-auto">
                @if (session()->has('success'))
                    <div class="alert alert-success p-5">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-success p-5">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="flex justify-between m-4">
                    <div class="text-2xl font-bold">
                        <input type="text" wire:model.live.debounce.250ms="search" class="input input-bordered" placeholder="Search Users">
                    </div>
                   
                    @can('create_users')
                        <button x-data=""
                            wire:click="$dispatch('openModal', { component: 'organization-user.create' })"
                            class="btn btn-primary ">Create User</button>
                    @endcan

                </div>
                <table class="table bg-base-300 p-5">
                    <!-- head -->
                    <thead class=" p-5">
                        <tr>
                            <th></th>
                            <th>
                                @if($sortField !== 'username')
                                    <button wire:click="sortBy('username')">Name &nbsp;
                                    <i class="fa-solid fa-sort"></i></button>
                                @else
                                    <button wire:click="sortBy('username')">
                                        Name &nbsp;
                                        @if($sortOrder === 'asc')
                                            <i class="fa fa-sort-up"></i>
                                        @else
                                            <i class="fa fa-sort-down"></i>
                                        @endif
                                    </button>
                                @endif
                            </th>
                            <th>
                                @if($sortField !== 'email')
                                    <button wire:click="sortBy('email')">Email &nbsp;
                                    <i class="fa-solid fa-sort"></i></button>
                                @else
                                    <button wire:click="sortBy('email')">
                                        Email &nbsp;
                                        @if($sortOrder === 'asc')
                                            <i class="fa fa-sort-up"></i>
                                        @else
                                            <i class="fa fa-sort-down"></i>
                                        @endif
                                    </button>
                                @endif
                            </th>
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
                                <td
                                    class="{{ $user->roles->first() && $user->roles->first()->name === 'admin' ? 'text-red-500' : 'text-blue-500' }}">
                                    {{ $user->roles->first()?->name ?? '' }}
                                </td>

                                <td class="text-center">
                                    @can('edit_users')
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="$dispatch('openModal', {component: 'organization-user.edit', arguments: {user: {{ $user->id }}}})">Edit</button>
                                    @endcan
                                    @can('view_user_roles')
                                        <button class="btn btn-sm btn-warning"
                                            wire:click="viewUser({{ $user->id }})">View</button>
                                    @endcan
                                    @can('delete_users')
                                        <button class="btn btn-sm bg-red-700"
                                            wire:click="$dispatch('openModal', {component: 'organization-user.delete', arguments: {id: {{ $user->id }}}})">Delete</button>
                                    @endcan
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
    </div>
</div>
