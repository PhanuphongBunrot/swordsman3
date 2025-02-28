<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class FacebookController extends Controller
{
    // Redirect to Facebook for authentication
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')
        ->scopes(['email', 'public_profile']) // กำหนดสิทธิ์ที่ต้องการ
        ->redirect();
    }

    // Handle Facebook callback
    public function handleFacebookCallback()
    {
      
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();
            


            $facebookUserArray = [
                'id' => $facebookUser->getId(),
                'name' => $facebookUser->getName(),
                'email' => $facebookUser->getEmail(),
                'avatar' => $facebookUser->getAvatar(),
                'token' => $facebookUser->token,
            ];
    
    
    
            $openId = env('openID');
            $productCode = env('productCode');
            $openType = 6;
            $userOpenId  = $facebookUserArray['id'];
            $access_token = $facebookUserArray['token'];
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
            print_r($response);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
          
      
    }
}
