<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('login');
});
Route::get('login', [LoginController::class,'login']);
Route::get('register', [LoginController::class,'register']);
Route::post('create', [LoginController::class,'create'])->name('auth.create');
Route::post('check', [LoginController::class,'check'])->name('auth.check');
Route::get('profile', [LoginController::class,'profile']);
Route::get('logout', [LoginController::class,'logout']);