<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXP UP เติมเงิน</title>
     <meta name="csrf-token" content="{!! csrf_token() !!}">
   
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

   <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




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
            max-width: auto; 
            text-align: center; 
        }

        /* ปุ่ม OTP */
        .otp-group .btn {
            /* min-width: 50px;  */
            padding: 8px 12px;
            font-weight: bold;
            text-align: center;
            
        }
        .otp-group input {
        /* width: 100%; */
        min-width: 230px;
        text-align: center;
    }
        /* ปรับให้ปุ่ม OTP ไม่โดนบีบ */
        .otp-group .d-flex {
            flex-wrap: nowrap;  /* ป้องกัน Flexbox พับลงมา */
            gap: 8px; /* เพิ่มช่องว่างระหว่าง input กับปุ่ม */
        }

  

    /* ปุ่ม "ขอใหม่" */
    .otp-group .btn-secondary {
        flex-shrink: 0;  /* ป้องกันปุ่มถูกบีบ */
        white-space: nowrap;  /* ป้องกันข้อความในปุ่มขึ้นบรรทัดใหม่ */
        width: auto;  /* ให้ขนาดอัตโนมัติตามเนื้อหา */
        padding: 6px 12px; /* ปรับขนาด padding ให้เหมาะสม */
    }

    /* Responsive ปรับ layout บนอุปกรณ์เล็ก */
    @media (max-width: 768px) {
   .otp-group .btn-otp{
    text-align: center;
    margin:0 auto;
    text: center;
   }
    .otp-group input {
        width: 100%;
        min-width: 0;
        text-align: center;
    }
    .otp-group .d-flex {
            flex-wrap: nowrap;  
            gap: 8px; /* เพิ่มช่องว่างระหว่าง input กับปุ่ม */
        }

    

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
    <form action="/register" method="POST" id="registerForm">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="d-flex">
                <input type="email" id="email" name="email" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp" id="email-otp-button" onclick="validateEmailBeforeOtp()">ขอ OTP</button>

            </div>
            <span class="error-message"></span>
        </div>

        <!-- OTP Email -->
        <div class="mb-3 otp-group" id="email-otp-section">
            <label class="form-label">OTP</label>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="email-otp" name="emailOtp" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp me-2" onclick="verifyOtp('email')">ยืนยัน</button>
                <button type="button" class="btn btn-secondary" id="email-resend-button" style="display: none;" onclick="validateEmailBeforeOtp()">ขอใหม่</button>

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
        <!-- <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <div class="d-flex">
                <input type="tel" id="phone" name="phone" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp" id="phone-otp-button" onclick="requestOtp('phone')">ขอ OTP</button>
            </div>
            <span class="error-message"></span>
        </div> -->

        <!-- OTP Phone -->
        <!-- <div class="mb-3 otp-group" id="phone-otp-section">
            <label class="form-label">OTP</label>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="phone-otp" name="phoneOtp" class="form-control flex-grow-1" required>
                <button type="button" class="btn btn-otp me-2" onclick="verifyOtp('phone')">ยืนยัน</button>
                <button type="button" class="btn btn-secondary" id="phone-resend-button" style="display: none;" onclick="requestOtp('phone')">ขอใหม่</button>
            </div>
            <span class="error-message"></span>
        </div> -->

        <button type="submit" class="btn btn-otp mt-3 w-100">Register</button>
    </form>
</div>

    <!-- OTP section -->
   
<script>
// ✅ ฟังก์ชันตรวจสอบ Email ก่อนขอ OTP
function validateEmailBeforeOtp() {
   let emailInput = document.getElementById("email");
    let email = emailInput.value.trim();

    if (!email) {
        Swal.fire({
            title: "❌ กรุณากรอกอีเมล!",
            text: "คุณต้องกรอกอีเมลก่อนขอ OTP",
            icon: "error",
            background: "#222",
            color: "#fff",
            width: "400px",
            customClass: {
                popup: "custom-swal-error-popup",
                title: "custom-swal-error-title",
                confirmButton: "custom-swal-error-button"
            }
        });
        return;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        Swal.fire({
            title: "❌ อีเมลไม่ถูกต้อง!",
            text: "กรุณากรอกรูปแบบที่ถูกต้อง",
            icon: "error",
            background: "#222",
            color: "#fff",
            width: "400px",
            customClass: {
                popup: "custom-swal-error-popup",
                title: "custom-swal-error-title",
                confirmButton: "custom-swal-error-button"
            }
        });
        return;
    }


    // ✅ ถ้าอีเมลถูกต้อง → เรียก requestOtp() (ขอ OTP จาก API จริง)
    requestOtp("email", email);
}

async function requestOtp(type, email) {
    let csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    
    if (!csrfTokenElement) {
        showError("❌ ขอ OTP ไม่สำเร็จ!", "CSRF Token ไม่พบใน HTML");
        return;
    }

    let csrfToken = csrfTokenElement.getAttribute("content");

    let otpSection = document.getElementById(`${type}-otp-section`);
    let otpButton = document.getElementById(`${type}-otp-button`);
    let resendButton = document.getElementById(`${type}-resend-button`);

    try {
        let response = await fetch("/send-mail-otp", {
            method: "POST",
            headers: { 
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken, 
            },
            body: JSON.stringify({
                recipient_email: email,
                template_uuid: "25031414-5310-894c-b024-4546e489a6e1",
                payload: {} 
            })
        });

        let result = await response.json();
        console.log("📩 Raw Response:", result);

        // ✅ ตรวจสอบว่ามี `token` หรือไม่
        if (result.details?.token) {
            let token = result.details.token;

            // ✅ เก็บ Token ไว้ใน Local Storage
            localStorage.setItem(`${type}_otp_token`, token);

            showSuccess("✅ OTP ถูกส่งแล้ว!", "กรุณาตรวจสอบอีเมลของคุณ");

            // ✅ แสดงช่อง OTP
            otpSection.style.display = "block";

            // ✅ ใช้ Local Storage เพื่อให้ OTP ไม่หายเมื่อรีเฟรช
            localStorage.setItem(`${type}_otp_requested`, "true");
            localStorage.setItem(`${type}_otp_visible`, "true");

            // ✅ บันทึกเวลาหมดอายุของ OTP (90 วินาที)
            let expireTime = Date.now() + 90000;
            localStorage.setItem(`${type}_otp_expire`, expireTime);

            // ซ่อนปุ่มขอ OTP แล้วแสดงปุ่มขอใหม่
            otpButton.style.display = "none";
            resendButton.style.display = "inline-block";
            resendButton.disabled = true;

            // ✅ เรียก `startCountdown()` หลังจากตั้งค่า `expireTime`
            startCountdown(resendButton, otpButton, type);
        } else {
            throw new Error(result.error || "เกิดข้อผิดพลาดในการขอ OTP");
        }
    } catch (error) {
        console.error("❌ Request Error:", error);
        showError("❌ ขอ OTP ไม่สำเร็จ!", error.message);
    }
}




// ✅ ฟังก์ชันยืนยัน OTP
async function verifyOtp(type) {
    let csrfTokenElement = document.querySelector('meta[name="csrf-token"]');

    if (!csrfTokenElement) {
        showError("❌ ยืนยัน OTP ไม่สำเร็จ!", "CSRF Token ไม่พบใน HTML");
        return;
    }

    let csrfToken = csrfTokenElement.getAttribute("content");
    let otpInput = document.getElementById(`${type}-otp`);
    let otpCode = otpInput.value.trim();
    let token = localStorage.getItem(`${type}_otp_token`); // ✅ ดึง Token จาก LocalStorage

    if (!otpCode) {
        showError("❌ กรุณากรอก OTP!", "คุณต้องป้อนรหัส OTP ที่ได้รับ");
        return;
    }

    if (!token) {
        showError("❌ ไม่พบ Token!", "กรุณาขอ OTP ใหม่อีกครั้ง");
        return;
    }

    console.log("🔍 OTP ที่ส่ง:", otpCode);
    console.log("🔍 Token ที่ส่ง:", token);

    try {
        let response = await fetch("/verify-mail-otp", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                otp_code: otpCode, // ✅ รหัส OTP
                token: token // ✅ Token ที่ได้รับจาก `requestOtp()`
            })
        });

        let result = await response.json();
        console.log("🔍 Raw Response:", result);

        // ✅ กรณี OTP ถูกต้องให้ตรวจสอบ `"status": "verified"` หรือ `"message": "Verified success"`
        if (result.details?.status === "verified" || result.details?.message === "Verified success") {
            showSuccess("✅ OTP ถูกต้อง!", "คุณสามารถเข้าสู่ระบบได้แล้ว");

            // ✅ ลบ Token ที่ใช้ไปแล้ว
            localStorage.removeItem(`${type}_otp_token`);

            document.getElementById(`${type}-otp-section`).innerHTML = `
                <p class="text-success">✅ OTP ถูกต้อง! ดำเนินการต่อได้</p>
            `;

            return; // ✅ ออกจากฟังก์ชันทันทีเพราะสำเร็จแล้ว
        }

        // ✅ ถ้า API ตอบ `invalid_request` หรือ `Invalid OTP` ให้ขึ้นแจ้งเตือนว่า OTP ไม่ถูกต้อง
        if (result.error === "invalid_request" || result.details?.message === "Invalid OTP") {
            throw new Error("❌ OTP ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!");
        }

        // ✅ ถ้าไม่มีเงื่อนไขไหนผ่าน ให้ถือว่า OTP ผิด
        throw new Error(result.error);

    } catch (error) {
        console.error("❌ Request Error:", error);
        showError("❌ ยืนยัน OTP ไม่สำเร็จ!", error.message);
    }
}









