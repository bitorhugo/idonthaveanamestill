<!DOCTYPE html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>


        <link href="{{URL::asset("css/font-face.css")}}" rel="stylesheet" media="all">
        <link href=" {{URL::asset("vendor/font-awesome-4.7/css/font-awesome.min.css")}} rel="stylesheet" media="all">
        
        <link href="{{URL::asset( 'vendor_/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('vendor_/mdi-font/css/material-design-iconic-font.min.css')}}"
              rel="stylesheet"
              media="all">

        
        <link href="{{URL::asset('bootstrap4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

        <link href="{{URL::asset('vendor_/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}"
              rel="stylesheet"
              media="all">
        <link href="{{URL::asset('vendor_/wow/animate.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('vendor_/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('vendor_/slick/slick.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('vendor_/select2/select2.min.css')}}" rel="stylesheet" media="all">

        
        <!-- Main CSS-->
        <link href="{{URL::asset("css/theme.css")}}" rel="stylesheet" media="all">
        <link href="{{URL::asset("css/lab.css")}}" rel="stylesheet" media="all">
        <link href="{{URL::asset("css/custom1.css")}}" rel="stylesheet" media="all">

        <!-- Jquery JS-->
        <script src="{{URL::asset('vendor_/jquery-3.2.1.min.js')}}"></script>
        <!-- Bootstrap JS-->
        <script src="{{URL::asset('vendor_/bootstrap-4.1/popper.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/bootstrap-4.1/bootstrap.min.js')}}"></script>
        <!-- Vendor_ JS -->
        <script src="{{URL::asset('vendor_/slick/slick.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/wow/wow.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/animsition/animsition.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/counter-up/jquery.waypoints.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/counter-up/jquery.counterup.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/circle-progress/circle-progress.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
        <script src="{{URL::asset('vendor_/chartjs/Chart.bundle.min.js')}}"></script>
        <script src="{{URL::asset('vendor_/select2/select2.min.js')}}"></script>
        

        
        <!-- Fontfaces CSS-->
        <link href="css/font-face.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

        <!-- Bootstrap CSS-->
        <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

        <!-- Libraries Stylesheet -->
        <link href="{{URL::asset("lib/owlcarousel/assets/owl.carousel.min.css")}}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{URL::asset("css/style.css")}}" rel="stylesheet">

        <!-- Vendor CSS-->
        <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="{{URL::asset("css/theme.css")}}" rel="stylesheet" media="all">
        <link href="{{URL::asset("css/lab.css")}}" rel="stylesheet" media="all">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{asset('js/custom1.js')}}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    
    <body class="animsition">
        <div class="page-wrapper">
            <div class="page-content--bgf7">
                @include('partials.headerApp')
                @yield('content')
                @include('partials.footer')
            </div>
        </div>
    </body>
    
</html> 
