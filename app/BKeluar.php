<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BKeluar extends Model
{
    protected $table = 'brg_masuk';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',
        'Kode_Barang',
        'Nama_Barang',
        'Qty',
        'Harga_Satuan',
        'Harga'
    ];
}