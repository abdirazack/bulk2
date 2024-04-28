<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\OrganizationsTableSeeder;
use Database\Seeders\OrganizationUsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(50)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // $this->call([
        //     OrganizationsTableSeeder::class,
        //     OrganizationUsersTableSeeder::class,
        //     PermissionsTableSeeder::class,
        //     RolesTableSeeder::class,
        // ]);
    }
}
