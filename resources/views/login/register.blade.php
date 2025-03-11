<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXP UP เติมเงิน</title>
    
   
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

   




    <style>
         body {
            background: linear-gradient(135deg, #0F2523, #021B1A);
            font-family: 'Roboto', sans-serif;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

            .navbar {
            background-color: #000;
            border-bottom: 2px solid #41e0cf;
            width: 100%;
        }

        .navbar h1 {
            font-size: 24px;
            color: #41e0cf;
            margin: 0;
        }




        .register-container {
            background: rgba(15, 37, 35, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(65, 224, 207, 0.3);
            width: 100%;
            max-width: 500px;
            text-align: center;
            transition: all 0.3s ease;
            margin-top: 50px;
        }

        .register-container h4 {
            color: #41e0cf;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-control {
            background-color: rgba(0, 0, 0, 0.4);
            border: 2px solid transparent;
            color: white;
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #41e0cf;
            box-shadow: 0 0 10px rgba(65, 224, 207, 0.5);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
        }

        .btn-otp {
             min-width: 80px;
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

        .input-group .btn-otp {
            margin-left: 10px;
            padding: 5px 12px;
            font-size: 14px;
        }

        /* ซ่อน OTP ตั้งแต่เริ่มต้น */
        .otp-group {
            display: none;
        }
       
        .otp-group .form-control {
            max-width: 150px; 
          
            text-align: center; 
        }

        /* ปุ่ม OTP */
        .otp-group .btn {
            min-width: 50px; 
            padding: 8px 12px;
            font-weight: bold;
            text-align: center;
            
        }
        .otp-group input {
        width: 100%;
        min-width: 230px; 
        text-align: center;
    }

 
    </style>

</head>

<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container d-flex align-items-center">
        <a class="d-flex align-items-center text-decoration-none" href="{{ asset('/') }}">
            <img src="{{ asset('images/logo.png') }}" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">
            <h1 class="mb-0 ms-1">EXP TOPUP</h1>
        </a>
    </div>
</nav>




    <!-- ฟอร์มลงทะเบียน -->
   <div class="register-container">
    <h4>ลงทะเบียน</h4>
    <form action="/register" method="POST">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="d-flex">
                <input type="email" id="email" name="email" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp" id="email-otp-button" onclick="requestOtp('email')">ขอ OTP</button>
            </div>
            <span class="error-message"></span>
        </div>

        <!-- OTP Email -->
        <div class="mb-3 otp-group" id="email-otp-section">
            <label class="form-label">OTP</label>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="email-otp" name="emailOtp" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp me-2" onclick="verifyOtp('email')">ยืนยัน</button>
                <button type="button" class="btn btn-secondary" id="email-resend-button" style="display: none;" onclick="requestOtp('email')">ขอใหม่</button>
            </div>
            <span class="error-message"></span>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
            <span class="error-message"></span>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control" required>
            <span class="error-message"></span>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <div class="d-flex">
                <input type="tel" id="phone" name="phone" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp" id="phone-otp-button" onclick="requestOtp('phone')">ขอ OTP</button>
            </div>
            <span class="error-message"></span>
        </div>

        <!-- OTP Phone -->
        <div class="mb-3 otp-group" id="phone-otp-section">
            <label class="form-label">OTP</label>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="phone-otp" name="phoneOtp" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp me-2" onclick="verifyOtp('phone')">ยืนยัน</button>
                <button type="button" class="btn btn-secondary" id="phone-resend-button" style="display: none;" onclick="requestOtp('phone')">ขอใหม่</button>
            </div>
            <span class="error-message"></span>
        </div>

        <button type="submit" class="btn btn-otp mt-3 w-100">Register</button>
    </form>
</div>

    <!-- OTP section -->
    <script>
   let otpTimers = {}; // เก็บตัวจับเวลาของแต่ละประเภท OTP

function requestOtp(type) {
    let otpSection = document.getElementById(`${type}-otp-section`);
    let otpButton = document.getElementById(`${type}-otp-button`);
    let resendButton = document.getElementById(`${type}-resend-button`);

    // บันทึกสถานะว่าเคยขอ OTP
    localStorage.setItem(`${type}_otp_requested`, "true");
    localStorage.setItem(`${type}_otp_visible`, "true"); // บันทึกให้ช่อง OTP แสดง

    // แสดงช่อง OTP
    otpSection.style.display = "block";

    // ซ่อนปุ่มขอ OTP แล้วแสดงปุ่มขอใหม่
    otpButton.style.display = "none";
    resendButton.style.display = "inline-block";
    localStorage.setItem(`${type}_resend_visible`, "true"); // บันทึกให้ปุ่มขอใหม่แสดง

    // ตั้งเวลาถอยหลัง (90 วินาที)
    let countdown = 90;
    let expireTime = Date.now() + countdown * 1000; // เวลาหมดอายุ
    localStorage.setItem(`${type}_otp_expire`, expireTime);

    startCountdown(resendButton, otpButton, type);
}

function startCountdown(resendButton, otpButton, type) {
    let expireTime = localStorage.getItem(`${type}_otp_expire`);
    if (!expireTime) return;

    let countdown = Math.floor((expireTime - Date.now()) / 1000); // เวลาที่เหลืออยู่

    // ถ้ามีตัวจับเวลาอยู่แล้ว ให้เคลียร์ก่อน
    if (otpTimers[type]) {
        clearInterval(otpTimers[type]);
    }

    if (countdown > 0) {
        resendButton.innerText = `ขอใหม่ (${countdown})`;
        resendButton.disabled = true;
        localStorage.setItem(`${type}_resend_visible`, "true"); // บันทึกให้ปุ่มขอใหม่แสดง

        otpTimers[type] = setInterval(() => {
            countdown--;
            resendButton.innerText = `ขอใหม่ (${countdown})`;

            if (countdown <= 0) {
                clearInterval(otpTimers[type]);
                resendButton.innerText = "ขอใหม่";
                resendButton.disabled = false;
                resendButton.style.display = "none"; // ซ่อนปุ่มขอใหม่
                otpButton.style.display = "inline-block"; // แสดงปุ่มขอ OTP กลับมา
                localStorage.removeItem(`${type}_otp_expire`);
                localStorage.removeItem(`${type}_resend_visible`); // ลบค่าการแสดงปุ่มขอใหม่
                localStorage.removeItem(`${type}_otp_requested`); // ลบค่าการขอ OTP
                localStorage.removeItem(`${type}_otp_visible`); // ซ่อนช่อง OTP เมื่อหมดเวลา
            }
        }, 1000);
    } else {
        resendButton.innerText = "ขอใหม่";
        resendButton.disabled = false;
        resendButton.style.display = "none"; // ซ่อนปุ่มขอใหม่
        otpButton.style.display = "inline-block"; // แสดงปุ่มขอ OTP กลับมา
        localStorage.removeItem(`${type}_otp_expire`);
        localStorage.removeItem(`${type}_resend_visible`); // ลบค่าการแสดงปุ่มขอใหม่
        localStorage.removeItem(`${type}_otp_requested`); // ลบค่าการขอ OTP
        localStorage.removeItem(`${type}_otp_visible`); // ซ่อนช่อง OTP เมื่อหมดเวลา
    }
}

// ดึงค่าจาก localStorage เมื่อรีเฟรช
document.addEventListener("DOMContentLoaded", function () {
    ["email", "phone"].forEach(type => {
        let resendButton = document.getElementById(`${type}-resend-button`);
        let otpButton = document.getElementById(`${type}-otp-button`);
        let otpSection = document.getElementById(`${type}-otp-section`);

        // เช็คว่ามีการขอ OTP ก่อนหน้าหรือไม่
        let isOtpRequested = localStorage.getItem(`${type}_otp_requested`) === "true";
        let isOtpVisible = localStorage.getItem(`${type}_otp_visible`) === "true";

        // ถ้าเคยขอ OTP และยังไม่นับถอยหลังเสร็จ ให้แสดงช่อง OTP
        if (isOtpRequested && isOtpVisible) {
            otpSection.style.display = "block";
        } else {
            otpSection.style.display = "none"; // ถ้าไม่มีการขอ OTP ให้ซ่อนช่อง OTP
        }

        // ถ้ามีการบันทึกค่า resend_visible ให้แสดงปุ่มขอใหม่
        if (localStorage.getItem(`${type}_resend_visible`) === "true") {
            resendButton.style.display = "inline-block";
            otpButton.style.display = "none";
        } else {
            resendButton.style.display = "none";
            otpButton.style.display = "inline-block";
        }

        if (resendButton && otpButton) {
            startCountdown(resendButton, otpButton, type);
        }
    });
});


    </script>






 <!--  Validator -->
    <script>
   document.addEventListener("DOMContentLoaded", function () {
    function validateInput(input) {
        const name = input.name;
        const value = input.value.trim();
        let errorMessage = "";

        // ตรวจสอบ Email
        if (name === "email") {
            if (value === "") {
                errorMessage = "กรุณากรอกอีเมล";
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                errorMessage = "รูปแบบอีเมลไม่ถูกต้อง";
            }
        }

        // ตรวจสอบ Password
        if (name === "password") {
            if (value.length < 6) {
                errorMessage = "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร";
            }
        }

        // ตรวจสอบ Confirm Password
        if (name === "confirmPassword") {
            const password = document.querySelector("input[name='password']").value;
            if (value !== password) {
                errorMessage = "รหัสผ่านไม่ตรงกัน";
            }
        }

        // ตรวจสอบ Phone Number
        if (name === "phone") {
            if (!/^\d{10}$/.test(value)) {
                errorMessage = "เบอร์โทรศัพท์ต้องเป็นตัวเลข 10 หลัก";
            }
        }

        // ตรวจสอบ OTP
        if (name === "emailOtp" || name === "phoneOtp") {
            if (!/^\d{6}$/.test(value)) {
                errorMessage = "OTP ต้องเป็นตัวเลข 6 หลัก";
            }
        }

        // แสดงหรือซ่อนข้อความผิดพลาด
        const errorSpan = input.closest(".mb-3").querySelector(".error-message");
        const otpButton = input.closest(".mb-3").querySelector(".btn-otp");

        if (errorMessage) {
            input.classList.add("is-invalid");
            errorSpan.textContent = errorMessage;
            errorSpan.style.color = "red";
            // if (otpButton) otpButton.style.visibility = "hidden"; // แค่ซ่อน ไม่ลบออกจาก Layout
        } else {
            input.classList.remove("is-invalid");
            errorSpan.textContent = "";
            if (otpButton) otpButton.style.visibility = "visible"; // แสดงปุ่ม OTP
        }
    }

    // ตรวจสอบค่าขณะที่พิมพ์
    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("input", function () {
            validateInput(this);
        });
    });

    // ตรวจสอบทั้งหมดก่อนส่งฟอร์ม
    document.getElementById("registerForm").addEventListener("submit", function (e) {
        let isValid = true;
        document.querySelectorAll("input").forEach(input => {
            validateInput(input);
            if (input.classList.contains("is-invalid")) {
                isValid = false;
            }
        });

        if (!isValid) {
            alert("❌ กรุณากรอกข้อมูลให้ถูกต้อง");
            e.preventDefault(); // ป้องกันการส่งฟอร์มถ้าข้อมูลผิดพลาด
        }
    });
});

    </script>




</body>

</html>
