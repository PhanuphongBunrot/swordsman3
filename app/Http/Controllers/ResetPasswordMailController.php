<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class ResetPasswordMailController extends Controller
{

    public function  sendCodeResetPass(Request $request){

       
       
        $openId = env('openID');
        $productCode = env('productCode');
        $email = $request->input('email'); 
        $sendType  = 4;
        $openKey = env('openKey');

        $params = [
            'openId' => $openId,
            'productCode' => $productCode,
            'email' => $email,
            'sendType' => $sendType
           
        ];

        // คำนวณค่า MD5 sign
        $sign = $this->getMd5Sign($params, $openKey);
        $params['sign'] = $sign;

      
       
        // API URL
        $url = env('URL_SDK')."open/sendCodeByEmail";

        // ส่ง API
        $response = $this->sendPostRequest($url, $params);

        return $response;
        // if($response)
        // return response()->json([
        //     'status' => false,
        //     'message' => 'เกิดข้อผิดพลาดระหว่างเปลี่ยนรหัสผ่าน',
            
        // ], 200);

    }
}