@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header mb-4 mt-3">Hapus Data Barang Masuk</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
                    <div class="form-group {{ $errors->has('nm_brg') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Nama Barang</label>
                        <input  id="nm_brg" type="text" name="nm_brg" class="form-control"  placeholder="Post Title ..." value="{{ old('nm_brg', $ins->brg1->nm_brg) }}" disabled>

                        @if ($errors->has('nm_brg'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nm_brg') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('jns_brg') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Jenis</label>
                        <input  id="jns_brg" type="text" name="jns_brg" class="form-control"  placeholder="Post Title ..." value="{{ old('jns_brg', $ins->jns1->jns_brg) }}" disabled>
                    </div>
                    <div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">QTY</label>
                        <input  id="jumlah" type="text" name="jumlah" class="form-control"  placeholder="Post Title ..." value="{{ old('jumlah', $ins->jumlah) }}" disabled>
                    </div>
                    <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Tanggal</label>
                        <input  id="tanggal" type="text" name="tanggal" class="form-control"  placeholder="Post Title ..." value="{{ old('tanggal', $ins->tanggal) }}" disabled>
                    </div>
                    <div class="form-group {{ $errors->has('hrg_item') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Harga Item</label>
                        <input  id="hrg_item" type="text" name="hrg_item" class="form-control"  placeholder="Post Title ..." value="{{ old('hrg_item', $ins->hrg_item) }}" disabled>
                    </div>
                    <div class="form-group">
                
                    <form action="{{url('/masuk/'.$ins->id.'/destroy') }}" method="POST" style="display: inline;" 
                        id="delete-form">
                        {{ csrf_field() }} 
                        
                        <button type="submit" class="btn btn-danger" id="delete-btn" >
                           Remove

                        </button>
                    </form>

                    <a href="{{url('/masuk') }}" class="btn btn-default">Cancel</a>     
                </div>

                </div>
                <!-- /.col-sm-4 -->
            </div>
            <!-- /.row -->
        </form>
    </div>
</div>
@endsection ('content')