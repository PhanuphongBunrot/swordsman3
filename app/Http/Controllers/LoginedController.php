<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;

use Google\Service\Texttospeech\Turn;
use Illuminate\Support\Facades\Session;

/*ส่วนของลงทะเบียน */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            // return response()->json(['status' => false], 200);
            // 🛑 ถ้า Login ไม่ผ่าน ส่ง error กลับไปแสดงผล
            if (!isset($data['status']) || $data['status'] != 1) {
                return back()->withErrors(['login_error' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
            }

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

        $amount =  $this->get_poin_sdk($uid);




        if ($res['status'] == 1) {

            Session::put('authenticated', true);
            Session::put('username', $data['data']['username']);
            Session::put('amount', $amount);
            Session::put('uid', $uid);
            return redirect()->route('user');
        }
    }



    public function logout()
    {
        session()->flush();

        return redirect('/');
    }



    /*ยิงลงทะเบียนสมัครสมาชิก */

    public function registerUser(Request $request)
    {
        try {
            // ✅ ตรวจสอบว่า OTP ได้รับการยืนยันหรือไม่

            if (!$request->has('otp_verified') || $request->otp_verified !== "true") {
                session()->flash('register-error', '❌ กรุณายืนยัน OTP ก่อนลงทะเบียน!');
                return redirect('/register');
            }

            // รับข้อมูลจากฟอร์ม
            $email = $request->email;
            $password = Hash::make($request->password); // เข้ารหัสรหัสผ่าน
            $openId = env('openID');
            $productCode = env('productCode');
            $openKey = env('openKey');

            // ส่งข้อมูลไปยัง SDK
            $params = [
                'openId' => $openId,
                'productCode' => $productCode,
                'username' => $email,
                'password' => $request->password,
            ];
            $sign = $this->getMd5Sign($params, $openKey);
            $params['sign'] = $sign;

            $url = env('URL_SDK') . "open/userRegister";
            $response = json_decode($this->sendPostRequest($url, $params), true);

            // ถ้า SDK แจ้งว่า user มีอยู่แล้ว
            if (isset($response['message']) && $response['message'] === "The user already exists.") {
                session()->flash('user-dup-error', '❌ อีเมลนี้เคยลงทะเบียนแล้ว!');
                return redirect('/register');
            }

            // ตรวจสอบสถานะจาก SDK
            if (!$response || !isset($response['status']) || $response['status'] != 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'SDK Registration Failed',
                    'error' => $response
                ], 400);
            }

            $uid = $response['data']['uid']; // ดึง UID จาก SDK

            // บันทึกลงฐานข้อมูล
            DB::table('users')->insert([
                'email' => $email,
                'password' => $password,
                'uid' => $uid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            session()->flash('register-success', '🎉 ลงทะเบียนสำเร็จ!');

            return redirect('/');
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    //     public function registerUser(Request $request){
    //     try {


    //         // รับข้อมูลจากฟอร์ม
    //         $email = $request->email;
    //         $password = Hash::make($request->password); // เข้ารหัสรหัสผ่าน
    //         $openId = env('openID');
    //         $productCode = env('productCode');
    //         $openKey = env('openKey');

    //         // ส่งข้อมูลไปยัง SDK
    //         $params = [
    //             'openId' => $openId,
    //             'productCode' => $productCode,
    //             'username' => $email,
    //             'password' => $request->password,
    //         ];
    //         $sign = $this->getMd5Sign($params, $openKey);
    //         $params['sign'] = $sign;

    //         $url = env('URL_SDK') . "open/userRegister";
    //         $response = json_decode($this->sendPostRequest($url, $params), true);

    //         // ถ้า SDK แจ้งว่า user มีอยู่แล้ว
    //         if (isset($response['message']) && $response['message'] === "The user already exists.") {
    //             session()->flash('user-dup-error', '❌ อีเมลนี้เคยลงทะเบียนแล้ว!');
    //             return redirect('/register');
    //         }

    //         if (!$response || !isset($response['status']) || $response['status'] != 1) {
    //             return response()->json(['status' => false, 'message' => 'SDK Registration Failed', 'error' => $response], 400);
    //         }

    //         $uid = $response['data']['uid']; // ดึง UID จาก SDK

    //         // บันทึกลงฐานข้อมูล
    //         DB::table('users')->insert([
    //             'email' => $email,
    //             'password' => $password,
    //             'uid' => $uid,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);


    //         session()->flash('register-success', '🎉 ลงทะเบียนสำเร็จ!');

    //         return redirect('/');
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
    //     }
    // }



    public function resetPassword(Request $request)
    {
        try {
            //  ตรวจสอบว่าใช้ POST จริงไหม
            if (!$request->isMethod('post')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Method not allowed. Please use POST.'
                ], 405);
            }

            // ตรวจสอบอีเมล
            $email = $request->email;
            $newPassword = Hash::make($request->password);

            $otp =   $request->otp;
            $openId = env('openID');
            $productCode = env('productCode');


            $openKey = env('openKey');

            $params = [
                'openId' => $openId,
                'productCode' => $productCode,
                'email' => $email,
                'code' => $otp,
                'newPassword' => $request->password

            ];

            // คำนวณค่า MD5 sign
            $sign = $this->getMd5Sign($params, $openKey);
            $params['sign'] = $sign;



            // API URL
            $url = env('URL_SDK') . "open/setNewPass";

            // ส่ง API
            $response = $this->sendPostRequest($url, $params);
            $response = json_decode($response,true);
            // print_r($response);
            if ($response) {
                
               if(!$response['status']){
                return response()->json([
                    'status' => false,
                    'message' => $response['message']
                ], 200);
               }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => '❌ มีบางอย่างผิดพลาด'
                ], 200);
            }

            // //  ค้นหา User
            $user = DB::table('users')->where('email', $email)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => '❌ ไม่พบอีเมลนี้ในระบบ!'
                ], 404);
            }

            //  อัปเดตรหัสผ่าน
            DB::table('users')->where('email', $email)->update([
                'password' => $newPassword,
                'updated_at' => now(),
            ]);

            // //  ส่ง JSON กลับ
            return response()->json([
                'status' => true,
                'message' => '✅ เปลี่ยนรหัสผ่านสำเร็จ!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'เกิดข้อผิดพลาดระหว่างเปลี่ยนรหัสผ่าน',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
