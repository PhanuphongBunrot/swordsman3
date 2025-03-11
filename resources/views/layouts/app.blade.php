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

    <!-- เรียกใช้ไอคอนจาก Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>



</head>

<body style="background-color:rgb(15, 37, 35);  font-family: 'Roboto', sans-serif;">

    <style>
        
            /* ปรับสไตล์สำหรับปุ่มเข้าสู่ระบบ */
            .btn:hover {
                background-color: #48C9B0;
                /* สีเมื่อเมาส์วางบนปุ่ม */
            }

            .btn-group-vertical {
                display: flex;
                flex-direction: column;
                align-items: center;
                /* ให้ปุ่มทั้งหมดอยู่กลาง */
                justify-content: center;
            }

                /* ปุ่ม Social Login ทั่วไป */
       .social-login-btn {
            display: flex;
            width: 100%; 
            max-width: 230px;
            justify-content: flex-start; 
            align-items: center; 
            padding: 10px;
            border-radius: 8px;
            margin-bottom:10px;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); 
            font-size: 17px;
            text-align: left; 
        }

            /* เอฟเฟกต์นูนเมื่อ Hover */
            .social-login-btn:hover {
                transform: translateY(-3px); /* เลื่อนขึ้นเล็กน้อยให้ดูนูน */
                box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3); /* เพิ่มเงาให้ดูมีมิติ */
                color: inherit !important; /* คงสีตัวอักษรเดิม */
                
            }
            .google-btn {
                border: 1px solid rgb(0, 51, 133);
                color: #000;
                background-color: #fff;
            }

            .facebook-btn {
                background-color: #0866FF;
                color: white;
            }

            .social-btn-content {
                display: flex;
                align-items: center;
            }

            .social-icon {
                width: 30px;
                margin-right: 10px;
            }

            /* ปรับขนาดของปุ่ม Apple Sign In */
            .apple-sign-in-button {
                width: 250px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                border-radius: 8px;
                padding: 0px 10px;
            }
              /* เอฟเฟกต์นูนเมื่อ Hover */
            .apple-sign-in-button:hover {
                transform: translateY(-3px); /* เลื่อนขึ้นเล็กน้อยให้ดูนูน */
                box-shadow: 0 6px 10px transparent; /* เพิ่มเงาให้ดูมีมิติ */
                
            }

            /* ปุ่มล็อกอินด้วยอีเมล */
            .email-login-btn {
                background-color: rgb(0, 193, 174);
                color: white;
                font-size: 16px;
                margin-top: 15px;
            }

            .email-login-btn:hover {
                background-color: #48C9B0;
            }

            /* เพิ่มการจัดแนวของข้อความ */
            .text-center {
                text-align: center;
            }

            /* ปรับการจัดตำแหน่งและขนาดในรูปแบบ flex */
            .d-flex {
                display: flex;
            }

            /* แบ่งเป็นซ้ายและขวา */
            .form-left,
            .form-right {
                flex: 1;
            }

            /* ปรับช่องว่างระหว่างสองฝั่ง */
            .pr-3 {
                padding-right: 15px;
            }

            .pl-3 {
                padding-left: 15px;
            }

            .w-50 {
                width: 50%;
            }
        
        @media (max-width: 767px) {

            .navbar-brand img {
                width: 40px;
                height: 40px;
            }

            .btn-login {
                width: 30%;
                text-align: center;
                margin-left: auto;
                margin-top: 5px;
                margin-bottom: 5px;
                padding: 2px;
            }

            .modal-dialog {
                max-width: 90%;
                margin: 0  auto;
            }

            .modal-title {
                font-size: 14px;
            }

            .form-group label {
                font-size: 10px;
            }

            .form-control {
                font-size: 10px;
                padding: 6px;
            }

            .email-login-btn {
                font-size: 10px;
                padding: 8px;
            }

            /* ปรับปุ่ม Social Login */
            .social-login-btn {
                width: 150px;
                padding: 3px;
            }

            .social-btn-content {
                font-size: 10px;
            }

            .social-icon {
                width: 24px;
            }

            .apple-sign-in-button {
                width: 170px;
                height: 30px;
            }

          
            .form-left, .form-right {
                width: 100%;
                padding: 0;
            }

            .pr-3, .pl-3 {
                padding: 0;
            }

            .w-50 {
                width: 100%;
            }
            .form-left p{
                font-size:10px;
            }


        }
        
   
    

    </style>

    <!-- {{-- Navbar สวย ๆ จาก Bootstrap --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" width="60" height="50" class="d-inline-block align-top" alt="" loading="lazy">
            <a class="navbar-brand" href="#"> Exp Topup</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="#">เข้าสู่ระบบ หรือ ลงทะเบียน</a></li>
                </ul>
            </div>
        </div>
    </nav> -->
    @if(session('username'))
    <nav class="navbar navbar-expand-lg" style="background-color:#000;border-bottom: 1px solid #41e0cf;padding:1px;">
        <div class="container">
            <!-- โลโก้ -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" width="45" height="45" class="d-inline-block align-top" alt="" loading="lazy">
                <h1 class="ms-2 mb-0 d-md-block" style="color: #41e0cf; font-size: 22px;">EXP TOPUP</h1>
            </a>

            <!-- ปุ่ม Toggle สำหรับมือถือ -->
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list" style="font-size: 24px; color: #41e0cf;"></i>
            </button>

            <!-- เมนู -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span style="color: #fff;">{{session('username')}}</span>
                        <span style="color: #fff;">{{session('amount')}}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-login" style="color: #000; background-color:#41e0cf;">
                            <i class="bi bi-box-arrow-right"></i>  ออกจากระบบ
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @else
    <nav class="navbar navbar-expand-lg" style="background-color:#000;border-bottom: 1px solid #41e0cf;padding:1px;">
        <div class="container">
            <!-- โลโก้ -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" width="45" height="45" class="d-inline-block align-top" alt="" loading="lazy">
                <h1 class="ms-2 mb-0 d-md-block" style="color: #41e0cf; font-size: 22px;">EXP TOPUP</h1>
            </a>

            <!-- ปุ่ม Toggle สำหรับมือถือ -->
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list" style="font-size: 24px; color: #41e0cf;"></i>
            </button>

            <!-- เมนู -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-login" style="color: #000;background-color:#41e0cf;" href="javascript:void(0)" onclick="openModal()">เข้าสู่ระบบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @endif






    <!-- โมเดล -->
    <div class="modal" tabindex="-1" id="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100">เข้าสู่ระบบ หรือ ลงทะเบียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login" action="{{ route('login_check') }}" method="POST" class="d-flex">
                        @csrf
                        <!-- ซ้าย: ช่องกรอกอีเมล์และพาสเวิร์ด -->
                        <div class="form-left w-50 pr-3">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>

                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-block email-login-btn mb-3">
                                    Login with Email
                                </button>
                            </div>
                            <p class="text-center">ยังไม่มีบัญชี?<a href="{{ asset('/register') }}">สร้างบัญชี</a></p>
                        </div>

                        <!-- ขวา: ปุ่มล็อกอินด้วยโซเชียล -->
                        <div class="form-right w-50 pl-3">

                            <!-- ปุ่มเข้าสู่ระบบทางสังคม (Google, Facebook, Apple) -->
                            <div class="btn-group-vertical d-flex justify-content-center mb-3" role="group">
                                <a href="{{ url('/auth/google') }}" class="social-login-btn google-btn">
                                    <div class="social-btn-content">
                                        <img src="{{ asset('images/google.png') }}" alt="Google" class="social-icon">
                                        <span>Sign in with Google</span>
                                    </div>
                                </a>

                                <a href="{{ url('/auth/facebook') }}" class="social-login-btn facebook-btn">
                                    <div class="social-btn-content">
                                        <img src="{{ asset('images/2023_Facebook_icon.png') }}" alt="Facebook" class="social-icon">
                                        <span>Sign in with Facebook</span>
                                    </div>
                                </a>

                                <!-- ปุ่ม Apple Sign In -->
                                <div class="apple-sign-in-button" id="appleid-signin"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  


    <div class="container mt-4">
        @yield('content')
    </div>


    <!-- JavaScript สำหรับเปิดและปิดโมเดล -->
    <script>
        function openModal() {
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'), {
                keyboard: false
            });
            myModal.show();
        }

        const randomState = Math.random().toString(36).substring(2); // สร้างค่า state แบบสุ่ม
        sessionStorage.setItem("oauth_state", randomState); // 

        AppleID.auth.init({
            clientId: "com.expup.swordsman3.login", // App ID
            scope: "name email",
            redirectURI: "https://exptopupdev.stationidea.com/auth/apple/callback",
            state: randomState,
            usePopup: false
        });
    </script>



</body>

</html>