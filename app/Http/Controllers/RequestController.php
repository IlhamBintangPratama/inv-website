<?php

namespace App\Http\Controllers;

use App\Eoq;
use App\Requeststok;
use App\Type;
use App\User;
use App\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $eoqresult = Eoq::where('status','=', 1)->paginate(5);
        // $stok_2 = Stok::find($id);
        $permintaan = Requeststok::paginate(5); 
        $stokss = Type::groupBy('items_id')->get('items_id');
        $restok = Stok::where('stok', '<=', 300)->paginate(5);
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();

        return view('transaksi.permintaan.create', compact('eoqresult','stokss','restok','permintaan', 'profil'));
    }
    public function create($id)
    {
        
        $stokss = Type::groupBy('items_id')->get('items_id');
        return view('transaksi.permintaan.create',compact('stokss')); 
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
            'jns_brg' => 'required|max:255',
            'jumlah'=> 'required',
            'waktu_pemesanan'=> 'required',
            'frekuensi'=> 'required',
        ]);

        if($request->status != null){
            $sts = Eoq::where('id', $request->id_eoq)->first();
            if($request->status != 1){
                $sts->status = 1;
                
            }else{
                $sts->status = 0;
            }
            $sts->save();
        }
        
        $stks = Requeststok::create([
            'idbarang' => request('nm_brg'),
            'idjenis' => request('jns_brg'),
            'jumlah' => request('jumlah'),
            'tanggal' => date('Y-m-d'),
            'waktu_pemesanan' => request('waktu_pemesanan'),
            'frekuensi' => request('frekuensi'),
        ]);
        
        
        $stks->save();

        return redirect('/permintaan')->with('toast_success','Data berhasil tersimpan!');
    }
    
    public function destroy($id)
    { 
        
		
        $applicant_id = Requeststok::findOrFail($id);
        $applicant_id->delete();
        return redirect('/permintaan')->with('toast_warning','Data berhasil dihapus!');
    }

    function listrequest($items_id, Request $request){

        $barang=new Type();
        $barang = $barang->select('id','jns_brg')
                        ->where('items_id','=',$items_id);
        return response()->json($barang->get());
    }
}
