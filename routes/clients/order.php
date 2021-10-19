<?php

//  middleware(['auth'])
Route::prefix('order')->name('order.')->namespace('Client\Order')->group(function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('show/{order}', 'IndexController@show')->name('show');

    Route::get('create', 'ActionController@create')->name('create');
    Route::post('store', 'ActionController@store')->name('store');
    
    // Route::get('edit/{order}', 'ActionController@edit')->name('edit');
    // Route::put('update/{order}', 'ActionController@update')->name('update');
    
    Route::delete('delete/{order}', 'ActionController@delete')->name('delete');

    Route::post('saveProductAttributes', 'ActionController@saveProductAttributes')->name('save_product_variations');
    Route::delete('deleteProductAttribute/{order}/{orderDetail}/{product}/{subProduct}/{quantity}', 'ActionController@deleteProductAttribute')->name('delete_product_variations');
});