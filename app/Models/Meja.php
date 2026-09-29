<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'mejas';
    protected $primaryKey = 'idmeja';
    public $timestamps = false;
    protected $guarded = [];
}
