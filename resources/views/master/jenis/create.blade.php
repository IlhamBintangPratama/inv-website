@extends ('admin-layouts.master')

@section ('content')
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
<div id="page-wrapper" class="container-fluid ml-3 mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header mb-4 mt-3">Tambah Jenis Barang</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                
            <form method="Post" action="{{ url('jenis') }}" name="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset >
                        <div class="form-group">
                            <label for="items_id">Nama Barang</label>
                                <select id="items_id" name="items_id" class="form-control" required='required'>
                                <option value="">- pilih -</option>
                                @foreach(App\Item::all() as $item) 
                                <option value="{{$item->id}}">
    
                                {{$item->nm_brg}}
    
                                </option>
                                @endforeach
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jns_brg">Jenis Barang</label>
                            <input class="form-control" name="jns_brg" id="jns_brg" type="text" placeholder="Jenis Barang" autocomplete="off" required>
                        </div>           
                        <button type="submit" class="btn btn-success">Save</button>

                        <a href="{{ url('jenis') }}" class="btn btn-default">Back</a>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
    
                return false;
            return true;
            
		}
    </script>
</div>
@endsection ('content')




