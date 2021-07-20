<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    protected $table = 'trx_barang_fix';
    protected $primaryKey = 'id_trx_barang';
    protected $fillable = [
        'id_trx_barang',
        'qty',
        'harga',
        'status',
    ];
    public function det_barang(){
        return $this->beloongsTo(det_barang::class,'id_trx_barang','id_trx_barang');
    }

}
