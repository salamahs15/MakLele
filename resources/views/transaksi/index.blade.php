@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="fw-bold mb-4">Transaksi</h2>

  {{-- Pilih Produk --}}
  <div class="card p-3 mb-4">
    <form action="{{ route('transaksi.tambahDropdown') }}" method="GET" class="d-flex gap-3">
      <select name="produk_id" class="form-select" required>
        <option value="">-- Pilih Produk --</option>
        @foreach ($menus as $menu)
          <option value="{{ $menu->id }}">
            {{ $menu->nama }} - Rp {{ number_format($menu->harga,0,',','.') }}
          </option>
        @endforeach
      </select>

      <button class="btn btn-success fw-bold px-4" style="background:#48C973; border:none;">
        Tambah Pesanan
      </button>
    </form>
  </div>

  {{-- Keranjang --}}
  @if(session('keranjang'))
  <div class="mt-4">
    <table class="table table-bordered text-center align-middle">
      <thead style="background-color:#f5f5f5;">
        <tr>
          <th>Nama</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php $total = 0; @endphp
        @foreach($keranjang as $id => $item)
          @php
            $subtotal = $item['harga'] * $item['jumlah'];
            $total += $subtotal;
          @endphp
          <tr>
            <td>{{ $item['nama'] }}</td>

            <td style="width:120px;">
                <input 
                  type="number" 
                  class="form-control text-center updateJumlah" 
                  data-id="{{ $id }}" 
                  min="1" 
                  value="{{ $item['jumlah'] }}"
                  data-old-value="{{ $item['jumlah'] }}">
            </td>

            <td class="subtotal">
                Rp {{ number_format($subtotal, 0, ',', '.') }}
            </td>

            <td>
              <a href="{{ route('transaksi.hapus', $id) }}" class="text-danger fs-5">
                <i class="bi bi-trash3-fill"></i>
              </a>
            </td>

          </tr>
        @endforeach
      </tbody>

      <tfoot>
        <tr style="background:#eafbea;">
          <th colspan="2">Total</th>
          <th colspan="2" id="total" data-value="{{ $total }}">
            Rp {{ number_format($total, 0, ',', '.') }}
          </th>
        </tr>
      </tfoot>
    </table>

    {{-- Form Pembayaran --}}
    <form action="{{ route('transaksi.simpan') }}" method="POST" class="text-center mt-3">
      @csrf
      <div class="w-25 mx-auto">
        <input 
          type="number" 
          name="tunai" 
          id="tunai" 
          placeholder="Masukkan uang tunai" 
          class="form-control mb-2" 
          required
        >

        @if (session('error'))
          <div class="alert alert-danger py-2">{{ session('error') }}</div>
        @endif

        <p class="fw-bold mt-2">Kembalian: <span id="kembalian">Rp 0</span></p>

        <button type="submit" class="btn fw-bold w-100" style="background:#48C973; color:white;">
          Simpan Transaksi
        </button>
      </div>
    </form>
  </div>
  @endif
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Script --}}
<script>
// Ambil elemen
const totalEl = document.getElementById('total');
const tunaiInput = document.getElementById('tunai');
const kembalianText = document.getElementById('kembalian');

// Hitung kembalian
if (tunaiInput) {
  tunaiInput.addEventListener('input', function() {
    const tunai = parseInt(this.value) || 0;
    const total = parseInt(totalEl.dataset.value || 0);
    const kembalian = tunai - total;

    if (kembalian < 0) {
      kembalianText.textContent = "Uang kurang!";
      kembalianText.style.color = "red";
    } else {
      kembalianText.textContent = "Rp " + kembalian.toLocaleString('id-ID');
      kembalianText.style.color = "green";
    }
  });
}

// UPDATE JUMLAH AJAX + VALIDASI STOK
document.querySelectorAll('.updateJumlah').forEach(input => {

  // Simpan nilai lama
  input.dataset.oldValue = input.value;

  input.addEventListener('change', function() {
    const id = this.dataset.id;
    const jumlahBaru = this.value;
    const oldValue = this.dataset.oldValue;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/transaksi/update/${id}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify({ jumlah: jumlahBaru })
    })
    .then(res => res.json())
    .then(data => {

      // VALIDASI STOK
      if (!data.success) {
        alert(data.message);       
        this.value = oldValue;    
        return;
      }

      
      this.dataset.oldValue = jumlahBaru;

     
      this.closest('tr').querySelector('.subtotal')
        .textContent = "Rp " + data.subtotal.toLocaleString('id-ID');

      
      totalEl.textContent = "Rp " + data.total.toLocaleString('id-ID');
      totalEl.dataset.value = data.total;

     
      const tunai = parseInt(tunaiInput.value) || 0;
      const kembalian = tunai - data.total;

      kembalianText.textContent =
        kembalian < 0 ? "Uang kurang!" : "Rp " + kembalian.toLocaleString('id-ID');

      kembalianText.style.color = kembalian < 0 ? "red" : "green";

    });
  });
});
</script>
@endsection
