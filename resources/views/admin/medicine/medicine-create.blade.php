@extends('layouts.admin')

@section('module')
    Medicine
@endsection

@section('before-path')
    Medicine-List
@endsection

@section('title')
    Add new Medicine
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a
                    href="{{route('medicine.index')}}">@yield('before-path')</a></li>
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
        <div class="col-md-6">{{--Add new Medicine --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-end">
                    <a href="{{route('medicine.index')}}" class="btn btn-sm btn-outline-primary"><i
                            class="fa fa-list"></i>@yield('before-path')</a>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form action="{{route('medicine.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="text-capitalize">Name</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror" id="name"
                                               placeholder="Enter Medicine name" value="{{ old('name') }}">
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
                                        <label for="generic_name" class="text-capitalize">Medicine Generic Name</label>
                                        <select class="custom-select mr-sm-2 @error('generic_name') is-invalid @enderror" id="generic_name" name="generic_name">
                                            <option selected disabled>--Select Generic Name--</option>
                                            @foreach($generics as $generic)
                                                <option value="{{$generic->id,old('generic_name')}}">
                                                {{$generic->name}}

                                            @endforeach
                                        </select>
                                        @error('generic_name')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company" class="text-capitalize">Medicine company Name</label>
                                        <select class="custom-select mr-sm-2 @error('company') is-invalid @enderror" id="company" name="company">
                                            <option selected disabled class="text-capitalize">--Select Company Name--</option>
                                            @foreach($companies as $company)
                                                <option class="text-capitalize" value="{{$company->id,old('company')}}">
                                                {{$company->name}}

                                            @endforeach
                                        </select>
                                        @error('company')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="text-capitalize">Medicine Category</label>
                                        <select class="custom-select mr-sm-2 @error('category') is-invalid @enderror" id="category" name="category">
                                            <option class="text-capitalize" selected disabled>--Select Medicine Category--</option>
                                            @foreach($categories as $category)
                                                <option class="text-capitalize" value="{{$category->id,old('category')}}">
                                                {{$category->name}}

                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit" class="text-capitalize">Medicine unit</label>
                                        <select class="custom-select mr-sm-2 @error('unit') is-invalid @enderror" id="unit" name="unit">
                                            <option class="text-capitalize" selected disabled>--Select Medicine Unit--</option>
                                            @foreach($units as $unit)
                                                <option class="text-capitalize" value="{{$unit->id,old('unit')}}">
                                                {{$unit->name}}

                                            @endforeach
                                        </select>
                                        @error('unit')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="text-capitalize">Price</label>
                                        <input type="text" name="price"
                                               class="form-control @error('price') is-invalid @enderror" id="price"
                                               placeholder="Enter Medicine name" value="{{ old('price') }}">
                                        @error('price')
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
        </div>
        <div class="col-md-6"> {{--Add new Medicine group and list table --}}
            <div class="row">
                <div class="col-md-8">{{--Medicine group list table --}}
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="text-capitalize text-primary">Medicine Generic name</h4>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Generic Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($generics as $key=>$generic)
                                    <tr>
                                        <th scope="row">{{$loop->index+1}}</th>
                                        <td class="text-capitalize">{{$generic->name}}</td>
                                        <td>-----</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-end">
                            <h6 class="text-primary text-capitalize">Add new Medicine Group</h6>
                        </div>
                        <div class="card-body">
                            <div class="form">
                                <form action="{{route('store_generic')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="generic" class="text-capitalize">Generic Name</label>
                                        <input type="text" name="generic"
                                               class="form-control @error('generic') is-invalid @enderror"
                                               id="generic"
                                               placeholder="Enter Generic Name" value="{{ old('generic') }}">
                                        @error('generic')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>
                                            <p>{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary text-capitalize">Save group
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>{{--Add new Medicine group --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
