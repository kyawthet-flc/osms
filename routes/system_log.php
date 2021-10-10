<?php

use Illuminate\Support\Facades\Route;

Route::prefix('systemLog')->name('system_log.')->middleware(['auth'])->group(function () {    
    Route::get('mail', 'SystemLog\MailLogController@index')->name('mail.index');
    Route::get('application', 'SystemLog\ApplicationLogController@index')->name('application.index');
    Route::get('loginout', 'SystemLog\LoginoutLogController@index')->name('loginout.index');
});