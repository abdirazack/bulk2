<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrganizationUser;
use App\Models\Role;
class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a role
        $role = Role::all();

        // Create an organization user
        $organizationUser = OrganizationUser::all();

        // Attach the role to the organization user
        foreach ($organizationUser as $user) {
            $user->roles()->attach($role);
        }
    }
}
