@extends('layouts.app')

@section('content')
<h3 class="mb-4">Edit Kategori</h3>

<a href="{{ route('admin.kategori.index') }}"
   class="btn btn-secondary mb-3">
   ← Kembali
</a>

<form method="POST"
      action="{{ route('admin.kategori.update', $kategori->id) }}"
      class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text"
               name="nama_kategori"
               value="{{ $kategori->nama_kategori }}"
               class="form-control"
               required>
    </div>

    <button class="btn btn-primary">
        Update
    </button>
</form>
@endsection
