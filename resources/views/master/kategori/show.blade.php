@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header mb-4 mt-3">Hapus Kategori Barang</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                    <div class="form-group {{ $errors->has('kategori') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Kategori Barang:</label>
                        <input  id="kategori" type="text" name="kategori" class="form-control"  placeholder="Post Title ..." value="{{ old('kategori', $categoris->kategori) }}" disabled>

                        @if ($errors->has('kategori'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kategori') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                
                    <form action="{{url('/kategori/'.$categoris->id.'/destroy') }}" method="POST" style="display: inline;" 
                        id="delete-form">
                        {{ csrf_field() }} 
                        
                        <button type="submit" class="btn btn-danger" id="delete-btn" >
                           Remove

                        </button>
                    </form>

                    <a href="{{url('/kategori') }}" class="btn btn-default">Cancel</a>     
                </div>

                </div>
                <!-- /.col-sm-4 -->
            </div>
            <!-- /.row -->
        </form>
    </div>
</div>
@endsection ('content')