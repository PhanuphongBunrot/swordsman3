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
use Illuminate\Http\Request;


class GoogleAuthController extends Controller
{
    // // 1. Redirect ไปยัง Google Login
    // public function redirect()
    // {
    //     return Socialite::driver('google')
    //         ->scopes(['openid', 'email', 'profile'])
    //         ->with(['prompt' => 'consent']) // บังคับให้ขอสิทธิ์ใหม่
    //         ->redirect();
    // }
    // // 2. รับ Callback จาก Google
    // public function callback()
    // {
    //     $googleUser = Socialite::driver('google')->user();
    //     $response = $googleUser->accessTokenResponseBody;
    //     $idToken = $response['id_token']; // ID 
    //     echo "<pre>";
    //     print_r($googleUser);
    //     exit();
    //     // echo "<br>";
    //     // $googleUserArray = [
    //     //     'id' => $googleUser->getId(),
    //     //     'name' => $googleUser->getName(),
    //     //     'email' => $googleUser->getEmail(),
    //     //     'avatar' => $googleUser->getAvatar(),
    //     //     'token' => $googleUser->token,   // Access Token from Google
    //     // ];

    //     // // Secret key for signing the JWT
    //     // $key = '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';

    //     // // Algorithm used for signing
    //     // $algorithm = 'HS256';

    //     // echo "<pre>";
    //     // print_r($googleUser->token);
    //     // echo "<br>";
    //     // // Payload containing the token and other claims
    //     // $payload = [
    //     //     'token' => $googleUser->token, // Google access token
    //     //     'iat' => time(),               // Issued at time
    //     //     'exp' => time() + 3600,         // Expiration time (1 hour)
    //     // ];

    //     // Encode the JWT using the secret key and chosen algorithm
    //     try {
    //         $jwt = JWT::encode($payload, $key, $algorithm);



    //         $openId = env('openID');
    //         $productCode = env('productCode');
    //         $openType = 8;
    //         $userOpenId  = "CREDENTIAL";
    //         $access_token = $jwt;
    //         $openKey = env('openKey');

    //         $params = [
    //             'openId' => $openId,
    //             'productCode' => $productCode,
    //             'openType' => $openType,
    //             'userOpenId' => $userOpenId,
    //             'access_token' => $access_token
    //         ];

    //         // คำนวณค่า MD5 sign
    //         $sign = $this->getMd5Sign($params, $openKey);
    //         $params['sign'] = $sign;


    //         print_r($params);
    //         // API URL
    //         $url = env('URL_SDK') . "open/snsLogin";

    //         // ส่ง API
    //         $response = $this->sendPostRequest($url, $params);

    //         print_r($response);

    //         $res = json_decode($response, true);
    //     } catch (Exception $e) {
    //         echo "Error generating JWT: " . $e->getMessage();
    //     }
    // }


    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'email', 'profile'])
            ->with([
                'prompt' => 'consent',
                'access_type' => 'offline',
            ])
            ->redirect();
    }

    public function callback(Request $request)
    {
        echo "<pre>";

        $code = $request->query('code');

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'), // ต้องตรงกับที่ตั้งค่าไว้ใน Google Console
            'code' => $code,
            'grant_type' => 'authorization_code',
        ]);
        
        $data = $response->json();
        
        if (!isset($data['access_token']) || !isset($data['id_token'])) {
            return response()->json(['error' => 'Invalid response from Google'], 400);
        }
        
        // ดึงข้อมูลผู้ใช้จาก Google โดยใช้ Socialite
        $googleUser = Socialite::driver('google')->userFromToken($data['access_token']);
        print_r($googleUser);
        $googleUserArray = [
            'id' => $googleUser->getId(), // Google ID ของผู้ใช้
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'token' => $data['access_token'],  // Access Token
            'id_token' => $data['id_token'],   // ID Token
        ];
        
        
        $openId = env('openID');
        $productCode = env('productCode');
        $openType = 8;
        $userOpenId  = "CREDENTIAL";
        $access_token = $googleUserArray['id_token'];
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



        $res = json_decode($response, true);

       print_r($res);
    }
}
