@extends('layouts.admin')

@section('module')
    Company
@endsection

@section('before-path')
    Company-List
@endsection

@section('title')
    Add new Company
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('company.index')}}">@yield('before-path')</a></li>
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
        <div class="card-header py-3 d-flex justify-content-end">
            <a href="{{route('company.index')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Company name" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                    <strong>Warning!  </strong>{{$message}}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="text-capitalize">phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Company phone" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                    <strong>Warning!  </strong>{{$message}}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sr_name" class="text-capitalize">Representative Name</label>
                                <input type="text" name="sr_name" class="form-control" id="sr_name" placeholder="Enter Company representative Name" {{ old('sr_name') }}>
                                @error('sr_name')
                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                    <strong>Warning!  </strong>{{$message}}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo" class="text-capitalize">logo</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="img-thumbnail">
                                            <img :src="image" alt="logo" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-8 align-self-end">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="logo" class="form-control" id="logo"
                                                           placeholder="Enter Company logo" @change="fileChange">
                                                    @error('logo')
                                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                        <strong>Warning! </strong>{{$message}}
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    </div>
                                                    @enderror

                                                </div>
                                                <div class="input-group-append">
                                                                            <span class="input-group-text bg-gradient-primary text-light"
                                                                                  id="">Upload Logo</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save @yield('module')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
