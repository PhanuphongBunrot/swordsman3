@extends('layouts.app')

@section('title', 'ลืมรหัสผ่าน')

@section('content')

<div class="resetpassword-container-flex">
    <div class="resetpassword-container">
        <h4 class="text-white">🔒 ลืมรหัสผ่าน</h4>
        <p class="text-white">กรุณากรอกอีเมลของคุณเพื่อขอรหัส OTP และตั้งค่ารหัสผ่านใหม่</p>

        <form action="/reset-password" method="POST" id="resetpassword-forgotPasswordForm" onsubmit="return handleResetSubmit(event)">


            @csrf

            <!-- Email -->
            <div class="resetpassword-mb-3">
                <label class="resetpassword-form-label text-white">อีเมล</label>
                <div class="emailinput-resetpassword d-flex gap-2">
                    <input type="email" id="resetpassword-email" name="email" class="resetpassword-form-control flex-grow-1" required>
                    <button type="button" class="resetpassword-btn-otp" id="resetpassword-email-otp-button" onclick="resetpasswordRequestOtp()">ขอ OTP</button>
                </div>
            </div>

            <!-- OTP -->
            <div class="resetpassword-mb-3 resetpassword-otp-group" id="resetpassword-otp-section" style="display: none;">
                <label class="resetpassword-form-label text-white">รหัส OTP</label>
                <div class="d-flex gap-2">
                    <input type="text" id="resetpassword-otp" name="otp" class="resetpassword-form-control flex-grow-1 text-center" required>
                    <!-- <button type="button" class="resetpassword-btn-otp me-2" onclick="resetpasswordVerifyOtp()">ยืนยัน</button> -->
                    <button type="button" class="resetpassword-btn-secondary" id="resetpassword-resend-button" onclick="resetpasswordRequestOtp()" style="display: none;">ขอใหม่</button>
                </div>
            </div>

            <!-- New Password -->
            <div class="resetpassword-mb-3 resetpassword-password-group" style="display: none;">
                <label class="resetpassword-form-label text-white d-block text-start w-100">รหัสผ่านใหม่</label>
                <div class="d-flex w-100">
                    <input type="password" id="resetpassword-password" name="password" class="resetpassword-form-control w-100" required>
                </div>
                <span class="error-message"></span>
            </div>

            <div class="resetpassword-mb-3 resetpassword-password-group" style="display: none;">
                <label class="resetpassword-form-label text-white d-block text-start w-100">ยืนยันรหัสผ่านใหม่</label>
                <div class="d-flex w-100">
                    <input type="password" id="resetpassword-confirmPassword" name="confirmPassword" class="resetpassword-form-control w-100" required>
                </div>
                <span class="error-message"></span>
            </div>




            <button type="submit" class="resetpassword-btn-otp w-100 resetpassword-password-group mt-3" id="resetpassword-reset-password-button" style="display: none;">
                ตั้งค่ารหัสผ่านใหม่
            </button>
        </form>

        <div class="text-center mt-5">
            <a href="/" class="text-decoration-none resetpassword-back-to-login">⬅️ กลับไปหน้าหลัก</a>
        </div>
    </div>
</div>
@endsection

