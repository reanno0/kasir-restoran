@extends('layouts.app')

@section('title', 'Proses Pembayaran')

@section('content')
<div class="card" style="max-width: 420px;">
    <h2>Proses Pembayaran</h2>

    <p>
        Meja: <strong>{{ $pesanan->meja->namameja }}</strong><br>
        Pelanggan: <strong>{{ $pesanan->pelanggan->namapelanggan }}</strong>
    </p>

    <ul>
        @foreach ($pesanan->details as $item)
            <li>{{ $item->menu->namamenu }} x {{ $item->jumlah }} = Rp{{ number_format($item->menu->harga * $item->jumlah, 0, ',', '.') }}</li>
        @endforeach
    </ul>

    <p><strong>Total: Rp{{ number_format($total, 0, ',', '.') }}</strong></p>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="idpesanan" value="{{ $pesanan->idpesanan }}">

        <label>Jumlah Bayar</label>
        <input type="number" name="bayar" min="0">

        <button type="submit" class="btn">Bayar</button>
        <a href="{{ route('transaksi.index') }}">Batal</a>
    </form>
</div>
@endsection