@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<h3 class="fw-bold mb-2">Riwayat Transaksi</h3>
<p class="text-muted mb-4">Laporan seluruh transaksi yang telah dilakukan</p>

{{-- 🔘 BUTTON EXPORT --}}
<div class="d-flex gap-2 mb-3">
    {{-- EXPORT EXCEL --}}
    <a href="{{ route('admin.laporan.excel') }}"
       class="btn btn-success btn-sm">
        <i class="fas fa-file-excel me-1"></i> Export Excel
    </a>

    {{-- EXPORT PDF --}}
    @if(Route::has('admin.laporan.pdf'))
        <a href="{{ route('admin.laporan.pdf') }}"
           class="btn btn-danger btn-sm">
            <i class="fas fa-file-pdf me-1"></i> Export PDF
        </a>
    @else
        <button class="btn btn-danger btn-sm" disabled
                title="Route PDF belum tersedia">
            <i class="fas fa-file-pdf me-1"></i> Export PDF
        </button>
    @endif
</div>

{{-- 📦 TABLE --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>User</th>
                    <th>Total</th>
                    <th width="140" class="text-center">Status</th>
                    <th width="140">Tanggal</th>
                </tr>
            </thead>

            <tbody>
            @forelse($transaksis as $t)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="fw-semibold">
                        {{ $t->user->name ?? '-' }}
                    </td>

                    <td>
                        Rp {{ number_format($t->total, 0, ',', '.') }}
                    </td>

                    <td class="text-center">
                        <span class="badge 
                            bg-{{ $t->status === 'selesai' ? 'success' : 'warning' }}">
                            {{ ucfirst($t->status) }}
                        </span>
                    </td>

                    <td>
                        {{ $t->created_at->format('d-m-Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Belum ada data transaksi
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
