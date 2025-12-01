@extends('layouts.app')

@section('content')
<div class="container">
    <h4>🍽️ Kelola Menu</h4>
    <a href="{{ route('menu.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($menu as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nama }}</td>
                <td>Rp{{ number_format($m->harga) }}</td>
                <td>{{ $m->stok }}</td>
                <td>
                    <a href="{{ route('menu.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('menu.destroy', $m->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection