<?php

Route::prefix('/item')->name('item.')->group(function () {
    // ITEM LIST
    Route::get('/', 'ItemController@index')->name('index');
    // SHOW ITEM
    Route::get('/{id}', 'ItemController@show')->name('show');
    // CREATE ITEM
    Route::post('/', 'ItemController@store')->name('store');
    // UPDATE ITEM
    Route::put('/{id}', 'ItemController@update')->name('update');
    // DELETE ITEM
    Route::delete('/{id}', 'ItemController@delete')->name('archive');
    // RESTORE ITEM
    Route::get('/restore/{id}', 'ItemController@restore')->name('restore');

});

