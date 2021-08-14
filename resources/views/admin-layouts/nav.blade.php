<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header" >
        <a class="navbar-brand" href="/dashboard">
          <img src="{{asset('assets/img/brand/logo1.png')}}" class="navbar-brand-img" height="79" width="69%" alt="...">
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
              <a class="nav-link" href="/dashboard">
                <i class="ni ni-shop text-dark"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-master">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">Master Data</span>
              </a>
              <div class="collapse" id="navbar-master">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ url('barang')}}" class="nav-link">
                      <span class="sidenav-normal"> Data Barang </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('jenis')}}" class="nav-link">
                      <span class="sidenav-normal"> Data Jenis </span>
                    </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="{{ url('kategori')}}" class="nav-link">
                      <span class="sidenav-normal"> Data Kategori </span>
                    </a>
                  </li> --}}
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-transaksi" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-transaksi">
                <i class="ni ni-money-coins text-orange"></i>
                <span class="nav-link-text">Transaksi</span>
              </a>
              <div class="collapse" id="navbar-transaksi">
                <ul class="nav nav-sm flex-column">
                  
                  <li class="nav-item">
                    <a href="{{ url('permintaan')}}" class="nav-link">
                      <span class="sidenav-normal"> Permintaan Stok </span>
                    </a>
                  </li>
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
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-perhitungan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-perhitungan">
                <i class="ni ni-chart-bar-32 text-success"></i>
                <span class="nav-link-text">Perhitungan</span>
              </a>
              <div class="collapse" id="navbar-perhitungan">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ url('eoq/create')}}" class="nav-link">
                      <span class="sidenav-normal"> Economic Order Quantity </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('rop/create')}}" class="nav-link">
                      <span class="sidenav-normal"> Reorder Point </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-laporan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-laporan">
                <i class="ni ni-single-copy-04 text-dark"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
              <div class="collapse" id="navbar-laporan">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ url('laporan-stok')}}" class="nav-link">
                      <span class="sidenav-normal"> Laporan Stok Gudang </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('laporan-hasil-metode')}}" class="nav-link">
                      <span class="sidenav-normal"> Hasil Perhitungan </span>
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
              <a class="nav-link" href="{{ url('profile')}}">
                <i class="ni ni-single-02"></i>
                <span class="nav-link-text">My Profile</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>