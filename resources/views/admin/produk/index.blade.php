@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-2">Manajemen Produk</h3>
<p class="text-muted mb-4">Kelola data produk</p>

{{-- SEARCH --}}
<form method="GET" action="{{ route('produk.index') }}" class="mb-4">
    <div class="row g-2 align-items-center">
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari nama produk...">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>

        <div class="col-md-6 text-end">
            <a href="{{ route('produk.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>
    </div>
</form>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Foto</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($products as $p)
                <tr>
                    <td class="text-center">
                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                    </td>

                    <td class="text-center">
                        @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}"
                                 width="65" class="rounded">
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $p->nama_produk }}</td>
                    <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ Str::limit($p->deskripsi, 60) }}</td>
                    <td>Rp {{ number_format($p->harga,0,',','.') }}</td>
                    <td>{{ $p->stok }}</td>

                    <td class="text-center">
                        <a href="{{ route('produk.edit', $p->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('produk.destroy', $p->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Hapus produk?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Produk tidak ditemukan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

@if($products->hasPages())
<div class="mt-4 d-flex justify-content-center">
    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@endif

@endsection
