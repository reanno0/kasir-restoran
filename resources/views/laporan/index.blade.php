@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="card">
    <h2>Laporan Transaksi</h2>

    <div style="display:flex; gap:16px; margin-bottom:20px;">
        <div style="background:#f4f5f7; padding:16px; border-radius:6px; flex:1;">
            <div>Jumlah Transaksi</div>
            <strong style="font-size:22px;">{{ $jumlahTransaksi }}</strong>
        </div>
        <div style="background:#f4f5f7; padding:16px; border-radius:6px; flex:1;">
            <div>Total Pendapatan</div>
            <strong style="font-size:22px;">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
        </div>
    </div>

    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <tr>
            <th>No. Transaksi</th>
            <th>Meja</th>
            <th>Pelanggan</th>
            <th>Item</th>
            <th>Total</th>
            <th>Bayar</th>
        </tr>
        @forelse ($transaksis as $t)
        <tr>
            <td>{{ $t->idtransaksi }}</td>
            <td>{{ $t->pesanan->meja->namameja }}</td>
            <td>{{ $t->pesanan->pelanggan->namapelanggan }}</td>
            <td>
                @foreach ($t->pesanan->details as $item)
                    {{ $item->menu->namamenu }} x{{ $item->jumlah }}@if (!$loop->last), @endif
                @endforeach
            </td>
            <td>Rp{{ number_format($t->total, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($t->bayar, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="6">Belum ada transaksi.</td></tr>
        @endforelse
    </table>

    <p style="margin-top: 16px;"><a href="{{ route('dashboard') }}">&larr; Kembali ke dashboard</a></p>
</div>
@endsection