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

Route::post('add-new-order', [OrderController::class,'addNewOrder']);
Route::post('get-all-orders', [OrderController::class,'getAllOrders']);
Route::get('get-all-message/{id}', [MessageController::class,'getAllMessageById']);
Route::get('getMess', [MessageController::class,'index']);
Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
});
 Route::get('list_order',[Admin::class,'get_Order']);
Route::delete('delete_order/{id}',[Admin::class,'deleteOrder']);

//promotion
Route::get('list_promotion',[Admin::class,'getPromotion']);
Route::delete('delete_promotion/{id}',[Admin::class,'deletePromotion']);
Route::get('promotion/{id}',[Admin::class,'PromotionByID']);
// Route::put('promotion/{id}',[Admin::class,'PromotionByID']);

Route::post('addPromotion',[Admin::class,'PromotionSave']);
 Route::PUT('editPromotion/{id}',[Admin::class,'PromotionUpdate']);


//User
Route::get('list_sender',[Admin::class,'getSender']);
Route::get('list_trucker',[Admin::class,'getTrucker']);
Route::delete('delete_user/{id}',[Admin::class,'deleteUser']);


//countDashBoard
Route::get('count-sender',[Admin::class,'countSender']);
Route::get('count-order',[Admin::class,'countOrder']);
Route::get('count-trucker',[Admin::class,'countTrucker']);
// Route::middleware('auth:api')->group(function () {
//     Route::resource('posts', PostController::class);
// });
