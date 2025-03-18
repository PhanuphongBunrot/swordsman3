<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class MailOtpController extends Controller
{
    // ✅ 1. ส่ง OTP ไปที่อีเมลผู้ใช้
    public function sendMailOtp(Request $request)
    {
        $email = $request->input('email');
        echo $email;
        // // 🔥 ตรวจสอบรูปแบบอีเมล
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     return response()->json(['error' => 'อีเมลไม่ถูกต้อง'], 400);
        // }

        // 🔥 ป้องกันการขอ OTP ถี่เกินไป (ขอได้ทุก 90 วินาที)
        if (Session::has('otp_request_time') && time() - Session::get('otp_request_time') < 90) {
            return response()->json(['error' => 'กรุณารอ 90 วินาทีก่อนขอ OTP ใหม่'], 429);
        }

        // ✅ ดึง API Key และ Template UUID จาก .env
        $apiKey = env('THAIBULKSMS_API_KEY');
        $templateUuid = env('THAIBULKSMS_TEMPLATE_UUID');

        // ✅ ส่ง OTP ผ่าน API
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode($apiKey),
            'content-type' => 'application/json'
        ])->post('https://email-api.thaibulksms.com/email/v1/otp/send', [
            'template_uuid' => $templateUuid,
            'recipient_email' => $email
        ]);

        // ✅ เช็คว่าส่ง OTP สำเร็จไหม
        if ($response->successful()) {
            // ✅ บันทึกอีเมล + เวลาขอ OTP ไว้ใน Session
            Session::put('otp_email', $email);
            Session::put('otp_request_time', time());

            return response()->json(['success' => 'OTP ถูกส่งไปที่อีเมลของคุณ']);
        } else {
            return response()->json([
                'error' => 'ไม่สามารถส่ง OTP ได้',
                'details' => $response->json()
            ], 500);
        }
    }

    // ✅ 2. ตรวจสอบ OTP ที่ผู้ใช้กรอก
    public function verifyMailOtp(Request $request)
    {
        $email = Session::get('otp_email');
        $otp = $request->input('otp');

        if (!$email) {
            return response()->json(['error' => 'ไม่มี OTP ที่รอการตรวจสอบ'], 400);
        }

        // ✅ ดึง API Key จาก .env
        $apiKey = env('THAIBULKSMS_API_KEY');

        // ✅ เรียก API เพื่อตรวจสอบ OTP
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode($apiKey),
            'content-type' => 'application/json'
        ])->post('https://email-api.thaibulksms.com/email/v1/otp/verify', [
            'recipient_email' => $email,
            'otp' => $otp
        ]);

        // ✅ เช็คว่าตรวจสอบสำเร็จไหม
        if ($response->successful()) {
            Session::put('otp_verified', true); // ✅ บันทึกว่าผู้ใช้ยืนยัน OTP แล้ว
            Session::forget('otp_email'); // 🔥 ลบข้อมูล OTP ทิ้งทันทีหลังจากใช้สำเร็จ

            return response()->json(['success' => 'OTP ถูกต้อง']);
        } else {
            return response()->json([
                'error' => 'OTP ไม่ถูกต้อง',
                'details' => $response->json()
            ], 400);
        }
    }
}
