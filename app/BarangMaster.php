<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangMaster extends Model
{
    protected $table = 'master_barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_barang',
        'kode_barang',
        'nama_barang',
        'stok',
        'harga',
        'harga_satuan'
    ];
}