// ✅ ฟังก์ชันเริ่มนับถอยหลัง (บันทึกลง Local Storage)
function startCountdown(resendButton, otpButton, type) {
    let expireTime = localStorage.getItem(`${type}_otp_expire`);
    if (!expireTime) return;

    let countdown = Math.floor((expireTime - Date.now()) / 1000);

    let timer = setInterval(() => {
        countdown--;
        resendButton.innerText = `ขอใหม่ (${countdown})`;

        if (countdown <= 0) {
            clearInterval(timer);
            resendButton.innerText = "ขอใหม่";
            resendButton.disabled = false;
            resendButton.style.display = "none";
            otpButton.style.display = "inline-block";
            localStorage.removeItem(`${type}_otp_expire`);
            localStorage.removeItem(`${type}_otp_requested`);
            localStorage.removeItem(`${type}_otp_visible`);
        }
    }, 1000);
}

// ✅ โหลดค่าจาก LocalStorage เมื่อรีเฟรช
document.addEventListener("DOMContentLoaded", function () {
    ["email", "phone"].forEach(type => {
        let otpSection = document.getElementById(`${type}-otp-section`);
        let resendButton = document.getElementById(`${type}-resend-button`);
        let otpButton = document.getElementById(`${type}-otp-button`);

        let isOtpRequested = localStorage.getItem(`${type}_otp_requested`) === "true";
        let isOtpVisible = localStorage.getItem(`${type}_otp_visible`) === "true";

        if (otpSection && isOtpVisible) otpSection.style.display = "block";
        if (resendButton && isOtpRequested) resendButton.style.display = "inline-block";
        if (otpButton && !isOtpRequested) otpButton.style.display = "inline-block";

        startCountdown(resendButton, otpButton, type);
    });
});

