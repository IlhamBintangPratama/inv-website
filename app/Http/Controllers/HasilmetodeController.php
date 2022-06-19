<?php

namespace App\Http\Controllers;

use App\Hasilmetode;
use App\User;
use Illuminate\Http\Request;

class HasilmetodeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $lapMetode = Hasilmetode::select('hasilmetodes.id','tanggal','items.nm_brg','jenis_id','periode','permintaan','eoq','frekuensi','leadtime','rop')
                    ->join('items', 'barang_id', '=', 'items.id')->paginate(8);
        if($keyword != ""){
            $lapMetode = Hasilmetode::where ( 'items.nm_brg', 'LIKE', '%' . $keyword . '%' )->join('items', 'barang_id', '=', 'items.id')->paginate (8)->setPath ( '' );
            $pagination = $lapMetode->appends ( array (
                'keyword' => $request->get('keyword') 
                ));
        }
        // this->validate($request,[
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|before_or_equal:start_date',
        // ]);
        
        // $start = Carbon::parse($request->tgl_awal);
        // $end = Carbon::parse($request->);
        
        // $get_all_user = User::whereDate('date','<=',$end->format('m-d-y'))
        // ->whereDate('date','>=',$start->format('m-d-y'));

        $profil = User::select('name','level')->where('level', '=', 1)->first();
        return view('laporan.result.index', compact('lapMetode','profil'));
    }
    public function periode(Request $request)
    {
        try{
            $awal = $request->tgl_awal;
            $akhir = $request->tgl_akhir;

            $lapMetode = Hasilmetode::select('hasilmetodes.id','tanggal','items.nm_brg','jenis_id','periode','permintaan','eoq','frekuensi','leadtime','rop')
            ->whereDate('tanggal', '>=', $awal)->whereDate('tanggal', '<=', $akhir)->orderBy('tanggal', 'desc')
            ->join('items', 'barang_id', '=', 'items.id')->paginate(8);

            $profil = User::select('name','level')->where('level', '=', 1)->first();
            return view('laporan.result.index', compact('lapMetode','profil'));
        }catch(\Exception $e){
            return redirect()->back();
        }
    }

    public function cetakHasilMetode($tglawal, $tglakhir)
    {
        // dd(["Tanggal Awal: ".$tglawal, "Tanggal Akhir" .$tglakhir]);
        $resultPerTanggal = Hasilmetode::with('brgs','jnsz')->whereBetween('tanggal',[$tglawal, $tglakhir])->get();
        return view('laporan.result.cetak-hasil-pertanggal', compact('resultPerTanggal'));
    }

    public function search(Request $request)
    {   
        $tglAwal = $request->get('tgl_awal');
        $tglAkhir = $request->get('tgl_akhir');
        $lapMetode = Hasilmetode::select('hasilmetodes.id','tanggal','items.nm_brg','jenis_id','periode','permintaan','eoq','frekuensi','leadtime','rop')
                    ->whereDate('tanggal', '>=', '%'. $tglAwal . '%' )
                    ->whereDate('tanggal', '<=', '%'. $tglAkhir . '%' )
                    ->join('items', 'barang_id', '=', 'items.id')->paginate(8);
        dd($lapMetode);

        $profil = User::select('name','level')->where('level', '=', 1)->first();
        return view('laporan.result.index', compact('lapMetode', 'profil'));
    }
}
