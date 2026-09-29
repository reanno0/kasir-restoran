<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanans';
    protected $primaryKey = 'iddetail';
    public $timestamps = false;
    protected $guarded = [];

    public function menu(){
        return $this->belongsTo(Menu::class, 'idmenu', 'idmenu');
    }
}
