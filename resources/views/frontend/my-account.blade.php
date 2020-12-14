@extends('layouts.website')

@section('title')
    My Account
@endsection

@section('before-path')

@endsection

@section('breadcrumb-name')

@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <div id="home" class="parallax first-section wow fadeIn animated" data-stellar-background-ratio="0.4" style="background-image: url(&quot;http://127.0.0.1:8000/frontend/images/slider-bg.png&quot;); visibility: visible; background-position: 0px 300px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-contant">
                            <h2>
                                <span class="center"><span class="icon"><img src="http://127.0.0.1:8000/frontend/images/icon-logo.png" alt="#"></span></span>
                                <a href="" class="typewrite" data-period="2000" data-type="[ &quot;Welcome to Life Care&quot;, &quot;We Care Your Health&quot;, &quot;We are Expert!&quot; ]"><span class="wrap">W</span></a>
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end section -->
        <div id="getintouch" class="section wb wow fadeIn" style="padding-bottom:0;">
            <div class="container">
                <div class="heading">
                    <span class="icon-logo"><img src="{{asset('frontend/images/icon-logo.png')}}" alt="#"></span>
                    <h2>My Account</h2>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                My Account
                            </div>
                            <div class="">
                                <ul class="list-group border-0">
                                    <li class="list-group-item"><a href="#">Cras justo odio</a></li>
                                    <li class="list-group-item"><a href="#">Dapibus ac facilisis in</a></li>
                                    <li class="list-group-item"><a href="#">Morbi leo risus</a></li>
                                    <li class="list-group-item"><a href="#">Porta ac consectetur ac</a></li>
                                    <li class="list-group-item"><a href="#">Vestibulum at eros</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
