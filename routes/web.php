<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FallenHerosController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth

Route::get('login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [LoginController::class, 'login'])
    ->name('login.attempt')
    ->middleware('guest');

Route::get('forgotpassword', [ForgotPasswordController::class, 'showForgetPasswordForm'])
    ->name('forgotpassword')
    ->middleware('guest');  
    
Route::post('forgetpassword', [ForgotPasswordController::class, 'submitForgetPasswordForm'])
    ->name('forgetpassword.attempt')
    ->middleware('guest'); 

Route::get('resetpassword/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])
    ->name('resetpassword')
    ->middleware('guest');

Route::post('resetpassword', [ForgotPasswordController::class, 'submitResetPasswordForm'])
    ->name('resetpassword.attempt')
    ->middleware('guest');    

Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('remember', 'auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');  

Route::get('users/{user}/export', [UsersController::class, 'export'])
    ->name('users.export')
    ->middleware('auth');

// Roles

Route::get('roles', [RolesController::class, 'index'])
    ->name('roles')
    ->middleware('remember', 'auth');

Route::post('roles', [RolesController::class, 'store'])
    ->name('roles.store')
    ->middleware('auth');

Route::put('roles/{role}', [RolesController::class, 'update'])
    ->name('roles.update')
    ->middleware('auth');

Route::delete('roles/{role}', [RolesController::class, 'destroy'])
    ->name('roles.destroy')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])->where('path', '.*');


