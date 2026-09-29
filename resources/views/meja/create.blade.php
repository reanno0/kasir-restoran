@extends('layouts.app')

@section('title', 'Tambah Meja')

@section('content')
<div class="card" style="max-width: 420px;">
    <h2>Tambah Meja</h2>

    <form action="{{ route('meja.store') }}" method="POST">
        @csrf
        <label>Nama Meja</label>
        <input type="text" name="namameja" value="{{ old('namameja') }}">

        <label>Status</label>
        <select name="status" style="width:100%; padding:10px; margin:6px 0 14px;">
            <option value="kosong">Kosong</option>
            <option value="terisi">Terisi</option>
        </select>

        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('meja.index') }}">Batal</a>
    </form>
</div>
@endsection