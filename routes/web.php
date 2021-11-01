<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@redirectToLogin');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('document')->name('document.')->namespace('Client\Document')->group(function () {
    Route::get('printOrder/{order}/{type}', 'ActionController@printOrder')->name('order.print');
    Route::get('printDownload/{file}/{type}', 'ActionController@downloadOrder')->name('order.download');
});

Auth::routes();

Route::get('changePassword', 'HomeController@changePassword')->name('change_password');
Route::post('storeChangedPassword', 'HomeController@storeChangedPassword')->name('store_change_password');

Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('updateProfile', 'HomeController@updateProfile')->name('update_profile');

Route::get('contact', 'HomeController@contact')->name('contact');
Route::post('saveContact', 'HomeController@saveContact')->name('save_contact');