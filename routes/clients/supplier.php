<?php
// ->middleware(['auth'])
Route::prefix('supplier')->name('supplier.')->namespace('Client\Supplier')->group(function () {

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('show/{supplier}', 'IndexController@show')->name('show');

    Route::get('create', 'ActionController@create')->name('create');
    Route::post('store', 'ActionController@store')->name('store');
    
    Route::get('edit/{supplier}', 'ActionController@edit')->name('edit');
    Route::put('update/{supplier}', 'ActionController@update')->name('update');
    
    Route::delete('delete/{supplier}', 'ActionController@delete')->name('delete');
});