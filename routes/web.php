<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoriController;
use App\Http\Controllers\InController;
use App\Http\Controllers\OutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EoqController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\LapstoksController;
use App\Http\Controllers\RopController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\HasilmetodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Su_admin\ManaController;
use App\Http\Controllers\Su_admin\Profile_AdmController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/', [LoginController::class, 'logUser'])->name('logUser');
Route::get('/', function () {
    return view('login');
});
// Auth::routes();
Route::group(['middleware'=>'auth','ceklevel:1'], function () {
// ;
    // Route::get('/dashboard', function(){return view('/dashboard');});
    Route::get('dashboard_admin', [StokController::class, 'index'])->name('dashboard_admin');
    Route::get('search', [StokController::class, 'index'])->name('dashboard_admin');
    Route::get('re_stok/{id}/getstok', [StokController::class, 'getStok']);
    Route::post('re_stok/{id}/addrequest', [StokController::class, 're_stok'])->name('re_stok');
    Route::post('permintaan/{permintaan}/destroy', [StokController::class, 'destroy']);
//Data_Barang
Route::get('barang', [ItemController::class, 'index'])->name('barang');
Route::get('search-items', [ItemController::class, 'index'])->name('barang');
Route::get('barang/create', [ItemController::class, 'create']);
Route::post('barang', [ItemController::class, 'store']);
Route::get('/barang/{barang}/edit', [ItemController::class, 'edit']);
Route::post('/barang/{barang}/update', [ItemController::class, 'update']);
Route::get('/barang/{barang}/show', [ItemController::class, 'show']);
Route::post('/barang/{barang}/destroy', [ItemController::class, 'destroy']);

//Jenis_Barang
Route::get('jenis', [TypeController::class, 'index'])->name('jenis');
Route::get('search-types', [TypeController::class, 'index'])->name('jenis');
Route::get('jenis/create', [TypeController::class, 'create']);
Route::post('jenis', [TypeController::class, 'store']);
Route::get('/jenis/{jenis}/edit', [TypeController::class, 'edit']);
Route::post('/jenis/{jenis}/update', [TypeController::class, 'update']);
Route::get('/jenis/{jenis}/show', [TypeController::class, 'show']);
Route::post('/jenis/{jenis}/destroy', [TypeController::class, 'destroy']);

//Kategori_Barang
Route::get('kategori', [CategoriController::class, 'index'])->name('kategori');
Route::get('search-categories', [CategoriController::class, 'index'])->name('kategori');
Route::get('kategori/create', [CategoriController::class, 'create']);
Route::post('kategori', [CategoriController::class, 'store']);
Route::get('/kategori/{kategori}/edit', [CategoriController::class, 'edit']);
Route::post('/kategori/{kategori}/update', [CategoriController::class, 'update']);
// Route::get('/kategori/{kategori}/show', [CategoriController::class, 'show']);
Route::get('kategori/{id}', [CategoriController::class, 'destroy']);
Route::resource('kategori','App\Http\Controllers\CategoriController');
Route::get('/apiCategori',[CategoriController::class, 'apiCategori'])->name('api.kategori');

//masuk
Route::get('masuk', [InController::class, 'index'])->name('masuk');
Route::get('search-instok', [InController::class, 'index'])->name('masuk');
Route::get('/masuk/{masuk}/edit', [InController::class, 'edit']);
Route::post('/masuk/{masuk}/update', [InController::class, 'update']);
Route::get('/masuk/{masuk}/show', [InController::class, 'show']);
Route::post('/masuk/{masuk}/destroy', [InController::class, 'destroy']);
Route::get('masuk/editmasuk/{items_id}', [InController::class, 'editmasuk']);

//keluar
Route::get('keluar', [OutController::class, 'index'])->name('keluar');
Route::get('search-outstok', [OutController::class, 'index'])->name('keluar');
Route::get('keluar/create', [OutController::class, 'create']);
Route::post('keluar', [OutController::class, 'store']);
Route::get('/keluar/{keluar}/edit', [OutController::class, 'edit']);
Route::post('/keluar/{keluar}/update', [OutController::class, 'update']);
Route::get('/keluar/{keluar}/show', [OutController::class, 'show']);
Route::post('/keluar/{keluar}/destroy', [OutController::class, 'destroy']);
Route::get('keluar/listbarang/{items_id}', [OutController::class, 'listbarang']);


//permintaan
Route::get('permintaan', [RequestController::class, 'index'])->name('permintaan');
Route::post('permintaan', [RequestController::class, 'store']);
Route::post('permintaan/{permintaan}/destroy', [RequestController::class, 'destroy']);
Route::get('listrequest/{items_id}', [RequestController::class, 'listrequest']);


//eoq
Route::get('eoq/create', [EoqController::class, 'create']);
Route::post('eoq', [EoqController::class, 'store']);
Route::get('eoq/picktypes/{items_id}', [EoqController::class, 'picktypes']);

//rop
Route::get('rop/create', [RopController::class, 'create']);
Route::post('rop', [RopController::class, 'store']);
Route::get('rop/pickeoq/{id}', [RopController::class, 'pickeoq']);

//stok
Route::get('stok', [StokController::class, 'index'])->name('stok');
Route::get('stok/create', [StokController::class, 'create']);
Route::post('stok', [StokController::class, 'store']);
Route::get('/stok/{stok}/edit', [StokController::class, 'edit']);
Route::post('/stok/{stok}/update', [StokController::class, 'update']);
Route::get('stok/listitems/{items_id}', [StokController::class, 'listitems']);

Route::get('laporan-stok', [LapstoksController::class, 'index'])->name('laporan-stok');
Route::get('laporan-stok/periode', [LapstoksController::class, 'periode'])->name('laporan-stok');
Route::get('search-lap-stok', [LapstoksController::class, 'index'])->name('laporan-stok');
Route::get('cetak-laporan-stok/{hasilfilter}', [LapstoksController::class, 'cetakLapStok'])->name('cetak-laporan-stok');

Route::get('laporan-hasil-metode', [HasilmetodeController::class, 'index'])->name('laporan-hasil-metode');
Route::get('laporan-hasil-metode/periode', [HasilmetodeController::class, 'periode'])->name('laporan-hasil-metode');
Route::get('cetak-hasil-perhitungan/{tglawal}/{tglakhir}', [HasilmetodeController::class, 'cetakHasilMetode'])->name('cetak-hasil-perhitungan');

Route::post('laporan-hasil-metode', [HasilmetodeController::class, 'search'])->name('laporan-hasil-metode');
// Route::get('/eoq/{eoq}/edit', [InController::class, 'edit']);
// Route::post('/eoq/{eoq}/update', [InController::class, 'update']);
// Route::get('/eoq/{eoq}/show', [InController::class, 'show']);
// Route::post('/eoq/{eoq}/destroy', [InController::class, 'destroy']);
Route::get('profile', [ProfileController::class, 'edit'])
        ->name('profile');
Route::post('profile',[ProfileController::class, 'changePassword'])->name('changePassword');
//logout
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});
Route::group(['middleware'=>'auth','ceklevel:2'], function () {
    // ;
        // Route::get('home', function(){return view('purchase/index');});
        Route::get('home', [BelanjaController::class, 'create'])->name('home');
        Route::post('home', [BelanjaController::class, 'store']);
        Route::get('listtypes/{items_id}', [BelanjaController::class, 'listtypes']);

        Route::get('purchase/riwayat', [BelanjaController::class, 'create1']);
        // Route::get('purchase/listriwayat/{tanggal}', [BelanjaController::class, 'listriwayat']);
        Route::get('purchase/riwayat-per/{tanggal}', [BelanjaController::class, 'listriwayat']);
        Route::get('cetak-riwayat-belanja/{tgl_riwayat}', [BelanjaController::class, 'cetakRiwayat'])->name('cetak-riwayat-belanja');
        Route::post('purchase/riwayat/{suplier}/destroy', [BelanjaController::class, 'destroy2']);
        Route::get('purchase/kebutuhan', [BelanjaController::class, 'create2']);
        Route::get('purchase/kebutuhan/{id}', [BelanjaController::class, 'status_update']);
        Route::get('purchase/tanggal-kebutuhan/{tanggal}', [BelanjaController::class, 'kebutuhan']);
        Route::get('purchase/profil', [BelanjaController::class, 'showProfil']);
        Route::post('profil', [BelanjaController::class, 'changeProfil'])->name('changeProfil');
        Route::post('suplier', [BelanjaController::class, 'tambahSuplier'])->name('tambahSuplier');
        Route::get('purchase/suplier', [BelanjaController::class, 'dataSuplier']);
        Route::post('tambah_supplier', [BelanjaController::class, 'tambahSuplier2'])->name('tambahSuplier2');
        Route::post('purchase/suplier/{suplier}/destroy', [BelanjaController::class, 'destroy']);

        Route::get('logout-user', [LoginController::class, 'logout'])->name('logout-user');
});

