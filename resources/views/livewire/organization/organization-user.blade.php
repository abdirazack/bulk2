<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Organzation User') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex  justify-between  m-4 flex-col bg-base-300 p-5 rounded-lg">
            <div class="flex-1 card bordered p-4 m-4">
                <h1 class="text-2xl font-semibold text-center text-accent">{{ $headerText }}</h1>
                <form wire:submit="submit">
                    <div>
                        <label class="label">
                            <span class="text-base label-text">Name</span>
                        </label>
                        <input type="text" placeholder="Name" wire:model="name" name="name"
                            class="w-full input input-bordered block" />

                        @if ($errors->has('name'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="label">
                            <span class="text-base label-text">Email</span>
                        </label>
                        <input type="text" wire:model="email" name="email" placeholder="Email Address"
                            class="w-full input input-bordered" />

                        @if ($errors->has('email'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="label">
                            <span class="text-base label-text">Password</span>
                        </label>
                        <input type="password" wire:model="password" name="password" placeholder="Enter Password"
                            class="w-full input input-bordered" />

                        @if ($errors->has('password'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="label">
                            <span class="text-base label-text">Confirm Password</span>
                        </label>
                        <input type="password" wire:model="confrmation_password" name = "confrmation_password"
                            placeholder="Confirm Password" class="w-full input input-bordered" />

                        @if ($errors->has('confrmation_password'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('confrmation_password') }}</p>
                        @endif
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-block btn-accent">{{ $btnText }}</button>
                    </div>

                </form>
            </div>
            @if ($user_id)
                <h1 class="text-xl font-semibold text-center text-accent">Roles</h1>
                <div class="justify-between bordered p-4 m-4">
                    <div class="grid grid-flow-col">
                        @if ($this->doesUserHaveRole())
                            {{-- {{ dd( $this->user->roles()->first()->id) }} --}}
                            <div class="card bordered p-4 mb-3 me-2">
                                <h2 class="text-lg font-bold">{{ $this->user->roles()->first()->name }}</h2>
                                <p>{{ $this->user->roles()->first()->description }}</p>
                                <div class="flex justify-end">
                                    <button class="btn btn-sm btn-primary"
                                        wire:click="detach({{ $this->user->roles()->first()->id }})">Remove</button>
                                </div>
                            </div>
                        @else
                            @foreach ($roles as $role)
                                <div class="card bordered p-4 mb-3 me-2" wire:key="{{ $role->id }}">
                                    <h2 class="text-lg font-bold">{{ $role->name }}</h2>
                                    <p>{{ $role->description }}</p>
                                    <div class="flex justify-end">
                                        <button class="btn btn-sm btn-primary"
                                            wire:click="attach({{ $role->id }})">Assign</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
