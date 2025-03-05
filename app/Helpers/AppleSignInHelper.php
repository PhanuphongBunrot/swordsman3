<?php

namespace App\Helpers;

use Firebase\JWT\JWT;

class AppleSignInHelper
{
    public static function generateClientSecret()
    {
        // Path to your private key (.p8 file)
        $keyPath = storage_path('app/AuthKey_W6WZD7CXK7.p8'); // แก้ไข path ตามที่เก็บไฟล์ .p8
        $keyId = env('APPLE_KEY_ID'); // Apple Key ID
        $teamId = env('APPLE_TEAM_ID'); // Apple Team ID
        $clientId = env('APPLE_CLIENT_ID'); // Apple Client ID

        // อ่านไฟล์ private key
        $privateKey = file_get_contents($keyPath);

        // กำหนดเวลาหมดอายุ JWT (30 วัน)
        $timeNow = time();
        $expTime = $timeNow + (86400 * 30); // 30 วัน

        // Payload ของ JWT
        $payload = [
            'iss' => $teamId,   // Apple Team ID
            'iat' => $timeNow,   // เวลาเริ่มต้น
            'exp' => $expTime,   // เวลาหมดอายุ
            'aud' => 'https://appleid.apple.com',   // URL ของ Apple
            'sub' => $clientId,  // Apple Client ID
        ];

        // สร้าง JWT
        return JWT::encode($payload, $privateKey, 'ES256', $keyId);
    }
}
