<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApisdkController;
use App\Http\Controllers\LoginedController;
use App\Http\Controllers\GoogleAuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FacebookController;
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



Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::post('/login_check', [LoginedController::class, 'login'])->name('login_check');
Route::post('/logout', [LoginedController::class, 'logout'])->name('logout');


Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
Route::controller(ApisdkController::class)->group(function () {
    Route::get('/userregister', 'user_register');
    Route::get('/userlogin', 'user_login');
    Route::get('/checkuserinfo', 'check_user_info');
    Route::get('/queryOrderList', 'queryOrderList');
    Route::get('/sendCodeByEmail', 'sendCodeByEmail');
});



Route::middleware('checkuser')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    
});