<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $fillable = [
        'name',
        'no_telp'
    ];
    public function supl() {

        return $this->hasMany('App\In', 'suplier_id', 'id');

    }
}
