<?php

namespace App\Http\Controllers\Su_admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\In;
use App\Out;
use App\Stok;
use Illuminate\Support\Facades\DB;

class ManaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $keyword = $request->get('keyword');
        $mana_user = User::whereBetween('level', [1 , 2])->paginate(8);
        // $role = User::whereBetween('level', [1 , 2]);
        if($keyword != ""){
            $mana_user = User::where ( 'email', 'LIKE', '%' . $keyword . '%' )->paginate (8)->setPath ( '' );
            $pagination = $mana_user->appends ( array (
            'keyword' => $request->get('keyword') 
            ) );
        }

        $profil = User::select('name','level')->where('level', '=', 3)->first();
        // $role = User::select('level')->whereBetween('level', [1 , 2]);

        return view('manager.mana_user.index', compact('mana_user','profil'));
    }

    public function index1(){
        $kapasitas = DB::table('stoks')->sum('stok');

        $tes = DB::table('stoks')->where('stoks.items_id', '=', '1')->sum('stok');
        $group = Stok::select('stoks.items_id', 'items.nm_brg', 'types_id', 'stok')
                        ->where('stoks.items_id', '=', '1')
                        ->join('items', 'items_id', '=', 'items.id')
                        ->get();

        $stoks = Stok::orderBy('items_id', 'asc')->orderBy('types_id', 'asc')->paginate(8);
        // $data = [intval($tes)];
        // $nama = '';
        
        // foreach($group as $grp){
        //     $data[] = $data;
        //     $nama = $grp->nm_brg;  
        // }
        $profil = User::select('name','level')->where('level', '=', 3)->first();

        return view('manager.dashmanager', compact('kapasitas', 'profil', 'stoks'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $profil = User::select('name','level')->where('level', '=', 3)->first();

        return view('manager.mana_user.create', compact('profil'));
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
            'nm_user' => 'required|max:255',
            'email'=> 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $mana_user = User::create([
            'name' => request('nm_user'),
            'email' => request('email'),
            'password' => Hash::make($request->get('password')),
            'level' => request('role'),
        ]);
        
        $mana_user->save();
        
        return redirect('/mana_user')->with('toast_success','Data berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mana_user = User::findorfail($id);
        $profil = User::select('name','level')->where('level', '=', 3)->first();
        return view('manager.mana_user.show', compact('mana_user', 'profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mana_user = User::find($id);
        $profil = User::select('name','level')->where('level', '=', 3)->first();

        return view('manager.mana_user.edit', compact('mana_user', 'id', 'profil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $item
     * @return \Illuminate\Http\Response
     */
    public function edit_jual($id)
    {
        $mana_user = Stok::find($id);
        $profil = User::select('name','level')->where('level', '=', 3)->first();

        return view('manager.produk_jual.edit', compact('mana_user', 'id', 'profil'));
    }

    public function update(Request $request, $id)
    {   
        
        $request->validate([
            'nm_user' => 'required|max:255',
            'email'=> 'required',
            // 'password' => 'required',
            // 'role' => 'required',
        ]);
        
        $mana_user = User::find($id);
        
        $mana_user->name = $request->get('nm_user');
        $mana_user->email = $request->get('email');
        // $mana_user->password = Hash::make($request->get('password'));
        // $mana_user->level = $request->get('role');
        $mana_user->save();
        return redirect('/mana_user')->with('toast_success','Data berhasil di ubah!');
    }
    public function update_jual(Request $request, $id)
    {   
        
        $request->validate([
            'hrg_jual'=> 'required',
            // 'password' => 'required',
            // 'role' => 'required',
        ]);
        
        $mana_user = Stok::find($id);
        $mana_user->hrg_jual = $request->get('hrg_jual');
        // $mana_user->password = Hash::make($request->get('password'));
        // $mana_user->level = $request->get('role');
        $mana_user->save();
        return redirect('/dashboard')->with('toast_success','Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mana_user = User::findorfail($id);

		$mana_user->delete();

		return redirect('/mana_user')->with('toast_warning','Data berhasil dihapus!');
    }

    //Laporan Masuk
    public function in_report(Request $request)
    {
        $keyword = $request->get('keyword');
        $tanggal = In::groupBy('tanggal')->get('tanggal');
        $in_report = In::select('ins.id','tanggal','suplier_id','items.nm_brg','jns_brg1','jumlah','hrg_item','total')
                    ->join('items', 'nm_brg1', '=', 'items.id')->paginate(8);
        if($keyword != ""){
            $in_report = In::where ( 'items.nm_brg', 'LIKE', '%' . $keyword . '%' )->join('items', 'nm_brg1', '=', 'items.id')
                        ->paginate (8)->setPath ( '' );
            $pagination = $in_report->appends ( array (
                'keyword' => $request->get('keyword') 
                ));
        }
        $profil = User::select('name','level')->where('level', '=', 3)->first();

        return view('manager.laporan_masuk.index', compact('in_report','profil','tanggal'));
    }

    public function periode(Request $request)
    {
        try{
            $awal = $request->tgl_awal;
            $akhir = $request->tgl_akhir;

            $in_report = In::select('ins.id','tanggal','suplier_id','items.nm_brg','jns_brg1','jumlah','hrg_item','total')
            ->whereDate('tanggal', '>=', $awal)->whereDate('tanggal', '<=', $akhir)->orderBy('tanggal', 'desc')
            ->join('items', 'nm_brg1', '=', 'items.id')->paginate(8);

            $profil = User::select('name','level')->where('level', '=', 3)->first();

            return view('manager.laporan_masuk.index', compact('in_report', 'profil'));
        }catch(\Exception $e){
            return redirect()->back();
        }
    }

    public function cetakMasuk($tglawal, $tglakhir)
    {
        // dd(["Tanggal Awal: ".$tglawal, "Tanggal Akhir" .$tglakhir]);
        $resultPerTanggal = In::with('suplier','brg1','jns1')->whereBetween('tanggal',[$tglawal, $tglakhir])->get();
        return view('manager.laporan_masuk.cetak-masuk-pertanggal', compact('resultPerTanggal'));
    }

    //Laporan Keluar
    public function out_report(Request $request)
    {
        $keyword = $request->get('keyword');
        $tanggal = Out::groupBy('tanggal')->get('tanggal');
        $out_report = Out::select('outs.id','tanggal','buyer','items.nm_brg','jns_id','jumlah','kategori')
                    ->join('items', 'id_brg', '=', 'items.id')->paginate(8);
        if($keyword != ""){
            $out_report = Out::where ( 'items.nm_brg', 'LIKE', '%' . $keyword . '%' )->join('items', 'id_brg', '=', 'items.id')
                        ->paginate (8)->setPath ( '' );
            $pagination = $out_report->appends ( array (
                'keyword' => $request->get('keyword') 
                ));
        }
        $profil = User::select('name','level')->where('level', '=', 3)->first();

        return view('manager.laporan_keluar.index', compact('out_report','profil','tanggal'));
    }
    public function periode1(Request $request)
    {
        try{
            $awal = $request->tgl_awal;
            $akhir = $request->tgl_akhir;

            $out_report = Out::select('outs.id','tanggal','buyer','items.nm_brg','jns_id','jumlah','kategori')
            ->whereDate('tanggal', '>=', $awal)->whereDate('tanggal', '<=', $akhir)->orderBy('tanggal', 'desc')
            ->join('items', 'id_brg', '=', 'items.id')->paginate(8);

            $profil = User::select('name','level')->where('level', '=', 3)->first();

            return view('manager.laporan_keluar.index', compact('out_report', 'profil'));
        }catch(\Exception $e){
            return redirect()->back();
        }
    }

    public function cetakKeluar($tglawal, $tglakhir)
    {
        // dd(["Tanggal Awal: ".$tglawal, "Tanggal Akhir" .$tglakhir]);
        $resultPerTanggal = Out::with('item1','type1')->whereBetween('tanggal',[$tglawal, $tglakhir])->get();
        return view('manager.laporan_keluar.cetak-keluar-pertanggal', compact('resultPerTanggal'));
    }
}
