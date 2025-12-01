@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Menu</h4>
    <form action="{{ route('menu.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection