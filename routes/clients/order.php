<?php

//  middleware(['auth'])
Route::prefix('order')->name('order.')->namespace('Client\Order')->group(function () {    
    
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('show', 'IndexController@show')->name('show');

    Route::get('create', 'ActionController@create')->name('create');
    Route::post('store', 'ActionController@store')->name('store');
    
    Route::get('edit/{order}', 'ActionController@edit')->name('edit');
    Route::post('update/{order}', 'ActionController@update')->name('update');

});