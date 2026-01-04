<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\LaporanTransaksiController;

/*
|--------------------------------------------------------------------------
| USER CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\User\ProdukController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ProfilController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect('/login'));

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN (role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('admin.dashboard');

        // PRODUK
        Route::resource('/produk', ProductController::class)
            ->except(['show']);

        // KATEGORI
        Route::resource('/kategori', KategoriController::class);

        // TRANSAKSI
        Route::get('/transaksi', [TransaksiController::class, 'index'])
            ->name('admin.transaksi.index');

        Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])
            ->name('admin.transaksi.show');

        Route::put('/transaksi/{transaksi}', [TransaksiController::class, 'update'])
            ->name('admin.transaksi.update');

        /*
        |--------------------------------------------------------------------------
        | LAPORAN / RIWAYAT TRANSAKSI 
        |--------------------------------------------------------------------------
        */
        Route::get('/laporan/transaksi',
            [LaporanTransaksiController::class, 'index'])
            ->name('admin.laporan.transaksi');

        Route::get('/laporan/transaksi/excel',
            [LaporanTransaksiController::class, 'exportExcel'])
            ->name('admin.laporan.excel');
        
        Route::get('/laporan/transaksi/pdf',
            [LaporanTransaksiController::class, 'exportPdf'])
            ->name('admin.laporan.pdf');

        // USER
        Route::get('/user', [UserController::class, 'index'])
            ->name('admin.user.index');

        // LOG AKTIVITAS
        Route::get('/aktivitas', [LogAktivitasController::class, 'index'])
            ->name('admin.aktivitas.index');
    });

/*
|--------------------------------------------------------------------------
| USER (role: user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', fn () => view('user.dashboard'))
            ->name('user.dashboard');

        // PRODUK
        Route::get('/produk', [ProdukController::class, 'index'])
            ->name('user.produk');

        // KERANJANG
        Route::post('/keranjang/tambah', [KeranjangController::class, 'store'])
            ->name('keranjang.tambah');

        Route::get('/keranjang', [KeranjangController::class, 'index'])
            ->name('keranjang.index');

        Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy'])
            ->name('keranjang.hapus');

        // CHECKOUT & RIWAYAT
        Route::post('/checkout', [CheckoutController::class, 'store'])
            ->name('user.checkout');

        Route::get('/riwayat', [CheckoutController::class, 'riwayat'])
            ->name('user.riwayat');

        // PROFIL
        Route::get('/profil', [ProfilController::class, 'index'])
            ->name('user.profil');

        Route::put('/profil', [ProfilController::class, 'update'])
            ->name('user.profil.update');
    });
