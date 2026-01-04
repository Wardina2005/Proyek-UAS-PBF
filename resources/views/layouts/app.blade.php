<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RBAC APP</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-dark: #0f172a;
            --blue-main: #1e3a8a;
            --gold: #f5c77a;
            --gold-dark: #d4a94f;
            --bg: #f4f6fb;
        }

        body {
            margin: 0;
            background: var(--bg);
            font-family: 'Segoe UI', sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--blue-dark), var(--blue-main));
            color: #fff;
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h4 {
            font-weight: 800;
            letter-spacing: 1px;
            color: var(--gold);
        }

        .sidebar small {
            color: #c7d2fe;
        }

        .sidebar a {
            color: #e5e7eb;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            font-weight: 500;
            transition: .2s;
        }

        .sidebar a i {
            width: 20px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: var(--gold);
            transform: translateX(4px);
        }

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            padding: 45px;
        }

        .content h3 {
            font-weight: 800;
            color: var(--blue-main);
            letter-spacing: .5px;
        }

        .content p.text-muted {
            font-size: 15px;
            margin-bottom: 30px;
        }

        /* ================= DASHBOARD CARD ================= */
        .dashboard-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 42px 30px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
            transition: all .3s ease;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 55px rgba(15, 23, 42, 0.15);
        }

        .dashboard-card .icon {
            font-size: 34px;
            color: var(--gold-dark);
            margin-bottom: 20px;
        }

        .dashboard-card h5 {
            font-weight: 800;
            color: var(--blue-main);
            margin-bottom: 6px;
            font-size: 18px;
        }

        .dashboard-card p {
            font-size: 14px;
            color: #64748b;
            margin: 0;
        }

        .dashboard-link {
            text-decoration: none;
            color: inherit;
        }

        /* ================= LOGOUT ================= */
        .logout-btn {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            border: none;
            color: #1e293b;
            font-weight: 600;
        }

        .logout-btn:hover {
            opacity: .9;
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- ===== SIDEBAR ===== -->
    <div class="sidebar">
        <div>
            <h4>RBAC APP</h4>
            <small>{{ Auth::user()->name }}</small><br>
            <small>Role: {{ Auth::user()->role }}</small>

            <hr style="border-color:#334155">

            {{-- ================= ADMIN ================= --}}
            @if(Auth::user()->role === 'admin')

                <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i>Dashboard
                </a>

                <a href="/admin/produk" class="{{ request()->is('admin/produk*') ? 'active' : '' }}">
                    <i class="fas fa-box me-2"></i>Produk
                </a>

                <a href="/admin/kategori" class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
                    <i class="fas fa-tags me-2"></i>Kategori
                </a>

                <a href="/admin/user" class="{{ request()->is('admin/user*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>User
                </a>

                <a href="/admin/transaksi" class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice me-2"></i>Transaksi
                </a>

                <a href="/admin/laporan/transaksi" class="{{ request()->is('admin/laporan/transaksi*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list me-2"></i>Laporan Transaksi
                </a>

                <a href="/admin/aktivitas" class="{{ request()->is('admin/aktivitas*') ? 'active' : '' }}">
                    <i class="fas fa-clock-rotate-left me-2"></i>Log Aktivitas
                </a>

            {{-- ================= USER ================= --}}
            @elseif(Auth::user()->role === 'user')

                <a href="/user/dashboard" class="{{ request()->is('user/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>

                <a href="/user/produk" class="{{ request()->is('user/produk*') ? 'active' : '' }}">
                    <i class="fas fa-store me-2"></i>Produk
                </a>

                <a href="/user/keranjang" class="{{ request()->is('user/keranjang*') ? 'active' : '' }}">
                    <i class="fas fa-cart-shopping me-2"></i>Keranjang
                </a>

                <a href="/user/riwayat" class="{{ request()->is('user/riwayat*') ? 'active' : '' }}">
                    <i class="fas fa-clock me-2"></i>Riwayat
                </a>

                <a href="/user/profil" class="{{ request()->is('user/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user me-2"></i>Profil
                </a>

            @endif
        </div>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn logout-btn w-100 mt-3">
                Logout
            </button>
        </form>
    </div>

    <!-- ===== CONTENT ===== -->
    <div class="content">
        @yield('content')
    </div>

</div>

<!-- ===== TOAST SUCCESS ===== -->
@if(session('success'))
<div class="toast-container position-fixed bottom-0 end-0 p-4">
    <div class="toast align-items-center text-bg-success border-0 show">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

<!-- Bootstrap JS (WAJIB) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
