@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
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
                                onchange="updateItems(this);">
                                <option value="">- pilih -</option>
                                @foreach ($stokss as $stoks)
                                <option value="{{$stoks->items_id}}">{{$stoks->itemsss->nm_brg}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jns_brg">Jenis</label>
                            <select class='form-control' name='jns_brg' required='required' id='input-barang'
                                style="display:none;">
                            </select>

                            <span class="help-block" id='input-barang-status' style="display:none;">
                                Pilih barang dulu bro.
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
                                            var options="";
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
                        </script>
                        <div class="form-group">
                            <label for="stok">Jumlah Stok (Kg)</label>
                            <input class="form-control"  name="stok" id="stok" type="number" placeholder="Jumlah stok (Kg)">
                        </div>
                        
                        <button type="submit" class="btn btn-success">Save</button>

                        <a href="{{ url('stok') }}" class="btn btn-default">Back</a>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection ('content')




