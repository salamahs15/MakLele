<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #d9d9d9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            width: 430px;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .btn-reset {
            background-color: #48C973;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            font-size: 20px;
        }
        .btn-reset:hover {
            background-color: #48C973;
        }
        a {
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="box">

    <h2 class="text-center fw-bold mb-4">Reset Password</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('forgot.submit') }}" method="POST">
        @csrf

        <label class="fw-semibold">Email</label>
        <input type="email" name="email" class="form-control mb-3" required>

        <label class="fw-semibold">Password Baru</label>
        <input type="password" name="password" class="form-control mb-4" required>

        <button class="btn btn-reset w-100">Ubah Password</button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-primary">Kembali ke login</a>
        </div>

    </form>

</div>

</body>
</html>
