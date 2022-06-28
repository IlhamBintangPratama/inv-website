@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1>Purchase Order</h1>
        <div class="row align-items-center mt-5 ">
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="width: 100%;">
                        <div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('tambahSuplier') }}" autocomplete="off">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="suplier" class="col-md-4 control-label">Supplier</label>
                                    <input class="form-control ml-3" style="width: 90%" name="suplier" id="suplier" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="no_telp" class="col-md-4 control-label">No. Telp</label>
                                    <input class="form-control ml-3" style="width: 90%" name="no_telp" id="no_telp" onkeypress="return hanyaAngka(event)" type="number">
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
                        {{-- <script>        
                            function phoneno(evt){          
                                $('#phone').keypress(function(e) {
                                    var a = [];
                                    var k = e.which;
                    
                                    for (i = 48; i < 58; i++)
                                        a.Push(i);
                    
                                    if (!(a.indexOf(k)>=0))
                                        e.preventDefault();
                                });
                            }
                        </script> --}}
                    </div>
                </div>
            </div>                 
            <div class="col-md-6">
                <div class="contact-form" style="background: rgb(253, 253, 253);">
                    <div id="success"></div>
                    <form method="Post" action="{{ url('home') }}" name="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            {{-- <div class="form-group">
                                <label for="nm_brg">Nama Barang:</label>
                                <input class="form-control"  name="nm_brg" id="nm_brg" type="text" placeholder="Nama barang">
                            </div> --}}
                            <div id="list-Checkout">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input class="form-control"  name="tanggal" id="tanggal" type="text" multiple value="{{date('Y-m-d')}}" hidden>
                                    <input class="form-control"  name="tgl-1" id="tgl-1" type="date" multiple value="{{date('Y-m-d')}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="suplier">Supplier</label>
                                    <div class="form-inline">
                                        <select name="suplier" id="suplier" class="form-control chosen-select" style="width: 79%" required='required'>
                                            <option value="" selected disabled>- pilih -</option>
                                            @foreach ($suplier as $supl)
                                            <option value="{{$supl->id}}">{{$supl->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                        <button href="#" class="btn-primary ml-3" style="height: 35px; width: 80px;" data-toggle="modal" data-target="#exampleModal">Baru</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nm_brg">Nama Barang</label>
                                    <select name="nm_brg" id="nm_brg" class="form-control chosen-select" required='required'
                                        onchange="updateBarangpurc(this);">
                                        <option value="" selected disabled>- pilih -</option>
                                        @foreach ($awal as $stok)
                                        <option value="{{$stok->items_id}}">{{$stok->item->nm_brg}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jns_brg">Jenis</label>
                                    <select class='form-control' name='jns_brg' required='required' id='inp-jns' required='required'
                                        onchange="getStock(this)">
                                        <option value="">- pilih -</option>
                                    </select>
                                    {{-- <label for="jns_brg">Jenis</label>
                                        <select id="jenis" name="jenis" class="form-control" style="display:none;">
                                        <option value="">- pilih -</option>
                                        @foreach ($stokss as $type)
                                        <option value="{{$type->types_id}}"multiple>{{$type->jns_brg}}</option>
                                    @endforeach--}}
                                    {{-- <br> --}}
                                    <span class="help-block" id='inp-jns-status' style="display:none;">
                                        Pilih barang terlebih dahulu.
                                    </span> 
                                </div>
                                <div class="form-group">
                                    <label for="awal">Awal</label>
                                    <input class="form-control"  name="awal" id="awal" type="text" multiple hidden>
                                    {{-- <div id="awal_stoks"></div> --}}
                                    <input class="form-control"  name="awal" id="awal-1" type="text" multiple disabled>
                                </div>
                                <script>
                                    var listTypes;

                                    function updateBarangpurc(stok) {
                                        if (stok.value == '') {
                                            $('#inp-jns-status').show().html("Pilih barang terlebih dahulu.");
                                            $('#inp-jns').hide();
                                        } else {
                                            $.ajax({
                                                url: 'listtypes/' + stok.value,
                                                type: 'get',
                                                dataType: 'json',
                                                data:{'nm_brg':stok.value},
                                                beforeSend: function () {
                                                    $('#inp-jns').hide();
                                                    $('#inp-jns-status').show().html(
                                                        "<strong><i class='fa fa-spinner fa-spin'></i> Memuat List Barang</strong>"
                                                        );
                                                    console.log("beforesend triggered");
                                                },
                                                success: function (result) {
                                                    listTypes = result;
                                                    if (listTypes.length > 0) {
                                                        var options = "<?php echo "<option selected disabled>-pilih-</option>";?>";
                                                        listTypes.forEach(function (item) {
                                                            options +=
                                                                "<option id='jenis_barang' value='" +
                                                                item.types_id + "'>" + item
                                                                .jns_brg + "</option>"
                                                        });
                                                        $('#inp-jns').html(options).show();
                                                        $('#inp-jns-status').hide();
                                                        // listTypes.forEach(function(item){
                                                        //     options+="<input value='"+item.id.toString()+"'>"
                                                        // });
                                                        // $('#awal').html(options).show();
                                                        // $('#awal-status').hide();
                                                    } else {
                                                        $('#inp-jns-status').show().html(
                                                            "<strong>Tidak ada jenis yang sesuai.</strong>"
                                                            );
                                                        $('#inp-jns').hide();
                                                        $('#awal-status').show().html(
                                                            "<strong>Tidak ada stok yang sesuai.</strong>"
                                                            );
                                                        $('#awal').hide();
                                                    }
                                                },
                                                error: function (err) {
                                                    console.log(err);
                                                    $('#inp-jns-status').show().html(
                                                        "<strong>Kesalahan saat memuat data</strong>");
                                                    $('#inp-jns').hide();
                                                },
                                                complete: function () {

                                                }
                                            });

                                        }

                                    }

                                    function getStock(jenis){
                                        $.ajax({
                                            url : 'listtypes/' + $('#nm_brg').val(),
                                            type : 'GET',
                                            dataType : 'json',
                                            success : function(data){
                                                let newData = data.find((item) => item.types_id == jenis.value)
                                                $('#awal').val(newData.stok).show(),
                                                $('#awal-1').val(newData.stok).show()
                                            }
                                        })
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
                                <label for="jumlah">QTY</label>
                                <input class="form-control" name="jumlah" id="jumlah" onkeypress="return hanyaAngka(event)" type="decimal" style="height: 45px;"
                                    autocomplete="off" multiple required='required'>
                            </div>
                            
                            <div class="form-group">
                                <label for="hrg_item">Harga Beli</label>
                                <input class="form-control" name="hrg_item" id="hrg_item" onkeypress="return hanyaAngka(event)" type="number" style="height: 45px;
                                    autocomplete="off" multiple required='required'>
                            </div>
                            <hr>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit"> Simpan</button>
                </div>

                </fieldset>
                </form>
            </div>
            </div>
        </div>
        <style>
            .table-shadow:hover {
            border-color: transparent;
            box-shadow: 0 0 30px rgba(0, 0, 0, .1);
            }
        </style>
        <div class="row align-items-center" style="margin-top: -71.8%;">
            <div class="col-md-6" style="margin-left: 50%;">
                <div class="table-responsive table-shadow" style="">
                    {{-- <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col" class="sort" data-sort="name">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($kebutuhan as $laps)
                            <tr>
                            <td class="budget">
                                {{ $laps->Catatan }}
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table> --}}
                        <div class="card-header border-0">
                            <h3 class="mb-0">Rincian</h3>
                        </div>
                    <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col" class="sort" data-sort="name">No</th>
                        <th scope="col" class="sort" data-sort="name">Suplier</th>
                        <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                        <th scope="col" class="sort" data-sort="name">Jenis</th>
                        <th scope="col" class="sort" data-sort="name">QTY</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($rincian as $no => $laps)
                        <tr>
                        <td>
                            {{ $rincian->firstItem()+$no}} 
                        </td>
                        <td class="budget">
                            {{ $laps->suplier->name }}
                        </td>
                        <td class="budget">
                            {{ $laps->brg1->nm_brg }}
                        </td>
                        <td class="budget">
                            {{ $laps->jns1->jns_brg }}
                        </td>
                        <td class="budget">
                            {{ $laps->jumlah }} Kg
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <div class="card-footer py-4">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                        {{$rincian->links()}}
                        </ul>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection

@section('footer.script')


