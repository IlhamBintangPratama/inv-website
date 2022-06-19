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
            <h1 class="page-header mb-4 mt-3">Hapus Data Barang Masuk</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                    <div class="form-group {{ $errors->has('nm_brg') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Nama Barang</label>
                        <input  id="nm_brg" type="text" name="nm_brg" class="form-control"  placeholder="Post Title ..." value="{{ old('nm_brg', $ins->brg1->nm_brg) }}" disabled>

                        @if ($errors->has('nm_brg'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nm_brg') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('jns_brg') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Jenis</label>
                        <input  id="jns_brg" type="text" name="jns_brg" class="form-control"  placeholder="Post Title ..." value="{{ old('jns_brg', $ins->jns1->jns_brg) }}" disabled>
                    </div>
                    <div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">QTY</label>
                        <input  id="jumlah" type="text" name="jumlah" class="form-control"  placeholder="Post Title ..." value="{{ old('jumlah', $ins->jumlah) }}" disabled>
                    </div>
                    <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Tanggal</label>
                        <input  id="tanggal" type="text" name="tanggal" class="form-control"  placeholder="Post Title ..." value="{{ old('tanggal', $ins->tanggal) }}" disabled>
                    </div>
                    <div class="form-group {{ $errors->has('hrg_item') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Harga Item</label>
                        <input  id="hrg_item" type="text" name="hrg_item" class="form-control"  placeholder="Post Title ..." value="{{ old('hrg_item', $ins->hrg_item) }}" disabled>
                    </div>
                    <div class="form-group">
                
                    <form action="{{url('/masuk/'.$ins->id.'/destroy') }}" method="POST" style="display: inline;" 
                        id="delete-form">
                        {{ csrf_field() }} 
                        
                        <button type="submit" class="btn btn-danger" id="delete-btn" >
                           Remove

                        </button>
                    </form>

                    <a href="{{url('/masuk') }}" class="btn btn-default">Cancel</a>     
                </div>

                </div>
                <!-- /.col-sm-4 -->
            </div>
            <!-- /.row -->
        </form>
    </div>
</div>
@endsection ('content')