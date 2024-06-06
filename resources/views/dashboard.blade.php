<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl bg-base-100 mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-base-200">
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card 1 -->
                        <div class="card w-full bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title">Wallet information</h3>
                                <div class="card-actions justify-start">
                                    <button class="btn btn-sm">
                                        Total Amount
                                        <div class="badge badge-accent badge-outline">434</div>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="card w-full bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title"> Batches information </h3>
                                <div class="card-actions justify-start flex-wrap">
                                    <button class="btn btn-sm mb-2">
                                       Approved 
                                        <div class="badge badge-outline">3424</div>
                                        
                                    </button>
                                    <button class="btn btn-sm mb-2">
                                        Pending
                                        <div class="badge badge-outline">3424</div>
                                        Rejected
                                        <div class="badge badge-outline">3424</div>
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                             <!-- Card 2 -->
                             <div class="card w-full bg-base-100 shadow-xl">
                                <div class="card-body">
                                    <h3 class="card-title">Payment information </h3>
                                    <div class="card-actions justify-start flex-wrap">
                                        <div class="btn btn-sm mb-1">
                                            Success 
                                            <div class="badge badge-outline">3424</div>
                                            Total Amount
                                            <div class="badge badge-outline">3424</div>
                                            
                                            Pending 
                                            <div class="badge badge-outline">3424</div>
                                            Total Amount
                                            <div class="badge badge-outline">3424</div>
                                        </button>
                                        
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="card w-full bg-base-100 shadow-xl">
                                <div class="card-body">
                                    <h3 class="card-title">Users information </h3>
                                    <div class="card-actions justify-start flex-wrap">
                                        <div class="btn btn-sm mb-2">
                                            Active 
                                            <div class="badge badge-outline">3424</div>
                                            suspend 
                                            <div class="badge badge-outline">3424</div>
                                            Roles 
                                            <div class="badge badge-outline">3424</div>
                                            Total Amount
                                            <div class="badge badge-outline">3424</div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                           

                            <div class="card w-full bg-base-100 shadow-xl">
                                <div class="card-body">
                                    <h3 class="card-title">Latest Transactions </h3>
                                    <div class="card-actions justify-start flex-wrap">
                                        <div>
                                            <table class="table table-xs">
                                              <thead>
                                                <tr>
                                                  <th></th> 
                                                  <th>Name</th> 
                                                  <th>Job</th> 
                                                  <th>company</th> 
                                                  <th>location</th> 
                                                  <th>Last Login</th> 
                                                  <th>Favorite Color</th>
                                                </tr>
                                              </thead> 
                                              <tbody>
                                                <tr>
                                                  <th>1</th> 
                                                  <td>Cy Ganderton</td> 
                                                  <td>Quality Control Specialist</td> 
                                                  <td>Littel, Schaden and Vandervort</td> 
                                                  <td>Canada</td> 
                                                  <td>12/16/2020</td> 
                                                  <td>Blue</td>
                                                </tr>
                                                <tr>
                                                  <th>2</th> 
                                                  <td>Hart Hagerty</td> 
                                                  <td>Desktop Support Technician</td> 
                                                  <td>Zemlak, Daniel and Leannon</td> 
                                                  <td>United States</td> 
                                                  <td>12/5/2020</td> 
                                                  <td>Purple</td>
                                                </tr>
                                                <tr>
                                                  <th>3</th> 
                                                  <td>Brice Swyre</td> 
                                                  <td>Tax Accountant</td> 
                                                  <td>Carroll Group</td> 
                                                  <td>China</td> 
                                                  <td>8/15/2020</td> 
                                                  <td>Red</td>
                                                </tr>
                                                <tr>
                                                  <th>4</th> 
                                                  <td>Marjy Ferencz</td> 
                                                  <td>Office Assistant I</td> 
                                                  <td>Rowe-Schoen</td> 
                                                  <td>Russia</td> 
                                                  <td>3/25/2021</td> 
                                                  <td>Crimson</td>
                                                </tr>
                                                <tr>
                                                  <th>5</th> 
                                                  <td>Yancy Tear</td> 
                                                  <td>Community Outreach Specialist</td> 
                                                  <td>Wyman-Ledner</td> 
                                                  <td>Brazil</td> 
                                                  <td>5/22/2020</td> 
                                                  <td>Indigo</td>
                                                </tr>
                                                <tr>
                                                  <th>6</th> 
                                                  <td>Irma Vasilik</td> 
                                                  <td>Editor</td> 
                                                  <td>Wiza, Bins and Emard</td> 
                                                  <td>Venezuela</td> 
                                                  <td>12/8/2020</td> 
                                                  <td>Purple</td>
                                                </tr>
                                                <tr>
                                                  <th>7</th> 
                                                  <td>Meghann Durtnal</td> 
                                                  <td>Staff Accountant IV</td> 
                                                  <td>Schuster-Schimmel</td> 
                                                  <td>Philippines</td> 
                                                  <td>2/17/2021</td> 
                                                  <td>Yellow</td>
                                                </tr>
                                                <tr>
                                                  <th>8</th> 
                                                  <td>Sammy Seston</td> 
                                                  <td>Accountant I</td> 
                                                  <td>O'Hara, Welch and Keebler</td> 
                                                  <td>Indonesia</td> 
                                                  <td>5/23/2020</td> 
                                                  <td>Crimson</td>
                                                </tr>
                                                <tr>
                                                  <th>9</th> 
                                                  <td>Lesya Tinham</td> 
                                                  <td>Safety Technician IV</td> 
                                                  <td>Turner-Kuhlman</td> 
                                                  <td>Philippines</td> 
                                                  <td>2/21/2021</td> 
                                                  <td>Maroon</td>
                                                </tr>
                                              </tfoot>
                                            </table>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Additional Cards can be added similarly -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
