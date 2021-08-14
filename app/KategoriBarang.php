<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class KategoriBarang extends Model
{
    protected $table = 'kategori_barang';

    protected $guarded = [];

    public function barang(){
        return $this->hasMany(Item::class,'katgori_barang_id');
    }


}
