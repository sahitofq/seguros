<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fuentes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--

    -->

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--
  <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
  <script src="{{ asset('js/superfish.js') }}"></script>
  <script src="{{ asset('js/camera.js') }}"></script>
  <script src="{{ asset('js/jquery.mobilemenu.js') }}"></script>
  <script src="{{ asset('js/jquery.ui.totop.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/tmstickup.js') }}"></script>
  -->
    


    <script>
        var backendURL = "{{ url('/') }}";

    </script>
    <!--[if lt IE 9]>
  <script src="docs-assets/js/ie8-responsive-file-warning.js"></script>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

  <div style='text-align:center'><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div>  
 <![endif]-->

</head>

<body style="overflow-x: hidden">
    <!--==============================header=================================-->
    <header id="header">
        <div id="stuck_container">
            <div class="container">
                <div class="row">
                    <article class="col-lg-5 col-sm-5 col-xs-12">
                        <div class="logo">
                            <a href="{{ asset('/') }}">
                                <img alt="logo" src="{{ asset('img/logo.svg') }}">
                            </a>
                        </div>
                    </article>
                    <article class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-sm-6 col-xs-12 redeso">
                            <div class="infoheader">
                                <img src="{{ asset('img/mail.svg') }}" alt="" /> info@segurospuma.com
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12 redeso">
                            <div class="infoheader lineaizq">
                                <img src="{{ asset('img/cel.svg') }}" alt="" /> Cel: +57 1 318 842-5431
                            </div>
                        </div>
                    </article>
                    <article class="col-lg-1 col-sm-1 col-xs-12">
                        <div class="respmenu">
                            <div class="container-header">
                                <div class="redes-menu">
                                    <div class="menu" id="btn-menu2">
                                        <span class="line line1"></span>
                                        <span class="line line2"></span>
                                        <span class="line line3"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <nav class="full-menu hide">
                <ul>
                    <li><a href="{{ asset('/') }}">Inicio</a></li>
                    <li><a href="{{ asset('/') }}">Soat</a></li>
                    <li><a href="{{ asset('/') }}">Seguros</a></li>
                    <li><a href="{{ asset('/') }}">S Puma</a></li>
                    <li><a href="{{ asset('/') }}">Soporte</a></li>
                    <li><a href="{{ asset('/') }}">Contacto</a></li>
                </ul>
            </nav>
        </div>



    </header>
