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
            <h1 class="page-header mb-4 mt-3">Hapus Data User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                    <div class="form-group {{ $errors->has('nm_user') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Nama Lengkap</label>
                        <input  id="nm_user" type="text" name="nm_user" class="form-control"  placeholder="Post Title ..." value="{{ old('name', $mana_user->name) }}" disabled>

                        @if ($errors->has('nm_user'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nm_user') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Email</label>
                        <input  id="email" type="email" name="email" class="form-control"  placeholder="Post Title ..." value="{{ old('email', $mana_user->email) }}" disabled>
                    </div>
                    {{-- <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Password</label>
                        <input  id="password" type="password" name="password" class="form-control"  placeholder="Post Title ..." value="{{ old('password', $mana_user->password) }}" disabled>
                    </div> --}}
                    <div class="form-group">
                        <label for="items_id">Role</label>
                            <select id="items_id" name="items_id" class="form-control" disabled>
                            <option value="">- pilih -</option>
                            @foreach(App\User::all() as $item) 
                            <option  value="{{$item->id}}" selected>

                            {{$item->level}}

                            </option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                
                    <form action="{{url('/mana_user/'.$mana_user->id.'/destroy') }}" method="POST" style="display: inline;" 
                        id="delete-form">
                        {{ csrf_field() }} 
                        
                        <button type="submit" class="btn btn-danger" id="delete-btn" >
                            Remove

                        </button>
                    </form>

                    <a href="{{url('/mana_user') }}" class="btn btn-default">Cancel</a>     
                </div>
                
                </div>
                <!-- /.col-sm-4 -->
            </div>
            <!-- /.row -->
        </form>
    </div>
</div>
@endsection ('content')
@section('footer.script')