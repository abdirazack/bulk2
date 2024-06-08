<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php

        //CREATE SAMPLE DATA FOR THE VARIABLES
        $totalAmount = 0;
        $totalBatches = 0;
        $totalApprovedBatches = 0;
        $totalPendingBatches = 0;
        $totalRejectedBatches = 0;
        $totalSuccessPayments = 0;
        $totalPendingPayments = 0;
        $totalActiveUsers = 0;
        $totalSuspendedUsers = 0;

       $totalApproved = 0;

    @endphp
 <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Wallet Information -->
            <div class="bg-gray-900 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Wallet Information</h3>
                <div class="flex justify-between items-center">
                    <span>Total Amount</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $totalAmount ? $totalAmount : 0 }}</span>
                </div>
            </div>

            <livewire:dashboardstats />

            <!-- Card 2: Batches Information -->
            <div class="bg-gray-900 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Batches Information</h3>
                <div class="mb-4">
                    <span class="inline-block bg-green-500 text-white px-2 py-1 rounded mr-2">Approved</span>
                    <span class="inline-block bg-yellow-500 text-white px-2 py-1 rounded mr-2">Pending</span>
                    <span class="inline-block bg-red-500 text-white px-2 py-1 rounded">Rejected</span>
                </div>
                <span class="text-gray-600">Total Approved: {{ $totalApproved ? $totalApproved : 0 }}</span>
            </div>

            <!-- Card 3: Payment Information -->
            <div class="bg-gray-900 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Payment Information</h3>
                <div>
                    <span class="inline-block bg-green-500 text-white px-2 py-1 rounded mr-2">Success</span>
                    <span class="text-gray-600">Total Success Payments: {{ $totalSuccessPayments ? $totalSuccessPayments : 0 }}</span>
                </div>
                <div class="mt-4">
                    <span class="inline-block bg-yellow-500 text-white px-2 py-1 rounded mr-2">Pending</span>
                    <span class="text-gray-600">Total Pending Payments: {{ $totalPendingPayments ? $totalPendingPayments : 0 }}</span>
                </div>
            </div>

            <!-- Card 4: Users Information -->
            <div class="bg-gray-900 text-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Users Information</h3>
                <div>
                    <span class="inline-block bg-blue-500 text-white px-2 py-1 rounded mr-2">Active</span>
                    <span class="text-gray-600">Total Active Users: {{ $totalActiveUsers ? $totalActiveUsers : 0 }}</span>
                </div>
                <div class="mt-4">
                    <span class="inline-block bg-red-500 text-white px-2 py-1 rounded mr-2">Suspended</span>
                    <span class="text-gray-600">Total Suspended Users: {{ $totalSuspendedUsers ? $totalSuspendedUsers : 0 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>


     <!-- Latest Transactions -->
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-900 text-white rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Latest Transactions</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Last Login</th>
                            <th>Favorite Color</th>
                        </tr>
                    
                    <tbody>
                      
                        <tr>
                            <td>1</td>
                            <td>done</td>
                            <td>test</td>
                            <td>yes</td>
                            <td>dsgsdgs</td>
                            <td>sdgsgs/td>
                            <td>sdg</td>
                        </tr>
               
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
