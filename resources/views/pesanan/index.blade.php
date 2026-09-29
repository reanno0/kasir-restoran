@extends('layouts.app')

@section('title', 'Entri Order')

@section('content')
<div class="card">
    <h2>Daftar Order (Belum Dibayar)</h2>

    @if (session('sukses'))
        <p style="color: green;">{{ session('sukses') }}</p>
    @endif

    <a href="{{ route('pesanan.create') }}" class="btn" style="display:inline-block; margin-bottom:16px; text-decoration:none;">+ Tambah Order</a>

    @forelse ($pesanans as $pesanan)
    <div style="border:1px solid #ddd; border-radius:6px; padding:12px 16px; margin-bottom:12px;">
        <strong>Meja {{ $pesanan->meja->namameja }}</strong> — {{ $pesanan->pelanggan->namapelanggan }}
        <ul style="margin:8px 0 0;">
            @foreach ($pesanan->details as $item)
                <li>{{ $item->menu->namamenu }} x {{ $item->jumlah }}</li>
            @endforeach
        </ul>
    </div>
    @empty
    <p>Belum ada order yang menunggu pembayaran.</p>
    @endforelse

    <p style="margin-top: 16px;"><a href="{{ route('dashboard') }}">&larr; Kembali ke dashboard</a></p>
</div>
@endsection