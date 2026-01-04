<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanTransaksiController extends Controller
{
    /**
     * Tampilkan halaman laporan / riwayat transaksi
     */
    public function index()
    {
        $transaksis = Transaksi::with('user')
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan.transaksi', compact('transaksis'));
    }

    /**
     * Export laporan transaksi ke Excel
     */
    public function exportExcel()
    {
        return Excel::download(
            new TransaksiExport,
            'riwayat-transaksi.xlsx'
        );
    }

    /**
     * Export laporan transaksi ke PDF
     */
    public function exportPdf()
    {
        $transaksis = Transaksi::with('user')
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.laporan.transaksi-pdf',
            compact('transaksis')
        )->setPaper('A4', 'portrait');

        return $pdf->download('riwayat-transaksi.pdf');
    }
}
