<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Pecel Lele</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; }
        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #007bff;
            position: fixed;
            top: 0; left: 0;
            padding-top: 60px;
        }
        .sidebar a {
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        .content {
            margin-left: 230px;
            padding: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">💰 Kasir Pecel Lele</span>
<a href="{{ route('logout') }}" class="btn btn-sm btn-logout">Logout</a>
    Logout
</a>
    </div>
</nav>

<div class="sidebar">
    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('menu.index') }}">🍽️ Kelola Menu</a>
    <a href="{{ route('transaksi.index') }}">🛒 Transaksi</a>
    <a href="{{ route('laporan.index') }}">📊 Laporan</a>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts') 

</body>
</html>