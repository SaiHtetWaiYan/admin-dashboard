<?php

namespace Database\Seeders;


use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-add-role',
            'user-export',
            'user-edit',
            'user-own-edit',
            'user-delete'
         ];
      
        foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
        }
        $SuperAdminrole = Role::create(['name' => 'SuperAdmin']);
        $Userrole = Role::create(['name'=>'User']);
        $permissions = Permission::pluck('id','id')->all();
        $SuperAdminrole->syncPermissions($permissions);

        $SuperAdminuser = User::create([
            'name' => 'Mg Mg',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $SuperAdminuser->assignRole([$SuperAdminrole->id]);

        $Users = User::factory(20)->create();

        foreach ($Users as $User)
        {
            $User->assignRole([$Userrole->id]);
        }
        
    }
}
