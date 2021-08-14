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
        $lapMetode = Hasilmetode::paginate(8);
        if($keyword != ""){
            $lapMetode = Hasilmetode::where ( 'nm_brg', 'LIKE', '%' . $keyword . '%' )->paginate (8)->setPath ( '' );
            $pagination = $lapMetode->appends ( array (
                'keyword' => $request->get('keyword') 
                ));
        }
        $profil = User::select('name','level')->where('level', '=', 1)->first();
        return view('laporan.result.index', compact('lapMetode','profil'));
    }
    public function cetakHasilMetode($tglhasil)
    {
        // dd(["Tanggal Laporan: ".$tglhasil]);
        $resultPerTanggal = Hasilmetode::with('brgs','jnsz')->where('tanggal', '=', $tglhasil)->get();
        return view('laporan.result.cetak-hasil-pertanggal', compact('resultPerTanggal'));
    }
}
