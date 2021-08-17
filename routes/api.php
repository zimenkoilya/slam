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

Route::post('/signup', [App\Http\Controllers\RegisterController::class, 'signup']);
Route::post('/signin', [App\Http\Controllers\RegisterController::class, 'signin']);
Route::post('/forget', [App\Http\Controllers\RegisterController::class, 'forget']);
Route::post('/token', [App\Http\Controllers\RegisterController::class, 'token']);

Route::post('/eth_slam', [App\Http\Controllers\RegisterController::class, 'eth_slam']);
Route::post('/bnb_slam', [App\Http\Controllers\RegisterController::class, 'bnb_slam']);
