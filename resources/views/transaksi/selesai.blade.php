@extends('layouts.app')

@section('content')
<div class="container-fluid text-center mt-5">

  <div class="card mx-auto shadow-lg border-0" style="max-width: 600px; border-radius: 20px;">
    <div class="card-body py-5">

      <h2 class="fw-bold mb-4" style="color:#48C973;">Transaksi Selesai</h2>

      <table class="table table-borderless text-start fs-5 mx-auto" style="max-width: 400px;">
        <tr>
          <th>Total</th>
          <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <th>Tunai</th>
          <td>Rp {{ number_format($transaksi->tunai, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <th>Kembalian</th>
          <td>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
        </tr>
      </table>

      <div class="mt-4">
        <a href="{{ route('transaksi.index') }}" 
           class="btn fw-bold px-4" 
           style="background:#48C973; color:white; border-radius:10px;">
          Kembali
        </a>
      </div>

    </div>
  </div>

</div>
@endsection
