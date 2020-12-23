@extends('layouts.admin')

@section('module')
    Lab
@endsection

@section('before-path')
    Lab-List
@endsection

@section('title')
    Add new Lab
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('lab.index')}}">@yield('before-path')</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
@endsection
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-end">
                    <a href="{{route('lab.index')}}" class="btn btn-sm btn-outline-primary"><i
                            class="fa fa-list"></i>@yield('before-path')</a>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form action="{{route('lab.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="text-capitalize">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                               placeholder="Enter test name" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advice" class="text-capitalize">advice</label>
                                        <input type="text" name="advice" class="form-control @error('advice') is-invalid @enderror" id="advice"
                                               placeholder="Enter Pre-advice for this test" value="{{ old('advice') }}">
                                        @error('advice')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="text-capitalize">price</label>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                                               placeholder="Enter Test price" value="{{ old('price') }}">
                                        @error('price')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="commission" class="text-capitalize">Commission</label>
                                        <input type="number" name="commission" class="form-control @error('commission') is-invalid @enderror" id="commission"
                                               placeholder="Enter Test commission" value="{{ old('commission') }}">
                                        @error('commission')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="template" class="text-capitalize">Template</label>
                                        <textarea type="text" style=" height:500px;max-height: 500px; min-height: auto;" name="template" class="form-control @error('template') is-invalid @enderror" id="template"
                                                  placeholder="Enter Report template" value="{{ old('template') }}"></textarea>
                                        @error('template')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
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
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'template', {
            uiColor: '#9AB8F3',
            height:500,
        });

    </script>
@endsection
