@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold">Riwayat Transaksi</h3>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($transaksis->isEmpty())
        <div class="alert alert-info">
            Belum ada transaksi
        </div>
    @else

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th width="60">No</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th width="140">Status</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($transaksis as $index => $transaksi)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            {{ $transaksi->created_at->format('d M Y') }}
                        </td>

                        <td>
                            Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($transaksi->status === 'pending')
                                <span class="badge bg-warning text-white">
                                    Pending
                                </span>
                            @else
                                <span class="badge bg-success text-white">
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endif

</div>
@endsection
