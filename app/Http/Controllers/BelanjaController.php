<?php

namespace App\Http\Controllers;

use App\In;
use App\Stok;
use App\Item;
use App\Type;
use App\Lapstok;
use App\Requeststok;
use App\User;
use App\Suplier;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class BelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stk = Stok::all();
        
        return view('purchase.index', compact('stk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $stokss = Type::groupBy('items_id')->get('items_id');
        $tgl = date('Y-m-d');
        $rincian = In::with('suplier','brg1', 'jns1')->where('tanggal', '=', $tgl)->paginate(7);
        $awal = Stok::groupBy('items_id')->get('items_id');
        $suplier = Suplier::all();
        $awal1 = In::get('tanggal');
        $groupstok = Stok::select('stoks.id', 'stoks.items_id', 'stoks.types_id', 'stok', 'items.nm_brg', 'types.jns_brg')
                            ->where('stoks.items_id', '=', '1')
                            ->join('items', 'items_id', '=', 'items.id')
                            ->join('types', 'types_id', '=', 'types.id')->get();
                            
        $groupstok1 = Stok::select('stoks.id', 'stoks.items_id', 'stoks.types_id', 'stok', 'items.nm_brg', 'types.jns_brg')
                            ->where('stoks.items_id', '=', '2')
                            ->join('items', 'items_id', '=', 'items.id')
                            ->join('types', 'types_id', '=', 'types.id')->get();
        $groupstok2 = Stok::select('stoks.id', 'stoks.items_id', 'stoks.types_id', 'stok', 'items.nm_brg', 'types.jns_brg')
                            ->where('stoks.items_id', '=', '3')
                            ->join('items', 'items_id', '=', 'items.id')
                            ->join('types', 'types_id', '=', 'types.id')->get();
        return view('purchase.index',compact('awal', 'groupstok', 'groupstok1', 'groupstok2','rincian','suplier')); 
    }

    public function create1(Request $request)
    {
        // // $stokss = Type::groupBy('items_id')->get('items_id');
        // $awal = Stok::groupBy('items_id')->get('items_id'); 
        $awal1 = In::groupBy('tanggal')->get('tanggal');
    
        return view('purchase.riwayat',compact('awal1'));
    }
    public function create2()
    {
        // // $stokss = Type::groupBy('items_id')->get('items_id');
        // $awal = Stok::groupBy('items_id')->get('items_id');
        $awal1 = Requeststok::groupBy('tanggal')->get('tanggal');
        $data_request = Requeststok::with('permStok', 'permStok2')->paginate(8);
        // dd($awal1);
        return view('purchase.kebutuhan',compact('awal1','data_request'));
    }

    public function status_update($id)
    {
        $request = DB::table('requeststoks')
                            ->select('status')
                            ->where('id', '=', $id)
                            ->first();
        if($request->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        $values = array('status' => $status);
        DB::table('requeststoks')->where('id', $id)->update($values);

        session()->flash('toast_success', 'Status telah di ubah');
        // dd($awal1);
        return redirect('/purchase/kebutuhan');
    }

    public function dataSuplier()
    {
        // // $stokss = Type::groupBy('items_id')->get('items_id');
        // $awal = Stok::groupBy('items_id')->get('items_id');
        $awal1 = Suplier::paginate(8);
        // $data_request = Requeststok::with('permStok', 'permStok2')->paginate(8);
        // dd($awal1);
        return view('purchase.suplier',compact('awal1'));
    }

    public function showProfil()
    {
        // // $stokss = Type::groupBy('items_id')->get('items_id');
        // $awal = Stok::groupBy('items_id')->get('items_id');
        $profil = User::select('id','name','email')->where('level', '=', 2)->first();
        // dd($profil);
        return view('purchase.profil', compact('profil'));
    }
    public function changeProfil(Request $request)
    {
    
            // dd($qwe);
            if (!Hash::check($request->get('current-password'), Auth::user()->password)) {
                // The passwords matches
                // dd(Auth::user()->password);
                return redirect()->back()->with("toast_error","Kata sandi Anda saat ini tidak cocok dengan kata sandi yang Anda berikan. Silakan coba lagi.");
            }
            
            if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
                //Current password and new password are same
                return redirect()->back()->with("toast_error","Kata Sandi Baru tidak boleh sama dengan kata sandi Anda saat ini. Silakan pilih kata sandi yang berbeda.");
            }
            if($request->get('new-password')==null){
                $profil = User::where('id', '=', Auth::user()->id)->first();
                $profil->name = $request->get('name');
                $profil->email = $request->get('email');
                $profil->save();
                }else{
                $validatedData = $request->validate([
                    'email' => 'required',
                    'name' => 'required',
                    'current-password' => 'required',
                    'new-password_confirmation' => 'required',
                    'new-password' => 'string|min:6|same:new-password_confirmation',
                ]);
                //Change Profile
                $profil = User::where('id', '=', Auth::user()->id)->first();
                $profil->name = $request->get('name');
                $profil->email = $request->get('email');
                //Change Password
                $user = Auth::user();
                $user->password = Hash::make($request->get('new-password'));
                
                $user->save();
                $profil->save();
                }
            // $validatedData = $request->validate([
            //     'username' => 'required',
            //     'email' => 'required',
            //     'current-password' => 'required',
            //     'new-password' => 'string|min:6|confirmed',
            // ]);
            // //Change Profile
            // $profil = User::where('id', '=', 2)->first();
            // $profil->name = $request->get('username');
            // $profil->email = $request->get('email');
            // //Change Password
            // $user = Auth::user();
            // $user->password = (\Hash::make($request->get('new-password')));
            
            // $user->save();
            // $profil->save();
    
            return redirect()->back()->with("toast_success","Password changed successfully !");
    
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
            'nm_brg' => 'required|max:255',
            'jns_brg'=> 'required',
            'awal' => 'required',
            'jumlah' => 'required',
            'hrg_item' => 'required',
            'tanggal' => 'required',
            'suplier' => 'required',
        ]);

        $stoks = Stok::where('items_id','=', $request->nm_brg)->where('types_id','=', $request->jns_brg)->first();
        // $kapasitas = DB::table('stoks')->sum('stok');
        
        // dd($stoks);/
        $stoks->stok += $request->jumlah;
        $stoks->hrg_beli = $request->hrg_item;
        
        
        // }else{
        //     return redirect('/purchase/index')->with('toast_warning','Pembelian melebihi batas stok');
        // }

        $hargaupdate = Type::where('items_id','=', $request->nm_brg)->where('id','=', $request->jns_brg)->first();
        $hargaupdate->hrg_item = $request->hrg_item;
        // dd($hargaupdate);
        $stklaps = Lapstok::where('tanggal', '=', $request->tanggal)->where('id_barang', '=', $request->nm_brg)->where('id_jenis', '=', $request->jns_brg)
        ->first();
        
        if($stklaps == NULL){
            $stklaps = Lapstok::create([
            'id_barang' => $request->nm_brg,
            'id_jenis' => $request->jns_brg,
            'awal' => $request->awal,
            'stok_masuk' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'akhir' => $request->awal + $request->jumlah,
            ]);
        }else{
            $stklaps->stok_masuk = $request->jumlah;
            $stklaps->akhir = $request->awal + $request->jumlah;
        }

        $ins = In::create([
            'stoks_id' => $stoks->id,
            'nm_brg1' => $request->nm_brg,
            'jns_brg1' => $request->jns_brg,
            'awal' => $request->awal,
            'jumlah' => $request->jumlah,
            'hrg_item' => $request->hrg_item,
            'total' => $request->hrg_item * $request->jumlah,
            'tanggal' => $request->tanggal,
            'suplier_id' => $request->suplier,
        ]);
        
        $hargaupdate->save();
        $stklaps->save();
        $stoks->save();

        return redirect('home')->with('toast_success','Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Belanja  $belanja
     * @return \Illuminate\Http\Response
     */
    public function updatePermintaan($id)
    {
        $request->validate([
            'status' => 'required',
        ]);
        
        $items = Requeststok::find($id);
        
        $items->status = $request->get('status');
        
        $items->save();
        return redirect('/purchase/kebutuhan')->with('toast_success','Data berhasil di ubah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Belanja  $belanja
     * @return \Illuminate\Http\Response
     */
    public function tambahSuplier(Request $request)
    {
        $request->validate([
            'suplier' => 'required',
            'no_telp' => 'required|digits:10',
            // 'hrg_item' => 'required',
        ]);

        $supl = Suplier::create([
            'name' => request('suplier'),
            'no_telp' => request('no_telp'),
            // 'hrg_item' => request('hrg_item'),
        ]);

        $supl->save();

        return redirect('/home')->with('toast_success','Data berhasil tersimpan!');
    }

    public function tambahSuplier2(Request $request)
    {
        $request->validate([
            'suplier' => 'required',
            'no_telp' => 'required|max:255',
            // 'hrg_item' => 'required',
        ]);

        $supl = Suplier::create([
            'name' => request('suplier'),
            'no_telp' => request('no_telp'),
            // 'hrg_item' => request('hrg_item'),
        ]);

        $supl->save();

        return redirect('/purchase/suplier')->with('toast_success','Data berhasil tersimpan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Belanja  $belanja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Belanja $belanja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Belanja  $belanja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $applicant_id = Suplier::findOrFail($id);
        $applicant_id->delete();
        return redirect('purchase/suplier')->with('toast_warning','Data berhasil dihapus!');
    }
    public function destroy2($id)
    {
        $applicant_id = In::findOrFail($id);
        $applicant_id->delete();
        return redirect('purchase/riwayat')->with('toast_warning','Data berhasil dihapus!');
    }
    function listtypes($items_id, Request $request){

        $barang= new Stok();
        $barang = $barang->select('stoks.id','types_id','stok','types.jns_brg')
                        ->where('stoks.items_id','=',$items_id)
                        ->join('types', 'types_id' , '=', 'types.id');
        
        // dd($barang);
        return response()->json($barang->get());
        
    }
    function listriwayat($tanggal, Request $request){

        $awal1 = In::groupBy('tanggal')->get('tanggal');
        $tgl = $request->tanggal;
        // dd($tgl);
        // dd($awal1);
        // $stokPerTanggal = Lapstok::with('barangz','jenisz')->where('tanggal', '=', $tgllaporan)->get();
        $riwayat= In::with('suplier','brg1', 'jns1')->where('tanggal', '=', $tanggal)->get();
        return view('purchase.riwayat-per', compact('riwayat','awal1', 'tgl'));
    }
    function kebutuhan($tanggal, request $request){

    $tanggal_kebutuhan = Requeststok::groupBy('tanggal')->get('tanggal');
    $kebutuhan = Requeststok::with('permStok', 'permStok2')->where('tanggal', '=', $tanggal)->paginate(8);

        return view('purchase.tanggal-kebutuhan', compact('tanggal_kebutuhan','kebutuhan'));
    }
    public function cetakRiwayat($tgl_riwayat)
    {
        $stokPerTanggal = In::with('brg1', 'jns1')->where('tanggal', '=', $tgl_riwayat)->get();
        
        $tanggalStok = In::with('brg1', 'jns1')->where('tanggal', '=', $tgl_riwayat)->first();
        return view('purchase.cetak-riwayat', compact('stokPerTanggal','tanggalStok'));
    }

}
