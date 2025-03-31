<!DOCTYPE html>
<html lang="th">

<head>
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXP UP เติมเงิน</title>

    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600;700&display=swap&subset=thai" rel="stylesheet">



    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


    <!-- เพิ่ม Bootstrap CDN ใน <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ตัวอย่างการเพิ่มฟอนต์จาก Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- เรียกใช้ไอคอนจาก Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>

       <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<!-- <body style="background-color:rgb(15, 37, 35);  font-family: 'Roboto', sans-serif;"> -->
<body>

    <style>

           body {
            font-family: 'Prompt', sans-serif;
            background: linear-gradient(135deg, #ffffff, #f7f7f7, #eaeaea);

          /* background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); */

        }


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
                font-size: 17px;
                white-space: nowrap;
            }

            .facebook-btn {
                background-color: #0866FF;
                color: white;
                font-size: 17px;
                white-space: nowrap;
            }

            .social-btn-content {
                display: flex;
                align-items: center;
            }

            .social-icon {
                width: 30px;
                /* margin-right: 10px; */
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

            
        /* ส่วนที่ล็อกอินแล้ว */
        /* สไตล์สำหรับส่วนข้อมูลผู้ใช้ */
        .navbar-user-info {
            display: flex;
            justify-content: flex-end;
        }

        .user-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .user-info-item {
            text-align: right;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }

        .user-balance {
            font-size: 20px;
            font-weight: bold;
            color: #ffc107; /* สีเหลือง */
        }

     

        .logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
            padding:0px;
            margin-bottom:1px;
        }

        .logout-btn img {
            width: 100px; /* ปรับขนาดปุ่ม */
            /* filter: drop-shadow(0px 0px 10px #41e0cf);  */
        }

        .logout-btn:hover img {
            transform: scale(1.1); /* ขยายปุ่มเมื่อ hover */
            filter: drop-shadow(0px 0px 15px #41e0cf); /* เงาเข้มขึ้น */
        }

        .modal-content {
        background: linear-gradient(135deg, #ffffff 0%, #f7f7f7 100%); /* สีขาวไฮโซแบบไล่เฉด */
        border-radius: 16px; /* ขอบโค้งมน */
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2); /* เงาหรู */
        border: none;
        width: auto;
        margin:0 auto;
        }

        .modal-body{
            padding-left:30px;
        }
            
        @media (max-width: 767px) {

            .navbar-brand img {
                width: 40px;
                height: 40px;
            }

            .btn-login {
                width: 100%;
                text-align: center;
                margin-left: auto;
                margin-top: 5px;
                margin-bottom: 5px;
                padding: 2px 5px !important;
                font-size:13px;
            }
              .modal-body{
                padding-left:10px;
            }

            .forgetpassword-login-text{
                font-size:10px;
            }

           @media (max-width: 767px) and (orientation: landscape) {
            .modal-dialog {
                max-width: 80% !important; /* ปรับให้กว้างขึ้นเพื่อให้ดูสมดุล */
                margin: auto !important; /* จัดให้กลางจอ */
                top: 50% !important; /* ดันขึ้นมาตรงกลาง */
                transform: translateY(-50%) !important; /* ทำให้ Modal อยู่ตรงกลางจอ */
            }
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
                padding-left: 10px;
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

            /*หลังจากล้อกอิน*/ 
            .user-name {
            font-size: 12px; 
            }

            .user-balance {
                font-size: 14px; /* ลดขนาดยอดเงิน */
            }

            .logout-btn img {
                width: 60px; /* ลดขนาดปุ่มออกจากระบบ */
            }


        }
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
    <nav class="navbar navbar-expand-lg" style="background-color:#000; border-bottom: 1px solid #41e0cf; padding: 1px;">
    <div class="container">
        <!-- โลโก้ -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/user') }}">
            <img src="{{ asset('images/logo.png') }}" width="45" height="45" class="d-inline-block align-top" alt="" loading="lazy">
            <h1 class="ms-2 mb-0 d-md-block" style="color: #41e0cf; font-size: 22px;">EXP TOPUP</h1>
        </a>

        <!-- ปุ่ม Toggle HamBurgerBar สำหรับมือถือ -->
        <!-- <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list" style="font-size: 24px; color: #41e0cf;"></i>
        </button> -->

        <!-- เมนู -->
       <div class="navbar-user-info justify-content-end">
    <ul class="user-info-list text-end d-flex flex-column align-items-end">
        <li class="user-info-item">
            <span class="user-name">{{ session('username') }}</span>
        </li>
        <!-- <li class="user-info-item">
    <span class="user-phone text-white">📱 {{ session('phone') ?? 'ไม่ระบุ' }}</span>
</li> -->

        <li class="user-info-item">
            <span class="user-balance">฿{{ number_format(session('amount'), 2) }}</span>
        </li>
        <li class="user-info-item ">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <img src="{{ asset('images/logout-button-image.png') }}" alt="Logout">
                </button>
            </form>
        </li>
    </ul>
</div>

</nav>

    @else
    <nav class="navbar navbar-expand-lg" style="background-color:#000;border-bottom: 1px solid #41e0cf;padding:1px;">
        <div class="container">
            <!-- โลโก้ -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" width="45" height="45" class="d-inline-block align-top" alt="" loading="lazy">
                <h1 class="ms-2 mb-0 d-md-block" style="color: #41e0cf; font-size: 22px;">EXP TOPUP</h1>
            </a>

            <!-- ปุ่ม Toggle สำหรับมือถือ -->
            <!-- <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list" style="font-size: 24px; color: #41e0cf;"></i>
            </button> -->

            <!-- เมนู -->
           <div class="justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-login"
                        href="javascript:void(0)"
                        onclick="openModal()"
                        style="color: #000; background-color:#41e0cf; filter: drop-shadow(4px 4px 8px rgba(0, 255, 255, 0.2));">
                        เข้าสู่ระบบ
                    </a>
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

                             <!-- ช่องลืมรหัสผ่าน -->
                            <div class="forgetpassword-login-text text-end">
                            <a href="{{ route('password.reset') }}" class="text-decoration-none" style="color: black;">
                                ลืมรหัสผ่าน?
                            </a>
                            </div>


                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-block email-login-btn mb-3" style="color: #000; background-color:#41e0cf; filter: drop-shadow(4px 4px 8px rgba(0, 255, 255, 0.4));">
                                    Login with Email
                                </button>
                            </div>
                            <p class="text-center">ยังไม่มีบัญชี?<a href="{{ asset('/register') }}">สร้างบัญชี</a></p>
                        </div>

                        <!-- ขวา: ปุ่มล็อกอินด้วยโซเชียล -->
                        <div class="form-right w-50 ">

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

   @if ($errors->has('login_error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // เปิด Modal Login ถ้ายังไม่เปิด
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'), {
                keyboard: false,
                backdrop: 'static' // ทำให้ modal ไม่ปิดเอง
            });
            myModal.show();

           
            Swal.fire({
                // icon: 'error',
                title: '❌ อีเมลหรือรหัสผ่านไม่ถูกต้อง!',
                text: 'โปรดลองล็อกอินอีกครั้ง',
                confirmButtonColor: '#ff4444',
                confirmButtonText: 'ตกลง',
                customClass: {
                    popup: 'custom-swal-error-popup',
                    title: 'custom-swal-error-title',
                    icon: 'custom-swal-error-icon',
                    confirmButton: 'custom-swal-error-button',
                    content: 'custom-swal-error-text'
                }
            });
        });
    </script>
    @endif






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