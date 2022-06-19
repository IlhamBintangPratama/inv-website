<?php

namespace App\Http\Controllers;

use App\Stok;
use App\Item;
use App\Type;
use App\Bulan;
use App\Chart;
use App\Eoq;
use App\Requeststok;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $chart = Bulan::select('id', 'nm_bulan')->get();
        // $group = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
        //                 ->where('charts.brg_id', '=', '1')
        //                 ->join('bulans', 'bulan', '=', 'bulans.id')
        //                 ->join('items', 'brg_id', '=', 'items.id')->get();
        // $group1 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
        //                 ->where('charts.brg_id', '=', '2')
        //                 ->join('bulans', 'bulan', '=', 'bulans.id')
        //                 ->join('items', 'brg_id', '=', 'items.id')->get();
        // $group2 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
        //                 ->where('charts.brg_id', '=', '3')
        //                 ->join('bulans', 'bulan', '=', 'bulans.id')
        //                 ->join('items', 'brg_id', '=', 'items.id')->get();
        // $group3 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
        //                 ->where('charts.brg_id', '=', '4')
        //                 ->join('bulans', 'bulan', '=', 'bulans.id')
        //                 ->join('items', 'brg_id', '=', 'items.id')->get();
        // $group4 = Chart::select('charts.bulan', 'charts.brg_id','bulans.nm_bulan', 'items.nm_brg', 'jumlah')
        //                 ->where('charts.brg_id', '=', '5')
        //                 ->join('bulans', 'bulan', '=', 'bulans.id')
        //                 ->join('items', 'brg_id', '=', 'items.id')->get();
        $stoks = Stok::orderBy('items_id', 'asc')->orderBy('types_id', 'asc')->paginate(8);
        // $categories = [];
        // $data = [];
        // $nama = '';
        // $data1 = [];
        // $nama1 = '';
        // $data2 = [];
        // $nama2 = '';
        // $data3 = [];
        // $nama3 = '';
        // $data4 = [];
        // $nama4 = '';
        // foreach($chart as $ch){
        //     $categories[] = $ch->nm_bulan;
        // }
        // foreach($group as $grp){
        //     $data[] = intval($grp->jumlah);
        //     $nama = $grp->nm_brg;
            
        // }
        // foreach($group1 as $grp1){
        //     $data1[] = intval($grp1->jumlah);
        //     $nama1 = $grp1->nm_brg;
            
        // }
        // foreach($group2 as $grp3){
        //     $data2[] = intval($grp3->jumlah);
        //     $nama2 = $grp3->nm_brg;
            
        // }
        // foreach($group3 as $grp2){
        //     $data3[] = intval($grp2->jumlah);
        //     $nama3 = $grp2->nm_brg;
            
        // }
        // foreach($group4 as $grp4){
        //     $data4[] = intval($grp4->jumlah);
        //     $nama4 = $grp4->nm_brg;
            
        // }
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        $kapasitas = DB::table('stoks')->sum('stok');

        return view('dashboard', compact('kapasitas','profil', 'stoks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stokss = Type::groupBy('items_id')->get('items_id');
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        return view('Stok.create',compact('stokss','profil')); 
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
            // 'stok'=> 'required',
            'safety_stok' => 'required',
        ]);
        $data = Stok::where('types_id', '=' , $request->jns_brg)->first();
        if($data == false){
        $data = Stok::create([
            'items_id' => request('nm_brg'),
            'types_id' => request('jns_brg'),
            // 'stok' => request('stok'),
            'reorder' => request('safety_stok'),
            'tanggal' => date('Y-m-d'),
        ]);
        
        }else{
        $data->stok += request('stok');
        }
        $data->save();
        return redirect('/dashboard_admin')->with('toast_success','Data berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    // public function restok($id)
    // {
    //     $stoks = Stok::find($id);

    // }

    public function getStok($id)
    {
        $eoqresult = Eoq::where('status','=', 1)->paginate(5);
        $permintaan = Requeststok::paginate(5);
        $stoks = Stok::find($id);
        $items = Type::groupBy('items_id')->get('items_id');
        $stks = Type::all();
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        return view('transaksi.permintaan.restok', compact('stoks','items','stks','profil','eoqresult', 'permintaan'));
    }

    public function re_stok(Request $request)
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
        
        // $sts->save();
        $stks->save();

        return redirect('/permintaan')->with('toast_success','Data berhasil tersimpan!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stoks = Stok::find($id);
        $items = Type::groupBy('items_id')->get('items_id');
        $stks = Type::all();
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        return view('permintaan.create', compact('stoks','items','stks','profil'));
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
    public function destroy($id)
    { 
        
		
        $applicant_id = Requeststok::findOrFail($id);
        $applicant_id->delete();
        return redirect('/permintaan')->with('toast_warning','Data berhasil dihapus!');
    }
    function listitems($items_id, Request $request){

        $barang=new Type();
        $barang = $barang->select('id','jns_brg')
                        ->where('items_id','=',$items_id);
        return response()->json($barang->get());
    }
}
