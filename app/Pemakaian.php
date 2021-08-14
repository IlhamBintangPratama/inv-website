<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    protected $fillable = [
        'items_id', 
        'types_id', 
        'bulan_id',
        'jumlah',
        'tanggal'
    ];
    public function jenis() {

        return $this->belongsTo('App\Type', 'types_id', 'id');
    }
    public function brg() {

        return $this->belongsTo('App\Item', 'items_id', 'id');
    }
    public function bln() {

        return $this->belongsTo('App\Bulan', 'bulan_id', 'id');
    }
    public function pk() {

        return $this->hasMany('App\Stok', 'pk_id', 'id');
    }
    public function pkn() {

        return $this->hasMany('App\Out', 'pk_id', 'id');
    }
}
