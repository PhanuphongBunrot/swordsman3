<?php

namespace App\Http\Controllers;


class ApisdkController extends Controller
{
    public function user_register()
    {

     
        $openId = env('openID');
        $productCode = env('productCode');
        $username = "SenNesTest@gmail.com";
        $password = "123456789";
        $openKey = env('openKey');

        // กำหนดค่าพารามิเตอร์ (ไม่รวม sign)
        $params = [
            'openId' => $openId,
            'productCode' => $productCode,
            'username' => $username,
            'password' => $password
        ];

        // คำนวณค่า MD5 sign
        $sign = $this->getMd5Sign($params, $openKey);
        $params['sign'] = $sign;

        // แสดงค่าที่ใช้ส่งไปยัง API
        
        // API URL
        $url  = env('URL_SDK')."open/userRegister";

        // ส่ง API
        $response = $this->sendPostRequest($url, $params);
        echo  $response;
    }






    public function user_login()
    {

        $openId = env('openID');
        $productCode = env('productCode');
        $username = "SenNesTest@gmail.com";
        $password = "123456789";
        $openKey = env('openKey');

        // กำหนดค่าพารามิเตอร์ (ไม่รวม sign)
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
        $url = env('URL_SDK')."open/userLogin";

        // ส่ง API
        $response = $this->sendPostRequest($url, $params);
        echo   $response;
    }



     public function   check_user_info (){

        

     

     $uid = "16588783";
     $token = "@131@209@218@148@151@152@214@185@131@176@145@168@98@209@138@116@166@121@121@204@160@185@172@167@167@175@95@127@153@168@168@158@175@187@173@149@173@149@190@163@164@113@110@185@125@169@131@119@158@98@173@185@99@186@107@127@169@168@152@128@174@127@130@147@146@186@191@154@166@159@179@148@98@112@125@215@168@156@163@123@152@173@128@148@161@191@154@104@171@107@166@132@103@137@128@116@172@217@209@149@211@155@149@178@108@109@141@160";

       // กำหนดค่าพารามิเตอร์ (ไม่รวม sign)
       $params = [
        'token' => $token,
        'uid' => $uid,
       
    ];

  

    // API URL
    $url = env('URL_SDK')."webapi/checkUserInfo";

    // ส่ง API
    $response = $this->sendPostRequest($url, $params);

    echo   $response;


     }



    

    public function getMd5Sign($params_in, $openKey)
    {
        $params = $params_in;
      
        ksort($params);
        $signKey = '';
        foreach($params as $key => $val){
        $signKey .= $key.'='.$val.'&';
        }
        $signKey .= $openKey;
        return md5($signKey);
    }

    private function sendPostRequest($url, $params)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, '', '&', PHP_QUERY_RFC3986));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
