<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    protected $fillable = [
        'bulan',
        'brg_id',
        'jumlah'
    ];
    public function nItem() {

        return $this->belongsTo('App\Item', 'brg_id', 'id');
    }
}
