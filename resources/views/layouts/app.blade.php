<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- เรียกใช้ Vite (ถ้าใช้ Laravel 10 ขึ้นไป) --}}
    @vite(['resources/js/app.js'])
    <!-- เพิ่ม Bootstrap CDN ใน <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

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

    <nav class="navbar navbar-expand-lg " style="background-color: #6439FF;">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" width="60" height="60" class="d-inline-block align-top" alt="" loading="lazy">
            <a class="navbar-brand mx-2" href="#">
                <h1 style="color: white;"> Exp</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn" style="background-color:#4F75FF; color:white; font-weight: bold;" href="javascript:void(0)" onclick="openModal()">เข้าสู่ระบบ หรือ ลงทะเบียน</a>

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
                            <a href="{{ url('/auth/apple') }}" class="btn btn-light border">
                                <img src="{{ asset('images/apple.png') }}" alt="Apple" style="width: 30px;">
                            </a>
                        </div>


                        <button type="submit" class="btn btn-primary btn-block ">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- โหลด JavaScript --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- JavaScript สำหรับเปิดและปิดโมเดล -->
    <script>
        function openModal() {
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'), {
                keyboard: false
            });
            myModal.show();
        }
    </script>
</body>

</html>