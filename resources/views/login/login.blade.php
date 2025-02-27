<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>



<body>
    <div class="login-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="display: block; margin: 0 auto 20px;width: 50px;" />
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
            <a href="{{ url('/auth/google') }}" class="btn btn-danger">
                Login with Google
            </a>
            <a href="{{ url('/auth/facebook') }}" class="btn btn-success">
                Login with facebook
            </a>


            <button type="submit" class="btn btn-primary btn-block ">Login</button>
        </form>
    </div>
</body>

</html>