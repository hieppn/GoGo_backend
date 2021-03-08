<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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
//Route::post('/admin/login',[LoginController::class,'login']);
//Route::get('/admin/me',[LoginController::class,'me']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'admin'

], function ($router) {

    Route::post('login', [LoginController::class,'login']);
    Route::post('register', [LoginController::class,'register']);
    Route::post('refresh', 'AuthController@refresh');
    //Route::get('me', [LoginController::class,'me']);

});