// ✅ ฟังก์ชันแสดงแจ้งเตือน SweetAlert (Success)
function showSuccess(title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: "success",
        background: "#222",
        color: "#fff",
        width: "400px",
    });
}

// ✅ ฟังก์ชันแสดงแจ้งเตือน SweetAlert (Error)
function showError(title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: "error",
        background: "#222",
        color: "#fff",
        width: "400px",
    });
}
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
        // if (name === "phone") {
        //     if (!/^\d{10}$/.test(value)) {
        //         errorMessage = "เบอร์โทรศัพท์ต้องเป็นตัวเลข 10 หลัก";
        //     }
        // }

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

<!-- ส่งมาจากอีเมลและuserมีอยู่แล้วในsdk -->
@if(session()->pull('user-dup-error')) 
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            title: "❌ อีเมลนี้เคยลงทะเบียนแล้ว!",
            html: '<i class="fas fa-exclamation-circle custom-swal-error-icon"></i>',
            showConfirmButton: true,
            background: "#222",
            color: "#fff",
            width: "400px",
            customClass: {
                popup: "custom-swal-error-popup",
                title: "custom-swal-error-title",
                confirmButton: "custom-swal-error-button"
            }
        });
    });
</script>
@endif

<style>
/* ==============================
🎨 SweetAlert2 แจ้งเตือนแบบ Error
============================== */
.custom-swal-error-popup {
    border-radius: 15px !important;
    box-shadow: 0px 0px 15px rgba(255, 0, 0, 0.7) !important;
    width: 60% !important;
    max-width: 350px !important;
    text-align: center !important;
}

