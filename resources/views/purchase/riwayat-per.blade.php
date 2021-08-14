@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1>Riwayat Belanja</h1>
        <div class="row align-items-center mt-5 ">
            
            <div class="col-md-7">
                <div class="contact-form" style="background: rgb(253, 253, 253); width:175%;">
                    <div id="success"></div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <select name="tanggal" id="tanggal" class="form-control" style="width: 20%">
                            <option value="0">- pilih -</option>
                            @foreach ($awal1 as $stok)
                            <option value="{{$stok->tanggal}}">{{$stok->tanggal}}</option>
                            @endforeach
                        </select>
                        <b style=" float: right; margin-right: 73%; margin-top: -3.6%;">
                        <a style="height: 38px; width: 50px;" href="" onclick="this.href='{{url('purchase/riwayat-per')}}/'+document.getElementById('tanggal').value" class="btn btn-sm btn-neutral"></a>
                        <p style="margin-left: 25%; margin-top: -50%;"><i style="margin-left: 18.2%; margin-top: -120%;" class="fas fa-search"></i></p>
                        </b>
                        <b style="float: right; margin-left: 89.5%; margin-top: -4.2%;">
                        <input type="text" id="tgl_riwayat" value="{{$tgl}}" hidden>
                        <a href="" style="height: 38px; width: 50px;" onclick="this.href='{{url('cetak-riwayat-belanja')}}/'+document.getElementById('tgl_riwayat').value" target="_blank" class="btn btn-sm btn-neutral"></a>
                        <p style="margin-left: 25%; margin-top: -50%;"><i style="margin-left: 18.2%; margin-top: -120%;" class="fas fa-print"></i></p>
                        </b>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                            <th>No</th>
                            <th scope="col" class="sort" data-sort="name">Suplier</th>
                            <th scope="col" class="sort" data-sort="name">Tanggal</th>
                            <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                            <th scope="col" class="sort" data-sort="name">Jenis</th>
                            <th scope="col" class="sort" data-sort="name">Harga Item</th>
                            <th scope="col" class="sort" style="width: 10%" data-sort="name">Stok Awal</th>
                            <th scope="col" class="sort" data-sort="name">Jumlah (Kg)</th>
                            <th scope="col" class="sort" data-sort="name">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($riwayat as $laps)
                            <tr>
                            <td class="budget">
                                {{$loop->iteration }}
                            </td>
                            <td class="budget">
                                {{ $laps->suplier }}
                            </td>
                            <td class="budget">
                                {{ $laps->tanggal }}
                            </td>
                            <td class="budget">
                                {{ $laps->brg1->nm_brg }}
                            </td>
                            <td class="budget">
                                {{ $laps->jns1->jns_brg }}
                            </td>
                            <td class="budget">
                                {{ $laps->hrg_item }}
                            </td>
                            <td class="budget mr-5">
                                {{ $laps->awal }}
                            </td>
                            <td class="budget">
                                {{ $laps->jumlah }}
                            </td>
                            <td class="budget">
                                Rp. {{ number_format($laps->total) }}
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
</div>
@include('sweetalert::alert')
@endsection
