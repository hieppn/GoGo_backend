<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SenderController;
use App\Http\Controllers\TruckerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\SearchHistoryController;
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
//Auth
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [LoginController::class,'register'])->name('auth.register');
Route::post('login', [LoginController::class,'login'])->name('auth.login');
Route::get('profile/{id}', [LoginController::class,'profile']);
Route::delete('logout/{id}', [LoginController::class,'logout']);


Route::get('get-all-message/{userId}', [MessageController::class,'getAllMessageByUserId']);
// Route::get('getMess', [MessageController::class,'index']);
// Route::middleware('auth:api')->group(function () {
//     Route::get('get-user', [PassportAuthController::class, 'userInfo']);
// });

//ORDER 
Route::post('order/create', [OrderController::class,'addNewOrder']);
 Route::get('order/list',[OrderController::class,'getOrder']);
Route::delete('order/delete/{id}',[OrderController::class,'deleteOrder']);
Route::get('order/by/{id}',[OrderController::class,'getOrderByIdUser']);
Route::put('order/updateStatus/{id}',[OrderController::class,'updateStatus']);
Route::get('order/new',[OrderController::class,'getOrderNew']);
Route::post('get-price',[OrderController::class,'getPrice']);
//promotion
Route::get('promotion/list',[PromotionController::class,'getPromotion']);
Route::delete('promotion/delete/{id}',[PromotionController::class,'deletePromotion']);
Route::get('promotion/{id}',[PromotionController::class,'PromotionByID']);
Route::get('promotion/by/{code}',[PromotionController::class,'PromotionByCode']);
Route::post('promotion/create',[PromotionController::class,'PromotionSave']);
Route::PUT('promotion/edit/{id}',[PromotionController::class,'PromotionUpdate']);

//truck
Route::get('truck/list',[TruckController::class,'getAllTruck']);
Route::delete('truck/delete/{id}',[TruckController::class,'deleteTruck']);
Route::get('truck/{id}',[TruckController::class,'getTruckById']);
Route::post('truck/create',[TruckController::class,'createTruck']);
Route::PUT('truck/edit/{id}',[TruckController::class,'updateTruck']);

//User
Route::get('sender/list',[SenderController::class,'getSender']);
Route::get('trucker/list',[TruckerController::class,'getTrucker']);
Route::get('trucker/tempt',[TruckerController::class,'truckerTempt']);
Route::delete('sender/delete/{id}',[SenderController::class,'deleteSender']);
Route::delete('trucker/delete/{id}',[TruckerController::class,'deleteTrucker']);
Route::post('trucker/create',[TruckerController::class,'registerTruckerInfo']);
Route::post('trucker/register/{id}',[TruckerController::class,'acceptTrucker']);
Route::delete('trucker/refuse/{id}',[TruckerController::class,'refuseTrucker']);
Route::put('user/updateImage/{id}',[LoginController::class,'updateImage']);
Route::put('user/update/{id}',[LoginController::class,'updateUser']);
Route::put('user/amount/{id}',[TruckerController::class,'updateAmount']);
//countDashBoard
Route::get('count-user',[DashboardController::class,'countUser']);
Route::get('count-order',[DashboardController::class,'countOrder']);
Route::get('count-sender',[DashboardController::class,'countSender']);
Route::get('count-trucker',[DashboardController::class,'countTrucker']);

//Chart
Route::get('chart',[ChartController::class,'index']);
Route::get('chart/line/user',[ChartController::class,'getLineUser']);
///Notification
Route::get('notification/list',[NotificationController::class,'getNotification']);
Route::get('notification/{id}',[NotificationController::class,'getNotificationById']);
Route::get('notification/count/{id}',[NotificationController::class,'countNotificationById']);
Route::put('notification/read/{id}',[NotificationController::class,'updateNotificationRead']);
Route::put('notification/all-read/{id}',[NotificationController::class,'updateAllNotificationReadByIdUser']);
Route::delete('notification/delete/{id}',[NotificationController::class,'deletenotification']);
Route::post('notification/create',[NotificationController::class,'create']);
//Bill
Route::get('bill/list',[BillController::class,'getAllBill']);
Route::get('bill/by/{id}',[BillController::class,'getBillById']);
Route::get('bill/trucker/{id}',[BillController::class,'getBillByIdTruck']);
Route::get('bill/trucker/complete/{id}',[BillController::class,'getCompleteBillTruck']);
Route::post('bill/location',[BillController::class,'addLocation']);
Route::get('bill/location/{id}',[BillController::class,'getLocationById']);
Route::get('bill/location/list',[BillController::class,'getLocationList']);
Route::get('bill/process',[BillController::class,'getBillProcess']);
//Search History
Route::post('search-history/create',[SearchHistoryController::class,'create']);
Route::get('search-history/by/{id}',[SearchHistoryController::class,'getSearchByIdUser']);
Route::delete('search-history/{id}',[SearchHistoryController::class,'delete']);
