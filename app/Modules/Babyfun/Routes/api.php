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

Route::get('/babyfun', function (Request $request) {
    // return $request->babyfun();
})->middleware('auth:api');

Route::group (['prefix' => 'babyfun'], function () {
    Route::get ('/youdao/speak/{id}', 'YoudaoController@getPronunciation')->name('pronunciation');

    Route::group (['prefix' => 'wechat'], function () {
        Route::get ('/get-customized-session-id/{id}', 'WeChatController@fetchSessionId')->name('fetchSessionId');
    });
});