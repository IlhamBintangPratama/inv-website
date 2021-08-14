<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasilmetode extends Model
{
    protected $fillable = [
        'tanggal',
        'barang_id', 
        'jenis_id', 
        'periode',
        'permintaan',
        'eoq',
        'frekuensi',
        'leadtime',
        'rop'
    ];
    public function brgs() {

        return $this->belongsTo('App\Item', 'barang_id', 'id');
    }
    public function jnsz() {

        return $this->belongsTo('App\Type', 'jenis_id', 'id');
    }
}
