<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Out extends Model
{
    protected $fillable = [
        'id_brg', 
        'stoks_id',
        'id_bulan',
        'buyer',
        'jns_id', 
        'hrg_jual',
        'jumlah',
        'tanggal',
        'total',
        'kategori'
    ];
    public function stok() {

        return $this->belongsTo('App\Stok', 'stoks_id', 'id');
    }
    public function item1() {

        return $this->belongsTo('App\Item', 'id_brg', 'id');
    }
    public function type1() {

        return $this->belongsTo('App\Type', 'jns_id', 'id');
    }
    // public function pkns() {

    //     // return $this->belongsTo('App\Pemakaian', 'pk_id', 'id');
    // }
    public function bulann() {

        return $this->belongsTo('App\Bulan', 'id_bulan', 'id');
    }
}