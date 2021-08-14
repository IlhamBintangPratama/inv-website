@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header mb-4 mt-3">Edit Jenis Barang</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                <form method="Post" action="{{ url('/jenis/'.$types->id.'/update') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group">
                            <label for="items_id">Nama Barang</label>
                                <select id="items_id" name="items_id" class="form-control">
                                <option value="">- pilih -</option>
                                @foreach(App\Item::all() as $item) 
                                <option  value="{{$item->id}}" selected>
    
                                {{$item->nm_brg}}
    
                                </option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="hrg_item">Harga</label>
                            <input class="form-control"  name="hrg_item" id="hrg_item" type="number" autocomplete="off" placeholder="Harga per item" value="{{ old('hrg_item', $types->hrg_item) }}">
                        </div>  
                        <div class="form-group" {{ $errors->has('jns_brg') ? 'has-error' : '' }}>
                            <label for="jns_brg">Jenis Barang</label>
                            <input class="form-control"  name="jns_brg" id="jns_brg" type="text" autocomplete="off" placeholder="Jenis barang" value="{{ old('jns_brg', $types->jns_brg) }}">
                        </div>
                        <div class="form-group">
                            
                            <input type="submit" class="btn btn-success" value="Simpan">
                            
                            <a href="{{ url('/jenis') }}" class="btn btn-default">Cancel</a>     
                        </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection ('content')