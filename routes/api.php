<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('playindex', 'Api\PlayIndexController@show');

Route::get('playproduct', 'Api\PlayProductController@index');
Route::get('playproduct/{id}', 'Api\PlayProductController@show');
Route::get('search', 'Api\PlayProductSearchController@show');
