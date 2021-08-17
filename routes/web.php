<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

// admin
Route::get('/admin/index', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/profile/{user_id}', [App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile');
Route::get('/admin/destroy/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/setting', [App\Http\Controllers\AdminController::class, 'setting'])->name('admin.setting');
Route::post('/admin/setting/update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.setting.update');
Route::get('/admin/slamss', [App\Http\Controllers\Auth\SlamController::class, 'user'])->name('admin.slamss');
Route::post('/admin/bonus', [App\Http\Controllers\AdminController::class, 'bonus'])->name('admin.bonus');

Route::post('/admin/memo/save', [App\Http\Controllers\AdminController::class, 'memo_save'])->name('admin.memo');
Route::post('/admin/password/save', [App\Http\Controllers\AdminController::class, 'password_update'])->name('admin.password_update');

Route::get('/admin/forceswap/{user_id}', [App\Http\Controllers\AdminController::class, 'forceswap'])->name('admin.forceswap');
Route::get('/admin/retrieve/{user_id}', [App\Http\Controllers\AdminController::class, 'retrieve'])->name('admin.retrieve');

