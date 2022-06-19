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
            {{-- <button type="submit" class="btn btn-primary mb-2" data-target="#navbar-search-main" aria-label="Close">
            
            </button> --}}
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
<div id="page-wrapper" class="container-fluid mt-4">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header mb-4 mt-3">Permintaan Stok</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
            <div class="colm-lg-6">
                <form method="Post" action="{{ url('re_stok/'.$stoks->id.'/addrequest') }}" name="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset >
                                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                                    Gunakan EOQ?
                                </button>
                                {{-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal-2">
                                    Stok Menipis
                                </button> --}}
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content" style="width: 160%">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Economic Order Quantity</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                                                    <th scope="col" class="sort" data-sort="name">Jenis</th>
                                                    <th scope="col" class="sort" data-sort="name">Periode</th>
                                                    <th scope="col" class="sort" data-sort="name">Frekuensi</th>
                                                    <th scope="col" class="sort" data-sort="name">Waktu Pemesanan</th>
                                                    <th scope="col" class="sort" data-sort="name">EOQ</th>
                                                    <th scope="col" class="sort" data-sort="completion">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody class="list">
                                                @foreach($eoqresult as $eoq)
                                                <tr>
                                                    <td>{{ $loop->iteration}} </td>
                                                    <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{ $eoq->typ_items->nm_brg }}</span>
                                                        </div>
                                                    </div>
                                                    </th>
                                                    <td class="budget">
                                                    {{ $eoq->jns_items->jns_brg }}
                                                    </td>
                                                    <td class="budget">
                                                    {{ $eoq->periode }} Hari
                                                    </td>
                                                    <td class="budget">
                                                        {{ $eoq->frekuensi }}x
                                                    </td>
                                                    <td class="budget">
                                                        {{ $eoq->leadtime }} Hari
                                                    </td>
                                                    <td class="budget">
                                                    {{ $eoq->eoq }} Kg
                                                    </td>
                                                    <td>  
                                                        <a href="#" class="btn btn-primary" id="select"
                                                            data-id="{{$eoq->id}}"
                                                            data-nama="{{$eoq->items_id}}"
                                                            data-nama2="{{$eoq->typ_items->nm_brg}}"
                                                            data-jenis="{{$eoq->types_id}}"
                                                            data-jenis2="{{$eoq->jns_items->jns_brg}}"
                                                            data-jumlah="{{$eoq->eoq}}"
                                                            data-frekuensi="{{$eoq->frekuensi}}"
                                                            data-waktu="{{$eoq->leadtime}}"
                                                            data-status="{{$eoq->status}}">Pilih</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="card-footer py-4">
                                                <nav aria-label="...">
                                                    <ul class="pagination justify-content-end mb-0">
                                                        {{$eoqresult->links()}}
                                                    </ul>
                                                </nav>
                                            </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                
                                <script>
                                    $(document).ready(function(){
                                    $(document).on('click', '#select', function(){
                                        var id_eoq = $(this).data('id');
                                        var nm_brg = $(this).data('nama');
                                        var nm_brg2 = $(this).data('nama2');
                                        nm_brg+="<option value='"+nm_brg+"'>"+nm_brg2+"</option>"
                                        var jns_brg = $(this).data('jenis');
                                        var jns_brg2 = $(this).data('jenis2');
                                        jns_brg+="<option value='"+jns_brg+"'>"+jns_brg2+"</option>"
                                        var eoq = $(this).data('jumlah');
                                        var frekuensi = $(this).data('frekuensi');
                                        var waktu = $(this).data('waktu');
                                        var status = $(this).data('status');
                                        $('#id_eoq').val(id_eoq);
                                        $('#nm_brg').html(nm_brg).show();
                                        $('#input-barang').html(jns_brg).show();
                                        $('#jumlah').val(eoq);
                                        $('#frekuensi').val(frekuensi);
                                        $('#waktu_pemesanan').val(waktu);
                                        $('#status').val(status);
                                        $('#exampleModal').modal('hide');
                                    })
                                })
                                
                                </script>
                        <style>
                            .colm-lg-6
                            {
                                max-width: 45%;
                                flex: 0 0 45%;
                                margin-left: 1%;
                            }
                            .col-cok
                            {
                                max-width: 54%; 

                                flex: 0 0 54%;
                            }
                            .wd-2
                            {
                                width: 50%;
                            }
                            .con-md-2
                            {
                                max-width: 98%;
                                flex: 140%;
                                margin-right: 5%;
                            }
                        </style>
                        <div class="wd-2">
                            <div class="form-group">
                                <label for="nm_brg">Nama Barang</label>
                                <input class="form-control"  name="id_eoq" id="id_eoq" style="width: 180%" type="text" hidden>
                                <input class="form-control"  name="status" id="status" style="width: 180%" type="number" hidden>
                                <select name="nm_brg" id="nm_brg" class="form-control" onchange="getData(this);" style="width: 180%">
                                    <option value="">- pilih -</option>
                                    @foreach ($items as $itm)
                                    <option {{$stoks->items_id == $itm->items_id ? 'selected' :''}} value="{{$itm->items_id}}">{{$itm->itemsss->nm_brg}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jns_brg">Jenis</label>
                                <select class='form-control' name='jns_brg' required='required' id='input-barang' style="width:180%;">
                                    <option value="">- pilih -</option>
                                    @foreach ($stks as $row)
                                    <option {{$stoks->types_id == $row->id ? 'selected' :''}} value="{{$row->id}}">{{$row->jns_brg}}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="jumlah">Jumlah (Kg)</label>
                                <input class="form-control"  name="jumlah" id="jumlah" style="width: 180%" type="number" onkeypress="return hanyaAngka(event)" autocomplete="off" multiple>
                                {{-- <div id="awal_stoks"></div> --}}
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Frekuensi Pemesanan (x)</label>
                                <input class="form-control"  name="frekuensi" id="frekuensi" style="width: 180%" type="number" onkeypress="return hanyaAngka(event)" autocomplete="off" multiple>
                                {{-- <div id="awal_stoks"></div> --}}
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Waktu Pemesanan (Hari)</label>
                                <input class="form-control"  name="waktu_pemesanan" id="waktu_pemesanan" style="width: 180%" max="31" type="number" onkeypress="return hanyaAngka(event)" max="2" autocomplete="off" multiple>
                                {{-- <div id="awal_stoks"></div> --}}
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success" style="width: 180%">Create</button>
                        </div>
                        </fieldset>
                    </form>
            </div>
            <script>
                
                function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
        
                    return false;
                return true;
                
                }
            </script>
        <div class="col-cok">
            <div class="row">
                <div class="con-md-2">
                    <div class="card">
                        <!-- Card header -->
                            <div class="card-header border-0">
                                <h3 class="mb-0">Permintaan Stok</h3>
                            </div>
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>No</th>
                                    <th scope="col" class="sort" data-sort="name">Tanggal</th>
                                    <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                                    <th scope="col" class="sort" data-sort="name">Jenis</th>
                                    <th scope="col" class="sort" data-sort="name">Jumlah</th>
                                    <th scope="col" class="sort" data-sort="name">Status</th>
                                    <th scope="col" class="sort" data-sort="completion">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($permintaan as $no => $perm)
                                    <tr>
                                    <td>{{ $permintaan->firstItem()+$no}} </td>
                                    <td class="budget">
                                        {{ $perm->tanggal }}
                                    </td>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{ $perm->permStok->nm_brg }}</span>
                                        </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        {{ $perm->permStok2->jns_brg }}
                                    </td>
                                    <td class="budget">
                                        {{ $perm->jumlah }} Kg
                                    </td>
                                    <td class="budget">
                                        <span class="badge badge-dot badge-lg mr-4"><i class="{{($perm->status == 1) ?
                                        'bg-success' : 'bg-danger'}}"></i>
                                            <span class="status">{{($perm->status == 1) ? 'Selesai' : 'Masih Dilakukan'}}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{url('/permintaan/'.$perm->id.'/destroy') }}" method="POST"
                                            id="delete-form">
                                            {{ csrf_field() }} 
                                            
                                            <button type="submit" class="btn btn-sm btn-danger" id="delete-btn" onclick="return confirm('Data yakin dihapus ?')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                                                        <!-- Modal -->
                
                                <div class="card-footer py-4">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{$permintaan->links()}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection ('content')
@section('footer.script')

@endsection





