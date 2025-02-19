<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApisdkController;
use App\Http\Controllers\LoginedController;

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

Route::get('/login', function () {
    return view('login.login');
});

Route::post('/login_check', [LoginedController::class, 'login'])->name('login_check');
Route::post('/logout', [LoginedController::class, 'logout'])->name('logout');

Route::controller(ApisdkController::class)->group(function () {
    Route::get('/userregister', 'user_register');
    Route::get('/userlogin', 'user_login');
    Route::get('/checkuserinfo', 'check_user_info');
});

Route::middleware('checkuser')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});