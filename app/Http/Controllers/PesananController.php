<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPesanan;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = Pesanan::with(['details.menu', 'pelanggan', 'meja'])
            ->whereDoesntHave('transaksi')
            ->orderByDesc('idpesanan')
            ->get();

        return view('pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mejas = Meja::orderBy('namameja')->get();
        $menus = Menu::orderBy('namamenu')->get();
        $pelanggans = Pelanggan::orderBy('namapelanggan')->get();

        return view('pesanan.create', compact('mejas', 'menus', 'pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idmeja' => 'required|exists:mejas,idmeja',
            'idpelanggan' => 'required|exists:pelanggans,idpelanggan',
            'items' => 'required|array|min:1',
            'items.*.idmenu' => 'required|exists:menus,idmenu',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($data) {
            $pesanan = Pesanan::create([
                'idmeja' => $data['idmeja'],
                'idpelanggan' => $data['idpelanggan'],
                'iduser' => Auth::id(),
            ]);

            foreach ($data['items'] as $item) {
                DetailPesanan::create([
                    'idpesanan' => $pesanan->idpesanan,
                    'idmenu' => $item['idmenu'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            Meja::where('idmeja', $data['idmeja'])->update(['status' => 'terisi']);
        });

        return redirect()->route('pesanan.index')->with('sukses', 'Order berhasil dicatat.');
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