<style>
     body {
            background: linear-gradient(135deg, #0F2523, #021B1A) !important;
        }


    .resetpassword-container-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
    }

    .resetpassword-container {
        background: rgba(15, 37, 35, 0.9);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0px 0px 15px rgba(65, 224, 207, 0.3);
        width: 100%;
        max-width: 500px;
        text-align: center;
        margin-bottom: 200px;
    }

    .resetpassword-form-control {
        background-color: rgba(0, 0, 0, 0.4);
        border: 2px solid transparent;
        color: white;
        transition: all 0.3s ease-in-out;
        border-radius: 8px;
        padding: 10px;
    }

    .resetpassword-form-control:focus {
        border: 2px solid #41e0cf !important;
        box-shadow: 0 0 10px rgba(65, 224, 207, 0.8) !important;
        background-color: rgba(0, 0, 0, 0.6) !important;
        color: white !important;
        outline: none !important;
    }

    .resetpassword-btn-otp {
        background-color: #41e0cf;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        padding: 8px 12px;
    }

    .resetpassword-btn-otp:hover {
        background-color: #37c1b1;
        box-shadow: 0px 0px 10px rgba(65, 224, 207, 0.5);
    }

    .resetpassword-btn-secondary {
        background-color: #444;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        padding: 8px 12px;
    }

    .resetpassword-btn-secondary:hover {
        background-color: #666;
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
    }

    .resetpassword-btn-secondary:disabled {
        background-color: #666;
        opacity: 0.7;
        cursor: not-allowed;
    }


    /*  ขอบแดงเมื่อ input ไม่ถูกต้อง */
    .resetpassword-form-control.is-invalid {
        border-color: #ff4d4d !important;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.6) !important;
    }

    /*  ข้อความ error ใต้ช่อง input */
    .error-message {
        color: red;
        font-size: 0.875rem;
        text-align: start;
        margin-top: 5px;
    }

    .is-invalid {
        border: 2px solid red !important;
    }

    .error-message {
        display: block;
        font-size: 0.9rem;
        margin-top: 5px;
        color: red;
    }

    .resetpassword-btn-otp.disabled,
    .resetpassword-btn-otp:disabled {
        background-color: #666 !important;
        opacity: 0.6;
        cursor: not-allowed;
        border: 1px solid #555;
        box-shadow: none;
    }

    @media (max-width: 768px) {
       .emailinput-resetpassword {
            flex-wrap: nowrap;
            white-space: nowrap;
            overflow: hidden;
        }
        .emailinput-resetpassword input,
        .emailinput-resetpassword button {
            flex-shrink: 1;
            min-width: 0;
        }

    }

    @media only screen and (max-width: 1400px) and (orientation: landscape) {
            .resetpassword-container {
      
        margin-bottom: 0px;
    }

    }
</style>



<style>
/* ==============================
🎨 SweetAlert2 แจ้งเตือนแบบ Error
============================== */
/* ปิดการใช้งานเฉพาะปุ่ม "ลงทะเบียน" */
#registerForm button[type="submit"]:disabled {
    background-color: #666 !important;
    cursor: not-allowed !important;
    opacity: 0.5 !important;
    border: 2px solid #444 !important;
}


