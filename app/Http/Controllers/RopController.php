<?php

namespace App\Http\Controllers;

use App\Eoq;
use App\Rop;
use App\User;
use App\Hasilmetode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RopController extends Controller
{   
    public function create()
    {
        $eoq = Eoq::all();
        // $per = DB::table('periodes')->select('periode','jml_hari')->get();
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        return view('method.rop.create', compact('eoq','profil')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'eoq_id'=> 'required',
            'leadtime'=> 'required',
        ]);
        $r = $request->leadtime * $request->eoq / $request->waktu;
        // dd($r);
        $rmetode = Hasilmetode::all()->where('eoq', '=', $request->eoq)->first();
        // dd($rmetode);
        $rmetode->rop = round($r, 2);
        $rops = Rop::create([
            'eoq_id' => request('eoq_id'),
            'rop' => round($r, 2),
            
        ]);
        $rmetode->save();
        // $rops->save();

        return redirect('/rop/create')->with('toast_success','Data berhasil tersimpan!');
    }

    function pickeoq($id, Request $request){

        $barang=new Eoq();
        $barang = $barang->select('eoqs.id','periode', 'frekuensi', 'leadtime', 'items.nm_brg', 'types.jns_brg', 'eoq')
                        ->where('eoqs.id','=',$id)
                        ->join('items', 'items_id', '=', 'items.id')
                        ->join('types', 'types_id', '=', 'types.id');
        return response()->json($barang->get());
    }
}

