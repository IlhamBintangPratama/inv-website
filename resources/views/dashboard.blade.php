<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
@extends('admin-layouts.master')

@section ('content')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include ('admin-layouts.top')
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title text-uppercase text-muted mb-0">Produk</h4>
                      <span class="h2 font-weight-bold mb-0">{{\App\Item::count()}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm mb-4">
                  </p>
                </div>
              </div>
            </div>
            <script>
              function blink_(){
                var el=document.getElementById("blink_").style.opacity;
                if(el==1){
                  document.getElementById("blink_").style.opacity=0;
                }else{
                  document.getElementById("blink_";).style.opacity=1;
                }
                setTimeout('blink_()', 500);
              }
              blink_();
              </script>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Kapasitas Gudang</h5>
                      <span class="h2 font-weight-bold mb-0" id='blink_' style="color: {{($kapasitas == 199899) ? 'red' : 'black'}}">{{($kapasitas == 200000) ? $kapasitas : $kapasitas}}/200000</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm mb-4">
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Transaksi Masuk</h5>
                      <span class="h2 font-weight-bold mb-0">{{\App\In::count()}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm mb-4">
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Transaksi Keluar</h5>
                      <span class="h2 font-weight-bold mb-0">{{\App\Out::count()}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm mb-4">
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card bg-default">
            <div id="chartSales"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Stok Gudang</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('stok/create') }}" class="btn btn-sm btn-primary">Stok Baru</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">QTY</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($stoks as $no => $stok)
                  <tr>
                    <td>{{ $stoks->firstItem()+$no}} </td>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $stok->updated_at}}</span>
                        </div>
                      </div>
                    </th>
                    <td class="budget">
                      {{ $stok->item->nm_brg}}
                    </td>
                    <td class="budget">
                      {{ $stok->type->jns_brg}}
                    </td>
                    <td class="budget">
                      {{ $stok->stok }} Kg
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="card-footer py-4">
                <nav aria-label="...">
                  <ul class="pagination justify-content-end mb-0">
                    {{$stoks->links()}}
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        @include('sweetalert::alert')
      </div>
      
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2021 <h4>Created by Tama Dev</h4>
            </div>
          </div>
          {{-- <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div> --}}
        </div>
      </footer>
    </div>
  </div>
  @endsection('content')

  @section('footer.script')
  <script src="{{asset('assets/js/highcharts.js')}}"></script>
  {{-- <script src="{{asset('assets/js1/jquery-3.4.1.min.js')}}"></script> --}}
  <script>
    Highcharts.chart('chartSales', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Penjualan Bulanan'
    },
    subtitle: {
        text: 'CV. Wira Samudra'
    },
    xAxis: {
        categories: {!!json_encode($categories)!!}
    },
    yAxis: {
        title: {
            text: 'Volume (Kg)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: {!!json_encode($nama)!!},
        data: {!!json_encode($data)!!}
    }, {
        name: {!!json_encode($nama1)!!},
        data: {!!json_encode($data1)!!}
    }]
});
// function blink_(){
// 	$('.blink_').fadeOut(500);
// 	$('.blink_').fadeIn(500);
// }
// setInterval(blink_,1000);       
  </script>
  @endsection