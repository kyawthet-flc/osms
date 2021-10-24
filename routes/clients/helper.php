<?php

Route::get('ajax/township', 'GeneralSetup\TownshipController@ajaxSearch')->name('township.ajax_search');

Route::prefix('document')->name('document.')->namespace('Client\Document')->group(function () {
    Route::get('printOrder/{order}/{type}', 'ActionController@printOrder')->name('order.print');
    Route::get('printDownload/{file}/{type}', 'ActionController@downloadOrder')->name('order.download');
});