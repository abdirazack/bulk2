<?php

namespace Database\Seeders;

use App\Models\OrganizationWallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

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
