<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginedController extends Controller
{
    public function login(Request $request)
    {
        // print_r($request->post());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $openId = env('openID');
        $productCode = env('productCode');
        $username = $request->email;
        $password = $request->password;
        $openKey = env('openKey');

        $params = [
            'openId' => $openId,
            'productCode' => $productCode,
            'username' => $username,
            'password' => $password
        ];

        // คำนวณค่า MD5 sign
        $sign = $this->getMd5Sign($params, $openKey);
        $params['sign'] = $sign;



        // API URL
        $url = env('URL_SDK') . "open/userLogin";

        // ส่ง API
        $response = $this->sendPostRequest($url, $params);

        $data = json_decode($response, true);

        if ($data['status'] != 1) {
            return response()->json(['status' => false], 200);
            exit();
        }

        $uid = $data['data']['uid'];
        $token = $data['data']['token'];

        // กำหนดค่าพารามิเตอร์ (ไม่รวม sign)
        $params = [
            'token' => $token,
            'uid' => $uid,

        ];



        // API URL
        $url = env('URL_SDK') . "webapi/checkUserInfo";

        // ส่ง API
        $res = $this->sendPostRequest($url, $params);
        $res = json_decode($res, true);




        if ($res['status'] == 1) {

            Session::put('authenticated', true);


            return redirect()->route('home');
        }

       
    }

    public function logout()
    {
        Session::forget('authenticated');

        return redirect('/login');
    }

    public function save_register (){

        
    }
}
