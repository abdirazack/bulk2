<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-300 mt-12 overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                <h1 class="text-2xl font-bold p-4">Settings</h1>
                <h3 class="text-xl font-bold p-8">Change Theme</h3>
                <div class="flex flex-row ">
                    <div class="grid grid-row grid- gap-9 p-12">
                        <div>
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller btn-wide" aria-label="Default" value="default" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="Retro" value="retro" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="Cyberpunk" value="cyberpunk" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="Valentine" value="valentine" />
                        </div>
                        <div>
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="Aqua" value="aqua" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="cupcake" value="cupcake" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="bumblebee" value="bumblebee" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="emerald" value="emerald" />
                        </div>
                        <div>
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="corporate" value="corporate" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="synthwave" value="synthwave" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="halloween" value="halloween" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="garden" value="garden" />
                        </div>
                        <div>
                       
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="forest" value="forest" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="lofi" value="lofi" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="pastel" value="pastel" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="fantasy" value="fantasy" />
                        </div>
                        <div>
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="wireframe" value="wireframe" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="black" value="black" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="luxury" value="luxury" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="dracula" value="dracula" />
                        </div>
                        <div>
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="cmyk" value="cmyk" />
                        
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="autumn" value="autumn" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="business" value="business" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="acid" value="acid" />
                        </div>
                        <div>
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="lemonade" value="lemonade" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="night" value="night" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="coffee" value="coffee" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="winter" value="winter" />
                        </div>
                        <div>
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="dim" value="dim" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="nord" value="nord" />
                            <input wire:click="toggleTheme()" type="radio" wire:model="theme"
                                class="btn theme-controller  btn-wide" aria-label="sunset" value="sunset" />
                        </div>

                    </div>
                </div>
                <div class="m-4 p-4">
                    <label>
                        
                        <button wire:click="clearCache()" class="btn btn-primary">Clear Cache</button>
                    </label>
                </div>
            </div>
        </div>
