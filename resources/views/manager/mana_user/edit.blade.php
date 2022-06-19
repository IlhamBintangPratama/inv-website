@extends ('layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
            
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                <!-- Sidenav toggler -->
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main" role="button">
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
            <h2 class="page-header mb-4 mt-3">Edit Data User</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                <form method="Post" action="{{ url('/mana_user/'.$mana_user->id.'/update') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group" {{ $errors->has('nm_user') ? 'has-error' : '' }}>
                            <label for="nm_user">Nama Lengkap</label>
                            <input class="form-control"  name="nm_user" id="nm_user" type="text" placeholder="Nama Lengkap" value="{{ old('name', $mana_user->name) }}" autocomplete="off" required='required'>
                        </div>
                    
                        <div class="form-group" {{ $errors->has('email') ? 'has-error' : '' }}>
                            <label for="email">Email</label>
                            <input class="form-control"  name="email" id="email" max="100" type="email" placeholder="Email Address" value="{{ old('email', $mana_user->email) }}" autocomplete="off" required='required'>
                        </div>
                        {{-- <div class="form-group" {{ $errors->has('password') ? 'has-error' : '' }}>
                            <label for="password">Password</label>
                            <input class="form-control"  name="password" id="password" type="password" placeholder="Password" value="{{ old('password', $mana_user->password) }}" autocomplete="off" required='required'>
                        </div> --}}
                        <div class="form-group">
                            <label for="role">Role</label>
                                <select id="role" name="role" class="form-control" disabled>
                                <option value="">- pilih -</option>
                                
                                <option  value="{{ old('level', $mana_user->level) }}" selected>
    
                                {{$mana_user->level}}
    
                                </option>
                                
                                </select>
                        </div>
                        


                        <div class="form-group">
                            
                                <input type="submit" class="btn btn-success" value="Simpan">
                                
                                <a href="{{ url('/mana_user') }}" class="btn btn-default">Cancel</a>     
                            </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection ('content')
@section('footer.script')