@extends('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form action="{{ url('search-categories')}}" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" method="GET">
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
                    <span class="mb-0 text-sm  font-weight-bold">John Snow</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="#!" class="dropdown-item">
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
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Master Data</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ url('kategori')}}">Data Kategori</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ url('kategori/create') }}" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Data Kategori</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th scope="col" class="sort" data-sort="name">Kategori Barang</th>
                    <th scope="col" class="sort" data-sort="completion">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                @foreach($categoris as $no => $categori)
                  <tr>
                    <td>{{ $categoris->firstItem()+$no}} </td>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $categori->kategori }}</span>
                        </div>
                      </div>
                    </th>
                    <td>  
                        <a href="{{ url('/kategori/'.$categori->id.'/edit') }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger cok-confirm"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  {{$categoris->links()}}
                </ul>
              </nav>
            </div>
            </div>
            <!-- Card footer -->
            
          </div>
        </div>
      </div>
      @include('sweetalert::alert')

      @endsection('content')
      
@section('footer.script')

  <script>
    $('.cok-confirm').click( function () {
        // event.preventDefault();
        // const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((willDelete)=>{
            if(willDelete){
            swal('proof!',{
              icon: 'success',
            })
            }else{
              swal('damn')
            }
        });
    });
</script> 
