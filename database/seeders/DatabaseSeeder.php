<?php

namespace Database\Seeders;


use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use App\Models\OrganizationUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    protected static ?string $password;
    protected static ?string $Userpassword;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(50)->create();
       $org1 = Organization::create(['name' => 'Organization 1', 'email' => 'org1@gmail.com', 'phone' => '666666666', 'address' => '1234 Main St']);
       
        

       $admin =  Role::create(['name' => 'admin']);

       $user = Role::create(['name' => 'user']);

        $create_users = Permission::create(['name' => 'create_users']);
        $edit_users = Permission::create(['name' => 'edit_users']);
        $delete_users = Permission::create(['name' => 'delete_users']);
        $view_users = Permission::create(['name' => 'view_users']);
        $view_user_roles = Permission::create(['name' => 'view_user_roles']);

        $upload_files = Permission::create(['name' => 'upload_files']);

        $admin_user = OrganizationUser::create([
            'organization_id' => $org1->id,
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => static::$password ??= Hash::make('admin1234'),
        ]);

        $normal_user =  OrganizationUser::create([
            'organization_id' => $org1->id,
            'email' => 'user@gmail.com',
            'username' => 'user',
            'password' => static::$Userpassword ??= Hash::make('user1234'),
        ]);

        // give admin role some permissions
        $admin->givePermissionTo( Permission::all());

        $user->givePermissionTo( $view_users);


        $admin_user->assignRole($admin);
        $normal_user->assignRole($user);
    }
}
