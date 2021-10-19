<?php

Route::prefix('customer')->name('customer.')->namespace('Client\Customer')->group(function () {    
    
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('show', 'IndexController@show')->name('show');

    Route::get('create', 'ActionController@create')->name('create');
    Route::post('store', 'ActionController@store')->name('store');
    
    Route::get('edit/{customer}', 'ActionController@edit')->name('edit');
    Route::put('update/{customer}', 'ActionController@update')->name('update');

    Route::delete('delete/{customer}', 'ActionController@delete')->name('delete');

});