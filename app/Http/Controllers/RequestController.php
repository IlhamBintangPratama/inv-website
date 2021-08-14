<?php

namespace App\Http\Controllers;

use App\Eoq;
use App\Requeststok;
use App\Type;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $eoqresult = Eoq::all();
        $permintaan = Requeststok::paginate(5); 
        $stokss = Type::groupBy('items_id')->get('items_id');
        return view('transaksi.permintaan.create', compact('eoqresult','stokss' ,'permintaan'));
    }
    public function create()
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

        $stks = Requeststok::create([
            'idbarang' => request('nm_brg'),
            'idjenis' => request('jns_brg'),
            'jumlah' => request('jumlah'),
            'tanggal' => date('Y-m-d'),
            'waktu_pemesanan' => request('waktu_pemesanan'),
            'frekuensi' => request('frekuensi'),
            
        ]);

        $stks->save();

        return redirect('/permintaan')->with('toast_success','Data berhasil tersimpan');
    }
    
    public function destroy($id)
    { 
        
		
        $applicant_id = Requeststok::findOrFail($id);
        $applicant_id->delete();
        return redirect('/permintaan')->with('toast_success','Data berhasil dihapus');
    }

    function listrequest($items_id, Request $request){

        $barang=new Type();
        $barang = $barang->select('id','jns_brg')
                        ->where('items_id','=',$items_id);
        return response()->json($barang->get());
    }
}
