 <div>
     <x-slot name="header">
         <h2 class="font-semibold text-xl leading-tight">
             {{ __('Organization Users') }}
         </h2>
     </x-slot>

     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

         <div class="mt-5">

         {{-- display User Details --}}
            <div class="bg-base-200 p-10 rounded ">
                <div class="flex justify-between m-4">
                    <h1 class="text-xl font-bold">User Details</h1>
                </div>
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="card bordered p-4">
                            <h2 class="text-lg font-bold">User Information</h2>
                            <p><span class="font-semibold">Name:</span> {{ $user->username }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                            <p><span class="font-semibold">Created At:</span> {{ $user->created_at }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="card bordered p-4 bg-base-100">
                            <h2 class="text-lg font-bold">Roles</h2>
                            <div class="grid grid-flow-col">
                                @if ($user->roles->isNotEmpty())
                                    @foreach ($user->roles as $role)
                                        <div class="card bordered p-4 mb-3 me-2 bg-base-300">
                                            <h2 class="text-lg font-bold">{{ $role->name }}</h2>
                                            <p>{{ $role->description }}</p>
                                             <button class="btn btn-sm btn-primary"
                                         wire:click="detach({{ $this->user->roles()->first()->id }})">Remove</button>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No roles assigned</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             @if ($user_id)
                 <div class="justify-between bordered p-4 m-4 bg-base-200">
                         @if (!$this->doesUserHaveRole())
                         <h1 class="text-xl font-semibold text-center text-accent">Roles</h1>
                          <div class="grid grid-flow-col">
                             @foreach ($roles as $role)
                                 <div class="card bordered p-4 mb-3 me-2 bg-base-100" wire:key="{{ $role->id }}">
                                     <h2 class="text-lg font-bold">{{ $role->name }}</h2>
                                     <p>{{ $role->description }}</p>
                                     <div class="flex justify-end">
                                         <button class="btn btn-sm btn-primary"
                                             wire:click="attach({{ $role->id }})">Assign</button>
                                     </div>
                                 </div>
                             @endforeach
                     </div>
                        @else
                            <p class="text-center">User already has a role</p>
                         @endif
                 </div>
             @endif
         </div>
     </div>
 </div>

