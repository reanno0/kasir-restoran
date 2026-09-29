@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="card">
        <h2>Selamat Datang, {{ auth()->user()->namauser }}!</h2>
        <p>Anda telah berhasil login sebagai {{ auth()->user()->role }}.</p>

        <ul>
            @if(in_array(auth()->user()->role, ['admin']))
                <li><a href="{{ route('meja.index') }}">Entri Meja</a></li>
            @endif
            @if(in_array(auth()->user()->role, ['admin', 'waiter']))
                <li><a href="{{ route('menu.index') }}">Entri Menu</a></li>
            @endif
            @if(in_array(auth()->user()->role, ['waiter']))
                <li><a href="{{ route('pesanan.index') }}">Entri Order</a></li>
            @endif
            @if(in_array(auth()->user()->role, ['kasir']))
                <li><a href="{{ route('transaksi.index') }}">Entri Transaksi</a></li>
            @endif
            @if(in_array(auth()->user()->role, ['waiter', 'kasir', 'owner']))
                <li><a href="{{ route('laporan.index') }}">Generate Laporan</a></li>
            @endif
        </ul>
    </div>