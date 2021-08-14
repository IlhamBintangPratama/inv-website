@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
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
                                    <label for="nm_brg">Nama Barang</label>
                                    <select name="nm_brg" id="nm_brg" class="form-control"
                                        onchange="updateBarang(this);">
                                        <option value="">- pilih -</option>
                                        @foreach ($stokss as $stoks)
                                        <option value="{{$stoks->items_id}}">{{$stoks->itemsss->nm_brg}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jns_brg">Jenis</label>
                                    <select class='form-control' name='jns_brg' required='required' id='input-barang'
                                        style="display:none;" onchange="getStock(this)">
                                    </select>

                                    <span class="help-block" id='input-barang-status' style="display:none;">
                                        Silahkan pilih barang.
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="awal">Awal</label>
                                    <input class="form-control"  name="awal" id="awal" type="text" style="display:none;"  multiple hidden>
                                    {{-- <div id="awal_stoks"></div> --}}
                                    <input class="form-control"  name="awal-1" id="awal-1" type="text" style="display:none;"  multiple disabled>
                                    <span class="help-block" id='awal-status' style="display:none;">
                                        Silahkan pilih barang.
                                    </span>
                                </div>
                                <script>
                                var listBarang;
                                function updateBarang(stoks){
                                    if(stoks.value==''){
                                        $('#input-barang-status').show().html("Pilih barang terlebih dahulu.");
                                        $('#input-barang').hide();
                                    }else{
                                        $.ajax({
                                            url:'listbarang/'+stoks.value,
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
                                                    var options="";
                                                    listBarang.forEach(function(item){
                                                        options+="<option id='jenis_barang' value='" +
                                                                item.types_id + "'>" + item
                                                                .jns_brg + "</option>"
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
                                function getStock(jenis){
                                        $.ajax({
                                            url : 'listbarang/' + $('#nm_brg').val(),
                                            type : 'GET',
                                            dataType : 'json',
                                            success : function(data){
                                                let newData = data.find((item) => item.types_id == jenis.value)
                                                $('#awal').val(newData.stok).show(),
                                                $('#awal-1').val(newData.stok).show()
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
                                <input class="form-control" name="tanggal" id="tanggal" type="date"
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
                                <input class="form-control" name="jumlah" id="jumlah" type="number"
                                    autocomplete="off" multiple>
                            </div>
                            <div class="form-group" id="box" style="display: none;">
                                <label for="jumlah-paking">QTY</label><br>
                                <input class="form-control" name="jum-pak" id="jum-pak" type="number" onkeyup="sum();">
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
                    {{-- <button class="btn btn-primary" id="btn-plus" type="button" onclick="tambah_form()"><i
                            class="fa fa-plus mr-2"></i></button> --}}
                </div>

                </fieldset>
                </form>


            </div>
        </div>

        <script>
            function tambah_form() {
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