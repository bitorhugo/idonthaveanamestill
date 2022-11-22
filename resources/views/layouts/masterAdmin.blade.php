<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">

        <!-- Title Page-->
        <title>Admin Page</title>

        
        <link href="{{URL::asset("css/font-face.css")}}" rel="stylesheet" media="all">
        <link href=" {{URL::asset("vendor/font-awesome-4.7/css/font-awesome.min.css")}} rel="stylesheet" media="all">
        
        <link href="{{URL::asset( 'vendor_/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('vendor_/mdi-font/css/material-design-iconic-font.min.css')}}"
                rel="stylesheet"
                media="all">

        
        <link href="{{URL::asset('vendor_/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
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
        

    </head>

    <body class="animsition">
        <div class="page-wrapper">
            <div class="page-content--bgf7">
                @include('partials.headerAdmin')
                @yield('content')
                @include('partials.footer')
            </div>
        </div>

        <!-- Jquery JS-->
        <script src="{{URL::asset("vendor_/jquery-3.2.1.min.js")}}"></script>
        <!-- Bootstrap JS-->
        <script src="{{URL::asset("vendor_/bootstrap-4.1/popper.min.js")}}"></script>
        <script src="{{URL::asset("vendor_/bootstrap-4.1/bootstrap.min.js")}}"></script>
        <!-- Vendor_ JS -->
        <script src="{{URL::asset("vendor_/slick/slick.min.js")}}"></script>
        <script src="{{URL::asset("vendor_/wow/wow.min.js")}}"></script>
        <script src="{{URL::asset("vendor_/animsition/animsition.min.js")}}"></script>
        <script src="{{URL::asset("vendor_/bootstrap-progressbar/bootstrap-progressbar.min.js")}}">
        </script>
        <script src="{{URL::asset("vendor_/counter-up/jquery.waypoints.min.js")}}"></script>
        <script src="{{URL::asset("vendor_/counter-up/jquery.counterup.min.js")}}">
        </script>
        <script src="{{URL::asset("vendor_/circle-progress/circle-progress.min.js")}}"></script>
        <script src="{{URL::asset("vendor_/perfect-scrollbar/perfect-scrollbar.js")}}"></script>
        <script src="{{URL::asset("vendor_/chartjs/Chart.bundle.min.js")}}"></script>
        <script src="{{URL::asset("vendor_/select2/select2.min.js")}}">
        </script>

        <!-- Main JS-->
        <script src="{{asset("js/main.js")}}"></script>

    </body>

</html>
<!-- end document-->
