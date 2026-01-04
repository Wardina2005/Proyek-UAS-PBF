@extends('layouts.app')

@section('content')

<h3 class="mb-1">Dashboard User</h3>
<p class="text-muted mb-4">
    Selamat datang, {{ Auth::user()->name }}
</p>

<div class="row g-4">

    <!-- PRODUK -->
    <div class="col-md-3">
        <a href="/user/produk" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon">
                    <i class="fas fa-store"></i>
                </div>
                <h5>Produk</h5>
                <p>Lihat semua produk</p>
            </div>
        </a>
    </div>

    <!-- KERANJANG -->
    <div class="col-md-3">
        <a href="/user/keranjang" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon">
                    <i class="fas fa-cart-shopping"></i>
                </div>
                <h5>Keranjang</h5>
                <p>Barang yang dipilih</p>
            </div>
        </a>
    </div>

    <!-- RIWAYAT -->
    <div class="col-md-3">
        <a href="/user/riwayat" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
                <h5>Riwayat</h5>
                <p>Transaksi sebelumnya</p>
            </div>
        </a>
    </div>

    <!-- PROFIL -->
    <div class="col-md-3">
        <a href="/user/profil" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <h5>Profil</h5>
                <p>Kelola akun</p>
            </div>
        </a>
    </div>

</div>

@endsection
