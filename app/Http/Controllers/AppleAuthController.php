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
    
    public function handleAppleCallback()
    {
        $user = Socialite::driver('apple')->user();
    
        dd($user); // ตรวจสอบข้อมูลที่ได้รับจาก Apple
    }
}

