    @extends ('admin-layouts.master')

    @section ('content')
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid mt-4">

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header mb-4 mt-3">Permintaan Stok</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
                <div class="colm-lg-6">
                    <form method="Post" action="{{ url('permintaan') }}" name="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <fieldset >
                                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                                        Gunakan EOQ?
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content" style="width: 160%">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Economic Order Quantity</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                <table class="table align-items-center table-flush">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>No</th>
                                                        <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                                                        <th scope="col" class="sort" data-sort="name">Jenis</th>
                                                        <th scope="col" class="sort" data-sort="name">Periode</th>
                                                        <th scope="col" class="sort" data-sort="name">Frekuensi</th>
                                                        <th scope="col" class="sort" data-sort="name">Waktu Pemesanan</th>
                                                        <th scope="col" class="sort" data-sort="name">EOQ</th>
                                                        <th scope="col" class="sort" data-sort="completion">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                    @foreach($eoqresult as $eoq)
                                                    <tr>
                                                        <td>{{ $loop->iteration}} </td>
                                                        <th scope="row">
                                                        <div class="media align-items-center">
                                                            <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $eoq->typ_items->nm_brg }}</span>
                                                            </div>
                                                        </div>
                                                        </th>
                                                        <td class="budget">
                                                        {{ $eoq->jns_items->jns_brg }}
                                                        </td>
                                                        <td class="budget">
                                                        {{ $eoq->periode }} Hari
                                                        </td>
                                                        <td class="budget">
                                                            {{ $eoq->frekuensi }}x
                                                        </td>
                                                        <td class="budget">
                                                            {{ $eoq->leadtime }} Hari
                                                        </td>
                                                        <td class="budget">
                                                        {{ $eoq->eoq }} Kg
                                                        </td>
                                                        <td>  
                                                            <a href="#" class="btn btn-primary" id="select"
                                                                data-id="{{$eoq->id}}"
                                                                data-nama="{{$eoq->items_id}}"
                                                                data-nama2="{{$eoq->typ_items->nm_brg}}"
                                                                data-jenis="{{$eoq->types_id}}"
                                                                data-jenis2="{{$eoq->jns_items->jns_brg}}"
                                                                data-jumlah="{{$eoq->eoq}}"
                                                                data-frekuensi="{{$eoq->frekuensi}}"
                                                                data-waktu="{{$eoq->leadtime}}">Pilih</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </div>                        
                                    <script>
                                        $(document).ready(function(){
                                        $(document).on('click', '#select', function(){
                                            var id_eoq = $(this).data('id');
                                            var nm_brg = $(this).data('nama');
                                            var nm_brg2 = $(this).data('nama2');
                                            nm_brg+="<option value='"+nm_brg+"'>"+nm_brg2+"</option>"
                                            var jns_brg = $(this).data('jenis');
                                            var jns_brg2 = $(this).data('jenis2');
                                            jns_brg+="<option value='"+jns_brg+"'>"+jns_brg2+"</option>"
                                            var eoq = $(this).data('jumlah');
                                            var frekuensi = $(this).data('frekuensi');
                                            var waktu = $(this).data('waktu');
                                            $('#id_eoq').val(id_eoq);
                                            $('#nm_brg').html(nm_brg).show();
                                            $('#input-barang').html(jns_brg).show();
                                            $('#jumlah').val(eoq);
                                            $('#frekuensi').val(frekuensi);
                                            $('#waktu_pemesanan').val(waktu);
                                            $('#exampleModal').modal('hide');
                                        })
                                    })
                                    </script>
                            <style>
                                .colm-lg-6
                                {
                                    max-width: 45%;
                                    flex: 0 0 45%;
                                    margin-left: 1%;
                                }
                                .col-cok
                                {
                                    max-width: 54%; 

                                    flex: 0 0 54%;
                                }
                                .wd-2
                                {
                                    width: 50%;
                                }
                                .con-md-2
                                {
                                    max-width: 140%;
                                    flex: 140%;
                                    margin-right: 5%;
                                }
                            </style>
                            <div class="wd-2">
                                <div class="form-group">
                                    <label for="nm_brg">Nama Barang</label>
                                    <input class="form-control"  name="jumlah" id="id_eoq" style="width: 180%" type="text" hidden>
                                    <select name="nm_brg" id="nm_brg" class="form-control" onchange="getData(this);" style="width: 180%">
                                        <option value="">- pilih -</option>
                                        @foreach ($stokss as $stoks)
                                        <option value="{{$stoks->items_id}}">{{$stoks->itemsss->nm_brg}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jns_brg">Jenis</label>
                                    <select class='form-control' name='jns_brg' required='required' id='input-barang'
                                        style="width:180%;">
                                    </select>
                                </div>
                            
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input class="form-control"  name="jumlah" id="jumlah" style="width: 180%" type="number" autocomplete="off" multiple>
                                    {{-- <div id="awal_stoks"></div> --}}
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Frekuensi Pemesanan (x)</label>
                                    <input class="form-control"  name="frekuensi" id="frekuensi" style="width: 180%" type="number" autocomplete="off" multiple>
                                    {{-- <div id="awal_stoks"></div> --}}
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Waktu Pemesanan (Hari)</label>
                                    <input class="form-control"  name="waktu_pemesanan" id="waktu_pemesanan" style="width: 180%" max="31" type="number" autocomplete="off" multiple>
                                    {{-- <div id="awal_stoks"></div> --}}
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success" style="width: 180%">Create</button>
                            </div>
                            </fieldset>
                        </form>
                </div>
                <script>
                    var listBarang;
                        function getData(stoks){
                            if(stoks.value==''){
                                $('#input-barang-status').show().html("Pilih barang terlebih dahulu.");
                                $('#input-barang').hide();
                            }else{
                                $.ajax({
                                    url:'listrequest/'+stoks.value,
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
                                                        item.id + "'>" + item
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
                    </script>
            <div class="col-cok">
                <div class="row">
                    <div class="con-md-2">
                        <div class="card">
                            <!-- Card header -->
                                <div class="card-header border-0">
                                    <h3 class="mb-0">Permintaan Stok</h3>
                                </div>
                                <!-- Light table -->
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                        <th>No</th>
                                        <th scope="col" class="sort" data-sort="name">Tanggal</th>
                                        <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                                        <th scope="col" class="sort" data-sort="name">Jenis</th>
                                        <th scope="col" class="sort" data-sort="name">Jumlah</th>
                                        <th scope="col" class="sort" data-sort="completion">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($permintaan as $no => $perm)
                                        <tr>
                                        <td>{{ $permintaan->firstItem()+$no}} </td>
                                        <td class="budget">
                                            {{ $perm->tanggal }}
                                        </td>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $perm->permStok->nm_brg }}</span>
                                            </div>
                                            </div>
                                        </th>
                                        <td class="budget">
                                            {{ $perm->permStok2->jns_brg }}
                                        </td>
                                        <td class="budget">
                                            {{ $perm->jumlah }} Kg
                                        </td>
                                        <td>
                                            <form action="{{url('/permintaan/'.$perm->id.'/destroy') }}" method="POST"
                                                id="delete-form">
                                                {{ csrf_field() }} 
                                                
                                                <button type="submit" class="btn btn-sm btn-danger" id="delete-btn" onclick="return confirm('Data yakin dihapus ?')" >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                                            <!-- Modal -->
                    
                                    <div class="card-footer py-4">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                {{$permintaan->links()}}
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    @endsection ('content')
    @section('footer.script')

    @endsection





