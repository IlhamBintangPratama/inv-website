<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rop extends Model
{
    protected $fillable = [
        'eoq_id',
        'rop'
    ];
    public function eoq_id() {

        return $this->belongsTo('App\Eoq', 'eoq_id', 'id');

    }
}
