@extends('layouts.admin')

@section('module')
    Doctor
@endsection

@section('before-path')
    Doctor List
@endsection

@section('title')
    Add new Doctor
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{ route('doctor.index') }}">@yield('before-path')</a></li>
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
            <a href="{{ route('doctor.index') }}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{ route('doctor.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter Doctor name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="text-capitalize">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter Doctor Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="text-capitalize">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter Password" value="{{ old('password') }}">
                                @error('password')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="text-capitalize">phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="text-capitalize">Address</label>
                                <textarea name="address" id="address" cols="30" class="form-control" {{ old('phone') }}
                                    rows="3">Enter Your Address Here</textarea>

                                @error('address')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
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
                                                    <input type="file" name="profile_picture" class="form-control"
                                                        id="profile_picture" placeholder="Enter supplier profile_picture"
                                                        @change="fileChange">
                                                    @error('profile_picture')
                                                        <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                            <strong>Warning! </strong>{{ $message }}
                                                            <button type="button" class="close"
                                                                data-dismiss="alert">&times;</button>
                                                        </div>
                                                    @enderror

                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-gradient-primary text-light"
                                                        id="">Upload profile_picture</span>
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
