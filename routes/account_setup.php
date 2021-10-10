<?php

use Illuminate\Support\Facades\Route;

// App\Http\Controllers\AccountSetup\AdminUserController

Route::prefix('accountSetup')->name('account_setup.')->middleware(['auth'])->group(function () {
    // Admin User
    Route::resource('adminUsers', 'AccountSetup\AdminUserController');
    Route::resource('roles', 'AccountSetup\RoleController');
    Route::resource('adminUsers.permissions', 'AccountSetup\UserPermissionController');
    Route::resource('roles.permissions', 'AccountSetup\RolePermissionController');
});