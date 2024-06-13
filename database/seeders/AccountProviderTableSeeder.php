<?php

namespace Database\Seeders;

use App\Models\AccountProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

class AccountProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Factory::factory(AccountProvider::class, 5)->create();
    }
}
