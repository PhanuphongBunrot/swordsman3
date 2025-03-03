<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AppleAuthController extends Controller
{
    // Redirect ไปที่ Apple OAuth
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    // Callback จาก Apple
    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();

            print_r($appleUser);
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'ไม่สามารถเข้าสู่ระบบด้วย Apple ได้');
        }
    }
}
