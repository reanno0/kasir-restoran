@extends('layouts.app')

@section('title', 'Entri Barang')

@section('content')
<div class="card">
    <h2>Entri Barang (Menu)</h2>

    @if (session('sukses'))
        <p style="color: green;">{{ session('sukses') }}</p>
    @endif

    <a href="{{ route('menu.create') }}" class="btn" style="display:inline-block; margin-bottom:16px; text-decoration:none;">+ Tambah Menu</a>

    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <tr>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        @forelse ($menus as $menu)
        <tr>
            <td>{{ $menu->namamenu }}</td>
            <td>Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('menu.edit', $menu) }}">Ubah</a>
                <form action="{{ route('menu.destroy', $menu) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus menu ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="border:0; background:none; color:#c0392b; cursor:pointer;">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3">Belum ada data menu.</td></tr>
        @endforelse
    </table>

    <p style="margin-top: 16px;"><a href="{{ route('dashboard') }}">&larr; Kembali ke dashboard</a></p>
</div>
@endsection