<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="flex justify-between m-4 flex-col bg-base-300 p-5 rounded-lg">
            <h1 class="text-2xl font-bold">Roles </h1>
            {{-- role card with its permissions --}}
            <div class="card bordered  bg-base-200 p-4 m-4">
                <div class="flex justify-between">
                    <h2 class="text-lg font-bold">Role: {{ $this->roles->name }}</h2>
                </div>
                <p class="small">{{ $this->roles->description }}</p>
                <h2 class="text-lg font-bold">Permissions For {{ $this->roles->name }}</h2>
                <div class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($this->roles->permissions as $permission)
                        <div class="bg-base-100  card bordered p-4" wire:key="{{ $permission->id }}">
                            <h2 class="text-lg font-bold">{{ $permission->name }}</h2>
                            <p>{{ $permission->description }}</p>

                            <div class="flex justify-end">
                                <button class="btn btn-sm btn-warning"
                                    wire:click="detach({{ $this->roles->id }},{{ $permission->id }})">Detach</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <h1 class="text-2xl font-bold">Permissions </h1>
            <div class="bg-base-200 card bordered p-4 m-4">
                <h2 class="text-lg font-bold">Assign New Permissions To {{ $this->roles->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($this->permissions as $permission)
                        <div class="bg-base-100  card bordered p-4" wire:key="{{ $permission->id }}">
                            <h2 class="text-lg font-bold">{{ $permission->name }}</h2>
                            <p>{{ $permission->description }}</p>
                            <div class="flex justify-end">
                                <button class="btn btn-sm btn-primary"
                                    wire:click="attach({{ $this->roles->id }},{{ $permission->id }})">Attach</button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
