@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="fw-bold mb-1">Manajemen Kategori</h3>
        <p class="text-muted mb-0">Kelola data kategori produk</p>
    </div>

    {{-- 🔙 TOMBOL KEMBALI (HANYA SAAT SEARCH) --}}
    @if(request('search'))
        <a href="{{ route('kategori.index') }}"
           class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    @endif
</div>

{{-- 🔍 SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari kategori...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100">
                <i class="fas fa-search me-1"></i> Cari
            </button>
        </div>
    </div>
</form>

{{-- ➕ TAMBAH KATEGORI (DIRAPIKAN) --}}
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('kategori.store') }}">
            @csrf

            <div class="row g-2 align-items-center">
                <div class="col-md-8">
                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           placeholder="Masukkan nama kategori"
                           required>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-plus me-1"></i> Tambah Kategori
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- 📦 TABLE --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>Nama Kategori</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($kategoris as $kategori)
                <tr>
                    <td class="text-center">
                        {{ $kategoris->firstItem() + $loop->index }}
                    </td>

                    <td>{{ $kategori->nama_kategori }}</td>

                    <td class="text-center">
                        {{-- ❌ EDIT DIHAPUS --}}
                        <form action="{{ route('kategori.destroy', $kategori->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        Data kategori tidak ditemukan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- 📄 PAGINATION --}}
<div class="mt-3 d-flex justify-content-center">
    {{ $kategoris->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>

@endsection
