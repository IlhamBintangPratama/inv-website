@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header mb-4 mt-3">Hapus Data Barang</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                    <div class="form-group {{ $errors->has('nm_brg') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Nama Barang:</label>
                        <input  id="nm_brg" type="text" name="nm_brg" class="form-control"  placeholder="Post Title ..." value="{{ old('nm_brg', $items->nm_brg) }}" disabled>

                        @if ($errors->has('nm_brg'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nm_brg') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('by_simpan') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Biaya Simpan:</label>
                        <input  id="by_simpan" type="text" name="by_simpan" class="form-control"  placeholder="Post Title ..." value="{{ old('by_simpan', $items->by_simpan) }}" disabled>
                    </div>
                    <div class="form-group {{ $errors->has('by_pesan') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Biaya Pesan:</label>
                        <input  id="by_pesan" type="text" name="by_pesan" class="form-control"  placeholder="Post Title ..." value="{{ old('by_pesan', $items->by_pesan) }}" disabled>
                    </div>

                   <div class="form-group">
                
                    <form action="{{url('/barang/'.$items->id.'/destroy') }}" method="POST" style="display: inline;" 
                        id="delete-form">
                        {{ csrf_field() }} 
                        
                        <button type="submit" class="btn btn-danger" id="delete-btn" >
                           Remove

                        </button>
                    </form>

                    <a href="{{url('/barang') }}" class="btn btn-default">Cancel</a>     
                </div>
                
                </div>
                <!-- /.col-sm-4 -->
            </div>
            <!-- /.row -->
        </form>
    </div>
</div>
@endsection ('content')