@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h2 class="fw-bold mb-4">Menu</h2>

  <div class="d-flex justify-content-end mb-3">
    <style>
.btn-green {
  background-color: #48C973;
  color: white;
  font-weight: 600;
  border-radius: 8px;
  transition: 0.3s;
}
.btn-green:hover {
  background-color: #48C973;
  color: white;
}
    </style>
    <a href="{{ route('produk.create') }}" class="btn btn-green fw-semibold">
      Tambah menu
    </a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered text-center align-middle">
        <thead style="background-color:#f5f5f5;">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($menus as $index => $menu)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $menu->nama }}</td>
            <td>Rp.{{ number_format($menu->harga,0,',','.') }}</td>
            <td style="color: {{ $menu->stok < 3 ? 'red' : 'black' }};">
    {{ $menu->stok }}
</td>

            <td>
              <a href="{{ route('produk.edit', $menu->id) }}" class="text-primary me-3">
                <i class="bi bi-pencil-square fs-5"></i>
              </a>
              <button type="button" 
                      onclick="openDeleteModal('{{ route('produk.destroy', $menu->id) }}')" 
                      class="btn btn-link p-0 m-0 text-danger">
                <i class="bi bi-trash3-fill fs-5"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="confirmDeleteModal" 
     style="display:none; position: fixed; top:0; left:0; width:100%; height:100%;
            background-color: rgba(0,0,0,0.3); z-index:9999; justify-content:center; align-items:center;">
  <div style="background:#D9D9D9; border-radius:20px; padding:30px; width:400px; text-align:center;">
    <h5 style="font-weight:700; color:#000;">Apakah anda yakin ingin menghapus?</h5>
    <form id="deleteForm" method="POST">
      @csrf
      @method('DELETE')
      <div style="margin-top:20px; display:flex; justify-content:center; gap:20px;">
        <button type="submit" 
                style="background:#E44D26; color:white; font-weight:700; border:none; border-radius:10px;
                       padding:10px 30px; cursor:pointer;">
          HAPUS
        </button>
        <button type="button" 
                onclick="closeModal()" 
                style="background:#7B6B6B; color:white; font-weight:700; border:none; border-radius:10px;
                       padding:10px 30px; cursor:pointer;">
          BATAL
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  let deleteForm = document.getElementById('deleteForm');
  function openDeleteModal(url) {
    deleteForm.action = url;
    document.getElementById('confirmDeleteModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('confirmDeleteModal').style.display = 'none';
  }
</script>
@endsection
