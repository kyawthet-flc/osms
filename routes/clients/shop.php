<?php
Route::prefix('shop')->name('shop.')->namespace('Client\Shop')->group(function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('show', 'IndexController@show')->name('show');

    Route::get('create', 'ActionController@create')->name('create');
    Route::post('store', 'ActionController@store')->name('store');
    
    Route::get('edit/{shop}', 'ActionController@edit')->name('edit');
    Route::put('update/{shop}', 'ActionController@update')->name('update');
    
    Route::delete('delete/{shop}', 'ActionController@delete')->name('delete');
});