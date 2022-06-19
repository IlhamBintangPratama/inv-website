<?php

namespace App\Http\Controllers;

use App\Lapstok;
use App\Out;
Use App\Stok;
use App\User;
use Illuminate\Http\Request;

class LapstoksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $tanggal = Lapstok::groupBy('tanggal')->get('tanggal');
        $lapstok = Lapstok::select('lapstoks.id','tanggal','items.nm_brg','id_jenis','awal','stok_masuk','stok_keluar','akhir')
                    ->join('items', 'id_barang', '=', 'items.id')->paginate(8);
        if($keyword != ""){
            $lapstok = Lapstok::where ( 'items.nm_brg', 'LIKE', '%' . $keyword . '%' )->join('items', 'id_barang', '=', 'items.id')
                        ->paginate (8)->setPath ( '' );
            $pagination = $lapstok->appends ( array (
                'keyword' => $request->get('keyword') 
                ));
        }
        $profil = User::select('name','level')->where('level', '=', 1)->first();

        return view('laporan.stok.index', compact('lapstok','profil','tanggal'));
    }

    public function periode(Request $request)
    {
        try{
            $awal = $request->tgl_awal;
            $akhir = $request->tgl_akhir;
            $tanggal = Lapstok::groupBy('tanggal')->get('tanggal');
            $lapstok = Lapstok::select('lapstoks.id','tanggal','items.nm_brg','id_jenis','awal','stok_masuk','stok_keluar','akhir')
            ->whereDate('tanggal', '>=', $awal)->whereDate('tanggal', '<=', $akhir)->orderBy('tanggal', 'desc')
            ->join('items', 'id_barang', '=', 'items.id')->paginate(8);

            $profil = User::select('name','level')->where('level', '=', 1)->first();
            return view('laporan.stok.index', compact('lapstok', 'profil','tanggal'));
        }catch(\Exception $e){
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tanggal = Lapstok::groupBy('tanggal')->get('tanggal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lapstok  $lapstok
     * @return \Illuminate\Http\Response
     */
    public function show(Lapstok $lapstok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lapstok  $lapstok
     * @return \Illuminate\Http\Response
     */
    public function edit(Lapstok $lapstok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lapstok  $lapstok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lapstok $lapstok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lapstok  $lapstok
     * @return \Illuminate\Http\Response
     */
    public function cetakLapStok($hasilfilter)
    {
        // dd(["Tanggal Laporan: ".$hasilfilter]);
        try{
            if($hasilfilter != null){
                $stokPerTanggal = Lapstok::with('barangz','jenisz')->where('tanggal', '=', $hasilfilter)->get();
                
                $tanggalStok = Lapstok::with('barangz','jenisz')->where('tanggal', '=', $hasilfilter)->first();
                return view('laporan.stok.cetak-stok-pertanggal', compact('stokPerTanggal','tanggalStok'));
            }else{
                return redirect()->back()->with('toast_error', 'Tanggal masih belum di isi');
            }
        }catch(\Exception $e){
            return redirect()->back();
        }
        
    }
}
