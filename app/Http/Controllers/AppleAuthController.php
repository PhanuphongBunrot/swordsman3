<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class AppleAuthController extends Controller
{
    // Redirect ไปที่ Apple OAuth
    public function redirectToApple()
    {
        $parameters = [
            'state' => bin2hex(random_bytes(16)),
            'nonce' => bin2hex(random_bytes(12))
        ];

        return Socialite::driver('apple')->with($parameters)->redirect();
    }

    public function handleAppleCallback()
    {
        $apple = Socialite::driver('apple')->stateless()->user();

      
        
          $appleArray = [
                'id' => $apple->getId(),
                'name' => $apple->getName(),
                'email' => $apple->getEmail(),
                'avatar' => $apple->getAvatar(),
                'token' => $apple->token,
            ];
    
    
    
            $openId = env('openID');
            $productCode = env('productCode');
            $openType = 16;
            $userOpenId  = $appleArray['id'];
            $access_token = $appleArray['token'];
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
    
           
    
            // API URL
            $url = env('URL_SDK') . "open/snsLogin";
    
            // ส่ง API
            $response = $this->sendPostRequest($url, $params);
          

          
        $res = json_decode($response, true);
        
         

           
          

        if ($res['status'] == 1) {

            Session::put('authenticated', true);
            Session::put('username', $res['data']['username']);

            return redirect()->route('user');
        }
    }
}