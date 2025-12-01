@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-left mb-4">Laporan Penjualan</h2>

    {{-- Filter tanggal --}}
    <form action="{{ route('laporan.filter') }}" method="GET" class="mb-4 d-flex justify-content-left">
        <input type="date" name="tanggal" value="{{ $tanggal ?? '' }}" class="form-control w-25 me-2">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    {{-- Tabel laporan --}}
    <table class="table table-bordered text-left align-middle">
        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>ID Transaksi</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $index => $t)
                <tr>
                    <td>{{ $t->created_at->format('d-m-Y') }}</td>
                    <td>{{ str_pad($t->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>Rp.{{ number_format($t->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Total penjualan --}}
    <h5 class="text-left mt-3 fw-bold">
        Total Penjualan : Rp. {{ number_format($total, 0, ',', '.') }}
    </h5>
</div>

<div class="text-left mb-3">
        <a href="{{ route('laporan.cetak', ['tanggal' => $tanggal ?? '']) }}" 
           class="btn btn-success" 
           target="_blank">
            Cetak Laporan
        </a>
    </div>
@endsection
