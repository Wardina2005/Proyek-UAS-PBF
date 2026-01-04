@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-2">
    <div>
        <h3 class="fw-bold mb-1">Produk</h3>
        <p class="text-muted">Temukan produk favoritmu</p>
    </div>

    {{-- 🔙 TOMBOL KEMBALI / RESET SEARCH --}}
    @if(request('search'))
        <a href="{{ route('user.produk') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    @endif
</div>

{{-- 🔍 SEARCH PRODUK --}}
<form method="GET"
      action="{{ route('user.produk') }}"
      class="mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari produk...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                <i class="fas fa-search me-1"></i> Cari
            </button>
        </div>
    </div>
</form>

{{-- 🛍️ CARD PRODUK --}}
<div class="row g-4">
@forelse($produks as $produk)
    <div class="col-md-3">
        <div class="dashboard-card h-100 d-flex flex-column">

            {{-- FOTO --}}
            <img src="{{ asset('storage/'.$produk->foto) }}"
                 class="img-fluid rounded mb-3"
                 style="height:180px;object-fit:cover">

            {{-- NAMA --}}
            <h6 class="fw-bold">{{ $produk->nama_produk }}</h6>

            {{-- KATEGORI --}}
            <small class="text-muted mb-1">
                <i class="fas fa-tag me-1"></i>
                {{ $produk->kategori->nama_kategori ?? '-' }}
            </small>

            {{-- DESKRIPSI --}}
            <small class="text-muted mb-2"
                   style="min-height:40px">
                {{ Str::limit($produk->deskripsi, 60) }}
            </small>

            {{-- HARGA --}}
            <strong class="mb-3 text-primary">
                Rp {{ number_format($produk->harga,0,',','.') }}
            </strong>

            {{-- FORM KERANJANG --}}
            <form action="{{ route('keranjang.tambah') }}"
                  method="POST"
                  class="mt-auto">
                @csrf

                <input type="hidden"
                       name="product_id"
                       value="{{ $produk->id }}">

                <input type="number"
                       name="qty"
                       value="1"
                       min="1"
                       class="form-control mb-2">

                <button class="btn btn-outline-primary w-100">
                    <i class="fas fa-cart-plus me-1"></i>
                    Tambah Keranjang
                </button>
            </form>

        </div>
    </div>
@empty
    <div class="col-12 text-center text-muted">
        <i class="fas fa-box-open fa-2x mb-2"></i><br>
        Produk tidak ditemukan
    </div>
@endforelse
</div>

@endsection
