@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header mb-4 mt-3">Edit Barang Masuk</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                <form method="Post" action="{{ url('/masuk/'.$ins->id.'/update') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group" {{ $errors->has('nm_brg') ? 'has-error' : '' }}>
                            <label for="nm_brg">Nama Barang</label>
                            <input class="form-control"  name="stoks_id" id="stoks_id" type="text" placeholder="Nama barang" value="{{ old('stoks_id', $ins->stoks_id) }}" hidden>
                            <select name="nm_brg" id="nm_brg" class="form-control">
                                <option value="">- pilih -</option>
                                @foreach ($stokss as $stoks)
                                <option {{$ins->nm_brg1 == $stoks->items_id ? 'selected' :''}} value="{{$stoks->items_id}}">{{$stoks->itemsss->nm_brg}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" {{ $errors->has('jns_brg') ? 'has-error' : '' }}>
                            <label for="jns_brg">Jenis</label>
                            <select class='form-control' name='jns_brg' required='required' id='input-barang'>
                                <option value="">- pilih -</option>
                                @foreach ($stks as $row)
                                <option {{$ins->jns_brg1 == $row->id ? 'selected' :''}} value="{{$row->id}}">{{$row->jns_brg}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group" {{ $errors->has('jumlah') ? 'has-error' : '' }}>
                            <label for="jumlah">QTY</label>
                            <input class="form-control"  name="jumlah" id="jumlah" type="number" placeholder="Biaya pesan per Kg" value="{{ old('jumlah', $ins->jumlah) }}">
                        </div>
                        <div class="form-group" {{ $errors->has('tanggal') ? 'has-error' : '' }}>
                            <label for="tanggal">Tanggal</label>
                            <input class="form-control"  name="tanggal" id="tanggal" type="date" placeholder="Biaya pesan per Kg" value="{{ old('tanggal', $ins->tanggal) }}">
                        </div>
                        <div class="form-group" {{ $errors->has('hrg_item') ? 'has-error' : '' }}>
                            <label for="hrg_item">Harga Item</label>
                            <input class="form-control"  name="hrg_item" id="hrg_item" type="text" placeholder="Biaya pesan per Kg" value="{{ old('hrg_item', $ins->hrg_item) }}">
                        </div>                         
                        <div class="form-group">
                            
                            <input type="submit" class="btn btn-success" value="Simpan">
                            
                            <a href="{{ url('/masuk') }}" class="btn btn-default">Cancel</a>     
                        </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection ('content')