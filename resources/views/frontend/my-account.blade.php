@extends('layouts.website')

@section('title')
    My Account
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
        <div id="getintouch" class="section wb wow fadeIn" style="padding-bottom:0;margin-bottom: 50px;">
            <div class="container">
                <div class="heading">
                    <span class="icon-logo"><img src="{{asset('frontend/images/icon-logo.png')}}" alt="#"></span>
                    <h3>Hello! {{$user->name}}'s, See all your activity</h3>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="bg-primary">
                                <h3 class="text-white all_appointment_text">All Appointment</h3>
                            </div>
                            <ul class="list-group">
                                @foreach($appointments as $appointment)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Doctor Name : {{$appointment->doctor->name}}
                                        <span class="badge badge-primary badge-pill">{{$appointment->date}}</span>
                                    </li>
                                @endforeach
                            </ul>
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
