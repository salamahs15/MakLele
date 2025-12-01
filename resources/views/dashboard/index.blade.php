@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="fw-bold mb-4">Dashboard</h2>

  <div class="row mb-4 justify-content-center">
    <div class="col-md-3">
      <div class="card shadow-sm text-center p-3" style="background-color:#E0E0E0;">
        <h5>Total Produk</h5>
        <h2 class="fw-bold" style="color:#6c5b5b;">{{ $totalProduk }}</h2>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm text-center p-3" style="background-color:#C8FACC;">
        <h5>Total Transaksi</h5>
        <h2 class="fw-bold" style="color:#6c5b5b;">{{ $totalTransaksi }}</h2>
      </div>
    </div>
  </div>

  <div class="card shadow-sm p-4">
    <h5 class="mb-3">Grafik Penjualan (6 bulan terakhir)</h5>
    <canvas id="salesChart" height="120"></canvas>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const labels = {!! json_encode($bulan) !!};
    const sales  = {!! json_encode($totalPenjualan) !!};

    console.log("Labels:", labels);
    console.log("Data:", sales);

    const ctx = document.getElementById('salesChart');

    if (!ctx) {
        console.error("Canvas tidak ditemukan!");
        return;
    }

    if (labels.length === 0) {
        console.warn("DATA LABEL KOSONG");
    }

    if (sales.length === 0) {
        console.warn("DATA GRAFIK KOSONG");
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: sales,
                borderColor: '#48C973',
                backgroundColor: 'rgba(72,201,115,0.12)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { grid: { display: false }},
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
