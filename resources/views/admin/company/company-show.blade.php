@extends('layouts.admin')

@section('module')
    Company
@endsection

@section('before-path')
    Company-List
@endsection

@section('title')
    Company Details
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('company.index')}}">@yield('before-path')</a>
            </li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
@endsection
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <a href="{{route('company.edit',$company->id)}}" class="btn btn-sm btn-outline-primary text-capitalize"><i
                    class="fa fa-edit"></i> update @yield('module')</a>
            <a href="{{route('company.index')}}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <ul class="list-group">
                        <li class="list-group-item text-capitalize"><span class="text-primary font-weight-bold">Company name : </span><span>{{$company->name}}</span></li>
                        <li class="list-group-item text-capitalize"><span class="text-primary font-weight-bold">Representative name : </span><span>{{$company->sr_name}}</span></li>
                        <li class="list-group-item text-capitalize"><span class="text-primary font-weight-bold">Contact number : </span><span>{{$company->phone}}</span></li>
                        <li class="list-group-item text-capitalize"><span class="text-primary font-weight-bold">Email Address : </span><span>{{$company->phone}}</span></li>
                        <li class="list-group-item text-capitalize"><span class="text-primary font-weight-bold">Address : </span><span>Address Asbe</span></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="card-img">
                        <div class="">
                            <img src="{{asset($company->logo)}}" alt="{{$company->name}}" class="img-fluid">
                        </div>
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
