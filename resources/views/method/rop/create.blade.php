@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
            {{-- <form action="{{ url('search-user')}}" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" method="GET">
                <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input name="keyword" class="form-control" placeholder="Cari berdasarkan email" type="text">
                </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2" data-target="#navbar-search-main" aria-label="Close">
                
                </button>
            </form> --}}
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
                    <h6 class="text-overflow m-0">Settings</h6>
                    </div>
                    <a href="{{ url('profile')}}" class="dropdown-item">
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
            <h2 class="page-header mb-4 mt-3">Reorder Point</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
            <form method="Post" action="{{ url('rop') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                            Pilih Data EOQ
                        </button>

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
                                        @foreach($eoq as $q)
                                        <tr>
                                            <td>{{ $loop->iteration}} </td>
                                            <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $q->typ_items->nm_brg }}</span>
                                                </div>
                                            </div>
                                            </th>
                                            <td class="budget">
                                            {{ $q->jns_items->jns_brg }}
                                            </td>
                                            <td class="budget">
                                            {{ $q->periode }} Hari
                                            </td>
                                            <td class="budget">
                                                {{ $q->frekuensi }}x
                                            </td>
                                            <td class="budget">
                                                {{ $q->leadtime }} Hari
                                            </td>
                                            <td class="budget">
                                            {{ $q->eoq }} Kg
                                            </td>
                                            <td>  
                                                <a href="#" class="btn btn-primary" id="select"
                                                    data-id="{{$q->id}}"
                                                    data-jumlah="{{$q->eoq}}"
                                                    data-periode="{{$q->periode}}"
                                                    data-waktu="{{$q->leadtime}}">Pilih</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                            $(document).on('click', '#select', function(){
                                var id_eoq = $(this).data('id');
                                var eoq = $(this).data('jumlah');
                                var waktu = $(this).data('waktu');
                                var periode = $(this).data('periode');
                                $('#id_eoq').val(id_eoq);
                                $('#eoq_id').val(id_eoq);
                                $('#eoq').val(eoq);
                                $('#waktu').val(waktu);
                                $('#periode').val(periode);
                                $('#exampleModal').modal('hide');
                            })
                        })
                        </script>

                        <div class="form-group">
                            <label for="kode">Kode EOQ</label>
                            <input class="form-control"  name="id_eoq" id="id_eoq" type="text" disabled>
                            <input class="form-control"  name="eoq_id" id="eoq_id" type="text" hidden>
                        </div>
                        <div class="form-group">
                            <input class="form-control"  name="eoq" id="eoq" type="text" hidden>
                        </div>
                        {{-- <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <select name="nm_brg" id="nm_brg" class="form-control"
                                onchange="pickType(this);">
                                <option value="">- pilih -</option>
                                @foreach ($types as $type)
                                <option value="{{$type->items_id}}">{{$type->itemsss->nm_brg}}</option>
                                    @endforeach
                            </select>
                        </div> --}}
                        
                        <div class="form-group">
                            {{-- <label for="waktu">WP</label> --}}
                            <input class="form-control"  name="waktu" id="waktu" type="text" autocomplete="off" hidden>
                        </div>
                        <div class="form-group">
                            {{-- <label for="waktu">WP</label> --}}
                            <input class="form-control"  name="periode" id="periode" type="text" autocomplete="off" hidden>
                        </div>
                        
                        <div class="form-group">
                            <label for="leadtime">Lead Time (Hari)</label>
                            <input class="form-control"  name="leadtime" id="leadtime" type="number" onkeypress="return hanyaAngka(event)" autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>

                        {{-- <a href="{{ url('rop') }}" class="btn btn-default">Back</a> --}}
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
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection ('content')




