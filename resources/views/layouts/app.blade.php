<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MakLele Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      display: flex;
      min-height: 100vh;
      margin: 0;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #2196F3;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 0;
    }

    .sidebar img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      background: white;
      padding: 10px;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .sidebar h4 {
      font-weight: 600;
      margin-bottom: 40px;
      color: white;
    }

    .menu {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .menu a {
      width: 100%;
      color: white;
      padding: 12px 30px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 16px;
      text-decoration: none;
      transition: 0.3s;
    }

    .menu a:hover {
      background-color: rgba(255, 255, 255, 0.15);
      padding-left: 40px;
    }

    /* Main content */
    .main-content {
      flex: 1;
      padding: 40px 50px;
    }

    .card {
      border: none;
      border-radius: 10px;
    }

    .card h5 {
      font-weight: 600;
      color: #6c5b5b;
    }
  </style>
</head>


<body>
  <div class="sidebar">
    <img src="{{ asset('images/logo_kasir.png') }}" alt="Logo">
    <div class="menu">
      <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door"></i> Dashboard
      </a>
      <a href="/produk" class="{{ request()->is('produk*') ? 'active' : '' }}">
        <i class="bi bi-box"></i> Menu
      </a>
      <a href="/transaksi" class="{{ request()->is('transaksi*') ? 'active' : '' }}">
        <i class="bi bi-wallet2"></i> Transaksi
      </a>
      <a href="/laporan" class="{{ request()->is('laporan*') ? 'active' : '' }}">
        <i class="bi bi-clipboard-data"></i> Laporan
      </a>
<a href="{{ route('logout') }}" class="btn btn-sm btn-logout">Logout</a>
    </div>
  </div>

    </div>
  </div>

  <div class="main-content">
    @yield('content')
  </div>
  @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
