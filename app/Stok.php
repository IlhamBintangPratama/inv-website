<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $fillable = [
        'items_id',
        'types_id',
        'stok',
        'tanggal'
    ];
    public function total_items() {

        return $this->hasMany('App\Out', 'stoks_id');
    }
    public function tot_item() {

        return $this->hasMany('App\In', 'stoks_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'items_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Type', 'types_id', 'id');
    }
    
    public static function stok(){
        $result=Array();
        $query=DB::table('stoks')
            ->select('stoks.id','nm_brg','jns_brg')
            ->join('items', 'stoks.items_id','=','items.id' ,'AND', 'types', 'stoks.types_id', 'types.id' )
            ->get();
    }
}
