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
        $lapstok = Lapstok::paginate(8);
        if($keyword != ""){
            $lapstok = Lapstok::where ( 'nm_brg', 'LIKE', '%' . $keyword . '%' )->paginate (8)->setPath ( '' );
            $pagination = $lapstok->appends ( array (
                'keyword' => $request->get('keyword') 
                ));
        }
        $profil = User::select('name','level')->where('level', '=', 1)->first();
        return view('laporan.stok.index', compact('lapstok','profil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function cetakLapStok($tgllaporan)
    {
        // dd(["Tanggal Laporan: ".$tgllaporan]);
        
        $stokPerTanggal = Lapstok::with('barangz','jenisz')->where('tanggal', '=', $tgllaporan)->get();
        
        $tanggalStok = Lapstok::with('barangz','jenisz')->where('tanggal', '=', $tgllaporan)->first();
        return view('laporan.stok.cetak-stok-pertanggal', compact('stokPerTanggal','tanggalStok'));

        
    }
}
