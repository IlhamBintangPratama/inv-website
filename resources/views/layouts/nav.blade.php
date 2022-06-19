<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header" >
        <a class="navbar-brand" href="/dashboard">
          <img src="{{asset('assets/img/brand/logo1.png')}}" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Menu</span>
          </h6>
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('dashboard')}}">
                <i class="ni ni-shop text-dark"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-master">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">Data Master</span>
              </a>
              <div class="collapse" id="navbar-master">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ url('mana_user')}}" class="nav-link">
                      <span class="sidenav-normal"> Managemen User </span>
                    </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="{{ url('jenis')}}" class="nav-link">
                      <span class="sidenav-normal">  </span>
                    </a>
                  </li> --}}
                </ul>
              </div>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="#navbar-transaksi" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-transaksi">
                <i class="ni ni-money-coins text-orange"></i>
                <span class="nav-link-text">Transaksi</span>
              </a>
              <div class="collapse" id="navbar-transaksi">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ url('masuk')}}" class="nav-link">
                      <span class="sidenav-normal"> Barang Masuk </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('keluar')}}" class="nav-link">
                      <span class="sidenav-normal"> Barang Keluar </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li> --}}
            
            <li class="nav-item">
              <a class="nav-link" href="#navbar-laporan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-laporan">
                <i class="ni ni-single-copy-04 text-dark"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
              <div class="collapse" id="navbar-laporan">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ url('laporan-masuk')}}" class="nav-link">
                      <span class="sidenav-normal"> Laporan Masuk </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('laporan-keluar')}}" class="nav-link">
                      <span class="sidenav-normal"> Laporan Keluar </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Pengaturan</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('profile_adm')}}">
                <i class="ni ni-single-02"></i>
                <span class="nav-link-text">My Profile</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>