/* ✅ ปรับขนาด Title */
.custom-swal-error-title {
    font-size: 22px !important;
    font-weight: bold !important;
    color: #ff4444 !important;
    text-shadow: 0px 0px 10px rgba(255, 0, 0, 0.7);
}

/* ✅ ปรับขนาดไอคอน Error */
.custom-swal-error-icon {
    font-size: 60px !important;
    color: #ff4444 !important;
    display: block !important;
    margin: 10px auto !important;
    text-shadow: 0px 0px 10px rgba(255, 0, 0, 0.7);
}

/* ✅ ปรับขนาดปุ่ม */
.custom-swal-error-button {
    background-color: #ff4444 !important;
    color: white !important;
    font-size: 16px !important;
    padding: 8px 16px !important;
    border-radius: 6px !important;
}

/* ✅ ปรับสไตล์ของข้อความแจ้งเตือน */
.custom-swal-error-text {
    font-size: 16px;
    font-weight: normal;
    color: #ff6666;
    margin-top: 10px;
}

/* ==============================
🎨 SweetAlert2 แจ้งเตือนแบบ Success
============================== */
.swal2-icon {
    display: none !important; /* ✅ ซ่อนไอคอนเริ่มต้นทั้งหมด */
}

/* ✅ สไตล์ของ Popup */
.custom-swal-success-popup {
    border-radius: 15px !important;
    box-shadow: 0px 0px 15px rgba(0, 255, 100, 0.7) !important;
    width: 60% !important;
    max-width: 350px !important;
    text-align: center !important;
}

/* ✅ ปรับขนาด Title */
.custom-swal-success-title {
    font-size: 22px !important;
    font-weight: bold !important;
    color: #00ff99 !important;
    text-shadow: 0px 0px 10px rgba(0, 255, 100, 0.7);
}

/* ✅ ปรับไอคอน Success */
.custom-swal-success-icon {
    font-size: 60px !important;
    color: #00ff99 !important;
    margin-bottom: 10px !important;
    text-shadow: 0px 0px 10px rgba(0, 255, 100, 0.7);
}

/* ✅ ปรับขนาดข้อความ */
.custom-swal-success-text {
    font-size: 16px !important;
    color: #d4ffd4 !important;
    margin-top: 10px !important;
}

/* ✅ ปรับขนาดปุ่ม */
.custom-swal-success-button {
    background-color: #00cc66 !important;
    color: white !important;
    font-size: 16px !important;
    padding: 8px 16px !important;
    border-radius: 6px !important;
    transition: all 0.3s ease-in-out;
}

/* ✅ เอฟเฟค Hover ปุ่ม */
.custom-swal-success-button:hover {
    background-color: #00994d !important;
    box-shadow: 0px 0px 10px rgba(0, 255, 100, 0.7);
}

</style>

</body>

</html>
