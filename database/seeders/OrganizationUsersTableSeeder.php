<?php

namespace Database\Seeders;

use App\Models\OrganizationUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

class OrganizationUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Factory::factory(OrganizationUser::class, 10)->create();
    }
}