Route::group(['middleware'=>'auth','ceklevel:3'], function () {
    // ;
        // login super admin
        Route::get('dashboard', [ManaController::class, 'index1'])->name('dashboard');
        // managemen user
        Route::get('mana_user', [ManaController::class, 'index'])->name('mana_user');
        Route::get('search-user', [ManaController::class, 'index'])->name('mana_user');
        Route::get('mana_user/create', [ManaController::class, 'create']);
        Route::post('mana_user', [ManaController::class, 'store']);
        Route::get('/mana_user/{mana_user}/edit', [ManaController::class, 'edit']);
        Route::post('/mana_user/{mana_user}/update', [ManaController::class, 'update']);
        Route::get('/mana_user/{mana_user}/show', [ManaController::class, 'show']);
        Route::post('/mana_user/{mana_user}/destroy', [ManaController::class, 'destroy']);
        //produk jual
        Route::get('/produk_jual/{produk_jual}/edit', [ManaController::class, 'edit_jual']);
        Route::post('/produk_jual/{produk_jual}/update', [ManaController::class, 'update_jual']);
        //laporan masuk
        Route::get('laporan-masuk', [ManaController::class, 'in_report'])->name('laporan-masuk');
        Route::get('laporan-masuk/periode', [ManaController::class, 'periode'])->name('laporan-masuk');
        Route::get('search-lap-masuk', [ManaController::class, 'in_report'])->name('laporan-masuk');
        Route::get('cetak-laporan-masuk/{tglawal}/{tglakhir}', [ManaController::class, 'cetakMasuk'])->name('cetak-laporan-masuk');
        //laporan keluar
        Route::get('laporan-keluar', [ManaController::class, 'out_report'])->name('laporan-keluar');
        Route::get('laporan-keluar/periode1', [ManaController::class, 'periode1'])->name('laporan-keluar');
        Route::get('search-lap-keluar', [ManaController::class, 'out_report'])->name('laporan-keluar');
        Route::get('cetak-laporan-keluar/{tglawal}/{tglakhir}', [ManaController::class, 'cetakKeluar'])->name('cetak-laporan-keluar');
        //profile
        Route::get('profile_adm', [Profile_AdmController::class, 'edit'])->name('profile_adm');
        Route::post('profile_adm',[Profile_AdmController::class, 'changePassword1'])->name('changePassword1');
        //logout
        Route::get('logout-user', [LoginController::class, 'logout'])->name('logout-user');
});

Route::get('forgot-password', [ForgotPasswordController::class, 'getEmail'])->name('password-password');
Route::post('forgot-password', [ForgotPasswordController::class, 'postEmail'])->name('forgot-pasword');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('updatePassword');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::post('admin/login', 'Auth\AdminAuthController@postLogin');

// Route::middleware('auth:admin')->group(function(){
//     // Tulis routemu di sini.
// });
