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
        // Get server session id
        Route::get ('/get-customized-session-id/{id}', 'WeChatController@fetchSessionId')->name('fetchSessionId');

        // Store family data
        Route::get ('/check-in-family/{id?}', 'WeChatController@checkInFamilyData')->name('checkInFam');

        // Get all associated cards
        Route::get ('/get-{type}-cards', function ($type) {
            $cardsJson = (new \App\Modules\Babyfun\Models\Card)->fetchCardsWithType($type);
            $cards = json_decode($cardsJson[$type],  true);
            
            return $cards;
        });
        
        // Get specific card by type and slug
        Route::get ('/get-{type}-cards/{slug}', function ($type, $slug) {
            $cards = (new \App\Modules\Babyfun\Models\Card)->fetchCardsWithTypeDetail($type, $slug);

            return $cards;
        });
    });
});