<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';
    protected $primaryKey = 'idpesanan';
    public $timestamps = false;
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(DetailPesanan::class, 'idpesanan', 'idpesanan');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'idmeja', 'idmeja');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'idpesanan', 'idpesanan');
    }
}
