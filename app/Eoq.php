<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eoq extends Model
{
    protected $fillable = [
        'items_id',
        'types_id',
        'periode',
        'hrg_item',
        'by_pesan',
        'by_simpan',
        'permintaan',
        'eoq',
        'frekuensi',
        'leadtime'
    ];
    public function typ_items() {

        return $this->belongsTo('App\Item', 'items_id','id');

    }
    public function jns_items() {

        return $this->belongsTo('App\Type', 'types_id', 'id');

    }
    public function eoq(){
        return $this->hasMany('App\Rop', 'eoq_id', 'id');
    }
}
