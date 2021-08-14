@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
<div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header mb-4 mt-3">Tambah Data Barang</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
            <form method="Post" action="{{ url('barang') }}" name="post" id="barang_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group">
                            <label for="nm_brg">Nama Barang</label>
                            <input class="form-control @error('nm_brg') is-invalid @enderror"  name="nm_brg" id="nm_brg" type="text" placeholder="Nama Barang" autocomplete="off">
                            @error('nm_brg')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="by_simpan">Biaya Simpan (%)</label>
                            <input class="form-control @error('by_simpan') is-invalid @enderror" name="by_simpan" id="by_simpam" type="number" max="100" placeholder="Biaya simpan per Kg" autocomplete="off">
                            @error('by_simpan')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="by_pesan">Biaya Pesan</label>
                            <input class="form-control @error('by_pesan') is-invalid @enderror"  name="by_pesan" id="by_pesan" type="number" placeholder="Biaya pesan per Kg" autocomplete="off">
                            @error('by_pesan')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>

                        <a href="{{ url('barang') }}" class="btn btn-default">Back</a>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection ('content')
@section('footer.script')

    




