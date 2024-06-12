<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('manfashion/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('manfashion/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('manfashion/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('manfashion/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('manfashion/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('manfashion/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('manfashion/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('manfashion/css/style.css')}}" type="text/css">
    @yield('css')
</head>

<body>
@include('sitePartials.header')

@yield('content')

@include('sitePartials.footer')

<!-- Js Plugins -->
<script src="{{asset('manfashion/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('manfashion/js/bootstrap.min.js')}}"></script>
<script src="{{asset('manfashion/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('manfashion/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('manfashion/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('manfashion/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('manfashion/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('manfashion/js/mixitup.min.js')}}"></script>
<script src="{{asset('manfashion/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('manfashion/js/main.js')}}"></script>
@yield('js')
</body>

</html>
