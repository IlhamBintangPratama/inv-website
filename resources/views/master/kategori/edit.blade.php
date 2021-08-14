@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header mb-4 mt-3">Edit Kategori Barang</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                <form method="Post" action="{{ url('/kategori/'.$categoris->id.'/update') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group" {{ $errors->has('kategori') ? 'has-error' : '' }}>
                            <label for="kategori">Kategori Barang:</label>
                            <input class="form-control"  name="kategori" id="kategori" type="text" placeholder="Kategori barang" autocomplete="off" value="{{ old('kategori', $categoris->kategori) }}">
                        </div>                
                        <div class="form-group">
                            
                            <input type="submit" class="btn btn-success" value="Simpan">
                            
                            <a href="{{ url('/kategori') }}" class="btn btn-default">Cancel</a>     
                        </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection ('content')