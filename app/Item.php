<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KategoriBarang;

class Item extends Model
{
    protected $fillable = [
        'nm_brg', 
        'by_simpan', 
        'by_pesan'
    ];
    public function j_items() {

        return $this->hasMany('App\Eoq', 'items_id');
    
    }
    public function item_stok() {

        return $this->hasMany('App\Stok', 'items_id');
    }
    public function brg_cuy(){
        return $this->hasMany('App\Pemakaian', 'items_id', 'id');
    }
    public function perm2() {
        return $this->hasMany('App\Requeststok', 'idbarang', 'id');
    }
    public function barangS() {

        return $this->hasMany('App\Chart', 'brg_id', 'id');
    }
    public function eoqitem() {

        return $this->hasMany('App\Hasilmetode', 'barang_id', 'id');
    }
    public function brg_1(){
        return $this->hasMany('App\In', 'nm_brg1', 'id');
    }

    public function nbarang(){
        return $this->hasMany('App\Lapstok', 'id_barang', 'id');
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class,'nm_brg');
    }
    
}
