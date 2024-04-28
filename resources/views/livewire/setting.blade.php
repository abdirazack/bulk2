<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-300 mt-12 overflow-hidden shadow-sm sm:rounded-lg">
            <h1 class="text-2xl font-bold p-4">Settings</h1>
                <h3 class="text-xl font-bold p-8">Change Theme</h3>
            <div class="hero">
                <div class="grid grid-flow-row gap-9 p-12">
                    <input  wire:click="toggleTheme()" type="radio" wire:model="theme" class="btn theme-controller btn-wide" aria-label="Default"
                        value="default" />
                    <input  wire:click="toggleTheme()" type="radio" wire:model="theme" class="btn theme-controller  btn-wide" aria-label="Retro"
                        value="retro" />
                    <input  wire:click="toggleTheme()" type="radio" wire:model="theme" class="btn theme-controller  btn-wide"
                        aria-label="Cyberpunk" value="cyberpunk" />
                    <input  wire:click="toggleTheme()" type="radio" wire:model="theme" class="btn theme-controller  btn-wide"
                        aria-label="Valentine" value="valentine" />
                    <input  wire:click="toggleTheme()" type="radio" wire:model="theme" class="btn theme-controller  btn-wide" aria-label="Aqua"
                        value="aqua" />
                </div>

            </div>
        </div>
</div>
