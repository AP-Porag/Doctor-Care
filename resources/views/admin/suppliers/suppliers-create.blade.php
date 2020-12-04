@extends('layouts.admin')

@section('title')
    Create-Supplier
@endsection

@section('before-path')
    Supplier-List
@endsection

@section('breadcrumb-name')
    Add new Supplier
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('supplier.index')}}">@yield('before-path')</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('breadcrumb-name')</li>
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
            <a href="{{route('supplier.index')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus-circle"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{route('supplier.store')}}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Supplier name">
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
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter supplier phone">
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
                                <input type="text" name="sr_name" class="form-control" id="sr_name" placeholder="Enter Supplier representative Name">
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
                                <input type="text" name="logo" class="form-control" id="logo" placeholder="Enter supplier logo">
                                @error('logo')
                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                    <strong>Warning!  </strong>{{$message}}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Supplier</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
