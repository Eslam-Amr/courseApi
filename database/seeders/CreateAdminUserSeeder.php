<?php

// namespace Database\Seeders;

// use App\Models\Admin;
// use App\Models\User;
// use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

// class CreateAdminUserSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         $user = User::create([
//             'name' => 'Admin',
//             'email' => 'admin@gmail.com',
//             // 'name' => 'admin',
//             'password' => 'admin123'
//         ]);

//         $role = Role::create(['name' => 'admin']);

//         $permissions = Permission::pluck('id','id')->all();

//         $role->syncPermissions($permissions);

//         $user->assignRole([$role->id]);
//     }
// }

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        // Check if admin user already exists
        if (User::where('email', 'admin@gmail.com')->exists()) {
            return;
        }

        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        // Check if admin role already exists
        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            // Create admin role if it doesn't exist
            $adminRole = Role::create(['name' => 'admin']);
        }

        // Sync permissions to admin role
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);

        // Assign admin role to the admin user
        $admin->assignRole($adminRole);

        */
        // Permission::create(['name'=>'assignment-solution-index']);
    // $permissionsToAssign = ['assignment-solution-update'];
            $admin=User::find(6);
    $admin->givePermissionTo('assignment-solution-index');
// $admin=user::find(6);
//     foreach ($permissionsToAssign as $permissionName) {
//         $permission = Permission::where('name', $permissionName)->first();

//         if ($permission) {
//             $admin->givePermissionTo($permission);
//         } else {
//             // Log or handle missing permission error
//             // This permission does not exist in the database: $permissionName
//         }
//     }
    }
}
