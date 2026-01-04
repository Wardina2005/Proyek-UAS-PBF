@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<h3 class="fw-bold mb-2">Manajemen User</h3>
<p class="text-muted mb-4">Daftar user yang terdaftar di sistem</p>

{{-- 📦 TABLE --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="120" class="text-center">Role</th>
                </tr>
            </thead>

            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="fw-semibold">
                        {{ $user->name }}
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td class="text-center">
                        <span class="badge 
                            {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Belum ada user
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
