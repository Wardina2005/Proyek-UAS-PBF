<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * PROSES CHECKOUT
     */
    public function store(Request $request)
    {
        $keranjangs = Keranjang::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->back()
                ->with('error', 'Keranjang masih kosong');
        }

        DB::transaction(function () use ($keranjangs) {

            // HITUNG TOTAL
            $total = $keranjangs->sum(function ($item) {
                return $item->qty * $item->product->harga;
            });

            // SIMPAN TRANSAKSI
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'total'   => $total,
                'status'  => 'pending',
            ]);

            // SIMPAN DETAIL TRANSAKSI
            foreach ($keranjangs as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'product_id'   => $item->product_id,
                    'qty'          => $item->qty,
                    'harga'        => $item->product->harga,
                ]);
            }

            // KOSONGKAN KERANJANG
            Keranjang::where('user_id', auth()->id())->delete();
        });

        return redirect()->route('user.riwayat')
            ->with('success', 'Checkout berhasil');
    }

    /**
     * RIWAYAT TRANSAKSI USER
     */
    public function riwayat()
    {
        $transaksis = Transaksi::with('detailTransaksi.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.riwayat.index', compact('transaksis'));
    }
}
