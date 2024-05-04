<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
               
                    <div class="stats shadow">
                        <div class="flex flex-row gap-2 justify-items-center">
                            <div class="bg-base-300 stat flex-1">
                                <div class="stat-title">Total Users</div>
                                <div class="stat-value">{{ count($users) }}</div>
                                <div class="stat-desc">21% more than last month</div>
                            </div>
                            <div class="stat flex-2 bg-base-300">
                                <div class="stat-title">Total Users</div>
                                <div class="stat-value">{{ count($users) }}</div>
                                <div class="stat-desc">21% more than last month</div>
                            </div>
                            <div class="stat flex-3 bg-base-300">
                                <div class="stat-title">Total Users</div>
                                <div class="stat-value">{{ count($users) }}</div>
                                <div class="stat-desc">21% more than last month</div>
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
