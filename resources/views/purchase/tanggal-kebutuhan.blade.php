@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1 style="margin-left: -4%;">Kebutuhan Gudang</h1>
        <div class="row align-items-center mt-5 ">
            
            <div class="col-md-7">
                <div class="contact-form" style="background: rgb(253, 253, 253); width:190%; margin-left: -7%;">
                    <div id="success"></div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <select name="tanggal" id="tanggal" class="form-control" style="width: 20%">
                            <option value="0">- pilih -</option>
                            @foreach ($tanggal_kebutuhan as $stok)
                            <option value="{{$stok->tanggal}}">{{$stok->tanggal}}</option>
                            @endforeach
                        </select>
                        <b style=" float: right; margin-right: 73%; margin-top: -3.33%;">
                        <a style="height: 38px; width: 50px;" href="" onclick="this.href='{{url('purchase/tanggal-kebutuhan')}}/'+document.getElementById('tanggal').value" class="btn btn-sm btn-neutral"></a>
                        <p style="margin-left: 25%; margin-top: -50%;"><i style="margin-left: 18.2%; margin-top: -120%;" class="fas fa-search"></i></p>
                        </b>
                    </div>
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
                    <div class="table-responsive">
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
                        <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col" class="sort" data-sort="name">Tanggal</th>
                            <th scope="col" class="sort" data-sort="name">Nama Barang</th>
                            <th scope="col" class="sort" data-sort="name">Jenis</th>
                            <th scope="col" class="sort" data-sort="name">Jumlah</th>
                            <th scope="col" class="sort" data-sort="name">Frekuensi</th>
                            <th scope="col" class="sort" data-sort="name">Waktu Pemesanan</th>
                            {{-- <th scope="col" class="sort" data-sort="name">Status</th> --}}
                            </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($kebutuhan as $laps)
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
                            {{-- <td>
                                <span class="badge badge-dot badge-lg mr-4"><i class="{{($laps->status == 1) ?
                                'bg-success' : 'bg-danger'}}"></i>
                                    <span class="status">{{($laps->status == 1) ? 'Completed' : 'On progress'}}</span>
                                </span>
                            </td> --}}
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