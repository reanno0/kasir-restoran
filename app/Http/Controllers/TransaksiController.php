<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = Pesanan::with(['details.menu', 'pelanggan', 'meja'])
            ->whereDoesntHave('transaksi')
            ->orderBy('idpesanan')
            ->get();

        $transaksis = Transaksi::with('pesanan.meja', 'pesanan.pelanggan')
            ->orderByDesc('idtransaksi')
            ->limit(10)
            ->get();

        return view('transaksi.index', compact('pesanans', 'transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pesanan $pesanan)
    {
        $pesanan->load(['details.menu', 'pelanggan', 'meja']);
        $total = $pesanan->details->sum(fn($item) => $item->menu->harga * $item->jumlah);

        return view('transaksi.create', compact('pesanan', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idpesanan' => 'required|exists:pesanans,idpesanan',
            'bayar' => 'required|integer|min:0',
        ]);

        $hasil = DB::select('CALL sp_buat_transaksi(?, ?)', [
            $data['idpesanan'],
            $data['bayar'],
        ]);

        $pesanan = Pesanan::find($data['idpesanan']);
        $pesanan->meja()->update(['status' => 'kosong']);

        $total = $hasil[0]->total;
        $kembalian = $hasil[0]->kembalian;

        return redirect()->route('transaksi.index')
            ->with('sukses', "Transaksi berhasil. Total Rp" . number_format($total, 0, ',', '.') . ", kembalian Rp" . number_format($kembalian, 0, ',', '.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
