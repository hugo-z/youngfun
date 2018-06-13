<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/wishplan', function (Request $request) {
    // return $request->wishplan();
})->middleware('auth:api');

Route::group(['prefix' => 'wishplan'], function () {
    Route::get('/voice-record/{id?}', 'ApiController@voiceRecord')->name('api-vrecord');
    Route::get('/note-record/{id?}', 'ApiController@vnoteRecord')->name('api-nrecord');
    Route::get('/add-tags', 'ApiController@addTags')->name('api-addtags');
    Route::get('/get-tags/{id?}', 'ApiController@getAllWishTags')->name('api-getwishtags');
});