.custom-swal-error-popup {
    border-radius: 15px !important;
    box-shadow: 0px 0px 15px rgba(255, 0, 0, 0.7) !important;
    background-color: #1a1a1a !important;
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
    color: white !important;
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
    background-color: #1a1a1a !important;
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
    color:rgb(252, 252, 252) !important;
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

<script>
    let resetpasswordOtpVerified = false;
    let csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    let csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute("content") : "";
   


   function resetpasswordRequestOtp() {
    const email = document.getElementById("resetpassword-email").value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // ❌ ไม่กรอกอีเมล
    if (!email) {
        Swal.fire({
            title: "⚠️ กรุณากรอกอีเมล",
            customClass: {
                popup: "custom-swal-error-popup",
                title: "custom-swal-error-title",
                confirmButton: "custom-swal-error-button",
                htmlContainer: "custom-swal-error-text",
                icon: "custom-swal-error-icon"
            }
        });
        return;
    }

    // ❌ รูปแบบอีเมลไม่ถูกต้อง
    if (!emailRegex.test(email)) {
        Swal.fire({
            title: "❌ รูปแบบอีเมลไม่ถูกต้อง",
            text: "กรุณากรอกอีเมลให้ถูกต้อง ต้องมี@และ.com",
            customClass: {
                popup: "custom-swal-error-popup",
                title: "custom-swal-error-title",
                confirmButton: "custom-swal-error-button",
                htmlContainer: "custom-swal-error-text",
                icon: "custom-swal-error-icon"
            }
        });
        return;
    }

        fetch("/api-sendCodeResetPass", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(response => response.json()) // แปลงเป็น JSON
            .then(status => {
                if (status) {
                   Swal.fire({
                    title: "✅ OTP ถูกส่งไปยังอีเมลของคุณ!",
                    text: "โปรดตรวจสอบอีเมล",
                    customClass: {
                        popup: "custom-swal-success-popup",
                        title: "custom-swal-success-title",
                        confirmButton: "custom-swal-success-button",
                        htmlContainer: "custom-swal-success-text",
                        icon: "custom-swal-success-icon"
                    }
                    });

                    // แสดงฟอร์ม OTP
                    document.getElementById("resetpassword-otp-section").style.display = "block";
                    document.getElementById("resetpassword-email-otp-button").style.display = "none";
                    document.getElementById("resetpassword-resend-button").style.display = "inline-block";

                    // เก็บสถานะ OTP
                    localStorage.setItem("resetpassword_email", email);
                    localStorage.setItem("resetpassword_otp_requested", "true");
                    localStorage.setItem("resetpassword_otp_expire", Date.now() + 90000); // 90 วินาที

                    startCountdown();
                } else {
                    Swal.fire("❌ ไม่สามารถส่ง OTP ได้", data.message, "error");
                }
            })
            .catch(error => {
                Swal.fire("❌ เกิดข้อผิดพลาด", error.message || "ไม่สามารถส่งคำขอ OTP ได้", "error");
            });
        // // เก็บอีเมลไว้
        // localStorage.setItem("resetpassword_email", email);

        // // ล้าง OTP verification
        // localStorage.removeItem("resetpassword_otpVerified");

        // Swal.fire("✅ OTP ถูกส่งไปยังอีเมลของคุณ!", "โปรดตรวจสอบอีเมล", "success");

        // document.getElementById("resetpassword-otp-section").style.display = "block";
        // document.getElementById("resetpassword-email-otp-button").style.display = "none";
        // document.getElementById("resetpassword-resend-button").style.display = "inline-block";

        // localStorage.setItem("resetpassword_otp_requested", "true");
        // localStorage.setItem("resetpassword_otp_expire", Date.now() + 90000); // 90 วินาที

        // startCountdown();
    }


    function startCountdown(initialCountdown = 90) {
        const resendButton = document.getElementById("resetpassword-resend-button");
        const requestButton = document.getElementById("resetpassword-email-otp-button");

        if (window.resetOtpTimer) clearInterval(window.resetOtpTimer);

        let countdown = initialCountdown;
        resendButton.disabled = true;

        window.resetOtpTimer = setInterval(() => {
            countdown--;
            resendButton.innerText = `ขอใหม่ (${countdown})`;

            if (countdown <= 0) {
                clearInterval(window.resetOtpTimer);
                resendButton.innerText = "ขอใหม่";
                resendButton.disabled = false;

                // สลับปุ่ม
                resendButton.style.display = "none";
                requestButton.style.display = "inline-block";

                localStorage.removeItem("resetpassword_otp_requested");
                localStorage.removeItem("resetpassword_otp_expire");
            }
        }, 1000);
    }


    // ✅ โหลดข้อมูลจาก localStorage เมื่อรีเฟรช
    // เรียกฟังก์ชันตอนหน้าโหลด
    document.addEventListener("DOMContentLoaded", function() {
        const otpRequested = localStorage.getItem("resetpassword_otp_requested") === "true";
        const expireTime = parseInt(localStorage.getItem("resetpassword_otp_expire"));
        const now = Date.now();

        const otpSection = document.getElementById("resetpassword-otp-section");
        const requestBtn = document.getElementById("resetpassword-email-otp-button");
        const resendBtn = document.getElementById("resetpassword-resend-button");

        //  Autofill email ถ้ามีใน localStorage
        const savedEmail = localStorage.getItem("resetpassword_email");
        if (savedEmail) {
            document.getElementById("resetpassword-email").value = savedEmail;
        }

        if (otpRequested && expireTime && now < expireTime) {
            const remaining = Math.floor((expireTime - now) / 1000);

            otpSection.style.display = "block";
            requestBtn.style.display = "none";
            resendBtn.style.display = "inline-block";
            resendBtn.disabled = true;

            startCountdown(remaining);
        } else if (otpRequested && now >= expireTime) {
            localStorage.removeItem("resetpassword_otp_requested");
            localStorage.removeItem("resetpassword_otp_expire");

            otpSection.style.display = "block";
            resendBtn.style.display = "none";
            requestBtn.style.display = "inline-block";
        }


    });

    /*เปิดช่องให้ใส่pass and confirm password เมือ่กรอกotp code ครบ6ตัว */
    document.addEventListener("DOMContentLoaded", function() {
        const otpInput = document.getElementById("resetpassword-otp");

        otpInput.addEventListener("input", function() {
            const otpValue = otpInput.value.trim();
            const passwordGroups = document.querySelectorAll(".resetpassword-password-group");

            if (/^\d{6}$/.test(otpValue)) {
                // ✅ แสดงช่องรหัสผ่าน
                passwordGroups.forEach(el => el.style.display = "block");
            } else {
                // ❌ ซ่อนถ้า OTP ยังไม่ครบ 6 หลัก
                passwordGroups.forEach(el => el.style.display = "none");
            }
        });
    });


    // function resetpasswordVerifyOtp() {
    //     const otp = document.getElementById("resetpassword-otp").value.trim();
    //     if (!otp || otp.length !== 6) {
    //         Swal.fire("❌ OTP ไม่ถูกต้อง", "กรุณากรอก OTP 6 หลัก", "error");
    //         return;
    //     }

    //     Swal.fire("✅ OTP ถูกต้อง!", "กรุณาตั้งค่ารหัสผ่านใหม่", "success");
    //     resetpasswordOtpVerified = true;

    //     localStorage.setItem("resetpassword_otpVerified", "true"); //  เก็บค่าไว้
    //     document.getElementById("resetpassword_otp_verified").value = "true"; //  ส่งให้ backend

    //     document.querySelectorAll(".resetpassword-password-group").forEach(el => {
    //         el.style.display = "block";
    //     });
    // }
</script>



<!-- Validator Script-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const emailInput = document.querySelector("#resetpassword-email");
        const otpInput = document.querySelector("#resetpassword-otp");
        const passwordInput = document.querySelector("#resetpassword-password");
        const confirmPasswordInput = document.querySelector("#resetpassword-confirmPassword");
        const submitButton = document.querySelector("#resetpassword-reset-password-button");

        const touchedFields = {
            email: false,
            otp: false,
            password: false,
            confirmPassword: false
        };

        // สร้าง error-message ให้ครบ
        ["#resetpassword-email", "#resetpassword-otp", "#resetpassword-password", "#resetpassword-confirmPassword"].forEach(selector => {
            const input = document.querySelector(selector);
            const group = input.closest(".resetpassword-mb-3, .resetpassword-password-group");
            if (!group.querySelector(".error-message")) {
                const span = document.createElement("span");
                span.className = "error-message";
                group.appendChild(span);
            }
        });

        function validateInput(input, touched = true) {
            const name = input.name;
            const value = input.value.trim();
            let errorMessage = "";

            if (name === "email") {
                if (!value) {
                    errorMessage = "กรุณากรอกอีเมล";
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    errorMessage = "รูปแบบอีเมลไม่ถูกต้อง";
                }
            }

            if (name === "otp") {
                if (!value) {
                    errorMessage = "กรุณากรอก OTP";
                } else if (!/^\d{6}$/.test(value)) {
                    errorMessage = "OTP ต้องเป็นตัวเลข 6 หลัก";
                }
            }

            if (name === "password" && value.length < 6) {
                errorMessage = "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร";
            }

            if (name === "confirmPassword" && value !== passwordInput.value) {
                errorMessage = "รหัสผ่านไม่ตรงกัน";
            }

            const group = input.closest(".resetpassword-mb-3, .resetpassword-password-group");
            const errorSpan = group.querySelector(".error-message");

            if (touched && errorMessage) {
                input.classList.add("is-invalid");
                errorSpan.textContent = errorMessage;
            } else {
                input.classList.remove("is-invalid");
                errorSpan.textContent = "";
            }



            //✅  ตรวจสอบเงื่อนไขทั้งหมด ก่อนส่งฟอร์ม เปิด/ปิดปุ่ม submit
            const requestedEmail = localStorage.getItem("resetpassword_email");
            const currentEmail = emailInput.value.trim();

            const isFormValid = (
                /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(currentEmail) &&
                /^\d{6}$/.test(otpInput.value.trim()) &&
                passwordInput.value.length >= 6 &&
                confirmPasswordInput.value === passwordInput.value &&
                currentEmail === requestedEmail
            );



            submitButton.disabled = !isFormValid;
            submitButton.classList.toggle("disabled", !isFormValid);
            submitButton.style.display = "block"; // Always show, just disable
        }

        // เรียก validate เมื่อเริ่มกรอกเท่านั้น
        [emailInput, otpInput, passwordInput, confirmPasswordInput].forEach(input => {
            input.addEventListener("input", () => {
                touchedFields[input.name] = true;
                validateInput(input, true);
            });
        });

        // โหลดหน้าครั้งแรก ไม่แสดง error แค่เตรียมปุ่ม
        submitButton.disabled = true;
        submitButton.classList.add("disabled");
        submitButton.style.display = "block";


    });
