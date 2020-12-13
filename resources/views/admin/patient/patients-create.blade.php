@extends('layouts.admin')

@section('module')
    Patient
@endsection

@section('before-path')
    Patient-List
@endsection

@section('title')
    Add new Patient
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('patient.index')}}">@yield('before-path')</a>
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
        <div class="card-header py-3 d-flex justify-content-end">
            <a href="{{route('patient.index')}}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{route('patient.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="text-capitalize">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                               placeholder="Enter Patient name" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="alert alert-danger alert-dismissible fade show mt-1">
                                            <strong>Warning! </strong>{{$message}}
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="text-capitalize">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               placeholder="Enter Patient email" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="alert alert-danger alert-dismissible fade show mt-1">
                                            <strong>Warning! </strong>{{$message}}
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="text-capitalize">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                               placeholder="Enter Patient phone" value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="alert alert-danger alert-dismissible fade show mt-1">
                                            <strong>Warning! </strong>{{$message}}
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="doctor" class="text-capitalize">doctor</label>
                                        <select class="custom-select mr-sm-2" id="doctor" name="doctor">
                                            <option selected disabled>--Select Doctor--</option>
                                            @foreach($doctors as $doctor)
                                            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('doctor')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth_date" class="text-capitalize">Birth Date</label>
                                <input type="date" name="birth_date" class="form-control" id="birth_date"
                                       placeholder="Enter Patient birth date" {{ old('birth_date') }}>
                                @error('birth_date')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>{{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blood_group" class="text-capitalize">Blood Group</label>
                                <select class="custom-select mr-sm-2" id="blood_group" name="blood_group">
                                    <option selected disabled>--Select Blood Group--</option>
                                        <option value="1">A+</option>
                                        <option value="2">A-</option>
                                        <option value="3">B+</option>
                                        <option value="4">B-</option>
                                        <option value="5">AB+</option>
                                        <option value="6">AB-</option>
                                        <option value="7">O+</option>
                                        <option value="8">O-</option>
                                </select>
                                @error('blood_group')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>{{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender" class="text-capitalize">Gender</label>
                                <div class="" id="gender">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" name="male" class="custom-control-input" value="male">
                                        <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="female" class="custom-control-input" value="female">
                                        <label class="custom-control-label" for="female">Female</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="other" name="other" class="custom-control-input" value="other">
                                        <label class="custom-control-label" for="other">Other's</label>
                                    </div>
                                </div>
                                @error('gender')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>{{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="text-capitalize">Address</label>
                                <div class="card p-2" id="address">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country" class="text-capitalize">Country</label>
                                                <input type="text" name="country" class="form-control" id="country"
                                                       placeholder="Enter Patient country" {{ old('country') }}>
                                                @error('country')
                                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                    <strong>Warning! </strong>{{$message}}
                                                    <button type="button" class="close" data-dismiss="alert">&times;
                                                    </button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="division" class="text-capitalize">Division</label>
                                                <input type="text" name="division" class="form-control" id="division"
                                                       placeholder="Select Division" {{ old('division') }}>
                                                @error('division')
                                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                    <strong>Warning! </strong>{{$message}}
                                                    <button type="button" class="close" data-dismiss="alert">&times;
                                                    </button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district" class="text-capitalize">District</label>
                                                <input type="text" name="district" class="form-control" id="district"
                                                       placeholder="Select district" {{ old('district') }}>
                                                @error('district')
                                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                    <strong>Warning! </strong>{{$message}}
                                                    <button type="button" class="close" data-dismiss="alert">&times;
                                                    </button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city" class="text-capitalize">City</label>
                                                <input type="text" name="city" class="form-control" id="city"
                                                       placeholder="Select City" {{ old('city') }}>
                                                @error('city')
                                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                    <strong>Warning! </strong>{{$message}}
                                                    <button type="button" class="close" data-dismiss="alert">&times;
                                                    </button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sub_district" class="text-capitalize">Thana/Sub-District</label>
                                                <input type="text" name="sub_district" class="form-control" id="sub_district"
                                                       placeholder="Enter Thana/Sub-District" {{ old('sub_district') }}>
                                                @error('sub_district')
                                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                    <strong>Warning! </strong>{{$message}}
                                                    <button type="button" class="close" data-dismiss="alert">&times;
                                                    </button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="village" class="text-capitalize">Village/Ward</label>
                                                <input type="text" name="village" class="form-control" id="village"
                                                       placeholder="Enter village name" {{ old('village') }}>
                                                @error('village')
                                                <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                    <strong>Warning! </strong>{{$message}}
                                                    <button type="button" class="close" data-dismiss="alert">&times;
                                                    </button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                           placeholder="Enter Patient logo" @change="fileChange">
                                                    @error('logo')
                                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                                        <strong>Warning! </strong>{{$message}}
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    @enderror

                                                </div>
                                                <div class="input-group-append">
                                                                            <span
                                                                                class="input-group-text bg-gradient-primary text-light"
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
