@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1 style="margin-left: -4%;">Data Supplier</h1>
        <div class="row align-items-center mt-5 ">
            
            <div class="col-md-7">
                <div class="contact-form" style="background: rgb(253, 253, 253); width:190%; margin-left: -7%;">
                    <div id="success"></div>
                    
                            <div class="table-responsive mt-4">
                                    <script>
                                        function hanyaAngka(evt) {
                                        var charCode = (evt.which) ? evt.which : event.keyCode
                                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                                
                                            return false;
                                        return true;
                                        }
                                    </script>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content" style="width: 100%;">
                                                <div class="modal-header">
                                                    
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="form-horizontal" method="POST" action="{{ route('tambahSuplier2') }}" autocomplete="off">
                                                    {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="suplier" class="col-md-4 control-label">Supplier</label>
                                                            <input class="form-control ml-3" style="width: 90%" name="suplier" id="suplier" type="text" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="no_telp" class="col-md-4 control-label">No. Telp</label>
                                                            <input class="form-control ml-3" style="width: 90%; height: 45px;" name="no_telp" id="no_telp" onkeypress="return hanyaAngka(event)" type="number" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                                <button type="submit" class="btn-primary" style="height: 37px">
                                                                    Simpan
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $("#email").attr("autocomplete", "off");
                                                                $("#new-password").attr("autocomplete", "off");
                                                                $("#new-password-confirm").attr("autocomplete", "off");
                                                            });
                                                        </script>
                                                </form>
                                                {{-- <script>        
                                                    function phoneno(evt){          
                                                        $('#phone').keypress(function(e) {
                                                            var a = [];
                                                            var k = e.which;
                                            
                                                            for (i = 48; i < 58; i++)
                                                                a.Push(i);
                                            
                                                            if (!(a.indexOf(k)>=0))
                                                                e.preventDefault();
                                                        });
                                                    }
                                                </script> --}}
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <table class="table align-items-center table-flush">
                                        <div class="new" style="margin-left: 0px; margin-bottom: 10px;">
                                            <button href="#" class="btn-md btn-success" data-toggle="modal" data-target="#exampleModal">Baru</button>
                                        </div>
                                    <thead class="thead-light">
                                        <tr>
                                        <th scope="col" class="sort" data-sort="name">No</th>
                                        <th scope="col" class="sort" data-sort="name">Supplier</th>
                                        <th scope="col" class="sort" data-sort="name">No Telp</th>
                                        <th scope="col" class="sort" data-sort="name">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($awal1 as $laps)
                                        <tr>
                                        <td class="budget">
                                            {{$loop->iteration }}
                                        </td>
                                        <td class="budget">
                                            {{ $laps->name }}
                                        </td>
                                        <td class="budget">
                                            {{ $laps->no_telp }}
                                        </td>
                                        <td>  
                                            <form action="{{url('purchase/suplier/'.$laps->id.'/destroy') }}" method="POST"
                                                id="delete-form">
                                                {{ csrf_field() }} 
                                                
                                                <button type="submit" class="btn-sm btn-danger" id="delete-btn" onclick="return confirm('Data yakin dihapus ?')" >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                                <div class="card-footer py-4">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                        {{ $awal1->links()}}
                                        </ul>
                                    </nav>
                                </div>
                                <hr>
                            </div>
                </div>
        </div>
    </div>
</div>
</div>
@include('sweetalert::alert')
@endsection
