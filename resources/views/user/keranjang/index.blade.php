@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold">Keranjang Belanja</h3>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">

                <thead class="bg-dark text-white">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @php $total = 0; @endphp

                @forelse($items as $index => $item)
                    @php
                        $subtotal = $item->product->harga * $item->qty;
                        $total += $subtotal;
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>

                        {{-- FOTO --}}
                        <td>
                            <img src="{{ asset('storage/'.$item->product->foto) }}"
                                 width="70"
                                 class="rounded shadow-sm">
                        </td>

                        {{-- NAMA --}}
                        <td class="fw-semibold">
                            {{ $item->product->nama_produk }}
                        </td>

                        {{-- JUMLAH --}}
                        <td>{{ $item->qty }}</td>

                        {{-- HARGA --}}
                        <td>
                            Rp {{ number_format($item->product->harga,0,',','.') }}
                        </td>

                        {{-- SUBTOTAL --}}
                        <td class="fw-bold">
                            Rp {{ number_format($subtotal,0,',','.') }}
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            <form action="{{ url('user/keranjang/'.$item->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus produk?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Keranjang masih kosong
                        </td>
                    </tr>
                @endforelse
                </tbody>

                {{-- TOTAL --}}
                <tfoot>
                    <tr class="bg-light">
                        <th colspan="5" class="text-end">Total Bayar</th>
                        <th colspan="2" class="fw-bold">
                            Rp {{ number_format($total,0,',','.') }}
                        </th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>

    {{-- CHECKOUT --}}
    @if(count($items) > 0)
        <div class="text-end mt-4">
            <form action="{{ route('user.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-success px-4 py-2">
                    Checkout
                </button>
            </form>
        </div>
    @endif

</div>
@endsection
