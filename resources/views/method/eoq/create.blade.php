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
            <h2 class="page-header mb-4 mt-3">Economic Order Quantity</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
            <form method="Post" action="{{ url('eoq') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <select class="form-control mb-2"  name="periode" id="periode">
                                <option value="" selected disabled>- pilih -</option>
                                <option value="90">3 Bulan</option>
                                <option value="180">6 Bulan</option>
                                <option value="360">12 Bulan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <select name="nm_brg" id="nm_brg" class="form-control chosen-select"
                                onchange="pickType(this);" required='required'>
                                <option value="" selected disabled>- pilih -</option>
                                @foreach ($types as $type)
                                <option value="{{$type->items_id}}">{{$type->itemsss->nm_brg}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jns_brg">Jenis</label>
                            <select class='form-control' name='jns_brg' required='required' id='input-jeniss'
                                onchange="getHarga(this)">
                            </select>
                            <br>
                            <span class="help-block" id='input-jeniss-status' style="display:none;">
                                Pilih barang dulu bro.
                            </span>
                        </div>
                        <script>
                            var listJeniss;
                            function pickType(type){
                                if(type.value==''){
                                    $('#input-jeniss-status').show().html("Pilih barang terlebih dahulu.");
                                    $('#input-jeniss').hide();
                                }else{
                                    $.ajax({
                                        url:'picktypes/'+type.value,
                                        type:'get',
                                        dataType:'json',
                                        data:{'nm_brg':type.value},
                                        beforeSend:function(){
                                            $('#input-jeniss').hide();
                                            $('#input-jeniss-status').show().html("<strong><i class='fa fa-spinner fa-spin'></i> Memuat list jenis barang</strong>");
                                            console.log("beforesend triggered");
                                        },
                                        success:function(result){
                                            listJeniss=result;
                                            if(listJeniss.length >= 1){
                                                var options="<?php echo "<option selected disabled>-pilih-</option>";?>";
                                                listJeniss.forEach(function(item){
                                                    options+="<option value='"+item.id+"'>"+item.jns_brg+"</option>"
                                                });
                                                $('#input-jeniss').html(options).show();
                                                $('#input-jeniss-status').hide();
                                            }else{
                                                $('#input-jeniss-status').show().html("<strong>Tidak ada jenis barang yang sesuai.</strong>");
                                                $('#input-jeniss').hide();
                                            }
                                        },
                                        error:function(err){
                                            console.log(err);
                                            $('#input-jeniss-status').show().html("<strong>Kesalahan saat memuat data</strong>");
                                            $('#input-jeniss').hide();
                                        },
                                        complete:function(){
    
                                        }
                                    });
    
                                }
                                
                            }
                            function getHarga(jenis){
                                        $.ajax({
                                            url : 'picktypes/' + $('#nm_brg').val(),
                                            type : 'GET',
                                            dataType : 'json',
                                            success : function(data){
                                                let newData = data.find((item) => item.id == jenis.value)
                                                $('#hrg_item').val(newData.hrg_item).show()
                                                $('#by_simpan').val(newData.by_simpan).show()
                                                $('#by_pesan').val(newData.by_pesan).show()
                                            }
                                        })
                                    }
                            
                            function hanyaAngka(evt) {
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode > 57))
                        
                                    return false;
                                return true;
                                
                            }
                            $(document).ready(function(){
                                        $('.chosen-select').chosen();
                                    })
                        </script>
                        <div class="form-group">
                            
                            <input class="form-control"  name="hrg_item" id="hrg_item" type="number" autocomplete="off" multiple required hidden>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            
                            <input class="form-control"  name="by_simpan" id="by_simpan" max="100" type="number" autocomplete="off" multiple hidden>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            
                            <input class="form-control"  name="by_pesan" id="by_pesan" type="number" autocomplete="off" multiple required hidden>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            <label for="permintaan">Permintaan (Kg)</label>
                            <input class="form-control"  name="permintaan" id="permintaan" type="number" onkeypress="return hanyaAngka(event)" placeholder="Jumlah permintaan barang" autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>

                        {{-- <a href="{{ url('eoq') }}" class="btn btn-default">Back</a> --}}
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')

@endsection ('content')




