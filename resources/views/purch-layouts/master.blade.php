<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sistem Informasi Gudang - Wira Samudra<</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Consulting Website Template Free Download" name="keywords">
        <meta content="Consulting Website Template Free Download" name="description">

        <!-- Favicon -->
        <link href="../img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="{{asset('assets/webfonts/font-family.css')}}" rel="stylesheet">
        
        <!-- CSS Libraries -->
        <link href="{{asset('assets/css1/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css1/all.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/lib1/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/lib1/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset('assets/css1/style.css')}}" rel="stylesheet">
        @yield('header')
    </head>
    <body>

    @if(auth()->user()->level=="2")
	@include ('purch-layouts.nav')

    @yield('content')
    @else 
    @include ('login')

    @endif
    <script src="{{asset('assets/js1/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('assets/js1/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/lib1/easing/easing.min.js')}}"></script>
        <script src="{{asset('assets/lib1/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/lib1/waypoints/waypoints.min.js')}}"></script>
        <script src="{{asset('assets/lib1/counterup/counterup.min.js')}}"></script>
        
        <!-- Contact Javascript File -->
        <script src="{{asset('assets/mail1/jqBootstrapValidation.min.js')}}"></script>
        <script src="{{asset('assets/mail1/contact.js')}}"></script>

        <!-- Template Javascript -->
        <script src="{{asset('assets/js1/all.min.js')}}"></script>
        <script src="{{asset('assets/js1/main.js')}}"></script>
        <script src="{{asset('assets/js/argon.js?v=1.2.0')}}"></script>
    @yield('footer.script')
    </body>
</html>