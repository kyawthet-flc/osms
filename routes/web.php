<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@redirectToLogin');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('changePassword', 'HomeController@changePassword')->name('change_password');
Route::post('storeChangedPassword', 'HomeController@storeChangedPassword')->name('store_change_password');

Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('updateProfile', 'HomeController@updateProfile')->name('update_profile');