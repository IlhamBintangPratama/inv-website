@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
<div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header mb-4 mt-3">Reorder Point</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
            <form method="Post" action="{{ url('rop') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group">
                            <label for="eoq_id">Kode EOQ</label>
                            <select name="eoq_id" id="eoq_id" class="form-control"
                                onchange="getEoq(this);">
                                <option value="">- pilih -</option>
                                @foreach ($eoq as $get)
                                <option value="{{$get->id}}">EOQ00{{$get->id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control"  name="eoq" id="eoq" type="text" hidden>
                        </div>
                        {{-- <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <select name="nm_brg" id="nm_brg" class="form-control"
                                onchange="pickType(this);">
                                <option value="">- pilih -</option>
                                @foreach ($types as $type)
                                <option value="{{$type->items_id}}">{{$type->itemsss->nm_brg}}</option>
                                    @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <input class="form-control"  name="nm_brg" id="nm_brg" type="text" autocomplete="off" multiple>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <script>
                            // var listJeniss;
                            // function pickType(type){
                            //     if(type.value==''){
                            //         $('#input-jeniss-status').show().html("Pilih barang terlebih dahulu.");
                            //         $('#input-jeniss').hide();
                            //     }else{
                            //         $.ajax({
                            //             url:'picktypes/'+type.value,
                            //             type:'get',
                            //             dataType:'json',
                            //             data:{'nm_brg':type.value},
                            //             beforeSend:function(){
                            //                 $('#input-jeniss').hide();
                            //                 $('#input-jeniss-status').show().html("<strong><i class='fa fa-spinner fa-spin'></i> Memuat list jenis barang</strong>");
                            //                 console.log("beforesend triggered");
                            //             },
                            //             success:function(result){
                            //                 listJeniss=result;
                            //                 if(listJeniss.length >= 1){
                            //                     var options="";
                            //                     listJeniss.forEach(function(item){
                            //                         options+="<option value='"+item.id+"'>"+item.jns_brg+"</option>"
                            //                     });
                            //                     $('#input-jeniss').html(options).show();
                            //                     $('#input-jeniss-status').hide();
                            //                 }else{
                            //                     $('#input-jeniss-status').show().html("<strong>Tidak ada jenis barang yang sesuai.</strong>");
                            //                     $('#input-jeniss').hide();
                            //                 }
                            //             },
                            //             error:function(err){
                            //                 console.log(err);
                            //                 $('#input-jeniss-status').show().html("<strong>Kesalahan saat memuat data</strong>");
                            //                 $('#input-jeniss').hide();
                            //             },
                            //             complete:function(){
    
                            //             }
                            //         });
    
                            //     }
                                
                            // }
                            function getEoq(eoq){
                                        $.ajax({
                                            url : 'pickeoq/' + $('#eoq_id').val(),
                                            type : 'GET',
                                            dataType : 'json',
                                            success : function(data){
                                                let newData = data.find((item) => item.id == eoq.value)
                                                $('#eoq').val(newData.eoq).show()
                                                $('#nm_brg').val(newData.nm_brg).show()
                                                $('#jns_brg').val(newData.jns_brg).show()
                                                $('#periode').val(newData.periode).show()
                                                $('#frekuensi').val(newData.frekuensi).show()
                                                $('#waktu').val(newData.leadtime).show()
                                            }
                                        })
                                    }
                            </script>
                        <div class="form-group">
                            <label for="jns_brg">Jenis</label>
                            <input class="form-control"  name="jns_brg" id="jns_brg" type="text" autocomplete="off" multiple>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            <label for="periode">Periode Pesan (Hari)</label>
                            <input class="form-control"  name="periode" id="periode" type="text" autocomplete="off" multiple>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            <label for="frekuensi">Frekuensi (Kali)</label>
                            <input class="form-control"  name="frekuensi" id="frekuensi" type="text" autocomplete="off" multiple>
                            {{-- <div id="awal_stoks"></div> --}}
                        </div>
                        <div class="form-group">
                            {{-- <label for="waktu">WP</label> --}}
                            <input class="form-control"  name="waktu" id="waktu" type="text" autocomplete="off" hidden>
                        </div>
                        <div class="form-group">
                            <label for="leadtime">Lead Time (Hari)</label>
                            <input class="form-control"  name="leadtime" id="leadtime" type="text" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>

                        {{-- <a href="{{ url('rop') }}" class="btn btn-default">Back</a> --}}
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection ('content')




