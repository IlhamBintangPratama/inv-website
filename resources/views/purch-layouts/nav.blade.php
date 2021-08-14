<div class="navbar navbar-expand-lg bg-gray-dark navbar-dark">
    <div class="container-fluid">
        <a href="{{url('home')}}" class="navbar-brand">
        <img src="{{asset('assets/img/brand/logo2.png')}}" height="55rem" width="113px" alt="">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse" ">
            <div class="navbar-nav ml-auto">
                {{-- <a href="{{url('home')}}" class="nav-item nav-link">Home</a> --}}
                <a href="{{url('home')}}" class="nav-item nav-link">Purchase Order</a>
                <a href="{{url('purchase/kebutuhan')}}" class="nav-item nav-link">Kebutuhan Gudang</a>
                <a href="{{url('purchase/riwayat')}}" class="nav-item nav-link">Riwayat</a>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" onclick>Pengaturan</a>
                    <div class="dropdown-menu">
                        <a href="{{ url('purchase/profil')}}" class="dropdown-item">Profil</a>
                        <a href="{{ url('logout-user')}}" class="dropdown-item">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>