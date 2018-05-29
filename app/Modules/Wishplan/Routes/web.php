<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'wishplan'], function () {
    Route::get('/', function () {
        dd('This is the Wishplan module index page. Build something great!');
    });

    // Route::group(['prefix' => 'api'], function () {
    //     Route::get('/voice-record/{id?}', 'ApiController@voiceRecord')->name('api-vrecord');
    //     Route::get('/note-record/{id?}', 'ApiController@vnoteRecord')->name('api-nrecord');
    //     Route::get('/add-tags', 'ApiController@addTags')->name('api-addtags');
    //     Route::get('/get-tags/{id?}', 'ApiController@getAllWishTags')->name('api-getwishtags');
    // });
});
