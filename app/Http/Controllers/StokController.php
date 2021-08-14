<?php

namespace App\Http\Controllers;

use App\Stok;
use App\Item;
use App\Type;
use App\Bulan;
use App\Chart;
use DB;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart = Bulan::select('id', 'nm_bulan')->get();
        $group = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
                        ->where('charts.brg_id', '=', '1')
                        ->join('bulans', 'bulan', '=', 'bulans.id')
                        ->join('items', 'brg_id', '=', 'items.id')->get();
        $group1 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
                        ->where('charts.brg_id', '=', '2')
                        ->join('bulans', 'bulan', '=', 'bulans.id')
                        ->join('items', 'brg_id', '=', 'items.id')->get();
        $group2 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
                        ->where('charts.brg_id', '=', '3')
                        ->join('bulans', 'bulan', '=', 'bulans.id')
                        ->join('items', 'brg_id', '=', 'items.id')->get();
        $group3 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
                        ->where('charts.brg_id', '=', '4')
                        ->join('bulans', 'bulan', '=', 'bulans.id')
                        ->join('items', 'brg_id', '=', 'items.id')->get();
        $group4 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
                        ->where('charts.brg_id', '=', '5')
                        ->join('bulans', 'bulan', '=', 'bulans.id')
                        ->join('items', 'brg_id', '=', 'items.id')->get();
        $stoks = Stok::paginate(8);
        $categories = [];
        $data = [];
        $nama = '';
        $data1 = [];
        $nama1 = '';
        $data2 = [];
        $nama2 = '';
        $data3 = [];
        $nama3 = '';
        $data4 = [];
        $nama4 = '';
        foreach($chart as $ch){
            $categories[] = $ch->nm_bulan;
        }
        foreach($group as $grp){
            $data[] = intval($grp->jumlah);
            $nama = $grp->nm_brg;
            
        }
        foreach($group1 as $grp1){
            $data1[] = intval($grp1->jumlah);
            $nama1 = $grp1->nm_brg;
            
        }
        foreach($group2 as $grp3){
            $data2[] = intval($grp3->jumlah);
            $nama2 = $grp3->nm_brg;
            
        }
        foreach($group3 as $grp2){
            $data3[] = intval($grp2->jumlah);
            $nama3 = $grp2->nm_brg;
            
        }
        foreach($group4 as $grp4){
            $data4[] = intval($grp4->jumlah);
            $nama4 = $grp4->nm_brg;
            
        }

        $kapasitas = DB::table('stoks')->sum('stok');

        return view('dashboard', compact('kapasitas','stoks','categories', 'data', 'nama','data1', 'nama1','data2', 'nama2'
                                        ,'data3', 'nama3','data4', 'nama4'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stokss = Type::groupBy('items_id')->get('items_id');
        return view('Stok.create',compact('stokss')); 
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
            'stok'=> 'required',
        ]);

        $stks = Stok::create([
            'items_id' => request('nm_brg'),
            'types_id' => request('jns_brg'),
            'stok' => request('stok'),
            'tanggal' => date('Y-m-d'),
            
        ]);

        $stks->save();

        return redirect('/dashboard')->with('toast_success','Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function edit(Stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stok $stok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stok $stok)
    {
        //
    }
    function listitems($items_id, Request $request){

        $barang=new Type();
        $barang = $barang->select('id','jns_brg')
                        ->where('items_id','=',$items_id);
        return response()->json($barang->get());
    }
}
