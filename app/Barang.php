<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nm_brg', 
        'by_simpan', 
        'by_pesan'
    ];

    protected $table = ['barang'];
}
