@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1>Riwayat Belanja</h1>
        <div class="row align-items-center mt-5 ">
            
            <div class="col-md-7">
                <div class="contact-form" style="background: rgb(253, 253, 253); width:175%;">
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
                                    <b style=" float: right; margin-right: 73%; margin-top: -3.6%;">
                                    <a style="height: 38px; width: 50px;" onclick="this.href='{{url('purchase/riwayat-per')}}/'+document.getElementById('tanggal').value" class="btn btn-sm btn-neutral"></a>
                                    <p style="margin-left: 25%; margin-top: -50%;"><i style="margin-left: 18.2%; margin-top: -120%;" class="fas fa-search"></i></p>
                                    </b>
                                    {{-- <a style="float: right; margin-top: -3.49%; margin-right: 73%; border-radius: .25rem; height: 36px;" class="btn btn-sm btn-neutral"></a> --}}
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
