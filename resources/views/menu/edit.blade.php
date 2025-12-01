@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Menu</h4>
    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama" value="{{ $menu->nama }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $menu->harga }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" value="{{ $menu->stok }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection