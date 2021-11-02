<?php
// ->middleware(['auth'])
Route::prefix('product')->name('product.')->namespace('Client\Product')->group(function () {

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('show/{product}', 'IndexController@show')->name('show');

    Route::get('create', 'ActionController@create')->name('create');
    Route::post('store', 'ActionController@store')->name('store');
    
    Route::get('edit/{product}', 'ActionController@edit')->name('edit');
    Route::put('update/{product}', 'ActionController@update')->name('update');
    
    Route::delete('delete/{product}', 'ActionController@delete')->name('delete');

    // Add Product Variants
    Route::get('product/{sku}/subProduct/form/{subProduct?}', 'SubProductController@getForm')->name('get_sub_product_form');

    Route::get('product/{sku}/subProducts/list', 'SubProductController@list')->name('sub_product.list');
    Route::post('product/{sku}/subProduct/save/{subProduct?}', 'SubProductController@store')->name('sub_product.store');
    Route::delete('subProductImage/delete/{subProductImage}', 'SubProductController@deleteSubProductImage')->name('sub_product_image.delete');
    Route::delete('subProduct/delete/{subProduct}', 'SubProductController@deleteSubProduct')->name('sub_product.delete');

    Route::get('variationFormBySize/{sku}/{subProduct?}', 'SubProductController@getVariationSizeColor')->name('sub_product.variation_form_by_size');

    // Supplier
    Route::get('productSupplyment/edit/{productSupplyment}', 'ProductSupplymentController@edit')->name('product_supplyment.edit');
    Route::put('productSupplyment/update/{productSupplyment}', 'ProductSupplymentController@update')->name('product_supplyment.update');    
    Route::get('productSupplyment/create', 'ProductSupplymentController@create')->name('product_supplyment.create');
    Route::post('productSupplyment/store', 'ProductSupplymentController@store')->name('product_supplyment.store');
    Route::delete('productSupplyment/delete/{productSupplyment}', 'ProductSupplymentController@delete')->name('product_supplyment.delete');

    // Product Size and Color
    Route::get('sizeColor/loadSizeColor', 'ActionController@loadSizeColor')->name('size_color.initial_load');
    Route::post('sizeColor/save', 'ActionController@saveSizeColor')->name('size_color.save');
    Route::delete('sizeColor/delete/{productAttr}', 'ActionController@deleteSizeColor')->name('size_color.delete');
});