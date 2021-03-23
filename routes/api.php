<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Order\OrderController;
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
Route::post('register', [LoginController::class,'register'])->name('auth.register');
Route::post('login', [LoginController::class,'login'])->name('auth.login');
Route::get('profile/{id}', [LoginController::class,'profile']);
Route::get('logout', [LoginController::class,'logout']);

Route::get('get-all-order', [OrderController::class,'getAllOrder']);
Route::post('add-new-order',[OrderController::class,'addNewOrder']);
