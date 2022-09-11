<?php

use Illuminate\Support\Facades\Route;
use Smbplus\UserManagement\Http\Controllers\UserController;


//Route::get('/roles', [\Smbplus\UserManagement\Http\Controllers\RoleController::class, 'index'])->name('roles.index');

Route::resource('users', \Smbplus\UserManagement\Http\Controllers\UserController::class);

Route::resource('roles', \Smbplus\UserManagement\Http\Controllers\RoleController::class);

Route::resource('permissions', \Smbplus\UserManagement\Http\Controllers\PermissionController::class);