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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        .navbar-brand h1 {
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
            max-width: 400px;
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
        }

        .btn-otp {
            background-color: #41e0cf;
            color: black;
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

 
    </style>

</head>

<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container d-flex align-items-center gap-1">
        <img src="{{ asset('images/logo.png') }}" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">
        <a class="navbar-brand d-flex align-items-center" href="{{ asset('/') }}">
            <h1 class="mb-0">EXP TOPUP</h1>
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
                    <input type="email" id="email" class="form-control flex-grow-1" required>
                    <button type="button" class="btn btn-otp" id="email-otp-button" onclick="requestOtp('email')">ขอ OTP</button>
                </div>
            </div>

            <!-- OTP Email (ซ่อนก่อน) -->
            <div class="mb-3 otp-group" id="email-otp-section">
                <label class="form-label">OTP</label>
                <div class="d-flex">
                    <input type="text" id="email-otp" class="form-control flex-grow-1" required>
                    <button type="button" class="btn btn-otp me-2" onclick="verifyOtp('email')">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" id="email-resend-button" style="display: none;" onclick="requestOtp('email')">ขอใหม่</button>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <div class="d-flex">
                    <input type="tel" id="phone" class="form-control flex-grow-1" required>
                    <button type="button" class="btn btn-otp" id="phone-otp-button" onclick="requestOtp('phone')">ขอ OTP</button>
                </div>
            </div>

            <!-- OTP Phone (ซ่อนก่อน) -->
            <div class="mb-3 otp-group" id="phone-otp-section">
                <label class="form-label">OTP</label>
                <div class="d-flex">
                    <input type="text" id="phone-otp" class="form-control flex-grow-1" required>
                    <button type="button" class="btn btn-otp me-2" onclick="verifyOtp('phone')">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" id="phone-resend-button" style="display: none;" onclick="requestOtp('phone')">ขอใหม่</button>
                </div>
            </div>

            <button type="submit" class="btn btn-otp mt-3 w-100">Register</button>
        </form>
    </div>

    <script>
        function requestOtp(type) {
            let otpSection = document.getElementById(`${type}-otp-section`);
            let otpButton = document.getElementById(`${type}-otp-button`);
            let resendButton = document.getElementById(`${type}-resend-button`);

            // แสดงช่อง OTP
            otpSection.style.display = "block";

            // ซ่อนปุ่มขอ OTP แล้วแสดงปุ่มขอใหม่
            otpButton.style.display = "none";
            resendButton.style.display = "inline-block";

            // ตั้งเวลาถอยหลัง 60 วินาที
            let countdown = 60;
            resendButton.innerText = `ขอใหม่ (${countdown})`;
            resendButton.disabled = true;

            let timer = setInterval(() => {
                countdown--;
                resendButton.innerText = `ขอใหม่ (${countdown})`;

                if (countdown <= 0) {
                    clearInterval(timer);
                    resendButton.innerText = "ขอใหม่";
                    resendButton.disabled = false;
                }
            }, 1000);
        }

        function verifyOtp(type) {
            alert(type + " OTP Verified! ✅");
        }
    </script>

</body>

</html>
