<?php

namespace App\Http\Controllers;

use App\Categori;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $categoris = Categori::paginate(8);
        if($keyword != ""){
            $categoris = Categori::where ( 'kategori', 'LIKE', '%' . $keyword . '%' )->paginate (8)->setPath ( '' );
            $pagination = $categoris->appends ( array (
               'keyword' => $request->get('keyword') 
             ) );
        }
        return view('master.kategori.index', compact('categoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.kategori.create'); 
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
            'kategori' => 'required|max:255',
            
        ]);

        $categoris = Categori::create([
            'kategori' => request('kategori'),
                    
        ]);

        $categoris->save();

        return redirect('/kategori')->with('toast_success','Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categori  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoris = Categori::findorfail($id);

        return view('master.kategori.show', compact('categoris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categori  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $categoris = Categori::find($id);

        return view('master.kategori.edit', compact('categoris','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categori  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|max:255',
            
        ]);

        $categoris = Categori::find($id);

        $categoris->kategori = $request->get('kategori');
       

        $categoris->save();
        return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categori  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoris = Categori::findorfail($id);

		$categoris->delete();

		return redirect('/kategori')->with('success','Kategori barang berhasil dihapus!');
    }
    
    // {
    //     Categori::destroy($id);

    //     return response()->json([
    //         'success'    => true,
    //         'message'    => 'Products Delete Deleted'
    //     ]);
    // }
    public function apiCategori(){
        $categoris = Categori::all();

        return view($categoris);
            
            $categoris->addColumn('action', function($categoris){
                return
                    '<a onclick="deleteData('. $categoris->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);

    }
}
