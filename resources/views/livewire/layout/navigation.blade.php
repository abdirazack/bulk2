<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<div class="bg-base-300">
    <div class="max-w-7xl mx-auto ">
        <nav class="navbar justify-between ">
            <!-- Logo -->
            <a class="btn btn-ghost text-lg" href="{{ route('dashboard') }}" wire:navigate>
                {{ env('APP_NAME', 'App') }}
            </a>

            <!-- Menu for desktop -->
            <div class="hidden sm:flex gap-2">
                <a class="btn btn-ghost btn-sm  {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}" wire:navigate>
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
                <a class="btn btn-ghost btn-sm  {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('file-upload') }}" wire:navigate>
                    <i class="fa-solid fa-house"></i>
                    Upload
                </a>

                <a class="btn btn-ghost btn-sm" href="{{ route('roles') }}" wire:navigate>
                    <i class="fa-solid fa-users text-secondary"></i>
                    Roles
                </a>
                <a class="btn btn-ghost btn-sm" href="{{ route('users') }}" wire:navigate>
                    <i class="fa-solid fa-user text-secondary"></i>
                    Users
                </a>
                

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS Navbar component"
                                src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <a class="justify-between " href="{{ route('profile') }}" wire:navigate>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a class="justify-between">
                                Notifications
                                <span class="badge">3</span>
                            </a>
                        </li>
                        <li><a>Settings</a></li>
                        <li><button wire:click="logout">Logout</button></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>


{{-- <div class="bg-base-300">
    <div class="max-w-7xl mx-auto navbar">
        <div class="flex-1">
            <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl">
                <x-application-logo class="w-10 h-10 rounded-full" />
            </a>
        </div>
        <div class="flex-none gap-2">
            <!-- Search Input -->
            <div class="form-control">
                <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
            </div>
            <!-- Dropdown Menu -->
            <div class="dropdown dropdown-end">
                <!-- Profile Button -->
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="{{ auth()->user()->name }}"
                            src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                    </div>
                </div>
                <!-- Dropdown Menu Content -->
                <ul tabindex="0"
                    class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                    <!-- Profile Link -->
                    <li>
                        <a href="{{ route('profile') }}" class="justify-between">
                            Profile
                        </a>
                    </li>
                    <!-- Settings Link -->
                    <li>
                        <a href="#">
                            Settings
                        </a>
                    </li>
                    <!-- Logout Button -->
                    <li>
                        <button wire:click="logout" class="btn btn-sm btn-error">
                            Logout
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}
