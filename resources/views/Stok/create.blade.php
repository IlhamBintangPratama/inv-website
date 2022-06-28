@extends ('admin-layouts.master')

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
                <h6 class="text-overflow m-0">Welcome!</h6>
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
    {{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-bell-55"></i></span>
        <span class="alert-text"><strong>Peringatan!</strong> Kapasitas gudang hampir penuh!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> --}}
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header mb-4 mt-3">Buat Stok Baru</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
            <form method="Post" action="{{ url('stok') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <select name="nm_brg" id="nm_brg" class="form-control"
                                onchange="updateItems(this);" required='required'>
                                <option value="">- pilih -</option>
                                @foreach ($stokss as $stoks)
                                <option value="{{$stoks->items_id}}">{{$stoks->itemsss->nm_brg}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jns_brg">Jenis</label>
                            <select class='form-control' name='jns_brg' required='required' id='input-barang'>
                                <option value="">- pilih -</option>

                            </select>

                            <span class="help-block" id='input-barang-status' style="display:none;">
                                Mohon input barang lebih dulu.
                            </span>
                        </div>
                        <script>
                        var listBarang;
                        function updateItems(stoks){
                            if(stoks.value==''){
                                $('#input-barang-status').show().html("Pilih barang terlebih dahulu.");
                                $('#input-barang').hide();
                            }else{
                                $.ajax({
                                    url:'listitems/'+stoks.value,
                                    type:'get',
                                    dataType:'json',
                                    data:{'nm_brg':stoks.value},
                                    beforeSend:function(){
                                        $('#input-barang').hide();
                                        $('#input-barang-status').show().html("<strong><i class='fa fa-spinner fa-spin'></i> Memuat list jenis barang</strong>");
                                        console.log("beforesend triggered");
                                    },
                                    success:function(result){
                                        listBarang=result;
                                        if(listBarang.length >= 1){
                                            var options="<?php echo "<option selected>-pilih-</option>";?>";
                                            listBarang.forEach(function(item){
                                                options+="<option value='"+item.id+"'>"+item.jns_brg+"</option>"
                                            });
                                            $('#input-barang').html(options).show();
                                            $('#input-barang-status').hide();
                                        }else{
                                            $('#input-barang-status').show().html("<strong>Tidak ada jenis barang yang sesuai.</strong>");
                                            $('#input-barang').hide();
                                        }
                                    },
                                    error:function(err){
                                        console.log(err);
                                        $('#input-barang-status').show().html("<strong>Kesalahan saat memuat data</strong>");
                                        $('#input-barang').hide();
                                    },
                                    complete:function(){

                                    }
                                });

                            }
                        }
                        function hanyaAngka(evt) {
                        var charCode = (evt.which) ? evt.which : event.keyCode
                        if (charCode == 46 || (charCode >= 48 && charCode <= 57))
                        
                        return true;
                            return false;
                        
                        }
                        </script>
                        {{-- <div class="form-group">
                            <label for="stok">Jumlah Stok (Kg)</label>
                            <input class="form-control"  name="stok" id="stok" type="number" placeholder="Jumlah stok (Kg)" required='required'>
                        </div> --}}
                        <div class="form-group">
                            <label for="stok">Safety Stok</label>
                            <input class="form-control"  name="safety_stok" onkeypress="return hanyaAngka(event)" id="safety_stok" type="decimal" placeholder="Jumlah stok aman(Kg)" required='required'>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Save</button>

                        <a href="{{ url('stok') }}" class="btn btn-default">Back</a>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')

@endsection ('content')




