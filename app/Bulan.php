<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    protected $fillable = [
        'nm_bulan'
    ];
    public function bulan() {

        return $this->hasMany('App\Out', 'id_bulan', 'id');
    }
    public function nmBulan() {

        return $this->hasMany('App\Chart', 'bulan', 'id');
    }
}
