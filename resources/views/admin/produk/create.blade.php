@extends('layouts.app')

@section('content')
<h3 class="mb-4">Tambah Produk</h3>

<a href="{{ route('produk.index') }}" class="btn btn-secondary mb-3">
    ← Kembali ke Manajemen Produk
</a>

{{-- TAMPILKAN ERROR VALIDASI --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ route('produk.store') }}"
      enctype="multipart/form-data"
      class="bg-white p-4 rounded shadow-sm">

    @csrf

    {{-- NAMA PRODUK --}}
    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text"
               name="nama_produk"
               value="{{ old('nama_produk') }}"
               class="form-control"
               required>
    </div>

    {{-- KATEGORI (WAJIB) --}}
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $k)
                <option value="{{ $k->id }}"
                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- HARGA --}}
    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number"
               name="harga"
               value="{{ old('harga') }}"
               class="form-control"
               required>
    </div>

    {{-- STOK --}}
    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number"
               name="stok"
               value="{{ old('stok') }}"
               class="form-control"
               required>
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi"
                  class="form-control"
                  rows="3">{{ old('deskripsi') }}</textarea>
    </div>

    {{-- FOTO PRODUK --}}
    <div class="mb-4">
        <label class="form-label">Foto Produk</label>
        <input type="file"
               name="foto"
               class="form-control"
               accept="image/*">
        <small class="text-muted">
            Format JPG / PNG (Max 2MB)
        </small>
    </div>

    <button class="btn btn-success">
        Simpan Produk
    </button>
</form>
@endsection
