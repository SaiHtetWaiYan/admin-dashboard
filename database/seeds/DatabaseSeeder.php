<?php


use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'user-edit',
            'user-own-edit',
            'user-delete'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
        
        
        $user = User::create([
            
            'name' => 'Mg Mg',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    
        $role = Role::create(['name' => 'SuperAdmin']);
        Role::create(['name'=>'User']);
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);


        

        
    }
}
