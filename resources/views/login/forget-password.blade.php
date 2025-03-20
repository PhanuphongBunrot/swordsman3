@extends('layouts.app')

@section('title', 'ลืมรหัสผ่าน')

@section('content')
<div class="container-flex">
    <div class="resetpassword-container">
        <h4 class="text-white">🔒 ลืมรหัสผ่าน</h4>
        <p class="text-white">กรุณากรอกอีเมลของคุณเพื่อขอรหัส OTP และตั้งค่ารหัสผ่านใหม่</p>

        <form action="#" method="POST" id="forgotPasswordForm">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label text-white">อีเมล</label>
                <div class="d-flex">
                    <input type="email" id="email" name="email" class="form-control flex-grow-1" required>
                    <button type="button" class="btn btn-otp" id="email-otp-button" onclick="requestOtp()">ขอ OTP</button>
                </div>
            </div>

            <!-- OTP -->
            <div class="mb-3 otp-group" id="otp-section" style="display: none;">
                <label class="form-label text-white">รหัส OTP</label>
                <div class="d-flex">
                    <input type="text" id="otp" name="otp" class="form-control flex-grow-1" required>
                    <button type="button" class="btn btn-otp me-2" onclick="verifyOtp()">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" id="resend-button" onclick="requestOtp()" style="display: none;">ขอใหม่</button>
                </div>
            </div>

            <!-- New Password -->
            <div class="mb-3 password-group" style="display: none;">
                <label class="form-label text-white">รหัสผ่านใหม่</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 password-group" style="display: none;">
                <label class="form-label text-white">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-otp w-100 password-group" id="reset-password-button" style="display: none;">
                ตั้งค่ารหัสผ่านใหม่
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="" class="text-decoration-none back-to-login">
                ⬅️ กลับไปหน้าเข้าสู่ระบบ
            </a>
        </div>
    </div>
</div>
@endsection

<style>
    /* ครอบ Container ให้เนื้อหาอยู่ตรงกลาง */
    .container-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        pa
    }

    .resetpassword-container {
        background: rgba(15, 37, 35, 0.9);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0px 0px 15px rgba(65, 224, 207, 0.3);
        width: 100%;
        max-width: 500px;
        margin-bottom: 500px;
        text-align: center;
    }

    .btn-otp {
        background-color: #41e0cf;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-otp:hover {
        background-color: #37c1b1;
        box-shadow: 0px 0px 10px rgba(65, 224, 207, 0.5);
    }

    .text-white {
        color: white;
    }

    .back-to-login {
        color: #41e0cf;
        font-size: 14px;
    }

    .back-to-login:hover {
        text-decoration: underline;
    }
</style>

<script>
    let otpVerified = false;

    function requestOtp() {
        let email = document.getElementById("email").value.trim();
        if (!email) {
            Swal.fire("⚠️ กรุณากรอกอีเมล", "", "error");
            return;
        }

        Swal.fire("✅ OTP ถูกส่งไปยังอีเมลของคุณ!", "โปรดตรวจสอบอีเมล", "success");

        document.getElementById("otp-section").style.display = "block";
        document.getElementById("email-otp-button").style.display = "none";
        document.getElementById("resend-button").style.display = "inline-block";
    }

    function verifyOtp() {
        let otp = document.getElementById("otp").value.trim();
        if (!otp || otp.length !== 6) {
            Swal.fire("❌ OTP ไม่ถูกต้อง", "กรุณากรอก OTP 6 หลัก", "error");
            return;
        }

        Swal.fire("✅ OTP ถูกต้อง!", "กรุณาตั้งค่ารหัสผ่านใหม่", "success");
        otpVerified = true;
        document.querySelectorAll(".password-group").forEach(el => el.style.display = "block");
    }

    document.getElementById("forgotPasswordForm").addEventListener("submit", function (e) {
        e.preventDefault();
        let password = document.getElementById("password").value.trim();
        let confirmPassword = document.getElementById("confirmPassword").value.trim();

        if (!otpVerified) {
            Swal.fire("⚠️ กรุณายืนยัน OTP ก่อน", "", "error");
            return;
        }

        if (!password || password.length < 6) {
            Swal.fire("⚠️ รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร", "", "error");
            return;
        }

        if (password !== confirmPassword) {
            Swal.fire("❌ รหัสผ่านไม่ตรงกัน!", "กรุณากรอกให้ตรงกัน", "error");
            return;
        }

        Swal.fire("🎉 รหัสผ่านถูกตั้งค่าใหม่แล้ว!", "สามารถเข้าสู่ระบบได้", "success");
    });
</script>
