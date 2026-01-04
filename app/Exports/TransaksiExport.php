<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Transaksi::with('user')
            ->where('status', 'selesai')
            ->get()
            ->map(function ($t) {
                return [
                    $t->user->name,
                    $t->total,
                    ucfirst($t->status),
                    $t->created_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama User',
            'Total Bayar',
            'Status',
            'Tanggal',
        ];
    }
}
