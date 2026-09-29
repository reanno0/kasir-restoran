@extends('layouts.app')

@section('title', 'Tambah Order')

@section('content')
<div class="card" style="max-width: 600px;">
    <h2>Tambah Order</h2>

    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <label>Meja</label>
        <select name="idmeja" style="width:100%; padding:10px; margin:6px 0 14px;">
            @foreach ($mejas as $meja)
                <option value="{{ $meja->idmeja }}">{{ $meja->namameja }} ({{ $meja->status }})</option>
            @endforeach
        </select>

        <label>Pelanggan</label>
        <select name="idpelanggan" style="width:100%; padding:10px; margin:6px 0 14px;">
            @foreach ($pelanggans as $pelanggan)
                <option value="{{ $pelanggan->idpelanggan }}" {{ session('idpelanggan_baru') == $pelanggan->idpelanggan ? 'selected' : '' }}>
                    {{ $pelanggan->namapelanggan }}
                </option>
            @endforeach
        </select>

        <h3>Item Pesanan</h3>
        <div id="daftar-item">
            <div class="baris-item" style="display:flex; gap:8px; margin-bottom:8px;">
                <select name="items[0][idmenu]" style="flex:2; padding:10px;">
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->idmenu }}">{{ $menu->namamenu }} - Rp{{ number_format($menu->harga, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <input type="number" name="items[0][jumlah]" min="1" value="1" style="flex:1; padding:10px;">
            </div>
        </div>

        <button type="button" id="tambah-item" style="margin: 8px 0 16px;">+ Tambah Item Menu</button>
        <br>

        <button type="submit" class="btn">Simpan Order</button>
        <a href="{{ route('pesanan.index') }}">Batal</a>
    </form>

    <hr style="margin: 24px 0;">

    <h3>Pelanggan baru?</h3>
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <label>Nama Pelanggan</label>
        <input type="text" name="namapelanggan">

        <label>Jenis Kelamin</label>
        <select name="jeniskelamin" style="width:100%; padding:10px; margin:6px 0 14px;">
            <option value="1">Laki-laki</option>
            <option value="0">Perempuan</option>
        </select>

        <label>No. HP</label>
        <input type="text" name="nohp">

        <label>Alamat</label>
        <input type="text" name="alamat">

        <button type="submit" class="btn">Simpan Pelanggan</button>
    </form>
</div>

<script>
    let indexItem = 1;
    const daftarItem = document.getElementById('daftar-item');
    const menuOptions = daftarItem.querySelector('select').innerHTML;

    document.getElementById('tambah-item').addEventListener('click', function () {
        const baris = document.createElement('div');
        baris.className = 'baris-item';
        baris.style = 'display:flex; gap:8px; margin-bottom:8px;';
        baris.innerHTML = `
            <select name="items[${indexItem}][idmenu]" style="flex:2; padding:10px;">${menuOptions}</select>
            <input type="number" name="items[${indexItem}][jumlah]" min="1" value="1" style="flex:1; padding:10px;">
            <button type="button" class="hapus-item" style="flex:0; background:#c0392b; color:#fff; border:0; border-radius:4px; padding:0 12px;">×</button>
        `;
        daftarItem.appendChild(baris);
        indexItem++;
    });

    daftarItem.addEventListener('click', function (e) {
        if (e.target.classList.contains('hapus-item')) {
            e.target.closest('.baris-item').remove();
        }
    });
</script>
@endsection