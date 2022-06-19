<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class In extends Model
{
    protected $fillable = [
        'stoks_id',
        'nm_brg1', 
        'jns_brg1', 
        'awal',
        'jumlah',
        'tanggal',
        'hrg_item',
        'total',
        'suplier_id'
    ];
    public function stokk() {

        return $this->belongsTo('App\Stok', 'stoks_id');
    }
    public function brg1() {

        return $this->belongsTo('App\Item', 'nm_brg1', 'id');
    }
    public function jns1() {

        return $this->belongsTo('App\Type', 'jns_brg1', 'id');
    }
    public function suplier() {

        return $this->belongsTo('App\Suplier', 'suplier_id', 'id');
    }
}
