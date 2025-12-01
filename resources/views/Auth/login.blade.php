<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Maklele</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #816E6E;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            width: 360px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-box img {
            width: 80px;
            margin-bottom: 10px;
        }
        .login-box h4 {
            color: #0277D9;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
            background-color: #f0f0f0;
        }
        .btn-login {
            background-color: #0277D9;
            color: white;
            font-weight: bold;
            border-radius: 8px;
        }
        .btn-login:hover {
            background-color: #0277D9;
        }
        .text-error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .forgot-link {
            font-size: 13px;
            color: #6c757d;
            text-decoration: none;
        }
        .forgot-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-box">
    <img src="{{ asset('images/logo_kasir.png') }}" alt="Logo Maklele" style="width: 150px; height: auto;">


    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="text-error">{{ session('error') }}</div>
    @endif

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('auth') }}">
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text bg-light">
                <i class="bi bi-person"></i>
            </span>
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        </div>

        <div class="input-group mb-2">
            <span class="input-group-text bg-light">
                <i class="bi bi-lock"></i>
            </span>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-login w-100 mt-2">MASUK</button>

        <div class="mt-3">
            <a href="{{ route('forgot') }}" class="forgot-link">Lupa password</a>
        </div>

    </form>
</div>

</body>
</html>
