@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1 style="margin-left: -4%;">Kebutuhan Gudang</h1>
        <div class="row align-items-center mt-5 ">
            
            <div class="col-md-7">
                <div class="contact-form" style="background: rgb(253, 253, 253); width:190%; margin-left: -7%;">
                    <div id="success"></div>
                    <form method="Post" action="{{ url('purchase') }}" name="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            {{-- <div class="form-group">
                                <label for="nm_brg">Nama Barang:</label>
                                <input class="form-control"  name="nm_brg" id="nm_brg" type="text" placeholder="Nama barang">
                            </div> --}}
                            <div id="list-Checkout">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <select name="tanggal" id="tanggal" class="form-control" style="width: 20%">
                                        <option value="0">- pilih -</option>
                                        @foreach ($awal1 as $stok)
                                        <option value="{{$stok->tanggal}}">{{$stok->tanggal}}</option>
                                        @endforeach
                                    </select>
                                    <b style=" float: right; margin-right: 73%; margin-top: -3.37%;">
                                    <a style="height: 38px; width: 50px;" onclick="this.href='{{url('purchase/tanggal-kebutuhan')}}/'+document.getElementById('tanggal').value" class="btn btn-sm btn-neutral"></a>
                                    <p style="margin-left: 25%; margin-top: -50%;"><i style="margin-left: 18.2%; margin-top: -120%;" class="fas fa-search"></i></p>
                                    </b>
                                    {{-- <a style="float: right; margin-top: -3.49%; margin-right: 73%; border-radius: .25rem; height: 36px;" class="btn btn-sm btn-neutral"></a> --}}
                                </div>
                                
                                <div class="table-responsive">
                                    <style>
                                        .badge-dot
                                        {
                                            font-size: .875rem;
                                            font-weight: 400;
                
                                            padding-right: 0;
                                            padding-left: 0;
                
                                            text-transform: none; 
                
                                            background: transparent;
                                        }
                                        .badge-dot strong
                                        {
                                            color: #32325d;
                                        }
                                        .badge-dot i
                                        {
                                            display: inline-block;
                
                                            width: .415rem;
                                            height: .415rem;
                                            margin-right: .415rem; 
                
                                            vertical-align: middle;
                
                                            border-radius: 50%;
                                        }
                                        .badge-dot.badge-md i
                                        {
                                            width: .5rem;
                                            height: .5rem;
                                        }
                                        .badge-dot.badge-lg i
                                        {
                                            width: .625rem;
                                            height: .625rem;
                                        }
                                    </style>
                                    <!-- Modal -->
                                    
                                    <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                        <th scope="col" class="sort" data-sort="name">Tanggal</th>
                                        <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                                        <th scope="col" class="sort" data-sort="name">Jenis</th>
                                        <th scope="col" class="sort" data-sort="name">Jumlah</th>
                                        <th scope="col" class="sort" data-sort="name">Frekuensi</th>
                                        <th scope="col" class="sort" data-sort="name">Waktu Pemesanan</th>
                                        <th scope="col" class="sort" data-sort="name">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($data_request as $laps)
                                        <tr>
                                        <td class="budget">
                                            {{ $laps->tanggal }}
                                        </td>
                                        <td class="budget">
                                            {{ $laps->permStok->nm_brg }}
                                        </td>
                                        <td class="budget">
                                            {{ $laps->permStok2->jns_brg }}
                                        </td>
                                        <td class="budget">
                                            {{ $laps->jumlah }} Kg
                                        </td>
                                        <td class="budget">
                                            {{ $laps->frekuensi }}x
                                        </td>
                                        <td class="budget">
                                            {{ $laps->waktu_pemesanan }} Hari
                                        </td>
                                        <td>
                                            <?php if($laps->status == '1'){?>
                                                <a href="{{url('purchase/kebutuhan', $laps->id)}}" class="btn-success">Selesai</a>
                                            <?php }else{?>
                                                <a href="{{url('purchase/kebutuhan', $laps->id)}}" class="btn-danger">Masih Dilakukan</a>
                                            <?php }?>
                                        </td>
                                    
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                                <div class="card-footer py-4">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                        {{ $data_request->links()}}
                                        </ul>
                                    </nav>
                                </div>
                                <hr>
                            </div>
                        </fieldset>
                    </form>
                    
                </div>
        </div>
    </div>
</div>
</div>
@include('sweetalert::alert')
@endsection
