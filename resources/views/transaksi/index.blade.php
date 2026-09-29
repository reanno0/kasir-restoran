@extends('layouts.app')

@section('title', 'Entri Transaksi')

@section('content')
<div class="card">
    <h2>Order Menunggu Pembayaran</h2>

    @if (session('sukses'))
        <p style="color: green;">{{ session('sukses') }}</p>
    @endif

    @forelse ($pesanans as $pesanan)
    <div style="border:1px solid #ddd; border-radius:6px; padding:12px 16px; margin-bottom:12px;">
        <strong>Meja {{ $pesanan->meja->namameja }}</strong> — {{ $pesanan->pelanggan->namapelanggan }}
        <ul style="margin:8px 0;">
            @foreach ($pesanan->details as $item)
                <li>{{ $item->menu->namamenu }} x {{ $item->jumlah }}</li>
            @endforeach
        </ul>
        <a href="{{ route('transaksi.create', $pesanan) }}">Proses Bayar</a>
    </div>
    @empty
    <p>Tidak ada order yang menunggu pembayaran.</p>
    @endforelse

    <h2 style="margin-top:32px;">Transaksi Terbaru</h2>
    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <tr>
            <th>Meja</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Bayar</th>
        </tr>
        @forelse ($transaksis as $t)
        <tr>
            <td>{{ $t->pesanan->meja->namameja }}</td>
            <td>{{ $t->pesanan->pelanggan->namapelanggan }}</td>
            <td>Rp{{ number_format($t->total, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($t->bayar, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="4">Belum ada transaksi.</td></tr>
        @endforelse
    </table>

    <p style="margin-top: 16px;"><a href="{{ route('dashboard') }}">&larr; Kembali ke dashboard</a></p>
</div>
@endsection