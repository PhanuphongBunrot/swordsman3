<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class MailOtpController extends Controller
{
//     public function sendMailOtp(Request $request)
// {
//     // ✅ รับค่าจาก Frontend
//     $email = $request->input('recipient_email');

//     // ✅ ดึงค่า API Key และ Secret จาก .env
//     $templateUuid = env('THAIBULKSMS_TEMPLATE_UUID');
//     $apiKey = env('THAIBULKSMS_API_KEY');
//     $apiSecret = env('THAIBULKSMS_API_SECRET');

//     // ✅ Debug Log เพื่อตรวจสอบค่าที่รับมา
//     Log::info("📨 Request OTP for:", ['email' => $email, 'template_uuid' => $templateUuid]);

//     // ✅ ตรวจสอบค่าอีเมล
//     if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         return response()->json(['error' => 'อีเมลไม่ถูกต้อง'], 400);
//     }

//     // ✅ ตรวจสอบว่า Template UUID มีค่าไหม
//     if (!$templateUuid) {
//         return response()->json(['error' => 'Template UUID ไม่ถูกต้อง'], 400);
//     }

//     // ✅ ตั้งค่าข้อมูลที่จะส่งไปยัง API
//     $postData = json_encode([
//         'template_uuid' => $templateUuid,
//         'recipient_email' => $email,
//         'payload' => new \stdClass() // ✅ ต้องใส่ `payload` เป็น object เปล่า
//     ]);

//     // ✅ ตั้งค่า cURL
//     $curl = curl_init();
//     curl_setopt_array($curl, [
//         CURLOPT_URL => "https://email-api.thaibulksms.com/email/v1/otp/send",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_CUSTOMREQUEST => "POST",
//         CURLOPT_POSTFIELDS => $postData,
//         CURLOPT_HTTPHEADER => [
//             "accept: application/json",
//             "authorization: Basic " . base64_encode("$apiKey:$apiSecret"), // ✅ แก้ไขการเข้ารหัส Basic Auth
//             "content-type: application/json"
//         ],
//     ]);

//     // ✅ ส่งคำขอไป API
//     $response = curl_exec($curl);
//     $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//     $error = curl_error($curl);
//     curl_close($curl);

//     // ✅ Debug เช็ค Response ที่ได้รับ
//     Log::info("📩 API Response:", ['response' => $response]);

//     // ✅ แปลง JSON Response
//     $responseData = json_decode($response, true);
//     // print_r($responseData);

//    if($responseData){
//        return response()->json(['success' => 'OTP ถูกส่งไปยังอีเมลแล้ว']);
//    }else{
//        return response()->json(['error' => 'ไม่สามารถส่ง OTP ไปยังอีเมลได้']);
//     }
// }

public function sendMailOtp(Request $request)
{
    $email = $request->input('recipient_email');
    $templateUuid = env('THAIBULKSMS_TEMPLATE_UUID');
    $apiKey = env('THAIBULKSMS_API_KEY');
    $apiSecret = env('THAIBULKSMS_API_SECRET');

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return response()->json(['error' => 'อีเมลไม่ถูกต้อง'], 400);
    }

    if (!$templateUuid) {
        return response()->json(['error' => 'Template UUID ไม่ถูกต้อง'], 400);
    }

    $postData = json_encode([
        'template_uuid' => $templateUuid,
        'recipient_email' => $email,
        'payload' => new \stdClass()
    ]);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://email-api.thaibulksms.com/email/v1/otp/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Basic " . base64_encode("$apiKey:$apiSecret"),
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $error = curl_error($curl);
    curl_close($curl);

    $responseData = json_decode($response, true);

    Log::info("📩 API Response:", ['response' => $response]);

    if ($httpCode === 200 && isset($responseData['details']['token'])) {
        return response()->json([
            'success' => 'OTP ถูกส่งไปยังอีเมลแล้ว',
            'token' => $responseData['details']['token'] 
        ]);
    } else {
        return response()->json([
            'error' => 'รอotp',
            'details' => $responseData
        ], $httpCode);
    }
}




  public function verifyMailOtp(Request $request)
{
    $otpCode = $request->input('otp_code');
    $token = $request->input('token');

    $apiKey = env('THAIBULKSMS_API_KEY');
    $apiSecret = env('THAIBULKSMS_API_SECRET');

    // ✅ ตรวจสอบค่าที่รับมา
    if (!$otpCode) {
        return response()->json(['error' => 'กรุณากรอก OTP'], 400);
    }
    if (!$token) {
        return response()->json(['error' => 'Token ไม่ถูกต้อง'], 400);
    }

    // ✅ ตั้งค่าข้อมูลที่จะส่งไปยัง API
    $postData = json_encode([
        'otp_code' => $otpCode, // ✅ รหัส OTP
        'token' => $token       // ✅ Token ที่ได้รับจาก `requestOtp()`
    ]);

    // ✅ ตั้งค่า cURL
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://email-api.thaibulksms.com/email/v1/otp/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Basic " . base64_encode("$apiKey:$apiSecret"), // ✅ ใช้ API Secret ด้วย
            "content-type: application/json"
        ],
    ]);

    // ✅ ส่งคำขอไป API
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $error = curl_error($curl);
    curl_close($curl);

    // ✅ Debug เช็ค Response ที่ได้รับ
    Log::info("🔍 API Verify OTP Response:", ['response' => $response]);

    // ✅ แปลง JSON Response
    $responseData = json_decode($response, true);

    // ✅ ตรวจสอบข้อผิดพลาดของ cURL
    if ($error) {
        return response()->json(['error' => "cURL Error: " . $error], 500);
    }

    // ✅ ตรวจสอบว่า API คืนค่า `success: true` หรือไม่
    if ($httpCode === 200 && isset($responseData['success']) && $responseData['success'] === true) {
        // ✅ เช็คว่า API ไม่ได้ส่ง `invalid_request`
        if (isset($responseData['data']['code']) && $responseData['data']['code'] === "invalid_request") {
            return response()->json([
                'error' => '❌ OTP ไม่ถูกต้อง หรือหมดอายุ',
                'details' => $responseData
            ], 400);
        }

        // ✅ ตั้งค่า Session ว่า OTP ถูกต้อง
        Session::put('mail-otp_verified', true);

        return response()->json([
            'success' => true,
            'message' => '✅ OTP ถูกต้อง ยืนยันสำเร็จ!',
            'data' => $responseData
        ]);
    } else {
        return response()->json([
            'error' => '❌ OTP ไม่ถูกต้อง หรือหมดอายุ',
            'details' => $responseData
        ], $httpCode);
    }
}



    
}
