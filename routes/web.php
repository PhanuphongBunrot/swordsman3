<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApisdkController;
use App\Http\Controllers\LoginedController;
use App\Http\Controllers\GoogleAuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\AppleAuthController;

use App\Http\Controllers\PhoneOtpController;
use App\Http\Controllers\MailOtpController;


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


Route::get('/register', function () {
    return view('login.register');
});


Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::post('/login_check', [LoginedController::class, 'login'])->name('login_check');
Route::post('/logout', [LoginedController::class, 'logout'])->name('logout');




Route::post('/register', [LoginedController::class, 'registerUser']);



Route::get('/forgot-password', function () {
    return view('login.forget-password');
})->name('password.reset');


Route::post('/reset-password', [LoginedController::class, 'resetPassword'])->name('reset.password');


Route::get('/check-user-phone', [PhoneOtpController::class, 'checkUserPhone']);
Route::post('/save-user-phone', [PhoneOtpController::class, 'saveUserPhone']);


Route::post('/send-mail-otp', [MailOtpController::class, 'sendMailOtp']);
Route::post('/verify-mail-otp', [MailOtpController::class, 'verifyMailOtp']);


Route::get('/delete-policy', function () {
    return view('user.delete-policy'); 
});


Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::get('/auth/apple', [AppleAuthController::class, 'redirectToApple']);
Route::get('/auth/apple/callback', [AppleAuthController::class, 'handleAppleCallback']);

Route::controller(ApisdkController::class)->group(function () {
    Route::get('/userregister', 'user_register');
    Route::get('/userlogin', 'user_login');
    Route::get('/checkuserinfo', 'check_user_info');
    Route::get('/queryOrderList', 'queryOrderList');
    Route::get('/sendCodeByEmail', 'sendCodeByEmail');
    Route::get('/payToUser', 'payToUser');
    Route::get('/walletInfo', 'walletInfo');
    Route::get('/test_api', 'test_api');
    Route::get('/startPay', 'startPay');
    Route::get('/setNewPass', 'setNewPass');
    
  
    
});

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');




Route::get('/', function () {
    return view('home');
});


Route::middleware('checkuser')->group(function () {

Route::get('/user', function () {
    return view('user.index');
})->name('user');;

});
