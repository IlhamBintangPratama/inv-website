@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1>Purchase Order</h1>
        <div class="row align-items-center mt-5 ">
            
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
                                    <label for="suplier">Suplier</label>
                                    <input class="form-control" name="suplier" id="suplier" type="text"
                                        autocomplete="off" multiple>
                                </div>
                                <div class="form-group">
                                    <label for="nm_brg">Nama Barang</label>
                                    <select name="nm_brg" id="nm_brg" class="form-control"
                                        onchange="updateBarangpurc(this);">
                                        <option value="">- pilih -</option>
                                        @foreach ($awal as $stok)
                                        <option value="{{$stok->items_id}}">{{$stok->item->nm_brg}}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jns_brg">Jenis</label>
                                    <select class='form-control' name='jns_brg' required='required' id='inp-jns'
                                        onchange="getStock(this)">
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
                                                data:{'#nm_brg':stok.value},
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
                                                        var options = "";
                                                        listTypes.forEach(function (item) {
                                                            options +=
                                                                "<option  value='" +
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
                                                    $('#awal-status').show().html(
                                                        "<strong>Kesalahan saat memuat data</strong>");
                                                    $('#awal').hide();
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
                                <input class="form-control" name="jumlah" id="jumlah" type="number"
                                    autocomplete="off" multiple>
                            </div>
                            
                            <div class="form-group">
                                <label for="hrg_item">Harga</label>
                                <input class="form-control" name="hrg_item" id="hrg_item" type="number"
                                    autocomplete="off" multiple>
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
        <div class="row align-items-center" style="margin-top: -70.8%;">
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
                            {{ $laps->suplier }}
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