</script>


<!-- ฟังก์ชันตอนกดsubmit form ตั้งค่ารหัสผ่านใหม่ -->
<script>
    function handleResetSubmit(event) {
        event.preventDefault();

        const email = document.getElementById("resetpassword-email").value.trim();
        const otp = document.getElementById("resetpassword-otp").value.trim();
        const password = document.getElementById("resetpassword-password").value;
        const confirmPassword = document.getElementById("resetpassword-confirmPassword").value;
        
        if (!otp || otp.length !== 6) {
            Swal.fire({
                title: "❌ กรุณากรอก OTP ให้ถูกต้อง",
                text: "ต้องเป็นตัวเลข 6 หลัก",
                customClass: {
                    popup: "custom-swal-error-popup",
                    title: "custom-swal-error-title",
                    confirmButton: "custom-swal-error-button",
                    htmlContainer: "custom-swal-error-text",
                    icon: "custom-swal-error-icon"
                }
            });
            return;
        }

        if (password !== confirmPassword) {
            Swal.fire({
                title: "❌ รหัสผ่านไม่ตรงกัน!",
                text: "กรุณากรอกรหัสผ่านให้ตรงกัน",
                customClass: {
                    popup: "custom-swal-error-popup",
                    title: "custom-swal-error-title",
                    confirmButton: "custom-swal-error-button",
                    htmlContainer: "custom-swal-error-text",
                    icon: "custom-swal-error-icon"
                }
            });
            return;
        }


        // ✅ ส่งข้อมูลไป route: /reset-password (ใช้ form URL เดิม Laravel)
        fetch("/reset-password", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    email,
                    password,
                    confirmPassword,
                     otp, // 🔒 API ตรวจสอบ OTP
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === false) {
                   Swal.fire({
                        html: `
                            <div class="custom-swal-error-icon">❌</div>
                            <div class="custom-swal-error-title">รหัส OTP ไม่ถูกต้อง</div>
                            <div class="custom-swal-error-text">${data.message}</div>
                        `,
                        customClass: {
                            popup: "custom-swal-error-popup",
                            confirmButton: "custom-swal-error-button"
                        }
                        });

                } else {
                    Swal.fire({
                        title: "✅ เปลี่ยนรหัสผ่านสำเร็จ!",
                        html: `
                            <div class="custom-swal-success-text">คุณสามารถเข้าสู่ระบบด้วยรหัสผ่านใหม่ได้แล้ว</div>
                        `,
                        customClass: {
                            popup: "custom-swal-success-popup",
                            title: "custom-swal-success-title",
                            confirmButton: "custom-swal-success-button"
                        }
                  }).then(() => {
                    // ✅ เคลียร์ข้อมูล
                    localStorage.clear();

                    // 🔄 รีเฟรชหน้าเดิม
                    window.location.reload();
                });

                }
            })

            .catch(error => {
                wal.fire({
                title: "❌ เกิดข้อผิดพลาด",
                text: "ไม่สามารถตั้งค่ารหัสผ่านใหม่ได้",
                customClass: {
                    popup: "custom-swal-error-popup",
                    title: "custom-swal-error-title",
                    confirmButton: "custom-swal-error-button",
                    htmlContainer: "custom-swal-error-text",
                    icon: "custom-swal-error-icon"
                }
            });

                console.error(error);
            });
    }
</script>