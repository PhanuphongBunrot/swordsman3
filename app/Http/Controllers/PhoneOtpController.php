<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PhoneOtpController extends Controller
{
    /**
     *  ตรวจสอบว่าผู้ใช้มีเบอร์โทรในฐานข้อมูลหรือไม่
     */
    public function checkUserPhone()
    {
        $uid = Session::get('uid'); // ดึง UID จาก Session

        if (!$uid) {
            return response()->json(['error' => 'User not logged in'], 401);
        }

        // ตรวจสอบว่า uid มีอยู่จริงในตาราง users
        $user = DB::table('users')->where('uid', $uid)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['has_phone' => !empty($user->phone)]);
    }

    /**
     *  บันทึกเบอร์โทรลงในฐานข้อมูล เมื่อยืนยัน OTP สำเร็จ
     */
   public function saveUserPhone(Request $request)
    {
    $uid = Session::get('uid'); // ดึง UID จาก Session
    $phone = $request->input('phone'); // รับค่าจากฟอร์ม

    if (!$uid) {
        return response()->json(['error' => 'User not logged in'], 401);
    }

    if (!preg_match('/^\d{10}$/', $phone)) {
        return response()->json(['error' => 'Invalid phone number'], 400);
    }

    // ตรวจสอบว่าผู้ใช้มีอยู่จริงก่อนบันทึกเบอร์โทร
    $user = DB::table('users')->where('uid', $uid)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $updated = DB::table('users')->where('uid', $uid)->update(['phone' => $phone]);

    if ($updated) {
        return response()->json(['success' => 'Phone number saved successfully']);
    } else {
        return response()->json(['error' => 'Failed to update phone number'], 500);
    }
}

}
