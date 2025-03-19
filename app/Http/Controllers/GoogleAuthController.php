<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Google_Client;
use Exception;
use Illuminate\Support\Facades\Http; // นำเข้า Http Facade


class GoogleAuthController extends Controller
{
    // 1. Redirect ไปยัง Google Login
    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'email', 'profile'])
            ->with(['prompt' => 'consent']) // บังคับให้ขอสิทธิ์ใหม่
            ->redirect();
    }
    // 2. รับ Callback จาก Google
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $response = $googleUser->accessTokenResponseBody;
        $idToken = $response['id_token']; // ID 
        echo "<pre>";
        print_r($googleUser);
        exit();
        // echo "<br>";
        // $googleUserArray = [
        //     'id' => $googleUser->getId(),
        //     'name' => $googleUser->getName(),
        //     'email' => $googleUser->getEmail(),
        //     'avatar' => $googleUser->getAvatar(),
        //     'token' => $googleUser->token,   // Access Token from Google
        // ];

        // // Secret key for signing the JWT
        // $key = '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';

        // // Algorithm used for signing
        // $algorithm = 'HS256';

        // echo "<pre>";
        // print_r($googleUser->token);
        // echo "<br>";
        // // Payload containing the token and other claims
        // $payload = [
        //     'token' => $googleUser->token, // Google access token
        //     'iat' => time(),               // Issued at time
        //     'exp' => time() + 3600,         // Expiration time (1 hour)
        // ];

        // Encode the JWT using the secret key and chosen algorithm
        try {
            $jwt = JWT::encode($payload, $key, $algorithm);



            $openId = env('openID');
            $productCode = env('productCode');
            $openType = 8;
            $userOpenId  = "CREDENTIAL";
            $access_token = $jwt;
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

            $res = json_decode($response, true);
        } catch (Exception $e) {
            echo "Error generating JWT: " . $e->getMessage();
        }
    }

}


