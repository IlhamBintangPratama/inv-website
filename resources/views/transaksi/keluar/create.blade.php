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
            <div class="col">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header mb-4 mt-3">Tambah Data Barang Keluar</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">

                    <form method="Post" action="{{ url('keluar') }}" name="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            {{-- <div class="form-group">
                            <label for="nm_brg">Nama Barang:</label>
                            <input class="form-control"  name="nm_brg" id="nm_brg" type="text" placeholder="Nama barang">
                        </div> --}}
                            <div id="list-Checkout">
                                {{-- <div class="form-group">
                                    <label for="id_bulan">Bulan</label>
                                    <select name="id_bulan" id="id_bulan" class="form-control">
                                        <option value="">- pilih -</option>
                                        @foreach ($bulann as $bln)
                                        <option value="{{$bln->id}}">{{$bln->nm_bulan}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="buyer">Buyer</label>
                                    <input class="form-control" name="buyer" id="buyer" type="text"
                                        autocomplete="off" required multiple>
                                </div>
                                <div class="form-group">
                                    <label for="nm_brg">Nama Barang</label>
                                    <select name="nm_brg" id="nm_brg" class="form-control chosen-select"
                                        onchange="updateBarang(this);">
                                        <option value="" selected disabled>- pilih -</option>
                                        @foreach ($stokss as $stk)
                                        <option value="{{$stk->items_id}}">{{$stk->itemsss->nm_brg}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jns_brg">Jenis</label>
                                    <select class='form-control' name='jns_brg' required='required' id='input-barang'
                                        onchange="getStock(this)">
                                        <option value="">- pilih -</option>

                                    </select>

                                    <span class="help-block" id='input-barang-status' style="display:none;">
                                        Silahkan pilih barang.
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="awal">Awal</label>
                                    <input class="form-control"  name="awal" id="awal" type="text"  multiple hidden>
                                    {{-- <div id="awal_stoks"></div> --}}
                                    <input class="form-control"  name="awal-1" id="awal-1" type="text" style="display:none;"  multiple disabled>
                                    <span class="help-block" id='awal-status' style="display:none;">
                                        Silahkan pilih barang.
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="hrg_jual">Harga Jual</label>
                                    <input class="form-control"  name="hrg_jual" id="hrg_jual" type="number" multiple hidden>
                                    {{-- <div id="awal_stoks"></div> --}}
                                    <input class="form-control"  name="hrg_jual-1" id="hrg_jual-1" type="number" style="display:none;"  multiple disabled>
                                    <span class="help-block" id='hrg_jual-status' style="display:none;">
                                        Silahkan pilih barang.
                                    </span>
                                </div>
                                <script>
                                var listBarang;
                                function updateBarang(stk){
                                    if(stk.value==''){
                                        $('#input-barang-status').show().html("Pilih barang terlebih dahulu.");
                                        $('#input-barang').hide();
                                    }else{
                                        $.ajax({
                                            url:'listbarang/'+stk.value,
                                            type:'get',
                                            dataType:'json',
                                            data:{'nm_brg':stk.value},
                                            beforeSend:function(){
                                                $('#input-barang').hide();
                                                $('#input-barang-status').show().html("<strong><i class='fa fa-spinner fa-spin'></i> Memuat list jenis barang</strong>");
                                                console.log("beforesend triggered");
                                            },
                                            success:function(result){
                                                listBarang=result;
                                                
                                                if(listBarang.length >= 1){
                                                    var options="<?php echo "<option selected disabled>-pilih-</option>";?>";
                                                    // var test="<?php echo "<option>-pilih-</option>";?>"
                                                    listBarang.forEach(function(item){
                                                        options+=
                                                                "<option id='jenis_barang' value='" +
                                                                item.types_id + "'>" + item
                                                                .jns_brg + "</option>"
                                                    });
                                                    // $('#input-barang').html(test).show();
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
                                function getStock(jenis){
                                        $.ajax({
                                            url : 'listbarang/' + $('#jenis_barang').val(),
                                            type : 'GET',
                                            dataType : 'json',
                                            success : function(data){
                                                let newData = data.find((item) => item.types_id == jenis.value)
                                                $('#awal').val(newData.stok).show(),
                                                $('#awal-1').val(newData.stok).show(),
                                                $('#hrg_jual').val(newData.hrg_jual).show(),
                                                $('#hrg_jual-1').val(newData.hrg_jual).show()
                                            }
                                        })
                                    }
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
                                function hanyaAngka(evt) {
                                    var charCode = (evt.which) ? evt.which : event.keyCode
                                    if (charCode == 46 || (charCode >= 48 && charCode <= 57))
                                    
                                    return true;
                                        return false;
                                    
                                    }
                                    $(document).ready(function(){
                                        $('.chosen-select').chosen();
                                    })
                                </script>
                                {{-- <div class="form-group">
                                    <label for="jns_brg">Jenis:</label>
                                    <input class="form-control"  name="jns_brg" id="jns_brg" type="text" placeholder="Jenis barang">
                                </div> --}}
                                {{-- <div class="form-group {{ $errors->has('stok') ? 'has-error' : '' }}">
                                <label class="control-label" for="title">Stok Awal:</label>
                                <input id="stok" type="text" name="stok" class="form-control"
                                    placeholder="Post Title ..." value="{{ old('stok', $outs->stok) }}" disabled>
                            </div> --}}
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input class="form-control" name="tanggal" id="tanggal" type="date" value="{{date('Y-m-d')}}"
                                    multiple>
                            </div>
                            
                            {{-- <div class="form-group">
                                    <label for="tanggal">Tanggal:</label>
                                    <input class="form-control"  name="tanggal" id="tanggal" type="date" placeholder="Tanggal" multiple>
                                </div> --}}
                            <div class="form-group">
                                
                                <input name="kategori" id="checkbox" type="checkbox" value="1" onchange="showHiddenField(this)"
                                    autocomplete="off" multiple>
                                <label for="kategori">Box Packing</label>
                            </div>
                            <div class="form-group" id="tes">
                                <label for="jumlah">QTY</label>
                                <input class="form-control" name="jumlah" id="jumlah" onkeypress="return hanyaAngka(event)" type="number"
                                    autocomplete="off" multiple>
                            </div>
                            <div class="form-group" id="box" style="display: none;">
                                <label for="jumlah-paking">QTY</label><br>
                                <input class="form-control" name="jum-pak" id="jum-pak" onkeypress="return hanyaAngka(event)" type="number" onkeyup="sum();">
                                <input class="form-control" name="jum-pak-1" id="jum-pak-1" type="number" value="5" onkeyup="sum();" hidden>
                            </div>
                            <div class="form-group" id="box1" style="display: none;">
                                <label for="total_b">Total Berat</label><br>
                                <input class="form-control" name="total_b" id="total-b" type="number" hidden>
                                <input class="form-control" name="total_b" id="total-b-1" type="number" disabled>
                            </div>
                            <hr>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit"> Simpan</button>

                    <a href="{{ url('keluar') }}" class="btn btn-default">Keluar</a>
                    {{-- <button class="btn btn-primary" id="btn-plus" type="button" onclick="tambah_row()"><i
                            class="fa fa-plus mr-2"></i></button> --}}
                </div>

                </fieldset>
                </form>


            </div>
        </div>
        <script>
            function tambah_row() {
                let elListCheckout = $('#list-Checkout');
                let list = elListCheckout.children();
                let count_checkout = list.length

                elListCheckout.append(`
                <div class="form-group">
                    <label for="nm_brg-${count_checkout+1}">Nama Barang</label>
                    <select name="nm_brg[]" id="nm_brg1-${count_checkout+1}" class="form-control" onchange="updateBarang1(this);">
                    <option value="">- pilih -</option>
                    @foreach ($stokss as $list)
                        <option value="{{$list->id}}"multiple>{{$list->nm_brg}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jns_brg-${count_checkout+1}">Jenis</label>
                    <select class='form-control' name='jns_brg[]' required='required' id='input-jenis-${count_checkout+1}' style="display:none;">
                    </select>
        
                    <span class="help-block" id='input-jenis-status' style="display:none;">
                        Pilih barang dulu bro.
                    </span>
                </div>

                <div id="jumlah-${count_checkout+1}">
                    <label for="jumlah-${count_checkout+1}">Jumlah</label>
                    <input type="text" id="jumlah-${count_checkout+1}" name="jumlah[]" placeholder="jumlah..." class="form-control">
                </div>
                <br>
                <div id="kategori-${count_checkout+1}">
                    <label for="kategori-${count_checkout+1}">Kategori</label>
                    <input type="text" id="kategori-${count_checkout+1}" name="kategori[]" placeholder="kategori...." class="form-control">
                </div>
                <hr>
            `);
            }

        </script>
    </div>
</div>
@include('sweetalert::alert')
@endsection ('content')
@section('footer.script')
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
$( "#tanggal" ).datepicker({                  
    minDate: moment().add('d', 1).toDate(),
});
} );
</script> --}}
@endsection