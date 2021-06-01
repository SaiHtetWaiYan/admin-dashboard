<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;
use Spatie\Permission\Models\Permission;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-own-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['store']]);
         $this->middleware('permission:user-edit', ['only' => ['update']]);
         $this->middleware('permission:user-own-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy','restore']]);
    }

    public function export($users) 
    {    
        $id = explode(",",$users);
        return Excel::download(new UsersExport($id), 'users_list.xlsx');
    }

    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);

        $query = User::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%')
                  ->orWhere('email', 'like', '%'.request('search').'%');
        }

        if (request('role')) {
            $query->role(request('role'));
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if (request('trashed')) {
            if (request('trashed') === 'with') {
                $query->withTrashed();
            } 
            elseif (request('trashed') === 'only') {
                $query->onlyTrashed();
            }
        }

        if(Auth::user()->hasRole('SuperAdmin'))
        {
            $query->get();
            $role = Role::pluck('name','name')->all();
        }
        else{
            $query->whereHas('roles', function ($query) {
                $query->where('name','!=', 'SuperAdmin');
            });
            $role = Role::pluck('name','name')->except('SuperAdmin')->all();
        }
        $users_id = $query->get();
        return Inertia::render('Users/Index', [
            'users' => $query->paginate()
                             ->withQueryString()
                             ->through(function ($user) {
                                return [
                                    'id' => $user->id,
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'photo' => $user->photoUrl(['w' => 120, 'h' => 120, 'fit' => 'crop']),
                                    'role' => $user->roles->pluck('name') ? $user->roles->pluck('name') : null ,
                                    'deleted_at' => $user->deleted_at,
                                ];
                             }),
            'roles' => $role,
            'users_id' => $users_id,              
            'filters' => request()->all(['search', 'field', 'trashed' , 'direction','role'])
        ]);

    }

    public function store()
    {
       
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['required'],
            'role' => ['nullable'],
            'photo' => ['nullable', 'image'],
        ]);

        
        $user = User::create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'password' => Hash::make( Request::get('password') ),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
        ]);
        
        if(Request::get('role')){
            $user->assignRole( Request::get('role'));
        }
        else{
            $user->assignRole('User');
        }
        

        return Redirect::route('users')->with('success', 'User created.');
    }

    public function edit(User $user)
    {   
        
        if(Auth::user()->hasRole('SuperAdmin') )
        {
            $role = Role::pluck('name','name')->all();
            
        }
        elseif(Auth::user()->id == $user->id)
        {
            $role = Role::pluck('name','name')->except('SuperAdmin')->all();

        }
        else
        {
            return abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
        }

        return Inertia::render('Users/Profile', [
            'roles' => $role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles->pluck('name') ? $user->roles->pluck('name') : null ,
                'photo' => $user->photoUrl(['w' => 120, 'h' => 120, 'fit' => 'crop']),
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {
        

        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
            'role' => ['required'],
            'photo' => ['nullable', 'image'],

        ]);

        $user->update(Request::only('name', 'email'));

        if (Request::file('photo')) {
            $user->update(['photo_path' => Request::file('photo')->store('users')]);
        }

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
    
        $user->assignRole(Request::get('role'));

        return Redirect::back()->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        
        $user->delete();

        return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }
}
