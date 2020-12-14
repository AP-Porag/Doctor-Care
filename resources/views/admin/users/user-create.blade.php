@extends('layouts.admin')

@section('module')
    User
@endsection

@section('before-path')
    User-List
@endsection

@section('title')
    Add new User
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('user.index')}}">@yield('before-path')</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>

    </style>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <a href="{{route('user.index')}}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{route('user.store')}}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="Enter User name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="text-capitalize">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                       placeholder="Enter email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="text-capitalize">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Enter password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="text-capitalize">Role</label>
                                <select name="role[]" id="role" class="custom-select select2 text-capitalize" multiple>
                                    <option value="" selected disabled>--Select Role--</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" class="form-control text-capitalize">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
