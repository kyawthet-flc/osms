<?php

use Illuminate\Support\Facades\Route;

Route::prefix('generalSetup')->name('general_setup.')->middleware(['auth'])->group(function () {

    Route::resource('applicationModules', 'GeneralSetup\ApplicationModuleController');

    Route::resource('fees', 'GeneralSetup\FeeController');
    Route::resource('documents', 'GeneralSetup\DocumentController');

    Route::resource('countries', 'GeneralSetup\CountryController');
    Route::resource('divisions', 'GeneralSetup\DivisionController');
    Route::resource('districts', 'GeneralSetup\DistrictController');
    Route::resource('townships', 'GeneralSetup\TownshipController');
    Route::resource('onetimePurposes', 'GeneralSetup\OnetimePurposeController');

    Route::resource('applicationPeriodics', 'GeneralSetup\AppPeriodicController');
    Route::resource('periods', 'GeneralSetup\PeriodController');
    Route::resource('handoverTasks', 'GeneralSetup\HandoverTaskController');
    Route::resource('banks', 'GeneralSetup\BankController');

    Route::resource('dlmcDosageForms', 'GeneralSetup\DlmcDosageFormController');
    Route::get('action/create/childDlmcDosageForms/{dlmcDosageForm}', 'GeneralSetup\DlmcDosageFormController@createChildDlmcDosageForm')->name('childDlmcDosageForms.create');
    Route::post('action/store/childDlmcDosageForms/{dlmcDosageForm}', 'GeneralSetup\DlmcDosageFormController@storeChildDlmcDosageForm')->name('childDlmcDosageForms.store');
    Route::get('action/edit/childDlmcDosageForms/{dlmcDosageForm}', 'GeneralSetup\DlmcDosageFormController@editChildDlmcDosageForm')->name('childDlmcDosageForms.edit');
    Route::post('action/update/childDlmcDosageForms/{dlmcDosageForm}', 'GeneralSetup\DlmcDosageFormController@updateChildDlmcDosageForm')->name('childDlmcDosageForms.update');
    Route::delete('action/destroy/childDlmcDosageForms/{dlmcDosageForm}', 'GeneralSetup\DlmcDosageFormController@destroyChildDlmcDosageForm')->name('childDlmcDosageForms.destroy');


});