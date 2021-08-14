<?php

namespace App\Http\Controllers;

use App\In;
use App\Stok;
use App\Type;
use App\Item;
use App\User;
use Illuminate\Http\Request;

class InController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $ins = In::select('ins.id','stoks_id','items.nm_brg','jns_brg1','awal','jumlah','tanggal','hrg_item')
                    ->join('items', 'nm_brg1', '=', 'items.id')
                    ->paginate(8);
        if($keyword != ""){
        $ins = In::where ('items.nm_brg', 'LIKE', '%' . $keyword . '%' )->join('items', 'nm_brg1', '=', 'items.id')
                            ->paginate (8)->setPath ( '' );
        $pagination = $ins->appends ( array (
            'keyword' => $request->get('keyword') 
            ) );
        }
        $profil = User::select('name','level')->where('level', '=', 1)->first();
        // dd($profil);
        return view('transaksi.masuk.index', compact('ins', 'profil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\In  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ins = In::findorfail($id);

        return view('transaksi.masuk.show', compact('ins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\In  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ins = In::find($id);
        $stokss = Type::groupBy('items_id')->get('items_id');
        $stks = Type::all();
        return view('transaksi.masuk.edit', compact('ins','stokss', 'stks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\In  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_brg' => 'required|max:255',
            'jns_brg'=> 'required',
            'jumlah' => 'required',
            'tanggal' => 'required',
            'hrg_item' => 'required',
        ]);
        $ins = In::find($id);
        $result1 = $request->jumlah-$ins->jumlah;
        $result2 = $ins->jumlah-$request->jumlah;
        $st = Stok::where('id', '=', $request->stoks_id)->first();
        if($ins->jumlah < $request->jumlah ){
            
            $st->stok += $result1; 
        }else{
            $st->stok -= $result2;  
            
        }
            
            $ins->nm_brg1 = $request->get('nm_brg');
            $ins->jns_brg1 = $request->get('jns_brg');
            $ins->jumlah = $request->jumlah;
            $ins->tanggal = $request->get('tanggal');
            $ins->hrg_item = $request->get('hrg_item');
        
        $st->save();
        $ins->save();
        return redirect('/masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\In  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ins = In::findorfail($id);
        // $st = Stok::where('id', '=', $ins->stoks_id)->first();
        // $st->stok -= $ins->jumlah;
        // $st->save();
		$ins->delete();

		return redirect('/masuk')->with('status','Data barang masuk berhasil dihapus!');
    }
    function editmasuk($items_id, Request $request){

        $barang=new Type();
        $barang = $barang->select('id','jns_brg')
                        ->where('items_id','=',$items_id);
        return response()->json($barang->get());
    }
    
}
