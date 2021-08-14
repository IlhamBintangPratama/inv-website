@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header mb-4 mt-3">Edit Data Barang</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                <form method="Post" action="{{ url('/barang/'.$items->id.'/update') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group" {{ $errors->has('nm_brg') ? 'has-error' : '' }}>
                            <label for="nm_brg">Nama Barang</label>
                            <input class="form-control"  name="nm_brg" id="nm_brg" type="text" placeholder="Nama Barang" value="{{ old('nm_brg', $items->nm_brg) }}" autocomplete="off">
                        </div>
                    
                        <div class="form-group" {{ $errors->has('by_simpan') ? 'has-error' : '' }}>
                            <label for="by_simpan">Biaya Simpan (%)</label>
                            <input class="form-control"  name="by_simpan" id="by_simpan" max="100" type="number" placeholder="Biaya simpan per Kg" value="{{ old('by_simpan', $items->by_simpan) }}" autocomplete="off">
                        </div>
                        <div class="form-group" {{ $errors->has('by_pesan') ? 'has-error' : '' }}>
                            <label for="by_pesan">Biaya Pesan</label>
                            <input class="form-control"  name="by_pesan" id="by_pesan" type="number" placeholder="Biaya pesan per Kg" value="{{ old('by_pesan', $items->by_pesan) }}" autocomplete="off">
                        </div>
                        
                        


                        <div class="form-group">
                            
                                <input type="submit" class="btn btn-success" value="Simpan">
                                
                                <a href="{{ url('/barang') }}" class="btn btn-default">Cancel</a>     
                            </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection ('content')