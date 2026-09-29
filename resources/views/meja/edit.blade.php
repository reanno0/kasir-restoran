@extends('layouts.app')

@section('title', 'Ubah Meja')

@section('content')
<div class="card" style="max-width: 420px;">
    <h2>Ubah Meja</h2>

    <form action="{{ route('meja.update', $meja) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Meja</label>
        <input type="text" name="namameja" value="{{ $meja->namameja }}">

        <label>Status</label>
        <select name="status" style="width:100%; padding:10px; margin:6px 0 14px;">
            <option value="kosong" {{ $meja->status === 'kosong' ? 'selected' : '' }}>Kosong</option>
            <option value="terisi" {{ $meja->status === 'terisi' ? 'selected' : '' }}>Terisi</option>
        </select>

        <button type="submit" class="btn">Simpan Perubahan</button>
        <a href="{{ route('meja.index') }}">Batal</a>
    </form>
</div>
@endsection