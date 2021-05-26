<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use DB;
use Illuminate\Support\Facades\Auth;
class RolesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['store']]);
         $this->middleware('permission:role-edit', ['only' => ['update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        
        if(Auth::user()->hasRole('SuperAdmin'))
        {
            $role = Role::with('permissions')->orderBy('id','DESC')->get();
        }
        else{
            $role = Role::where('name','!=','SuperAdmin')->with('permissions')->orderBy('id','DESC')->get();
        }

        
       
        return Inertia::render('Roles/Index', [
            'roles' => $role,
            'permissions' => Permission::get()
            ],
        );  
    }

   
    public function store()
    {
        Request::validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => Request::get('name')]);
        $role->syncPermissions(Request::get('permissions'));
    
        return Redirect::route('roles')->with('success', 'Role created.');
    }

   

    public function update(Role $role)
    {
        Request::validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
    
        for ($x = 0; $x < count(Request::get('permissions')); $x++) {
            $checked []= DB::table("permissions")->where("id",Request::get('permissions')[$x])->pluck('name')->all();
          };
        $role = Role::find($role->id);
        $role->name = Request::get('name');
        $role->save();
    
        $role->syncPermissions($checked);
    
        return Redirect::back()->with('success', 'Role updated.');
    }
    
    public function destroy(Role $role)
    {
        DB::table("roles")->where('id',$role->id)->delete();
        return Redirect::route('roles')->with('success', 'Role deleted');
       
    }
    
}
