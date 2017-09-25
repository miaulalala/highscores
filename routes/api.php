<?php

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::get('highscores', 'HighscoreController@index');


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('highscores/notApproved', 'HighscoreController@notApproved');
    Route::put('highscores/{highscore}', 'HighscoreController@update');
    Route::delete('highscores/{highscore}', 'HighscoreController@delete');
});

Route::get('highscores/{highscore}', 'HighscoreController@show');
Route::post('highscores', 'HighscoreController@store');
