<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
