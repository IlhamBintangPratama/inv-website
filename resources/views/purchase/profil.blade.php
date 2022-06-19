@extends('purch-layouts.master')
@section('content')
<div class="contact mt-125">
    <div class="container">
        <h1>Profil Saya</h1>
        <div class="row align-items-center mt-5 ">
            
            <div class="col-md-12">
                <div class="contact-form" style="background: rgb(253, 253, 253)">
                    <div id="success"></div>
                    <form class="form-horizontal" method="POST" action="{{ route('changeProfil') }}">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Nama Pengguna</label>
                                <input class="form-control"  name="name" id="name" type="text" value="{{ old('name', $profil->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control"  name="email" id="email" type="text" value="{{ old('email', $profil->email) }}">
                            </div>
                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>
    
                                
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>
    
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                
                            </div>
    
                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>
    
                            
                                    <input id="new-password" type="password" class="form-control" name="new-password" placeholder="Kosongkan jika tidak di ubah">
    
                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                    @endif
                            
                            </div>
    
                            <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
    
                            
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" placeholder="Kosongkan jika tidak di ubah">
                        
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4" style="margin-left: -15px">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection