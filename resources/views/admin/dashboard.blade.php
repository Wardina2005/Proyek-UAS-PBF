@extends('layouts.app')

@section('content')
<h3>Dashboard Admin</h3>
<p class="text-muted">Selamat datang, <strong>Admin</strong>. Kelola sistem di sini.</p>

<div class="row g-4">

    <div class="col-md-4">
        <a href="/admin/produk" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon"><i class="fas fa-box"></i></div>
                <h5>Manajemen Produk</h5>
                <p>Tambah & kelola produk</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/admin/user" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h5>Manajemen User</h5>
                <p>Admin & user sistem</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/admin/transaksi" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon"><i class="fas fa-file-invoice-dollar"></i></div>
                <h5>Transaksi</h5>
                <p>Laporan pembelian</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/admin/kategori" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon"><i class="fas fa-tags"></i></div>
                <h5>Kategori</h5>
                <p>Kelola kategori produk</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/admin/aktivitas" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                <h5>Log Aktivitas</h5>
                <p>Jejak aktivitas sistem</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/admin/laporan/transaksi" class="dashboard-link">
            <div class="dashboard-card">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <h5>Laporan Transaksi</h5>
                <p>Riwayat & laporan pesanan</p>
            </div>
        </a>
    </div>

</div>
@endsection
