<?php

Route::get('ajax/township', 'GeneralSetup\TownshipController@ajaxSearch')->name('township.ajax_search');