@extends('layouts.app')

@section('title', 'Entri Meja')

@section('content')
<div class="card">
    <h2>Entri Meja</h2>

    @if (session('sukses'))
        <p style="color: green;">{{ session('sukses') }}</p>
    @endif

    <a href="{{ route('meja.create') }}" class="btn" style="display:inline-block; margin-bottom:16px; text-decoration:none;">+ Tambah Meja</a>

    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <tr>
            <th>Nama Meja</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @forelse ($mejas as $meja)
        <tr>
            <td>{{ $meja->namameja }}</td>
            <td>{{ $meja->status }}</td>
            <td>
                <a href="{{ route('meja.edit', $meja) }}">Ubah</a>
                <form action="{{ route('meja.destroy', $meja) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus meja ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="border:0; background:none; color:#c0392b; cursor:pointer;">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3">Belum ada data meja.</td></tr>
        @endforelse
    </table>

    <p style="margin-top: 16px;"><a href="{{ route('dashboard') }}">&larr; Kembali ke dashboard</a></p>
</div>
@endsection