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

Route::get('highscores', 'HighscoreController@index');
Route::get('highscores/notApproved', 'HighscoreController@notApproved')->middleware('auth:api');
Route::get('highscores/{highscore}', 'HighscoreController@show');
Route::post('highscores', 'HighscoreController@store');
Route::put('highscores/{highscore}', 'HighscoreController@update')->middleware('auth:api');;
Route::delete('highscores/{highscore}', 'HighscoreController@delete')->middleware('auth:api');;


