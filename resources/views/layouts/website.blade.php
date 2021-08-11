<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- Site Metas -->
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('frontend/images/fevicon.ico.png')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{asset('frontend/images/apple-touch-icon.png')}}">
    <!-- Bootstrap CSS -->
{{--    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap4.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <!-- Colors CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/colors.css')}}">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/versions.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{'frontend/css/responsive.css'}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
    <!DOCTYPE html>
    <!-- Modernizer for Portfolio -->
    <script src="{{asset('frontend/js/modernizer.js')}}"></script>
    <!-- [if lt IE 9] -->
</head>
<body class="clinic_version">
<!-- LOADER -->
<div id="preloader">
    <img class="preloader" src="{{asset('frontend/images/loaders/heart-loading2.gif')}}" alt="">
</div>
<!-- END LOADER -->
<header>
    <div class="header-top wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a class="navbar-brand" href="{{route('website')}}"><img src="{{asset('frontend/images/logo.png')}}" class="img-fluid"
                                                                             alt="image"></a>
                </div>
                <div class="right-header col-md-10">
                    <div class="header-info">
                        <div class="info-inner">
                            <span class="icontop"><img src="{{asset('frontend/images/phone-icon.png')}}" alt="#"></span>
                            <span class="iconcont"><a href="tel:800 123 456">800 123 456</a></span>
                        </div>
                        <div class="info-inner">
                            <span class="icontop"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <span class="iconcont"><a data-scroll
                                                      href="mailto:info@yoursite.com">info@Doctor-Care.com</a></span>
                        </div>
                        <div class="info-inner">
                            <span class="icontop"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            <span class="iconcont"><a data-scroll href="#">Daily: 7:00am - 8:00pm</a></span>
                        </div>
                        <div class="info-inner">
                            @guest
                                <a href="{{route('login')}}" data-scroll
                                   class="btn btn-light btn-radius btn-brd grd1 effect-1"
                                   style="margin-right: 5px;">Log in</a>
                                <a href="{{route('register')}}" data-scroll
                                   class="btn btn-light btn-radius btn-brd grd1 effect-1"
                                   style="margin-right: 10px; margin-left: 5px;">Sign Up</a>
                            @endguest
                            @auth
                                <a href="{{ route('home') }}" data-scroll
                                   class="btn btn-light btn-radius btn-brd grd1 effect-1">My
                                    Account</a>

                                <a class="btn btn-light btn-radius btn-brd grd1 effect-1" href="{{ route('logout') }}" data-scroll
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom wow fadeIn">
        <div class="container">
            <nav class="main-menu">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar"><i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a class="active" href="{{route('website')}}">Home</a></li>
                        <li><a data-scroll href="#about">About us</a></li>
                        <li><a data-scroll href="#service">Services</a></li>
                        <li><a data-scroll href="#doctors">Doctors</a></li>
                        <li><a data-scroll href="#price">Price</a></li>
                        <li><a data-scroll href="#testimonials">Testimonials</a></li>
                        <li><a data-scroll href="#getintouch">Contact</a></li>
                    </ul>
                </div>
            </nav>
            <div class="serch-bar">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control input-lg" placeholder="Search"/>
                        <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="content">
    @yield('content')

    <footer id="footer" class="footer-area wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo padding">
                        <a href=""><img src="{{asset('frontend/images/logo.png')}}" alt=""></a>
                        <p>Locavore pork belly scen ester pine est chill wave microdosing pop uple itarian cliche
                            artisan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-info padding">
                        <h3>CONTACT US</h3>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> PO Box 16122 Collins Street West Victoria
                            8007 Australia</p>
                        <p><i class="fa fa-paper-plane" aria-hidden="true"></i> info@gmail.com</p>
                        <p><i class="fa fa-phone" aria-hidden="true"></i> (+1) 800 123 456</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="subcriber-info">
                        <h3>SUBSCRIBE</h3>
                        <p>Get healthy news, tip and solutions to your problems from our experts.</p>
                        <div class="subcriber-box">
                            <form id="mc-form" class="mc-form">
                                <div class="newsletter-form">
                                    <input type="email" autocomplete="off" id="mc-email" placeholder="Email address"
                                           class="form-control" name="EMAIL">
                                    <button class="mc-submit" type="submit"><i class="fa fa-paper-plane"></i></button>
                                    <div class="clearfix"></div>
                                    <!-- mailchimp-alerts Start -->
                                    <div class="mailchimp-alerts">
                                        <div class="mailchimp-submitting"></div>
                                        <!-- mailchimp-submitting end -->
                                        <div class="mailchimp-success"></div>
                                        <!-- mailchimp-success end -->
                                        <div class="mailchimp-error"></div>
                                        <!-- mailchimp-error end -->
                                    </div>
                                    <!-- mailchimp-alerts end -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<div class="copyright-area wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="footer-text">
                    <p>© 2018 Doctor-Care. All Rights Reserved.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="social">
                    <ul class="social-links">
                        <li><a href=""><i class="fa fa-rss"></i></a></li>
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-youtube"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end copyrights -->
<a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
<!-- all js files -->
<script src="{{asset('frontend/js/all.js')}}"></script>
<!-- all plugins -->
<script src="{{asset('frontend/js/custom.js')}}"></script>
<!-- map -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNUPWkb4Cjd7Wxo-T4uoUldFjoiUA1fJc&callback=myMap"></script>

</body>
</html>
