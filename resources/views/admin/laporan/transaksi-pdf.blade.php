<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Riwayat Transaksi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f1f5f9;
            font-weight: bold;
        }

        .status {
            font-weight: bold;
            color: #0f766e;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>

    <h2>Laporan Riwayat Transaksi</h2>
    <div class="subtitle">
        Dicetak pada {{ now()->format('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="30%">User</th>
                <th width="20%">Total</th>
                <th width="20%">Status</th>
                <th width="30%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $t)
                <tr>
                    <td>{{ $t->user->name ?? '-' }}</td>
                    <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                    <td class="status">{{ ucfirst($t->status) }}</td>
                    <td>{{ $t->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">
                        Tidak ada data transaksi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        RBAC APP — Laporan Transaksi
    </div>

</body>
</html>
