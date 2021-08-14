@extends('purch-layouts.master')

@section ('content')
<!-- Carousel Start -->
    <div class="row" style="background-color:#092949; height: 300%;">
        <div class="container">
            <style>
                .mol-md-2
                {
                    margin-top: 12%;
                    max-width: 70%;
                    flex: 0 0 70%;
                }
                .mol-md-3
                {
                    margin-top: 12%;
                    max-width: 44%;
                    flex: 0 0 44%;
                }
            </style>

            
                <div class="fact">
                    <div class="mol-md-3">
                        <div class="fact-item">
                            <a class="btn">Cumi</a>
                        </div>
                        <div class="fact-item" style="margin-top: -4.58%">
                            <a class="btn">Cendol</a>
                        </div>
                        <div class="fact-item" style="margin-top: -4.6%">
                            <a class="btn">Bekutak</a>
                        </div>
                        <div class="fact-item" style="margin-top: -4.5%">
                            <a class="btn">Semampar</a>
                        </div>
                    </div>
                </div>
            <div class="mol-md-2" style="width: 50%; margin-left:44.55%;  margin-top:-40.2%;">
                <div class="ch-md-3" style="margin-bottom: 10%" id="stokChart"></div>
            </div>
        </div>
    </div>
        <!-- Carousel End -->

        <!-- Video Modal Start-->
        
        <!-- Video Modal End -->
        
        
        <!-- Fact Start -->
        {{-- <div class="fact">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6">
                        
                        <div class="fact-item">
                            <img src="../img/icon-4.png" alt="Icon">
                            <h2>Qualified Team</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="fact-item">
                            <img src="../img/icon-1.png" alt="Icon">
                            <h2>Individual Approach</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="fact-item">
                            <img src="../img/icon-8.png" alt="Icon">
                            <h2>100% Success</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="fact-item">
                            <img src="../img/icon-6.png" alt="Icon">
                            <h2>100% Satisfaction</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Fact Start -->


@endsection('content')

@section('footer.script')
<script src="{{asset('assets/js/highcharts.js')}}"></script>
<script>
Highcharts.chart('stokChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Stok Gudang'
    },
    subtitle: {
        text: 'WIRA SAMUDRA'
    },
    xAxis: {
        categories: [
            'Nama Barang'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Volume (Kg)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Cumi',
        data: [49.9]

    }, {
        name: 'Cendol',
        data: [83.6]

    }, {
        name: 'Bekutak',
        data: [48.9]

    }, {
        name: 'Semampar',
        data: [42.4]

    }]
});
</script>
@endsection