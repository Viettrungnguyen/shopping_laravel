<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('web/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">
    
    @yield('css')
</head>

<body>
    @include('partials.web.header')
    @include('partials.web.menu')
    @include('partials.web.slider')
    @yield('content')
    @include('partials.web.footer')

    @yield('js')
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('web/js/jquery.easing.1.3.min.js') }}"></script>
    <script src="{{ asset('web/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/script.slider.js') }}"></script>
</body>

</html>
