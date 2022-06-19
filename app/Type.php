<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'items_id',
        // 'hrg_item',
        'jns_brg'
    ];

    public function j_types() {

        return $this->hasMany('App\Eoq', 'types_id');
    
    }
    public function items() {

        return $this->hasMany('App\Stok', 'types_id', 'id');
    }
    public function jenis_cuy(){
        return $this->hasMany('App\Pemakaian', 'types_id', 'id');
    }
    public function perm() {
        return $this->hasMany('App\Requeststok', 'idjenis', 'id');
    }

    public function jeniseoq(){
        return $this->hasMany('App\Hasilmetode', 'jenis_id', 'id');
    }

    public function njenis(){
        return $this->hasMany('App\Lapstok', 'id_jenis', 'id');
    }

    public function itemsss()
    {
        return $this->belongsTo('App\Item','items_id', 'id');
    }
    
    public function jns_1(){
        return $this->hasMany('App\In', 'jns_brg1', 'id');
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class,'jns_brg');
    }
}
