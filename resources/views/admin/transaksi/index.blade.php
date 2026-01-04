@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<h3 class="fw-bold mb-2">Data Transaksi</h3>
<p class="text-muted mb-4">Daftar seluruh transaksi yang terjadi</p>

{{-- ALERT SUCCESS --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- 📦 TABLE --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>User</th>
                    <th>Total</th>
                    <th width="120" class="text-center">Status</th>
                    <th width="140">Tanggal</th>
                    <th width="180" class="text-center">Aksi</th>
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
                        @if($t->status === 'pending')
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        @else
                            <span class="badge bg-success">
                                Selesai
                            </span>
                        @endif
                    </td>

                    <td>
                        {{ $t->created_at->format('d-m-Y') }}
                    </td>

                    <td class="text-center">
                        @if($t->status === 'pending')
                            <form action="{{ url('/admin/transaksi/' . $t->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Ubah status menjadi selesai?')">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="selesai">
                                <button class="btn btn-success btn-sm">
                                    Selesaikan
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>
                                ✔ Selesai
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada transaksi
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
