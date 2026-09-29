@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="card" style="max-width: 420px;">
    <h2>Tambah Menu</h2>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf
        <label>Nama Menu</label>
        <input type="text" name="namamenu" value="{{ old('namamenu') }}">

        <label>Harga</label>
        <input type="number" name="harga" value="{{ old('harga') }}">

        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('menu.index') }}">Batal</a>
    </form>
</div>
@endsection