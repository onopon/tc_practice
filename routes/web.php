<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

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

Route::get('/', [UserController::class, 'mypage'])->middleware('auth');
Route::get('/user/login', [UserController::class, 'login'])->name('login');
Route::post('/user/login', [LoginController::class, 'attempt']);
Route::post('/user/logout', [LogoutController::class, 'attempt']);
