<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requeststok extends Model
{
    protected $fillable = [
        'idbarang',
        'idjenis',
        'jumlah',
        // 'catatan',
        'tanggal',
        'waktu_pemesanan',
        'frekuensi',
        'status'
    ];
    public function permStok() {
        return $this->belongsTo('App\Item', 'idbarang', 'id');
    }
    public function permStok2() {
        return $this->belongsTo('App\Type', 'idjenis', 'id');
    }
}
