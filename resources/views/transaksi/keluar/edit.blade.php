@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->
        <form action="{{ url('search-outstok')}}" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" method="GET">
            <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input name="keyword" class="form-control" placeholder="Cari berdasarkan nama" type="text">
            </div>
            </div>
            <button type="submit" class="btn btn-primary mb-2" data-target="#navbar-search-main" aria-label="Close">
            
            </button>
        </form>
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                </div>
            </div>
            </li>
            <li class="nav-item d-sm-none">
            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
            </a>
            </li>
            
            
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="../../assets/img/theme/team-4.jpg">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{$profil->name}}</span>
                </div>
                </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{ url('profile_adm')}}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
                </a>
                
                <div class="dropdown-divider"></div>
                <a href="{{ url('logout')}}" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
                </a>
            </div>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header mb-4 mt-3">Edit Data Barang Keluar</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                <form method="Post" action="{{ url('/keluar/'.$outs->id.'/update') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        {{-- <div class="form-group">
                            <label for="id_bulan">Bulan</label>
                            <select name="id_bulan" id="id_bulan" class="form-control">
                                <option value="">- pilih -</option>
                                @foreach ($bulann as $blnn)
                                <option value="{{$blnn->id}}" selected>{{$blnn->nm_bulan}}</option>
                                
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="buyer">Buyer</label>
                            <input class="form-control" name="buyer" id="buyer" type="text" value="{{ old('buyer', $outs->buyer) }}"
                                autocomplete="off" multiple required>
                        </div>
                        <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <select name="nm_brg" id="nm_brg" class="form-control"
                                onchange="changeItem(this);">
                                <option value="">- pilih -</option>
                                @foreach ($stoks as $keluar)
                                <option {{$outs->id_brg == $keluar->items_id ? 'selected' :''}} value="{{$keluar->items_id}}">{{$keluar->itemsss->nm_brg}}</option>
                                
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jns_brg">Jenis</label>
                            <select name="jns_brg" id="jns_brg" class="form-control"
                                onchange="changeItem(this);">
                                <option value="">- pilih -</option>
                                @foreach ($stks as $type)
                                <option {{$outs->jns_id == $type->id ? 'selected' :''}} value="{{$type->id}}">{{$type->jns_brg}}</option>
                                @endforeach
                            </select>
                        </div>
                        <script>
                            function showHiddenField(paking){
                                    var checkbox = document.getElementById('checkbox');
                                    var box = document.getElementById('box');
                                    var box1 = document.getElementById('box1');
                                    var tes = document.getElementById('tes');
                                    checkbox.onclick = function(){
                                        console.log(paking);
                                        if(paking.checked){
                                            box.style['display'] = 'block';
                                            box1.style['display'] = 'block';
                                            tes.style['display'] = 'none';
                                        }else{
                                            box.style['display'] = 'none';
                                            box1.style['display'] = 'none';
                                            tes.style['display'] = 'block';
                                        }
                                    };
                                }
                            function sum() {
                                var txtFirstNumberValue = document.getElementById('jum-pak').value;
                                var txtSecondNumberValue = document.getElementById('jum-pak-1').value;
                                var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
                                if (!isNaN(result)) {
                                    document.getElementById('total-b').value = result;
                                    document.getElementById('total-b-1').value = result;
                                }
                            }
                        </script>
                        <div class="form-group" {{ $errors->has('tanggal') ? 'has-error' : '' }}>
                            <label for="tanggal">Tanggal</label>
                            <input class="form-control"  name="tanggal" id="tanggal" type="date" placeholder="Tanggal" value="{{ old('tanggal', $outs->tanggal) }}">
                        </div>
                        <div class="form-group" {{ $errors->has('kategori') ? 'has-error' : '' }}>
                            
                            <input class="form-control"  name="stoks_id" id="stoks_id" type="text" placeholder="Kategori barang" value="{{ old('stoks_id', $outs->stoks_id) }}" hidden>
                            <label for="kategori">Box Packing</label>
                            <input name="kategori" id="checkbox" type="checkbox" value="1" {{($outs->kategori) || old('kategori', 0) === 1 ? 'checked' : ' '}} onchange="showHiddenField(this)">
                        </div>
                        <div class="form-group" {{ $errors->has('jumlah') ? 'has-error' : '' }} id="tes">
                            <label for="jumlah">QTY</label>
                            <input class="form-control"  name="jumlah" id="jumlah" type="number" placeholder="Jumlah barang yang keluar" value="{{ old('jumlah', $outs->jumlah) }}">
                        </div>
                        <div class="form-group" id="box" style="display: none;">
                            <label for="jumlah-paking">QTY</label><br>
                            <input class="form-control" name="jum-pak" id="jum-pak" type="number" onkeyup="sum();">
                            <input class="form-control" name="jum-pak-1" id="jum-pak-1" type="number" value="5" onkeyup="sum();" hidden>
                        </div>
                        <div class="form-group" id="box1" style="display: none;">
                            <label for="total_b">Total Berat</label><br>
                            <input class="form-control" name="total_b" id="total-b" type="number" value="{{ old('jumlah', $outs->jumlah) }}" hidden>
                            <input class="form-control" name="total_b" id="total-b-1" type="number" disabled>
                        </div>
                        <div class="form-group">
                            
                            <input type="submit" class="btn btn-success" value="Simpan">
                            
                            <a href="{{ url('/keluar') }}" class="btn btn-default">Cancel</a>     
                        </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection ('content')

