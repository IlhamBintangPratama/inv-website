<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lapstok extends Model
{
    protected $fillable = [
        'tanggal',
        'id_barang', 
        'id_jenis', 
        'awal',
        'stok_masuk',
        'stok_keluar',
        'akhir'
    ];
    public function barangz() {

        return $this->belongsTo('App\Item', 'id_barang', 'id');
    }
    public function jenisz() {

        return $this->belongsTo('App\Type', 'id_jenis', 'id');
    }
}
