<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleAuthController extends Controller
{
    // 1. Redirect ไปยัง Google Login
    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes(['email', 'profile']) 
            ->redirect();
    }

    // 2. รับ Callback จาก Google
    public function callback()
    {

        $googleUser = Socialite::driver('google')->user();
        
        
        $googleUserArray = [
            'id' => $googleUser->getId(),
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'token' => $googleUser->token,
        ];



        $openId = env('openID');
        $productCode = env('productCode');
        $openType = 8;
        $userOpenId  = "CREDENTIAL";
        $access_token = $googleUserArray['token'];
        $openKey = env('openKey');

        $params = [
            'openId' => $openId,
            'productCode' => $productCode,
            'openType' => $openType,
            'userOpenId' => $userOpenId,
            'access_token' => $access_token
        ];

        // คำนวณค่า MD5 sign
        $sign = $this->getMd5Sign($params, $openKey);
        $params['sign'] = $sign;

        print_r($params);

        // API URL
        $url = env('URL_SDK') . "open/snsLogin";

        // ส่ง API
        $response = $this->sendPostRequest($url, $params);
        print_r($response);
        
        // $data = json_decode($response, true);
        // echo "<pre>";
       
        // // ถ้าไม่มีให้สร้างใหม่
        // if (!$user) {
        //     $user = User::create([
        //         'name' => $googleUser->getName(),
        //         'email' => $googleUser->getEmail(),
        //         'google_id' => $googleUser->getId(),
        //         'password' => bcrypt('google_auth'), // ตั้งค่าให้ปลอดภัย
        //     ]);
        // }

        // // เข้าสู่ระบบผู้ใช้
        // Auth::login($user);
        // Session::put('authenticated', true);

        // return redirect('/');



        // return redirect()->route('home');
    }
}
