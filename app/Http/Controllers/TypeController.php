<?php

namespace App\Http\Controllers;

use App\Type;
use App\Item;
use App\Stok;
use App\User;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {   
        $keyword = $request->get('keyword');
        $types = Type::select('types.id', 'items.nm_brg', 'jns_brg')
                    ->join('items', 'items_id', '=', 'items.id')->paginate(8);
        if($keyword != ""){
            $types = Type::where ( 'items.nm_brg', 'LIKE', '%' . $keyword . '%' )->join('items', 'items_id', '=', 'items.id')
                        ->paginate (8)->setPath ( '' );
            $pagination = $types->appends ( array (
            'keyword' => $request->get('keyword') 
            ) );
        }
        $profil = User::select('name','level')->where('level', '=', 1)->first();
        return view('master.jenis.index', compact('types','profil'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.jenis.create'); 
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
            'items_id' => 'required',
            'jns_brg' => 'required|max:255',
        ]);

        $types = Type::create([
            'items_id' => request('items_id'),
            'jns_brg' => request('jns_brg'),
        ]);

        $types->save();

        return redirect('/jenis')->with('toast_success','Data berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $types = Type::findorfail($id);

        return view('master.jenis.show', compact('types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = Type::find($id);
        $items = Type::groupBy('items_id')->get('items_id');

        return view('master.jenis.edit', compact('types','id','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'items_id' => 'required',
            'jns_brg' => 'required|max:255',
        ]);

        $types = Type::find($id);
        $types->items_id = $request->get('items_id');
        $types->jns_brg = $request->get('jns_brg');

        $types->save();
        return redirect('/jenis')->with('toast_success','Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $types = Type::findorfail($id);

		$types->delete();

		return redirect('/jenis')->with('toast_warning','Data berhasil dihapus!');
    }
}
