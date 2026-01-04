@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<h3 class="fw-bold mb-2">Log Aktivitas</h3>
<p class="text-muted mb-4">Riwayat aktivitas yang dilakukan oleh user dan admin</p>

{{-- 📦 TABLE --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th width="180">User</th>
                    <th>Aktivitas</th>
                    <th width="180">Waktu</th>
                </tr>
            </thead>

            <tbody>
            @forelse($logs as $log)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="fw-semibold">
                        {{ $log->user->name ?? '-' }}
                    </td>

                    <td>
                        {{ $log->aktivitas }}
                    </td>

                    <td>
                        {{ $log->created_at->format('d-m-Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Belum ada aktivitas
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
