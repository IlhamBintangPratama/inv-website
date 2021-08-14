@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
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
                            <select class="form-control mb-2"  name="jml_hari" id="jml_hari">
                                <option value="">- pilih -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                            
                            <select name="periode" id="periode" class="form-control">
                                <option value="">- pilih -</option>
                                @foreach ($per as $prd)
                                <option value="{{$prd->jml_hari}}">{{$prd->periode}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <select name="nm_brg" id="nm_brg" class="form-control"
                                onchange="pickType(this);">
                                <option value="">- pilih -</option>
                                @foreach ($types as $type)
                                <option value="{{$type->items_id}}">{{$type->itemsss->nm_brg}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jns_brg">Jenis</label>
                            <select class='form-control' name='jns_brg' required='required' id='input-jeniss'
                                style="display:none;" onchange="getHarga(this)">
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
                                                var options="";
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
                            </script>
                        <div class="form-group">
                            <label for="hrg_item">Harga Item</label>
                            <input class="form-control"  name="hrg_item" id="hrg_item" type="number" autocomplete="off" multiple>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            <label for="by_simpan">Biaya Simpan (%)</label>
                            <input class="form-control"  name="by_simpan" id="by_simpan" max="100" type="number" autocomplete="off" multiple>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            <label for="by_pesan">Biaya Pesan</label>
                            <input class="form-control"  name="by_pesan" id="by_pesan" type="number" autocomplete="off" multiple>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            <label for="permintaan">Permintaan (Kg)</label>
                            <input class="form-control"  name="permintaan" id="permintaan" type="number" placeholder="Jumlah permintaan barang" autocomplete="off">
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




