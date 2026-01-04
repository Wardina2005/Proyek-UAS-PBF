@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <h4 class="fw-bold mb-4 text-center">
                Profil Saya
            </h4>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('user.profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Nama Lengkap
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ auth()->user()->name }}"
                                   class="form-control"
                                   required>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email
                            </label>
                            <input type="email"
                                   value="{{ auth()->user()->email }}"
                                   class="form-control"
                                   disabled>
                        </div>

                        <hr class="my-4">

                        <p class="fw-semibold mb-3 text-muted">
                            Ganti Password
                        </p>

                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Password Baru
                            </label>
                            <input type="password"
                                   name="password"
                                   class="form-control">
                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti password
                            </small>
                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Konfirmasi Password
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control">
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-grid">
                            <button class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
