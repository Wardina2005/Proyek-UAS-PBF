@extends('layouts.app')

@section('content')
<h3 class="mb-4">Edit Produk</h3>

<a href="{{ route('produk.index') }}" class="btn btn-secondary mb-3">
    ← Kembali ke Manajemen Produk
</a>

<form method="POST"
      action="{{ route('produk.update', $produk->id) }}"
      enctype="multipart/form-data"
      class="bg-white p-4 rounded shadow-sm">

    @csrf
    @method('PUT')

    {{-- NAMA --}}
    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text"
               name="nama_produk"
               value="{{ old('nama_produk', $produk->nama_produk) }}"
               class="form-control"
               required>
    </div>

    {{-- KATEGORI --}}
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $k)
                <option value="{{ $k->id }}"
                    {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }}>
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
               value="{{ old('harga', $produk->harga) }}"
               class="form-control"
               required>
    </div>

    {{-- STOK --}}
    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number"
               name="stok"
               value="{{ old('stok', $produk->stok) }}"
               class="form-control"
               required>
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi"
                  class="form-control"
                  rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
    </div>

    {{-- FOTO --}}
    <div class="mb-4">
        <label class="form-label">Foto Produk</label>

        @if($produk->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$produk->foto) }}"
                     class="img-thumbnail"
                     style="max-width: 200px;">
                <p class="text-muted mt-1">Foto saat ini</p>
            </div>
        @endif

        <input type="file"
               name="foto"
               class="form-control"
               accept="image/*">

        <small class="text-muted">
            Kosongkan jika tidak ingin mengganti foto
        </small>
    </div>

    <button class="btn btn-primary">
        Update Produk
    </button>
</form>
@endsection
