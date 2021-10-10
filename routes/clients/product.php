<?php
// ->middleware(['auth'])
Route::prefix('product')->name('product.')->namespace('Client\Product')->group(function () {

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('show', 'IndexController@show')->name('show');

    Route::get('create', 'ActionController@create')->name('create');
    Route::post('store', 'ActionController@store')->name('store');
    
    Route::get('edit/{product}', 'ActionController@edit')->name('edit');
    Route::put('update/{product}', 'ActionController@update')->name('update');
    
    Route::delete('delete/{product}', 'ActionController@delete')->name('delete');

    // Add Product Variants
    Route::get('product/{sku}/subProducts/list', 'SubProductController@list')->name('sub_product.list');
    Route::post('product/{sku}/subProducts/store', 'SubProductController@store')->name('sub_product.store');

});