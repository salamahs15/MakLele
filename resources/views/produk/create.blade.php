<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #F8F9FA;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Poppins', sans-serif;
    }
    .card {
      width: 400px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      background: #fff;
      padding: 25px 30px;
    }
    h4 {
      text-align: center;
      font-weight: 700;
      color: #000000ff;
      margin-bottom: 25px;
    }
    label {
      font-weight: 600;
      color: #555;
    }
    input {
      border-radius: 10px !important;
    }
    .btn {
      width: 48%;
      border-radius: 10px;
      font-weight: 600;
      padding: 10px 0;
      transition: 0.3s;
    }
    .btn-submit {
      background-color: #48C973;
      color: white;
    }
    .btn-submit:hover {
      background-color: #48C973;
    }
    .btn-back {
      background-color: #816E6E;
      color: white;
    }
    .btn-back:hover {
      background-color: #816E6E;
    }
  </style>
</head>
<body>
  <div class="card">
    <h4>Tambah Menu</h4>
    <form action="{{ route('produk.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="nama">Nama Menu</label>
        <input type="text" class="form-control" name="nama" required>
      </div>
      <div class="mb-3">
        <label for="harga">Harga</label>
        <input type="number" class="form-control" name="harga" required>
      </div>
      <div class="mb-3">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" name="stok" required>
      </div>
      <div class="d-flex justify-content-between mt-3">
  <button type="submit" class="btn btn-submit">Simpan</button>
  <a href="{{ route('produk.index') }}" class="btn btn-back">Batal</a>
</div>
    </form>
  </div>
</body>
</html>
