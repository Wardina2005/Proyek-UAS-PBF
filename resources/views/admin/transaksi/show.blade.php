@extends('layouts.app')

@section('content')
<h3>Detail Transaksi</h3>

<p><b>User:</b> {{ $transaksi->user->name }}</p>
<p><b>Status:</b> {{ $transaksi->status }}</p>

<form method="POST" action="/admin/transaksi/{{ $transaksi->id }}">
@csrf
@method('PUT')

<select name="status" class="form-select w-25 mb-3">
    <option value="pending">Pending</option>
    <option value="diproses">Diproses</option>
    <option value="selesai">Selesai</option>
    <option value="dibatalkan">Dibatalkan</option>
</select>

<button class="btn btn-primary">Update Status</button>
</form>

<hr>

<table class="table table-bordered">
<tr>
    <th>Produk</th>
    <th>Qty</th>
    <th>Harga</th>
</tr>

@foreach($transaksi->details as $d)
<tr>
    <td>{{ $d->product->nama_produk }}</td>
    <td>{{ $d->qty }}</td>
    <td>Rp {{ number_format($d->harga) }}</td>
</tr>
@endforeach
</table>
@endsection
