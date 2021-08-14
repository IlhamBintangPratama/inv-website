<?php

namespace App\Http\Controllers;

use App\Type;
use App\Eoq;
use App\Hasilmetode;
use DB;
use Illuminate\Http\Request;

class EoqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eoqs = Eoq::all();
        return view('method.eoq.create', compact('eoqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::groupBy('items_id')->get('items_id');
        $per = DB::table('periodes')->select('periode','jml_hari')->get();

        return view('method.eoq.create', compact('types', 'per')); 
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
            'nm_brg'=> 'required',
            'jns_brg'=> 'required',
            'jml_hari' => 'required',
            'periode' => 'required',
            'hrg_item'=> 'required',
            'by_simpan'=> 'required',
            'by_pesan'=> 'required',
            'permintaan'=> 'required',
        ]);
        $simpan = $request->by_simpan/100;
        $pesan = $request->by_pesan;
        $periode = $request->jml_hari * $request->periode;
        $biayatotalpemesanan = $pesan * $request->permintaan;
        
        // $biayatotalsimpan = $simpan * $request->permintaan;
        $rumus1 = 2 * $request->permintaan * $pesan;
        $rumus2 = $request->hrg_item * $simpan;
        $eoq = $rumus1/$rumus2;
        $result = sqrt($eoq);
        
        
        $jumlahorder = $request->permintaan / $result;
        $leadtime = $periode / $jumlahorder;
        
        if($jumlahorder > $periode){
            $coba = $periode/$jumlahorder;
            $result2 = $result/$coba;
        }else{
            $result2 = sqrt($eoq);
        }
        
        $resultHitung = Hasilmetode::where('barang_id', '=', $request->nm_brg)->where('jenis_id', '=', $request->jns_brg)->where('eoq', '=', round($result2))->first();
        if($resultHitung == NULL){
            $resultHitung = Hasilmetode::create([
                'tanggal' => date('Y-m-d'),
                'barang_id' => request('nm_brg'),
                'jenis_id' => request('jns_brg'),
                'periode' => $periode,
                'permintaan' => request('permintaan'),
                'eoq' => round($result2),
                'frekuensi' => round($jumlahorder),
                'leadtime' => round($leadtime),
            ]);
        }

        $eoqs = Eoq::create([
            'items_id' => request('nm_brg'),
            'types_id' => request('jns_brg'),
            'periode' => $periode,
            'hrg_item' => request('hrg_item'),
            'by_simpan' => round($simpan),
            'by_pesan' => round($biayatotalpemesanan),
            'permintaan' => request('permintaan'),
            'eoq' => round($result2),
            'frekuensi' => round($jumlahorder),
            'leadtime' => round($leadtime),
            
        ]);
        $resultHitung->save();
        $eoqs->save();

        return redirect('/eoq/create')->with('toast_success','Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eoq  $eoq
     * @return \Illuminate\Http\Response
     */
    public function show(Eoq $eoq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eoq  $eoq
     * @return \Illuminate\Http\Response
     */
    public function edit(Eoq $eoq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eoq  $eoq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eoq $eoq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eoq  $eoq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eoq $eoq)
    {
        //
    }
    function picktypes($items_id, Request $request){

        $barang=new Type();
        $barang = $barang->select('types.id','jns_brg', 'hrg_item', 'items.by_pesan', 'items.by_simpan')
                        ->where('types.items_id','=',$items_id)
                        ->join('items', 'items_id', '=', 'items.id');
        return response()->json($barang->get());
    }
}
