<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationWallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationWalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WithoutModelEvents::disable(function () {
            Factory::factory(OrganizationWallet::class, 10)->create();
        });
    }
}
