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
            <h2 class="page-header mb-4 mt-3">My Profile</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}" autocomplete="off">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nama Pengguna</label>
                            <input class="form-control"  name="name" id="name" type="text" value="{{ old('name', $profil->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <input class="form-control"  name="email" id="email" type="text" value="{{ old('email', $profil->email) }}" required>
                        </div>
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Current Password</label>

                            
                                <input id="current-password" type="password" class="form-control" name="current-password" autocomplete="off" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">New Password</label>

                        
                                <input id="new-password" type="password" class="form-control" name="new-password" autocomplete="off" placeholder="Kosongkan jika tidak di ubah">

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                        
                        </div>

                        <div class="form-group">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                        
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" autocomplete="off" placeholder="Kosongkan jika tidak di ubah">
                    
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#email").attr("autocomplete", "off");
                                $("#new-password").attr("autocomplete", "off");
                                $("#new-password-confirm").attr("autocomplete", "off");
                            });
                        </script>
                </form>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection ('content')




