<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getMd5Sign($params_in, $openKey)
    {
        $params = $params_in;

        ksort($params);
        $signKey = '';
        foreach ($params as $key => $val) {
            $signKey .= $key . '=' . $val . '&';
        }
        $signKey .= $openKey;
        return md5($signKey);
    }

    public function sendPostRequest($url, $params)
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


    public function sendPostRequestv2($url, $params)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, '', '&', PHP_QUERY_RFC1738));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function  get_poin_sdk($uid)
    {

        $openId = env('openID');
        $productCode = env('productCode');
        $userId = $uid;
        $openKey = env('openKey');



        $params = [
            'openId' => $openId,
            'productCode' => $productCode,
            'userId' => $userId,

        ];

        // คำนวณค่า MD5 sign
        $sign = $this->getMd5Sign($params, $openKey);
        $params['sign'] = $sign;



        // API URL
        $url = env('URL_SDK') . "open/walletInfo";

        // ส่ง API
        $response = $this->sendPostRequest($url, $params);
        $res = json_decode($response, true);


        return $res['data']['amount'];
    }
}
