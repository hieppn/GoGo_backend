<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('Admin/Login');
// });
// Route::post('/admin/login',[LoginController::class,'login']);
Route::get('/', function () {
    return view('Admin\trangchu');
});
Route::get('/', [ChartController::class, 'index']);

Route::get('OrderManagement',[Admin::class, 'getOrder']);