<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\Admin;

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

Route::post('order/create', [OrderController::class,'addNewOrder']);
// Route::get('get-all-message/{id}', [MessageController::class,'getAllMessageById']);
// Route::get('getMess', [MessageController::class,'index']);
// Route::middleware('auth:api')->group(function () {
//     Route::get('get-user', [PassportAuthController::class, 'userInfo']);
// });
 Route::get('order/list',[Admin::class,'get_Order']);
Route::delete('order/delete/{id}',[Admin::class,'deleteOrder']);

//promotion
Route::get('promotion/list',[Admin::class,'getPromotion']);
Route::delete('promotion/delete/{id}',[Admin::class,'deletePromotion']);
Route::get('promotion/{id}',[Admin::class,'PromotionByID']);

Route::post('promotion/create',[Admin::class,'PromotionSave']);
 Route::PUT('promotion/edit/{id}',[Admin::class,'PromotionUpdate']);


//User
Route::get('sender/list',[Admin::class,'getSender']);
Route::get('trucker/list',[Admin::class,'getTrucker']);
Route::delete('user/delete/{id}',[Admin::class,'deleteUser']);
Route::post('trucker/create',[Admin::class,'registerTruckerInfo']);


//countDashBoard

Route::get('count-order',[Admin::class,'countOrder']);
Route::get('count-sender',[Admin::class,'countSender']);
Route::get('count-trucker',[Admin::class,'countTrucker']);
Route::get('order/by/{id}',[OrderController::class,'getOrderByIdUser']);