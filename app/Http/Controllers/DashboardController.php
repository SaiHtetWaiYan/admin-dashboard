<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $role = Role::count();
        return Inertia::render('Dashboard/Index',[
            'user' => $user,
            'role' => $role
        ]);
    }
}
