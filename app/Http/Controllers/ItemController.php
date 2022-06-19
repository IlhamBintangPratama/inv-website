<?php

namespace App\Http\Controllers;

use App\Item;
use App\Stok;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $keyword = $request->get('keyword');
        $items = Item::paginate(8);
        if($keyword != ""){
            $items = Item::where ( 'nm_brg', 'LIKE', '%' . $keyword . '%' )->paginate (8)->setPath ( '' );
            $pagination = $items->appends ( array (
            'keyword' => $request->get('keyword') 
            ) );
        }
        $profil = User::select('name','level')->where('level', '=', 1)->first();
        
        return view('master.barang.index', compact('items','profil'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.barang.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus angka',
        ];
        $attributes = [
            'nm_brg' => 'Nama Barang',
            'by_simpan' => 'Biaya Simpan',
            'by_pesan' => 'Biaya Pesan'
        ];

        $request->validate([
            'nm_brg' => 'required|max:255',
            'by_simpan'=> 'required|numeric',
            'by_pesan' => 'required|numeric',
        ], $messages, $attributes);

        $items = Item::create([
            'nm_brg' => request('nm_brg'),
            'by_simpan' => request('by_simpan'),
            'by_pesan' => request('by_pesan'),
            
        ]);
        
        $items->save();

        return redirect('/barang')->with('toast_success','Data berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Item::findorfail($id);

        return view('master.barang.show', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Item::find($id);

        return view('master.barang.edit', compact('items','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $messages = [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus angka',
        ];
        $attributes = [
            'nm_brg' => 'Nama Barang',
            'by_simpan' => 'Biaya Simpan',
            'by_pesan' => 'Biaya Pesan'
        ];
        $request->validate([
            'nm_brg' => 'required|max:255',
            'by_simpan'=> 'required|numeric',
            'by_pesan' => 'required|numeric',
        ],$messages, $attributes);
        
        $items = Item::find($id);
        
        $items->nm_brg = $request->get('nm_brg');
        $items->by_simpan = $request->get('by_simpan');
        $items->by_pesan = $request->get('by_pesan');

        $items->save();
        return redirect('/barang')->with('toast_success','Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Item::findorfail($id);

		$items->delete();

		return redirect('/barang')->with('toast_warning','Data berhasil dihapus!');
    }
}
