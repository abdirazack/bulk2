<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use App\Models\OrganizationUser;
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
        Organization::factory(5)->create();
        OrganizationUser::factory(20)->create();
        Role::factory(5)->create();
        Permission::factory(20)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call([
        //     OrganizationsTableSeeder::class,
        //     OrganizationUsersTableSeeder::class,
        //     PermissionsTableSeeder::class,
        //     RolesTableSeeder::class,
        // ]);
    }
}
