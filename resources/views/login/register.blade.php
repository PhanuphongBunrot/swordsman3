<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXP UP เติมเงิน</title>
    <!-- เพิ่ม Bootstrap CDN ใน <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ตัวอย่างการเพิ่มฟอนต์จาก Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{asset('js/register.js')}}"></script>

    <style>
        /* Add this to your CSS */
        input:focus,
        .is-invalid {
            border-color: #41e0cf !important;
            /* Green color for valid fields */
        }

        input.is-invalid {
            border-color: red !important;
            /* Red color for invalid fields */
        }
    </style>

</head>

<body style="background-color:rgb(15, 37, 35);  font-family: 'Roboto', sans-serif;">



    <nav class="navbar navbar-expand-lg " style="background-color:#000;border-bottom: 1px solid #41e0cf; ">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">
            <a class="navbar-brand mx-2" href="{{ asset('/') }}">
                <h1 style="color: #41e0cf;"> EXP TOPUP </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn" style="background-color:#41e0cf; color:#0F2523; font-weight: 500;" href="javascript:void(0)" onclick="openModal()">เข้าสู่ระบบ </a>

                    </li>
                </ul> -->
            </div>

        </div>
    </nav>




    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; flex-direction: column;">
        <h4 style="color: white; margin-bottom: 20px;">ลงทะเบียน</h4>
        <form action="/register" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label" style="color: white;">Email:</label>
                <div class="input-group" style="width: 300px;">
                    <input type="email" id="email" name="email" class="form-control" required>
                    <button type="button" class="btn btn-secondary" id="email-otp-button" onclick="requestOtp('email')">ขอ OTP</button>
                </div>
            </div>
            <div class="mb-3" id="email-otp-section" style="display: none;">
                <label for="email_otp" class="form-label" style="color: white;">OTP:</label>
                <div class="input-group" style="width: 300px;">
                    <input type="text" id="email_otp" name="email_otp" class="form-control" required>
                    <button type="button" class="btn btn-secondary me-2" onclick="verifyOtp('email')">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" id="email-resend-button" onclick="requestOtp('email')" style="display: none;">ขอใหม่</button>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label" style="color: white;">Password:</label>
                <input type="password" id="password" name="password" class="form-control" style="width: 300px;" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label" style="color: white;">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" style="width: 300px;" required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label" style="color: white;">Phone Number:</label>
                <div class="input-group" style="width: 300px;">
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                    <button type="button" class="btn btn-secondary" id="phone-otp-button" onclick="requestOtp('phone')">ขอ OTP</button>
                </div>
            </div>
            <div class="mb-3" id="phone-otp-section" style="display: none;">
                <label for="phone_otp" class="form-label" style="color: white;">OTP:</label>
                <div class="input-group" style="width: 300px;">
                    <input type="text" id="phone_otp" name="phone_otp" class="form-control" required>
                    <button type="button" class="btn btn-secondary me-2" onclick="verifyOtp('phone')">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" id="phone-resend-button" onclick="requestOtp('phone')" style="display: none;">ขอใหม่</button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="background-color: #41e0cf;">Register</button>
        </form>
    </div>

    <script>

        

    </script>

</body>

</html>