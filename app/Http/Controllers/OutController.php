<?php

namespace App\Http\Controllers;

use App\Out;
use App\Stok;
use App\Type;
use App\Item;
use App\Pemakaian;
use App\Bulan;
use App\Lapstok;
use App\Chart;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KategoriBarang;

Class RegresiLinier{
    
    public  $x, //inputted x param
            $y, //inputted y param
            $n, //count of data

            $x2,
            $y2,
            $xy,
            $a,
            $b,
    
            $all; //forecast y value based on linear regression
    
    
    public function __construct($x=null, $y=null){
        if(!is_null($x) && !is_null($y)){
            $this->x = $x;
            $this->y = $y;
            $this->compute();
        }
    }
    
    public function compute(){
        if(is_array($this->x) && is_array($this->y)){
            if(count($this->x) == count($this->y)){
                $this->n  = count($this->x);
                
                $this->prepare_calculation();
                $this->ab();
                $this->linear_regression();
            }
            else{
                throw new Exception('Jumlah data variabel X dan Y harus sama');
            }

        }
        else{
            throw new Exception('Variabel X atau Y belum didefinisikan');
        }
    }
    
    public function prepare_calculation(){
        //persiapan menghitung x2, y2, dan xy;
        $this->x2 = array_map(function($n){
            return $n * $n;
        }, $this->x);
        $this->y2 = array_map(function($n){
            return $n * $n;
        }, $this->y);
        
        
        for($i=0; $i<$this->n; $i++){
            $this->xy[$i] = $this->x[$i] * $this->y[$i];
        }
        
    }
    
    public function ab(){
        //mendapat nilai konstanta A dan B
        $a = ((array_sum($this->y) * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->xy))) / (($this->n * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->x)));
        $this->a = $a;
        
        $b = (($this->n * array_sum($this->xy)) - (array_sum($this->x) * array_sum($this->y))) / (($this->n * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->x)));
        $this->b = $b;
    }
    
    public function forecast($xfore){
        $y = $this->a + ($this->b * $xfore);
        return $y;
    }
    
    public function linear_regression(){
        $n = 0;
        foreach($this->x as $xnew){
            $this->all[$n] = $this->forecast($xnew);
            $n++;
        }
    }
    
    
    
}
class OutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $outs = Out::select('outs.id','items.nm_brg','buyer','stoks_id','id_bulan','jns_id','jumlah','tanggal','kategori')
                    ->join('items', 'id_brg', '=', 'items.id')->paginate(8);
        if($keyword != ""){
            $outs = Out::where ( 'items.nm_brg', 'LIKE', '%' . $keyword . '%' )->join('items', 'id_brg', '=', 'items.id')
                            ->paginate (8)->setPath ( '' );
            $pagination = $outs->appends ( array (
            'keyword' => $request->get('keyword') 
        ) );
        }
        $profil = User::select('name','level')->where('level', '=', 1)->first();
        // $tes = Out::select('id_bulan','jumlah')->get();
        // $x = [
        //     1,
        //     2,
        //     3,
        //     4
        // ];
        // $y = [
        //     132,
        //     25,
        //     53,
        //     21
        // ];
        
        
        
        // $regresi = new RegresiLinier($x, $y);
        // $predik = $regresi->forecast(5);
        // dd($predik);

        return view('transaksi.keluar.index', compact('outs','profil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stokss = Type::groupBy('items_id')->get('items_id');
        // $bulann = Bulan::all();
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        // $types = Type::all();
        return view('transaksi.keluar.create',compact('stokss','profil')); 
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
            // 'id_bulan' => 'required',
            'nm_brg' => 'required|max:255',
            'jns_brg'=> 'required',
            'awal' => 'required',
            'buyer' => 'required',
            // 'hrg_jual' => 'required',
            'tanggal' => 'required',
        ]);

        $stoks = Stok::where('items_id','=', $request->nm_brg)->where('types_id','=', $request->jns_brg)->first();
        if($stoks->stok >= $request->jumlah){
            
            $stoks->stok -= $request->jumlah;
            // $stoks2 = Pemakaian::where('items_id','=', $request->nm_brg)->where('types_id','=', $request->jns_brg)
            //                     ->where('bulan_id','=', $request->id_bulan)->first();
            // dd($stoks2);
            // $stoks2->jumlah += $request->jumlah;
            
            $ktg = $request->kategori;
            $jml = '';
            if($ktg == null){
                $ktg = 0;
                $jml = $request->jumlah;
            }else{
                $ktg = $request->kategori;
                $jml = $request->total_b;
            }
        }else{
            return redirect('/keluar/create')->with('toast_warning','Stok saat ini tidak mencukupi!');
        }

        $hrg_jual = '';
        if($request->hrg_jual != null){
            $hrg_jual = $request->hrg_jual;
        }else{
            return redirect('/keluar/create')->with('toast_warning','Harga jual belum di atur!');
        }

        $laps = Lapstok::where('tanggal', '=', date('Y-m-d'))->where('id_barang', '=', $request->nm_brg)->where('id_jenis', '=', $request->jns_brg)
        ->first();
        
        if($laps == NULL){
            $laps = Lapstok::create([
            'id_barang' => $request->nm_brg,
            'id_jenis' => $request->jns_brg,
            'awal' => $request->awal,
            'stok_keluar' => $jml,
            'tanggal' => $request->tanggal,
            'akhir' => $request->awal - $jml,
            ]);
        }else{
            $laps->stok_keluar = $jml;
            $laps->akhir = $request->awal - $jml;
        }
        // $chart = Chart::where('bulan', '=', $request->id_bulan)->where('brg_id', '=', $request->nm_brg)->first();
        // if($chart == NULL){
        //     $chart = Chart::create([
        //         'bulan' => date('m'),
        //         'brg_id' => $request->nm_brg,
        //         'jumlah' => $jml,
        //     ]);
        // }else{
        //     $chart->jumlah += $jml;
        // }
        
        $outs = Out::create([
            // 'pk_id' => $stoks2->id,
            'stoks_id' => $stoks->id,
            'id_bulan' => date('m'),
            'id_brg' => $request->nm_brg,
            'jns_id' => $request->jns_brg,
            'jumlah' => $jml,
            'hrg_jual' => $hrg_jual, 
            'tanggal' => $request->tanggal,
            'buyer' => $request->buyer,
            'total' => $jml*$request->hrg_jual,
            'kategori' => $ktg,
        ]);
        
        // $chart->save();
        $laps->save();
        $stoks->save();
        // $stoks2->save();
        

        return redirect('/keluar')->with('toast_success','Data berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Out  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outs = Out::findorfail($id);
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        return view('transaksi.keluar.show', compact('outs','profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Out  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outs = Out::find($id);
        $stoks = Type::groupBy('items_id')->get('items_id');
        $stks = Type::all();
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        $bulann = Bulan::all();
        return view('transaksi.keluar.edit', compact('outs','profil','id','stoks','stks','bulann'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Out  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'id_bulan' => 'required',
            'nm_brg' => 'required|max:255',
            'jns_brg'=> 'required',
            // 'jumlah' => 'required',
            'tanggal' => 'required',
            // 'kategori' => 'required',
        ]);
        $ktg = $request->kategori;
        $jml = '';
        if($ktg == null){
            $ktg = 0;
            $jml = $request->jumlah;
        }else{
            $ktg = $request->kategori;
            $jml = $request->total_b;
        }
        // dd($jml);
        $outs = Out::find($id);
        $result1 = $jml-$outs->jumlah;
        $result2 = $outs->jumlah-$jml;
        
        $st = Stok::where('id', '=', $request->stoks_id)->first();
        // dd($st);
        if($outs->jumlah < $jml ){
            
            $st->stok -= $result1; 
        }else{
            $st->stok += $result2;  
            
        }
        $outs->id_bulan = date('m');
        $outs->id_brg = $request->get('nm_brg');
        $outs->jns_id = $request->get('jns_brg');
        $outs->jumlah = $jml;
        $outs->buyer = $request->get('buyer');
        $outs->tanggal = $request->get('tanggal');
        $outs->kategori = $ktg;
        
        $st->save();
        $outs->save();
        return redirect('/keluar')->with('toast_success','Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Out  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outs = Out::findorfail($id);
        // $chart = Chart::where('bulan', '=', $outs->id_bulan)->where('brg_id', '=', $outs->id_brg)->first();
        // // $st = Stok::where('id', '=', $outs->stoks_id)->first();
        // // $st->stok += $outs->jumlah;
        // // $st->save();
        // $chart->delete();
		$outs->delete();

		return redirect('/keluar')->with('toast_success','Data berhasil dihapus!');
    }
    function listbarang($items_id, Request $request){

        $barang= new Stok();
        $barang = $barang->select('stoks.id','types_id','stok','types.jns_brg','hrg_jual')
                        ->where('stoks.items_id','=',$items_id)
                        ->join('types', 'types_id' , '=', 'types.id');
        return response()->json($barang->get());
    }
    public function predik()
    {
        $x = Out::select('id_bulan')->get('id_bulan');
        
        $y = Out::select('jumlah')->get('jumlah');
        $regresi = new RegresiLinier($x, $y);
        $predik = $regresi->forecast(5);
        dd($predik);
    }

}
