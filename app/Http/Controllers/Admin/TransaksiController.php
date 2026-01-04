<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

/* TAMBAHAN UNTUK EXCEL */
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    // ===============================
    // TAMPIL DATA TRANSAKSI
    // ===============================
    public function index()
    {
        $transaksis = Transaksi::with('user')
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    // ===============================
    // DETAIL TRANSAKSI
    // ===============================
    public function show(Transaksi $transaksi)
    {
        $transaksi->load('details.product', 'user');
        return view('admin.transaksi.show', compact('transaksi'));
    }

    // ===============================
    // UPDATE STATUS (Pending / Selesai)
    // ===============================
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:pending,selesai',
        ]);

        $transaksi->update([
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('success', 'Status transaksi berhasil diperbarui');
    }

    // ===============================
    // EXPORT LAPORAN TRANSAKSI (EXCEL)
    // ===============================
    public function exportExcel()
    {
        return Excel::download(
            new TransaksiExport,
            'laporan-transaksi.xlsx'
        );
    }
}
