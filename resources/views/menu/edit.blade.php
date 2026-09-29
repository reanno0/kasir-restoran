@extends('layouts.app')

@section('title', 'Ubah Menu')

@section('content')
<div class="card" style="max-width: 420px;">
    <h2>Ubah Menu</h2>

    <form action="{{ route('menu.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Menu</label>
        <input type="text" name="namamenu" value="{{ $menu->namamenu }}">

        <label>Harga</label>
        <input type="number" name="harga" value="{{ $menu->harga }}">

        <button type="submit" class="btn">Simpan Perubahan</button>
        <a href="{{ route('menu.index') }}">Batal</a>
    </form>
</div>
@endsection