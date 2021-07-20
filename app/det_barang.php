<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class det_barang extends Model
{
    protected $table = 'det_trx_barang_fix';
    protected $primaryKey = 'id_det';
    protected $fillable = [
        'id_det',
        'id_trx_barang',
        'id_barang',
        'qty',
        'harga'
    ];
        public function BarangMaster()
    {
        return $this->hasMany(BarangMaster::class);
    }
    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
