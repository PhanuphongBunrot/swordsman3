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

    
</head>

<body style="background-color:rgb(15, 37, 35);  font-family: 'Roboto', sans-serif;">

    <style>
        @media (max-width: 767px) {
            .navbar-brand h1 {
           
        }

       
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
            padding:2px;
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

    <!-- โมเดล -->
    <div class="modal" tabindex="-1" id="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เข้าสู่ระบบ หรือ ลงทะเบียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- เนื้อหาของฟอร์ม หรือข้อมูลที่คุณต้องการแสดงในโมเดล -->
                    <form id="login" action="{{ route('login_check') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div id="recheck" style="color: red; margin-bottom: 15px;"></div>
                        <div class="btn-group d-flex justify-content-center mb-3" role="group">
                            <a href="{{ url('/auth/google') }}" class="btn btn-light border">
                                <img src="{{ asset('images/google.png') }}" alt="Google" style="width: 30px;">
                            </a>
                            <a href="{{ url('/auth/facebook') }}" class="btn btn-light border">
                                <img src="{{ asset('images/facebook.png') }}" alt="Facebook" style="width: 30px;">
                            </a>
                            <a class="btn btn-light border" id="appleid-signin" data-mode="center-align">
                                <img src="{{ asset('images/apple.png') }}" alt="Apple" style="width: 20px;">
                            </a>
                        </div>
                        
                            <p>ยังไม่มีบัญชี?<a href="{{ asset('/register') }}">สร้างบัญชี</a></p>
                        <button type="submit" class="btn btn-primary btn-block ">Login</button>
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